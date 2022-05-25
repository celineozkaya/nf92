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

      //récupération des informations du formulaire
      $idseance = $_POST['menuChoixSeance'];

      //récupération des élèves de la séance à noter
      $q="SELECT * FROM inscription INNER JOIN eleves ON inscription.ideleve=eleves.ideleve WHERE idseance=$idseance";
      //echo " <br> $q";
      $r=mysqli_query($connect,$q);
      if (!$r){
        echo "<br> erreur  ".mysqli_error($connect);
        exit;
      }

      //maj des notes
      while($row= mysqli_fetch_array($r)){
        $ideleve = $row[1];
        $note=$_POST[$row[1]];
        $qupdate="UPDATE inscription SET note=$note WHERE idseance=$idseance AND ideleve=$ideleve";
        //echo"<br>$qupdate";
        $rupdate = mysqli_query($connect, $qupdate);
        if (!$rupdate){
          echo "<br> erreur ".mysqli_error($connect);
          exit;
        }
      }

      echo "<br> Les élèves ont bien été notés : <br>";

      //récapitulatif des notes saisies
      $qnotes="SELECT nom, prenom, note FROM inscription INNER JOIN eleves ON inscription.ideleve=eleves.ideleve WHERE idseance=$idseance";
      //echo " <br> $qnotes";
      $rnotes=mysqli_query($connect,$qnotes);
      if (!$rnotes){
        echo "<br> erreur  ".mysqli_error($connect);
        exit;
      }

      echo "<table>";
      echo "<tr><th> Nom :</th><th> Prénom :</th><th> Note :</th></tr>";
      while ($row_notes=mysqli_fetch_array($rnotes)) {
        echo "<tr><td> $row_notes[0] </td><td> $row_notes[1] </td><td> $row_notes[2] </td></tr>";
      }
      echo "</table>";

      mysqli_close($connect);
    ?>
  </body>
</html>
