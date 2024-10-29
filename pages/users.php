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

$users = array_slice($users, $inicio, $registros_por_pagina);
?>
<?php include("menus.php") ?>
<div class="container-fluid ">
    <link rel="stylesheet" href="./assets/css/styles.min.css">
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
                            <select class="d-inline-block form-select form-select-sm" id="recordsPerPage"
                                name="registros_por_pagina" onchange="changeRecordsPerPage()">
                                <option value="10" <?php echo ($registros_por_pagina == 10) ? 'selected' : ''; ?>>10
                                </option>
                                <option value="25" <?php echo ($registros_por_pagina == 25) ? 'selected' : ''; ?>>25
                                </option>
                                <option value="50" <?php echo ($registros_por_pagina == 50) ? 'selected' : ''; ?>>50
                                </option>
                                <option value="100" <?php echo ($registros_por_pagina == 100) ? 'selected' : ''; ?>>100
                                </option>
                            </select>&nbsp;
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input
                                type="search" class="form-control form-control-sm" aria-controls="dataTable"
                                placeholder="Search"></label></div>
                </div>
            </div>
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="userTable">
                    <thead>
                        <tr>
                            <th>Rf_Id</th>
                            <th>Nome</th>
                            <th>Nível</th>
                            <th>E-mail</th>
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
                                <td data-id="' . $user['id'] . '">' . $user['rf_id'] . '</td>
                                <td><img class="rounded-circle me-2 clickable-image" width="30" height="30" src="../uploads/' . $user['imagem'] . '" data-toggle="modal" data-target="#imageModal" data-img-src="../uploads/' . $user['imagem'] . '">' . $user['nome'] . '</td>
                                <td>' .$user['level']. '</td>
                                <td>' . $user['email'] . '</td>
                                <td>' .$user['pontos']. '</td>
                                <td>
                                    <button class="btn btn-sm btnE editBtn" data-id="' . $user['id'] . '">Editar</button>
                                    <button class="btn btn-sm btn-danger deleteBtn btnD" data-toggle="modal" data-target="#deleteModal" data-id="' . $user['id'] . '">Deletar</button>
                                </td>
                            </tr>');
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Mostrando
                        de <?php echo ($inicio + 1) ?> à <?php echo min($inicio + $registros_por_pagina, $total_registros) ?>
                        de <?php echo ($total_registros) ?></p>
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


        <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" id="deleteModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Aviso!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que pretende deletar este usuario?
                    </div>
                    <form class="modal-footer" action="delete_user.php" method="post">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger" name="delete_user">Confirmar</button>
                        <input type="text" id="delete_data" name="id" value="" hidden>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar Usuário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" action="edit_user.php" method="post">
                            <input type="text" hidden id="editUserId" name="id" value="">
                            <div class="mb-3">
                                <label for="editUserName" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="editUserName" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="editUserEmail" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="editUserEmail" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="editUserLevel" class="form-label">Nível de Usuário</label>
                                <select class="form-select" id="editUserLevel" name="user_level" required>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Comum">Usuário Comum</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editUserRFID" class="form-label">RF_ID</label>
                                <input type="text" class="form-control" id="editUserRFID" name="rf_id" required disabled>
                            </div>
                            <button type="submit" class="btn btn-primary" name="edit_user">Salvar mudanças</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Pré-visualização da Imagem</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </button>
                    </div>
                    <div class="modal-body d-flex justify-content-center align-items-center">
                        <img id="modal-image" src="" alt="Imagem" class="img-fluid" style="max-height: 80vh; max-width: 100%;">
                    </div>
                </div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function changeRecordsPerPage() {
                var recordsPerPage = $('#recordsPerPage').val();
                loadUsers(1, recordsPerPage);
            }

            $(document).on('click', '.pagination .page-link', function(e) {
                e.preventDefault();
                var page = $(this).data('page');
                var recordsPerPage = $('#recordsPerPage').val();
                loadUsers(page, recordsPerPage);
            });

            function loadUsers(page, recordsPerPage) {
                $.ajax({
                    url: 'fetch_users.php',
                    type: 'GET',
                    data: {
                        pagina: page,
                        registros_por_pagina: recordsPerPage
                    },
                    success: function(data) {
                        $('#userTable tbody').html(data);
                    }
                });
            }
            $(document).on('click', '.editBtn', function() {
                var userId = $(this).data('id');
                var userRF_ID = $(this).closest('tr').find('td:eq(0)').text();
                var userName = $(this).closest('tr').find('td:eq(1)').text();
                var userLevel = $(this).closest('tr').find('td:eq(2)').text();
                var userEmail = $(this).closest('tr').find('td:eq(3)').text();

                $('#editUserId').val(userId);
                $('#editUserRFID').val(userRF_ID);
                $('#editUserName').val(userName);
                $('#editUserLevel').val(userLevel);
                $('#editUserEmail').val(userEmail);

                $('#editModal').modal('show');
            });

            $(document).on('click', '.clickable-image', function() {
                var imgSrc = $(this).data('img-src');
                console.log(imgSrc);
                $('#imageModal').modal('show');
                $('#modal-image').attr('src', imgSrc);
            });

            $(document).on('click', '.deleteBtn', function() {
                var userId = $(this).data('id');
                $('#delete_data').attr('value', userId);
                $('#deleteModal').modal('show');
            });
        </script>

        <?php include("footer.php") ?>