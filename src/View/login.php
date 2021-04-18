<main class="form-signin text-center">
    <form action="/connexion" method="post">
        <h1 class="h3 mb-3 fw-normal">Connexion</h1>
        <label for="inputEmail">Adresse Email</label>
        <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Adresse Email" required autofocus>
        <label for="inputPassword">Mot de passe</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Mot de passe" required>
        <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Se connecter</button>
        <p class="mt-1 text-muted">Vous n'avez pas encore de compte ? <a href="/inscription">S'inscrire</a></p>
    </form>
</main>