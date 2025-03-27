# Test Technique

Ce test a vocation à évaluer les compétences techniques et le savoir-faire sur la technologie. La qualité du test sera l’aspect le plus important dans ce rendu. Toute prise d’initiative supplémentaire sera évidemment prise en compte. En cas de doute sur certains points de ce test, ne pas hésiter à nous contacter à it@hellocse.fr.

## Objectif

À l’aide de Laravel 10/11, créer une API qui possède :

### Entité "Administrateur"
- Seuls les utilisateurs authentifiés sur le projet peuvent être administrateurs.
- Les champs composant cette entité ne sont pas importants, l’idée étant simplement de protéger certains endpoints de l’application.

### Endpoint protégé pour la création de "Profil"
- Accessible uniquement par un administrateur.
- L'entité "Profil" doit contenir les champs suivants :
  - `nom`
  - `id` de l'administrateur ayant créé le profil
  - `prénom`
  - `image` (un véritable fichier)
  - `statut` (inactif, en attente, actif)
  - Timestamps classiques

### Entité "Commentaire"
- Relation de type **N:1** avec les profils.
- Champs requis :
  - `contenu`
  - `id` de l'administrateur ayant posté le commentaire
  - `id` du profil concerné par le commentaire
  - Timestamps classiques

### Endpoint protégé pour l'ajout de commentaires
- Permet d'ajouter des commentaires sur un profil.
- Un administrateur ne peut poster **qu'un seul commentaire** sur un profil.

### Endpoint public pour la récupération des profils actifs
- Retourne uniquement les profils ayant le statut "actif".
- Ne doit pas retourner le champ `statut` (champ visible uniquement pour les utilisateurs authentifiés).

### Endpoint protégé pour la modification ou suppression de profil
- Accessible uniquement aux administrateurs authentifiés.

## Indications
- **Validation et typage des données** via FormRequest.
- Utilisation de **seeders, factories et tests unitaires**.
- L’utilisation d'outils **d'analyse statique du code** est un plus.
- Intégration de **notions de sécurité** pour l'authentification.
- Ajout de commentaires dans le code et création de commits Git réguliers.
- Exploitation des fonctionnalités de **PHP8+** (types, etc.).
- Bonne **séparation du code métier**.
- Utilisation d'**IA autorisée**, mais les choix devront être justifiés lors de l'entretien.

## Rendu attendu
- Repository **GitHub** ou **GitLab** public contenant le code du projet.

# Test Technique

Ce test a vocation à évaluer les compétences techniques et le savoir-faire sur la technologie. La qualité du test sera l’aspect le plus important dans ce rendu. Toute prise d’initiative supplémentaire sera évidemment prise en compte. En cas de doute sur certains points de ce test, ne pas hésiter à nous contacter à it@hellocse.fr.

## Objectif

À l’aide de Laravel 10/11, créer une API qui possède :

### Entité "Administrateur"
- Seuls les utilisateurs authentifiés sur le projet peuvent être administrateurs.
- Les champs composant cette entité ne sont pas importants, l’idée étant simplement de protéger certains endpoints de l’application.

### Endpoint protégé pour la création de "Profil"
- Accessible uniquement par un administrateur.
- L'entité "Profil" doit contenir les champs suivants :
  - `nom`
  - `id` de l'administrateur ayant créé le profil
  - `prénom`
  - `image` (un véritable fichier)
  - `statut` (inactif, en attente, actif)
  - Timestamps classiques

### Entité "Commentaire"
- Relation de type **N:1** avec les profils.
- Champs requis :
  - `contenu`
  - `id` de l'administrateur ayant posté le commentaire
  - `id` du profil concerné par le commentaire
  - Timestamps classiques

### Endpoint protégé pour l'ajout de commentaires
- Permet d'ajouter des commentaires sur un profil.
- Un administrateur ne peut poster **qu'un seul commentaire** sur un profil.

### Endpoint public pour la récupération des profils actifs
- Retourne uniquement les profils ayant le statut "actif".
- Ne doit pas retourner le champ `statut` (champ visible uniquement pour les utilisateurs authentifiés).

### Endpoint protégé pour la modification ou suppression de profil
- Accessible uniquement aux administrateurs authentifiés.

## Indications
- **Validation et typage des données** via FormRequest.
- Utilisation de **seeders, factories et tests unitaires**.
- L’utilisation d'outils **d'analyse statique du code** est un plus.
- Intégration de **notions de sécurité** pour l'authentification.
- Ajout de commentaires dans le code et création de commits Git réguliers.
- Exploitation des fonctionnalités de **PHP8+** (types, etc.).
- Bonne **séparation du code métier**.
- Utilisation d'**IA autorisée**, mais les choix devront être justifiés lors de l'entretien.

## Rendu attendu
- Repository **GitHub** ou **GitLab** public contenant le code du projet.

