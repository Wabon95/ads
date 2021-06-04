<?php

namespace App\Model;

use App\Util\Database;

class Category
{
    public function __construct(
        private int | null $id = null,
        private string $name
    ) {}

    public static function getCategories() : array | false
    {
        $db = Database::dbConnect();
        $sql = "
            SELECT *
            FROM `category`
        ";
        $sth = $db->prepare($sql);
        $sth->execute();
        $categories = [];
        if ($result = $sth->fetchAll()) {
            foreach($result as $category) {
                $categories[] = new Category(
                    id: $category['id'],
                    name: $category['name'],
                );
            }
            return $categories;
        }
        return false;
    }

    public static function findByName(string $name) : self | bool
    {
        $db = Database::dbConnect();
        $sql = "
            SELECT *
            FROM `category`
            WHERE name = :name
        ";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, $db::PARAM_STR);
        $stmt->execute();
        if ($result = $stmt->fetch()) {
            return new Category(
                id: $result['id'],
                name: $result['name']
            );
        }
        return false;
    }

    public function getName() : string
    {
        return $this->name;
    }
    
    public function getId() : int
    {
        return $this->id;
    }
}