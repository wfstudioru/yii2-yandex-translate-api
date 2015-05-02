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
        $langDirection = explode('-',$source)[0].'-'.explode('-',$target)[0];
        if (strlen($text)>300) {
            return $this->getPostResponse($text, $langDirection);
        } else {
            return $this->getResponse($text, $langDirection);
        }
    }

    /**
     * Forming query parameters
     * @param  string $text   Source text string
     * @param  string $lang   Translation direction ru-en, en-es
     * @return array          Data properties
     */
    protected function getPostResponse($text = '', $lang = 'en-ru')
    {
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query(
                    [
                        'key' => $this->key,
                        'lang' => $lang,
                        'text' => $text,
                        'format' => 'html',
                    ]
                )
            )
        );

        $context  = stream_context_create($opts);

        $response = file_get_contents(self::API_URL, false, $context);
        return Json::decode($response, true);
    }

    /**
     * Forming query parameters
     * @param  string $text   Source text string
     * @param  string $lang   Translation direction ru-en, en-es
     * @return array          Data properties
     */
    protected function getResponse($text = '', $lang = 'en-ru')
    {
        $request = self::API_URL . '?' . http_build_query(
            [
                'key' => $this->key,
                'lang' => $lang,
                'text' => Html::encode($text),
                'format' => 'html',
            ]
        );

        $response = file_get_contents($request);
        return Json::decode($response, true);
    }
}
