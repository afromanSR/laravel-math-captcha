# Laravel Math Captcha
A simple math-captcha based on [Laravel Simple Captcha](https://laravelarticle.com/laravel-simple-captcha)  
Captcha is the most used technique for preventing spam in form submission. The Laravel Math Captcha package will help you to prevent spam form submission. It's a really simple and lightweight Laravel package for captcha.

### Features of Laravel Math Captcha

- Lightweight
- Simple & easy to use
- Support Laravel 5, 6
- Captcha validation rules
- Customizable math operation

#### Installation

Use [Composer] to install the package:

```
$ composer require afromansr/laravel-math-captcha
```

### Usage

Use the `getCaptchaBox` method, In the form where you need to add captcha.

```blade
{!!getCaptchaBox()!!}
```

Optional: You can change the captcha answer input box name. By default, it is `_answer`

```blade
{!!getCaptchaBox('txtAnswer')!!}
```
Example

```blade
<form action="#" method="POST">
    @csrf
    
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="text" class="form-control">
    </div>
    
    <div class="form-group">
    {!!getCaptchaBox()!!}
    </div>

    <button class="btn btn-sm btn-default">Submit</button>
</form>
```

**Custom Captcha Box**

For adjusting the captcha box in your markup, you can make the captcha box using the `getCaptchaQuestion` method.

```blade
<p>Captcha</p>
<p>{{getCaptchaQuestion()}}</p>
<input name="_answer" type="number">
```

**Custom Captcha Math Operation**

By default, captcha will auto generate math questions with random math operators from addition, subtraction or multiplication.
To customise this setting, you need to publish the config file.

```
$ php artisan vendor:publish --tag=captcha-config
```

### Validation

Use `math_captcha` validation rules where you handle the request.

```php
public function handleForm(Request $request)
{
     $this->validate( $request, [
         '_answer'=>'required|simple_captcha'
     ]);
}
```