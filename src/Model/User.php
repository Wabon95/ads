<?php

namespace App\Model;

use App\Util\Database;

class User {

    public function __construct(
        private int | null $id = null,
        private string $username,
        private string $email,
        private string $password,
        private string | null $firstname = null,
        private string | null $lastname = null,
        private string | null $street = null,
        private string | null $postal_code = null,
        private string | null $city = null,
        private \DateTime | null $created_at = null,
        private \DateTime | null $updated_at = null
    ) {}

    public function insert() : bool {
        if (!self::findByEmail($this->getEmail())) {
            $db = Database::dbConnect();
            $sql = "
                INSERT INTO `user` (username, email, password)
                VALUES (:username, :email, :password)
            ";
            $sth = $db->prepare($sql);
            $sth->bindValue(':username', $this->getUsername(), $db::PARAM_STR);
            $sth->bindValue(':email', $this->getEmail(), $db::PARAM_STR);
            $sth->bindValue(':password', password_hash($this->getPassword(), PASSWORD_BCRYPT), $db::PARAM_STR);
            $sth->execute();
            SessionManager::addFlashMessage('Votre compte a correctement été créé, vous pouvez dès à présent vous connectez avec celui-ci.', 'success');
            return true;
        }
        SessionManager::addFlashMessage('Cette addresse email est déjà utilisée.', 'warning');
        return false;
    }
    
    public static function find(int $id) : self | bool {
        $db = Database::dbConnect();
        $sql = "
            SELECT *
            FROM `user`
            WHERE user.id = :id
        ";
        $sth = $db->prepare($sql);
        $sth->bindValue(':id', $id, $db::PARAM_INT);
        $sth->execute();
        if ($result = $sth->fetch()) {
            return new User(
                id: $result['id'],
                username: $result['username'],
                email: $result['email'],
                password: $result['password'],
                firstname: $result['firstname'],
                lastname: $result['lastname'],
                street: $result['street'],
                postal_code: $result['postal_code'],
                city: $result['city'],
                created_at: \DateTime::createFromFormat('Y-m-d H:i:s', $result['created_at']),
                updated_at: (\DateTime::createFromFormat('Y-m-d H:i:s', $result['updated_at'])) ? \DateTime::createFromFormat('Y-m-d H:i:s', $result['updated_at']) : null
            );
        }
        return false;
    }

    public static function findByEmail(string $email) : self | bool {
        $db = Database::dbConnect();
        $sql = "
            SELECT *
            FROM `user`
            WHERE user.email = :email
        ";
        $sth = $db->prepare($sql);
        $sth->bindValue(':email', $email, $db::PARAM_STR);
        $sth->execute();
        if ($result = $sth->fetch()) {
            return new User(
                id: $result['id'],
                username: $result['username'],
                email: $result['email'],
                password: $result['password'],
                firstname: $result['firstname'],
                lastname: $result['lastname'],
                street: $result['street'],
                postal_code: $result['postal_code'],
                city: $result['city'],
                created_at: \DateTime::createFromFormat('Y-m-d H:i:s', $result['created_at']),
                updated_at: (\DateTime::createFromFormat('Y-m-d H:i:s', $result['updated_at'])) ? \DateTime::createFromFormat('Y-m-d H:i:s', $result['updated_at']) : null
            );
        }
        return false;
    }

    public function update() {
        $db = Database::dbConnect();
        $sql = "
            UPDATE `user`
            SET password = :password, username =:username, firstname = :firstname, lastname = :lastname, postal_code = :postal_code, city = :city, street = :street, updated_at = :updated_at
            WHERE id = :id
        ";
        $sth = $db->prepare($sql);
        $sth->bindValue(':id', $this->getId(), $db::PARAM_INT);
        $sth->bindValue(':password', password_hash($this->getPassword(), PASSWORD_BCRYPT), $db::PARAM_STR);
        $sth->bindValue(':username', $this->getUsername(), $db::PARAM_STR);
        $sth->bindValue(':firstname', $this->getFirstname(), $db::PARAM_STR);
        $sth->bindValue(':lastname', $this->getLastname(), $db::PARAM_STR);
        $sth->bindValue(':postal_code', $this->getPostalCode(), $db::PARAM_STR);
        $sth->bindValue(':city', $this->getCity(), $db::PARAM_STR);
        $sth->bindValue(':street', $this->getStreet(), $db::PARAM_STR);
        $sth->bindValue(':updated_at', (new \DateTime())->format('d-m-Y'), $db::PARAM_STR);
        $sth->execute();
    }


    // SETTERS
    public function setUsername(string $username) : self {
        $this->username = strip_tags($username);
        return $this;
    }
    public function setEmail(string $email) : self {
        $this->email = strip_tags($email);
        return $this;
    }
    public function setPassword(string $password) : self {
        $this->password = strip_tags($password);
        return $this;
    }
    public function setFirstname(string $firstname) : self {
        $this->firstname = strip_tags($firstname);
        return $this;
    }
    public function setLastname(string $lastname) : self {
        $this->lastname = strip_tags($lastname);
        return $this;
    }
    public function setStreet(string $street) : self {
        $this->street = strip_tags($street);
        return $this;
    }
    public function setPostalCode(string $postal_code) : self {
        $this->postal_code = strip_tags($postal_code);
        return $this;
    }
    public function setCity(string $city) : self {
        $this->city = strip_tags($city);
        return $this;
    }
    public function setUpdatedAt(\DateTime $date) {
        $this->updated_at = $date;
    }

    // GETTERS
    public function getId() : int {
        return $this->id;
    }
    public function getUsername() : string {
        return $this->username;
    }
    public function getEmail() : string {
        return $this->email;
    }
    public function getPassword() : string {
        return $this->password;
    }
    public function getFirstname() : string | null {
        return $this->firstname;
    }
    public function getLastname() : string | null {
        return $this->lastname;
    }
    public function getStreet() : string | null {
        return $this->street;
    }
    public function getPostalCode() : string | null {
        return $this->postal_code;
    }
    public function getCity() : string | null {
        return $this->city;
    }
    public function getCreatedAt() {
        return $this->created_at;
    }
    public function getUpdatedAt() {
        return $this->updated_at;
    }
}