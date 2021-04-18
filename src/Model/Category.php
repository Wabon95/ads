<?php

namespace App\Model;

use App\Util\Database;

class Category {

    public function __construct(
        private int | null $id = null,
        private string $name
    ) {}

    public static function getCategories() : array | false {
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

    public function getName() : string {
        return $this->name;
    }
}