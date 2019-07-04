<?php
return [
    'params' => [
        'updateButtonId' => 'update_currency',
        'listOfAPI' => [
            [
                'method' => 'parseDataFromCbr',
                'url' => 'https://www.cbr-xml-daily.ru/daily_json.js',
                'format' => 'json'
            ],
            [
                'method' => 'parseDataFromEcb',
                'url' => 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml',
                'format' => 'xml'
            ],
        ]
    ],
];