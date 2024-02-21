<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Sales Chart</title>
    <!-- Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <!-- fav-icon -->
     <link rel="shortcut icon" href="../images/shop_logo.png" type="image/x-icon">
</head>
<body>

    <a href="./admin_home.php" class="navigator">back to dashboard</a>
    <!-- Canvas element for the bar chart -->
    <canvas id="productSalesChart"></canvas>


    <!-- JavaScript code to render the bar chart -->
    <script type="text/javascript">
        // Function to fetch data from the server and update the chart
        function updateChart() {
            // AJAX request to fetch data from the server
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Parse the JSON response
                        var response = JSON.parse(xhr.responseText);
                        // Update the chart with the new data
                        myChart.data.labels = response.labels;
                        myChart.data.datasets[0].data = response.data;
                        myChart.update();
                    } else {
                        console.error('Error fetching data from the server');
                    }
                }
            };
            xhr.open('GET', './fetch_sales_data.php', true);
            xhr.send();
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
                fill: false,  // set background to false
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

        // Update the chart every 5 seconds
        setInterval(updateChart, 5000);
    </script>



    <!-- internal styles -->
   <style type="text/css">
    /*## page scroll bar styles ##*/
    ::-webkit-scrollbar{
     width: 0;
      background: gray;
    }
    ::-webkit-scrollbar-button{
     background: rgb(109, 108, 108);
    }
     ::-webkit-scrollbar-thumb{
      background:  rgb(27, 27, 27);
    }
     a.navigator{
      text-decoration: none;
      color: rgb(255, 99, 132); 
      font-size: 16px; 
      padding: 7px;
      border: 1px solid #eee;
      align-items: center;
      border-radius: .3rem;
      position: relative;
      left: 50px;
      top: 7px;
     }
     a.navigator:hover{
      transition: ease-in .4s;
      border: 1px solid rgb(255, 99, 132);
     }
   </style>
  </body>
</html>
