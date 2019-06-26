<?php
include '../assets/db/dbconnection.php';
$conn = OpenCon();
$sqlGetOrders = "SELECT * FROM order_details WHERE description != 'Meat' AND description != 'Donation'";
$result = $conn->query($sqlGetOrders);
$sqlGet = "SELECT * FROM order_details";
$results = $conn->query($sqlGet);
$LargePizzaQuantity  = $MediumPizzaQuantity =$SmallPizzaQuantity=$MeatToppingQuantity = $DonationAmount =$VegetableToppingQuantity=0;
while($rows = $results->fetch_assoc()) {
  if($rows['description'] == 'Large_Pizza'){
    $LargePizzaQuantity = $LargePizzaQuantity + $rows['quantity'];
  }
  if($rows['description'] == 'Medium_Pizza'){
    $MediumPizzaQuantity = $MediumPizzaQuantity + $rows['quantity'];
  }
  if($rows['description'] == 'Small_Pizza'){
    $SmallPizzaQuantity = $SmallPizzaQuantity + $rows['quantity'];
  }
  if($rows['description'] == 'Meat'){
      $MeatToppingQuantity = $MeatToppingQuantity + $rows['quantity'];
    }
  if($rows['description'] == 'Vegetable'){
        $VegetableToppingQuantity = $VegetableToppingQuantity + $rows['quantity'];
      }
  if($rows['description'] == 'Donation'){
          $DonationAmount = $DonationAmount + $rows['unit_amount'];
      }
}
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Data Report</title><link href="./style.css"  rel='stylesheet' type='text/css'>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
     <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
     <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" integrity="sha256-aa0xaJgmK/X74WM224KMQeNQC2xYKwlAt08oZqjeF0E=" crossorigin="anonymous" />
   </head>
   <body>
     <header>
       <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
          <div class="container">
              <img style=" width: 80px;"src="./pizza.png" alt="" href="./index.php">
              <h6 href="./index.php"style="color: white; font-size: 25px;">Orders Statistics</h6>
            <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="btn btn-primary" role="button" href="./index.php">Order Pizza</a>
                </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <li class="nav-item">
                    <a class="btn btn-primary" role="button" href="../login.php">Sign Out</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
     </header>

<div style="width: 100%; overflow: hidden;">
  <div class="pieChart" style="margin-top:30px; height: 30%; width: 30%; float: left;">
    <canvas id="myPieChart" width="2" height="2"></canvas>
    <script type="text/javascript">
    var datas = {
        labels: ["Large Pizza", "Medium Pizza", "Small Pizza", "Meat Toppings", "Vegetable Toppings"],
          datasets: [
            {
                fill: true,
                backgroundColor: [
                    'red',
                    'blue','purple','yellow', 'green'],
                data: [<?php echo $LargePizzaQuantity; ?>, <?php echo $MediumPizzaQuantity; ?>,<?php echo $SmallPizzaQuantity; ?>,<?php echo $MeatToppingQuantity; ?>, <?php echo $VegetableToppingQuantity; ?>],
    // Notice the borderColor

            }
        ]
    };
    var option = {
          title: {
                    display: true,
                    text: 'Pizza Size Quantity Distribution & Toppings Selections',
                    position: 'top'
                }
  };
  var xtx = document.getElementById('myPieChart').getContext('2d');
    var myPieChart = new Chart(xtx, {
        type: 'pie',
        data: datas,
        options: option
    });
    </script>
  </div>
  <div class="barChart" style="margin-top:30px;  height: 200px;width: 60%; float: right;">
  <canvas id="myChart" width="50" height="15"></canvas>
  <script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'horizontalBar',
      data: {
          labels: ['Large Pizza', 'Medium Pizza', 'Small Pizza'],
          datasets: [{
              label: 'Pizza Distribution',
              data: [<?php echo $LargePizzaQuantity; ?>, <?php echo $MediumPizzaQuantity; ?>, <?php echo $SmallPizzaQuantity; ?>,0],
              backgroundColor: [
                  'rgba(255, 99, 132, 0.6)',
                  'rgba(54, 162, 235, 0.6)',
                  'rgba(255, 206, 86, 0.6)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 0.2)'
              ],
              borderWidth: 0.2
          }]
      },
      options: {

          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
  </script>
  </div>
</div>

   <div style="margin-top:30px;" class="table" id="table">
     <table id="orders" class="cell-border compact display stripe">
       <thead>
         <th>#</th>
         <th>Item Ordered</th>
         <th>Quantity</th>
         <th>Unit Price</th>
         <th>Amount (Quantity X Unit Price)</th>
       </thead>
       <tbody>
           <?php while($row = $result->fetch_assoc()) {
           echo "<tr>
           <td>".$row["order_id"]."</td>
           <td>".$row["description"]."</td>
           <td>".$row["quantity"]."</td>
           <td>".$row["unit_amount"]."</td>
           <td>".$row["unit_amount"] * $row["quantity"]."</td>
           </tr>";
         } ?>
       </tbody>
     </table>
   </div>
   <script type="text/javascript">
   $(document).ready( function () {
       $('#orders').DataTable();
   } );
   </script>
   </body>

 </html>
