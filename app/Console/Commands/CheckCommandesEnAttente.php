<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Commande;
use App\Notifications\CommandeEnAttenteNotification;
use Carbon\Carbon;

class CheckCommandesEnAttente extends Command
{
    protected $signature = 'commandes:check-attente';
    protected $description = 'Notifier les commerciaux des commandes en attente > 24h';

    public function handle()
    {
        $commandes = Commande::where('statut', 'en_attente')
            ->where('created_at', '<=', Carbon::now()->subHours(24))
            ->get();

        foreach ($commandes as $commande) {
            $user = $commande->commercial; // si la relation existe
            if ($user) {
                $user->notify(new CommandeEnAttenteNotification($commande));
            }
        }

        $this->info('Notifications envoyées.');
    }
}
