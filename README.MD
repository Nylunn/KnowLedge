# 🚀 Installation et Lancement du Projet Knowledge

Bienvenue dans **Knowledge** ! Ce guide vous aidera à installer et exécuter correctement l'application.

## 📌 Prérequis

Avant de commencer, assurez-vous d’avoir installé les éléments suivants :

- **Git** pour cloner le projet.
- **Composer** pour la gestion des dépendances PHP.
- **Symfony CLI** pour exécuter le serveur de développement.
- **Télécharger la base de données** avec le projet.
- **Importer la base de données fournie** dans votre système de gestion de base de données.

## ⚙️ Installation

1. **Clonez le dépôt Git** :
   ```bash
   git clone https://github.com/Nylunn/knowledge.git
   cd knowledge
   ```
2. **Installez les dépendances du projet** :
   ```bash
   composer install
   ```
3. **Importez la base de données** :

   ```
   - Téléchargez le fichier SQL de la base de données.
   - Importez-le dans votre gestionnaire de base de données (PhpMyAdmin)
   ```

## ▶️ Lancement de l’Application

- **Démarrer le serveur Symfony** :
  ```bash
  symfony server:start
  ```
- **Arrêter le serveur** :
  Appuyez sur `CTRL + C`.

Vous êtes maintenant prêt à explorer **Knowledge** ! 🚀
