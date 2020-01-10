<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Site;

interface PublicThemeInterface
{

    public function breadcrumbs(array $params = []);

    public function actionMenu(array $params = []);

    public function mainMenu(array $params = []);

    public function mainLayout(array $params = []);

}