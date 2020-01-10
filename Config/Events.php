<?php

use BasicApp\Admin\AdminEvents;
use BasicApp\Helpers\Url;
use BasicApp\Site\Forms\SiteConfigForm;

if (class_exists(AdminEvents::class))
{
    AdminEvents::onOptionsMenu(function($event)
    {
        if (BasicApp\Config\Controllers\Admin\Config::checkAccess())
        {
            $event->items[SiteConfigForm::class] = [
                'label' => t('admin.menu', 'System'),
                'icon' => 'fa fa-wrench',
                'url' => Url::createUrl('admin/config', ['class' => SiteConfigForm::class])
            ];
        }
    });
}