var canvas = document.querySelector("canvas");
var ctx = canvas.getContext("2d");

var video = document.querySelector("video");

var colors = ["red", "blue", "yellow", "orange", "black", "white", "green"];

function draw() {
    ctx.fillStyle = colors[Math.floor(Math.random() * colors.length)];
    ctx.fillRect(0, 0, canvas.width, canvas.height);
}
draw();

var videoStream = canvas.captureStream(30);
var mediaRecorder = new MediaRecorder(videoStream);

var chunks = [];
mediaRecorder.ondataavailable = function(e) {
    chunks.push(e.data);
};

mediaRecorder.onstop = function(e) {
    var blob = new Blob(chunks, { 'type': 'video/mp4' });
    chunks = [];
    var videoURL = URL.createObjectURL(blob);
    video.src = videoURL;
};
mediaRecorder.ondataavailable = function(e) {
    chunks.push(e.data);
};

mediaRecorder.start();
setInterval(draw, 300);
setTimeout(function() { mediaRecorder.stop(); }, 5000);