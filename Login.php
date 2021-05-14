<?php
session_start();

if(isset($_SESSION['username'])){
		session_destroy();
}

include 'checkBrowser.php';
?>


<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">

    <link rel="stylesheet" href="css/style.css">
    <link href="images/LOGO XL 2018.jpg">

    <title></title>
</head>
<body>

    <?php 
		// if(get_the_browser() == 'Google Chrome'){
		if(1==1){
	?>


  <form action="Controlador/validar.php" method="post">
    <div class="row" align="center">
        <div class="col">
          <div class="content" style="width:500px">
            <h3>Login XL Gestion</h3>
            <figure>
              <img src="images/LOGO XL 2018.jpg" alt="" />
            </figure>
            <div class="inp">
              <input type="text" class="email" placeholder="login" />
              <br>
              <input type="password" class="pass" placeholder="password" />
              <br>
              <button type="submit" class="btn btn-primary">Log in</button>
            </div>
            <div class="min-footer">
              <span>Olvidaste la contraseña?</span>
            </div>
          </div>
          <br />
          <br />
          <br />
        </div>
      </div>
 </form>

<?php
		}
	?>
	
		
	</div>
	
</body>

<script src="Controlador/validar_usuario.js"></script>


</html>