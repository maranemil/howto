
window.onload = function() {
    var dataPoints = [];
    var chart = new CanvasJS.Chart("devices_by_type", {
        //animationEnabled: true,
        //exportEnabled: true,
        title: {
            text: "Type Hardware Exif",
            fontSize: 16,
            //fontWeight: "bold"
        },
        axisX:{
          interval: 1,
          margin: 40
        },
        axisY:{
          //title: "Margin",
          interlacedColor: "rgba(1,77,101,.2)",
          gridColor: "rgba(1,77,101,.1)",
          margin: 40
        },
        data: [{
            type: "column",
            toolTipContent: "{y} total",
            dataPoints: dataPoints
        }]
    });
    $.get("devices_by_type.csv", getDataPointsFromCSV);
    //CSV Format
    function getDataPointsFromCSV(csv) {
        var points;
        var csvLines = csv.split(/[\r?\n|\r|\n]+/);
        for (var i = 0; i < csvLines.length; i++) {
            if (csvLines[i].length > 0) {
                points = csvLines[i].split(",");
                dataPoints.push({
                    //label: points[0] + '[' + points[1] + ']' ,
                    label: points[0],
                    y: parseFloat(points[1])
                });
            }
        }
       chart.render();
    }
}