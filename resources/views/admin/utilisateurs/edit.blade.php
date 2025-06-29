@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier l'utilisateur</h2>

    <form method="POST" action="{{ route('admin.utilisateurs.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Prénom</label>
            <input type="text" name="prenom" value="{{ old('prenom', $user->prenom) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" value="{{ old('nom', $user->nom) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Rôle</label>
            <select name="role" class="form-select">
                <option value="commercial" {{ $user->role == 'commercial' ? 'selected' : '' }}>Commercial</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="owner" {{ $user->role == 'owner' ? 'selected' : '' }}>Owner</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>
@endsection
