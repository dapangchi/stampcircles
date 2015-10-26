<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jabref extends CI_Controller {

/**
 * The index() function gets called automatically when running this
 * example. It will perform the following steps:
 *
 *    1) Connect to a mySQL database (see /application/config/database.php)
 *    2) Load a database$patterns[]='/\"/';
  			$replacements[] = '';
		    $match[1] = preg_replace($patterns, $replacements, $match[1]); model (see /application/models/model.php)
 *    3) Create a table named 'items' if it doesn't already exist
 *    4) Insert an item to the 'items's table
 *    5) Retrieves the last inserted item
 *    6) Retrieves the row count of the 'items' table
 *    7) Loads a view and passes the retrieved data
 *
 * The Terminal (adjacent to the Console Output) can be used to connect
 * directly to the mySQL database. Just type in 'mysql' to connect.
 *
 */


  public function index()
  {

    /* Connect to the mySQL database - config values can be found at:
      /application/config/database.php */
    $dbconnect = $this->load->database('jabref');


    /* Load the database model:
      /application/models/jabrefmodel.php */
    $this->load->model('jabrefmodel');


    /* Create a table if it doesn't exist already */
    $this->jabrefmodel->create_table();


    /* Call the "insert_item" entry */
    $this->jabrefmodel->insert_item('Hello from Runnable!');

    /* Retrieve the last item  */
    $lastitem = $this->jabrefmodel->get_last_item();

    /* Retrieve the row count */
    $rowcount = $this->jabrefmodel->get_row_count();

    $data = array(
                'lastitem' => $lastitem,
                'rowcount' => $rowcount
            );
	$data['thelast'] = 'This is a Test';

    $this->load->view('jabrefview', $data);
    //echo "sucsess";
  }

}

/* End of file controller.php */
/* Location: ./application/controllers/controller.php */
