<?php
function msg($x){
    echo '<pre>';
    print_r($x);
    echo '</pre>';
}
if($_SERVER['SCRIPT_NAME'] === '/public/carte.php'){
require_once '../class/Connect.php';
}else{
    require_once 'class/Connect.php';
}

//Gestion du stock
function afficheStock(string $cat):array{
    $data1= Connect::Pdo();
    $data2=$data1->prepare("SELECT stock.id,produit.nom,stock.stock,stock.quantite,stock.prix FROM produit,categorie,stock WHERE produit.id_Categorie=categorie.id and produit.id=stock.id_Produit and categorie.nom='$cat' ORDER BY produit.nom,stock.prix;");
    $data2->execute();
    return $data2->fetchAll(PDO::FETCH_ASSOC);
    
}
function ajusteQuantite(int $id,int $quant):void{
    $data1= Connect::Pdo();
    $data2=$data1->prepare("UPDATE stock set stock.stock=stock.stock+$quant WHERE stock.id=$id");
    $data2->execute();
}

function ajustePrix(int $id,float $prix):void{
    $data1= Connect::Pdo();
    $data2=$data1->prepare("UPDATE stock set stock.prix=$prix WHERE stock.id=$id");
    $data2->execute();
}

function supprimeEntre(int $id):void{
    $data1= Connect::Pdo();
    $data2=$data1->prepare("DELETE FROM stock where stock.id=$id");
    $data2->execute();
}

//Ajout du stock
function recupCategorie():array{
    $data1= Connect::Pdo();
    $data2=$data1->prepare("SELECT * FROM categorie;");
    $data2->execute();
    return $data2->fetchAll(PDO::FETCH_ASSOC);
}
function ajoutNomProduit(string $nom,int $id):void{
    $data1= Connect::Pdo();
    $data2=$data1->prepare("INSERT INTO produit (nom,id_Categorie) VALUES ('$nom',$id);");
    $data2->execute();
}
function choixCategorie(int $id):array{
    $data1= Connect::Pdo();
    $data2=$data1->prepare("SELECT nom FROM categorie WHERE categorie.id=$id;");
    $data2->execute();
    return $data2->fetch(PDO::FETCH_ASSOC);
    
}
function recupIdProduit(string $nom):array{
    $data1= Connect::Pdo();
    $data2=$data1->prepare("SELECT id FROM produit WHERE produit.nom='$nom';");
    $data2->execute();
    return $data2->fetch(PDO::FETCH_ASSOC);
}
function ajoutStock(int $id,int $stock,int $quantite,float $prix):void{
    $data1= Connect::Pdo();
    $data2=$data1->prepare("INSERT INTO stock (stock,quantite,prix,id_Produit) VALUES ('$stock','$quantite','$prix',$id);");
    $data2->execute();
}

function ajoutCat(string $cat):void{
    $data1= Connect::Pdo();
    $data2=$data1->prepare("INSERT INTO categorie (nom) VALUES ('$cat');");
    $data2->execute();
}

function editProduit(string $cat):array{
    $data1= Connect::Pdo();
    $data2=$data1->prepare("SELECT DISTINCT produit.nom FROM produit,categorie WHERE produit.id_Categorie=categorie.id AND categorie.nom='$cat';");
    $data2->execute();
    return $data2->fetchAll(PDO::FETCH_ASSOC); 
}

function recupProduitByName(string $name):array{
    $data1= Connect::Pdo();
    $data2=$data1->prepare("SELECT DISTINCT produit.id FROM produit,stock WHERE stock.id_Produit=produit.id AND produit.nom='$name';");
    $data2->execute();
    return $data2->fetchAll(PDO::FETCH_ASSOC); 
}

//Affichage de la carte


function carte(string $cat):array{
    $data1= Connect::Pdo();
    $data2=$data1->prepare(
"SELECT DISTINCT produit.nom,produit.id 
FROM produit INNER JOIN stock,categorie
WHERE produit.id=stock.id_Produit AND categorie.id=produit.id_Categorie AND categorie.nom='$cat' 
ORDER BY produit.nom;");
    $data2->execute();
    return $data2->fetchAll(PDO::FETCH_ASSOC);
}
function carte2(int $id, string $cat):array{
    $data1= Connect::Pdo();
    $data2=$data1->prepare(
"SELECT DISTINCT * from stock,categorie,produit WHERE produit.id=stock.id_Produit AND produit.id='$id' AND categorie.nom='$cat'
ORDER BY stock.prix;");
    $data2->execute();
    return $data2->fetchAll(PDO::FETCH_ASSOC);
}

//Login

function login($user,$password){
    $data1= Connect::Pdo();
    $data2=$data1->prepare("SELECT * FROM user;");
    $data2->execute();
    while($data = $data2->fetch(PDO::FETCH_ASSOC)){
        if (($data['nom'] === $user)&&($data['password'] === sha1($password))){
            session_start();
            $_SESSION['role']='admin';
            header('Location: gestion.php');
        }
    }
}
?>