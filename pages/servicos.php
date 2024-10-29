<?php include("menus.php");
?>
<link rel="stylesheet" href="../estilo.css">

<div class="container-fluid">
    <h3 class="text-dark mb-4">Trocas</h3>
    <div class="card shadow" style="display: flex; justify-content:center;">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Trocas Disponíveis</p>
        </div>
        <div class="card-body" style="display: flex; justify-content:center; margin:20px 0px; flex-wrap: wrap;">

            <?php

            for ($i = 1; $i < 4; $i++) {
                echo ('<div class="card-servico" style=" margin:10px 10px; "
                    onmouseover="this.style.transform="scale(1.07) translateY(-7px)"; this.style.boxShadow="0 12px 20px rgba(0, 0, 0, 0.2)";"
                    onmouseout="this.style.transform="scale(1)"; this.style.boxShadow="0 6px 12px rgba(0, 0, 0, 0.15)";">
                    <h2 style="color: #4CAF50; font-size: 26px; margin: 0 0 10px; font-weight: bold; text-align: center;">Serviço Premium ' . $GLOBAL[$i] . '</h2>
                    <p style="color: #555; font-size: 16px; text-align: center; line-height: 1.5; margin: 10px 0 20px;">
                        Explore o melhor que oferecemos com recursos avançados e suporte dedicado para garantir uma experiência incomparável.
                    </p>
                    <button class="button-converter" id="services">
                        CONVERTER
                    </button>
                </div>');
            }

            for ($i = 4; $i < 7; $i++) {
                echo ('<div class="card-servico" style=" margin:10px 10px; background-color: rgba(90, 87, 87, 0.521); border-top: 8px solid rgba(90, 87, 87, 0.521); "
                    onmouseover="this.style.transform="scale(1.07) translateY(-7px)"; this.style.boxShadow="0 12px 20px rgba(0, 0, 0, 0.2)";"
                    onmouseout="this.style.transform="scale(1)"; this.style.boxShadow="0 6px 12px rgba(0, 0, 0, 0.15)";">
                    <h2 style="color: gray; font-size: 26px; margin: 0 0 10px; font-weight: bold; text-align: center;">Serviço Premium ' . $GLOBAL[$i] . '</h2>
                    <p style="color: #555; font-size: 16px; text-align: center; line-height: 1.5; margin: 10px 0 20px;">
                        Explore o melhor que oferecemos com recursos avançados e suporte dedicado para garantir uma experiência incomparável.
                    </p>
                    <button class="button-converter" style="background-color: rgba(90, 87, 87, 0.521);"
                        onmouseover="this.style.backgroundColor="#147453";"
                        onmouseout="this.style.backgroundColor="#027d51";">
                        CONVERTER
                    </button>
                </div>');
            }

            ?>


        </div>

    </div>

    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" id="servicesModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Efectuar troca!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="textService">Selecione o pacote que deseja: </label>
                        <select class="form-select" id="textService" aria-label="Default select example">
                            <option selected>Selecione o pacote...</option>
                            <option value="1"> 500 Mb </option>
                            <option value="2"> 1 Gb </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="convert">Correspondente em Pontos</label>
                        <input type="text" class="form-control" disabled value="" id="convert">
                    </div>
                </div>
                <form class="modal-footer" action="delete_user.php" method="post">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger" name="delete_user">Confirmar</button>
                    <input type="text" id="delete_data" name="id" value="" hidden>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).on("click", ".button-converter", function() {
            $("#servicesModal").modal('show');
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