<?php
$currentSite = 'aquarium';
include 'includes/header.php';
?>

<section class="hero-section text-white">
    <div class="hero-overlay"></div>
    <div class="container text-center position-relative">
        <h1 class="display-3 fw-bold mb-4">Discover the Wonders of the Deep</h1>
        <p class="lead fs-4 mb-4">Experience an unforgettable journey through our vibrant underwater world</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="#" class="btn btn-light btn-lg px-5 py-3 fw-semibold" id="ctaButton">Plan Your Visit</a>
            <a href="#" class="btn btn-outline-light btn-lg px-5 py-3 fw-semibold">Learn More</a>
        </div>
    </div>
</section>

<section class="features-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title fw-bold mb-3">Upcoming Events</h2>
            <p class="section-subtitle text-muted">Join our latest aquarium programs and special days</p>
        </div>

        <!-- Simple event cards (you can later load from DB) -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <img src="img/event1.jpg" class="card-img-top" alt="Terrapin Appreciation Day">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">Terrapin Appreciation Day</h6>
                        <p class="card-text small text-muted mb-2">Jan 27</p>
                        <a href="#" class="btn btn-primary btn-sm">Find Out More</a>
                    </div>
                </div>
            </div>
            <!-- add more event cards here -->
        </div>

        <div class="text-center mb-5">
            <h2 class="section-title fw-bold mb-3">Featured Experiences</h2>
            <p class="section-subtitle text-muted">Make your visit unforgettable</p>
        </div>

        <div class="row g-4">
            <!-- 3 example feature cards (reuse from your current HTML) -->
            <!-- ... (same structure you already have) ... -->
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>