<?php

namespace app\components\payment_gateway;

class Merchant {
    public $kode;
    public $nama;
    public $api_key;
    public $private_key;
    public $merchant_ref;

    public function __construct($kode, $nama, $api_key, $private_key, $merchant_ref)
    {
        $this->$kode = $kode;
        $this->$nama = $nama;
        $this->$api_key = $api_key;
        $this->$private_key = $private_key;
        $this->merchant_ref = $merchant_ref;
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->api_key;
    }

    /**
     * @return mixed
     */
    public function getKode()
    {
        return $this->kode;
    }

    /**
     * @param mixed $kode
     */
    public function setKode($kode): void
    {
        $this->kode = $kode;
    }

    /**
     * @return mixed
     */
    public function getNama()
    {
        return $this->nama;
    }

    /**
     * @param mixed $nama
     */
    public function setNama($nama): void
    {
        $this->nama = $nama;
    }

    /**
     * @return mixed
     */
    public function getPrivateKey()
    {
        return $this->private_key;
    }

    /**
     * @param mixed $private_key
     */
    public function setPrivateKey($private_key): void
    {
        $this->private_key = $private_key;
    }

    /**
     * @return mixed
     */
    public function getMerchatRef()
    {
        return $this->merchat_ref;
    }

    /**
     * @param mixed $merchant_ref
     */
    public function setMerchatRef($merchant_ref): void
    {
        $this->merchat_ref = $merchant_ref;
    }

}