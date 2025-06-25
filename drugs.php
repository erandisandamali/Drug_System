<!-- include header -->
<?php include_once("includes/header.php"); ?>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

        <div class="col-4">
            <!-- Search Box Start -->
            <div class="input-group">
                <input type="text" class="form-control" id="drugSearch" placeholder="Search by Drug Name">
            </div>
            <!-- Search Box End -->
        </div>

        <!-- Filter by Drug Type -->
        <div class="col-4">
            <div class="input-group">
                <select class="form-select" id="drugTypeFilter">
                    <option value="" selected>All Drug Types</option>
                    <option value="Normal">Normal</option>
                    <option value="Name patient">Name patient</option>
                    <option value="Special">Special</option>
                    <!-- Add more options for other drug types -->
                </select>
            </div>
        </div>

        <!-- Refresh Button -->
        <div class="col-2">
            <!-- Refresh Button with Font Awesome Icon -->
            <button type="button" class="btn btn-secondary" id="refreshButton" title="Refresh">
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>

        <!-- Add Drug Button -->
        <div class="col-2 text-right">
            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDrugModal">
                <i class="fas fa-prescription-bottle me-1"></i> Add Drug
            </button>
        </div>
    </div>

    <!-- Add Drug Modal -->
    <?php require_once('modals/add_drug_modal.php'); ?>
    <!-- Edit Drug Modal -->
    <?php require_once('modals/edit_drug_modal.php'); ?>

    <div class="row g-4 mt-2">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Drugs Table</h6>

                <!-- Table Start -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Drug Type</th>
                                <th scope="col">SR Number</th>
                                <th scope="col">Drug Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="drugTableBody">
                            <!-- Drug List goes here -->
                        </tbody>
                    </table>
                </div>
                <!-- Table End -->
            </div>
        </div>
    </div>
</div>

<!-- Drugs Custom JS -->
<script src="assets/js/drugs.js"></script>
<!-- include footer -->
<?php include_once("includes/footer.php"); ?>