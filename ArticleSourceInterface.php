<?php

interface ArticleSourceInterface {
    /**
     * Retourne un tableau d'articles
     * @return array
     */
    public function retrieve():array;
}