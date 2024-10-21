<?php
require_once('../includes/load.php');

$municipios = getData('municipio');
$provincias = getData('provincia');
$paises = getData('pais');

if(isset($_POST['save_data']) && $_SERVER['REQUEST_METHOD']=='POST'){
    $id = $_SESSION['user_id'];
    $nome = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    if(!empty($nome) && !empty($email)){
        $sql = "UPDATE usuario SET nome='$nome', email='$email' WHERE id=$id";
        $result = $db->query($sql);
        if($result && $db->affected_rows() === 1){
            echo "<script>alert('Usuario actualizado com sucesso');</script>";
        }
    }
}
if(isset($_POST['save_contact']) && $_SERVER['REQUEST_METHOD']=='POST'){
    $id = $_SESSION['user_id'];

}


?>

<?php include("menus.php")?>
				<div class="container-fluid">
					<h3 class="text-dark mb-4">Perfil</h3>
					<div class="row mb-3">
						<div class="col-lg-4">
							<div class="card mb-3 py-3">
								<div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4"
										src="assets/img/dogs/image2.jpeg?h=a0a7d00bcd8e4f84f4d8ce636a8f94d4" width="160"
										height="160">
									<div class="mt-3 mb-3"><button class="btn btn-primary btn-sm" type="button">Alterar Foto</button></div>
								</div>
							</div>
							<div class="card shadow mb-4">
								<div class="card-header py-3">
									<h6 class="text-primary fw-bold m-0">Projects</h6>
								</div>
								<div class="card-body" style="height: 274px">
									<h4 class="small fw-bold">Server migration<span class="float-end">20%</span></h4>
									<div class="progress progress-sm mb-3">
										<div class="progress-bar bg-danger" aria-valuenow="20" aria-valuemin="0"
											aria-valuemax="100" style="width: 20%;"><span
												class="visually-hidden">20%</span></div>
									</div>
									<h4 class="small fw-bold">Sales tracking<span class="float-end">40%</span></h4>
									<div class="progress progress-sm mb-3">
										<div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0"
											aria-valuemax="100" style="width: 40%;"><span
												class="visually-hidden">40%</span></div>
									</div>
									<h4 class="small fw-bold">Customer Database<span class="float-end">60%</span></h4>
									<div class="progress progress-sm mb-3">
										<div class="progress-bar bg-primary" aria-valuenow="60" aria-valuemin="0"
											aria-valuemax="100" style="width: 60%;"><span
												class="visually-hidden">60%</span></div>
									</div>
									<h4 class="small fw-bold">Payout Details<span class="float-end">80%</span></h4>
									<div class="progress progress-sm mb-3">
										<div class="progress-bar bg-info" aria-valuenow="80" aria-valuemin="0"
											aria-valuemax="100" style="width: 80%;"><span
												class="visually-hidden">80%</span></div>
									</div>
									<h4 class="small fw-bold">Account setup<span class="float-end">Complete!</span></h4>
									<div class="progress progress-sm mb-3">
										<div class="progress-bar bg-success" aria-valuenow="100" aria-valuemin="0"
											aria-valuemax="100" style="width: 100%;"><span
												class="visually-hidden">100%</span></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-8">
							<div class="row">
								<div class="col">
									<div class="card shadow mb-3">
										<div class="card-header py-3">
											<p class="text-primary m-0 fw-bold">Seus Dados</p>
										</div>
										<div class="card-body">
											<form method="post">
												<div class="row">
													<div class="col">
														<div class="mb-3"><label class="form-label"
																for="name"><strong>Nome</strong></label><input class="form-control"
																type="text" id="name" placeholder="Nome"
																name="name" value="<?php echo $user['nome'];?>"></div>
													</div>
													<div class="col">
														<div class="mb-3"><label class="form-label"
																for="last_name"><strong>Password</strong></label><input
																class="form-control" type="text" id="password"
																placeholder="Password" name="password"></div>
													</div>
												</div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"
                                                                                 for="username"><strong>Email</strong></label><input
                                                                    class="form-control" type="text" id="email"
                                                                    placeholder="Email" name="email" value="<?php echo $user['email'];?>"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"
                                                                                 for="email"><strong>Email de Recuperação</strong></label><input
                                                                    class="form-control" type="email" id="recuperation_email"
                                                                    placeholder="Email de Recuperação" name="recuperation_email" value="<?php echo $user['email_recuperacao'];?>"></div>
                                                    </div>
                                                </div>
												<div class="mt-3 mb-3"><button class="btn btn-primary btn-sm"
														type="submit" name="save_data">Salvar alterações</button></div>
											</form>
										</div>
									</div>
									<div class="card shadow">
										<div class="card-header py-3">
											<p class="text-primary m-0 fw-bold">Informações de contacto</p>
										</div>
										<div class="card-body" style="height: 274px">
                                            <form method="post">
                                                <div class="mb-3">
                                                    <label class="form-label" for="endereco"><strong>Endereço</strong></label>
                                                    <input class="form-control" type="text" id="endereco" placeholder="Bairro, Rua, casa..." name="endereco">
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="municipio"><strong>Municipio</strong></label>
                                                            <select class="form-control" id="municipio" name="municipio">
                                                                <option value="" disabled selected>Selecione um municipio</option>
                                                                <?php foreach ($municipios as $municipio): ?>
                                                                    <option value="<?php echo $municipio['id'] ?>"><?php echo $municipio['nome'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="country"><strong>Provincia</strong></label>
                                                            <select class="form-control" id="country" name="country">
                                                                <option value="" disabled selected>Selecione uma província</option>
                                                                <?php foreach ($provincias as $provincia): ?>
                                                                    <option value="<?php echo $provincia['id'] ?>"><?php echo $provincia['nome'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="province"><strong>País</strong></label>
                                                            <select class="form-control" id="province" name="province">
                                                                <option value="" disabled selected>Selecione um país</option>
                                                                <?php foreach ($paises as $pais): ?>
                                                                    <option value="<?php echo $pais['id'] ?>"><?php echo $pais['nome'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-3 mb-3">
                                                    <button class="btn btn-primary btn-sm" type="submit" name="save_contact">Salvar dados</button>
                                                </div>
                                            </form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php include("footer.php")?>