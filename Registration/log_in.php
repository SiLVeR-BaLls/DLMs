<?php 
$conn=mysqli_connect("localhost","root","","dlms");


session_start();
if (isset($_POST['submit'])) {
  $username=$_POST['uname'];
  $password=$_POST['password'];
  
 $query="SELECT * FROM `user_log` WHERE username='".$username."' AND password='".$password."'";
  $result=mysqli_query($conn,$query);

  while ($row=mysqli_fetch_assoc($result)) {
     // print_r($row);
     if ($row['U_type']=="admin") {
         $_SESSION['admin']=$row;
        header("Location:../dashboard/admin/index.php");
      } 
      elseif($row["U_type"]=="student"){
        $_SESSION['student']=$row;
        header("Location:../dashboard/student/index.php");
      }
      elseif($row["U_type"]=="visitor"){
        $_SESSION['visitor']=$row;
        header("Location:../dashboard/visitor/index.php");
      }
      
      else{
        echo "Your UserName Or Password Not Matched!";
      }
  }
  
}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/log_in.css">
  <title>Log In</title>
</head>
<body>
      <center>
         <form class="form" accept="" method="POST" >
         <div class="card">
          <div class="top">
           <a href="../index.html"><img src="pic/logo.png" alt="Logo"></a>
           <strong>Digital Library Management System</strong>
          </div>
          
            <a class="login">Log in</a>
            <div class="inputBox">
                <input name="uname" type="text" required="required">
                <span class="user">Username</span>
            </div>

            <div class="inputBox">
                <input name="password" type="password" required="required">
                <span>Password</span>
            </div>

            <div class="inputBox">          
              <button type="submit" name="submit" class="enter">Enter</button>
              <p>already has account?<a href="sign_up.php"> sign in</a> </p>
            </div>
     </div>
    </form>
</center>
</body>
</html>