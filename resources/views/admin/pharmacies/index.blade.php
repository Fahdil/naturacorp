@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestion des Pharmacies</h1>
        <a href="{{ route('admin.pharmacies.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter
        </a>
    </div>

    <div class="card shadow-sm mb-4 w-100">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="statut" class="form-select">
                        <option value="">Tous les statuts</option>
                        <option value="prospect" {{ request('statut') == 'prospect' ? 'selected' : '' }}>Prospect</option>
                        <option value="client_actif" {{ request('statut') == 'client_actif' ? 'selected' : '' }}>Client actif</option>
                        <option value="client_inactif" {{ request('statut') == 'client_inactif' ? 'selected' : '' }}>Client inactif</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm w-100">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Adresse</th>
                            <th>Statut</th>
                            <th>Commercial</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pharmacies as $pharmacy)
                        <tr>
                            <td>{{ $pharmacy->nom }}</td>
                            <td>{{ Str::limit($pharmacy->adresse, 30) }}</td>
                            <td>
                                <span class="badge 
                                    @if($pharmacy->statut == 'client_actif') bg-success
                                    @elseif($pharmacy->statut == 'prospect') bg-info
                                    @else bg-secondary @endif">
                                    {{ $pharmacy->statut }}
                                </span>
                            </td>
                            <td> {{ $pharmacy->user ? $pharmacy->user->prenom . ' ' . $pharmacy->user->nom : 'Non attribué' }}</td>
                            <td>
                                <a href="{{ route('admin.pharmacies.show', $pharmacy) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.pharmacies.edit', $pharmacy) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.pharmacies.destroy', $pharmacy) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Aucune pharmacie trouvée</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $pharmacies->links() }}
    </div>
</div>
@endsection