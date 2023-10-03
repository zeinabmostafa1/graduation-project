<?php 
session_start();
if(!isset($_SESSION['admin'])){
    header('location:adminlogin.php');
}
include ('../database/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$name=mysqli_real_escape_string($conn,$_POST['name']);
$id=mysqli_real_escape_string($conn,$_POST['id']);

$_SESSION['school_name']= $name;
$_SESSION['school_id']= $id;

header("Location:view-package.php");


}
include ('nav.php');

    $sql= "SELECT * from `schools`  ";
    $result=mysqli_query($conn,$sql);




?>

<div class="container pt-5">
    <div class="row">
        <div class="col-8 mx-auto">
        <p class="fs-1">All Schools</p>

            <?php include ('../validation/message.php'); ?>

            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Descrption</th>
                        <th scope="col">IMG</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php $c=1; if(isset($result)): foreach($result as $value):?>
                    <tr>
                        <th scope="row"><?php echo $c++; ?></th>
                        <td><?php echo $value['name'] ?></td>
                        <td><?php echo $value['descrption'] ?></td>
                        <td> 
                    <center>
                        <img src="../uploads/<?php echo $value['img'] ?>" width="150px" alt="">    
                    </center>
                        </td>
                        <td>  <a href="update-school.php?id=<?php echo $value['id']; ?> " class="btn btn-primary "> Update</a>
                            <a href="../school/delete.php?id=<?php echo $value['id']; ?> " class="btn btn-danger "> Delete</a>
                            <form method="post">
                            <button type="submit"  name="sub" class="btn btn-warning m-2 "> Packages </button>
                            <input type="hidden" name="name"  value=" <?php echo $value['name']; ?>"  >
                            <input type="hidden" name="id"  value=" <?php echo $value['id']; ?>"  >
                            </form>

                        </td>
                    </tr>
                    
                    <?php endforeach;endif ?>
                </tbody>
            </table>
            <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>