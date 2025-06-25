$(document).ready(function () {
  fetchAllDrugs();
  fetchDrugTypes();
  populateDrugTypesForEditModal();

  $("#drugSearch").keyup(function () {
    var searchText = $(this).val().toLowerCase(); // Get the search text

    // Loop through each row in the table
    $("#drugTableBody tr").each(function () {
      var drugName = $(this).find("td:nth-child(3)").text().toLowerCase(); // Get the drug name in this row

      // Check if the drug name contains the search text
      if (drugName.includes(searchText)) {
        $(this).show(); // If yes, show the row
      } else {
        $(this).hide(); // If not, hide the row
      }
    });
  });

  // Event listener for changes on the drug type filter dropdown
  $("#drugTypeFilter").on("change", function () {
    // Get the selected drug type
    var selectedType = $(this).val();

    // Check if a drug type is selected
    if (selectedType !== "") {
      // Hide all table rows
      $("#drugTableBody tr").hide();

      // Loop through each table row
      $("#drugTableBody tr").each(function () {
        // Get the text of the first column in this row
        var drugType = $(this).find("td:first").text().trim();
        // Check if the drug type matches the selected type
        if (drugType === selectedType) {
          $(this).show(); // If yes, show the row
        }
      });
    } else {
      // If no drug type is selected, show all table rows
      $("#drugTableBody tr").show();
    }
  });

  $("#refreshButton").click(function () {
    $("#drugSearch").val("");
    fetchAllDrugs();
  });

  // Event delegation for delete buttons
  $("#drugTableBody").on("click", ".deleteButton", function () {
    var itemId = $(this).data("drug-id");
    confirmDeleteDrug(itemId);
  });

  // Event delegation for edit buttons
  $("#drugTableBody").on("click", ".editButton", function () {
    var drugId = $(this).data("drug-id");
    // Store drug ID in modal data
    $("#editDrugModal").data("drugId", drugId);
    // Populate modal with existing drug details
    populateEditDrugModal(drugId);
    // Show the edit modal
    $("#editDrugModal").modal("show");
  });

  // When the "Submit" button is clicked
  $("#btnAddDrug").click(function () {
    var form = $(".needs-validation")[0];
    if (form.checkValidity() === false) {
      event.stopPropagation(); // Stop event propagation
      $(form).addClass("was-validated");
      return;
    }

    // Retrieve drug details from form fields
    var drugTypeId = $("#drugType").val();
    var srNumber = $("#srNumber").val();
    var drugName = $("#drugName").val();

    // Send AJAX request to insert drug details
    $.ajax({
      url: "process/insert_drug.php",
      type: "POST",
      dataType: "json", // Ensure that the response is parsed as JSON
      data: {
        drugTypeId: drugTypeId,
        srNumber: srNumber,
        drugName: drugName,
      },
      success: function (response) {
        // Check if the insertion was successful
        if (response.status === "success") {
          // Display success message using SweetAlert
          swal
            .fire({
              icon: "success",
              title: "Success!",
              text: "The record has been inserted successfully.",
              showConfirmButton: false,
              timer: 1500,
            })
            .then(() => {
              // close the modal after successful submission
              $("#addDrugModal").modal("hide");

              // Clear form inputs and errors
              form.reset(); // Reset form inputs
              $(form).removeClass("was-validated"); // Remove validation classes

              fetchAllDrugs();
            });
        } else {
          console.log("Error inserting drug details: " + response.message);
        }
      },
      error: function (xhr, status, error) {
        console.error("Error inserting drug details:", error);
      },
    });
  });

  //Function to save edited drug details
  $("#btnEditDrug").click(function () {
    // Validate form fields
    if ($("#editDrugModal .needs-validation")[0].checkValidity() === false) {
      $("#editDrugModal .needs-validation").addClass("was-validated");
      return;
    }

    // Prepare data for submission
    var drugData = {
      id: $("#editDrugModal").data("drugId"),
      type_id: $("#editDrugType").val(),
      sr_number: $("#editSrNumber").val(),
      name: $("#editDrugName").val(),
    };

    // Make an AJAX request to update drug details
    $.ajax({
      url: "process/update_drug_details.php", // Replace with actual URL
      type: "POST",
      data: drugData,
      success: function (response) {
        // Check the response from the server
        if (response.status) {
          // Display success message using SweetAlert
          swal
            .fire({
              icon: "success",
              title: "Success!",
              text: "Drug details updated successfully.",
              showConfirmButton: false,
              timer: 1500,
            })
            .then(() => {
              // Close the modal
              $("#editDrugModal").modal("hide");
              // Optionally, refresh the drug list or update the UI accordingly
              fetchAllDrugs();
            });
        } else {
          console.log("Failed to update drug details.");
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX error:", error); // Check for any AJAX errors
        console.log(xhr.responseText); // Log the response text for further inspection
        console.log("An error occurred while updating drug details.");
      },
    });
  });
});

// Function to confirm deletion using SweetAlert
function confirmDeleteDrug(drugId) {
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
      deleteDrug(drugId);
    }
  });
}

// Function to fetch drug types
function fetchDrugTypes() {
  $.ajax({
    url: "process/fetch_drug_types.php",
    type: "GET",
    dataType: "json",
    success: function (drugTypes) {
      let options = '<option selected disabled value="">Choose...</option>';
      drugTypes.forEach((drugType) => {
        options += `<option value="${drugType.id}">${drugType.type}</option>`;
      });
      $("#drugType").html(options); // Update the ward select options
    },
    error: function (xhr, status, error) {
      console.error("Error fetching drug types:", error);
    },
  });
}

function populateDrugTypesForEditModal() {
  $.ajax({
    url: "process/fetch_drug_types.php",
    type: "GET",
    dataType: "json",
    success: function (drugTypes) {
      let options = '<option selected disabled value="">Choose...</option>';
      drugTypes.forEach((drugType) => {
        options += `<option value="${drugType.id}">${drugType.type}</option>`;
      });
      $("#editDrugType").html(options); // Update the ward select options
    },
    error: function (xhr, status, error) {
      console.error("Error fetching drug types:", error);
    },
  });
}

// function to delete drug
function deleteDrug(drugId) {
  // Send AJAX request
  $.ajax({
    url: "process/delete_drug.php",
    type: "POST",
    data: {
      id: drugId,
    },
    success: function (response) {
      // Display success message using SweetAlert
      Swal.fire({
        icon: "success",
        title: "Success!",
        text: "Drug has been deleted successfully.",
        showConfirmButton: false,
        timer: 1500,
      }).then(() => {
        // update the patient list
        fetchAllDrugs();
      });
    },
    error: function (xhr, status, error) {
      // Handle error response
      console.error("Error deleting patient:", error);
    },
  });
}

function fetchAllDrugs() {
  $.ajax({
    url: "process/fetch_all_drugs.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      if (!data.error) {
        populateDrugTable(data);
      }
    },
    error: function (xhr, status, error) {
      console.error("Error:", error);
    },
  });
}

function populateDrugTable(data) {
  // Clear the table body
  $("#drugTableBody").empty();

  // Loop through each drug and populate the table
  data.forEach((drug) => {
    const row = `<tr>
                <td>${drug.type}</td>
                <td>${drug.srs_number}</td>
                <td>${drug.drug_name}</td>
                <td>
                <div class="btn-group" role="group">
    <button type="button" class="btn btn-warning btn-sm editButton" data-drug-id="${drug.id}">
        <i class="fas fa-edit"></i> 
    </button>
    <button type="button" class="btn btn-danger btn-sm deleteButton" data-drug-id="${drug.id}">
    <i class="fas fa-trash-alt"></i>
</button>

</div>

                </td>
            </tr>`;
    $("#drugTableBody").append(row);
  });
}

// Function to populate edit drug modal with drug details
function populateEditDrugModal(drugId) {
  $.ajax({
    url: "process/fetch_drug_details.php",
    type: "GET",
    dataType: "json",
    data: {
      id: drugId,
    },
    success: function (data) {
      // Check if data is retrieved successfully
      if (data && data.length > 0) {
        // Populate the inputs in the modal with the retrieved drug details
        $("#editDrugType").val(data[0].drug_type_id);
        $("#editSrNumber").val(data[0].srs_number);
        $("#editDrugName").val(data[0].drug_name);
      } else {
        // If no data is retrieved, show an error message or handle it accordingly
        console.error("No drug details found for drug ID: " + drugId);
      }
    },
    error: function (xhr, status, error) {
      // Handle error response
      console.error("Error fetching drug details:", error);
    },
  });
}
