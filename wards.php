<!-- Include header -->
<?php include_once("includes/header.php"); ?>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- Manage Wards Section -->
        <div class="col-6">
            <h5>Manage Wards</h5>
            <hr>
            <!-- Search, Refresh, Add Ward buttons -->
            <div class="row g-4">
                <div class="col-6">
                    <div class="input-group">
                        <input type="text" class="form-control" id="wardSearch" placeholder="Search by Ward Name">
                    </div>
                </div>
                <!-- <div class="col-2">
                    <button type="button" class="btn btn-secondary" id="refreshAllButton" title="Refresh Wards">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div> -->
                <div class="col-4">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addWardModal">
                        <i class="fas fa-plus-circle me-1"></i> Add Ward
                    </button>
                </div>
            </div>

            <!-- Wards Table -->
            <div class="table-responsive mt-3">
                <table class="table table-hover table-striped" id="wardTable">
                    <thead>
                        <tr>
                            <th scope="col">Ward Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="wardTableBody">
                        <!-- Wards List goes here -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Manage Sections Section -->
        <div class="col-6">
            <h5 id="sectionTableHeader">Sections for Selected Ward</h5>
            <hr>
            <!-- Search, Refresh, Add Section buttons -->
            <div class="row g-4">
                <div class="col-6">
                    <div class="input-group">
                        <input type="text" class="form-control" id="sectionSearch" placeholder="Search by Section Name">
                    </div>
                </div>

                <div class="col-4 text-right">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" id="addSectionButton" data-bs-target="#addSectionModal" disabled>
                        <i class="fas fa-plus-circle me-1"></i> Add Section
                    </button>

                </div>

                <div class="col-2">
                    <button type="button" class="btn btn-secondary" id="refreshAllButton" title="Refresh Wards">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>

            </div>
            <!-- Sections Table -->
            <div class="table-responsive mt-3">
                <table class="table table-hover table-striped" id="sectionTable">
                    <thead>
                        <tr>
                            <th scope="col">Section Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="sectionTableBody">
                        <!-- Section List goes here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Ward Modal -->
<?php include_once('modals/add_ward_modal.php'); ?>
<!-- Edit Ward Modal -->
<?php include_once('modals/edit_ward_modal.php'); ?>
<!-- Add Section Modal -->
<?php include_once('modals/add_section_modal.php'); ?>
<!-- Edit Section Modal -->
<?php include_once('modals/edit_section_modal.php'); ?>


<!-- Wards and Sections Custom JS -->
<script src="assets/js/wards_and_sections.js"></script>
<!-- Include footer -->
<?php include_once("includes/footer.php"); ?>