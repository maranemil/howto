anychart.onDocumentReady(function () {
    // create a data set
    const data = anychart.data.set([
        [1111, 1331],
        [1222, 1535]
    ]);
    // create a chart
    const chart = anychart.bar();
    // create a bar series and set the data
    const series = chart.bar(data);
    // set the chart title
    chart.title("TensorFlow Samples");
    // set the titles of the axes
    chart.xAxis().title("source");
    chart.yAxis().title("Samples");
    // set the container id
    chart.container("container_samples_tf2");
    // initiate drawing the chart
    chart.draw();
});