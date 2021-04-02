<?php

include './common.php';
include 'inc/header.php';
require 'inc/ws_inserisci_workpool.php';

$utente=$_SESSION['utente'];
$pwd=$_SESSION['pwd'];
//$_SESSION['lista_telai'].=";".$_POST['telaio'];

$reparto=$_SESSION['reparto'];
$macchina=$_SESSION['macchina'];
$programma=$_SESSION['programma'];

$tmp=explode(";",$_SESSION['lista_telai']);
$telai="";
foreach ($tmp as $value){
	if ($value!="")
		$telai.="<LIN><FLD NAME=\"YNTEL\" >".$value."</FLD></LIN>";
		
}


if ($programma=="")
	$programma=$_REQUEST['programma'];


$risultatoTXT="Work Pool con i seguenti reparto:".$reparto." Programma:".$programma." Telai:".$_SESSION['lista_telai'];
file_put_contents("log.txt","pre get inserisci WorkPool:".$risultatoTXT. PHP_EOL, FILE_APPEND);

/*
if ($_SERVER['REMOTE_ADDR']=="10.212.134.200"){
	echo "<br>session lista telai:".$_SESSION['lista_telai'];
	echo "<hr>telai:".$telai;
	echo "<br>session programma:".$_SESSION['programma'];
	echo "<hr>programma:".$programma;
	die();
}*/


$risultato=getInserisciWorkPool($utente, $pwd,$reparto,$macchina,$programma, $telai);
file_put_contents("log.txt","post get inserisci WorkPool:".$risultato. PHP_EOL, FILE_APPEND);


?>
<div class="container">
	<div class="my-4">
		<?php include 'inc/blocco.php'; ?>
	</div>
	<div class="row">
	    <!--<div class="col-12 align-self-center">
            <div class="card card-body">Utente:<?php echo $utente; ?></div>
        </div>-->
		<hr>
		<div class="col-12 align-self-center">
			<?php	if (($risultato!=null)&&($risultato!="err1")&&($risultato!="err2")&&($risultato!="err3")) {?>
				<div class="card text-white">
					<div class="card-body">
					
						<label class="color-black"> Workpool Creato </label>
						<input class="form-control" type="text" placeholder="<?php echo $risultato ?>" readonly>
						<br>
					</div>
				</div>
			<?php 	}else{?>
				<div class="card text-white ">
					<div class="card-body btn-danger">
					
						<label class="color-black"> Nessun Workpool creato </label>
						<?php echo "-".$risultato."-"; ?>
						<br>
					</div>
				</div>
			<?php 	}?>
				
		</div>

		
		
    </div>
</div>


<?php
require 'inc/footer.php';
