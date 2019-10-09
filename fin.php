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
	console.log(ObtenerValores("correcto"));
	
	
</script>
</html>