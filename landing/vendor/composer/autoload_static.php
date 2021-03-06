<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit41fc61f747218844e0adc031f69b6180
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Abraham\\TwitterOAuth\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Abraham\\TwitterOAuth\\' => 
        array (
            0 => __DIR__ . '/..' . '/abraham/twitteroauth/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'Twig_' => 
            array (
                0 => __DIR__ . '/..' . '/twig/twig/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit41fc61f747218844e0adc031f69b6180::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit41fc61f747218844e0adc031f69b6180::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit41fc61f747218844e0adc031f69b6180::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
