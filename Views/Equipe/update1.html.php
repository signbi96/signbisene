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

<h4 style="margin-left: 35%;margin-top:8%;color:#002879">Modifier ce Membre</h4>
               <div class="container" style="width:50%;height:auto;padding-top:3%;background: #D7D7D7;">
                 
                       <form  action="<?= WEB_ROUTE ?>" method="POST" enctype="multipart/form-data" » >
                                 <input type="hidden" name="Controller" value="Equipe">
                                 <input type="hidden" name="action" value="<?=!isset($Membre['idue']) ? 'update1' : 'Modification1' ?>">           
                              <input type="hidden" name="idue" value="<?=isset($Membre['idue']) ? $Membre['idue'] : '' ;?>">
                                  <div class="row">
                                  <div class="col md-6">
                                     <div class="form-group">
                                       <label for=""></label>
                                       <select class="form-control" name="idU" id="" style="width:60% ">
                                       <?php foreach ($datass as  $value):?> 
                                        <?php if(isset($arraySelection) && $arraySelection == $value['idU']):?> 
                                         <option value="<?= $value['idU'] ?>" selected><?= $value['nomU']?></option>
                                         <?php endif ?>
                                         <?php if(!isset($arraySelection) || $arraySelection != $value['idU']):?> 
                                         <option value="<?= $value['idU'] ?>" ><?= $value['nomU']?></option>
                                         <?php endif ?>
                                        <?php endforeach ?>
                                       </select>
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