@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-title">Tableau de Bord </h1>
                <div class="text-muted">Analyse des performances et indicateurs clés</div>
            </div>
            <div class="col-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-white dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Période : {{ $label }}
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item period-filter" href="#" data-period="today">Aujourd'hui</a>
                        <a class="dropdown-item period-filter" href="#" data-period="week">Cette semaine</a>
                        <a class="dropdown-item period-filter" href="#" data-period="month">Ce mois</a>
                        <a class="dropdown-item period-filter" href="#" data-period="quarter">Ce trimestre</a>
                        <a class="dropdown-item period-filter" href="#" data-period="year">Cette année</a>
                        <a class="dropdown-item period-filter" href="#" data-period="custom">Personnalisée</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="card mb-4" id="customPeriodCard" style="{{ request('period') == 'custom' ? '' : 'display: none;' }}">
        <div class="card-body">
            <form id="filterForm" class="row g-3 align-items-center">
                <div class="col-md-3">
                    <label for="dateDebut" class="form-label">Date début</label>
                    <input type="date" name="dateDebut" id="dateDebut" class="form-control" value="{{ request('dateDebut') }}">
                </div>
                <div class="col-md-3">
                    <label for="dateFin" class="form-label">Date fin</label>
                    <input type="date" name="dateFin" id="dateFin" class="form-control" value="{{ request('dateFin') }}">
                </div>
                <div class="col-md-3">
                    <label for="zone" class="form-label">Zone</label>
                    <select name="zone" id="zone" class="form-select">
                        <option value="">Toutes zones</option>
                        @foreach($zones as $zone)
                            <option value="{{ $zone->id }}" {{ request('zone') == $zone->id ? 'selected' : '' }}>
                                {{ $zone->code_postal }} - {{ $zone->ville }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="statut" class="form-label">Statut</label>
                    <select name="statut" id="statut" class="form-select">
                        <option value="">Tous statuts</option>
                        <option value="en_cours" {{ request('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                        <option value="envoye" {{ request('statut') == 'envoye' ? 'selected' : '' }}>Envoyé</option>
                        <option value="annule" {{ request('statut') == 'annule' ? 'selected' : '' }}>Annulé</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-filter me-1"></i> Appliquer les filtres
                    </button>
                    <a href="{{ route('statistiques.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-sync-alt me-1"></i> Réinitialiser
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card kpi-card border-start-lg border-primary h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Commandes totales</h6>
                            <h2 class="mb-0">{{ $total }}</h2>
                        </div>
                        <div class="icon-shape bg-primary text-white rounded-circle">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="{{ $evolutionTotal >= 0 ? 'text-success' : 'text-danger' }}">
                            <i class="fas fa-arrow-{{ $evolutionTotal >= 0 ? 'up' : 'down' }} me-1"></i>
                            {{ abs($evolutionTotal) }}%
                        </span>
                        <span class="text-muted ms-2">vs période précédente</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card kpi-card border-start-lg border-success h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Commandes envoyées</h6>
                            <h2 class="mb-0">{{ $envoyees }}</h2>
                        </div>
                        <div class="icon-shape bg-success text-white rounded-circle">
                            <i class="fas fa-truck"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="{{ $evolutionEnvoyees >= 0 ? 'text-success' : 'text-danger' }}">
                            <i class="fas fa-arrow-{{ $evolutionEnvoyees >= 0 ? 'up' : 'down' }} me-1"></i>
                            {{ abs($evolutionEnvoyees) }}%
                        </span>
                        <span class="text-muted ms-2">vs période précédente</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card kpi-card border-start-lg border-danger h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Taux d'annulation</h6>
                            <h2 class="mb-0">{{ $tauxAnnulation }}%</h2>
                        </div>
                        <div class="icon-shape bg-danger text-white rounded-circle">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="{{ $evolutionAnnulation <= 0 ? 'text-success' : 'text-danger' }}">
                            <i class="fas fa-arrow-{{ $evolutionAnnulation <= 0 ? 'down' : 'up' }} me-1"></i>
                            {{ abs($evolutionAnnulation) }}%
                        </span>
                        <span class="text-muted ms-2">vs période précédente</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card kpi-card border-start-lg border-info h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Volume total</h6>
                            <h2 class="mb-0">{{ number_format($volume, 0, ',', ' ') }}</h2>
                        </div>
                        <div class="icon-shape bg-info text-white rounded-circle">
                            <i class="fas fa-cubes"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="{{ $evolutionVolume >= 0 ? 'text-success' : 'text-danger' }}">
                            <i class="fas fa-arrow-{{ $evolutionVolume >= 0 ? 'up' : 'down' }} me-1"></i>
                            {{ abs($evolutionVolume) }}%
                        </span>
                        <span class="text-muted ms-2">vs période précédente</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-2">
        <div class="col-lg-6 mb-2">
            <div class="card h-100 w-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Répartition des commandes</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-chart-pie me-1"></i> Type
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item chart-type" href="#" data-type="doughnut">Doughnut</a>
                            <a class="dropdown-item chart-type" href="#" data-type="pie">Pie</a>
                            <a class="dropdown-item chart-type" href="#" data-type="bar">Barre</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="statutChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-2">
            <div class="card h-100 w-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Performance par zone</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-chart-bar me-1"></i> Type
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item zone-chart-type" href="#" data-type="bar">Barre</a>
                            <a class="dropdown-item zone-chart-type" href="#" data-type="line">Ligne</a>
                            <a class="dropdown-item zone-chart-type" href="#" data-type="radar">Radar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="zoneChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Trend Chart -->
    <div class="card mb-4 h-100 w-75" style="margin-left:12.5%">
        <div class="card-header">
            <h5 class="mb-0">Évolution mensuelle</h5>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="trendChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="card mb-4 h-100 w-100">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Dernières commandes</h5>
            <div>
                <a href="{{ route('stats.exportExcel', request()->query()) }}" class="btn btn-sm btn-success me-2">
                    <i class="fas fa-file-excel me-1"></i> Excel
                </a>
                <a href="{{ route('stats.exportPdf', request()->query()) }}" class="btn btn-sm btn-danger me-2">
                    <i class="fas fa-file-pdf me-1"></i> PDF
                </a>
                <a href="{{ route('mes-commandes.index') }}" class="btn btn-sm btn-outline-primary">
                    Voir toutes <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="commandesTable" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Facture</th>
                            <th>Pharmacie</th>
                            <th>Commercial</th>
                            <th class="text-end">Quantité</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Zone</th>
                            <!--th class="text-end">Actions</th-->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dernieresCommandes as $commande)
                        <tr>
                            <td>{{ $commande->id }}</td>
                            <td>
                                @if($commande->numero_facture)
                                <span class="badge bg-light text-dark">{{ $commande->numero_facture }}</span>
                                @else
                                <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm me-2">
                                        {{ substr(optional($commande->pharmacy)->nom ?? 'N/A', 0, 2) }}
                                    </div>
                                    {{ optional($commande->pharmacy)->nom ?? 'N/A' }}
                                </div>
                            </td>
                            <td>{{ optional($commande->user)->prenom ?? 'N/A' }}</td>
                            <td class="text-end">{{ number_format($commande->quantite, 0, ',', ' ') }}</td>
                            <td>
                                <span class="badge 
                                    @if($commande->statut=='envoye') bg-success 
                                    @elseif($commande->statut=='annule') bg-danger 
                                    @else bg-warning @endif">
                                    {{ ucfirst(str_replace('_',' ',$commande->statut)) }}
                                </span>
                            </td>
                            <td>{{ $commande->date}}</td>
                            <td>
                                <span class="badge bg-light text-dark">{{ $commande->zone_geographique }}</span>
                            </td>
                            <td class="text-end">
                                <!--a href="#" class="btn btn-sm btn-icon btn-outline-primary" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a-->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
<style>
.kpi-card {
    transition: all 0.3s ease;
    border-left-width: 4px !important;
}
.kpi-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}
.icon-shape {
    width: 3rem;
    height: 3rem;
    display: flex;
    align-items: center;
    justify-content: center;
}
.avatar {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
    background-color: #f8f9fa;
    color: #495057;
    font-weight: 600;
    font-size: 0.75rem;
}
.chart-container {
    position: relative;
    height: 300px;
}
</style>
@endpush

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#commandesTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json'
        },
        dom: '<"top"fB>rt<"bottom"lip><"clear">',
        buttons: [
            {
                extend: 'copy',
                className: 'btn btn-sm btn-outline-secondary'
            },
            {
                extend: 'csv',
                className: 'btn btn-sm btn-outline-secondary'
            },
            {
                extend: 'print',
                className: 'btn btn-sm btn-outline-secondary'
            }
        ],
        order: [[6, 'desc']],
        columnDefs: [
            { targets: [8], orderable: false }
        ]
    });

    // Period filter
    $('.period-filter').on('click', function(e) {
        e.preventDefault();
        const period = $(this).data('period');
        
        if (period === 'custom') {
            $('#customPeriodCard').show();
        } else {
            window.location.href = "{{ route('statistiques.index') }}?period=" + period;
        }
    });

    // Initialize charts
    let statutChart, zoneChart, trendChart;

    function initCharts() {
        // Destroy existing charts if they exist
        if (statutChart) statutChart.destroy();
        if (zoneChart) zoneChart.destroy();
        if (trendChart) trendChart.destroy();

        // Status Chart (Doughnut/Pie)
        const statutCtx = document.getElementById('statutChart').getContext('2d');
        statutChart = new Chart(statutCtx, {
            type: 'doughnut',
            data: {
                labels: ['En cours', 'Envoyées', 'Annulées'],
                datasets: [{
                    data: [{{ $enCours }}, {{ $envoyees }}, {{ $annulees }}],
                    backgroundColor: [
                        'rgba(255, 193, 7, 0.8)',
                        'rgba(40, 167, 69, 0.8)',
                        'rgba(220, 53, 69, 0.8)'
                    ],
                    borderColor: [
                        'rgba(255, 193, 7, 1)',
                        'rgba(40, 167, 69, 1)',
                        'rgba(220, 53, 69, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    },
                    datalabels: {
                        formatter: (value, ctx) => {
                            const total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${percentage}%`;
                        },
                        color: '#fff',
                        font: {
                            weight: 'bold'
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        // Zone Chart (Bar)
        const zoneCtx = document.getElementById('zoneChart').getContext('2d');
        zoneChart = new Chart(zoneCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($commandesParZone->pluck('zone_geographique')) !!},
                datasets: [{
                    label: 'Nombre de commandes',
                    data: {!! json_encode($commandesParZone->pluck('count')) !!},
                    backgroundColor: 'rgba(23, 162, 184, 0.7)',
                    borderColor: 'rgba(23, 162, 184, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: ${context.raw}`;
                            }
                        }
                    }
                }
            }
        });

        // Trend Chart (Line)
        const trendCtx = document.getElementById('trendChart').getContext('2d');
        trendChart = new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($tendanceMensuelle->pluck('month')) !!},
                datasets: [
                    {
                        label: 'Commandes',
                        data: {!! json_encode($tendanceMensuelle->pluck('count')) !!},
                        borderColor: 'rgba(13, 110, 253, 1)',
                        backgroundColor: 'rgba(13, 110, 253, 0.1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Volume',
                        data: {!! json_encode($tendanceMensuelle->pluck('volume')) !!},
                        borderColor: 'rgba(253, 126, 20, 1)',
                        backgroundColor: 'rgba(253, 126, 20, 0.1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Nombre de commandes'
                        }
                    },
                    y1: {
                        beginAtZero: true,
                        position: 'right',
                        grid: {
                            drawOnChartArea: false
                        },
                        title: {
                            display: true,
                            text: 'Volume de produits'
                        }
                    }
                }
            }
        });
    }

    // Initialize charts on page load
    initCharts();

    // Chart type change
    $('.chart-type').on('click', function(e) {
        e.preventDefault();
        const type = $(this).data('type');
        statutChart.config.type = type;
        statutChart.update();
    });

    $('.zone-chart-type').on('click', function(e) {
        e.preventDefault();
        const type = $(this).data('type');
        zoneChart.config.type = type;
        zoneChart.update();
    });

    // Filter form submission
    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        window.location.href = "{{ route('statistiques.index') }}?period=custom&" + formData;
    });
});
</script>
@endpush