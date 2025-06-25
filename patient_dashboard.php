<!-- include header -->
<?php include_once "includes/header_patient.php";?>
<!-- include db connection -->
<?php include_once "config/db_connection.php";?>
<!-- include Statistics -->
<?php //include_once 'process/get_statistics_patient.php';?>



<?php
echo $_SESSION["username"];
  echo  $_SESSION['role'] ;
?>
<!-- Dashboard Custom JS -->
<script src="assets/js/dashboard_patient.js"></script>








<!-- include footer -->
<?php include_once "includes/footer.php";?>
