<?php

namespace App\Controller;

use App\Model\Ad;
use App\Model\Category;
use Cocur\Slugify\Slugify;
use App\Util\ImagesUploader;
use App\Util\SessionManager;

class AdController extends Controller {

    public function add_view() {
        $this->render('ad.add', [
            'page_title' => 'Accueil',
            'categories' => Category::getCategories()
        ]);
    }

    public function add_treatment() {
        $slugify = new Slugify();
        $ad = new Ad(
            title: strip_tags($_POST['inputTitle']),
            slug: $slugify->slugify(strip_tags($_POST['inputTitle'])),
            content: strip_tags($_POST['textareaContent']),
            price: strip_tags($_POST['inputPrice']),
            pictures: ImagesUploader::reMakeArray($_FILES['inputFiles']),
            author: SessionManager::getConnectedUser()
        );
        $ad->insert();
    }
}