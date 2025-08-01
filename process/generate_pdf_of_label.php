<?php
require_once '../assets/tcpdf/tcpdf.php'; // Include TCPDF library

// Function to generate PDF label
function generatePDF($jsonData) {
	// Decode JSON data
	$data = json_decode($jsonData, true);

	// Extract data from JSON
	$referenceId = isset($data['referenceId']) ? $data['referenceId'] : '';
	$drugName = isset($data['drugName']) ? $data['drugName'] : '';
	$strength = isset($data['strength']) ? $data['strength'] : '';
	$volume = isset($data['volume']) ? $data['volume'] : '';
	$route = isset($data['route']) ? $data['route'] : '';
	$solution = isset($data['solution']) ? $data['solution'] : '';

	// Get current date and time
	$currentDateTime = date('Ymd_His');

	// Generate a unique filename based on referenceID and current date-time
	$filename = $referenceId . '_' . $currentDateTime . '_label.pdf';

	// Specify the directory path to save the PDF
	$directory = __DIR__ . '/../generated-labels/';

	// Create the directory if it doesn't exist
	if (!file_exists($directory)) {
		mkdir($directory, 0777, true);
	}

	// Set the full file path
	$pdf_file_path = $directory . $filename;

	// Initialize TCPDF
	$pdf = new TCPDF('P', 'mm', 'A7', true, 'UTF-8', false);

	// Set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetTitle('Prescription Label');

	// Set default font
	$pdf->SetFont('helvetica', '', 8); // Decreased font size to 8

	// Add a page
	$pdf->AddPage();

	// Set cell padding
	$pdf->setCellPaddings(1, 1, 1, 1); // Decreased padding

	// Set background color
	$pdf->SetFillColor(255, 255, 255); // White

	// Title
	$pdf->Cell(0, 10, 'Prescription Label', 0, 1, 'C', true);
	$pdf->Ln(2); // Decreased line break space

	// Data Fields
	$pdf->Cell(40, 5, 'Reference ID:', 0, 0);
	$pdf->Cell(0, 5, $referenceId, 0, 1);

	$pdf->Cell(40, 5, 'Route:', 0, 0);
	$pdf->Cell(0, 5, $route, 0, 1);

	$pdf->Cell(40, 5, 'Drug Name:', 0, 0);
	$pdf->Cell(0, 5, $drugName, 0, 1);

	$pdf->Cell(40, 5, 'Strength:', 0, 0);
	$pdf->Cell(0, 5, $strength, 0, 1);

	$pdf->Cell(40, 5, 'Diluent:', 0, 0);
	$pdf->Cell(0, 5, $solution, 0, 1);

	$pdf->Cell(40, 5, 'Diluent Volume:', 0, 0);
	$pdf->Cell(0, 5, $volume, 0, 1);

	// Output PDF directly to the specified directory
	$pdf->Output($pdf_file_path, 'F'); // Save PDF to a file

	// Return the filename of the generated PDF file
	return $filename;
}

// Get the JSON data from the POST request
$jsonData = isset($_POST['jsonData']) ? $_POST['jsonData'] : '';

// Generate PDF using the received JSON data
if (!empty($jsonData)) {
	$pdfFilename = generatePDF($jsonData);

	// Define the base URL of the project
	$baseUrl = 'http://localhost/dms/';

	// Generate the full URL of the PDF file
	$pdfUrl = $baseUrl . 'generated-labels/' . rawurlencode($pdfFilename);

	// Return the URL of the generated PDF file
	echo $pdfUrl;
} else {
	echo 'Error: JSON data not received.';
}
?>
