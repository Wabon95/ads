<article class="border rounded p-4">
    <header>
        <div class="position-relative">
        <?php if ($user->getId() === $ad->getAuthor()->getId()): ?>
            <a href="/annonce/supprimer/<?= $ad->getId() ?>"><button type="button" class="btn btn-danger position-absolute top-1 end-0">Supprimer</button></a>
        <?php endif; ?>
        </div>
        <h1><?= $ad->getTitle() ?></h1>
        <small>Publié le <?= $ad->getFormatedDate() ?> dans <strong><?= $ad->getCategory()->getName() ?></strong> par <strong><?= $ad->getAuthor()->getUsername() ?></strong></small>\
        <p class="card-text mb-auto"><?= $ad->getContent() ?></p>
    </header>
</article>