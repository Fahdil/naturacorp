@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestion des Commandes</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.commandes.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus-circle me-2"></i>Nouvelle Commande
            </a>
            <a href="{{ route('admin.commandes.export') }}" class="btn btn-success shadow-sm">
                <i class="fas fa-file-export me-2"></i>Exporter
            </a>
        </div>
    </div>

    <!-- Filtres améliorés -->
    <div class="card shadow mb-4 w-75">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-filter me-2"></i>Filtres de recherche
            </h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.commandes.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="statut" class="form-label small text-muted">Statut</label>
                        <select name="statut" id="statut" class="form-select form-select-sm">
                            <option value="">Tous les statuts</option>
                            <option value="en_cours" {{ request('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                            <option value="envoye" {{ request('statut') == 'envoye' ? 'selected' : '' }}>Envoyé</option>
                            <option value="annule" {{ request('statut') == 'annule' ? 'selected' : '' }}>Annulé</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="pharmacy_id" class="form-label small text-muted">Pharmacie</label>
                        <select name="pharmacy_id" id="pharmacy_id" class="form-select form-select-sm">
                            <option value="">Toutes les pharmacies</option>
                            @foreach($pharmacies as $pharmacy)
                                <option value="{{ $pharmacy->id }}" {{ request('pharmacy_id') == $pharmacy->id ? 'selected' : '' }}>
                                    {{ $pharmacy->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="date_debut" class="form-label small text-muted">Date début</label>
                        <input type="date" name="date_debut" id="date_debut" class="form-control form-control-sm" value="{{ request('date_debut') }}">
                    </div>
                    <div class="col-md-2">
                        <label for="date_fin" class="form-label small text-muted">Date fin</label>
                        <input type="date" name="date_fin" id="date_fin" class="form-control form-control-sm" value="{{ request('date_fin') }}">
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-sm btn-primary flex-grow-1">
                            <i class="fas fa-search me-1"></i> Appliquer
                        </button>
                        <a href="{{ route('admin.commandes.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tableau amélioré -->
    <div class="card shadow w-100">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-nowrap">N° Facture</th>
                            <th class="text-nowrap">Date</th>
                            <th>Pharmacie</th>
                            <th>Commercial</th>
                            <th class="text-center">Quantité</th>
                            <th class="text-center">Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($commandes as $commande)
                            <tr class="align-middle">
                                <td class="text-nowrap fw-semibold">{{ $commande->numero_facture }}</td>
                                <td class="text-nowrap">{{ $commande->date }}</td>

                                <td>
                                    @if($commande->pharmacy)
                                        <span class="d-flex align-items-center gap-2">
                                            <i class="fas fa-pharmacy text-primary"></i>
                                            <span>{{ $commande->pharmacy->nom }}</span>
                                        </span>
                                    @else
                                        <span class="text-danger small">Non attribuée</span>
                                    @endif
                                </td>
                                <td>
                                    @if($commande->user)
                                        <span class="d-flex align-items-center gap-2">
                                            <i class="fas fa-user-tie text-info"></i>
                                            <span>{{ $commande->user->nom.' '.$commande->user->prenom }}</span>
                                        </span>
                                    @else
                                        <span class="text-danger small">Non attribué</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ number_format($commande->quantite, 0, ',', ' ') }}</td>
                                <td class="text-center">
                                    <span class="badge rounded-pill py-1 px-3 
                                        @if($commande->statut == 'envoye') bg-success
                                        @elseif($commande->statut == 'annule') bg-danger
                                        @else bg-warning text-dark
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="{{ route('admin.commandes.show', $commande) }}" 
                                           class="btn btn-sm btn-outline-primary rounded-circle action-btn"
                                           data-bs-toggle="tooltip" title="Voir détails">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.commandes.edit', $commande) }}" 
                                           class="btn btn-sm btn-outline-secondary rounded-circle action-btn"
                                           data-bs-toggle="tooltip" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.commandes.destroy', $commande) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger rounded-circle action-btn"
                                                    data-bs-toggle="tooltip" 
                                                    title="Supprimer"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-3"></i>
                                    <p class="h5">Aucune commande trouvée</p>
                                    <p class="small">Utilisez les filtres pour affiner votre recherche</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination améliorée -->
    @if($commandes->hasPages())
    <div class="mt-4 d-flex justify-content-between align-items-center">
        <div class="small text-muted">
            Affichage de {{ $commandes->firstItem() }} à {{ $commandes->lastItem() }} sur {{ $commandes->total() }} commandes
        </div>
        <div>
            {{ $commandes->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .action-btn {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .table th {
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
    }
    
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,.05);
    }
    
    .fa-pharmacy:before {
        content: "\f5e5";
    }
</style>
@endpush

@push('scripts')
<script>
    // Activer les tooltips Bootstrap
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endpush