<?php

$conn = mysqli_connect('localhost', "root", '', 'hospital_record_management_system');
$error = mysqli_error($conn);

    session_start();
    if (isset ($_GET['dname'])) {
        $doctorName = $_GET['dname'];
    } if (isset ($_GET['dID'])) {
      $doctorID = $_GET['dID'];
  }
    $id = $_SESSION['patientID'];
    

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
    <caption>*list of schedules of <?php echo $doctorName;?></caption>
      <thead class="thead-dark">
        <tr>
          <th scope="col">Record ID</th>
          <th scope="col">Patient Name</th>
          <th scope="col">Name of Test</th>
          <th scope="col">Date of Examination</th>
          <th scope="col">Results</th>
          
        </tr>
      </thead>
      <?php

      // $sort = "SELECT consult. FROM patients, doctors,consult, tests WHERE consult.doctor_id=$dID AND doctors.doctor_id=$dID";
      $sort = "SELECT records.*, patients.name AS 'pname', tests.test_name AS 'test', performed.result AS 'results', performed.result_ID AS 'resultsID', consult.date AS 'date' FROM consult, patients, tests, performed, records WHERE records.doctor_id = $doctorID AND patients.patient_ID=records.patient_ID AND tests.test_id=records.test_ID AND performed.result_ID = records.result_ID AND consult.consult_ID = records.consult_ID ORDER BY date DESC";
      $result = mysqli_query($conn, $sort);
      if (mysqli_num_rows($result) > 0) {
      while ($r = mysqli_fetch_assoc($result)) {
        echo '
          <tbody>
          <tr class="table-light ">
          <td> ' . $r['record_ID'] . ' </td>
          <td> ' . $r['pname'] . '       </td>
          <td> ' . $r['test'] . '      </td>
          <td> ' . $r['date'] . '      </td>';
         
          if ($r['results'] == "Available") {
            echo '<td id="update"> <a class="text-success" href="?dname='.$doctorName.'&dID='.$doctorID.'&action_update=update&consultID=' . $r['record_ID'] . ' ">Available</a> </td>';
        } else if ($r['results'] == "Claimed") {
          echo '<td> <a class="text-primary" href="?dname='.$doctorName.'&dID='.$doctorID.'&action_update=update&consultID=' . $r['record_ID'] . ' ">Claimed</a> </td> ';
      } else if ($r['results'] == "Pending") {
        echo '<td> <a class="text-warning" href="?dname='.$doctorName.'&dID='.$doctorID.'&action_update=update&consultID=' . $r['record_ID'] . ' ">Pending</a> </td> ';
    }
         echo '
         </tr>
        ';
      }
    }
      ?>

    </table>
  </div>

  
  <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.sticky.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/wow.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/custom.js"></script>

     <div class="modal" tabindex="-1" role="dialog" id="updateModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Results</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="queries/update.php" method="post">
      <input type="hidden" name="update">
      <input type="hidden" name="currentID" value="<?php echo $_GET['consultID']; ?>">
      <input type="hidden" name="doctorID" value="<?php echo $_GET['dID']; ?>">
      <input type="hidden" name="doctorName" value="<?php echo $_GET['dname']; ?>">
      <div class="form-group row">
              <label for="update_status" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
                <select class="form-control" name="update_status" id="update_status" required>
                  <!-- <option selected disabled value=""><?php echo $r['results'];  ?></option> -->
                  <option class="text-success" value="1">Available</option>
                  <option class="text-primary" value="2">Claimed</option>
                  <option class="text-warning" value="3">Pending</option>
                </select>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
  
    </div>
    </form>
  </div>
</div>
  
  <?php
    // if action is edit... 
      if (isset ($_GET['action_update']) && isset ($_GET['action_update']) == 'update') {
        echo "<script type='text/javascript'>
          $('#updateModal').modal('show');
            </script>";
        }
    ?>
</body>
<!-- SCRIPTS -->
<script src='http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.js'></script>
<!-- <script type="text/javascript">
     $(document).ready(function(){
    $("#update").change(function () {
        var val = $(this).val();
        
        if (val == "1757") {
            $("#testID").html("<option selected disabled value=''>-- Select One --</option> <option value='1'>Chest x-ray</option> <option value='2'>CT scan (computed tomography)</option> <option value='3'>Thoracoscopy</option>");
        } else if (val == "1615") {
            $("#testID").html("<option selected disabled value=''>-- Select One --</option> <option value='4'>Complete Blood Count (CBC)</option><option value='1'>Chest X-ray</option><option value='5'>ECG (electrocardiogram)</option>");
        } else if (val == "1950") {
            $("#testID").html("<option selected disabled value=''>-- Select One --</option> <option value='6'>Arthrography</option><option value='7'>Blood Test</option>  <option value='8'>Bone Scan</option>");
        } 
    });
});
</script> -->




  
</html>

<?php

    if (isset($_GET['action']) && isset($_GET['action']) == 'update' && isset($_POST['action'])) {
        $dID = $_GET['dID'];
        $dname = $_GET['dname'];
        $consultID = $_GET['consultID'];
        $result = $_POST['resultsID'];

        $update_query = "UPDATE consult SET `result_ID`=$result WHERE consult_ID=$consultID";

        mysqli_query($conn,$update_query);

        $error = mysqli_error($conn);

        if ($error) {
            echo "Sorry something went wrong!";
        } 

        // header("Location: http://localhost/2098_health/doctors.php?dname=Eduard%20R.%20Arcenas%20&dID=1615");
        // exit;
    }

?>

