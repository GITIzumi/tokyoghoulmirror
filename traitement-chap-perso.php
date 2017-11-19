<?php
  session_start();
  if (isset($_POST["perso"]))
  {
    $id_perso = strip_tags(trim($_POST["perso"]));
    if (isset($_SESSION["perso-chapitre-crea"]))
    {
      if (in_array($id_perso, $_SESSION["perso-chapitre-crea"]))
      {
        $perso_key = array_search($id_perso, $_SESSION['perso-chapitre-crea']);
        unset($_SESSION['perso-chapitre-crea'][$perso_key]);
      }
      else
      {
        array_push($_SESSION['perso-chapitre-crea'],$id_perso);
      }
    }
    else
    {
      $_SESSION['perso-chapitre-crea'] = array();
      array_push($_SESSION['perso-chapitre-crea'],$id_perso);
    }
  }
?>
