<?php
/**
 * Copyright © 2013 Native5
 * 
 * All Rights Reserved.  
 * Licensed under the Native5 License, Version 1.0 (the "License"); 
 * You may not use this file except in compliance with the License. 
 * You may obtain a copy of the License at
 *  
 *      http://www.native5.com/legal/npl-v1.html
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *  PHP version 5.3+
 *
 * @category  Controllers 
 * @package   App/Controllers
 * @author    Support Native5 <support@native5.com>
 * @copyright 2012 Native5. All Rights Reserved 
 * @license   See attached LICENSE for details
 * @version   GIT: $gitid$ 
 * @link      http://www.docs.native5.com 
 */

use Native5\Control\DefaultController;
use Native5\Route\HttpResponse;
use Native5\UI\TwigRenderer;
use Native5\Identity\UsernamePasswordToken;
use Native5\Identity\AuthenticationException;
use Native5\Identity\SecurityUtils;

/**
 * Home Controller
 *
 * @category  Controllers 
 * @package   App/Controllers
 * @author    Support Native5 <support@native5.com>
 * @copyright 2012 Native5. All Rights Reserved
 * @license   See attached NOTICE.md for details
 * @version   Release: 1.0
 * @link      http://www.docs.native5.com
 * Created : 27-11-2012
 * Last Modified : Fri Dec 21 09:11:53 2012
 */
class homeController extends DefaultController
{


    /**
     * _default 
     * 
     * @param mixed $request Request to use
     *
     * @access public
     * @return void
     */
    public function _default($request)
    {
        $GLOBALS['logger']->info("LOhbfvmdbfvjbdfmvb.jv,vkdjbvdv");

        $skeleton =  new TwigRenderer('welcome.html');
        $this->_response = new HttpResponse('none', $skeleton);
        
        $this->_response->setBody(array(
            'title' => 'Login',
            'login' => true,
        ));

        // $this->_response = new HttpResponse('json', null);
        // $this->_response->setBody(array("app"=>"Location Mapper"));

    }//end _default()

    public function _getRoutes($request)
    {
        $this->_response->setBody("abc123");
        $data = array();
        $json = '[{"location":[{"lat":12.953165,"lng":77.6407222}],"distance":20,"name":"Home to Office","desc":"fun filled ride love to travel :-) "},{"location":[{"lat":12.9532565,"lng":77.6407435},{"lat":12.9532053,"lng":77.6407542},{"lat":12.9532053,"lng":77.6407542},{"lat":12.9533086,"lng":77.6407279},{"lat":12.9533086,"lng":77.6407279}],"distance":10,"name":"Point A to Point B","desc":"A to B description"},{"location":[{"lat":12.953165,"lng":77.6407222}],"distance":30,"name":"Poiny x to point Y","desc":"X to Y description"}]';
        $data['location'] = json_decode($json, 1);

        $this->_response = new HttpResponse('json', null);
        $this->_response->setBody($data);
    }

    public function _reportIncident($request)
    {
        $name = $request->getParam('name');
        $latitude = $request->getParam('latitude');
        $longitude = $request->getParam('longitude');
        $time = $request->getParam('time');
        $generateDir = __DIR__ .'/../incidents';

        $data = array();

        if(!file_exists($generateDir)) {
            mkdir($generateDir);
        }

        $fileName = $name . '_' . $time . ".txt";
        $filePath = $generateDir . "/" . $fileName;

        $file = fopen($filePath, "w+");
        $contents = "Name \t\t:\t" . $name . "\nLatitude \t:\t" . $latitude . "\nLongitude \t:\t" . $longitude . "\nTime \t\t:\t" . $time;
        fwrite($file, $contents);

        if(file_exists($filePath)) {
            $success = "true";
        } else {
            $success = "false";
        }

        $data["success"] = $success;

        $this->_response = new HttpResponse('json', null);
        $this->_response->setBody($data);
    }


}//end class

?>
