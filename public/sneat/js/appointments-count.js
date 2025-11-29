const fetchAppointmentCount = async () => {
    try {
      const response = await fetch("/appointments/count");
      if (!response.ok) {
        throw new Error("Failed to fetch appointment count");
      }
      const data = await response.json();
      return data.appointments;
    } catch (error) {
      console.error("Error:", error);
      return 0;  // Default if fetch fails
    }
  };

  // Update the percentage or appointment count
  const updateAppointmentCount = async () => {
    const appointmentCount = await fetchAppointmentCount();
    
    // Example percentage calculation (if needed, change as per your logic)
    const percentage = (appointmentCount / 100) * 100; // You can customize the calculation

    // Update the HTML with the new value
    document.querySelector(".text-success").innerHTML = `<i class="bx bx-chevron-up"></i> ${appointmentCount} appointments`;
  };

  // Call the update function
  updateAppointmentCount();