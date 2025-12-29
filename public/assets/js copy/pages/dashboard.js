document.addEventListener("DOMContentLoaded", function () {
      // statusOneData 변수를 사용하는 ApexCharts 설정
  var optionsProfileVisit = {
    annotations: {
      position: "back",
    },
    dataLabels: {
      enabled: false,
    },
    chart: {
      type: "bar",
      height: 300,
    },
    fill: {
      opacity: 1,
    },
    plotOptions: {},
    series: [
      {
        name: "명",
        data: typeof statusOneData !== "undefined" ? statusOneData : [0, 0, 0, 0, 0, 0],
      }
    ],
    colors: "#02af66",
    xaxis: {
      categories: ["1주차", "2주차", "3주차", "4주차", "8주차", "12주차"],
    },
  };

  // 차트를 렌더링할 요소 찾기
  var chartProfileVisitElement = document.querySelector("#chart-profile-visit");
  if (chartProfileVisitElement) {
    var chartProfileVisit = new ApexCharts(
      chartProfileVisitElement,
      optionsProfileVisit
    );
    chartProfileVisit.render(); // 차트를 화면에 렌더링
  }
});

// let optionsVisitorsProfile = {
//   series: [70, 30],
//   labels: ["Male", "Female"],
//   colors: ["#435ebe", "#55c6e8"],
//   chart: {
//     type: "donut",
//     width: "100%",
//     height: "350px",
//   },
//   legend: {
//     position: "bottom",
//   },
//   plotOptions: {
//     pie: {
//       donut: {
//         size: "30%",
//       },
//     },
//   },
// };

// var optionsEurope = {
//   series: [
//     {
//       name: "series1",
//       data: [310, 800, 600, 430, 540, 340, 605, 805, 430, 540, 340, 605],
//     },
//   ],
//   chart: {
//     height: 80,
//     type: "area",
//     toolbar: {
//       show: false,
//     },
//   },
//   colors: ["#02af66"],
//   stroke: {
//     width: 2,
//   },
//   grid: {
//     show: false,
//   },
//   dataLabels: {
//     enabled: false,
//   },
//   xaxis: {
//     type: "datetime",
//     categories: [
//       "2018-09-19T00:00:00.000Z",
//       "2018-09-19T01:30:00.000Z",
//       "2018-09-19T02:30:00.000Z",
//       "2018-09-19T03:30:00.000Z",
//       "2018-09-19T04:30:00.000Z",
//       "2018-09-19T05:30:00.000Z",
//       "2018-09-19T06:30:00.000Z",
//       "2018-09-19T07:30:00.000Z",
//       "2018-09-19T08:30:00.000Z",
//       "2018-09-19T09:30:00.000Z",
//       "2018-09-19T10:30:00.000Z",
//       "2018-09-19T11:30:00.000Z",
//     ],
//     axisBorder: {
//       show: false,
//     },
//     axisTicks: {
//       show: false,
//     },
//     labels: {
//       show: false,
//     },
//   },
//   show: false,
//   yaxis: {
//     labels: {
//       show: false,
//     },
//   },
//   tooltip: {
//     x: {
//       format: "dd/MM/yy HH:mm",
//     },
//   },
// };

// let optionsAmerica = {
//   ...optionsEurope,
//   colors: ["#008b75"],
// };
// let optionsIndonesia = {
//   ...optionsEurope,
//   colors: ["#dc3545"],
// };

// var chartVisitorsProfile = new ApexCharts(
//   document.getElementById("chart-visitors-profile"),
//   optionsVisitorsProfile
// );
// var chartEurope = new ApexCharts(
//   document.querySelector("#chart-europe"),
//   optionsEurope
// );
// var chartAmerica = new ApexCharts(
//   document.querySelector("#chart-america"),
//   optionsAmerica
// );
// var chartIndonesia = new ApexCharts(
//   document.querySelector("#chart-indonesia"),
//   optionsIndonesia
// );

// chartIndonesia.render();
// chartAmerica.render();
// chartEurope.render();
// chartVisitorsProfile.render();
