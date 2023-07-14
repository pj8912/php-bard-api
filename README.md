# php-bard-api

<p align="left">
<a><img alt="composer bard package" src="https://img.shields.io/badge/composer-BardAPI-default"></a>
<a><img alt="bard api"  src="https://img.shields.io/badge/BardAPI-default"></a>
<a><img alt="composer version"  src="https://img.shields.io/badge/composer-2.2.6-orange"></a>
</p>

> A package that returns Response of Google Bard through API

## Install
 ```
 composer require pj8912/php-bard-api
 ```

## Get Your Keys
- Open [bard.google.com](https://bard.google.com/)
- Open developer tools, click `Application` tab
- In Application under the `Storage` you will find `cookies` dropdown
- Under cookies click on `https://bard.google.com` which will show you all the cookies being used as `Name` and `Value`
- Copy the values the cookies`__Secure-1PSID` and `__Secure-1PSIDTS`

 ## Run
 ```php
require_once 'vendor/autoload.php';
use Pj8912\PhpBardApi\Bard;
//two keys are required which are two cookies values
$_ENV['BARD_API_KEY_X'] = " value of cookie '__Secure-1PSID' ";
$_ENV['BARD_API_KEY_Y'] = " value of cookie '__Secure-1PSIDTS' "
$bard = new Bard();
$input_text = "Hello, Bard!";  // Input text for the conversation
$result = $bard->get_answer($input_text);  // Get the response from Bard

// bard reply
print($result['choices'][0]['content'][0]);

```
## License
This project is licensed under the [MIT](https://opensource.org/license/mit/)  License

## Reference
- [dsdanielpark/Bard-API](https://github.com/dsdanielpark/Bard-API)

### Important Notice
The user assumes all legal responsibilities associated with using the BardAPI package. This PHP package merely facilitates easy access to Google Bard for developers. Users are solely responsible for managing data and using the package appropriately. For further information, please consult the Google Bard Official Document.


## :handshake: Support
Hello there! If you've found my work helpful or useful in any way, please consider supporting me by donating. Your support helps me continue to create and share useful projects with the community. Thank you for your generosity and support! :handshake:

<p align="center"><a href="https://www.buymeacoffee.com/gjohnpinto" target="_blank" align="center"><img src="https://cdn.buymeacoffee.com/buttons/v2/default-yellow.png" alt="Buy Me A Coffee" style="height: 60px !important;width: 217px !important;" ></a></p>
