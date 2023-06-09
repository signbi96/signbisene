<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link rel="stylesheet" href="Css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

<h4 style="margin-left: 35%;margin-top:1%;color:#002879">Ajout d'une Equipe</h4>
               <div class="container" style="width:50%;height:auto;padding-top:3%;background: #D7D7D7;">
                 
                       <form  action="<?= WEB_ROUTE ?>" method="POST" enctype="multipart/form-data" » >
                                 <input type="hidden" name="Controller" value="Equipe">
                                 <input type="hidden" name="action" value="<?=!isset($Equipe['ide']) ? 'update' : 'Modification' ?>">           
                              <input type="hidden" name="ide" value="<?=isset($Equipe['ide']) ? $Equipe['ide'] : '' ;?>">
                                  <div class="row">
                                        <div class="col md-6">
                                             <div class="form-group">
                                                 <label for="">nom</label>
                                                 <input type="text" class="form-control"  
                                                 value="<?=isset($Equipe['nome']) ? $Equipe['nome'] : '' ;?>" name="nome" id="NomU"
                                                 placeholder="entrer votre nome">
                                             </div>
                                        </div>
                                  </div>
                                           <div class="card-foter text-center">
                                             <input type="submit" class="btn btn-primary " value="enregistrer" name="enregistrer"
                                              style="width: 50%;margin-top:5%;background:#002879"  >
                                           </div>

                           </form>
                          </div>
                         

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>