<!DOCTYPE html>
<html>
<head>
	<title>Trivia</title>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="Bootstrap/css/bootstrap.min.css">
  
<script src="js/jquery.slim.min.js" type="text/javascript"></script>

<script src="Bootstrap/js/bootstrap.min.js" type="text/javascript" ></script>
<script   src="js/jquery.min.js" ></script>
<script src="js/jquery.simple.timer.js" type="text/javascript" ></script>
</head>
<body>

<?php $i = 0;?>
<?php
function MezclarPreguntas(&$p,&$r)
{
  
  for ($i=0; $i <100 ; $i++) { 
    $k = rand(0,3);
    $l = rand(0,3);

    $aux = $p[$k];
    $aux2 = $r[$k];

    $p[$k] = $p[$l];
    $r[$k] = $r[$l];
    
    $p[$l] = $aux;
    $r[$l] = $aux2;
  }
}

$preguntas = [];
$respuestas = [];
$arch_respuestas = fopen("txt/RESPUESTAS.txt","r");
$arch_pregutnas = fopen("txt/PREGUNTAS.txt", "r");
while (!feof($arch_pregutnas) and !feof($arch_respuestas)){
    $linea_p = fgets($arch_pregutnas);
    array_push($preguntas,$linea_p);
    $linea_r = fgets($arch_respuestas);
    $data_r = explode(",",$linea_r);
    array_push($respuestas,$data_r);
}
fclose($arch_pregutnas);
fclose($arch_respuestas);
MezclarPreguntas($preguntas,$respuestas);


?>
<div class="progress barra" style="margin:100px">
      <div id="bar" class="progress-bar color-barra progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
        <span class="sr-only">0% Complete</span>
      </div>
</div>
<?php echo "<div class='bloque-pregunta' align='center'><h1 id='pregunta' class='pregunta'>".$preguntas[$i]."</h1></div>";
echo '<div > <input id="I" type="hidden" value="'.$i.'"></div>';
for ($j=0; $j < 4; $j++) { 
  echo '<button id="'.$j.'" class="opcion" name="'.$j.'" onclick="contar(this)" data-toggle="modal" data-target="#exampleModal">'.$respuestas[$i][$j]."</button>";
}
?>

<br>

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tu Respuesta es:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div   align="center">
          <img id="Respuesta" src="" alt="Respuesta"  class= "imagen"/>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary boton-pop tam" onclick="reiniciaIntervalo()" data-dismiss="modal">Continuar</button>

      </div>
    </div>
  </div>
</div>

<script>
function mifuncion() {
  console.log("presione boton");
}

  function MezclarRespuestas(vector) {
  for (var k = 0; k<100 ; k++) {
    var i = Math.floor( Math.random()*(4-0) + 0);
    var j = Math.floor( Math.random()*(4-0) + 0);
    var aux = vector[i];
    vector[i] = vector [j];
    vector[j] = aux;
  }
}



    var conteocorrecto = 0;
    var conteoincorrecto = 0;
    var progreso = 0;
    var lista = <?php echo json_encode($preguntas);?>;
    var lista2 = <?php echo json_encode($respuestas)?>;
    var i = 1;
    var indice = Array(0,1,2,3);
      var idIterval = setInterval(function(){
        // Aumento en 10 el progeso
        
        progreso +=10;

        $('#bar').css('width', progreso + '%');
       
      //Si llegó a 100 elimino el interval
        if(progreso > 100){
          
         MezclarRespuestas(indice);




          
  
          
          if (i <=3) {
            progreso = 0;
             $('#bar').css('width', progreso + '%');
             
             document.getElementById("pregunta").innerHTML = lista[i];
            
             document.getElementById('0').innerHTML = lista2[i][indice[0]];
             $("#0").attr('name',indice[0]);
             document.getElementById('1').innerHTML = lista2[i][indice[1]];
             $("#1").attr('name',indice[1]);
             document.getElementById('2').innerHTML = lista2[i][indice[2]];
             $("#2").attr('name',indice[2]);
             document.getElementById('3').innerHTML = lista2[i][indice[3]];
             $("#3").attr('name',indice[3]);

             $("#I").val(i);
             i = i +1;

             
          }else{
            clearInterval(idIterval);
          }
       
       
      }
      

      },1000);
    
    
    
    function contar(comp) {
    let resp = parseInt(comp.name);
    if (resp == 0) {
      document.getElementById('Respuesta').src = 'img/correcto.jpg';
      clearInterval(idIterval);
      conteocorrecto = conteocorrecto + 1;

    }else{

      clearInterval(idIterval);
      document.getElementById('Respuesta').src = 'img/incorrecto.png';
      conteoincorrecto = conteoincorrecto + 1;
    }
    

    
  }

  function reiniciaIntervalo() {
    if (i == 4){
        c = String(conteocorrecto);
        inc = String(conteoincorrecto);
        window.location = "fin.php?correcto="+ c +"&incorrecto="+ inc;
    }else{
        clearInterval(idIterval);
        MezclarRespuestas(indice);
        progreso = 0;
        $('#bar').css('width', progreso + '%');
        document.getElementById("pregunta").innerHTML = lista[i];
                
        document.getElementById('0').innerHTML = lista2[i][indice[0]];
        $("#0").attr('name',indice[0]);
        document.getElementById('1').innerHTML = lista2[i][indice[1]];
        $("#1").attr('name',indice[1]);
        document.getElementById('2').innerHTML = lista2[i][indice[2]];
        $("#2").attr('name',indice[2]);
        document.getElementById('3').innerHTML = lista2[i][indice[3]];
        $("#3").attr('name',indice[3]);
        $("#I").val(i);
        i = i +1;
       
        idIterval = setInterval(function(){
            // Aumento en 10 el progeso
            
            progreso +=10;

            $('#bar').css('width', progreso + '%');
           
          //Si llegó a 100 elimino el interval
            if(progreso > 100){
              
             MezclarRespuestas(indice);




              
      
              
              if (i <=3) {
                progreso = 0;
                 $('#bar').css('width', progreso + '%');
                 
                 document.getElementById("pregunta").innerHTML = lista[i];
                
                 document.getElementById('0').innerHTML = lista2[i][indice[0]];
                 $("#0").attr('name',indice[0]);
                 document.getElementById('1').innerHTML = lista2[i][indice[1]];
                 $("#1").attr('name',indice[1]);
                 document.getElementById('2').innerHTML = lista2[i][indice[2]];
                 $("#2").attr('name',indice[2]);
                 document.getElementById('3').innerHTML = lista2[i][indice[3]];
                 $("#3").attr('name',indice[3]);

                 $("#I").val(i);
                 i = i +1;

                 
              }else{
                clearInterval(idIterval);
              }
           
           
          }
          

          },1000);
      }
    }
      
    </script>



</body>
<!--<script >

function traducir(vector){
  for (var i = 0; i < vector.length; i++) {
    vector[i] =vector[i].replace('¿','\u00BF');

    vector[i] = vector[i].replace('á','\u00E1');
    vector[i] = vector[i].replace('é','\u00E9');
    vector[i] = vector[i].replace('í','\u00ED');
    vector[i] = vector[i].replace('ó','\u00f3');
    vector[i] = vector[i].replace('ú','\u00fa');

    vector[i] = vector[i].replace('Á','\u00c1');
    vector[i] = vector[i].replace('É','\u00c9');
    vector[i] = vector[i].replace('Í','\u00cd');
    vector[i] = vector[i].replace('Ó','\u00d3');
    vector[i] = vector[i].replace('Ú','\u00da');

    vector[i] = vector[i].replace('ñ','\u00f1');
    vector[i] = vector[i].replace('Ñ','\u00d1');

  }
  
  return vector;

}-->

</html>