<?php 
$arrayError = [];
if (isset($_SESSION['arrayError'])) {
     $arrayError = $_SESSION['arrayError'];
     unset($_SESSION['arrayError']);
}
?>
<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

<div class="tout">
            <div class="menu" style='width:20%;float:left;'>
            <?php
            require(ROUTE_DIR.'Views/Inc/Menu.html.php')
             ?>
            </div>
            <div class="contenu" style='width:80%; height:auto; float: right; margin-top:5%;'>
            <div class="kiki11" style="display:flex;justify-content:space-between;width:50%">
            <a style="margin-top: -3%;" href="<?= WEB_ROUTE.'?Controller=Projet&Views=ListerProjet'?>">
                <input type="submit" value="Liste Des Projets" class="btn btn-primary" 
                 style="width:100%;background:#002879;"></a>
              <h4 style="color:#002879;margin-top:5%;margin-right:15%">Ajouter Un Projet</h4>
            </div>
               <div class="container" style="width:50%;height:auto;background:#d7d7d7;margin-left:8%;border-radius:8px">
            
                       <form  action="<?= WEB_ROUTE ?>" method="POST"  enctype= »multipart/form-data » >
                                 <input type="hidden" name="Controller" value="Projet">
                                 <input type="hidden" name="action" value="<?=!isset($projet['idp']) ? 'AddProjet' : 'Modification' ?>">           
                              <input type="hidden" name="idp" value="<?=isset($projet['idp']) ? $projet['idp'] : '' ;?>">

                                  <div class="row">
                                         <div class="col md-6">
                                             <div class="form-group">
                                                 <label for="">Nom</label>
                                                 <input type="text" class="form-control" style="border: 1px solid black;" 
                                                 value="<?=isset($projet['nomp']) ? $projet['nomp'] : '' ;?>" name="nomp" id="NomU"
                                                 placeholder="entrer votre nom">
                                                 <span class="erreur" style="color:red">
                                                 <?= isset($arrayError) && isset($arrayError["nomp"]) ? $arrayError['nomp'] : "" ?></span>
                                             </div>
                                             </div>
                                    </div>
                                  <div class="row">
                                             <div class="col md-6">
                                                <div class="form-group">
                                                  <label for="">description du projet</label>
                                                  <textarea class="form-control" name="descriptionp" id="" rows="3" style="height: 40vh;border:1px solid black"
                                                  ><?=isset($projet['descriptionp']) ? $projet['descriptionp'] : '' ;?></textarea>
                                                 <span class="erreur" style="color:red">
                                                 <?= isset($arrayError) && isset($arrayError["descriptionp"]) ? $arrayError['descriptionp'] : "" ?></span>

                                                </div>
                                          </div>
                                        </div>
                                           <div class="card-foter text-center">
                                             <button type="submit" class="btn btn-primary " style="width: 50%;margin-top:5%;background:#002879" >Ajout d'un projet</button>
                                           </div>

                           </form>
                          </div>
    </div>
                         
</div>
<script src="style.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>