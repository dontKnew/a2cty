<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FaqsModel;
use App\Models\CityModel;
use App\Models\StateModel as State;
use App\Models\CategoryModel;
use App\Models\EscortModel;
use App\Models\BlogModel;

class DashboardController extends BaseController
{
    public function index()
    {

        $data = array(
            "dashboard"=>"active",
            'city'=>count((new CityModel)->findAll()),
            'state'=>count((new State)->findAll()),
            'faqs'=>count((new FaqsModel)->findAll()),
            'blog'=>count((new BlogModel)->findAll()),
            'escort'=>count((new EscortModel)->findAll()),
            'category'=>count((new CategoryModel)->findAll())
        );

        return view("admin/dashboard", $data);
    }
}
