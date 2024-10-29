                    </div>
                    </div>
                    </div>
                    <footer class="bg-white sticky-footer">
                    	<div class="container my-auto">

                    		<!-- Toast -->
                    		<div id="toast" class="toast">
                    			<div style="display:flex; background-color:#027d51; justify-content:center; margin:auto; width:30%; border-radius: 5px;box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3); padding:15px">
                    				<?php
									$mensagem = "<div>Esta é uma mensagem de toast simples!</div>";
									echo $mensagem;
									?>
                    			</div>
                    		</div>

                    		<!-- <div style="display:flex; justify-content:center"><button id="mostrarToast">Mostrar Toast</button></div> -->
                    		<!-- Fim do Toast -->

                    		<div class="text-center my-auto copyright"><span>Copyright © Tuassakidila 2024</span></div>
                    	</div>
                    </footer>
                    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
                    </div>

                    <script>
                    	$(document).ready(function() {
                    		$("#mostrarToast").click(function() {
                    			$("#toast").fadeIn(500).delay(3000).fadeOut(500);
                    		});
                    	});
                    </script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
                    <script src="assets/js/script.min.js?h=bdf36300aae20ed8ebca7e88738d5267"></script>
                    </body>

                    </html>