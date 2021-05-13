<article class="border rounded p-4">
    <header>
        <div class="position-relative">
        <?php if ($user->getId() === $ad->getAuthor()->getId()): ?>
            <!-- <a href="/annonce/supprimer/<?= $ad->getId() ?>"><button type="button" class="btn btn-danger position-absolute top-1 end-0">Supprimer</button></a> -->
        <?php endif; ?>
        </div>
        <h1><?= $ad->getTitle() ?></h1>
        <small>Publié le <?= $ad->getFormatedDate() ?> dans <strong><?= $ad->getCategory()->getName() ?></strong> par <strong><?= $ad->getAuthor()->getUsername() ?></strong></small>
    </header>
</article>


<div class="g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
    <div class="col p-4 d-flex flex-column position-relative">
        <strong class="d-inline-block mb-2 text-primary position-absolute top-1 start-1"><?= $ad->getCategory()->getName() ?></strong>
        <button type="button" class="btn btn-danger position-absolute top-1 start-9">Danger</button>
        <h3 class="mb-0"><?= $ad->getTitle() ?></h3>
        <div class="mb-1 text-muted">Publié le <?= $ad->getFormatedDate() ?></div>
            <p class="card-text mb-auto"><?= $ad->getContent() ?></p>
            <button type="button" class="btn btn-primary">Contacter le vendeur</button>
        </div>
    <div class="col-auto d-none d-lg-block">
</div>