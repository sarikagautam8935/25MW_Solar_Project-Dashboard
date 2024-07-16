<?php 
include('includes/header.php'); 
include('../middleware/adminmiddleware.php'); 
include('../config/dbcon.php');

// Fetch count of approved and total entries from the design table
$query = "SELECT 
            (SELECT COUNT(*) FROM design WHERE status = 'APPROVED') as approved_count,
            (SELECT COUNT(*) FROM design) as total_count";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$approved_count = $row['approved_count'];
$total_count = $row['total_count'];

// Calculate the percentage of approved entries
$approved_percentage = ($total_count > 0) ? ($approved_count / $total_count) * 100 : 0;

// Fetch count of approved and total entries from the Service table
$query_service = "SELECT 
            (SELECT COUNT(*) FROM service WHERE status = 'COMPLETED') as completed_count,
            (SELECT COUNT(*) FROM service) as total_count_service";
$result_service = mysqli_query($con, $query_service);
$row_service = mysqli_fetch_assoc($result_service);
$completed_count = $row_service['completed_count'];
$total_count_service = $row_service['total_count_service'];

// Calculate the percentage of approved entries
$completed_percentage = ($total_count_service > 0) ? ($completed_count / $total_count_service) * 100 : 0;

// Fetch count of approved and total entries from the Supply table
$query_supply = "SELECT 
            (SELECT COUNT(*) FROM supply WHERE status = 'DELIVERED') as delivered_count,
            (SELECT COUNT(*) FROM design) as total_count_supply";
$result_supply = mysqli_query($con, $query_supply);
$row_supply = mysqli_fetch_assoc($result_supply);
$delivered_count = $row_supply['delivered_count'];
$total_count_supply = $row_supply['total_count_supply'];

// Calculate the percentage of approved entries
$delivered_percentage = ($total_count_supply > 0) ? ($delivered_count / $total_count_supply) * 100 : 0;

?>

<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #d1dbbd; 
    }

    .custom-heading {
        text-align: center;
        font-size: 20px;
        font-family: 'Times New Roman', sans-serif;
        color: black;
        margin-top: 14px;
        text-decoration: underline;
        font-weight: bold;
    }

    .container {
        background-color: #d1dbbd; 
        padding: 0;
        margin: 0;
    }

    .row, .col-md-12 {
        padding: 0;
        margin: 0;
    }

    .content {
        padding: 20px;
    }

    .header-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        margin-bottom: 20px;
    }

    .header-container .logo-container {
        margin: 0 20px; 
    }

    .logo-container img {
        width: 150px;
        height: auto;
    }

    .card {
        margin: 0;
        padding: 0;
        background-color: #ffffff;
    }

    .card-header-custom {
        background-color: #3e606f; 
        color: #ffffff; 
        font-size: 24px;
        font-family: Arial, sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-body {
        text-align: center;
    }

    h2 {
        font-size: 30px;
        font-family: 'Roboto', sans-serif;
        color: #193441;
    }

    h6 {
        font-size: 20px;
        font-family: Arial, sans-serif;
        margin-left: 8px;
        color: #ffffff; 
    }

    p {
        font-size: 14px;
        font-family: Arial, sans-serif;
    }

    .icon {
        font-size: 24px;
    }

    .date-card p {
        font-size: 20px;
        font-family: 'Times New Roman', serif;
        font-weight: bold !important;
        color: black !important;
    }

    .chart-container {
        position: relative;
        height: 80px; 
        width: 160px; 
        margin: 0 auto;
        margin-left: 30px; /* Adjust this value to shift the chart right */
    }

    .custom-label {
        text-align: center;
        font-size: 18px;
        font-family: 'Arial', sans-serif;
        color: #193441;
        margin-top: 10px;
    }
</style>

<div class="container content">
    <div class="row">
        <div class="col-md-12">
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
                <div class="col-lg-4 col-sm-4 mb-3">
                    <div class="card">
                        <div class="card-header card-header-custom blue-card-header">
                            <h6>Contractual Start Date</h6>
                        </div>
                        <div class="card-body date-card">
                            <p>01-Sep-2020</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 mb-3">
                    <div class="card">
                        <div class="card-header card-header-custom blue-card-header">
                            <h6>Contractual End Date</h6>
                        </div>
                        <div class="card-body date-card">
                            <p>31-Aug-2024</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 mb-3">
                    <div class="card">
                        <div class="card-header card-header-custom blue-card-header">
                            <h6>Best Effort Completion</h6>
                        </div>
                        <div class="card-body date-card">
                            <p>31-Dec-2024</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6 mb-3">
                    <div class="card">
                        <div class="card-header card-header-custom blue-card-header">
                            <i class="material-icons icon">brush</i>
                            <h6>Design</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="designPieChart"></canvas>
                            </div>
                            <div class="custom-label" id="designChartLabel">
                                <?= number_format($approved_percentage, 2); ?>% APPROVED
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-3">
                    <div class="card">
                        <div class="card-header card-header-custom blue-card-header">
                            <i class="material-icons icon">local_shipping</i>
                            <h6>Supply</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="supplyPieChart"></canvas>
                            </div>
                            <div class="custom-label" id="supplyChartLabel">
                                <?= number_format($delivered_percentage, 2); ?>% DELIVERED
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-3">
                    <div class="card">
                        <div class="card-header card-header-custom blue-card-header">
                            <i class="material-icons icon">build</i>
                            <h6>Service</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="servicePieChart"></canvas>
                            </div>
                            <div class="custom-label" id="serviceChartLabel">
                                <?= number_format($completed_percentage, 2); ?>% COMPLETED
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-3">
                    <div class="card">
                        <div class="card-header card-header-custom blue-card-header">
                            <i class="material-icons icon">receipt</i>
                            <h6>Invoices</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="invoicePieChart"></canvas>
                            </div>
                            <div class="custom-label" id="invoiceChartLabel">
                                <?= number_format($approved_percentage, 2); ?>% APPROVED
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var designCtx = document.getElementById('designPieChart').getContext('2d');
        var designPieChart = new Chart(designCtx, {
            type: 'pie',
            data: {
                labels: ['Approved', 'Others'],
                datasets: [{
                    data: [<?= $approved_percentage; ?>, <?= 100 - $approved_percentage; ?>],
                    backgroundColor: ['#193441', '#91aa9d'],
                    hoverBackgroundColor: ['#193441', '#91aa9d']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';
                            }
                        }
                    }
                }
            }
        });

        var designCtx = document.getElementById('supplyPieChart').getContext('2d');
        var supplyPieChart = new Chart(designCtx, {
            type: 'pie',
            data: {
                labels: ['Delivered', 'Others'],
                datasets: [{
                    data: [<?= $delivered_percentage; ?>, <?= 100 - $delivered_percentage; ?>],
                    backgroundColor: ['#193441', '#91aa9d'],
                    hoverBackgroundColor: ['#193441', '#91aa9d']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';
                            }
                        }
                    }
                }
            }
        });

        var designCtx = document.getElementById('servicePieChart').getContext('2d');
        var servicePieChart = new Chart(designCtx, {
            type: 'pie',
            data: {
                labels: ['Completed', 'Others'],
                datasets: [{
                    data: [<?= $completed_percentage; ?>, <?= 100 - $completed_percentage; ?>],
                    backgroundColor: ['#193441', '#91aa9d'],
                    hoverBackgroundColor: ['#193441', '#91aa9d']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';
                            }
                        }
                    }
                }
            }
        });

    });
</script>
