var lokasi = document.getElementById("loc");
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    // var watch = navigator.geolocation.watchPosition(successCallback, errorCallback);
}

function successCallback(position) {
    lokasi.value = position.coords.latitude + "," + position.coords.longitude;
    var map = L.map("map").setView(
        [position.coords.latitude, position.coords.longitude],
        18
    );

    L.tileLayer("http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}", {
        maxZoom: 20,
        subdomains: ["mt0", "mt1", "mt2", "mt3"],
    }).addTo(map);
    var marker = L.marker([
        position.coords.latitude,
        position.coords.longitude,
    ]).addTo(map);
}

function errorCallback(error) {}
