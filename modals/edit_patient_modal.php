<style>
    /* Custom CSS to increase the modal width */
    .modal-lg-custom {
        max-width: 70%; /* Adjust the width as needed */
    }
    .form-section {
        margin-bottom: 1.5rem;
    }
    .form-section h6 {
        font-weight: bold;
        margin-bottom: 0.5rem;
    }
    .form-label {
        font-weight: bold;
    }
</style>

<div class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="editPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg-custom">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPatientModalLabel">Edit Patient Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate>
                    <input type="hidden" id="editPatientID" name="">
                    <div class="row">
                        <!-- Column for Identification Numbers -->
                        <div class="col-md-6">
                            <div class="form-section">
                                <h6>Identification Numbers</h6>
                                <div class="mb-3">
                                    <label class="form-label">Identification Type</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="phnCheckEdit" disabled>
                                        <label class="form-check-label" for="phnCheckEdit">PHN</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="bhtCheckEdit">
                                        <label class="form-check-label" for="bhtCheckEdit">BHT Number</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="clinicCheckEdit">
                                        <label class="form-check-label" for="clinicCheckEdit">Clinic Number</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="phnInput" class="form-label">Personal Health Number (PHN)</label>
                                    <input type="number" maxlength="11" class="form-control" id="phnEdit" required disabled>
                                    <div class="invalid-feedback">Please enter a PHN.</div>
                                    <div id="phn-error" class="invalid-feedback">PHN already exists.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="bhtNumEdit" class="form-label">BHT Number</label>
                                    <input type="text" class="form-control" id="bhtNumEdit" required disabled>
                                    <div class="invalid-feedback">Please enter a BHT.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="clinicNumEdit" class="form-label">Clinic Number</label>
                                    <input type="text" class="form-control" id="clinicNumEdit" required disabled>
                                    <div class="invalid-feedback">Please enter a Clinic number.</div>
                                </div>
                            </div>
                            
                            <div class="form-section">
                                <h6>Personal Information</h6>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <select id="titleEdit" class="form-select" required>
                                        <option selected disabled value="">Choose Title...</option>
                                        <option value="Mr">Mr.</option>
                                        <option value="Mrs">Mrs.</option>
                                        <option value="Ms">Ms.</option>
                                        <option value="Dr">Dr.</option>
                                        <option value="Prof">Prof.</option>
                                        <option value="Rev">Rev.</option>
                                    </select>
                                      <div class="invalid-feedback">Please select a title.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="firstNameEdit" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstNameEdit" required>
                                    <div class="invalid-feedback">Please enter a first name.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="lastNameEdit" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastNameEdit" required>
                                    <div class="invalid-feedback">Please enter a last name.</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Column for Personal Details -->
                        <div class="col-md-6">
                            <div class="form-section">
                                <div class="mb-3">
                                    <label for="ageEdit" class="form-label">Age</label>
                                    <input type="number" class="form-control" id="ageEdit" required>
                                    <div class="invalid-feedback">Please enter an age.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select id="genderEdit" class="form-select" required>
                                        <option selected disabled value="">Choose Gender...</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                      <div class="invalid-feedback">Please select a gender type.</div>
                                </div>
                            </div>
                            
                            <div class="form-section">
                                <h6>Medical Information</h6>
                                <div class="mb-3">
                                    <label for="wardEdit" class="form-label">Ward</label>
                                    <select class="form-select" id="wardEdit" required>
                                        <option selected disabled value="">Choose Ward...</option>
                                        <!-- Populate wards dynamically -->
                                    </select>
                                    <div class="invalid-feedback">Please select a ward.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="sectionEdit" class="form-label">Section</label>
                                    <select class="form-select" id="sectionEdit" required>
                                        <option selected disabled value="">Choose Section...</option>
                                        <!-- Populate sections dynamically -->
                                    </select>
                                    <div class="invalid-feedback">Please select a section.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="oncologistEdit" class="form-label">Consultant (Oncologist)</label>
                                    <select class="form-select" id="oncologistEdit" required>
                                        <option selected disabled value="">Choose Oncologist...</option>
                                        <!-- Populate oncologists dynamically -->
                                    </select>
                                    <div class="invalid-feedback">Please select an oncologist.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="editSubmitBtn">Save Changes</button>
            </div>
        </div>
    </div>
</div>
