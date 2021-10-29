<?php
$host = "localhost";
$user = "root";
$password = "";
$dbName = "trainingcompany";
$connect = mysqli_connect($host, $user, $password, $dbName);


//create
if (isset($_POST['send'])) {
    $name =  $_POST['courseName'];
    $cost = $_POST['courseCost'];
    $insert = "INSERT INTO `courses` VALUES(null,'$name',$cost)";
    $i = mysqli_Query($connect, $insert);
}
//read
$select = "SELECT * FROM `courses`";
$S = mysqli_Query($connect, $select);
//delete
if(isset($_GET['delete'])){
 $id=$_GET['delete'];
 $delete ="DELETE FROM `courses` WHERE id=$id";
 $d=mysqli_Query($connect,$delete);
 header("location:/testCURD/index.php");
}
$name="";
$cost="";
$update=false;
//update
if(isset($_GET['edit'])){
    $update=true;
   $id= $_GET['edit'];
   $select = "SELECT * FROM `courses` WHERE id=$id";
   $Ss = mysqli_Query($connect, $select);
  $row= mysqli_fetch_assoc($Ss);
  $name =$row['name'];
  $cost =$row['cost'];
  if(isset($_POST['update'])){
    $name =  $_POST['courseName'];
    $cost = $_POST['courseCost'];
    $update ="UPDATE `courses` SET name='$name', cost=    $cost where id =$id";
    $i=mysqli_Query($connect,$update);
    header("location:/testCURD/index.php");
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="/testCURD/index.css">
</head>

<body>
    <div class="container col-md-6 mt-3">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label for="">Course Name</label>
                        <input type="text" value="<?php echo $name ?>" name="courseName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Course Cost</label>
                        <input type="text"  value="<?php echo $cost ?>"  name="courseCost" class="form-control">
                    </div>
                    <?php if($update) :?>
                    <button name="update" class="btn btn-primary">Update Deta</button>
                    <?php else :?>
                    <button name="send" class="btn btn-info">Send Deta</button>
                    <?php endif ;?>
                </form>
            </div>
        </div>
    </div>
    <div class="container col-md-8 mt-3">
        <div class="card">
            <div class="card-body">
                <table class="table table-dark">
                    <tr>
                        <th>ID</th>
                        <th>courseName</th>
                        <th>courseCost</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach($S as $data){ ?>
                    <tr>
                        <th><?php echo $data['id'] ?></th>
                        <th><?php echo $data['name'] ?></th>
                        <th><?php echo $data['cost'] ?></th>
                        <th><a href="/testCURD/index.php?delete=<?php echo $data['id'] ?>" class="btn btn-danger">Delete</a></th>
                        <th><a href="/testCURD/index.php?edit=<?php echo $data['id'] ?>" class="btn btn-primary">Edit</a></th>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>