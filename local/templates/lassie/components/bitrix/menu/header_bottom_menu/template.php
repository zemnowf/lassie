<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="header__bottom">
    <div class="container">
        <nav class="header__nav navigation">
            <ul class="header__menu menu menu_width_full">
                <? foreach ($arResult as $arItem): ?>
                    <li class="menu__item"><a href="<?= $arItem["LINK"] ?>"
                                              class="menu__name"><?= $arItem["TEXT"] ?></a>
                        <? if (!empty($arItem["ITEMS"])): ?>
                            <ul class="dropdown-menu">
                                <li class="dropdown-menu__content">
                                    <div class="dropdown-menu__img">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/header-submenu-1.jpg"
                                             alt="девочка">
                                    </div>
                                    <div class="dropdown-menu__menu-col">
                                        <ul class="vertical-menu">
                                            <? foreach ($arItem["ITEMS"] as $arSubItem): ?>
                                                <li class="vertical-menu__item"><span
                                                            class="vertical-menu__name"><?= $arSubItem["TEXT"] ?></span>
                                                    <ul class="vertical-menu__submenu">
                                                        <? foreach ($arSubItem["ITEMS"] as $arSubSubItem): ?>
                                                            <li class="vertical-menu__submenu-item">
                                                                <a href="<?= $arSubSubItem["LINK"] ?>"
                                                                   class="link vertical-menu__submenu-name">
                                                                    <?= $arSubSubItem["TEXT"] ?>
                                                                </a>
                                                            </li>
                                                        <? endforeach; ?>
                                                    </ul>
                                                </li>
                                            <? endforeach; ?>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        <? endif; ?>
                    </li>
                <? endforeach; ?>
                <li class="header menu__item"><a href="javascript:void(0);" class="header__sale-wrapper menu__name">
                        <span class="header__sale">Распродажа</span></a>
                </li>
            </ul>
            <button class="burger-btn header__nav-btn js-nav-btn"><span
                        class="burger-btn__switch">Развернуть меню </span>
            </button>
            <div class="navigation__collapse">
                <ul class="navigation__collapse-menu vertical-menu">
                    <? foreach ($arResult as $arItem): ?>
                        <li class="navigation__collapse-item vertical-menu__item">
                            <a href="<?= $arItem["LINK"] ?>" class="vertical-menu__name"><?= $arItem["TEXT"] ?></a>
                        </li>
                    <? endforeach; ?>
                </ul>
            </div>
        </nav>
    </div>
</div>