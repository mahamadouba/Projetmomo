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
        background-color:rgba(125, 100, 175, 0.9);

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
        background-color:rgba(120, 50, 50, 0.5);
    }
    a{
        text-decoration: solid;
        border-radius: 5px;
    }
    </style>
    <body>
        <form method="POST" action="">
            <fieldset><legend style="font-weight: bold; color: aliceblue;">Ajouter une Catégorie</legend>
            <table>
                <tr>
                    <td>
                        <input type="text" name="nomCategorie" placeholder="Entrez le nom de la Catégorie"require/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="ajouter" value="Ajouter"/>
                        
                    </td>
                </tr>
            </fieldset>
        </form>
    </body>
</html>
<?php
if(isset($_POST["ajouter"])){
    extract($_POST);
    require "fonction.php";
    ajoutCategorie($nom);
    }

?>