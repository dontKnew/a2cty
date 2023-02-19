<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FaqsModel;


class FaqsController extends BaseController
{
    public function index()
    {
        $result_number  = 15;
        if($this->request->getPostGet()){
            $result_number = $this->request->getVar("result_number");
        }
        $faqsModel = new FaqsModel();
        $faqs = $faqsModel->orderBy("id","desc")->paginate($result_number);

        $data = array(
            "faqs"=>"active",
            "data"=>$faqs,
            'pager' =>$faqsModel->pager,
            'faqsCount'=>count($faqsModel->findAll())
        );
        return view("admin/faqs/index", $data);
    }

    public function add(){
        if($this->request->getPostGet()){
            $session = session();
            try {

                $data = $this->request->getVar();
                $faqs = new FaqsModel();
                $faqs->save($data);

                $session->setFlashdata("msg","Faqs add successfully");
                return redirect()->route("admin/faqs");
            }catch (\Exception $e){
                $session->setFlashdata("err","Error : ".$e->getMessage());
                return redirect()->back();
            }
            return redirect()->route("admin/faqs");
        }
        return view("admin/faqs/add");
    }

    public function update($id){
            $session = session();
            $faqs = new FaqsModel();
            $faqsData= $faqs->find($id);
            if($this->request->getPostGet()){
                try {

                    $data = $this->request->getVar();
                    $faqs = new FaqsModel();

                    $faqs->save($data);
                    $session->setFlashdata("msg","Faqs updated successfully");
                    return redirect()->route("admin/faqs");
                }catch (\Exception $e){
                    $session->setFlashdata("err","Error : ".$e->getMessage());
                    return redirect()->back();
                }
                return redirect()->route("admin/faqs");
            }else {
                $data = array(
                    "faqs"=>"active",
                    "data"=>$faqsData,
                    "faqsCount"=>count($faqs->findAll())
                );

                return view("admin/faqs/edit", $data);
            }
    }

    public function delete($id){
        $session = session();
        try {
            $faqs = new FaqsModel();
            $faqs->delete($id);
            $session->setFlashdata("err","Faqs has been Deleted");
            return redirect()->route("admin/faqs");
        }catch(\Exception $e){
            $session->setFlashdata("err","Error : ".$e->getMessage());
            return redirect()->route("admin/faqs");
        }
    }


}
