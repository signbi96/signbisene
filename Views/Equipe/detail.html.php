<?php 
if(isset($_SESSION["id"])){
  $id = $_SESSION["id"];
  // unset($_SESSION["id"]);
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
                                    
            <div class="contenu" style='width:80%; height:auto; float: right;'>
            <div class="container" style="text-align:center;width:50%;
            margin-top:5%;margin-left:-5%;margin-top:5%;">
                <?php 
                       
                       if(isset($_SESSION['succes_operation'])){
                             echo ('<p style="color:green">'.$_SESSION['succes_operation'].'</p>');
                             unset($_SESSION['succes_operation']);
                         }
                         if(isset($_SESSION['succes1_operation'])){
                             echo ('<p style="color:green">'.$_SESSION['succes1_operation'].'</p>');
                              unset($_SESSION['succes1_operation']);
                       }
                  ?>
                </div>
               
            <div class="container" style="width:100%;margin-left:0%;">    
            <h4 style="margin-left: 35%;margin-top:8%;color:#002879">Liste des Membres</h4>   
                          <table class="table table-hover" style="margin-top:1%">
                                    <thead>
                                        <tr>
                                          <th scope="col">IdEquipeUser</th>
                                          <th scope="col">Nom</th>
                                          <th scope="col">Prenom</th>
                                          <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                      <tbody>
                                        <?php foreach ($datas as $data):?>
                                        <tr class="table">
                                          <th scope="row"><?= $data['idue']?></th>
                                          <th scope="row"><?= $data['nomU']?></th>
                                          <th scope="row"><?= $data['prenomU']?></th>
                                          <td>
                                          <div class="action" style="display: flex;justify-content:space-around">
                                          <a href="<?= WEB_ROUTE.'?Controller=Equipe&Views=Modification1&id='.$data['idue'] ?>">
                                          <i class="fas fa-solid fa-pen-to-square"></i></a>

                                          <a href="<?= WEB_ROUTE.'?Controller=Equipe&Views=Changed&id='.$data['idue'] ?>"
                                          onclick="return confirm('etes vous sure de vouloir archiver cette projet ?')";>
                                          <i class="fas fa-archive" style="color:#002879"></i></a>

                                           <a href="<?= WEB_ROUTE.'?Controller=Affectation&Views=add&id='.$data['idU'] ?>">
                                           <input type="submit" value="Affecter Taches" class="btn btn-primary"  
                                              style="width:100%;background:blue;"></a>

                                              <a href="<?= WEB_ROUTE.'?Controller=Equipe&Views=rappelle&id='.$data['idU'] ?>">
                                           <input type="submit" value="Rappelles" class="btn btn-primary"  
                                              style="width:100%;background:#002879;"></a>
                                        </div>
                                        </td>
                                          </tr>
                                          <?php endforeach ?>
                                      </tbody>
                              </table>
                              <div class="container">
                                      <ul class="pagination" style="justify-content:center;">
                                          
                                         <?php for($i=1;$i<=$nombrepage;$i++):?>  
                                          <?php if($i == $page):?>
                                            <li class="page-item disabled">
                                              <a class="page-link" href="<?= WEB_ROUTE.'?Controller=Equipe&Views=detail&id='.$id.'&page='.$i?>"><?= $i ;?></a>
                                            </li>                          
                                            <?php else:?>
                                              <li class="page-item active">
                                              <a class="page-link" style="background: #002879;" href="<?= WEB_ROUTE.'?Controller=Equipe&Views=detail&id='.$id.'&page='.$i?>"><?= $i ;?></a>
                                            </li>
                                            <?php endif?>
                                            <?php endfor ?> 
                                      </ul> 
                                </div>
 
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
