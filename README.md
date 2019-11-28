# TYPO3 configuration blinder

TYPO3 hides some confidential configuration values like database credentials from human beings that
use the TYPO3 backend - even from administrators that have access to the configuration module.

With this extension you can add more values that should be blinded in the configuration module and 
thus hidden from all backend users.

## Option 1: Selectively blind single configuration values

Just add configuration values that should be blinded to the `$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['configuration_blinder']['blindedConfigurationOptions']` array like this:

```php
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['configuration_blinder']['blindedConfigurationOptions']['TYPO3_CONF_VARS']['EXTCONF']['my_extension']['my_secret_key'] = '******';
```

## Option 2: Define configuration keys that should always be blinded

If you have multiple confidential values with the same key name in different places, you can add
the name of the key to the `$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['configuration_blinder']['keysToBlind']` array like this: 

```php
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['configuration_blinder']['keysToBlind'][] = 'my_secret_key';
```

This would blind the configuration value of the first example, but also all other configuration
values of type string with the key 'my_secret_key'.
