<?php

include('templates/header.php');
include('config/connect.php');

$id_to_create = '';
$first_name = '';
$last_name = '';
date_default_timezone_set("Asia/Kuala_Lumpur");
$last_update = date("Y-m-d H:i:s");
$errors = array('id'=>'', 'first_name'=>'', 'last_name'=>'');

if(isset($_POST['submit'])){

    $id_to_create = $_POST['id'];

    if(empty($_POST['id'])){
        $errors['id'] = 'ID is required. <br />';
    }
    else{
        $sql_check_id = "SELECT actor_id FROM actor WHERE actor_id = $id_to_create";
        $result_check_id = mysqli_query($conn, $sql_check_id);

        if(mysqli_num_rows($result_check_id) > 0){
            $errors['id'] = 'ID is already in the table. Please key in another ID. <br />';
        }
    }

    if(empty($_POST['first_name'])){
        $errors['first_name'] = 'First name is required. <br />';
    }
    else{
        $first_name = $_POST['first_name'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $first_name)){
            $errors['first_name'] = 'First name must be letters and/or spaces only.';
        }
    }

    if(empty($_POST['last_name'])){
        $errors['last_name'] = 'Last name is required. <br />';
    }
    else{
        $last_name = $_POST['last_name'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $last_name)){
            $errors['last_name'] = 'Last name must be letters and/or spaces only.';
        }
    }

    if(array_filter($errors)){
        //
    }
    
    else{
        $sql = "INSERT INTO actor (actor_id, first_name, last_name, last_update) VALUES ('$id_to_create', '$first_name', '$last_name', '$last_update')";

        if(mysqli_query($conn, $sql)){
            header('Location: actor.php');
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

    <form action="create_actor.php" class="white" method="POST">
		<label>Actor Id</label>
        <input type="text" name="id" value="<?php echo htmlspecialchars($id_to_create) ?>">
        <div class="red-text"><?php echo $errors['id']; ?></div>

		<label>First Name</label>
		<input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name) ?>">
        <div class="red-text"><?php echo $errors['first_name']; ?></div>

		<label>Last Name</label>
		<input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name) ?>">
        <div class="red-text"><?php echo $errors['last_name']; ?></div>

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