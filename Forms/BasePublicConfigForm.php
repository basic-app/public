<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Public\Forms;

use BasicApp\Public\Config\Public as PublicConfig;
use BasicApp\Core\Form;
use BasicApp\Public\PublicEvents;

abstract class BasePublicConfigForm extends \BasicApp\Config\BaseConfigForm
{

    protected $returnType = PublicConfig::class;

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
        return PublicEvents::themes($return);
    }

}