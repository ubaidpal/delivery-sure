<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 16-Jun-16 3:30 PM
 * File Name    : GlobalComposer.php
 */

namespace App\Composers;

use App\Category;

class GlobalComposer
{
    public function compose($view) {
        $view->with('categories', $this->getCategories());
    }

    private function getCategories($page = 5) {
        $data[ 'pageNumber' ] = $page + 5;

        if($page == 5) {
            $data[ "pageNumber" ] = 5;
        }

        return Category::orderBy('name', 'DESC')->select('id', 'name', 'class')->paginate($data[ "pageNumber" ]);
    }
}
