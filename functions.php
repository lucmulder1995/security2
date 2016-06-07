<?php
/**
 * Returns an encrypted & utf8-encoded
 */
function encrypt($pure_string, $encryption_key) {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
    return base64_encode($encrypted_string);


}

/**
 * Returns decrypted original string
 */
function decrypt($encrypted_string, $encryption_key) {
	$encrypted_string = base64_decode($encrypted_string);
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
    return $decrypted_string;
}

// function encrypt($input, $key)
// {
// 	$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
//     $iv = mcrypt_create_iv($iv_size);
//     return base64_encode(
//         $iv . mcrypt_encrypt(
//             MCRYPT_RIJNDAEL_128,
//             $key,
//             $input,
//             MCRYPT_MODE_CBC,
//             $iv
//         )
//     );
// }

// function decrypt($input, $key)
// {
// 	$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
//     $input = base64_decode($input);
//     $iv = substr(
//         $input,
//         0,
//         $iv_size
//     );
//     $cipher = subs1r(
//         $input,
//         $iv_size
//     );
//     return trim(
//         mcrypt_decrypt(
//             MCRYPT_RIJNDAEL_128,
//             $key,
//             $cipher,
//             MCRYPT_MODE_CBC,
//             $iv
//         )
//     );
// }