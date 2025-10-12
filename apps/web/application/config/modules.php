<?php

/** ---------------------------------------------------------------------------------
 * NEXTLOOP NOTES
 * Do NOT format this document, use Nwidart\Modules\Commands; will be deleted 
 *-----------------------------------------------------------------------------------*/

use Nwidart\Modules\Activators\FileActivator;
use Nwidart\Modules\Commands;

return [

    /*
    |--------------------------------------------------------------------------
    | Module Namespace
    |--------------------------------------------------------------------------
    |
    | Default module namespace.
    |
     */

    'namespace' => 'Modules',

    /*
    |--------------------------------------------------------------------------
    | Module Stubs
    |--------------------------------------------------------------------------
    |
    | Default module stubs.
    |
     */

    'stubs' => [
        'enabled' => true,
        'path' => base_path('vendor/nwidart/laravel-modules/src/Commands/stubs'),
        'files' => [
            'routes/api' => 'Routes/api.php',
            'scaffold/config' => 'Config/config.php',
            'composer' => 'composer.json',
            'package' => 'package.json',

            //NEXTLOOP - CORE
            'nextloop-module-stubs/lang/lang.php' => 'Resources/lang/english/lang.php',
            'nextloop-module-stubs/config.json' => 'config.json',
            'nextloop-module-stubs/config/config.php' => 'Config/config.php',
            'nextloop-module-stubs/module.json' => 'module.json',
            'nextloop-module-stubs/models/SCAFFOLDING.php' => 'Models/SCAFFOLDING.php',
            'nextloop-module-stubs/controllers/SCAFFOLDING.php' => 'Http/Controllers/SCAFFOLDING.php',
            'nextloop-module-stubs/controllers/settings/SCAFFOLDING.php' => 'Http/Controllers/Settings/SCAFFOLDING.php',

            'nextloop-module-stubs/cronjobs/SCAFFOLDING.php' => 'Cronjobs/SCAFFOLDING.php',


            //NEXTLOOP - PROVIDERS
            'nextloop-module-stubs/providers/ModuleServiceProvider.php' => 'Providers/ModuleServiceProvider.php',
            'nextloop-module-stubs/providers/CronServiceProvider.php' => 'Providers/CronServiceProvider.php',
            'nextloop-module-stubs/providers/RouteServiceProvider.php' => 'Providers/RouteServiceProvider.php',
            'nextloop-module-stubs/providers/ListenerServiceProvider.php' => 'Providers/ListenerServiceProvider.php',

            //NEXTLOOP - ROUTES
            'nextloop-module-stubs/routes/web.php' => ['STUDLY_NAME', 'LOWER_NAME'],


            //NEXTLOOP - MIDDLEWARE
            'nextloop-module-stubs/middleware/SCAFFOLDING/Create.php' => 'Http/Middleware/SCAFFOLDING/Create.php',
            'nextloop-module-stubs/middleware/SCAFFOLDING/Destroy.php' => 'Http/Middleware/SCAFFOLDING/Destroy.php',
            'nextloop-module-stubs/middleware/SCAFFOLDING/Edit.php' => 'Http/Middleware/SCAFFOLDING/Edit.php',
            'nextloop-module-stubs/middleware/SCAFFOLDING/Index.php' => 'Http/Middleware/SCAFFOLDING/Index.php',
            'nextloop-module-stubs/middleware/SCAFFOLDING/Show.php' => 'Http/Middleware/SCAFFOLDING/Show.php',


            //NEXTLOOP - VIEWS
            'nextloop-module-stubs/views/SCAFFOLDING/wrapper.blade.php' => 'Resources/views/SCAFFOLDING/wrapper.blade.php',
            'nextloop-module-stubs/views/SCAFFOLDING/tabswrapper.blade.php' => 'Resources/views/SCAFFOLDING/tabswrapper.blade.php',
            'nextloop-module-stubs/views/SCAFFOLDING/table/wrapper.blade.php' => 'Resources/views/SCAFFOLDING/table/wrapper.blade.php',
            'nextloop-module-stubs/views/SCAFFOLDING/table/table.blade.php' => 'Resources/views/SCAFFOLDING/table/table.blade.php',
            'nextloop-module-stubs/views/SCAFFOLDING/table/ajax.blade.php' => 'Resources/views/SCAFFOLDING/table/ajax.blade.php',
            'nextloop-module-stubs/views/SCAFFOLDING/modals/add-edit.blade.php' => 'Resources/views/SCAFFOLDING/modals/add-edit.blade.php',
            'nextloop-module-stubs/views/SCAFFOLDING/modals/show.blade.php' => 'Resources/views/SCAFFOLDING/modals/show.blade.php',
            'nextloop-module-stubs/views/SCAFFOLDING/misc/filter.blade.php' => 'Resources/views/SCAFFOLDING/misc/filter.blade.php',
            'nextloop-module-stubs/views/SCAFFOLDING/misc/list-page-actions.blade.php' => 'Resources/views/SCAFFOLDING/misc/list-page-actions.blade.php',
            'nextloop-module-stubs/views/settings/SCAFFOLDING/page.blade.php' => 'Resources/views/settings/SCAFFOLDING/page.blade.php',


            //NEXTLOOP - RESOURCES
            'nextloop-module-stubs/js/events.js' => 'Resources/assets/js/events.js',
            'nextloop-module-stubs/css/module.scss' => 'Resources/assets/css/module.scss',
            'nextloop-module-stubs/css/module.css' => 'Resources/assets/css/module.css',
            'nextloop-module-stubs/css/custom.scss' => 'Resources/assets/css/custom.scss',
            'nextloop-module-stubs/css/custom.css' => 'Resources/assets/css/custom.css',

            //NEXTLOOP - RESPONSES
            'nextloop-module-stubs/responses/SCAFFOLDING/IndexResponse.php' => 'Http/Responses/SCAFFOLDING/IndexResponse.php',
            'nextloop-module-stubs/responses/SCAFFOLDING/StoreResponse.php' => 'Http/Responses/SCAFFOLDING/StoreResponse.php',
            'nextloop-module-stubs/responses/SCAFFOLDING/EditResponse.php' => 'Http/Responses/SCAFFOLDING/EditResponse.php',
            'nextloop-module-stubs/responses/SCAFFOLDING/UpdateResponse.php' => 'Http/Responses/SCAFFOLDING/UpdateResponse.php',
            'nextloop-module-stubs/responses/SCAFFOLDING/CreateResponse.php' => 'Http/Responses/SCAFFOLDING/CreateResponse.php',
            'nextloop-module-stubs/responses/SCAFFOLDING/DestroyResponse.php' => 'Http/Responses/SCAFFOLDING/DestroyResponse.php',
            'nextloop-module-stubs/responses/settings/SCAFFOLDING/IndexResponse.php' => 'Http/Responses/Settings/SCAFFOLDING/IndexResponse.php',
            'nextloop-module-stubs/responses/settings/SCAFFOLDING/UpdateResponse.php' => 'Http/Responses/Settings/SCAFFOLDING/UpdateResponse.php',


            //NEXTLOOP - REPOSITORY
            'nextloop-module-stubs/repositories/SCAFFOLDING.php' => 'Repositories/SCAFFOLDING.php',

            //NEXTLOOP - REQUESTS
            'nextloop-module-stubs/requests/SCAFFOLDING.php' => 'Http/Requests/SCAFFOLDING.php',
            'nextloop-module-stubs/requests/settings/SCAFFOLDING.php' => 'Http/Requests/Settings/SCAFFOLDING.php',

            //NEXTLOOP - HELPERS
            'nextloop-module-stubs/helpers/Helpers.php' => 'Helpers/Helpers.php',
            'nextloop-module-stubs/routes/web.php' => 'Routes/web.php',

            //NEXTLOOP - MAIL
            'nextloop-module-stubs/emails/SCAFFOLDING.php' => 'Emails/SCAFFOLDING.php',

            //NEXTLOOP - SETUP SQL
            'nextloop-module-stubs/module.sql' => 'module.sql',

        ],
        'replacements' => [
            'routes/api' => ['LOWER_NAME'],
            'webpack' => ['LOWER_NAME'],
            'json' => ['LOWER_NAME', 'STUDLY_NAME', 'MODULE_NAMESPACE', 'PROVIDER_NAMESPACE'],
            'views/index' => ['LOWER_NAME'],
            'views/master' => ['LOWER_NAME', 'STUDLY_NAME'],
            'scaffold/config' => ['STUDLY_NAME'],
            'composer' => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'VENDOR',
                'AUTHOR_NAME',
                'AUTHOR_EMAIL',
                'MODULE_NAMESPACE',
                'PROVIDER_NAMESPACE',
            ],

            //NEXTLOOP - CORE
            'nextloop-module-stubs/config.json' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/config/config.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/module.json' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/models/SCAFFOLDING.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/controllers/SCAFFOLDING.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/controllers/settings/SCAFFOLDING.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/cronjobs/SCAFFOLDING.php' => ['STUDLY_NAME', 'LOWER_NAME'],

            //NEXTLOOP - PROVIDERS
            'nextloop-module-stubs/providers/ModuleServiceProvider.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/providers/CronServiceProvider.php' => ['STUDLY_NAME', 'LOWER_NAME'],            
            'nextloop-module-stubs/providers/RouteServiceProvider.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/providers/ListenerServiceProvider.php' => ['STUDLY_NAME', 'LOWER_NAME'],

            //NEXTLOOP - WEB
            'nextloop-module-stubs/routes/web.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            
            //NEXTLOOP - MIDDLEWARE
            'nextloop-module-stubs/middleware/SCAFFOLDING/Create.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/middleware/SCAFFOLDING/Destroy.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/middleware/SCAFFOLDING/Edit.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/middleware/SCAFFOLDING/Index.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/middleware/SCAFFOLDING/Show.php' => ['STUDLY_NAME', 'LOWER_NAME'],

            //NEXTLOOP - VIEWS
            'nextloop-module-stubs/views/SCAFFOLDING/wrapper.blade.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/views/SCAFFOLDING/tabswrapper.blade.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/views/SCAFFOLDING/table/wrapper.blade.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/views/SCAFFOLDING/table/table.blade.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/views/SCAFFOLDING/table/ajax.blade.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/views/SCAFFOLDING/modals/add-edit.blade.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/views/SCAFFOLDING/modals/show.blade.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/views/SCAFFOLDING/misc/filter.blade.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/views/SCAFFOLDING/misc/list-page-actions.blade.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/views/settings/SCAFFOLDING/page.blade.php' => ['STUDLY_NAME', 'LOWER_NAME'],

            //NEXTLOOP - RESOURCES
            'nextloop-module-stubs/js/events.js' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/css/module.scss'=> ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/css/module.css' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/css/custom.scss' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/css/custom.css' => ['STUDLY_NAME', 'LOWER_NAME'],

            //NEXTLOOP - RESPONSES
            'nextloop-module-stubs/responses/SCAFFOLDING/IndexResponse.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/responses/SCAFFOLDING/StoreResponse.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/responses/SCAFFOLDING/EditResponse.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/responses/SCAFFOLDING/UpdateResponse.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/responses/SCAFFOLDING/CreateResponse.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/responses/SCAFFOLDING/DestroyResponse.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/responses/settings/SCAFFOLDING/IndexResponse.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/responses/settings/SCAFFOLDING/UpdateResponse.php' => ['STUDLY_NAME', 'LOWER_NAME'],

            //NEXTLOOP - REPOSITORIES
            'nextloop-module-stubs/repositories/SCAFFOLDING.php' => ['STUDLY_NAME', 'LOWER_NAME'],

            //NEXTLOOP - REQUESTS
            'nextloop-module-stubs/requests/SCAFFOLDING.php' => ['STUDLY_NAME', 'LOWER_NAME'],
            'nextloop-module-stubs/requests/settings/SCAFFOLDING.php' => ['STUDLY_NAME', 'LOWER_NAME'],

            //NEXTLOOP - HELPERS
            'nextloop-module-stubs/helpers/Helpers.php' => ['STUDLY_NAME', 'LOWER_NAME'],

            //NEXTLOOP - MAIL
            'nextloop-module-stubs/emails/SCAFFOLDING.php' => ['STUDLY_NAME', 'LOWER_NAME'],

            //NEXTLOOP - SETUP SQL
            'nextloop-module-stubs/module.sql' => ['STUDLY_NAME', 'LOWER_NAME'],
            

        ],
        'gitkeep' => false,
    ],
    'paths' => [
        /*
        |--------------------------------------------------------------------------
        | Modules path
        |--------------------------------------------------------------------------
        |
        | This path used for save the generated module. This path also will be added
        | automatically to list of scanned folders.
        |
         */

        'modules' => base_path('Modules'),
        /*
        |--------------------------------------------------------------------------
        | Modules assets path
        |--------------------------------------------------------------------------
        |
        | Here you may update the modules assets path.
        |
         */

        'assets' => public_path('modules'),
        /*
        |--------------------------------------------------------------------------
        | The migrations path
        |--------------------------------------------------------------------------
        |
        | Where you run 'module:publish-migration' command, where do you publish the
        | the migration files?
        |
         */

        'migration' => base_path('database/migrations'),
        /*
        |--------------------------------------------------------------------------
        | Generator path
        |--------------------------------------------------------------------------
        | Customise the paths where the folders will be generated.
        | Set the generate key to false to not generate that folder
         */
        'generator' => [
            'config' => ['path' => 'Config', 'generate' => true],
            'command' => ['path' => 'Console', 'generate' => false],
            'migration' => ['path' => 'Database/Migrations', 'generate' => true],
            'seeder' => ['path' => 'Database/Seeders', 'generate' => true],
            'factory' => ['path' => 'Database/factories', 'generate' => true],
            'model' => ['path' => 'Models', 'generate' => true],
            'routes' => ['path' => 'Routes', 'generate' => true],
            'controller' => ['path' => 'Http/Controllers', 'generate' => true],
            'filter' => ['path' => 'Http/Middleware', 'generate' => true],
            'request' => ['path' => 'Http/Requests', 'generate' => true],
            'provider' => ['path' => 'Providers', 'generate' => false],
            'assets' => ['path' => 'Resources/assets', 'generate' => true],
            'lang' => ['path' => 'Resources/lang', 'generate' => true],
            'views' => ['path' => 'Resources/views', 'generate' => true],
            'test' => ['path' => 'Tests/Unit', 'generate' => false],
            'test-feature' => ['path' => 'Tests/Feature', 'generate' => false],
            'repository' => ['path' => 'Repositories', 'generate' => true],
            'event' => ['path' => 'Events', 'generate' => true],
            'listener' => ['path' => 'Listeners', 'generate' => true],
            'policies' => ['path' => 'Policies', 'generate' => false],
            'rules' => ['path' => 'Rules', 'generate' => false],
            'jobs' => ['path' => 'Jobs', 'generate' => false],
            'emails' => ['path' => 'Emails', 'generate' => true],
            'notifications' => ['path' => 'Notifications', 'generate' => false],
            'resource' => ['path' => 'Transformers', 'generate' => false],
            'component-view' => ['path' => 'Resources/views/components', 'generate' => false],
            'component-class' => ['path' => 'View/Components', 'generate' => false],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Package commands
    |--------------------------------------------------------------------------
    |
    | Here you can define which commands will be visible and used in your
    | application. If for example you don't use some of the commands provided
    | you can simply comment them out.
    |
     */
    'commands' => [
        Commands\CommandMakeCommand::class,
        Commands\ComponentClassMakeCommand::class,
        Commands\ComponentViewMakeCommand::class,
        Commands\ControllerMakeCommand::class,
        Commands\DisableCommand::class,
        Commands\DumpCommand::class,
        Commands\EnableCommand::class,
        Commands\EventMakeCommand::class,
        Commands\JobMakeCommand::class,
        Commands\ListenerMakeCommand::class,
        Commands\MailMakeCommand::class,
        Commands\MiddlewareMakeCommand::class,
        Commands\NotificationMakeCommand::class,
        Commands\ProviderMakeCommand::class,
        Commands\RouteProviderMakeCommand::class,
        Commands\InstallCommand::class,
        Commands\ListCommand::class,
        Commands\ModuleDeleteCommand::class,
        Commands\ModuleMakeCommand::class,
        Commands\FactoryMakeCommand::class,
        Commands\PolicyMakeCommand::class,
        Commands\RequestMakeCommand::class,
        Commands\RuleMakeCommand::class,
        Commands\MigrateCommand::class,
        Commands\MigrateRefreshCommand::class,
        Commands\MigrateResetCommand::class,
        Commands\MigrateRollbackCommand::class,
        Commands\MigrateStatusCommand::class,
        Commands\MigrationMakeCommand::class,
        Commands\ModelMakeCommand::class,
        Commands\PublishCommand::class,
        Commands\PublishConfigurationCommand::class,
        Commands\PublishMigrationCommand::class,
        Commands\PublishTranslationCommand::class,
        Commands\SeedCommand::class,
        Commands\SeedMakeCommand::class,
        Commands\SetupCommand::class,
        Commands\UnUseCommand::class,
        Commands\UpdateCommand::class,
        Commands\UseCommand::class,
        Commands\ResourceMakeCommand::class,
        Commands\TestMakeCommand::class,
        Commands\LaravelModulesV6Migrator::class,
        Commands\ComponentClassMakeCommand::class,
        Commands\ComponentViewMakeCommand::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Scan Path
    |--------------------------------------------------------------------------
    |
    | Here you define which folder will be scanned. By default will scan vendor
    | directory. This is useful if you host the package in packagist website.
    |
     */

    'scan' => [
        'enabled' => false,
        'paths' => [
            base_path('vendor/*/*'),
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Composer File Template
    |--------------------------------------------------------------------------
    |
    | Here is the config for composer.json file, generated by this package
    |
     */

    'composer' => [
        'vendor' => 'GrowCRM',
        'author' => [
            'name' => 'Grow CRM',
            'email' => 'support@mycrm.io',
        ],
        'composer-output' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | Here is the config for setting up caching feature.
    |
     */
    'cache' => [
        'enabled' => false,
        'key' => 'laravel-modules',
        'lifetime' => 60,
    ],
    /*
    |--------------------------------------------------------------------------
    | Choose what laravel-modules will register as custom namespaces.
    | Setting one to false will require you to register that part
    | in your own Service Provider class.
    |--------------------------------------------------------------------------
     */
    'register' => [
        'translations' => true,
        /**
         * load files on boot or register method
         *
         * Note: boot not compatible with asgardcms
         *
         * @example boot|register
         */
        'files' => 'register',
    ],

    /*
    |--------------------------------------------------------------------------
    | Activators
    |--------------------------------------------------------------------------
    |
    | You can define new types of activators here, file, database etc. The only
    | required parameter is 'class'.
    | The file activator will store the activation status in storage/installed_modules
     */
    'activators' => [
        'file' => [
            'class' => FileActivator::class,
            'statuses-file' => base_path('modules_statuses.json'),
            'cache-key' => 'activator.installed',
            'cache-lifetime' => 604800,
        ],
    ],

    'activator' => 'file',
];
