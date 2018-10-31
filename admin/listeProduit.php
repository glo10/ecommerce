<?php
    require_once '../bdd/bdd_connect.php';
    array_map('htmlspecialchars', $_POST);

    $request = 'SELECT      P.id_produit,
                            P.nom_produit,
                            P.description_produit,
                            P.prix_produit,
                            G.stock                 as quantite_produit
                FROM        produit P
                JOIN        gestion G
                ON          P.id_produit = G.id_produit
                ORDER BY    P.id_produit';

    $select = $pdo->prepare($request);

    if($select->execute())
    {
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }
    else
    {
        echo 'Aucun produit n\'a pu être récuperer, veuillez recommencer ultérieument';
    }