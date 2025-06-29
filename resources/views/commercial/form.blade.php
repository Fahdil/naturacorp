@extends('layouts.app')

@section('title', $pharmacy ? 'Modifier une pharmacie' : 'Ajouter une pharmacie')

@section('content')
<style>
    :root {
        --primary: #4a90e2;
        --secondary: #6c757d;
        --success: #28a745;
        --danger: #dc3545;
        --gray-light: #f8f9fa;
        --radius: 0.5rem;
        --shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease-in-out;
    }

    .pharmacy-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        margin-top: 2rem;
    }

    .form-box, .map-box {
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 2rem;
        flex: 1 1 45%;
        min-width: 350px;
    }

    h2.section-title {
        text-align: center;
        color: var(--primary);
        margin-bottom: 1.5rem;
    }

    label.required::after {
        content: ' *';
        color: var(--danger);
    }

    input.form-control, select.form-select {
        transition: var(--transition);
    }

    .btn-primary {
        background-color: var(--primary);
        border: none;
    }

    .btn-primary:hover {
        background-color: darken(var(--primary), 10%);
    }

    #map {
        height: 400px;
        border-radius: var(--radius);
        margin-top: 1rem;
    }

    .search-wrapper {
        position: relative;
        margin-bottom: 1rem;
    }

    .search-wrapper input {
        padding-right: 2.5rem;
    }

    .search-wrapper i {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--secondary);
    }

    @media (max-width: 768px) {
        .pharmacy-wrapper {
            flex-direction: column;
        }
    }
</style>

<div class="container">
    <h2 class="section-title">{{ $pharmacy ? 'Modifier une pharmacie' : 'Ajouter une nouvelle pharmacie' }}</h2>

    <div class="pharmacy-wrapper">
        <!-- Formulaire -->
        <div class="form-box">
            <form action="{{ $pharmacy ? route('pharmacies.update', $pharmacy->id) : route('pharmacies.store') }}"
                  method="POST" id="pharmacy-form">
                @csrf
                @if($pharmacy)
                    @method('PUT')
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Erreurs :</strong>
                        <ul>
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="nom" class="form-label required">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control"
                           value="{{ old('nom', $pharmacy->nom ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="adresse" class="form-label required">Adresse</label>
                    <input type="text" name="adresse" id="adresse" class="form-control"
                           value="{{ old('adresse', $pharmacy->adresse ?? '') }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                               value="{{ old('email', $pharmacy->email ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="text" name="telephone" id="telephone" class="form-control"
                               value="{{ old('telephone', $pharmacy->telephone ?? '') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="statut" class="form-label required">Statut</label>
                    <select name="statut" id="statut" class="form-select" required>
                        <option value="">-- Choisir --</option>
                        <option value="prospect" {{ old('statut', $pharmacy->statut ?? '') == 'prospect' ? 'selected' : '' }}>Prospect</option>
                        <option value="client_actif" {{ old('statut', $pharmacy->statut ?? '') == 'client_actif' ? 'selected' : '' }}>Client actif</option>
                        <option value="client_inactif" {{ old('statut', $pharmacy->statut ?? '') == 'client_inactif' ? 'selected' : '' }}>Client inactif</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="region" class="form-label">Région</label>
                        <input type="text" name="region" id="region" class="form-control"
                               value="{{ old('region', $pharmacy->region ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="departement" class="form-label">Département</label>
                        <select name="departement" id="departement" class="form-select">
                            <option value="">-- Sélectionner --</option>
                            @foreach($departements as $dep)
                                <option value="{{ $dep }}" {{ old('departement', $pharmacy->departement ?? '') == $dep ? 'selected' : '' }}>{{ $dep }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="text" name="latitude" id="latitude" class="form-control"
                               value="{{ old('latitude', $pharmacy->latitude ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="text" name="longitude" id="longitude" class="form-control"
                               value="{{ old('longitude', $pharmacy->longitude ?? '') }}">
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('pharmacies.index') }}" class="btn btn-secondary">Retour</a>
                    <button type="submit" class="btn btn-success">
                        {{ $pharmacy ? 'Mettre à jour' : 'Créer' }}
                    </button>
                </div>
            </form>
        </div>

        <!-- Carte -->
        <div class="map-box">
            <div class="search-wrapper">
                <input type="text" id="searchBox" class="form-control" placeholder="Recherche adresse ou pharmacie...">
                <i class="fas fa-search"></i>
            </div>
            <div id="map"></div>
            <div class="alert alert-info mt-3">
                Cliquez sur la carte ou cherchez une adresse pour renseigner les coordonnées.
            </div>
        </div>
    </div>
</div>

<script>
    let map = L.map('map').setView([46.6, 2.2], 6);
    let marker;

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const icon = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/447/447031.png',
        iconSize: [32, 32],
        iconAnchor: [16, 32]
    });

    function updateMarker(lat, lon, name = '') {
        if (!marker) {
            marker = L.marker([lat, lon], { icon, draggable: true }).addTo(map);
            marker.on('dragend', e => {
                const pos = marker.getLatLng();
                updateFields(pos.lat, pos.lng);
            });
        } else {
            marker.setLatLng([lat, lon]);
        }
        map.setView([lat, lon], 15);
        updateFields(lat, lon);
    }

    function updateFields(lat, lon) {
        document.getElementById('latitude').value = lat.toFixed(6);
        document.getElementById('longitude').value = lon.toFixed(6);
    }

    // Recherche
    document.getElementById('searchBox').addEventListener('keyup', function (e) {
        if (e.key === 'Enter') {
            const query = e.target.value;
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&countrycodes=fr&limit=1`)
                .then(res => res.json())
                .then(data => {
                    if (data.length) {
                        const place = data[0];
                        updateMarker(parseFloat(place.lat), parseFloat(place.lon), place.display_name);
                        document.getElementById('adresse').value ||= place.display_name;
                    }
                });
        }
    });

    map.on('click', function (e) {
        updateMarker(e.latlng.lat, e.latlng.lng);
    });

    @if($pharmacy && $pharmacy->latitude && $pharmacy->longitude)
        updateMarker({{ $pharmacy->latitude }}, {{ $pharmacy->longitude }}, '{{ $pharmacy->adresse }}');
    @endif
</script>
@endsection
