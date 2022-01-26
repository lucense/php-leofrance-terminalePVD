<?php

include './common.php';
include 'inc/header.php';
require 'inc/ws_inserisci_workpool.php';

$utente=$_SESSION['utente'];
$pwd=$_SESSION['pwd'];
$reparto=$_SESSION['reparto'];
$macchina=$_SESSION['macchina'];


$telaio= $_REQUEST['telaio'];
//$_SESSION['lista_telai'].=";".$_POST['telaio'];


if (strstr($_SESSION['lista_telai'],$telaio)) {
	
}else{
	if ($telaio!=""){
	
				$risultato=getVerificaTelaio($telaio,$_SESSION['macchina']);
				//if ($risultato==1){
				if ($risultato=="NOPRES"){
						?>
						<div class="alert alert-warning" role="alert">
							ATTENZIONE Telaio Non valido 
						</div>							
						<?php
				}
				//if ($risultato==2){
				if ($risultato=="PIAN"){
						?>
						<div class="alert alert-warning" role="alert">
							ATTENZIONE Telaio Non disponibile, gia presente in un altro workpool 
						</div>							
						<?php
				}
				else if ($risultato!=""){
						if (($risultato!=$_SESSION['programma'])&& ($_SESSION['programma']!="")){
							?>
							<div class="alert alert-warning" role="alert">
								ATTENZIONE Telaio Non inserito :<?php echo $telaio ?>, trovata lavorazione diversa:<?php echo $risultato?>
							</div>							
							<?php
						}
						else{
							
							$_SESSION['lista_telai'].=";".$telaio;
							$_SESSION['programma']=$risultato;
			
						}
				}
			
	}
}


$programmi = json_decode($_SESSION['prog_macchina'], true);

$tmp=explode(";",$_SESSION['programma']);
$programma_id=$tmp[0];
$codice=$tmp[1];
$_SESSION['programma']=$programma_id;
?>
<div class="container">
	<div class="my-4">
		<?php include 'inc/blocco.php'; ?>
	</div>
	<div class="row">
		<div class="col-12 align-self-center">
            <div class="card card-body d-inline-block">
				<b>Rep:</b><i><?php echo $_SESSION['reparto']; ?></i>
				<b>Prog:</b><i><?php echo $codice."(".$programma_id.")"; ?></i>
				<b>Mac:</b><i><?php echo $_SESSION['macchina']; ?></i>
			</div>
        </div>
		<hr>
		<div class="col-12 align-self-center">			
				<div class="card text-white">
					<div class="card-body">		
					<?php if (($programma_id!="")||($programma_id!= null)){ ?>
						<div class="card card-body d-inline-block" style="color: black;">
						Programma consigliato: <?php echo $codice."(".$programma_id.")" ?>
						</div>
					<?php } else{?>
					<div class="card card-body d-inline-block alert alert-warning" style="color: black;">
						Nessun Programma consigliato
						</div>
					
					<?php } ?>
						
					<form action="chiudi_workpool.php" name="InsertForm" method="GET">					
					<label class="color-black" for="InputProgramma">Inserisci Programma</label>						
						 <select class="form-control" value="1" name="programma" id="InputProgramma" aria-describedby="InputProgrammaHelp" placeholder="Inserisci Programma"  >
							<?php
								foreach($programmi[$reparto][$macchina] as $programmaList){
									$tmp=explode("#",$programmaList);
									//echo $tmp[0]."---".$programma;
									if ($tmp[0]==$programma_id)
										echo '<option value="'.$tmp[0].'" selected >'.$tmp[1].'('.$tmp[0].')</option>';
									else
										echo '<option value="'.$tmp[0].'">'.$tmp[1].'('.$tmp[0].')</option>';
									
								}
							
							?>
						</select>
						<small id="InputProgrammaHelp" class="form-text text-muted">Scansiona il Programma.</small>					
						
						<div class="form-group text-center my-5">
							<button type="submit" id="chiudi" class="btn btn-primary">Crea workpool</button>					
						</div>
						<br>
						
						</form>
					</div>
				</div>
		</div>
    </div>
</div>
<?php

require 'inc/footer.php';
