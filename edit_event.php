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
include 'dbconnect.php';
$event_array= array();

class event
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

$sql2 = "SELECT * from events where CWID = '$CWID'";
    foreach ($db->query($sql2) as $data) {
      $events = new event();
      $events->set_name($data["event_name"]);
      $events->set_detail($data["event_detail"]);
      $events->set_date($data["event_date"]);
      if ($events->get_name() != null) {
        array_push($event_array, $events);
        }
      }    
   
function cmp($a, $b) {
        return strcmp($a->get_date(), $b->get_date());
    }
    
usort($event_array, "cmp");
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
        <a class="home-header-logo text-dark" href="">Add Event</a>
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
<?php foreach ($event_array as $event_array) : ?>
    <div class="col-4">

  <div class="card">
  <div class="card-header"><?php echo $event_array->get_name(); ?></div>
    <div class="card-body">
      <p class="card-text"><?php echo $event_array->get_detail(); ?></p>
      <p class="card-text"><small class="text-muted"><?php echo $event_array->get_date(); ?></small></p>
    </div>
    </div>

  </div>
<?php endforeach; ?>
</div>
<br>

<div class="row">
    <div class="col">
        <h2>Add New Event</h2>
    </div>
</div>

<?php

      if (isset($_POST['submit']) && !empty($_POST['event_name'])){
        $eventname = $_POST['event_name'];
        $eventdetail = $_POST['event_detail'];
        $eventdate = $_POST['event_date'];
        $eventsql = "SELECT * FROM events WHERE event_name ='$eventname' AND CWID='$CWID' ";
        $eventraw = mysqli_query($db, $eventsql);
        if(mysqli_num_rows($eventraw) > 0) {
          $errormsg="event name already exists";
          header("location: edit_task.php?errormsg=$errormsg");
        }
        else{
            $sql = "INSERT INTO events (event_name, event_detail, event_date, CWID) VALUES ('$eventname', '$eventdetail', '$eventdate','$CWID') ";
            $sqlrslt = mysqli_query($db, $sql);


            if ($sqlrslt)  {
                header("location: homepage.php");
            }
            else{
                $errormsg="error occured". mysqli_error($db);
                header("location: edit_event.php?errormsg=$errormsg");  
            }
        }  
      }

    ?>
<div class="alert alert-light" role="alert"> <?php if (isset($_GET['errormsg'])) {
                                                    echo $_GET['errormsg'];
                                                  } ?></div>
<form  method="post" enctype="multipart/form-data">

<div class="form-group">
       <label for="events"><h2>event name:</h2></label>
       <input type="test" class="form-control" name="event_name" placeholder="enter event name">
</div>

    <div class="form-group">
       <label for="events"><h2>event detail:</h2></label>
       <textarea class="form-control" name="event_detail" rows="3"></textarea>
    </div>
    
    <div class="row">
                <div class="col-3">
                    <h2>event date:</h2>
                </div>
                <div class="col-3">
                    <input type="date" class="form-control" id="validationToolTip" name="event_date" placeholder="YYYY-MM-DD" required>
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