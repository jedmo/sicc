/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/charts.js ***!
  \********************************/
var cmg_options = {
  series: [{
    name: "Asistencia",
    data: [3, 3, 4, 5, 4, 3, 3, 6, 4, 8, 5, 6]
  }],
  chart: {
    height: 350,
    type: "bar"
  },
  plotOptions: {
    bar: {
      borderRadius: 10
    }
  },
  dataLabels: {
    enabled: false
  },
  colors: ['#8231D3'],
  xaxis: {
    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    axisBorder: {
      show: false
    },
    axisTicks: {
      show: false
    }
  }
};
var cmg_chart = new ApexCharts(document.querySelector("#cell_meeting_graph"), cmg_options);
cmg_chart.render();
var apg_options = {
  series: [2, 4, 2],
  chart: {
    width: 380,
    type: "pie"
  },
  labels: ["Adultos", "Jóvenes", "Niños"],
  legend: {
    show: false
  },
  colors: ["#8231d3", "#00aaff", "#5940ff"],
  responsive: [{
    breakpoint: 480,
    options: {
      chart: {
        width: 200
      },
      legend: {
        position: "bottom"
      }
    }
  }]
};
var apg_chart = new ApexCharts(document.querySelector("#attendance_percentage_graph"), apg_options);
apg_chart.render();
/******/ })()
;