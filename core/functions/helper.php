<?php

if (! function_exists('createGUID')) {
    /**
     * create globally unique identifiers (guid)
     *
     * @return string
     */
    function createGUID()
    {
        srand((double)microtime() * 1000000);
        $r = rand();
        $u = uniqid(getmypid() . $r . (double)microtime() * 1000000, 1);
        $m = md5($u);

        return $m;
    }
}

if (! function_exists('generate_password')) {
    /**
     * Generate password
     *
     * @param int $length
     * @return string
     */
    function generate_password($length = 10)
    {
        $allowable_characters = "abcdefghjkmnpqrstuvxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789";
        $ps_len = strlen($allowable_characters);
        mt_srand((double)microtime() * 1000000);
        $pass = "";
        for ($i = 0; $i < $length; $i++) {
            $pass .= $allowable_characters[mt_rand(0, $ps_len - 1)];
        }

        return $pass;
    }
}

if (!function_exists('entities')) {
    /**
     * @param  string $string
     * @param  string $charset
     * @return mixed
     */
    function entities($string, $charset = 'UTF-8')
    {
        return htmlentities($string, ENT_COMPAT | ENT_SUBSTITUTE, $charset, false);
    }
}

if (! function_exists('get_by_key')) {
    /**
     * @param mixed $data
     * @param string|int $key
     * @param mixed $default
     * @param Closure $validate
     * @return mixed
     */
    function get_by_key($data, $key, $default = null, $validate = null)
    {
        $out = $default;
        if (is_array($data) && (is_int($key) || is_string($key)) && $key !== '' && array_key_exists($key, $data)) {
            $out = $data[$key];
        }
        if (!empty($validate) && is_callable($validate)) {
            $out = (($validate($out) === true) ? $out : $default);
        }

        return $out;
    }
}

if (! function_exists('is_cli')) {
    function is_cli()
    {
        return php_sapi_name() === 'cli' || php_sapi_name() === 'phpdbg';
    }
}

if (! function_exists('nicesize')) {
    /**
     * @param $size
     * @return string
     */
    function nicesize($size)
    {
        $sizes = array('Tb' => 1099511627776, 'Gb' => 1073741824, 'Mb' => 1048576, 'Kb' => 1024, 'b' => 1);
        $precisions = count($sizes) - 1;
        foreach ($sizes as $unit => $bytes) {
            if ($size >= $bytes) {
                return number_format($size / $bytes, $precisions) . ' ' . $unit;
            }
            $precisions--;
        }

        return '0 b';
    }
}

if (! function_exists('data_is_json')) {
    /**
     * @param $string
     * @param bool $returnData
     * @return bool|mixed
     */
    function data_is_json($string, $returnData = false)
    {
        $data = is_scalar($string) ? json_decode($string, true) : false;

        return (json_last_error() == JSON_ERROR_NONE) ? ($returnData ? $data : true) : false;
    }
}
