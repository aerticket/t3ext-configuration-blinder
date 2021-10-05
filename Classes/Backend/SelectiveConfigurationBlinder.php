<?php

namespace Aerticket\ConfigurationBlinder\Backend;

use TYPO3\CMS\Lowlevel\Controller\ConfigurationController;

/**
 * This class allows to selectively blind additional credentials. Just add configuration values that should be blinded
 * to the $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['configuration_blinder']['blindedConfigurationOptions'] array like
 * this:
 *
 * 'TYPO3_CONF_VARS' => [
 *     'EXTCONF' => [
 *         'my_extension' => [
 *             'my_secret_key' => '******',
 *         ]
 *     ]
 * ]
 */
class SelectiveConfigurationBlinder
{
    /**
     * @param array<mixed> $blindedConfigurationOptions
     * @param ConfigurationController $configurationController
     * @return array<mixed>
     */
    public function modifyBlindedConfigurationOptions(
        array $blindedConfigurationOptions,
        ConfigurationController $configurationController
    ): array {
        return array_replace_recursive(
            $blindedConfigurationOptions,
            $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['configuration_blinder']['blindedConfigurationOptions']
        );
    }
}
