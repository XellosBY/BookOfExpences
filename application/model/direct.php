<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 20.03.17
 * Time: 17:03
 */

class Direct extends Model
{
    const PRIHOD = 1;
    const RASHOD = 2;

    public $id;
    public $name;
    public static $dbconnect;
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        parent::__construct($db);
        self::$dbconnect = $db;
    }

    /**
     * Get all rows from database
     */
    public function getAllDirects()
    {
        $sql = "SELECT * FROM direct";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public static function getDirectById($id){
        $sql = "SELECT * FROM direct WHERE id = :id LIMIT 1";
        $query = self::$dbconnect->prepare($sql);
        $parameters = [':id' => $id];

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }
}