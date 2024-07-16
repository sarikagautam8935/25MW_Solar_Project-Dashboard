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

function handle_add_drawing($con) {
    reconnect_db($con);

    // Retrieve and escape POST variables
    $drawing_number = mysqli_real_escape_string($con, $_POST['drawing_number']);
    $drawing_title = mysqli_real_escape_string($con, $_POST['drawing_title']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    // Prepare and execute the insert statement
    $stmt = mysqli_prepare($con, "INSERT INTO design (drawing_number, drawing_title, category, status) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $drawing_number, $drawing_title, $category, $status);
    $result = mysqli_stmt_execute($stmt);

    // Check the result and redirect accordingly
    if ($result) {
        redirect("design_display.php", "Drawing Added Successfully");
    } else {
        redirect("design.php", "Something went wrong: " . mysqli_error($con));
    }

    mysqli_stmt_close($stmt);
}

function handle_update_drawing($con) {
    reconnect_db($con);

    // Retrieve and escape POST variables
    $design_id = mysqli_real_escape_string($con, $_POST['design_id']);
    $drawing_number = mysqli_real_escape_string($con, $_POST['drawing_number']);
    $drawing_title = mysqli_real_escape_string($con, $_POST['drawing_title']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    // Prepare and execute the update statement
    $stmt = mysqli_prepare($con, "UPDATE design SET drawing_number = ?, drawing_title = ?, category = ?, status = ? WHERE id = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssi", $drawing_number, $drawing_title, $category, $status, $design_id);
        $result = mysqli_stmt_execute($stmt);

        // Check the result and redirect accordingly
        if ($result) {
            redirect("design_display.php", "Drawing Updated Successfully");
        } else {
            redirect("design.php", "Something went wrong: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
    } else {
        redirect("design.php", "Database error: " . mysqli_error($con));
    }
}

function handle_delete_drawing($con) {
    reconnect_db($con);

    // Retrieve and escape POST variables
    $design_id = mysqli_real_escape_string($con, $_POST['design_id']);

    // Start transaction
    mysqli_begin_transaction($con);

    try {
        $delete_query = "DELETE FROM design WHERE id = '$design_id'";
        $delete_query_run = mysqli_query($con, $delete_query);

        // Commit or rollback transaction based on the result
        if ($delete_query_run) {
            mysqli_commit($con);
            redirect("design_display.php", "Design deleted successfully");
        } else {
            mysqli_rollback($con);
            redirect("design_display.php", "Something went wrong: " . mysqli_error($con));
        }
    } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($con);
        redirect("design_display.php", "Something went wrong: " . $exception->getMessage());
    }
}

// Handle different POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_drawing_btn']) && isset($_POST['drawing_number']) && isset($_POST['drawing_title'])) {
        handle_add_drawing($con);
    } else if (isset($_POST['update_drawing_btn'])) {
        handle_update_drawing($con);
    } else if (isset($_POST['delete_drawing_btn'])) {
        handle_delete_drawing($con);
    } else {
        redirect("design.php", "Invalid Access");
    }
}

// Close the database connection
mysqli_close($con);
?>
