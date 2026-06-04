function calculateWaterUsage() {
    const laundry = parseFloat(document.getElementById("laundry").value) || 0;
    const drinking = parseFloat(document.getElementById("drinking").value) || 0;
    const washroom = parseFloat(document.getElementById("washroom").value) || 0;
    const plants = parseFloat(document.getElementById("plants").value) || 0;

    const totalUsage = laundry + drinking + washroom + plants;

    const result = document.getElementById("result");
    result.style.fontSize = "1.2rem";
    
    // Play water drop sound
    const waterSound = document.getElementById("waterSound");
    waterSound.play();


    if (waterSound) {
        waterSound.play().catch((error) => {
            console.error("Audio playback failed:", error);
        });
    }
    
    if (totalUsage <= 100) {
        result.textContent = `Great! Your daily water usage is ${totalUsage} liters. Keep it up!`;
    } else {
        result.textContent = `Your daily water usage is ${totalUsage} liters. Consider reducing usage to conserve water.`;
    }
}
