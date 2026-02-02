<?php
// includes/header.php
// $currentSite: 'aquarium'

if (!isset($currentSite)) {
    $currentSite = 'aquarium';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Jenkinson's Aquarium - Discover the wonders of the deep sea">
    <title>Jenkinson's - <?= ucfirst(str_replace('-', ' ', $currentSite)) ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <!-- Component CSS Files -->
    <!-- Base Styles -->
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/reset.css">
    
    <!-- Component Styles -->
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/hero.css">
    <link rel="stylesheet" href="css/features.css">
    <link rel="stylesheet" href="css/footer.css">
    
    <!-- Utilities & Responsive -->
    <link rel="stylesheet" href="css/utilities.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body>
    <!-- Header -->
    <header class="main-header" role="banner">
        <!-- Thin top links bar -->
        <div class="top-links-bar border-bottom">
            <div class="container">
                <div class="top-bar-content d-flex justify-content-end align-items-center gap-3 small flex-wrap py-2">
                    <nav class="d-flex gap-3 me-auto text-uppercase top-links-nav" aria-label="Site navigation">
                        <a href="index.php"
                           class="top-link fw-semibold text-aqua"
                           aria-current="page">
                            <i class="fa-solid fa-fish me-1" aria-hidden="true"></i>
                            <span>Aquarium</span>
                        </a>
                    </nav>

                    <a href="#" 
                       class="top-link text-dark d-flex align-items-center gap-1"
                       aria-label="View hours and schedule">
                        <span class="calendar-icon" aria-hidden="true">
                            <i class="fa-solid fa-calendar-days"></i>
                        </span>
                        <span class="d-none d-sm-inline">VIEW HOURS</span>
                    </a>
                    
                    <a href="#" 
                       class="top-link text-dark d-flex align-items-center gap-1"
                       aria-label="Translate page">
                        <span class="lang-icon" aria-hidden="true">🌐</span>
                        <span class="d-none d-sm-inline">TRANSLATE</span>
                    </a>

                    <div class="d-flex align-items-center gap-2 social-links" role="list">
                        <a href="https://www.facebook.com/JenksBoardwalk/" 
                           class="top-link text-dark"
                           aria-label="Visit our Facebook page"
                           target="_blank"
                           rel="noopener noreferrer"
                           role="listitem">
                            <i class="fa-brands fa-facebook-f" aria-hidden="true"></i>
                        </a>
                        <a href="https://www.instagram.com/JenksBoardwalk/" 
                           class="top-link text-dark"
                           aria-label="Visit our Instagram page"
                           target="_blank"
                           rel="noopener noreferrer"
                           role="listitem">
                            <i class="fa-brands fa-instagram" aria-hidden="true"></i>
                        </a>
                        <a href="https://x.com/JenksBoardwalk/" 
                           class="top-link text-dark"
                           aria-label="Visit our Twitter page"
                           target="_blank"
                           rel="noopener noreferrer"
                           role="listitem">
                            <i class="fa-brands fa-x-twitter" aria-hidden="true"></i>
                        </a>
                        <a href="https://www.youtube.com/user/JenkinsonsBoardwalk" 
                           class="top-link text-dark"
                           aria-label="Visit our YouTube channel"
                           target="_blank"
                           rel="noopener noreferrer"
                           role="listitem">
                            <i class="fa-brands fa-youtube" aria-hidden="true"></i>
                        </a>
                    </div>

                    <button class="btn btn-link p-0 ms-2 search-btn" 
                            type="button"
                            aria-label="Open search"
                            data-bs-toggle="modal"
                            data-bs-target="#searchModal">
                        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Logo + main menu (second row) -->
        <div class="main-header-content">
            <div class="container">
                <div class="header-main-row d-flex flex-column flex-lg-row align-items-lg-center justify-content-lg-between gap-3 py-3">
                    <div class="logo-section d-flex align-items-center">
                        <a href="index.php" class="aquarium-logo-wrapper text-decoration-none" aria-label="Jenkinson's Aquarium Home">
                            <img src="img/aquarium-logo-768x318.png"
                                 alt="Jenkinson's Aquarium"
                                 class="img-fluid aquarium-logo-img"
                                 loading="eager">
                        </a>
                    </div>

                    <nav class="main-navigation" aria-label="Main navigation">
                        <button class="navbar-toggler d-lg-none" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#mainMenuCollapse"
                                aria-controls="mainMenuCollapse"
                                aria-expanded="false"
                                aria-label="Toggle navigation menu">
                            <span class="navbar-toggler-icon">
                                <i class="fa-solid fa-bars"></i>
                            </span>
                        </button>
                        
                        <div class="collapse navbar-collapse" id="mainMenuCollapse">
                            <ul class="nav main-menu text-uppercase fw-semibold small flex-wrap" role="menubar">
                                <li class="nav-item dropdown-hover" role="none">
                                    <a href="#" 
                                       class="nav-link px-3 text-dark" 
                                       role="menuitem"
                                       aria-haspopup="true"
                                       aria-expanded="false">
                                        <span>Visit</span>
                                        <span class="menu-caret" aria-hidden="true">▼</span>
                                    </a>
                                    <ul class="dropdown-menu visit-mega-menu">
                                        <li><a class="dropdown-item" href="#">HOURS & ADMISSION</a></li>
                                        <li><a class="dropdown-item" href="#">UPCOMING EVENTS</a></li>
                                        <li><a class="dropdown-item" href="#">EXPERIENCES</a></li>
                                        <li><a class="dropdown-item" href="#">PROMOTIONS</a></li>
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item" href="#">JOIN OUR TEAM <i class="fa-solid fa-chevron-right join-team-arrow"></i></a>
                                            <ul class="dropdown-menu submenu">
                                                <li><a class="dropdown-item" href="#">INTERNSHIPS</a></li>
                                                <li><a class="dropdown-item" href="#">EMPLOYMENT</a></li>
                                                <li><a class="dropdown-item" href="#">VOLUNTEER</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="dropdown-item" href="#">OUR MISSION</a></li>
                                        <li><a class="dropdown-item" href="#">OUR PARTNERS</a></li>
                                        <li><a class="dropdown-item" href="#">SELF GUIDED TOUR</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item" role="none">
                                    <a href="#" 
                                       class="nav-link px-3 text-dark"
                                       role="menuitem">
                                        <i class="fa-solid fa-video me-1" aria-hidden="true"></i>
                                        <span>Penguin Cam</span>
                                    </a>
                                </li>
                                <li class="nav-item dropdown-hover" role="none">
                                    <a href="#" 
                                       class="nav-link px-3 text-dark" 
                                       role="menuitem"
                                       aria-haspopup="true"
                                       aria-expanded="false">
                                        <span>Groups &amp; Education</span>
                                        <span class="menu-caret" aria-hidden="true">▼</span>
                                    </a>
                                    <ul class="dropdown-menu visit-mega-menu">
                                        <li><a class="dropdown-item" href="#">EXPERIENCES</a></li>
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item" href="#">GROUPS <i class="fa-solid fa-chevron-right join-team-arrow"></i></a>
                                            <ul class="dropdown-menu submenu">
                                                <li><a class="dropdown-item" href="#">GROUP RATES</a></li>
                                                <li><a class="dropdown-item" href="#">TEACHER TIPS (CHECKING IN &amp; PARKING)</a></li>
                                                <li><a class="dropdown-item" href="#">PRE &amp; POST VISIT ACTIVITIES</a></li>
                                                <li><a class="dropdown-item" href="#">OUTREACH &amp; FOCUS PROGRAMS</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="dropdown-item" href="#">OUTREACH &amp; FOCUS PROGRAMS</a></li>
                                        <li><a class="dropdown-item" href="#">VIRTUAL PROGRAMS</a></li>
                                        <li><a class="dropdown-item" href="#">SUMMER CAMPS</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown-hover" role="none">
                                    <a href="#" 
                                       class="nav-link px-3 text-dark"
                                       role="menuitem"
                                       aria-haspopup="true"
                                       aria-expanded="false">
                                        <span>Adoption, Encounters &amp; Programs</span>
                                        <span class="menu-caret" aria-hidden="true">▼</span>
                                    </a>
                                    <ul class="dropdown-menu visit-mega-menu">
                                        <li><a class="dropdown-item" href="#">ADOPT-AN-ANIMAL</a></li>
                                        <li><a class="dropdown-item" href="#">ANIMAL ENCOUNTERS</a></li>
                                        <li><a class="dropdown-item" href="#">ANIMAL PROGRAMS</a></li>
                                        <li><a class="dropdown-item" href="#">PROMOTIONS</a></li>
                                        <li><a class="dropdown-item" href="#">UPCOMING EVENTS</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>