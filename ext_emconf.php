<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'Configuration Blinder',
    'description' => 'Hide confidential configuration values from backend users',
    'category' => 'plugin',
    'state' => 'beta',
    'author' => 'Thomas Heilmann',
    'author_email' => 'theilmann@aer.de',
    'author_company' => 'AERTiCKET GmbH',
    'clearCacheOnLoad' => 0,
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.0-'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
