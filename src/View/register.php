<main class="form-signin text-center">
    <form action="/inscription" method="post">
        <h1 class="h3 mb-3 fw-normal">Inscription</h1>
        <label for="inputUsername">Pseudo</label>
        <input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="Votre pseudo" required autofocus>
        <label for="inputEmail">Adresse Email</label>
        <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Adresse Email" required>
        <label for="inputPassword">Mot de passe</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Mot de passe" required>
        <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">S'inscrire</button>
        <p class="mt-1 text-muted">Dejà inscrit ? <a href="/connexion">Se connecter</a></p>
    </form>
</main>