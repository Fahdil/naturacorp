@extends('layouts.app')

@section('content')

<section class="about-hero">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">À PROPOS DE NATURACORP</h1>
            <p class="hero-description">NaturaCorp est une startup innovante fondée par Benjamin DUFOUR et Hannah COSTA, spécialisée dans les compléments alimentaires naturels à base d'extraits de champignons.</p>
        </div>
    </div>
</section>

<section class="about-story">
    <div class="container">
        <div class="story-grid">
            <div class="story-text">
                <p>Inspirés par un voyage à Okinawa (Japon), les fondateurs ont découvert l'Aoi Kinoko, un champignon aux propriétés médicinales traditionnelles. Après deux ans de R&D en collaboration avec un laboratoire spécialisé, ils ont développé MushBlue, un complément alimentaire liquide à base d'extrait de ce champignon.</p>
                <div class="activities">
                    <h3>Activités clés :</h3>
                    <ul>
                        <li>Étude scientifique des bienfaits du champignon</li>
                        <li>Création d'une champignonnière dédiée à la myciculture durable</li>
                        <li>Commercialisation de MushBlue, ciblant le marché des solutions santé naturelles</li>
                    </ul>
                </div>
            </div>
            <div class="story-image">
                <img src="/storage/images/all.png" alt="Produits NaturaCorp" class="zoom-effect">
            </div>
        </div>
    </div>
</section>

<section class="about-stats">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <h2 class="counter" data-target="100000">0</h2>
                <p>Clients satisfaits</p>
            </div>
            
            <div class="stat-card">
                <h2 class="counter" data-target="3">0</h2>
                <p>Collaborateurs experts</p>
            </div>
            <div class="stat-card">
                <h2>2023</h2>
                <p>Année de création</p>
            </div>
            <div class="stat-card">
                <h2>Bien-être</h2>
                <p>Notre objectif</p>
            </div>
            <div class="stat-card">
                <h2>Bio & Éco</h2>
                <p>Nos valeurs</p>
            </div>
        </div>
    </div>
</section>

<section class="about-lab">
    <div class="container">
        <div class="lab-grid">
            <div class="lab-content">
                <h2 class="section-title">Notre laboratoire</h2>
                <h3 class="section-subtitle">Fusion des savoir-faire japonais et français</h3>
                <p>Benjamin DUFOUR et Hannah COSTA, fondateurs de NaturaCorp, se sont associés à un laboratoire spécialisé pour transformer leur découverte japonaise – le champignon Aoi Kinoko – en un complément alimentaire innovant. Pendant deux ans, leur collaboration a permis d'isoler les principes actifs du champignon, d'optimiser son extraction et de valider scientifiquement ses bienfaits. Le résultat est MushBlue, un extrait liquide bleu concentré, alliant rigueur scientifique et savoir-faire artisanal.</p>
            </div>
            <div class="lab-gallery">
                <div class="gallery-item">
                    <img src="/storage/images/lab1png.png" alt="Laboratoire NaturaCorp" class="gallery-img">
                </div>
                <div class="gallery-item">
                    <img src="/storage/images/tokyo.jpg" alt="Recherche à Tokyo" class="gallery-img">
                </div>
                <div class="gallery-item">
                    <img src="/storage/images/mushblue.jpeg" alt="Produit MushBlue" class="gallery-img">
                </div>
                <div class="gallery-item">
                    <img src="/storage/images/lab2.png" alt="Équipe de recherche" class="gallery-img">
                </div>
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

.container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.section-title {
    font-size: 2.2rem;
    color: var(--dark-color);
    margin-bottom: 1rem;
    position: relative;
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

.section-subtitle {
    font-size: 1.2rem;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    font-weight: 500;
}

/* About Hero Section */
.about-hero {
   background-color: var(--dark-color);
    color: var(--light-color);
    background-size: cover;
    background-position: center;
    color: var(--light-color);
    padding: 100px 0;
    text-align: center;
}

.hero-title {
    font-size: 3rem;
    margin-bottom: 1.5rem;
    animation: fadeInDown 1s ease;
}

.hero-description {
    font-size: 1.2rem;
    max-width: 800px;
    margin: 0 auto;
    animation: fadeInUp 1s ease;
}

/* About Story Section */
.about-story {
    padding: 80px 0;
    background-color: var(--light-color);
}

.story-grid {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 40px;
}

.story-text {
    flex: 1;
    min-width: 300px;
}

.story-text p {
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.activities {
    background-color: var(--secondary-color);
    padding: 20px;
    border-radius: 10px;
    margin-top: 30px;
}

.activities h3 {
    color: var(--primary-color);
    margin-bottom: 15px;
}

.activities ul {
    list-style-type: none;
    padding-left: 0;
}

.activities li {
    position: relative;
    padding-left: 30px;
    margin-bottom: 10px;
    font-size: 1rem;
}

.activities li::before {
    content: '✓';
    position: absolute;
    left: 0;
    color: var(--primary-color);
    font-weight: bold;
}

.story-image {
    flex: 1;
    min-width: 300px;
    text-align: center;
}

.zoom-effect {
    width: 100%;
    max-width: 500px;
    border-radius: 10px;
    box-shadow: var(--shadow);
    transition: var(--transition);
}

.zoom-effect:hover {
    transform: scale(1.03);
}

/* About Stats Section */
.about-stats {
    padding: 80px 0;
    background-color: var(--dark-color);
    color: var(--light-color);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.stat-card {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    padding: 30px 20px;
    text-align: center;
    transition: var(--transition);
    backdrop-filter: blur(5px);
}

.stat-card:hover {
    transform: translateY(-10px);
    background: rgba(255, 255, 255, 0.15);
}

.stat-card h2 {
    font-size: 2.5rem;
    margin-bottom: 10px;
    color: var(--accent-color);
}

.stat-card p {
    font-size: 1rem;
    opacity: 0.9;
}

/* About Lab Section */
.about-lab {
    padding: 80px 0;
    background-color: var(--secondary-color);
}

.lab-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 40px;
}

.lab-content {
    flex: 1;
    min-width: 300px;
    justify-content:center;
}

.lab-content p {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 20px;
}

.lab-gallery {
    flex: 1;
    min-width: 250px;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.gallery-item {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: var(--transition);
    aspect-ratio: 3/2;
}

.gallery-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.gallery-item:hover .gallery-img {
    transform: scale(1.1);
}

/* Animations */
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .about-hero {
        padding: 80px 0;
    }
    
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-description {
        font-size: 1rem;
    }
    
    .story-grid, .lab-grid {
        flex-direction: column;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 576px) {
    .hero-title {
        font-size: 1.8rem;
    }
    
    .section-title {
        font-size: 1.8rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .gallery-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    // Counter animation
    const counters = document.querySelectorAll('.counter');
    const animationDuration = 2000; // 2 seconds
    const frameDuration = 1000 / 60; // 60fps
    
    counters.forEach(counter => {
        const target = +counter.getAttribute('data-target');
        const frames = Math.floor(animationDuration / frameDuration);
        const increment = target / frames;
        let count = 0;
        
        const updateCount = () => {
            count += increment;
            if (count < target) {
                counter.textContent = Math.floor(count);
                requestAnimationFrame(updateCount);
            } else {
                counter.textContent = target.toLocaleString();
            }
        };
        
        // Start animation when element is in viewport
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                updateCount();
                observer.unobserve(counter);
            }
        });
        
        observer.observe(counter);
    });
    
    // Gallery image hover effect
    const galleryItems = document.querySelectorAll('.gallery-item');
    galleryItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            item.querySelector('.gallery-img').style.transform = 'scale(1.1)';
        });
        
        item.addEventListener('mouseleave', () => {
            item.querySelector('.gallery-img').style.transform = 'scale(1)';
        });
    });
    
    // Animate elements when they come into view
    const animateOnScroll = () => {
        const elements = document.querySelectorAll('.stat-card, .story-grid, .lab-grid');
        
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
    const animatedElements = document.querySelectorAll('.stat-card, .story-grid, .lab-grid');
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