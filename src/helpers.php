<?php

use AfromanSR\LaravelMathCaptcha\MathCaptcha;

function getCaptchaQuestion(){
    return MathCaptcha::getQuestion();
}

function getCaptchaBox($inputBoxName="_answer"){
    $html= '<div style="display: flex;align-items: center;font-weight: 600;"><div>'.MathCaptcha::getQuestion().'</div>';
    $html .='<div style="margin-left:10px"><input name="'.$inputBoxName.'" type="number" style="width:60px"></div></div>';
    return $html;
}