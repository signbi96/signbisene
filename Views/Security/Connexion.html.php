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
<div class="container" style="width:40%;height:auto;margin-top:10%;background: #D7D7D7;">
                       <h3 class="text" style="color:black;margin-left:30%;color:#002879">CONNEXION</h3>
              <form  action="<?= WEB_ROUTE ?>" method="POST"  enctype= »multipart/form-data » >
                        <input type="hidden" name="Controller" value="Security">
                        <input type="hidden" name="action" value="Connexion">

                            <div class="row">
                                <div class="col md-6">
                                    <div class="form-group">
                                        <label for="">Mail</label>
                                        <input type="text" class="form-control" style="border: 1px solid black;" value="" name="mailU" id="ok"
                                        placeholder="entrer votre email">
                                    </div>
                                  </div>
                             </div>

                             <div class="row">
                                    <div class="col md-6">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" class="form-control" style="border: 1px solid black;" value="" name="passwordU" id="ok"
                                        placeholder="entrer votre password">
                                    </div>
                                    </div>
                             </div>
                            <div class="card-foter text-center">
                                <button type="submit" class="btn btn-primary " style="width: 50%;margin-top:5%;background:#002879">Connexion</button>
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