<?php session_start(); //PHP $_SESSION?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Formulario</title>
<meta name="viewport" content="width=device-width">
<link href="validate/style.css" rel="stylesheet">

</head>
<body>

  <form id="registration-form" class="form-horizontal" method="post" action="insert_formulario.php">

    <div class="form-control-group">
      <div class="controls">
        <input type="text" name="nombre" id="nombre" placeholder="Nombre*" required value="x_x">
      </div>
    </div>

    <div class="form-control-group">
      <div class="controls">
        <input type="text" name="apellido" id="apellido" placeholder="Apellido*" required value="o_o">
      </div>
    </div>

    <div class="form-control-group">
      <div class="controls">
        <input type="email" name="email" id="email" placeholder="Email*" required value="ola@k.ase">
      </div>
    </div>

    <div class="form-control-group">
      <label class="control-label" for="cumple" id="cumple" class="cumple"><p>Cumpleaños:*</p></label>
      <div class="controls">
        <input type="date" name="cumple" id="cumple" placeholder="dd/mm/aaaa" required value="1999-12-31">
      </div>
    </div>

    <div class="form-control-group">
      <div class="controls">
        <select id="genero" name="genero" required>
          <option value="">Género</option>
          <option value="female">Femenino</option>
          <option value="male" selected>Masculino</option>
        </select>
      </div>
    </div>

    <div class="form-control-group" id="terminos_mobile">
    	<label id="terminos" class="larga" class="control-label" for="message">Términos y condiciones</label>
        <div class="controls">
            <input id="agree" class="checkbox" type="checkbox" name="agree" checked>
        </div>

    </div>

    <div class="form-actions">
        <button id="submit" type="submit" class="btn btn-success btn-large"><p>Enviar</p></button>
    </div>

</form>

<script src="validate/js/jquery-1.7.1.min.js"></script>

<script src="validate/js/jquery.validate.js"></script>

<script src="validate/script.js"></script> <!--campos que valida-->
<script>
		addEventListener('load', prettyPrint, false);
		$(document).ready(function(){
		$('pre').addClass('prettyprint linenums');
			});
		</script>

</body>
</html>
