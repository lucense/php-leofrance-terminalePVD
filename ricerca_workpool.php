<?php

include './common.php';
require 'inc/header.php';
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
					<form action="ricercato_workpool.php" method="POST">
					  <div class="form-group">
						<label class="color-black" for="InputWorkPool">Inserisci Workpool da ricercare</label>
						<input type="text"  name="workpool"  class="form-control" id="InputWorkPool" aria-describedby="InputWorkPoolHelp" placeholder="Inserisci workpool">
						<small id="InputWorkPoolHelp" class="form-text text-muted">Scansiona il workpool da ricercare.</small>
					  </div>
					  <div class="form-group">
						<button type="submit" class="btn btn-primary">Verifica</button>
					  </div>
					</form>
				</div>
			</div>
		</div>
		
		
    </div>
</div>
<script>
document.getElementById("InputWorkPool").focus();
</script>

<?php
require 'inc/footer.php';
