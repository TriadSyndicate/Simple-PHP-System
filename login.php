<?php
//db connection
include '/assets/db/dbconnection.php';
$conn = OpenCon();
$sql = "SELECT * FROM  userdetails";
$result = $conn->query($sql);
$loginerrr="";
$loginusererrr ="";

session_start(); // Start the session
$_SESSION['username']="";
$_SESSION['email']="";
$_SESSION['firstname']="";
$_SESSION['lastname']="";
$_SESSION['password']="";
$_SESSION['gender']="";
$_SESSION['dob']="";
$_SESSION['secretword']="";



if(isset($_POST['submit'])){
$useremail = htmlentities($_POST['useroremail']);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($row["username"] == $useremail || $row["email"] == $useremail){
              if (password_verify(htmlentities($_POST['password']), $row["password"])) {
                  // Success!
                  session_start(); // Start the session
                  $_SESSION['username'] = $row["username"];
                  $_SESSION['email'] = $row["email"];
                  $_SESSION['firstname'] = $row["firstName"];
                  $_SESSION['lastname'] = $row["lastName"];
                  $_SESSION['password'] = $row["password"];
                  $_SESSION['gender'] = $row["gender"];
                  $_SESSION['dob'] = $row["dob"];
                  $_SESSION['secretword'] = $row["secretword"];
                  $_SESSION['user_id'] = $row["id"];

                  header('Location: welcome.php');
              }
              else {
                  // Invalid credentials
                $loginerrr  = "Error invalid Password";
              }
        }
        else {
            // Invalid credentials
            $loginusererrr  = "Error invalid Username/Email";
        }
    }
}
}

//echo "Connected Successfully";
CloseCon($conn);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="./assets/css/log.css"  rel='stylesheet' type='text/css'>
    <style>
      .error {color: #FF0000;};
    </style>
  </head>
  <body>
    <div id="login-form">
  <div class='fieldset'>
    <legend>Login <br><br> <a class="regbutton" role="button" href="./index.php">Sign Up</a></legend>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class='row'>
        <label for='useroremail'>Username/Email</label>
        <input type="text" placeholder="Username/Email" name='useroremail' id='useroremail' required>
        <span class="error"><?php echo $loginusererrr; ?></span>
      </div>
      <div class='row'>
        <label for="password">Password</label>
        <input type="password" placeholder="Password" name='password' required>
        <span class="error"><?php echo $loginerrr; ?></span>
      </div>
      <input type="submit" value="Login" name="submit">
    </form>
  </div>
</div>
  </body>
</html>
