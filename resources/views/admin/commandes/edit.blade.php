@extends('layouts.app')

@section('content')
<div class="container py-4 w-75">
    <div class="row justify-content-center ">
        <div class="col-md-12">
            <div class="card w-100">
                <div class="card-header">
                    <h4 class="mb-0">Modifier la Commande #{{ $commande->numero_facture }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.commandes.update', $commande) }}">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <!-- Pharmacie -->
                            <div class="col-md-6">
                                <label for="pharmacy_id" class="form-label">Pharmacie *</label>
                                <select name="pharmacy_id" id="pharmacy_id" class="form-select @error('pharmacy_id') is-invalid @enderror" required>
                                    <option value="">Sélectionnez une pharmacie</option>
                                    @foreach($pharmacies as $pharmacy)
                                        <option value="{{ $pharmacy->id }}" {{ old('pharmacy_id', $commande->pharmacy_id) == $pharmacy->id ? 'selected' : '' }}>
                                            {{ $pharmacy->nom }} ({{ $pharmacy->ville }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('pharmacy_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Commercial -->
                            <div class="col-md-6">
                                <label for="user_id" class="form-label">Commercial *</label>
                                <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                    <option value="">Sélectionnez un commercial</option>
                                    @foreach($commerciaux as $commercial)
                                        <option value="{{ $commercial->id }}" {{ old('user_id', $commande->user_id) == $commercial->id ? 'selected' : '' }}>
                                            {{ $commercial->nom }} {{ $commercial->prenom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Quantité -->
                            <div class="col-md-6">
                                <label for="quantite" class="form-label">Quantité *</label>
                                <input type="number" name="quantite" id="quantite" class="form-control @error('quantite') is-invalid @enderror" 
                                    value="{{ old('quantite', $commande->quantite) }}" min="1" required>
                                @error('quantite')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Date -->
                            <div class="col-md-6">
                                <label for="date" class="form-label">Date *</label>
                               <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" 
                                value="{{ old('date', isset($commande) && $commande->date ? $commande->date->format('Y-m-d') : '') }}" required>

                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Statut -->
                            <div class="col-md-6">
                                <label for="statut" class="form-label">Statut *</label>
                                <select name="statut" id="statut" class="form-select @error('statut') is-invalid @enderror" required>
                                    <option value="en_cours" {{ old('statut', $commande->statut) == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                    <option value="envoye" {{ old('statut', $commande->statut) == 'envoye' ? 'selected' : '' }}>Envoyé</option>
                                    <option value="annule" {{ old('statut', $commande->statut) == 'annule' ? 'selected' : '' }}>Annulé</option>
                                </select>
                                @error('statut')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Zone géographique -->
                            <div class="col-md-6">
                                <label for="zone_geographique" class="form-label">Zone géographique</label>
                                <input type="text" name="zone_geographique" id="zone_geographique" class="form-control @error('zone_geographique') is-invalid @enderror" 
                                    value="{{ old('zone_geographique', $commande->zone_geographique) }}">
                                @error('zone_geographique')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Notes -->
                            <div class="col-12">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea name="notes" id="notes" rows="3" class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $commande->notes) }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Boutons -->
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Enregistrer
                                </button>
                                <a href="{{ route('admin.commandes.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left"></i> Annuler
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection