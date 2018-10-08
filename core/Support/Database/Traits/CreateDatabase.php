<?php

namespace Pluma\Support\Database\Traits;

use PDO;

trait CreateDatabase
{
    /**
     * The database name.
     *
     * @var string
     */
    protected $database;

    /**
     * The PDO instance.
     *
     * @var \PDO
     */
    protected $db;

    /**
     * Setup the database.
     *
     * @param  string $database
     * @param  string $username
     * @param  string $password
     * @return $this
     */
    public function db($database, $username, $password)
    {
        $this->database = $database;

        $connection = config('DB_CONNECTION', env('DB_CONNECTION'));
        $host = config('DB_HOST', env('DB_HOST'));
        $this->db = new PDO("{$connection}:host={$host}", $username, $password);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $this;
    }

    /**
     * Drops the database.
     *
     * @param  string $database
     * @return $this
     */
    public function drop($database = null)
    {
        $database = is_null($database) ? $this->database : $database;
        $dbname = "`".str_replace("`", "``", $database)."`";
        $this->db->query("DROP DATABASE IF EXISTS $dbname");

        return $this;
    }

    /**
     * Create a database.
     *
     * @param  string $database
     * @return $this
     */
    public function make($database = null)
    {
        $database = is_null($database) ? $this->database : $database;
        $database = "`".str_replace("`", "``", $database)."`";
        $this->db->query("CREATE DATABASE IF NOT EXISTS $database");
        $this->db->query("USE $database");

        return $this;
    }
}
