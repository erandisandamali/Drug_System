<!-- Modal -->
<div class="modal fade" id="viewCreateDetailsModal" tabindex="-1" aria-labelledby="viewCreateDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewCreateDetailsModalLabel">Patient and Drug Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-4">
          <div class="col-6">
            <div class="bg-light rounded p-4">
              <h6 class="mb-4">Patient Details</h6>
              <div class="row">
                <div class="col-md-12 mb-2">
                  <span class="patient-detail-label">Patient Name:</span>
                  <span id="patientName" class="patient-detail-value"></span>
                </div>
                <div class="col-md-12 mb-2">
                  <span class="patient-detail-label">Personal Health Number (PHN):</span>
                  <span id="phnNumber" class="patient-detail-value"></span>
                </div>
                <div class="col-md-12 mb-2">
                  <span class="patient-detail-label">BHT Number:</span>
                  <span id="bhtNumber" class="patient-detail-value"></span>
                </div>
                <div class="col-md-12 mb-2">
                  <span class="patient-detail-label">Clinic Number:</span>
                  <span id="clinicNumber" class="patient-detail-value"></span>
                </div>
                <div class="col-md-6 mb-2">
                  <span class="patient-detail-label">Age:</span>
                  <span id="age" class="patient-detail-value"></span>
                </div>
                <div class="col-md-6 mb-2">
                  <span class="patient-detail-label">Gender:</span>
                  <span id="gender" class="patient-detail-value"></span>
                </div>
                <div class="col-md-6 mb-2">
                  <span class="patient-detail-label">Ward:</span>
                  <span id="ward" class="patient-detail-value"></span>
                </div>
                <div class="col-md-6 mb-2">
                  <span class="patient-detail-label">Section:</span>
                  <span id="section" class="patient-detail-value"></span>
                </div>
                <div class="col-md-12 mb-2">
                  <span class="patient-detail-label">Oncologist:</span>
                  <span id="oncologist" class="patient-detail-value"></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Drug details -->
        <div class="mt-4">
          <h6 class="mb-4">Drug Details</h6>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Reference ID</th>
                <th scope="col">Route</th>
                <th scope="col">Drug Type</th>
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
            <tbody id="drugDetailBody">
              <!-- Drug details will be populated here dynamically -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
