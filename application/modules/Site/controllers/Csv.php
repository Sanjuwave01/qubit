<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Csv extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model(array('Main_model'));
    }

    public function index(){
        if($this->input->server("REQUEST_METHOD") == "POST"){
            //die('stop');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'csv';
            $config['max_size'] = 1024;
            $config['file_name'] = 'csv'.time();
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload('file')){
                $this->session->set_flashdata('message', $this->upload->display_errors());
            } else {
                $this->session->set_flashdata('message','No User available for address');
                $file = $this->upload->data('file_name');
                $file2 = 'http://stacking.murphycoin.us/uploads/'.$file;
                $row = 1;
                if (($handle = fopen($file2, "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $num = count($data);
                        echo "<p> $num fields in line $row: <br /></p>\n";
                        if($row > 1){
                            //for ($c=0; $c < $num; $c++) {
                                echo 'Wallet Address :<b>   '.$data[3].'</b> | Trust Wallet Address: <b>'.$data[4]. "</b><br />\n";
                                $getUser = $this->Main_model->get_single_record('tbl_users',['wallet_address' => $data[3],'eth_address' => ''],'user_id');
                                if(!empty($getUser)){
                                    $this->Main_model->update('tbl_users',['wallet_address' => $data[3],'eth_address' => ''],['eth_address' => $data[4]]);
                                    $this->session->set_flashdata('message','Address Updated');
                                }
                            //}
                        }
                        $row++;
                    }
                    fclose($handle);
                }
                unlink(FCPATH.'uploads/'.$file);
                redirect('csv');
            }
        }
        $this->load->view('form');
    }
}
?>