<?php
session_start();
// ini_set('display_errors','on');
// error_reporting(E_ALL);
include("_connected.php");
include("langue.php");
if(isset($_GET["chapitre"]))
{
  $_SESSION['chapitre'] = $chapitre = strip_tags(trim($_GET["chapitre"]));
  $query = $mysqli->query("SELECT * FROM chapitre WHERE chapitre_id = $chapitre");
  $nb    = $query->num_rows;
  if ($nb > 0)
  {
    $row                = $query->fetch_array();
    $numero_chiffre     = $row["chapitre_numero_fr"];
    $numero_chiffre_jp  = $row["chapitre_numero_jp"];
    $titre_fr           = $row["chapitre_titre_fr"];
    $titre_jp           = $row["chapitre_titre_jp"];
    $resume_fr          = $row["chapitre_resume_fr"];
    $resume_jp          = $row["chapitre_resume_jp"];
    $lien_drive         = $row["chapitre_link"];
    if ($numero_chiffre == 0)
    {
      $spinoff = true;
    }
  }
  if (isset($_SESSION['controlchapmodif']))
  {
    if ($_SESSION['controlchapmodif'] !== $chapitre)
    {
      unset($_SESSION["perso-chapitre-modif"]);
    }
  }
  $_SESSION['controlchapmodif'] = $chapitre;
  // Recuperer les personnages et les metttres en session
  $query3 = $mysqli->query("SELECT * FROM chapitre_perso WHERE chapitre_id = $chapitre ");
  $nb3    = $query3->num_rows;
  if ($nb3 > 0) {
    while($row3 = $query3->fetch_array())
    {
      $idperso = $row3["perso_id"];
      if (isset($_SESSION["perso-chapitre-modif"]))
      {
        if (!in_array($idperso, $_SESSION["perso-chapitre-modif"]))
        {
          array_push($_SESSION["perso-chapitre-modif"],$idperso);
        }
      }
      else
      {
        $_SESSION['perso-chapitre-modif'] = [];
        if (!in_array($idperso, $_SESSION["perso-chapitre-modif"]))
        {
          array_push($_SESSION["perso-chapitre-modif"],$idperso);
        }
      }
    }
  }
}
// else
// {
//   unset($_SESSION['chapitre']);
// }
if (isset($_POST["annuler"]))
{
  unset($_SESSION["perso-chapitre-modif"]);
  header("location:http://tokyoghoul-mirror.com/chapitre.php");
}
if (isset($_POST["envoyer"]))
{
  $numero_chiffre     = htmlspecialchars(trim(strip_tags($_POST["numerochiffre"])),ENT_QUOTES,"UTF-8");
  $numero_chiffre_jp  = htmlspecialchars(trim(strip_tags($_POST["numerojp"])),     ENT_QUOTES,"UTF-8");
  $titre_fr           = htmlspecialchars(trim(strip_tags($_POST["titrefr"])),      ENT_QUOTES,"UTF-8");
  $titre_jp           = htmlspecialchars(trim(strip_tags($_POST["titrejp"])),      ENT_QUOTES,"UTF-8");
  $resume_fr          = htmlspecialchars(trim(strip_tags($_POST["resumefr"])),     ENT_QUOTES,"UTF-8");
  $resume_jp          = htmlspecialchars(trim(strip_tags($_POST["resumejp"])),     ENT_QUOTES,"UTF-8");
  $lien_drive         = htmlspecialchars(trim(strip_tags($_POST["liendrive"])),    ENT_QUOTES,"UTF-8");

  $chapitre = $_SESSION['chapitre'];
  $query  = $mysqli->query("UPDATE chapitre SET
                            chapitre_titre_jp='$titre_jp',
                            chapitre_titre_fr='$titre_fr',
                            chapitre_numero_fr='$numero_chiffre',
                            chapitre_numero_jp='$numero_chiffre_jp',
                            chapitre_resume_fr='$resume_fr',
                            chapitre_resume_jp='$resume_jp',
                            chapitre_link='$lien_drive'
                            WHERE chapitre_id = $chapitre;
                          ");
  // les personnages
  // Supprimer les liens existants
  $query = $mysqli->query("DELETE FROM chapitre_perso WHERE chapitre_id = $chapitre");
  $idinsert = $_SESSION['chapitre'];
  foreach ($_SESSION["perso-chapitre-modif"] as $key => $value)
  {
    $query = $mysqli->query("INSERT INTO chapitre_perso(
                                                        chapitre_perso_id,
                                                        chapitre_id,
                                                        perso_id
                                                        )
                                                        VALUES
                                                        (
                                                          NULL,
                                                          $idinsert,
                                                          $value
                                                        )
                                                          ");
  }
  //  Création de la notification
  if ($numero_chiffre == 0)
  {
    $action = 6;
  }
  else
  {
    $action = 4;
  }
  $date  = strtotime("now");
  $query = $mysqli->query("INSERT INTO notification (
                            notification_id,
                            notification_action,
                            notification_date,
                            user_id,
                            chapitre_id,
                            perso_id
                          ) VALUES (
                            NULL,
                            $action,
                            '$date',
                            '$user_id',
                            $idinsert,
                            0
                          )
                        ");
  unset($_SESSION["perso-chapitre-modif"]);
  header("location:http://tokyoghoul-mirror.com/chapitre.php");
}
if(isset($_POST["supprimer"]))
{
  $chapitre = $_SESSION['chapitre'];
  $query    = $mysqli->query("DELETE FROM chapitre WHERE chapitre_id = $chapitre");
  $query2   = $mysqli->query("DELETE FROM notification WHERE chapitre_id = $chapitre");
  header("location:http://tokyoghoul-mirror.com/chapitre.php");
}
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
    <link rel="stylesheet" href="css/chapitre.css">
    <link rel="stylesheet" href="css/navigation.css">
    <link rel="stylesheet" href="css/navigation-phone.css">
  </head>
  <body>
    <?php
      include("navigation.php");
      include("navigation-phone.php");
    ?>
    <div class="entete">
      <h1><? echo $language_chapitre['chapitre_modif_titre'][$user_langue]; ?></h1>
    </div>
    <div class="container general">
      <div class="col-xs-12">
        <div class="row part">
          <form action="chapitre-modification.php" enctype="multipart/form-data" method="post">
            <div class="col-xs-12">
              <p><i class="fa fa-square-o spinoff" data-switch="0" aria-hidden="true"></i> Spin-off</p>
            </div>
            <div class="col-xs-12 col-md-6">
              <p class="numero-form">
                <label for=""><?php echo $language_chapitre['chapitre_crea_input_num_fr'][$user_langue]; ?></label>
                <input class="form-control numerochiffre" type="text" name="numerochiffre" value="<?php if(isset($numero_chiffre)) echo $numero_chiffre ?>">
              </p>
            </div>
            <div class="col-xs-12 col-md-6">
              <p class="numero-form">
                <label for=""><?php echo $language_chapitre['chapitre_crea_input_num_jp'][$user_langue]; ?></label>
                <input class="form-control numerojap" type="text" name="numerojp" value="<?php if(isset($numero_chiffre_jp)) echo $numero_chiffre_jp ?>">
              </p>
            </div>
            <div class="col-xs-12 col-md-6">
              <p>
                <label for=""><?php echo $language_chapitre['chapitre_crea_input_titre_fr'][$user_langue]; ?></label>
                <input class="form-control" type="text" name="titrefr" value="<?php if(isset($titre_fr)) echo $titre_fr ?>">
              </p>
            </div>
            <div class="col-xs-12 col-md-6">
              <p>
                <label for=""><?php echo $language_chapitre['chapitre_crea_input_titre_jp'][$user_langue]; ?></label>
                <input class="form-control" type="text" name="titrejp" value="<?php if(isset($titre_jp)) echo $titre_jp ?>">
              </p>
            </div>
            <div class="col-xs-12 col-md-6">
              <p>
                <label for=""><?php echo $language_chapitre['chapitre_crea_input_resume_fr'][$user_langue]; ?></label>
                <textarea class="form-control" name="resumefr" rows="8" cols="80"><?php if(isset($resume_fr)) echo $resume_fr ?></textarea>
              </p>
            </div>
            <div class="col-xs-12 col-md-6">
              <p>
                <label for=""><?php echo $language_chapitre['chapitre_crea_input_resume_jp'][$user_langue]; ?></label>
                <textarea class="form-control" name="resumejp" rows="8" cols="80"><?php if(isset($resume_jp)) echo $resume_jp ?></textarea>
              </p>
            </div>
            <div class="col-xs-12">
              <p>
                <label for=""><?php echo $language_chapitre['chapitre_crea_input_google'][$user_langue]; ?></label>
                <input class="form-control" type="text" name="liendrive" value="<?php if(isset($lien_drive)) echo $lien_drive ?>">
              </p>
            </div>
            <div class="col-xs-12">
              <p>
                <label for=""><?php echo $language_chapitre['chapitre_crea_persos'][$user_langue]; ?></label>
              </p>
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
                      'id'                  => $row["perso_id"],
                      'prenom'             => array(	'fr' => $row["perso_prenom_fr"],
                                                      'jp' => $row["perso_prenom_jp"]),

                      'nom'                => array(	'fr' => $row["perso_nom_fr"],
                                                      'jp' => $row["perso_nom_jp"]),

                      'surnom'              => array(	'fr' => $row["perso_surnom_fr"],
                                                      'jp' => $row["perso_surnom_jp"]),

                      'img'              => $row["perso_image"],
                      );
                    echo "<a href=\"javascript:void(0)\">";
                      if (in_array($text['id'], $_SESSION["perso-chapitre-modif"]))
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
            <div class="col-xs-12 col-md-4">
              <p class="actionnor">
                <input class="envoyer" type="submit" name="envoyer" value="<?php echo $language_chapitre['chapitre_crea_input_save'][$user_langue]; ?>">
              </p>
            </div>
            <div class="col-xs-12 col-md-4">
              <p class="actionnor">
                <input class="envoyer" type="submit" name="annuler" value="<?php echo $langage_perso['creation_annuler'][$user_langue]; ?>">
              </p>
            </div>
            <div class="col-xs-12 col-md-4">
              <p class="actionnor">
                <input class="envoyer" type="submit" name="supprimer" value="<?php echo $language_chapitre['chapitre_crea_input_delete'][$user_langue]; ?>">
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      $(document).ready(function(){
        $(".personnage").click(function(){
          var persoId = $(this).attr('data-id');
          $(this).toggleClass("actifperso");
          query = $.ajax({
            type:"POST",
            url:"traitement-chap-perso-modif.php",
            data:"perso="+persoId,
            // success: function(data){
            //   alert(data);
            // }
          });
        });
        <?php
            if ($spinoff)
            {
              ?>
              var dataSwicth = $(".spinoff").attr('data-switch');
              if (dataSwicth == 0) {
                $(".spinoff").removeClass("fa-square-o")
                       .addClass("fa-check-square-o")
                       .attr("data-switch","1");
                $(".numero-form").hide();
              }
              <?php
            }
         ?>
        $(".spinoff").click(function(){
          var dataSwicth = $(this).attr('data-switch');
          if (dataSwicth == 0) {
            $(this).removeClass("fa-square-o")
                   .addClass("fa-check-square-o")
                   .attr("data-switch","1");
            $(".numero-form").fadeOut(function(){
              $(".numerochiffre").val("0");
            });
          }
          if (dataSwicth == 1) {
            $(".numerochiffre").val("");
            $(this).removeClass("fa-check-square-o")
                   .addClass("fa-square-o")
                   .attr("data-switch","0");
            $(".numero-form").fadeIn();
          }
        });
      })
    </script>
  </body>
</html>
