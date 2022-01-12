<?php

namespace Core\Database;

class Database
{
    /**
     * @var string
     */
    private string $host;

    /**
     * @var string
     */
    private string $dbname;

    /**
     * @var string
     */
    private string $dbuser;

    /**
     * @var string
     */
    private string $dbpass;

    /**
     * @var \PDO|null
     */
    protected \PDO|null $pdo = null;

    /**
     * Connecte le projet à la BDD
     */
    public function __construct()
    {
        $this->getConfig();

        $this->pdo = new \PDO("mysql:host=$this->host;dbname=$this->dbname", $this->dbuser, $this->dbpass, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
    }

    /**
     * Récupère les informations pour se connecter à la BDD
     * @return void
     */
    private function getConfig()
    {
        require ROOT . "/Config/dbConfig.php";

        // $this->host = $config["host"];

        foreach ($config as $key => $value) {
            $this->$key = $value;
        }

    }
}