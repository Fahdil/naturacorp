@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ isset($pharmacy) ? 'Modifier la pharmacie' : 'Créer une pharmacie' }}</h1>
        <a href="{{ route('admin.pharmacies.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>

    <div class="card shadow-sm w-100">

        <div class="col-12">
            <label class="form-label">Localisation sur la carte</label>
            <div id="map" style="height: 400px; width: 100%;" class="mb-3"></div>
        </div>


        <div class="card-body">
            <form action="{{ isset($pharmacy) ? route('admin.pharmacies.update', $pharmacy) : route('admin.pharmacies.store') }}" method="POST">
                @csrf
                @if(isset($pharmacy))
                    @method('PUT')
                @endif

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" 
                               value="{{ old('nom', $pharmacy->nom ?? '') }}" required>
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="statut" class="form-label">Statut</label>
                        <select class="form-select @error('statut') is-invalid @enderror" id="statut" name="statut" required>
                            <option value="">Sélectionnez un statut</option>
                            <option value="prospect" {{ old('statut', $pharmacy->statut ?? '') == 'prospect' ? 'selected' : '' }}>Prospect</option>
                            <option value="client_actif" {{ old('statut', $pharmacy->statut ?? '') == 'client_actif' ? 'selected' : '' }}>Client actif</option>
                            <option value="client_inactif" {{ old('statut', $pharmacy->statut ?? '') == 'client_inactif' ? 'selected' : '' }}>Client inactif</option>
                        </select>
                        @error('statut')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" class="form-control @error('adresse') is-invalid @enderror" id="adresse" name="adresse" 
                               value="{{ old('adresse', $pharmacy->adresse ?? '') }}" required>
                        @error('adresse')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" 
                               value="{{ old('email', $pharmacy->email ?? '') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" 
                               value="{{ old('telephone', $pharmacy->telephone ?? '') }}">
                        @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="region" class="form-label">Région</label>
                        <input type="text" class="form-control @error('region') is-invalid @enderror" id="region" name="region" 
                               value="{{ old('region', $pharmacy->region ?? '') }}">
                        @error('region')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="departement" class="form-label">Département</label>
                        <input type="text" class="form-control @error('departement') is-invalid @enderror" id="departement" name="departement" 
                               value="{{ old('departement', $pharmacy->departement ?? '') }}">
                        @error('departement')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="user_id" class="form-label">Commercial assigné</label>
                        <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                            <option value="">Sélectionnez un commercial</option>
                            @foreach($commerciaux as $commercial)
                                <option value="{{ $commercial->id }}" {{ old('user_id', $pharmacy->user_id ?? '') == $commercial->id ? 'selected' : '' }}>
                                    {{ $commercial->nom . ' ' .$commercial->prenom}}

                                   
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="number" step="0.000001" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" 
                               value="{{ old('latitude', $pharmacy->latitude ?? '') }}">
                        @error('latitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="number" step="0.000001" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" 
                               value="{{ old('longitude', $pharmacy->longitude ?? '') }}">
                        @error('longitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> {{ isset($pharmacy) ? 'Mettre à jour' : 'Enregistrer' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const latInput = document.getElementById('latitude');
            const lngInput = document.getElementById('longitude');

            const defaultLat = parseFloat(latInput.value) || 14.6928;
            const defaultLng = parseFloat(lngInput.value) || -17.4467;

            const map = L.map('map').setView([defaultLat, defaultLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);

            const marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

            // Mise à jour des inputs lors du déplacement du marqueur
            marker.on('dragend', function (e) {
                const pos = marker.getLatLng();
                latInput.value = pos.lat.toFixed(6);
                lngInput.value = pos.lng.toFixed(6);
            });

            // Clic sur la carte pour déplacer le marqueur
            map.on('click', function (e) {
                const { lat, lng } = e.latlng;
                marker.setLatLng([lat, lng]);
                latInput.value = lat.toFixed(6);
                lngInput.value = lng.toFixed(6);
            });

            // Ajout du contrôle de géocodage (barre de recherche)
            L.Control.geocoder({
                defaultMarkGeocode: false
            })
            .on('markgeocode', function(e) {
                const center = e.geocode.center;
                marker.setLatLng(center);
                map.setView(center, 16);
                latInput.value = center.lat.toFixed(6);
                lngInput.value = center.lng.toFixed(6);
            })
            .addTo(map);
        });
    </script>
@endpush
