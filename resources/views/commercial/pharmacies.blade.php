@extends('layouts.app')
@section('title', 'Mes Pharmacies')

@section('content')
<div class="container my-5">


    <h1 class="mb-4 text-center">Mes Pharmacies</h1>

    <div class="mb-4 d-flex justify-content-between align-items-center">
    <h1>Mes Pharmacies</h1>

    <a href="{{ url('/mes-commandes') }}" class="btn btn-primary">
        commandes
    </a>

    <a href="{{ route('pharmacies.create') }}" class="btn btn-success">
        + Ajouter une pharmacie
    </a>

    
    </div>


    <!-- Filtres -->
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <select name="statut" class="form-select" aria-label="Filtrer par statut">
                <option value="">Tous les statuts</option>
                <option value="prospect" {{ request('statut') == 'prospect' ? 'selected' : '' }}>Prospect</option>
                <option value="client_actif" {{ request('statut') == 'client_actif' ? 'selected' : '' }}>Client actif</option>
                <option value="client_inactif" {{ request('statut') == 'client_inactif' ? 'selected' : '' }}>Client inactif</option>
            </select>
        </div>

        <div class="col-md-3">
            <input type="text" name="region" class="form-control" placeholder="Région" value="{{ request('region') }}">
        </div>

        <div class="col-md-3">
            <input type="text" name="departement" class="form-control" placeholder="Département" value="{{ request('departement') }}">
        </div>

        <div class="col-md-2">
            <select name="sort" class="form-select" aria-label="Trier par">
                <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Trier par</option>
                <option value="volume" {{ request('sort') == 'volume' ? 'selected' : '' }}>Volume de commande</option>
                <option value="alpha" {{ request('sort') == 'alpha' ? 'selected' : '' }}>Ordre alphabétique</option>
            </select>
        </div>

        <div class="col-md-1 d-grid">
            <button type="submit" class="btn btn-primary">Filtrer</button>
        </div>
    </form>

    <!-- Liste des pharmacies -->
    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Adresse</th>
                    <th>Statut</th>
                    <th>Zone</th>
                    <th>Volume commande</th>
                    <th style="width: 180px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pharmacies as $pharmacy)
                <tr>
                    <td>{{ $pharmacy->nom }}</td>
                    <td>{{ $pharmacy->adresse }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $pharmacy->statut)) }}</td>
                    <td>{{ $pharmacy->region }} / {{ $pharmacy->departement }}</td>
                    <td>{{ $pharmacy->commandes_sum_quantite }}</td>
                    <td>
                        <a href="#"
                            class="btn btn-sm btn-info"
                            data-bs-toggle="modal"
                            data-bs-target="#pharmacyModal"
                            data-id="{{ $pharmacy->id }}"
                            data-nom="{{ $pharmacy->nom }}"
                            data-adresse="{{ $pharmacy->adresse }}"
                            data-email="{{ $pharmacy->email ?? '' }}"
                            data-telephone="{{ $pharmacy->telephone ?? '' }}"
                            data-statut="{{ $pharmacy->statut }}"
                            data-region="{{ $pharmacy->region }}"
                            data-departement="{{ $pharmacy->departement }}">
                            Voir
                        </a>

                   

                        <a href="{{ url('/mes-pharmacies/modifier/'.$pharmacy->id) }}" class="btn btn-sm btn-warning ms-1">Modifier</a>
                        <form method="POST" action="{{ url('/mes-pharmacies/'.$pharmacy->id) }}" class="d-inline ms-1" onsubmit="return confirm('Supprimer cette pharmacie ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Aucune pharmacie trouvée.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $pharmacies->withQueryString()->links() }}
    </div>
</div>

<!-- MODALE DÉTAILS PHARMACIE -->
<div class="modal fade" id="pharmacyModal" tabindex="-1" aria-labelledby="pharmacyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Détails de la pharmacie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nom :</strong> <span id="modalNom"></span></p>
                <p><strong>Adresse :</strong> <span id="modalAdresse"></span></p>
                <p><strong>Email :</strong> <span id="modalEmail"></span></p>
                <p><strong>Téléphone :</strong> <span id="modalTelephone"></span></p>
                <p><strong>Statut :</strong> <span id="modalStatut"></span></p>
                <p><strong>Région :</strong> <span id="modalRegion"></span></p>
                <p><strong>Département :</strong> <span id="modalDepartement"></span></p>

                <!-- ✅ BOUTON POUR OUVRIR LES COMMANDES -->
                <div class="text-end mt-3">
                    <a href="#" id="btnVoirCommandes"
                       class="btn btn-primary"
                       data-bs-toggle="modal"
                       data-bs-target="#ordersModal"
                       data-pharmacy-id=""
                       data-pharmacy-nom="">
                        Voir les commandes
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal commandes -->
<!-- MODALE COMMANDES -->
<div class="modal fade" id="ordersModal" tabindex="-1" aria-labelledby="ordersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Commandes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body" id="ordersModalBody">
                <!-- Le contenu sera chargé dynamiquement -->
                <div class="text-center">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-2">Chargement des commandes...</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const pharmacyModal = document.getElementById('pharmacyModal');

        pharmacyModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            const nom = button.getAttribute('data-nom');
            const adresse = button.getAttribute('data-adresse');
            const email = button.getAttribute('data-email');
            const telephone = button.getAttribute('data-telephone');
            const statut = button.getAttribute('data-statut');
            const region = button.getAttribute('data-region');
            const departement = button.getAttribute('data-departement');
            const pharmacyId = button.getAttribute('data-id');

            document.getElementById('modalNom').textContent = nom;
            document.getElementById('modalAdresse').textContent = adresse;
            document.getElementById('modalEmail').textContent = email;
            document.getElementById('modalTelephone').textContent = telephone;
            document.getElementById('modalStatut').textContent = statut;
            document.getElementById('modalRegion').textContent = region;
            document.getElementById('modalDepartement').textContent = departement;

            const btnVoirCommandes = document.getElementById('btnVoirCommandes');
            btnVoirCommandes.setAttribute('data-pharmacy-id', pharmacyId);
            btnVoirCommandes.setAttribute('data-pharmacy-nom', nom);
        });

        document.getElementById('btnVoirCommandes').addEventListener('click', function (e) {
            const pharmacyId = this.getAttribute('data-pharmacy-id');
            const nom = this.getAttribute('data-pharmacy-nom');

            // Fermer le modal principal
            const pharmacyModalEl = document.getElementById('pharmacyModal');
            const pharmacyModal = bootstrap.Modal.getInstance(pharmacyModalEl);
            if (pharmacyModal) pharmacyModal.hide();

            // Affichage du spinner de chargement
            const ordersModalBody = document.getElementById('ordersModalBody');
            ordersModalBody.innerHTML = `
                <div class="text-center">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-2">Chargement des commandes...</p>
                </div>
            `;

            fetch(`/pharmacies/${pharmacyId}/commandes`)
                .then(res => res.json())
                .then(data => {
                    const commandes = data.commandes;

                    if (commandes.length === 0) {
                        ordersModalBody.innerHTML = `<p class="text-center">Aucune commande trouvée pour cette pharmacie.</p>`;
                        return;
                    }

                    let html = `
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Quantité</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                    `;

                    commandes.forEach(cmd => {
                        html += `
                            <tr>
                                <td>${cmd.id}</td>
                                <td>${cmd.quantite}</td>
                                <td>${formatStatut(cmd.statut)}</td>
                                <td>${formatDate(cmd.date)}</td>
                            </tr>
                        `;
                    });

                    html += `
                                </tbody>
                            </table>
                        </div>
                    `;

                    ordersModalBody.innerHTML = html;

                    const modalTitle = document.querySelector('#ordersModal .modal-title');
                    if (modalTitle) modalTitle.textContent = 'Commandes de ' + nom;
                });
        });
    });

    function formatStatut(statut) {
        switch (statut) {
            case 'en_cours':
                return '<span class="badge bg-warning text-dark">En cours</span>';
            case 'livree':
                return '<span class="badge bg-success">Livrée</span>';
            case 'annulee':
                return '<span class="badge bg-danger">Annulée</span>';
            default:
                return '<span class="badge bg-secondary">' + statut + '</span>';
        }
    }

    function formatDate(dateStr) {
        const date = new Date(dateStr);
        return date.toLocaleDateString('fr-FR', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }
</script>
@endpush
