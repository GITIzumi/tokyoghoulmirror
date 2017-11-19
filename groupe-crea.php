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
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/groupe-crea.css">
    <link rel="stylesheet" href="css/navigation.css">
    <link rel="stylesheet" href="css/navigation-phone.css">
  </head>
  <body>
    <?php
      include("navigation.php");
      include("navigation-phone.php");
    ?>
    <div class="entete">
      <h1><?php echo $language_groupe['creation_groupe'][$user_langue]; ?></h1>
    </div>
    <div class="container general">
      <div class="col-xs-12">
        <div class="row part">
          <form  action="groupe-crea.php" enctype="multipart/form-data" method="post">
            <div class="col-xs-12 col-md-6">
              <p class="numero-form">
                <label for=""><?php echo $language_groupe['creation_nom_francais'][$user_langue]; ?></label>
                <input class="form-control" type="text" name="nomfr" value="<?php // if(isset()) echo  ?>">
              </p>
            </div>
            <div class="col-xs-12 col-md-6">
              <p class="numero-form">
                <label for=""><?php echo $language_groupe['creation_nom_japonais'][$user_langue]; ?></label>
                <input class="form-control" type="text" name="nomjp" value="<?php // if(isset()) echo  ?>">
              </p>
            </div>

            <div class="col-xs-12 col-md-6">
              <p class="numero-form">
                <label for=""><?php echo $language_groupe['creation_description_fr'][$user_langue]; ?></label>
                <input class="form-control" type="text" name="descfr" value="<?php // if(isset()) echo  ?>">
              </p>
            </div>
            <div class="col-xs-12 col-md-6">
              <p class="numero-form">
                <label for=""><?php echo $language_groupe['creation_description_jp'][$user_langue]; ?></label>
                <input class="form-control" type="text" name="descjp" value="<?php // if(isset()) echo  ?>">
              </p>
            </div>
            <div class="col-xs-12 col-md-6">
              <p class="numero-form">
                <label for=""><?php echo $language_groupe['creation_couleur'][$user_langue]; ?></label>
                <input class="form-control" type="text" name="couleur" value="<?php // if(isset()) echo  ?>">
              </p>
            </div>
          </form>
          <div class="col-xs-12">
            <?php
              $query = $mysqli->query("
                SELECT *
                FROM perso
                WHERE perso_visibilite = 0
                  AND perso_actif = 1
                ORDER BY perso_nom_fr
              ");
              $nb    = $query->num_rows;
              if ($nb > 0)
              {
                while($row = $query->fetch_array())
                {
                  $text = array(
                    'id'                 => $row["perso_id"],
                    'prenom'             => array(	'fr' => $row["perso_prenom_fr"],
                                                    'jp' => $row["perso_prenom_jp"]),

                    'nom'                => array(	'fr' => $row["perso_nom_fr"],
                                                    'jp' => $row["perso_nom_jp"]),

                    'surnom'             => array(	'fr' => $row["perso_surnom_fr"],
                                                    'jp' => $row["perso_surnom_jp"]),

                    'img'                => $row["perso_image"],
                    );
                  echo "<a href=\"javascript:void(0)\">";
                    if (in_array($text['id'], $_SESSION["perso-chapitre-crea"]))
                    {
                      echo "<div class=\"personnage actifperso\" data-id=\"".$text['id']."\">";
                    }
                    else
                    {
                      echo "<div class=\"personnage\" data-id=\"".$text['id']."\">";
                    }
                      echo "<div class=\"rond-img\" style=\"background-image: url(img/persos/".$text["img"].");\"></div>";
                      if (empty($text["nom"][$user_langue]))
                      {
                        echo "<p class=\"nom\">".$text["nom"]['fr']."</p>";
                      }else{
                        echo "<p class=\"nom\">".$text["nom"][$user_langue]."</p>";
                      }
                      if (empty($text["prenom"][$user_langue]))
                      {
                        echo "<p class=\"prenom\">".$text["prenom"]['fr']."</p>";
                      }else{
                        echo "<p class=\"prenom\">".$text["prenom"][$user_langue]."</p>";
                      }
                      if (empty($text["surnom"][$user_langue])) {
                        echo "<p class=\"surnom\">".$text["surnom"]['fr']."</p>";
                      }else{
                        echo "<p class=\"surnom\">".$text["surnom"][$user_langue]."</p>";
                      }
                    echo "</div>";
                  echo "</a>";
                }
              }
            ?>
          </div>
        </div>
      </div>
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
