<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 20.03.17
 * Time: 17:03
 */

class Category extends Model
{
    public $id;
    public $name;
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        parent::__construct($db);
    }

    /**
     * Get all rows from database
     */
    public function getAllCategories()
    {
        $sql = "SELECT * FROM category";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function addCategory($values){
        $sql = "INSERT INTO category (name) VALUES (:name)";
        $query = $this->db->prepare($sql);
        $parameters = [':name' => $values['name']];
        if($query->execute($parameters)){
            return true;
        }else{
            return false;
        }
    }

    public function deleteCategory($id){
        $sql = "DELETE FROM category WHERE id = :id";
        return $this->deleteRow($id, $sql);
    }

    public function updateValueById($pk, $name, $value){
        $sql = "UPDATE category SET ".$name." = :value WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = [':id' => $pk, ':value' => $value];
        if($query->execute($parameters)){
            return $value;
        }
    }
}