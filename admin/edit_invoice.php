<?php
include('includes/header.php');
include('../middleware/adminmiddleware.php');
?>

<style>
    .custom-heading {
        text-align: center;
        font-size: 34px;
        font-family: 'Times New Roman', sans-serif;
        color: #193441; /* Use fourth-color */
        margin-top: 20px;
        text-decoration: underline;
        font-weight: bold;
        background-color: #d1dbbd; /* Use first-color for background */
        padding: 10px; /* Add some padding */
        border-radius: 5px; /* Add some border radius */
    }

    .form-control {
        font-size: 14px;
        font-family: 'Times New Roman', sans-serif;
        color: #012626;
        background-color: #d1dbbd; /* Use first-color for form input background */
        border: 2px solid #193441; /* Use fourth-color for form input border */
        padding: 8px; /* Add padding for better readability */
        margin-bottom: 10px; /* Add margin between form fields */
    }

    .form-control::placeholder {
        font-family: 'Times New Roman', sans-serif;
        color: #000000; /* Black color for placeholders */
    }

    .form-label {
        font-family: 'Times New Roman', sans-serif;
        color: #FFFFFF; /* White color for labels */
        font-weight: bold;
        font-size: 16px; /* Adjust font size if needed */
    }

    .btn-primary {
        background-color: #193441; /* Match the heading color */
        border-color: #193441;
    }

    .btn-primary:hover {
        opacity: 0.9; /* Slight opacity change on hover */
    }

    .card-header, .card-body {
        background-color: #d1dbbd; /* Use first-color for card background */
    }

    .card {
        border: 2px solid #193441; /* Optional: Add border to match the table */
        border-radius: 10px; /* Add border-radius to cover corners */
        overflow: hidden; /* Ensure no overflow to show underlying colors */
    }

    .first-color {
        background: #d1dbbd;
    }

    .second-color {
        background: #91aa9d;
    }

    .third-color {
        background: #3e606f;
    }

    .fourth-color {
        background: #193441;
    }

    /* Ensure the form inputs maintain their background color on focus */
    .form-control:focus {
        background-color: #d1dbbd; /* Maintain first-color on focus */
        color: #012626;
    }
</style>

<div class="container-fluid first-color">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $design = getByID("invoice", $id);

                if (mysqli_num_rows($invoice) > 0) {
                    $data = mysqli_fetch_array($invoice);
                    ?>
                    <div class="card second-color">
                        <div class="card-header first-color">
                            <h4 class="custom-heading">Edit Invoice</h4>
                        </div>
                        <div class="card-body third-color">
                            <form action="code_invoice.php" method="POST">
                                <input type="hidden" name="invoice_id" value="<?= $data['id'] ?>">
                                <div class="row mb-3">
                                    <label for="invoice_number" class="form-label">Invoice No.</label>
                                    <input type="text" name="invoice_number" value="<?= $data['invoice_number'] ?>" placeholder="Enter Invoice No." class="form-control">
                                </div>
                                <div class="row mb-3">
                                    <label for="invoice_date" class="form-label">Invoice Date</label>
                                    <input type="date" name="invoice_date" value="<?= $data['invoice_date'] ?>" placeholder="Enter Invoice Date" class="form-control">
                                </div>
                                <div class="row mb-3">
                                    <label for="invoice_name" class="form-label">Invoice Title</label>
                                    <input type="text" name="invoice_name" value="<?= $data['invoice_name'] ?>" placeholder="Enter Invoice Title" class="form-control">
                                </div>
                                <div class="row mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="SUBMITTED" <?= $data['status'] == 'SUBMITTED' ? 'selected' : '' ?>>SUBMITTED</option>
                                        <option value="COMMENTED" <?= $data['status'] == 'COMMENTED' ? 'selected' : '' ?>>COMMENTED</option>
                                        <option value="APPROVED" <?= $data['status'] == 'APPROVED' ? 'selected' : '' ?>>APPROVED</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mt-4 w-100" name="update_invoice_btn">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                } else {
                    echo "Design not found";
                }
            } else {
                echo "ID missing from URL";
            }
            ?>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>
