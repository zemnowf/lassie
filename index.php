<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Популярные товары");
?>
<? // Самые продаваемые товары
$APPLICATION->IncludeComponent(
	"bitrix:sale.bestsellers", 
	".default", 
	array(
		"HIDE_NOT_AVAILABLE" => "N",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_NAME" => "Y",
		"SHOW_IMAGE" => "Y",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"PAGE_ELEMENT_COUNT" => "30",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "86400",
		"CACHE_NOTES" => "",
		"BY" => "AMOUNT",
		"PERIOD" => "0",
		"FILTER" => array(
			0 => "N",
		),
		"DISPLAY_COMPARE" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "Y",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"USE_PRODUCT_QUANTITY" => "Y",
		"SHOW_PRODUCTS_2" => "N",
		"PROPERTY_CODE_2" => array(
		),
		"CART_PROPERTIES_2" => array(
		),
		"ADDITIONAL_PICT_PROP_2" => "-",
		"LABEL_PROP_2" => "-",
		"PROPERTY_CODE_3" => "",
		"CART_PROPERTIES_3" => "",
		"ADDITIONAL_PICT_PROP_3" => "-",
		"OFFER_TREE_PROPS_3" => array(
			0 => "-",
		),
		"COMPONENT_TEMPLATE" => ".default",
		"LINE_ELEMENT_COUNT" => "3",
		"TEMPLATE_THEME" => "blue",
		"SHOW_PRODUCTS_4" => "Y",
		"PROPERTY_CODE_4" => array(
			0 => "",
			1 => "39",
			2 => "",
		),
		"CART_PROPERTIES_4" => array(
			0 => "",
			1 => "39",
			2 => "",
		),
		"ADDITIONAL_PICT_PROP_4" => "ATT_MORE_PHOTO",
		"LABEL_PROP_4" => "-",
		"PROPERTY_CODE_5" => array(
			0 => "ATT_LABEL",
			1 => "ATT_SIZE",
			2 => "",
		),
		"CART_PROPERTIES_5" => array(
			0 => "",
			1 => "",
		),
		"ADDITIONAL_PICT_PROP_5" => "",
		"OFFER_TREE_PROPS_5" => array(
		),
		"CURRENCY_ID" => "RUB"
	),
	false
);
?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>