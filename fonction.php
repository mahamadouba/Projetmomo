<?php
    function database(){
    $host = "localhost";
    $user = "root";
    $pass = "";
    $base = "gestion_produit";

    $con = new mysqli($host, $user, $pass, $base);
    if($con->connect_errno)
        $db = $con->connect_error;
    else
        $db = new mysqli($host, $user, $pass, $base);
    return $db;
    }
    // fin fonction database()
    function creerCompte($pre, $nom, $adr, $tel, $em, $pro, $log, $pas)// declaration
    {
        //version procedural
        $connexion = database();
        //verification du login
        $ver = "select login from compte where login='".$log."'";//requete 1 login verification
        $res = $connexion->query($ver);
        $nb = $res->num_rows;// affectation des nombres de lignes
        if($nb == 1)
            echo "Ce login $log est déja utilisé";
        else
        {
            //insertion dans la table prenom
            $ins_pers = "insert into personne(prenom, nom, adresse, tel, email, profil)
            values('".$pre."','".$nom."','".$adr."','".$tel."','".$em."','".$pro."')";// req 2 insert personne
            $res = $connexion->query($ins_pers);//execution
            if($res){
                $id = $connexion->insert_id;// id en cours
                $motCrypte = sha1($pas);// cryptage du password
                $ins_comp = "insert into compte(login, Password, idPersonne)
                values('".$log."','".$motCrypte."','".$id."')";//insert compte
                $res_comp = $connexion->query($ins_comp);//execution
                if($res_comp){
                echo "Création du compte réussie";
                }
                else{
                echo "Echec d'enregistrement";
                }
            }
            
        }
        $connexion->close();
        //version objet
        /*$connexion = database();
        $ins_pers = "insert into personne(prenom, nom, adresse, tel, email, profil)
            values('".$pre."','".$nom."','".$adr."','".$tel."','".$em."','".$pro."')";
            $res = $connexion->query($ins_pers);
            if($res){
                $id = $connexion->insert_id;
                $motCrypte = sha1($pas);
                $ins_comp = "insert into compte(login, motPasse, idPersonne)
                values('".$log."','".$motCrypte."','".$id."')";
                $res_comp = $connexion->query($ins_comp);
                if($res){
                    echo "Création du compte réussie";
                }
                else{
                    echo "Echec d'enregistrement";
                }
            }*/
    }// fin creation compte

    //fonction pour s'authentifier
    function authentification($log,$pas)
    {
        $db = database();//connexion a la base de données
        $mc = sha1($pas);//verification du mot de passe
        $req = "select * from compte c, personne p where p.idPersonne = c.idPersonne and 
        login ='".$log."' and Password = '".$mc."'";// lancement de la requete
        $res = $db->query($req);// execution de la requete
        $nb = $res->num_rows;// selection des lignes
        if($nb == 0)// parcourrir des lignes
            {
                echo "Ce compte n'existe pas";
            }
        else
        {
            session_start();//utilise une session en cours
            $inf = $res->fetch_assoc();// cretion tableau associatif
            $_SESSION["prenom"] = $inf["prenom"];// recupere les infos de l'utilisateur en cours
            $_SESSION["nom"] = $inf["nom"];
            $_SESSION["profil"] = $inf["profil"];
            $_SESSION["login"] = $inf["login"];
            if($inf["profil"] == "Administrateur"){//verification s'il est admin
                header("location:admin.php");// redirection vers la page admin
                exit();// fin if
            }
            else if($inf["profil"] == "Utilisateur"){//verification s'il est user
                header("location:user.php");// redirection vers la page user
                exit();// fin if
            }
        }
        $db->close();// fermeture de la base de donnees
    }

    // fonction supprimer un compte
    function supprimerCompte($id){
        $db = database();// connexion base de donnees
        $id = intval($id);// securiser l'id
        $req2 = "delete from personne where idPersonne = $id";// lancement de la requete
        $res = $db->query($req2);
        if($res === true){// si la requte est execute
            header("location:admin.php");// affichage de la reussite
            exit();// fin if
        }
        $db->close();// fermeture connexion base de donnees
    }

    //fonction liste compte
    function listeCompte(){
        $db = database();
        $req = "select prenom, nom, adresse, tel, email, login, profil 
            from compte c, personne p where p.idPersonne = c.idPersonne";
            $res = $db->query($req);//execution
            if($res->num_rows > 0){// si le nombre de ligne est superieur a 0
                $personne = array();// soit la variable personne stocke les lignes dans un tableau
                while($row = $res->fetch_assoc()){// tant qu'une nouvelle ligne apparait mettez le dans un tableau associatif
                    $personne[] = $row;// nombres d'occurence du taleau = nombres de ligne
                }
                return $personne;// retourne la valeur de chk ligne du tableau
            }
            else{
    
                return array();// sinon retourne le tableau 
            }
            $db->close();// fermeture connexion base de donnees
            //autre methode
        /*if($res = $db->query($req)){
            
            echo"<table border='1'>";
            echo"<tr><th>Prénom</th><th>Nom</th><th>Adresse</th>
            <th>Téléphone</th><th>Email</th><th>Login</th><th>Profil</th></tr>";
        
            while($liste = $res->fetch_row()){

                    echo"<tr>";
                    echo"<td>".$liste[0]."</td>";
                    echo"<td>".$liste[1]."</td>";
                    echo"<td>".$liste[2]."</td>";
                    echo"<td>".$liste[3]."</td>";
                    echo"<td>".$liste[4]."</td>";
                    echo"<td>".$liste[5]."</td>";
                    echo"<td>".$liste[6]."</td>";
                    echo"</tr>";
            }
            echo"</table>";
                
        }
        else{

            echo"Aucun compte trouvé";
        }
        $db->close();*/
    }

    // fonction pour ajouter des categories
    function ajoutCategorie($nom){
        $db = database();
        $req = "insert into categorie(nomCategorie)
        values('".$nom."')";
        $res = $db->query($req);
        if($res){
            echo "Catégorie ajoutée avec succée";
        }
        else{
            echo "Echec d'ajout de la catégorie";
                
        }
        $db->close();
    }

    // fonction pour modifier son mot de passe
    function modifierPassword($log, $ancPassword, $newPassword){
        $db = database();
        $mc = sha1($ancPassword);
        $new_mc = sha1($newPassword);
        $req = "select Password from compte where login ='$log'";
        $res = $db->query($req);
        if($res->num_rows > 0){
            $ligne = $res->fetch_assoc();
            $ancPassword = $ligne['Password'];
        
            if($ancPassword !== $mc){
            echo "Le mot de passe saisit ne correspond pas à l'ancien.";
            }
            else{
                $req_update = "update compte set Password = '$new_mc' where login = '$log'";
                if($db->query($req_update)){
                echo "Mot de passe mis à jour avec succès.";
                }
                else{
                    echo "Erreur lors de la mise à jour du mot de passe : ";
                }    
            }
        }
        $db->close();
    }

     // fonction pour ajouter des produits
    function enregistrerProduit($nomprod, $quantie, $prix, $codeCategorie){
        $db = database();
        $req = "insert into produit(nomProduit, quantite, prix, codeCategorie)
        values('".$nomprod."','".$quantie."','".$prix."','".$codeCategorie."')";
        $res = $db->query($req);
        if($res){
            echo "<p style='color:goldenrod'>Le produit est enrégistré avec succée</p>";
        }
        else{
            echo "<p style='color:goldenrod'>Echec lors de l'enrégistrement du produit".$db->error;
                
        }
        $db->close();
    }
?>