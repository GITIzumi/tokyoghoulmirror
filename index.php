<?php
session_start();
if (isset($_SESSION["keepitalive"]))
{
  $id_user = $_SESSION["keepitalive"];
  include("connexion.php");
  $query = $mysqli -> query("SELECT * FROM user WHERE user_id = $id_user AND user_statut > 0");
  $nb    = $query -> num_rows;
  if ($nb == 1)
  {
    header("location:/home.php");
  }
  else
  {
    header("location:_logout.php");
    include("erreur404.php");
    die();
  }
}
session_regenerate_id();
//  CONNEXION
if (isset($_POST["connexion"]))
{
  $gotoscript = true;
  $name_connexion     = strip_tags(trim($_POST["name_connexion"]));
  $password_connexion = strip_tags(trim($_POST["password_connexion"]));
  $content = true;
  if (empty($name_connexion))
  {
    $content = false;
    $erreur = true;
    // $erreur_name_connexion = "Prénom invalide";
  }
  if (empty($password_connexion))
  {
    $content = false;
    $erreur = true;
    // $erreur_password_connexion = "Impossible de se connecter";
  }
  if ($content)
  {
    $pass_connexionOK = hash("sha512",$password_connexion);
    include_once("connexion.php");
    $query = $mysqli->query("SELECT * FROM user WHERE user_prenom = '$name_connexion' AND user_mdp = '$pass_connexionOK' AND user_statut > 0");
    $nb = $query -> num_rows;
    if($nb == 1)
    {
      $row = $query -> fetch_array();
      $_SESSION["keepitalive"] = $row["user_id"];
      header("Location:/home.php");
    }
    else
    {
      $erreur = true;
      // sleep(3);
      // $retour = "Impossible de se conecter avec cet identifiant et ce mot de passe... Cliquez ce <a href=\"/forget.php\">lien</a> si vous avez oublié votre mot de passe";
    }
  }
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
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/porte.css">
  </head>
  <body>
    <div class="container">
      <?php
        include("connexion.php");
        $query = $mysqli->query("SELECT * FROM perso WHERE perso_visibilite = 0 AND perso_actif = 1 ORDER BY RAND() LIMIT 1 ");
        $nb    = $query->num_rows;
        if ($nb > 0)
        {
          $row = $query->fetch_array();
          $imageperso = $row["perso_image"];
        }
      ?>
      <div class="profil" style="background-image: url(img/persos/<?php echo $imageperso ?>);"></div>
      <form class="formconnection" enctype="multipart/form-data" method="post">
        <p>
          <input class="champconnexion" type="text" name="name_connexion" placeholder="Prénom"<?php if (isset($erreur)) echo " style=\"background-color:rgb(165, 54, 54);\""?><?php if(isset($name_connexion)) echo " value=\"$name_connexion\""; ?>>
        </p>
        <p>
          <input class="champconnexion" type="password" name="password_connexion" placeholder="Mot de passe"<?php if (isset($erreur)) echo " style=\"background-color:rgb(165, 54, 54);\""?>>
        </p>
        <p>
          <input class="btnconnexion" type="submit" name="connexion" value="CONNEXION">
        </p>
      </form>
      <div class="blocktitre">
         <p>
           <a href="http://tokyoghoul-mirror.com/index.php">
           T O K Y O <br> G H O U L <strong>R P</strong><br> M I R R O R
           </a>
         </p>
       </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function(){



      })
    </script>
  </body>
</html>
