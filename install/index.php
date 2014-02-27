<?php
IncludeModuleLangFile(__FILE__);

class setprops extends CModule {
  
    var $MODULE_ID = "setprops";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_GROUP_RIGHTS;
    var $errors = array();

    function __construct() {
        $arModuleVersion = array();
        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path . "/version.php"); 
        if (array_key_exists("VERSION", $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }
        $this->MODULE_NAME = GetMessage('SETPROPS_MODULE_NAME');
        $this->MODULE_DESCRIPTION = GetMessage('SETPROPS_MODULE_DESCRIPTION');
    } 

    function DoInstall() {
         CopyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/setprops/install/bitrix_files/',
                      $_SERVER['DOCUMENT_ROOT'] . '/bitrix/', true, true);
         RegisterModule($this->MODULE_ID);
    }
 
    function DoUninstall() {
         DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/setprops/install/bitrix_files/",
                        $_SERVER["DOCUMENT_ROOT"]."/bitrix/");
         UnRegisterModule($this->MODULE_ID);
    }

}