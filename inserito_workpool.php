<?php
include './common.php';
require 'inc/header.php';
require 'inc/ws_verifica_telaio.php';
$telaio= $_REQUEST['telaio'];



if (strstr($_SESSION['lista_telai'],$telaio)) {
?>
	<div class="alert alert-warning" role="alert">
		Telaio Eliminato :<?php echo $telaio ?>
	</div>
	<?php
	
	$_SESSION['lista_telai']=str_replace(";".$telaio,"",$_SESSION['lista_telai']);
	$_SESSION['programma']="";
	
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
				else if (($risultato!=$_SESSION['programma'])&& ($_SESSION['programma']!="")&& ($risultato!="")){
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

/*
if ($_SERVER['REMOTE_ADDR']=="10.212.134.200"){
	echo "<br>lista telai:".$_SESSION['lista_telai'];
	echo "<br>programma:".$_SESSION['programma'];
}*/


$tmpLista=explode(";",$_SESSION['lista_telai']);
$tmp=explode(";",$_SESSION['programma']);

?>
<div class="container">
	<div class="my-4">
		<?php include 'inc/blocco.php'; ?>
	</div>
	<div class="row">
	    <div class="col-12 align-self-center">
            <div class="card card-body d-inline-block">
				<b>Rep:</b><i><?php echo $_SESSION['reparto']; ?></i>
				<b>Prog:</b><i><?php echo $tmp[1]."(".$tmp[0].")"; ?></i>
				<b>Mac:</b><i><?php echo $_SESSION['macchina']; ?></i>
			</div>
        </div>
		<hr>
		<div class="col-12 align-self-center">
			<div class="card text-white ">
				<div class="card-body">
					<form action="inserito_workpool.php" name="InsertForm" method="GET" >
					  <div class="form-group">
						<?php echo '<label class="color-black" for="InputTelaio"><b>Telai caricati: '.(count($tmpLista)-1)."</b></label>" ?>
						<br>
						<label class="color-black" for="InputTelaio">Inserisci workpool</label>
						<input type="text" class="form-control" name="telaio" autocomplete="off" id="InputTelaio" aria-describedby="InputTelaioHelp" placeholder="Inserisci telaio">
						<small id="InputTelaioHelp" class="form-text text-muted">Scansiona il telaio da inserire.</small>
					  </div>
					  
					  <div class="form-group" id="test">					  
						<button type="submit" id="aggiungi" class="btn btn-success">Aggiungi telaio</button>
						
					  </div>
						<br>
						<hr>					
					
						<div class="form-group text-center my-5">
							<button type="submit" id="chiudi" class="btn btn-primary">Crea workpool</button>					
						</div>
					</form>
				</div>
			</div>
		</div>
		
		
		<div class="col-12 align-self-center">
			<div class="card text-black ">
				<div class="card-body">
				<?php 
			
				echo "<b>Telai caricati: ".(count($tmpLista)-1)."</b><br><hr>";
				echo '<input type="hidden" value="'.(count($tmpLista)-1).'" id="count">';
				foreach($tmpLista as $key) {   
					if ($key!="")
						echo $key.'<hr/>';    
				}

		?>
				</div>
			</div>
		</div>
		
    </div>
</div>
<script>



$(function() {
	
	
	document.getElementById("InputTelaio").focus();
	//sleep(500);
	
	setInterval(function(){ 
		document.getElementById("InputTelaio").focus(); 
	}, 1000);
	
	;
	
	
	/*
	$("#InputTelaio").on("keypress", function(event){
    if (event.keyCode == 13) {
            event.preventDefault();
            event.target.blur()
        }
})*/
	

	
  $("#chiudi").click(function() {
    $(this).closest("form").attr('action', 'pre_chiudi_workpool.php');
  });
   $("#aggiungi").click(function() {
    $(this).closest("form").attr('action', 'inserito_workpool.php');
  });
});


function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

		function verifica_dati(){
		
		}





</script>

<?php
require 'inc/footer.php';
