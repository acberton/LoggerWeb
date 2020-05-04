<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"></head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link href="homepage.css" rel="stylesheet">
<?php
session_start(); 
$account= $_SESSION['username'];
$CWID=$_SESSION['CWID'];
$class_id= $_GET["class_id"];
include 'dbconnect.php';
$task_array= array();

class task
    {
      public $name;
      public $detail;
      public $duedate;
      function set_name($name)
      {
        $this->name = $name;
      }
      function get_name()
      {
        return $this->name;
      }
      function set_detail($detail)
      {
        $this->detail = $detail;
      }
      function get_detail()
      {
        return $this->detail;
      }
      function set_date($duedate)
      {
        $this->date = $duedate;
      }
      function get_date()
      {
        return $this->date;
      }
    }

$sql = "SELECT * from users where username = '$account'";
$result = mysqli_query($db ,$sql);
if (mysqli_num_rows($result) > 0 ){
//output id# of login user
    $row = mysqli_fetch_assoc($result);
        
}
$sql2 = "SELECT class_name from classes where class_id = '$class_id'";
$result2 = mysqli_query($db ,$sql2);
if (mysqli_num_rows($result2) > 0 ){
  //output classname
      $row2 = mysqli_fetch_assoc($result2);
          
  }
$sql3 = "SELECT * from class_task where class_id = '$class_id'";
    foreach ($db->query($sql3) as $data) {
      $class_task = new task();
      $class_task->set_name($data["task_name"]);
      $class_task->set_detail($data["task_detail"]);
      $class_task->set_date($data["task_duedate"]);
      if ($class_task->get_name() != null) {
        array_push($task_array, $class_task);
        }
      }    
    

?> 
</head>
<body>
<div class="container">
<header class="home-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="text-muted" href=""><?php echo "login as " .$row["firstname"] ." ".$row["lastname"]." CWID:".$row["CWID"] ; ?></a>
      </div>
      <div class="col-5 text-center">
        <a class="home-header-logo text-dark" href="">Add Task for <?php echo $row2["class_name"] ?> </a>
      </div>
      <div class="col-3 d-flex justify-content-between ">


        <a class="btn btn-sm btn-outline-secondary" href="">Notifications <span class="badge badge-light">0</span> </a>

        

        <a class="btn btn-sm btn-outline-secondary" href="login.php">Log Out</a>
      </div>
    </div>
  </header>
  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
      <a class="p-2 text-muted" href="homepage.php">Home</a>
      <a class="p-2 text-muted" href="">Class</a>
      
    </nav>
  </div>

  <div class="container">

<div class="card-deck">
<?php foreach ($task_array as $task_array) : ?>
    <div class="col-4">

  <div class="card">
  <div class="card-header"><?php echo $task_array->get_name(); ?></div>
    <div class="card-body">
      <p class="card-text"><?php echo $task_array->get_detail(); ?></p>
      <p class="card-text"><small class="text-muted"><?php echo $task_array->get_date(); ?></small></p>
    </div>
    </div>

  </div>
<?php endforeach; ?>
</div>

<div class="row">
    <div class="col">
        <h2>Add New Task</h2>
    </div>
</div>
<br>
<?php

      if (isset($_POST['submit']) && !empty($_POST['task_name'])){
        $taskname = $_POST['task_name'];
        $taskdetail = $_POST['task_detail'];
        $taskduedate = $_POST['due_date'];
        $tasksql = "SELECT * FROM class_task WHERE task_name ='$taskname' AND class_id='$class_id' ";
        $taskraw = mysqli_query($db, $tasksql);
        if(mysqli_num_rows($taskraw) > 0) {
          $errormsg="task name already exists";
          header("location: edit_task.php?errormsg=$errormsg&class_id=$class_id");
        }
        else{
            $sql = "INSERT INTO class_task (task_name, task_detail, task_duedate, class_id) VALUES ('$taskname', '$taskdetail', '$taskduedate',(SELECT class_id FROM classes WHERE class_id = '$class_id')) ";
            $sqlrslt = mysqli_query($db, $sql);


            if ($sqlrslt)  {
                header("location: homepage.php");
            }
            else{
                $errormsg="error occured". mysqli_error($db);
                header("location: edit_task.php?errormsg=$errormsg&class_id=$class_id");  
            }
        }  
      }

    ?>
<div class="alert alert-light" role="alert"> <?php if (isset($_GET['errormsg'])) {
                                                    echo $_GET['errormsg'];
                                                  } ?></div>
<form  method="post" enctype="multipart/form-data">

    <div class="row">
        <div class="col-3">
            <h2>task name:</h2>
        </div>
        <div class="col-3">
            <input type="text" name="task_name" required>
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <h2>task detail:</h2>
        </div>
        <div class="col-3">
            <input type="text" name="task_detail" required>
        </div>
    </div>
    
    <div class="row">
                <div class="col-3">
                    <h2>Due date:</h2>
                </div>
                <div class="col-3">
                    <input type="date" class="form-control" id="validationToolTip" name="due_date" placeholder="YYYY-MM-DD" required>
                    <div class="invalid-tooltip">Please Enter Valid Date </div>
                </div>
            </div>

    <div class="row">
        <div class="col-3 offset-3">
            <input type="submit" name="submit" value="Submit">
        </div>
    </div>

</form>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>