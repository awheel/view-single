<?php

namespace App\Controller;

use awheel\Routing\Controller;

/**
 * Class HomeController
 *
 * @package App\Controller
 */
class HomeController extends Controller
{
    /**
     * Home
     *
     * @return mixed
     */
    public function home()
    {
        return app('view.single')->render('admin', 'index.html', ['title' => 'Home']);
    }

    /**
     * Share
     *
     * @return mixed
     */
    public function share()
    {
        return app('view.single')->render('share', 'index.html', ['title' => 'Share']);
    }
}
