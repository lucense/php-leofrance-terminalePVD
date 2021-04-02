
<!--

<footer class="fixed-bottom">
  <nav class="navbar navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        
      </a>
	  
	  
	   <?php if ($_SESSION['utente']!="") {?>	  
	  <a class="nav navbar-nav navbar-right" href="logout.php">
        <span class="fa fas fa-sign-out-alt fa-home icon-home">&nbsp;</span>   
		
      </a>
	  <?php }?>
    </div>
  </nav>
</footer>
<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields

</script>
-->
</body>

<?php 
if (($_SESSION['utente']=="") &&(basename($_SERVER['PHP_SELF']) !="index.php")){
	header("location: index.php");
}
?>

</html>