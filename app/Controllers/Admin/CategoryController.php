<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;


class CategoryController extends BaseController
{
    public function index()
    {
        $result_number  = 10;
        if($this->request->getPostGet()){
            $result_number = $this->request->getVar("result_number");
        }
        $adsModel = new CategoryModel();
        $adsCategory = $adsModel->orderBy("sort_order","asc")->paginate($result_number);

        $data = array(
            "category"=>"active",
            "data"=>$adsCategory,
            'pager' =>$adsModel->pager,
            'categoryCount'=>count($adsModel->findAll())
        );
        
        return view("admin/category/index", $data);
    }

    public function add(){
        if($this->request->getPostGet()){
            $session = session();
            try {
                    $file = $this->request->getFile("thumbnail_image");
                    $name = "category_".$file->getRandomName();
                    $file->move("frontend/images/category/", $name);
                    $data = $this->request->getVar();
                    $data['thumbnail_image'] = $name;
                    $data['url'] = strtolower(url_title($data['name']));

                    $adsCategory = new CategoryModel();
                    $adsCategory->save($data);
                    $session->setFlashdata("msg"," Category add successfully");
                    return redirect()->route("admin/category");
            }catch (\Exception $e){
                $session->setFlashdata("err","Error : ".$e->getMessage());
                return redirect()->back();
            }
            return redirect()->route("admin/category");
        }
        return view("admin/category/add");
    }

    public function update($id){
        if($id!==null){
            $session = session();
            $adsCategory = new CategoryModel();
            $adsCategoryData= $adsCategory->find($id);
            if($this->request->getPostGet()){
                try {
                    if($_FILES["thumbnail_image"]['name']!==''){
                        $file = $this->request->getFile("thumbnail_image");
                        $name = "category_".$file->getRandomName();
                        $file->move("frontend/images/category/", $name);
                        unlink("frontend/images/category/".$adsCategoryData['thumbnail_image']);
                    }else {
                        $name = $adsCategoryData['thumbnail_image'];
                    }
                    
                    $data = $this->request->getVar();
                    $data['thumbnail_image'] = $name;
                    $data['name'] = strtolower(url_title($data['name']));
                    $adsCategory = new CategoryModel();
                    $adsCategory->save($data);
                    $session->setFlashdata("msg"," Category updated successfully");
                    return redirect()->route("admin/category");
                }catch (\Exception $e){
                    $session->setFlashdata("err","Error : ".$e->getMessage());
                    return redirect()->back();
                }
                return redirect()->route("admin/category");
            }else {
                $data = array(
                    "category"=>"active",
                    "data"=>$adsCategoryData,
                    "categoryCount"=>count($adsCategory->findAll())
                );
                return view("admin/category/edit", $data);
            }
        }
    }

    public function delete($id){
        $session = session();
        try {
            $adsCategory = new CategoryModel();
            $adsCategoryData = $adsCategory->find($id);
            $adsCategory->delete($id);
            @unlink("frontend/images/category/".$adsCategoryData['thumbnail_image']);
            $session->setFlashdata("err"," Category has been Deleted");
            return redirect()->route("admin/category");
        }catch(\Exception $e){
            $session->setFlashdata("err","Error : ".$e->getMessage());
            return redirect()->route("admin/category");
        }
    }


}
