<?php

require_once "vendor/autoload.php"; 

use Rakit\Validation\Validator;
$db = new Photos\DB();
$validator = new Validator([
	'required' => ':attribute  обязатлен для заполнения!',
	'min' => ':attribute не менее 6 символов!',
	'max' => ':attribute не более 20 символов! '
]);;
$validation = $validator->make($_POST, [
    'login'                 => 'required|min:6|max:20',
    'password'              => 'required|min:6|max:20',
    'name'                  => 'required|min:6|max:20',
]);
// $validation_a->setMessages([
// 	'age:min' => '18+ only',
// ]);
$validation->validate();

if ($validation->fails()) {
    $errors = $validation->errors();
    header("Location: user.php?sign_error=" . $errors->all()[0]);
} else {
    $db->new_user($_POST["login"], $_POST["password"], $_POST["name"]);
    header("Location: user.php?sign_success=ok");
}
// composer require rakit/validation 
