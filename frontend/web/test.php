<?php
$params =
    [
        'domain_name' => 'freelemur.com',
        'dname'        => 'freelemur.com',
        'input_format' => 'plain',
        'username'     => 'anatoliysmirnov79@yandex.ru',
    ];

$sig_params = $params;
sort($sig_params);
$pkeyid = openssl_pkey_get_private("file:///home/developer/reg.ru/api.key");
openssl_sign( implode(';', $sig_params), $sig, $pkeyid );

$params['sig'] = base64_encode($sig);
$endpoint = 'https://api.reg.ru/api/regru2/get_service_id';
$url = $endpoint . '?' . http_build_query($params);
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_SSLCERT, "/home/developer/reg.ru/api.crt");
curl_setopt($curl, CURLOPT_SSLKEY, "/home/developer/reg.ru/api.key");
curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);

$result = curl_exec($curl);
curl_close($curl);
$result = json_decode(urldecode($result),true);
echo "\n";
print_r($result);
echo "\n";