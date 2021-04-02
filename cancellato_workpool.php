<?php

include './common.php';
include 'inc/header.php';
require 'inc/ws_cancella_workpool.php';
$workpool=$_REQUEST['workpool'];
$utente=$_SESSION['utente'];
$pwd=$_SESSION['pwd'];


$risultato=getCancellaWorkPool($utente, $pwd, $workpool);

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
			<?php	if ($risultato!=null) {?>
				<div class="card text-white">
					<div class="card-body">
					
						<label class="color-black"> Workpool Cancellato </label>
						<input class="form-control" type="text" placeholder="<?php echo $risultato ?>" readonly>
						<br>
					</div>
				</div>
			<?php 	}else{?>
				<div class="card text-white ">
					<div class="card-body btn-danger">
					
						<label class="color-black"> Nessun Workpool trovato </label>
						
						<br>
					</div>
				</div>
			<?php 	}?>
				
		</div>
		
		
    </div>
</div>


<?php
require 'inc/footer.php';
