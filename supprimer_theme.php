<html>
  <head>
    <link rel="stylesheet" href="feuille_de_style.css">
    <meta charset="utf-8">
  </head>
  <body>
    <h1> Suppression d'un thème de l'autoécole </h1>
    <?php

      //connexion à la bdd
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a060';
      $dbpass = '0tWFmzHS';
      $dbname = 'nf92a060';
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Erreur lors de la connection à mysql');

      //encodage : UTF-8
      mysqli_set_charset($connect, 'utf8');

      //récupération des informations du formulaire
      $idtheme=$_POST['menuChoixTheme'];

      //maj de supprime à 1 pour indiquer que le thème n'est plus actif
      $qupdate="UPDATE themes SET supprime=1 WHERE idtheme=$idtheme";
      //echo "<br> $qupdate <br>";
      $r=mysqli_query($connect,$qupdate);
      if (!$r) {
        echo "<br> erreur  ".mysqli_error($connect);
        exit;
      }

      //récupération des infos du thème supprimé
      $query="SELECT * FROM themes WHERE idtheme=$idtheme";
      //echo "<br>$query<br>";
      $result=mysqli_query($connect,$query);
      if (!$result) {
        echo "<br> erreur  ".mysqli_error($connect);
        exit;
      }

      //confirmation de la suppression
      echo "<p> Le thème à bien été supprimé, en voici les informations : <br></p>";
      echo"<table>";
      echo"<tr><th> Nom du thème : </th><th> Description : </th></tr>";
      while ($row=mysqli_fetch_array($result, MYSQLI_NUM)) {
        echo"<tr><td> $row[1] </td><td> $row[3] </td></tr>";
      }
      echo"</table>";

      mysqli_close($connect);
    ?>
  </body>
</html>
