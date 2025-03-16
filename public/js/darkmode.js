// Pastikan script ini dipanggil setelah DOM siap
document.addEventListener("DOMContentLoaded", function () {
    const darkModeToggle = document.getElementById("darkModeToggle");
    const currentTheme = localStorage.getItem("theme");

    // Cek apakah ada nilai di localStorage dan sesuaikan tampilan
    if (currentTheme === "dark") {
        document.body.classList.add("dark-mode");
        document.body.style.backgroundColor = "#121212";
        document.body.style.color = "#e0e0e0";
        darkModeToggle.textContent = "🌙"; // Menampilkan ikon bulan untuk kembali ke terang
    } else {
        darkModeToggle.textContent = "☀️"; // Menampilkan ikon matahari untuk masuk ke mode gelap
    }

    // Event listener untuk toggle dark mode
    darkModeToggle.addEventListener("click", function () {
        document.body.classList.toggle("dark-mode");

        if (document.body.classList.contains("dark-mode")) {
            document.body.style.backgroundColor = "#121212";
            document.body.style.color = "#e0e0e0";
            darkModeToggle.textContent = "🌙"; // Menampilkan bulan karena mode gelap aktif
            localStorage.setItem("theme", "dark");
        } else {
            document.body.style.backgroundColor = "";
            document.body.style.color = "";
            darkModeToggle.textContent = "☀️"; // Menampilkan matahari karena mode terang aktif
            localStorage.setItem("theme", "light");
        }
    });
});
