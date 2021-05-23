<?php
session_start();
$id = $_SESSION['patientID'];
    $conn = mysqli_connect('localhost', "root", '', 'hospital_record_management_system');
  $error = mysqli_error($conn);


  // Insert
if (
  isset($_POST['actions'])
) { 
  $ID = $_POST['pID'];
  $testID = $_POST['testID'];
  $date = $_POST['date'];
  $doctorID = $_POST['department'];

  $insertConsult_query = "INSERT INTO `consult`(`date`, `patient_ID`, `doctor_id`, `test_ID`) VALUES ('$date',$id,$doctorID,$testID)";
  mysqli_query($conn, $insertConsult_query);

  $rowSQL = mysqli_query($conn, "SELECT MAX(consult_ID) AS max FROM consult");
  $row = mysqli_fetch_array($rowSQL);
  $largestNumber = $row['max'];
  
  $insertRecords_query = "INSERT INTO `records`(`test_ID`, `doctor_id`, `patient_ID`, `result_ID`, `consult_ID`) VALUES ($testID,$doctorID,$id,3,$largestNumber)";
  
  
  mysqli_query($conn, $insertRecords_query);
  
  if ($error) {
    echo "Sorry something went wrong!";
  } 
  header("Location: http://localhost/2098_health/profile.php");
  exit;
}

?>
<!doctype html>
<html lang="en">
<!-- Head -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Icon CSS -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <title>Profile</title>
  


     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="Tooplate">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/animate.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/tooplate-style.css">
     <style>
body {
  background-image: url("images/slider2.jpg");
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>
</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">
<section class="preloader">
          <div class="spinner">

               <span class="spinner-rotate"></span>
               
          </div>
     </section>
<!-- HEADER -->
<header>
          <div class="container">
               <div class="row">

                    <div class="col-md-4 col-sm-5">
                         <p> <a href="http://localhost/2098_health/index.php">Welcome to a Professional Health Care </a></p>
                    </div>
                         
                    <div class="col-md-8 col-sm-7 text-align-right">
                         <span class="phone-icon"><i class="fa fa-phone"></i> 010-060-0160</span>
                         <span class="date-icon"><i class="fa fa-calendar-plus-o"></i> 6:00 AM - 10:00 PM (Mon-Fri)</span>
                         <span class="email-icon"><i class="fa fa-envelope-o"></i> <a href="#">info@company.com</a></span>
                    </div>

               </div>
          </div>
     </header>


     
<!-- Data Table -->
 
<div class="container d-flex flex-column position-relative" style="top:70px; margin-bottom: 70px;">
    <h1 class="display-5 text-center">PROFILE</h1>
    <table class="table table-hover">
    <caption>*scheduled tests</caption>
      <thead class="thead-dark">
        <tr>
          <th scope="col">Record ID</th>
          <th scope="col">Patient Name</th>
          <th scope="col">Name of Test</th>
          <th scope="col">Date of Examination</th>
          <th scope="col">Doctor</th>
          <th scope="col">Department</th>
          <th scope="col">Results</th>
        </tr>
      </thead>
      <?php
      $sort = "SELECT patients.name AS 'pname', doctors.name AS 'dname', doctors.specialization AS 'dspecial', records.record_ID, consult.date AS 'date', tests.test_name AS 'test', performed.result AS 'results' FROM patients, doctors,consult, tests, performed, records WHERE patients.patient_ID=$id AND records.patient_ID=$id AND doctors.doctor_id=records.doctor_id AND tests.test_id=records.test_ID AND performed.result_ID = records.result_ID AND consult.consult_ID = records.consult_ID";
      $result = mysqli_query($conn, $sort);
      if (mysqli_num_rows($result) > 0) {
      while ($r = mysqli_fetch_assoc($result)) {
        echo '
          <tbody>
          <tr class="table-light">
          <td> '.$r['record_ID'].'</td>
          <td> ' . $r['pname'] . ' </td>
          <td> ' . $r['test'] . '       </td>
          <td> ' . $r['date'] . '      </td>
          <td> ' . $r['dname'] . '        </td>
          <td> ' . $r['dspecial'] . '        </td>';
          if ($r['results'] == "Available") {
              echo '<td class="text-success">'. $r['results'] .'</td>';
          } else if ($r['results'] == "Claimed") {
            echo '<td class="text-primary"> '.$r['results'] .'</td>';
        } else if ($r['results'] == "Pending") {
          echo '<td class="text-warning"> '.$r['results'] .'</td>';
      }
          echo '
        </tbody>
        ';
      }
    }
      ?>

    </table>
  </div>

</body>
<!-- SCRIPTS -->
     
<script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.sticky.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/wow.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/custom.js"></script>
</html>