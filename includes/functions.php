<?php
    require_once('load.php');
    
    function getUser($user_id){
        global $db;
        $sql = "SELECT * FROM `usuario` WHERE `id` = $user_id";
        if($result = $db->query($sql)){
            return $user = $db->fetch_assoc($result);
        } else{
            return false;
        }
    }
    function getData($table){
        global $db;
        $sql = "SELECT * FROM $table";
        $result = $db->query($sql);
        $set_results = $db->while_loop($result);
        return $set_results;
    }

