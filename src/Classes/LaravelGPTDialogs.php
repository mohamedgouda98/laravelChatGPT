<?php
namespace Gouda\LaravelChatgpt\Classes;

use Gouda\LaravelChatgpt\Models\Dialog;

class LaravelGPTDialogs{

    public static function startDialog($title): Dialog
    {
        return Dialog::firstOrCreate([
            'user_id' => Auth::id(),
            'title' => $title
        ]);
    }

    public static function getUserDialogs($userId)
    {
        return Dialog::where('user_id', $userId)->get();
    }

    public static function getDialogById($id)
    {
        return Dialog::find($id);
    }
}