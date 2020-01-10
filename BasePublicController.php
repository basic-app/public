<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\System;

abstract class BasePublicController extends \BasicApp\Core\Controller
{

	protected $layout = 'BasicApp\Public\Views\layout';

    public function __construct()
    {
        parent::__construct();

        PublicEvents::controller($this);
    }

}