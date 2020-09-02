<?php


// $password = "e583799b852467HWeirdWords7f0cb11ca3c3";
// e583799b-f7c2-411c-b704-7f0cb11ca3c3
$password = "e583799b852467HWeirdWords7f0cb11ca3c3";

$hash_variable_salt = password_hash($password,
    PASSWORD_DEFAULT, array('cost' => 9));

echo $hash_variable_salt;
echo "\n";

echo password_verify('e583799b852467HWeirdWords7f0cb11ca3c3',
    $hash_variable_salt );

echo "\n";

// {"Request": {"SignUp":{"name":"Tangani","surname":"Pindi","email":"tanganimoyo@gmail.com","username":"Tangani","password":"891234SomewhereElse"}}}
// 42c21821-9708-4157-b060-370f29a2ee68

// {"Request": {"SignUp":{"name":"Molisa","surname":"Moyo","email":"moyomolisa@yahoo.com","username":"Molisa","password":"$2y$09$D02OdWokcieao2Qh.tfodONQDf0riUcKrjGDsct.lLPDf5guDfxGy"}}}

// {"Request": {"SignUp":{"name":"Taken","surname":"Hleka","email":"someBody@yahoo.com","username":"Nono","password":"e583799b852467HWeirdWords7f0cb11ca3c3"}}}
