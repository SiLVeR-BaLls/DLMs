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
        header("Location:php/admin.php");
      } 
      elseif($row["U_type"]=="student"){
        $_SESSION['student']=$row;
        header("Location:php/user.php");
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
  <link rel="stylesheet" href="css/stu">
  <title>RoleWise</title>
</head>
<body>
  <h1>Login Data</h1>
    <fieldset>
      <legend>Login Form</legend>
      <form class="form" accept="" method="POST" >
        <table>
          
          <tr>
            <td><label>UserName</label></td>
            <td><input class="input" type="text" name="uname" placeholder="Enter User Name"></td>
          </tr>
          <tr>
            <td><label>Password</label></td>
            <td><input class="input" type="text" name="password" placeholder="Enter Password"></td>

            <label for="">
              <div>
                <p>still don't hava account?  <a href="sign_up.php">sign up</a></p>
              </div>
            </label>

         
          </tr>
          <tr>
            <td><input type="submit" name="submit" value="Login"></td>
        </tr>
        </table>
      </form>
    </fieldset>
</body>
</html>