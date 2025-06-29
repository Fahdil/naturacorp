@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Gestion des zones de prospection</h2>

    {{-- ✅ Message de succès --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- ✅ Formulaire d'import CSV --}}
    <div class="mb-4">
        <form action="{{ route('admin.zones.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-2 align-items-center">
                <div class="col-md-6">
                    <input type="file" name="zones_csv" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-success">Importer zones (CSV)</button>
                </div>
            </div>
        </form>
    </div>

    {{-- ✅ Formulaire d’attribution de zone --}}
    <form method="POST" action="{{ route('admin.zones.assign') }}" class="mb-5">
        @csrf
        <div class="row">
            <div class="col">
                <select name="user_id" class="form-control" required>
                    <option value="">Sélectionnez un commercial</option>
                    @foreach($commerciaux as $user)
                        <option value="{{ $user->id }}">{{ $user->prenom }} {{ $user->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select name="zone_id" class="form-control" required>
                    <option value="">Sélectionnez une zone</option>
                    @foreach($zones as $zone)
                        <option value="{{ $zone->id }}">{{ $zone->code_postal }} - {{ $zone->ville }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Attribuer</button>
            </div>
        </div>
    </form>

    {{-- ✅ Liste des zones attribuées --}}
    <h4>Zones attribuées par commercial</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Commercial</th>
                <th>Zones attribuées</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($commerciaux as $user)
            <tr>
                <td>{{ $user->prenom }} {{ $user->nom }}</td>
                <td>
                    <ul class="list-unstyled">
                        @foreach($user->zones as $zone)
                            @php
                                $admin = \App\Models\User::find($zone->pivot->assigned_by);
                            @endphp
                            <li>
                                {{ $zone->code_postal }} - {{ $zone->ville }}
                                @if ($admin)
                                    <small class="text-muted">(Attribué par {{ $admin->prenom }})</small>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    @foreach($user->zones as $zone)
                        <form method="POST" action="{{ route('admin.zones.detach', [$user->id, $zone->id]) }}" style="display:inline-block; margin-bottom: 5px;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Retirer cette zone ?')">×</button>
                        </form><br>
                    @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
