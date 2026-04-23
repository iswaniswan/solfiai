<?php

namespace app\components\payment_gateway;

class MerchantBezzttie
{
    const kode = 'T15337';
    const nama = 'bezzttie';
    const api_key = 'AIWlWZkb1vBCfWoEVFA84A1njkXaEgRRQ0fFnjMz';
    const private_key = 'PiWRh-FbWy8-rrvOj-IFFZn-wS2Yh';
    const merchant_ref = null;

    public static function get()
    {
        return [
            'kode' => self::kode,
            'nama' => self::nama,
            'api_key' => self::api_key,
            'private_key' => self::private_key,
            'merchat_ref' => self::merchant_ref,
        ];
    }

    public static function getMerchant(): Merchant
    {
        return new Merchant(self::kode, self::nama, self::api_key, self::private_key, self::merchant_ref);
    }
}