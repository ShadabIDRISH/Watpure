function calculateWaterUsage() {
    // Fetch selected values from dropdowns
    const temperature = parseFloat(document.getElementById("temperature").value) || "Unknown";
    const pH = parseFloat(document.getElementById("pH").value) || "Unknown";
 
    const dissolvedOxygen = parseFloat(document.getElementById("dissolvedOxygen").value) || "Unknown";
    const cod = parseFloat(document.getElementById("cod").value) || "Unknown";
    const bacteria = document.getElementById("bacteria").value || "Unknown";
    const electricalConductivity = parseFloat(document.getElementById("electricalConductivity").value) || "Unknown";
    const tds = parseFloat(document.getElementById("tds").value) || 0;
    const location = document.getElementById("location").value || "Unknown";


    const result = document.getElementById("result");
    result.style.fontSize = "1.2rem";

    // Determine water quality based on TDS level
    let waterQuality = "";
    let drinkabilityFeedback = "";
    if (tds >= 0 && tds <= 50) {
        waterQuality = "Very High Quality";
        drinkabilityFeedback = "This water is excellent for drinking.";
    } else if (tds > 50 && tds <= 150) {
        waterQuality = "High Quality";
        drinkabilityFeedback = "This water is suitable for drinking.";
    } else if (tds > 150 && tds <= 300) {
        waterQuality = "Good Quality";
        drinkabilityFeedback = "This water is acceptable for drinking.";
    } else if (tds > 300 && tds <= 500) {
        waterQuality = "Fair Quality";
        drinkabilityFeedback = "This water is safe but not ideal for drinking.";
    } else if (tds > 500 && tds <= 1000) {
        waterQuality = "Poor Quality";
        drinkabilityFeedback = "This water is not recommended for drinking.";
    } else if (tds > 1000 && tds <= 2000) {
        waterQuality = "Unacceptable";
        drinkabilityFeedback = "This water is unsafe for drinking.";
    } else if (tds > 2000) {
        waterQuality = "Not Suitable for Drinking";
        drinkabilityFeedback = "This water is hazardous for drinking.";
    }

    result.innerHTML = `
    Location: ${location}<br>
        Temperature: ${temperature} °C<br>
        pH Level: ${pH}<br>
     
        Dissolved Oxygen: ${dissolvedOxygen} mg/L<br>
        COD: ${cod} mg/L<br>
        Bacteria Level: ${bacteria}<br>
        Electrical Conductivity: ${electricalConductivity} µS/cm<br>
        TDS: ${tds} mg/L<br>
        Water Quality: ${waterQuality}<br>
        Drink Quality:${drinkabilityFeedback}
    `;

    // Play water drop sound
    const waterSound = document.getElementById("waterSound");
    if (waterSound) {
        waterSound.play().catch((error) => {
            console.error("Audio playback failed:", error);
        });
    }

    // Display the chart using CanvasJS
    displayChart(tds);
}

function displayChart(tds) {
    const chart = new CanvasJS.Chart("chartContainer", {
        title: {
            text: "Water Quality based on TDS Level"
        },
        data: [
            {
                type: "column",
                dataPoints: [
                    { label: "TDS Level", y: tds }
                ]
            }
        ]
    });
    chart.render();
}
