<?php

include('templates/header.php');
include('config/connect.php');

$id_to_create = '';
$special_feature = '';
date_default_timezone_set("Asia/Kuala_Lumpur");
$last_update = date("Y-m-d H:i:s");
$errors = array('id'=>'', 'special_feature'=>'');

if(isset($_POST['submit'])){

    $id_to_create = $_POST['id'];

    if(empty($_POST['id'])){
        $errors['id'] = 'ID is required. <br />';
    }
    else{
        $sql_check_id = "SELECT feature_id FROM feature WHERE feature_id = $id_to_create";
        $result_check_id = mysqli_query($conn, $sql_check_id);

        if(mysqli_num_rows($result_check_id) > 0){
            $errors['id'] = 'ID is already in the table. Please key in another ID. <br />';
        }
    }

    if(empty($_POST['special_feature'])){
        $errors['special_feature'] = 'Special feature is required. <br />';
    }
    else{
        $special_feature = $_POST['special_feature'];
    }

    if(array_filter($errors)){
        //
    }
    
    else{
        $sql = "INSERT INTO feature (feature_id, special_feature, last_update) VALUES ('$id_to_create', '$special_feature', '$last_update')";

        if(mysqli_query($conn, $sql)){
            header('Location: feature.php');
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

    <form action="create_feature.php" class="white" method="POST">
		<label>Feature Id</label>
        <input type="text" name="id" value="<?php echo htmlspecialchars($id_to_create) ?>">
        <div class="red-text"><?php echo $errors['id']; ?></div>

        <label>Special Feature</label>
		<input type="text" name="special_feature" value="<?php echo htmlspecialchars($special_feature) ?>">
        <div class="red-text"><?php echo $errors['special_feature']; ?></div>

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