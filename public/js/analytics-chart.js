const ctx = document.getElementById("applicationsChart").getContext("2d");
new Chart(ctx, {
    type: "line",
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
        datasets: [
            {
                label: "Applications",
                data: [12, 19, 15, 25, 22, 30],
                borderColor: "#28a745",
                backgroundColor: "rgba(40,167,69,0.2)",
                fill: true,
                tension: 0.4,
            },
        ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
    },
});
