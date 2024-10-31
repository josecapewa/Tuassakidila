<?php
require_once('load.php');

$GLOBAL['1'] = "Pontos para Dados";
$GLOBAL['2'] = "Pontos para Voz e SMS";
$GLOBAL['3'] = "Pontos para Kwanzas";
$GLOBAL['4'] = "Pontos para Viagens";
$GLOBAL['5'] = "Pontos para Alimentos";
$GLOBAL['6'] = "Unitel Money";


function first_character($str)
{
    $val = str_replace('-', " ", $str);
    $var = ucfirst($val);
    return $val;
}

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

function getTrocaServico()
{
    global $db;
    $sql = "SELECT t.*, s.nome AS nome_servico 
    FROM trocas t 
    JOIN servicos s ON t.id_servico = s.id";
    $result = $db->query($sql);
    $set_results = $db->while_loop($result);
    return $set_results;
}

function getDataWhere($table, $condition)
{
    global $db;
    $sql = "SELECT * FROM $table WHERE $condition";
    $result = $db->query($sql);
    $set_results = $db->while_loop($result);
    return $set_results;
}

function current_user()
{
    static $current_user;
    global $db;
    if (isset($_SESSION['user_id'])):
        $user_id = $_SESSION['user_id'];
        $sql = $db->query("SELECT * FROM usuario WHERE id=$user_id LIMIT 1");
        if ($result = $db->fetch_assoc($sql))
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
    return ($db->num_rows($result) === 0 ? true : false);
}

function page_require_level($require_level)
{
    global $session;
    $current_user = current_user();
    $login_level = find_by_groupLevel($current_user['user_level']);
    if (!$session->isUserLoggedIn(true)):
        header("Location: home.php");
    elseif ($current_user['user_level'] <= (int)$require_level):
        return true;
    else:
        header("Location: home.php");
    endif;
}

function display_msg($msg = '') {
    $output = ''; 
    if (!empty($msg) && is_array($msg)) {
        foreach ($msg as $key => $value) {
            $output = "<div class=\"alert alert-{$key}\">";
            $output .= "<a href=\"#\" class=\"btn-close me-3\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></a>";
            $output .= first_character($value);
            $output .= "</div>";
        }
    }
    return $output; // Retorne o resultado acumulado
}


// function display_msg($msg = ''){
//     $output = array();
//     if(!empty($msg) && is_array($msg)){
//         foreach($msg as $key => $value){
//             $output = "<div id=\"toast\" class=\"toast\">";
//             $output .= "<div class=\"bg-{$key}\" style=\"display:flex; justify-content:center; margin:auto; width:30%; border-radius: 5px;box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3); padding:15px\">";
//             $output .= first_character($value);
//             $output .= "</div></div>";
//         }
//         return $output;
//     } else {
//         return "";
//     }
// }