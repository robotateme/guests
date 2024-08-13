<?php

namespace App\Services;

use libphonenumber\geocoding\PhoneNumberOfflineGeocoder;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;

class PhoneNumberService
{
    private PhoneNumberUtil $phoneNumberUtil;
    private PhoneNumberOfflineGeocoder $geoCoder;

    public function __construct()
    {
        $this->phoneNumberUtil = PhoneNumberUtil::getInstance();
        $this->geoCoder = PhoneNumberOfflineGeocoder::getInstance();
    }

    /**
     * @throws NumberParseException
     */
    public static function validatePhoneNumber(string $phoneNumber): bool
    {
        $phoneNumberUtil = PhoneNumberUtil::getInstance();
        $geoCoderUtil = PhoneNumberOfflineGeocoder::getInstance();
        $phoneNumber = $phoneNumberUtil->parse($phoneNumber);
//        dd($geoCoderUtil->getDescriptionForNumber($phoneNumber, 'en_EN'));
        return $phoneNumberUtil->isValidNumber($phoneNumber);
    }

    public function getInfo(string $phoneNumber): array
    {

    }
}