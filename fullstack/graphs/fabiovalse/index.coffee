italy = undefined

region_capitals = ["Aosta", "Torino", "Genova", "Milano", "Trento", "Trieste", "Venezia", "Bologna", "Firenze", "Ancona", "Perugia", "Roma", "L'Aquila", "Campobasso", "Napoli", "Potenza", "Bari", "Catanzaro", "Palermo", "Cagliari"]
TH_1 = 5
TH_2 = 25

# SVG group structure
svg = d3.select 'svg'
width = svg.node().getBoundingClientRect().width
height = svg.node().getBoundingClientRect().height

zoomable_layer = svg.append 'g'
base_layer = zoomable_layer.append 'g'
boundaries_layer = zoomable_layer.append 'g'
labels_layer = zoomable_layer.append 'g'

# Zoom behaviour
zoom = d3.zoom()
  .scaleExtent [1, Infinity]
  .on 'zoom', () ->
    # Update level of details
    lod d3.event.transform
    # Transform SVG
    zoomable_layer
      .attrs
        transform: d3.event.transform
svg.call(zoom)

# Geographic projection
projection = d3.geoAzimuthalEqualArea()
  .clipAngle 180-1e-3
  .scale 3000
  .rotate [-12.22, -42, 0]
  .translate [width/2, height/2]
  .precision 0.1
path = d3.geoPath().projection(projection)

# Returns a transform for center a bounding box in the browser viewport
# - W and H are the witdh and height of the window
# - w and h are the witdh and height of the bounding box
# - center cointains the coordinates of the bounding box center
# - margin defines the margin of the bounding box once zoomed
to_bounding_box = (W, H, center, w, h, margin) ->
  kw = (W - margin) / w
  kh = (H - margin) / h

  k = d3.min [kw, kh]

  x = W/2 - center.x*k
  y = H/2 - center.y*k

  return d3.zoomIdentity
    .translate x, y
    .scale k

# Filters data outside the current viewport
in_viewport = (d, x0, x1, y0, y1) -> d.properties.bbox.x0 < x1 and d.properties.bbox.x1 > x0 and d.properties.bbox.y0 < y1 and d.properties.bbox.y1 > y0

# Prepares data for being visualized
transform = (data) ->
  regions = {type: 'GeometryCollection', geometries: data.objects.final.geometries.filter (d) -> d.properties.REGIONE?}
  provinces = {type: 'GeometryCollection', geometries: data.objects.final.geometries.filter (d) -> d.properties.PROVINCIA?}
  towns = {type: 'GeometryCollection', geometries: data.objects.final.geometries.filter (d) -> d.properties.COMUNE?}

  data.objects = {
    country: data.objects.country
    regions: regions
    provinces: provinces
    towns: towns
  }

  for key, obj of data.objects
    topojson.feature(data, obj).features.forEach (d,i) ->
      bounds = path.bounds d

      if d.properties.COMUNE?
        d.properties.label = d.properties.COMUNE
      if d.properties.PROVINCIA?
        if d.properties.PROVINCIA is '-'
          d.properties.label = d.properties.DEN_CMPRO
        else
          d.properties.label = d.properties.PROVINCIA
      if d.properties.REGIONE?
        d.properties.label = d.properties.REGIONE

      d.properties.capital = d.properties.label in region_capitals

      if data.objects[key].geometries[i].properties?
        data.objects[key].geometries[i].properties.area = d3.geoArea d
        data.objects[key].geometries[i].properties.bbox = {
          x0: bounds[0][0]
          y0: bounds[0][1]
          x1: bounds[1][0]
          y1: bounds[1][1]
        }
  return data

draw_labels = (data, cls, k) ->
  labels = labels_layer.selectAll ".#{cls}"
    .data data, (d) -> d.properties.label

  en_labels = labels.enter().append 'text'
    .attrs
      class: cls

  all_labels = en_labels.merge(labels)
  all_labels
    .attrs
      x: (d) -> d.properties.bbox.x0 + (d.properties.bbox.x1-d.properties.bbox.x0)/2
      y: (d) -> d.properties.bbox.y0 + (d.properties.bbox.y1-d.properties.bbox.y0)/2
      dy: '0.35em'
    .styles
      'font-size': (d) -> if d.properties.region_capital? and d.properties.region_capital is 1 then 18/k else 14/k
    .classed 'capital', (d) -> d.properties.capital
    .on 'click', (d) ->
      w = d.properties.bbox.x1-d.properties.bbox.x0
      h = d.properties.bbox.y1-d.properties.bbox.y0
      center = {
        x: d.properties.bbox.x0 + w/2
        y: d.properties.bbox.y0 + h/2
      }
      transform = to_bounding_box(width, height, center, w, h, height/10)
      svg.transition().duration(2000).call(zoom.transform, transform)
    .text (d) -> d.properties.label

  labels.exit().remove()

# Level of Details
# filters useless data from the visualization according to the current viewport
lod = (transform) ->
  x0 = -transform.x/transform.k
  y0 = -transform.y/transform.k
  x1 = x0 + width/transform.k
  y1 = y0 + height/transform.k
  k = transform.k

  ### Region labels
  ###
  data = []
  if k <= TH_1
    data = topojson.feature(italy, italy.objects.regions).features
      .filter (d) -> in_viewport(d, x0, x1, y0, y1) and d.properties.area > Math.pow(0.015/k, 2)
  draw_labels data, 'region_label', k

  ### Provinces labels
  ###
  data = []
  if TH_2 > k > TH_1
    data = topojson.feature(italy, italy.objects.provinces).features
      .filter (d) -> in_viewport(d, x0, x1, y0, y1) and d.properties.area > Math.pow(0.01/k, 2)
  draw_labels data, 'province_label', k

  ### Towns labels
  ###
  data = []
  if k > TH_2
    data = topojson.feature(italy, italy.objects.towns).features
      .filter (d) -> in_viewport(d, x0, x1, y0, y1) and d.properties.area > Math.pow(0.025/k, 2)
  draw_labels data, 'town_label', k

# Initialize the layout displaying
# - the base layer of Italy
# - the internal boundaries of regions, provinces and towns
init = (zoomable_layer) ->
  italy or= await fetch 'italy.topo.json'
    .then (response) -> response.json()
    .then (data) -> transform data

  ### Base Layer
  ###
  shapes = base_layer.selectAll '.italy'
    .data topojson.feature(italy, italy.objects.country).features

  en_shapes = shapes.enter().append 'g'
    .attrs
      class: 'italy'
  en_shapes.append 'path'

  all_shapes = en_shapes.merge(shapes)
  all_shapes.select 'path'
    .attrs
      d: path

  shapes.exit().remove()

  ### Boundaries Layer
  ###
  # Regions
  boundaries_layer.append 'path'
    .datum topojson.mesh(italy, italy.objects.regions, (a, b) -> a != b)
    .attr 'class', 'boundaries region'
    .attr 'd', path

  # Provinces
  boundaries_layer.append 'path'
    .datum topojson.mesh(italy, italy.objects.provinces, (a, b) -> a isnt b and a.properties.COD_REG is b.properties.COD_REG)
    .attr 'class', 'boundaries province'
    .attr 'd', path

  # Towns
  boundaries_layer.append 'path'
    .datum topojson.mesh(italy, italy.objects.towns, (a, b) -> a isnt b and a.properties.COD_PRO is b.properties.COD_PRO)
    .attr 'class', 'boundaries town'
    .attr 'd', path

  lod d3.zoomIdentity

init()