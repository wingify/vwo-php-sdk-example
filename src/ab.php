<?php
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

$segmentVars['var1'] = '';
$vwoClient = new VWO($config);
$_SESSION['settings'] = $vwoClient->settings;

$userId = $_GET['userId'] || USERS_LIST[rand(0, 25)];

$variationName = $vwoClient->getVariationName(AB_CAMPAIGN_KEY, $userId, $segmentVars);
$w = $vwoClient->track(AB_CAMPAIGN_KEY, $userId, AB_CAMPAIGN_GOAL_IDENTIFIER);

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
                <div>Campaign test key - <strong><?php echo AB_CAMPAIGN_KEY; ?></strong></div>
            </div>
            <div class="center margin--top">
                <div>Campaign goal identifier - <strong><?php echo AB_CAMPAIGN_GOAL_IDENTIFIER; ?></strong></div>
            </div>

            <div class="center  margin--top">
                <div>userId - <strong><?php echo $userId; ?></strong></div>
            </div>
            <div class="center  margin--top">
                <pre><code><?php if (isset($segmentVars)) {
                    echo json_encode($segmentVars, JSON_PRETTY_PRINT);
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
            <button class="v2">Variation-1</button>
            <?php } elseif ($variationName == 'Variation-2') { ?>
            <button class="v3">Variation-2</button>
            <?php } else { ?>
            <button>Not part</button>
            <?php } ?>
        </div>
    </div>
</div>

</body>
</html>
