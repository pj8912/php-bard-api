# php-bard-api

<p align="left">
<a><img alt="composer bard package" src="https://img.shields.io/badge/composer-BardAPI-default"></a>
<a><img alt="bard api"  src="https://img.shields.io/badge/BardAPI-default"></a>
<a><img alt="composer version"  src="https://img.shields.io/badge/composer-2.2.6-orange"></a>
</p>

> A package that returns Response of Google Bard through API

## Install
 ```
 composer require pj8912/php-bard-api:dev-main
 ```

## Get Your Key
Follow the [gif](https://github.com/dsdanielpark/Bard-API/blob/main/assets/bard_api.gif) to get your key

 ## Use
 ```php
require_once 'vendor/autoload.php';
use Pj8912\PhpBardApi\Bard;
$_ENV['_BARD_API_KEY'] = "Your Key";
$bard = new Bard();
$input_text = "Hello, Bard!";  // Input text for the conversation
$result = $bard->get_answer($input_text);  // Get the response from Bard
// Access the result data
$conversation_id = $result["conversation_id"];
$response_id = $result["response_id"];
$factualityQueries = $result["factualityQueries"];
$textQuery = $result["textQuery"];
$choices = $result["choices"];
// reply
$content = $result["content"];
print($content);
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