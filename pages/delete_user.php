<?php
    require_once('../includes/load.php');

    if(isset($_POST['delete_user'])){
        $id = $_POST['delete_user'];
        $sql = "DELETE FROM usuario WHERE id = '$id'";
        if($db->query($sql)){
            header("Location: users.php");
        }else{
            echo "<script>alert('Erro ao deletar usuário!')</script>";
        }
    }