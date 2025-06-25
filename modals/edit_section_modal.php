<!-- Add Section Modal -->
<div class="modal fade" id="editSectionModal" tabindex="-1" aria-labelledby="editSectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSectionModalLabel">Edit Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding a new section -->
                <form id="editSectionForm">
                    <input type="hidden" id="editSectionId">
                    <div class="mb-3">
                        <label for="editSectionwardId" class="form-label">Ward</label>
                        <select class="form-select" id="editSectionwardId" required>
                            <!-- Populate options dynamically based on wards -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editSectionName" class="form-label">Section Name</label>
                        <input type="text" class="form-control" id="editSectionName" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="saveSectionButton">Save</button>
            </div>
        </div>
    </div>
</div>