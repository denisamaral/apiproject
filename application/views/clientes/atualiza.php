<html>

	<head>
		<title> Atualização - Projeto API Rest </title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>

	<body>

		<div class="container">

			<br />

			<nav class="navbar navbar-inverse navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#"> Projeto API Rest </a>
					</div>
					<ul class="nav navbar-nav">
						<li><a href="<?= base_url('Clientes') ?>">Clientes</a></li>
					</ul>
				</div>
			</nav>

			<br/>

			<div class="container" style="margin-top:20px;">

				<div class="wy-table-responsive">

					<div class="panel-body">

						<form method="post" id="form">

							<div class="">

								<span id="success_message"></span>

								<div class="modal-header">
									<h3 class="modal-title">Atualizar Cliente</h3>
								</div>

								<div class="modal-body">

									<label> Nome </label>
									<input type="hidden" name="idCliente" id="idCliente" class="form-control" value="<?= $cliente[0]['idCliente']?>"/>
									<input type="text" name="nome" id="nome" class="form-control" value="<?= $cliente[0]['nomeCliente']?>"/>
									<span id="nomeError" class="error text-danger"></span>
									<br />

									<label> Email </label>
									<input type="email" name="email" id="email" class="form-control" value="<?= $cliente[0]['emailCliente']?>"/>
									<span id="emailError" class="error text-danger"></span>
									<br />

									<label> Telefone </label>
									<input type="text" name="tel" id="tel" class="form-control" value="<?= $cliente[0]['telCliente']?>"/>
									<span id="telError" class="error text-danger"></span>
									<br />

									<label> Estado </label>
									<input type="text" name="estado" id="estado" class="form-control" value="<?= $cliente[0]['ufCliente']?>"/>
									<span id="estadoError" class="error text-danger"></span>
									<br />

									<label> Cidade </label>
									<input type="text" name="cidade" id="cidade" class="form-control" value="<?= $cliente[0]['cidadeCliente']?>"/>
									<span id="cidadeError" class="error text-danger"></span>
									<br />

									<label> Data de Nascimento </label>
									<input type="date" name="dataNasc" id="dataNasc" class="form-control" value="<?= $cliente[0]['dtNascCliente']?>"/>
									<span id="dataNascError" class="error text-danger"></span>
									<br />

									<label> Planos </label>
									<br>

									<?php

										foreach($planos as $plano){

											$checked = null;

											if(!empty($clientePlanos)) $checked = ($plano['idPlano'] == $clientePlanos[0]['idPlano']) ? "checked" : null;

											?>

											<input type="checkbox" id="planos<?= $plano['idPlano']; ?>" class="planos" name="planos[]" value="<?= $plano['idPlano']; ?>" <?= $checked ?>>
											<label for="planos<?= $plano['idPlano']; ?>"> <?= $plano['nomePlano']; ?> </label>

											<br>
									<?php

										}

										?>

								</div>

								<div class="">
									<input type="submit" name="action" id="action" class="btn btn-success" value="Atualizar" />
								</div>

							</div>

						</form>

					</div>

				</div>

			</div>

		</div>

	</body>
</html>

<script type="text/javascript" language="javascript" >

	$(document).ready(function(){

		$(document).on('submit', '#form', function(event){

			event.preventDefault();

			var planos = $("input.planos:checkbox:checked").map(function(){
				return $(this).val();
			}).get().join(",");

			planos = planos.split(',')

			var idCliente = $('input#idCliente').val();
			var nome 	 = $('input#nome').val();
			var email 	 = $('input#email').val();
			var tel 	 = $('input#tel').val();
			var estado 	 = $('input#estado').val();
			var cidade 	 = $('input#cidade').val();
			var dataNasc = $('input#dataNasc').val();

			$("input").change(function(){
				$('.error').html("");
			});

			$.ajax({
				url:"<?php echo base_url() . 'Clientes/editar' ?>",
				method:"POST",
				data:{
					idCliente: idCliente,
					nome: nome,
					email: email,
					tel: tel,
					estado: estado,
					cidade: cidade,
					dataNasc: dataNasc,
					planossel:planos
				},
				dataType:"json",
				success:function(data) {

					if(data.success) {
						$('#success_message').html('<div class="alert alert-success"> Cliente atualizado com sucesso! </div>');
					}

					if(data.error) {
						$('#nomeError').html(data.nomeError);
						$('#emailError').html(data.emailError);
						$('#telError').html(data.telError);
						$('#estadoError').html(data.estadoError);
						$('#cidadeError').html(data.cidadeError);
						$('#dataNascError').html(data.dataNascError);
					}

				}

			})

		});

	});
</script>
