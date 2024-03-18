<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Sales Chart</title>
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

    <!-- Form for custom chart -->
    <form method="post" class="chart_form">
        <input type="number" name="chart_year" placeholder="Enter year (<?= date('Y') ?>).." autocomplete="off" required min="1"> <br/><br/>
        <input type="number" name="chart_month" placeholder="Enter month (<?= date('m') ?>).." autocomplete="off" required min="1" max="12"> <br/><br/>
        <input type="number" name="chart_day" placeholder="Enter day (<?= date('d') ?>).." autocomplete="off" required min="1" max="31"> <br/><br/>
        <button type="submit" class="navigator"><span class="message">View Custom Chart</span></button>
    </form> <br/><br/><br/>

    <a href="../iamadmin/admin_home.php" class="navigator"><span>back to dashboard</span></a>
    <a href="./custom_chart.php" class="navigator"><span>custom chart</span></a>
    <a href="./general_chart.php" class="navigator"><span>general chart</span></a><br/><br/><br/>


    <!-- JavaScript code to render the bar chart -->
    <script type="text/javascript">
      // Function to handle form submission and update the chart
      document.querySelector('.chart_form').addEventListener('submit', function(event) {
         event.preventDefault(); // Prevent default form submission behavior
         updateChart(); // Call the function to update the chart with custom data
      });

      // Function to fetch data from the server and update the chart
      function updateChart() {
         // AJAX request to fetch aggregated data from the server
         var xhr = new XMLHttpRequest();
         xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Parse the JSON response
                var response = JSON.parse(xhr.responseText);
                // check if response is empty
                if(response.length === 0){
                  console.log("No data found for the selected date.");
                } else {
                   // Update the chart with the new aggregated data
                   updateChartData(response);
                }
            } else {
                console.error('Error fetching data from the server');
            }
            }
         };
         xhr.open('POST', '../chart_data/fetch_custom_sales.php', true);
         xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
         xhr.send('chart_year=' + encodeURIComponent(document.querySelector('input[name="chart_year"]').value) +
                  '&chart_month=' + encodeURIComponent(document.querySelector('input[name="chart_month"]').value) +
                  '&chart_day=' + encodeURIComponent(document.querySelector('input[name="chart_day"]').value));
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

        // Update the chart every 3 seconds
        setInterval(updateChart, 3000);
    </script>
</body>
</html>
