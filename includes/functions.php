<?php
require_once('load.php');

$GLOBAL['1'] = "Pontos para Dados";
$GLOBAL['2'] = "Pontos para Voz e SMS";
$GLOBAL['3'] = "Pontos para Viagens";
$GLOBAL['4'] = "Pontos para Dinheiro";
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
