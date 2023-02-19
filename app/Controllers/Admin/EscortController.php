<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EscortModel;
use App\Models\CategoryModel;
use App\Models\StateModel;
use App\Models\CityModel;



class EscortController extends BaseController
{
    public function index()
    {
        $result_number  = 10;
        if($this->request->getPostGet()){
            $result_number = $this->request->getVar("result_number");
        }
        $adsModel = new EscortModel();
        $adsCategory = $adsModel->orderBy("id","asc")
            ->join("cities", "cities.id=escort.city")
            ->join("category", "category.id=escort.category")
            ->select("escort.*, cities.name as city, category.name as category")
            ->paginate($result_number);


        $data = array(
            "escort"=>"active",
            "data"=>$adsCategory,
            'pager' =>$adsModel->pager,
            'escortCount'=>count($adsModel->findAll())
        );
        
        return view("admin/escort/index", $data);
    }

    public function add(){
        if($this->request->getPostGet()){
            $session = session();
            try {
                    $file = $this->request->getFile("thumbnail_image");
                    $name = "escort_".$file->getRandomName();
                    $file->move("frontend/images/escort/", $name);
                    $data = $this->request->getVar();
                    $data['thumbnail_image'] = $name;
                    $data['url'] = strtolower(url_title($data['escort_title']));

                    $adsCategory = new EscortModel();
                    $adsCategory->save($data);
                    $session->setFlashdata("msg"," Escort add successfully");
                    return redirect()->route("admin/escort");
            }catch (\Exception $e){
                $session->setFlashdata("err","Error : ".$e->getMessage());
                return redirect()->back();
            }
            return redirect()->route("admin/escort");
        }
        $data['category_list'] = (new CategoryModel)->orderBy("name", "asc")->findAll();
        $data['city_list'] = (new CityModel)->orderBy("name", "asc")->findAll();
        return view("admin/escort/add", $data);
    }

    public function update($id){
        if($id!==null){
            $session = session();
            $adsCategory = new EscortModel();
            $adsCategoryData= $adsCategory->find($id);
            if($this->request->getPostGet()){
                try {
                    if($_FILES["thumbnail_image"]['name']!==''){
                        $file = $this->request->getFile("thumbnail_image");
                        $name = "escort_".$file->getRandomName();
                        $file->move("frontend/images/escort/", $name);
                        @unlink("frontend/images/escort/".$adsCategoryData['thumbnail_image']);
                    }else {
                        $name = $adsCategoryData['thumbnail_image'];
                    }

                    $data = $this->request->getVar();
                    $data['thumbnail_image'] = $name;
                    $data['url'] = strtolower(url_title($data['escort_title']));
                    $adsCategory = new EscortModel();
                    $adsCategory->save($data);
                    $session->setFlashdata("msg"," Escort updated successfully");
                    return redirect()->route("admin/escort");
                }catch (\Exception $e){
                    $session->setFlashdata("err","Error : ".$e->getMessage());
                    return redirect()->back();
                }
                return redirect()->route("admin/escort");
            }else {
                $category_list = (new CategoryModel)->orderBy("name", "asc")->findAll();
                $city_list = (new CityModel)->orderBy("name", "asc")->findAll();
                $data = array(
                    "escort"=>"active",
                    "data"=>$adsCategoryData,
                    "escortCount"=>count($adsCategory->findAll()),
                    "category_list"=>$category_list,
                    "city_list"=>$city_list
                );
                return view("admin/escort/edit", $data);
            }
        }
    }

    public function delete($id){
        $session = session();
        try {
            $adsCategory = new EscortModel();
            $adsCategoryData = $adsCategory->find($id);
            $adsCategory->delete($id);
            @unlink("frontend/images/escort/".$adsCategoryData['thumbnail_image']);
            $session->setFlashdata("err"," Escort has been Deleted");
            return redirect()->route("admin/escort");
        }catch(\Exception $e){
            $session->setFlashdata("err","Error : ".$e->getMessage());
            return redirect()->route("admin/escort");
        }
    }


}
