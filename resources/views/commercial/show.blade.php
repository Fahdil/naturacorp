@extends('layouts.app')

@section('title', 'Détail de la pharmacie')

@section('content')
<div class="container py-5 d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card shadow rounded">
            <div class="card-header bg-info text-white text-center">
                <h4 class="mb-0">Détail de la pharmacie</h4>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Nom</dt>
                    <dd class="col-sm-8">{{ $pharmacy->nom }}</dd>

                    <dt class="col-sm-4">Adresse</dt>
                    <dd class="col-sm-8">{{ $pharmacy->adresse }}</dd>

                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8">{{ $pharmacy->email ?? 'Non renseigné' }}</dd>

                    <dt class="col-sm-4">Téléphone</dt>
                    <dd class="col-sm-8">{{ $pharmacy->telephone ?? 'Non renseigné' }}</dd>

                    <dt class="col-sm-4">Statut</dt>
                    <dd class="col-sm-8">
                        @switch($pharmacy->statut)
                            @case('prospect')
                                <span class="badge bg-secondary">Prospect</span>
                                @break
                            @case('client_actif')
                                <span class="badge bg-success">Client actif</span>
                                @break
                            @case('client_inactif')
                                <span class="badge bg-warning text-dark">Client inactif</span>
                                @break
                            @default
                                <span class="badge bg-light text-dark">Inconnu</span>
                        @endswitch
                    </dd>

                    <dt class="col-sm-4">Région</dt>
                    <dd class="col-sm-8">{{ $pharmacy->region ?? 'Non renseigné' }}</dd>

                    <dt class="col-sm-4">Département</dt>
                    <dd class="col-sm-8">{{ $pharmacy->departement ?? 'Non renseigné' }}</dd>
                </dl>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('pharmacies.index') }}" class="btn btn-outline-secondary">← Retour à la liste</a>
                    <a href="{{ route('pharmacies.edit', $pharmacy->id) }}" class="btn btn-primary">Modifier</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
