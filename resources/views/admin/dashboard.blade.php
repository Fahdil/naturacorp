@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Tableau de Bord Administrateur</h1>

    <div class="row g-4">
        <!-- Utilisateurs -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('admin.utilisateurs.index') }}" class="card h-100 text-decoration-none text-dark shadow-sm">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users me-3 text-primary"></i>
                        <h5 class="mb-0">Gestion des utilisateurs</h5>
                    </div>
                    <hr class="my-2">
                    <p class="mb-0 text-muted small">Ajouter, modifier ou désactiver les utilisateurs</p>
                </div>
            </a>
        </div>

        <!-- Zones de prospection -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('admin.zones.index') }}" class="card h-100 text-decoration-none text-dark shadow-sm">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-map-marked-alt me-3 text-success"></i>
                        <h5 class="mb-0">Zones de prospection</h5>
                    </div>
                    <hr class="my-2">
                    <p class="mb-0 text-muted small">Gérer les zones et leur attribution</p>
                </div>
            </a>
        </div>

        <!-- Pharmacies -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('admin.pharmacies.index') }}" class="card h-100 text-decoration-none text-dark shadow-sm">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-pharmacy me-3 text-info"></i>
                        <h5 class="mb-0">Pharmacies</h5>
                    </div>
                    <hr class="my-2">
                    <p class="mb-0 text-muted small">Superviser toutes les pharmacies</p>
                </div>
            </a>
        </div>

        <!-- Commandes -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('admin.commandes.index') }}" class="card h-100 text-decoration-none text-dark shadow-sm">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-clipboard-list me-3 text-warning"></i>
                        <h5 class="mb-0">Commandes</h5>
                    </div>
                    <hr class="my-2">
                    <p class="mb-0 text-muted small">Visualiser et trier les commandes</p>
                </div>
            </a>
        </div>

        <!-- Statistiques -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('statistiques.index') }}" class="card h-100 text-decoration-none text-dark shadow-sm">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-chart-line me-3 text-danger"></i>
                        <h5 class="mb-0">Statistiques</h5>
                    </div>
                    <hr class="my-2">
                    <p class="mb-0 text-muted small">Consulter les performances</p>
                </div>
            </a>
        </div>

        <!-- Audit Trail -->
        <div class="col-md-6 col-lg-4">
            <a href="#" class="card h-100 text-decoration-none text-dark shadow-sm">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-history me-3 text-secondary"></i>
                        <h5 class="mb-0">Audit Trail</h5>
                    </div>
                    <hr class="my-2">
                    <p class="mb-0 text-muted small">Suivi des activités</p>
                </div>
            </a>
        </div>


          <!-- Bloc Mon compte -->
            <div class="col-md-4">
                <a href="{{ url('/mon-compte') }}" class="card h-100 text-decoration-none text-dark shadow-sm border-secondary-hover">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-0">Mon Compte</h4>
                            <i class="fas fa-user-cog ms-auto text-secondary"></i>
                        </div>
                        <p class="text-muted mb-0">Modifier vos informations personnelles</p>
                    </div>
                </a>
            </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        transition: transform 0.2s;
        border: none;
        border-radius: 8px;
    }
    
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important;
    }
    
    .fa-pharmacy:before {
        content: "\f5e5";
    }
</style>
@endpush