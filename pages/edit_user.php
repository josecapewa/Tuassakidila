<?php
    require_once('../includes/load.php');
    if(isset($_POST['edit_user'])){
        $id = (int)$_POST['id'];
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $user_level = isset($_POST['user_level']) ? $_POST['user_level'] : '';

        if(!empty($email) && !empty($name) && !empty($user_level)){
            $sql = "UPDATE usuario SET nome = '$name', email = '$email', level = '$user_level' WHERE id = $id";
            if($db->query($sql)){
                $session->msg('s', "usuário atualizado com sucesso");
                header("Location: users.php");
            } else {
                echo "Erro ao atualizar o usuário.";
            }
        }else{
            echo "Preencha todos os campos.";
        }
    }
