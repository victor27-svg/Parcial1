<?php
class Validator {
    private static $clave_secreta = "iTECH_2025_Secret";
    private static $metodo_cifrado = "AES-256-CBC";

    // Sanitización de datos (Data Cleaning)
    public static function cleanData($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Convertir a Title Case (Primeras letras mayúsculas)
    public static function toTitleCase($string) {
        return ucwords(strtolower(self::cleanData($string)));
    }

    // Generar Firma OpenSSL
    public static function firmarDatos($identidad, $nombre, $correo, $celular, $sexo) {
        $cadena = $identidad . $nombre . $correo . $celular . $sexo;
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::$metodo_cifrado));
        $firma = openssl_encrypt($cadena, self::$metodo_cifrado, self::$clave_secreta, 0, $iv);
        return base64_encode($firma . '::' . $iv);
    }

    // Verificar Integridad
    public static function verificarIntegridad($identidad, $nombre, $correo, $celular, $sexo, $firma_guardada) {
        $cadena_actual = $identidad . $nombre . $correo . $celular . $sexo;
        list($firma_original, $iv) = explode('::', base64_decode($firma_guardada), 2);
        $datos_descifrados = openssl_decrypt($firma_original, self::$metodo_cifrado, self::$clave_secreta, 0, $iv);
        return $cadena_actual === $datos_descifrados;
    }
}
?>