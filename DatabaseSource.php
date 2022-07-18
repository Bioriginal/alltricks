<?php

require_once 'ArticleSourceInterface.php';
require_once 'Article.php';

class DatabaseSource implements ArticleSourceInterface
{
    /**
     * On choisi mysqli par soucis de temps mais on pourrait vouloir utiliser
     * d'autres dbs, dans ce cas il faudrait une autre abstraction pour la bdd
     * @var Mysqli
     */
    private Mysqli $connection;

    /**
     * @var array
     */
    private array $articles = [];

    public function __construct(
        private string $host,
        private string $user,
        private string $pass,
        private string $database
    ) {
    }

    /**
     * connection à la bdd
     * @return void
     */
    public function connect()
    {
        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->database, 3306);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    /**
     * Fermeture de la connection
     * @return void
     */
    public function close()
    {
        $this->connection->close();
    }

    /**
     * Retourne un tableau d'Articles
     * @return array
     */
    public function retrieve(): array
    {
        try {
            $this->connect();
            $result = $this->connection->query("SELECT
            a.name as name,s.name as source , a.content as description
            FROM article a 
            INNER JOIN source s on a.source_id = s.id");

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_row()) {
                    $this->articles[] = new Article($row[0], $row[1], $row[2]);
                }

            }

            $this->close();

        } catch (Exception $e) {
            //@TODO exception à gérer
        }
        return $this->articles;

    }
}