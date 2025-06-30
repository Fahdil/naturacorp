<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\CommercialController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZoneProspectionController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\PharmacieControllerAdmin;
use App\Http\Controllers\CommandeControllerAdmin;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* SITE VITRINE */

//page contact
Route::get('/vitrine/contact', [ContactController::class, 'index'])->name('contact.index');

Route::post('/vitrine/contact', [ContactController::class, 'send'])->name('contact.send');

//page acceuil
Route::get('/vitrine/test', function () {
    return view('/vitrine/test');
})->name('home');

//page confidentialites
Route::get('/vitrine/confid', function () {
    return view('/vitrine/confid');
})->name('politique-confidentialités');

//a propos
Route::get('/vitrine/propos', function () {
    return view('/vitrine/propos');
})->name('propos.index');

//page produit
Route::get('/vitrine/produit', function () {
    return view('/vitrine/produit');
})->name('produit.index');



/************  CRM  *****************/
Route::get('/', function () {
    return view('/vitrine/test');
});

// Admin
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard.admin');
});

// Commercial
Route::middleware(['auth', 'isCommercial'])->group(function () {
    Route::get('/commercial/dashboard', [CommercialController::class, 'dashboard'])->name('dashboard.commercial');
});




// Owner
Route::middleware(['auth', 'isOwner'])->group(function () {
    Route::get('/owner/dashboard', [OwnerController::class, 'dashboard'])->name('dashboard.owner');
});

require __DIR__.'/auth.php';

Route::get('/test-user', function () {
    $user = Auth::user();
    dd($user->email, $user->role);  // Affiche directement ces champs
});



Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::post('/logout', [AuthManager::class, 'logout'])->name('logout');





/*** suite */
Route::middleware(['auth', 'isCommercial'])->group(function () {
    Route::get('/mes-pharmacies', [\App\Http\Controllers\PharmacyController::class, 'index'])->name('pharmacies.index');

    //Route::get('/commercial/dashboard', [CommercialDashboardController::class, 'index'])->name('commercial.dashboard');

});

Route::middleware(['auth'])->group(function () {
// Pharmacies
    Route::prefix('mes-pharmacies')->name('pharmacies.')->group(function () {
        Route::get('/', [PharmacyController::class, 'index'])->name('index');                 // Liste
        Route::get('/nouveau', [PharmacyController::class, 'create'])->name('create');        // Formulaire ajout
        Route::post('/', [PharmacyController::class, 'store'])->name('store');                // Enregistrer

        Route::get('/{id}', [PharmacyController::class, 'show'])->name('show');               // Détails
        Route::get('/modifier/{id}', [PharmacyController::class, 'edit'])->name('edit');      // Formulaire modif
        Route::put('/{id}', [PharmacyController::class, 'update'])->name('update');           // Modifier
        Route::delete('/{id}', [PharmacyController::class, 'destroy'])->name('destroy');      // Supprimer
    });

    Route::get('/pharmacies/{pharmacy}/commandes', [PharmacyController::class, 'commandesJson'])
    ->name('pharmacies.commandes.json');

    Route::get('/geojson', [PharmacyController::class, 'geojson'])->name('pharmacies.geojson');
    Route::get('/commercial/carte', [PharmacyController::class, 'map'])->name('pharmacies.carte');
   



//commandes


// Commandes (index, create, store, edit, update, destroy)

    Route::get('/mes-commandes', [CommandeController::class, 'index'])->name('mes-commandes.index');
    Route::get('/mes-commandes/nouveau', [CommandeController::class, 'create'])->name('mes-commandes.create');
    Route::post('/mes-commandes', [CommandeController::class, 'store'])->name('mes-commandes.store');
    Route::get('/mes-commandes/modifier/{mes_commande}', [CommandeController::class, 'edit'])->name('mes-commandes.edit');
    Route::put('/mes-commandes/{mes_commande}', [CommandeController::class, 'update'])->name('mes-commandes.update');
    Route::delete('/mes-commandes/{mes_commande}', [CommandeController::class, 'destroy'])->name('mes-commandes.destroy');

    // Générer une facture PDF
    Route::get('/mes-commandes/facture/{mes_commande}', [CommandeController::class, 'facture'])->name('mes-commandes.facture');
});

// mon compte
Route::middleware(['auth'])->group(function () {
    Route::get('/mon-compte', [UserController::class, 'edit'])->name('mon-compte.edit');
    Route::post('/mon-compte', [UserController::class, 'update'])->name('mon-compte.update');
    Route::post('/mon-compte/mot-de-passe', [UserController::class, 'updatePassword'])->name('mon-compte.updatePassword');
});

/*notification*/
// web.php
Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::post('/notifications/read-all', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');


/*admin*/

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard.admin');
    
    Route::get('/utilisateurs', [AdminController::class, 'index'])->name('admin.utilisateurs.index');
    Route::get('/utilisateurs/create', [AdminController::class, 'create'])->name('admin.utilisateurs.create');
    Route::post('/utilisateurs', [AdminController::class, 'store'])->name('admin.utilisateurs.store');
    Route::delete('/utilisateurs/{user}', [AdminController::class, 'destroy'])->name('admin.utilisateurs.destroy');
    Route::get('/utilisateurs/{user}/edit', [AdminController::class, 'edit'])->name('admin.utilisateurs.edit');
    Route::put('/utilisateurs/{user}', [AdminController::class, 'update'])->name('admin.utilisateurs.update');

    Route::get('/zones', [AdminController::class, 'zones'])->name('admin.zones');
    Route::get('/pharmacies', [AdminController::class, 'pharmacies'])->name('admin.pharmacies');
    Route::get('/commandes', [AdminController::class, 'commandes'])->name('admin.commandes');
    Route::get('/statistiques', [AdminController::class, 'stats'])->name('admin.statistiques');
    Route::get('/audit', [AdminController::class, 'audit'])->name('admin.audit');
    Route::get('/pharmacies/{id}/documents', [AdminController::class, 'documents'])->name('admin.documents.index');


    Route::get('/zones', [ZoneProspectionController::class, 'index'])->name('admin.zones.index');
    Route::post('/zones/assign', [ZoneProspectionController::class, 'assignZone'])->name('admin.zones.assign');
    Route::delete('/zones/{user}/{zone}', [ZoneProspectionController::class, 'detachZone'])->name('admin.zones.detach');
    Route::post('/admin/zones/import', [ZoneProspectionController::class, 'import'])->name('admin.zones.import');


   // Route::get('/statistiques', [StatsController::class, 'index']) ->name('statistiques.index');


    Route::get('/statistiques', [StatsController::class, 'index'])->name('statistiques.index');
    Route::get('stats/export-excel', [StatsController::class, 'exportExcel'])->name('stats.exportExcel');
    Route::get('stats/export-pdf',   [StatsController::class, 'exportPdf'])->name('stats.exportPdf');
    Route::get('stats/chart-data',   [StatsController::class, 'chartData'])->name('stats.chartData');
   // Route::get('commandes/{id}',     [StatsController::class, 'show'])->name('commandes.show');



    //pharmacies

     Route::get('pharmacies/index', [PharmacieControllerAdmin::class, 'index'])->name('admin.pharmacies.index');
    Route::get('pharmacies/create', [PharmacieControllerAdmin::class, 'create'])->name('admin.pharmacies.create');
    Route::post('pharmacies', [PharmacieControllerAdmin::class, 'store'])->name('admin.pharmacies.store');
    Route::get('pharmacies/{pharmacy}', [PharmacieControllerAdmin::class, 'show'])->name('admin.pharmacies.show');
    Route::get('pharmacies/{pharmacy}/edit', [PharmacieControllerAdmin::class, 'edit'])->name('admin.pharmacies.edit');
    Route::put('pharmacies/{pharmacy}', [PharmacieControllerAdmin::class, 'update'])->name('admin.pharmacies.update');
    Route::delete('pharmacies/{pharmacy}', [PharmacieControllerAdmin::class, 'destroy'])->name('admin.pharmacies.destroy');


   
        Route::get('/commandes/', [CommandeControllerAdmin::class, 'index'])->name('admin.commandes.index');
        Route::get('/commandes/create', [CommandeControllerAdmin::class, 'create'])->name('admin.commandes.create');
        Route::post('/commandes/', [CommandeControllerAdmin::class, 'store'])->name('admin.commandes.store');
        Route::get('/commandes/{commande}', [CommandeControllerAdmin::class, 'show'])->name('admin.commandes.show');
        Route::get('/commandes/{commande}/edit', [CommandeControllerAdmin::class, 'edit'])->name('admin.commandes.edit');
        Route::put('/commandes/{commande}', [CommandeControllerAdmin::class, 'update'])->name('admin.commandes.update');
        Route::delete('/commandes/{commande}', [CommandeControllerAdmin::class, 'destroy'])->name('admin.commandes.destroy');
        Route::get('/export', [CommandeControllerAdmin::class, 'export'])->name('admin.commandes.export');
    

});

