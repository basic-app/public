<?php

use BasicApp\Helpers\Url;
use BasicApp\Site\SiteEvents;
use BasicApp\Menu\MenuEvents;
use BasicApp\Member\MemberEvents;
use BasicApp\Block\BlockEvents;

$theme = service('theme');

SiteEvents::registerAssets($theme->head, $theme->beginBody, $theme->endBody);

if (class_exists(MenuEvents::class))
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

if (class_exists(MemberEvents::class))
{
    $userMenu = MemberEvents::userMenu();
}
else
{
    $userMenu = [];
}

$accountMenu = SiteEvents::accountMenu();

$defaultTitle = 'My Site';

$siteName = 'My Site';

$copyright = '&copy; My Company {year}'; 

$defaultDescription = 'Default page description';

if (class_exists(BlockEvents::class))
{
    $siteName = block('layout.siteName', $siteName);
    $copyright = block('layout.copyright', $copyright);
    $defaultTitle = block('layout.defaultTitle', $defaultTitle);
    $defaultDescription = block('layout.defaultDescription', $defaultDescription);
}

$session = service('session');

$params = SiteEvents::mainLayout([
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