<?php
session_start();
include("_connected.php");
include_once("langue.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tokyo Goul Mirror</title>
    <script type="text/javascript" src="js/jquery-3.2.0.min.js"></script>
    <script type="text/javascript" src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Special+Elite" rel="stylesheet">
    <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/error.css">
    <link rel="stylesheet" href="css/navigation.css">
    <link rel="stylesheet" href="css/navigation-phone.css">
  </head>
  <body>
    <?php
      include("navigation.php");
      include("navigation-phone.php");
    ?>
    <div class="entete">
      <h1>
      <?php
      if (isset($user_langue))
      {
        echo $language_erreur["erreur_survenue"][$user_langue];
      }
      else
      {
        echo $language_erreur["erreur_survenue"]["fr"];
      }
      ?>
    </h1>
    </div>
    <div class="container general">
      <?php
      echo "<h2 style=\"text-align:center;color:white\">";
      switch($_GET['error'])
      {
         case '400':
         echo 'Échec de l\'analyse HTTP.';
         break;
         case '401':
         echo 'Erreur d\'identification !';
         break;
         case '403':
         echo 'Requête interdite !';
         break;
         case '404':
         echo 'La page n\'existe pas ou plus !';
         break;
         case '405':
         echo 'Méthode non autorisée.';
         break;
         case '500':
         echo 'Erreur interne au serveur ou serveur saturé.';
         break;
         case '501':
         echo 'Le serveur ne supporte pas le service demandé.';
         break;
         case '502':
         echo 'Mauvaise passerelle.';
         break;
         case '503':
         echo 'Service indisponible.';
         break;
         case '504':
         echo 'Trop de temps à la réponse.';
         break;
         case '505':
         echo 'Version HTTP non supportée.';
         break;
         default:
         echo $language_erreur["erreur"]["fr"]." <br> ".$language_erreur["erreur"]["jp"];
      }
      echo "</h2>";
      ?>
      <img style="width:100%"src="img/shizueflatdesign.png" alt="Shizue Flat Design">

    </div>
    <!-- <div class="footer">
      <i class="fa fa-bars teuteu" aria-hidden="true"></i>
    </div> -->
    <script type="text/javascript">
      $(document).ready(function(){
        $(".footer").mouseenter(function(){
          var heightScreen = $(window).height();
          var result = heightScreen-85;
          var result = result+"px";
          $(".footer").css({
            'height': result
          });
        });
        $(".footer").mouseleave(function(){
          $(".footer").css({
            'height': '25px'
          });
        });
      })
    </script>
  </body>
</html>
