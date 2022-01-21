<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2201770520a8ece95e14484947b79447
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WpActionNetworkEvents\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WpActionNetworkEvents\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $fallbackDirsPsr0 = array (
        0 => __DIR__ . '/..' . '/elliotchance/iterator/tests',
        1 => __DIR__ . '/..' . '/elliotchance/iterator/src',
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Elliotchance\\Iterator\\AbstractPagedIterator' => __DIR__ . '/..' . '/elliotchance/iterator/src/Elliotchance/Iterator/AbstractPagedIterator.php',
        'Elliotchance\\Iterator\\PagedIteratorTest' => __DIR__ . '/..' . '/elliotchance/iterator/tests/Elliotchance/Iterator/PagedIteratorTest.php',
        'WpActionNetworkEvents\\App\\Admin\\Admin' => __DIR__ . '/../..' . '/src/App/Admin/Admin.php',
        'WpActionNetworkEvents\\App\\Admin\\Options' => __DIR__ . '/../..' . '/src/App/Admin/Options.php',
        'WpActionNetworkEvents\\App\\Blocks\\Blocks' => __DIR__ . '/../..' . '/src/App/Blocks/Blocks.php',
        'WpActionNetworkEvents\\App\\Blocks\\Fields\\Fields' => __DIR__ . '/../..' . '/src/App/Blocks/Fields/Fields.php',
        'WpActionNetworkEvents\\App\\Blocks\\Fields\\Meta' => __DIR__ . '/../..' . '/src/App/Blocks/Fields/Meta.php',
        'WpActionNetworkEvents\\App\\Blocks\\Patterns' => __DIR__ . '/../..' . '/src/App/Blocks/Patterns.php',
        'WpActionNetworkEvents\\App\\Frontend\\Frontend' => __DIR__ . '/../..' . '/src/App/Frontend/Frontend.php',
        'WpActionNetworkEvents\\App\\General\\ContentFilters' => __DIR__ . '/../..' . '/src/App/General/ContentFilters.php',
        'WpActionNetworkEvents\\App\\General\\CustomFields' => __DIR__ . '/../..' . '/src/App/General/CustomFields.php',
        'WpActionNetworkEvents\\App\\General\\PostTypes\\Event' => __DIR__ . '/../..' . '/src/App/General/PostTypes/Event.php',
        'WpActionNetworkEvents\\App\\General\\PostTypes\\PostTypes' => __DIR__ . '/../..' . '/src/App/General/PostTypes/PostTypes.php',
        'WpActionNetworkEvents\\App\\General\\Queries' => __DIR__ . '/../..' . '/src/App/General/Queries.php',
        'WpActionNetworkEvents\\App\\General\\Taxonomies\\EventTag' => __DIR__ . '/../..' . '/src/App/General/Taxonomies/EventTag.php',
        'WpActionNetworkEvents\\App\\General\\Taxonomies\\EventType' => __DIR__ . '/../..' . '/src/App/General/Taxonomies/EventType.php',
        'WpActionNetworkEvents\\App\\General\\Taxonomies\\Taxonomies' => __DIR__ . '/../..' . '/src/App/General/Taxonomies/Taxonomies.php',
        'WpActionNetworkEvents\\App\\Integration\\GetEvents' => __DIR__ . '/../..' . '/src/App/Integration/GetEvents.php',
        'WpActionNetworkEvents\\App\\Integration\\Parse' => __DIR__ . '/../..' . '/src/App/Integration/Parse.php',
        'WpActionNetworkEvents\\App\\Integration\\Process' => __DIR__ . '/../..' . '/src/App/Integration/Process.php',
        'WpActionNetworkEvents\\App\\Integration\\RestFilters' => __DIR__ . '/../..' . '/src/App/Integration/RestFilters.php',
        'WpActionNetworkEvents\\App\\Integration\\Sync' => __DIR__ . '/../..' . '/src/App/Integration/Sync.php',
        'WpActionNetworkEvents\\Common\\Abstracts\\Base' => __DIR__ . '/../..' . '/src/Common/Abstracts/Base.php',
        'WpActionNetworkEvents\\Common\\Abstracts\\GetData' => __DIR__ . '/../..' . '/src/Common/Abstracts/GetData.php',
        'WpActionNetworkEvents\\Common\\Abstracts\\PostType' => __DIR__ . '/../..' . '/src/Common/Abstracts/PostType.php',
        'WpActionNetworkEvents\\Common\\Abstracts\\Taxonomy' => __DIR__ . '/../..' . '/src/Common/Abstracts/Taxonomy.php',
        'WpActionNetworkEvents\\Common\\I18n' => __DIR__ . '/../..' . '/src/Common/I18n.php',
        'WpActionNetworkEvents\\Common\\Loader' => __DIR__ . '/../..' . '/src/Common/Loader.php',
        'WpActionNetworkEvents\\Common\\Plugin' => __DIR__ . '/../..' . '/src/Common/Plugin.php',
        'WpActionNetworkEvents\\Common\\Traits\\Singleton' => __DIR__ . '/../..' . '/src/Common/Traits/Singleton.php',
        'WpActionNetworkEvents\\Common\\Util\\Iterator' => __DIR__ . '/../..' . '/src/Common/Util/Iterator.php',
        'WpActionNetworkEvents\\Common\\Util\\TemplateLoader' => __DIR__ . '/../..' . '/src/Common/Util/TemplateLoader.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2201770520a8ece95e14484947b79447::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2201770520a8ece95e14484947b79447::$prefixDirsPsr4;
            $loader->fallbackDirsPsr0 = ComposerStaticInit2201770520a8ece95e14484947b79447::$fallbackDirsPsr0;
            $loader->classMap = ComposerStaticInit2201770520a8ece95e14484947b79447::$classMap;

        }, null, ClassLoader::class);
    }
}
