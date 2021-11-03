<?php
// use App\Core\Helpers;
// $title = 'Synchronisation';
?>
<!-- <h1>SYNCHRONISER SUR LE SITE</h1> -->

<?php if (isset($info)) : ?>
    <div class="alert alert-success" role="alert">
        <?= 'OK' ?>
    </div>
<?php endif ?>

<?php if (isset($error)) : ?>
    <div class="alert alert-danger" role="alert">
        <?= 'error' ?>
    </div>
<?php endif ?>

<div class="row">
    
<!-- <div class="table-container"> -->
    <table class="table table-bordered table-striped table-highlight header-fixed">
            <thead>
            <tr class="menu">
                <th id="center" >ID</th>
                <th id="center2">DATE</th>
                <th id="center1" >ARTICLES</th>
                <th id="center"></th>
                <th id="center"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $article) : ?>
                <tr>
                    <td id="center"># <?= $article->idart ?></td>
                  
                    <td id="center1"> <?= $article->new_name ?> </a></td>
                    <td id="center">
                    <a href="/connector/items/add/<?= $article->idart ?>" class="btn btn-success btn-xs active"  style="display:flex; justify-content:center;" role="button">ADD</a>
                    </td>
                    <td id="center">
                    <a href="/connector/items/add/<?= $article->idart ?> " class="btn btn-danger btn-xs active" role="button">DEL</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <!-- </div> -->
</div>


