<?php

include('templates/header.php');
include('config/connect.php');

$id_to_create = '';
$street_address = '';
$district = '';
$city_id ='';
$postal_code = '';
$phone = '';
date_default_timezone_set("Asia/Kuala_Lumpur");
$last_update = date("Y-m-d H:i:s");
$errors = array('id'=>'', 'street_address'=>'', 'district'=>'', 'city_id'=>'', 'postal_code'=>'', 'phone'=>'');

if(isset($_POST['submit'])){

    $id_to_create = $_POST['id'];

    if(empty($_POST['id'])){
        $errors['id'] = 'ID is required. <br />';
    }
    else{
        $sql_check_id = "SELECT address_id FROM address WHERE address_id = $id_to_create";
        $result_check_id = mysqli_query($conn, $sql_check_id);

        if(mysqli_num_rows($result_check_id) > 0){
            $errors['id'] = 'ID is already in the table. Please key in another ID. <br />';
        }
    }

    if(empty($_POST['street_address'])){
        $errors['street_address'] = 'Street address is required. <br />';
    }
    else{
        $street_address = $_POST['street_address'];
    }

    if(empty($_POST['district'])){
        $errors['district'] = 'District is required. <br />';
    }
    else{
        $district = $_POST['district'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $district)){
            $errors['district'] = 'District must be letters and/or spaces only.';
        }
    }

    if(empty($_POST['city_id'])){
        $errors['city_id'] = 'City Id is required. <br />';
    }
    else{
        $city_id = $_POST['city_id'];
    }

    if(array_filter($errors)){
        //
    }
    
    else{
        $phone = $_POST['phone'];
        $postal_code = $_POST['postal_code'];

        $sql = "INSERT INTO address (address_id, street_address, district, city_id, postal_code, phone, last_update) VALUES ('$id_to_create', '$street_address', '$district', '$city_id', '$postal_code', '$phone', '$last_update')";

        if(mysqli_query($conn, $sql)){
            header('Location: address.php');
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

    <form action="create_address.php" class="white" method="POST">
		<label>Address Id</label>
        <input type="text" name="id" value="<?php echo htmlspecialchars($id_to_create) ?>">
        <div class="red-text"><?php echo $errors['id']; ?></div>

		<label>Street Address</label>
		<input type="text" name="street_address" value="<?php echo htmlspecialchars($street_address) ?>">
        <div class="red-text"><?php echo $errors['street_address']; ?></div>

        <label>District</label>
        <input type="text" name="district" value="<?php echo htmlspecialchars($district) ?>">
        <div class="red-text"><?php echo $errors['district']; ?></div>

        <label>City Id</label>
        <input type="text" name="city_id" value="<?php echo htmlspecialchars($city_id) ?>">
        <div class="red-text"><?php echo $errors['city_id']; ?></div>

        <label>Postal Code</label>
        <input type="text" name="postal_code" value="">

        <label>Phone</label>
        <input type="text" name="phone" value="">

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