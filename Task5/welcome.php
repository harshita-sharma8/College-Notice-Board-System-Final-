<?php
session_start();
require_once 'config/Database.php';

// Connect to database to fetch latest notices for public preview
$db_name = new Database();
$conn = $db_name->getConnection();

$query = "SELECT * FROM notices ORDER BY created_at DESC LIMIT 3";
$stmt = $conn->prepare($query);
$stmt->execute();
$recent_notices = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - College Notice Board System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 80px 0;
            border-bottom-left-radius: 40px;
            border-bottom-right-radius: 40px;
        }
        .feature-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        .notice-card {
            border-left: 5px solid #2a5298;
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-light">

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="fa-solid fa-bullhorn me-2"></i>Campus Notice Hub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-2">
                        <a class="btn btn-primary text-white nav-link px-3 mb-1 mb-lg-0" href="security/login.php"><i class="fa-solid fa-right-to-bracket me-1"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary nav-link text-white px-3" href="security/register.php"><i class="fa-solid fa-user-plus me-1"></i> Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Welcome to College Notice Board</h1>
            <p class="lead mb-4">Stay updated with the latest academic announcements, circulars, and campus events in real-time.</p>
            <div>
                <a href="security/login.php" class="btn btn-warning btn-lg me-2 fw-semibold"><i class="fa-solid fa-right-to-bracket"></i> Login to Access</a>
                <a href="security/register.php" class="btn btn-outline-light btn-lg fw-semibold"><i class="fa-solid fa-user-plus"></i> Student Register</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="container my-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Key Platform Features</h2>
            <p class="text-muted">Designed for fast, secure, and organized communication</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card feature-card h-100 p-4 text-center">
                    <div class="display-5 text-primary mb-3"><i class="fa-solid fa-layer-group"></i></div>
                    <h5 class="fw-bold">Categorized Notices</h5>
                    <p class="text-muted">Filter notices easily according to your academic branch, year, or category.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card h-100 p-4 text-center">
                    <div class="display-5 text-success mb-3"><i class="fa-solid fa-shield-halved"></i></div>
                    <h5 class="fw-bold">Secure Access</h5>
                    <p class="text-muted">Role-Based Access Control protecting students and administration credentials.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card h-100 p-4 text-center">
                    <div class="display-5 text-warning mb-3"><i class="fa-solid fa-bolt"></i></div>
                    <h5 class="fw-bold">Instant Updates</h5>
                    <p class="text-muted">Get immediate updates on internal exams, schedules, and college events.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Announcements Preview -->
    <section class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold"><i class="fa-solid fa-bell text-primary me-2"></i>Recent Announcements</h3>
            <a href="security/login.php" class="btn btn-sm btn-outline-primary">View All Notices →</a>
        </div>

        <div class="row g-3">
            <?php if (!empty($recent_notices)): ?>
                <?php foreach ($recent_notices as $notice): ?>
                    <div class="col-md-12">
                        <div class="card notice-card shadow-sm p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="fw-bold mb-1 text-dark"><?php echo htmlspecialchars($notice['title']); ?></h5>
                                <span class="badge bg-secondary"><?php echo date('d M Y', strtotime($notice['created_at'])); ?></span>
                            </div>
                            <p class="text-muted mb-2"><?php echo htmlspecialchars(substr($notice['content'], 0, 150)) . '...'; ?></p>
                            <div>
                                <span class="badge bg-info text-dark"><?php echo htmlspecialchars($notice['category'] ?? 'General'); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">No recent announcements found. Please log in to view details.</div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> College Notice Board System | Harshita Sharma's Project</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/bootstrap.bundle.min.js"></script>
</body>
</html>