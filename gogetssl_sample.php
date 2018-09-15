<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

if(isset($_GET['class']))
{
  highlight_file('./GoGetSSLApi.php');
  die;
}

if(isset($_GET['source']))
{
  highlight_file(__FILE__);
  die;
}

require './GoGetSSLApi.php';

echo '<pre>';
$api = new GoGetSSLApi();

/*******************************************
 * Authentication                          *
 *******************************************/
$authKey = $api->auth('user@domain.com', 'password' );

printResponse( $authKey );

$key = $authKey['key'];
$api->setKey($key);

/*******************************************
 * Account Methods                         *
 *******************************************/
/*
    printResponse($api->getAccountBalance());
    printResponse($api->getAccountDetails());
    printResponse($api->getTotalOrders());
    printResponse($api->getTotalTransactions());
    printResponse($api->getAllInvoices());
    printResponse($api->getUnpaidInvoices());
*/

/*******************************************
 * Product Methods                         *
 *******************************************/
/*
    printResponse($api->getAllProductPrices());
    printResponse($api->getProductPrice('58'));
    printResponse($api->getProductDetails('56'));
    printResponse($api->getUserAgreement('53'));
    printResponse($api->getAllProducts());
*/

/*******************************************
 * Product Methods                         *
 *******************************************/
/*
    printResponse($api->getOrderInvoice(1));
    printResponse($api->getOrderStatus(1));
*/

$simpleCsr = "-----BEGIN CERTIFICATE REQUEST-----
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
-----END CERTIFICATE REQUEST-----";

$sanCsr = "-----BEGIN NEW CERTIFICATE REQUEST-----
MIIE3jCCA8YCAQAwezEbMBkGA1UEAwwSZXBvc3QudGVycmFob3N0Lm5vMRAwDgYD
VQQLDAdIb3N0aW5nMRUwEwYDVQQKDAxUZXJyYUhvc3QgQVMxEzARBgNVBAcMClNh
bmRlZmpvcmQxETAPBgNVBAgMCFZlc3Rmb2xkMQswCQYDVQQGEwJOTzCCASIwDQYJ
KoZIhvcNAQEBBQADggEPADCCAQoCggEBALI6FzsYt9BkVnNINoqjL5EuTVBupc3g
LBp/af2yR4oXP50Mm1mRl6oL+uWUG+jrU19FzIeuaDpcXNii46xib+Q1PqV4nw9t
hmTLbo/+R8pD+A7KjPX/sPYXzKlDXJFFPc97IH7nMzMbm+8BDKQ7I82uO6goduTz
M79VgA4KO5vQzQyBhNgKRt88V8vmlSGTg7IwPfqrVCz6VPIh9QlVqcH9nMPKkXfA
C9kzUjENLaRx6VF9nGbRFmaVZ5aLrFN3b5cKjLUNrM5GL3ZYEg1piQnv62MfZXTY
jZvbOIswH39wMdBHrVa9z5p3VpkBv2MgFOOnuX4frww88s6j+6t4GNUCAwEAAaCC
AhwwGgYKKwYBBAGCNw0CAzEMFgo2LjEuNzYwMC4yMGUGCSsGAQQBgjcVFDFYMFYC
AQUMGEVYQ0hBTkdFMTEuSG9zdGluZy5sb2NhbAwTSE9TVElOR1xFWENIQU5HRTEx
JAwiTWljcm9zb2Z0LkV4Y2hhbmdlLlNlcnZpY2VIb3N0LmV4ZTByBgorBgEEAYI3
DQICMWQwYgIBAR5aAE0AaQBjAHIAbwBzAG8AZgB0ACAAUgBTAEEAIABTAEMAaABh
AG4AbgBlAGwAIABDAHIAeQBwAHQAbwBnAHIAYQBwAGgAaQBjACAAUAByAG8AdgBp
AGQAZQByAwEAMIIBIQYJKoZIhvcNAQkOMYIBEjCCAQ4wDgYDVR0PAQH/BAQDAgWg
MIHOBgNVHREEgcYwgcOCGGV4Y2hhbmdlMTAuaG9zdGluZy5sb2NhbIIYZXhjaGFu
Z2UxMS5ob3N0aW5nLmxvY2FsghhleGNoYW5nZTEyLmhvc3RpbmcubG9jYWyCEmVw
b3N0LnRlcnJhaG9zdC5ub4IaYXV0b2Rpc2NvdmVyLkhvc3RpbmcubG9jYWyCGWF1
dG9kaXNjb3Zlci50ZXJyYWhvc3Qubm+CFHdlYm1haWwudGVycmFob3N0Lm5vghJy
ZHdlYi50ZXJyYWhvc3Qubm8wDAYDVR0TAQH/BAIwADAdBgNVHQ4EFgQUUFjhH9zg
Wv7653OTjMs+M9kv8rswDQYJKoZIhvcNAQEFBQADggEBACYn6gn/Px73zIjTFaPl
d3bq6yktzxclAMad1EKnipUWBTRJA4XWGUu5QznuNYAENUH9qlCMnjjpin5aQqyU
rexBkBq7pYzAYLRRawKEegnnu2cfedKCwzPJE9QKPsNC4ppUOmXMAsQZKW/SoKSb
vyaiHi8CtusmEif6EBOrK9Hx/JtJ/vVsPmzRidC0KUq6eu8285pJDdKVppsV2Fk3
gvPESz1qz12fUStHLz3JSnuID/s5AcjE9rVf/K74WHLtG6gCYPlCz19dw/mS8NsZ
jyW01Sxt+n4sIfB8GuqpeHiFfHtRxEQm2Us5o2dGt+RRubagibodQYiB0skiDGXT
Org=
-----END NEW CERTIFICATE REQUEST-----";

$errorCSR = "-----BEGIN CERTIFICATE REQUEST-----
MIIC0TCCAbkCAQAwgYsxCzAJBgNVBAYTAlVBMQ8wDQYDVQQIDAZPREVTU0ExDzAN
BgNVBAcMBk9ERVNTQTESMBAGA1UECgwJSU5URUggTFREMQswCQYDVQQLDAJJVDEY
MBYGA1UEAwwPVmFkeW0gUG9saXNjaHVrMR8wHQYJKoZIhvcNAQkBFhBzZXJ2aWNl
QGludGVoLnVhMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAx/jTdQIl
FzmwZ6kTIvEWGWsOvAOzSUQrOwC72LAZC4WfU1iGliT9DBW1IjrnKYbyUHkaxNC2
MwxGHMRpmQF7KTRtSu6CS0BirpeeVOpOrIxNzxLRH79DFFr1YGlQXpCNzcPlpzj3
eBWvV9UnH96gkrU6dQrg5YyL+b+nhGwQ/1NL8KQQbkW7rJnK26mzsqAo55ojqrDG
/4wv1zGGom15oW813TjFGnaDcHSurZPbMl4ElvCFY5ZT07WsukSSzcSUOHmKEaLa
FzC5lLZWUF1CSI2rpX88ky9G7CHdi86a4YdFR3vxr1OC5uZ4JWvQ039/DWeejSdm
t6PG1l/2xUpLqwIDAQABoAAwDQYJKoZIhvcNAQEFBQADggEBADeZS7iKCDBXRXsG
7NVLQ7T7x7ymO8dU3PREmBFPMFmTwWxJeaCnyaNwfSxcLlAoIHDIK7kAReVswOBW
Qp4hsdSMNAYuA0SkmJaOUHbKZY4+/na/zyecuYbEhH3uibBFu1Ir4Dw062oIlRRX
syYwvTUlZUEJMlNnfs/zv3CxVNGyU/wfGKKQ4W0wzUJuOr/IpbYmh87vf4YGXMbw
xHwBx650Dp/MDsbYPOYsdKMToy5SJ93Qbnn7o1AUwNnAlf3f/kkP1fY2d7j7He7Q
zv81Wij/SubkVF5X2dlWFBf4G2vcCHKeX7WBy2stNgh3P+FqtrLLBgW5YP0R5OU3
pgzxBb8=
-----END CERTIFICATE REQUEST-----";

$wildcardCSR = "-----BEGIN CERTIFICATE REQUEST-----
MIIC2TCCAcECAQAwgZMxCzAJBgNVBAYTAkJZMQ4wDAYDVQQIDAVNaW5zazEOMAwG
A1UEBwwFTWluc2sxGDAWBgNVBAoMD0JlbGluZm9uZXQgTHRkLjETMBEGA1UECwwK
VGVjaCBEZXB0LjESMBAGA1UEAwwJKi5hZHNsLmJ5MSEwHwYJKoZIhvcNAQkBFhJw
ZXRlckBjb3JwLmFkc2wuYnkwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIB
AQDUFTX9P6TEe6vavMjWMOlamI32/FRe0kKTotQDS9PuN+r+hcks8hiQN/6jPL4H
D6bDXhvdBdyx9atXVG/xVmHLT0RBSWCgNyHCH2NmoaAQXFrOWU5XZD7TvON0qf3a
fesU7dV0ysYYuMVcIjGlG7U5pjz/6Nqs/CtQeie/wYWNixG08dgRczHfvotr7AkW
gc9uvAK+caMCEQbFpqsu9CTbKCgM/CPPEgQspPQjVJDLWG3lZ2m4nkUNPDX13QXz
XfKg9Z71Z9Ms0XCTeZEs1vD3g9m7S4SEcmiLIE8eLWy5822ZiEj/ju4x5NXyZCMs
vwd0vUNz56oDmKaOqpYJXiCTAgMBAAGgADANBgkqhkiG9w0BAQUFAAOCAQEAZtil
3JckBov6z3n/3mjBON+PW03ksGgW3pY4+NCrYis0zn+GZSiHw8o2r+zDWp710PY3
cOKKLC/6mGRa2hDa+g74PCBmIQ4JyQ/lNOU4Imr6J2leZrhUZvtbNpVG0s3Rb1jh
IiEujtqrP7qAVVh1wdRoKDLJb1LrbMasc9H8O+bW54/JaLYJlgrM22dDKChfJyfT
DN5qrXjm3Kj+c0tDzkTkRX6oentXjmQ+jT1cYXppPDPzmNWYTgHMbvlOAndbz+0x
q5Etn2XmauzvLEkc3S36qPyma5LunBmg12I+ByyBoVM5QGrhWUJeC5oHFvmEEgUx
AQKddq+25dTdNU684Q==
-----END CERTIFICATE REQUEST-----";

$data = array(
        'csr' => $wildcardCSR
);

$data = array(
        'product_id'       => 45,
        'csr'              => $simpleCsr,
        'server_count'     => "-1",
        'period'           => 12,
        'approver_email'   => "admin@test.itriga.lv",
        'webserver_type'   => "1",
        'admin_firstname'  => "Aleksander",
        'admin_lastname'   => "Andrijenko",
        'admin_phone'      => "0037128216269",
        'admin_title'      => "Mr",
        'admin_email'      => "admin@test.itriga.lv",
        'tech_firstname'   => "Aleksander",
        'tech_lastname'    => "Andrijenko",
        'tech_phone'       => "0037128216269",
        'tech_title'       => "Mr",
        'tech_email'       => "admin@test.itriga.lv",
        //'dns_names' => "domain.lv,domain2.lv,domani3.lv",
        'org_name'         => "AlexoMedia",
        'org_division'     => "Hosting",
        'org_addressline1' => "Valdeku street 55",
        'org_city'         => "Riga",
        'org_country'      => "LV",
        'org_phone'        => "37128216269",
        'org_postalcode'   => "LV-1056",
        'org_region'       => "None",
        'dcv_method'       => "dns",
        'only_validate'    => true   // <-- Remove to place a real order
);

// printResponse( $api->addSSLRenewOrder( $data ) );
$output = $api->addSSLOrder( $data );

echo '------------------------------------------------' . PHP_EOL;
  var_dump( $output );
echo '------------------------------------------------' . PHP_EOL;

// printResponse( $api->getUnpaidOrders() );
$data = array(
        'org_name'         => "AlexoMedia",
        'org_division'     => "Hosting",
        'org_addressline1' => "Valdeku street 55",
        'org_city'         => "Riga",
        'org_country'      => "LV",
        'org_phone'        => "37128216269",
        'org_postalcode'   => "LV-1056",
        'org_duns'         => "1838839939939",
        'org_region'       => "None",
);

/*******************************************
 * Other Methods                           *
 *******************************************/
/*
   1 - comodo
   2 - verisign/geotrust/thawte
*/
// printResponse($api->getWebServers(2));
// printResponse($api->getDomainEmails("domain.com"));
// printResponse($api->decodeCSR($wildcardCSR,2,1));
// printResponse($api->comodoClaimFreeEV(322, $data));

function printResponse($response)
{
    global $api;

    if($response)
    {
        print_r($response);
    }
    else
    {
        print_r($api->getLastResponse());
    }
}
