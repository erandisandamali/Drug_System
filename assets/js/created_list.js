$(document).ready(function () {
  // Call fetchData function on document ready
  fetchData();

  // Search
  $("#searchByName").keyup(function () {
    var searchText = $(this).val().toLowerCase();

    $("#createdListBody tr").each(function () {
      var name = $(this).find("td:nth-child(2)").text().toLowerCase();
      if (name.includes(searchText)) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });

  // Function to filter data based on creation date
  $("#filterDate").on("change", function () {
    var selectedDate = $(this).val();
    // Convert the date to ISO format
    var isoDate = new Date(selectedDate).toISOString().split("T")[0];

    // Loop through each row in the table body
    $("#createdListBody tr").each(function () {
      var createdAt = $(this).find("td:eq(9)").text(); // Assuming the created at column is at index 9

      // Compare the creation date with the selected date
      if (createdAt.trim().startsWith(isoDate)) {
        $(this).show(); // Show the row if the dates match
      } else {
        $(this).hide(); // Hide the row if the dates don't match
      }
    });
  });

  $("#refreshButton").click(function () {
    $("#searchByName").val("");
    $("#filterDate").val("");
    fetchData();
  });

  $(document).on("click", ".view-details-btn", function () {
    var id = $(this).data("id");
    fetchCreateDetails(id);
  });

  $(document).on("click", ".print-details-btn", function () {
    var id = $(this).data("id");
    fetchCreateDetailsToLabel(id);
    $("#printLabelModal").modal("show");
  });

  $("#btnPdfLabel").click(function () {
    // Prepare JSON data from UI elements
    var jsonData = {
      referenceId: $("#referenceId").text(),
      route: $("#route").text(),
      drugName: $("#drugName").text(),
      strength: $("#strength").text(),
      solution: $("#solution").text(),
      volume: $("#volume").text(),
    };

    // Send an AJAX request to the PHP script
    $.ajax({
      url: "process/generate_pdf_of_label.php",
      type: "POST",
      data: {
        jsonData: JSON.stringify(jsonData),
      }, // Send JSON data as a string
      success: function (response) {
        // Response should contain the URL of the generated PDF
        // console.log('Generated PDF URL:', response);
        // redirect the user to the generated PDF URL
        window.open(response, "_blank");
      },
      error: function (xhr, status, error) {
        console.error("Error:", status, error);
      },
    });
  });
});

//click the delete button
$(document).on("click", ".delete-btn", function () {
  var id = $(this).data("id");
  // sweete alert to confirm deletion
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
      // delete drug
      deleteCreateDetail(id);
    }
  });
});

// Function to delete drug
function deleteCreateDetail(id) {
  $.ajax({
    url: "process/delete_created_detail.php",
    type: "POST",
    data: {
      id: id,
    },
    success: function (response) {
      // Display success message using SweetAlert
      Swal.fire({
        icon: "success",
        title: "Success!",
        text: "Record has been deleted successfully.",
        showConfirmButton: false,
        timer: 1500,
      }).then(() => {
        // update the patient list
        fetchData();
      });
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    },
  });
}

// Function to fetch data using AJAX
function fetchData() {
  $.ajax({
    url: "process/fetch_created_list.php", // URL to fetch data
    type: "GET",
    dataType: "json",
    success: function (data) {
      if (data.length == 0) {
        $("#createdListBody").html(
          '<tr class="mt-2 alert alert-danger text-center" role="alert"><td colspan="12">No records found!</td></tr>'
        );
      } else {
        displayCreatedList(data);
      }
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
      $("#createdListBody").html(
        '<tr class="mt-2 alert alert-danger text-center" role="alert"><td colspan="12">Error fetching data!</td></tr>'
      );
    },
  });
}

// function to populate the created list
function displayCreatedList(data) {
  const patientDetailsBody = $("#createdListBody");
  patientDetailsBody.empty();
  $.each(data, function (index, item) {
    const row = `<tr>
                <td>${item.id}</td>
                <td>${item.first_name} ${item.last_name}</td>
                <td>${item.route}</td>
                <td>${item.drug_name}</td>
                <td>${item.strength}</td>
                <td>${item.solution}</td>
                <td>${item.volume}</td>
                <td>${item.location}</td>
                <td>${item.duration_type}</td>
                <td>${item.dosage}</td>
                <td>${item.created_at}</td>
                <td>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary view-details-btn btn-sm" data-id="${item.id}" data-bs-toggle="modal" data-bs-target="#viewCreateDetailsModal"><i class="fas fa-eye"></i></button>
                        <button type="button" class="btn btn-danger delete-btn btn-sm" data-id="${item.id}"><i class="fas fa-trash-alt"></i></button>
                        
                        <button type="button" class="btn btn-success print-details-btn btn-sm" data-id="${item.id}">
<i class="fas fa-tag"></i>
</i>
</button>
                    </div>
                </td>
            </tr>`;
    patientDetailsBody.append(row);
  });
}

// Function to fetch create details
function fetchCreateDetails(id) {
  $.ajax({
    url: "process/fetch_create_details.php",
    type: "GET",
    data: {
      id: id,
    },
    success: function (response) {
      // Check if response contains error
      if (response.hasOwnProperty("error")) {
        // Display error message
        console.log(response.error);
        return;
      }
      populateDeailsToViewModal(response);
    },
    error: function (xhr, status, error) {
      // Display error message
      console.error("Error:", error);
    },
  });
}

// Function to fetch create details
function fetchCreateDetailsToLabel(id) {
  $.ajax({
    url: "process/fetch_create_details.php",
    type: "GET",
    data: {
      id: id,
    },
    success: function (response) {
      // Check if response contains error
      if (response.hasOwnProperty("error")) {
        // Display error message
        console.log(response.error);
        return;
      }
      populateLabelDetails(response);
    },
    error: function (xhr, status, error) {
      // Display error message
      console.error("Error:", error);
    },
  });
}

function populateDeailsToViewModal(response) {
  // Populate modal elements with data

  $("#phnNumber").text(response[0].phn || "not provided");
  $("#bhtNumber").text(response[0].bht_number || "not provided");
  $("#clinicNumber").text(response[0].clinic_number || "not provided");
  $("#patientName").text(
    `${response[0].title}. ${response[0].patient_first_name} ${response[0].patient_last_name}`
  );
  $("#age").text(response[0].age);
  $("#gender").text(response[0].gender);
  $("#ward").text(response[0].ward_name);
  $("#section").text(response[0].section_name);
  $("#oncologist").text(
    `${response[0].oncologist_first_name} ${response[0].oncologist_last_name}`
  );

  // Populate drug details table
  var drugDetailBody = $("#drugDetailBody");
  drugDetailBody.empty(); // Clear previous data

  // Iterate over drug data and append rows to the table
  response.forEach(function (drug) {
    const row = `<tr>
      <td>${drug.id}</td>
      <td>${drug.route}</td>
      <td>${drug.type}</td>
      <td>${drug.drug_name}</td>
      <td>${drug.strength}</td>
      <td>${drug.solution}</td>
      <td>${drug.volume}</td>
      <td>${drug.location}</td>
      <td>${drug.duration_type}</td>
      <td>${drug.dosage}</td>
      <td>${drug.created_at}</td>
    </tr>`;
    drugDetailBody.append(row);
  });
}

function populateLabelDetails(response) {
  // Assuming response is an array of objects
  // Iterate over the response data, assuming it's an array of objects
  response.forEach(function (data) {
    // Populate the input fields with the received data
    $("#referenceId").text(data.id);
    $("#patientName").text(
      `${data.patient_title}. ${data.patient_first_name} ${data.patient_last_name}`
    );
    $("#ward").text(data.ward_name);
    $("#section").text(data.section_name);
    $("#oncologist").text(
      `${data.oncologist_title}. ${data.oncologist_first_name} ${data.oncologist_last_name}`
    );
    $("#phn").text(data.phn || "not provided");
    $("#clinicNumber").text(data.clinic_number || "not provided");
    $("#bhtNumber").text(data.bht_number || "not provided");
    $("#drugName").text(data.drug_name);
    $("#drugType").text(data.type);
    $("#strength").text(data.strength);
    $("#volume").text(data.volume);
    $("#location").text(data.location);
    $("#dosage").text(data.dosage);
    $("#route").text(data.route);
    $("#createdAt").text(data.created_at);
    $("#solution").text(data.solution);
    $("#durationType").text(data.duration_type);
  });
}
