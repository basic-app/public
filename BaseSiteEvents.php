<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Site;

use BasicApp\Site\Events\SiteThemesEvent;
use BasicApp\Site\Events\SiteRegisterAssetsEvent;
use BasicApp\Site\Events\SiteMainLayoutEvent;

abstract class BaseSiteEvents extends \CodeIgniter\Events\Events
{

    const EVENT_THEMES = 'ba:themes';
    
    const EVENT_REGISTER_ASSETS = 'ba:register_assets';

    const EVENT_MAIN_LAYOUT = 'ba:main_layout';

    public static function onMainLayout($callback)
    {
        static::on(static::EVENT_MAIN_LAYOUT, $callback);
    }

    public static function onRegisterAssets($callback)
    {
        static::on(static::EVENT_REGISTER_ASSETS, $callback);
    }
    
    public static function onThemes($callback)
    {
        static::on(static::EVENT_THEMES, $callback);
    }

    public static function themes($return = [])
    {
        $event = new SiteThemesEvent;

        $event->result = $return;

        static::trigger(static::EVENT_THEMES, $event);

        return $event->result;
    }

    public static function registerAssets(&$head, &$beginBody, &$endBody)
    {
        $event = new SiteRegisterAssetsEvent;

        $event->head = $head;

        $event->beginBody = $beginBody;

        $event->endBody = $endBody;

        static::trigger(static::EVENT_REGISTER_ASSETS, $event);

        $head = $event->head;

        $beginBody = $event->beginBody;

        $endBody = $event->endBody;
    }

    public static function mainLayout(array $params = [])
    {
        $event = new SiteMainLayoutEvent;

        $event->params = $params;

        $session = service('session');

        $event->params['successMessages'] = (array) $session->getFlashdata('success');

        $event->params['errorMessages'] = (array) $session->getFlashdata('error');

        $event->params['infoMessages'] = (array) $session->getFlashdata('info');

        static::trigger(static::EVENT_MAIN_LAYOUT, $event);

        return $event->params;
    }

}