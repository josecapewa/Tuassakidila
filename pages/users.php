<?php
require_once('../includes/load.php');
$users = getData('usuario');

$sql = "SELECT COUNT(*) FROM usuario";
$result = $db->query($sql);
$row = $result->fetch_row();
$total_registros = $row[0];

$registros_por_pagina = isset($_GET['registros_por_pagina']) ? intval($_GET['registros_por_pagina']) : 10;
$pagina_atual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;

$inicio = ($pagina_atual - 1) * $registros_por_pagina;
$total_paginas = ceil($total_registros / $registros_por_pagina);

// Fetch users for the current page
$users = array_slice($users, $inicio, $registros_por_pagina);
?>
<?php include("menus.php") ?>
<div class="container-fluid ">
    <h3 class="text-dark mb-4">Usuários</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Informações de Usuários</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 text-nowrap">
                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                        <label class="form-label">Mostrar&nbsp;
                            <select class="d-inline-block form-select form-select-sm" id="recordsPerPage" name="registros_por_pagina" onchange="changeRecordsPerPage()">
                                <option value="10" <?php echo ($registros_por_pagina == 10) ? 'selected' : ''; ?>>10</option>
                                <option value="25" <?php echo ($registros_por_pagina == 25) ? 'selected' : ''; ?>>25</option>
                                <option value="50" <?php echo ($registros_por_pagina == 50) ? 'selected' : ''; ?>>50</option>
                                <option value="100" <?php echo ($registros_por_pagina == 100) ? 'selected' : ''; ?>>100</option>
                            </select>&nbsp;
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                </div>
            </div>
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="userTable">
                    <thead>
                        <tr>
                            <th>Rf_Id</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>E-mail de Recuperação</th>
                            <th>Pontos</th>
                            <th>Modificar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($users as $user) {
                            $ponto = rand(1, 1000);
                            $rf_id = $user['id'];
                            echo ('<tr>
                                <td>' . $rf_id . '</td>
                                <td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/avatars/avatar3.jpeg?h=c5166867f10a4e454b5b2ae8d63268b3">' . $user['nome'] . '</td>
                                <td>' . $user['email'] . '</td>
                                <td>' . $user['email_recuperacao'] . '</td>
                                <td>' . $ponto . '</td>
                                <td>
                                    <button class="btn btn-info btn-sm editBtn" data-id="' . $rf_id . '" style="
                                            background-color: #4FB8FC;
                                            color: #fff;">Editar</button>
                                    <button class="btn btn-danger btn-sm deleteBtn" data-toggle="modal" data-target="#deleteModal" data-id="' . $rf_id . '" >Deletar</button>
                                </td>
                            </tr>');
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Mostrando de <?php echo ($inicio + 1) ?> à <?php echo min($inicio + $registros_por_pagina, $total_registros) ?> de <?php echo ($total_registros) ?></p>
                </div>
                <div class="col-md-6">
                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                            <?php

                            $pagina_atual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;

                            $inicio = max(1, $pagina_atual - 1);
                            $fim = min($inicio + 2, $total_paginas);

                            if ($pagina_atual > 1) {
                                echo '<li class="page-item"><a class="page-next" aria-label="Previous" href="?pagina=' . ($pagina_atual - 1) . '"><span aria-hidden="true">«</span></a></li>';
                            } else {
                                echo '<li class="page-item disabled"><a class="page-next" aria-label="Previous" href="#"><span aria-hidden="true">«</span></a></li>';
                            }

                            for ($i = $inicio; $i <= $fim; $i++) {
                                if ($i == $pagina_atual) {
                                    echo '<li class="page-item active"><a class="page-next" href="#" style="background-color: #027D51; color: white;">' . $i . '</a></li>';
                                } else {
                                    echo '<li class="page-item"><a class="page-next" href="?pagina=' . $i . '">' . $i . '</a></li>';
                                }
                            }

                            if ($pagina_atual < $total_paginas) {
                                echo '<li class="page-item"><a class="page-next" aria-label="Next" href="?pagina=' . ($pagina_atual + 1) . '"><span aria-hidden="true">»</span></a></li>';
                            } else {
                                echo '<li class="page-item disabled"><a class="page-next" aria-label="Next" href="#"><span aria-hidden="true">»</span></a></li>';
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="modal fade"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" id="deleteModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Aviso!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que pretende deletar este usuario?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function changeRecordsPerPage() {
                var recordsPerPage = $('#recordsPerPage').val();
                loadUsers(1, recordsPerPage); // Reset to page 1
            }

            $(document).on('click', '.pagination .page-link', function(e) {
                e.preventDefault();
                var page = $(this).data('page');
                var recordsPerPage = $('#recordsPerPage').val();
                loadUsers(page, recordsPerPage);
            });

            function loadUsers(page, recordsPerPage) {
                $.ajax({
                    url: 'fetch_users.php', // New PHP file to handle the AJAX request
                    type: 'GET',
                    data: {
                        pagina: page,
                        registros_por_pagina: recordsPerPage
                    },
                    success: function(data) {
                        $('#userTable tbody').html(data);
                        // Update pagination or other info if needed
                    }
                });
            }
            $(document).on('click', '.deleteBtn', function() {
                var userId = $(this).data('id');
                // Aqui você pode definir a imagem que deseja mostrar
                $('#modal-image').attr('src', 'caminho/para/a/imagem/' + userId + '.jpeg');
                $('#deleteModal').modal('show'); // Abre o modal
            });
        </script>

        <?php include("footer.php") ?>