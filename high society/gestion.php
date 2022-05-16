<?php $title="Gerer les produits";
require "elements/head.php";
require "elements/menu.php";
require_once "data/function.php";
session_start();
if (!isset($_SESSION['role'])){
    header('Location:/login.php');
}
if (isset($_POST['ajusteQuantite'])){
    ajusteQuantite((int)$_POST['id'],(int)$_POST['ajusteQuantite']);
    unset($_POST);
}
if (isset($_POST['ajustePrix'])){
    ajustePrix((int)$_POST['id'],(float)$_POST['ajustePrix']);
    unset($_POST);
}
if (isset($_GET['ids'])){
    supprimeEntre((int)$_GET['ids']);
    unset($_GET);
}
?>


<div class="container">

<h1 class="text-center">Gestion du stock</h1>

<?php $data=recupCategorie();
foreach($data as $d=>$v) : ?>

<h3><?= $v['nom'] ?> :</h3>
<table class="table table-striped table-dark">
    <th scope="col">id</th>
    <th scope="col">Nom</th>
    <th scope="col">Quantité</th>
    <th scope="col">Stock disponible</th>
    <th scope="col">Prix</th>
    <th scope="col">Ajuster stock</th>
    <th scope="col">Supprimer</th>
    <?php $data=afficheStock($v['nom']);
    foreach($data as $d => $v): ?>
    <tr>
        <td><?= $v['id'] ?></td>
        <td><?= $v['nom'] ?></td>
        <td><?= $v['quantite'] ?></td> 
        <td><?= $v['stock'] ?></td>
        <td>
        <form action="#" method="post">
                <input type="hidden" name="id" value="<?= $v['id'] ?>">
                <input type="number" step=".50" name="ajustePrix" value="<?= $v['prix'] ?>" required>
                <button class="btn btn-primary" type="submit">Ajuster prix</button>
            </form>
        </td>
        <td>
            <form action="#" method="post">
                <input type="hidden" name="id" value="<?= $v['id'] ?>">
                <input type="number" name="ajusteQuantite" required>
                <button class="btn btn-primary" type="submit">Ajuster quantité</button>
            </form>
        </td>
        <td>
            <button class="btn btn-danger suppr"> <a href="gestion.php?ids=<?= $v['id'] ?>" style="text-decoration: none;color: white">Supprimer</a> </button>
        </td>   
    </tr>

    <?php endforeach; ?>
</table>

<?php endforeach ; ?>



<?php require "elements/footer.php" ?>