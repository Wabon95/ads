<?php

namespace App\Controller;

use App\Model\Ad;
use App\Model\Category;
use Cocur\Slugify\Slugify;
use App\Util\ImagesUploader;
use App\Util\SessionManager;

class AdController extends Controller
{
    public function addView()
    {
        $this->render('ad.add', [
            'page_title' => 'Accueil',
            'categories' => Category::getCategories()
        ]);
    }

    public function addTreatment()
    {
        $slugify = new Slugify();
        $ad = new Ad(
            title: strip_tags($_POST['inputTitle']),
            slug: $slugify->slugify(strip_tags($_POST['inputTitle'])),
            content: strip_tags($_POST['textareaContent']),
            price: strip_tags($_POST['inputPrice']),
            pictures: ImagesUploader::reMakeArray($_FILES['inputFiles']),
            author: $this->connectedUser
        );
        $ad->insert();
        $this->redirect('/annonce/' . $ad->getSlug());
    }

    public function viewOne($slug)
    {
        $ad = (Ad::findBySlug($slug)) ? Ad::findBySlug($slug) : false;
        if ($ad)
        {
            $this->render('ad.view', [
                'page_title' => $ad->getSlug(),
                'ad' => $ad
            ]);
        }
    }
}