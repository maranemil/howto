
```

################################################################################
The Authorization Code Grant is the most common authorization flow in OAuth2.
https://portal.test.datev.pdicloud-test.azure-k8s.haufe.io/help/oauth2_authorization_code
################################################################################

http://your.application.com/oauth2/callback?code=(authorization code)

curl -X POST -d 'grant_type=authorization_code&client_id=(your client id)&client_secret=(your client secret)&code=(authorization code)' https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/auth/(auth method id)/api/(api id)/token

{
  "access_token": "(access token)",
  "refresh_token": "(refresh token)",
  "token_type": "bearer",
  "expires_in": 3600
}

Refreshing the Access Token (confidential clients)

curl -X POST -d 'grant_type=refresh_token&client_id=(your client id)&client_secret=(your client secret)&refresh_token=(refresh token)' https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/auth/(auth method id)/api/(api id)/token

Accessing the API

curl -H 'Authorization: Bearer (access token)' https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/(api endpoint)

Refreshing the Access Token (native/mobile)
curl -X POST -d 'grant_type=refresh_token&client_id=(your client id)&refresh_token=(refresh token)' https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/auth/(auth method id)/api/(api id)/token
```

```

################################################################################
HTTP Client in PhpStorm Overview
################################################################################
https://blog.jetbrains.com/phpstorm/2019/11/http-client-in-phpstorm-overview/
https://www.youtube.com/watch?v=n8KCuKhDSZY
https://www.jetbrains.com/help/phpstorm/exploring-http-syntax.html#use-multipart-form-data
https://www.jetbrains.com/help/phpstorm/http-client-in-product-code-editor.html#converting-curl-requests
```


```

################################################################################
openssl decrypt encrypt  
################################################################################

https://www.php.net/manual/de/function.openssl-decrypt.php
https://www.php.net/manual/de/function.openssl-encrypt.php
https://stackoverflow.com/questions/51715376/php-warning-openssl-decrypt-iv-passed-is-32-bytes-long-which-is-longer-than
https://www.codegrepper.com/code-examples/whatever/openssl_decrypt%28%29%3A+IV+passed+is+16+bytes+long+which+is+longer+than+the+8+expected+by+selected+cipher%2C+truncating+in+BF-CBC
https://github.com/poweradmin/poweradmin/issues/353
https://stackoverflow.com/questions/28131574/hex2binvar-error-input-string-must-be-hexadecimal-string
https://www.php.net/manual/de/function.hex2bin.php
https://stackoverflow.com/questions/34871579/how-to-encrypt-plaintext-with-aes-256-cbc-in-php-using-openssl/34871988
https://www.php.net/manual/de/function.openssl-decrypt.php
https://hotexamples.com/de/examples/-/-/openssl_decrypt/php-openssl_decrypt-function-examples.html
https://github.com/ccxt/ccxt/issues/6307

--------------------------------------------------------------------------------

$textToEncrypt = "My super secret information.";
$encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
$secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($encryptionMethod));

//To encrypt
$encryptedMessage = openssl_encrypt($textToEncrypt, $encryptionMethod, $secretHash,0,$iv);

//To Decrypt
$decryptedMessage = openssl_decrypt($encryptedMessage, $encryptionMethod, $secretHash,0,$iv);

//Result
echo "Encrypted: $encryptedMessage <br>Decrypted: $decryptedMessage";
echo "<hr>";

--------------------------------------------------------------------------------

$key = hex2bin('5ae1b8a17bad4da4fdac796f64c16ecd');
$plaintext = "zu verschlüsselnde Nachricht";
$cipher = "aes-256-cbc";

if (in_array($cipher, openssl_get_cipher_methods()))
{
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv);
echo "<br>Encrypted: ".$ciphertext."\n";
    $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv);
echo "<br>Decrypted:".$original_plaintext."\n";
}

--------------------------------------------------------------------------------

https://www.php.net/manual/en/function.hash-pbkdf2.php
https://stackoverflow.com/questions/16600708/how-do-you-encrypt-and-decrypt-a-php-string
https://www.php.net/manual/en/function.openssl-encrypt.php
https://stackoverflow.com/questions/9262109/simplest-two-way-encryption-using-php

--------------------------------------------------------------------------------

/*
$password ="546614";
const MY_PBKDF2_SALT = 3;
function getKeyFromPassword($password, $keysize = 16)
{
    return hash_pbkdf2(
        'sha256',
        $password,
        MY_PBKDF2_SALT,
        100, // Number of iterations
        $keysize,
        true
    );
}
echo getKeyFromPassword($password);
*/

--------------------------------------------------------------------------------

$string_to_encrypt="Test";
$password="password";

$encrypted_string=openssl_encrypt($string_to_encrypt,"AES-128-ECB",$password);
echo "<br>".$encrypted_string;

$decrypted_string=openssl_decrypt($encrypted_string,"AES-128-ECB",$password);
echo "<br>".$decrypted_string;

```

```
################################################################################
camelCaseKeys convertor   
################################################################################

// WARNING Function create_function() is deprecated on line number 18
// https://stackoverflow.com/questions/48161526/php-7-2-function-create-function-is-deprecated
// https://stackoverflow.com/questions/48161526/php-7-2-function-create-function-is-deprecated
// https://stackoverflow.com/questions/31274782/convert-array-keys-from-underscore-case-to-camelcase-recursively
// https://localcoder.org/convert-array-keys-from-underscore-case-to-camelcase-recursively


// http://phptester.net/
// https://gist.github.com/goldsky/3372487

$arr = [
    "salutation"=> "",
    "first_name"=> "Frankfurt",
    "last_name"=> "Heinemann"
];


function camelCaseKeys($array, $arrayHolder = array()) {
    $camelCaseArray = !empty($arrayHolder) ? $arrayHolder : array();
    foreach ($array as $key => $val) {
        $newKey = @explode('_', $key);       
        array_walk(
            $newKey,
            function(&$v){return $v = ucwords($v);});                   
                $newKey = @implode('', $newKey);
                $newKey[0] = strtolower($newKey[0]);
                if (!is_array($val)) {
                    $camelCaseArray[$newKey] = $val;
                } else {
                    $camelCaseArray[$newKey] = $this->camelCaseKeys($val, $camelCaseArray[$newKey]);
                }
            }
            return $camelCaseArray;
        );
    }
}

print "<pre>";
print_r(camelCaseKeys($arr));

Array
(
    [salutation] =>
    [firstName] => Frankfurt
    [lastName] => Heinemann
)

```