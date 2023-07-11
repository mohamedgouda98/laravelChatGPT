
# Laravel ChatGPT Package
####Note: This is a version Beta and I wish to complete all my ideas in this package.

sample package for laravel applications to integrate with ChatGPT

# Hi, I'm Gouda! 👋


## 🚀 About Me
I'm a Software Engineer...


## Installation

Install with composer

```bash
  composer require gouda/laravel-chatgpt
```

Add service Provider in config/app.php

```bash
\Gouda\LaravelChatgpt\LaravelChatGptServiceProvider::class,
```

run migration
```bash
php artisan migrate
```



    
## Environment Variables

To run this package, you will need to add the following environment variables to your .env file

`gpt_token`

`gpt_model`

OR run command:
```bash
 php artisan vendor:publish --tag=chat-gpt-config
```
## How to use ?

### Send a new question:

```bash
$answer = LaravelGPT::newQuestion('Hello GPT!');
```
newQuestion function in this case will create dialog automatic in database, but if u want to send question in specific dialog you can use blew function:

Use this function to get all user dialogs:
```bash
LaravelGPTDialogs::getUserDialogs(Auth::id());
```
Use this function to get one dialog
```bash
LaravelGPTDialogs::getDialogById($dialog_id);
```

#Audio
```bash
$audio = AudioGPT::newAudio($filePath);
```
you can pass lang as optional as:
```bash
$audio = AudioGPT::newAudio($filePath, 'ar');
```

## Support

For support, email dev.mohamedgouda@gmail.com 

