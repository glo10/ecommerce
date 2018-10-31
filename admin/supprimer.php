<?php
    session_start();
    if(isset($_POST['id']))
    {
        require_once '../bdd/bdd_connect.php';
        $id = htmlspecialchars($_POST['id']);

        $pdo->beginTransaction();

        $reqProduit = ' DELETE FROM produit 
                        WHERE       id_produit=:id_produit';
        
        $deleteProduit = $pdo->prepare($reqProduit);
        $deleteProduit->bindParam(':id_produit',$id);

        if($deleteProduit->execute()){
            $reqGestion = ' DELETE FROM gestion 
                            WHERE       id_produit=:id_produit';
            $deleteGestion = $pdo->prepare($reqGestion);
            $deleteGestion->bindParam(':id_produit',$id);
            
            if($deleteGestion->execute()){
                $pdo->commit();
                echo 'suppression';
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