<?php

namespace App\Util;

abstract class ImagesUploader {

    public static function reMakeArray(array $images) {
        $file_array = array();
        $file_count = count($images['name']);
        $file_keys = array_keys($images);
        for ($i=0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_array[$i][$key] = $images[$key][$i];
            }
        }
        return $file_array;
    }

    private static function sizeChecker(array $images) : bool {
        foreach ($images as $img) {
            if ($img['size'] > 5000000) {
                SessionManager::addFlashMessage('La taille des images ne doit pas dépasser 5Mo.', 'warning');

                return false;
            }
        }
        return true;
    }

    private static function extensionChecker(array $images) : bool {
        foreach($images as $img) {
            $allowedExtensions = ['jpg', 'png'];
            $fileExtension = strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));
            if (!in_array($fileExtension, $allowedExtensions)) {
                SessionManager::addFlashMessage('Le format des fichiers envoyé doit être .jpg ou .png', 'warning');

                return false;
            }
        }
        return true;
    }

    public static function upload(array $images) : bool {
        if (self::sizeChecker($images) && self::extensionChecker($images)) {
            foreach($images as $img) {
                move_uploaded_file($img["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . IMG_FOLDER . basename($img["name"]));
            }
            return true;
        }
        return false;
    }

}