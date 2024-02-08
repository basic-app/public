<?php

use Config\Database;
use BasicApp\Admin\AdminEvents;
use BasicApp\Helpers\Url;
use BasicApp\Site\Forms\SiteConfigForm;
use BasicApp\System\SystemEvents;
use BasicApp\System\Events\SystemSeedEvent;
use BasicApp\Site\Database\Seeds\SiteSeeder;
use BasicApp\Config\Controllers\Admin\Config as ConfigController;
use CodeIgniter\Events\Events;

if (class_exists(AdminEvents::class))
{
    AdminEvents::onOptionsMenu(function($event)
    {
        $event->items[SiteConfigForm::class] = [
            'label' => t('admin.menu', 'System'),
            'url' => Url::createUrl('admin/config', ['class' => SiteConfigForm::class]),
            'icon' => 'fa fa-fw fa-cogs'
        ];
    });
}

Events::on('pre_system', function()
{
    $config = config(\Config\Pager::class);

    $config->templates['theme'] = 'BasicApp\Site\pager';
});

SystemEvents::onSeed(function(SystemSeedEvent $event)
{
    $seeder = Database::seeder();

    $seeder->call(SiteSeeder::class);
});