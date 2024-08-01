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
        background-color:rgba(25, 100, 175, 0.9);

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
        background-color:rgba(100, 150, 100, 0.5);
    }
    a{
        text-decoration: solid;
        border-radius: 5px;
    }
    </style>
    <body>
        <form method="POST" action="">
            <fieldset><legend style="font-weight: bold; color: aliceblue;">Connexion</legend>
            <table>
                <tr>
                    <td>
                        <input type="text" name="login" placeholder="Votre login"require/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" name="motPasse" placeholder="Votre mot de passe"require/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="connecter" value="Connecter"/>
                        <a href="inscription.php">S'inscrire</a>
                    </td>
                </tr>
            </fieldset>
        </form>
    </body>
</html>
<?php
if(isset($_POST["login"])){
    extract($_POST);
    require "fonction.php";
        authentification($login, $motPasse);
    }

?>