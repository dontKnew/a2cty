<?php

namespace App\Controllers;
use App\Models\UserAdsModel;
use App\Models\UserModel;
use App\Models\CityModel;
use App\Models\StateModel as State;
use App\Models\CategoryModel as Category;
use App\Models\PortfolioModel as Portfolio;

class UserAdsController extends BaseController
{
    /*
        category : return all data
        city : return ads which is cover this city with cateogry
        $ads_title :  return single ads data information with gallery
    */
    public function index($category = null)
    {
        
        helper('text');
        $category = strtolower(str_replace("-"," ",$category));
        $search =  $this->request->getVar("search");
        $model = new UserAdsModel();
        if($search!==null){
            
            $data['data'] = $model->select("user_ads.*, 
            ads_category.name as ads_category, cities.name as city, states.name as state")
            ->join("ads_category","ads_category.id=user_ads.ads_category", "left")
            ->join("states", "states.id=user_ads.state", "left")
            ->join("cities", "cities.id=user_ads.city", "left")
            ->like("ads_title", $search)
            ->orLike("ads_text", $search)->orderBy("id", "desc")->paginate(15);
             $data['page_title'] = "Total Records Found - ".count($data['data']);
             
        }else {
            
            /*category ads*/
            $data['data'] = $model->select("
            user_ads.*, 
            ads_category.name as ads_category, ads_category.description, ads_category.page_title as page_title, ads_category.meta_keywords as meta_keywords, ads_category.meta_description as meta_description,
            cities.name as city, states.name as state")
            ->join("ads_category","ads_category.id=user_ads.ads_category", "left")
            ->join("states", "states.id=user_ads.state", "left")
            ->join("cities", "cities.id=user_ads.city", "left")
            ->where("ads_category.name",$category)->orderBy("id", "desc")->paginate(15);
            
            /*city ads*/
            if(count($data['data'])==0){
                $data['data'] = $model->select(
                    "user_ads.*, 
                    ads_category.name as ads_category, 
                    cities.name as city, 
                    states.name as state, states.page_title as page_title, states.meta_keywords as meta_keywords, states.meta_description as meta_description")
                ->join("ads_category","ads_category.id=user_ads.ads_category", "left")
                ->join("states", "states.id=user_ads.state", "left")
                ->join("cities", "cities.id=user_ads.city", "left")
                ->where("cities.name",$category)->orderBy("id", "desc")->paginate(15);
                
            $data['normal_state'] = true;
            
            }
            $data['page_title'] = $category;
            
            /*user ads*/
            if(session()->has("user_logged_in")){
                if(count($data['data'])==0){
                    $data['data'] = $model->select("user_ads.*, ads_category.name as ads_category, cities.name as city, states.name as state")
                    ->join("ads_category","ads_category.id=user_ads.ads_category", "left")
                    ->join("states", "states.id=user_ads.state", "left")
                    ->join("cities", "cities.id=user_ads.city", "left")
                    ->where("user_ads.user_id",intval($category))->orderBy("id", "desc")->paginate(15);
                    $data['page_title'] = "Manage Ads";
                }   
            }
        }
        
        if($data['data']){
            $data['meta_keywords'] = $data['data'][0]['meta_keywords'];
            $data['meta_description'] = $data['data'][0]['meta_description'];
            $data['title'] = $data['data'][0]['page_title'];   
            if(isset($data['data']['0']['description'])){
                $data['description'] = $data['data']['0']['description'];
            }
            $data['pagination'] = $model->pager->getDetails();
            $data['pagination']['path'] = $model->pager->getPageURI();
            $data['pagination']['get_last_page'] = $model->pager->getLastPage();
        }else {
            return view("page_not_found");
        }

        $data['state_list'] = (new CItyModel)->orderBy("name", "asc")->findAll();
        $data['portfolio'] = (new Portfolio)->orderBy("name", "asc")->findAll();
        
        return view('call_girls',$data);
        
    }
    
    public function categoryAreaAds($category=null, $city=null)
    {
        helper('text');
        $category = strtolower(str_replace("-"," ",$category));
        $city = strtolower(str_replace("-"," ",$city));
        $model = new UserAdsModel();
        /*$data['data'] = $model->where(array("ads_category"=>$category, "city"=>$city))->orderBy("id", "desc")->findAll();*/
        $data['data'] = $model->select("user_ads.*, ads_category.name as ads_category, 
        cities.name as city, cities.page_title as page_title, cities.description as description,  cities.meta_keywords as meta_keywords, cities.meta_description as meta_description,
        states.name as state")
            ->join("ads_category","ads_category.id=user_ads.ads_category", "left")
            ->join("states", "states.id=user_ads.state", "left")
            ->join("cities", "cities.id=user_ads.city", "left")
            ->where(array("ads_category.name"=>$category, "cities.name"=>$city))->orderBy("id", "desc")->paginate(15);
            
            $data['page_title'] = $category;
            $data['state1'] = $city;
            $data['state_list'] = (new CItyModel)->orderBy("name", "asc")->findAll();
            $data['portfolio'] = (new Portfolio)->orderBy("name", "asc")->findAll();
        
        if($data['data']){
            $data['meta_keywords'] = $data['data'][0]['meta_keywords'];
            $data['meta_description'] = $data['data'][0]['meta_description'];
            $data['title'] = $data['data'][0]['page_title'];   
            if(isset($data['data']['0']['description'])){
                $data['description'] = $data['data']['0']['description'];
            }
            
            $data['pagination'] = $model->pager->getDetails();
            $data['pagination']['path'] = $model->pager->getPageURI();
            $data['pagination']['get_last_page'] = $model->pager->getLastPage();
        }else {
            return view("page_not_found");
        }
        
        return view('call_girls',$data);
        
    }
    
    public function singleAds($category=null, $city=null, $ads_title=null)
    {
        
        $category = strtolower(str_replace("-"," ",$category));
        $city = strtolower(str_replace("-"," ",$city));
        
        // $data['data'] = $model->where(array("ads_category"=>$category, "city"=>$city, "ads_title"=>$ads_title))->first();
        $model = new UserAdsModel();
        /*$data['data'] = $model->where(array("ads_category"=>$category, "city"=>$city))->orderBy("id", "desc")->findAll();*/
        $data['data'] = $model->select("user_ads.*, 
            ads_category.name as ads_category, ads_category.meta_keywords as ads_category_keywords, 
            cities.name as city, 
            states.name as state, states.meta_keywords as state_keywords")
            ->join("ads_category","ads_category.id=user_ads.ads_category", "left")
            ->join("states", "states.id=user_ads.state", "left")
            ->join("cities", "cities.id=user_ads.city", "left")
            ->where(array("ads_category.name"=>$category, "cities.name"=>$city, "ads_title_url"=>strtolower($ads_title)))->orderBy("id", "desc")->first();
            $data['page_title'] = $category;
        $data['ads_category'] = (new Category())->orderBy("id", "desc")->where("status", "Public")->findAll();
        $data['city'] = (new CityModel)->orderBy("name", "asc")->paginate(15);
        
        if($data['data']){
             $data['meta_keywords'] = $data['data']['ads_category_keywords'].','.$data['data']['state_keywords'];
             $data['meta_description'] = word_limiter(strip_tags($data['data']['meta_description']),160);
             $data['title'] = strip_tags($data['data']['ads_title']);
        }else {
            return view("page_not_found");
        }
        
        return view('single',$data);
        
    }
    
     public function adsWithState()
    {
        
        helper('text');
        $keywords = $this->request->getVar("search");
        $state = strtolower($this->request->getVar("city"));
        $state = strtolower(str_replace("-"," ",$state));
        $model = new UserAdsModel();
        /*$data['data'] = $model->where("city", 69)->like("ads_title", $keywords)
                ->orLike("ads_text", $keywords)->orderBy("id", "desc")->find();*/
        $data['data'] = $model->select("user_ads.*, ads_category.name as ads_category, 
                cities.name as city, cities.page_title as page_title, cities.meta_keywords as meta_keywords, cities.meta_description as meta_description,
                states.name as state, states.description as description")
                ->where("cities.name",$state)
                ->join("ads_category","ads_category.id=user_ads.ads_category", "left")
                ->join("states", "states.id=user_ads.state", "left")
                ->join("cities", "cities.id=user_ads.city", "left")
                ->like("ads_text", $keywords)
                ->orderBy("id", "desc")->findAll();
        /*orLike not working*/
        $data['normal_state'] = true;   
        $data['page_title'] = "Total Records Found - ".count($data['data']);
        $data['state_list'] = (new CItyModel)->orderBy("name", "asc")->findAll();
        $data['portfolio'] = (new Portfolio)->orderBy("name", "asc")->findAll();
        if($data['data']){
            $data['meta_keywords'] = $data['data'][0]['meta_keywords'];
            $data['meta_description'] = $data['data'][0]['meta_description'];
            $data['title'] = $data['data'][0]['page_title'];   
            
            if(isset($data['data']['0']['description'])){
                $data['description'] = $data['data']['0']['description'];
            }
        }else {
            return view("page_not_found");
        }
        
        return view('call_girls',$data);
        
    }
    
    public function postAds(){
        if($this->request->getPostGet()){
            try {
                $data = $this->request->getVar();
                
                if(trim($data['captcha'])==$data['captcha_text']){
                    unset($data['captcha_text']);
                    unset($data['captcha']);
                    $files = $this->request->getFiles("photo");
                    foreach ($files as $file1) {
                        $photos = [];
                        foreach ($file1 as $file) {
                            $name = strtolower($data['nickname'])."_".$file->getRandomName();
                            $image = \Config\Services::image()
                                ->withFile($file)
                                ->withResource()
                                ->save('frontend/images/user_gallery/compress/' .$name,50);
                            $file->move("frontend/images/user_gallery/original/", $name);
                            array_push($photos, $name);
                        }
                        $check_user = (new UserModel)->where("email", strtolower($data['email']))->first();
                        if($check_user){
                            $data['email']=strtolower($check_user['email']);
                            $data['nickname']=ucwords($check_user['name']);
                            $data['phone_no']=$check_user['phone_no'];
                            $data['age']= $check_user['age'];
                            $data['user_id'] = $check_user['id'];
                        }else {
                         $user_data = [
                            "email"=>strtolower($data['email']), 
                            "name"=>ucwords($data['nickname']), 
                            "phone_no"=>$data['phone_no'], 
                            "age"=>$data['age'], 
                            "password"=>password_hash($data['password'], PASSWORD_DEFAULT), 
                            "profile"=>$photos[0]
                            ];
                            (new UserModel)->save($user_data);
                            $user_data =  (new UserModel)->orderBy("id", "desc")->first();
                            $data['user_id'] = $user_data['id'];
                        }
                        
                        $data['user_gallery'] = json_encode($photos);
                        $data['ads_title_url'] = strtolower(url_title($data['ads_title']));
                        
                        $portfolio = new UserAdsModel();
                        $portfolio->save($data);
                    }
                    $category = (new Category)->find($data['ads_category']);
                    $state = (new CityModel)->find($data['city']);
                    $url = url_title(strtolower($category['name']))."/".url_title(strtolower($state['name']))."/".strtolower($data['ads_title_url']);
                    return redirect()->to($url);
                }else {
                    return redirect()->back()->withInput()->with("err", "Captcha verification failed, Please try again!")->withInput();
                }
            }catch(Exception $e){
                return redirect()->back()->with("err", "Error : ".$e->getMessage())->withInput();   
            }
        }else {
            $data['state'] = (new State())->findAll();
            $data['ads_category'] = (new Category())->orderBy("sort_order", "asc")->where("status", "Public")->findAll();
             $data['captcha_text'] = $this->captcha();
            return view ("post_ads", $data);
        }
    }
    
    public function postAdsEdit($id=null)
    {
        $data['state'] = (new State)->orderBy("name", "asc")->findAll();
        $data['ads_category'] = (new Category())->orderBy("sort_order", "asc")->where("status", "Public")->findAll();
        $model = new UserAdsModel();
        if($this->request->getPostGet()){
            $data = $this->request->getVar();
            $files = $this->request->getFiles("photo");
            if($files['user_gallery'][0]->getName()!==""){
                foreach ($files as $file1) {
                    $photos = [];
                    foreach ($file1 as $file) {
                        $name = strtolower($data['nickname'])."_".$file->getRandomName();
                        $image = \Config\Services::image()
                            ->withFile($file)
                            ->withResource()
                            ->save('frontend/images/user_gallery/compress/' .$name,50);
                        $file->move("frontend/images/user_gallery/original/", $name);
                        array_push($photos, $name);
                    }
                 }
                 
                foreach($data['old_user_gallery'] as $ug){
                    array_push($photos,$ug);
                }
                $data['user_gallery'] = json_encode($photos);
                 
            }else {
                $data['user_gallery'] = json_encode($data['old_user_gallery']);
            }
            $data['ads_title_url'] = strtolower(url_title($data['ads_title']));
            unset($data['old_user_gallery']);
            $model->save($data);
            return redirect()->to("admin/user-ads")->with("msg", "User Ads Data successfully updated");
            
        }else {
            $data['data'] = $model->select("user_ads.*, ads_category.name as ads_category, ads_category.id as ads_category_id, cities.name as city, cities.id as city_id, states.name as state, states.id as state_id")
                ->join("ads_category","ads_category.id=user_ads.ads_category", "left")
                ->join("states", "states.id=user_ads.state", "left")
                ->join("cities", "cities.id=user_ads.city", "left")
                ->orderBy("id", "desc")->find($id);
            
            $data['city'] = (new CityModel)->where("state_name",$data['data']['state_id'])->findAll();
            
            return view('post_ads_edit',$data);      
            
        }
        
    }
    
   public function userAdsEdit($id)
    {
        
        $data['state'] = (new State)->orderBy("name", "asc")->findAll();
        $data['ads_category'] = (new Category())->orderBy("id", "desc")->where("status", "Public")->findAll();
        $model = new UserAdsModel();
        if($this->request->getPostGet()){
            $data = $this->request->getVar();
            $files = $this->request->getFiles("photo");
            if($files['user_gallery'][0]->getName()!==""){
                foreach ($files as $file1) {
                    $photos = [];
                    foreach ($file1 as $file) {
                        $name = strtolower($data['nickname'])."_".$file->getRandomName();
                        $image = \Config\Services::image()
                            ->withFile($file)
                            ->withResource()
                            ->save('frontend/images/user_gallery/compress/' .$name,50);
                        $file->move("frontend/images/user_gallery/original/", $name);
                        array_push($photos, $name);
                    }
                 }
                if(isset($data['old_user_gallery'])){
                 foreach($data['old_user_gallery'] as $ug){
                        array_push($photos,$ug);
                    }   
                }
                $data['user_gallery'] = json_encode($photos);
                 
            }else {
                $data['user_gallery'] = json_encode($data['old_user_gallery']);
            }
            $data['ads_title_url'] = strtolower(url_title($data['ads_title']));
            unset($data['old_user_gallery']);
            $model->save($data);
            return redirect()->to("user/your-ads/".$id)->with("msg", "User Ads Data successfully updated");
            
        }else {
            
           $data['data'] = $model->select("user_ads.*, user.name as name, user.name as nickname, user.email as email, user.phone_no as phone_o, user.age as age, user.id as user_id, ads_category.name as ads_category, ads_category.id as ads_category_id, cities.name as city, cities.id as city_id, states.name as state, states.id as state_id")
                ->join("ads_category","ads_category.id=user_ads.ads_category", "left")
                ->join("states", "states.id=user_ads.state", "left")
                ->join("cities", "cities.id=user_ads.city", "left")
                ->join("user", "user.id=user_ads.user_id", "left")
                ->find($id);
            
            $data['city'] = (new CityModel)->where("state_name",intval($data['data']['state_id']))->findAll();
            
            
            return view('post_ads_edit',$data);      
            
        }
        
    }
    
    public function getCity(){
        if($this->request->getPostGet()){
            $state_id =  $this->request->getVar("state_id");
            $data = (new CityModel)->where("state_name", intval($state_id))->findAll();
            $city = "<option value=''>Select City</option>";
            foreach($data as $d){
                $city .="<option value='".$d['id']."'>".ucwords($d['name'])."</option>";    
            }
            echo $city;
        }else {
            return '<option value="">Somethig wrong</option>';
        }
    }
    
    public function captcha(){
        $code = bin2hex(random_bytes(4));
        $image = imagecreatetruecolor(200, 50);
        $bg_color = imagecolorallocate($image, 255, 255, 255);
        $text_color = imagecolorallocate($image, 0, 0, 0);
        imagefill($image, 0, 0, $bg_color);
        imagestring($image, 5, 50, 15, $code, $text_color);
        for ($i = 0; $i < 200; $i++) {
            $x = rand(0, 200);
            $y = rand(0, 50);
            imagesetpixel($image, $x, $y, $text_color);
        }
        header('Content-Type:image/png');
        imagepng($image, "frontend/captcha.png");
        imagedestroy($image);
        return $code;
    }


}
