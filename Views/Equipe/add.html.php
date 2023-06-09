<?php 
$id =$_SESSION['idp'];
$arrayError = [];
if (isset($_SESSION['arrayError'])) {
     $arrayError = $_SESSION['arrayError'];
     unset($_SESSION['arrayError']);
}
if(isset($_SESSION["arraySelection"])){
  $arraySelection = $_SESSION["arraySelection"];
  $users = find_user_by_id( $arraySelection);
  $nom = $users[0]['nomU'];
  $prenom = $users[0]['prenomU'];
   unset($_SESSION["arraySelection"]);
}

if(isset($_SESSION['arrayMembre'])){
  $array = $_SESSION['arrayMembre'];
  //unset($_SESSION["arrayMembre"]);
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
  <link rel="stylesheet" href="Css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>

<div class="tout">
            <div class="menu" style='width:20%;float:left;'>
            <?php
            require(ROUTE_DIR.'Views/Inc/Menu.html.php')
             ?>
            </div>
            <div class="contenu" style='width:80%; height:auto; float: right; margin-top:2.4%;'>
            <div class="kiki11" style="display:flex;justify-content:space-between;width:50%">
            <a style="margin-top:-6%;" href="<?= WEB_ROUTE.'?Controller=Equipe&Views=lister&id='.$id?>">
                <input type="submit" value="Liste Des Equipes" class="btn btn-primary" 
                 style="width:100%;background:#002879;"></a>
              <h4 style="color:#002879;margin-top:0%;margin-right:15%">Ajouter d'une Equipe</h4>
            </div>
               <div class="container" style="width:70%;background: #D7D7D7;border-radius:8px;margin-left:5%">
                       <form  action="<?= WEB_ROUTE ?>" method="POST" enctype="multipart/form-data" » >
                                 <input type="hidden" name="Controller" value="Equipe">
                                 <input type="hidden" name="action" value="<?=!isset($Equipe['ide']) ? 'add' : 'Modification' ?>">           
                              <input type="hidden" name="ide" value="<?=isset($Equipe['ide']) ? $Equipe['ide'] : '' ;?>">
                                  <div class="row">
                                         <div class="col md-6">
                                             <div class="form-group">
                                                 <label for="">nom</label>
                                                 <input type="text" class="form-control"  
                                                 value="<?=isset($Equipe['nome']) ? $Equipe['nome'] : '' ;?>" name="nome" id="NomU"
                                                 placeholder="entrer votre nome">
                                                 <span class="erreur" style="color:red">
                                                 <?= isset($arrayError) && isset($arrayError["nome"]) ? $arrayError['nome'] : "" ?></span>
                                             </div>
                                             </div>
                                    </div>     
                                <div class="partie2" style="width:100%;height:100px;display:flex;justify-content:space-around">
                                   <div class="col md-6">
                                     <div class="form-group">
                                       <label for=""></label>
                                       <select class="form-control" name="idU" id="" style="width:60% ;margin-top:-1%">
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
                                             <input type="submit" class="btn btn-primary " value="choisir"
                                             style="background:#002879;height:40px;width:20%;margin-top:4%" name="choisir" >          
                                </div>

                                <div class="partie3" style="width:100%;height:100px;display:flex;justify-content:space-around">
                                   <div class="col md-6">
                                   <div class="form-group">
                                                 <label for="">nom</label>
                                                 <input type="text" class="form-control" style="width:60% " 
                                                 value="<?= isset($nom) ? $nom : "" ?>" name="nomU" id="NomU"
                                                 readonly="readonly" >
                                                 <span class="erreur" style="color:red">
                                                 <?= isset($arrayError) && isset($arrayError["nomU"]) ? $arrayError['nomu'] : "" ?></span>
                                             </div>
                                     </div>

                                     <div class="col md-6">
                                   <div class="form-group">
                                                 <label for="">prenom</label>
                                                 <input type="text" class="form-control" style="width:60% " 
                                                 value="<?= isset($prenom) ? $prenom : "" ?>" name="prenomU" id="NomU"
                                                 readonly="readonly" >
                                             </div>
                                     </div>
                                          
                                             <input type="submit" class="btn btn-primary " 
                                             style="background:#002879;height:40px;margin-top:4%;width:20%" name="ajouter"  value="ajouter">
                                           
                                </div>


                                <div class="partie3" style="width:100%;height:auto;display:flex;justify-content:space-around">
                                  
                                <table class="table table-hover" style="margin-top:1%;width:100%;">
                                    <thead style="border:1px solid black">
                                        <tr>
                                          <th scope="col">Nom</th>
                                          <th scope="col">Prenom</th>
                                          <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                      <tbody style="border:1px solid black">
                                           
                                      <?php if(!empty($array)):?>
                                      <?php foreach ($array as $value):?>
                                         <tr class="table" style="border:1px solid black">
                                          <th scope="row"> <?= isset($value['nomU']) ? $value['nomU'] : "" ?></th>
                                          <td style="border:1px solid black"><?= isset($value['prenomU']) ? $value['prenomU'] : "" ?></td>
                                          <td>
                                            <div class="action" style="display: flex;justify-content:space-around">
                                          <a href="<?= WEB_ROUTE.'?Controller=Equipe&Views=supprimer&id='.$value['idU'] ?>"
                                            onclick="return confirm('etes vous sure de vouloir supprimer cette ligne ?')";>
                                            <i class="fa-solid fa-trash" style="color: red;"></i></a>
                                          </div>
                                          </td>
                                        </tr>
                                        <?php endforeach ?>
                                        <?php endif ?>
                                       
                                      </tbody>
                              </table>

                                  </div>
                                           <div class="card-foter text-center">
                                             <input type="submit" class="btn btn-primary " value="enregistrer" name="enregistrer"
                                              style="width: 50%;margin-top:2%;background:#002879"  >
                                           </div>

                           </form>
                          </div>
                    </div>
            </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>