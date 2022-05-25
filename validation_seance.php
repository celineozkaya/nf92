<html>
  <head>
    <link rel="stylesheet" href="feuille_de_style.css">
    <meta charset="utf-8">
  </head>
  <body>
    <h1> Validation d'une séance terminée </h1>
    <?php
      //connexion à la bdd
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a060';
      $dbpass = '0tWFmzHS';
      $dbname = 'nf92a060';
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Erreur lors de la connection à mysql');
      mysqli_set_charset($connect, 'utf8');

      //date du jour
      date_default_timezone_set('Europe/Paris');
      $dateJour=date("Y-m-d");

      //recupération des séances passées
      $q="SELECT * FROM seances INNER JOIN themes ON seances.idtheme=themes.idtheme WHERE seances.DateSeance<'$dateJour'";
      //echo " <br> $q <br>";
      $result=mysqli_query($connect,$q);
      if (!$result){
        echo "<br> erreur  ".mysqli_error($connect);
        exit;
      }

      //création du formulaire
      echo "<FORM METHOD='POST' ACTION='valider_seance.php'>";
      echo "<table>";
      echo "<tr><th> Séances :</th></tr><td>";
      echo "<select name='menuChoixSeance' size= '4' required>";
      while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
        echo "<option value='$row[0]'>";
        echo "$row[1] (effectif :$row[2])";
        echo "</option>";
      }

      echo "</select></td></tr>";
      echo "</table>";
      echo "<br><br>";
      echo "<INPUT type='submit' value='Valider la séance'>";
      echo "</FORM>";

      mysqli_close($connect);
    ?>
  </body>
</html>
