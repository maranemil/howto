anychart.onDocumentReady(function () {
    // create a data set
    const data = anychart.data.set([
        [1111, 2175],
        [1234, 2031]
    ]);
    // create a chart
    const chart = anychart.bar();
    // create a bar series and set the data
    const series = chart.bar(data);
    // set the chart title
    chart.title("Exif Samples");
    // set the titles of the axes
    chart.xAxis().title("source");
    chart.yAxis().title("Samples");
    // set the container id
    chart.container("container_samples_exif");
    // initiate drawing the chart
    chart.draw();
});