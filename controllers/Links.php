<?php

declare(strict_types=1);

namespace DamianLewis\SocialMedia\Controllers;

use Backend\Behaviors\FormController;
use Backend\Behaviors\ListController;
use Backend\Behaviors\ReorderController;
use BackendMenu;
use Backend\Classes\Controller;
use DamianLewis\SocialMedia\Models\Link;
use Model;
use System\Classes\SettingsManager;

class Links extends Controller
{
    public $requiredPermissions = ['damianlewis.socialmedia.access_links'];

    public $implement = [
        ListController::class,
        FormController::class,
        ReorderController::class
    ];

    public $formConfig = 'config/form.yaml';
    public $listConfig = 'config/list.yaml';
    public $reorderConfig = 'config/reorder.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('DamianLewis.SocialMedia', 'links');

        if (in_array($this->action, ['create', 'update'])) {
            $this->bodyClass = 'compact-container';
        }
    }

    public function listInjectRowClass(Model $record): string
    {
        if (!$record instanceof Link) {
            return '';
        }

        return $record->is_visible ? '' : 'safe disabled';
    }
}
