<?php

namespace Hleyf\Blog\Models;

class Url {

    public static function getPath() {
        return substr(__DIR__, 0, strpos(__DIR__, 'src') + 3);
    }
}