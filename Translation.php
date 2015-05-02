<?php

namespace wfstudioru\translate;

use yii\helpers\Json;
use yii\helpers\Html;

/**
 * Yii2 extension for Yandex Translate API
 *
 * @author Ilin Alexei <babl1986@gmail.com>
 * @since 1.0
 */
class Translation
{
    /**
     * API key
     * @var string
     */
    public $key;

    /**
     * API URL
     */
    const API_URL = 'https://translate.yandex.net/api/v1.5/tr.json/translate';

    /**
     * You can translate text from one language
     * to another language
     * @param string $source Source language
     * @param string $target Target language
     * @param string $text   Source text string
     * @return array
     */
    public function translate($source, $target, $text)
    {
        return $this->getResponse($this->getRequest('', $text, $source, $target));
    }

    /**
     * Forming query parameters
     * @param  string $method API method
     * @param  string $text   Source text string
     * @param  string $source Source language
     * @param  string $target Target language
     * @return array          Data properties
     */
    protected function getRequest($method, $text = '', $source = '', $target = '')
    {
        $lang = explode('-',$source)[0].'-'.explode('-',$target)[0];
        $request = self::API_URL . $method . '?' . http_build_query(
            [
                'key' => $this->key,
                'lang' => $lang,
                'text' => Html::encode($text),
            ]
        );

        return $request;
    }

    /**
     * Getting response
     * @param string $request
     * @return array
     */
    protected function getResponse($request)
    {
        $response = file_get_contents($request);
        return Json::decode($response, true);
    }
}
