<html>
  <head>
    <link rel="stylesheet" href="feuille_de_style.css">
    <meta charset = "utf-8">
  </head>
  <body>
    <h1> Ajout d'un nouvel élève </h1>

    <?php

      //connexion a la bdd
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a060';
      $dbpass = '0tWFmzHS';
      $dbname = 'nf92a060';
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

      //les données envoyées vers mysql sont encodées en UTF-8
      mysqli_set_charset($connect, 'utf8');

      // récupère les infos du formulaire
      $nom = $_POST["nom"];
      $prenom = $_POST["prenom"];
      $daten = $_POST["date"]; // daten = date de naissance
      // echo "<br> Le(la) nouvel(le) élève est $nom $prenom, né(e) le $daten ";

      //date du jour
      date_default_timezone_set('Europe/Paris');
      $dateJour = date("Y-m-d");

      //on vérifie que la date de naissance soit antérieure à la date du jour
      if ($daten<$dateJour){

        //on cherche à savoir s'il existe déjà un élève homonyme
        $q1="SELECT * FROM eleves WHERE nom='$nom' AND prenom='$prenom'";
        //echo "<br> $q1";
        $r1=mysqli_query($connect, $q1);
        if (!$r1){
          echo "<br> erreur  ".mysqli_error($connect);
          exit;
        }

        $n=mysqli_num_rows($r1);

        //dans la positive, on demande à l'utilisateur s'il souhaite quand même l'ajouter
        if($n!=0){
          echo "Un ou plusieurs élèves portent les mêmes noms et prénoms. Souhaitez-vous tout de même les/ l'ajouter à la base de données?";
          echo "<form method='POST' action='valider_eleve.php'>";
          echo "<tr><td>";
          echo "<input type='radio' name='choix' value='oui' checked> Oui";
          echo "<input type='radio' name='choix' value='non'> Non";
          echo "<input type='hidden' name='nom' value='$nom'>";
          echo "<input type='hidden' name='daten' value='$daten'>";
          echo "<input type='hidden' name='prenom' value='$prenom'>";
          echo "</td></tr>";
          echo "<br><br>";
          echo "<tr><td><input type='submit' value='Valider'></td></tr>";
          echo "</form>";

        }
        else { //sinon on ajoute l'élève à la bdd
          $q2="INSERT INTO eleves VALUES (NULL, '$nom', '$prenom', '$daten', '$dateJour')";
          //echo "<br>$q2<br>";
          $r2=mysqli_query($connect, $q2);
          if (!$r2){
            echo "<br> erreur  ".mysqli_error($connect);
            exit;
          }

          //on renvoit les informations de l'élève à l'utilisateur et on confirme que l'ajout a bien été effectué
          echo "<br><br> $nom $prenom a été ajouté. Voici les informations du nouvel élève : <br><br>";
          echo "<table>";
          echo "<tr><th> Nom : </th><td> $nom </td></tr>";
          echo "<tr><th> Prénom : </th><td> $prenom </td></tr>";
          echo "<tr><th> Date de naissance : </th><td> $daten </td></tr>";
          echo "<tr><th> Date d'inscription : </th><td> $dateJour </td></tr>";
          echo "</table>";
        }
      }
      else{
        echo "Vérifiez la date de naissance de l'élève : la date du jour ne doit pas y être antérieur. <br>
        L'ajout a été annulé. Veuillez ressaisir les informations.";
      }

      mysqli_close($connect);
    ?>
  </body>
</html>
