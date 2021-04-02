<?php


include './common.php';


require 'inc/header.php';
if ($_SESSION['utente']==""){
	?>
	
	
	
	<div class="container">
		<div class="row">
			<hr>
			<div class="col-12 align-self-center">
				<div class="card text-white ">
					<div class="card-body">
						<form  name="LoginForm" action="login.php" method="POST" onsubmit="return  verifica_dati()">
						  <div class="form-group">
							<label class="color-black" for="InputTelaio">Inserisci login</label>
							<input type="text" name="utente" class="form-control" id="InputLogin" aria-describedby="InputLoginHelp" placeholder="utente">							
						  </div>
						   <div class="form-group">
							<label class="color-black" for="InputPassword">Inserisci Password</label>
							<input type="password" name="pwd" class="form-control" id="InputPassword" aria-describedby="InputPasswordHelp" placeholder="password">							
						  </div>
						  <div class="form-group">					  
							<button type="submit" class="btn btn-success">Entra</button>
									
						  </div>
						</form>
					</div>
				</div>
			</div>
		
		</div>
	</div>
	<script>
		function verifica_dati(){
			var utente = document.forms["LoginForm"]["utente"];               
			var pwd = document.forms["LoginForm"]["pwd"];    
			if (utente.value == "")                                  
			{ 
				window.alert("Inserisci l'utente"); 
				utente.focus(); 
				return false; 
			} 
	   
			if (pwd.value == "")                               
			{ 
				window.alert("Inserisci la password."); 
				pwd.focus(); 
				return false; 
			} 
		}
	</script>
<?php
	//$_SESSION["utente"]="Alessandro";
//$_SESSION["pwd"]="passwdAle";
	
}
else{
?>
<div class="container">
    <div class="row">
		<hr>
        <div class="col-12 align-self-center">
            <div class="card card-body ">
				<div class="d-inline">Utente: <b><?php echo $_SESSION['utente']; ?></b></div>
			</div>
        </div>
		<hr>
        <div class="col-md-4 col-12">
            <div class="card text-white ">
                <div class="card-body">
                    <a href="intestazione_inserimento_workpool.php" class="btn-lg btn btn-block btn-success"><i class="fas fa-plus"></i> Inserire Workpool</a>
                </div>
            </div>
        </div>
		<div class="col-md-4 col-12">
            <div class="card text-white ">
                <div class="card-body">
                    <a href="ricerca_telaio.php" class="btn-lg btn btn-block btn-info"><i class="fas fa-search"></i> Ricerca telaio</a>
                </div>
            </div>
        </div>
		<!--
		<div class="col-md-6 col-12">
            <div class="card text-white ">
                <div class="card-body">
                    <a href="ricerca_workpool.php" class="btn-lg btn btn-block btn-info"><i class="fas fa-search"></i> Ricerca Workpool</a>
                </div>
            </div>
        </div>
		-->
		<div class="col-md-4 col-12">
            <div class="card text-white ">
                <div class="card-body">
                    <a href="cancella_workpool.php" class="btn-lg btn btn-block btn-danger"><i class="fas fa-times"></i> Cancella Workpool</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
}
require 'inc/footer.php';
