<!-- Create Drug Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-xxl-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Patient and Drug Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Your content goes here -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                             <div class="bg-light rounded p-4">
            <h6 class="mb-4">Patient Details</h6>
            <div class="row">
                <form>
                    <input type="hidden" name="" id="createPatientId">
                </form>
                <div class="col-md-12 mb-2">
                    <span class="patient-detail-label">Patient Name:</span>
                    <span id="createPatientName" class="patient-detail-value"></span>
                </div>
                        <div class="col-md-12 mb-2" id="createPhnDev">
            <span class="patient-detail-label">Personal Health Number (PHN):</span>
            <span id="createPhn" class="patient-detail-value"></span>
        </div>

        <div class="col-md-12 mb-2" id="createBhtDev">
            <span class="patient-detail-label">BHT Number:</span>
            <span id="CreateBhtNumber" class="patient-detail-value"></span>
        </div>

        <div class="col-md-12 mb-2" id="createClinicDev">
            <span class="patient-detail-label">Clinic Number:</span>
            <span id="createClinicNumber" class="patient-detail-value"></span>
        </div>
                <div class="col-md-6 mb-2">
                    <span class="patient-detail-label">Age:</span>
                    <span id="createAge" class="patient-detail-value"></span>
                </div>
                <div class="col-md-6 mb-2">
                    <span class="patient-detail-label">Gender:</span>
                    <span id="createGender" class="patient-detail-value"></span>
                </div>
                <div class="col-md-6 mb-2">
                    <span class="patient-detail-label">Ward:</span>
                    <span id="createWard" class="patient-detail-value"></span>
                </div>
                <div class="col-md-6 mb-2">
                    <span class="patient-detail-label">Section:</span>
                    <span id="createSection" class="patient-detail-value"></span>
                </div>
                <div class="col-md-12 mb-2">
                    <span class="patient-detail-label">Oncologist:</span>
                    <span id="createOncologist" class="patient-detail-value"></span>
                </div>
            </div>
        </div>
                        </div>
                    </div>


                    <div class="row g-4 mt-3">
                        <div class="col-sm-12 col-xl-12">
                            <div class="bg-light rounded h-100 p-4">
                                <h6 class="mb-4">Drug Details
                                    <div class="d-flex justify-content-end mb-3">
                                        <!-- Add button -->
                                        <button type="button" class="btn btn-secondary btn-sm mb-3" id="addDrugDetail">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </h6>
                                <!-- Drug detail fields container -->
                                <!-- Drug detail fields container -->
                                <div id="drugDetailsContainer">
                                    <!-- Drug detail fields will be dynamically added here -->
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="col-drug-route">Route</th>
                                                <th class="col-drug-type">Drug Type</th>
                                                <th class="col-drug-name">Drug Name</th>
                                                <th class="col-strength">Strength</th>
                                                <th class="col-solution">Diluent</th>
                                                <th class="col-volume">Diluent Volume</th>
                                                <th class="col-location">Location</th>
                                                <th class="col-days">Days</th>
                                                 <th class="col-dosage">Dosage</th>
                                                <th class="col-action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="CreateDrugDetailBody">
                                            <!-- Drug detail fields will be dynamically added here -->
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Submit and clear buttons -->
                                <button type="button" class="btn btn-sm btn-primary m-2" id="submitCreateForm">Submit</button>
                                <button type="button" class="btn btn-sm btn-secondary m-2" data-bs-dismiss="modal" id="cancelCreateForm">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
