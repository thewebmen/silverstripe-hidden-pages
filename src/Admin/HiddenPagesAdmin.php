<?php

namespace TheWebmen\HiddenPages\Admin;

use SilverStripe\Admin\ModelAdmin;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldEditButton;
use TheWebmen\HiddenPages\Forms\GridFieldSiteTreeEditButton;

class HiddenPagesAdmin extends ModelAdmin {

    /**
     * @var string
     */
    private static $url_segment = 'hidden-pages';

    /**
     * @var string
     */
    private static $menu_title = 'Hidden pages';

    /**
     * @var string
     */
    private static $menu_icon_class = 'font-icon-page-multiple';

    /**
     * @var array
     */
    private static $managed_models = [
        SiteTree::class
    ];

    /**
     * @return bool
     */
    public function subsiteCMSShowInMenu()
    {
        return true;
    }

    /**
     * @param null $id
     * @param null $fields
     * @return \SilverStripe\Forms\Form
     */
    public function getEditForm($id = null, $fields = null) {
        $form = parent::getEditForm($id, $fields);



        $gridFieldName = $this->sanitiseClassName($this->modelClass);
        /**
         * @var $grid GridField
         */
        $grid = $form->Fields()->dataFieldByName($gridFieldName);
        if($grid){
            $pages = SiteTree::get()->filter('HideFromSiteTree', true);
            $grid->setList($pages);

            $config = GridFieldConfig_RecordEditor::create();
            $config->removeComponentsByType(GridFieldAddNewButton::class);
            $config->removeComponentsByType(GridFieldEditButton::class);
            $config->removeComponentsByType(GridFieldDeleteAction::class);
            $config->addComponent(new GridFieldSiteTreeEditButton());
            $grid->setConfig($config);

            /**
             * @var $dataColumns GridFieldDataColumns
             */
            $dataColumns = $config->getComponentByType(GridFieldDataColumns::class);
            $dataColumns->setDisplayFields([
                'ID' => 'ID',
                'LastEdited' => 'LastEdited',
                'Title' => 'Title',
                'Link' => 'Link'
            ]);
        }

        return $form;
    }


}
