<?php


namespace Gouda\LaravelChatgpt\Models;


use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{

    protected $fillable = ['user_id', 'title'];

}