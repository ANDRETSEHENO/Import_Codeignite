# Import CodeIgniter CSV

Une application CodeIgniter 4 professionnelle pour importer des utilisateurs en masse depuis un fichier CSV vers une base de données MySQL.

[![PHP](https://img.shields.io/badge/PHP-8.2-blue)](https://www.php.net/)
[![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4.3.0-red)](https://codeigniter.com/)
[![MySQL](https://img.shields.io/badge/MySQL-%3E%3D8.0-blue)](https://www.mysql.com/)
[![JavaScript](https://img.shields.io/badge/JavaScript-Vanilla-yellow)](https://developer.mozilla.org/fr/docs/Web/JavaScript)
[![CSS3](https://img.shields.io/badge/CSS3-Modern-brightgreen)](https://developer.mozilla.org/fr/docs/Web/CSS)

## Fonctionnalités clés

- 🚀 Import CSV en masse pour alimenter la base de données (Exemple : import.csv dans le repertoire racine du projet)
- 📁 Interface simple de drag-and-drop ou de sélection de fichier
- ✅ Validation des données côté serveur et côté client
- 🛡️ Gestion des erreurs de connexion à la base de données
- 🔄 Flux clair MVC avec `Controllers`, `Models` et `Views`
- 📊 Support d’un format CSV standardisé pour l’import des utilisateurs

## Prérequis

- PHP 8.2 ou supérieur
- MySQL 8.0 ou compatible
- Extensions PHP requises :
  - `mysqli`
  - `pdo`
  - `mbstring`
  - `json`
  - `fileinfo`
- Composer installé
- Ne pas oublier dans creer la base de donne dans App/Database/base.sql

## Installation et Configuration

1. Cloner le dépôt :
   ```bash
   git clone https://github.com/votre-compte/import-codeigniter-csv.git
   cd import-codeigniter-csv