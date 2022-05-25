<html>
  <head>
    <link rel="stylesheet" href="feuille_de_style.css">
    <meta charset="utf-8">
  </head>
  <body>
    <h1> Consultation d'un élève </h1>
    <?php

      //connexion à la bdd
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a060';
      $dbpass = '0tWFmzHS';
      $dbname = 'nf92a060';
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Erreur lors de la connection à mysql');

      //encodage : UTF-8
      mysqli_set_charset($connect, 'utf8');

      //récupération des données du formulaires
      $ideleve=$_POST['menuChoixEleve'];

      //récupération des informations de l'élève
      $query="SELECT * from eleves WHERE ideleve=$ideleve ";
      //echo "<br> $query";
      $r1=mysqli_query($connect,$query);
      if (!$r1) {
        echo "<br> erreur  ".mysqli_error($connect);
        exit;
      }

      //tableau renseignant les informations de l'élève
      echo"<table>";
      echo"<tr><th> Nom: </th><th> Prenom: </th><th> Date de naissance:</th><th> Date d'inscription:</th></tr>";
      while ($row=mysqli_fetch_array($r1, MYSQLI_NUM)) {
        echo"<tr><td> $row[1] </td><td> $row[2] </td><td> $row[3] </td><td> $row[4] </td></tr>";
      }
      echo"</table>";

      mysqli_close($connect);
    ?>
  </body>
</html>
