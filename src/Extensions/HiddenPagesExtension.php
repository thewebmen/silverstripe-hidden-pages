<?php

namespace TheWebmen\HiddenPages\Extensions;

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class HiddenPagesExtension extends DataExtension {

    private static $db = [
        'HideFromSiteTree' => 'Boolean'
    ];

    /**
     * @param $fields FieldList
     */
    public function updateSettingsFields($fields){
        $fields->addFieldToTab('Root.Settings', CheckboxField::create('HideFromSiteTree', 'Hide from SiteTree'));
    }

    public function augmentStageChildren(&$staged){
        $staged = $staged->exclude('HideFromSiteTree', true);
    }


}
