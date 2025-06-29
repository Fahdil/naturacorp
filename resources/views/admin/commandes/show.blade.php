@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Détails de la Commande</h4>
                    <div>
                        <a href="{{ route('admin.commandes.edit', $commande) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Informations générales</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0">
                                    <strong>N° Facture:</strong> {{ $commande->numero_facture }}
                                </li>
                                <li class="list-group-item px-0">
                                    <strong>Date:</strong> {{ $commande->date->format('d/m/Y') }}
                                </li>
                                <li class="list-group-item px-0">
                                    <strong>Statut:</strong>
                                    <span class="badge 
                                        @if($commande->statut == 'envoye') bg-success
                                        @elseif($commande->statut == 'annule') bg-danger
                                        @else bg-warning text-dark
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                                    </span>
                                </li>
                                <li class="list-group-item px-0">
                                    <strong>Quantité:</strong> {{ $commande->quantite }}
                                </li>
                                <li class="list-group-item px-0">
                                    <strong>Zone géographique:</strong> {{ $commande->zone_geographique ?? 'N/A' }}
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>Acteurs</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0">
                                    <strong>Pharmacie:</strong> 
                                    <a href="{{ route('admin.pharmacies.show', $commande->pharmacy) }}">
                                        {{ $commande->pharmacy->nom }}
                                    </a>
                                </li>
                                <li class="list-group-item px-0">
                                    <strong>Adresse:</strong> {{ $commande->pharmacy->adresse }}
                                </li>
                                <li class="list-group-item px-0">
                                    <strong>Commercial:</strong> 
                                    {{ $commande->user->nom }} {{ $commande->user->prenom }}
                                </li>
                            </ul>
                        </div>
                    </div>

                    <h5>Notes</h5>
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            {{ $commande->notes ?? 'Aucune note pour cette commande' }}
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <small class="text-muted">
                            Créé le: {{ $commande->created_at->format('d/m/Y H:i') }}
                        </small>
                        <small class="text-muted">
                            Modifié le: {{ $commande->updated_at->format('d/m/Y H:i') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection