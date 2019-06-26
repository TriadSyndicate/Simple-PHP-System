	<?php
session_start();
$usernames = $_SESSION['pizzaorderer'];
 ?>
<html>
<head>
<link href="./style.css"  rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="sweetalert2.all.min.js"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

<style media="screen">
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
-webkit-appearance: none;
margin: 0;
}
</style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
  <div class="container">
      <img style=" width: 80px;"src="./pizza.png" alt="">
      <h6 style="color: white; font-size: 25px;">Order for <?php echo $usernames; ?></h6>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
				<li class="nav-item">
            <a class="btn btn-primary" role="button" href="./data.php">Data</a>
        </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <li class="nav-item">
            <a class="btn btn-primary" role="button" href="../login.php">Sign Out</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="orderForm" style="">
<h4 name="head" style="font-weight: bold; font-size: 25px; color:#3987c9;">Pizza Quantity</h4>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="orderform" method="post">
<div class='row'>&nbsp;
<input type="number" min="0" value="0"  max = "50" maxlength="2" size="2"  placeholder="0" name="lpizza" id="lpizza" style="margin-left:20px; width: 30px; font-weight: bold;">&nbsp;&nbsp;
<label for="lpizza" style="padding-left: 10px; font-size: 20px;"> Large Pizza (Ksh 1000)</label>
</div> <br>
<div class='row'>&nbsp;
<input type="number" min="0" value="0"  max = "50" maxlength="2" size="2" placeholder="0" name="mpizza" id="mpizza" style="margin-left:20px; width: 30px; font-weight: bold;">&nbsp;&nbsp;
<label for="mpizza" style="padding-left: 10px; font-size: 20px;">Medium Pizza (Ksh 700)</label>
</div> <br>
<div class='row'>&nbsp;
<input  type="number" min="0" value="0"  max = "50" maxlength="2" size="2" placeholder="0" id="spizza" name="spizza" style="margin-left:20px; width: 30px; font-weight: bold;">&nbsp;&nbsp;
<label for="spizza" style="padding-left: 10px; font-size: 20px;"> Small Pizza (Ksh 400)</label>
</div> <br>

<h5 name="xtra" style="font-weight: bold; font-size: 25px; color:#3987c9;">Extra Toppings</h5>
<br>
<div class="row" style="padding-left:25px;">
	<input type="radio"  name="top" value="Meat" required> Meat Toppings(Ksh 150)<br>
</div>
<br>
<div class="row" style="padding-left:25px;">
    <input type="radio"  name="top" value="Vegetable">Vegetable Toppings (Ksh 100) <br>
</div>
<br>
<div class="row" style="padding-left:25px;">
	<input type="radio"  name="top" value="notop" checked> No Toppings (Ksh 0)
</div>
<br><br>
<div class="row">
<h5 name="feed" style="font-size: 20px; color:#3987c9;padding-left:20px;">Feed a Hungry Child Today?</h5>
</div>
<div class="row" style="padding-left:25px;">
<input  type="checkbox" id="donate" name="donate" value="donate">Wish to donate?<br>
</div>
<br>
<br>
<div class="row" style="padding-left:25px;">
<input style="font-size:30px; color: #3987c9;" type="submit" value="ORDER NOW" name="submit" id="submit">
</div>
</div>
</form>

<script type="text/javascript">
var donationamount = 0;
$(document).ready(function(){
	$("#donate").change(function() {
		if(this.checked) {
		(async function getText () {
const {value: text} = await Swal.fire({
	title: 'Enter your donation amount:',
  input: 'number',
  inputPlaceholder: 'donation amount',
  showCancelButton: true,
	type: 'info',
	inputValidator: (value) => {
	if (value<0) {
		return 'You need to input a positive value'
	}}
})

if (text>0) {
	Swal.fire(
  'Bless your Kind Heart!',
  'You have donated! ' + text +' KES',
  'success'
)
donationamount = text;
}
})()

}});
  $("#submit").on('click',
    function(j){
      j.preventDefault();
			var large_pizza = $("#lpizza").val();

      var medium_pizza = $("#mpizza").val();

      var small_pizza = $("#spizza").val();

      var donate = $("#donate").val();

      var topping = $("input[name='top']:checked").val();

			if (large_pizza==0 && medium_pizza ==0 && small_pizza==0) {
				Swal.fire({
				type: 'error',
				title: 'Error',
				text: 'You have to order at least 1 Pizza',
			})
			return false;
			}

      $.post("order.php",
      {
      	large:large_pizza,
      	small:small_pizza,
      	medium:medium_pizza,
      	top:topping,
      	donate:donationamount
			},
      	function (result){

      		if (result!="error") {
						var largepizzastmt = "";
						var mediumpizzastmt = "";
						var smallpizzastmt = "";
						var toppingstmt = "";
						var donationstmt = "";


						var p = JSON.parse(result);
						if (large_pizza!=0) {
							largepizzastmt = large_pizza + " X   Large Pizza = <b>" + p.lpizza + "</b><br/>";
						}
						if (medium_pizza!=0) {
							mediumpizzastmt = medium_pizza + " X   Medium Pizza = <b>" + p.mpizza + "</b><br/>";
						}
						if (small_pizza!=0) {
							smallpizzastmt = small_pizza + " X   Small Pizza = <b>" + p.spizza + "</b><br/>";
						}
						if (topping!="notop") {
							toppingstmt = topping + " Topping X "+p.pizzaquantity+" = <b>" + p.toptotal + "</b><br/>";
						}

						if (donationamount!=0) {
							donationstmt = "<b>Bless your kind heart. Thank You for your donation of: " +donationamount+ "</b><br/>";
						}

						Swal.fire({
											type: 'success',
											title: 'Thank You ' + p.username + ' for Ordering with OrderID: ' + p.orderid ,
											html:
												'<b>Order Details:</b><br/> ' +largepizzastmt+mediumpizzastmt+smallpizzastmt+toppingstmt+donationstmt+' Your Total is: <b>' +p.total+'</b>',
										})
										document.getElementById("orderform").reset();
      		}
					else {
											Swal.fire({
										  type: 'error',
										  title: 'Oops...',
										  text: 'Something went wrong!, Try Again',
										})
					}
      	});
  });
});
</script>
</body>
</html>
