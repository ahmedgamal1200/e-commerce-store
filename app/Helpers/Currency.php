<?php

namespace App\Helpers;

use NumberFormatter;

class Currency
{
    // to use the class ' Currency ' Replace Currency::format
    public function __invoke($params)
    {
        return static::format(...$params);
    }

    public static function format($amount, $currency = null): string
    {
        $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
        if($currency === null){
            $currency = config('app.currency', 'USD');
        }
        return $formatter->formatCurrency($amount, $currency);
    }
}


