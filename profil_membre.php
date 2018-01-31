<?php
session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=instagram;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur :' . $e->getMessage());
}if (!isset($_SESSION['membre_id'])){
    header('Location:login');
} ?>


<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet"/>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'/>
    <link href="css/animate.css" rel="stylesheet"/>
    <link href="css/magnific-popup.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet" media="screen"/>
    <link href="css/responsive.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Instagram_like</title>
</head>
<header>
    <div class="navbar-fixed ">
        <nav>
            <div class="nav-wrapper">
                <a href="accueil" class="brand-logo center">Postagram</a>
                <ul id="nav-mobile" class="left">
                    <li>Bonjour <?php
                        $affiche_nom = $bdd->prepare('SELECT login FROM membre WHERE membre_id = ?');
                        $affiche_nom->execute(array($_SESSION["membre_id"]));
                        $result = $affiche_nom->fetch();
                        echo $result["login"];
                        ?></li>
                </ul>
                <ul id="nav-mobile" class="right">
                    <li><a href="profil">&nbsp;Profil </a></li>
                    <li><a href="logout">Déconnexion</a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<body>


<section id="blog" class="latest-blog-section section-padding">
    <div class="container">
        <h2 class="section-title wow fadeInUp"><?php

            echo $_GET["login"];
            ?></h2>
        <div class="row">



<?php
$reponse = $bdd->prepare('SELECT * FROM image INNER JOIN membre ON image.membre_id = membre.membre_id WHERE membre.login = ? ORDER BY image.date DESC');
$reponse->execute(array($_GET["login"]));

while ($donnees = $reponse->fetch()){
       echo '
 
                <div >
                    <article class="blog-post-wrapper col s3">
                        <div class="figure">
                            <div class="post-thumbnail">
                                <a href="image.php?id='.$donnees['id'].'"> <img src="./images/'. $donnees['nom_image']. '" class="img-responsive " alt=""><a>
                            </div>
                            </div><!-- /.figure -->
                         <header class="entry-header">
                            <p>Posté le : '. $donnees['date'].'</p>
                            </header><!-- .entry-header -->
                    </article>
                    </div><!-- /.col-sm-4 -->
               
           ';
}

?>

        </div><!--.row-->
    </div><!-- /.container -->
</section><!-- End Blog Section -->


</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script type="text/javascript"></script>
<script src="js/jquery.js"></script>
</html>