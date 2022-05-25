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

      $query="SELECT * from themes WHERE supprime=0";
      //echo "<br> $query <br>";
      $r=mysqli_query($connect,$query);
      if (!$r) {
        echo "<br> erreur  ".mysqli_error($connect);
        exit;
      }

      echo"<form method='POST' action='supprimer_theme.php'>";
      echo"<table>";

      //l'utilisateur choisit un thème à supprimer
      echo"<tr><th> Thèmes : </th></tr>";
      echo"<tr><td><select name='menuChoixTheme' size='6' required>";
      while ($row=mysqli_fetch_array($r, MYSQLI_NUM)) {
        echo"<option value=$row[0]>";
        echo"$row[1] ($row[3])";
        echo"</option>";
      }

      echo"</select></td></tr>";
      echo"</table>";
      echo"<br>";
      echo'<input type="submit" value="Supprimer le thème">';
      echo"</form>";

      mysqli_close($connect);
    ?>
  </body>
</html>
