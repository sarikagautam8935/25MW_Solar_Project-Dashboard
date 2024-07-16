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
        margin-top: 5px; /* Adjust margin-top for reduced space */
        margin-bottom: 5px; /* Adjust margin-bottom for reduced space */
        text-decoration: underline;
        font-weight: bold;
        background-color: #d1dbbd; /* Use first-color for background */
        padding: 5px; /* Reduce padding */
        border-radius: 5px; /* Add some border radius */
    }

    .custom-table {
        font-size: 12px; /* Increased font size */
        font-weight: bold;
        font-family: 'Times New Roman', sans-serif;
        color: #012626;
        border-collapse: collapse; /* Ensure borders collapse into a single border */
        width: 100%; /* Ensure the table takes the full width */
    }

    .custom-table th, .custom-table td {
        border: 2px solid #193441; /* Use fourth-color */
        padding: 2px; /* Reduced padding for smaller cell size */
        text-align: center; /* Center align text horizontally */
        vertical-align: middle; /* Center align text vertically */
        background-color: #d1dbbd; /* Use first-color for table cells */
    }

    .custom-table-heading {
        font-size: 16px; /* Increased font size */
        font-family: 'Times New Roman', sans-serif;
        color: #193441; /* Use fourth-color */
        font-weight: bold;
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

    .btn-primary {
        background-color: #193441; /* Match the heading color */
        border-color: #193441;
    }

    .btn-danger {
        background-color: #3e606f; /* Use default danger color */
        border-color: #3e606f;
    }

    .btn-success {
        background-color: #193441; /* Use default success color */
        border-color: #193441;
    }

    .btn-primary:hover, .btn-danger:hover, .btn-success:hover {
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

    /* Ensure buttons are displayed in separate lines */
    .button-container div {
        margin-bottom: 2px; /* Add margin between buttons */
    }

    /* Define small button size */
    .small-btn {
        font-size: 10px; /* Adjust font size */
        padding: 4px 8px; /* Adjust padding */
    }

    /* Styles for the header with logos */
    .header-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        margin-bottom: 10px; /* Adjust margin-bottom for reduced padding */
        padding-top: 20px; /* Add padding at the top */
    }

    .header-container .logo-container {
        margin: 0 20px; 
    }

    .logo-container img {
        width: 150px;
        height: auto;
    }
</style>

<div class="container-fluid first-color">
    <div class="header-container">
        <div class="logo-container">
            <img src="assets/image/LOGO1.png" alt="Logo 1">
        </div>
        <h2>25MW AC Solar Project Namrup, Assam</h2>
        <div class="logo-container">
            <img src="assets/image/LOGO2.png" alt="Logo 2">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card second-color">
                <div class="card-header first-color">
                    <h4 class="custom-heading">Supply Timeline</h4>
                </div>
                <div class="card-body third-color">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped custom-table">
                            <thead>
                                <tr>
                                    <th class="custom-table-heading">ID</th>
                                    <th class="custom-table-heading">Particulars</th>
                                    <th class="custom-table-heading">Status</th>
                                    <th class="custom-table-heading">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $supply = getAll("supply"); // Ensure this function returns data correctly
                                if (mysqli_num_rows($supply) > 0) {
                                    foreach ($supply as $item) {
                                ?>
                                        <tr>
                                            <td><?= htmlspecialchars($item['id']); ?></td>
                                            <td><?= htmlspecialchars($item['particulars']); ?></td>
                                            <td><?= htmlspecialchars($item['status']); ?></td>
                                            <td>
                                                <a href="edit_supply.php?id=<?= htmlspecialchars($item['id']); ?>" class="btn btn-sm btn-primary">Edit</a>
                                                <form action="code_supply.php" method="POST" style="display:inline;">
                                                    <input type="hidden" name="supply_id" value="<?= htmlspecialchars($item['id']); ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger" name="delete_supply_btn">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No records found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Add Supply Button -->
                    <div class="mt-3">
                        <a href="add_supply.php" class="btn btn-success">Add Supply</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
