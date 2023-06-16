<?php


namespace Gouda\LaravelChatgpt;


use Gouda\LaravelChatgpt\Models\DialogContext;
use Illuminate\Support\Facades\Http;

class LaravelGPT
{
    private static $gptToken;
    private static $gptModel;

    public function __construct()
    {
        self::$gptModel = config('chatGPT.gpt_model');
        self::$gptToken = config('chatGPT.gpt_token');
    }

    public static function newQuestion($question, $dialog = null){

        if(is_null($dialog))
        {
            $dialogTitle = $dialogTitle ?? substr($question, 0 , 40);
            $dialog = LaravelGPTDialogs::startDialog($dialogTitle);
        }

        LaravelGPT::saveQuestionInDatabase($question, $dialog->id,'user');

        $questionResponse = LaravelGPT::sendQuestion($question);

        if($questionResponse)
        {
            LaravelGPT::saveQuestionInDatabase($questionResponse, $dialog->id, 'GPT');
        }

        return $questionResponse;
    }

    private static function sendQuestion($question)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . self::$gptToken,
        ])->post('https://api.openai.com/v1/chat/completions', [

            "frequency_penalty" => 0,
            "presence_penalty" => 0,
            'max_tokens' => 300,
            "temperature"=> 0.6,
            "stream" => false,
            "model"=> self::$gptModel,
            "messages"=> [["role"=> "user", "content"=> $question]]
        ]);


        $result = json_decode($response->getBody(), true);

        return $result['choices'][0]['message']['content'];
    }

    private static function saveQuestionInDatabase($content, $dialog_id, $sender)
    {
        DialogContext::create([
            'dialog_id' => $dialog_id,
            'content' => $content,
            'sender' => $sender
        ]);
        return true;
    }

}