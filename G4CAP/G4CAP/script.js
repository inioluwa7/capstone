document.querySelector("form").addEventListener("submit", function (e) {
    const progressBar = document.getElementById("progress-bar");
    progressBar.style.display = "block";

    // Simulate progress
    let value = 0;
    const interval = setInterval(() => {
        if (value >= 100) clearInterval(interval);
        else progressBar.value = value += 10;
    }, 300);
});
