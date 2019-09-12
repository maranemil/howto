
setTimeout( function() {

    var dataPoints3 = [];
    function getDataPointsFromCSV3(csv) {
        var dataPoints3 = csvLines3 = points = [];
        csvLines3 = csv.split(/[\r?\n|\r|\n]+/);
        for (var i = 0; i < csvLines3.length; i++)
            if (csvLines3[i].length > 0) {
                points = csvLines3[i].split(",");
                dataPoints3.push({
                    y: parseInt(points[1]),
                    label: points[0]
                });
            }
        return dataPoints3;
    }

    $.get("devices_phone_marke.csv", function(data) {
        var chart3 = new CanvasJS.Chart("devices_phone_marke", {
            title:{
                text:"Device phone  Exif  ",
                fontSize: 16,
                //fontWeight: "bold"
            },
            axisX:{
                interval: 1,
                margin: 40,
                fontSize: 12
            },
            /*axisY:{
                margin: 40,
            },*/
            axisY:{
                interlacedColor: "rgba(1,77,101,.2)",
                gridColor: "rgba(1,77,101,.1)",
                title: "Number",
                margin: 40,
                fontSize: 10
            },
            /*data: [{
                type: "bar",
                name: "companies",
                axisYType: "secondary",
                color: "#014D65",
                dataPoints: [
                    { y: 3, label: "Sweden" },
                    { y: 7, label: "Taiwan" },
                    { y: 5, label: "Russia" },
                    { y: 9, label: "Spain" },
                    { y: 7, label: "Brazil" },
                    { y: 7, label: "India" },
                    { y: 9, label: "Italy" },
                    { y: 8, label: "Australia" },
                    { y: 11, label: "Canada" },
                    { y: 15, label: "South Korea" },
                    { y: 12, label: "Netherlands" },
                    { y: 15, label: "Switzerland" },
                    { y: 25, label: "Britain" },
                    { y: 28, label: "Germany" },
                    { y: 29, label: "France" },
                    { y: 52, label: "Japan" },
                    { y: 103, label: "China" },
                    { y: 134, label: "US" }
                ]
            }]*/
            data: [{
                 type: "line",
                 dataPoints: getDataPointsFromCSV3(data)
              }]
        });
        chart3.render();
    });

},200);