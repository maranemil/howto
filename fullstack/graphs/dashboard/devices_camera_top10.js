setTimeout(function () {
    const dataPoints2 = [];

    function getDataPointsFromCSV2(csv) {
        const dataPoints2 = csvLines2 = points = [];
        csvLines2 = csv.split(/[\r?\n|\r|\n]+/);
        for (let i = 0; i < csvLines2.length; i++)
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

    $.get("devices_camera_top10.csv", function (data) {
        const chart2 = new CanvasJS.Chart("devices_camera_top10", {
            title: {
                text: "img by camera",
                fontSize: 16,
                //fontWeight: "bold"
            },
            axisX: {
                interval: 1,
                margin: 40
            },
            axisY: {
                //title: "Margin",
                interlacedColor: "rgba(1,77,101,.2)",
                gridColor: "rgba(1,77,101,.1)",
                margin: 40
            },
            data: [{
                type: "line",
                dataPoints: getDataPointsFromCSV2(data)
            }]
        });
        chart2.render();
    });
}, 600);
