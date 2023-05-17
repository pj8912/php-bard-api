# php-bard-api
Bard API built using PHP

## Install
 ```
 composer require pj8912/php-bard-api
 ```
 ## Use
 ```
  <?php

 $_ENV['_BARD_API_KEY'] = "Your Key";
$bard = new Bard();
$input_text = "Hello, Bard!";  // Input text for the conversation
$result = $bard->get_answer($input_text);  // Get the response from Bard
// Access the result data
$content = $result["content"];
print($content);
?>
```