<div class="modal fade" id="addOncologistModal" tabindex="-1" aria-labelledby="addOncologistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOncologistModalLabel">Add New Oncologist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form inside modal -->
                <form class="needs-validation" novalidate id="addOncologistForm">
                    <div class="mb-3">
                        <label for="oncologistTitle" class="form-label">Title</label>
                        <select id="oncologistTitle" class="form-select" required>
                            <option selected disabled value="">Choose Title...</option>
                            <option value="Dr.">Dr.</option>
                            <option value="Prof.">Prof.</option>
                            <option value="Asst. Prof.">Asst. Prof.</option>
                            <option value="Assoc. Prof.">Assoc. Prof.</option>
                            <option value="Sr. Dr.">Sr. Dr.</option>
                            <option value="Mr.">Mr.</option>
                            <option value="Ms.">Ms.</option>
                            <option value="Rev.">Rev.</option>
                        </select>
                        <div class="invalid-feedback">Please select a title.</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="firstNameInput" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstNameInput" required>
                                <div class="invalid-feedback">Please enter a first name.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="lastNameInput" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastNameInput" required>
                                <div class="invalid-feedback">Please enter a last name.</div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="submitBtn">Add</button>
            </div>
        </div>
    </div>
</div>