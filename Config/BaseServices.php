<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\System\Config;

use Exception;

abstract class BaseServices extends \CodeIgniter\Config\BaseService
{

    public static function theme($getShared = true)
    {
        if (!$getShared)
        {
            $systemConfig = config(System::class);

            $themeClass = $systemConfig->theme;

            if (!$themeClass)
            {
                throw new Exception('Theme not defined.');
            }

            $theme = new $themeClass;

            return $theme;
        }

        return static::getSharedInstance('theme');
    }

}