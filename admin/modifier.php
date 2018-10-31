<?php
    session_start();
    print_r($_POST);
    if(
        isset($_POST['id'])           &&
        isset($_POST['name'])         &&
        isset($_POST['description'])  &&
        isset($_POST['price'])        &&
        isset($_POST['qtite'])        &&
        !empty($_POST['id'])          &&
        !empty($_POST['name'])        &&
        !empty($_POST['description']) &&
        !empty($_POST['price'])       &&
        !empty($_POST['qtite'])
        )
    {
        require_once '../bdd/bdd_connect.php';
        $id = htmlspecialchars($_POST['id']);

        $pdo->beginTransaction();

        $reqProduit = ' UPDATE FROM produit
                        SET         nom_produit = :nom_produit,
                                    description_produit = :description_produit,
                                    prix_produit = :prix_produit
                        WHERE       id_produit = :id_produit';
        
        $updateProduit = $pdo->prepare($reqProduit);
        $updateProduit->bindParam(':id_produit',$id);
        $updateProduit->bindParam(':nom_produit',$_POST['name']);
        $updateProduit->bindParam(':description_produit',$_POST['description']);
        $updateProduit->bindParam(':prix_produit',$_POST['price']);

        if($updateProduit->execute()){
            $reqGestion = ' UPDATE FROM gestion
                            SET         stock  = :stock
                            WHERE       id_produit=:id_produit';
            $updateGestion = $pdo->prepare($reqGestion);
            $updateGestion->bindParam(':stock',$_POST['qtite']);
            $updateGestion->bindParam(':id_produit',$id);
            
            if($updateGestion->execute()){
                $pdo->commit();
                echo 'modifier';
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