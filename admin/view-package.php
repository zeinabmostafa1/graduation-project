<?php 
session_start();
if(!isset($_SESSION['admin'])){
    header('location:adminlogin.php');
}

include ('../database/db.php');

if (isset($_POST['sub-add'])) {

    $package_id=mysqli_real_escape_string($conn,$_POST['package_id']);
    $package_name=mysqli_real_escape_string($conn,$_POST['package_name']);
    
    $_SESSION['package_name']= $package_name;
    $_SESSION['package_id']= $package_id;
    
    header("Location:add-prod-to-packge.php");
    
    
    }

    if (isset($_POST['sub-edit'])) {

        $package_id=mysqli_real_escape_string($conn,$_POST['package_id']);
        $package_name=mysqli_real_escape_string($conn,$_POST['package_name']);
        
        $_SESSION['package_name']= $package_name;
        $_SESSION['package_id']= $package_id;
        
        header("Location:edit-packge.php");
        
        
        }

include ('nav.php');



    $school_name= $_SESSION['school_name'];

    $school_id= $_SESSION['school_id'];

    $sql = "SELECT packages.*, quality.name AS quality_name 
    FROM packages
    INNER JOIN quality ON packages.quality_id = quality.id
    WHERE packages.school_id = '$school_id'";

    $result=mysqli_query($conn,$sql);


?>

 <center>

 <h1 style="color: #e74c3c; font-size: 32px; text-align: center; text-transform: uppercase; font-weight: bold; letter-spacing: 2px;"><?php echo $_SESSION['school_name'] ?> School</h1>
 </center>

<a href="view-school.php" class="btn btn-primary col-1  mx-auto m-3"> Go back</a>
<div class="container pt-5">
    <div class="row">

        <div class="col-9 mx-auto">
            <p class="fs-1">View <mark> <?php echo $school_name ;?></mark> Packages</p>
            
            <a href="add-package.php" class="btn btn-primary col-8  mx-auto m-3"> Add New Package </a>
            <?php include ('../validation/message.php'); ?>

            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">IMG</th>
                        <th scope="col">Quality</th>
                        <th scope="col">Price</th>
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

                        <td><?php echo $value['quality_name'] ?></td>
                        <td><?php echo $value['price'] ?></td>

                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="package_id" value="<?php echo $value['id']; ?>">
                                <input type="hidden" name="package_name" value="<?php echo $value['name']; ?>">
                                <button  type="submit" name="sub-add" class="btn btn-success "> Add </button>
                            </form>
                            <form action="" method="post">
                                <input type="hidden" name="package_id" value="<?php echo $value['id']; ?>">
                                <input type="hidden" name="package_name" value="<?php echo $value['name']; ?>">
                                <button  type="submit" name="sub-edit" class="btn btn-warning "> Edit </button>
                            </form>
                        <a href="../school/delete-package.php?id=<?php echo $value['id']; ?> " class="btn btn-danger "> Delete</a>
                        <a href="update-package.php?id=<?php echo $value['id']; ?> " class="btn btn-warning "> Edit package</a>
                        </td>
                    </tr>
                    <?php endforeach;endif ?>
                </tbody>
            </table>
            <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>