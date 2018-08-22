<?php
/**
 * PWAuth module for Craft CMS 3.x
 *
 * Authorization for Play-Well Users
 *
 * @link      github.com/playwellsteve
 * @copyright Copyright (c) 2018 Steve Halford
 */

namespace modules\pwauthmodule\services;

use modules\pwauthmodule\PWAuthModule;

use Craft;
use craft\base\Component;
use GuzzleHttp\Client;
use craft\web\Session;
use stdClass;

/**
 * PWAuthModuleService Service
 *
 * All of your module’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other modules can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Steve Halford
 * @package   PWAuthModule
 * @since     1.0.0
 */
class PWAuthModuleService extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin/module file, call it like this:
     *
     *     PWAuthModule::$instance->pWAuthModuleService->exampleService()
     *
     * @return mixed
     */
    public function exampleService()
    {
        $client = new Client();
        $result = $client->get('course-api.dev/api/test');

//        $result = 'something';

        return $result;
    }

    public function authLevel()
    {
        $sess =  new Session;


        return $sess->get('authLevel', 'None');
    }

    public function login(string $userName, string $pass)
    {
        $client = new Client();
        $hashedPass = md5($pass);
        $response = $client->get('http://course-api.test/userrole', ['query' => ['u' => $userName, 'p' => $hashedPass]]);
        $result =  $response->getBody()->getContents();
        return json_decode($result, true)['role'];
    }
}
