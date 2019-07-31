<html>
<head>
    <title>VWO PHP SDK Example</title>
</head>
<style>
    .center {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .margin--top {
        margin-top: 20px;
    }
    .color-grey {
        color: #777;
    }
    .color-blue {
        color: #00a8ff;
    }
    button {
        background: #fff;
        padding: 10px 20px;
        color: #777;
        border: 2px solid #777;
        font-size: 18px;
    }
    button.v1 {
        border: 2px solid #ff9a9a;
    }
    button.v2 {
        border: 2px solid #57e0a2;
    }
    button.v3 {
        border: 2px solid #00a8ff;
    }
    pre {
        background-color: ghostwhite;
        border: 1px solid silver;
        padding: 10px 20px;
        max-height: 80vh;
        overflow: auto;
    }
    .json-key {
        color: brown;
    }
    .json-value {
        color: navy;
    }
    .json-string {
        color: olive;
    }
    .main-container {
        display: flex;
        width: 100%;
        height: 100%;
        max-height: 100%;
    }
    .left-container {
        flex: 0 1 50%;
        min-height: 100%;
        max-width: 50%;
        margin: 0 10px;
    }
    .right-container {
        flex: 0 1 50%;
        display: flex;
        height: 100%;
        max-width: 50%;
        flex-wrap: wrap;
        align-items: flex-start;
        margin: 0 10px;
    }
    .half-containers {
        flex: 0 0 100%;
        max-height: 50%;
        min-height: 50%;
        max-width: 100%;
        overflow: hidden;
    }
</style>
<body>

<?php
require_once('vendor/autoload.php');
require_once('userProfile.php');
require_once('customLogger.php');
session_start();
$customerHashlist=array(
    'Ashley',
    'Bill',
    'Chris',
    'Dominic',
    'Emma',
    'Faizan',
    'Gimmy',
    'Harry',
    'Ian',
    'John',
    'King',
    'Lisa',
    'Mona',
    'Nina',
    'Olivia',
    'Pete',
    'Queen',
    'Robert',
    'Sarah',
    'Tierra',
    'Una',
    'Varun',
    'Will',
    'Xin',
    'You',
    'Zeba'
);

use vwo\VWO;
$account_id=123456;
$sdk_key='loremipsum123456';
$settings='';
if(isset($_GET['nocache']) && $_GET['nocache']==1){

    unset($_SESSION['settings']);
}
if(isset($_SESSION['settings'])){

    $settings=  $_SESSION['settings'];
}else{
    $settings=VWO::getSettingsFile($account_id,$sdk_key);
}

// object instead of many parameteres

// to check for empty schema



$config=['settingsFile'=>$settings,
    'isDevelopmentMode'=>0,
    //'logging'=>new CustomLogger(),
    //'userProfileService'=> new userProfile()
];


$vwoClient = new VWO($config);
$_SESSION['settings']=$vwoClient->settings;

$campaign_name='DEV_TEST_1';
$customer_hash=$customerHashlist[rand(0,9)];
// echo $varient=$vwoClient->activate($campaign_name,$customer_hash);
$varient=$vwoClient->getVariation($campaign_name,$customer_hash);
$goalIdentifier='CUSTOM';

//$w=$vwoClient->track($campaign_name,$customer_hash,$$goalIdentifier);
?>
<h2 class="center  color-blue">VWO PHP SDK Example</h2>
<div class="main-container">
    <div class="left-container">
        <h2 class="center  color-grey">Settings</h2>
        <pre><code><?php echo json_encode($settings, JSON_PRETTY_PRINT); ?></code></pre>
    </div>

    <div class="right-container">
        <div class="half-containers">
            <h2 class="center  color-grey">Details</h2>

            <div class="center  margin--top">
                <div>Campaign test key - <strong><?php echo $campaign_name; ?></strong></div>
            </div>
            <div class="center margin--top">
                <div>Campaign goal identifier - <strong><?php echo $goalIdentifier; ?></strong></div>
            </div>

            <div class="center  margin--top">
                <div>userId - <strong><?php echo $customer_hash; ?></strong></div>
            </div>

            <?php if ($varient!=null) { ?>
            <div class="center  margin--top">
                <div>variationAssigned - <strong><?php echo $varient ?></strong></div>
            </div>
            <?php } else { ?>
            <div class="center  margin--top">
                <div>did not become a part of campaign</div>
            </div>
            <?php } ?>
        </div>
        <div class="half-containers  center">
            <?php if ($varient == 'Control') { ?>
            <button class="v1">Control</button>
            <?php  } else if ($varient == 'Variation-1') { ?>
            <button class="v2">Variation 1</button>
            <?php } else if ($varient == 'Variation-2') { ?>
            <button class="v3">Variation 2</button>
            <?php } else{ ?>
            <button>Not part</button>
            <?php } ?>
        </div>
    </div>
</div>

</body>
</html>

