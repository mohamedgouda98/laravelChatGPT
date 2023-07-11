<?php


namespace Gouda\LaravelChatgpt;


use Gouda\LaravelChatgpt\Models\DialogContext;
use GuzzleHttp\Client;

class AudioGPT
{
    private static $gptToken;
    private static $gptModel;

    public function __construct()
    {
        self::$gptModel = config('chatGPT.gpt_audio_model');
        self::$gptToken = config('chatGPT.gpt_token');
    }

    public static function newAudio($filePath, $lang = 'en')
    {

        $client = new Client();

        $response = $client->post('https://api.openai.com/v1/audio/transcriptions', [
            'headers' => [
                'Authorization' => 'Bearer ' . self::$gptToken,
            ],
            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => fopen($filePath, 'r'),
                ],
                [
                    'name' => 'model',
                    'contents' => self::$gptModel,
                ],
                [
                    'name' => 'language',
                    'contents' => $lang
                ],
            ],
        ]);

        $result = json_decode($response->getBody(), true);

        return $result['text'];
    }

}