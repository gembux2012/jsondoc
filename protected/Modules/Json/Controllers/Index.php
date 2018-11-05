<?php
/**
 * Created by PhpStorm.
 * User: alexc
 * Date: 16.10.18
 * Time: 11:23
 */

namespace App\Modules\Json\Controllers;

use App\Modules\Json\Models\Json;
use T4\Mvc\Controller;
use T4\Fs\Helpers;

class Index
    extends Controller
{
        const PAGE_SIZE = 20;

        public function actionDefault($page = 1)
        {
           /* $this->data->itemsCount = Story::countAll();
            $this->data->pageSize = self::PAGE_SIZE;
            $this->data->activePage = $page;

            $this->data->items = Story::findAll([
                'order' => 'published DESC',
                'offset'=> ($page-1)*self::PAGE_SIZE,
                'limit'=> self::PAGE_SIZE
            ]);
           */
            $file = file_get_contents(Helpers::getRealPath('/jsondoc/document-list-response.json'));
            $taskList=json_decode($file,TRUE);
            $file['propertis']['pagination']['propertis']['page']['type']=1;
            $file['propertis']['pagination']['propertis']['perPage']['type']=1;
            $file['propertis']['pagination']['propertis']['total']['type']=10;
            $this->data->items=$file;
            var_dump($file);

        }


    public function actionNew(){
       $this->data->JsonDoc=Json::getContent('new');  }

    public function actionSave(){
        $data=$this->app->request->post->data;
        $this->data=$data;
        //Json::SaveFile($data);

    }
}