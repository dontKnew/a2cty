<?php

namespace App\Controllers\User;
use App\Controllers\BaseController;

use App\Models\UserModel;

class AccountController extends BaseController
{

    public function changePassword(){
        if($this->request->getMethod()=="post"){
            $session = session();
            $id = $session->get('user_id');
            $password = $this->request->getVar('password');
            $cpassword = $this->request->getVar('cpassword');

            if($password == $cpassword){
                $password = password_hash($password, PASSWORD_DEFAULT);
                $model = new UserModel();
                try {
                    if($model->update($id, array("password"=>$password))){
                        $session->setFlashdata('msg', 'Password has been changed');
                    }else {
                        $session->setFlashdata('err', 'Password could not change');
                    }
                    return redirect()->to('change-password');
                }catch(Exception $e){
                    $session->setFlashdata('err', 'Error :'.$e->getMessage());
                    return redirect()->to('change-password');
                }

            }else {
                $session->setFlashdata('err', 'Please enter same password');
                return redirect()->to('change-password');
            }

        }
        $data['title'] = "Change Password - Hiremyescort";
        return view("user/change_password");
    }

    public function profile(){
        if($this->request->getMethod()=="post"){
            $session = session();
            $id = $session->get('user_id');
            $model = new UserModel();
            $oldData  =$model->find($id);
            try {
                
                $data = $this->request->getVar();
                if(password_verify($data['password'], $oldData['password'])){
                    /*$image = $this->updateImage("profile", $oldData['profile'], "frontend/images/user_gallery/" );*/
                    if($_FILES['profile']['name']!==""){
                        $file = $this->request->getFile("profile");
                        $name = "user_gallery_".$file->getRandomName();
                        $image = \Config\Services::image()
                        ->withFile($file)
                        ->withResource()
                        ->save('frontend/images/user_gallery/compress/' .$name,50);
                        $file->move("frontend/images/user_gallery/original/", $name);
                        @unlink("frontend/images/user_gallery/original/".$userAdsData['profile']);
                        @unlink("frontend/images/user_gallery/compress/".$userAdsData['profile']);   
                    }else {
                        $name = $oldData['profile'];
                    }
                    
                    $data['profile'] =$name;
                    
                    $_SESSION['user_profile'] = $name;
                    $_SESSION['user_name'] = $data['name'];
                    $_SESSION['user_email'] = $data['email'];
                    
                    unset($data['password']);
                    if($model->update($id, $data)){
                        $session->setFlashdata('msg', 'Your profile is updated');
                        return redirect()->to('user/profile');
                    }else {
                        return redirect()->to('user/profile')->with("err", "Please could not update");
                    }   
                }else {
                    
                    return redirect()->to('user/profile')->with("err", "Please enter correct passsword");
                }

            }catch(Exception $e){
                $session->setFlashdata('msg', 'Error :'.$e->getMessage());
                return redirect()->to('user/profile');
            }
        }else {
            $session = session();
            $id = $session->get('user_id');
            $admin = new UserModel();
            $data = $admin->find($id);
            $data['title'] = "User Profile - Hiremyescort";
            return view("user/profile",["data"=>$data]);
        }
    }
    
    
    public function passwordRecover(){
        
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }

    
}
