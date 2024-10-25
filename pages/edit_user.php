<?php
    require_once('../includes/load.php');
    if(isset($_POST['edit_user'])){
        $id = (int)$_POST['id'];
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email_recuperacao = isset($_POST['email_recuperacao']) ? $_POST['email_recuperacao'] : '';
        $rf_id = isset($_POST['rf_id']) ? $_POST['rf_id'] : '';

        if(!empty($email) && !empty($name) && !empty($email_recuperacao) && !empty($rf_id)){
            $sql = "UPDATE usuario SET nome = '$name', email = '$email', email_recuperacao = '$email_recuperacao', rf_id = '$rf_id' WHERE id = $id";
            if($db->query($sql)){
                header("Location: users.php");
            }
        }
    }
