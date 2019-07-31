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

2. Update your app with your accountId, sdk-key, campaign-test-key and goal-identifier

```text
$campaignTestKey = 'REPLACE_THIS_WITH_CORRECT_VALUE';
$goalIdentifeir = 'REPLACE_THIS_WITH_CORRECT_VALUE';
$accountId = 'REPLACE_THIS_WITH_CORRECT_VALUE';
$sdkKey = 'REPLACE_THIS_WITH_CORRECT_VALUE';

```

3. Run application

```
php -S localhost:1112 -t .
```

### LICENSE

```text
    MIT License

    Copyright (c) 2019 Wingify Software Pvt. Ltd.

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
```
