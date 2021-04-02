<?php

include './common.php';
require 'inc/header.php';
$_SESSION['lista_telai']="";
$_SESSION['reparto']="";
$_SESSION['programma']="";
$_SESSION['macchina']="";
$_SESSION['reparto']="";

require 'inc/ws_lista_reparti.php';

$utente=$_SESSION['utente'];
$pwd=$_SESSION['pwd'];

$risultato=getListaReparti($userFornitore, $passFornitore);
$_SESSION['prog_macchina']=$risultato;
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
		<div class="col-12 align-self-center">
			<div class="card text-white ">
				<div class="card-body">
					<form action="inserire_workpool.php" name="InsertForm" method="GET" onsubmit="return  verifica_dati()">
					  <div class="form-group">
						<label class="color-black" for="InputReparto">Inserisci reparto</label>
						<select  class="form-control" name="reparto" id="InputReparto" aria-describedby="InputRepartoHelp" onchange="populateMacchine(this.value)">
							<!--<option>90010</option>							-->
						</select>
						
					
						<small id="InputRepartoHelp" class="form-text text-muted">Scansiona il Reparto da inserire.</small>
					  </div>
					  <div class="form-group">
						<label class="color-black" for="InputMacchina">Inserisci macchina</label>
						<select name="macchina" class="form-control" name="macchina" id="InputMacchina" aria-describedby="InputMacchinaHelp" onchange="populateProgrammi(this.value)">
							
						</select>
						
						<small id="InputMacchinaHelp" class="form-text text-muted">Seleziona la Macchina.</small>
					  </div>
					  <!--
					  <div class="form-group">
						<label class="color-black" for="InputProgramma">Inserisci Programma</label>
						
						 <select class="form-control" value="1" name="programma" id="InputProgramma" aria-describedby="InputProgrammaHelp" placeholder="Inserisci Programma"  >
							<option>Please Select</option>
						</select>
						
						
						<small id="InputProgrammaHelp" class="form-text text-muted">Scansiona il Programma.</small>
					  </div>
					  -->
					  <div class="form-group">					  
						<button type="submit" class="btn btn-success">Aggiungi telaio</button>
						
					  </div>
					</form>
					<br>
					<hr>					
					
				</div>
			</div>
		</div>
		
		
    </div>
</div>
<script>

		function verifica_dati(){
			var telaio = document.forms["InsertForm"]["reparto"];               
			
			if (telaio.value == "")                                  
			{ 
				window.alert("telaio vuoto"); 
				telaio.focus(); 
				return false; 
			} 
	   		
		}
		var MacchineProgrammi = <?php echo $risultato ?>;
			window.onload = function() {   
				populateReparto()			
                //populateMacchine(document.getElementById("InputReparto").value);
				//populateProgrammi(document.getElementById("InputMacchina").value);
            };
            
			 function populateReparto() {        
                var reparto = "";
                var data = Object.keys(MacchineProgrammi); // get keys from MacchineProgrammi object
                for (i=0; i < data.length; i++) {
                    reparto += "<option>" + data[i] + "</option>";
                }
              
				document.getElementById("InputReparto").innerHTML = reparto;
				populateMacchine(document.getElementById("InputReparto").value);
            }
			
			
            function populateMacchine(id) {  
                var macchina = "";
                var data = MacchineProgrammi[id];
                for (i=0; i < Object.keys(data).length; i++) {
                    macchina += "<option>" + Object.keys(data)[i] + "</option>";
                }
				document.getElementById("InputMacchina").innerHTML = macchina;
				populateProgrammi(document.getElementById("InputMacchina").value);
            
            }
                
				
			function populateProgrammi(id_programma) {  
				var id_macchina=document.getElementById("InputReparto").value
                var programmi = "";
                var data = MacchineProgrammi[id_macchina][id_programma];
				//var ricette=Object.keys(data);
				//console.log(data);
				//alert ("data lenght"+Object.keys(data).length);
				for (i=1; i <= Object.keys(data).length; i++) {
					if (data[i] === undefined ) {
						// array empty or does not exist
					}else
					{
						var ris = data[i].split('#');
						//console.log("--"+data[i]);
						programmi += "<option value="+ris[0]+">" + ris[1]+"-("+ris[0]+	")</option>";
						
						
					}
                }
				document.getElementById("InputProgramma").innerHTML = programmi;
				
            }
			
</script>

<?php
require 'inc/footer.php';
