<?php include("menus.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_service'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $points_necessarios = isset($_POST['points_necessarios']) ? (int)$_POST['points_necessarios'] : 0;
    $kwanzas = isset($_POST['kwanzas']) ? (int)$_POST['kwanzas'] : 0;

    if (!empty($name) && !empty($description) && $points_necessarios > 0 && $kwanzas > 0) {
        $sql = "INSERT INTO servicos (nome, descricao, pontos_necessarios, kwanzas) VALUES ('$name', '$description', $points_necessarios, $kwanzas)";

        if ($result = $db->query($sql)) {
            $session->msg('s', 'Serviço adicionado com sucesso');
        } else {
            $session->msg('d', 'Erro ao adicionar serviço: ' . $db->error);
        }
    } else {
        $session->msg('d', 'Todos os campos devem ser preenchidos corretamente.');
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_service'])) {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    $sql = "DELETE FROM servicos WHERE id = $id";

    if ($db->query($sql)) {
        $session->msg('s', "Serviço deletado com sucesso!");
    } else {
        $session->msg('d', "Erro ao deletar o serviço: " . $db->error);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['convert'])) {
    $pontos = isset($_POST['pontos']) ? (int)$_POST['pontos'] : 0;
    $kwanzas = isset($_POST['kwanzas']) ? (int)$_POST['kwanzas'] : 0;
    $emailDestino = isset($_POST['emailDestino']) ? $_POST['emailDestino'] : '';
    $id = isset($_POST['idService']) ? (int)$_POST['idService'] : 0;

    $user = current_user();
    $user['pontos'] = (int)$user['pontos'];

    if ($user['pontos'] < $pontos) {
        $session->msg('d', 'Pontos insuficientes para efetuar a troca');
        return;
    }

    $pontos_resultantes = $user['pontos'] - $pontos;
    $sql = "UPDATE usuario SET pontos = $pontos_resultantes WHERE id = " . $user['id'];

    if ($db->query($sql)) {
        $result = $db->query("SELECT COUNT(*) FROM servicos WHERE id = $id");

        if (!$db->num_rows($result)) {
            $session->msg('d', 'Serviço não encontrado.');
        } else {

            // Directly constructing the query string
            $sqlTroca = "INSERT INTO trocas (id_servico, id_usuario, email_destino) VALUES ($id, " . $user['id'] . ", '$emailDestino')";

            if ($db->query($sqlTroca)) {
                $session->msg('s', 'Troca efetuada com sucesso! O código do serviço é: ' . rand(1000, 9999) . '. Não se preocupe, também foi enviado para o email de destino');
            } else {
                $session->msg('d', 'Erro ao efetuar troca: ' . $db->error);
            }
        }
    } else {
        $session->msg('d', 'Erro ao retirar pontos: ' . $db->error);
    }
}




$servicos = getData("servicos");


?>
<link rel="stylesheet" href="../estilo.css">

<div class="container-fluid">
    <h3 class="text-dark mb-4">Trocas</h3>
    <?php echo display_msg($msg) ?>
    <div class="card shadow" style="display: flex; justify-content:center;">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">
                Trocas Disponíveis
                <?php if ($user['level'] == 'Administrador'): ?>
                    <span class="position-absolute end-0 me-3">
                        <button class="btn btn-sm btn-primary" id="addService"> Adicionar serviço</button>
                    </span>
                <?php endif; ?>
            </p>
        </div>
        <div class="card-body" style="display: flex; justify-content:center; margin:20px 0px; flex-wrap: wrap;">

            <?php

            foreach ($servicos as $servico) {
                echo ('<div class="card-servico" style="margin:10px 10px;"
        onmouseover="this.style.transform=\'scale(1.07) translateY(-7px)\'; this.style.boxShadow=\'0 12px 20px rgba(0, 0, 0, 0.2)\';"
        onmouseout="this.style.transform=\'scale(1)\'; this.style.boxShadow=\'0 6px 12px rgba(0, 0, 0, 0.15)\';">
        <h2 style="color: #4CAF50; font-size: 26px; margin: 0 0 10px; font-weight: bold; text-align: center;"> Trocar pontos para ' . htmlspecialchars($servico['nome']) . '</h2>
        <p style="color: #555; font-size: 16px; line-height: 1.5; margin: 10px 0 20px; text-overflow: ellipsis; height: 120px; display: flex; justify-content: center; align-items: center;">
           ' . htmlspecialchars($servico['descricao']) . '.
        </p>
        <button class="btn btn-primary callModal"
                data-pontos="' . htmlspecialchars($servico['pontos_necessarios']) . '"
                data-kwanzas="' . htmlspecialchars($servico['kwanzas']) . '" 
                data-id="' . $servico['id'] . '" >
            Converter
        </button>
        ' . (($user['level'] === 'Administrador') ? '
            <button class="btn btn-danger btn-delete" data-id="' . $servico['id'] . '">
                Apagar
            </button>' : '') . '
    </div>');
            }



            foreach ($servicos as $servico) {
                echo ('<div class="card-servico ' . (($servico['estado'] == 0) ? '' : " card-servico-desab") . '"
                    onmouseover="this.style.transform="scale(1.07) translateY(-7px)"; this.style.boxShadow="0 12px 20px rgba(0, 0, 0, 0.2)";"
                    onmouseout="this.style.transform="scale(1)"; this.style.boxShadow="0 6px 12px rgba(0, 0, 0, 0.15)";">
                    <h2 style="color: gray; font-size: 26px; margin: 0 0 10px; font-weight: bold;">Serviço Premium ' . $servico['nome'] . '</h2>
                    <p style="color: #555; font-size: 16px; line-height: 1.5; margin: 10px 0 20px;text-overflow: ellipsis; height: 120px; display: flex;justify-content: center;align-items:center;">
                       ' . $servico['descricao'] . '.
                    </p>
                    <button disabled class="button-converter button-converter-desab" >
                        CONVERTER
                    </button>
                </div>');
            }

            ?>


        </div>

    </div>

    <div class="modal fade" tabindex="-1" aria-hidden="true" id="servicesModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Efetuar troca!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="textService">Pontos necessários</label>
                            <input type="text" class="form-control" id="points" name="pontos" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="convert">Correspondente em kwanzas</label>
                            <input type="text" class="form-control" id="kwanzas" name="kwanzas" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="convert">Email de destino</label>
                            <input type="text" class="form-control" id="emailDestino" name="emailDestino" value="<?php echo $user['email']; ?>" required>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="convertService" name="idService" value="">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" name="convert">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" aria-hidden="true" id="addServiceModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar Serviço</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addServiceForm" method="post">
                        <div class="mb-3">
                            <label for="serviceName" class="form-label">Nome do Serviço</label>
                            <input type="text" class="form-control" id="serviceName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="serviceDescription" class="form-label">Descrição</label>
                            <textarea class="form-control" id="serviceDescription" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="pointsRequired" class="form-label">Pontos Necessários</label>
                            <input type="number" class="form-control" id="pointsRequired" name="points_necessarios" required>
                        </div>
                        <div class="mb-3">
                            <label for="serviceKwanza" class="form-label">Kwanza</label>
                            <input type="number" class="form-control" id="serviceKwanza" name="kwanzas" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="add_service">Adicionar Serviço</button>
                    </form>
                </div>
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
                    Tem certeza que pretende deletar este serviço?
                </div>
                <form class="modal-footer" method="post" action="">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger" name="delete_service">Confirmar</button>
                    <input type="text" id="delete_data" name="id" value="" hidden>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.callModal').on('click', function() {
                const pontos = $(this).data('pontos');
                const kwanzas = $(this).data('kwanzas');
                const id = $(this).data('id');
                $('#points').val(pontos);
                $('#kwanzas').val(kwanzas);
                $('#convertService').val(id);
                $('#servicesModal').modal('show');
            });
            $(document).on('click', '.btn-delete', function() {
                const serviceId = $(this).data('id');
                $('#delete_data').val(serviceId); // Seletor mais específico
                $('#deleteModal').modal('show');
            });
        });
        $(document).on("click", ".callModal", function() {
            $("#servicesModal").modal('show');
        });
        $(document).on("click", "#addService", function() {
            $("#addServiceModal").modal('show');
        });
        document.getElementById("textService").addEventListener("change", function() {
            document.getElementById("convert").value = "500 pontos";
        });
    </script>
</div>
</div>
<footer class="bg-white sticky-footer">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © Brand 2024</span></div>
    </div>
</footer>
</div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.min.js?h=bdf36300aae20ed8ebca7e88738d5267"></script>
</body>

</html>