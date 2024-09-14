<div>
    @section('styles')
        <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}">
    @endsection
    <div class="flex">



        <section class="hidden md:block md:w-2/5 p-3 ">
            <section class="overflow-y-auto text-center  p-3 border rounded-lg bg-white">
                <h2 class="font-bold mb-3 text-lg">Filtrar por</h2>
                <div class="col-span-12 md:col-span-6 px-3 py-3 mb-6 md:mb-0 ">
                    <label class="block font-bold mb-2" for="system">{{ __('Sistema') }}</label>
                    <select name="system" id="system"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        wire:model.lazy="systemSelected">
                        <option value="">{{ __('Seleccione') }}</option>
                        @if ($systems)
                            @foreach ($systems as $system)
                                <option value="{{ $system->id }}">{{ $system->description }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-span-12 md:col-span-6 px-3 py-3 mb-6 md:mb-0 ">
                    <label class="block font-bold mb-2" for="municipalitySelected">{{ __('Municipio') }}</label>
                    <select name="municipalitySelected" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="municipalitySelected"
                        wire:model.live="municipalitySelected">
                        <option value="">{{ __('Seleccione') }}</option>
                        @foreach ($municipalities as $municipality)
                            <option value="{{ $municipality->municipality_id }}">
                                {{ $municipality->municipality }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-12 md:col-span-6 px-3 py-3 mb-6 md:mb-0 ">
                    <label class="block font-bold mb-2" for="parishesSelected">{{ __('Parroquia') }}</label>
                    <select name="parishesSelected" id="parishesSelected" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model.live="parishesSelected">
                        <option value="">{{ __('Seleccione') }}</option>
                        @if ($parishes)
                            @foreach ($parishes as $parish)
                                <option value="{{ $parish->parish_id }}">{{ $parish->parish }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="col-span-12 md:col-span-6 px-3 py-3 mb-6 md:mb-0 ">
                    <label class="block font-bold mb-2" for="status">{{ __('Estatus') }}</label>
                    <select name="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="status" wire:model.live='operabilityTypeSelected'>
                        <option value="">{{ __('Seleccione') }}</option>
                        @foreach ($operabilityTypes as $operabilityType)
                            <option value="{{ $operabilityType->id }}">{{ $operabilityType->description }}</option>
                        @endforeach
                    </select>
                </div>
            </section>


        </section>

        <section id="sectionMap" class="w-full h-screen-4rem z-0" wire:ignore>
            <div id="map" class="h-full"></div>
        </section>
    </div>

    {{-- <i class="far fa-lightbulb"></i> --}}
    @section('scripts')
        <script src="{{ asset('js/leaflet.js') }}"></script>
        <script>
            function ubicationDelete(latitude, longitude) {
                // Encontrar la capa de marcador correspondiente a las coordenadas especificadas
                map.eachLayer(function(layer) {
                    if (layer instanceof L.Marker && layer.getLatLng().equals([latitude, longitude])) {
                        // Eliminar la capa de marcador correspondiente
                        map.removeLayer(layer);
                        layer.remove();
                        map.on('zoomend', function() {
                            // Verificar si el marcador eliminado sigue en el mapa
                            if (map.hasLayer(layer)) {
                                // Eliminar el marcador del mapa
                                map.removeLayer(layer);

                                // Eliminar el marcador del DOM
                                layer.remove();
                            }
                        });
                    }
                });
            }
        </script>
        <script>
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
                    popupContent: '<h2 class="uppercase font-bold">Sede Principal de Hidrolara</h2> <p>Municipio: Iribarren</p><p>Parroquia: Concepción</p><p>Coordenadas: 10.0545284, -69.3390881</p>'
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
                    popupContent: '<h2 class="font-bold uppercase text-center">{{ $operability->details }}</h2> <p>Municipio: {{ $operability->municipality }}</p> <p>Parroquia: {{ $operability->parish }}</p><p class="capitalize">Sector: {{ $operability->sector }}</p><p class="capitalize">Capacidad: {{ $operability->capacity }} litros</p> <p class="capitalize">Caudal: {{ $operability->flow }} litros</p><p class="capitalize">Estatus: {{ $operability->operability_type }}</p><p>Motivo: {{ $operability->status_description }}</p><p>Coordenadas:'+[<?php echo $operability->latitude; ?>, <?php echo $operability->longitude; ?>]+'</p>'
                };
                locations.push(foundLocation);
                <?php }?>

                for (var i = 0; i < locations.length; i++) {
                    let marker = L.marker(locations[i].coords, {
                            icon: locations[i].icon
                        }).addTo(map)
                        .bindPopup(locations[i].popupContent, {
                            closeButton: false
                        });
                    markers.push(marker);
                    marker.on('mouseover', function(e) {
                        this.openPopup();
                    });
                    marker.on('mouseout', function(e) {
                        this.closePopup();
                    });
                map.on('zoomend', function() {
                    let currentZoom = map.getZoom();
                    let desiredZoom = 9; // Nivel de zoom deseado

                    if (currentZoom < desiredZoom) {
                        for (let i = 0; i < markers.length; i++) {
                            map.removeLayer(markers[i]);
                        }
                    } else {
                        for (let i = 0; i < markers.length; i++) {
                            markers[i].addTo(map);
                        }
                    }
                });
            }

            function removeAllMarkers() {
                markers.forEach(function(marker) {
                    map.removeLayer(marker);
                });
                markers = []; // Vaciar el array de marcadores
            }
            // Inicializar el mapa al cargar la página
            document.addEventListener('DOMContentLoaded', function() {
                window.addEventListener('resetMap', function() {
                    removeAllMarkers();

                    addMarkers(event.detail[0].locations);
                });

                function addMarkers(locations) {
                    let hidrolara_locations = [{
                        coords: [10.0545284, -69.3390881],
                        icon: '<i class="fas fa-building"></i>',
                        className: 'my-icon-green',
                        popupContent: '<h2 class="uppercase font-bold">Sede Principal de Hidrolara</h2> <p>Municipio: Iribarren</p><p>Parroquia: Concepción</p><p>Coordenadas: 10.0545284, -69.3390881</p>'
                    }, ];
                    Array.prototype.push.apply(locations, hidrolara_locations);
                    locations.forEach(function(location) {
                        foundIcon = L.divIcon({
                            className: location.className,
                            html: location.icon,
                            iconSize: [30, 30],
                            iconAnchor: [5, 20],
                            popupAnchor: [0, -30]
                        })
                        let marker = L.marker(location.coords, {
                                icon:  foundIcon
                            }).addTo(map)
                            .bindPopup(location.popupContent, {
                                closeButton: false
                            });

                        markers.push(marker); // Agregar el marcador al array de marcadores

                        marker.on('mouseover', function(e) {
                            this.openPopup();
                        });
                        marker.on('mouseout', function(e) {
                            this.closePopup();
                        });
                    });
                }
            });
        </script>
    @endsection
</div>
