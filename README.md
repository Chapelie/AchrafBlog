
🛠 **Technologies utilisées :** Laravel, Repository Pattern, Sanctum pour l'authentification  

## 🚀 **1. Authentification**
Le backend utilise Laravel Sanctum pour gérer l'authentification des utilisateurs. Toutes les routes nécessitant un utilisateur authentifié doivent inclure un `Authorization: Bearer <TOKEN>` dans les requêtes.

### 📝 **Endpoints d'authentification**
| Méthode | Endpoint | Description |
|---------|---------|-------------|
| `POST`  | `/api/register` | Inscription d'un nouvel utilisateur |
| `POST`  | `/api/login` | Connexion et récupération du token |
| `POST`  | `/api/logout` | Déconnexion et suppression du token |

### 📌 **1.1 Inscription**
**Requête :**  
```http
POST /api/register
Content-Type: application/json
```
```json
{
  "name": "John Doe",
  "email": "john.doe@example.com",
  "password": "password",
  "password_confirmation": "password"
}
```
**Réponse :**  
```json
{
  "message": "Utilisateur créé avec succès",
  "token": "eyJhbGciOiJIUzI1..."
}
```

### 📌 **1.2 Connexion**
**Requête :**  
```http
POST /api/login
Content-Type: application/json
```
```json
{
  "email": "john.doe@example.com",
  "password": "password"
}
```
**Réponse :**  
```json
{
  "message": "Connexion réussie",
  "token": "eyJhbGciOiJIUzI1..."
}
```

### 📌 **1.3 Déconnexion**
**Requête :**  
```http
POST /api/logout
Authorization: Bearer <TOKEN>
```
**Réponse :**  
```json
{
  "message": "Déconnexion réussie"
}
```

---

## 📖 **2. Gestion des Articles (Posts)**
Les articles (posts) permettent de publier du contenu sur la plateforme.

### 📝 **Endpoints des articles**
| Méthode | Endpoint | Description |
|---------|---------|-------------|
| `GET`   | `/api/posts` | Récupérer tous les articles |
| `POST`  | `/api/posts` | Créer un nouvel article |
| `GET`   | `/api/posts/{id}` | Récupérer un article spécifique |
| `PUT`   | `/api/posts/{id}` | Modifier un article |
| `DELETE` | `/api/posts/{id}` | Supprimer un article |

### 📌 **2.1 Récupérer tous les articles**
**Requête :**  
```http
GET /api/posts
```
**Réponse :**  
```json
[
  {
    "id": 1,
    "title": "Premier article",
    "content": "Ceci est le contenu de l'article...",
    "author": "John Doe",
    "likes_count": 5,
    "comments_count": 3
  }
]
```

### 📌 **2.2 Créer un nouvel article**
**Requête :**  
```http
POST /api/posts
Authorization: Bearer <TOKEN>
Content-Type: application/json
```
```json
{
  "title": "Mon nouvel article",
  "content": "Contenu de l'article..."
}
```
**Réponse :**  
```json
{
  "message": "Article créé avec succès",
  "post": { "id": 2, "title": "Mon nouvel article" }
}
```

---

## 💬 **3. Gestion des Commentaires**
Les utilisateurs peuvent commenter un article.

### 📝 **Endpoints des commentaires**
| Méthode | Endpoint | Description |
|---------|---------|-------------|
| `GET`   | `/api/posts/{post}/comments` | Récupérer les commentaires d'un article |
| `POST`  | `/api/posts/{post}/comments` | Ajouter un commentaire |

### 📌 **3.1 Récupérer les commentaires d’un article**
**Requête :**  
```http
GET /api/posts/1/comments
```
**Réponse :**  
```json
[
  {
    "id": 1,
    "content": "Super article !",
    "author": "John Doe",
    "created_at": "2025-02-21"
  }
]
```

### 📌 **3.2 Ajouter un commentaire**
**Requête :**  
```http
POST /api/posts/1/comments
Authorization: Bearer <TOKEN>
Content-Type: application/json
```
```json
{
  "content": "Merci pour cet article très intéressant !"
}
```
**Réponse :**  
```json
{
  "message": "Commentaire ajouté avec succès",
  "comment": { "id": 2, "content": "Merci pour cet article très intéressant !" }
}
```

---

## 👍 **4. Gestion des Likes**
Les utilisateurs peuvent liker/déliker un article.

### 📝 **Endpoints des likes**
| Méthode | Endpoint | Description |
|---------|---------|-------------|
| `POST`  | `/api/posts/{post}/like` | Ajouter/supprimer un like |

### 📌 **4.1 Liker / Disliker un article**
**Requête :**  
```http
POST /api/posts/1/like
Authorization: Bearer <TOKEN>
```
**Réponse (Like ajouté) :**  
```json
{
  "message": "Like ajouté",
  "likes_count": 6
}
```
**Réponse (Like supprimé) :**  
```json
{
  "message": "Like supprimé",
  "likes_count": 5
}
```

---

## ⚙ **5. Middleware & Sécurité**
Toutes les routes protégées nécessitent un utilisateur authentifié avec **Sanctum**.  
**Exemple d'en-tête pour une requête protégée :**
```http
Authorization: Bearer <TOKEN>
```

---

## 📌 **6. Déploiement & Configuration**
**.env à configurer :**  
```
APP_NAME=BlogAPI
APP_URL=http://127.0.0.1:8000

DB_DATABASE=blog
DB_USERNAME=root
DB_PASSWORD=

SANCTUM_STATEFUL_DOMAINS=localhost
```

