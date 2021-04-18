# Petites Annonces

## Description
Ce site à pour but de porposer aux particuliers de publier des petites annonces.
- Technos
  - Bootstrap
  - Font Awesome
  - Slugify
  - Altorouter
  - Vardumper
### Fonctionnalités
- Espace utilisateur
  - Se connecter
  - Se déconnecter
  - Modifier ses informations de profil
- Annonces
  - En tant que visiteur
    - Consulter toutes les annonces
    - Consulter une annonce en particulier
  - En tant que membre connecté
    - Contacter l'auteur d'une annonce
  - En tant que membre connecté et auteur d'une annonce
    - Supprimer l'annonce

- Messagerie privée
- Annnonces regroupées par catégories

### Base de données
- User
  - id
  - username
  - avatar
  - email
  - password
  - street
  - postal_code
  - city
  - created_at
  - updated_at

- Ad
  - id
  - title
  - content
  - price
  - pictures
  - category
  - created_at
  - updated_at
  - author

- Messages
  - id
  - content
  - sender
  - receiver
  - created_at
  - updated_at
