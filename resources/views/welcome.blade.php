<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Building Permit Management System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow sticky-top">
        <div class="container">
            <!-- Logo and Title -->
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img
                    src="{{ asset('images/Logo.png') }}"
                    alt="Logo"
                    style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;" />
                <span class="fw-bold">BPMS</span>
            </a>

            <!-- Toggler for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- General Links -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('welcome') ? 'active' : '' }}" href="{{ route('welcome') }}">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>

                    <!-- Authentication Links -->
                    @guest
                    <!-- Show if user is NOT logged in -->
                    <li class="nav-item d-flex flex-column flex-md-row gap-2">
                        <a class="btn btn-light btn-sm px-3 w-100 w-md-auto" href="{{ route('login') }}">
                            Login
                        </a>
                        <a class="btn btn-outline-light btn-sm px-3 w-100 w-md-auto" href="{{ route('register') }}">
                            Register
                        </a>
                    </li>
                    @else
                    <!-- Add authenticated user menu here -->

                    <!-- Show if user IS logged in -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Hidden logout form -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>


    <!-- Hero Section -->
    <section class="hero text-center py-5">
        <div>
            <img
                src="images/Logo.png"
                alt="Building Permit Logo"
                style="max-width: 250px; margin-bottom: 20px; border-radius: 50%" />
            <h1>Development of Building Permit Management System</h1>
            <p class="mt-3">
                A modern solution for managing and tracking building permits
                efficiently.
            </p>
            <a href="#features" class="btn btn-custom btn-primary mt-4">Explore Features</a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Key Features</h2>
            <p class="text-muted">
                Discover the core functionalities of our system
            </p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card feature-card p-3 text-center shadow">
                    <i class="bi bi-building fs-1 text-primary"></i>
                    <h5 class="mt-3">Permit Management</h5>
                    <p class="text-muted">
                        Easily create, update, and manage building permit applications.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card p-3 text-center shadow">
                    <i class="bi bi-bar-chart-line fs-1 text-success"></i>
                    <h5 class="mt-3">Progress Tracking</h5>
                    <p class="text-muted">
                        Monitor the status of each permit in real time for transparency.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card p-3 text-center shadow">
                    <i class="bi bi-shield-lock fs-1 text-danger"></i>
                    <h5 class="mt-3">Secure Records</h5>
                    <p class="text-muted">
                        Keep permit data safe with advanced authentication and security.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="team container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Meet the Team</h2>
            <p class="text-muted">
                The brilliant minds behind the Building Permit Management System
            </p>
        </div>

        <!-- Carousel Wrapper -->
        <div id="teamCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000">
            <div class="carousel-inner text-center">

                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <div class="card team-card shadow p-3 animate-card" style="min-width: 220px;">
                            <img src="{{ asset('Team/member_1.jpg') }}" class="rounded-circle mx-auto"
                                style="width: 120px; height: 120px; object-fit: cover;" alt="Member 1" />
                            <h5 class="mt-3 mb-1">Angel Mae Quiban</h5>
                            <p class="text-muted mb-2">Project Leader</p>
                            <p class="small">Managed the overall project development and deployment.</p>
                        </div>

                        <div class="card team-card shadow p-3 animate-card" style="min-width: 220px;">
                            <img src="{{ asset('Team/member_2.jpg') }}" class="rounded-circle mx-auto"
                                style="width: 120px; height: 120px; object-fit: cover;" alt="Member 2" />
                            <h5 class="mt-3 mb-1">Jericho Dalit</h5>
                            <p class="text-muted mb-2">Backend Developer</p>
                            <p class="small">Developed secure APIs and database management for the system.</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <div class="card team-card shadow p-3 animate-card" style="min-width: 220px;">
                            <img src="{{ asset('Team/member_3.jpg') }}" class="rounded-circle mx-auto"
                                style="width: 120px; height: 120px; object-fit: cover;" alt="Member 3" />
                            <h5 class="mt-3 mb-1">Jesel P. Batestil</h5>
                            <p class="text-muted mb-2">Frontend Developer</p>
                            <p class="small">Designed the UI for a modern, responsive user experience.</p>
                        </div>

                        <div class="card team-card shadow p-3 animate-card" style="min-width: 220px;">
                            <img src="{{ asset('Team/member_4.jpg') }}" class="rounded-circle mx-auto"
                                style="width: 120px; height: 120px; object-fit: cover;" alt="Member 4" />
                            <h5 class="mt-3 mb-1">Annabel L. Abadines</h5>
                            <p class="text-muted mb-2">Quality Assurance</p>
                            <p class="small">Tested the system to ensure a smooth and bug-free performance.</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <div class="card team-card shadow p-3 animate-card" style="min-width: 220px;">
                            <img src="{{ asset('Team/member_5.jpg') }}" class="rounded-circle mx-auto"
                                style="width: 120px; height: 120px; object-fit: cover;" alt="Member 5" />
                            <h5 class="mt-3 mb-1">Rosuel B. Acebo</h5>
                            <p class="text-muted mb-2">Quality Assurance</p>
                            <p class="small">Tested the system to ensure a smooth and bug-free performance.</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#teamCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#teamCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
            </button>
        </div>
    </section>


    <!-- About Section -->
    <section id="about" class="about container py-5">
        <div class="row align-items-center">
            <!-- Left Column: Image -->
            <div class="col-md-6 text-center mb-4 mb-md-0">
                <img
                    src="{{ asset('images/Logo.png') }}"
                    alt="About Building Permit System"
                    class="img-fluid rounded shadow"
                    style="max-height: 300px; object-fit: cover;" />
            </div>

            <!-- Right Column: Text -->
            <div class="col-md-6">
                <h2 class="fw-bold">About the Project</h2>
                <p class="text-muted mt-3">
                    The <strong>Building Permit Management System</strong> is a web-based platform designed to streamline the application, tracking, and approval of building permits.
                    It provides a modern and efficient way for both applicants and administrators to manage permit requests, track progress in real time, and ensure compliance with regulatory standards.
                </p>
                <a href="#features" class="btn btn-primary mt-3">Learn More</a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Contact Us</h2>
            <p class="text-muted">
                Have questions or need support? Reach out to our team behind the
                <strong>Building Permit Management System</strong>.
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <form class="card shadow p-4">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Name</label>
                        <input type="text" id="name" class="form-control" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label fw-semibold">Message</label>
                        <textarea id="message" class="form-control" rows="4" placeholder="Write your message here..." required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-4">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <!-- Map Section -->
    <section id="map" class="map container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Our Location</h2>
            <p class="text-muted">
                Visit our municipal office based in <strong>Municipality of Bontoc, Southern Leyte</strong>, where we manage and support the application process for the Building Permit Management System for more inquires.
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="map-container shadow">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!3m2!1sen!2sus!4v1755838432404!5m2!1sen!2sus!6m8!1m7!1sRi_SjhQ2UoAIgiuXvNR-Sw!2m2!1d10.35477753549788!2d124.9704960433906!3f173.68296783842158!4f-13.692415352208329!5f0.7820865974627469"
                        width="100%"
                        height="400"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Building Permit Management System | All Rights Reserved</p>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
            anchor.addEventListener("click", function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute("href")).scrollIntoView({
                    behavior: "smooth",
                });
            });
        });
    </script>
</body>

</html>