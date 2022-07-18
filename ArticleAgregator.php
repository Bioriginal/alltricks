<?php

/**
 * Classe chargée d'agréger les articles
 * et de les récupérer indépendamment de la source
 */
class ArticleAgregator
{
    /**
     * Tableau de sources de données à parcourrir (database, rss, etc ... )
     * @var array
     */
    private array $sources = [];

    /**
     *  Tableau d'objets articles retournés
     * @var array
     */
    private array $articles = [];

    public function __construct()
    {
    }

    /**
     * Ajoute une source de données
     * @param ArticleSourceInterface $source
     * @return $this
     */
    public function addSource(ArticleSourceInterface $source): self
    {
        $this->sources[] = $source;

        return $this;
    }

    /**
     * Retourner les articles en fonction des sources de données
     * @return $this
     */
    public function retrieveArticles(): array
    {

        foreach ($this->sources as $source) {
            $this->articles = array_merge($this->articles, $source->retrieve());
        }

        return $this->articles;
    }
}

?>