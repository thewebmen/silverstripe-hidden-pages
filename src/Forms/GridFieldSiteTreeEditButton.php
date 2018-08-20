<?php

namespace TheWebmen\HiddenPages\Forms;

use SilverStripe\Forms\GridField\GridFieldEditButton;
use SilverStripe\View\ArrayData;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\ORM\DataObject;

class GridFieldSiteTreeEditButton extends GridFieldEditButton
{
    /**
     * @param  GridField $gridField
     * @param  DataObject $record
     * @param  string $columnName
     * @return string - the HTML for the column
     */
    public function getColumnContent($gridField, $record, $columnName)
    {
        // No permission checks - handled through GridFieldDetailForm
        // which can make the form readonly if no edit permissions are available.

        $data = ArrayData::create(
            ['Link' => $record->CMSEditLink()]
        );

        return $data->renderWith(GridFieldEditButton::class);
    }
}
