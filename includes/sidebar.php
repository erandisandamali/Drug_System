<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="dashboard.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"> <img src="assets/images/syrup.png" alt="Medicine Icon" style=" width: 20%;
            height: 20%;
            object-fit: cover">
                DrugMaster</h3>
        </a>

        <div class="navbar-nav w-100">
            <a href="dashboard.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="create.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'create.php' ? 'active' : ''; ?>"><i class="fas fa-user-plus me-2"></i>Registration</a>
            <a href="created_list.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'created_list.php' ? 'active' : ''; ?>"><i class="fas fa-file-alt me-2"></i>Reports</a>
            <a href="drugs.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'drugs.php' ? 'active' : ''; ?>"><i class="fas fa-pills me-2"></i>Drugs</a>
            <a href="wards.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'wards.php' ? 'active' : ''; ?>"><i class="fas fa-bed me-2"></i>Wards</a>
            <a href="oncologists.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'oncologists.php' ? 'active' : ''; ?>"><i class="fas fa-user-md me-2"></i>Oncologists</a>
        </div>

    </nav>
</div>
<!-- Sidebar End -->