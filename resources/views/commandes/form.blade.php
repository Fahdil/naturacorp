
@extends('layouts.app')
@section('title', isset($commande) ? 'Modifier commande' : 'Nouvelle commande')
@section('content')
<div class="container py-4">
    <h2 class="mb-4">{{ isset($commande) ? 'Modifier' : 'Créer' }} une commande</h2>
    <form action="{{ isset($commande) ? route('mes-commandes.update', $commande) : route('mes-commandes.store') }}" method="POST" id="commande-form">
        @csrf
        @if(isset($commande)) @method('PUT') @endif

        <div class="mb-3">
            <label for="pharmacy_id" class="form-label">Pharmacie</label>
            <select name="pharmacy_id" class="form-select" required>
                @foreach($pharmacies as $pharmacy)
                    <option value="{{ $pharmacy->id }}" {{ (old('pharmacy_id', $commande->pharmacy_id ?? '') == $pharmacy->id) ? 'selected' : '' }}>{{ $pharmacy->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité</label>
            <input type="number" name="quantite" class="form-control" value="{{ old('quantite', $commande->quantite ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="statut" class="form-label">Statut</label>
            <select name="statut" class="form-select" required>
                <option value="en_cours" {{ old('statut', $commande->statut ?? '') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                <option value="envoye" {{ old('statut', $commande->statut ?? '') == 'envoye' ? 'selected' : '' }}>Envoyé</option>
                <option value="annule" {{ old('statut', $commande->statut ?? '') == 'annule' ? 'selected' : '' }}>Annulé</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" class="form-control" value="{{ old('date', $commande->date ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="zone_geographique" class="form-label">Zone géographique</label>
            <input type="text" name="zone_geographique" class="form-control" value="{{ old('zone_geographique', $commande->zone_geographique ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" class="form-control">{{ old('notes', $commande->notes ?? '') }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('mes-commandes.index') }}" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary">{{ isset($commande) ? 'Mettre à jour' : 'Créer' }}</button>
        </div>
    </form>
</div>

<script>
let formModified = false;
document.getElementById('commande-form').addEventListener('change', () => formModified = true);
window.addEventListener('beforeunload', function (e) {
    if (formModified) {
        e.preventDefault();
        e.returnValue = 'Attention votre travail va être perdu, êtes-vous sûr de vouloir changer de page ?';
    }
});
</script>
@endsection