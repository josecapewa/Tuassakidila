<?php include("menus.php") ?>
<div class="container-fluid">
    <h3 class="text-dark mb-4">Usuários</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Informações de Usuários</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 text-nowrap">
                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Mostrar&nbsp;<select class="d-inline-block form-select form-select-sm">
                                <option value="10" selected="">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>&nbsp;</label></div>
                </div>
                <div class="col-md-6">
                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                </div>
            </div>
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
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
                        $registros_por_pagina = 10;

                        // Total de registros
                        $total_registros = 50; // Como você está gerando 18 registros


                        // Determinar a página atual
                        if (isset($_GET['pagina'])) {
                            $pagina_atual = $_GET['pagina'];
                        } else {
                            $pagina_atual = 1;
                        }
                        $inicio_page = ($pagina_atual - 1) * $registros_por_pagina + 1;
                        $fim_page = min($pagina_atual * $registros_por_pagina, $total_registros);


                        // Calcular o índice inicial para a query
                        $inicio = ($pagina_atual - 1) * $registros_por_pagina;

                        // Calcular o número total de páginas
                        $total_paginas = ceil($total_registros / $registros_por_pagina);

                        // Gerar os registros
                        for ($i = 1; $i <= $total_registros; $i++) {
                            if ($i > $inicio && $i <= ($inicio + $registros_por_pagina)) {
                                $ponto = rand(1, 1000);
                                $rf_id = $i; // Aqui você está incrementando o id corretamente
                                echo ('
            <tr>
                <td>' . $rf_id++ . '</td>
                <td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/avatars/avatar3.jpeg?h=c5166867f10a4e454b5b2ae8d63268b3">Fulano Cicriano</td>
                <td>exemple@gmail.com</td>
                <td>exemple2@gmail.com</td>
                <td>' . $ponto . '</td>
                <td> <button style="display: inline-block;
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 10px;
            cursor: pointer;" type="submit" name="btnEditar" value="">Editar</button>

            
                <button style="display: inline-block;
            padding: 5px 10px;
            background-color: #ff0000;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 10px;
            cursor: pointer;" type="submit" name="btnDeletar" value="">Deletar</button> </td>
            </tr>
        ');
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Mostrando de <?php echo ($inicio_page) ?> à <?php echo ($fim_page) ?> de <?php echo ($total_registros) ?></p>
                </div>
                <div class="col-md-6">
                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                            <?php
                            // Definir a página atual
                            $pagina_atual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;

                            $inicio = max(1, $pagina_atual - 1); // Exibe pelo menos a página 1
                            $fim = min($inicio + 2, $total_paginas); // Exibe no máximo até a última página

                            // Botão "Anterior"
                            if ($pagina_atual > 1) {
                                echo '<li class="page-item"><a class="page-next" aria-label="Previous" href="?pagina=' . ($pagina_atual - 1) . '"><span aria-hidden="true">«</span></a></li>';
                            } else {
                                echo '<li class="page-item disabled"><a class="page-next" aria-label="Previous" href="#"><span aria-hidden="true">«</span></a></li>';
                            }

                            // Gerar os nexts de páginas com a nova cor para a página ativa
                            for ($i = $inicio; $i <= $fim; $i++) {
                                if ($i == $pagina_atual) {
                                    echo '<li class="page-item active"><a class="page-next" href="#" style="background-color: #027D51; color: white;">' . $i . '</a></li>';
                                } else {
                                    echo '<li class="page-item"><a class="page-next" href="?pagina=' . $i . '">' . $i . '</a></li>';
                                }
                            }

                            // Botão "Próximo"
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
        <?php include("footer.php") ?>