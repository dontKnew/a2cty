<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserAdsModel;

class UserAdsController extends BaseController
{
    /*
        category : return all data
        city : return ads which is cover this city with cateogry
        $ads_title :  return single ads data information with gallery
    */

    public function deleteAds($id){
        
        try {
            $data = (new UserAdsModel)->delete($id);
            if($data){
                return redirect()->back()->with("msg", "Ads deleted successfully");
            }else {
                return redirect()->back()->with("msg", "Ads could not delete, Please try again later");
            }   
        }catch(Exception $e){
               return redirect()->back()->with("msg", "Error: ".$e->getMessage());
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
