<?php
    require_once('../includes/load.php');
    if(isset($_POST['edit_user'])){
        $id = (int)$_POST['id'];
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $name = isset($_POST['name']) ? $_POST['name'] : '';

        if(!empty($email) && !empty($name)){
            $sql = "UPDATE usuario SET nome = '$name', email = '$email' WHERE id = $id";
            if($db->query($sql)){
                header("Location: users.php");
            } else {
                echo "Erro ao atualizar o usuário.";
            }
        }else{
            echo "Preencha todos os campos.";
        }
    }
