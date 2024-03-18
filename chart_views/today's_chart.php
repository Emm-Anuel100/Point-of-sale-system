<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today's Sales Chart</title>
    <!-- Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <!-- fav-icon -->
     <link rel="shortcut icon" href="../images/shop_logo.png" type="image/x-icon">
      <!-- External Styles -->
      <link rel="stylesheet" href="../styles/dist/chartPage.css">
</head>
<body>

    <span class="graphs">
      <a href="./today's_chart.php" class="navigator"><span>today's chart</span></a>
      <a href="./week_chart.php" class="navigator"><span>this week's chart</span></a>
      <a href="./month_chart.php" class="navigator"><span>this month's chart</span></a>
      <a href="./year_chart.php" class="navigator"><span>this year's chart</span></a>
    </span>

    <!-- Canvas element for the bar chart -->
    <canvas id="productSalesChart"></canvas>

    <a href="../iamadmin/admin_home.php" class="navigator"><span>back to dashboard</span></a>
    <a href="./custom_chart.php" class="navigator"><span>custom chart</span></a>
    <a href="./general_chart.php" class="navigator"><span>general chart</span></a><br/><br/><br/>


    <!-- JavaScript code to render the bar chart -->
    <script type="text/javascript">
        // Function to fetch data from the server and update the chart
        function updateChart() {
            // AJAX request to fetch aggregated data from the server
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Parse the JSON response
                        var response = JSON.parse(xhr.responseText);
                        // Update the chart with the new aggregated data
                        updateChartData(response);
                    } else {
                        console.error('Error fetching data from the server');
                    }
                }
            };
            xhr.open('GET', '../chart_data/fetch_today_sales.php', true);
            xhr.send();
        }

        // Function to update chart data with aggregated data
        function updateChartData(data) {
            // Clear existing labels and data
            myChart.data.labels = [];
            myChart.data.datasets[0].data = [];
            
            // Iterate over the aggregated data and add to chart data
            data.forEach(function(item) {
                myChart.data.labels.push(item.product_name);
                myChart.data.datasets[0].data.push(item.total_quantity);
            });
            
            // Update the chart
            myChart.update();
        }


        // Chart data and options
        var ctx = document.getElementById('productSalesChart').getContext('2d');
        var data = {
            labels: [],
            datasets: [{
                label: 'Number of sales',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [],
                fill: false,  // set background color to false
                tension: 0.4, // tension value for curved lines
                pointRadius: 6 // point radius for thicker dots
            }]
        };
        var options = {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of sales'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Product Name'
                    }
                }
            }
        };

        // Chart instance
        var myChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });

        // Update the chart initially
        updateChart();

        // Update the chart every 5 seconds
        setInterval(updateChart, 5000);
    </script>
  </body>
</html>
