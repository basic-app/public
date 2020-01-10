<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Site\Events;

class SiteRegisterAssetsEvent extends \BasicApp\Core\Event
{

    public $head;

    public $beginBody;

    public $endBody;

}