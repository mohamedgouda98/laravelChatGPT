<?php


namespace Gouda\LaravelChatgpt\Models;


use Illuminate\Database\Eloquent\Model;

class DialogContext extends Model
{

    protected $fillable = ['dialog_id', 'content', 'sender'];

}