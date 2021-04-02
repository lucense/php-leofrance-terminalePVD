<?php

include './common.php';
require 'inc/header.php';
$_SESSION['lista_telai']="";
$_SESSION['reparto']=$_REQUEST['reparto'];
$_SESSION['macchina']=$_REQUEST['macchina'];

?>
<div class="container">
	<div class="my-4">
		<?php include 'inc/blocco.php'; ?>
	</div>
	<div class="row">
	    <div class="col-12 align-self-center">
            <div class="card card-body d-inline-block">
				<b>Rep:</b><i><?php echo $_SESSION['reparto']; ?></i>
				<b>Prog:</b><i><?php echo $_SESSION['programma']; ?></i>
				<b>Mac:</b><i><?php echo $_SESSION['macchina']; ?></i>
			</div>
        </div>
		<hr>
		<div class="col-12 align-self-center">
			<div class="card text-white ">
				<div class="card-body">
					<form action="inserito_workpool.php" name="InsertForm" method="GET" onsubmit="return  verifica_dati()">
					  <div class="form-group">
						<label class="color-black" for="InputTelaio">Inserisci workpool</label>
						<input type="text" class="form-control" name="telaio" id="InputTelaio"  autocomplete="off" aria-describedby="InputTelaioHelp" placeholder="Inserisci telaio">
						<small id="InputTelaioHelp" class="form-text text-muted">Scansiona il telaio da inserire.</small>
					  </div>
					  
					  <div class="form-group">					  
						<button type="submit" class="btn btn-success">Aggiungi telaio</button>
						
					  </div>
					</form>
					<!--
					<br>
					<hr>					
					<form action="chiudi_workpool.php" name="chiudiForm" method="POST" >
						<div class="form-group text-center my-5">
							<button type="submit" class="btn btn-primary">Crea workpool</button>					
						</div>
					</form>-->
				</div>
			</div>
		</div>
		
		
    </div>
</div>
<script>

		function verifica_dati(){
			var telaio = document.forms["InsertForm"]["telaio"];               
			
			if (telaio.value == "")                                  
			{ 
				window.alert("telaio vuoto"); 
				telaio.focus(); 
				return false; 
			} 
	   		
		}

document.getElementById("InputTelaio").focus();




</script>

<?php
require 'inc/footer.php';
