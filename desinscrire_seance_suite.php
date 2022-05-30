
<html>
  <head>
    <link rel="stylesheet" href="feuille_de_style.css">
    <meta charset="utf-8">
  </head>
  <body>
    <h1> Desinscription d'un élève à une séance </h1>
    <?php

      //connexion à la bdd
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a060';
      $dbpass = '0tWFmzHS';
      $dbname = 'nf92a060';
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Erreur lors de la connection à mysql');

      //encodage : UTF-8
      mysqli_set_charset($connect, 'utf8');

      //date du jour
      date_default_timezone_set('Europe/Paris');
      $dateJour=date("Y-m-d");

      //recupération des données du formulaire
      $ideleve=$_POST['menuChoixEleve'];
      $idseance=$_POST['menuChoixSeance'];

      //desinscription
      $query="DELETE FROM inscription WHERE ideleve=$ideleve AND idseance=$idseance";
      //echo "<br> $query <br>";
      $result=mysqli_query($connect,$query);
      if (!$result) {
        echo "<br> erreur  ".mysqli_error($connect);
        exit;
      }

      echo "<p> L'élève a été desinscrit de la séance. <p>";

      mysqli_close($connect);
    ?>
  </body>
</html>
