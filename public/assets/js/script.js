document.addEventListener("DOMContentLoaded", function () {
    // Ambil elemen alert
    var alertElement = document.querySelector(".alert");

    // Periksa apakah ada elemen alert
    if (alertElement) {
        // Sembunyikan elemen alert setelah 3 detik
        setTimeout(function () {
            alertElement.style.display = "none";
        }, 3000);
    }
});
