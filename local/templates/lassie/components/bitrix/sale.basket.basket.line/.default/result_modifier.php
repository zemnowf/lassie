<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Lib\DeclensionService;

$arResult['DECLENSION'] = DeclensionService::getDeclension($arResult["NUM_PRODUCTS"]);