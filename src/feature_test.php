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

$segmnentVars['var1'] = '';
$segmnentVars['var2'] = '';

$vwoClient = new VWO($config);
$_SESSION['settings'] = $vwoClient->settings;

$variablekey1 = 'int1';
$variablekey2 = 'float1';
$variablekey3 = 'string1';
$variablekey4 = 'bool1';

$userId = $_GET['userId'];// || USERS_LIST[rand(0, 25)];
$variationName = $vwoClient->getVariationName(FEATURE_TEST_CAMPAIGN_KEY, $userId, $segmnentVars);
$res = $vwoClient->isFeatureEnabled(FEATURE_TEST_CAMPAIGN_KEY, $userId);
$val1 = $vwoClient->getFeatureVariableValue(FEATURE_TEST_CAMPAIGN_KEY, $variablekey1, $userId);
$val2 = $vwoClient->getFeatureVariableValue(FEATURE_TEST_CAMPAIGN_KEY, $variablekey2, $userId);
$val3 = $vwoClient->getFeatureVariableValue(FEATURE_TEST_CAMPAIGN_KEY, $variablekey3, $userId);
$val4 = $vwoClient->getFeatureVariableValue(FEATURE_TEST_CAMPAIGN_KEY, $variablekey4, $userId);

// Uncomment below line, If you want to track a goal, Update $goalIdentifier as per VWO application campaign
// $goalIdentifier = '';
// $revenueValue = '';
// $w = $vwoClient->track(FEATURE_TEST_CAMPAIGN_KEY, $userId, $goalIdentifier, $revenueValue);

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
                <div>Campaign test key - <strong><?php echo FEATURE_TEST_CAMPAIGN_KEY; ?></strong></div>
            </div>
            <div class="center margin--top">
                <div>Campaign goal identifier - <strong><?php echo $goalIdentifier; ?></strong></div>
            </div>

            <div class="center  margin--top">
                <div>userId - <strong><?php echo $userId; ?></strong></div>
            </div>
            <div class="center  margin--top">
                <div>Feature Test1 Enabled - <strong><?php echo $res == true ? 'true' : 'false'; ?></strong></div>

            </div>
            <div class="center  margin--top">
                <div>Feature Value - <strong><?php echo $variablekey1 . '=' . $val1; ?></strong></div><br>
                <div>Feature Value - <strong><?php echo $variablekey2 . '=' . $val2; ?></strong></div><br>
                <div>Feature Value - <strong><?php echo $variablekey3 . '=' . $val3; ?></strong></div><br>
                <div>Feature Value - <strong><?php echo $variablekey4 . '=' . $val4; ?></strong></div>

            </div>
            <div class="center  margin--top">
                <pre><code><?php if (isset($segmnentVars)) {
                    echo json_encode($segmnentVars, JSON_PRETTY_PRINT);
                           } ?></code></pre>
            </div>
            <?php if ($variationName != null) { ?>
                <div class="center  margin--top">
                    <div>variationAssigned - <strong><?php echo $variationName ?></strong></div>
                </div>
            <?php } else { ?>
                <div class="center  margin--top">
                    <div>did not become a part of campaign</div>
                </div>
            <?php } ?>
        </div>
        <div class="half-containers  center">
            <?php if ($variationName == 'Control') { ?>
                <button class="v1">Control</button>
            <?php  } elseif ($variationName == 'Variation-1') { ?>
                <button class="v2">Variation 1</button>
            <?php } elseif ($variationName == 'Variation-2') { ?>
                <button class="v3">Variation 2</button>
            <?php } elseif ($variationName == 'fs') { ?>
                <button class="v3">Variation 3</button>
            <?php } else { ?>
                <button>Not part</button>
            <?php } ?>
        </div>
    </div>
</div>

</body>
</html>
