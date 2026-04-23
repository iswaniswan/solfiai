<?php

namespace app\components\payment_gateway;

class MerchantSofin
{
    const kode = 'T10632';
    const nama = 'sofin';
    const api_key = 'tGjLRmGZx7lNOtbxwXBqwtej8D6A1AXEvjAdyFJl';
    const private_key = 's1Yyp-9b72S-2nd8V-iaZXn-1KqCo';
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