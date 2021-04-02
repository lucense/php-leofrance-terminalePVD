<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

  <link rel="stylesheet" href="css/stile.css" >
 <link rel="icon" href="img/logo.png" type="image/png" />
  <title>Creazione Workpool</title>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="js/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 
</head>
<body style="background-color: whitesmoke">

  <nav class="navbar navbar-dark bg-dark">
    <div class="container">
     <!-- <a class="navbar-brand" href="index.php">
        <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
		
		</a>-->
		
		
		
		
		   
	   
	   
  <div class="navbar-header">
    <!--<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">-->
      <img src="img/logo.png" width="50" height="50" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
    <!--</button>   -->
  </div>
 
  <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="intestazione_inserimento_workpool.php" class="btn-lg btn btn-block btn-success"><i class="fas fa-plus"></i>  Workpool</a><br></li>
      <li><a href="cancella_workpool.php" class="btn-lg btn btn-block btn-danger"><i class="fas fa-times"></i>  Workpool</a><br></li>
      <li><a href="ricerca_telaio.php" class="btn-lg btn btn-block btn-info"><i class="fas fa-search"></i>  Telaio</a><br></li>
	  <!--<li><a href="ricerca_workpool.php" class="btn-lg btn btn-block btn-info"><i class="fas fa-search"></i>  Workpool</a><br></li>-->
		
    </ul>
  </div>

	   
		
		
		
	<span style="color:white">
		
       Gestione WorkPool
	   </span>

 <?php if ($_SESSION['utente']!="") {?>	  
	  <a class="nav navbar-nav navbar-left" href="logout.php">
        <span class="fa fas fa-sign-out-alt fa-home icon-home">&nbsp;</span>   
		
      </a>
	  <?php }?>
  
      </a>
	   <a class="nav navbar-nav navbar-right" href="index.php">
        <span class="fa fa-home icon-home">&nbsp;</span>   
		
      </a>
	 
	  
	
	   
	 
	  
    </div>
  </nav>