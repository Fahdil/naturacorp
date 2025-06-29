@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Carte des Pharmacies</h2>

    <!-- Légende des couleurs -->
    <div class="mb-3">
        <h5>Légende :</h5>
        <ul class="list-inline">
            <li class="list-inline-item">
                <span style="display:inline-block; width:15px; height:15px; background-color:green; border-radius:50%; margin-right:5px;"></span>
                Client actif
            </li>
            <li class="list-inline-item">
                <span style="display:inline-block; width:15px; height:15px; background-color:red; border-radius:50%; margin-right:5px;"></span>
                Client inactif
            </li>
            <li class="list-inline-item">
                <span style="display:inline-block; width:15px; height:15px; background-color:blue; border-radius:50%; margin-right:5px;"></span>
                Prospect
            </li>
            <li class="list-inline-item">
                <span style="display:inline-block; width:15px; height:15px; background-color:gray; border-radius:50%; margin-right:5px;"></span>
                Statut inconnu
            </li>
        </ul>
    </div>
    
    <div id="map" style="height: 450px;margin:2rem 0;"></div>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const map = L.map('map').setView([48.8566, 2.3522], 6); // 🟢 Centré sur la France

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    fetch('{{ route("pharmacies.geojson") }}')
        .then(res => res.json())
        .then(data => {
            L.geoJSON(data, {
                pointToLayer: function (feature, latlng) {
                    let color;
                    switch (feature.properties.statut) {
                        case 'client_actif':
                            color = 'green';
                            break;
                        case 'client_inactif':
                            color = 'red';
                            break;
                        case 'prospect':
                            color = 'blue';
                            break;
                        default:
                            color = 'gray';
                    }

                    return L.circleMarker(latlng, {
                        radius: 8,
                        fillColor: color,
                        color: '#fff',
                        weight: 1,
                        opacity: 1,
                        fillOpacity: 0.8
                    }).bindPopup(`<strong>${feature.properties.nom}</strong><br>${feature.properties.adresse}`);
                }
            }).addTo(map);
        });
});

</script>
@endpush
