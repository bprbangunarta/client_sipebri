$(document).ready(function() {
    // Ketika halaman sudah dimuat, jalankan kode ini
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            // Cetak koordinat
            $('#loc').val(latitude + "," + longitude);
        }, function(error) {
            console.error("Gagal mendapatkan lokasi: " + error.message);
        });
    } else {
        console.error("Geolokasi tidak didukung oleh peramban ini.");
    }
});

