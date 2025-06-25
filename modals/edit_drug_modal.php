<!-- Edit Drug Modal Start -->
<div class="modal fade" id="editDrugModal" tabindex="-1" aria-labelledby="editDrugModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editDrugModalLabel">Edit Drug Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="needs-validation" novalidate>
          <div class="mb-3">
            <label for="editDrugType" class="form-label">Select Drug Type</label>
            <select class="form-select mb-3" id="editDrugType" aria-label="Default select example" required>
              <option selected disabled value="">Choose...</option>
              <!-- Add options dynamically if needed -->
            </select>
            <div class="invalid-feedback">Please select a drug type.</div>
          </div>
          <div class="mb-3">
            <label for="editSrNumber" class="form-label">SR Number</label>
            <input type="text" class="form-control" id="editSrNumber" required>
            <div class="invalid-feedback">Please provide a SR number.</div>
          </div>
          <div class="mb-3">
            <label for="editDrugName" class="form-label">Drug Name</label>
            <input type="text" class="form-control" id="editDrugName" aria-describedby="editDrugNameHelp" required>
            <div id="editDrugNameHelp" class="form-text">Enter the name of the drug</div>
            <div class="invalid-feedback">Please provide a drug name.</div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="btnEditDrug" class="btn btn-sm btn-primary">Save Changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Edit Drug Modal End -->
