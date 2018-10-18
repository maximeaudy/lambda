<?php

function array_not_empty($data){
    foreach($data as $k => $v)
        if(empty($v))
            return false;
    return true;
}

function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = '1rtyj8uyj854ryj8jytr';
    $secret_iv = '5rty646r8tyjjryjr187t';
    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 1) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } elseif($action == 2) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
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
        return str_replace(array("<script>", "</script>"), array("&lt;script&gt;", "&lt;/script&gt;"), trim($string));
    } else {
        return htmlspecialchars(htmlspecialchars_decode(trim($string), ENT_QUOTES), ENT_QUOTES);
    }
}

function Secure_array($array, $mode = false){
    $array_new = array();

    foreach($array as $key => $value){
        //On vérifie que le champ n'est pas vide
        if(!empty($value)) {
            //Si le mode editeur de texte est activé
            if ($mode == true) {
                //On recherche dans array['editor'] s'il y a un champ à sécuriser différement
                //Sinon on sécurise comme d'habitude
                if (in_array($key, explode(",", $array['editor']))) {
                    $value = Secure($value, 'editor');
                } else {
                    $value = Secure($value);
                }
            } else {
                $value = Secure($value);
            }
        }
        $array_new[$key] = $value;
    }

    return $array_new;
}

function identical_values($arrayA, $arrayB) {
    if(is_array($arrayA) AND is_array($arrayB)){
        sort($arrayA);
        sort($arrayB);

        return $arrayA == $arrayB;
    }
}

function array_required_stay($arrayA, $arrayB){
    $new_array = array();
    if(is_array($arrayA)) {
        if(is_array($arrayB)) {
            foreach ($arrayA as $k => $v) {
                foreach ($arrayB as $d => $p) {
                    if ($p === true) {
                        $new_array[$d] = $arrayA[$d];
                    }
                }
            }
        }else exit('$arrayB n\'est pas un tableau');
    }else exit('$arrayA n\'est pas un tableau');

    return $new_array;
}