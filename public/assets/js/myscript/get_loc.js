// $(document).ready(function() {
//     // Ketika halaman sudah dimuat, jalankan kode ini
//     var lokasi = document.getElementById('loc');
//     if (navigator.geolocation) {
//             navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
//         }

//     function successCallback(position) {
//         lokasi.value = position.coords.latitude + "," + position.coords.longitude;
//         var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 18);

//         L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
//             maxZoom: 20,
//             subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
//         }).addTo(map);
//         var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
//     }

//     function errorCallback() {

//     }
//     if ("geolocation" in navigator) {
//         navigator.geolocation.getCurrentPosition(function(position) {
//             // var latitude = 0;
//             // var longitude = 0;
//             var latitude = position.coords.latitude;
//             var longitude = position.coords.longitude;

//             // Cetak koordinat
//             $('#loc').val(latitude + "," + longitude);
//             // Membuat peta Leaflet
//             var peta = L.map('map');

//             // Menambahkan layer Google Maps sebagai tile layer menggunakan Leaflet.GoogleMutant
//             var googleLayer = new L.Google('ROADMAP'); // Jenis peta dapat diubah menjadi 'SATELLITE', 'HYBRID', atau 'TERRAIN'

//             // Menambahkan layer Google Maps ke peta
//             peta.addLayer(googleLayer);

//             // Menetapkan tampilan peta
//             peta.setView(new L.LatLng(latitude, longitude), 13); // Menetapkan tampilan ke lokasi tertentu

//             // Contoh menambahkan marker
//             L.marker([latitude, longitude]).addTo(peta)
//             .bindPopup('Ini adalah Jakarta, Indonesia.')
//             .openPopup();

//         }, function(error) {
//             console.error("Gagal mendapatkan lokasi: " + error.message);
//         });
//     } else {
//         console.error("Geolokasi tidak didukung oleh peramban ini.");
//     }
// });
var lokasi = document.getElementById('loc');
    if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }

    function successCallback(position) {
        lokasi.value = position.coords.latitude + "," + position.coords.longitude;
        var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 18);

        L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);
        var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
    }

    function errorCallback() {

    }

