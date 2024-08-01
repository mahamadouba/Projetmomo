<?php 
    session_start();
    if(!isset($_SESSION["login"]))
    {
        header("location:index.php?msg=Veuillez s'authentifier");
        exit();
    }
    else
    {
        echo "<p style='color:goldenrod'align='center'>".$_SESSION["prenom"]." ".$_SESSION["nom"]."</p>";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <style>
        body{
            background-color: #004225;
            position: relative;
            
        }
        h2{
            
            top: 0;
            left: 0;
            width: 50%;
            
            color: goldenrod;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(0,0,0,0.4);
        }
        
        fieldset{
        margin: 50px;
        width: 14.5%;
        border: 50%;
        border-radius: 5px;
        padding: 20px;
        background-color:rgba(0, 0, 0, 0.5);
        }
        

    </style>
    
    <body>
        <marquee behavior="alternate" direction="right" width="717px"><h2>Bienvenue dans la page Utilisateur</h2></marquee>
        <div class="MDP_produit">
        <fieldset>
            
            <h3 style="color:goldenrod">Modifier le mot de passe</h3>
            <form method="POST">
                
                <input type="password" name="ancPassword" placeholder="Ancien mot de passe"/><br>
                
                <input type="password" name="newPassword" placeholder="Nouveau mot de passe" require/><br>
                <input type="submit" name="changer" value="Changer le mot de passe">
            </form>
        
        </fieldset>

        <fieldset>
            <h3 style="color:goldenrod">Enrégistrement de produit</h3>
            <form method="POST">
                
                <input type="text" name="nomProduit" placeholder="Nom du produit" require/><br>
                
                <input type="number" name="quantite" placeholder="Quantité du produit" require/><br>

                <input type="number" name="prix" placeholder="Prix du produit" require/><br>

                <input type="number" name="code" placeholder="Code catégorie" require/><br>
                <input type="submit" name="enregistrer" value="Enrégistrer">
            </form>
            
        </fieldset>
        </div>

    </body>
    <script>
         // Appel a la fonction change de couleur de fond
        document.getElementById("bgColor").changeBgColor();

    </script>
</html>
<?php 
    //include "admin.php";
    require "fonction.php";// connexion avec fonction.php
    
    if(isset($_POST['changer'])){//si le user clique sur changer
        extract($_POST);// extraire tous ce qui a ete saisi sur le formulaire
    
        $log = ($_SESSION['login']);// affecte la variable log au login en cours
        modifierPassword($log, $ancPassword, $newPassword);// executez la fonction modifierPassword
    }
    
    if(isset($_POST['enregistrer'])){
        extract($_POST);
        require "fonction.php";
        if(empty($_GET['code'])){
            echo "Associer le produit à un catégorie";
        }else{
        enregistrerProduit($nomprod, $quantie, $prix, $codeCategorie);
        }
    }

?>