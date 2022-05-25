<?php

return array(
    'name' => '/^[^0-9][a-z0-9\-_ñ]+$/i',
    'mail' => '/^[^0-9][a-zA-Z0-9_-ñ]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+[.]([a-zA-Z0-9_]){2,4}$/',
    'ipv4' => '/^[0-9]{1,4}\.[0-9]{1,4}\.[0-9]{1,4}\.[0-9]{1,4}$/',
    'hexadecimal' => '/^[[:xdigit:]]+$/',
    'title' => '/^[^0-9][a-z0-9ñ\s\-_]*$/i',
    'address' => '/^[0-9a-zñ\s\/\.#\-_]+$/i',
    'phone' => '/^[0-9]+$/',
    'rut' => '/^\d{1,8}\-[K|k|0-9]$/',
    'number' => '/^[1-9][0-9]*(\.[0-9]+)?$/',
    'float' => '/^[0-9]+(\.[0-9]+)?$/'
);
