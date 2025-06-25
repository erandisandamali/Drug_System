<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login - DrugMaster</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="assets/images/syrup.png" rel="icon">

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Include Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- Include Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Include DataTables Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link href="assets/css/login.css" rel="stylesheet">
    
</head>

<body>
    <div class="container">
        <div class="header-text">
            <h2 class="text-primary">
                <img src="assets/images/syrup.png" alt="Medicine Icon">
                DrugMaster - Drugs Management System
            </h2>
            <h4 class="text-secondary">National Hospital Kandy</h4>
        </div>
        <div class="login-container">
            <div class="login-image">
                <img src="assets/images/66161.jpg" alt="Background Image" class="img-fluid">
            </div>
            <div class="login-form">
                <h3>Login</h3>
                <form id="loginForm">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" placeholder="Username">
                        <label for="username">Username</label>
                        <span id="usernameError" class="text-danger"></span>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="password" placeholder="Password">
                        <label for="password">Password</label>
                        <span id="passwordError" class="text-danger"></span>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-4">Login</button>
                   <a href="./unique_patient_login.php">Check Report</a>

                </form>
                <span id="error-message" class="text-danger mb-3" style="display: none;"></span>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!-- Include DataTables Bootstrap JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <!-- Template Javascript -->
    <script src="assets/js/main.js"></script>

    <script src="assets/lib/chart/chart.min.js"></script>
    <script src="assets/lib/easing/easing.min.js"></script>
    <script src="assets/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="assets/lib/tempusdominus/js/moment.min.js"></script>
    <script src="assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Login Custom Js -->
    <script src="assets/js/login.js"></script>
</body>

</html>
