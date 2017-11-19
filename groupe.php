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
    <link rel="stylesheet" href="css/groupe.css">
    <link rel="stylesheet" href="css/navigation.css">
    <link rel="stylesheet" href="css/navigation-phone.css">
  </head>
  <body>
    <?php
      include("navigation.php");
      include("navigation-phone.php");
    ?>
    <div class="entete">
      <h1><?php echo $langage_home['groupe_h2'][$user_langue]; ?></h1>
    </div>
    <div class="col-xs-12 general">
      <div class="row">
        <div class="col-xs-12 col-md-5">
          <div class="groupegroupe">
            <div class="col-md-4">
              <a href="groupe-crea.php" style="text-decoration: none; color:black;">
                <p class="groupename groupenamecreate">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                  <?php echo $language_groupe["ajout_groupe"][$user_langue]; ?>
                </p>
              </a>
            </div>
            <?php
            $query = $mysqli->query("SELECT * FROM groupe ");
            $nb    = $query->num_rows;
            if ($nb > 0)
            {
              $i = 0;
              while($row = $query->fetch_array())
              {
                $i++;
                $text = array(
                  'nom' => array(
                          'fr' => $row["groupe_nom_fr"],
                          'jp' => $row["groupe_nom_jp"]),
                  'couleur' => $row["groupe_couleur"],
                );
                echo "<div class=\"col-md-4\">";
                if (!isset($text['nom'][$user_langue]))
                {
                  echo "<p class=\"groupename groupename".$i."\" style=\"border: 3px solid ".$text['couleur']."\">".$text['nom']['fr']."</p>";
                }
                else
                {
                  echo "<p class=\"groupename groupename".$i."\" style=\"border: 3px solid ".$text['couleur']."\">".$text['nom'][$user_langue]."</p>";
                }
                echo "</div>";
                echo "<style media=\"screen\">";
                echo ".groupename".$i."{ background-color :".$text['couleur']."; color: white }";
                echo ".groupename".$i.":hover{ background-color : rgb(237, 237, 237); color: ".$text['couleur']." }";
                echo "</style>";
              }
            }
            ?>
          </div>
        </div>
        <div class="col-xs-12 col-md-7">
          <img class="imglieux" src="img/lieuxtokyogoul.png" alt="">
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
