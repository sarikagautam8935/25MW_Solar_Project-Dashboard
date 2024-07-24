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

function handle_add_invoice($con) {
    reconnect_db($con);

    // Retrieve and escape POST variables
    $invoice_number = mysqli_real_escape_string($con, $_POST['invoice_number']);
    $invoice_date = mysqli_real_escape_string($con, $_POST['invoice_date']);
    $invoice_name = mysqli_real_escape_string($con, $_POST['invoice_name']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    // Prepare and execute the insert statement
    $stmt = mysqli_prepare($con, "INSERT INTO invoice (invoice_number, invoice_date, invoice_name, status) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $invoice_number, $invoice_date, $invoice_name, $status);
    $result = mysqli_stmt_execute($stmt);

    // Check the result and redirect accordingly
    if ($result) {
        redirect("invoice.php", "Invoice Added Successfully");
    } else {
        redirect("add_invoice.php", "Something went wrong: " . mysqli_error($con));
    }

    mysqli_stmt_close($stmt);
}

function handle_update_invoice($con) {
    reconnect_db($con);

    // Retrieve and escape POST variables
    $invoice_id = mysqli_real_escape_string($con, $_POST['invoice_id']);
    $invoice_number = mysqli_real_escape_string($con, $_POST['invoice_number']);
    $invoice_date = mysqli_real_escape_string($con, $_POST['invoice_date']);
    $invoice_name = mysqli_real_escape_string($con, $_POST['invoice_name']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    // Prepare and execute the update statement
    $stmt = mysqli_prepare($con, "UPDATE invoice SET invoice_number = ?, invoice_date = ?, invoice_name = ?, status = ? WHERE id = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssi", $invoice_number, $invoice_date, $invoice_name, $status, $invoice_id);
        $result = mysqli_stmt_execute($stmt);

        // Check the result and redirect accordingly
        if ($result) {
            redirect("invoice.php", "Drawing Updated Successfully");
        } else {
            redirect("add_invoice.php", "Something went wrong: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
    } else {
        redirect("add_invoice.php", "Database error: " . mysqli_error($con));
    }
}

function handle_delete_invoice($con) {
    reconnect_db($con);

    // Retrieve and escape POST variables
    $invoice_id = mysqli_real_escape_string($con, $_POST['invoice_id']);

    // Start transaction
    mysqli_begin_transaction($con);

    try {
        $invoice_query = "DELETE FROM invoice WHERE id = '$invoice_id'";
        $invoice_query_run = mysqli_query($con, $invoice_query);

        // Commit or rollback transaction based on the result
        if ($invoice_query_run) {
            mysqli_commit($con);
            redirect("invoice.php", "Invoice deleted successfully");
        } else {
            mysqli_rollback($con);
            redirect("invoice.php", "Something went wrong: " . mysqli_error($con));
        }
    } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($con);
        redirect("invoice.php", "Something went wrong: " . $exception->getMessage());
    }
}

// Handle different POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_invoice_btn']) && isset($_POST['invoice_number']) && isset($_POST['invoice_date'])) {
        handle_add_invoice($con);
    } else if (isset($_POST['update_invoice_btn'])) {
        handle_update_invoice($con);
    } else if (isset($_POST['delete_invoice_btn'])) {
        handle_delete_invoice($con);
    } else {
        redirect("add_invoice.php", "Invalid Access");
    }
}

// Close the database connection
mysqli_close($con);
?>
