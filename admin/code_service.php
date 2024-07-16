<?php
session_start();

include('../config/dbcon.php');
include('../functions/myfunctions.php');

function reconnect_db($con) {
    if (!$con || mysqli_ping($con) === false) {
        global $con;
        include('../config/dbcon.php'); // Reconnect to the database
    }
}

function handle_add_service($con) {
    reconnect_db($con);

    // Retrieve and escape POST variables
    $particulars = mysqli_real_escape_string($con, $_POST['particulars']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    // Prepare and execute the insert statement
    $stmt = mysqli_prepare($con, "INSERT INTO service (particulars, status) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $particulars, $status); // Changed "ssss" to "ss"
    $result = mysqli_stmt_execute($stmt);

    // Check the result and redirect accordingly
    if ($result) {
        redirect("service.php", "Service Added Successfully");
    } else {
        redirect("edit_service.php", "Something went wrong: " . mysqli_error($con));
    }

    mysqli_stmt_close($stmt);
}

function handle_update_service($con) {
    reconnect_db($con);

    // Retrieve and escape POST variables
    $service_id = mysqli_real_escape_string($con, $_POST['service_id']);
    $particulars = mysqli_real_escape_string($con, $_POST['particulars']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    // Prepare and execute the update statement
    $stmt = mysqli_prepare($con, "UPDATE service SET particulars = ?, status = ? WHERE id = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssi", $particulars, $status, $service_id); // Changed "ssssi" to "ssi"
        $result = mysqli_stmt_execute($stmt);

        // Check the result and redirect accordingly
        if ($result) {
            redirect("service.php", "Service Updated Successfully");
        } else {
            redirect("edit_service.php", "Something went wrong: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
    } else {
        redirect("edit_service.php", "Database error: " . mysqli_error($con));
    }
}

function handle_delete_service($con) {
    reconnect_db($con);

    // Retrieve and escape POST variables
    $service_id = mysqli_real_escape_string($con, $_POST['service_id']);

    // Start transaction
    mysqli_begin_transaction($con);

    try {
        $delete_query = "DELETE FROM service WHERE id = '$service_id'";
        $delete_query_run = mysqli_query($con, $delete_query);

        // Commit or rollback transaction based on the result
        if ($delete_query_run) {
            mysqli_commit($con);
            redirect("service.php", "Service deleted successfully");
        } else {
            mysqli_rollback($con);
            redirect("service.php", "Something went wrong: " . mysqli_error($con));
        }
    } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($con);
        redirect("service.php", "Something went wrong: " . $exception->getMessage());
    }
}

// Handle different POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_service_btn']) && isset($_POST['particulars'])) {
        handle_add_service($con);
    } else if (isset($_POST['update_service_btn'])) {
        handle_update_service($con);
    } else if (isset($_POST['delete_service_btn'])) {
        handle_delete_service($con);
    } else {
        redirect("edit_service.php", "Invalid Access");
    }
}

// Close the database connection
mysqli_close($con);
?>
