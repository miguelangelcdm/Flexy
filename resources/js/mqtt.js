import mqtt from "mqtt";
import "flowbite";
import "flowbite/dist/flowbite.min.js";
import ApexCharts from "apexcharts";
import axios from "axios";
import getPhChartOptions from "./pHGraph.js";
import getTempChartOptions from "./tempGraph.js";
import getOdChartOptions from "./ODGraph.js";
import getCondChartOptions from "./CondGraph.js";

let globalThresholds;
let globalPhData = [];
let globalTemperaturaData = [];
let globalOxigenoDisueltoData = [];
let globalConductividadData = [];
let chartPh,chartTemp,chartCond,chartOD;

// Function to initialize the MQTT client
function initializeMQTT() {
    const client = mqtt.connect("wss://broker.emqx.io:8084/mqtt");

    client.on("connect", function () {
        console.log("Conectado al broker MQTT");
        client.subscribe("salida/01", function (err) {
            if (!err) {
                console.log("Suscrito al tema salida/01");
            }
        });
    });

    client.on("message", async function (topic, message) {
        // Mensaje recibido
        console.log("Mensaje recibido:", message.toString());
        const data = JSON.parse(message.toString());
        axios
            .post("/data/save", {
                dispositivo: data.Dispositivo,
                id: data.Id,
                timestamp: data.Timestamp,
                ph: data.Data.Ph,
                temperatura: data.Data.Temperatura,
                conductividad: data.Data.Conductividad,
                oxigeno_disuelto: data.Data.OxigenoDisuelto,
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });

        const tableBody = document.getElementById("data-body");

        // Crear una nueva fila
        const newRow = document.createElement("tr");
        newRow.innerHTML = `
            <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">${data.Dispositivo}</td>
            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${data.Timestamp}</td>
            <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">${data.Data.Ph}</td>
            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${data.Data.Temperatura}</td>
            <td class="inline-flex items-center p-4 space-x-2 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${data.Data.Conductividad}</td>
            <td class="p-4 whitespace-nowrap">${data.Data.OxigenoDisuelto}</td>
        `;

        // Agregar la nueva fila al principio del cuerpo de la tabla
        tableBody.insertBefore(newRow, tableBody.firstChild);

        // Mostrar scroll solo si hay datos
        const overflowDiv = document.querySelector(".overflow-y-auto");
        if (tableBody.children.length > 0) {
            overflowDiv.style.overflowY = "auto";
        } else {
            overflowDiv.style.overflowY = "hidden";
        }

        // Update global data arrays with new data, keeping only the last 10 values
        globalPhData.push(data.Data.Ph);
        globalTemperaturaData.push(data.Data.Temperatura);
        globalOxigenoDisueltoData.push(data.Data.OxigenoDisuelto);
        globalConductividadData.push(data.Data.Conductividad);

        // Ensure we only keep the last 10 entries
        if (globalPhData.length > 10) globalPhData.shift();
        if (globalTemperaturaData.length > 10) globalTemperaturaData.shift();
        if (globalOxigenoDisueltoData.length > 10)
            globalOxigenoDisueltoData.shift();
        if (globalConductividadData.length > 10)
            globalConductividadData.shift();

        // Update the chartPh with new data
        chartPh.updateSeries([
            {
                name: "Ph",
                data: globalPhData,
            },
        ]);
        chartTemp.updateSeries([
            {
                name: "Temperatura",
                data: globalTemperaturaData,
            },
        ]);
        chartOD.updateSeries([
            {
                name: "Oxigeno disuelto",
                data: globalOxigenoDisueltoData,
            },
        ]);
        chartCond.updateSeries([
            {
                name: "Conductividad",
                data: globalConductividadData,
            },
        ]);
    });
}

async function fetchData() {
    try {
        const response = await axios.get("/data/getAll");
        console.log("Datos recibidos:", response.data);
        // Almacenar los datos globalmente
        globalThresholds = response.data.expextedValues;
        globalPhData = response.data.ph;
        globalTemperaturaData = response.data.temperatura;
        globalOxigenoDisueltoData = response.data.oxigenoDisuelto;
        globalConductividadData = response.data.conductividad;
    } catch (error) {
        console.error("Error al obtener los datos:", error);
        throw error; // Relanza el error para poder capturarlo más adelante si es necesario.
    }
}

function processData() {
    // Aquí puedes acceder a los datos globales
    console.log("pH data:", globalPhData);
    console.log("Temperatura data:", globalTemperaturaData);
    console.log("Oxígeno Disuelto data:", globalOxigenoDisueltoData);
    console.log("Conductividad data:", globalConductividadData);

    // Realiza el procesamiento que necesites con los datos
    // Por ejemplo, calcular el promedio del pH
    const phPromedio =
        globalPhData.reduce((sum, value) => sum + value, 0) /
        globalPhData.length;
    console.log("Promedio del pH:", phPromedio);
}

if (document.getElementById("ph-chart")) {
    fetchData().then(() => {
        processData();
        chartPh = new ApexCharts(
            document.getElementById("ph-chart"),
            getPhChartOptions(globalPhData,globalThresholds['min']['ph'] ,globalThresholds['max']['ph'])
        );
        chartPh.render();


        

        chartCond = new ApexCharts(
            document.getElementById("cond-chart"),
            getCondChartOptions(
                globalConductividadData,
                globalThresholds["min"]["conductividad"],
                globalThresholds["max"]["conductividad"]
            )
        );
        chartCond.render();

        // init again when toggling dark mode
        document.addEventListener("dark-mode", function () {
            chartPh.updateOptions(getPhChartOptions(globalPhData,globalThresholds['min']['ph'] ,globalThresholds['max']['ph']));
            chartCond.updateOptions(getCondChartOptions(globalConductividadData, globalThresholds['min']['conductividad'],globalThresholds['max']['conductividad']));
        });

        // Initialize MQTT client
        initializeMQTT();
    });
                
}

if (document.getElementById("temp-chart")) {
    chartTemp = new ApexCharts(
        document.getElementById("temp-chart"),
        getTempChartOptions(
            globalTemperaturaData,
            globalThresholds["min"]["temperatura"],
            globalThresholds["max"]["temperatura"]
        )
    );
    chartTemp.render();

    document.addEventListener("dark-mode", function () {
            chartTemp.updateOptions(getTempChartOptions(globalTemperaturaData, globalThresholds['min']['temperatura'],globalThresholds['max']['temperatura']));
        });

}

if (document.getElementById("od-chart")) {
    chartOD = new ApexCharts(
        document.getElementById("od-chart"),
        getOdChartOptions(
            globalOxigenoDisueltoData,
            globalThresholds["min"]["oxigeno_disuelto"],
            globalThresholds["max"]["oxigeno_disuelto"]
        )
    );
    chartOD.render();

    document.addEventListener("dark-mode", function () {
        chartOD.updateOptions(
            getOdChartOptions(
                globalOxigenoDisueltoData,
                globalThresholds["min"]["oxigeno_disuelto"],
                globalThresholds["max"]["oxigeno_disuelto"]
            )
        );
    });
}


// Support Chart

const options2 = {
    series: [
        {
            name: "Income",
            color: "#31C48D",
            data: ["1420", "1620", "1820", "1420", "1650", "2120"],
        },
        {
            name: "Expense",
            data: ["788", "810", "866", "788", "1100", "1200"],
            color: "#F05252",
        },
    ],
    chart: {
        sparkline: {
            enabled: false,
        },
        type: "bar",
        width: "100%",
        height: 420,
        toolbar: {
            show: false,
        },
    },
    fill: {
        opacity: 1,
    },
    plotOptions: {
        bar: {
            horizontal: true,
            columnWidth: "100%",
            borderRadiusApplication: "end",
            borderRadius: 6,
            dataLabels: {
                position: "top",
            },
        },
    },
    legend: {
        show: true,
        position: "bottom",
    },
    dataLabels: {
        enabled: false,
    },
    tooltip: {
        shared: true,
        intersect: false,
        formatter: function (value) {
            return "$" + value;
        },
    },
    xaxis: {
        labels: {
            show: true,
            style: {
                fontFamily: "Inter, sans-serif",
                cssClass:
                    "text-xs font-normal fill-gray-500 dark:fill-gray-400",
            },
            formatter: function (value) {
                return "$" + value;
            },
        },
        categories: ["Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        axisTicks: {
            show: false,
        },
        axisBorder: {
            show: false,
        },
    },
    yaxis: {
        labels: {
            show: true,
            style: {
                fontFamily: "Inter, sans-serif",
                cssClass:
                    "text-xs font-normal fill-gray-500 dark:fill-gray-400",
            },
        },
    },
    grid: {
        show: true,
        strokeDashArray: 4,
        padding: {
            left: 2,
            right: 2,
            top: -20,
        },
    },
    fill: {
        opacity: 1,
    },
    responsive: [
        {
            breakpoint: 1024,
            options: {
                xaxis: {
                    labels: {
                        show: false,
                    },
                },
            },
        },
    ],
};

if (document.getElementById("bar-chart") && typeof ApexCharts !== "undefined") {
    const chart = new ApexCharts(
        document.getElementById("bar-chart"),
        options2
    );
    chart.render();
}

// Mini 1
if (document.getElementById("new-products-chart")) {
    const options = {
        colors: ["#1A56DB", "#FDBA8C"],
        series: [
            {
                name: "Quantity",
                color: "#1A56DB",
                data: [
                    { x: "01 Feb", y: 170 },
                    { x: "02 Feb", y: 180 },
                    { x: "03 Feb", y: 164 },
                    { x: "04 Feb", y: 145 },
                    { x: "05 Feb", y: 194 },
                    { x: "06 Feb", y: 170 },
                    { x: "07 Feb", y: 155 },
                ],
            },
        ],
        chart: {
            type: "bar",
            height: "140px",
            fontFamily: "Inter, sans-serif",
            foreColor: "#4B5563",
            toolbar: {
                show: false,
            },
        },
        plotOptions: {
            bar: {
                columnWidth: "90%",
                borderRadius: 3,
            },
        },
        tooltip: {
            shared: false,
            intersect: false,
            style: {
                fontSize: "14px",
                fontFamily: "Inter, sans-serif",
            },
        },
        states: {
            hover: {
                filter: {
                    type: "darken",
                    value: 1,
                },
            },
        },
        stroke: {
            show: true,
            width: 5,
            colors: ["transparent"],
        },
        grid: {
            show: false,
        },
        dataLabels: {
            enabled: false,
        },
        legend: {
            show: false,
        },
        xaxis: {
            floating: false,
            labels: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
        yaxis: {
            show: false,
        },
        fill: {
            opacity: 1,
        },
    };

    const chart = new ApexCharts(
        document.getElementById("new-products-chart"),
        options
    );
    chart.render();
}

//Mini 2
const getSignupsChartOptions = () => {
    let signupsChartColors = {};

    if (document.documentElement.classList.contains("dark")) {
        signupsChartColors = {
            backgroundBarColors: [
                "#374151",
                "#374151",
                "#374151",
                "#374151",
                "#374151",
                "#374151",
                "#374151",
            ],
        };
    } else {
        signupsChartColors = {
            backgroundBarColors: [
                "#E5E7EB",
                "#E5E7EB",
                "#E5E7EB",
                "#E5E7EB",
                "#E5E7EB",
                "#E5E7EB",
                "#E5E7EB",
            ],
        };
    }

    return {
        series: [
            {
                name: "Users",
                data: [1334, 2435, 1753, 1328, 1155, 1632, 1336],
            },
        ],
        labels: [
            "01 Feb",
            "02 Feb",
            "03 Feb",
            "04 Feb",
            "05 Feb",
            "06 Feb",
            "07 Feb",
        ],
        chart: {
            type: "bar",
            height: "140px",
            foreColor: "#4B5563",
            fontFamily: "Inter, sans-serif",
            toolbar: {
                show: false,
            },
        },
        theme: {
            monochrome: {
                enabled: true,
                color: "#1A56DB",
            },
        },
        plotOptions: {
            bar: {
                columnWidth: "25%",
                borderRadius: 3,
                colors: {
                    backgroundBarColors: signupsChartColors.backgroundBarColors,
                    backgroundBarRadius: 3,
                },
            },
            dataLabels: {
                hideOverflowingLabels: false,
            },
        },
        xaxis: {
            floating: false,
            labels: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
        tooltip: {
            shared: true,
            intersect: false,
            style: {
                fontSize: "14px",
                fontFamily: "Inter, sans-serif",
            },
        },
        states: {
            hover: {
                filter: {
                    type: "darken",
                    value: 0.8,
                },
            },
        },
        fill: {
            opacity: 1,
        },
        yaxis: {
            show: false,
        },
        grid: {
            show: false,
        },
        dataLabels: {
            enabled: false,
        },
        legend: {
            show: false,
        },
    };
};

if (document.getElementById("week-signups-chart")) {
    const chart = new ApexCharts(
        document.getElementById("week-signups-chart"),
        getSignupsChartOptions()
    );
    chart.render();

    // init again when toggling dark mode
    document.addEventListener("dark-mode", function () {
        chart.updateOptions(getSignupsChartOptions());
    });
}

//focus 1
if (document.getElementById("sales-by-category")) {
    const options = {
        colors: ["#1A56DB", "#FDBA8C"],
        series: [
            {
                name: "Desktop PC",
                color: "#1A56DB",
                data: [
                    { x: "01 Feb", y: 170 },
                    { x: "02 Feb", y: 180 },
                    { x: "03 Feb", y: 164 },
                    { x: "04 Feb", y: 145 },
                    { x: "05 Feb", y: 194 },
                    { x: "06 Feb", y: 170 },
                    { x: "07 Feb", y: 155 },
                ],
            },
            {
                name: "Phones",
                color: "#FDBA8C",
                data: [
                    { x: "01 Feb", y: 120 },
                    { x: "02 Feb", y: 294 },
                    { x: "03 Feb", y: 167 },
                    { x: "04 Feb", y: 179 },
                    { x: "05 Feb", y: 245 },
                    { x: "06 Feb", y: 182 },
                    { x: "07 Feb", y: 143 },
                ],
            },
            {
                name: "Gaming/Console",
                color: "#17B0BD",
                data: [
                    { x: "01 Feb", y: 220 },
                    { x: "02 Feb", y: 194 },
                    { x: "03 Feb", y: 217 },
                    { x: "04 Feb", y: 279 },
                    { x: "05 Feb", y: 215 },
                    { x: "06 Feb", y: 263 },
                    { x: "07 Feb", y: 183 },
                ],
            },
        ],
        chart: {
            type: "bar",
            height: "420px",
            fontFamily: "Inter, sans-serif",
            foreColor: "#4B5563",
            toolbar: {
                show: false,
            },
        },
        plotOptions: {
            bar: {
                columnWidth: "90%",
                borderRadius: 3,
            },
        },
        tooltip: {
            shared: true,
            intersect: false,
            style: {
                fontSize: "14px",
                fontFamily: "Inter, sans-serif",
            },
        },
        states: {
            hover: {
                filter: {
                    type: "darken",
                    value: 1,
                },
            },
        },
        stroke: {
            show: true,
            width: 5,
            colors: ["transparent"],
        },
        grid: {
            show: false,
        },
        dataLabels: {
            enabled: false,
        },
        legend: {
            show: false,
        },
        xaxis: {
            floating: false,
            labels: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
        yaxis: {
            show: false,
        },
        fill: {
            opacity: 1,
        },
    };

    const chart = new ApexCharts(
        document.getElementById("sales-by-category"),
        options
    );
    chart.render();
}

//focus 2
const getTrafficChannelsChartOptions = () => {
    let trafficChannelsChartColors = {};

    if (document.documentElement.classList.contains("dark")) {
        trafficChannelsChartColors = {
            strokeColor: "#1f2937",
        };
    } else {
        trafficChannelsChartColors = {
            strokeColor: "#ffffff",
        };
    }

    return {
        series: [70, 5, 25],
        labels: ["Desktop", "Tablet", "Phone"],
        colors: ["#16BDCA", "#FDBA8C", "#1A56DB"],
        chart: {
            type: "donut",
            height: 400,
            fontFamily: "Inter, sans-serif",
            toolbar: {
                show: false,
            },
        },
        responsive: [
            {
                breakpoint: 430,
                options: {
                    chart: {
                        height: 300,
                    },
                },
            },
        ],
        stroke: {
            colors: [trafficChannelsChartColors.strokeColor],
        },
        states: {
            hover: {
                filter: {
                    type: "darken",
                    value: 0.9,
                },
            },
        },
        tooltip: {
            shared: true,
            followCursor: false,
            fillSeriesColor: false,
            inverseOrder: true,
            style: {
                fontSize: "14px",
                fontFamily: "Inter, sans-serif",
            },
            x: {
                show: true,
                formatter: function (_, { seriesIndex, w }) {
                    const label = w.config.labels[seriesIndex];
                    return label;
                },
            },
            y: {
                formatter: function (value) {
                    return value + "%";
                },
            },
        },
        grid: {
            show: false,
        },
        dataLabels: {
            enabled: false,
        },
        legend: {
            show: false,
        },
    };
};

if (document.getElementById("traffic-by-device")) {
    const chart = new ApexCharts(
        document.getElementById("traffic-by-device"),
        getTrafficChannelsChartOptions()
    );
    chart.render();

    // init again when toggling dark mode
    document.addEventListener("dark-mode", function () {
        chart.updateOptions(getTrafficChannelsChartOptions());
    });
}

// Tema oscuro
if (
    localStorage.getItem("color-theme") === "dark" ||
    (!("color-theme" in localStorage) &&
        window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
    document.documentElement.classList.add("dark");
} else {
    document.documentElement.classList.remove("dark");
}
