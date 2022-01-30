<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4fc7937039e0203b4e0abbc9d1297d90
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4fc7937039e0203b4e0abbc9d1297d90::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4fc7937039e0203b4e0abbc9d1297d90::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4fc7937039e0203b4e0abbc9d1297d90::$classMap;

        }, null, ClassLoader::class);
    }
}