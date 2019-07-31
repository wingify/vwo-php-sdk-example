<?php
require_once('vendor/autoload.php');
use vwo\Utils\UserProfileInterface;
Class UserProfile implements UserProfileInterface{

    /**
     * @param $userId
     * @param $campaignName
     * @return string
     */
    public function lookup($userId,$campaignName){
        // xyz actions     
       return[
            'userId'=>$userId,
            $campaignName=>['variationName'=>'Control']
        ];

    }

    /**
     * @param $campaignInfo
     * @return bool
     */
    public function save($campaignInfo){
       // print_r($campaignInfo);
        return True;

    }

}


