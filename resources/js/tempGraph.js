export default function getTempChartOptions(globalTempData,minthreshold,maxthreshold) {
    let mainChartColors = {};

    if (document.documentElement.classList.contains("dark")) {
        mainChartColors = {
            borderColor: "#374151",
            labelColor: "#9CA3AF",
            opacityFrom: 0.6,
            opacityTo: 0.0,
        };
    } else {
        mainChartColors = {
            borderColor: "#F3F4F6",
            labelColor: "#6B7280",
            opacityFrom: 0.6,
            opacityTo: 0,
        };
    }

    return {
        chart: {
            height: 460,
            type: "bar",
            fontFamily: "Inter, sans-serif",
            foreColor: mainChartColors.labelColor,
            toolbar: {
                show: false,
            },
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "70%",
                borderRadiusApplication: "end",
                borderRadius: 4,
            },
        },
        dataLabels: {
            enabled: false,
        },
        tooltip: {
            x: {
                format: "dd MMM yyyy HH:mm",
            },
            style: {
                fontSize: "14px",
                fontFamily: "Inter, sans-serif",
            },
        },
        grid: {
            show: true,
            borderColor: mainChartColors.borderColor,
            strokeDashArray: 1,
            padding: {
                left: 35,
                bottom: 15,
            },
        },
        series: [
            {
                name: "Temperature",
                data: globalTempData,
                color: "#1A56DB",
            },
        ],
        markers: {
            size: 5,
            strokeColors: "#ffffff",
            hover: {
                size: undefined,
                sizeOffset: 3,
            },
        },
        xaxis: {
            // type: "datetime",
            // categories: timestamps, // Timestamps for x-axis labels
            // labels: {
            //     show: true,
            //     formatter: function (value) {
            //         return new Date(value).toLocaleString();
            //     },
            // },
            show: false, // Hide the x-axis
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
            labels: {
                style: {
                    colors: [mainChartColors.labelColor],
                    fontSize: "14px",
                    fontWeight: 500,
                },
                formatter: function (value) {
                    return (
                        value +"º"
                    );
                },
            },
        },
        legend: {
            fontSize: "14px",
            fontWeight: 500,
            fontFamily: "Inter, sans-serif",
            labels: {
                colors: [mainChartColors.labelColor],
            },
            itemMargin: {
                horizontal: 10,
            },
        },
        annotations: {
            yaxis: [
                {
                    y: maxthreshold,
                    borderColor: "#FF0000",
                    label: {
                        borderColor: "#FF0000",
                        style: {
                            color: "#fff",
                            background: "#FF0000",
                        },
                        text: "Max límite ECA: " + maxthreshold,
                    },
                },
                {
                    y: minthreshold,
                    borderColor: "#54cdff",
                    label: {
                        borderColor: "#54cdff",
                        style: {
                            color: "#fff",
                            background: "#54cdff",
                        },
                        text: "Min límite ECA: " + minthreshold,
                    },
                },
            ],
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
}
