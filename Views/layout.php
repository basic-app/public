<?php

use BasicApp\Site\SiteEvents;

$theme = service('theme');

SiteEvents::registerAssets($theme->head, $theme->beginBody, $theme->endBody);

$params = SiteEvents::mainLayout([
    'enableCard' => $this->data['enableCard'] ?? true,
    'cardTitle' => $this->data['cardTitle'] ?? null,
    'actionMenu' => $this->data['actionMenu'] ?? [],
    'breadcrumbs' => $this->data['breadcrumbs'] ?? [],
    'content' => $content,
    'title' => $this->data['title'] ?? null
]);

echo $theme->mainLayout($params);