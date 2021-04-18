<h1>Modification de profil</h1>
<form action="/profil" method="post">
    <fieldset>
        <legend class="my-3">Informations de connexion</legend>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="inputEmail" class="mb-2">Adresses email</label>
                    <input type="email" class="form-control" name="inputEmail" id="inputEmail" aria-describedby="emailHelp" value="<?= $user->getEmail() ?>" disabled>
                    <small id="emailHelp" class="form-text text-muted">Vous ne pouvez pas changer votre adresse email.</small>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="inputUsername" class="mb-2">Pseudo</label>
                    <input type="text" class="form-control" name="inputUsername" id="inputUsername" value="<?= $user->getUsername() ?>">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="inputActualPassword" class="mb-2">Mot de passe actuel</label>
                    <input type="password" class="form-control" name="inputActualPassword" id="inputActualPassword" aria-describedby="passwordHelp" placeholder="Veuillez renseigner votre mot de passe actuel">
                    <small id="passwordHelp" class="form-text text-muted">N'oubliez pas de renseigner votre mot de passe actuel pour toute modification</small>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend class="my-3">Adresse</legend>
        <div class="row mb-3">
            <div class="col-6">
                <div class="form-group">
                    <label for="inputFirstname" class="mb-2">Prénom</label>
                    <input type="text" class="form-control" name="inputFirstname" id="inputFirstname" value="<?= $user->getFirstname(); ?>">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="inputLastname" class="mb-2">Nom</label>
                    <input type="text" class="form-control" name="inputLastname" id="inputLastname" value="<?= $user->getLastname(); ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="inputPostalCode" class="mb-2">Code postal</label>
                    <input type="text" class="form-control" name="inputPostalCode" id="inputPostalCode" value="<?= $user->getPostalCode(); ?>">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="inputCity" class="mb-2">Ville</label>
                    <input type="text" class="form-control" name="inputCity" id="inputCity" value="<?= $user->getCity(); ?>">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="inputStreet" class="mb-2">Rue</label>
                    <input type="text" class="form-control" name="inputStreet" id="inputStreet" value="<?= $user->getStreet(); ?>">
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend class="my-3">Changement de votre mot de passe</legend>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="inputNewPassword" class="mb-2">Votre nouveau Mot de passe</label>
                    <input type="password" class="form-control" name="inputNewPassword" id="inputNewPassword" placeholder="Veuillez renseigner votre nouveau mot de passe">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="inputNewPasswordConfirm" class="mb-2">Confirmer votre nouveau mot de passe</label>
                    <input type="password" class="form-control" name="inputNewPasswordConfirm" id="inputNewPasswordConfirm" placeholder="Veuillez confirmer votre nouveau mot de passe">
                </div>
            </div>
        </div>
    </fieldset>
    <a href="/mesures" class="btn btn-secondary mt-4">Renseigner ses mesures</a>
    <button type="submit" class="btn btn-primary mt-4">Actualiser mon profil</button>
</form>