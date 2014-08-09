<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Minify
 *
 * A minification driver system for CodeIgniter
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Open Software License version 3.0
 *
 * This source file is subject to the Open Software License (OSL 3.0) that is
 * bundled with this package in the files license.txt / license.rst.  It is
 * also available through the world wide web at this URL:
 * http://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world wide web, please send an email to
 * licensing@ellislab.com so we can send you a copy immediately.
 *
 * @package     ci-minify
 * @author      Eric Barnes
 * @copyright   Copyright (c) Eric Barnes. (http://ericlbarnes.com/)
 * @license     http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * @link        http://ericlbarnes.com
 * @since       Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Unit Test Controller
 *
 * @subpackage  Controllers
 */
class Test extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->driver('minify');
    }

    function index()
    {
        $class_methods = get_class_methods($this);
        foreach ($class_methods as $method_name)
        {
            if (substr($method_name, 0, 5) == '_test')
            {
                self::$method_name();
            }
        }

        echo $this->unit->report();
    }

    private function _test_css()
    {
        $file = 'test/css/calendar.css';
        $this->unit->run($this->minify->css->min($file), 'is_string', 'test min css');
    }

    private function _test_js_min()
    {
        $file = 'test/js/colorbox.js';
        $this->unit->run($this->minify->js->min($file), 'is_string', 'test min js');
    }


    public function test_js()
    {
        $this->load->driver('minify');

        // Add minify file
        $files = array('a.js' , 'b.js');
        $this->minify->addfile($files);

        // Generate minify file html script
        $script = $this->minify->deploy('app.js');

        // <script type="text/javascript" src="http://example.com/assets/app.js?t=1407564151"></script>
        echo $script;
    }
    

    public function test_css()
    {
        $this->load->driver('minify');

        // Add minify file
        $files = array('a.css' , 'b.css');
        $this->minify->addfile($files);

        // Generate minify file html script
        $script = $this->minify->deploy('app.css');

        // <link href="http://example.com/assets/app.css?t=1407564180" rel="stylesheet" type="text/css">
        echo $script;
    }
}

/* End of file test.php */
/* Location: ./application/controllers/test.php */