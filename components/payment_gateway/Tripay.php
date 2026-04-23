<?php

namespace app\components\payment_gateway;

use app\components\PaymentGatewayInterface;
use yii\base\Exception;

class Tripay implements PaymentGatewayInterface
{
    const URL_TRANSACTION_CREATE = 'https://tripay.co.id/api/transaction/create';
    const URL_TRANSACTION_SANDBOX_CREATE = 'https://tripay.co.id/api-sandbox/transaction/create';
    const URL_TRANSACTION_DETAIL = 'https://tripay.co.id/api/transaction/detail';
    const URL_TRANSACTION_SANDBOX_DETAIL = 'https://tripay.co.id/api-sandbox/transaction/detail';
    const URL_PAYMENT_CHANNEL = 'https://tripay.co.id/api/merchant/payment-channel';
    const URL_PAYMENT_CHANNEL_SANDBOX = 'https://tripay.co.id/api-sandbox/merchant/payment-channel';

    const STATUS_UNPAID = 0;
    const STATUS_PAID = 1;
    const STATUS_EXPIRED = 2;
    const STATUS_FAILED = 3;

    const URL_REDIRECT = '';

    public $merchant;
    public $merchant_ref;
    public $amount;
    public $formData;
    public $item;
    public $items;

    protected $signature;

    /**
     * @throws Exception
     */
    public function sendTransaction()
    {
        // TODO: Implement sendTransaction() method.
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => static::URL_TRANSACTION_CREATE,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => $this->getHTTPHeaders(),
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($this->getHTTPBody()),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        return empty($error) ? $response : $error;
    }

    public function getTransaction($reference=null)
    {
        // TODO: Implement getTransaction() method.
        if ($reference == null) {
            throw new Exception('Referrence is Null, need \"Kode referensi transaksi\"');
        }

        $payload = ['reference'	=> $reference];
        $queryUrl = static::URL_TRANSACTION_DETAIL;
        $queryUrl .= '?' . http_build_query($payload);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => $queryUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => $this->getHTTPHeaders(),
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        echo empty($error) ? $response : $error;
    }

    public function callback()
    {
        // TODO: Implement callback() method.

    }

    public function getChannelPembayaran($code=null)
    {
        $_code = '';
        if ($code != null) {
            $_code = $code;
        }
        $payload = ['code' => $_code];

//        $queryUrl = static::URL_PAYMENT_CHANNEL_SANDBOX;
        $queryUrl = static::URL_PAYMENT_CHANNEL;
        $queryUrl .= '?' . http_build_query($payload);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => $queryUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => $this->getHTTPHeaders(),
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        return empty($error) ? $response : $error;
    }

    public function setMerchant($merchant=[])
    {
        $this->merchant = $merchant;
    }

    /**
     * @throws Exception
     */
    public function getMerchant()
    {
        if ($this->merchant == null) {
            throw new Exception('Merchant is Null');
        }
        return $this->merchant;
    }

    public function getHTTPHeaders()
    {
        $apiKey = $this->merchant['api_key'];
        return ['Authorization: Bearer '.$apiKey];
    }

    public function setFormData($method=null, $merchant_ref=null, $amount=null, $customer_name=null, $customer_email=null, $customer_phone=null)
    {
        $this->merchant_ref = $merchant_ref;
        $this->amount = $amount;
        $this->setSignature();
        $this->formData = [
            'method' => $method,
            'merchant_ref' => $merchant_ref,
            'amount' => $amount,
            'customer_name' => $customer_name,
            'customer_email' => $customer_email,
            'customer_phone' => $customer_phone,
            'order_items' => $this->getItems()
        ];
    }

    public function getFormData()
    {
        return $this->formData;
    }

    public function setItem($sku=null, $name=null, $price=null, $quantity=null, $product_url=null, $image_url=null)
    {
        $this->item = [
            'sku' => $sku,
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'product_url' => $product_url,
            'image_url' => $image_url,
        ];
    }

    public function getItem()
    {
        return $this->item;
    }

    public function addItems($item)
    {
        $this->items[] = $item;
    }

    public function getItems()
    {
        return $this->items;
    }

    /**
     * @throws Exception
     */
    public function getHTTPBody()
    {
        $formData = $this->getFormData();
        $formData['return_url'] = self::URL_REDIRECT;
        $formData['expired_time'] = (time() + (24 * 60 * 60)); // 24 jam
        $formData['signature'] = $this->getSignature();
        return $formData;
    }

    private function setSignature()
    {
        $privateKey   = $this->merchant['private_key'];
        $merchantCode = $this->merchant['kode'];
        $merchantRef  = $this->merchant_ref;
        $amount       = $this->getAmount();

        $this->signature = hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey);
    }

    /**
     * @throws Exception
     */
    public function getSignature()
    {
        if ($this->signature == null) {
            try {
                $this->setSignature();
            } catch (\Exception $e) {
                print_r($e->getMessage());
            }
        }
        return $this->signature;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function example()
    {
        $apiKey       = $this->merchant['api_key'];
        $privateKey   = $this->merchant['private_key'];
        $merchantCode = $this->merchant['kode'];
        $merchantRef  = '1023456789';
        $amount       = 1000000;

        $data = [
            'method'         => 'BNIVA',
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => 'Nama Pelanggan',
            'customer_email' => 'emailpelanggan@domain.com',
            'customer_phone' => '081234567890',
            'order_items'    => [
                [
                    'sku'         => 'FB-06',
                    'name'        => 'Nama Produk 1',
                    'price'       => 500000,
                    'quantity'    => 1,
                    'product_url' => 'https://tokokamu.com/product/nama-produk-1',
                    'image_url'   => 'https://tokokamu.com/product/nama-produk-1.jpg',
                ],
                [
                    'sku'         => 'FB-07',
                    'name'        => 'Nama Produk 2',
                    'price'       => 500000,
                    'quantity'    => 1,
                    'product_url' => 'https://tokokamu.com/product/nama-produk-2',
                    'image_url'   => 'https://tokokamu.com/product/nama-produk-2.jpg',
                ]
            ],
            'return_url'   => 'https://domainanda.com/redirect',
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => static::URL_TRANSACTION_CREATE,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        echo empty($error) ? $response : $error;
    }

    public static function getListStatusPayment()
    {
        return [
            self::STATUS_UNPAID => 'UNPAID',
            self::STATUS_PAID => 'PAID',
            self::STATUS_EXPIRED => 'EXPIRED',
            self::STATUS_FAILED => 'FAILED'
        ];
    }

}