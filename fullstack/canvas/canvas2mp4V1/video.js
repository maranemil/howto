const canvas = document.querySelector("canvas");
const ctx = canvas.getContext("2d");
const video = document.querySelector("video");
const colors = ["red", "blue", "yellow", "orange", "black", "white", "green"];

function draw() {
    ctx.fillStyle = colors[Math.floor(Math.random() * colors.length)];
    ctx.fillRect(0, 0, canvas.width, canvas.height);
}

draw();

const videoStream = canvas.captureStream(30);
const mediaRecorder = new MediaRecorder(videoStream);

let chunks = [];
mediaRecorder.ondataavailable = function (e) {
    chunks.push(e.data);
};

mediaRecorder.onstop = function (e) {
    const blob = new Blob(chunks, {'type': 'video/mp4'});
    chunks = [];
    const videoURL = URL.createObjectURL(blob);
    video.src = videoURL;
};
mediaRecorder.ondataavailable = function (e) {
    chunks.push(e.data);
};

mediaRecorder.start();
setInterval(draw, 300);
setTimeout(function () {
    mediaRecorder.stop();
}, 5000);