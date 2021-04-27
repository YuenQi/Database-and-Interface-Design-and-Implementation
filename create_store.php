<?php

include('templates/header.php');
include('config/connect.php');

$id_to_create = '';
$manager_staff_id = '';
$address_id = '';
date_default_timezone_set("Asia/Kuala_Lumpur");
$last_update = date("Y-m-d H:i:s");
$errors = array('id'=>'', 'manager_staff_id'=>'', 'address_id'=>'');

if(isset($_POST['submit'])){

    $id_to_create = $_POST['id'];

    if(empty($_POST['id'])){
        $errors['id'] = 'ID is required. <br />';
    }
    else{
        $sql_check_id = "SELECT store_id FROM store WHERE store_id = $id_to_create";
        $result_check_id = mysqli_query($conn, $sql_check_id);

        if(mysqli_num_rows($result_check_id) > 0){
            $errors['id'] = 'ID is already in the table. Please key in another ID. <br />';
        }
    }

    if(empty($_POST['manager_staff_id'])){
        $errors['manager_staff_id'] = 'Manager_staff Id is required. <br />';
    }
    else{
        $manager_staff_id = $_POST['manager_staff_id'];
    }

    if(empty($_POST['address_id'])){
        $errors['address_id'] = 'Address Id is required. <br />';
    }
    else{
        $address_id = $_POST['address_id'];
    }

    if(array_filter($errors)){
        //
    }
    
    else{
        $sql = "INSERT INTO store (store_id, manager_staff_id, address_id, last_update) VALUES ('$id_to_create', '$manager_staff_id', '$address_id', '$last_update')";

        if(mysqli_query($conn, $sql)){
            header('Location: store.php');
        }
        else{
            echo 'query error: ' . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>

<body>

    <form action="create_store.php" class="white" method="POST">
		<label>Store Id</label>
        <input type="text" name="id" value="<?php echo htmlspecialchars($id_to_create) ?>">
        <div class="red-text"><?php echo $errors['id']; ?></div>

		<label>Manager_staff Id</label>
		<input type="text" name="manager_staff_id" value="<?php echo htmlspecialchars($manager_staff_id) ?>">
        <div class="red-text"><?php echo $errors['manager_staff_id']; ?></div>

        <label>Address Id</label>
		<input type="text" name="address_id" value="<?php echo htmlspecialchars($address_id) ?>">
        <div class="red-text"><?php echo $errors['address_id']; ?></div>

        <div class="center">
            <input type="submit" name="submit" value="Next" class="btn brand z-depth-0">
        </div>
    </form>

    <form action="create.php" method="POST">
        <input type="hidden" name="id" value="">
        <input type="submit" name="back" value="Back to previous page" class=" right btn brand z-depth-0">

    </form>

</body>

</html>