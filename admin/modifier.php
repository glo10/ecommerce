<?php
    session_start();
    if(
        isset($_POST['id'])           &&
        isset($_POST['name'])         &&
        isset($_POST['description'])  &&
        isset($_POST['price'])        &&
        isset($_POST['quantite'])     &&
        !empty($_POST['id'])          &&
        !empty($_POST['name'])        &&
        !empty($_POST['description']) &&
        !empty($_POST['price'])       &&
        !empty($_POST['quantite'])
        )
    {
        require_once '../bdd/bdd_connect.php';
        $id = htmlspecialchars($_POST['id']);
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);
        $price = htmlspecialchars($_POST['price']);
        $quantite = htmlspecialchars($_POST['quantite']);

        $pdo->beginTransaction();

        $reqProduit = ' UPDATE    produit
                        SET       nom_produit = :nom_produit,
                                  description_produit = :description_produit,
                                  prix_produit = :prix_produit
                        WHERE     id_produit = :id_produit';

        $updateProduit = $pdo->prepare($reqProduit);
        $updateProduit->bindParam(':id_produit',$id);
        $updateProduit->bindParam(':nom_produit',$name);
        $updateProduit->bindParam(':description_produit',$description);
        $updateProduit->bindParam(':prix_produit',$price);

        if($updateProduit->execute()){
            $reqGestion = ' UPDATE  gestion
                            SET     stock  = :stock
                            WHERE   id_produit=:id_produit';
            $updateGestion = $pdo->prepare($reqGestion);
            $updateGestion->bindParam(':stock',$quantite);
            $updateGestion->bindParam(':id_produit',$id);

            if($updateGestion->execute()){
                $pdo->commit();
                echo 'modifier';
            }
            else{
              $pdo->rollback();
              echo 'erreur execution deuxieme requete';
            }
        }
        else{
            $pdo->rollback();
            echo 'Erreur d\'exécution de la requête';
        }
    }
    else
    {
        echo 'Les données saisis sont incorrectes.';
    }
