<?php

namespace App\Services;

use App\Data\PhoneNumber\PhoneNumberInfoData;
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
        $phoneNumber = $phoneNumberUtil->parse($phoneNumber);
        return $phoneNumberUtil->isValidNumber($phoneNumber);
    }

    /**
     * @throws NumberParseException
     */
    public function getInfo(string $phoneNumber): PhoneNumberInfoData
    {
        $phoneNumber = $this->phoneNumberUtil->parse($phoneNumber);
        $geocoderInfo = $this->geoCoder->getDescriptionForNumber($phoneNumber, 'en_EN');

        return PhoneNumberInfoData::from([
            'phone_number' => $phoneNumber->getNationalNumber(),
            'country_code' => $phoneNumber->getCountryCode(),
            'country_name' => $geocoderInfo
        ]);
    }
}