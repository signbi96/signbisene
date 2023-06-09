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

<h4 style="margin-left: 35%;margin-top:7%;color:#002879">veillez creer un compte pour se connecter</h4>

               <div class="container" style="width:50%;height:auto;padding-top:3%;background: #D7D7D7;">

                       <form  action="<?= WEB_ROUTE ?>" method="POST"  enctype= »multipart/form-data » >
                                 <input type="hidden" name="Controller" value="Security">
                                 <input type="hidden" name="action" value="Inscription">

                                  <div class="row">
                                         <div class="col md-6">
                                             <div class="form-group">
                                                 <label for="">Nom</label>
                                                 <input type="text" class="form-control" style="border: 1px solid black;" value="" name="nomU" id="NomU"
                                                 placeholder="entrer votre nom">
                                                 <span class="erreur" style="color:red">
                                                 <?= isset($arrayError) && isset($arrayError["nomU"]) ? $arrayError['nomU'] : "" ?></span>
                                             </div>
                                             </div>
                                    </div>

                                  <div class="row">
                                             <div class="col md-6">
                                             <div class="form-group">
                                                 <label for="">Prenom</label>
                                                 <input type="text" class="form-control" style="border: 1px solid black;" value="" name="prenomU" id="ok"
                                                 placeholder="entrer votre prenom">
                                                 <span class="erreur" style="color:red">
                                                 <?= isset($arrayError) && isset($arrayError["prenomU"]) ? $arrayError['prenomU'] : "" ?></span>
                                             </div>
                                          </div>
                                        </div>

                                     <div class="row">
                                         <div class="col md-6">
                                             <div class="form-group">
                                                 <label for="">Mail</label>
                                                 <input type="text" class="form-control" style="border: 1px solid black;" value="" name="mailU" id="ok"
                                                 placeholder="entrer votre email">
                                                 <span class="erreur" style="color:red">
                                                 <?= isset($arrayError) && isset($arrayError["mailU"]) ? $arrayError['mailU'] : "" ?></span>
                                             </div>
                                           </div>
                                     </div>

                                     <div class="row">
                                             <div class="col md-6">
                                             <div class="form-group">
                                                 <label for="">Password</label>
                                                 <input type="password" class="form-control" style="border: 1px solid black;" value="" name="passwordU" id="ok"
                                                 placeholder="entrer votre password">
                                                 <span class="erreur" style="color:red">
                                                 <?= isset($arrayError) && isset($arrayError["passwordU"]) ? $arrayError['passwordU'] : "" ?></span>
                                             </div>
                                             </div>
                                    </div>

                                           <div class="card-foter text-center">
                                             <button type="submit" class="btn btn-primary " style="width: 50%;margin-top:5%;background:#002879" >Inscription</button>
                                           </div>

                           </form>
                          </div>
                          <div class="connexion" style="margin-left:40%;margin-top:5%;color:#002879" >

                         <a class="kiki" style="color:#002879"  href="<?= WEB_ROUTE.'?Controller=Security&Views=Connexion' ?>">se connecter ?</a>
                        </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>