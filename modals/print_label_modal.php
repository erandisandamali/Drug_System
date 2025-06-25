<div class="modal fade" id="printLabelModal" tabindex="-1" aria-labelledby="printLabelModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Information of Prescription Label</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="referenceId" class="form-label">Reference ID:</label>
                                <label for="referenceId" class="form-label" id="referenceId"></label>
                            </div>
                            <div class="form-group">
                                <label for="route" class="form-label">Route:</label>
                                <label for="route" class="form-label" id="route"></label>
                            </div>
                            <div class="form-group">
                                <label for="drugName" class="form-label">Drug Name:</label>
                                <label for="drugName" class="form-label" id="drugName"></label>
                            </div>
                            <div class="form-group">
                                <label for="strength" class="form-label">Strength:</label>
                                <label for="strength" class="form-label" id="strength"></label>
                            </div>
                            <div class="form-group">
                                <label for="solution" class="form-label">Diluent:</label>
                                <label for="solution" class="form-label" id="solution"></label>
                            </div>
                            <div class="form-group">
                                <label for="volume" class="form-label">Diluent Volume:</label>
                                <label for="volume" class="form-label" id="volume"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" id="btnPdfLabel">
                    <i class="fas fa-file-pdf me-1"></i> Generate PDF
                </button>
            </div>
        </div>
    </div>
</div>