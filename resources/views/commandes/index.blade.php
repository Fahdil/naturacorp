@extends('layouts.app')
@section('title', 'Mes Commandes')
@section('content')
<div class="container py-4">
    <h2 class="mb-4">Liste des commandes</h2>
    <form method="GET" class="row g-3 mb-4">
    <div class="col-md-3">
        <select name="statut" class="form-select">
            <option value="">Tous les statuts</option>
            <option value="en_cours" {{ request('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
            <option value="envoye" {{ request('statut') == 'envoye' ? 'selected' : '' }}>Envoyé</option>
            <option value="annule" {{ request('statut') == 'annule' ? 'selected' : '' }}>Annulé</option>
        </select>
    </div>
    <div class="col-md-3">
        <input type="text" name="zone" class="form-control" placeholder="Zone géographique" value="{{ request('zone') }}">
    </div>
    <div class="col-md-3">
        <input type="text" name="numero_facture" class="form-control" placeholder="Numéro de facture" value="{{ request('numero_facture') }}">
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary">Filtrer</button>
    </div>
</form>

    <a href="{{ route('mes-commandes.create') }}" class="btn btn-success mb-3">Ajouter une commande</a>

     <a href="{{ url('/mes-pharmacies') }}" class="btn btn-primary mb-3">pharmacies</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pharmacie</th>
                <th>Quantité</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commandes as $cmd)
            <tr>
                <td>{{ optional($cmd->pharmacy)->nom ?? 'Pharmacie inconnue/supprimer' }}</td>

                <td>{{ $cmd->quantite }}</td>
                <td>{{ $cmd->date }}</td>
                <td>{{ ucfirst(str_replace('_', ' ', $cmd->statut)) }}</td>
                <td>
                    <a href="{{ route('mes-commandes.edit', $cmd) }}" class="btn btn-sm btn-warning">Modifier</a>
                    <form action="{{ route('mes-commandes.destroy', $cmd) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ?')">Supprimer</button>
                    </form>
                    <a href="{{ route('mes-commandes.facture', $cmd) }}" class="btn btn-sm btn-secondary">Facture</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
