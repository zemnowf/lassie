<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/assets/styles/app.min.css');
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/assets/scripts/app.min.js');

IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/templates/" . SITE_TEMPLATE_ID . "/header.php");
CJSCore::Init(array("fx"));

$curPage = $APPLICATION->GetCurPage(true);

?><!DOCTYPE html>
<html xml:lang="<?= LANGUAGE_ID ?>" lang="<?= LANGUAGE_ID ?>">
<head>
    <title><? $APPLICATION->ShowTitle() ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <link rel="shortcut icon" type="image/x-icon" href="<?= SITE_DIR ?>favicon.ico"/>
    <? $APPLICATION->ShowHead(); ?>
</head>
<body>
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
<header class="header">
    <div class="header__top">
        <div class="container header__container header__container_top">
            <div class="header__col header__col_top-left"><span class="header__icon icon-mail"></span><a
                        href="javascript:void(0);" class="link">Подписаться</a>
            </div>
            <div class="header__col header__col_top-right">
                <ul class="header__top-menu menu">
                    <li class="menu__item"><a href="javascript:void(0);" class="link menu__name">О компании</a>
                    </li>
                    <li class="menu__item"><a href="javascript:void(0);" class="link menu__name">Оплата</a>
                    </li>
                    <li class="menu__item"><a href="javascript:void(0);" class="link menu__name">Доставка</a>
                    </li>
                </ul>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:search.title",
                    ".default",
                    array(
                        "NUM_CATEGORIES" => "1",
                        "TOP_COUNT" => "5",
                        "CHECK_DATES" => "N",
                        "SHOW_OTHERS" => "N",
                        "PAGE" => SITE_DIR . "catalog/",
                        "CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),
                        "CATEGORY_0" => array(
                            0 => "iblock_catalog",
                        ),
                        "CATEGORY_0_iblock_catalog" => array(
                            0 => "all",
                        ),
                        "CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
                        "SHOW_INPUT" => "Y",
                        "INPUT_ID" => "title-search-input",
                        "CONTAINER_ID" => "search",
                        "PRICE_CODE" => array(
                            0 => "BASE",
                        ),
                        "SHOW_PREVIEW" => "Y",
                        "PREVIEW_WIDTH" => "75",
                        "PREVIEW_HEIGHT" => "75",
                        "CONVERT_CURRENCY" => "Y"
                    ),
                    false
                ); ?>
            </div>
        </div>
    </div>
    <div class="header__middle">
        <div class="container header__container header__container_middle">
            <div class="header__col header__col_logo">
                <a href="javascript:void(0);" class="header__logo logo">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/logo.png" class="logo__img" alt="">
                </a>
            </div>
            <div class="header__contacts"><span class="header__icon icon-comment"></span>
                <div class="header__col header__col_contacts">
                    <div class="contacts"><a href="tel:+74952150435" class="contacts__tel">8 495 215-04-35</a>
                        <div class="contacts__info">с 9:00 до 24:00 ежедневно</div>
                    </div>
                </div>
                <div class="header__col header__col_contacts">
                    <div class="contacts"><a href="tel:+78003331204" class="contacts__tel">8 800 333-12-04</a>
                        <div class="contacts__info">24 часа 7 дней в неделю</div>
                    </div>
                </div>
                <div class="header__col header__col_contacts"><a href="javascript:void(0);" class="link">Контактная
                        информация</a>
                </div>
            </div>
            <div class="header__col header__col_basket"><span class="header__icon icon-bag"></span>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:sale.basket.basket.line",
                    ".default",
                    array(
                        "PATH_TO_BASKET" => SITE_DIR . "personal/cart/",
                        "PATH_TO_PERSONAL" => SITE_DIR . "personal/",
                        "SHOW_PERSONAL_LINK" => "N",
                        "SHOW_NUM_PRODUCTS" => "Y",
                        "SHOW_TOTAL_PRICE" => "Y",
                        "SHOW_PRODUCTS" => "N",
                        "POSITION_FIXED" => "N",
                        "SHOW_AUTHOR" => "Y",
                        "PATH_TO_REGISTER" => SITE_DIR . "login/",
                        "PATH_TO_PROFILE" => SITE_DIR . "personal/",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH_TO_ORDER" => SITE_DIR . "personal/order/make/",
                        "SHOW_EMPTY_VALUES" => "Y",
                        "PATH_TO_AUTHORIZE" => "",
                        "SHOW_REGISTRATION" => "Y",
                        "HIDE_ON_BASKET_PAGES" => "Y"
                    ),
                    false
                ); ?>
            </div>
        </div>
    </div>
    <div class="header__bottom">
        <div class="container">
            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "header_bottom_menu",
                array(
                    "ROOT_MENU_TYPE" => "header_bottom_menu",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_TIME" => "36000000",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "MENU_THEME" => "site",
                    "CACHE_SELECTED_ITEMS" => "N",
                    "MENU_CACHE_GET_VARS" => array(),
                    "MAX_LEVEL" => "3",
                    "CHILD_MENU_TYPE" => "left",
                    "USE_EXT" => "Y",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N",
                    "COMPONENT_TEMPLATE" => "header_bottom_menu"
                ),
                false
            ); ?>
        </div>
    </div>
</header>
<?
if ($APPLICATION->GetCurPage() === '/'):
?>
<main class="content index">
    <?$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        ".default",
        array(
            "IBLOCK_TYPE" => "news",
            "IBLOCK_ID" => "1",
            "NEWS_COUNT" => "3",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "SORT",
            "SORT_ORDER2" => "ASC",
            "FILTER_NAME" => "",
            "FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "PROPERTY_CODE" => array(
                0 => "",
                1 => "",
            ),
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_SHADOW" => "Y",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "PREVIEW_TRUNCATE_LEN" => "120",
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "DISPLAY_PANEL" => "N",
            "SET_TITLE" => "N",
            "SET_STATUS_404" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
            "PAGER_SHOW_ALL" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "COMPONENT_TEMPLATE" => "flat",
            "SET_BROWSER_TITLE" => "Y",
            "SET_META_KEYWORDS" => "Y",
            "SET_META_DESCRIPTION" => "Y",
            "SET_LAST_MODIFIED" => "N",
            "INCLUDE_SUBSECTIONS" => "Y",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "MEDIA_PROPERTY" => "",
            "SEARCH_PAGE" => "/search/",
            "USE_RATING" => "N",
            "USE_SHARE" => "N",
            "PAGER_TITLE" => "Новости",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "SHOW_404" => "N",
            "MESSAGE_404" => "",
            "TEMPLATE_THEME" => "site",
        ),
        false
    ); ?>
    <section class="popular">
        <div class="container">
            <h1 class="heading"><span class="heading__text"><?= $APPLICATION->ShowTitle(false) ?></span></h1>
            <? endif ?>
            <? if(preg_match('/\/catalog\/[a-z0-9_-].+/', $APPLICATION->GetCurPage())): ?>
            <main class="content catalog-page">
                <div class="container">
                    <? // Навигационная цепочка - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/navigation/breadcrumb.php
                    $APPLICATION->IncludeComponent(
                    	"bitrix:breadcrumb",
                    	".default",
                    	array(
                    		// region Дополнительные настройки
                    		"START_FROM"  =>  "0",  // Номер пункта, начиная с которого будет построена навигационная цепочка
                    		"PATH"        =>  "",   // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    		"SITE_ID"     =>  "-",  // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный) : array ( '-' => '', 's1' => '[s1] Интернет-магазин (Сайт по умолчанию)', )
                    		// endregion
                    	)
                    ); ?>
                    <h1><?= $APPLICATION->ShowTitle() ?></h1>
                    <? endif ?>
