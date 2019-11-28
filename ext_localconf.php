<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

(function () {
    if (TYPO3_MODE !== 'BE') {
        return;
    }

    $className = \TYPO3\CMS\Lowlevel\Controller\ConfigurationController::class;
    if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS'][$className]['modifyBlindedConfigurationOptions'])) {
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS'][$className]['modifyBlindedConfigurationOptions'] = [];
    }
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS'][$className]['modifyBlindedConfigurationOptions'][] =
        \Aerticket\ConfigurationBlinder\Backend\SelectiveConfigurationBlinder::class;
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS'][$className]['modifyBlindedConfigurationOptions'][] =
        \Aerticket\ConfigurationBlinder\Backend\KeyBasedConfigurationBlinder::class;

    if (!is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['configuration_blinder']['blindedConfigurationOptions'])) {
        $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['configuration_blinder']['blindedConfigurationOptions'] = [];
    }
    if (!is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['configuration_blinder']['keysToBlind'])) {
        $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['configuration_blinder']['keysToBlind'] = [];
    }
})();


