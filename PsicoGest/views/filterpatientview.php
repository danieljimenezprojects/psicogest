<?php
session_start();
// esto solo muestra la vista de filtrar (el formulario)

    class FilterView {

        public function filterView(){
            echo '<html>
            <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>PsicoGest - Filtrar Paciente</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <link rel="stylesheet" href="/styles/index.css">
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            </head>
            <body>
            <nav class="navbar navbar-light bg-dark py-0 pt-1 justify-content-between">
                <a class="navbar-brand text-primary" href="pacientes.php">PsicoGest</a>
            </nav>
            <br>
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <h1 class="display-3"> Filtrar <span class="text-primary">Pacientes</span></h1>
                    </div>
                </div>
            </div>
            <div class="container bg-dark pb-1 ml-3 pr-3 mt-3">
            <div class="row">
                <div class="col">
                  <p class="text-white"> En este apartado puedes filtrar cómo quieres que te salgan los pacientes en el listado. De cada grupo solo puedes escoger una de ellas.</p>
                </div>
            </div>
            </div>   
            <div class="container  py-2 ml-3 pr-3">
                <div class="row ">
            <div class="col-3">

             </div>
            <div class="col-6 col-sm-6 bg-light my-3">
                <h4 class="display-5 py-2">¿Cómo quieres ver los pacientes?</h4>';?>
                
            <form action="../controllers/patientcontroller.php" method="POST">    
            <div class="row border-bottom border-primary py-2"> 
                <div class="col-12 col-md-6 ">
                <span> Ascendente/descendente </span>
                </div>
                <div class="col-6 ">
                <div class="form-check form-check-inline">
                
                
                <input class="form-check-input" type="radio" name="order" id="asc" value="ASC">
                <label class="form-check-label" for="asc">ASC</label>
                
                </div>
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="order" id="dsc" value="DSC">
                <label class="form-check-label" for="dsc">DSC</label>
                </div>
            </div>
            </div>
             <div class="row border-bottom border-primary py-2">
            
            <div class="col-12 col-md-6 ">
                <span>  5 Últimos / Todos</span>
                </div>
                <div class="col-6 ">
                <div class="form-check form-check-inline">
                    
                    
                    <input class="form-check-input" type="radio" name="cantidad" id="cinco" value="cinco">
                    <label class="form-check-label" for="inlineRadio1">5 últimos</label>
                    
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="cantidad" id="todos" value="todos">
                    <label class="form-check-label" for="inlineRadio2">Todos</label>
                </div>
            </div>
            </div>
            <input name="action" type="hidden" value="filter"/>
                <input name="userID" type="hidden" value="<?php echo $_SESSION["userID"] ?>">
            <div class="text-right">
                <button type="submit" name="submit" class="btn btn-primary my-3">Filtrar</button>
            </div>    
            </form>  <?php 
            echo '
            <div class="col-3">

            </div>
            </div>
            <div class="container pb-1 ml-1 pr-3 mt-3">
            <div class="row">
                <div class="col">
                  <p class="text-dark"> Ascendente ordena de fecha actual a más antiguos y descendente al revés.</p>
                  <p class="text-dark"> Por defecto, se verán: Todos los pacientes y ascendente. Es indispensable pulsar una de cada uno de los dos grupos.</p>
                </div>
                </div>
            </div>    
      
            </body>
            </html>';
        } 
    }

$filterView = new filterView();
$filterView->filterView();