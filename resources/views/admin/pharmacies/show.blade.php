@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Détails de la pharmacie</h1>
        <div>
            <a href="{{ route('admin.pharmacies.edit', $pharmacy) }}" class="btn btn-secondary">
                <i class="fas fa-edit"></i> Modifier
            </a>
            <a href="{{ route('admin.pharmacies.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4 w-75">
                <div class="card-body">
                    <h5 class="card-title">{{ $pharmacy->nom }}</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Adresse:</strong> {{ $pharmacy->adresse }}</p>
                            <p><strong>Région:</strong> {{ $pharmacy->region ?? 'Non renseigné' }}</p>
                            <p><strong>Département:</strong> {{ $pharmacy->departement ?? 'Non renseigné' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Email:</strong> {{ $pharmacy->email ?? 'Non renseigné' }}</p>
                            <p><strong>Téléphone:</strong> {{ $pharmacy->telephone ?? 'Non renseigné' }}</p>
                            <p>
                                <strong>Statut:</strong>
                                <span class="badge 
                                    @if($pharmacy->statut == 'client_actif') bg-success
                                    @elseif($pharmacy->statut == 'prospect') bg-info
                                    @else bg-secondary @endif">
                                    {{ $pharmacy->statut }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p><strong>Commercial assigné:</strong> {{ $pharmacy->user ? $pharmacy->user->prenom . ' ' . $pharmacy->user->nom : 'Non attribué' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm w-100">
                <div class="card-body w-100">
                    <h5 class="card-title">Localisation</h5>
                    <hr>
                    @if($pharmacy->latitude && $pharmacy->longitude)
                        <div id="map" style="height: 300px; width: 100%;"></div>
                    @else
                        <p class="text-muted">Coordonnées non disponibles</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const lat = {{ $pharmacy->latitude ?? 0 }};
        const lng = {{ $pharmacy->longitude ?? 0 }};
        const map = L.map('map').setView([lat, lng], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        L.marker([lat, lng]).addTo(map)
            .bindPopup("{{ $pharmacy->nom }}")
            .openPopup();
    });
</script>
@endpush