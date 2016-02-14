<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
            $data['title'] = ucfirst('history'); // Capitalize the first letter
            $this->load->view('templates/header', $data);
            $this->load->view('pages/history');
            $this->load->view('templates/footer', $data);
            
            //default value of dropdown selection
            $value = 'BOND';
            if(isset($_POST['BTN'])){
                $value = $_POST['DropDownBox'];
            }

            //debugging value of the current dropdown selection
            echo $value;
            
            //get value from dropdown
            $currentStock = $value;
            
            //get from the transactions table, 
            //all info that have Stock = thing from dropdown
            $trans = $this->transactions->some('Stock', $currentStock);
            
            $transactions = array();
            foreach($trans as $info){
                $this1 = array(
                    'DateTime' => $info->DateTime,
                    'Player' => $info->Player,
                    'Stock' => $info->Stock,
                    'Trans' => $info->Trans,
                    'Quantity' => $info->Quantity
                );
                $transactions[] = $this1;
            }
            
            $this->data['transactions'] = $transactions;
            
            $this->render();
	}
}
