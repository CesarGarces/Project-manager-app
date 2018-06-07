<?php
require'../users/class/sessions.php';
$objses = new Sessions();
$objses->init();
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null ;

if($user == ''){
   header('Location: ../index.php?error=2');
}

require'../users/class/config.php';
require'../users/class/users.php';
require'../users/class/dbactions.php';
require'../users/class/panel.php';
require'../users/class/encuestas.php';

$objCon = new Connection();
$objCon->get_connected();

$objEnc = new Encuesta();

$consulta_renovacion = $objEnc->consulta_renovacion();
header("Content-Disposition: attachment; filename=consulta_renovacion.xls");

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        
        
    </head>
    
    <body>
       
        <table align="center" border="1">
            
        <p></p>
        <p></p>
        <p></p>
        <p></p>
                
                  
                <tr>        
                  <td>Id Izo</td>
                  <td>Pregunta 1</td>
                  <td>Pregunta 2</td>
                  <td>Pregunta 3</td>
                  <td>Pregunta 4</td>
                  <td>Pregunta 5</td>
                  <td>Pregunta 6</td>
                  <td>Pregunta 7</td>
                  <td>Pregunta 7 1 a 4</td>
                  <td>Pregunta 8</td>
                  <td>Pregunta 8 7 a 8</td>
                  <td>Pregunta 8 0 a 7</td>
                  <td>Pregunta 9</td>
                  <td>Pregunta 9 3 a 5</td>
                  <td>Pregunta 10</td>
                  <td>Pregunta 10 6 a 7</td>
                  <td>Pregunta 11</td>
                  <td>Pregunta 12</td>
                  <td>Pregunta 13</td>
                  <td>fecha</td>
                  <td>Sección</td>              
                  <td>Encuestador</td>  
        
                
        
          
        <?php 
                $numrows = mysql_num_rows($consulta_renovacion);
                
                if($numrows > 0){
                    
                    while($list=mysql_fetch_array($consulta_renovacion)){
                    
                    ?>
                        <tr>
                            <td><?php echo $list["id_izo"];?></td>
                            <td><?php echo $list["preg1"];?></td>
                            <td><?php echo $list["preg2"];?></td>
                            <td><?php echo $list["preg3"];?></td>
                            <td><?php echo $list["preg4"];?></td>
                            <td><?php echo $list["preg5"];?></td>
                            <td><?php echo $list["preg6"];?></td>
                            <td><?php echo $list["preg7"];?></td>
                            <td><?php echo $list["preg7_1_4"];?></td>
                            <td><?php echo $list["preg8"];?></td>
                            <td><?php echo $list["preg8_7_8"];?></td>
                            <td><?php echo $list["preg8_0_6"];?></td>
                            <td><?php echo $list["preg9"];?></td>
                            <td><?php echo $list["preg9_3_5"];?></td>
                            <td><?php echo $list["preg10"];?></td>
                            <td><?php echo $list["preg10_6_7"];?></td>
                            <td><?php echo $list["preg11"];?></td>
                            <td><?php echo $list["preg12"];?></td>
                            <td><?php echo $list["preg13"];?></td>
                            <td><?php echo $list["fecha_crea"];?></td>                         
                            <td><?php echo "Renovacion"; ?></td> 
                            <td><?php echo $list["login"]; ?></td>
                 
                                                                    
                        
                        
                        <?php
                        
                    }
                    
                }
                
            
                ?>
            
         
        
        </table>
      </div>
      </div>
    </div>                 
        </div>
        
    </body>
</html>