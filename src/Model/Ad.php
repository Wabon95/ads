<?php

namespace App\Model;

use App\Util\Database;
use App\Model\Category;
use App\Util\ImagesUploader;

class Ad
{
    public function __construct(
        private int | null $id = null,
        private string $title,
        private string $slug,
        private string $content,
        private string $price,
        private array | null $pictures = null,
        private \DateTime | null $created_at = null,
        private \DateTime | null $updated_at = null,

        // Join
        private Category | null $category = null,
        private User $author,
    ) {}

    public function insert()
    {
        $db = Database::dbConnect();
        $sql = "
            INSERT INTO `ad` (title, slug, content, price, author, category)
            VALUES (:title, :slug, :content, :price, :author, :category)
        ";
        $sth = $db->prepare($sql);
        $sth->bindValue(':title', $this->getTitle(), $db::PARAM_STR);
        $sth->bindValue(':slug', $this->getSlug(), $db::PARAM_STR);
        $sth->bindValue(':content', $this->getContent(), $db::PARAM_STR);
        $sth->bindValue(':price',$this->getPrice(), $db::PARAM_INT);
        $sth->bindValue(':author',$this->getAuthor()->getId(), $db::PARAM_INT);
        $sth->bindValue(':category',$this->getCategory()->getId(), $db::PARAM_INT);
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
            // dump(self::findBySlug($this->getSlug())->getId());
            // dump($db->lastInsertId());
            // $sthPictures->bindValue(':ad', self::findBySlug($this->getSlug())->getId(), $db::PARAM_INT);
            $sthPictures->bindValue(':ad', $db->lastInsertId(), $db::PARAM_INT);
            $sthPictures->execute();
            // die;
        }
    }

    public static function findBySlug(string $slug)
    {
        $db = Database::dbConnect();
        $sql = "
            SELECT ad.id AS ad_id, ad.slug AS ad_slug, ad.title AS ad_title, ad.content AS ad_content, ad.price AS ad_price, ad.created_at AS ad_created_at, ad.updated_at AS ad_updated_at,
            user.id AS user_id, user.username AS user_username, user.email AS user_email, user.password AS user_password, user.firstname AS user_firstname,
            user.lastname AS user_lastname, user.street AS user_street, user.postal_code AS user_postal_code, user.city AS user_city, user.created_at AS user_created_at, user.updated_at AS user_updated_at,
            category.id AS category_id, category.name AS category_name
            FROM `ad`
            LEFT JOIN user
            ON ad.author = user.id
            LEFT JOIN category
            ON ad.category = category.id
            WHERE ad.slug = :slug
        ";
        $sth = $db->prepare($sql);
        $sth->bindValue(':slug', $slug, $db::PARAM_STR);
        $sth->execute();
        if ($result = $sth->fetch()) {
            $author = new User(
                id: $result['user_id'],
                username: $result['user_username'],
                email: $result['user_email'],
                password: $result['user_password'],
                firstname: $result['user_firstname'],
                lastname: $result['user_lastname'],
                street: $result['user_street'],
                postal_code: $result['user_postal_code'],
                city: $result['user_city'],
                created_at: \DateTime::createFromFormat('Y-m-d H:i:s', $result['user_created_at']),
                updated_at: (\DateTime::createFromFormat('Y-m-d H:i:s', $result['user_updated_at'])) ? \DateTime::createFromFormat('Y-m-d H:i:s', $result['user_updated_at']) : null
            );
            return new Ad(
                id: $result['ad_id'],
                title: $result['ad_title'],
                slug: $result['ad_slug'],
                content: $result['ad_content'],
                price: $result['ad_price'],
                author: $author,
                category: Category::findByName($result['category_name']),
                created_at: \DateTime::createFromFormat('Y-m-d H:i:s', $result['ad_created_at']),
                updated_at: (\DateTime::createFromFormat('Y-m-d H:i:s', $result['ad_updated_at'])) ? \DateTime::createFromFormat('Y-m-d H:i:s', $result['ad_updated_at']) : null
            );
        }
        return false;
    }

    // SETTERS

    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getPictures()
    {
        if (!$this->pictures) {
            $db = Database::dbConnect();
            $sql = "
                SELECT * FROM `pictures`
                WHERE ad = :id
            ";
            $sth = $db->prepare($sql);
            $sth->bindValue(':id', $this->getId(), $db::PARAM_INT);
            $sth->execute();
            $this->pictures = $sth->fetchAll();

            return $this->pictures;
        }
        return $this->pictures;
    }

    public function getCategory() : Category
    {
        return $this->category;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getFormatedDate()
    {
        return $this->created_at->format('d-m-Y à H:i');
    }
    
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}