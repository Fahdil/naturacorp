@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des utilisateurs</h2>
    <a href="{{ route('admin.utilisateurs.create') }}" class="btn btn-primary mb-3">Ajouter un utilisateur</a>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->nom }}</td>
                <td>{{ $user->prenom }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
        
                <td>
                    <a href="{{ route('admin.utilisateurs.edit', $user) }}" class="btn btn-sm btn-warning">Modifier</a>

                    <form method="POST" action="{{ route('admin.utilisateurs.destroy', $user) }}" style="display:inline;" onsubmit="return confirm('Confirmer la suppression ?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Supprimer</button>
                    </form>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
