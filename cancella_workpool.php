<?php

include './common.php';
require 'inc/header.php';
require 'inc/ws_lista_workpool.php';



$risultato=getListaWorkPool();
?>
<div class="container">
	<div class="my-4">
		<?php include 'inc/blocco.php'; ?>
	</div>
	<div class="row">
	    <!--<div class="col-12 align-self-center">
            <div class="card card-body">Utente:<?php echo $_SESSION['utente']; ?></div>
        </div>-->
		<hr>
		<!--
		<div class="col-12 align-self-center">
			<div class="card text-white ">
				<div class="card-body">
					<form action="cancellato_workpool.php" method="GET" onsubmit="return confirm('Sei Sicuro di voler cancellare questo workpool ? ');">
					  <div class="form-group">
						<label class="color-black" for="InputWorkPool">Rimuovi Workpool</label>
						<input type="text" class="form-control" name="workpool" id="InputWorkPool" aria-describedby="InputWorkPoolHelp" placeholder="Inserisci workpool">
						<small id="InputWorkPoolHelp" class="form-text text-muted">Scansiona il WorkPool da cancellare.</small>
					  </div>
					  <div class="form-group">					  
						<button type="submit" class="btn btn-danger">Rimuovi WorkPool</button>
						
					  </div>
					</form>
				</div>
			</div>
		</div>
		-->
		Cancellazione WorkPool 
		<hr>
		<form action="cancellato_workpool.php" method="GET" onsubmit="return confirm('Sei Sicuro di voler cancellare questo workpool ? ');">
		<input type="hidden" class="form-control" name="workpool" id="InputWorkPoolList" aria-describedby="InputWorkPoolHelp" placeholder="Inserisci workpool">
		<div class="col-12 align-self-center">
				<div class="card text-black ">
					<div class="card-body d-inline-block" style="text-align: center;">

					<?php 
				
					if (sizeof($risultato)>0){
						foreach($risultato as $key) {   
								$tmp=explode("#",$key);
								$workpool=$tmp[0];
								$reparto=$tmp[1];
								$macchina=$tmp[2];
							   ?>
							
								<b>Rep:</b><i><?php echo $reparto; ?></i>
								
								<b>Mac:</b><i><?php echo $macchina; ?></i>
								<b>Wrk:</b><i><?php echo $workpool; ?></i>
								<button type="submit" class="btn btn-danger" onclick="CancellaWrk('<?php echo $workpool?>')">Rimuovi WorkPool</button>
							   
							  
							   <?php
							   
						}
					}
					
			?>
			
					</div>
				</div>
		</div>
		</form>
		
    </div>
</div>

<script>
document.getElementById("InputWorkPool").focus();
function CancellaWrk(workpool){
	
	document.getElementById("InputWorkPoolList").value=workpool;
	//alert ("wrk"+workpool);
}
</script>
<?php
require 'inc/footer.php';
