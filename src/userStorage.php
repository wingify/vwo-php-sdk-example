<?php

/**
 * Copyright 2019-2020 Wingify Software Pvt. Ltd.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

use vwo\Storage\UserStorageInterface;

class UserStorage implements UserStorageInterface
{

    /**
     * @param  $userId
     * @param  $campaignName
     * @return array
     */
    public function get($userId, $campaignKey)
    {
        // Fetch from Storage system
        // $variation = $db->getVariation($userId, $campaignName);

        return [
            'userId' => $userId,
            'campaignKey' => $campaignKey,
            'variationName' => $variation
        ];
    }

    /**
     * @param $campaignUserMapping
     */
    public function set($campaignUserMapping)
    {
        // use $campaignUserMapping to set it into your storage system
        // Please check how we would like you to pass it while getting it in `get` method
    }
}
