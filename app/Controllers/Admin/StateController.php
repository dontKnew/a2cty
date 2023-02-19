<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\StateModel;


class StateController extends BaseController
{
    public function index()
    {
        $result_number  = 15;
        if($this->request->getPostGet()){
            $result_number = $this->request->getVar("result_number");
        }
        $stateModel = new StateModel();
        $state = $stateModel->orderBy("name","asc")->paginate($result_number);

        $data = array(
            "state"=>"active",
            "data"=>$state,
            'pager' =>$stateModel->pager,
            'stateCount'=>count($stateModel->findAll())
        );
        return view("admin/state/index", $data);
    }

    public function add(){
        if($this->request->getPostGet()){
            $session = session();
            try {

                $data = $this->request->getVar();
                $data['name'] = strtolower($data['name']);
                $state = new StateModel();
                $state->save($data);

                $session->setFlashdata("msg","State add successfully");
                return redirect()->route("admin/state");
            }catch (\Exception $e){
                $session->setFlashdata("err","Error : ".$e->getMessage());
                return redirect()->back();
            }
            return redirect()->route("admin/state");
        }
        return view("admin/state/add");
    }

    public function update($id){
            $session = session();
            $state = new StateModel();
            $stateData= $state->find($id);
            if($this->request->getPostGet()){
                try {

                    $data = $this->request->getVar();
                    $data['name'] = strtolower(trim($data["name"]));
                    $data['id'] = $id;
                    $state = new StateModel();
                    $state->save($data);
                    $session->setFlashdata("msg","State updated successfully");
                    return redirect()->route("admin/state");
                }catch (\Exception $e){
                    $session->setFlashdata("err","Error : ".$e->getMessage());
                    return redirect()->back();
                }
                return redirect()->route("admin/state");
            }else {
                $data = array(
                    "state"=>"active",
                    "data"=>$stateData,
                    "stateCount"=>count($state->findAll())
                );
                return view("admin/state/edit", $data);
            }
    }

    public function delete($id){
        $session = session();
        try {
            $state = new StateModel();
            $state->delete($id);
            $session->setFlashdata("err","State has been Deleted");
            return redirect()->route("admin/state");
        }catch(\Exception $e){
            $session->setFlashdata("err","Error : ".$e->getMessage());
            return redirect()->route("admin/state");
        }
    }


}
