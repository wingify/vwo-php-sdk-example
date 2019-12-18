<?php

/**
 * Copyright 2019 Wingify Software Pvt. Ltd.
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

require_once('../vendor/autoload.php');
require_once('./userStorage.php');
require_once('./customLogger.php');
require_once('../config.php');
session_start();
ini_set('date.timezone', 'Europe/Berlin');

?>

<?php

include_once('./templates/header.php');

use vwo\VWO;

// Require logger deps to modify custom logger implementation
// Also, verify the deps-path
use vwo\Logger\DefaultLogger as VwoLogger;
use Monolog\Logger as Logger;

// send logs to stdout, you can configure it as per Monolog options available
// Read more - https://github.com/Seldaek/monolog
$stream = 'php://stdout';
$settingsFile = '';

// Settings-file Caching Implementation
if (isset($_GET['cache']) && $_GET['cache'] == 1 && isset($_SESSION['settings'])) {
    $settingsFile =  $_SESSION['settings'];
} else {
    $settingsFile = VWO::getSettingsFile(ACCOUNT_ID, SDK_KEY);
    if (isset($_GET['cache']) && $_GET['cache'] == 1) {
        $_SESSION['settings'] = $settingsFile;
    } else {
        unset($_SESSION['settings']);
    }
}

// object instead of many parameteres
$config = ['settingsFile' => $settingsFile,
    'isDevelopmentMode' => 0,
    // Uncomment below line to define monolog log-levels(DEBUG, INFO, WARNING, ERROR) and streams
    // 'logging' => new VWOLogger(Logger::DEBUG, $stream),
    // Uncomment below line, If you want to implement your own logger i.e. you want message and level so that you can use them accordingly
    //'userStorageService'=> new UserStorage(),
];


$segmnentVars['test'] = '';
$vwoClient = new VWO($config);
$_SESSION['settings'] = $vwoClient->settings;
$userId = $_GET['userId'] || USERS_LIST[rand(0, 25)];

$pushResult = $vwoClient->push(TAG_KEY, TAG_VALUE, $userId);

?>
<h2 class="center  color-blue">VWO PHP SDK Example</h2>
<div class="main-container">
    <div class="left-container">
        <h2 class="center  color-grey">Settings</h2>
        <pre><code><?php echo json_encode($settingsFile, JSON_PRETTY_PRINT); ?></code></pre>
    </div>

    <div class="right-container">
        <div class="half-containers">
            <h2 class="center  color-grey">Details</h2>
            <div class="center  margin--top">
                <div>userId - <strong><?php echo $userId; ?></strong></div>
            </div>
            <div class="center  margin--top">
                <div>Tag Key - <strong><?php echo TAG_KEY; ?></strong></div>
            </div>
            <div class="center  margin--top">
                <div>Tag Value - <strong><?php echo TAG_VALUE; ?></strong></div>
            </div>
            <div class="center  margin--top">
                <div>Push result - <strong><?php echo $pushResult == true ? 'TRUE' : 'FALSE'; ?></strong></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
