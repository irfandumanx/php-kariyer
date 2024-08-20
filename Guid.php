<?php

class Guid
{
    private static function gen($count): string
    {//saat ve makinenin unique bir kaç bilgilerini kullan
        //duplicate sayısına bak
        $out = "";
        for ($i = 0; $i<$count; $i++) {
            $out .= strtoupper(dechex(mt_rand(0x1000, 0xFFFF)));
        }
        return $out;
    }

    public static function generate(): string {
        return join("-",
            [self::gen(2), self::gen(1), self::gen(1), self::gen(1), self::gen(3)]);
    }

}