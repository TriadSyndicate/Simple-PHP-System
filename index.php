<?php
/* The DB Connection is in dir: / Assets/db/dbconnection.php We call it to use it in our file*/
include '/assets/db/dbconnection.php';
$conn = OpenCon();

//get db data
$sql = "SELECT * FROM  userdetails";
$result = $conn->query($sql);
$erruserexists = "";
$erremailexists ="";

//If Form(Submit) is clicked
if(isset($_POST['submit'])){
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $rowuser = $row["username"];
      $rowemail = $row["email"];
      //Check if email/ username already exists
        if($rowuser == htmlentities($_POST['user'])){
          $erruserexists = "Error! Username  already exists!!";
        }
        if ($rowemail ==  htmlentities($_POST['email'])) {
          $erremailexists = "Error! Email already exists!!";
        }
    }
}
//if username & email are unique
if ($erruserexists == "" && $erremailexists =="") {
  session_start(); // Start the session
  $_SESSION['username'] = htmlentities($_POST['user']);
  $_SESSION['email'] = htmlentities($_POST['email']);
  $_SESSION['firstname'] = htmlentities($_POST['firstname']);
  $_SESSION['lastname'] = htmlentities($_POST['lastname']);
  $_SESSION['password'] = htmlentities($_POST['pass']);
  $_SESSION['gender'] = htmlentities($_POST['gender']);
  $_SESSION['dob'] = htmlentities($_POST['dob']);
  $_SESSION['secretword'] = htmlentities($_POST['secretword']);

  //Success creation for account
  header('Location: success.php');
}

}

CloseCon($conn);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="./assets/css/style.css"  rel='stylesheet' type='text/css'>
    <style>
      .error {color: #FF0000;}
    </style>
  </head>
  <body>
    <div id="registration-form">
      <div class='fieldset'>
        <legend>Register for an Account <a class="loginbutton" role="button" href="./login.php">Log In</a></legend>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <div class='row'>
            <label for='firstname'>First Name</label>
            <input type="text" placeholder="First Name" name='firstname' id='firstname' required>
          </div>
          <div class='row'>
            <label for="lastname">Last Name</label>
            <input type="text" placeholder="Last Name" name='lastname' id='lastname' required>
          </div>
          <div class='row'>
            <label for="email">E-mail</label>
            <input type="text" placeholder="E-mail" name='email' required>
            <span class="error"><?php echo $erremailexists; ?></span>
          </div>

          <div class='row'>
            <label for='pass'>Password</label>
            <input type="password" placeholder="Enter Password" name='pass' id='pass' required>
          </div>
          <div class='row'>
            <label for='user'>Username</label>
            <input type="text" placeholder="Enter your username" name="user" id='user' required>
            <span class="error"><?php echo $erruserexists; ?></span>
          </div>
          <div class='row'>
            <label for="gender">Gender</label><br>
            <input type="radio"  name="gender" value="Male" required> Male
            <input type="radio"  name="gender" value="Female"> Female
          </div>
          <br>
          <div class='row'>
            <label for='dob'>Enter Date of Birth</label>
            <input type="date" placeholder="Enter Date of Birth" name='dob' id='dob' required>
          </div>
          <div class='row'>
            <label for="secretword">Secret Word</label>
            <input type="text" placeholder="Secret Word" name='secretword' id='secretword' required>
          </div>


          <input type="submit" value="Register" name="submit">
        </form>
      </div>
    </div>


    <script type="text/javascript">
      function placeholderIsSupported()
      {
  		test = document.createElement('input');
  		return ('placeholder' in test);
    	}

      $(document).ready(function(){
      placeholderSupport = placeholderIsSupported() ? 'placeholder' : 'no-placeholder';
      $('html').addClass(placeholderSupport);
      });
    </script>
    </body>
</html>
