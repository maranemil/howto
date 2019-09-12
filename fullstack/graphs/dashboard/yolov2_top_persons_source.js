
setTimeout( function() {
    var dataPoints2 = [];
    function getDataPointsFromCSV2(csv) {
        var dataPoints2 = csvLines2 = points = [];
        csvLines2 = csv.split(/[\r?\n|\r|\n]+/);
        for (var i = 0; i < csvLines2.length; i++)
            if (csvLines2[i].length > 0) {
                points = csvLines2[i].split(",");
                dataPoints2.push({
                    //x: parseFloat(points[0]),
                    label: points[0],
                    y: parseFloat(points[1])
                });
            }
        return dataPoints2;
    }
    $.get("yolov2_top_persons_source.csv", function(data) {
        var chart2 = new CanvasJS.Chart("yolov2_top_persons_source", {
            title: {
                 text: "Yolov2 Top word pers by source",
                 fontSize: 16
                 //fontWeight: "bold"
            },
            axisX:{
                interval: 1,
                margin: 40
            },
            axisY:{
                //title: "Margin",
                margin: 40,
                interlacedColor: "rgba(1,77,101,.2)",
                gridColor: "rgba(1,77,101,.1)"
            },
            data: [{
                 type: "line",
                 dataPoints: getDataPointsFromCSV2(data)
              }]
         });
        chart2.render();
    });
},600);