<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Favicon -->
  <link rel="shortcut icon" href="../img/favicon.ico" />

  <title>DoeFácil</title>

  <!-- Custom styles for this template -->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" rel="stylesheet">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/viacep.js"></script>

  <script type="text/javascript">
  $(document).ready(function(){
  	// Activate tooltip
  	$('[data-toggle="tooltip"]').tooltip();

  	// Select/Deselect checkboxes
  	var checkbox = $('table tbody input[type="checkbox"]');
  	$("#selectAll").click(function(){
  		if(this.checked){
  			checkbox.each(function(){
  				this.checked = true;
  			});
  		} else{
  			checkbox.each(function(){
  				this.checked = false;
  			});
  		}
  	});
  	checkbox.click(function(){
  		if(!this.checked){
  			$("#selectAll").prop("checked", false);
  		}
  	});
  });
  </script>
  <?php
    include_once '../php/class/Usuario.class.php';
    $uso = new Usuario();
    $uso->verificacaoLogin();
  ?>

</head>

<body id="page-top">

  <nav class="navbar navbar-expand-lg bg-white nav-pills">
    <a class="navbar-brand" href="../index.php"><img src="../img/logo.png" class="float-left" alt="Logo DoeFácil"></a>

    <button class="btn btn-link text-success order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fa-1x fas fa-bars"></i>
    </button>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto btn">
      <li class="nav-item dropdown no-arrow">
        <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa-2x fas fa-user-circle fa-fw text-success"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Configurações</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Sair</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper" style="background-color: #F2F2F2">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav bg-success">
      <li class="nav-item active">
        <a class="nav-link" href="admin/index.php">
          <i class="fas fa-hand-holding-heart"></i>
          <span>Instituições</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin/produtos.php">
          <i class="fas fa-box-open"></i>
          <span>Produtos</span></a>
      </li>
    </ul>

    <div id="content-wrapper">
      <div class="container-fluid">
        <div class="table-wrapper card-body col-md-12 bg-white">
          <div class="table-title">
            <div class="row">
              <div class="col-sm-6 text-success">
                <h2><i class="fas fa-hand-holding-heart"></i>
                <span>Instituições</span></h2>
        			</div>
              </div>
            </div>


<?php
// verifica se foi enviado um arquivo
if(isset($_FILES['arquivo']['name']) && $_FILES["arquivo"]["error"] == 0)
{

	echo "Você enviou o arquivo: <strong>" . $_FILES['arquivo']['name'] . "</strong><br />";
	echo "Este arquivo é do tipo: <strong>" . $_FILES['arquivo']['type'] . "</strong><br />";
	echo "Temporáriamente foi salvo em: <strong>" . $_FILES['arquivo']['tmp_name'] . "</strong><br />";
	echo "Seu tamanho é: <strong>" . $_FILES['arquivo']['size'] . "</strong> Bytes<br /><br />";

	$arquivo_tmp = $_FILES['arquivo']['tmp_name'];
	$nome = $_FILES['arquivo']['name'];


	// Pega a extensao
	$extensao = strrchr($nome, '.');

	// Converte a extensao para mimusculo
	$extensao = strtolower($extensao);

	// Somente imagens, .jpg;.jpeg;.gif;.png
	// Aqui eu enfilero as extesões permitidas e separo por ';'
	// Isso server apenas para eu poder pesquisar dentro desta String
	if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
	{
		// Cria um nome único para esta imagem
		// Evita que duplique as imagens no servidor.
		$novoNome = $_POST['id_inst']. $extensao;

		// Concatena a pasta com o nome
		$destino = '../img/' . $novoNome;

		// tenta mover o arquivo para o destino
		if( @move_uploaded_file( $arquivo_tmp, $destino  ))
		{
			header("Location: index.php");
			echo "Arquivo salvo com sucesso.";
			echo "</br></br>
						<a href='index.php' class='text-decoration-none'>
							<input type='button' class='btn btn-success' value='Voltar'>
						</a>";
		}
		else
			echo "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";
			echo "</br></br>";
	}
	else
		echo "Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"<br />";
		echo "</br></br>
					<a href='index.php' class='text-decoration-none'>
						<input type='button' class='btn btn-success' value='Voltar'>
					</a>";
}
else
{
	echo "Você não enviou nenhum arquivo!";
	echo "</br></br>
				<a href='index.php' class='text-decoration-none'>
					<input type='button' class='btn btn-success' value='Voltar'>
				</a>";
}
?>
</div>
</div>
<!-- Sticky Footer -->
<footer class="sticky-footer bg-dark">
	<div class="container my-auto">
		<div class="copyright text-center my-auto text-white">
			<span>Copyright &copy; DoeFácil 2019</span>
		</div>
	</div>
</footer>

</div>
<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Certeza que deseja sair?</h5>
		<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div>
	<div class="modal-body">Selecione "Sair" abaixo se você estiver pronto para terminar sua sessão atual.</div>
	<div class="modal-footer">
		<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
		<a href="../php/sair.php" class="btn btn-success" href="login.php">Sair</a>
	</div>
</div>
</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="../vendor/chart.js/Chart.min.js"></script>
<script src="../vendor/datatables/jquery.dataTables.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<script src="js/demo/datatables-demo.js"></script>
<script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
