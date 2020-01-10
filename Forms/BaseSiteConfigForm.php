<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Site\Forms;

use BasicApp\Site\Config\Site as PublicConfig;
use BasicApp\Core\Form;
use BasicApp\Site\SiteEvents;

abstract class BaseSiteConfigForm extends \BasicApp\Config\BaseConfigForm
{

    protected $returnType = SiteConfig::class;

    protected $validationRules = [
        'theme' => 'not_special_chars|max_length[255]'
    ];

    protected $fieldLabels = [
        'theme' => 'Theme'
    ];

    protected $allowedFields = [
        'theme'
    ];

    protected $langCategory = 'system';

    public function renderForm(Form $form, $data)
    {
        $return = '';

        $return .= $form->dropdownGroup($data, 'theme', static::themes(['' => '...']));

        return $return;
    }

    public static function themes($return = [])
    {
        return SiteEvents::themes($return);
    }

}