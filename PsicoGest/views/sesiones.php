<!-- Muestra la sesión una vez elegido un paciente -->
<?php 
session_start();
require_once '../model/sessionmodel.php';

class SessionView extends SessionModel{

  function seeSessionView(){
    echo'
    <html>
        <head>
            <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>PsicoGest - Sesiones</title>
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
          <link rel="stylesheet" href="/styles/register.css">
          <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        </head>
      <body>

        <nav class="navbar navbar-light bg-dark py-0 pt-1 justify-content-between">
            <a class="navbar-brand text-primary" href="pacientes.php">PsicoGest</a>
            
            
        </nav>
        <div class="container my-2">
        <div class="row my-4 ">
            <div class="col-6">
              <h4 class="display-3 text-primary"> Sesiones </h4>
            </div>
            <div class="col-3">
                
            </div>
            <div class="col-3 ">
                
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div>';?>
                <?php $patientID = $_POST["patientID"];?>
                <form action="../controllers/sessioncontroller.php" method="POST">
                <input name="patientID" type="hidden" value="<?php echo $patientID ?>">
                <input name="action" type="hidden" value="create"/>
                    <button type="submit" class="bg-primary btn btn-outline-primary text-white"> Nueva Sesión </button>
                </form>
                <?php echo'
                    </div>
            </div>
         </div> 
        </div>
      </div>';?>
      <?php 
      $i=1;
      $patientID = $_POST["patientID"];
      $conexion = new SessionModel();
      $conn = $conexion->connect();
      $resultSessions = $this->mainSessionModel($conn,$patientID);
      $z = 1;
      $a = 1;
      while($row = mysqli_fetch_array($resultSessions)){
        
       echo'  <div class="container my-5 px-5">
            <div class="row border-bottom border-dark my-1">
            <div class="col-12 col-sm-8 ">
            
            
              <h2 class="display-5 "> "Sesión ' .$i. '<span class="text-primary"> ||</span> <span class="text-muted"> '. $row["fecha_session"].'"</span></h2>
            
             
            
            </div>
            <div class="col-12 col-sm-4">
              <a class="btn btn-primary " data-toggle="collapse" href="#versesion'.$z.'" role="button" aria-expanded="false" aria-controls="versesion">
                Ver sesión
              </a>
              <a class="btn btn-danger text-white" data-toggle="modal" data-target="#eliminarsesion'.$row["session_ID"].'">
                Eliminar sesión
              </a>
              <div class="modal fade" id="eliminarsesion'.$row["session_ID"].'" tabindex="-1" role="dialog" aria-labelledby="eliminarusuario" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="eliminarusuario">Eliminar Sesión</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      ¿Desea eliminar esta sesión?
                    </div>'?><?php  
                    echo'
                    <form action="../controllers/sessioncontroller.php" method="POST">
                    <div class="modal-footer">
                    <input name="patientID" type="hidden" value="'.$patientID.'">
                    <input name="sessionID" type="hidden" value="'.$row["session_ID"].'">
                    <input name="action" type="hidden" value="delete"/>
                      <button type="submit" name="submit" class="btn btn-danger" >Si</button>
                      <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>';?>
                    </div>
                  </form>
                  <?php echo'
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="container-fluid collapse" id="versesion'.$z.'">';?> <?php $z++;?>
            <div class="row mt-3">
                
                <div class="col-6 col-sm-3">
                    <h3 class="text-primary">Observaciones </h3>
                </div>
                <div class="col-6 col-sm-7">
                <?php echo'
                    
                    <button type="button" class="btn btn-primary mb-2 btn-sm" data-toggle="modal" data-target="#añadir'.$z.'">
                        añadir
                      </button>';
                      
                ?>    <?php echo'
                      <div class="modal fade" id="añadir'.$z.'"  role="dialog" aria-labelledby="añadir" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="añadir">Añadir Observación</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                           <form action="../controllers/sessioncontroller.php" method="POST">
                            <div class="modal-body text-center">
                              <textarea class="form-control" id="descripcion" rows="3" maxlength="255" name="descripcion"></textarea>
                            </div>
                            <input name="patientID" type="hidden" value="'.$patientID.'">
                            <input name="sessionID" type="hidden" value="'.$row["session_ID"].'">
                            <input name="sessioncodID" type="hidden" value="'.$row["session_ID"].'">
                            <input name="action" type="hidden" value="createobs"/>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary" name="submit" >Añadir Observación</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>
                          </form>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="col-2">

                </div>
            '
            ;?>
            <?php 
            $resultObs = $this->mainObsModel($conn,$row["session_ID"]);
            $j = 1;
            while($rowobs = mysqli_fetch_array($resultObs)){ echo'  
            <table class="table mb-4">
                <thead>
                  <tr>
                    <th scope="col">Nº</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Modificar</th>
                    <th scope="col">Eliminar</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    

                    
                    <th scope="row">'.$j.'</th>
                    <td class="">'.$rowobs["descripcion"].'</td>
                 
                    <form method="POST" action="obview.php">
                    <input name="patientID" type="hidden" value="'.$patientID.'">
                    <input name="sessionID" type="hidden" value="'.$row["session_ID"].'">
                    <input name="obsID" type="hidden" value="'.$rowobs["obsID"].'">
                    <input name="descripcion" type="hidden" value="'.$rowobs["descripcion"].'">
                    <input name="action" type="hidden" value="modifyobs"/>
                    <td class=""><button class="btn btn-primary" type="submit" name="submit">modificar</button></td>
                    </form>
                    <form method="POST" action="obview.php">
                    <td class=""><button class="btn btn-danger" type="submit" name="submit" >eliminar</button></td>
                    
                    <input name="obsID" type="hidden" value="'.$rowobs["obsID"].'">
                    
                    <input name="action" type="hidden" value="deleteobs"/>
                    
                  </form>
                  </tr>
                 
                </tbody>
              </table>';
              $j++;
            }
            ?> <?php 
            echo '</div>
            
            <div class="row">
                
                <div class="col-6 col-sm-3">
                    <h3 class="text-primary">Informes </h3>
                </div>
                <div class="col-6 col-sm-7">
                    <button type="button" class="btn btn-primary mb-2 btn-sm" data-toggle="modal" data-target="#añadirinforme'.$a.'">
                        añadir
                      </button>
                      
                      
                      <div class="modal fade" id="añadirinforme'.$a.'"  role="dialog" aria-labelledby="añadirinforme'.$a.'" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="añadirinforme"> Añadir informe</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="../controllers/infcontroller.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <label for="titulo" class="form-label">Título</label>
                                <input class="form-control" type="text" id="titulo" name="tituloinf">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" rows="3" max-length="255" name="descripcioninf"></textarea>
                              <div class="mb-3">
                                <label for="seleccionararchivo" class="form-label">Seleccionar archivo</label>
                                <input class="form-control" type="file" id="seleccionararchivo" name="archivo"/>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <input name="patientID" type="hidden" value="'.$patientID.'">
                              <input name="sessionID" type="hidden" value="'.$row["session_ID"].'">
                              <input name="sessioninfID" type="hidden" value="'.$row["session_ID"].'">
                              <input name="action" type="hidden" value="createinf"/>
                              <button type="submit" name="submit" class="btn btn-primary" >Añadir</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>
                              </form>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="col-2">

                </div>
            </div>
            <div class="table-responsive">';?>
            <?php 
            $resultInf = $this->mainInfModel($conn,$row["session_ID"]);
            $inf = 1;
            while($rowinf = mysqli_fetch_array($resultInf)){ echo'  

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nº</th>
                    <th scope="col">Título</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Archivo</th>
                    <th scope="col">Modificar</th>
                    <th scope="col">Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <div class="col-12 col-sm-0">
                    <th scope="row">'.$inf.'</th>
                    
                    <td class="text-center">'.$rowinf["titulo"].'</td>
                    <td class="text-center">'.$rowinf["descripcion"].'</td>
                    <td class="text-center" ><a target="_blank" href="filesview.php?session_inf_id='.$rowinf['session_inf_id'].'">'.$rowinf["nombreinforme"].'</a></td>
                  </div>
                    <form method="POST" action="infview.php">
                   
                    <input name="infID" type="hidden" value="'.$rowinf["informeID"].'">
                    <input name="descripcioninf" type="hidden" value="'.$rowinf["descripcion"].'">
                    <input name="tituloinf" type="hidden" value="'.$rowinf["titulo"].'">
                    <input name="sessioninfid" type="hidden" value="'.$rowinf['session_inf_id'].'">
                    <input name="action" type="hidden" value="modifyinf"/>
                    
                    <td class="text-center"><button class="btn btn-primary" type="submit" name="submit">modificar</button></td>
                    </form>
                    <form method="POST" action="infview.php">
                    <input name="infID" type="hidden" value="'.$rowinf["informeID"].'">
                    <input name="action" type="hidden" value="deleteinf"/>
                    <td class="text-center"><button class="btn btn-danger" type="submit" name="submit">eliminar</button></td>
                    
                    </form>
                  </tr>
             </div>    
                </tbody>
              </table>';
              $inf++;
            }  
            
            ?>
            <?php echo'
            </div>        
          </div>
          
        </div>';
        $i++;
        $z++;
        $a++;
        
      }
        ?><?php echo'
        </body>
        </html>';

  }
}

$sessionView = new SessionView();
$sessionView -> seeSessionView();

?>