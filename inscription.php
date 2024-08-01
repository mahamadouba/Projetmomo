<!DOCTYPE html>
<html>
    <head>
        <title>Formulaire</title>
        <meta charset="UTF-8">
    </head>
    <style>
    body{
        display: flex;
        justify-content: center;
        align-items: center;
        background-color:rgba(25, 150, 75, 0.9);

    }
    label{
        color:aliceblue;
        font-weight: bold;
    }
    fieldset{
        margin: 50px;
        width: 40%;
        border: 50%;
        border-radius: 5px;
        padding: 20px;
        background-color:rgba(150, 50, 100, 0.5);
    }
    </style>
    <body>
        <form method="POST" action="">
            <fieldset><legend style="font-weight: bold; color: aliceblue;">Inscription</legend>
            <table>
                <tr>
                    <td>
                        <input type="text" name="prenom" placeholder="prenom"require/>
                    </td>
                    <td>
                        <input type="text" name="nom" placeholder="nom"require/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="adresse" placeholder="adresse"require/>
                    </td>
                    <td>
                        <input type="number" name="tel" placeholder="telephone"require/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="email" name="email" placeholder="Votre email"require/>
                    </td>
                    <td>
                        <select name="profil" style="width: 175px;">
                            <option>Administrateur</option>
                            <option>Utilisateur</option>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="login" placeholder="Votre login"require/>
                    </td>
                    <td>
                        <input type="password" name="motPasse" placeholder="Votre mot de passe"require/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" name="confPasse" placeholder="Confirmer le mot de passe"require/>
                    </td>
                    <td>
                        <input type="submit" name="creer" value="Créer un compte"/>
                    </td>
                </tr>
            </fieldset>
        </form>
    </body>
</html>
<?php
session_start();
if(isset($_POST["creer"])){

    extract($_POST);
    require "fonction.php"; 
    if($motPasse != $confPasse){
        echo"Les deux mots de passe ne sont pas identiques";
    }
    else if(strlen($motPasse)<8 || strlen($confPasse)>14){

        echo"Veuillez revoir la longueur du mot de passe [8 à 14] caractères";
    }
    else{
        creerCompte($prenom, $nom, $adresse, $tel, $email, $profil, $login, $motPasse);
    }
}
?>