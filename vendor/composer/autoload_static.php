<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdc1295d9a1d518f8169302c4d47a311f
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Kriosmane\\OpenStreetMap\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Kriosmane\\OpenStreetMap\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdc1295d9a1d518f8169302c4d47a311f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdc1295d9a1d518f8169302c4d47a311f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdc1295d9a1d518f8169302c4d47a311f::$classMap;

        }, null, ClassLoader::class);
    }
}
