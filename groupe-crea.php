<?php
session_start();
include("_connected.php");
include_once("langue.php");

if (isset($_POST["annuler"]))
{
  unset($_SESSION["crea-groupe"]);
  header("location:http://tokyoghoul-mirror.com/groupe.php");
}
if (isset($_POST["envoyer"]))
{
  $nomfr   = NULL;
  $nomjp   = NULL;
  $descfr  = NULL;
  $descjp  = NULL;
  $couleur = NULL;

  if (isset($_SESSION["crea-groupe"]["nomfr"]))
  {
    $nomfr = trim(strip_tags(htmlspecialchars($_SESSION["crea-groupe"]["nomfr"],ENT_QUOTES,"UTF-8")));
  }
  if (isset($_SESSION["crea-groupe"]["nomjp"]))
  {
    $nomjp = trim(strip_tags(htmlspecialchars($_SESSION["crea-groupe"]["nomjp"],ENT_QUOTES,"UTF-8")));
  }
  if (isset($_SESSION["crea-groupe"]["descfr"]))
  {
    $descfr = trim(strip_tags(htmlspecialchars($_SESSION["crea-groupe"]["descfr"],ENT_QUOTES,"UTF-8")));
  }
  if (isset($_SESSION["crea-groupe"]["descjp"]))
  {
    $descjp = trim(strip_tags(htmlspecialchars($_SESSION["crea-groupe"]["descjp"],ENT_QUOTES,"UTF-8")));
  }
  if (isset($_SESSION["crea-groupe"]["couleur"]))
  {
    $couleur = trim(strip_tags(htmlspecialchars($_SESSION["crea-groupe"]["couleur"],ENT_QUOTES,"UTF-8")));
  }

  $query = $mysqli->query("
    INSERT INTO groupe(
    groupe_id,
    groupe_nom_fr,
    groupe_nom_jp,
    groupe_couleur,
    groupe_description_fr,
    groupe_description_jp,
     groupe_actif
     ) VALUES (
     NULL,
     '$nomfr',
     '$nomjp',
     '$couleur',
     '$descfr',
     '$descjp',
     0)
   ");
  $idinsert = $mysqli->insert_id;

  // Ajout ARRONDISSEMENTS
  if (isset($_SESSION["crea-groupe"]["ward"]))
  {
    $arrondissemnts = $_SESSION["crea-groupe"]["ward"];
    foreach ($arrondissemnts as $key => $value)
    {
      if ($value >0)
      {
        $query = $mysqli->query("INSERT INTO groupe_arrondissement (
          groupe_arrondissement_id,
          groupe_id,
          arrondissement_id
        ) VALUES (
          NULL,
          $idinsert,
          $value
        )");
      }
    }
  }

  // Ajout GROUPES
  if (isset($_SESSION["crea-groupe"]["perso"]))
  {
    $perso = $_SESSION["crea-groupe"]["perso"];
    foreach ($perso as $key => $value)
    {
      if ($value >0)
      {
        $query = $mysqli->query("INSERT INTO perso_groupe (
          perso_groupe_id,
          perso_id,
          groupe_id
        ) VALUES (
          NULL,
          $value,
          $idinsert
        )");
      }
    }
  }

  $action = 11;
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

  unset($_SESSION["crea-groupe"]);
  header('location: groupe.php');

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
            <div class="row">
              <div class="col-xs-12 col-md-6">
                <div class="col-xs-12 col-md-6">
                  <p class="numero-form">
                    <label for=""><?php echo $language_groupe['creation_nom_francais'][$user_langue]; ?></label>
                    <input class="form-control creainput" type="text" name="nomfr" value="<?php if(isset($_SESSION["crea-groupe"]["nomfr"])) echo $_SESSION["crea-groupe"]["nomfr"];  ?>">
                  </p>
                </div>
                <div class="col-xs-12 col-md-6">
                  <p class="numero-form">
                    <label for=""><?php echo $language_groupe['creation_nom_japonais'][$user_langue]; ?></label>
                    <input class="form-control creainput" type="text" name="nomjp" value="<?php if(isset($_SESSION["crea-groupe"]["nomjp"])) echo $_SESSION["crea-groupe"]["nomjp"];  ?>">
                  </p>
                </div>

                <div class="col-xs-12 col-md-6">
                  <p class="numero-form">
                    <label for=""><?php echo $language_groupe['creation_description_fr'][$user_langue]; ?></label>
                    <input class="form-control creainput" type="text" name="descfr" value="<?php if(isset($_SESSION["crea-groupe"]["descfr"])) echo $_SESSION["crea-groupe"]["descfr"]; ?>">
                  </p>
                </div>
                <div class="col-xs-12 col-md-6">
                  <p class="numero-form">
                    <label for=""><?php echo $language_groupe['creation_description_jp'][$user_langue]; ?></label>
                    <input class="form-control creainput" type="text" name="descjp" value="<?php if(isset($_SESSION["crea-groupe"]["descjp"])) echo $_SESSION["crea-groupe"]["descjp"]; ?>">
                  </p>
                </div>
                <div class="col-xs-12 col-md-6">
                  <p class="numero-form">
                    <label for=""><?php echo $language_groupe['creation_couleur'][$user_langue]; ?></label>
                    <input class="form-control creainput" type="text" name="couleur" value="<?php  if(isset($_SESSION["crea-groupe"]["couleur"])) echo $_SESSION["crea-groupe"]["couleur"]; ?>">
                  </p>
                </div>
              </div>

              <div class="col-xs-12 col-md-6">
                <p class="numero-form col-xs-12">
                  <label for=""><?php echo $langage_perso['creation_arrondissement'][$user_langue]; ?></label>
                </p>
                <div class="containerarrondissmeent col-xs-12">
                  <?php
                  $a = 1;
                  foreach ($arrondissement as $key => $value)
                  {
                    echo "<p class=\"btnarrond ward ward".$key."\" data-ward=\"".$key."\">";
                    if (isset($_SESSION["crea-groupe"]["ward"]))
                    {
                      if (in_array($key,$_SESSION["crea-groupe"]["ward"]))
                      {
                        echo "<i class=\"fa checkarrond fa-check-square-o\" aria-hidden=\"true\"></i>";
                      }
                      else
                      {
                        echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                      }
                    }
                    else
                    {
                      echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                    }
                    if ($user_langue == "fr")
                    {
                      echo $key;
                      if ($a == 1)
                      {
                        echo "er -";
                      }
                      else
                      {
                        echo "ème - ";
                      }
                      echo $value['fr'];
                    }
                    else
                    {
                      echo $key;
                      echo " : ";
                      echo $value['jp'];
                    }
                    echo "</p>";
                    $a++;
                  }
                  ?>

                </div>
              </div>

            </div>

            <div class="col-xs-12 containerpersos">
              <p>
                <label for=""><?php echo $language_groupe['crea_groupe_perso'][$user_langue]; ?></label>
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
                  if (in_array($text['id'], $_SESSION["crea-groupe"]["perso"]))
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
            <div class="row">
              <div class="col-xs-12 col-md-6">
                <p>
                  <input class="envoyer" type="submit" name="envoyer" value="<?php echo $language_chapitre['chapitre_crea_input_save'][$user_langue]; ?>">
                </p>
              </div>
              <div class="col-xs-12 col-md-6">
                <p>
                  <input class="envoyer" type="submit" name="annuler" value="<?php echo $langage_perso['creation_annuler'][$user_langue]; ?>">
                </p>
              </div>
            </div>
          </form>

        </div>

      </div>
    </div>


    <!-- <div class="footer">
      <i class="fa fa-bars teuteu" aria-hidden="true"></i>
    </div> -->
    <script type="text/javascript">
      $(document).ready(function(){
        /*ARRONDISSEMENTS*/
        $(".ward").click(function(){
          var ward = $(this).data("ward");
          query = $.ajax({
            type:"POST",
            url:"traitement-crea-groupe.php",
            data:"ward="+ward,
            success: function(data){
              if (data == 0)
              {
                $(".ward"+ward+" .fa").addClass("fa-square-o").removeClass("fa-check-square-o");
              }
              else
              {
                $(".ward"+ward+" .fa").removeClass("fa-square-o").addClass("fa-check-square-o");
              }
            }
          });
        });
        $(".personnage").click(function(){
          var persoId = $(this).attr('data-id');
          $(this).toggleClass("actifperso");
          query = $.ajax({
            type:"POST",
            url:"traitement-crea-groupe.php",
            data:"perso="+persoId,
            // success: function(data){
            //   alert(data);
            // }
          });
        });
        $(".creainput").keyup(function(){
          var nomFR = $('input[name="nomfr"]').val();
          var nomJP = $('input[name="nomjp"]').val();
          var descFR = $('input[name="descfr"]').val();
          var descJP = $('input[name="descjp"]').val();
          var couleur = $('input[name="couleur"]').val();
          query = $.ajax({
            type:"POST",
            url:"traitement-crea-groupe.php",
            data:{
              nomFR:nomFR,
              nomJP:nomJP,
              descFR:descFR,
              descJP:descJP,
              couleur:couleur
            },
            success: function(data){
            }
          });
        })
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
