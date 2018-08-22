<?php
/**
 * PWAuth module for Craft CMS 3.x
 *
 * Authorization for Play-Well Users
 *
 * @link      github.com/playwellsteve
 * @copyright Copyright (c) 2018 Steve Halford
 */

namespace modules\pwauthmodule\variables;

use modules\pwauthmodule\PWAuthModule;

use Craft;

/**
 * PWAuth Variable
 *
 * Craft allows modules to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.pWAuthModule }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    Steve Halford
 * @package   PWAuthModule
 * @since     1.0.0
 */
class PWAuthModuleVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want.  From any Twig template,
     * call it like this:
     *
     *     {{ craft.pWAuthModule.exampleVariable }}
     *
     * Or, if your variable requires parameters from Twig:
     *
     *     {{ craft.pWAuthModule.exampleVariable(twigValue) }}
     *
     * @param null $optional
     * @return string
     */
    public function exampleVariable($optional = null)
    {
        $result = "And away we go to the Twig template...";
        if ($optional) {
            $result = "I'm feeling optional today...";
        }
        return $result;
    }

    public function authLevel()
    {
        $loginLevel = PWAuthModule::$instance->pWAuthModuleService->authLevel();
        // get login level from service

        return $loginLevel;
    }
}
