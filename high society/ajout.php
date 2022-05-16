<?php $title="Ajouter des produits";
require "elements/head.php";
require "elements/menu.php";
require_once "data/function.php";
session_start();
if (!isset($_SESSION['role'])){
    header('Location:/login.php');
}
if (isset($_POST['nomp'])){
    ajoutNomProduit($_POST['nomp'],(int)$_POST['idc']);
    unset($_POST);
}
if(isset($_POST['stock'])){
    ajoutStock((int)$_POST['id'],(int)$_POST['stock'],(int)$_POST['quantite'],(float)$_POST['prix']);
    unset($_POST);
}
if(isset($_POST['catAjout'])){
    ajoutCat($_POST['catAjout']);
    unset($_POST);
}
if(isset($_POST['quantitee'])&&isset($_POST['stocke'])&&isset($_POST['prixe'])){
    ajoutStock((int)$_POST['idp'],(int)$_POST['stocke'],(int)$_POST['quantitee'],(float)$_POST['prixe']);
    unset($_POST);
}
?>
<div class="container">
<h1>Ajouter des produits</h1>

<?php if(!isset($_POST['categorie'])&&!isset($_POST['editProduit'])) : ?>

 <h2>Choisir la catégorie :</h2> 
 <form action="#" method="post">
<select class="form-select-lg" name="categorie">
<?php $data=recupCategorie();
    foreach($data as $d => $v): ?>
    <option value="<?= $v['id'] ?>"><?= $v['nom'] ?></option>
    <?php endforeach ; ?>
</select>
<button class="btn btn-primary" type="submit">Choisir</button>
</form>



<?php elseif (isset($_POST['categorie'])) : ?>
    <h2>Categorie choisie : <?php $data=choixCategorie($_POST['categorie']);
    echo $data['nom']; ?></h2><br>
    
<?php endif ; ?>

<?php if(!isset($_POST['categorie'])&&!isset($_POST['editProduit'])) : ?>
<br>
<h2>Ajouter une nouvelle catégorie</h2>
<form action="#" method="POST">
<input type="text" name="catAjout" required placeholder="Nom de la nouvelle catégorie">
<button class="btn btn-primary" type="submit">Ajouter</button>
</form>
<?php endif ; ?>


<?php if(isset($_POST['categorie'])) : ?>

    <h2>Ajouter un produit :</h2>

    <form action="#" method="post">
        <table class="table table-striped table-dark">
            <tr>                
                <td>
                    <input name="idc" type="hidden" value="<?= $_POST['categorie'] ?>">
                    <label for="nomp">Nom :</label>
                    <input class="form-control-sm" type="text" name="nomp" required>
                    <button class="btn btn-primary" type="submit">Ajouter</button>
                </td>
            </tr>
        </table>
    </form>
    <br>
    <h2>Editer un produit</h2>
    <form action="#" method="POST">
    <table class="table table-striped table-dark">
        <tr>
            <td>
            <select name="editProduit" class="form-select">
            <?php $data1=choixCategorie($_POST['categorie']);$data2=$data1['nom'] ; $data=editProduit($data2);
            foreach($data as $d => $v) : ?>
            <option value="<?= $v['nom'] ?>"><?= $v['nom'] ?></option>
            <?php endforeach ; ?>
        </select>
        <button class="btn btn-primary" type="submit">Selectioner</button>
    </form>
            </td>
        </tr>
</table>


<?php endif ; ?>

<?php if(isset($_POST['editProduit'])) : ?>

<h2>Ajouter stock sur <?=$_POST['editProduit'] ?> </h2>

<table class="table table-striped table-dark">
    <tr>
        <th>Quantité</th>
        <th>Stock</th>
        <th>Prix</th>
        <th></th>
    </tr>
    <form action="#" method="POST">
    <tr>
    <?php $data=recupProduitByName($_POST['editProduit']);
    foreach($data as $d => $v) : ?>
    <input type="text" name="idp" value="<?= $v['id']?>" hidden>
    <td> <input type="text" name="quantitee" required> </td>
    <td> <input type="number" name="stocke" required> </td>
    <td> <input type="number" name="prixe" step="0.50" required> </td>
    <td><button class="btn btn-primary" type="submit">Ajouter</button></td>
    <?php endforeach ?>
    </tr>

</table>

    </form>

<?php endif ; ?>

<?php if(isset($_POST['nomp'])) : ?>

    <form action="#" method="post" class="table table-striped table-dark">
        <table>
            <tr>
                <th>Stock</th>
                <th>Quantite</th>
                <th>Prix</th>
            </tr>
            <tr>
                <input type="hidden" name="id" value="<?php $data=recupIdProduit($_POST['nomp']);echo $data['id'] ?>">
                <td> <input type="number" name="stock" required></td>
                <td> <input type="text" name="quantite" required></td>
                <td> <input type="number" name="prix" step="0.50" required></td>
            </tr>
        </table>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>

    <?php endif ; ?>

</div>