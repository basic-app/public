<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Site;

use BasicApp\Site\Events\SiteThemesEvent;
use BasicApp\Site\Events\SitePagerEvent;
use BasicApp\Site\Events\SiteAssetsEvent;
use BasicApp\Site\Events\SiteAccountMenuEvent;
use BasicApp\Site\Events\SiteMainLayoutEvent;

abstract class BaseSiteEvents extends \CodeIgniter\Events\Events
{

    const EVENT_THEMES = 'ba:themes';
    
    const EVENT_REGISTER_ASSETS = 'ba:register_assets';

    const EVENT_ACCOUNT_MENU = 'ba:account_menu';

    const EVENT_MAIN_LAYOUT = 'ba:main_layout';





    const EVENT_SEED = 'ba:site_seed';

    public static function seed($created)
    {
        static::trigger(static::EVENT_SEED, $created);
    }

    public static function onSeed($callback)
    {
        static::on(static::EVENT_SEED, $callback);
    }










    public static function onMainLayout($callback)
    {
        static::on(static::EVENT_MAIN_LAYOUT, $callback);
    }

    public static function onAccountMenu($callback)
    {
        static::on(static::EVENT_ACCOUNT_MENU, $callback);
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

    public static function accountMenu(array $items = [])
    {
        $event = new SiteAccountMenuEvent;

        $event->items = $items;

        static::trigger(static::EVENT_ACCOUNT_MENU, $event);

        $view = service('renderer');

        $data = $view->getData();

        if (array_key_exists('accountMenu', $data))
        {
            return array_merge_recursive($event->items, $data['accountMenu']);
        }

        return $event->items;
    }

    public static function mainLayout(array $params = [])
    {
        $event = new SiteMainLayoutEvent;

        $event->params = $params;

        static::trigger(static::EVENT_MAIN_LAYOUT, $event);

        return $event->params;
    }

}