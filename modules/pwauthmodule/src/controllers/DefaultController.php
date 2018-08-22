<?php
/**
 * PWAuth module for Craft CMS 3.x
 *
 * Authorization for Play-Well Users
 *
 * @link      github.com/playwellsteve
 * @copyright Copyright (c) 2018 Steve Halford
 */

namespace modules\pwauthmodule\controllers;

use craft\db\Query;
use craft\web\Request;
use craft\web\Session;
use modules\pwauthmodule\PWAuthModule;

use Craft;
use craft\web\Controller;
use GuzzleHttp\Client;

/**
 * Default Controller
 *
 * Generally speaking, controllers are the middlemen between the front end of
 * the CP/website and your module’s services. They contain action methods which
 * handle individual tasks.
 *
 * A common pattern used throughout Craft involves a controller action gathering
 * post data, saving it on a model, passing the model off to a service, and then
 * responding to the request appropriately depending on the service method’s response.
 *
 * Action methods begin with the prefix “action”, followed by a description of what
 * the method does (for example, actionSaveIngredient()).
 *
 * https://craftcms.com/docs/plugins/controllers
 *
 * @author    Steve Halford
 * @package   PWAuthModule
 * @since     1.0.0
 */
class DefaultController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['index', 'do-something', 'authorize', 'login'];

    // Public Methods
    // =========================================================================

    /**
     * Handle a request going to our module's index action URL,
     * e.g.: actions/pwauth-module/default
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $sess =  new Session;
        $result = 'Welcome to the DefaultController actionIndex() method';
        $sess->set('test', 'This is the newest session test variable');
        $sess->set('authLevel', 'Manager');
        return $result;
    }

    /**
     * Handle a request going to our module's actionDoSomething URL,
     * e.g.: actions/pwauth-module/default/do-something
     *
     * @return mixed
     */
    public function actionDoSomething()
    {
        $result = 'Welcome to the DefaultController actionDoSomething() method';
        $sess =  new Session;


        return $sess->get('test');
    }

    public function actionAuthorize()
    {
//        $client = new Client();
        $userName = 'steve@play-well.org';
        $pass = 'tangent';
        return PWAuthModule::$instance->pWAuthModuleService->login($userName, $pass);
//        $hashedPass = '75e7384f08d8f81a380699ce840c1167';
//        $userName = 'drew@play-well.org';
//        $hashedPass = '9bcd4eb54ee631b9b36d163f48c8d7d5';
//        $hashedPass = md5('tangent');
        // must deal with 404

//        $response = $client->get('http://course-api.test/userrole', ['query' => ['u' => $userName, 'p' => $hashedPass]]);
//        $result =  $response->getBody()->getContents();
//        return json_decode($result, true)['role'];
        // success

    }

    public function actionLogin()
    {
        $request = new Request();
        // validate the request
        $userName = $request->getParam('loginName');
        $pass = $request->getParam('password');
        // try to login
        // if not valid redirect to login page

        // if valid, redirect to start
        return PWAuthModule::$instance->pWAuthModuleService->login($userName, $pass);

    }
}
