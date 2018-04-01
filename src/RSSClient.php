<?php
/**
 * RSSClient plugin for Craft CMS 3.x
 *
 * Just a simple RSS client
 *
 * @link      https://venveo.com
 * @copyright Copyright (c) 2017 Venveo
 */

namespace venveo\rssclient;

use venveo\rssclient\variables\RSSClientVariable;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

/**
 * @author    Venveo
 * @package   RSSClient
 * @since     1.0.0
 */
class RSSClient extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var static
     */
    public static $plugin;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        $this->setComponents([
            'rssfeed' => services\RSSFeedService::class,
        ]);

        // add event hook to allow variable to appear in template
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('rssclient', RSSClientVariable::class);
            }
        );

    }

    /**
     * @inheritdoc
     */
    public function defineTemplateComponent()
    {
        return RSSClientVariable::class;
    }

    // Protected Methods
    // =========================================================================

}
