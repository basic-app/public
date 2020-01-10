<?php

use BasicApp\Helpers\Url;
use BasicApp\Public\PublicEvents;
use BasicApp\Site\SiteEvents;

$theme = service('theme');

PublicEvents::registerAssets($theme->head, $theme->beginBody, $theme->endBody);

if (class_exists(BasicApp\Site\SiteEvents::class))
{
    $mainMenu = menu_items('main', true, ['menu_name' => 'Main Menu']);
}
else
{
    $mainMenu = [];
}

if (array_key_exists('mainMenu', $this->data))
{
    $mainMenu = array_merge_recursive($mainMenu, $this->data['mainMenu']);
}

$userMenu = PublicEvents::userMenu();

$accountMenu = PublicEvents::accountMenu();

$defaultTitle = 'My Site';

$siteName = 'My Site';

$copyright = '&copy; My Company {year}'; 

$defaultDescription = 'Default page description';

if (class_exists(SiteEvents::class))
{
    $siteName = block('layout.siteName', $siteName);
    $copyright = block('layout.copyright', $copyright);
    $defaultTitle = block('layout.defaultTitle', $defaultTitle);
    $defaultDescription = block('layout.defaultDescription', $defaultDescription);
}

$session = service('session');

$params = PublicEvents::mainLayout([
    'title' => array_key_exists('title', $this->data) ? $this->data['title'] : $defaultTitle,
    'siteName' => $siteName,
    'mainMenu' => $mainMenu,
    'userMenu' => $userMenu,
    'accountMenu' => $accountMenu,
    'actionMenu' => array_key_exists('actionMenu', $this->data) ? $this->data['actionMenu'] : [],
    'breadcrumbs' => array_key_exists('breadcrumbs', $this->data) ? $this->data['breadcrumbs'] : [],
    'content' => $content,
    'copyright' => $copyright,
    'description' => array_key_exists('description', $this->data) ? $this->data['description'] : $defaultDescription,
    'successMessages' => (array) $session->getFlashdata('success'),
    'errorMessages' => (array) $session->getFlashdata('error'),
    'infoMessages' => (array) $session->getFlashdata('info')
]);

echo $theme->mainLayout($params);