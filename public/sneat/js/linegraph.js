let myChartInstance = null;

const allMonths = [
  "January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

const fetchAppointmentData = async () => {
  try {
    const response = await fetch("/appointments/data");

    if (!response.ok) {
      throw new Error(`Failed to fetch appointment data (Status: ${response.status})`);
    }

    const data = await response.json();

    // Validate structure
    if (!Array.isArray(data.data) || data.data.length !== 12) {
      throw new Error("Invalid data format from backend.");
    }

    return {
      labels: allMonths,
      data: data.data,
    };

  } catch (error) {
    console.error("Chart Fetch Error:", error.message);
    return {
      labels: allMonths,
      data: Array(12).fill(0),
    };
  }
};

const initChart = async () => {
  const canvas = document.getElementById("myChart");

  if (!canvas) {
    console.error("Canvas element with id 'myChart' not found.");
    return;
  }

  const ctx = canvas.getContext("2d");
  const appointmentData = await fetchAppointmentData();

  // Destroy previous chart instance if it exists
  if (myChartInstance) {
    myChartInstance.destroy();
  }

  myChartInstance = new Chart(ctx, {
    type: "bar",
    data: {
      labels: appointmentData.labels,
      datasets: [
        {
          label: "Number of Appointments",
          data: appointmentData.data,
          backgroundColor: "rgba(75, 192, 192, 0.5)",
          borderColor: "rgba(75, 192, 192, 1)",
          borderWidth: 1,
          borderRadius: 6,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { position: "top" },
        title: {
          display: true,
          text: "Appointments Per Month - 2025",
        },
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            precision: 0
          }
        },
      },
    },
  });
};

document.addEventListener("DOMContentLoaded", initChart);
