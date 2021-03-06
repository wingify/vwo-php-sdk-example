<?php session_start(); ?>
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
<div>
  <h2 class="center  color-blue">VWO PHP SDK Example</h2>
  <div class="main-container">
    <h3>Hey there, what would you like to experiment?</h3>

    <div>
      <ul c;ass="margin--top">
        <li><a href="src/ab.php">A/B Test</a></li>
        <li><a href="src/feature_rollout.php">Feature Rollout</a></li>
        <li><a href="src/feature_test.php">Feature Test</a></li>
        <li><a href="src/push.php">Push API</a></li>
      </ul>
    </div>
  </div>
</div>

</body>
</html>
