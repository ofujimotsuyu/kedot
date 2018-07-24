// グラフで使用するデータ
// var graphData = [
//     {
//         'name': 'IE',
//         'value': 44.79,
//         'color': '#00BCF2'
//     }, {
//         'name': 'chrome',
//         'value': 36.56,
//         'color': '#4BB847'
//     }, {
//         'name': 'Firefox',
//         'value': 11.68,
//         'color': '#EA6110'
//     }, {
//         'name': 'Safari',
//         'value': 4.88,
//         'color': '#1B85F3'
//     }, {
//         'name': 'Opera',
//         'value': 1.68,
//         'color': '#EF1E1E'
//     }, {
//         'name': 'other',
//         'value': 0.41,
//         'color': '#666666'
//     }
// ]
 
// グラフで使用している値の合計
var total = 0;
for (var i = 0; i < graphData.length; i++) {
    total += graphData[i]['value'];
}
 
window.onload = function() {
    draw();
}
function draw() {
    var canvas = document.getElementById('canvas');
    if(!canvas || !canvas.getContext) return false;
    var ctx = canvas.getContext('2d');
 
    // グラフの中央位置(canvasの中心)
    var centerX = 250;
    var centerY = 250;
    // 円グラフの半径
    var r = 200;
    var angle = -90; // 頂点から開始
 
    for (var i = 0; i < graphData.length; i++) {
        endAngle = (360 / total) * graphData[i]['value']; // 円弧終了の角度
        ctx.fillStyle = graphData[i]['color'];
 
        var startX = Math.cos(Math.PI / 180 * (angle)) * r + centerX;
        var startY = Math.sin(Math.PI / 180 * (angle)) * r + centerY;
        ctx.beginPath();
        ctx.moveTo(centerX, centerY); // canvasの中心から描画開始
        ctx.lineTo(startX, startY); // 円弧描画の開始位置へ
        ctx.arc(centerX, centerY, r, ((angle) * Math.PI / 180), ((angle + endAngle) * Math.PI / 180), false); // 円弧描画
        ctx.lineTo(centerX, centerY); // canvasの中心へ
        ctx.fill(); // 塗りつぶし
 
        angle += endAngle; // 今回の円弧終了角度を次回の円弧開始角度にする
    };
}