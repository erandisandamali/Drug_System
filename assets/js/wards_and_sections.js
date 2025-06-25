let wards;
let sections;
let selectedWardId;
let selectedWardName;

$(document).ready(function () {
  // Fetch wards and sections on page load
  fetchAllWards();
  fetchAllSections();
  populateWardsDropdownMenu();
  populateWardsDropdownMenuForEditSection();

  // Search functionality
  $("#wardSearch").keyup(function () {
    var searchText = $(this).val().toLowerCase();
    $("#wardTableBody tr").each(function () {
      var wardName = $(this).find("td:nth-child(1)").text().toLowerCase();
      if (wardName.includes(searchText)) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });

  $("#sectionSearch").keyup(function () {
    var searchText = $(this).val().toLowerCase();
    $("#sectionTableBody tr").each(function () {
      var sectionName = $(this).find("td:nth-child(1)").text().toLowerCase();
      if (sectionName.includes(searchText)) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });

  // Refresh wards when the refresh button is clicked
  $("#refreshAllButton").click(function () {
    $("#wardSearch").val("");
    $("#sectionSearch").val("");
    fetchAllWards();
    fetchAllSections();
    populateWardsDropdownMenu();
    $("#sectionTableHeader").text(`Sections for Selected Ward`);
    $("#sectionTableBody").empty();
    $("#addSectionButton").prop("disabled", true);
  });

  // Handle form submission for adding a ward
  $("#addWardBtn").click(function () {
    // Check if form is valid
    if ($("#addWardForm")[0].checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
      $("#addWardForm").addClass("was-validated");
      return;
    }

    // Get form data
    const wardName = $("#wardName").val();

    // Send AJAX request to save the ward
    $.ajax({
      url: "process/insert_ward.php",
      type: "POST",
      dataType: "json",
      data: { wardName: wardName },
      success: function (response) {
        // Handle success response
        swal
          .fire({
            icon: "success",
            title: "Success!",
            text: "The ward has been inserted successfully.",
            showConfirmButton: false,
            timer: 1500,
          })
          .then(() => {
            $("#addWardModal").modal("hide");
            fetchAllWards();
          });
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  });

  // Handle form submission for adding a section
  $("#submitSectionButton").click(function () {
    // Check if form is valid
    if ($("#addSectionForm")[0].checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
      $("#addSectionForm").addClass("was-validated");
      return;
    }

    // Get form data
    const sectionName = $("#sectionName").val();
    const wardId = $("#wardId").val();

    // Send AJAX request to save the section
    $.ajax({
      url: "process/insert_section.php",
      type: "POST",
      dataType: "json",
      data: { sectionName: sectionName, wardId: wardId },
      success: function (response) {
        // Handle success response
        swal
          .fire({
            icon: "success",
            title: "Success!",
            text: "The section has been inserted successfully.",
            showConfirmButton: false,
            timer: 1500,
          })
          .then(() => {
            $("#addSectionModal").modal("hide");
            fetchAllSections().then(() => {
              displaySections(wardId);
            });
          });
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  });

  // Reset form validation on modal close
  $("#addSectionModal").on("hidden.bs.modal", function () {
    $("#addSectionForm").removeClass("was-validated");
    $("#addSectionForm")[0].reset();
  });

  // Reset form validation on modal close
  $("#addWardModal").on("hidden.bs.modal", function () {
    $("#addWardForm").removeClass("was-validated");
    $("#addWardForm")[0].reset();
  });

  // Edit ward button click handler
  $("#wardTableBody").on("click", ".editWardButton", function () {
    var wardId = $(this).data("ward-id");
    editWard(wardId);
  });

  // Delete ward button click handler
  $("#wardTableBody").on("click", ".deleteWardButton", function () {
    const wardId = $(this).data("ward-id");
    confirmDeleteWard(wardId);
  });

  // Edit section button click handler
  $(document).on("click", ".editSectionButton", function () {
    const sectionId = $(this).data("section-id");
    editSection(sectionId);
  });

  // Delete section button click handler
  $(document).on("click", ".deleteSectionButton", function () {
    const sectionId = $(this).data("section-id");
    confirmDeleteSection(sectionId);
  });

  // Handle form submission for editing a ward
  $("#editWardBtn").click(function () {
    // Check if form is valid
    if ($("#editWardForm")[0].checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
      $("#editWardForm").addClass("was-validated");
      return;
    }

    // Get form data
    const wardId = $("#editWardId").val();
    const wardName = $("#editwardName").val();

    // Send AJAX request to update the ward
    $.ajax({
      url: "process/update_ward.php",
      type: "POST",
      dataType: "json",
      data: { wardId: wardId, wardName: wardName },
      success: function (response) {
        // Handle success response
        if (response.status) {
          // Display success message using SweetAlert
          swal
            .fire({
              icon: "success",
              title: "Success!",
              text: "Ward details updated successfully.",
              showConfirmButton: false,
              timer: 1500,
            })
            .then(() => {
              // Close the modal
              $("#editWardModal").modal("hide");
              fetchAllWards();
            });
        } else {
          console.log("Failed to update drug details.");
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
        // Optionally, display an error message to the user
      },
    });
  });

  // Reset form validation on modal close
  $("#editWardModal").on("hidden.bs.modal", function () {
    $("#editWardForm").removeClass("was-validated");
  });

  // Handle form submission for editing a section
  $("#saveSectionButton").click(function () {
    // Check if form is valid
    if ($("#editSectionForm")[0].checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
      $("#editSectionForm").addClass("was-validated");
      return;
    }

    // Get form data
    const sectionId = $("#editSectionId").val();
    const wardId = $("#editSectionwardId").val();
    const sectionName = $("#editSectionName").val();

    // Send AJAX request to update the section
    $.ajax({
      url: "process/update_section.php",
      type: "POST",
      dataType: "json",
      data: { sectionId: sectionId, wardId: wardId, sectionName: sectionName },
      success: function (response) {
        // Display success message using SweetAlert
        swal
          .fire({
            icon: "success",
            title: "Success!",
            text: "Section details updated successfully.",
            showConfirmButton: false,
            timer: 1500,
          })
          .then(() => {
            // Close the modal
            $("#editSectionModal").modal("hide");
            fetchAllSections().then(() => {
              displaySections(wardId);
            });
          });
      },
      error: function (xhr, status, error) {
        // Log the full responseText for debugging purposes
        console.error("XHR status:", xhr.status);
        console.error("XHR responseText:", xhr.responseText);
        console.error("Status:", status);
        console.error("Error:", error);
        //display a user-friendly error message
        swal.fire({
          icon: "error",
          title: "Error!",
          text: "An error occurred while updating the section. Please try again later.",
        });
      },
    });
  });
});

function fetchAllWards() {
  $.ajax({
    url: "process/fetch_all_wards.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      if (!data.error) {
        wards = data; // Assign data to wards variable
        displayWards(wards); // Display wards in the table
      }
    },
    error: function (xhr, status, error) {
      console.error("Error fetching wards:", error);
    },
  });
}

function fetchAllSections() {
  return $.ajax({
    url: "process/fetch_all_sections.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      if (!data.error) {
        sections = data; // Assign data to sections variable
      }
    },
    error: function (xhr, status, error) {
      console.error("Error fetching sections:", error);
    },
  });
}

// Function to display wards in the table
function displayWards(data) {
  const wardTableBody = $("#wardTableBody");
  wardTableBody.empty();
  data.forEach((ward) => {
    const row = $("<tr>").append(
      $("<td>").text(ward.ward_name),
      $("<td>").append(
        $("<button>")
          .addClass("btn btn-primary btn-sm selectButton")
          .html('<i class="fas fa-hand-pointer"></i>')
          .attr("data-ward-id", ward.id)
          .click(() => {
            displaySections(ward.id);
            selectedWardId = ward.id;
            selectedWardName = ward.ward_name;
          }),
        $("<button>")
          .addClass("btn btn-warning btn-sm editWardButton")
          .html('<i class="fas fa-edit"></i>')
          .attr("data-ward-id", ward.id),
        $("<button>")
          .addClass("btn btn-danger btn-sm deleteWardButton")
          .html('<i class="fas fa-trash-alt"></i>')
          .attr("data-ward-id", ward.id)
      )
    );
    wardTableBody.append(row);
  });
}

// Function to display sections for a selected ward
function displaySections(wardId) {
  $("#sectionTableHeader").text(
    `Sections for Selected Ward - ${selectedWardName}`
  );
  $("#wardId").val(selectedWardId);
  // Enable the "Add Section" button
  $("#addSectionButton").prop("disabled", false);
  const sectionTableBody = $("#sectionTableBody");
  sectionTableBody.empty();
  const sectionsForWard = sections.filter(
    (section) => section.ward_id === wardId
  );
  if (sectionsForWard.length > 0) {
    sectionsForWard.forEach((section) => {
      const row = $("<tr>").append(
        $("<td>").text(section.section_name),
        $("<td>").append(
          $("<button>")
            .addClass("btn btn-warning btn-sm editSectionButton")
            .html('<i class="fas fa-edit"></i>')
            .attr("data-section-id", section.id),
          $("<button>")
            .addClass("btn btn-danger btn-sm deleteSectionButton")
            .html('<i class="fas fa-trash-alt"></i>')
            .attr("data-section-id", section.id)
        )
      );
      sectionTableBody.append(row);
    });
  } else {
    const row = $("<tr>").append(
      $("<td>").append(
        $("<div>")
          .addClass("alert alert-warning text-center") // Add Bootstrap alert classes
          .attr("role", "alert")
          .text(`No sections found for ward - ${selectedWardName}!`)
      )
    );

    sectionTableBody.append(row);
  }
}

// Function to fetch wards & populate the dropdown menu on the add section modal
function populateWardsDropdownMenu() {
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
        $("#wardId").html(options); // Update the ward select options
      } else {
        // Handle case where no wards are returned
        console.error("No wards found.");
      }
    },
    error: function (xhr, status, error) {
      // Provide user-facing feedback in case of error
      console.error("Error fetching wards:", error);
      $("#wardId").html(
        '<option selected disabled value="">Error fetching data</option>'
      );
    },
  });
}

// Function to fetch wards & populate the dropdown menu on the edit section modal
function populateWardsDropdownMenuForEditSection() {
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
        $("#editSectionwardId").html(options); // Update the ward select options
      } else {
        // Handle case where no wards are returned
        console.error("No wards found.");
      }
    },
    error: function (xhr, status, error) {
      // Provide user-facing feedback in case of error
      console.error("Error fetching wards:", error);
      $("#editSectionwardId").html(
        '<option selected disabled value="">Error fetching data</option>'
      );
    },
  });
}

function editWard(wardId) {
  // Populate modal with existing ward details
  populateEditWardModal(wardId);
  // Show the edit ward modal
  $("#editWardModal").modal("show");
}

// Function to confirm deletion using SweetAlert
function confirmDeleteWard(wardId) {
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
      deleteWard(wardId);
    }
  });
}

function confirmDeleteSection(sectionId) {
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
      deleteSection(sectionId);
    }
  });
}

function deleteWard(wardId) {
  // If confirmed, send an AJAX request to delete the ward
  $.ajax({
    url: "process/delete_ward.php",
    type: "POST",
    data: {
      id: wardId,
    },
    success: function (response) {
      // Display success message using SweetAlert
      Swal.fire({
        icon: "success",
        title: "Success!",
        text: "Ward has been deleted successfully.",
        showConfirmButton: false,
        timer: 1500,
      }).then(() => {
        // Update the UI to reflect the changes
        fetchAllWards();
      });
    },
    error: function (xhr, status, error) {
      console.error("Error deleting ward:", error);
    },
  });
}

function deleteSection(sectionId) {
  // If confirmed, send an AJAX request to delete the ward
  $.ajax({
    url: "process/delete_section.php",
    type: "POST",
    data: {
      id: sectionId,
    },
    success: function (response) {
      // Display success message using SweetAlert
      Swal.fire({
        icon: "success",
        title: "Success!",
        text: "Section has been deleted successfully.",
        showConfirmButton: false,
        timer: 1500,
      }).then(() => {
        // Update the UI to reflect the changes
        fetchAllSections().then(() => {
          displaySections(selectedWardId);
        });
      });
    },
    error: function (xhr, status, error) {
      console.error("Error deleting ward:", error);
    },
  });
}

function editSection(sectionId) {
  // Populate the edit section modal with the fetched details
  populateEditSectionModal(sectionId);
  // Show the edit section modal
  $("#editSectionModal").modal("show");
}

// Function to populate edit ward modal with details
function populateEditWardModal(wardId) {
  $.ajax({
    url: "process/fetch_ward_details_by_id.php",
    type: "GET",
    dataType: "json",
    data: {
      id: wardId,
    },
    success: function (data) {
      // Check if data is retrieved successfully
      if (data && data.length > 0) {
        // Populate the inputs in the modal with the retrieved ward details
        $("#editWardId").val(data[0].id);
        $("#editwardName").val(data[0].ward_name);
      } else {
        // If no data is retrieved, show an error message or handle it accordingly
        console.error("No drug details found for drug ID: " + wardId);
      }
    },
    error: function (xhr, status, error) {
      // Handle error response
      console.error("Error fetching drug details:", error);
    },
  });
}

// Function to populate edit section drug modal with details
function populateEditSectionModal(sectionId) {
  $.ajax({
    url: "process/fetch_section_details_by_id.php",
    type: "GET",
    dataType: "json",
    data: {
      id: sectionId,
    },
    success: function (data) {
      // Check if data is retrieved successfully
      if (data && data.length > 0) {
        // Populate the inputs in the modal with the retrieved section details
        $("#editSectionId").val(data[0].id);
        $("#editSectionwardId").val(data[0].ward_id);
        $("#editSectionName").val(data[0].section_name);
      } else {
        // If no data is retrieved, show an error message or handle it accordingly
        console.error("No drug details found for drug ID: " + sectionId);
      }
    },
    error: function (xhr, status, error) {
      // Handle error response
      console.error("Error fetching drug details:", error);
    },
  });
}
