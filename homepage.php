<?php
$account=$_POST['account'];
$passwrd=$_POST['password'];
include 'dbconnect.php';
$sql = "SELECT * from users where username = '$account' and password='$passwrd'";
$result = mysqli_query($db ,$sql);
if (mysqli_num_rows($result) > 0 ){
//output id# of login user
    while($row = mysqli_fetch_assoc($result)){
        echo "login as " .$row["CWID"] .$row["firstname"] .$row["lastname"];
    }
}
?> 