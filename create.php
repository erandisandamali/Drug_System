<!-- include header -->
<?php include_once("includes/header.php"); ?>
<link rel="stylesheet" href="assets/css/create.css">

<!-- add patient Modal -->
<?php include_once('modals/add_patient_modal.php'); ?>

<!-- edit patient modal -->
<?php include_once('modals/edit_patient_modal.php'); ?>

<!-- View created list of patient modal -->
<?php include("modals/view_create_details_of_patient_modal.php"); ?>

<!-- create modal -->
<?php include_once('modals/create_modal.php'); ?>

<!-- Custom CSS -->

<div class="container-fluid pt-4 px-4">

    <div class="row g-4">
        <div class="col-4">
            <!-- Search Box Start -->
            <div class="input-group">
                <input type="text" class="form-control" id="searchByPatientName" placeholder="Search by Patient Name">
            </div>
            <!-- Search Box End -->
        </div>

        <div class="col-4">
            <!-- Search Box Start -->
            <div class="input-group">
                <input type="text" class="form-control" id="searchByPatientNumber" placeholder="Search by PHN, BHT or Clinic Number">
            </div>
            <!-- Search Box End -->
        </div>

        <!-- Refresh Button -->
        <div class="col-2">
            <!-- Refresh Button with Font Awesome Icon -->
            <button type="button" class="btn btn-secondary" id="refreshButton" title="Refresh">
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>

        <!-- Add Drug Button -->
        <div class="col-2">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPatientModal">
                <i class="fas fa-user-plus me-1"></i> Add Patient
            </button>
        </div>

    </div>
    <div class="row g-4 mt-1">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-3">Patients</h6>
                <!-- Table Start -->
                <div class="table-responsive">
                    <table id="patientTable" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>PHN</th>
                                <th>BHT Number</th>
                                <th>Clinic Number</th>
                                <th>Ward</th>
                                <th>Section</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="patientsBody">
                            <!-- Table rows will be dynamically populated here -->
                        </tbody>
                    </table>

                </div>
                <!-- Table End -->
            </div>
        </div>
    </div>
</div>

<!-- Create Page Cusotm JS -->
<script src="assets/js/create.js"></script>
<!-- include footer -->
<?php include_once("includes/footer.php"); ?>