<?php
require_once 'ArticleSourceInterface.php';
require_once 'Article.php';

class RssSource implements ArticleSourceInterface
{

    private SimpleXMLElement $rss;
    private array $articles = [];

    /**
     * @param string $name
     * @param string $url
     */
    public function __construct(private string $name, private string $url)
    {
    }

    /**
     * @return array
     */
    public function retrieve(): array
    {

        try {
            $this->rss = simplexml_load_file($this->url, 'SimpleXMLElement', LIBXML_NOCDATA);
            $this->parseRss();
            return $this->articles;
        } catch (Exception $e) {
            //@TODO exception à gérer
        }

    }

    /**
     * @throws Exception
     */
    public function parseRss()
    {

        switch ($this->name) {
            case 'Le Monde':
                return $this->parseLeMonde();

            default;
                throw new Exception($this->name . " non supporté ");
        }

    }

    /**
     *  Parse le rss de type Le Monde
     *  et rempli le tableau d'articles
     *
     * @return void
     */
    private function parseLeMonde()
    {
        $channel = $this->rss->channel ?? false;

        if ($channel) {

            $items = $channel->item ?? [];

            foreach ($items as $item) {
                $this->articles[] = new Article($item->title, $this->name, $item->description);
            }
        }

    }
}
