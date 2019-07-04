<?php

namespace app\modules\euro\controllers;

use yii\web\Controller;
use yii\httpclient\Client;

/**
 * Default controller for the `euro` module
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        $currency = $this->actionGetEuroCurrency();
        $updateButtonId = $this->module->params['updateButtonId'];
        return $this->render('index',
            [
                'currency' => $currency,
                'updateButtonId' => $updateButtonId
            ]
        );
    }
    private function actionGetEuroCurrency()
    {
        $listApi = $this->module->params['listOfAPI'];
        foreach ($listApi as $item){
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('GET')
                ->setUrl($item['url'])
                ->setFormat($item['format'])
                ->send();
            if ($response->isOk) {
                $method = $item['method'];
                if(method_exists($this, $method)){
                    $currency = $this->$method($response->data);
                    if($currency) {
                        return $currency;
                    }
                }
            }
        }
        return false;
    }
    private function parseDataFromCbr($data)
    {
        if (isset($data['Valute']['EUR']['Value'])){
            return $data['Valute']['EUR']['Value'];
        }
        return false;
    }
    private function parseDataFromEcb($data)
    {
        if(isset($data['Cube']['Cube']['Cube'])){
            $currenciesList = $data['Cube']['Cube']['Cube'];
            foreach ($currenciesList as $currency){
                if($currency['@attributes']['currency'] === 'RUB'){
                    return $currency['@attributes']['rate'];
                }
            }
        }
        return false;
    }
}