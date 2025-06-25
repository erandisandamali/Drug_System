<!-- Sidebar Start -->


<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="patient_dashboard.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"> <img src="assets/images/syrup.png" alt="Medicine Icon" style=" width: 20%;
            height: 20%;
            object-fit: cover">
                DrugMaster</h3>
        </a>

        <div class="navbar-nav w-100">
            <a href="created_list_patient.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'created_list_patient.php' ? 'active' : ''; ?>"><i class="fas fa-file-alt me-2"></i>Reports</a>
        </div>

    </nav>
</div>
<!-- Sidebar End -->