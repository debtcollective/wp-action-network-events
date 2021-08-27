<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitef2b9c6e8d24c4b2eb0fad50b4f7d0d1
{
    public static $files = array (
        '6632f90381dd49c5fe745d09406b9abb' => __DIR__ . '/..' . '/htmlburger/carbon-field-number/field.php',
        'a5f882d89ab791a139cd2d37e50cdd80' => __DIR__ . '/..' . '/tgmpa/tgm-plugin-activation/class-tgm-plugin-activation.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WpActionNetworkEvents\\' => 22,
        ),
        'C' => 
        array (
            'Carbon_Fields\\' => 14,
            'Carbon_Field_Rest_Api_Select\\' => 29,
            'Carbon_Field_Number\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WpActionNetworkEvents\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Carbon_Fields\\' => 
        array (
            0 => __DIR__ . '/..' . '/htmlburger/carbon-fields/core',
        ),
        'Carbon_Field_Rest_Api_Select\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'Carbon_Field_Number\\' => 
        array (
            0 => __DIR__ . '/..' . '/htmlburger/carbon-field-number/core',
        ),
    );

    public static $classMap = array (
        'Carbon_Field_Number\\Number_Field' => __DIR__ . '/..' . '/htmlburger/carbon-field-number/core/Number_Field.php',
        'Carbon_Fields\\Block' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Block.php',
        'Carbon_Fields\\Carbon_Fields' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Carbon_Fields.php',
        'Carbon_Fields\\Container' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container.php',
        'Carbon_Fields\\Container\\Block_Container' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Block_Container.php',
        'Carbon_Fields\\Container\\Broken_Container' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Broken_Container.php',
        'Carbon_Fields\\Container\\Comment_Meta_Container' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Comment_Meta_Container.php',
        'Carbon_Fields\\Container\\Condition\\Blog_ID_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Blog_ID_Condition.php',
        'Carbon_Fields\\Container\\Condition\\Boolean_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Boolean_Condition.php',
        'Carbon_Fields\\Container\\Condition\\Comparer\\Any_Contain_Comparer' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Comparer/Any_Contain_Comparer.php',
        'Carbon_Fields\\Container\\Condition\\Comparer\\Any_Equality_Comparer' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Comparer/Any_Equality_Comparer.php',
        'Carbon_Fields\\Container\\Condition\\Comparer\\Comparer' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Comparer/Comparer.php',
        'Carbon_Fields\\Container\\Condition\\Comparer\\Contain_Comparer' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Comparer/Contain_Comparer.php',
        'Carbon_Fields\\Container\\Condition\\Comparer\\Custom_Comparer' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Comparer/Custom_Comparer.php',
        'Carbon_Fields\\Container\\Condition\\Comparer\\Equality_Comparer' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Comparer/Equality_Comparer.php',
        'Carbon_Fields\\Container\\Condition\\Comparer\\Scalar_Comparer' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Comparer/Scalar_Comparer.php',
        'Carbon_Fields\\Container\\Condition\\Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Condition.php',
        'Carbon_Fields\\Container\\Condition\\Current_User_Capability_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Current_User_Capability_Condition.php',
        'Carbon_Fields\\Container\\Condition\\Current_User_ID_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Current_User_ID_Condition.php',
        'Carbon_Fields\\Container\\Condition\\Current_User_Role_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Current_User_Role_Condition.php',
        'Carbon_Fields\\Container\\Condition\\Factory' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Factory.php',
        'Carbon_Fields\\Container\\Condition\\Post_Ancestor_ID_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Post_Ancestor_ID_Condition.php',
        'Carbon_Fields\\Container\\Condition\\Post_Format_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Post_Format_Condition.php',
        'Carbon_Fields\\Container\\Condition\\Post_ID_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Post_ID_Condition.php',
        'Carbon_Fields\\Container\\Condition\\Post_Level_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Post_Level_Condition.php',
        'Carbon_Fields\\Container\\Condition\\Post_Parent_ID_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Post_Parent_ID_Condition.php',
        'Carbon_Fields\\Container\\Condition\\Post_Template_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Post_Template_Condition.php',
        'Carbon_Fields\\Container\\Condition\\Post_Term_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Post_Term_Condition.php',
        'Carbon_Fields\\Container\\Condition\\Post_Type_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Post_Type_Condition.php',
        'Carbon_Fields\\Container\\Condition\\Term_Ancestor_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Term_Ancestor_Condition.php',
        'Carbon_Fields\\Container\\Condition\\Term_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Term_Condition.php',
        'Carbon_Fields\\Container\\Condition\\Term_Level_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Term_Level_Condition.php',
        'Carbon_Fields\\Container\\Condition\\Term_Parent_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Term_Parent_Condition.php',
        'Carbon_Fields\\Container\\Condition\\Term_Taxonomy_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/Term_Taxonomy_Condition.php',
        'Carbon_Fields\\Container\\Condition\\User_Capability_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/User_Capability_Condition.php',
        'Carbon_Fields\\Container\\Condition\\User_ID_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/User_ID_Condition.php',
        'Carbon_Fields\\Container\\Condition\\User_Role_Condition' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Condition/User_Role_Condition.php',
        'Carbon_Fields\\Container\\Container' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Container.php',
        'Carbon_Fields\\Container\\Fulfillable\\Fulfillable' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Fulfillable/Fulfillable.php',
        'Carbon_Fields\\Container\\Fulfillable\\Fulfillable_Collection' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Fulfillable/Fulfillable_Collection.php',
        'Carbon_Fields\\Container\\Fulfillable\\Translator\\Array_Translator' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Fulfillable/Translator/Array_Translator.php',
        'Carbon_Fields\\Container\\Fulfillable\\Translator\\Json_Translator' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Fulfillable/Translator/Json_Translator.php',
        'Carbon_Fields\\Container\\Fulfillable\\Translator\\Translator' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Fulfillable/Translator/Translator.php',
        'Carbon_Fields\\Container\\Nav_Menu_Item_Container' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Nav_Menu_Item_Container.php',
        'Carbon_Fields\\Container\\Network_Container' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Network_Container.php',
        'Carbon_Fields\\Container\\Post_Meta_Container' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Post_Meta_Container.php',
        'Carbon_Fields\\Container\\Repository' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Repository.php',
        'Carbon_Fields\\Container\\Term_Meta_Container' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Term_Meta_Container.php',
        'Carbon_Fields\\Container\\Theme_Options_Container' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Theme_Options_Container.php',
        'Carbon_Fields\\Container\\User_Meta_Container' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/User_Meta_Container.php',
        'Carbon_Fields\\Container\\Widget_Container' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Container/Widget_Container.php',
        'Carbon_Fields\\Datastore\\Comment_Meta_Datastore' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Datastore/Comment_Meta_Datastore.php',
        'Carbon_Fields\\Datastore\\Datastore' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Datastore/Datastore.php',
        'Carbon_Fields\\Datastore\\Datastore_Holder_Interface' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Datastore/Datastore_Holder_Interface.php',
        'Carbon_Fields\\Datastore\\Datastore_Interface' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Datastore/Datastore_Interface.php',
        'Carbon_Fields\\Datastore\\Empty_Datastore' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Datastore/Empty_Datastore.php',
        'Carbon_Fields\\Datastore\\Key_Value_Datastore' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Datastore/Key_Value_Datastore.php',
        'Carbon_Fields\\Datastore\\Meta_Datastore' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Datastore/Meta_Datastore.php',
        'Carbon_Fields\\Datastore\\Nav_Menu_Item_Datastore' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Datastore/Nav_Menu_Item_Datastore.php',
        'Carbon_Fields\\Datastore\\Network_Datastore' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Datastore/Network_Datastore.php',
        'Carbon_Fields\\Datastore\\Post_Meta_Datastore' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Datastore/Post_Meta_Datastore.php',
        'Carbon_Fields\\Datastore\\Term_Meta_Datastore' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Datastore/Term_Meta_Datastore.php',
        'Carbon_Fields\\Datastore\\Theme_Options_Datastore' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Datastore/Theme_Options_Datastore.php',
        'Carbon_Fields\\Datastore\\User_Meta_Datastore' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Datastore/User_Meta_Datastore.php',
        'Carbon_Fields\\Datastore\\Widget_Datastore' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Datastore/Widget_Datastore.php',
        'Carbon_Fields\\Event\\Emitter' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Event/Emitter.php',
        'Carbon_Fields\\Event\\Listener' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Event/Listener.php',
        'Carbon_Fields\\Event\\PersistentListener' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Event/PersistentListener.php',
        'Carbon_Fields\\Event\\SingleEventListener' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Event/SingleEventListener.php',
        'Carbon_Fields\\Exception\\Incorrect_Syntax_Exception' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Exception/Incorrect_Syntax_Exception.php',
        'Carbon_Fields\\Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field.php',
        'Carbon_Fields\\Field\\Association_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Association_Field.php',
        'Carbon_Fields\\Field\\Broken_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Broken_Field.php',
        'Carbon_Fields\\Field\\Checkbox_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Checkbox_Field.php',
        'Carbon_Fields\\Field\\Color_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Color_Field.php',
        'Carbon_Fields\\Field\\Complex_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Complex_Field.php',
        'Carbon_Fields\\Field\\Date_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Date_Field.php',
        'Carbon_Fields\\Field\\Date_Time_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Date_Time_Field.php',
        'Carbon_Fields\\Field\\Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Field.php',
        'Carbon_Fields\\Field\\File_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/File_Field.php',
        'Carbon_Fields\\Field\\Footer_Scripts_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Footer_Scripts_Field.php',
        'Carbon_Fields\\Field\\Gravity_Form_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Gravity_Form_Field.php',
        'Carbon_Fields\\Field\\Group_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Group_Field.php',
        'Carbon_Fields\\Field\\Header_Scripts_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Header_Scripts_Field.php',
        'Carbon_Fields\\Field\\Hidden_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Hidden_Field.php',
        'Carbon_Fields\\Field\\Html_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Html_Field.php',
        'Carbon_Fields\\Field\\Image_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Image_Field.php',
        'Carbon_Fields\\Field\\Map_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Map_Field.php',
        'Carbon_Fields\\Field\\Media_Gallery_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Media_Gallery_Field.php',
        'Carbon_Fields\\Field\\Multiselect_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Multiselect_Field.php',
        'Carbon_Fields\\Field\\Oembed_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Oembed_Field.php',
        'Carbon_Fields\\Field\\Predefined_Options_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Predefined_Options_Field.php',
        'Carbon_Fields\\Field\\Radio_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Radio_Field.php',
        'Carbon_Fields\\Field\\Radio_Image_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Radio_Image_Field.php',
        'Carbon_Fields\\Field\\Rich_Text_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Rich_Text_Field.php',
        'Carbon_Fields\\Field\\Scripts_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Scripts_Field.php',
        'Carbon_Fields\\Field\\Select_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Select_Field.php',
        'Carbon_Fields\\Field\\Separator_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Separator_Field.php',
        'Carbon_Fields\\Field\\Set_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Set_Field.php',
        'Carbon_Fields\\Field\\Sidebar_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Sidebar_Field.php',
        'Carbon_Fields\\Field\\Text_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Text_Field.php',
        'Carbon_Fields\\Field\\Textarea_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Textarea_Field.php',
        'Carbon_Fields\\Field\\Time_Field' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Field/Time_Field.php',
        'Carbon_Fields\\Helper\\Color' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Helper/Color.php',
        'Carbon_Fields\\Helper\\Delimiter' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Helper/Delimiter.php',
        'Carbon_Fields\\Helper\\Helper' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Helper/Helper.php',
        'Carbon_Fields\\Libraries\\Sidebar_Manager\\Sidebar_Manager' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Libraries/Sidebar_Manager/Sidebar_Manager.php',
        'Carbon_Fields\\Loader\\Loader' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Loader/Loader.php',
        'Carbon_Fields\\Pimple\\Container' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Pimple/Container.php',
        'Carbon_Fields\\Pimple\\ServiceProviderInterface' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Pimple/ServiceProviderInterface.php',
        'Carbon_Fields\\Provider\\Container_Condition_Provider' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Provider/Container_Condition_Provider.php',
        'Carbon_Fields\\REST_API\\Decorator' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/REST_API/Decorator.php',
        'Carbon_Fields\\REST_API\\Router' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/REST_API/Router.php',
        'Carbon_Fields\\Service\\Legacy_Storage_Service_v_1_5' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Service/Legacy_Storage_Service_v_1_5.php',
        'Carbon_Fields\\Service\\Meta_Query_Service' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Service/Meta_Query_Service.php',
        'Carbon_Fields\\Service\\REST_API_Service' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Service/REST_API_Service.php',
        'Carbon_Fields\\Service\\Revisions_Service' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Service/Revisions_Service.php',
        'Carbon_Fields\\Service\\Service' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Service/Service.php',
        'Carbon_Fields\\Toolset\\Key_Toolset' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Toolset/Key_Toolset.php',
        'Carbon_Fields\\Toolset\\WP_Toolset' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Toolset/WP_Toolset.php',
        'Carbon_Fields\\Value_Set\\Value_Set' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Value_Set/Value_Set.php',
        'Carbon_Fields\\Walker\\Nav_Menu_Item_Edit_Walker' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Walker/Nav_Menu_Item_Edit_Walker.php',
        'Carbon_Fields\\Widget' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Widget.php',
        'Carbon_Fields\\Widget\\Widget' => __DIR__ . '/..' . '/htmlburger/carbon-fields/core/Widget/Widget.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
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
        'WpActionNetworkEvents\\App\\Integration\\RestFilters' => __DIR__ . '/../..' . '/src/App/Integration/RestFilters.php',
        'WpActionNetworkEvents\\Common\\Abstracts\\Base' => __DIR__ . '/../..' . '/src/Common/Abstracts/Base.php',
        'WpActionNetworkEvents\\Common\\Abstracts\\GetData' => __DIR__ . '/../..' . '/src/Common/Abstracts/GetData.php',
        'WpActionNetworkEvents\\Common\\Abstracts\\PostType' => __DIR__ . '/../..' . '/src/Common/Abstracts/PostType.php',
        'WpActionNetworkEvents\\Common\\Abstracts\\Taxonomy' => __DIR__ . '/../..' . '/src/Common/Abstracts/Taxonomy.php',
        'WpActionNetworkEvents\\Common\\I18n' => __DIR__ . '/../..' . '/src/Common/I18n.php',
        'WpActionNetworkEvents\\Common\\Loader' => __DIR__ . '/../..' . '/src/Common/Loader.php',
        'WpActionNetworkEvents\\Common\\Plugin' => __DIR__ . '/../..' . '/src/Common/Plugin.php',
        'WpActionNetworkEvents\\Common\\Traits\\Singleton' => __DIR__ . '/../..' . '/src/Common/Traits/Singleton.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitef2b9c6e8d24c4b2eb0fad50b4f7d0d1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitef2b9c6e8d24c4b2eb0fad50b4f7d0d1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitef2b9c6e8d24c4b2eb0fad50b4f7d0d1::$classMap;

        }, null, ClassLoader::class);
    }
}
