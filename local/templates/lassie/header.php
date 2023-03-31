<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/assets/styles/app.min.css');
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/assets/scripts/app.min.js');

IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
CJSCore::Init(array("fx"));

$curPage = $APPLICATION->GetCurPage(true);

?><!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
	<title><?$APPLICATION->ShowTitle()?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>favicon.ico" />
	<? $APPLICATION->ShowHead(); ?>
</head>
<body>
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
<header class="header">
    <div class="header__top">
        <div class="container header__container header__container_top">
            <div class="header__col header__col_top-left"><span class="header__icon icon-mail"></span><a href="javascript:void(0);" class="link">Подписаться</a>
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
                        "PAGE" => SITE_DIR."catalog/",
                        "CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS") ,
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
                <div class="header__col header__col_contacts"><a href="javascript:void(0);" class="link">Контактная информация</a>
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
            <nav class="header__nav navigation">
                <ul class="header__menu menu menu_width_full">
                    <li class="menu__item"><a href="#" class="menu__name">Коллекции</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__content">
                                <div class="dropdown-menu__img">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/header-submenu-1.jpg" alt="девочка">
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Варежки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Для новорождённых</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Горловина и шарфы</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Носки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Перчатки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Зимние</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="menu__item"><a href="javascript:void(0);" class="menu__name">Верхняя одежда</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__content">
                                <div class="dropdown-menu__img">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/header-submenu-1.jpg" alt="девочка">
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Варежки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Для новорождённых</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Горловина и шарфы</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Носки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Перчатки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Зимние</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="menu__item"><a href="javascript:void(0);" class="menu__name">Игра слоями</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__content">
                                <div class="dropdown-menu__img">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/header-submenu-1.jpg" alt="девочка">
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Варежки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Для новорождённых</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Горловина и шарфы</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Носки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Перчатки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Зимние</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="menu__item"><a href="javascript:void(0);" class="menu__name">Для прогулки и спорта</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__content">
                                <div class="dropdown-menu__img">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/header-submenu-1.jpg" alt="девочка">
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Варежки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Для новорождённых</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Горловина и шарфы</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Носки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Перчатки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Зимние</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Сумки и рюкзаки</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Солнцезащитные очки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Головные уборы</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Шапка-шлем</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Шапка-бини</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Повязка на голову</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Вязаные шапки</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Шапки с козырьком</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Непромокаемые шапки</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Шапка на завязках</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Шапка с помпоном </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="menu__item"><a href="javascript:void(0);" class="menu__name">Летняя одежда</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__content">
                                <div class="dropdown-menu__img">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/header-submenu-1.jpg" alt="девочка">
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Варежки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Для новорождённых</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Горловина и шарфы</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Носки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Перчатки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Зимние</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="menu__item"><a href="javascript:void(0);" class="menu__name">Обувь</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__content">
                                <div class="dropdown-menu__img">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/header-submenu-1.jpg" alt="девочка">
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Варежки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Для новорождённых</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Горловина и шарфы</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Носки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Перчатки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Зимние</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="menu__item"><a href="javascript:void(0);" class="menu__name">Аксессуары</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__content">
                                <div class="dropdown-menu__img">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/header-submenu-1.jpg" alt="девочка">
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Варежки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Для новорождённых</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Горловина и шарфы</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Носки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Перчатки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Зимние</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Сумки и рюкзаки</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Солнцезащитные очки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Головные уборы</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Шапка-шлем</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Шапка-бини</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Повязка на голову</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Вязаные шапки</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Шапки с козырьком</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Непромокаемые шапки</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Шапка на завязках</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Шапка с помпоном </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="menu__item"><a href="javascript:void(0);" class="menu__name">Для новорожденных</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__content">
                                <div class="dropdown-menu__img">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/header-submenu-1.jpg" alt="девочка">
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Варежки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Для новорождённых</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Горловина и шарфы</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Носки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Перчатки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Зимние</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="header menu__item"><a href="javascript:void(0);" class="header__sale-wrapper menu__name"><span class="header__sale">Распродажа</span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__content">
                                <div class="dropdown-menu__img">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/header-submenu-1.jpg" alt="девочка">
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Варежки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Для новорождённых</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Горловина и шарфы</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Носки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Перчатки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);" class="link vertical-menu__submenu-name">Зимние</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
                <button class="burger-btn header__nav-btn js-nav-btn"><span class="burger-btn__switch">Развернуть меню </span>
                </button>
                <div class="navigation__collapse">
                    <ul class="navigation__collapse-menu vertical-menu">
                        <li class="navigation__collapse-item vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Распродажа</a>
                        </li>
                        <li class="navigation__collapse-item vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Для новорожденных</a>
                        </li>
                        <li class="navigation__collapse-item vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Аксессуары</a>
                        </li>
                        <li class="navigation__collapse-item vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Обувь</a>
                        </li>
                        <li class="navigation__collapse-item vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Летняя одежда</a>
                        </li>
                        <li class="navigation__collapse-item vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Для прогулки и спорта</a>
                        </li>
                        <li class="navigation__collapse-item vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Игра слоями</a>
                        </li>
                        <li class="navigation__collapse-item vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Верхняя одежда</a>
                        </li>
                        <li class="navigation__collapse-item vertical-menu__item"><a href="javascript:void(0);" class="vertical-menu__name">Коллекции</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<main class="content index">
    <div class="index__slider slider">
        <ul class="slider__container">
            <li class="slider__item">
                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/slider-1.jpg" alt="" class="slider__img">
                <div class="index__slider-title">Встречаем осень
                    <br>с новой коллекцией</div>
            </li>
            <li class="slider__item">
                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/slider-1.jpg" alt="" class="slider__img">
                <div class="index__slider-title">Встречаем осень
                    <br>с новой коллекцией</div>
            </li>
        </ul>
    </div>
    <section class="popular">
        <div class="container">
            <h1 class="heading"><span class="heading__text">Популярные товары</span></h1>