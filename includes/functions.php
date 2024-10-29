<?php
require_once('load.php');

$GLOBAL['1'] = "Pontos para Dados";
$GLOBAL['2'] = "Pontos para Voz e SMS";
$GLOBAL['3'] = "Pontos para Dinheiro";
$GLOBAL['4'] = "Pontos para Viagens";
$GLOBAL['5'] = "Pontos para Alimentos";
$GLOBAL['6'] = "Unitel Money";

function getUser($user_id)
{
    global $db;
    $sql = "SELECT * FROM `usuario` WHERE `id` = $user_id";
    if ($result = $db->query($sql)) {
        return $user = $db->fetch_assoc($result);
    } else {
        return false;
    }
}
function getData($table)
{
    global $db;
    $sql = "SELECT * FROM $table";
    $result = $db->query($sql);
    $set_results = $db->while_loop($result);
    return $set_results;
}

function current_user(){
    static $current_user;
    global $db;
    if(isset($_SESSION['user_id'])):
        $user_id = $_SESSION['user_id'];
        $sql = $db->query("SELECT * FROM usuario WHERE id=$user_id LIMIT 1");
        if($result = $db->fetch_assoc($sql))
            $current_user = $result;
        else
            return null;
      endif;
      
    return $current_user;
}

function find_by_groupLevel($level)
  {
    global $db;
    $sql = "SELECT level_name FROM user_level WHERE level_name = '$level' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }

function page_require_level($require_level){
    global $session;
    $current_user = current_user();
    $login_level = find_by_groupLevel($current_user['user_level']);
    if (!$session->isUserLoggedIn(true)):
        header("Location: home.php");
    elseif($current_user['user_level'] <= (int)$require_level):
             return true;
     else:
        header("Location: home.php");
       endif;

    }