<?php

namespace app\components\payment_gateway;

class MerchantSandbox
{
    const kode = 'T3589';
    const nama = 'Merchant Sandbox';
    const api_key = 'DEV-CJ7rZu24IGfQIRz1kLWCTimTaOZPFzmepf5Y3GAd';
    const private_key = 'tTEG8-JJhxb-mGOb3-bUGkB-ohx3t';
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