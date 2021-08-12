<?php

require_once __DIR__ . '/GoGetSSLApi.php';

define('GOGETSSL_API_USER', '***@you-mail.com');
define('GOGETSSL_API_PASS', '***************');


$csr = <<<csr
-----BEGIN CERTIFICATE REQUEST-----
MIICzjCCAbYCAQAwgYgxCzAJBgNVBAYTAkxWMQ0wCwYDVQQIDARSaWdhMQ0wCwYD
VQQHDARSaWdhMRAwDgYDVQQKDAdJVCBSaWdhMQswCQYDVQQLDAJJVDEXMBUGA1UE
AwwOdGVzdC5pdHJpZ2EubHYxIzAhBgkqhkiG9w0BCQEWFGFkbWluQHRlc3QuaXRy
aWdhLmx2MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA+Uhrr+r/nXw1
u/RNc6JNalwuSXTl4eS2kpZK6rrHo4NlhIDjJVEwAnWu5Fu49tMQjrhT8mZOHCFx
xXlcRQgwjLtzrtopc06Hv92gkzfVBIj+h5e4a/je1zyqvJm3ckMPGtW9FBdpXdx0
BbNsKPsjrbRQgVTDZMVNgSNUgtEu5/UU1bR0CYhZby1t6kE7z2fqmLAXCeHuOk4s
3r5KkwXO3fMx41JdqGcktoWzdNk4uTIPNSIqA9Z0P1+J2LMtXsZlhqe3EbL+bqAr
+qqc+9rC55pcfK11M61j8p4WlA0pe9LmGtSX7TyESGUjLyJGr14mEf8E1Xlrha9F
lkDnbmgfKQIDAQABoAAwDQYJKoZIhvcNAQELBQADggEBADQP/0qfE1IMGfXqX263
xzNa9mwCyrYp3QfgcmcT7so7YYtKYzFzOmBJ5tzyPweM1rF53R4YizMvxqFLtQGa
HhEG2AFbEQ/IrpPFQUFz1aDSnJSUjwX8WV2DxXCxOX809JSlLqmK73nwTkgnd25y
8vr00fd9lohQpCp+JSDvN4r/f9ETkC8ulZChPQ5BHPiPZSPitI9opPxQ3CHnuU/5
J0bm5eeXYLMcqkyb9heJl7B0WcEHZeJBsBKVtA5rc53Qk6IWaYN/sHeTuD1J4gx1
x+Ta8HiJomfe713ugPUc78Zco8W2saed5oaWyudx9w/xwyQ7pBBBF5YOoSxdNEz/
bo0=
-----END CERTIFICATE REQUEST-----
csr;


$data = [
    'product_id'       => 65,
    'csr'              => $csr,
    'server_count'     => "-1",
    'period'           => 3,
    'approver_email'   => "admin@domain.tld",
    'webserver_type'   => "1",
    'admin_firstname'  => "John",
    'admin_lastname'   => "Silver",
    'admin_phone'      => "003719999999",
    'admin_title'      => "Mr",
    'admin_email'      => "webmaster@domain.tld",
    'tech_firstname'   => "John",
    'tech_lastname'    => "Silver",
    'tech_phone'       => "003719999999",
    'tech_title'       => "Mr",
    'tech_email'       => "webmaster@domain.tld",
    //'dns_names' => "domain.tld,domain2.tld,domani3.tld",
    'org_name'         => "Some Company",
    'org_division'     => "Hosting",
    'org_addressline1' => "Street 123",
    'org_city'         => "Riga",
    'org_country'      => "LV",
    'org_phone'        => "3799999999",
    'org_postalcode'   => "LV-1056",
    'org_region'       => "None",
    'dcv_method'       => "dns",
    'only_validate'    => true   // <-- Remove to place a real order
];

try {

    $apiClient = new GoGetSSLApi();
    $token = $apiClient->auth(GOGETSSL_API_USER, GOGETSSL_API_PASS);
    $newOrder = $apiClient->addSSLOrder($data);

    print_r($newOrder);

} catch (Exception $e) {
    printf("%s: %s", get_class($e), $e->getMessage());
}
