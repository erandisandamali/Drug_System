let phnIsChecked = false;
let drugDetailCounter = 0;
const maxDrugDetails = 5;

$(document).ready(function () {
  // Flag to track successful form submission
  let formSubmitted = false;

  // Fetch all patient details
  fetchAllPatients();

  // Set focus to the "Search by Name" input box when the page loads
  $("#searchByPatientName").focus();

  // Search by name
  $("#searchByPatientName").keyup(function () {
    var searchText = $(this).val().toLowerCase(); // Get the search text

    // Loop through each row in the table
    $("#patientsBody tr").each(function () {
      var patientName = $(this).find("td:nth-child(1)").text().toLowerCase(); // Get the drug name in this row
      // Check if the drug name contains the search text
      if (patientName.includes(searchText)) {
        $(this).show(); // If yes, show the row
      } else {
        $(this).hide(); // If not, hide the row
      }
    });
  });

  // Search by number
  $("#searchByPatientNumber").keyup(function () {
    var searchNum = $(this).val().toLowerCase(); // Get the search text

    // Loop through each row in the table
    $("#patientsBody tr").each(function () {
      var phn = $(this).find("td:nth-child(2)").text().toLowerCase();
      var bhtNumber = $(this).find("td:nth-child(3)").text().toLowerCase();
      var clinicNumber = $(this).find("td:nth-child(4)").text().toLowerCase();

      // Check if any of the numbers contain the search text
      if (
        phn.includes(searchNum) ||
        bhtNumber.includes(searchNum) ||
        clinicNumber.includes(searchNum)
      ) {
        $(this).show(); // If yes, show the row
      } else {
        $(this).hide(); // If not, hide the row
      }
    });
  });

  // Call the function to populate the dropdowns
  populateWardsDropdownMenuForAddPatient();
  populateWardsDropdownMenuForEditPatient();

  populateSectionsDropdownMenuForAddPatient();
  populateSectionsDropdownMenuForEditPatient();

  populateOncologistsDropdownMenuForAddPatient();
  populateOncologistsDropdownMenuForEditPatient();

  addDrugDetailField();

  $("#refreshButton").on("click", function () {
    fetchAllPatients();
    $("#searchByPatientName").val("");
    $("#searchByPatientNumber").val("");
  });

  // Handle view button click event
  $("#patientsBody").on("click", ".view-btn", function () {
    const patientId = $(this).data("id");
    fetchCreateDetails(patientId);
    populateViewPatientDetails(patientId);
  });

  // Event delegation for the "Edit" buttons
  $("#patientsBody").on("click", ".edit-btn", function () {
    const patientId = $(this).data("id");
    // Call the function to populate sections dropdown
    populateSectionsDropdownMenuForEditPatient_AllSections();
    populateEditPatientDetails(patientId);
  });

  // Event delegation for the "Delete" buttons
  $("#patientsBody").on("click", ".delete-btn", function () {
    const patientId = $(this).data("id");
    confirmDeletePatient(patientId);
  });

  // Event delegation for the "Create" buttons
  $("#patientsBody").on("click", ".create-btn", function () {
    const patientId = $(this).data("id");
    getPatientDetailsToCreate(patientId);
    // Show the crate modal
    $("#createModal").modal("show");
  });

  // Event listener for "Add" button
  $("#addDrugDetail").on("click", function () {
    addDrugDetailField();
  });

  // Event listener for "Submit" button
  $("#submitCreateForm").on("click", function () {
    const isValid = validateDrugDetails();

    if (!isValid) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Please fill in all drug detail fields.",
      });
    } else {
      // Get drug details from the form

      var createPatinetID = $("#createPatientId").val();
      const drugDetails = getDrugDetailsInputs();

      insertDrugDetails();

      // Set the formSubmitted flag to true when the form is successfully submitted
      formSubmitted = true;
    }
  });

  // Add event listener for modal hide event
  $("#createModal").on("hide.bs.modal", function (e) {
    if (!formSubmitted) {
      // Show SweetAlert confirmation dialog
      Swal.fire({
        title: "Are you sure?",
        text: "Changes you made may not be saved.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, close it!",
      }).then((result) => {
        if (result.isConfirmed) {
          // If user confirms, close the modal
          $("#createModal").modal("hide");
          // Clear all inputs in createModal
          clearDrugDetailsInputs();
          return;
        } else {
          // Prevent the default behavior of the modal hide event
          e.preventDefault();
          $("#createModal").modal("show");
        }
      });
    }
  });

  $("#submitBtn").on("click", function (event) {
    event.preventDefault(); // Prevent default form submission behavior

    var firstName = $("#firstNameInput").val();
    var lastName = $("#lastNameInput").val();
    var phn = $("#phnInput").val();
    var bhtNum = $("#bhtNumInput").val();
    var clinicNum = $("#clinicNumInput").val();
    var age = $("#ageInput").val();
    var gender = $("#genderInput").val();
    var title = $("#titleInput").val();
    var ward = $("#wardInput").val();
    var section = $("#sectionInput").val();
    var oncologist = $("#oncologistInput").val();

    // Perform frontend validation
    var form = $(".needs-validation")[0];
    if (form.checkValidity() === false) {
      event.stopPropagation(); // Stop event propagation
      $(form).addClass("was-validated");
      return;
    }

    // Clear previous PHN error
    $("#phn-error").hide();

    // AJAX request to check PHN uniqueness
    $.ajax({
      type: "POST",
      url: "process/check_phn_uniqueness.php", // Path to your backend script
      data: {
        phn: phn,
      },
      success: function (response) {
        if (phnIsChecked && response === "exists") {
          $("#phn-error").show();
        } else {
          $("#phn-error").hide();
          // PHN number is unique, proceed with database insertion
          var formData = {
            firstName: firstName,
            lastName: lastName,
            phn: phn,
            bhtNum: bhtNum,
            clinicNum: clinicNum,
            ward: ward,
            section: section,
            age: age,
            title: title,
            gender: gender,
            oncologist: oncologist,
          };

          insertPatientData(formData);
        }
      },
      error: function (xhr, status, error) {
        // Handle errors
        console.error("Error checking PHN uniqueness:", error);
      },
    });
  });

  // Event listener for modal close
  $("#addPatientModal").on("hidden.bs.modal", function () {
    // Clear all input fields
    $("#addPatientModal form")[0].reset();

    // Remove validation classes
    $("#addPatientModal form").removeClass("was-validated");

    // Hide all custom error messages
    $("#phn-error").hide();
  });

  // edit patient details
  $("#editSubmitBtn").on("click", function (event) {
    // Get form values
    var editPatientID = $("#editPatientID").val();
    var editFirstName = $("#firstNameEdit").val();
    var editLastName = $("#lastNameEdit").val();
    var editPhn = $("#phnEdit").val();
    var editBhtNum = $("#bhtNumEdit").val();
    var editClinicNum = $("#clinicNumEdit").val();
    var editTitle = $("#titleEdit").val();
    var editGender = $("#genderEdit").val();
    var editAge = $("#ageEdit").val();
    var editWardId = $("#wardEdit").val();
    var editSectionId = $("#sectionEdit").val();
    var editOncologistId = $("#oncologistEdit").val();

    var editPatientFormData = {
      id: editPatientID,
      new_first_name: editFirstName,
      new_last_name: editLastName,
      new_phn: editPhn,
      new_bht_num: editBhtNum,
      new_clinic_num: editClinicNum,
      new_gender: editGender,
      new_title: editTitle,
      new_ward: editWardId,
      new_age: editAge,
      new_section: editSectionId,
      new_oncologist: editOncologistId,
    };

    // AJAX request to update patient data
    $.ajax({
      type: "POST",
      url: "process/update_patient.php",
      data: editPatientFormData,
      success: function (response) {
        // Hide the edit modal
        $("#editPatientModal").modal("hide");

        // Display success message using SweetAlert
        swal
          .fire({
            icon: "success",
            title: "Success!",
            text: "The patient details have been updated successfully.",
            showConfirmButton: false,
            timer: 1500,
          })
          .then(() => {
            // Clear input fields and error messages
            $("#editPatientForm").removeClass("was-validated");
            $("#editPatientModal").find("input, select").val("");
          });
      },
      error: function (xhr, status, error) {
        // Handle errors
        console.error("Error updating patient data:", error);
      },
    });
  });

  // Toggle PHN input field
  $("#phnCheck").change(function () {
    if (this.checked) {
      $("#phnInput").prop("disabled", false);
      phnIsChecked = true;
    } else {
      $("#phnInput").prop("disabled", true);
      phnIsChecked = false;
    }
  });

  // Toggle BHT Number input field
  $("#bhtCheck").change(function () {
    if (this.checked) {
      $("#bhtNumInput").prop("disabled", false);
    } else {
      $("#bhtNumInput").prop("disabled", true);
    }
  });

  // Toggle Clinic Number input field
  $("#clinicCheck").change(function () {
    if (this.checked) {
      $("#clinicNumInput").prop("disabled", false);
    } else {
      $("#clinicNumInput").prop("disabled", true);
    }
  });

  // Toggle PHN input field
  $("#phnCheckEdit").change(function () {
    if (this.checked) {
      $("#phnEdit").prop("disabled", false);
    } else {
      $("#phnEdit").prop("disabled", true);
    }
  });

  // Toggle BHT Number input field
  $("#bhtCheckEdit").change(function () {
    if (this.checked) {
      $("#bhtNumEdit").prop("disabled", false);
    } else {
      $("#bhtNumEdit").prop("disabled", true);
    }
  });

  // Toggle Clinic Number input field
  $("#clinicCheckEdit").change(function () {
    if (this.checked) {
      $("#clinicNumEdit").prop("disabled", false);
    } else {
      $("#clinicNumEdit").prop("disabled", true);
    }
  });
});

function toggleInput(inputId, checkBoxId) {
  $(checkBoxId).change(function () {
    if (this.checked) {
      $(inputId).prop("disabled", false);
    } else {
      $(inputId).prop("disabled", true);
    }
  });
}

// Function to get patient details
function getPatientDetailsToCreate(patientId) {
  console.log(patientId);
  $.ajax({
    url: "process/fetch_patient_details.php",
    type: "GET",
    data: {
      id: patientId,
    },
    dataType: "json",
    success: function (patient) {
      // Populate modal fields with patient data
      $("#createPatientId").val(patient.id);

      $("#createPhn").text(patient.phn || "not provided");
      $("#CreateBhtNumber").text(patient.bht_number || "not provided");
      $("#createClinicNumber").text(patient.clinic_number || "not provided");
      $("#createPatientName").text(
        `${patient.title}. ${patient.first_name} ${patient.last_name}`
      );
      $("#createAge").text(patient.age);
      $("#createGender").text(patient.gender);
      $("#createWard").text(patient.ward_name);
      $("#createSection").text(patient.section_name);
      $("#createOncologist").text(
        `${patient.oncologist_title}. ${patient.oncologist_first_name} ${patient.oncologist_last_name}`
      );
    },
    error: function (xhr, status, error) {
      console.error("Error fetching patient details:", error);
    },
  });
}

// Function to add a drug detail field
function addDrugDetailField() {
  if (drugDetailCounter >= maxDrugDetails) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Maximum limit reached!",
    });
    return;
  }

  // Define unique IDs for input fields
  const uniqueId = "drugDetail_" + drugDetailCounter;

  // Define the HTML for the drug detail row with unique IDs
  const drugDetailRow = `
                <tr class="create-drug-detail" id="${uniqueId}">
                    <td>
                        <select class="form-select" name="routes[]" id="${uniqueId}_routes" aria-label="Select Route">
                            <option selected disabled>Select</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" name="drugType[]" id="${uniqueId}_drugType" aria-label="Select Drug Type">
                            <option value="">Select</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" name="drugName[]" id="${uniqueId}_drugName" aria-label="Select Drug Name">
                            <option value="">Select</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="strength[]" id="${uniqueId}_strength">
                    </td>
                    <td>
                        <select class="form-select" name="solutions[]" id="${uniqueId}_solution" aria-label="Select Solution">
                            <option selected disabled>Select</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="volume[]" id="${uniqueId}_volume">
                    </td>
                    <td>
                        <select class="form-select" name="location[]" id="${uniqueId}_location" aria-label="Select Location">
                            <option selected disabled>Select</option>
                            <option value="Inside">Inside</option>
                            <option value="Outside">Outside</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" name="days[]" id="${uniqueId}_days" aria-label="Select Days">
                            <option selected disabled>Select</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" name="dosage[]" id="${uniqueId}_dosage" aria-label="Select Dosage">
                            <option selected disabled>Select</option>
                            <option value="bd">bd</option>
                            <option value="tds">tds</option>
                        </select>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm mb-3 removeDrugDetail" onclick="removeDrugDetailField('${uniqueId}')">
                            <i class="fas fa-minus"></i>
                        </button>
                    </td>
                </tr>`;

  // Append the drug detail row to the table body
  $("#CreateDrugDetailBody").append(drugDetailRow);

  // Increment the drug detail counter
  drugDetailCounter++;

  // After adding the field, fetch drug types and populate the dropdowns
  fetchDrugTypes(uniqueId);
  displayDrugNamesByCategory(uniqueId);
  fetchSolutions(uniqueId);
  fetchDays(uniqueId);
  fetchRoutes(uniqueId);
}

// Function to validate Drug Details Input
function validateDrugDetails() {
  let isValid = true;

  $(".create-drug-detail").each(function () {
    const route = $(this).find(`select[name="route[]"]`).val();
    const drugName = $(this).find(`select[name="drugName[]"]`).val();
    const strength = $(this).find(`input[name="strength[]"]`).val();
    const solution = $(this).find(`select[name="solutions[]"]`).val();
    const volume = $(this).find(`input[name="volume[]"]`).val();
    const location = $(this).find(`select[name="location[]"]`).val();
    const days = $(this).find(`select[name="days[]"]`).val();
    const dosage = $(this).find(`select[name="dosage[]"]`).val();

    // Check if any of the fields are empty
    if (
      route === "" ||
      drugName === "" ||
      strength === "" ||
      solution === "" ||
      volume === "" ||
      location === "" ||
      days === "" ||
      dosage === ""
    ) {
      isValid = false;
      return false; // Exit the loop early if any field is empty
    }
  });

  return isValid;
}

// Function to register event listener for drug type change
function displayDrugNamesByCategory(uniqueId) {
  // Add event listener to drug type select element
  $("#" + uniqueId + "_drugType").change(function () {
    const selectedDrugType = $(this).val(); // Get the selected drug type
    fetchDrugNamesByType(uniqueId, selectedDrugType); // Fetch drug names for the selected type
  });
}

// Function to fetch drug names by type
function fetchDrugNamesByType(uniqueId, drugType) {
  // Make an AJAX request to fetch drug names based on the selected drug type
  $.ajax({
    url: "process/fetch_drug_names_by_type.php",
    type: "GET",
    data: {
      drugType: drugType,
    }, // Pass selected drug type as parameter
    dataType: "json",
    success: function (drugData) {
      // Clear existing options in the drug name dropdown
      $("#" + uniqueId + "_drugName").empty();
      $("#" + uniqueId + "_drugName").append(
        ` <option selected disabled value="">Select</option>`
      );
      // Populate options for the selected drug type
      drugData.forEach(function (drug) {
        $("#" + uniqueId + "_drugName").append(
          `<option value="${drug.id}">${drug.drug_name}</option>`
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("Error fetching drug names by type:", error);
    },
  });
}

function fetchSolutions(uniqueId) {
  $.ajax({
    url: "process/fetch_all_solutions.php", // Change to your PHP script URL
    type: "GET",
    dataType: "json",
    success: function (response) {
      // Clear existing options
      $("#" + uniqueId + "_solution").empty();
      // Populate options
      $("#" + uniqueId + "_solution").append(
        ` <option selected disabled value="">Select</option>`
      );
      response.forEach(function (item) {
        $("#" + uniqueId + "_solution").append(
          `<option value="${item.id}">${item.solution}</option>`
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("Error fetching drug types:", error);
    },
  });
}

function fetchDrugTypes(uniqueId) {
  $.ajax({
    url: "process/fetch_drug_types.php", // Change to your PHP script URL
    type: "GET",
    dataType: "json",
    success: function (response) {
      // Clear existing options
      $("#" + uniqueId + "_drugType").empty();
      // Populate options
      $("#" + uniqueId + "_drugType").append(
        `<option selected disabled value="">Select</option>`
      );
      response.forEach(function (item) {
        $("#" + uniqueId + "_drugType").append(
          `<option value="${item.id}">${item.type}</option>`
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("Error fetching drug types:", error);
    },
  });
}

function fetchDays(uniqueId) {
  $.ajax({
    url: "process/fetch_all_durations.php",
    type: "GET",
    dataType: "json",
    success: function (response) {
      // Clear existing options
      $("#" + uniqueId + "_days").empty();
      // Populate options
      $("#" + uniqueId + "_days").append(
        ` <option selected disabled value="">Select</option>`
      );
      response.forEach(function (item) {
        $("#" + uniqueId + "_days").append(
          `<option value="${item.id}">${item.type}</option>`
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("Error fetching duration:", error);
    },
  });
}

function fetchRoutes(uniqueId) {
  $.ajax({
    url: "process/fetch_all_routes.php",
    type: "GET",
    dataType: "json",
    success: function (response) {
      // Clear existing options
      $("#" + uniqueId + "_routes").empty();
      // Populate options
      $("#" + uniqueId + "_routes").append(
        ` <option selected disabled value="">Select</option>`
      );
      response.forEach(function (item) {
        $("#" + uniqueId + "_routes").append(
          `<option value="${item.id}">${item.type}</option>`
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("Error fetching routes:", error);
    },
  });
}

function removeDrugDetailField(drugDetailId) {
  // Check if drugDetailCounter is 1, if so, do not remove
  if (drugDetailCounter === 1) {
    // Alert or notify the user that at least one drug detail field is required
    Swal.fire({
      icon: "warning",
      title: "Oops...",
      text: "At least one drug detail field is required.",
    });
    return; // Exit the function early
  }

  $("#" + drugDetailId).remove();
  drugDetailCounter--;
  renumberDrugDetails();
}

function renumberDrugDetails() {
  $(".create-drug-detail").each(function (index) {
    $(this).attr("id", "drugDetail_" + index);
    $(this)
      .find("select, input")
      .each(function () {
        const name = $(this).attr("name").replace(/\d+/g, index);
        $(this).attr("name", name);
        $(this).attr("aria-label", name);
        $(this).attr("placeholder", name);
      });
  });
}

// Function to retrieve the values of drug detail inputs
function getDrugDetailsInputs() {
  const drugDetails = [];
  // Iterate over each drug detail row
  $(".create-drug-detail").each(function () {
    const drugDetail = {};
    // Patient ID
    drugDetail.patientId = $("#createPatientId").val();
    // Get values from input fields

    drugDetail.route = $(this).find('select[name="routes[]"]').val();
    drugDetail.drugType = $(this).find('select[name="drugType[]"]').val();
    drugDetail.drugName = $(this).find('select[name="drugName[]"]').val();
    drugDetail.strength = $(this).find('input[name="strength[]"]').val();
    drugDetail.solution = $(this).find('select[name="solutions[]"]').val();
    drugDetail.volume = $(this).find('input[name="volume[]"]').val();
    drugDetail.location = $(this).find('select[name="location[]"]').val();
    drugDetail.days = $(this).find('select[name="days[]"]').val();
    drugDetail.dosage = $(this).find('select[name="dosage[]"]').val();

    // Add drug detail object to the array
    drugDetails.push(drugDetail);
  });

  return drugDetails;
}

// Function to clear all inputs in the createModal
function clearDrugDetailsInputs() {
  // Clear all drug detail inputs within each drug detail row
  $(".create-drug-detail").each(function () {
    $(this).find('select[name="route[]"]').val("");
    $(this).find('select[name="drugType[]"]').val("");
    $(this).find('select[name="drugName[]"]').val("");
    $(this).find('select[name="strength[]"]').val("");
    $(this).find('select[name="solutions[]"]').val("");
    $(this).find('input[name="volume[]"]').val("");
    $(this).find('select[name="location[]"]').val("");
    $(this).find('select[name="days[]"]').val("");
    $(this).find('select[name="dosage[]"]').val("");
  });
}

// Function to send drug details data to the server
function insertDrugDetails() {
  // Get drug details data

  const jsonData = getDrugDetailsInputs();

  // Convert JSON data to string
  var jsonString = JSON.stringify(jsonData);

  // Log JSON data before sending to the server
  // console.log("JSON data sent to the server:", jsonString);

  // Send JSON data to the server via AJAX
  $.ajax({
    type: "POST",
    url: "process/insert_created_drug_details.php",
    data: jsonString,
    contentType: "application/json",
    success: function (response) {
      // Display success message using SweetAlert
      swal
        .fire({
          icon: "success",
          title: "Success!",
          text: "The drug details have been created successfully",
          showConfirmButton: false,
          timer: 1500,
        })
        .then(() => {
          // Clear all inputs in createModal
          clearDrugDetailsInputs();
          // close the modal after successful submission
          $("#createModal").modal("hide");
        });
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText); // Log error message
    },
  });
}

//function to insert paient data
function insertPatientData(formData) {
  // AJAX request to insert data into the database
  $.ajax({
    type: "POST",
    url: "process/insert_patient.php", // Path to your PHP script for database insertion
    data: formData,
    success: function (response) {
      // Display success message using SweetAlert
      swal
        .fire({
          icon: "success",
          title: "Success!",
          text: "The patient has been inserted successfully.",
          showConfirmButton: false,
          timer: 1500,
        })
        .then(() => {
          // close the modal after successful submission
          $("#addPatientModal").modal("hide");
          // clear input fields and error messages
          $("#addPatientModal").find("input, select").val("");
          $(".invalid-feedback").hide();
          // Fetch and display updated patient list
          fetchAllPatients();
        });
    },
    error: function (xhr, status, error) {
      // Handle errors
      console.error("Error inserting data:", error);
    },
  });
}

// Function to show the spinner
function showSpinner() {
  $(".spinner-overlay").show();
}

// Function to hide the spinner
function hideSpinner() {
  $(".spinner-overlay").hide();
}

// Function to fetch all patient details using AJAX
function fetchAllPatients() {
  showSpinner();
  $.ajax({
    url: "process/fetch_all_patients.php",
    type: "GET",
    dataType: "json",
    success: function (response) {
      hideSpinner();
      if (response && Array.isArray(response)) {
        displayPatients(response);
      } else {
        $("#patientsBody").html(`
                <tr>
                    <td colspan="6">
                        <div class="alert alert-danger text-center" role="alert">
                            No Patients found!
                        </div>
                    </td>
                </tr>`);
      }
    },
    error: function (xhr, status, error) {
      hideSpinner();
      console.error("Error:", error);
      $("#patientsBody").html(`
            <tr>
                <td colspan="6">
                    <div class="alert alert-danger text-center" role="alert">
                        Something went wrong!
                    </div>
                </td>
            </tr>`);
    },
  });
}

// Function to display patient details as a table on the page
function displayPatients(patients) {
  const patientDetailsBody = $("#patientsBody");
  patientDetailsBody.empty();
  // Iterate over the patient details and populate the table
  patients.forEach((patient) => {
    // JavaScript code to generate the table rows with buttons containing only icons
    const row = `
    <tr>
        <td>${patient.first_name} ${patient.last_name}</td>
        <td>${patient.phn || "not provided"}</td>
        <td>${patient.bht_number || "not provided"}</td>
        <td>${patient.clinic_number || "not provided"}</td>
        <td>${patient.ward_name}</td>
        <td>${patient.section_name}</td>
        <td>
        <div class="btn-group" role="group" aria-label="Patient Actions">
            <button class="btn btn-primary btn-sm view-btn" data-id="${
              patient.id
            }" data-toggle="modal" data-target="#viewPatientModal">
                <i class="fas fa-eye"></i>
            </button>
            <button class="btn btn-warning btn-sm edit-btn" data-id="${
              patient.id
            }" data-toggle="modal" data-target="#editPatientModal">
                <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-danger btn-sm delete-btn" data-id="${
              patient.id
            }">
                <i class="fas fa-trash"></i>
            </button>
            <button class="btn btn-success btn-sm create-btn" data-id="${
              patient.id
            }">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </td>    
    </tr>`;

    patientDetailsBody.append(row);
  });
}

// Function to confirm deletion using SweetAlert
function confirmDeletePatient(patientId) {
  // Display SweetAlert confirmation dialog
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      // If user confirms deletion, call deletePatient function
      deletePatient(patientId);
    }
  });
}

// Function to delete a patient using AJAX
function deletePatient(patientId) {
  // Send AJAX request
  $.ajax({
    url: "process/delete_patient.php",
    type: "POST",
    data: {
      id: patientId,
    },
    success: function (response) {
      // Display success message using SweetAlert
      Swal.fire({
        icon: "success",
        title: "Success!",
        text: "Patient has been deleted successfully.",
        showConfirmButton: false,
        timer: 1500,
      }).then(() => {
        fetchAllPatients();
      });
    },
    error: function (xhr, status, error) {
      // Handle error response
      console.error("Error deleting patient:", error);
    },
  });
}

// Function to fetch wards & populate the dropdown menu on the add patient modal
function populateWardsDropdownMenuForAddPatient() {
  $.ajax({
    url: "process/fetch_wards.php",
    type: "GET",
    dataType: "json",
    success: function (wards) {
      if (wards.length > 0) {
        let options = '<option selected disabled value="">Choose...</option>';
        wards.forEach((ward) => {
          // Sanitize data before inserting into HTML
          const sanitizedWardName = $("<div>").text(ward.ward_name).html();
          options += `<option value="${ward.id}">${sanitizedWardName}</option>`;
        });
        $("#wardInput").html(options); // Update the ward select options
      } else {
        // Handle case where no wards are returned
        console.error("No wards found.");
      }
    },
    error: function (xhr, status, error) {
      // Provide user-facing feedback in case of error
      console.error("Error fetching wards:", error);
      $("#wardInput").html(
        '<option selected disabled value="">Error fetching data</option>'
      );
    },
  });
}

// Function to fetch wards & populate the dropdown menu on the edit patient modal
function populateWardsDropdownMenuForEditPatient() {
  $.ajax({
    url: "process/fetch_wards.php",
    type: "GET",
    dataType: "json",
    success: function (wards) {
      if (wards.length > 0) {
        let options = '<option selected disabled value="">Choose...</option>';
        wards.forEach((ward) => {
          // Sanitize data before inserting into HTML
          const sanitizedWardName = $("<div>").text(ward.ward_name).html();
          options += `<option value="${ward.id}">${sanitizedWardName}</option>`;
        });
        $("#wardEdit").html(options); // Update the ward select options
      } else {
        // Handle case where no wards are returned
        console.error("No wards found.");
      }
    },
    error: function (xhr, status, error) {
      // Provide user-facing feedback in case of error
      console.error("Error fetching wards:", error);
      $("#wardEdit").html(
        '<option selected disabled value="">Error fetching data</option>'
      );
    },
  });
}

// Function to fetch oncologists & populate the dropdown
function populateOncologistsDropdownMenuForAddPatient() {
  $.ajax({
    url: "process/fetch_all_oncologists.php",
    type: "GET",
    dataType: "json",
    success: function (oncologists) {
      if (oncologists.length > 0) {
        let options = '<option selected disabled value="">Choose...</option>';
        oncologists.forEach((oncologist) => {
          // Sanitize data before inserting into HTML
          const sanitizedFirstName = $("<div>")
            .text(oncologist.first_name)
            .html();
          const sanitizedLastName = $("<div>")
            .text(oncologist.last_name)
            .html();
          options += `<option value="${oncologist.id}">${oncologist.title}. ${sanitizedFirstName} ${sanitizedLastName}</option>`;
        });
        $("#oncologistInput").html(options); // Update the oncologist select options
      } else {
        // Handle case where no oncologists are returned
        console.error("No oncologists found.");
      }
    },
    error: function (xhr, status, error) {
      // Provide user-facing feedback in case of error
      console.error("Error fetching oncologists:", error);
      $("#oncologistInput").html(
        '<option selected disabled value="">Error fetching data</option>'
      );
    },
  });
}

function populateOncologistsDropdownMenuForEditPatient() {
  $.ajax({
    url: "process/fetch_all_oncologists.php",
    type: "GET",
    dataType: "json",
    success: function (oncologists) {
      if (oncologists.length > 0) {
        let options = '<option selected disabled value="">Choose...</option>';
        oncologists.forEach((oncologist) => {
          // Sanitize data before inserting into HTML
          const sanitizedFirstName = $("<div>")
            .text(oncologist.first_name)
            .html();
          const sanitizedLastName = $("<div>")
            .text(oncologist.last_name)
            .html();
          options += `<option value="${oncologist.id}">${oncologist.title}. ${sanitizedFirstName} ${sanitizedLastName}</option>`;
        });
        $("#oncologistEdit").html(options); // Update the oncologist select options
      } else {
        // Handle case where no oncologists are returned
        console.error("No oncologists found.");
      }
    },
    error: function (xhr, status, error) {
      // Provide user-facing feedback in case of error
      console.error("Error fetching oncologists:", error);
      $("#oncologistEdit").html(
        '<option selected disabled value="">Error fetching data</option>'
      );
    },
  });
}

// Function to fetch sections & populate the dropdown based on the selected ward
function populateSectionsDropdownMenuForAddPatient() {
  // Event listener for changes in the ward dropdown
  $("#wardInput").change(function () {
    // Get the selected ward ID
    var selectedWardId = $(this).val();

    // Make AJAX request to fetch sections based on the selected ward
    $.ajax({
      url: "process/fetch_sections_by_ward.php", // Replace with the correct endpoint
      type: "GET",
      dataType: "json",
      data: { ward_id: selectedWardId }, // Send selected ward ID to the server
      success: function (sections) {
        let options =
          '<option selected disabled value="">Choose Section...</option>';
        sections.forEach((section) => {
          options += `<option value="${section.id}">${section.section_name}</option>`;
        });
        $("#sectionInput").html(options); // Update the section select options
      },
      error: function (xhr, status, error) {
        console.error("Error fetching sections:", error);
      },
    });
  });
}

function populateSectionsDropdownMenuForEditPatient() {
  // Event listener for changes in the ward dropdown
  $("#wardEdit").change(function () {
    // Get the selected ward ID
    var selectedWardId = $(this).val();

    // Make AJAX request to fetch sections based on the selected ward
    $.ajax({
      url: "process/fetch_sections_by_ward.php",
      type: "GET",
      dataType: "json",
      data: { ward_id: selectedWardId }, // Send selected ward ID to the server
      success: function (sections) {
        let options =
          '<option selected disabled value="">Choose Section...</option>';
        sections.forEach((section) => {
          options += `<option value="${section.id}">${section.section_name}</option>`;
        });
        $("#sectionEdit").html(options); // Update the section select options
      },
      error: function (xhr, status, error) {
        console.error("Error fetching sections:", error);
      },
    });
  });
}

function populateSectionsDropdownMenuForEditPatient_AllSections() {
  $.ajax({
    url: "process/fetch_all_sections.php",
    type: "GET",
    dataType: "json",
    success: function (sections) {
      if (sections.length > 0) {
        let options = '<option selected disabled value="">Choose...</option>';
        sections.forEach((section) => {
          // Sanitize data before inserting into HTML
          const sanitizedSectionsName = $("<div>")
            .text(section.section_name)
            .html();
          options += `<option value="${section.id}">${sanitizedSectionsName}</option>`;
        });
        $("#sectionEdit").html(options); // Update the ward select options
      } else {
        // Handle case where no wards are returned
        console.error("No sections found.");
      }
    },
    error: function (xhr, status, error) {
      // Provide user-facing feedback in case of error
      console.error("Error fetching sections:", error);
      $("#sectionEdit").html(
        '<option selected disabled value="">Error fetching data</option>'
      );
    },
  });
}

// Function to fetch drug details using AJAX
function fetchCreateDetails(patientId) {
  $.ajax({
    url: "process/fetch_created_list_of_patient.php",
    type: "GET",
    data: {
      id: patientId,
    },
    dataType: "json",
    success: function (data) {
      if (data.status) {
        populateCreatedDetails(data);
      } else {
        $("#drugDetailBody").html(
          '<tr class="mt-2 alert alert-danger text-center" role="alert"><td colspan="12">No Created Drug Details found!</td></tr>'
        );
      }
    },
    error: function (xhr, status, error) {
      console.error("Error fetching drug details:", error);
    },
  });
}

// Function to display drug details in the table
function populateCreatedDetails(response) {
  const drugDetailBody = $("#drugDetailBody");
  drugDetailBody.empty();

  // Iterate over the drug details and populate the table
  for (let key in response) {
    if (key !== "status" && key !== "message") {
      const detail = response[key];
      const row = `<tr>
          <td>${detail.id}</td>
          <td>${detail.route}</td>
          <td>${detail.drug_type}</td>
          <td>${detail.drug_name}</td>
          <td>${detail.strength}</td>
          <td>${detail.solution}</td>
          <td>${detail.volume}</td>
          <td>${detail.location}</td>
          <td>${detail.duration_type}</td>
          <td>${detail.dosage}</td>
          <td>${detail.created_at}</td>
        </tr>`;
      drugDetailBody.append(row);
    }
  }
}

// Function to get patient details
function populateViewPatientDetails(patientId) {
  $.ajax({
    url: "process/fetch_patient_details.php",
    type: "GET",
    data: {
      id: patientId,
    },
    dataType: "json",
    success: function (patient) {
      // Populate modal fields with patient data
      $("#phnNumber").text(patient.phn || "not provided");
      $("#bhtNumber").text(patient.bht_number || "not provided");
      $("#clinicNumber").text(patient.clinic_number || "not provided");
      $("#patientName").text(
        `${patient.title}. ${patient.first_name} ${patient.last_name}`
      );
      $("#age").text(patient.age);
      $("#gender").text(patient.gender);
      $("#ward").text(patient.ward_name);
      $("#section").text(patient.section_name);
      $("#oncologist").text(
        `${patient.oncologist_title}. ${patient.oncologist_first_name} ${patient.oncologist_last_name}`
      );

      $("#viewCreateDetailsModal").modal("show");
    },
    error: function (xhr, status, error) {
      console.error("Error fetching patient details:", error);
    },
  });
}

// Function to fetch patient data by ID
function populateEditPatientDetails(patientId) {
  $.ajax({
    url: "process/fetch_patient_details.php",
    type: "GET",
    data: {
      id: patientId,
    },
    dataType: "json",
    success: function (patient) {
      // Populate modal fields with patient data
      $("#editPatientID").val(patient.id);
      $("#phnEdit").val(patient.phn);
      $("#titleEdit").val(patient.title);
      $("#genderEdit").val(patient.gender);
      $("#bhtNumEdit").val(patient.bht_number);
      $("#clinicNumEdit").val(patient.clinic_number);
      $("#firstNameEdit").val(patient.first_name);
      $("#lastNameEdit").val(patient.last_name);
      $("#ageEdit").val(patient.age);
      $("#wardEdit").val(patient.ward_id);
      $("#oncologistEdit").val(patient.oncologist_id);
      $("#sectionEdit").val(patient.section_id);

      // Show the edit modal
      $("#editPatientModal").modal("show");
    },
    error: function (xhr, status, error) {
      console.error("Error fetching patient data:", error);
    },
  });
}
