<?php
require_once('../includes/load.php');

$registros_por_pagina = isset($_GET['registros_por_pagina']) ? intval($_GET['registros_por_pagina']) : 10;
$pagina_atual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;

$users = getData('usuario');
$total_registros = count($users);
$total_paginas = ceil($total_registros / $registros_por_pagina);

$inicio = ($pagina_atual - 1) * $registros_por_pagina;
$users = array_slice($users, $inicio, $registros_por_pagina);

foreach ($users as $user) {
    $ponto = rand(1, 1000);
    $rf_id = $user['id'];
    echo ('<tr>
        <td>' . $rf_id . '</td>
        <td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/avatars/avatar3.jpeg?h=c5166867f10a4e454b5b2ae8d63268b3">' . $user['nome'] . '</td>
        <td>' . $user['email'] . '</td>
        <td>' . $ponto . '</td>
        <td>
            <button class="btn btnE btn-sm editBtn" data-id="' . $rf_id . '"">Editar</button>
            <button class="btn btn-danger btn-sm deleteBtn btnD" data-id="' . $rf_id . '">Deletar</button>
        </td>
    </tr>');
}
