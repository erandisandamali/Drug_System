<!-- Edit Ward Modal -->
<div class="modal fade" id="editWardModal" tabindex="-1" aria-labelledby="editWardModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editWardModalLabel">Edit Ward</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding a new ward -->
                <form id="editWardForm" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <input type="hidden" id="editWardId">
                        <label for="editwardName" class="form-label">Ward Name</label>
                        <input type="text" class="form-control" id="editwardName" required>
                        <div class="invalid-feedback">
                            Please provide a ward name.
                        </div>
                    </div>
                    <!-- Add any additional fields for the ward here -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="editWardBtn">Save</button>
            </div>
        </div>
    </div>
</div>
