<html>

  
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IZO | Encuestas</title>

	<style type="text/css">
div.stars {

  display: inline-block;
}
div.stars2 {

  display: inline-block;
}
div.stars3 {

  display: inline-block;
}
div.stars4 {

  display: inline-block;
}
div.stars5 {
 
  display: inline-block;
}

input.star { display: none; }
input.star2 { display: none; }
input.star3 { display: none; }
input.star4 { display: none; }
input.star5 { display: none; }


label.star {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}

label.star2 {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}
label.star3 {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}
label.star4 {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}
label.star5 {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}
input.star2:checked ~ label.star2:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}
input.star3:checked ~ label.star3:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}
input.star4:checked ~ label.star4:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}
input.star5:checked ~ label.star5:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}
input.star2-5:checked ~ label.star2:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}
input.star3-5:checked ~ label.star3:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}
input.star4-5:checked ~ label.star4:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}
input.star5-5:checked ~ label.star5:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}




input.star-1:checked ~ label.star:before { color: #F62; }
input.star2-1:checked ~ label.star2:before { color: #F62; }
input.star3-1:checked ~ label.star3:before { color: #F62; }
input.star4-1:checked ~ label.star4:before { color: #F62; }
input.star5-1:checked ~ label.star5:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }
label.star2:hover { transform: rotate(-15deg) scale(1.3); }
label.star3:hover { transform: rotate(-15deg) scale(1.3); }
label.star4:hover { transform: rotate(-15deg) scale(1.3); }
label.star5:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
label.star2:before {
  content: '\f006';
  font-family: FontAwesome;
}
label.star3:before {
  content: '\f006';
  font-family: FontAwesome;
}
label.star4:before {
  content: '\f006';
  font-family: FontAwesome;
}
label.star5:before {
  content: '\f006';
  font-family: FontAwesome;
}
    </style>
	
    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../lib/css/sweetalert.css" rel="stylesheet">
    <link href="../lib/css/animate.css" rel="stylesheet">
    <link href="../lib/css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../favicon.ico" />


    <link href="../lib/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    <link href="../lib/css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="../lib/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
    <!-- rateit -->
    <link href="../lib/js/plugins/rateit/scripts/rateit.css" rel="stylesheet">
	
</head>
<body class="gray-bg">
    
            


    <div class="middle-box text-center animated fadeInDown">
        
    
            <form name="form1" onSubmit="return Validar()" action="encuesta_sb.php" method="post" >

                <div class="ibox col-md-12">
                    <img width="250" height="210" src="logo2.png">
                    <p></p>
                    <br/>
                    <h5>
                                         Hola Julián, Para ACH tu opinión cuenta!! Responde por favor 4 preguntas.
                                        </h5>

                                </div>
                                        <div class="ibox-content text-center">
                                            <p>
                                                Responde de 0 (Nada probable) a 10 (Completamente probable). ¿Qué tan probable es que recomiendes ACH a un amigo/familiar?

                                            </p>
                                            
                                            <div  class="text-center">
                                                <div align="left" class="m-r-md inline">
                                                    
                                                    <div class="text-center">
                                                <br/>
                                                <br/>
                                                <input type="text" value="0" class="dial m-r" data-fgColor="#1E79B3" data-min="0" data-max="10" data-width="200" data-height="200" data-angleOffset=-120 data-angleArc=240 />
                                            </div>

                                                </div>
                                            </div>
                                        
                                        </div>
                                        <div class="ibox-content text-center">
                                            <p>
                                                Responde de 1 (Muy bajo esfuerzo) a 5 (Mucho Esfuerzo) ¿Qué tanto esfuerzo personal tuviste que invertir en tu interacción de hoy con ACH?

                                            </p>
                                            <div class="text-center">
                                                <div class="m-r-md inline">
                                                    <input  name="solucion" type="hidden" value="0">
                                                    <div class="checkbox">
                                                       <p><div class="checkbox">
                                                        <label>
                                                            <input type="radio" value="1"  name="ultima_experiencia" onclick="mostrar0();"> 1
                                                        </label>
                                                        <label>
                                                            <input  type="radio" value="2"  name="ultima_experiencia" onclick="mostrar34();"> 2
                                                        </label>
                                                        <label>
                                                            <input  type="radio" value="3"  name="ultima_experiencia" onclick="mostrar34();"> 3
                                                        </label>
                                                        <label>
                                                            <input type="radio" value="4"  name="ultima_experiencia" onclick="mostrar12();"> 4
                                                        </label>
                                                        <label>
                                                            <input type="radio" value="5"  name="ultima_experiencia" onclick="mostrar12();"> 5
                                                        </label>
                                                    </div></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ibox-content text-center" id="pregunta12">
                                            <p>
                                                Indica el motivo de tu respuesta anterior.

                                            </p>
                                            <div class="text-center">
                                                <div class="m-r-md inline">
                                                    <input id="satisfechoTiempoCheck" name="tiempo_espera" type="hidden" value="0">
                                                    <div align="center">
                                                        <p><label>
                                                            <textarea rows="4" cols="35">

</textarea>
                                                        </label></p>
                                                        
                                                    </div>

                                                </div>

                                            </div>
                                            
                                            
                                            
                                        </div>
                                        <div class="ibox-content text-center" id="pregunta34">
                                            <p>
                                                ¿Qué podríamos hacer para que tu esfuerzo sea menor? 


                                            </p>
                                            <div class="text-center">
                                                <div class="m-r-md inline">
                                                    <input id="satisfechoTiempoCheck" name="tiempo_espera" type="hidden" value="0">
                                                    <div align="center">
                                                        <p><label>
                                                            <textarea rows="4" cols="35">

</textarea>
                                                        </label></p>
                                                        
                                                    </div>

                                                </div>

                                            </div>
										</div>
                                            <div class="ibox-content text-center">
                                                <h3>
                                                    Satisfación:
                                                </h3>
                                                <p>
                                                    ¿Como calificaría usted su satisfaccion frente a ACH?
                                                </p>
                                                <h3>
                                                    <span id="emotionDisplay1"></span>
                                                </h3>
                                                <div class="text-center">
                                                    <div class="m-r-md inline">
                                                        <input class="hidden" id="emocionalTxt1" name="EmocionalmenteCalifiqueSummit2015" type="text" value="0">
                                                        <button onclick="$('#emocionalTxt1').val('1'); $('#emotionDisplay1').html('Muy Insatisfecho');" class="btn btn-outline btn-danger dim" type="button"><i class="fa fa-thumbs-o-down"></i></button>
                                                        <button onclick="$('#emocionalTxt1').val('2'); $('#emotionDisplay1').html('Insatisfecho');" class="btn btn-outline btn-warning dim" type="button"><i class="fa fa-frown-o"></i></button>
                                                        <button onclick="$('#emocionalTxt1').val('3'); $('#emotionDisplay1').html('Me da igual...');" class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-meh-o"></i></button>
                                                        <button onclick="$('#emocionalTxt1').val('4'); $('#emotionDisplay1').html('Satisfecho');" class="btn btn-outline btn-info dim" type="button"><i class="fa fa-smile-o"></i></button>
                                                        <button onclick="$('#emocionalTxt1').val('5'); $('#emotionDisplay1').html('Muy Satisfecho');" class="btn btn-outline btn-success dim" type="button"><i class="fa fa-thumbs-o-up"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="ibox-content text-center">
                                                <p>
                                                    Como calificarías el tiempo que tardamos en atenderte?
                                                </p>
                                                <div class="text-center">
                                                    <div class="stars5">
                                                    
                                                        <input class="star5 star5-5" id="star5-5" value="5" type="radio" name="preg5"/>
                                                        <label class="star5 star5-5" for="star5-5"></label>
                                                        <input class="star5 star5-4" id="star5-4" value="4" type="radio" name="preg5"/>
                                                        <label class="star5 star5-4" for="star5-4"></label>
                                                        <input class="star5 star5-3" id="star5-3" value="3" type="radio" name="preg5"/>
                                                        <label class="star5 star5-3" for="star5-3"></label>
                                                        <input class="star5 star5-2" id="star5-2" value="2" type="radio" name="preg5"/>
                                                        <label class="star5 star5-2" for="star5-2"></label>
                                                        <input class="star5 star5-1" id="star5-1" value="1" type="radio" name="preg5"/>
                                                        <label class="star5 star5-1" for="star5-1"></label>
                                                    
                                                </div>
                                                </div>
												

												
                                            </div>

                                            
                                            <p></p>
                                            Julián, de antemano ¡Muchas gracias!
                                            <p></p>
                                            <p></p>
											<br/>
                                            <button type="submit" class="btn btn-success">Enviar</button>
											<br/>
                                            <br/>
                                        
                                 </form>
                             </div>
      

    
   <!-- Mainly scripts -->
    <script src="../lib/js/jquery-2.1.1.js"></script>
    <script src="../lib/js/bootstrap.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../lib/js/inspinia.js"></script>
    <script src="../lib/js/plugins/pace/pace.min.js"></script>
    <script src="../lib/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

   <!-- JSKnob -->
   <script src="../lib/js/plugins/jsKnob/jquery.knob.js"></script>

   <!-- NouSlider -->
   <script src="../lib/js/plugins/nouslider/jquery.nouislider.min.js"></script>

    <!-- MENU -->
    <script src="../lib/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- rateit -->
    <script src="../lib/js/plugins/rateit/scripts/jquery.rateit.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".dial").knob();
		$("#pregunta12").css("display", "none");
		$("#pregunta34").css("display", "none");
		
    });
	
	function mostrar12()
	{
		$("#pregunta12").css("display", "block");
		$("#pregunta34").css("display", "none");
	}
 
	function mostrar34()
	{
		$("#pregunta12").css("display", "none");
		$("#pregunta34").css("display", "block");
	}
	
	function mostrar0()
	{
		$("#pregunta12").css("display", "none");
		$("#pregunta34").css("display", "none");
	}
</script> 
</body>

</html>
