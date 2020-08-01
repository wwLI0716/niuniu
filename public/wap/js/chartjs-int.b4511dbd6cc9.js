//[chartjs Javascript]

//Project:	Crypto Admin - Responsive Admin Template

$(function () {

  'use strict';
    //----chart1
    //Get the context of the Chart canvas element we want to select
    /*var dasChartjs = document.getElementById("chartjs1").getContext("2d");

    // Create Linear Gradient
    var blue_trans_gradient = dasChartjs.createLinearGradient(0, 0, 0, 100);
    blue_trans_gradient.addColorStop(0, 'rgba(247, 147, 26, 0.4)');
    blue_trans_gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');

    // Chart Options
    var DASStats = {
        responsive: true,
        maintainAspectRatio: false,
        datasetStrokeWidth : 3,
        pointDotStrokeWidth : 4,
        tooltipFillColor: "rgba(247, 147, 26,0.8)",
        legend: {
            display: false,
        },
        hover: {
            mode: 'label'
        },
        scales: {
            xAxes: [{
                display: false,
            }],
            yAxes: [{
                display: false,
                ticks: {
                    min: 0,
                    max: 85
                },
            }]
        },
        title: {
            display: false,
            fontColor: "#FFF",
            fullWidth: false,
            fontSize: 30,
            text: '52%'
        }
    };*/

    var c = document.getElementById('chartjs1');
    var ctx = c.getContext('2d');
    var w = c.width = window.innerWidth;
    var h = c.height = window.innerHeight;
    var cx = w / 2;
    var cy = h / 2;
    var Box = function(x, y, vx, color) {
        this.color = color;
        this.vx = vx;
        this.x = x;
        this.y = y;
        this.w = 10 + Math.random() * 5;
        this.h = 5 + Math.random() * 300;
    };
    Box.prototype = {
        constructor: Box,
        update: function() {
            this.x += this.vx;
            if(this.x < -this.w / 2) {
                this.x = w + this.w / 2;
            }
        },
        render: function(ctx) {
            ctx.save();
            ctx.fillStyle = this.color;
            ctx.translate(this.x, this.y);
            ctx.fillRect(-this.w/2, -this.h, this.w, this.h);
            ctx.restore();
        }
    };

    var ctr = 50;
    var boxes = [];
    var boxes2 = [];
    var boxes3 = [];
    var box;
    var speed = -1;

    for(var i = 0; i < ctr; i++) {
        box = new Box(Math.random() * w, h, speed * 0.5, '#e5e5e5');
        boxes.push(box);
    }
    for(var i = 0; i < ctr; i++) {
        box = new Box(Math.random() * w, h, speed * 0.8, '#cccccc');
        boxes2.push(box);
    }
    for(var i = 0; i < ctr; i++) {
        box = new Box(Math.random() * w, h, speed, '#999999');
        boxes3.push(box);
    }

    requestAnimationFrame(function loop() {
        requestAnimationFrame(loop);
        ctx.clearRect(0, 0, w, h);
        ctx.globalAlpha = 0.9;
        for(var i = 0, len = boxes.length; i < len; i++) {
            box = boxes[i];
            box.update();
            box.render(ctx);
        }
        for(var i = 0, len = boxes2.length; i < len; i++) {
            box = boxes2[i];
            box.update();
            box.render(ctx);
        }
        for(var i = 0, len = boxes3.length; i < len; i++) {
            box = boxes3[i];
            box.update();
            box.render(ctx);
        }
    });

    // Chart Data
    var DASMonthData = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
        datasets: [{
            label: "BTC",
            data: [20, 18, 35, 60, 38, 40, 70],
            backgroundColor: blue_trans_gradient,
            borderColor: "#F7931A",
            borderWidth: 1.5,
            strokeColor : "#F7931A",
            pointRadius: 0,
        }]
    };

    var DASCardconfig = {
        type: 'line',

        // Chart Options
        options : DASStats,

        // Chart Data
        data : DASMonthData
    };

    // Create the chart
    var DASAreaChart = new Chart(dasChartjs, DASCardconfig);
	
	
	//----chart2
    //Get the context of the Chart canvas element we want to select
    /*var dasChartjs = document.getElementById("chartjs2").getContext("2d");
    // Create Linear Gradient
    var blue_trans_gradient = dasChartjs.createLinearGradient(0, 0, 0, 100);
    blue_trans_gradient.addColorStop(0, 'rgba(131, 131, 131,0.4)');
    blue_trans_gradient.addColorStop(1, 'rgba(255,255,255,0)');
    // Chart Options
    var DASStats = {
        responsive: true,
        maintainAspectRatio: false,
        datasetStrokeWidth : 3,
        pointDotStrokeWidth : 4,
        tooltipFillColor: "rgba(131, 131, 131,0.8)",
        legend: {
            display: false,
        },
        hover: {
            mode: 'label'
        },
        scales: {
            xAxes: [{
                display: false,
            }],
            yAxes: [{
                display: false,
                ticks: {
                    min: 0,
                    max: 85
                },
            }]
        },
        title: {
            display: false,
            fontColor: "#FFF",
            fullWidth: false,
            fontSize: 30,
            text: '52%'
        }
    };*/


    //next
    // Chart Data
    var DASMonthData = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
        datasets: [{
            label: "ETH",
            data: [40, 30, 60, 40, 45, 30, 60],
            backgroundColor: blue_trans_gradient,
            borderColor: "#838383",
            borderWidth: 1.5,
            strokeColor : "#838383",
            pointRadius: 0,
        }]
    };

    var DASCardconfig = {
        type: 'line',
        // Chart Options
        options : DASStats,
        // Chart Data
        data : DASMonthData
    };

    // Create the chart
    var DASAreaChart = new Chart(dasChartjs, DASCardconfig);

    //----chart3
    //Get the context of the Chart canvas element we want to select
//     var dasChartjs = document.getElementById("chartjs3").getContext("2d");
    var dasChartjs = document.getElementById("chartjs3");

    // Create Linear Gradient
    var blue_trans_gradient = dasChartjs.createLinearGradient(0, 0, 0, 100);
    blue_trans_gradient.addColorStop(0, 'rgba(73, 152, 6,0.4)');
    blue_trans_gradient.addColorStop(1, 'rgba(255,255,255,0)');
    
    // Chart Options
    var DASStats = {
        responsive: true,
        maintainAspectRatio: false,
        datasetStrokeWidth : 3,
        pointDotStrokeWidth : 4,
        tooltipFillColor: "rgba(73, 152, 6,0.8)",
        legend: {
            display: false,
        },
        hover: {
            mode: 'label'
        },
        scales: {
            xAxes: [{
                display: false,
            }],
            yAxes: [{
                display: false,
                ticks: {
                    min: 0,
                    max: 85
                },
            }]
        },
        title: {
            display: false,
            fontColor: "#FFF",
            fullWidth: false,
            fontSize: 30,
            text: '52%'
        }
    };

    // Chart Data
    var DASMonthData = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
        datasets: [{
            label: "XRP",
            data: [70, 20, 35, 60, 20, 40, 30],
            backgroundColor: blue_trans_gradient,
            borderColor: "#499806",
            borderWidth: 1.5,
            strokeColor : "#499806",
            pointRadius: 0,
        }]
    };

    var DASCardconfig = {
        type: 'line',

        // Chart Options
        options : DASStats,

        // Chart Data
        data : DASMonthData
    };

    // Create the chart
    var DASAreaChart = new Chart(dasChartjs, DASCardconfig);
	
	
	 //----chart4
    //Get the context of the Chart canvas element we want to select
    var dasChartjs = document.getElementById("chartjs4");
    // Create Linear Gradient
//     var blue_trans_gradient = dasChartjs.createLinearGradient(0, 0, 0, 100);
    blue_trans_gradient.addColorStop(0, 'rgba(28, 117, 188,0.4)');
    blue_trans_gradient.addColorStop(1, 'rgba(255,255,255,0)');
    // Chart Options
    var DASStats = {
        responsive: true,
        maintainAspectRatio: false,
        datasetStrokeWidth : 3,
        pointDotStrokeWidth : 4,
        tooltipFillColor: "rgba(28, 117, 188,0.8)",
        legend: {
            display: false,
        },
        hover: {
            mode: 'label'
        },
        scales: {
            xAxes: [{
                display: false,
            }],
            yAxes: [{
                display: false,
                ticks: {
                    min: 0,
                    max: 85
                },
            }]
        },
        title: {
            display: false,
            fontColor: "#FFF",
            fullWidth: false,
            fontSize: 30,
            text: '52%'
        }
    };

    // Chart Data
    var DASMonthData = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
        datasets: [{
            label: "XRP",
            data: [20, 50, 65, 30, 24, 60, 40],
            backgroundColor: blue_trans_gradient,
            borderColor: "#1c75bc",
            borderWidth: 1.5,
            strokeColor : "#1c75bc",
            pointRadius: 0,
        }]
    };

    var DASCardconfig = {
        type: 'line',

        // Chart Options
        options : DASStats,

        // Chart Data
        data : DASMonthData
    };

    // Create the chart
//     var DASAreaChart = new Chart(dasChartjs, DASCardconfig);
	
}); // End of use strict
