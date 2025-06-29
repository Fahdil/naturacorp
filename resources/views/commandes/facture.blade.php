
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Facture Commande {{ $mes_commande->id }}</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        h2 { margin-top: 40px; }
    </style>
</head>
<body>
    <h1>Facture - Commande #{{ $mes_commande->id }}</h1>
    <h3>Facture N° : {{ $mes_commande->numero_facture }}</h3>
    <p>Date : {{ $mes_commande->date }}</p>
    <p>Pharmacie : {{ $mes_commande->pharmacy->nom }}</p>
    <p>Quantité : {{ $mes_commande->quantite }}</p>
    <p>Statut : {{ ucfirst(str_replace('_', ' ', $mes_commande->statut)) }}</p>
    <p>Zone géographique : {{ $mes_commande->zone_geographique }}</p>
    <h2>Notes :</h2>
    <p>{{ $mes_commande->notes }}</p>
</body>
</html>
