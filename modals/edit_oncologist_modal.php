<div class="modal fade" id="editOncologistModal" tabindex="-1" aria-labelledby="editOncologistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOncologistModalLabel">Edit Oncologist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form inside modal -->
                <form class="needs-validation" novalidate id="editOncologistForm">
                    <input type="hidden" id="editOncologistId">
                    <div class="mb-3">
                        <label for="editOncologistTitle" class="form-label">Title</label>
                        <select id="editOncologistTitle" class="form-select" required>
                            <option selected disabled value="">Choose Title...</option>
                            <option value="Dr">Dr.</option>
                            <option value="Prof">Prof.</option>
                            <option value="Asst. Prof.">Asst. Prof.</option>
                            <option value="Assoc. Prof.">Assoc. Prof.</option>
                            <option value="Sr. Dr.">Sr. Dr.</option>
                            <option value="Mr">Mr.</option>
                            <option value="Ms">Ms.</option>
                            <option value="Rev">Rev.</option>
                        </select>
                        <div class="invalid-feedback">Please select a title.</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editFirstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="editFirstNameInput" required>
                                <div class="invalid-feedback">Please enter a first name.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editLastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="editLastNameInput" required>
                                <div class="invalid-feedback">Please enter a last name.</div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="saveBtn">Save</button>
            </div>
        </div>
    </div>
</div>
