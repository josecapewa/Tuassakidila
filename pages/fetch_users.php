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
        <td data-id="' . $user['id'] . '">' . $user['rf_id'] . '</td>
        <td><img class="rounded-circle me-2 clickable-image" width="30" height="30" src="../uploads/' . $user['imagem'] . '" data-toggle="modal" data-target="#imageModal" data-img-src="../uploads/' . $user['imagem'] . '">' . $user['nome'] . '</td>
        <td>' . $user['level'] . '</td>
        <td>' . $user['email'] . '</td>
        <td>' . $user['pontos'] . '</td>
        <td>
            <button class="btn btn-sm btnE editBtn" data-id="' . $user['id'] . '">Editar</button>
            <button class="btn btn-sm btn-danger deleteBtn btnD" data-toggle="modal" data-target="#deleteModal" data-id="' . $user['id'] . '">Deletar</button>
        </td>
    </tr>');
}
