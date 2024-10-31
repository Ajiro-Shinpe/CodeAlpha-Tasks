<?php
global $user;
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
    <div class="container">
        <!-- Logo and Brand -->
        <a class="navbar-brand" href="./">
            <img src="./assets/images/logo.png" alt="Brand Logo" height="28">
        </a>

        <!-- Toggler for Mobile View -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="d-flex justify-content-between w-100">
                <!-- Left Section: Search Bar -->
                <form class="d-flex col-lg-8 col-md-6 me-3">
                    <input class="form-control me-2" type="search" placeholder="Looking for someone..." aria-label="Search">
                    <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
                </form>

                <!-- Right Section: Icons and Profile -->
                <ul class="navbar-nav d-flex align-items-center mb-2 mb-lg-0">
                    <li class="nav-item mx-1">
                        <a class="nav-link text-white" href="./"><i class="bi bi-house-door-fill"></i></a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link text-white" data-bs-toggle="modal" data-bs-target="#addpost" href="#"><i class="bi bi-plus-square-fill"></i></a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link text-white position-relative" href="#"><i class="bi bi-bell-fill"></i>
                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span> <!-- Notification dot -->
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link text-white position-relative" data-bs-toggle="offcanvas" href="#messageSideBar" role="button" aria-controls="messageSideBar"><i class="bi bi-chat-right-dots-fill"></i>
                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span> <!-- Message dot -->
                        </a>
                    </li>
                    <li class="nav-item dropdown mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="./assets/images/profile/<?= $user['profile_pic'] ?>" style="aspect-ratio:1/1; object-fit:cover;" alt="Profile" height="30" class="rounded-circle border">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="?editprofile"><i class="bi bi-pencil-square me-2"></i>Edit Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear-fill me-2"></i>Account Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="assets/php/actions.php?logout"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
