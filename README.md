# authJWT - sf

Projet d’exemple d’authentification avec **JWT** sous **Symfony**, utilisant **API Platform** pour exposer des ressources et sécuriser les accès.

## 🚀 Présentation

Ce projet montre comment mettre en place un système d’authentification **JSON Web Token (JWT)** dans un projet **Symfony**, avec :
- Un mécanisme de hashage des mots de passe via un listener.
- L’intégration du bundle `lexik/jwt-authentication-bundle`.
- L’utilisation d’API Platform pour exposer des entités sécurisées.
- La configuration de `security.yaml` et `routes.yaml` pour protéger certaines routes.

## 📦 Installation & Test

### 1. Cloner le projet
```bash
git clone https://github.com/<ton-user>/authJWT-sf.git
cd authJWT-sf
```

### 2. Installer les dépendances
```bash
composer install
```

### 3. Configurer la base de données
Modifier le fichier `.env` avec vos identifiants puis :
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

### 4. Générer les clés JWT
```bash
php bin/console lexik:jwt:generate-keypair
```

### 5. Lancer le serveur
```bash
symfony server:start
```

### 6. Tester l’authentification
- Endpoint pour obtenir un token :  
  `POST /api/login_check`  
  ```json
  {
    "username": "demo",
    "password": "demo"
  }
  ```

- Exemple de requête avec token :  
  ```bash
  curl -H "Authorization: Bearer <votre_token>" https://127.0.0.1:8000/api/articles
  ```

## 🛠 Explication du fonctionnement

1. **Hashage des mots de passe**  
   → Géré par un listener, qui s’assure que les mots de passe utilisateurs soient encodés avant la persistance en base.

2. **JWT Authentication**  
   → Mise en place grâce au `lexik/jwt-authentication-bundle`.  
   Lorsqu’un utilisateur se connecte, un token signé est généré et doit être utilisé pour chaque requête authentifiée.

3. **API Platform**  
   → Les entités (Article, Category, User) sont exposées en REST via API Platform.  
   Les ressources protégées nécessitent un token JWT valide.

4. **Sécurité & Configuration**  
   - `security.yaml` définit les firewalls et les règles d’accès.  
   - `routes.yaml` configure les endpoints pour `login_check` et les API.

## 🔮 Améliorations possibles

- Ajouter une gestion des rôles (ex : `ROLE_ADMIN`, `ROLE_USER`).
- Mettre en place des tests fonctionnels pour vérifier l’authentification.
- Dockerisation du projet pour simplifier le déploiement.

---

## 👤 Auteur
Projet réalisé par **Alex Hamon**  
📅 Août 2024
