<html>
  <head>
    <link rel="stylesheet" href="feuille_de_style.css">
    <meta charset="utf-8">
  </head>
  <body>
    <h1> Visualisation du calendrier d'un élève </h1>
    <?php

      //connexion à la bdd
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a060';
      $dbpass = '0tWFmzHS';
      $dbname = 'nf92a060';
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Erreur lors de la connection à mysql');

      //encodage : UTF-8
      mysqli_set_charset($connect, 'utf8');

      //choix de l'élève
      $query="SELECT * FROM eleves";
      //echo "<br>$query<br>";
      $result=mysqli_query($connect, $query);
      if (!$result) {
        echo "<br> erreur  ".mysqli_error($connect);
        exit;
      }

      //liste des eleves
      echo "<p>Veuillez choisir un élève afin d'en visualiser le calendrier</p>";

      echo "<FORM METHOD='POST' ACTION='visualiser_calendrier_eleve.php'>";
      echo "<table>";
      echo "<tr><th>Eleves :</th></tr>";
      echo "<tr><td><select name='menuChoixEleve' size='4' required>";
      while ($row=mysqli_fetch_array($result, MYSQLI_NUM)) {
        echo "<option value='$row[0]'>";
        echo "$row[1] $row[2] ($row[3])";
        echo "</option>";
      }
      echo "</select></td></tr>";
      echo "</table>";
      echo "<br>";
      echo "<INPUT type='submit' value='Consulter le calendrier'>";
      echo "</FORM>";

      mysqli_close($connect);
    ?>
  </body>
</html>
