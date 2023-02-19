<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BlogModel;
use App\Models\CategoryModel;
use App\Models\StateModel;
use App\Models\CityModel;



class BlogController extends BaseController
{
    public function index()
    {
        $result_number  = 10;
        if($this->request->getPostGet()){
            $result_number = $this->request->getVar("result_number");
        }
        $adsModel = new BlogModel();
        $adsCategory = $adsModel->orderBy("id","asc")
            ->paginate($result_number);


        $data = array(
            "blog"=>"active",
            "data"=>$adsCategory,
            'pager' =>$adsModel->pager,
            'blogCount'=>count($adsModel->findAll())
        );
        
        return view("admin/blog/index", $data);
    }

    public function add(){
        if($this->request->getPostGet()){
            $session = session();
            try {

                $file = $this->request->getFile("thumbnail_image");
                $name = "blog_".$file->getRandomName();
                $file->move("frontend/images/blog/", $name);
                $data = $this->request->getVar();
                $data['thumbnail_image'] = $name;
                $data['url'] = strtolower(url_title($data['blog_title']));
                $data['category_url'] = strtolower(url_title($data['category']));

                $adsCategory = new BlogModel();

                $adsCategory->save($data);
                $session->setFlashdata("msg"," Blog add successfully");
                return redirect()->route("admin/blog");
            }catch (\Exception $e){
                $session->setFlashdata("err","Error : ".$e->getMessage());
                return redirect()->back();
            }
            return redirect()->route("admin/blog");
        }
        $data['category_list'] = (new CategoryModel)->orderBy("name", "asc")->findAll();
        $data['city_list'] = (new CityModel)->orderBy("name", "asc")->findAll();
        return view("admin/blog/add", $data);
    }

    public function update($id){
        if($id!==null){
            $session = session();
            $adsCategory = new BlogModel();
            $adsCategoryData= $adsCategory->find($id);
            if($this->request->getPostGet()){
                try {

                    if($_FILES["thumbnail_image"]['name']!==''){
                        $file = $this->request->getFile("thumbnail_image");
                        $name = "blog_".$file->getRandomName();
                        $file->move("frontend/images/blog/", $name);
                        unlink("frontend/images/blog/".$adsCategoryData['thumbnail_image']);
                    }else {
                        $name = $adsCategoryData['thumbnail_image'];
                    }

                    $data = $this->request->getVar();
                    $data['thumbnail_image'] = $name;
                    $data['url'] = strtolower(url_title($data['blog_title']));
                    $data['category_url'] = strtolower(url_title($data['category']));
                    $adsCategory = new BlogModel();
                    $adsCategory->save($data);
                    $session->setFlashdata("msg"," Blog updated successfully");
                    return redirect()->route("admin/blog");
                }catch (\Exception $e){
                    $session->setFlashdata("err","Error : ".$e->getMessage());
                    return redirect()->back();
                }
                return redirect()->route("admin/blog");
            }else {
                $data = array(
                    "blog"=>"active",
                    "data"=>$adsCategoryData,
                    "blogCount"=>count($adsCategory->findAll())
                );
                return view("admin/blog/edit", $data);
            }
        }
    }

    public function delete($id){
        $session = session();
        try {
            $adsCategory = new BlogModel();
            $adsCategoryData = $adsCategory->find($id);
            $adsCategory->delete($id);
            @unlink("frontend/images/blog/".$adsCategoryData['thumbnail_image']);
            $session->setFlashdata("err"," Blog has been Deleted");
            return redirect()->route("admin/blog");
        }catch(\Exception $e){
            $session->setFlashdata("err","Error : ".$e->getMessage());
            return redirect()->route("admin/blog");
        }
    }


}
