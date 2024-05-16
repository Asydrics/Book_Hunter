<?php
/*

Tout dabord on établi une structure de dossiers du projet qui est :
    - app
        - controllers
        - models
        - routers
        - templates
        - view
            - posts
    - documents
    - public
    - test

1.  TEMPLATE dans app > templates > template.php 

    ROLE :
        Le template contient le code client complet (Doctype, html, head, body, …) avec :
            - Tout le code statique du site
            - En y affichant les zones dynamiques avec des echo ($zonePrincipale, …)

    QUE FAIRE : 
        - Je met en place le template et j'y place ma variable $content (qui contient la zone dynamique)
        - Pour rappel le template c'est la partie statique du site mis en page graphiquement 

2.  DISPATCHER dans public > index.php 

    ROLE :
        C’est le point d’entrée de notre application son rôle est de :
            - Charger le routeur dont le rôle est, au final, de mettre du contenu dans les zones dynamiques du template ($content, …)
            - Charger le template qui affichera tout le code client avec les zones dynamiques ($content, …)

    QUE FAIRE :
        - Je charge sur mon dispatcher le fichier template 
            --> require_once 'template.php';
        - Je charge sur mon dispatcher le controler
            --> include_once 'controler.php'

3. ROUTEUR dans app > routeur > index.php

    ROLE :
        Le but final du routeur est de faire en sorte que les zones dynamiques du templates soient hydratées avec le contenu attendu
        Pour ce faire, il va devoir, en fonction de l’URL :
            - Choisir le contrôleur à charger
            - Lancer une des actions de ce contrôleur

    QUE FAIRE :
        // ROUTE par défaut:
        // PATTERN: /?postID=x
        // CTRL: postsController
        // ACTION: show
            if (isset($_GET['postID'])) :
                include_once '../app/controllers/postsController.php';
                showAction($_GET['postID']);

        // ROUTE par défaut:
        // PATTERN: /
        // CTRL: postsController
        // ACTION: index
            else :
                include_once '../app/controllers/postsController.php';
                indexAction();
            endif;

4. POST CONTROLLER  dans app > controllers > PostController.php

    ROLE :
        Le contrôleur est un fichier qui contient des fonctions nommées ‘Actions’
        Chaque action du contrôleur a pour rôle :
            - De demander des infos à son modèle et les récupérer dans une variable qui sera accessible à la vue
            - De charger une vue, en la plaçant éventuellement dans une des zones dynamique du template grâce à un tampon

    QUE FAIRE :
        function indexAction() {
            include_once "../app/models/postsModel.php";
            $posts = findAll();

            global $content;
            ob_start();
            include "../app/views/posts/index.php";
            $content = ob_get_clean();
        }

        function showAction(int $id) {
            include_once "../app/models/postsModel.php";
            $post = findOneById($id);

            global $content;
            ob_start();
            include "../app/views/posts/show.php";
            $content = ob_get_clean();
        }

5. POST MODELS dans app > models > postModel.php
    
    ROLE :
        Le modèle est un fichier qui contient des fonctions
        Chaque fonction du modèle a pour rôle :
            - Aller chercher des données (en général dans la base de données via une requête SQL)
            - Retourner ces données au contrôleur grâce à un ‘return’

    QUE FAIRE : 

    function findAll(): array {
        // Exécuter une requête SQL
        // SELECT *
        // FROM posts
        // ORDER BY created_at DESC
        // LIMIT 10
        return [
            ['id' => 1, 'title' => "Titre du post 1", 'content' => "Lorem ispum 1"],
            ['id' => 2, 'title' => "Titre du post 2", 'content' => "Lorem ispum 2"],
            ['id' => 3, 'title' => "Titre du post 3", 'content' => "Lorem ispum 3"],
            ['id' => 4, 'title' => "Titre du post 4", 'content' => "Lorem ispum 4"],
            ['id' => 5, 'title' => "Titre du post 5", 'content' => "Lorem ispum 5"],
        ];
    }

    function findOneById(int $id): array {
        // SELECT *
        // FROM posts
        // WHERE id = $id
        return ['id' => $id, 'title' => "Titre du post $id", 'content' => "Lorem ispum $id"];
    }

6. LES VUES dans app > view > posts > index.php ET app > view > posts > show.php

    ROLE : 
        La vue contient du code client (HTML) avec la mise en page des infos envoyées par le contrôleur...
        C'est ce que va contenir notre $content

    QUE FAIRE (EXEMPLE) 
        - Pour index.php :

            <?php
                // Variables disponibles
                // - $posts ARRAY(ARRAY id, title, content)
            ?>
            <h2>Liste des posts</h2>
            <ul>
                <?php foreach ($posts as $post) : ?>
                    <li>
                        <a href="?postID=<?php echo $post['id'] ?>">
                            <?php echo $post['title']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

    QUE FAIRE (EXEMPLE)
        - Pour show.php :

            <?php
                // Variables disponibles
                // $post ARRAY(id, title, content)
            ?>
            <h2><?php echo $post['title']; ?></h2>
            <div>
                <?php echo $post['content']; ?>
            </div>
*/
