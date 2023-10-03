<?php
include ('../database/db.php');
include ('../validation/validation.php');

session_start();
$errors=[];


if (isset($_POST["submit"])) {
    $categname = mysqli_real_escape_string($conn, $_POST['categname']);


    if (empty($categname)) {
        $errors[] = "Enter Name";
    } else {
        if (!minLength($categname, 3)) {
            $errors[] = "Enter Valid Name";
        }
    }

    if (isset($_SESSION['admin_id']) && isset($_GET['id'])) {
        $user_id = $_SESSION['admin_id'];
        $id = $_GET['id'];
    }

    $sql = "SELECT `name` FROM `categ` WHERE  `id` != '$id' AND `name` = '$categname'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row != null) {
        $errors[] = "Name is already exist";
    }

    if (empty($errors)) {
        $IMG = $_FILES['IMG'];
        $sql2 = "SELECT img FROM categ WHERE id = '$id'";
        $result2 = mysqli_query($conn, $sql2);
        $img = mysqli_fetch_assoc($result2);
        $currentImg = $img['img'];
        // Check if a new image is provided
        if (!empty($IMG['name'])) {
            $target_dir = "../uploads/"; // Directory where the uploaded image will be saved
    
            // Delete the current image file
            if (!empty($currentImg)) {
                $filePath = $target_dir . $currentImg;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            include('../upload-mang/upload.php');
            // Upload the new image file
            uploadImage($_FILES['IMG'], $target_dir, $errors);
            $imgName = $_SESSION['IMG'];
            $sql1 = "UPDATE `categ` SET `name` = '$categname', `img` = '$imgName' WHERE `id` = '$id'";
            if (mysqli_query($conn, $sql1)) {
                $_SESSION['Done'] = "Category Updated";
                header("Location: ../admin/update-categories.php?id=$id");
            } else {
                $_SESSION['errors'] = ['Category Not Updated'];
                header("Location: ../admin/update-categories.php?id=$id");
            }

        } else {
            $sql1 = "UPDATE `categ` SET `name` = '$categname' WHERE `id` = '$id'";
            if (mysqli_query($conn, $sql1)) {
                $_SESSION['Done'] = "Category Updated";
                header("Location: ../admin/update-categories.php?id=$id");
            } else {
                $_SESSION['errors'] = ['Category Not Updated'];
                header("Location: ../admin/update-categories.php?id=$id");
            }

        }
    
    } else {
        $_SESSION['errors'] = $errors;
        header("Location: ../admin/update-categories.php?id=$id");
    }
    
}
?>