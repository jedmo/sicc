// Función para verificar si un elemento está visible en la pantalla
function isElementInViewport(el) {
    var rect = el.getBoundingClientRect();
    return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

// Verificar si el elemento que contiene los gráficos está visible en la pantalla
var graphContainer = document.querySelector("#cell_meeting_graph");
if (graphContainer) {
    graphContainer = graphContainer.parentNode;
    if (isElementInViewport(graphContainer)) {
        var assistance = [];

        axios.get("/report/assistance", { withCredentials: true })
        .then((response) => {
            console.log(response);
            assistance = response.data.assistance;
            dates = response.data.dates;
            attendance = response.data.attendance;

            var cmg_options = {
                series: [
                    {
                        name: "Asistencia",
                        data: attendance,
                    },
                ],
                chart: {
                    height: 350,
                    type: "bar",
                },
                plotOptions: {
                    bar: {
                        borderRadius: 10
                    }
                },
                dataLabels: {
                    enabled: false,
                },
                colors: ['#8231D3'],
                xaxis: {
                    categories: dates,
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    }
                }
            };

            var apg_options = {
                series: assistance,
                chart: {
                    width: 380,
                    type: "pie",
                },
                labels: ["Adultos", "Jóvenes", "Niños"],
                legend: {
                    show: false,
                },
                colors: ["#8231d3", "#00aaff", "#5940ff"],
                responsive: [
                    {
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200,
                            },
                            legend: {
                                position: "bottom",
                            },
                        },
                    },
                ],
            };

            var cmg_chart = new ApexCharts(document.querySelector("#cell_meeting_graph"), cmg_options);
            cmg_chart.render();

            var apg_chart = new ApexCharts(document.querySelector("#attendance_percentage_graph"), apg_options);
            apg_chart.render();
        })
        .catch((error) => {
            assistance = [0,0,0];
        });
    }
}
