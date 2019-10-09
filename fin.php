<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="Bootstrap/css/bootstrap.min.css">
  
<script src="js/jquery.slim.min.js" type="text/javascript"></script>

<script src="Bootstrap/js/bootstrap.min.js" type="text/javascript" ></script>
<script   src="js/jquery.min.js" ></script>
<script src="js/jquery.simple.timer.js" type="text/javascript" ></script>
</head>
<body>
	<h1 class="titulo-fin">Tu Puntaje es:</h1>
	<br>
	<h1 class="puntaje" id="puntaje"></h1>
	<br>

		<h1 class="titulo respuestas correctas">Respuestas Correctas</h1>
		<h1 class="titulo respuestas correctas" id="correctas"></h1>
	<br><br><br>
	
	<h1 class="titulo respuestas incorrectas">Respuestas Incorrectas</h1>
	<h1 class="titulo respuestas incorrectas" id="incorrectas"></h1>
	<br><br><br><br><br><br><br><br><br>
	<div class="row">
		  <div class="col-md-6">
		  	
            	<a href="#" class="boton_personalizado jugar"onclick="location.href='juego.php'">Volver a Jugar</a>
        	
		  </div>
		  <div class="col-md-6">
		  	
            	<a href="#" class="boton_personalizado salir" onclick="location.href='juego.php'">Salir</a>
        	
		  </div>
	</div>
</body>
<script type="text/javascript">
	function ObtenerValores(nombreVariable) {
		var url = window.location.search.substring(1);
		var valores = url.split('&');
		for (var i = 0; i < valores.length; i++) {
			var variables = valores[i].split('=');
			if (variables[0] == nombreVariable) {
				return variables[1];

			}

		}
		return null

	}

	function ObtenerPuntaje() {
		var c = ObtenerValores("correcto");
		var m = ObtenerValores("incorrecto");
		var suma = c*25 +(m*(-5));
		if (suma > 0){
			return suma;
		}
		else{
			return 0;
		}
	}
	console.log(ObtenerPuntaje());
	document.getElementById("puntaje").innerHTML = ObtenerPuntaje();
	document.getElementById("correctas").innerHTML = ObtenerValores("correcto");
	document.getElementById("incorrectas").innerHTML = ObtenerValores("incorrecto");
	
	
</script>
</html>