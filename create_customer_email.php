<?php

include('templates/header.php');
include('config/connect.php');

$id_to_create = '';
$customer_id = '';
$email = '';
$active ='';
$create_date = '';
date_default_timezone_set("Asia/Kuala_Lumpur");
$last_update = date("Y-m-d H:i:s");
$errors = array('id'=>'', 'customer_id'=>'', 'email'=>'', 'active'=>'', 'create_date'=>'');

if(isset($_POST['submit'])){

    $id_to_create = $_POST['id'];

    if(empty($_POST['id'])){
        $errors['id'] = 'ID is required. <br />';
    }
    else{
        $sql_check_id = "SELECT email_id FROM customer_email WHERE email_id = $id_to_create";
        $result_check_id = mysqli_query($conn, $sql_check_id);

        if(mysqli_num_rows($result_check_id) > 0){
            $errors['id'] = 'ID is already in the table. Please key in another ID. <br />';
        }
    }

    if(empty($_POST['customer_id'])){
        $errors['customer_id'] = 'Customer Id is required. <br />';
    }
    else{
        $customer_id = $_POST['customer_id'];
    }

    if(empty($_POST['email'])){
        $errors['email'] = 'Email is required. <br />';
    }
    else{
        $email = $_POST['email'];
    }

    if(empty($_POST['active'])){
        $errors['active'] = 'Active is required. <br />';
    }
    else{
        $active = $_POST['active'];
    }

    if(empty($_POST['create_date'])){
        $errors['create_date'] = 'Create date is required. <br />';
    }
    else{
        $create_date = $_POST['create_date'];
    }

    if(array_filter($errors)){
        //
    }
    
    else{
        $sql = "INSERT INTO customer_email (email_id, customer_id, email, active, create_date, last_update) VALUES ('$id_to_create', '$customer_id', '$email', '$active', '$create_date', '$last_update')";

        if(mysqli_query($conn, $sql)){
            header('Location: customer_email.php');
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

    <form action="create_customer_email.php" class="white" method="POST">
		<label>Email Id</label>
        <input type="text" name="id" value="<?php echo htmlspecialchars($id_to_create) ?>">
        <div class="red-text"><?php echo $errors['id']; ?></div>

		<label>Customer Id</label>
		<input type="text" name="customer_id" value="<?php echo htmlspecialchars($customer_id) ?>">
        <div class="red-text"><?php echo $errors['customer_id']; ?></div>

        <label>Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email) ?>">
        <div class="red-text"><?php echo $errors['email']; ?></div>

        <label>Active</label>
        <input type="text" name="active" value="<?php echo htmlspecialchars($active) ?>">
        <div class="red-text"><?php echo $errors['active']; ?></div>

        <label for="create_date">Create Date</label>
        <input type="datetime-local" id="create_date" name="create_date" value="<?php echo htmlspecialchars($create_date) ?>">
        <div class="red-text"><?php echo $errors['create_date']; ?></div>
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