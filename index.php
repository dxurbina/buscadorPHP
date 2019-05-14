<?php
  const CIUDAD = array('New York', 'Orlando', 'Los Angeles','Houston','Washington','Miami');
  const TIPO = array('Casa', 'Casa de Campo', 'Apartamento');

 ?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/customColors.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/index.css"  media="screen,projection"/>
  <script src="./js/jquery-3.0.0.js"></script>
  <script src="./js/ion.rangeSlider.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Formulario</title>
</head>
	<script
	src="https://code.jquery.com/jquery-2.2.4.js"
	integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
	crossorigin="anonymous"></script>

<script>

    function insertarComentarios(comentarios) {
					var dff = $("#rangoPrecio").val().split(';');


        $.each(comentarios, function (indice, elemento) {
			//var Costo = parseInt( elemento.Precio.replace(',','').replace('$','') );		
			//alert(parseInt( elemento.Precio.replace(',','').replace('$','') ));
			//alert(dff[0] + ' ' + parseInt( elemento.Precio.replace(',','').replace('$','') > dff[0] ));
			if ((elemento.Ciudad == $("#selectCiudad").val() || '' == $("#selectCiudad").val()) && 
				(elemento.Tipo == $("#selectTipo").val() || '' == $("#selectTipo").val())
				 &&(parseInt( elemento.Precio.replace(',','').replace('$','')) > dff[0] )
				 &&(parseInt( elemento.Precio.replace(',','').replace('$','')) < dff[1] ) 
				) {
			
            var insertar = "<div class='ImagenTexto'><img src='img/home.jpg'><div class='comentario'><div class='Id'>Id: " + elemento.Id +
                "</div><div class='Direccion'>Direccion: " + elemento.Direccion +
                "</div><div class='Ciudad'>Ciudad: " + elemento.Ciudad +
                "</div><div class='Telefono'>Telefono: " + elemento.Telefono +
                "</div><div class='Codigo_Postal'>Codigo_Postal: " + elemento.Codigo_Postal +
                "</div><div class='Tipo'>Tipo: " + elemento.Tipo +
                "</div><div class='Precio'>Precio: " + elemento.Precio +
                "</div></div></div>";
            $(".comentarios").append(insertar);}
        });
    }


    function cargarMasComentarios() {
        $.ajax({
            url: "./data-1.json",
            success: function (datos) {
                insertarComentarios(datos);
            }
        });
    }

    $(document).ready(function () {
        //$(window).on('scroll', function(){
        //	if( $(window).scrollTop() > $(document).height() - $(window).height() ) {
        //		cargarMasComentarios();
        //	}
        //}).scroll();
        $("#submitButton").click(function () {
			$(".comentarios").empty();
            cargarMasComentarios();
			

        });
        $("#mostrarTodos").click(function () {
			$(".comentarios").empty();
			$("#selectCiudad").val("");
			$("#selectTipo").val("");
			//var rango = $("#rangoPrecio").val().split(';');
			$("#rangoPrecio").val("10000;100000");
            cargarMasComentarios();
			//$("#rangoPrecio").val(rango[0];rango[1]);
			
        });
    });
</script>

<body>

  <video src="img/video.mp4" id="vidFondo"></video>

  <div class="contenedor">
    <div class="card rowTitulo">
      <h1>Buscador</h1>
    </div>
    <div class="colFiltros">
      <form action="buscador.php" method="post" id="formulario">
        <div class="filtrosContenido">
          <div class="tituloFiltros">
            <h5>Realiza una búsqueda personalizada</h5>
          </div>
          <div class="filtroCiudad input-field">
            <label for="selectCiudad">Ciudad:</label><br /><br />
              <select name="ciudad" class="browser-default" id="selectCiudad">
                  <option value="" selected>Elige una ciudad</option>
                  <?php foreach (CIUDAD as $key => $value) { ?>
                  <option value="<?php echo $value ?>"><?php echo $value ?></option>
                  <?php } ?>
              </select>
          </div>
          <div class="filtroTipo input-field">
            <label for="selecTipo">Tipo:</label><br/><br />
              <select name="tipo" class="browser-default" id="selectTipo">
                  <option value="" selected>Elige un tipo</option>
                  <?php foreach (TIPO as $key => $value) { ?>
                  <option value="<?php echo $value ?>"><?php echo $value ?></option>
                  <?php } ?>
              </select>
          </div>
          <div class="filtroPrecio">
            <label for="rangoPrecio">Precio:</label>
            <input type="text" id="rangoPrecio" class="js-range-slider" name="precio" value="" />
			
          </div>
          <div class="botonField">
            <button type="button" name="todos" class="btn cadeBlue" value="Buscar" id="submitButton">Buscar</button>
          </div>
        </div>
      </form>
    </div>

    <div class="colContenido">
      <div class="tituloContenido card">
        <h5>Resultados de la búsqueda:</h5>
          <div class="comentarios">
          </div>
        <div class="divider"></div>
        <button type="button" name="todos" class="btn-flat waves-effect" id="mostrarTodos">Mostrar Todos</button>
      </div>

    </div>
  </div>
   
  <script type="text/javascript" src="js/jquery-3.0.0.js"></script>
  <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript" src="js/index.js"></script>
  <script>
			 $("#rangoPrecio").ionRangeSlider({
				type: "double",
				min: 10000,
				max: 100000,
				from: 10000,
				to: 100000,
				grid: true
			});
  </script>
</body>
</html>

