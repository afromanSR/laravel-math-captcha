<?php


namespace AfromanSR\LaravelMathCaptcha;

use Illuminate\Support\Facades\Session;

class MathCaptcha
{
    private $arr;
    private $sessionKey = '_math_captcha';
    private $operation = '';

    public function __construct()
    {
        $this->operation = config('captcha.operation', 'random');
    }

    private function generate()
    {
        $num1 = rand(2, 5);
        $num2 = rand(6, 9);

        $this->arr['num1'] = $num1;
        $this->arr['num2'] = $num2;

        switch ($this->operation)
        {
            case 'addition':
                $this->arr['question'] = $num1 . " + " . $num2 . " = ? ";
                $this->arr['answer'] = $this->addition($num1, $num2);
                return $this->arr;
                break;

            case 'substruction':
                $this->arr['question'] = $num2 . " - " . $num1 . " = ? ";
                $this->arr['answer'] = $this->substruction($num1, $num2);
                return $this->arr;
                break;

            case 'multiplication':
                $this->arr['question'] = $num1 . " * " . $num2 . " = ? ";
                $this->arr['answer'] = $this->multiplication($num1, $num2);
                return $this->arr;
                break;

            case 'random':
                $action = rand(1, 3);
                switch ($action)
                {
                    case 1:
                        $this->arr['question'] = $num1 . " + " . $num2 . " = ? ";
                        $this->arr['answer'] = $this->addition($num1, $num2);
                        return $this->arr;
                        break;

                    case 2:
                        $this->arr['question'] = $num2 . " - " . $num1 . " = ? ";
                        $this->arr['answer'] = $this->substruction($num1, $num2);
                        return $this->arr;
                        break;

                    case 3:
                        $this->arr['question'] = $num1 . " * " . $num2 . " = ? ";
                        $this->arr['answer'] = $this->multiplication($num1, $num2);
                        return $this->arr;
                        break;
                }
        }
    }

    private function addition($num1, $num2)
    {
        return $num1 + $num2;
    }

    private function substruction($num1, $num2)
    {
        return $num2 - $num1;
    }

    private function multiplication($num1, $num2)
    {
        return $num1 * $num2;
    }

    public static function getQuestion()
    {
        $instance = new self();
        Session::put($instance->sessionKey,$instance->generate());

        return Session::get($instance->sessionKey)['question'];
    }

    public static function getAnswer()
    {
        $instance = new self();
        return Session::get($instance->sessionKey)['answer'];
    }
}