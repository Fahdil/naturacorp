

@extends('layouts.app')

@section('content')

<div class="background-waves">
    <svg class="wave wave1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#007bff" fill-opacity="0.2" d="M0,96L48,90.7C96,85,192,75,288,74.7C384,75,480,85,576,101.3C672,117,768,139,864,144C960,149,1056,139,1152,144C1248,149,1344,171,1392,181.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"/>
    </svg>

    <svg class="wave wave2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#007bff" fill-opacity="0.15" d="M0,160L60,170.7C120,181,240,203,360,213.3C480,224,600,224,720,218.7C840,213,960,203,1080,181.3C1200,160,1320,128,1380,112L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"/>
    </svg>

    <!--svg class="wave wave3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#007bff" fill-opacity="0.1" d="M0,64L60,90.7C120,117,240,171,360,197.3C480,224,600,224,720,197.3C840,171,960,117,1080,106.7C1200,96,1320,128,1380,144L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"/>
    </svg-->
</div>


<div class="container my-5"> 


        <!-- afficher um message quand on envoie un mail -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    <!-- Titre principal --> 
    <h1 class="text-center mb-4">Service Client</h1> 
    <h3 class="text-center mb-4">Bonjour. Comment pouvons-nous vous aider ?</h3> 

 
    <!-- Sections principales --> 
    <div class="row"> 
        <!-- Section FAQ --> 
        <div class="col-md-6 mb-4"> 
            <section class="mb-5"> 
                <h2 class="mb-3">Questions Fréquentes</h2> 
                <div id="faqAccordion"> 
                    <div class="card mb-3"> 
                        <div class="card-header" id="faqOne"> 
                            <h5 class="mb-0"> 
                                <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> 
                                    Comment suivre ma commande ? 
                                </button> 
                            </h5> 
                        </div> 
                        <div id="collapseOne" class="collapse show" aria-labelledby="faqOne" data-bs-parent="#faqAccordion"> 
                            <div class="card-body"> 
                                Vous pouvez suivre votre commande en accédant à votre compte et en sélectionnant "Mes commandes". 
                            </div> 
                        </div> 
                    </div> 
 
                    <div class="card mb-3"> 
                        <div class="card-header" id="faqTwo"> 
                            <h5 class="mb-0"> 
                                <button class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> 
                                    Quelle est la politique de retour ? 
                                </button> 
                            </h5> 
                        </div> 
                        <div id="collapseTwo" class="collapse" aria-labelledby="faqTwo" data-bs-parent="#faqAccordion"> 
                            <div class="card-body"> 
                                Vous pouvez retourner un article dans les 30 jours suivant la réception, sous réserve qu'il soit dans son état d'origine. 
                            </div> 
                        </div> 
                    </div> 
 
                    <button type="submit" class="btn btn-primary">Plus de FAQ</button> 
 
                </div> 
            </section> 
        </div> 
 
        <!-- Section Formulaire de Contact --> 
        <div class="col-md-6 mb-4" id="aideServices"> 
            <section class="mb-5"> 
                <h2 class="mb-3">Contactez-nous</h2> 
                <form method="POST" action="{{ route('contact.send') }}">
                    @csrf 
                    <div class="mb-3"> 
                        <label for="name" class="form-label">Nom</label> 
                        <input type="text" class="form-control contact-form-input" id="name" name="name" required> 
                    </div> 
                    <div class="mb-3"> 
                        <label for="email" class="form-label">Adresse e-mail</label> 
                        <input type="email" class="form-control contact-form-input" id="email" name="email" required> 
                    </div> 
                    <div class="mb-3"> 
                        <label for="message" class="form-label">Message</label> 
                        <textarea class="form-control contact-form-input" id="message" name="message" rows="4" required></textarea> 
                    </div> 
                    <button type="submit" class="btn btn-primary">Envoyer</button> 
                </form> 
            </section> 
        </div> 
 
        <!-- Section Liens Rapides --> 
        <div class="col-md-6 mb-4"> 
            <section> 
                <h2 class="mb-3">Liens Rapides</h2> 
                <ul class="list-group"> 
                    <li class="list-group-item"> 
                    <a href="{{ route('home') }}"> Acceuil </a>
                    </li>
                    <li class="list-group-item"> 
                        <a href="{{ route('politique-confidentialités') }}">Politique de confidentialité</a> 
                    </li> 
                    <li class="list-group-item"> 
                        <a href="#">Achat et retours</a> 
                    </li> 
                </ul> 
            </section> 
        </div> 
    </div> 
</div> 

 
 
<style> 
.container.my-5 {
    position: relative;
    z-index: 1;
}

 
/* Styles pour la page Service Client */ 
.service-client-container { 
    margin-top: 50px; 
} 
 
.card-header button { 
    color: #007bff; 
    text-decoration: none; 
} 
 
.card-header button:hover { 
    color: #0056b3; 
} 
 
.list-group-item a { 
    color: #333; 
    text-decoration: none; 
} 
 
.list-group-item a:hover { 
    color: #007bff; 
} 
 
/* Styles pour les sections */ 
section { 
    margin-bottom: 30px; 
} 
 
/* Sections contatez-nous */ 
input{ 
    margin-left : 2O%; 
    width: 80%; 
} 
 
/* Section Questions Fréquentes */ 
#faqAccordion .card-header { 
    background-color: #f8f9fa; 
} 
 
/* Pour les écrans plus petits (Mobile et Tablette) */ 
@media (max-width: 767px) { 
    .col-md-6 { 
        margin-bottom: 20px; 
    } 
} 
 
/* Pour les grands écrans (Desktop) */ 
@media (min-width: 768px) { 
    .col-md-6 { 
        margin-bottom: 30px; 
    } 
} 




/**test */

.background-waves {
    position: absolute;
    top: 0;
    width: 100%;
    
    z-index: 0;
}

.wave {
    position: absolute;
    width: 100%;
    height: auto;
}

.wave1 {
    top: 0;
}

.wave2 {
    top: 250px;
}

.wave3 {
    top: 500px;
}

 
 
</style>

@endsection