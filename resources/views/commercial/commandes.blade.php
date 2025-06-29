@if($commandes->isEmpty())
    <p class="text-center">Aucune commande pour cette pharmacie.</p>
@else
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>Date</th>
                <th>Montant</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commandes as $commande)
                <tr>
                    <td>{{ $commande->created_at->format('d/m/Y') }}</td>
                    <td>{{ number_format($commande->montant, 2, ',', ' ') }} €</td>
                    <td>{{ ucfirst($commande->statut) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
