<?php
define('LOGIN_URL', 'http://www.root-me.org/spip.php?page=login&lang=fr&ajax=1');
define("COOKIE_FILE", ".rootme_cookie.txt");

/**
 * Urlify an array into a string
 * @param $fields : array, data
 * @return $fields_string : string, data to send
 */
function urlify($fields = array())
{
	$fields_string = '';

	foreach($fields as $key=>$value)
	{ 
		$fields_string .= $key.'='.$value.'&'; 
	}
	rtrim($fields_string, '&');

	return $fields_string;
}

/**
 * GET request to url
 * @param $url : string, url to get
 * @return $result : string, data received
 */
function get_request($url)
{
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt ($curl, CURLOPT_COOKIEJAR, COOKIE_FILE);
	curl_setopt( $curl, CURLOPT_COOKIEFILE, COOKIE_FILE );

	$result = curl_exec($curl);
	curl_close($curl);

	return $result;
}

/**
 * POST request to url
 * @param $url : string, url to get
 * @param $fields : array, data to send
 * @return $result : string, data received
 */
function post_request($url, $fields)
{
	$fields_string = urlify($fields);
	$curl = curl_init($url);
	curl_setopt($curl,CURLOPT_URL, $url);
	curl_setopt($curl,CURLOPT_POST, count($fields));
	curl_setopt($curl,CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt ($curl, CURLOPT_COOKIEJAR, COOKIE_FILE);
	curl_setopt( $curl, CURLOPT_COOKIEFILE, COOKIE_FILE );
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$result = curl_exec($curl);
	curl_close($curl);
	return $result;
}

/**
 * Retreived the form_action_args token
 * @param $html : string, html content
 * @return string, form_action_args token
 */
function parse_form_action_args($html)
{
	$pattern = "/<input name='formulaire_action_args' type='hidden'
value='(.)+'/";
	preg_match($pattern, $html, $match);
	$match = explode('=', $match[0]);

	return trim($match[3], "'");
}

/**
 * Retreived the user_info
 * @param $login : string, username
 * @return array, user_infos
 */
function get_info_user($login)
{
	$fields = [
	'page' => 'informer_auteur',
	'var_login' => $login,
	'var_compteur' => time()
	];
	$fields_string = urlify($fields);
	$result = get_request("http://www.root-me.org/spip.php?".$fields_string);
	return json_decode($result, 'true');
}

/**
 * Hash the password
 * @param $user_infos : array
 * @return $password : string
 * @return string, the hashed password
 */
function gen_password($user_infos, $password)
{
	$res =  hash("sha256", $user_infos['alea_actuel'].$password).';';
	$res .= hash("sha256", $user_infos['alea_futur'].$password).';';
	$res .= md5($user_infos['alea_actuel'].$password).';';
	$res .= md5($user_infos['alea_futur'].$password);
	$res = "{".$res."}";

	return $res;
}

/**
 * Try to log in the user
 * @param $token : string, form_action_args
 * @param $login : string, username
 * @param $password : string, hashed password
 * @return $result : string, data received
 */
function connexion($token, $login, $password)
{
	$url = LOGIN_URL;
	$fields = array(
		'var_ajax' => 'form',
		'page' => 'login',
		'lang' => 'fr',
		'ajax' => 1,
		'formulaire_action' => 'login',
		'formulaire_action_args' => urlencode($token),
		'var_login' => $login,
		'password' => urlencode($password)
	);
	$result = post_request(LOGIN_URL, $fields);
	return $result;
}

function input_login()
{
	echo "Login : ";
	return rtrim(fgets(STDIN));
}

function input_password()
{
	echo "Password : ";
	shell_exec('stty -echo');
	$pass = rtrim(fgets(STDIN));
	shell_exec('stty echo');
	echo "\n";

	return $pass;
}

if (file_exists(COOKIE_FILE))
	unlink(COOKIE_FILE);

echo "=======================================\n";
echo "# Root-me login script by NeedToLearn #\n";
echo "=======================================\n";
$LOGIN = input_login();
$PASSWORD = input_password();

$html = get_request(LOGIN_URL);
$token = parse_form_action_args($html);
$user_infos = get_info_user($LOGIN);
$password = gen_password($user_infos, $PASSWORD);
$result = connexion($token, $LOGIN, $password);

if (strpos($result, "Vous êtes enregistré"))
{
	echo "[+] Login Success\n";
	$result = get_request("http://www.root-me.org/?page=news&lang=fr");
	if (strpos($result, "Se déconnecter"))
	{
		echo "[+] Connected to spip\n";
		echo "Have a good fl4g !!!\n";
	}
	else
		echo "[-] Spip connection failed\n";
}
else
	echo "[-] Login Failed\n";
