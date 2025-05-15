<?php

namespace MedanWeb\Tools;

class ReferenceData
{
    /*
     * https://www.w3schools.com/php/php_ref_timezones.asp
     */
    public static function getTimezones(): array
    {
        $timezones = [
            "Asia/Jakarta",
            "Asia/Taipei",
        ];

        return array_combine($timezones, $timezones);
    }

    /*
     * https://gist.github.com/djaiss/2938259
     */
    public static function getCountries(): array
    {
        return [
            "ID" => "Indonesia",
            "TW" => "Taiwan, Province of China",
            "CN" => "China",
            "PH" => "Philippines",
        ];
    }

    /*
     * https://github.com/ankane/chartkick.js/blob/945c9ed70c70d7fda572fb7073e55259fb19ad0c/src/adapters/chartjs.js#L59-L63
     */
    public static function getChartColors(): array
    {
        return [
            "#3366CC", "#DC3912", "#FF9900", "#109618", "#990099", "#3B3EAC", "#0099C6",
            "#DD4477", "#66AA00", "#B82E2E", "#316395", "#994499", "#22AA99", "#AAAA11",
            "#6633CC", "#E67300", "#8B0707", "#329262", "#5574A6", "#651067"
        ];
    }
}