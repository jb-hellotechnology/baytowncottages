<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit79c57aa47e8abf7034b52c1b5ca93bff
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\EventDispatcher\\' => 34,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\EventDispatcher\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/event-dispatcher',
        ),
    );

    public static $prefixesPsr0 = array (
        's' => 
        array (
            'stringEncode' => 
            array (
                0 => __DIR__ . '/..' . '/paquettg/string-encode/src',
            ),
        ),
        'P' => 
        array (
            'PageSpeed\\Tests' => 
            array (
                0 => __DIR__ . '/..' . '/sgrodzicki/pagespeed/tests',
            ),
            'PageSpeed' => 
            array (
                0 => __DIR__ . '/..' . '/sgrodzicki/pagespeed/src',
            ),
            'PHPHtmlParser' => 
            array (
                0 => __DIR__ . '/..' . '/paquettg/php-html-parser/src',
            ),
        ),
        'G' => 
        array (
            'Guzzle\\Tests' => 
            array (
                0 => __DIR__ . '/..' . '/guzzle/guzzle/tests',
            ),
            'Guzzle' => 
            array (
                0 => __DIR__ . '/..' . '/guzzle/guzzle/src',
            ),
        ),
        'D' => 
        array (
            'DaveChild\\TextStatistics' => 
            array (
                0 => __DIR__ . '/..' . '/davechild/textstatistics/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit79c57aa47e8abf7034b52c1b5ca93bff::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit79c57aa47e8abf7034b52c1b5ca93bff::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit79c57aa47e8abf7034b52c1b5ca93bff::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
