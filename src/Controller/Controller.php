<?php

namespace App\Controller;

use App\Model\User;
use App\Util\SessionManager;

class Controller {

    protected User | bool $connectedUser;

    public function __construct() {
        $this->connectedUser = SessionManager::getConnectedUser();
    }

    protected function render(string $view, ?array $data) {
        $view = str_replace('.', '/', $view);
        extract($data);
        $flashMessages = SessionManager::getAndRemoveAllFlashMessages();
        $user = $this->connectedUser;
        require_once __DIR__ . VIEWS_FOLDER . 'header.php';
        require_once __DIR__ . VIEWS_FOLDER . $view . '.php';
        require_once __DIR__ . VIEWS_FOLDER . 'footer.php';
    }

    protected function redirect(string $url) {
        header("Location: $url");
    }
}