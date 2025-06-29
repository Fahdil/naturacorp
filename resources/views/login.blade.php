@extends('layouts.app')
@section('title', 'Login')
@section('content')

<main class="container" id="login-container">
    <h1>Connexion</h1>

    <!-- Display Errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if(session('Error'))
        <div class="alert alert-danger">{{ session('Error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Login Form -->
    <form action="{{ route('login.post') }}" method="POST">
        @csrf 

        <!-- Email Input -->
        <label for="email">Email</label>
        <input 
            type="email" 
            id="email" 
            name="email" 
            placeholder="Entrez votre email" 
            value="{{ old('email') }}" 
            required>

        <!-- Password Input -->
        <label for="password">Mot de passe</label>
        <input 
            type="password" 
            id="password" 
            name="password" 
            placeholder="Entrez votre mot de passe" 
            required>

        <!-- Submit Button -->
        <button type="submit">Se connecter</button>

        <!-- Links -->
        <div class="link">
              @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
        </div>
        <!--div class="link">
            <a href="{{ route('register') }}">Créer un compte</a>
        </div-->
    </form>
</main>

@endsection
<style>

    /* Appliquer un fond léger à toute la page */


/* Conteneur du formulaire */
#login-container {
    margin-top: 2rem;
    background-color: white;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

/* Titre */
#login-container h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
}

/* Champs de formulaire */
form label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
}

form input[type="email"],
form input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 4px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Bouton de connexion */
form button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
}

form button:hover {
    background-color: #0056b3;
}

/* Lien de mot de passe oublié */
.link {
    text-align: center;
    margin-top: 15px;
}

.link a {
    color: #007bff;
    text-decoration: none;
}

.link a:hover {
    text-decoration: underline;
}

/* Alertes */
.alert {
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 4px;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
}



</style>