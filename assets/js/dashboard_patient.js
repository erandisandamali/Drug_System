var createdDrugDetailsChart = null;
var pieChart = null;
var drugTypeChart = null;

$(document).ready(function () {
  fetchCreaetedData();
  // Set up event listener for filter changes
  $("#filter-select").on("change", function () {
    var selectedFilter = $(this).val();
    fetchDataForCreatedDrugDetailsChart(selectedFilter);
  });

  // Initialize charts with default filter (day)
  fetchDataForCreatedDrugDetailsChart("day");
  displayPieChart();
  displayDrugTypeChart();
});

// Function to fetch data using AJAX
function fetchCreaetedData() {
  $.ajax({
    url: "process/fetch_created_list.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      if (data.length > 0 && !data[0].error) {
        // Sort the data array by created_at property in descending order
        data.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

        // Get the first ten elements from the sorted array
        var firstFive = data.slice(0, 5);
        displayCreatedList(firstFive);
      } else {
        $("#createdListBody").html(`
                <tr>
                    <td colspan="12">
                        <div class="alert alert-danger text-center" role="alert">
                            No Record found!
                        </div>       
                    </td>
                </tr>`);
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
      $("#createdListBody").html(`
                <tr>
                    <td colspan="12">
                        <div class="alert alert-danger text-center" role="alert">
                            Something went wrong!
                        </div>       
                    </td>
                </tr>`);
    },
  });
}

// Function to display created list as a table on the page
function displayCreatedList(items) {
  const createdList = $("#createdListBody");
  createdList.empty();

  items.forEach((item) => {
    const row = `<tr>
            <td>${item.id}</td>
            <td>${item.first_name} ${item.last_name}</td>
            <td>${item.drug_name}</td>
            <td>${item.strength}</td>
            <td>${item.solution}</td>
            <td>${item.volume}</td>
            <td>${item.location}</td>
            <td>${item.duration_type}</td>
            <td>${item.dosage}</td>
            <td>${item.created_at}</td>
        </tr>`;
    createdList.append(row);
  });
}

// Function to fetch data and display the Created Drug Details chart with filter
function fetchDataForCreatedDrugDetailsChart(filter) {
  $.ajax({
    url: "process/get_created_list_statistics.php",
    type: "GET",
    data: { filter: filter },
    dataType: "json",
    success: function (data) {
      // Extract dates and count per date from the fetched data
      var dates = data.dates;
      var countPerDate = data.countPerDate;

      // Destroy the previous chart if it exists
      if (createdDrugDetailsChart) {
        createdDrugDetailsChart.destroy();
      }

      // Bar Chart

    },
    error: function (xhr, status, error) {
      console.error("Error fetching data:", error);
    },
  });
}

function displayPieChart() {
  // Fetch data from PHP script
  $.ajax({
    url: "process/get_wards_statistics.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      // Check if data contains any errors
      if (data.error) {
        console.error("Error fetching data:", data.error);
        return;
      }

      // Extract ward names and patient counts from the fetched data
      var wardLabels = [];
      var patientCounts = [];
      data.forEach(function (wardData) {
        wardLabels.push(wardData.ward_name);
        patientCounts.push(wardData.patient_count);
      });

      // Destroy the previous chart if it exists
      if (pieChart) {
        pieChart.destroy();
      }


    },
    error: function (xhr, status, error) {
      console.error("Error fetching data:", error);
    },
  });
}

function displayDrugTypeChart() {
  // Fetch data from PHP script
  $.ajax({
    url: "process/get_drug_statistics.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      // Extract drug type labels and drug counts from the fetched data
      var drugTypeLabels = data.drugTypeLabels;
      var drugCounts = data.drugCounts;

      // Destroy the previous chart if it exists
      if (drugTypeChart) {
        drugTypeChart.destroy();
      }

      // Pie Chart

    },
    error: function (xhr, status, error) {
      console.error("Error fetching data:", error);
    },
  });
}
