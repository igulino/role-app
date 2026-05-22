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
            name: "sales",
            data: [9, 20, 30, 20, 10, 20, 30, 20, 10, 20, 30, 20],
        },
    ],
    colors: "#435ebe",
    xaxis: {
        categories: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
        ],
    },
};
let optionsVisitorsProfile = {
    series: window.DataUser.seriesTot,
    labels: ["Users", "Admins"],
    colors: ["#008b75", "#435ebe"],
    chart: {
        type: "donut",
        width: "100%",
        height: "350px",
    },
    legend: {
        position: "bottom",
    },
    plotOptions: {
        pie: {
            donut: {
                size: "30%",
            },
        },
    },
};

var optionsEurope = {

    
    series: [
        {
            name: "quantidade/mês",
            data: window.Data.series,
        },
    ],
    chart: {
        height: 60,
        type: "area",
        toolbar: {
            show: false,
        },
    },
    colors: ["#5350e9"],
    stroke: {
        width: 2,
    },
    grid: {
        show: false,
    },
    dataLabels: {
        enabled: false,
    },
    xaxis: {
        type: "datetime",
        categories: [
            "2026-01-1T00:00:00.000Z",
            "2026-02-1T01:30:00.000Z",
            "2026-03-1T02:30:00.000Z",
            "2026-04-1T03:30:00.000Z",
            "2026-05-1T04:30:00.000Z",
        ],
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
        labels: {
            show: false,
        },
    },
    show: false,
    yaxis: {
        labels: {
            show: false,
        },
    },
    tooltip: {
        x: {
            format: "dd/MM/yy",
        },
    },
};

let optionsAmerica = {
    ...optionsEurope,

    series: [
        {
            ...optionsEurope.series[0],
            data: window.DataUser.series,
        },
    ],

    colors: ["#008b75"],
    chart: {
        height: 80,
        type: "area",
        toolbar: {
            show: false,
        },
    }
};
let optionsIndonesia = {
    ...optionsEurope,
    colors: ["#dc3545"],
};

var chartProfileVisit = new ApexCharts(
    document.querySelector("#chart-profile-visit"),
    optionsProfileVisit,
);
var chartVisitorsProfile = new ApexCharts(
    document.getElementById("chart-visitors-profile"),
    optionsVisitorsProfile,
);
var chartEurope = new ApexCharts(
    document.querySelector("#chart-europe"),
    optionsEurope,
);
var chartAmerica = new ApexCharts(
    document.querySelector("#chart-america"),
    optionsAmerica,
);
var chartIndonesia = new ApexCharts(
    document.querySelector("#chart-indonesia"),
    optionsIndonesia,
);

chartIndonesia.render();
chartAmerica.render();
chartEurope.render();
chartProfileVisit.render();
chartVisitorsProfile.render();
