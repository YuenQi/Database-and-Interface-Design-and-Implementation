<?php

include('templates/header.php');
include('config/connect.php');

$id_to_create = '';
$film_id = '';
$store_id = '';
date_default_timezone_set("Asia/Kuala_Lumpur");
$last_update = date("Y-m-d H:i:s");
$errors = array('id'=>'', 'film_id'=>'', 'store_id'=>'');

if(isset($_POST['submit'])){

    $id_to_create = $_POST['id'];

    if(empty($_POST['id'])){
        $errors['id'] = 'ID is required. <br />';
    }
    else{
        $sql_check_id = "SELECT inventory_id FROM inventory WHERE inventory_id = $id_to_create";
        $result_check_id = mysqli_query($conn, $sql_check_id);

        if(mysqli_num_rows($result_check_id) > 0){
            $errors['id'] = 'ID is already in the table. Please key in another ID. <br />';
        }
    }

    if(empty($_POST['film_id'])){
        $errors['film_id'] = 'Film Id is required. <br />';
    }
    else{
        $film_id = $_POST['film_id'];
    }

    if(empty($_POST['store_id'])){
        $errors['store_id'] = 'Store Id is required. <br />';
    }
    else{
        $store_id = $_POST['store_id'];
    }

    if(array_filter($errors)){
        //
    }
    
    else{
        $sql = "INSERT INTO inventory (inventory_id, film_id, store_id, last_update) VALUES ('$id_to_create', '$film_id', '$store_id', '$last_update')";

        if(mysqli_query($conn, $sql)){
            header('Location: inventory.php');
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

    <form action="create_inventory.php" class="white" method="POST">
		<label>Inventory Id</label>
        <input type="text" name="id" value="<?php echo htmlspecialchars($id_to_create) ?>">
        <div class="red-text"><?php echo $errors['id']; ?></div>

		<label>Film Id</label>
		<input type="text" name="film_id" value="<?php echo htmlspecialchars($film_id) ?>">
        <div class="red-text"><?php echo $errors['film_id']; ?></div>

        <label>Store Id</label>
		<input type="text" name="store_id" value="<?php echo htmlspecialchars($store_id) ?>">
        <div class="red-text"><?php echo $errors['store_id']; ?></div>
        
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