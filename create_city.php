<?php

include('templates/header.php');
include('config/connect.php');

$id_to_create = '';
$city = '';
$country_id = '';
date_default_timezone_set("Asia/Kuala_Lumpur");
$last_update = date("Y-m-d H:i:s");
$errors = array('id'=>'', 'city'=>'', 'country_id'=>'');

if(isset($_POST['submit'])){

    $id_to_create = $_POST['id'];

    if(empty($_POST['id'])){
        $errors['id'] = 'ID is required. <br />';
    }
    else{
        $sql_check_id = "SELECT city_id FROM city WHERE city_id = $id_to_create";
        $result_check_id = mysqli_query($conn, $sql_check_id);

        if(mysqli_num_rows($result_check_id) > 0){
            $errors['id'] = 'ID is already in the table. Please key in another ID. <br />';
        }
    }

    if(empty($_POST['city'])){
        $errors['city'] = 'City name is required. <br />';
    }
    else{
        $city = $_POST['city'];
    }

    if(empty($_POST['country_id'])){
        $errors['country_id'] = 'Country Id is required. <br />';
    }
    else{
        $country_id = $_POST['country_id'];
    }

    if(array_filter($errors)){
        //
    }
    
    else{
        $sql = "INSERT INTO city (city_id, city, country_id, last_update) VALUES ('$id_to_create', '$city', '$country_id', '$last_update')";

        if(mysqli_query($conn, $sql)){
            header('Location: city.php');
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

    <form action="create_city.php" class="white" method="POST">
		<label>City Id</label>
        <input type="text" name="id" value="<?php echo htmlspecialchars($id_to_create) ?>">
        <div class="red-text"><?php echo $errors['id']; ?></div>

		<label>City Name</label>
		<input type="text" name="city" value="<?php echo htmlspecialchars($city) ?>">
        <div class="red-text"><?php echo $errors['city']; ?></div>

        <label>Country Id</label>
		<input type="text" name="country_id" value="<?php echo htmlspecialchars($country_id) ?>">
        <div class="red-text"><?php echo $errors['country_id']; ?></div>

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