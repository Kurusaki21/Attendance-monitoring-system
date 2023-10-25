<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitca5a4336ad827d12286b67d4a3798845
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Picqer\\Barcode\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Picqer\\Barcode\\' => 
        array (
            0 => __DIR__ . '/..' . '/picqer/php-barcode-generator/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitca5a4336ad827d12286b67d4a3798845::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitca5a4336ad827d12286b67d4a3798845::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitca5a4336ad827d12286b67d4a3798845::$classMap;

        }, null, ClassLoader::class);
    }
}