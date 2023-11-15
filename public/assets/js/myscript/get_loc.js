$(document).ready(function() {
    // Menangani onsubmit event pada formulir
    $("form").on("submit", function(event) {
        var form = $(this);
        event.preventDefault(); // Menghentikan pengiriman formulir
        
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                // Cetak koordinat ke konsol
                $('#loc').val(latitude + "," + longitude)
                
                form.unbind('submit').submit();
            }, function(error) {
                console.error("Gagal mendapatkan lokasi: " + error.message);
            });
        } else {
            console.error("Geolokasi tidak didukung oleh peramban ini.");
        }
    });
});