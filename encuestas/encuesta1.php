<?php
error_reporting(0);
$id_usuario = $_GET['id_usuario'];
?>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IZO | Encuestas</title>

    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../lib/css/sweetalert.css" rel="stylesheet">
    <link href="../lib/css/animate.css" rel="stylesheet">
    <link href="../lib/css/style.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">

</head>
<body class="gray-bg">
        <meta charset="utf-8">

    <div class="middle-box text-center animated fadeInDown">
    
            <form name="form1" onSubmit="return Validar()" action="../private/encuesta1_exe.php" method="post" >

                <div class="form-group">
                    <img width="50" height="50" class="img-circle" src="../favicon.ico">
                    <h5>
                                            Cuéntanos tu experiencia en tu última visita al Centro de Atención de "....."
                                        </h5>

                                </div>
                                        <div class="ibox-content text-center">
                                            <p>
                                                Por favor califique la atención recibida el día ....... a través del Centro de Atención de .......respondiendo de 0 a 10 donde 10 es la calificación más alta y 0 la calificación más baja
                                            </p>
                                            
                                            <div  class="text-center">
                                                <div align="left" class="m-r-md inline">
                                                    <input name="id_usuario" type="hidden" value="<?php echo $id_usuario; ?>">
                                                    <input id="experienciaCheck" name="ultima_experiencia" type="hidden" value="0">
                                                    <p><div class="checkbox" align="center">
                                                        <label>
                                                            <input type="radio" value="0"  name="ultima_experiencia" requiere> 0
                                                        </label>
                                                    <label>
                                                            <input type="radio" value="1"  name="ultima_experiencia" requiere> 1
                                                        </label>
                                                    
                                                        <label>
                                                            <input type="radio" value="2"  name="ultima_experiencia"> 2
                                                        </label>
                                                        <label>
                                                            <input  type="radio" value="3"  name="ultima_experiencia"> 3
                                                        </label>
                                                        <label>
                                                            <input  type="radio" value="4"  name="ultima_experiencia"> 4
                                                        </label>
                                                        <label>
                                                            <input type="radio" value="5"  name="ultima_experiencia"> 5
                                                        </label>
                                                        <label>
                                                            <input type="radio" value="6"  name="ultima_experiencia"> 6
                                                        </label>
                                                        <label>
                                                            <input type="radio" value="7"  name="ultima_experiencia"> 7
                                                        </label>
                                                        <label>
                                                            <input  type="radio" value="8"  name="ultima_experiencia"> 8
                                                        </label>
                                                        <label>
                                                            <input  type="radio" value="9"  name="ultima_experiencia"> 9
                                                        </label>
                                                        <label>
                                                            <input type="radio" value="10"  name="ultima_experiencia"> 10
                                                        </label>
                                                    </div></p>
                                                </div>
                                            </div>
                                        
                                        </div>
                                        <div class="ibox-content text-center">
                                            <p>
                                                    ¿Qué considera que podríamos mejorar para que su satisfacción sea mayor ? 
                                            </p>
                                            <div class="text-center">
                                                <div class="m-r-md inline">
                                                    <input  name="solucion" type="hidden" value="0">
                                                    <div class="checkbox">
                                                        <label>
                                                            <textarea rows="4" cols="40"></textarea>
                                                        </label>
                                                        <br>
                                                        <br/>
                                                        <label> Seleccione el Motivo
                                                            <select style="width: 330px;">
                                                                <option value="1">1. Disconformidad con la compra/ servicio/ promoción / facturación </option>
                                                                <option value="2">2. Error/ Omisión/ Falta de claridad en la información</option>
                                                                <option value="3">3. Lentitud o fallas en los sistemas (software, medios audiovisuales, maquinas en general)</option>
                                                                <option value="4">4. Mala atención/ Disposición para atender</option>
                                                                <option value="5">5. No brindaron solución/ Solución tardia</option>
                                                                <option value="6">6. Estuvo bien/ Nota justa</option>
                                                                <option value="7">7. Tiempo antes / Durante la atención</option>
                                                                <option value="8">8. Comodidad (instalaciones, orden, etc)</option>
                                                                <option value="9">9. Falta de stock</option>
                                                                <option value="10">10. Atención/ cola en caja</option>
                                                                <option value="11">11.Otros</option>
                                                                <option value="12">12.NO OPINA</option>
                                                            </select>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ibox-content text-center">
                                            <p>
                                                    ¿Qué debería hacer CLARO para que se sienta complemente safistecho?
                                            </p>
                                            <div class="text-center">
                                                <div class="m-r-md inline">
                                                    <input  name="solucion" type="hidden" value="0">
                                                    <div class="checkbox">
                                                        <label>
                                                            <textarea rows="4" cols="40" disabled></textarea>
                                                        </label>
                                                        <br>
                                                        <br/>
                                                        <label> Seleccione el Motivo
                                                            <select style="width: 330px;" disabled>
                                                                <option value="1">1. Disconformidad con la compra/ servicio/ promoción / facturación </option>
                                                                <option value="2">2. Error/ Omisión/ Falta de claridad en la información</option>
                                                                <option value="3">3. Lentitud o fallas en los sistemas (software, medios audiovisuales, maquinas en general)</option>
                                                                <option value="4">4. Mala atención/ Disposición para atender</option>
                                                                <option value="5">5. No brindaron solución/ Solución tardia</option>
                                                                <option value="6">6. Estuvo bien/ Nota justa</option>
                                                                <option value="7">7. Tiempo antes / Durante la atención</option>
                                                                <option value="8">8. Comodidad (instalaciones, orden, etc)</option>
                                                                <option value="9">9. Falta de stock</option>
                                                                <option value="10">10. Atención/ cola en caja</option>
                                                                <option value="11">11.Otros</option>
                                                                <option value="12">12.NO OPINA</option>
                                                            </select>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ibox-content text-center">
                                            <p>
                                                ¿Qué fue lo que mas le agrado en la atención recibida en el Centro de Atenciòn al Cliente de ......(nombre del CAC)?
                                            </p>
                                            <div class="text-center">
                                                <div class="m-r-md inline">
                                                    <input  name="solucion" type="hidden" value="0">
                                                    <div class="checkbox">
                                                        <label>
                                                            <textarea rows="4" cols="40" disabled></textarea>
                                                        </label>
                                                        <br>
                                                        <br/>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <p></p>
                                            <p></p>
                                            <?php

                                            if($id_usuario==""){

                                            }else{?>
                                            <button type="submit" class="btn btn-primary">Enviar</button>
                                            <?php

                                            }
                                            ?>
                                            
                                            
                                        </div>              
                                 </form>
      

    <!-- Mainly scripts -->
    <script src="../lib/js/jquery-2.1.1.js"></script>
    <script src="../lib/js/bootstrap.min.js"></script>
    <script src="../lib/js/plugins/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
function Validar()
{
if(document.form1.ultima_experiencia[0].checked==false && document.form1.ultima_experiencia[1].checked==false && document.form1.ultima_experiencia[2].checked==false && document.form1.ultima_experiencia[3].checked==false && document.form1.ultima_experiencia[4].checked==false && document.form1.ultima_experiencia[5].checked==false)
    {
    swal('Seleccionar Ultima experiencia','ERROR','error');
    return false;
    }
if(document.form1.solucion[0].checked==false && document.form1.solucion[1].checked==false && document.form1.solucion[2].checked==false)
    {
    swal('Seleccionar Su necesidad fue solucionada','ERROR','error');
    return false;
    }
if(document.form1.tiempo_espera[0].checked==false && document.form1.tiempo_espera[1].checked==false && document.form1.tiempo_espera[2].checked==false && document.form1.tiempo_espera[3].checked==false)
    {
    swal('Por favor Califique el tiempo de espera','ERROR','error');
    return false;
    }
return true
}
</script>
</body>

</html>



