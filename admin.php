<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
        <link rel="stylesheet" href="css/fontawesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/tooplate.css">
        <script>
    function confsuppr(){
        return confirm("Voulez-vous vraiment supprimer ce compte ?");
    }
    </script>
    </head>
    <style>
        body{
            background-color: #8855e9;
            position: relative;
            transition: background-color 1s ease;
            
        }
        /*body::before{
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('ordi et bureau 1.PNG');
            background-size: cover;
            background-repeat: no-repeat;
            filter: opacity(0.5);
            z-index: -1;
        }*/
        
        h2{
            top: 0;
            left: 0;
            width: 50%;
            
            color: whitesmoke;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(0,0,0,0.4);
            
        }
        h3{
            text-decoration: underline;
        }
        a:visited{
        color: goldenrod;
        }
        
        .h3-cont{
            
            text-decoration: underline;
            display: flex;
            justify-content: space-around;
            align-items: left;
            
        }
    </style>
    <?php
    session_start();
    if(!isset($_SESSION["login"])){
        header("location:connexion.php?msg=Veuillez s'authentifier");
        exit();
    }
    else{
        echo "<p style='color:whitesmoke' align='center'> ".$_SESSION["prenom"]." ".$_SESSION['nom']."</p>";
    }
    //liste compte et suppression
    require "fonction.php";
    $personne = listeCompte();// obtenir la liste des personne
    
    //verifier si une suppression est demandee
    if(isset($_GET['id'])){
        $id = $_GET['id'];//recuperation de l'id
        supprimerCompte($id);
    }
    ?>
    <body>
        <marquee behavior="alternate" direction="right" width="825px"><h2>Bienvenue dans la page Administrateur</h2></marquee>
        <div class="h3-cont">
            <h3><a href="inscription.php">Créer un compte</a></h3>
            <h3><a href="AjoutCategorie.php">Ajouter une Catégorie</a></h3>
        </div>
        
        
        <h3>Liste des Personnes</h3>
    <table border="1px">
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Adresse</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th>Login</th>
            <th>Profil</th>
            <th>Suppression</th>
        </tr>
        <?php foreach($personne as $personne):?>
        <tr>
            <td><?php echo $personne['prenom']; ?></td>
            <td><?php echo $personne['nom']; ?></td>
            <td><?php echo $personne['adresse']; ?></td>
            <td><?php echo $personne['tel']; ?></td>
            <td><?php echo $personne['email']; ?></td>
            <td><?php echo $personne['login']; ?></td>
            <td><?php echo $personne['profil']; ?></td>
            <td><a href="admin.php?id=<?php echo $personne['idPersonne'];?>"onclick="return confsuppr();">Supprimer</a></td>
        </tr>
        <?php endforeach;?>
    </table>
    </body>
    <script id="bgColor">
        //tableau de couleur de fond
        var couleurs = ['#f44336','#9c27b0','#3f51b5','#00bcd4','#8bc34a','#ffc107','#795548','#607d8b','e91e63','ff9800'];

        //index de la couleur actuelle
        var indexCouleurCourant = 0;

        //fonction pour changer la couleur de fond toutes les 10s
        function changeBgColor(){
            document.body.style.backgroundColor = couleurs[indexCouleurCourant];
            indexCouleurCourant = (indexCouleurCourant + 1) % couleurs.length;
        }

        //appel de la fonction 
        changeBgColor();

        //duree du changement
        setInterval(changeBgColor, 10000);
    </script>

</html>