<!-- include header -->
<?php include_once "includes/header.php";?>
<!-- Print Label Modal -->
<?php include_once "modals/print_label_modal.php";?>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
         <div class="col-4">
            <!-- Search Box Start -->
                <div class="input-group">
                    <input type="text" class="form-control" id="searchByName" placeholder="Search by Patient Name">
                </div>
            <!-- Search Box End -->
        </div>
        <div class="col-4">
            <div class="form-group">
                <input type="date" class="form-control" id="filterDate">
            </div>
        </div>
         <!-- Refresh Button -->
         <div class="col-4">
            <!-- Refresh Button with Font Awesome Icon -->
            <button type="button" class="btn btn-secondary" id="refreshButton" title="Refresh">
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>
    </div>

    <div class="row g-4 mt-1">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Created List</h6>
                <!-- Table Start -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Reference ID</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Route</th>
                                <th scope="col">Drug Name</th>
                                <th scope="col">Strength</th>
                                <th scope="col">Diluent</th>
                                <th scope="col">Diluent Volume</th>
                                <th scope="col">Location</th>
                                <th scope="col">Days</th>
                                <th scope="col">Dosage</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="createdListBody">
                        </tbody>
                    </table>
                </div>
                <!-- Table End -->
            </div>
        </div>
    </div>
</div>

<!-- view crated details mods -->
<?php include_once "modals/view_create_details_modal.php";?>
<!-- Craeted List JS -->
<script src="assets/js/created_list.js"></script>
<!-- include footer -->
<?php include_once "includes/footer.php";?>