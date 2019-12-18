## VWO PHP SDK Example

[vwo-php-sdk](https://github.com/wingify/vwo-php-sdk) allows you to A/B Test your Website at server-side.

This repository provides a basic demo of how server-side works with VWO PHP SDK.

### Requirements

- PHP 5.6.0 or later

### Documentation

Refer [VWO Official Server-side Documentation](https://developers.vwo.com/reference#server-side-introduction)

### Scripts

1. Install dependencies

```
composer install
```

2. Update configuration based on your setup inside `config.php`

```php
const ACCOUNT_ID = '';
const SDK_KEY = '';

const AB_CAMPAIGN_KEY = '';
const AB_CAMPAIGN_GOAL_IDENTIFIER = '';

const FEATURE_ROLLOUT_CAMPAIGN_KEY = '';
const FEATURE_TEST_CAMPAIGN_KEY = '';

const TAG_KEY = '';
const TAG_VALUE = '';
```

3. Run application

```
php -S localhost:1112 -t .

//open url without setttings-file being cached
http://localhost:1112

//open url with setttings-file being cached
http://localhost:1112?cache=1
```

4. For development

```
composer run-script start
```

## License

[Apache License, Version 2.0](https://github.com/wingify/vwo-php-sdk-example/blob/master/LICENSE)

Copyright 2019 Wingify Software Pvt. Ltd.
