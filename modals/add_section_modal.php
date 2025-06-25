<!-- Add Section Modal -->
<div class="modal fade" id="addSectionModal" tabindex="-1" aria-labelledby="addSectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSectionModalLabel">Add Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding a new section -->
                <form id="addSectionForm">
                    <div class="mb-3">
                        <label for="wardId" class="form-label">Ward</label>
                        <select class="form-select" id="wardId" required disabled>
                            <!-- Populate options dynamically based on wards -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sectionName" class="form-label">Section Name</label>
                        <input type="text" class="form-control" id="sectionName" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="submitSectionButton">Add</button>
            </div>
        </div>
    </div>
</div>