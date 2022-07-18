
## Explications
    Le sujet du test se trouve dans instructions.php
    Le point d'entrée du programme est "index.php"
    On peut ajouter autant de "sources" à l'articleAgregator que l'on souhaite
    L'idée est la suivante:
     Chaque classe source: RssSource.php et DatabaseSource.php  par exemple doivent implémenter
     l'interface ArticleSourceInterface.
     Les classes sources doivent implémenter la méthode retrieve() chargée de récupérer les articles
     La classe ArticleAgregator est chargée d'aggréger toutes les sources avec la méthode addSource.
     Puis la méthode retrieveArticles permet de récupérer tout les articles de toutes les sources ajoutées précédemment



## Une possibilité pour tester le projet en utilisant docker:

### Database mysql 8
docker run --name alltricks-mysql --network mysql -e MYSQL_ROOT_PASSWORD=root -d mysql:8.0
### Créer la database
docker exec -i  alltricks-mysql mysql -uroot -proot < createDatabase.sql
### Remplir la database
docker exec -i  alltricks-mysql mysql -uroot -proot alltricks_test < ./database.sql

### Du coup il faut installer mysqli d'apres le dockerfile
docker build -t php8-mysqli .

### Lancer le programme sur index.php
docker run -it --network mysql -v "$PWD":/usr/src/app -w /usr/src/app php8-mysqli php index.php



