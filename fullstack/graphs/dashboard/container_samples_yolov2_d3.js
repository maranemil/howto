anychart.onDocumentReady(function () {
    // create a data set
    const data = anychart.data.set([
        [1111, 2838],
        [1234, 1731]
    ]);
    // create a chart
    const chart = anychart.bar();
    // create a bar series and set the data
    const series = chart.bar(data);
    // set the chart title
    chart.title("Yolov2 Samples");
    // set the titles of the axes
    chart.xAxis().title("Source");
    chart.yAxis().title("Samples");
    // set the container id
    chart.container("container_samples_yolov2");
    // initiate drawing the chart
    chart.draw();
});