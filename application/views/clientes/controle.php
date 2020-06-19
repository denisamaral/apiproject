<html>

	<head>
		<title> Controle - Projeto API Rest </title>
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

					<div id="navbar" class="collapse navbar-collapse">

						<ul class="nav navbar-nav">
							<li><a href="<?= base_url('Clientes') ?>">Clientes</a></li>
						</ul>

					</div><!--/.nav-collapse -->

				</div>

			</nav>

			<br/>

			<div class="container" style="margin-top:20px;">

				<div class="col-lg-12">
					<span id="success_message"></span>
				</div>

				<div class="col-lg-12">
					<div class="row">
						<div class="col-md-6">
							<h3 class=""> Listagem de Clientes </h3>
						</div>
						<div class="col-md-6" align="right">
							<a href="<?= base_url('Clientes/add') ?>" class="btn btn-info btn-md"> Novo Cliente </a>
						</div>
					</div>
				</div>

				<div class="wy-table-responsive">

					<div class="panel-body">

						<table class="table table-bordered table-striped table-responsive">

							<thead>
								<tr>
									<th> Nome </th>
									<th> E-mail </th>
									<th> Telefone </th>
									<th> Estado </th>
									<th> Cidade </th>
									<th> Data. Nasc </th>
									<th class="align-center"> Editar </th>
									<th class="align-center"> Deletar </th>
								</tr>
							</thead>

							<tbody>

							</tbody>

						</table>

					</div>

				</div>

			</div>

		</div>

	</body>

</html>

<script type="text/javascript" language="javascript" >
	$(document).ready(function(){

		function read() {
			$.ajax({
				url:"<?= base_url() ?>Clientes/listar",
				method:"POST",
				success:function(data)
				{
					$('tbody').html(data);
				}
			});
		}

		read();

		$(document).on('click', '.delete', function(){

			var idCliente = $(this).attr('id');

			if(confirm("Você tem certeza que deseja deletar este cliente?")) {

				$.ajax({
					url:"<?php echo base_url(); ?>Clientes/deletar",
					method:"POST",
					data:{idCliente:idCliente},
					dataType:"JSON",
					success:function(data)
					{
						if(data.success)
						{
							$('#success_message').html('<div class="alert alert-success">Cliente deletado com sucesso!</div>');
							read();
						}
					}
				})

			}

		});

	});
</script>
