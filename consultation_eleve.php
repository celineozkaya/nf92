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

      //récupération des élèves 
      $query="SELECT * from eleves";
      //echo "<br> $query";
      $r1=mysqli_query($connect,$query);
      if (!$r1) {
        echo "<br> erreur  ".mysqli_error($connect);
        exit;
      }

      echo"<p>Liste des élèves inscrits à l'autoécole : </p>";
      echo"<form method='POST' action='consulter_eleve.php'>";
      echo"<table>";

      //l'utilisateur choisit un élève
      echo"<tr><th> Elèves </th></tr>";
      echo"<tr><td><select name='menuChoixEleve' size='6' required>";
      while ($row=mysqli_fetch_array($r1, MYSQLI_NUM)) {
        echo"<option value=$row[0]>";
        echo"$row[1] $row[2] ($row[3])";
        echo"</option>";
      }

      echo"</select></td></tr>";
      echo"</table>";
      echo"<br>";
      echo'<input type="submit" value="Consulter l\'élève">';
      echo"</form>";

      mysqli_close($connect);
    ?>
  </body>
</html>
