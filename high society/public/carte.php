<?php $title="Notre carte";
require "elements/head.php";
require_once "../data/function.php";
?>
<div class="hero">
<div class="container">
<div class="logo">
<img class="img-fluid" src="img/highsociety-logo.png" alt="High Society">
</div>
<h1 class="text-center m-4">Notre carte :</h1>
    <div class="row">
        
        <div class="col-md-6 card" >
        <h2 class="text-center mb-4">Fleur :</h2>
            <?php $data=carte('fleur');
            foreach($data as $d=> $v): ?>
            <div class="card shadow mb-4">
            <div class="card-body">
            <h4 class="card-title text-center"><?= $v['nom'] ?></h4><hr>
            <p class="card-text">Disponible en : </p>
            <ul>
            <?php $data2=carte2((int)$v['id'],'fleur');
            foreach($data2 as $da=>$va) : ?>
            <?php if($va['stock']!=0) : ?>
            <li><?= $va['quantite'] ?> : <?= $va['prix'] ?>€</li>
            <?php endif ; ?>
            <?php endforeach ; ?>
            </ul>
            </div></div>
            <?php endforeach ; ?>
        </div>
        <div class="col-md-6 card" >
        <h2 class="text-center mb-4">Résine :</h2>
            <?php $data=carte('resine');
            foreach($data as $d=> $v): ?>
            <div class="card shadow  mb-4">
            <div class="card-body">
            <h4 class="card-title text-center"><?= $v['nom'] ?></h4><hr>
            <p class="card-text">Disponible en : </p>
            <ul>
            <?php $data2=carte2((int)$v['id'],'fleur');
            foreach($data2 as $da=>$va) : ?>
            <?php if($va['stock']!=0) : ?>
            <li><?= $va['quantite'] ?> : <?= $va['prix'] ?>€</li>
            <?php endif ; ?>
            <?php endforeach ; ?>
            </ul>
            </div></div>
            <?php endforeach ; ?>
        </div>
</div>
</div>

<?php require "elements/footer.php"; ?>