let foundIcon;
let foundLocation;
let map;
let locations;
let sectionMap;
let markers = [];
if (map) {
    map.off();
    map.remove();
    for (var i = 0; i < markers.length; i++) {
        map.removeLayer(markers[i]);
    }
    markers = [];
    locations = [];
}
map = L.map('map', {
    zoomControl: false
}).setView([10.0545284, -69.3390881], 20.75);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
L.control.zoom({
    zoomInTitle: 'Acercar',
    zoomOutTitle: 'Alejar'
}).addTo(map);
locations = [{
    coords: [10.0545284, -69.3390881],
    icon: L.divIcon({
        className: 'my-icon-green',
        html: '<i class="fas fa-building"></i>',
        iconSize: [30, 30],
        iconAnchor: [5, 20],
        popupAnchor: [0, -30]
    }),
    popupContent: '<h2>Sede Principal de Hidrolara</h2>'
}, ];
<?php foreach ($operabilities as $operability) { ?>
foundIcon = L.divIcon({
    className: '{{ $operability->operability_type_id == 1 ? 'my-icon-green' : ($operability->operability_type_id == 3 ? 'my-icon-red' : 'my-icon-yellow') }}',
    html: '{!! $operability->icon !!}',
    iconSize: [30, 30],
    iconAnchor: [5, 20],
    popupAnchor: [0, -30]
});
foundLocation = {
    coords: [<?php echo $operability->latitude; ?>, <?php echo $operability->longitude; ?>],
    icon: foundIcon,
    popupContent: '<h2>{{ $operability->details }}</h2>'
};
locations.push(foundLocation);
<?php }?>

for (var i = 0; i < locations.length; i++) {
    let marker = L.marker(locations[i].coords, {
            icon: locations[i].icon
        }).addTo(map)
        .bindPopup(locations[i].popupContent);
    markers.push(marker);
}

map.on('zoomend', function() {
    var currentZoom = map.getZoom();
    var desiredZoom = 8; // Nivel de zoom deseado

    if (currentZoom < desiredZoom) {
        for (var i = 0; i < markers.length; i++) {
            map.removeLayer(markers[i]);
        }
    } else {
        for (var i = 0; i < markers.length; i++) {
            markers[i].addTo(map);
        }
    }
});
