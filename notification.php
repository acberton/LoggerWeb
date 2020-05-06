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
$notinum=0;
include 'dbconnect.php';
$sql = "SELECT * from users where username = '$account'";
$result = mysqli_query($db ,$sql);
if (mysqli_num_rows($result) > 0 ){
//output id# of login user
    $user = mysqli_fetch_assoc($result);
    $CWID=$user["CWID"];   
    $_SESSION['CWID']= $user["CWID"];   
}
class Course
  {
    public $name;
    public $task;
    public $detail;
    public $duedate;
    public $id;

    function set_name($name)
    {
      $this->name = $name;
    }
    function get_name()
    {
      return $this->name;
    }
    function set_task($task)
    {
      $this->task = $task;
    }
    function get_task()
    {
      return $this->task;
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
    function set_id($id)
    {
      $this->id = $id;
    }
    function get_id()
    {
      return $this->id;
    }
  }
//save data from database to object array
$class_array = array(); 
$event_array = array();
$query = "SELECT * FROM classes WHERE CWID = '$CWID' ";
foreach ($db->query($query) as $data) {
  $class = new Course(); 
  $class_id=$data["class_id"];
  $query2 = "SELECT* from class_task 
  Where class_id = '$class_id' AND task_duedate > CURDATE() AND task_duedate < CURDATE() + 3  ";
  $result2= mysqli_query($db ,$query2);
  $data2 = mysqli_fetch_assoc($result2);
  $class->set_name($data["class_name"]);
  $class->set_task($data2["task_name"]);
  $class->set_detail($data2["task_detail"]);
  $class->set_date($data2["task_duedate"]);
  $class->set_id($data["class_id"]);
  if ($class->get_task() != null) {
    array_push($class_array, $class);
  }

  $query5 = "SELECT* from class_task 
  Where class_id = '$class_id' AND task_duedate > CURDATE() AND task_duedate < CURDATE() + 3  ";
  $result5 = mysqli_query($db ,$query5);
  $notinum =$notinum + mysqli_num_rows($result5);
}


$query4 = "SELECT* from events 
where CWID = '$CWID' AND event_date > CURDATE() AND event_date < CURDATE() + 3  ";
$result4 = mysqli_query($db ,$query4);
$notinum =$notinum + mysqli_num_rows($result4);
foreach ($db->query($query4) as $data3) {
    $events = new Course(); 
    $events->set_task($data3["event_name"]);
    $events->set_detail($data3["event_detail"]);
    $events->set_date($data3["event_date"]);
    if ($events->get_task() != null) {
        array_push($event_array, $events);
    }
}

?> 
</head>
<body>
<div class="container">
<header class="home-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="text-muted" href=""><?php echo "login as " .$user["firstname"] ." ".$user["lastname"]." CWID:".$user["CWID"] ; ?></a>
      </div>
      <div class="col-5 text-center">
        <a class="home-header-logo text-dark" href="">Notification</a>
      </div>
      <div class="col-3 d-flex justify-content-between ">


        <a class="btn btn-sm btn-outline-secondary" href="notification.php">Notifications <span class="badge badge-light"><?php echo $notinum ?></span> </a>

        

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


<h5>Class task in 3 days: </h5>  
<br>
<br>

<div class="card-deck">
<?php foreach ($class_array as $class_array) : ?>
    <div class="col-4">

  <div class="card">
  <div class="card-header"><?php echo $class_array->get_name(); ?></div>
    <div class="card-body">
      <h5 class="card-title"><?php echo $class_array->get_task(); ?></h5>
      <p class="card-text"><?php echo $class_array->get_detail(); ?></p>
      <p class="card-text"><small class="text-muted"><?php echo $class_array->get_date(); ?></small></p>

    </div>
    </div>

  </div>
<?php endforeach; ?>
</div>
<br>
<br>

<h5>Events in 3 days: </h5> 
<br>
<br>
<div class="card-deck">
<?php foreach ($event_array as $event_array) : ?>
    

  <div class="card">
  <div class="card-header">Events</div>
    <div class="card-body">
      <h5 class="card-title"><?php echo $event_array->get_task(); ?></h5>
      <p class="card-text"><?php echo $event_array->get_detail(); ?></p>
      <p class="card-text"><small class="text-muted"><?php echo $event_array->get_date(); ?></small></p>

    </div>
    

  </div>
<?php endforeach; ?>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>