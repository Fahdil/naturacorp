@extends('layouts.app')

@section('content')
<div class="container py-4 ">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-lg w-100">
                <div class="card-header bg-white py-3">
                    <h3 class="h5 mb-0 text-primary">
                        <i class ="fas fa-user-cog me-2"></i>Mon Compte
                    </h3>
                </div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Section Informations personnelles -->
                    <div class="mb-5">
                        <h4 class="h6 text-muted mb-4 pb-2 border-bottom">
                            <i class="fas fa-user-edit me-2"></i>Informations personnelles
                        </h4>
                        
                        <form action="{{ route('mon-compte.update') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Prénom</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-user text-muted"></i>
                                        </span>
                                        <input type="text" name="prenom" class="form-control" 
                                               value="{{ old('prenom', $user->prenom) }}" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Nom</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-user text-muted"></i>
                                        </span>
                                        <input type="text" name="nom" class="form-control" 
                                               value="{{ old('nom', $user->nom) }}" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-8">
                                    <label class="form-label small text-muted">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input type="email" name="email" class="form-control" 
                                               value="{{ old('email', $user->email) }}" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label small text-muted">Rôle</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-user-tag text-muted"></i>
                                        </span>
                                        <input type="text" class="form-control bg-light" 
                                               value="{{ ucfirst($user->role) }}" disabled>
                                    </div>
                                </div>
                                
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-save me-2"></i>Mettre à jour
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Section Mot de passe -->
                    <div class="mt-5 pt-4">
                        <h4 class="h6 text-muted mb-4 pb-2 border-bottom">
                            <i class="fas fa-lock me-2"></i>Sécurité du compte
                        </h4>
                        
                        <form action="{{ route('mon-compte.updatePassword') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label small text-muted">Mot de passe actuel</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-key text-muted"></i>
                                        </span>
                                        <input type="password" name="current_password" 
                                               class="form-control" required>
                                        <button class="btn btn-outline-secondary toggle-password" 
                                                type="button">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Nouveau mot de passe</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-key text-muted"></i>
                                        </span>
                                        <input type="password" name="password" 
                                               class="form-control" required>
                                        <button class="btn btn-outline-secondary toggle-password" 
                                                type="button">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="form-text small">Minimum 8 caractères</div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Confirmation</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-key text-muted"></i>
                                        </span>
                                        <input type="password" name="password_confirmation" 
                                               class="form-control" required>
                                        <button class="btn btn-outline-secondary toggle-password" 
                                                type="button">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-warning px-4">
                                        <i class="fas fa-lock me-2"></i>Changer le mot de passe
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border: none;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }
    
    .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
    }
    
    .input-group-text {
        transition: all 0.3s;
    }
    
    .toggle-password {
        cursor: pointer;
    }
    
    .form-control:disabled {
        background-color: #f8f9fa;
    }
</style>
@endpush

@push('scripts')
<script>
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(function(button) {
        button.addEventListener('click', function() {
            const input = this.parentNode.querySelector('input');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    });
</script>
@endpush