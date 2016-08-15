<?php
session_start();

include ($_SERVER['DOCUMENT_ROOT'] . '/landing/radius_vars.php');
print_radius_vars();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>DNA Wi-Fi Twitter</title>
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" type="text/css" href="estilos.css">
<link rel="icon" href="../img/favicon.png" type="image/gif" sizes="16x16">

</head>
<body>

<div id="contenedor">
  <div id="header">
    <div id="tit">
      <h1>Ya casi tienes Wi-Fi gratis, sólo contesta lo siguiente</h1>
    </div><!--tit-->
    <div id="img">
      <img src="../restaurante/logo.png">
    </div><!--img-->
  </div><!--header-->

  <div id="formulario">
  <form id="registration-form-twitter" class="form-horizontal" method="post" action="insert_formulario_tw.php">

    <div class="form-control-group">
      <div class="controls">
        <input type="email" name="email" id="email" placeholder="Email*" required>
      </div>
    </div>

    <div class="form-control-group">
      <label class="control-label" for="cumple" id="cumple" class="cumple"><p>Cumpleaños:*</p></label>
      <div class="controls">
        <input type="date" name="cumple" id="cumple" required max="2006-12-31">
      </div>
    </div>

    <div class="form-control-group">
      <div class="controls">
        <select id="genero" name="genero" required>
          <option value="">Género</option>
          <option value="female">Femenino</option>
          <option value="male">Masculino</option>
        </select>
      </div>
    </div>

    <div class="form-control-group" id="terminos_mobile">
    	<label id="terminos" class="larga" class="control-label" for="message">Términos y condiciones</label>
        <div class="controls">
            <input id="agree" class="checkbox" type="checkbox" name="agree" required>
        </div>

    </div>

    <div class="form-actions">
        <button id="submit" type="submit" class="btn btn-success btn-large"><p>Enviar</p></button>
    </div>
</form>
</div><!--formulario-->


<div id="footer">
  <div id="creado">
    <img src="../img/herramienta.png" class="herramienta">
    <h2>Powered by</h2>
    <a href="http://www.brains.mx">
            <img src="../img/brains.png" class="brains">
    </a>
    <a href="http://www.grupolirun.com.mx">
            <img src="../img/lirun.png" class="lirun">
    </a>
  </div><!--creado-->
</div><!--footer-->

</div><!--contenedor-->

<script src="../validate/js/jquery-1.7.1.min.js"></script>

<script src="../validate/js/jquery.validate.js"></script>

<script src="../validate/script.js"></script> <!--campos que valida-->
<script>
		addEventListener('load', prettyPrint, false);
		$(document).ready(function(){
		$('pre').addClass('prettyprint linenums');
			});
		</script>

</body>
</html>
