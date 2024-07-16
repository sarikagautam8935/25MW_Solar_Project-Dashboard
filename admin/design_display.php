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
        margin-top: 10px; /* Adjust margin-top for reduced padding */
        text-decoration: underline;
        font-weight: bold;
        background-color: #d1dbbd; /* Use first-color for background */
        padding: 5px; /* Reduce padding */
        border-radius: 5px; /* Add some border radius */
    }

    .custom-table {
        font-size: 12px;
        font-weight: bold;
        font-family: 'Times New Roman', sans-serif;
        color: #012626;
        border-collapse: collapse; /* Ensure borders collapse into a single border */
        width: 100%; /* Ensure the table takes the full width */
    }

    .custom-table th, .custom-table td, .custom-table tr {
        border: 2px solid #193441; /* Use fourth-color */
        padding: 4px; /* Reduce padding for table cells */
        text-align: left; /* Align text to the left */
        background-color: #d1dbbd; /* Use first-color for table cells */
    }

    .custom-table th, .custom-table td {
        border: 2px solid #193441; /* Ensure each cell has a border */
    }

    .custom-table tr {
        border: 2px solid #193441; /* Ensure each row has a border */
    }

    .custom-table-heading {
        font-size: 15px;
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

    .header-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        margin-bottom: 20px; /* Adjust margin-bottom for reduced padding */
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
                    <h4 class="custom-heading">Main Design/Drawing List - MDL</h4>
                </div>
                <div class="card-body third-color">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped custom-table">
                            <thead>
                                <tr>
                                    <th class="custom-table-heading">ID</th>
                                    <th class="custom-table-heading">Drawing No.</th>
                                    <th class="custom-table-heading">Drawing Title</th>
                                    <th class="custom-table-heading">Category</th>
                                    <th class="custom-table-heading">Status</th>
                                    <th class="custom-table-heading">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $design = getAll("design"); // Ensure this function returns data correctly
                                if (mysqli_num_rows($design) > 0) {
                                    foreach ($design as $item) {
                                ?>
                                        <tr>
                                            <td><?= htmlspecialchars($item['id']); ?></td>
                                            <td><?= htmlspecialchars($item['drawing_number']); ?></td>
                                            <td><?= htmlspecialchars($item['drawing_title']); ?></td>
                                            <td><?= htmlspecialchars($item['category']); ?></td>
                                            <td><?= htmlspecialchars($item['status']); ?></td>
                                            <td>
                                                <a href="edit-design.php?id=<?= htmlspecialchars($item['id']); ?>" class="btn btn-sm btn-primary">Edit</a>
                                                <form action="code.php" method="POST" style="display:inline;">
                                                    <input type="hidden" name="design_id" value="<?= htmlspecialchars($item['id']); ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger" name="delete_drawing_btn">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No records found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Add Design Button -->
                    <div class="mt-3">
                        <a href="design.php" class="btn btn-success">Add Design</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
