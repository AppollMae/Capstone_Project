document.addEventListener("DOMContentLoaded", function () {
    // ✅ Chart 1: Permit Status
    const chartCanvas = document.getElementById("statusChart");
    const chartData = JSON.parse(chartCanvas.dataset.chartData);

    const ctx = chartCanvas.getContext("2d");
    new Chart(ctx, {
        type: "bar",
        data: chartData,
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: true, text: "Permit Status Overview" },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1, // ✅ Show only whole numbers
                        precision: 0, // ✅ Ensure no decimal values
                    },
                },
            },
        },
    });

    const monthData = document.getElementById("monthChart");
    const monthChartData = JSON.parse(monthData.dataset.chartData);
    const ctx2 = monthData.getContext("2d");

    new Chart(ctx2, {
        type: "bar",
        data: monthChartData,
        options: {
            responsive: true,
            plugins: {
                legend: { display: true, position: "bottom" },
                title: { display: true, text: "Monthly Permit Uploads" },
            },
            scales: {
                x: {
                    title: { display: true, text: "Months" },
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1, // ✅ Whole numbers only
                        precision: 0,
                    },
                    title: { display: true, text: "Number of Permits" },
                },
            },
        },
    });

    // ✅ Chart 2: Monthly Uploads
    // const monthData = JSON.parse(
    //     document.getElementById("monthChart").dataset.chartData
    // );
    // const ctx2 = document.getElementById("monthChart").getContext("2d");
    // new Chart(ctx2, {
    //     type: "line",
    //     data: monthData,
    //     options: {
    //         responsive: true,
    //         plugins: {
    //             legend: { display: true, position: "bottom" },
    //             title: { display: true, text: "Monthly Permit Uploads" },
    //         },
    //         scales: { y: { beginAtZero: true } },
    //     },
    // });
});
