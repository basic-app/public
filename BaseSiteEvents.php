<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Site;

use BasicApp\Core\Event;

abstract class BaseSiteEvents extends \CodeIgniter\Events\Events
{

    const EVENT_THEMES = 'ba:themes';
    
    const EVENT_PAGER = 'ba:pager';

    const EVENT_CONTROLLER = 'ba:controller';

    const EVENT_REGISTER_ASSETS = 'ba:register_assets';

    const EVENT_USER_MENU = 'ba:user_menu';

    const EVENT_ACCOUNT_MENU = 'ba:account_menu';

    const EVENT_MAIN_LAYOUT = 'ba:main_layout';

    public static function onUserMenu($callback)
    {
        static::on(static::EVENT_USER_MENU, $callback);
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

    public static function onController($callback)
    {
        static::on(static::EVENT_CONTROLLER, $callback);
    }
    
    public static function onThemes($callback)
    {
        static::on(static::EVENT_THEMES, $callback);
    }

    public static function onPager($callback)
    {
        static::on(static::EVENT_PAGER, $callback);
    }

    public static function pager($pager)
    {
        static::trigger(static::EVENT_PAGER, $pager);
    }

    public static function themes($return = [])
    {
        $event = new Event;

        $event->result = $return;

        static::trigger(static::EVENT_THEMES, $event);

        return $event->result;
    }

    public static function controller($controller)
    {
        static::trigger(static::EVENT_CONTROLLER, $controller);
    }

    public static function registerAssets(&$head, &$beginBody, &$endBody)
    {
        $event = new Event;

        $event->head = $head;

        $event->beginBody = $beginBody;

        $event->endBody = $endBody;

        static::trigger(static::EVENT_REGISTER_ASSETS, $event);

        $head = $event->head;

        $beginBody = $event->beginBody;

        $endBody = $event->endBody;
    }

    public static function userMenu()
    {
        $event = new Event;

        $event->items = [];

        static::trigger(static::EVENT_USER_MENU, $event);

        $view = service('renderer');

        $data = $view->getData();

        if (array_key_exists('userMenu', $data))
        {
            return array_merge_recursive($event->items, $data['userMenu']);
        }

        return $event->items;
    }

    public static function accountMenu()
    {
        $event = new Event;

        $event->items = [];

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
        $event = new Event;

        $event->params = $params;

        static::trigger(static::EVENT_MAIN_LAYOUT, $event);

        return $event->params;
    }
       
}