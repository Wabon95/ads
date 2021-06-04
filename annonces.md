# Annonces

## Description
Ce projet web va être un site de publication d'annonce entre particuliers.

### Fonctionnalités
- Compte utilisateur
  - S'inscrire sur le site
  - Se connecter à son espace utilisateur
  - Renseigner / Modifier ses informations utilisateur
  - Se déconnecter
- Annonces
  - Visiteur
    - Voir les annonces publiées
    - S'inscrire sur le site
  - Utilisateur connecté
    - Voir les annonces publiées
    - Publier une annonce
    - Supprimer une de ses annonces postée
    - Contacter l'auteur d'une annonce
  - Administrateur
    - Supprimer une annonce
    - Supprimer un utilisateur

### Base de données
- user
  - id `int`
  - username `varchar`
  - email `varchar`
  - password `varchar`
  - address `varchar`
  - postal_code `varchar`
  - city `varchar`
  - evaluation `int`
  - created_at `datetime`
  - updated_at `datetime`

- ad
  - id `int`
  - title `varchar`
  - content `text`
  - price `int`
  - created_at `datetime`
  - updated_at `datetime`
  - author `join`

- category
  - id `int`
  - name `varchar`
  - created_at `datetime`
  - updated_at `datetime`

- message
  - id `int`
  - subject `varchar`
  - content `text`
  - created_at `datetime`
  - author `join`