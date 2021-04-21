<?php

namespace App\Model;

use App\Util\Database;
use App\Util\ImagesUploader;

class Ad {

    public function __construct(
        private int | null $id = null,
        private string $title,
        private string $slug,
        private string $content,
        private string $price,
        private array | null $pictures = null,
        private User $author,
        private \DateTime | null $created_at = null,
        private \DateTime | null $updated_at = null
    ) {}

    public function insert() {
        $db = Database::dbConnect();
        $sql = "
            INSERT INTO `ad` (title, slug, content, price, author)
            VALUES (:title, :slug, :content, :price, :author)
        ";
        $sth = $db->prepare($sql);
        $sth->bindValue(':title', $this->getTitle(), $db::PARAM_STR);
        $sth->bindValue(':slug', $this->getSlug(), $db::PARAM_STR);
        $sth->bindValue(':content', $this->getContent(), $db::PARAM_STR);
        $sth->bindValue(':price',$this->getPrice(), $db::PARAM_INT);
        $sth->bindValue(':author',$this->getAuthor()->getId(), $db::PARAM_INT);
        if ($sth->execute()) {
            ImagesUploader::upload($this->getPictures());
        }

        foreach ($this->getPictures() as $picture) {
            $sqlPictures = "
                INSERT INTO `pictures` (url, ad)
                VALUES (:url, :ad)
            ";
            $sthPictures = $db->prepare($sqlPictures);
            $sthPictures->bindValue(':url', $_SERVER['DOCUMENT_ROOT'] . '/img/' . basename($picture['name']), $db::PARAM_STR);
            $sthPictures->bindValue(':ad', self::findBySlug($this->getSlug())->getId(), $db::PARAM_INT);
            $sthPictures->execute();
        }
    }

    public static function findBySlug(string $slug) {
        $db = Database::dbConnect();
        $sql = "
            SELECT *
            FROM `ad`
            WHERE ad.slug = :slug
        ";
        $sth = $db->prepare($sql);
        $sth->bindValue(':slug', $slug, $db::PARAM_STR);
        $sth->execute();
        if ($result = $sth->fetch()) {
            return new Ad(
                id: $result['id'],
                title: $result['title'],
                slug: $result['slug'],
                content: $result['content'],
                price: $result['price'],
                author: User::find($result['author']),
                created_at: \DateTime::createFromFormat('Y-m-d H:i:s', $result['created_at']),
                updated_at: (\DateTime::createFromFormat('Y-m-d H:i:s', $result['updated_at'])) ? \DateTime::createFromFormat('Y-m-d H:i:s', $result['updated_at']) : null
            );
        }
        return false;
    }

    // SETTERS

    // GETTERS
    public function getId() {
        return $this->id;
    }
    public function getTitle() {
        return $this->title;
    }
    public function getSlug() {
        return $this->slug;
    }
    public function getContent() {
        return $this->content;
    }
    public function getPrice() {
        return $this->price;
    }
    public function getPictures() {
        return $this->pictures;
    }
    public function getAuthor() {
        return $this->author;
    }
    public function getCreatedAt() {
        return $this->created_at;
    }
    public function getUpdatedAt() {
        return $this->updated_at;
    }

}