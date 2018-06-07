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

$consulta_ventas = $objEnc->consulta_ventas();
header("Content-Disposition: attachment; filename=consulta_ventas.xls");

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
                  <td>Fecha</td>
                  <td>Sección</td>              
                  <td>Encuestador</td>  
                  <td>Estado</td>  
                
        
          
        <?php 
                $numrows = mysql_num_rows($consulta_ventas);
                
                if($numrows > 0){
                    
                    while($list=mysql_fetch_array($consulta_ventas)){
                    $seccion = $list["id_encuesta"];
                    ?>
                        <tr>
                            <td><?php echo $list["id_izo"];?></td>
                            <td><?php echo $list["fecha"];?></td>                         
                            <td><?php
                            if($seccion == 1){
                            	echo "Renovacion";
                            }
                            if($seccion == 2){
                            	echo "Ventas";
                            }
                            ?></td> 
                            <td><?php echo $list["encuestador"]; ?></td>
                            <td><?php echo $list["estado"]; ?></td>
                                                                    
                        
                        
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