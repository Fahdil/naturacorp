@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">Tableau de bord Commercial</h1>
            <div class="badge bg-primary">
                Bonjour, {{ auth()->user()->nom.' '.auth()->user()->prenom }}
            </div>
        </div>




         <!-- Statistics Section -->
        <div class="row mb-4 g-4">
            <!-- Total Pharmacies -->
            <div class="col-md-4">
                <div class="card shadow-sm border-start border-primary border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-pharmacy fs-2 text-primary"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Pharmacies</h6>
                                <h3 class="mb-0">{{ $stats['total_pharmacies'] }}</h3>
                                <small class="text-muted">
                                    @if($stats['pharmacy_growth'] > 0)
                                        <span class="text-success"><i class="fas fa-arrow-up"></i> {{ $stats['pharmacy_growth'] }}%</span>
                                    @elseif($stats['pharmacy_growth'] < 0)
                                        <span class="text-danger"><i class="fas fa-arrow-down"></i> {{ abs($stats['pharmacy_growth']) }}%</span>
                                    @else
                                        <span class="text-muted">Stable</span>
                                    @endif
                                    vs mois dernier
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="col-md-4">
                <div class="card shadow-sm border-start border-success border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-clipboard-list fs-2 text-success"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Commandes (30j)</h6>
                                <h3 class="mb-0">{{ $stats['total_orders'] }}</h3>
                                <small class="text-muted">
                                    @if($stats['order_growth'] > 0)
                                        <span class="text-success"><i class="fas fa-arrow-up"></i> {{ $stats['order_growth'] }}%</span>
                                    @elseif($stats['order_growth'] < 0)
                                        <span class="text-danger"><i class="fas fa-arrow-down"></i> {{ abs($stats['order_growth']) }}%</span>
                                    @else
                                        <span class="text-muted">Stable</span>
                                    @endif
                                    vs mois dernier
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Status Summary -->
            <div class="col-md-4">
                <div class="card shadow-sm border-start border-info border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-chart-pie fs-2 text-info"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Statut Commandes</h6>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <span class="badge bg-primary">{{ $stats['orders_en_cours'] }}</span>
                                        <small class="text-muted d-block">En cours</small>
                                    </div>
                                    <div class="me-3">
                                        <span class="badge bg-success">{{ $stats['orders_envoye'] }}</span>
                                        <small class="text-muted d-block">Envoyé</small>
                                    </div>
                                    <div>
                                        <span class="badge bg-secondary">{{ $stats['orders_annule'] }}</span>
                                        <small class="text-muted d-block">Annulé</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>








        <div class="row g-4">
            <!-- Bloc Mes Pharmacies -->
            <div class="col-md-4">
                <a href="{{ url('/mes-pharmacies') }}" class="card h-100 text-decoration-none text-dark shadow-sm border-primary-hover">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-0">Mes Pharmacies</h4>
                            <i class="fas fa-pharmacy ms-auto text-primary"></i>
                        </div>
                        <p class="text-muted mb-0">Gérer vos clients et prospects</p>
                    </div>
                </a>
            </div>

            <!-- Bloc Mes Commandes -->
            <div class="col-md-4">
                <a href="{{ url('/mes-commandes') }}" class="card h-100 text-decoration-none text-dark shadow-sm border-success-hover">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-0">Mes Commandes</h4>
                            <i class="fas fa-clipboard-list ms-auto text-success"></i>
                        </div>
                        <p class="text-muted mb-0">Historique, ajout, et suivi de commandes</p>
                    </div>
                </a>
            </div>

            <!-- Bloc Notifications -->
            <div class="col-md-4">
                <a href="{{ route('notifications.index') }}" class="card h-100 text-decoration-none text-dark shadow-sm border-info-hover">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-0">Notifications</h4>
                            <span class="badge bg-info ms-auto">
                                {{ auth()->user()->unreadNotifications->count() }} nouvelle(s)
                            </span>
                        </div>
                        <p class="text-muted mb-0">Consulter vos alertes et messages</p>
                    </div>
                </a>
            </div>

            <!-- Bloc Carte interactive -->
            <div class="col-md-4">
                <a href="{{ url('/commercial/carte') }}" class="card h-100 text-decoration-none text-dark shadow-sm border-warning-hover">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-0">Carte Interactive</h4>
                            <i class="fas fa-map-marked-alt ms-auto text-warning"></i>
                        </div>
                        <p class="text-muted mb-0">Vue géographique des clients</p>
                    </div>
                </a>
            </div>

            <!-- Bloc Annonces -->
            <div class="col-md-4">
                <a href="{{ url('/mes-annonces') }}" class="card h-100 text-decoration-none text-dark shadow-sm border-danger-hover">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-0">Mes Annonces</h4>
                            <i class="fas fa-bullhorn ms-auto text-danger"></i>
                        </div>
                        <p class="text-muted mb-0">Consulter et gérer vos annonces</p>
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
</main>
@endsection

@push('styles')
<style>
    .card {
        transition: transform 0.2s, box-shadow 0.2s;
        border: 1px solid rgba(0,0,0,0.125);
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    
    .border-primary-hover:hover {
        border-color: #0d6efd !important;
    }
    
    .border-success-hover:hover {
        border-color: #198754 !important;
    }
    
    .border-info-hover:hover {
        border-color: #0dcaf0 !important;
    }
    
    .border-warning-hover:hover {
        border-color: #ffc107 !important;
    }
    
    .border-danger-hover:hover {
        border-color: #dc3545 !important;
    }
    
    .border-secondary-hover:hover {
        border-color: #6c757d !important;
    }
    
    .fa-pharmacy:before {
        content: "\f5e5";
    }
</style>
@endpush