<?php

use vwo\Storage\UserStorageInterface;

class UserStorage implements UserStorageInterface
{

    /**
     * @param $userId
     * @param $campaignName
     * @return string
     */
    public function get($userId, $campaignName)
    {
        // xyz actions
        return[
            'userId' => $userId,
            $campaignName => ['variationName' => 'Control']
        ];
    }

    /**
     * @param $campaignInfo
     * @return bool
     */
    public function set($campaignInfo)
    {
       // print_r($campaignInfo);
        return true;
    }
}
