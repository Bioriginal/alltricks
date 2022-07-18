<?php
include 'ArticleAgregator.php';
include 'RssSource.php';
include 'DatabaseSource.php';


$articleAg = new ArticleAgregator();

$rss = new RssSource('Le Monde',    'http://www.lemonde.fr/rss/une.xml');
$db = new DatabaseSource('alltricks-mysql', 'root', 'root', 'alltricks_test');

$articleAg->addSource($rss);
$articleAg->addSource($db);

$articles = $articleAg->retrieveArticles();

foreach ($articles as $article) {
    echo sprintf('<h2>%s</h2><em>%s</em><p>%s</p>',
        $article->name,
        $article->sourceName,
        $article->content
    );
}