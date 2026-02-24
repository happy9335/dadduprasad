<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
require_once '../db.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Daddoo Prasad</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --sidebar-bg: #003893;
            --sidebar-color: #ffffff;
            --hover-color: #FECB00;
        }
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            overflow-x: hidden;
        }
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
            min-height: 100vh;
        }
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: var(--sidebar-bg);
            color: var(--sidebar-color);
            transition: all 0.3s;
        }
        #sidebar .sidebar-header {
            padding: 20px;
            background: rgba(0,0,0,0.1);
            text-align: center;
        }
        #sidebar ul.components {
            padding: 20px 0;
        }
        #sidebar ul li a {
            padding: 12px 20px;
            font-size: 1.1em;
            display: block;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: 0.2s;
        }
        #sidebar ul li a:hover, #sidebar ul li.active > a {
            color: var(--hover-color);
            background: rgba(255,255,255,0.05);
            border-left: 4px solid var(--hover-color);
        }
        #sidebar ul li a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }
        .navbar-custom {
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            border-radius: 5px;
            padding: 10px 20px;
        }
        .card-stats {
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border: none;
            border-left: 4px solid var(--sidebar-bg);
        }
        .text-blue { color: #003893; }
        .text-orange { color: #FF6F00; }
        .text-red { color: #D21034; }
        .text-yellow { color: #FECB00; }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Admin Panel</h3>
                <small>Daddoo Prasad</small>
            </div>
            <ul class="list-unstyled components">
                <li class="<?= $currentPage == 'dashboard.php' ? 'active' : '' ?>">
                    <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
                </li>
                <li class="<?= $currentPage == 'manage_slider.php' ? 'active' : '' ?>">
                    <a href="manage_slider.php"><i class="fas fa-images"></i> Home Slider</a>
                </li>
                <li class="<?= $currentPage == 'manage_settings.php' ? 'active' : '' ?>">
                    <a href="manage_settings.php"><i class="fas fa-cogs"></i> Global Settings</a>
                </li>
                <li class="<?= $currentPage == 'manage_biography.php' ? 'active' : '' ?>">
                    <a href="manage_biography.php"><i class="fas fa-history"></i> Biography</a>
                </li>
                <li class="<?= $currentPage == 'manage_achievements.php' ? 'active' : '' ?>">
                    <a href="manage_achievements.php"><i class="fas fa-star"></i> Achievements</a>
                </li>
                <li class="<?= $currentPage == 'manage_press.php' ? 'active' : '' ?>">
                    <a href="manage_press.php"><i class="fas fa-newspaper"></i> Press Releases</a>
                </li>
                <li class="<?= $currentPage == 'manage_blogs.php' ? 'active' : '' ?>">
                    <a href="manage_blogs.php"><i class="fas fa-blog"></i> Manage Blog Posts</a>
                </li>
                <li class="<?= $currentPage == 'manage_gallery.php' ? 'active' : '' ?>">
                    <a href="manage_gallery.php"><i class="fas fa-images"></i> Media Gallery</a>
                </li>
                <li class="<?= $currentPage == 'manage_messages.php' ? 'active' : '' ?>">
                    <a href="manage_messages.php"><i class="fas fa-envelope"></i> Contact Messages</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
                <div class="container-fluid">
                    <span class="navbar-text fw-bold">
                        Welcome, <?= htmlspecialchars($_SESSION['admin_username']) ?>
                    </span>
                    <div class="d-flex">
                        <a href="../" target="_blank" class="btn btn-outline-secondary btn-sm me-2"><i class="fas fa-external-link-alt"></i> View Site</a>
                        <a href="logout.php" class="btn btn-danger btn-sm"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            </nav>
            <!-- Flash messages -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['success']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['error']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
