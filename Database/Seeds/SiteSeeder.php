<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Site\Database\Seeds;

class SiteSeeder extends \BasicApp\Core\Seeder
{

    public function run()
    {
        if (function_exists('block'))
        {
            block('layout.siteName', 'My Site');
            block('layout.copyright', '&copy; My Company {year}');
            block('layout.defaultTitle', 'My Site Default Title');
        }
    }

}