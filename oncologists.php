<!-- include header -->
<?php include_once("includes/header.php"); ?>

<div class="container-fluid pt-4 px-4 ">
    <div class="row g-4">

        <div class="col-4">
            <!-- Search Box Start -->
            <div class="input-group">
                <input type="text" class="form-control" id="oncologistSearch" placeholder="Search by Name">
            </div>
            <!-- Search Box End -->
        </div>

        <!-- Refresh Button -->
        <div class="col-3">
            <!-- Refresh Button with Font Awesome Icon -->
            <button type="button" class="btn btn-secondary" id="refreshButton" title="Refresh">
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>

        <!-- Add Drug Button -->
        <div class="col-3 text-right">
            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addOncologistModal">
                <i class="fas fa-user-md me-1"></i> Add Oncologist
            </button>
        </div>
    </div>

    <!-- Add Oncologist Modal -->
    <?php include_once('modals/add_oncologist_modal.php') ?>
    <!-- Edit Oncologist Modal -->
    <?php include_once('modals/edit_oncologist_modal.php') ?>

    <div class="row g-4 mt-2">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Oncologists</h6>

                <!-- Table Start -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="oncologistTableBody">
                            <!-- Drug List goes here -->
                        </tbody>
                    </table>
                </div>
                <!-- Table End -->
            </div>
        </div>
    </div>
</div>

<!-- Oncologists Custom JS -->
<script src="assets/js/oncologists.js"></script>
<!-- include footer -->
<?php include_once("includes/footer.php"); ?>