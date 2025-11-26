<?php
namespace Src\Clases;

class Sanitizar
{
    public static function limpiar($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function limpiarArray($array)
    {
        $limpio = [];
        foreach ($array as $key => $value) {
            $limpio[$key] = self::limpiar($value);
        }
        return $limpio;
    }
}
