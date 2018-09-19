<?php

function array_empty($data){
    foreach($data as $k => $v)
        if(empty($v))
            return false;
    return true;
}

function BeHash($ghu){
	return md5(sha1('erdj18yt'.$ghu.'g14dhy7d'));
}

function generate_password($size)
{
    // Initialisation des caractères utilisables
    $characters = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
    $password = '';
    for($i=0;$i<$size;$i++)
    {
        $password .= ($i%2) ? strtoupper($characters[array_rand($characters)]) : $characters[array_rand($characters)];
    }
		
    return $password;
}

function Secure($string, $mode = false) {
    if($mode=="editor") {
        return str_replace(array("<script>", "</script>"), array("&lt;script&gt;", "&lt;/script&gt;"), addslashes(trim($string)));
    } else {
        return htmlspecialchars(htmlspecialchars_decode(trim($string), ENT_QUOTES), ENT_QUOTES);
    }
}

function Secure_array($array, $mode = false){
    $data = '';
    $array_new = array();

    foreach($array as $key => $value){

        if($mode == false){
            $value = Secure($value);
        }else{
            $value = Secure($value, 'editor');
        }

        $array_new[$key] = $value;
    }

    return $array_new;
}