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

      //selection de l'élève
      $query="SELECT * from eleves";
      //echo "<br> $query <br>";
      $result=mysqli_query($connect,$query);
      if (!$result) {
        echo "<br> erreur  ".mysqli_error($connect);
        exit;
      }

      echo "<p>Veuillez selectionner l'élève que vous souhaitez desinscrire :</p>";

      echo"<form method='POST' action='desinscrire_seance.php'>";
      echo"<table>";

      //l'utilisateur choisit un eleve
      echo"<tr><th> Eleves : </th></tr>";
      echo"<tr><td><select name='menuChoixEleve' size='6' required>";
      while ($row=mysqli_fetch_array($result, MYSQLI_NUM)) {
        echo "<option value=$row[0]>";
        echo "$row[1] : $row[2]";
        echo "</option>";
      }
      echo "</select></td></tr>";
      echo "</table>";
      echo "<br>";
      echo '<input type="submit" value="Valider">';
      echo"</form>";

      mysqli_close($connect);
    ?>
  </body>
</html>
