<?php

CModule::IncludeModule('iblock');

$db_iblock_type = CIBlockType::GetList();
while ($ar_iblock_type = $db_iblock_type->Fetch()) {
    if ($arIBType = CIBlockType::GetByIDLang($ar_iblock_type["ID"], LANG)) {
        $res = CIBlock::GetList(Array(), Array('TYPE' => $ar_iblock_type["ID"], 'ACTIVE' => 'Y'), true); 
        $iblocks = array();
        while ($ar_res = $res->Fetch()) {
            $iblocks[] = array(
                "text" => $ar_res['NAME'], 
                "icon" => "iblock_menu_icon_iblocks", 
                "url" => "setprops.php?IBLOCK_ID=" . $ar_res["ID"] . "&type=" . $ar_iblock_type["ID"] . "&lang=" . LANGUAGE_ID . "&find_el_y=Y", 
                "items_id" => "setprops_iblock_" . $ar_res["ID"]
                ); 
        } 
        $iblock_types[] = array(
            "text" => $arIBType['NAME'], 
            "icon" => "iblock_menu_icon_types",
            "items" => $iblocks,
            "items_id" => "setprops_iblock_type" . $arIBType["ID"]
            );
    }
}

$aMenu[] = array(
    "parent_menu" => "global_menu_services",
    "sort" => "5",
    "text" => 'Массовая установка свойств',
    "title" => 'Массовая установка свойств',
    "icon" => "setprops_menu_icon",
    "page_icon" => "setprops_menu_icon",
    "items_id" => "setprops_main", 
    "items" => $iblock_types,
    "more_url" => array("setprops.php")
); 

return $aMenu;  