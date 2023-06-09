<?php 
$id =$_SESSION['idp'];
$id1 =$_SESSION['idc'];
?>

<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title></title>
    
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="Css/style.css">
   </head>
<body>
  <div class="sidebar close">
    <ul class="nav-links">
      
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-collection' ></i>
            <span class="link_name">Projet</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Projet</a></li>
          <li><a href="<?= WEB_ROUTE.'?Controller=Projet&Views=AddProjet' ?>">Ajouter projet</a></li>
          <li><a href="<?= WEB_ROUTE.'?Controller=Projet&Views=ListerProjet' ?>">Mes projet</a></li>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-book-alt' ></i>
            <span class="link_name">Categorie</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Categorie</a></li>
          <li><a href="<?= WEB_ROUTE.'?Controller=Categorie&Views=add&id=' .$id?>">ajouter categorie</a></li>
          <li><a href="<?= WEB_ROUTE.'?Controller=Categorie&Views=lister&id=' .$id?>">ListerCategorie</a></li>
        </ul>
      </li>


      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-book-alt' ></i>
            <span class="link_name">Tache</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Tache</a></li>
          <li><a href="<?= WEB_ROUTE.'?Controller=Tache&Views=add&id=' .$id1?>">ajouter tache</a></li>
          <li><a href="<?= WEB_ROUTE.'?Controller=Tache&Views=lister&id=' .$id1?>">Liste des taches</a></li>
          
        </ul>
      </li>


      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-book-alt' ></i>
            <span class="link_name">Equipe</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Equipe</a></li>
          <li><a href="<?= WEB_ROUTE.'?Controller=Equipe&Views=add&id=' .$id ?>">Ajouter Equipe</a></li>
          <li><a href="<?= WEB_ROUTE.'?Controller=Equipe&Views=lister&id=' .$id ?>">Lister Equipe</a></li>
          
        </ul>
      </li>


      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-book-alt' ></i>
            <span class="link_name">ArtcileVente</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">ArticleVente</a></li>
          <li><a href="<?= WEB_ROUTE.'?Controller=ArticleVente&Views=AddArticleVente' ?>">AddArticleVente</a></li>
          <li><a href="<?= WEB_ROUTE.'?Controller=ArticleVente&Views=ListerArticleVente' ?>">ListerArticleVente</a></li>
          
        </ul>
      </li>


      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-book-alt' ></i>
            <span class="link_name">CategorieVente</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">CategorieArticleVente</a></li>
          <li><a href="<?= WEB_ROUTE.'?Controller=CategorieArticleVente&Views=AddCategorieArticleVente' ?>">AddCategorieVente</a></li>
          <li><a href="<?= WEB_ROUTE.'?Controller=CategorieArticleVente&Views=ListerCategorieArticleVente' ?>">ListerArticleVente</a></li>
          
        </ul>
      </li>


      <li>
        <div class="iocn-link">
          <a href="<?= WEB_ROUTE.'?Controller=Security&Views=Connexion' ?>">
            <i class='bx bx-book-alt' ></i>
            <span class="link_name">Production</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Production</a></li>
          <li><a href="#">AddProduction</a></li>
          <li><a href="#">ListerProduction</a></li>
          
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="<?= WEB_ROUTE.'?Controller=Security&Views=Inscription' ?>">
            <span class="link_name">Deconnexion</span>
          </a>
        </div>
      </li>

</ul>
  </div>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
      <span class="text"></span>
    </div>
  </section>

  <script src="Js/style.js"></script>

</body>
</html>