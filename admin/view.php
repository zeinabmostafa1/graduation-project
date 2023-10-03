<?php 
session_start();
if(!isset($_SESSION['admin'])){
    header('location:adminlogin.php');
}

include ('nav.php');
include ('../database/db.php');
if (isset($_SESSION['admin_id'])){
    $user_id=$_SESSION['admin_id'];
    $sql= "SELECT * from `categ`  ";
    $result=mysqli_query($conn,$sql);

}
?>


<div class="container pt-5">
    <div class="row">
        <div class="col-8 mx-auto">
        <p class="fs-1">All Categories</p>

            <?php include ('../validation/message.php'); ?>

            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">IMG</th>
                        <th scope="col">created_at</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php $c=1; if(isset($result)): foreach($result as $value):?>
                    <tr>
                        <th scope="row"><?php echo $c++; ?></th>
                        <td><?php echo $value['name'] ?></td>
                        <td> 
                             <center>
                        <img src="../uploads/<?php echo $value['img'] ?>" width="150px" alt=""> 
                        </center>
                        </td>
                        <td><?php echo $value['created_at'] ?></td>


                        <td>
                            <a href="update-categories.php?id=<?php echo $value['id']; ?> " class="btn btn-primary "> Update</a>
                            <a href="../categories/delete.php?id=<?php echo $value['id']; ?> " class="btn btn-danger "> Delete</a>
                        </td>
                    </tr>
                    <?php endforeach;endif ?>
                </tbody>
            </table>
            <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>