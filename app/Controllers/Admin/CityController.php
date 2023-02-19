<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CityModel;
use App\Models\StateModel;


class CityController extends BaseController
{
    public function index()
    {
        $result_number  = 15;
        if($this->request->getPostGet()){
            $result_number = $this->request->getVar("result_number");
        }
        
        $cityModel = new CityModel();
        $city = $cityModel->orderBy("name","asc")->paginate($result_number);
        
        $state = (new StateModel)->findAll();
        $data = array(
            "city"=>"active",
            "data"=>$city,
            "state1"=>$state,
            'pager' =>$cityModel->pager,
            'cityCount'=>count($cityModel->findAll())
        );
        return view("admin/city/index", $data);
    }

    public function add(){
        if($this->request->getPostGet()){
            $session = session();
            try {

                $data = $this->request->getVar();
                $city = explode(",",$data['name']);
                
                for($i=0; $i < count($city) ; $i++){
                    
                    $data['name'] = strtolower(trim($city[$i]));
                    $data['url'] = strtolower(url_title(trim($city[$i])));
                    (new CityModel)->save($data);
                }
                $session->setFlashdata("msg","City add successfully");
                return redirect()->route("admin/city");
            }catch (\Exception $e){
                $session->setFlashdata("err","Error : ".$e->getMessage());
                return redirect()->back();
            }
            
            return redirect()->route("admin/city");
        }
        $data['stateData'] = (new StateModel)->findAll();
        
        return view("admin/city/add", $data);
    }

    public function update($id){
        if($id!==null){
            $session = session();
            $city = new CityModel();
            $cityData= $city->find($id);
            if($this->request->getPostGet()){
                try {

                    $data = $this->request->getVar();
                    $data['name'] = strtolower(trim($data['name']));
                    $data['url'] = strtolower(url_title(trim($data['name'])));
                    $city = new CityModel();
                    $city->save($data);
                    $session->setFlashdata("msg","City updated successfully");
                    return redirect()->route("admin/city");
                }catch (\Exception $e){
                    $session->setFlashdata("err","Error : ".$e->getMessage());
                    return redirect()->back();
                }
                return redirect()->route("admin/city");
            }else {
                $stateData = (new StateModel)->findAll();
                $data = array(
                    "city"=>"active",
                    "data"=>$cityData,
                    "cityCount"=>count($city->findAll()),
                    "stateData"=>$stateData
                );
                return view("admin/city/edit", $data);
            }
        }
    }

    public function delete($id){
        $session = session();
        try {
            $city = new CityModel();
            $city->delete($id);
            $session->setFlashdata("err","City has been Deleted");
            return redirect()->route("admin/city");
        }catch(\Exception $e){
            $session->setFlashdata("err","Error : ".$e->getMessage());
            return redirect()->route("admin/city");
        }
    }


}
