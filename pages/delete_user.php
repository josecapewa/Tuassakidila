<?php
    require_once('../includes/load.php');

    if(isset($_POST['delete_user'])){
        $id = $_POST['id'];
        $sql = "DELETE FROM usuario WHERE id = '$id'";
        if($db->query($sql)){
            $_SESSION['deleted'] = true;
            header("Location: users.php");
        }else{
            echo "alert('Erro ao deletar usuário!')";
        }
    }