@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">Mushblue</h1>
                <h2 class="hero-subtitle">La nature à votre service</h2>
                <p class="hero-description">MushBlue, un complément alimentaire révolutionnaire à base d'Aoi Kinoko, un champignon japonais aux vertus uniques. Inspiré des traditions d'Okinawa et développé en France, il soutient votre bien-être naturellement.</p>
                <a href="{{ route('produit.index') }}" class="cta-button">Découvrir le produit</a>
            </div>
            <div class="hero-model">
                <model-viewer id="bioModel" class="product-model" 
                    src="{{ asset('storage/models/bio.glb') }}" 
                    alt="Modèle 3D de MushBlue"
                    auto-rotate  
                    rotation-per-second="180" 
                    camera-controls
                    ar
                    background-color="transparent">
                </model-viewer>
            </div>
        </div>
    </div>
</section>

<!-- Story Section -->
<section class="story-section">
    <div class="container">
        <article class="story-article">
            <div class="story-image">
                <img src="/storage/images/tokyo.jpg" alt="Voyage au Japon">
            </div>
            <div class="story-content">
                <h2 class="section-title">Notre histoire</h2>
                <div class="story-text">
                    <p>Tout a commencé lors d'un voyage au Japon. Benjamin DUFOUR, ingénieur agronome, et Hannah COSTA, consultante en communication, ont découvert l'Aoi Kinoko, un champignon rare utilisé sur l'île d'Okinawa pour ses vertus thérapeutiques.</p>
                    <p>Fascinés par ses propriétés, ils ramènent un échantillon en France et consacrent deux années à l'étude de ce champignon en collaboration avec un laboratoire spécialisé. Ce travail donne naissance à MushBlue, le premier complément alimentaire liquide à base d'Aoi Kinoko.</p>
                </div>
                <a href="{{ route('produit.index') }}" class="secondary-button">Voir le produit</a>
            </div>
        </article>
    </div>
</section>

<!-- Founders Section -->
<section class="founders-section">
    <div class="container">
        <h2 class="section-title centered">Les fondateurs de NaturaCorp</h2>
        <div class="founders-grid">
            <div class="founder-card">
                <div class="founder-image">
                    <img src="/storage/images/benjamin.png" alt="Benjamin DUFOUR">
                </div>
                <h3>Benjamin DUFOUR</h3>
                <p class="founder-role">Ingénieur agronome</p>
                <p class="founder-bio">Passionné par les plantes médicinales et la mycologie. Il pilote les recherches scientifiques et la production.</p>
            </div>
            
            <div class="founder-card">
                <div class="founder-image">
                    <img src="/storage/images/hannah.png" alt="Hannah COSTA">
                </div>
                <h3>Hannah COSTA</h3>
                <p class="founder-role">Consultante en communication</p>
                <p class="founder-bio">Elle dirige la stratégie marketing, l'identité de marque et les relations publiques de NaturaCorp.</p>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="gallery-section">
    <div class="container">
        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="/storage/images/prod1.jpg" alt="Produit MushBlue">
            </div>
            <div class="gallery-item">
                <img src="/storage/images/prod2.jpg" alt="Produit MushBlue">
            </div>
            <div class="gallery-item">
                <img src="/storage/images/prod3.jpg" alt="Produit MushBlue">
            </div>
            <div class="gallery-item">
                <img src="/storage/images/prod4.jpg" alt="Produit MushBlue">
            </div>
            
        </div>
    </div>
</section>

<!-- Trust Section -->
<section class="trust-section">
    <div class="container">
        <h2 class="section-title centered">Pourquoi nous croire</h2>
        <p class="section-subtitle">Notre engagement pour votre bien-être</p>
        
        <div class="trust-grid">
            <div class="trust-card">
                <div class="trust-icon">
                    <i class="fa-solid fa-leaf"></i>
                </div>
                <h3>Laboratoire certifié</h3>
                <p>Nos produits sont développés dans des laboratoires certifiés selon les normes les plus strictes de l'industrie.</p>
                <a href="#" class="learn-more">En savoir plus <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            
            <div class="trust-card">
                <div class="trust-icon">
                    <i class="fa-solid fa-flask"></i>
                </div>
                <h3>Recherche scientifique</h3>
                <p>Nos formulations sont basées sur des études scientifiques rigoureuses et des tests cliniques.</p>
                <a href="#" class="learn-more">En savoir plus <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            
            <div class="trust-card">
                <div class="trust-icon">
                    <i class="fa-solid fa-heart"></i>
                </div>
                <h3>Engagement qualité</h3>
                <p>Nous sélectionnons uniquement les ingrédients les plus purs pour garantir l'efficacité de nos produits.</p>
                <a href="#" class="learn-more">En savoir plus <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="values-section">
    <div class="container">
        <h2 class="section-title centered">Nos <span>Valeurs</span></h2>
        
        <div class="values-grid">
            <div class="value-card">
                <div class="value-image">
                    <img src="/storage/images/bio2.jpg" alt="Nature">
                </div>
                <div class="value-content">
                    <h3>Nature</h3>
                    <p>Nous nous engageons à préserver et respecter la nature dans toutes nos activités.</p>
                </div>
            </div>
            
            <div class="value-card">
                <div class="value-image">
                    <img src="/storage/images/bio2.jpg" alt="Bio">
                </div>
                <div class="value-content">
                    <h3>Bio</h3>
                    <p>Tous nos ingrédients sont issus de l'agriculture biologique et rigoureusement sélectionnés.</p>
                </div>
            </div>
            
            <div class="value-card">
                <div class="value-image">
                    <img src="/storage/images/bio2.jpg" alt="Santé">
                </div>
                <div class="value-content">
                    <h3>Santé</h3>
                    <p>Notre mission première est d'améliorer votre santé et votre bien-être naturellement.</p>
                </div>
            </div>
            
            <div class="value-card">
                <div class="value-image">
                    <img src="/storage/images/bio2.jpg" alt="Éco-responsabilité">
                </div>
                <div class="value-content">
                    <h3>Éco-responsabilité</h3>
                    <p>Nous minimisons notre impact environnemental à chaque étape de notre production.</p>
                </div>
            </div>
            
            <div class="value-card">
                <div class="value-image">
                    <img src="/storage/images/bio2.jpg" alt="Développement">
                </div>
                <div class="value-content">
                    <h3>Développement</h3>
                    <p>Nous investissons continuellement dans la recherche et l'innovation.</p>
                </div>
            </div>
            
            <div class="value-card">
                <div class="value-image">
                    <img src="/storage/images/bio2.jpg" alt="Bien-être">
                </div>
                <div class="value-content">
                    <h3>Bien-être</h3>
                    <p>Votre satisfaction et votre qualité de vie sont au cœur de nos préoccupations.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="container">
        <h2 class="section-title centered">Les Avis <span>clients</span></h2>
        
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-image">
                    <img src="/storage/images/bart.jpg" alt="John Doe">
                </div>
                <h3>John Doe</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">"MushBlue a transformé mon quotidien. Après seulement deux semaines d'utilisation, je me sens plus énergique et concentré."</p>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-image">
                    <img src="/storage/images/bart.jpg" alt="Jane Smith">
                </div>
                <h3>Jane Smith</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">"Je recommande vivement MushBlue. Le produit est efficace et j'apprécie particulièrement son origine naturelle et éthique."</p>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-image">
                    <img src="/storage/images/bart.jpg" alt="Robert Johnson">
                </div>
                <h3>Robert Johnson</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <p class="testimonial-text">"Excellent complément alimentaire. J'ai essayé de nombreux produits mais MushBlue se distingue vraiment par sa qualité."</p>
            </div>
        </div>
    </div>
</section>

<style>
/* Global Styles */
:root {
    --primary-color: #2a6f5c;
    --secondary-color: #f8f9fa;
    --accent-color: #e9c46a;
    --dark-color: #264653;
    --light-color: #ffffff;
    --text-color: #333333;
    --light-text: #6c757d;
    --shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s ease;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: var(--text-color);
    line-height: 1.6;
}

.container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.section-title {
    font-size: 2.2rem;
    color: var(--dark-color);
    margin-bottom: 1.5rem;
    position: relative;
    display: inline-block;
}

.section-title span {
    color: var(--primary-color);
}

.section-title.centered {
    text-align: center;
    display: block;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 60px;
    height: 3px;
    background-color: var(--primary-color);
}

.section-title.centered::after {
    left: 50%;
    transform: translateX(-50%);
}

.section-subtitle {
    text-align: center;
    color: var(--light-text);
    margin-bottom: 3rem;
    font-size: 1.1rem;
}

/* Button Styles */
.cta-button, .secondary-button {
    display: inline-block;
    padding: 12px 30px;
    border-radius: 30px;
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
    margin-top: 20px;
}

.cta-button {
    background-color: var(--primary-color);
    color: var(--light-color);
    box-shadow: 0 4px 15px rgba(42, 111, 92, 0.3);
}

.cta-button:hover {
    background-color: #1f5848;
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(42, 111, 92, 0.4);
}

.secondary-button {
    background-color: transparent;
    color: var(--primary-color);
    border: 2px solid var(--primary-color);
}

.secondary-button:hover {
    background-color: var(--primary-color);
    color: var(--light-color);
    transform: translateY(-3px);
}

/* Hero Section */
.hero {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 80px 0;
    position: relative;
    overflow: hidden;
}

.hero-content {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
}

.hero-text {
    flex: 1;
    min-width: 300px;
    padding-right: 40px;
}

.hero-title {
    font-size: 3.5rem;
    color: var(--dark-color);
    margin-bottom: 15px;
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 1.8rem;
    color: var(--primary-color);
    margin-bottom: 20px;
    font-weight: 400;
}

.hero-description {
    font-size: 1.1rem;
    color: var(--text-color);
    margin-bottom: 30px;
    max-width: 600px;
}

.hero-model {
    flex: 1;
    min-width: 300px;
    height: 400px;
    position: relative;
}

.product-model {
    width: 100%;
    height: 100%;
    border-radius: 20px;
    box-shadow: var(--shadow);
}

/* Story Section */
.story-section {
    padding: 80px 0;
    background-color: var(--light-color);
}

.story-article {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 40px;
}

.story-image {
    flex: 1;
    min-width: 300px;
}

.story-image img {
    width: 100%;
    border-radius: 15px;
    box-shadow: var(--shadow);
}

.story-content {
    flex: 1;
    min-width: 300px;
}

.story-text p {
    margin-bottom: 20px;
    font-size: 1.05rem;
}

/* Founders Section */
.founders-section {
    padding: 80px 0;
    background-color: var(--secondary-color);
}

.founders-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
    margin-top: 50px;
}

.founder-card {
    flex: 1;
    min-width: 280px;
    max-width: 400px;
    background: var(--light-color);
    border-radius: 15px;
    padding: 30px;
    box-shadow: var(--shadow);
    transition: var(--transition);
    text-align: center;
}

.founder-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.founder-image {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto 20px;
    border: 5px solid var(--primary-color);
}

.founder-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.founder-card h3 {
    color: var(--dark-color);
    margin-bottom: 5px;
}

.founder-role {
    color: var(--primary-color);
    font-weight: 600;
    margin-bottom: 15px;
    font-size: 0.9rem;
}

.founder-bio {
    color: var(--text-color);
    font-size: 0.95rem;
}

/* Gallery Section */
.gallery-section {
    padding: 80px 0;
    background-color: var(--light-color);
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 40px;
}

.gallery-item {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: var(--transition);
    aspect-ratio: 1/1;
}

.gallery-item:hover {
    transform: scale(1.05);
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.gallery-item:hover img {
    transform: scale(1.1);
}

/* Trust Section */
.trust-section {
    padding: 80px 0;
    background-color: var(--secondary-color);
}

.trust-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
    margin-top: 50px;
}

.trust-card {
    flex: 1;
    min-width: 280px;
    max-width: 350px;
    background: var(--light-color);
    border-radius: 15px;
    padding: 30px;
    box-shadow: var(--shadow);
    transition: var(--transition);
    text-align: center;
}

.trust-card:hover {
    transform: translateY(-10px);
}

.trust-icon {
    font-size: 2.5rem;
    color: var(--primary-color);
    margin-bottom: 20px;
}

.trust-card h3 {
    color: var(--dark-color);
    margin-bottom: 15px;
}

.trust-card p {
    color: var(--text-color);
    margin-bottom: 20px;
    font-size: 0.95rem;
}

.learn-more {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: var(--transition);
}

.learn-more:hover {
    color: var(--dark-color);
}

.learn-more i {
    margin-left: 5px;
    transition: var(--transition);
}

.learn-more:hover i {
    transform: translateX(5px);
}

/* Values Section */
.values-section {
    padding: 80px 0;
    background-color: var(--light-color);
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.value-card {
    background: var(--light-color);
    border-radius: 15px;
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: var(--transition);
}

.value-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.value-image {
    height: 200px;
    overflow: hidden;
}

.value-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.value-card:hover .value-image img {
    transform: scale(1.1);
}

.value-content {
    padding: 25px;
}

.value-content h3 {
    color: var(--primary-color);
    margin-bottom: 10px;
}

.value-content p {
    color: var(--text-color);
    font-size: 0.95rem;
}

/* Testimonials Section */
.testimonials-section {
    padding: 80px 0;
    background-color: var(--secondary-color);
}

.testimonials-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
    margin-top: 50px;
}

.testimonial-card {
    flex: 1;
    min-width: 280px;
    max-width: 350px;
    background: var(--light-color);
    border-radius: 15px;
    padding: 30px;
    box-shadow: var(--shadow);
    transition: var(--transition);
    text-align: center;
}

.testimonial-card:hover {
    transform: translateY(-10px);
}

.testimonial-image {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto 20px;
    border: 3px solid var(--primary-color);
}

.testimonial-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.testimonial-card h3 {
    color: var(--dark-color);
    margin-bottom: 10px;
}

.stars {
    color: var(--accent-color);
    margin-bottom: 15px;
    font-size: 1rem;
}

.testimonial-text {
    color: var(--text-color);
    font-style: italic;
    font-size: 0.95rem;
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .hero-title {
        font-size: 2.8rem;
    }
    
    .hero-subtitle {
        font-size: 1.5rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .hero {
        padding: 60px 0;
    }
    
    .hero-content {
        flex-direction: column;
    }
    
    .hero-text {
        padding-right: 0;
        margin-bottom: 40px;
        text-align: center;
    }
    
    .hero-description {
        margin-left: auto;
        margin-right: auto;
    }
    
    .hero-model {
        height: 300px;
    }
    
    .story-article {
        flex-direction: column;
    }
    
    .story-image, .story-content {
        min-width: 100%;
    }
    
    .section-title::after {
        left: 50%;
        transform: translateX(-50%);
    }
}

@media (max-width: 576px) {
    .hero-title {
        font-size: 2.2rem;
    }
    
    .hero-subtitle {
        font-size: 1.3rem;
    }
    
    .section-title {
        font-size: 1.8rem;
    }
    
    .cta-button, .secondary-button {
        width: 100%;
        text-align: center;
    }
    
    .gallery-grid {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    }
    
    .values-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const model = document.getElementById("bioModel");

    model.addEventListener("mouseenter", () => {
        model.setAttribute("auto-rotate-delay", "1000");
        model.setAttribute("rotation-per-second", "30deg");
    });

    model.addEventListener("mouseleave", () => {
        model.setAttribute("rotation-per-second", "90deg");
    });
    
    // Animate elements when they come into view
    const animateOnScroll = () => {
        const elements = document.querySelectorAll('.founder-card, .trust-card, .value-card, .testimonial-card');
        
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.3;
            
            if (elementPosition < screenPosition) {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }
        });
    };
    
    // Set initial state for animated elements
    const animatedElements = document.querySelectorAll('.founder-card, .trust-card, .value-card, .testimonial-card');
    animatedElements.forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    });
    
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Run once on load
});
</script>

@endsection