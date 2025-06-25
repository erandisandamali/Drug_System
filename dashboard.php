<!-- include header -->
<?php include_once "includes/header.php";?>
<!-- include db connection -->
<?php include_once "config/db_connection.php";?>
<!-- include Statistics -->
<?php include_once 'process/get_statistics.php';?>

<!-- Dashboard Custom JS -->
<script src="assets/js/dashboard.js"></script>

<!-- Statistics Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Patients</p>
                    <h6 class="mb-0"><?php echo $total_patients; ?></h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Drugs</p>
                    <h6 class="mb-0"><?php echo $total_drugs; ?></h6>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Today Created</p>
                    <h6 class="mb-0"><?php echo $total_today_created; ?></h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Created</p>
                    <h6 class="mb-0"><?php echo $total_created; ?></h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Statistics End -->

<!-- Recent Created -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Recent Created</h6>
            <a href="created_list.php">Show All</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">Reference ID</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Drug Name</th>
                        <th scope="col">Strength</th>
                        <th scope="col">Diluent</th>
                        <th scope="col">Diluent Volume</th>
                        <th scope="col">Location</th>
                        <th scope="col">Days</th>
                        <th scope="col">Dosage</th>
                        <th scope="col">Created At</th>
                    </tr>
                </thead>
                <tbody id="createdListBody">
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Created End -->

<!-- Filter and Chart Container Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-4">Created Drug Details</h6>
                    <div class="form-group">
                        <label for="filter-select" class="form-label">Filter by:</label>
                        <select id="filter-select" class="form-select-sm">
                            <option value="day">Day</option>
                            <option value="month">Month</option>
                            <option value="year">Year</option>
                        </select>
                    </div>
                </div>
                <canvas id="created-drug-details-chart"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Filter and Chart Container End -->


<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Wards Patient Distribution</h6>
                <canvas id="pie-chart"></canvas>
            </div>
        </div>
        <div class="col-sm-6 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Drug Type Distribution</h6>
                <canvas id="drug-type-chart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- include footer -->
<?php include_once "includes/footer.php";?>
