<?php
  define("HOST","db691608193.db.1and1.com");
  define("USER","dbo691608193");
  define("PASS","ag+58plPV5bR+swe");
  define("BDD","db691608193");

  //connextion avec la BDD
  //le @ sert à désactiver les messages d'erreur de connexion trop parlants
  $mysqli = @new mysqli(HOST,USER,PASS,BDD);

  $mysqli->set_charset("utf8");
  //gestion d'un message d'erreur personnalisé en cas d'erreur de connexion
  if($mysqli -> connect_errno)
  {
    //on tue la connection
    //on affcihe un message d'errreur
    die("<p>Try again later !</p>");
  }
?>
