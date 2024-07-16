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

function handle_add_supply($con) {
    reconnect_db($con);

    // Retrieve and escape POST variables
    $particulars = mysqli_real_escape_string($con, $_POST['particulars']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    // Prepare and execute the insert statement
    $stmt = mysqli_prepare($con, "INSERT INTO supply (particulars, status) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $particulars, $status); // Changed "ssss" to "ss"
    $result = mysqli_stmt_execute($stmt);

    // Check the result and redirect accordingly
    if ($result) {
        redirect("supply.php", "Supply Added Successfully");
    } else {
        redirect("edit_supply.php", "Something went wrong: " . mysqli_error($con));
    }

    mysqli_stmt_close($stmt);
}

function handle_update_supply($con) {
    reconnect_db($con);

    // Retrieve and escape POST variables
    $supply_id = mysqli_real_escape_string($con, $_POST['supply_id']);
    $particulars = mysqli_real_escape_string($con, $_POST['particulars']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    // Prepare and execute the update statement
    $stmt = mysqli_prepare($con, "UPDATE supply SET particulars = ?, status = ? WHERE id = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssi", $particulars, $status, $supply_id); // Changed "ssssi" to "ssi"
        $result = mysqli_stmt_execute($stmt);

        // Check the result and redirect accordingly
        if ($result) {
            redirect("supply.php", "Supply Updated Successfully");
        } else {
            redirect("edit_supply.php", "Something went wrong: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
    } else {
        redirect("edit_supply.php", "Database error: " . mysqli_error($con));
    }
}

function handle_delete_supply($con) {
    reconnect_db($con);

    // Retrieve and escape POST variables
    $supply_id = mysqli_real_escape_string($con, $_POST['supply_id']);

    // Start transaction
    mysqli_begin_transaction($con);

    try {
        $delete_query = "DELETE FROM supply WHERE id = '$supply_id'";
        $delete_query_run = mysqli_query($con, $delete_query);

        // Commit or rollback transaction based on the result
        if ($delete_query_run) {
            mysqli_commit($con);
            redirect("supply.php", "Supply deleted successfully");
        } else {
            mysqli_rollback($con);
            redirect("supply.php", "Something went wrong: " . mysqli_error($con));
        }
    } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($con);
        redirect("supply.php", "Something went wrong: " . $exception->getMessage());
    }
}

// Handle different POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_supply_btn']) && isset($_POST['particulars'])) {
        handle_add_supply($con);
    } else if (isset($_POST['update_supply_btn'])) {
        handle_update_supply($con);
    } else if (isset($_POST['delete_supply_btn'])) {
        handle_delete_supply($con);
    } else {
        redirect("edit_supply.php", "Invalid Access");
    }
}

// Close the database connection
mysqli_close($con);
?>
