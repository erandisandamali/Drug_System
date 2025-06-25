<!-- include header -->
<?php include_once "includes/header_patient.php";?>
<!-- Print Label Modal -->
<?php include_once "modals/print_label_modal.php";?>

<div class="container-fluid pt-4 px-4">
   

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

<!-- view of of pateint details eye view --> 
<!-- view crated details mods -->
<?php include_once "modals/view_create_details_patient.php";?>
<!-- Craeted List JS -->
<script src="assets/js/created_list_patient.js"></script>
<!-- include footer -->
<?php include_once "includes/footer.php";?>