<?php

namespace App\Controllers;
use App\Models\BlogModel;
use App\Models\CategoryModel;
use App\Models\CityModel;
use App\Models\EscortModel;
use App\Models\FaqsModel;

class PageController extends BaseController
{
    public function __construct()
    {
        $this->data['faqs_list'] = (new FaqsModel)->orderBy("sort_order", "asc")->findAll();
        $this->data['city_list'] = (new CityModel)->orderBy("sort_order", "asc")->findAll();
    }

    public function blogs()
    {
        return view('blogs', $this->data);
    }

    public function blog_post($param=null){
        $this->data['blogs'] = (new BlogModel)->orderBy("sort_order", "asc")->limit(5)->findAll();
        $this->data['blog'] = (new BlogModel)->where("url", $param)->first();
        return view("blog_post", $this->data);
    }

    public function service_post($param=null){
        if($param!==null){
            $this->data['service'] = (new EscortModel)->where("escort.url", $param)
                ->join("cities", "cities.id=escort.city")
                ->join("category", "category.id=escort.category")
                ->select("escort.*, cities.name as city_name, cities.url as city_url, category.name as category_name, category.url as category_url")
                ->first();
            if(!is_array($this->data['service'])){
                return $this->category_post($param);
            }else {
                $this->data['services'] = (new EscortModel)->orderBy("sort_order", "asc")
                    ->limit(6)
                    ->join("cities", "cities.id=escort.city")
                    ->join("category", "category.id=escort.category")
                    ->select("escort.*, cities.name as city_name, cities.url as city_url, category.name as category_name, category.url as category_url")
                    ->findAll();
                $this->data['related_service'] = (new EscortModel)->where("category.url", $this->data['service']['category_url'])
                    ->join("cities", "cities.id=escort.city")
                    ->join("category", "category.id=escort.category")
                    ->select("escort.*, cities.name as city_name, cities.url as city_url, category.name as category_name, category.url as category_url")
                    ->findAll();
                return view("service_post", $this->data);
            }
        }else {
            echo "something is wrong";
        }
    }

    private function category_post($param=null){

        $this->data['services'] = (new EscortModel)->where("cities.url", $param)
            ->join("cities", "cities.id=escort.city")
            ->join("category", "category.id=escort.category")
            ->select("escort.*, cities.name as city_name, cities.url as city_url, category.name as category_name, category.url as category_url")
            ->find();
        $this->data['page_type'] = "city";
        if(is_array($this->data['services']) && count($this->data['services'])== 0){
            $this->data['services'] = (new EscortModel)->where("category.url", $param)
                ->join("cities", "cities.id=escort.city")
                ->join("category", "category.id=escort.category")
                ->select("escort.*, cities.name as city_name, cities.url as city_url, category.name as category_name, category.url as category_url")
                ->find();
            $this->data['page_type'] = "category";
        }

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
        return view("service", $this->data);
    }


}


