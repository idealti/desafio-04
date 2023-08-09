<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit686d5f85e168433f92df2e6059b6cfce
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit686d5f85e168433f92df2e6059b6cfce', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit686d5f85e168433f92df2e6059b6cfce', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit686d5f85e168433f92df2e6059b6cfce::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}