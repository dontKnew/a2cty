<?php

namespace App\Controllers;


use App\Models\BlogModel;
use App\Models\CategoryModel;
use App\Models\CityModel;
use App\Models\EscortModel;
use App\Models\FaqsModel;

class HomeController extends BaseController
{

    public function __construct(){
        $this->data['city_list'] = (new CityModel)->orderBy("sort_order", "asc")->findAll();
        $this->data['faqs_list'] = (new FaqsModel)->orderBy("sort_order", "asc")->findAll();
    }
    public function index()
    {

        if($this->request->getVar("filter")){
            $filter = $this->request->getVar("filter");
            $this->data['services'] = (new EscortModel)
                ->like("escort.escort_title", $filter)
                ->orLike("cities.name", $filter)
                ->orLike("category.name", $filter)
                ->orderBy("escort.sort_order", "asc")
                ->join("cities", "cities.id=escort.city")
                ->join("category", "category.id=escort.category")
                ->select("escort.*, cities.name as city_name, cities.url as city_url, category.name as category_name, category.url as category_url")
                ->findAll();

            $this->data['recent_post'] = (new EscortModel)->orderBy("id", "desc")->limit(6)->findAll();
            $this->data['category_lists'] = (new CategoryModel)->orderBy("sort_order", "asc")->findAll();
            $this->data['category'] = [];
            foreach($this->data['category_lists'] as $k=>$category){
                $service = (new EscortModel)->where("category", $category['id'])->find();
                if($service){
                    $this->data['category'][$k]= $category;
                    $this->data['category'][$k]['service']= count($service);
                }
            }
            $this->data['page_type'] = "null";
            return view("service", $this->data);

        }else {
            $this->data['category_lists'] = (new CategoryModel)->orderBy("sort_order", "asc")->findAll();
            $this->data['category'] = [];
            foreach($this->data['category_lists'] as $k=>$category){
                $service = (new EscortModel)->where("category", $category['id'])->find();
                if($service){
                    $this->data['category'][$k]= $category;
                    $this->data['category'][$k]['service']= count($service);
                }
            }
            return view('home', $this->data);
        }
    }

    public function about(){
        return view("about", $this->data);
    }
    public function faqs(){
        return view("faqs", $this->data);
    }
    public function service(){

        $this->data['services'] = (new EscortModel)
            ->orderBy("escort.sort_order", "asc")
            ->join("cities", "cities.id=escort.city")
            ->join("category", "category.id=escort.category")
            ->select("escort.*, cities.name as city_name, cities.url as city_url, category.name as category_name, category.url as category_url")
            ->findAll();

        $this->data['recent_post'] = (new EscortModel)->orderBy("id", "desc")->limit(6)->findAll();
        $this->data['category_lists'] = (new CategoryModel)->orderBy("sort_order", "asc")->findAll();
        $this->data['category'] = [];
        foreach($this->data['category_lists'] as $k=>$category){
            $service = (new EscortModel)->where("category", $category['id'])->find();
            if($service){
                $this->data['category'][$k]= $category;
                $this->data['category'][$k]['service']= count($service);
            }
        }
        $this->data['page_type'] = "null";
        return view("service", $this->data);
    }
    public function blogs(){
        $this->data['recent_post'] = (new BlogModel)->orderBy("id", "desc")->limit(6)->findAll();
        $this->data['blogs'] = (new BlogModel)->orderBy("sort_order", "asc")->findAll();
        return view("blogs", $this->data);
    }
    public function rate(){
        return view("rate", $this->data);
    }
    public function contact(){
        if($this->request->getPostGet()){

            $messageBody = '<table style="width:55%;margin:0 auto;text-align:left;border-collapse:collapse">
                        <thead>
                        <tr>
                        <td colspan="2" style="background-color:#fd7e14;text-align:center;padding:10px;color:white;border:1px solid grey;font-weight:800;font-size:20px">A2zcity Contact Form </td>
                        </tr>
                        <tr style="padding:10px">
                            <th style="border:1px solid grey;padding:10px">NAME </th>
                            <td style="border:1px solid grey;padding:10px">'.ucwords(strtolower($_POST['name'])).'</td>
                        </tr>
                    
                        <tr style="padding:10px">
                            <th style="border:1px solid grey;padding:10px">EMAIL </th>
                            <td style="border:1px solid grey;padding:10px"><a href="mailto:'.strtolower($_POST['email']).'" target="_blank" title="click to send email">'.strtolower($_POST['email']).'</a></td>
                        </tr>
                    
                        <tr style="padding:10px">
                            <th style="border:1px solid grey;padding:10px"> PHONE NUMBER </th>
                            <td style="border:1px solid grey;padding:10px">'.$_POST['phone'].'</td>
                        </tr>
                        <tr style="padding:10px">
                            <th style="border:1px solid grey;padding:10px"> SUBJECT </th>
                            <td style="border:1px solid grey;padding:10px">'.$_POST['subject'].'</td>
                        </tr>
                        <tr style="padding:10px">
                            <th style="border:1px solid grey;padding:10px"> MESSAGE </th>
                            <td style="border:1px solid grey;padding:10px">'.$_POST['message'].'</td>
                        </tr>
                        </thead>
                    </table>';


            $to = "sajid.globalheight@gmail.com";
            $subject = "A2zcity Contact Form";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: customer@a2zcty.com' . "\r\n";
            try {
                if(mail($to, $subject, $messageBody, $headers)){
                    redirect()->to("contact-us")->with("msg", "<div class='alert' style='margin-bottom:10px; font-size:16px; text-align: left'>Thanks for connecting us, We'll contact your soon as possible</div>");
                }else {
                    redirect()->to("contact-us")->with("msg", "<div class='alert' style='margin-bottom:10px; font-size:16px; text-align: left; color:red'>Something is worng, Please try again later</div>");
                }
            }catch(Exception $e){
                    redirect()->to("contact-us")->with("msg", "<div class='alert' style='margin-bottom:10px; font-size:16px; text-align: left; color:red'>Error ".$e->getMessage()."</div>");
            }
        }else {
            return view("contact", $this->data);
        }
    }

}


