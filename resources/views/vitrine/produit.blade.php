@extends('layouts.app')

@section('content')
<section class="product-section">
    <div class="container">
        <!-- Trust badges ribbon -->
        <div class="trust-badges">
            <div class="badge">
                <i class="fas fa-check-circle"></i>
                <span>100% Naturel</span>
            </div>
            <div class="badge">
                <i class="fas fa-flask"></i>
                <span>Validé Scientifiquement</span>
            </div>
            <div class="badge">
                <i class="fas fa-leaf"></i>
                <span>Ingrédients Bio</span>
            </div>
        </div>

        <div class="product-content">
            <!-- Left: Text -->
            <div class="product-text">
                <span class="product-label">Complément Premium</span>
                <h1>MushBlue: <span class="highlight">Le pouvoir naturel</span> de l'Aoi Kinoko</h1>
                <p class="lead">
                    Découvrez l'élixir de bien-être développé à partir du champignon japonais <strong>Aoi Kinoko</strong>, cultivé dans les forêts préservées d'Okinawa.
                </p>
                
                <div class="benefits">
                    <div class="benefit-item">
                        <i class="fas fa-brain"></i>
                        <span>Clarté mentale</span>
                    </div>
                    <div class="benefit-item">
                        <i class="fas fa-heart"></i>
                        <span>Énergie durable</span>
                    </div>
                    <div class="benefit-item">
                        <i class="fas fa-shield-alt"></i>
                        <span>Défenses naturelles</span>
                    </div>
                </div>

                <div class="rating">
                    <div class="stars">
                        @for ($i = 0; $i < 5; $i++)
                            <i class="fas fa-star" aria-hidden="true"></i>
                        @endfor
                        <span class="rating-text">4.9/5 (248 avis)</span>
                    </div>
                </div>

                <div class="cta-container">
                    <a href="{{ route('contact.index') }}" class="cta-button">
                        <span>Essayer MushBlue</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    
                </div>
            </div>

            <!-- Middle: Product Image with floating elements -->
            <div class="product-image-container">
                <div class="product-image">
                    <img src="/storage/images/mushblue.jpeg" alt="Flacon de MushBlue - Complément alimentaire naturel à base d'Aoi Kinoko" loading="lazy">
                    <div class="floating-label organic">
                        <i class="fas fa-leaf"></i>
                        <span>Bio</span>
                    </div>
                    <div class="floating-label made-in-france">
                        <i class="fas fa-flag"></i>
                        <span>Fabriqué en France</span>
                    </div>
                </div>
            </div>

            <!-- Right: Features -->
            <div class="product-features">
                <h2>Pourquoi choisir MushBlue ?</h2>
                <ul>
                    <li>
                        <div class="feature-icon">
                            <i class="fas fa-seedling"></i>
                        </div>
                        <div class="feature-text">
                            <h3>100% naturel et bio</h3>
                            <p>Sans additifs artificiels ni conservateurs</p>
                        </div>
                    </li>
                    <li>
                        <div class="feature-icon">
                            <i class="fas fa-microscope"></i>
                        </div>
                        <div class="feature-text">
                            <h3>Recherche scientifique</h3>
                            <p>Validé par des études cliniques</p>
                        </div>
                    </li>
                    <li>
                        <div class="feature-icon">
                            <i class="fas fa-tint"></i>
                        </div>
                        <div class="feature-text">
                            <h3>Formule liquide</h3>
                            <p>Absorption 3x plus rapide que les gélules</p>
                        </div>
                    </li>
                    <li>
                        <div class="feature-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="feature-text">
                            <h3>Qualité premium</h3>
                            <p>Production selon les normes pharmaceutiques</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<style>
:root {
    --primary-color: #0f3c4d; /* Deep blue from other pages */
    --primary-light: #145a6d; /* Lighter blue variant */
    --secondary-color: #2a6f5c; /* Green from other pages */
    --accent-color: #e9c46a; /* Gold accent */
    --light-bg: #f8fbfd; /* Light background */
    --text-dark: #264653; /* Dark text color */
    --text-light: #6c757d; /* Light text color */
    --white: #ffffff;
    --transition: all 0.3s ease;
}

.product-section {
    padding: 5rem 1rem;
    background: var(--light-bg);
    font-family: 'Segoe UI', system-ui, sans-serif;
    position: relative;
    overflow: hidden;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
}

.trust-badges {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    margin-bottom: 2.5rem;
    flex-wrap: wrap;
}

.badge {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--white);
    padding: 0.75rem 1.25rem;
    border-radius: 50px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--primary-color);
    transition: var(--transition);
}

.badge:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.badge i {
    color: var(--secondary-color);
}

.product-content {
    display: flex;
    flex-wrap: wrap;
    gap: 3rem;
    justify-content: space-between;
    align-items: center;
}

.product-text {
    flex: 1 1 100%;
    max-width: 400px;
}

.product-label {
    display: inline-block;
    background: var(--secondary-color);
    color: var(--white);
    padding: 0.25rem 0.75rem;
    border-radius: 4px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.product-text h1 {
    font-size: 2.4rem;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    line-height: 1.3;
    font-weight: 700;
}

.highlight {
    color: var(--secondary-color);
    position: relative;
    display: inline-block;
}

.highlight::after {
    content: '';
    position: absolute;
    bottom: 5px;
    left: 0;
    width: 100%;
    height: 8px;
    background: rgba(42, 111, 92, 0.3);
    z-index: -1;
    border-radius: 3px;
}

.product-text .lead {
    font-size: 1.2rem;
    color: var(--text-dark);
    line-height: 1.7;
    margin-bottom: 2rem;
}

.benefits {
    display: flex;
    gap: 1rem;
    margin: 2rem 0;
    flex-wrap: wrap;
}

.benefit-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--white);
    padding: 0.75rem 1rem;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--primary-color);
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    transition: var(--transition);
}

.benefit-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.benefit-item i {
    color: var(--secondary-color);
}

.rating {
    margin: 2rem 0;
}

.stars {
    color: var(--accent-color);
    font-size: 1.2rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.rating-text {
    font-size: 0.9rem;
    color: var(--text-light);
    margin-left: 0.5rem;
    font-weight: 500;
}

.cta-container {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    flex-wrap: wrap;
}

.cta-button {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 1.75rem;
    background-color: var(--primary-color);
    color: var(--white);
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
    box-shadow: 0 4px 6px rgba(15, 60, 77, 0.2);
}

.cta-button:hover {
    background-color: var(--primary-light);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(15, 60, 77, 0.3);
}

.secondary-button {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 1.5rem;
    background-color: var(--white);
    color: var(--primary-color);
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
    border: 1px solid rgba(15, 60, 77, 0.2);
}

.secondary-button:hover {
    background-color: rgba(15, 60, 77, 0.05);
    border-color: var(--primary-color);
}

.product-image-container {
    flex: 1 1 100%;
    max-width: 400px;
    position: relative;
}

.product-image {
    position: relative;
    width: 100%;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    aspect-ratio: 1/1;
    background: var(--white);
    padding: 1rem;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: var(--transition);
}

.floating-label {
    position: absolute;
    padding: 0.5rem 0.75rem;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    transition: var(--transition);
}

.floating-label.organic {
    top: 1.5rem;
    left: 1.5rem;
    background: var(--secondary-color);
    color: var(--white);
}

.floating-label.made-in-france {
    bottom: 1.5rem;
    right: 1.5rem;
    background: var(--white);
    color: var(--primary-color);
    border: 1px solid rgba(0,0,0,0.1);
}

.product-features {
    flex: 1 1 100%;
    max-width: 400px;
}

.product-features h2 {
    font-size: 1.75rem;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    font-weight: 700;
}

.product-features ul {
    list-style: none;
    padding-left: 0;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.product-features li {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
    transition: var(--transition);
    padding: 1rem;
    border-radius: 8px;
}

.product-features li:hover {
    background: rgba(255,255,255,0.7);
    transform: translateX(5px);
}

.feature-icon {
    width: 40px;
    height: 40px;
    background: rgba(42, 111, 92, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--secondary-color);
    font-size: 1.1rem;
    flex-shrink: 0;
}

.feature-text h3 {
    font-size: 1.1rem;
    color: var(--primary-color);
    margin-bottom: 0.25rem;
    font-weight: 600;
}

.feature-text p {
    font-size: 0.95rem;
    color: var(--text-light);
    line-height: 1.5;
    margin: 0;
}

@media (min-width: 768px) {
    .product-text, .product-image-container, .product-features {
        flex: 1 1 30%;
    }
    
    .product-text h1 {
        font-size: 2.8rem;
    }
}

@media (max-width: 767px) {
    .product-section {
        padding: 3rem 1rem;
    }
    
    .product-content {
        gap: 2rem;
    }
    
    .product-image {
        margin: 0 auto;
    }
    
    .trust-badges {
        gap: 0.75rem;
    }
    
    .badge {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
    }
}
</style>
@endsection