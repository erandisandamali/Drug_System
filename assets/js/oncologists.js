$(document).ready(function () {
  fetchAllOncologists();

  $("#oncologistSearch").keyup(function () {
    var searchText = $(this).val().toLowerCase(); // Get the search text
    // Loop through each row in the table
    $("#oncologistTableBody tr").each(function () {
      var oncologistName = $(this).find("td:nth-child(1)").text().toLowerCase();
      // Check if the drug name contains the search text
      if (oncologistName.includes(searchText)) {
        $(this).show(); // If yes, show the row
      } else {
        $(this).hide(); // If not, hide the row
      }
    });
  });

  $("#refreshButton").click(function () {
    $("#oncologistSearch").val("");
    fetchAllOncologists();
  });

  // Handle form submission for adding a new oncologist
  $("#submitBtn").click(function () {
    // Check if form is valid using Bootstrap validation
    if ($("#addOncologistForm")[0].checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
      $("#addOncologistForm").addClass("was-validated");
      return;
    }

    // Get form data
    const title = $("#oncologistTitle").val();
    const firstName = $("#firstNameInput").val();
    const lastName = $("#lastNameInput").val();

    // AJAX request to add the new oncologist
    $.ajax({
      url: "process/insert_oncologist.php",
      type: "POST",
      dataType: "json",
      data: { firstName: firstName, lastName: lastName, title: title },
      success: function (response) {
        // Display success message using SweetAlert
        swal
          .fire({
            icon: "success",
            title: "Success!",
            text: "The oncologist has been inserted successfully.",
            showConfirmButton: false,
            timer: 1500,
          })
          .then(() => {
            //close the modal
            $("#addOncologistModal").modal("hide");
            // Clear the form inputs
            $("#addOncologistForm")[0].reset();
            fetchAllOncologists();
          });
      },
      error: function (xhr, status, error) {
        // Log the full responseText for debugging purposes
        console.error("XHR status:", xhr.status);
        console.error("XHR responseText:", xhr.responseText);
        console.error("Status:", status);
        console.error("Error:", error);
        // Display a user-friendly error message
        swal.fire({
          icon: "error",
          title: "Error!",
          text: "An error occurred while adding the oncologist. Please try again later.",
        });
      },
    });
  });

  // Event delegation for delete buttons
  $("#oncologistTableBody").on("click", ".deleteButton", function () {
    var oncologistId = $(this).data("oncologist-id");
    confirmDeleteDrug(oncologistId);
  });

  // Event delegation for edit buttons
  $("#oncologistTableBody").on("click", ".editButton", function () {
    var oncologistId = $(this).data("oncologist-id");
    populateEditOncologistModal(oncologistId);
    $("#editOncologistModal").modal("show");
  });

  $("#saveBtn").click(function () {
    event.preventDefault();
    event.stopPropagation();
    // Perform manual validation
    if ($("#editOncologistForm")[0].checkValidity() === false) {
      // If the form is invalid, add the Bootstrap was-validated class to display validation messages
      $("#editOncologistForm").addClass("was-validated");
    } else {
      // If the form is valid, proceed with form submission
      submitForm();
    }
  });
});

function fetchAllOncologists() {
  $.ajax({
    url: "process/fetch_all_oncologists.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      if (!data.error) {
        populateOncologistTable(data);
      }
    },
    error: function (xhr, status, error) {
      console.error("Error:", error);
    },
  });
}

function populateOncologistTable(data) {
  // Clear the table body
  $("#oncologistTableBody").empty();

  // Loop through each drug and populate the table
  data.forEach((oncologist) => {
    const row = `<tr>
                  <td>${oncologist.title} ${oncologist.first_name} ${oncologist.last_name}</td>
                  <td>
                  <div class="btn-group" role="group">
      <button type="button" class="btn btn-warning btn-sm editButton" data-oncologist-id="${oncologist.id}">
          <i class="fas fa-edit"></i> 
      </button>
      <button type="button" class="btn btn-danger btn-sm deleteButton" data-oncologist-id="${oncologist.id}">
      <i class="fas fa-trash-alt"></i>
  </button>
  
  </div>
  
                  </td>
              </tr>`;
    $("#oncologistTableBody").append(row);
  });
}

// Function to confirm deletion using SweetAlert
function confirmDeleteDrug(oncologistId) {
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
      // If user confirms deletion
      deleteOncologist(oncologistId);
    }
  });
}

function deleteOncologist(oncologistId) {
  // Send AJAX request
  $.ajax({
    url: "process/delete_oncologist.php",
    type: "POST",
    data: {
      id: oncologistId,
    },
    success: function (response) {
      // Display success message using SweetAlert
      Swal.fire({
        icon: "success",
        title: "Success!",
        text: "OncologistId has been deleted successfully.",
        showConfirmButton: false,
        timer: 1500,
      }).then(() => {
        fetchAllOncologists();
      });
    },
    error: function (xhr, status, error) {
      // Handle error response
      console.error("Error deleting oncologist:", error);
    },
  });
}

function populateEditOncologistModal(oncologistId) {
  $.ajax({
    url: "process/fetch_oncologist_details_by_id.php",
    type: "GET",
    dataType: "json",
    data: {
      id: oncologistId,
    },
    success: function (data) {
      // Check if data is retrieved successfully
      if (data && data.length > 0) {
        $("#editOncologistId").val(data[0].id);
        $("#editOncologistTitle").val(data[0].title);
        $("#editFirstNameInput").val(data[0].first_name);
        $("#editLastNameInput").val(data[0].last_name);
      } else {
        // If no data is retrieved, show an error message or handle it accordingly
        console.error("No drug details found for drug ID: " + oncologistId);
      }
    },
    error: function (xhr, status, error) {
      // Handle error response
      console.error("Error fetching oncologist details:", error);
    },
  });
}

// Function to submit the form via AJAX
function submitForm() {
  // Get form data
  var editOncologistId = $("#editOncologistId").val();
  var editOncologistTitle = $("#editOncologistTitle").val();
  var editFirstName = $("#editFirstNameInput").val();
  var editLastName = $("#editLastNameInput").val();

  // Send AJAX request to save data
  $.ajax({
    url: "process/update_oncologist.php",
    type: "POST",
    dataType: "json",
    data: {
      oncologistId: editOncologistId,
      firstName: editFirstName,
      lastName: editLastName,
      title: editOncologistTitle,
    },
    success: function (response) {
      // Display success message using SweetAlert
      swal
        .fire({
          icon: "success",
          title: "Success!",
          text: "The oncologist has been updated successfully.",
          showConfirmButton: false,
          timer: 1500,
        })
        .then(() => {
          // Close the modal
          $("#editOncologistModal").modal("hide");
          fetchAllOncologists();
        });
    },
    error: function (xhr, status, error) {
      // Log the full responseText for debugging purposes
      console.error("XHR status:", xhr.status);
      console.error("XHR responseText:", xhr.responseText);
      console.error("Status:", status);
      console.error("Error:", error);
      // Display a user-friendly error message
      swal.fire({
        icon: "error",
        title: "Error!",
        text: "An error occurred while updating the oncologist. Please try again later.",
      });
    },
  });
}
