<?php

declare(strict_types=1);

namespace Aerticket\ConfigurationBlinder\Backend;

use TYPO3\CMS\Lowlevel\Controller\ConfigurationController;

/**
 * This class allows to blind confidential configuration values by key. Just add the keys that should be blinded
 * to the $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['configuration_blinder']['keysToBlind'] array. The class will search
 * the EXTCONF array recursively for values of type string with this key.
 */
class KeyBasedConfigurationBlinder
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
        if (empty($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['configuration_blinder']['keysToBlind'])) {
            return $blindedConfigurationOptions;
        }

        // Filter the EXTCONF array so that includes only values that should be blinded
        $filteredArray = self::filterArrayRecursive($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']);
        if (empty($filteredArray)) {
            return $blindedConfigurationOptions;
        }

        // Actually blind the remaining values in the array
        array_walk_recursive($filteredArray, function (&$value) {
            $value = '******';
        });

        if (!is_array($blindedConfigurationOptions['TYPO3_CONF_VARS']['EXTCONF'])) {
            $blindedConfigurationOptions['TYPO3_CONF_VARS']['EXTCONF'] = [];
        }

        $blindedConfigurationOptions['TYPO3_CONF_VARS']['EXTCONF'] = array_replace_recursive(
            $filteredArray,
            $blindedConfigurationOptions['TYPO3_CONF_VARS']['EXTCONF']
        );

        return $blindedConfigurationOptions;
    }

    /**
     * Only keeps non empty arrays or string values to be blinded
     *
     * @param array<mixed> $input
     * @return array<mixed>
     */
    public static function filterArrayRecursive(array $input): array
    {
        foreach ($input as &$value) {
            if (is_array($value)) {
                $value = self::filterArrayRecursive($value);
            }
        }
        return array_filter($input, function ($value, $key) {
            $isNotEmptyArray = is_array($value) && !empty($value) && $key != 'configuration_blinder';
            $isStringValueWithKeyToBlind = is_string($value)
                && is_string($key)
                && in_array($key, $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['configuration_blinder']['keysToBlind']);
            return $isNotEmptyArray || $isStringValueWithKeyToBlind;
        }, ARRAY_FILTER_USE_BOTH);
    }
}
