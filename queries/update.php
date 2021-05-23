<?php
    $conn = mysqli_connect('localhost', "root", '', 'hospital_record_management_system');
    $error = mysqli_error($conn);

    if (isset($_POST['update'])) {
        $id = $_POST['currentID'];
        $updated_status = $_POST['update_status'];
        $dname = $_POST['doctorName'];
        $dID = $_POST['doctorID'];
        $update_query = "UPDATE `records` SET `result_ID`=$updated_status WHERE record_ID=$id";

        mysqli_query($conn,$update_query);

        $error = mysqli_error($conn);

        if ($error) {
            echo "Sorry something went wrong!";
        }

        header("Location: http://localhost/2098_health/doctors.php?dname=$dname&dID=$dID");
        exit;
    }

?>