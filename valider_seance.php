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

      //encodage : UTF-8
      mysqli_set_charset($connect, 'utf8');

      //récupération des infos du formulaire
      $idseance=$_POST['menuChoixSeance'];

      //récupération des élèves à noter
      $q="SELECT * FROM inscription INNER JOIN eleves on inscription.ideleve=eleves.ideleve WHERE idseance=$idseance";
      //echo " <br> $q";
      $result=mysqli_query($connect,$q);
      if (!$result){
        echo "<br> erreur  ".mysqli_error($connect);
        exit;
      }

      //création du formulaire pour noter l'élève
      //rappel : row[1]=ideleve, row[2]=note courrante, row[5]=nom, row[6]=prenom
      echo "<br>";
      echo "<FORM METHOD='POST' ACTION='noter_eleves.php'>";
      echo "<table>";
      echo "<INPUT type='hidden' name='menuChoixSeance' value='$idseance'>";
      echo "<tr><th> Eleve :</th><th> Note : </th></tr>";
      while ($row=mysqli_fetch_array($result, MYSQLI_NUM)){
        $note=$row[2];
        echo "<tr><td>$row[5] $row[6]</td>";
        echo "<td><INPUT type='number' name='$row[1]' value='$note' min='0' max='40' required></td></tr>";
      }

      echo "</table>";
      echo "<br><br>";
      echo '<INPUT type="submit" value="Noter l\'élève">';
      echo "</FORM>";

      mysqli_close($connect);
    ?>
  </body>
</html>
