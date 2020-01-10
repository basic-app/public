<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Site\Config;

use BasicApp\Site\Forms\SiteConfigForm;

abstract class BaseSite extends \BasicApp\Config\BaseConfig
{

    protected $modelClass = SiteConfigForm::class;

    public $theme;

    public function __construct()
    {
        parent::__construct();

        $list = $this->themes();

        if (!$this->theme || !array_key_exists($this->theme, $list))
        {
            $this->theme = $this->getDefaultTheme();
        }
    }

    public function themes() : array
    {
        $modelClass = $this->modelClass;

        return $modelClass::themes();
    }

    public function getDefaultTheme() : string
    {
        $items = static::themes();

        if (count($items) > 0)
        {
            $items = array_keys($items);

            return array_shift($items);
        }

        return '';
    }

    public function getThemeName() : string
    {
        if ($this->theme)
        {
             $items = static::themes();

             if (array_key_exists($this->theme, $items))
             {
                return $items[$this->theme];
             }
        }

        return '';
    }

}