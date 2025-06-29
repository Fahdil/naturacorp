@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajouter un utilisateur</h2>

    <form method="POST" action="{{ route('admin.utilisateurs.store') }}">
        @csrf

        <div class="mb-3">
            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Mot de passe</label>
            <input type="password" name="mot_de_passe" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Rôle</label>
            <select name="role" class="form-select" required>
                <option value="commercial">Commercial</option>
                <option value="admin">Admin</option>
                <option value="owner">Owner</option>
            </select>
        </div>

        <button class="btn btn-success">Créer l'utilisateur</button>
    </form>
</div>
@endsection
