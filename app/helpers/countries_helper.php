<?php
function getCountry ( $code )
{
    $output = country ( $code ) ;
    return $output;
}

function worldCountries ()
{
    $output = countries();
    return $output;
}

/**    huh? 😃

Advanced Usage

Get country attributes (self-descriptive):

$egypt = country('eg');

// Egypt                                            // مصر
$egypt->getName();                                  $egypt->getNativeName();

// Arab Republic of Egypt                           // جمهورية مصر العربية
$egypt->getOfficialName();                          $egypt->getNativeOfficialName();

// Egyptian                                         // Cairo
$egypt->getDemonym();                               $egypt->getCapital();

// EG                                               // EGY
$egypt->getIsoAlpha2();                             $egypt->getIsoAlpha3();

// 818                                              // .eg
$egypt->getIsoNumeric();                            $egypt->getTld();

// [".eg",".مصر"]                                   // ["EG","Arab Republic of Egypt"]
$egypt->getTlds();                                  $egypt->getAltSpellings();

// Arabic                                           // {"ara":"Arabic"}
$egypt->getLanguage();                              $egypt->getLanguages();

// Africa                                           // true
$egypt->getContinent();                             $egypt->usesPostalCode();

// 27 00 N                                          // 30 00 E
$egypt->getLatitude();                              $egypt->getLongitude();

// 26.756103515625                                  // 29.86229705810547
$egypt->getLatitudeDesc();                          $egypt->getLongitudeDesc();

// 31.916667                                        // 36.333333
$egypt->getMaxLatitude();                           $egypt->getMaxLongitude();

// 20.383333                                        // 24.7
$egypt->getMinLatitude();                           $egypt->getMinLongitude();

// 1002450                                          // Africa
$egypt->getArea();                                  $egypt->getRegion();

// Northern Africa                                  // EMEA
$egypt->getSubregion();                             $egypt->getWorldRegion();

// 002                                              // 015
$egypt->getRegionCode();                            $egypt->getSubregionCode();

// false                                            // ["ISR","LBY","SDN"]
$egypt->isLandlocked();                             $egypt->getBorders();

// Yes                                              // 20
$egypt->isIndependent();                            $egypt->getCallingCode();

// ["20"]                                           // 0
$egypt->getCallingCodes();                          $egypt->getNationalPrefix();

// 9                                                // [9]
$egypt->getNationalNumberLength();                  $egypt->getNationalNumberLengths();

// 2                                                // [2]
$egypt->getNationalDestinationCodeLength();         $egypt->getnationaldestinationcodelengths();

// "00"                                             // {{recipient}}\n{{street}}\n{{postalcode}} {{city}}\n{{country}}
$egypt->getInternationalPrefix();                   $egypt->getAddressFormat();

// 357994                                           // H2
$egypt->getGeonameid();                             $egypt->getEdgar();

// EGY                                              // ua
$egypt->getItu();                                   $egypt->getMarc();

// EG                                               // ET
$egypt->getWmo();                                   $egypt->getDs();

// EGY                                              // EG
$egypt->getFifa();                                  $egypt->getFips();

// 40765                                            // EGY
$egypt->getGaul();                                  $egypt->getIoc();

// EGY                                              // 651
$egypt->getCowc();                                  $egypt->getCown();

// 59                                               // 469
$egypt->getFao();                                   $egypt->getImf();

// MAF                                              // null
$egypt->getAr5();                                   $egypt->isEuMember();

// null                                             // 🇪🇬
$egypt->getVatRates();                              $egypt->getEmoji();

// GeoJson data returned as string                  // SVG data returned as string
$egypt->getGeoJson();                               $egypt->getFlag();

// Divisions returned as array                      // {"official":"جمهورية مصر العربية","common":"مصر"}
$egypt->getDivisions();                             $egypt->getTranslation();

// {"ara":{"official":"جمهورية مصر العربية","common":"مصر"}}
$egypt->getNativeNames();

// {"iso_4217_code":"EGP","iso_4217_numeric":818,"iso_4217_name":"Egyptian Pound","iso_4217_minor_unit":2}
$egypt->getCurrency();

// {"EGP":{"iso_4217_code":"EGP","iso_4217_numeric":818,"iso_4217_name":"Egyptian Pound","iso_4217_minor_unit":2}}
$egypt->getCurrencies();

// {"ara":{"official":"جمهورية مصر العربية","common":"مصر"},"cym":{"official":"Arab Republic of Egypt","common":"Yr Aifft"},"deu":{"official":"Arabische Republik Ägypten","common":"Ägypten"},"fra":{"official":"République arabe d'Égypte","common":"Égypte"},"hrv":{"official":"Arapska Republika Egipat","common":"Egipat"},"ita":{"official":"Repubblica araba d'Egitto","common":"Egitto"},"jpn":{"official":"エジプト·アラブ共和国","common":"エジプト"},"nld":{"official":"Arabische Republiek Egypte","common":"Egypte"},"por":{"official":"República Árabe do Egipto","common":"Egito"},"rus":{"official":"Арабская Республика Египет","common":"Египет"},"spa":{"official":"República Árabe de Egipto","common":"Egipto"},"fin":{"official":"Egyptin arabitasavalta","common":"Egypti"}}
$egypt->getTranslations();

// {"continent":{"AF":"Africa"},"postal_code":true,"latitude":"27 00 N","latitude_dec":"26.756103515625","longitude":"30 00 E","longitude_dec":"29.86229705810547","max_latitude":"31.916667","max_longitude":"36.333333","min_latitude":"20.383333","min_longitude":"24.7","area":1002450,"region":"Africa","subregion":"Northern Africa","world_region":"EMEA","region_code":"002","subregion_code":"015","landlocked":false,"borders":["ISR","LBY","SDN"],"independent":"Yes"}
$egypt->getGeodata();

// {"geonameid":357994,"edgar":"H2","itu":"EGY","marc":"ua","wmo":"EG","ds":"ET","fifa":"EGY","fips":"EG","gaul":40765,"ioc":"EGY","cowc":"EGY","cown":651,"fao":59,"imf":469,"ar5":"MAF","address_format":"{{recipient}}\n{{street}}\n{{postalcode}} {{city}}\n{{country}}","eu_member":null,"vat_rates":null,"emoji":"🇪🇬"}
$egypt->getExtra();

// {"name":"Al Iskandariyah","alt_names":["El Iskandariya","al-Iskandariyah","al-Iskandarīyah","Alexandria","Alexandrie","Alexandria"],"geo":{"latitude":31.2000924,"longitude":29.9187387,"min_latitude":31.1173177,"min_longitude":29.8233701,"max_latitude":31.330904,"max_longitude":30.0864016}}
$egypt->getDivision("ALX"); */
?>