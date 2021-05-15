<?php

namespace App\Util;

use App\Model\User;

abstract class SessionManager
{
    public static function connectUser(string $email, string $password) : bool | User
    {
        if ($user = User::findByEmail(strip_tags($email)))
        {
            if (password_verify(strip_tags($password), $user->getPassword()))
            {
                $_SESSION['user'] = [
                    'email' => $user->getEmail()
                ];

                return $user;
            }
            self::addFlashMessage("Mot de passe incorrect", 'warning');

            return false;
        }
        self::addFlashMessage("Aucun email correspondant trouvé", 'warning');

        return false;
    }

    public static function getConnectedUser() : User | bool
    {
        if (isset($_SESSION['user']))
        {
            return User::findByEmail($_SESSION['user']['email']);
        }
        return false;
    }

    public static function disconnectUser()
    {
        if (isset($_SESSION['user']))
        {
            unset($_SESSION['user']);
        }
    }

    public static function addFlashMessage(string $message, string $type)
    {
        $_SESSION['flashMessages'][] = [
            'type' => $type,
            'message' => $message
        ];
    }

    public static function getAndRemoveAllFlashMessages()
    {
        if (isset($_SESSION['flashMessages']))
        {
            $messages = $_SESSION['flashMessages'];
            unset($_SESSION['flashMessages']);

            return $messages;
        }
    }
}