<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MyRecharge extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user'));
        date_default_timezone_set('Asia/Kolkata');
        $this->exceptionCase = '';
        if(is_logged_in() === false) {
            redirect('Dashboard/User/logout');
            exit;
        }
    }

     public function index() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['header'] = 'Recharge & Bill Payments';

            $this->load->view('recharge_list', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function recharge($type) {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['providers'] = $this->User_model->get_records('tbl_pay2all_opreators', array('type' => $type), '*');
            $response['header'] = ucfirst(str_replace('_', ' ', $type));
            $response['balance'] = $this->User_model->get_single_record('tbl_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
                $this->form_validation->set_rules('provider_id', 'Provider Id', 'trim|required');
                if ($this->form_validation->run() != FALSE) {
                    $withdraw_amount = abs($data['amount']);
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $balance = $this->User_model->get_single_record('tbl_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');

                    $opreator = $this->User_model->get_single_record('tbl_pay2all_opreators', ['opreator_id' => $data['provider_id']], '*');
                    $requiredAmount = $withdraw_amount/80;
                    if ($balance['balance'] >= $requiredAmount) {
                        if ($user['paid_status'] == 1) {
                            $myorderid = $this->generate_order_id();
                            $postData = ['number' => $data['phone'],'provider_id' => $data['provider_id'],'amount' => $data['amount'],'client_id' => $myorderid,'operator_ref'=>$data['provider_id']];
                           // pr($postData,true);
                            $jsonD = $this->curlSetup($postData);
                            //pr($jsonD,true);
                            if(!empty($jsonD['status'])){
                                if($jsonD['status'] == 'failure' && $jsonD['status_id'] == 2){
                                    $this->session->set_flashdata('message',$jsonD['message']);
                                    $this->load->view('recharge_transaction', $response);
                                }elseif($jsonD['status'] == 'success'){
                                    $DirectIncome = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => - $requiredAmount,
                                        'type' => 'recharge_amount',
                                        'remark' => 'Mobile Recharge',
                                    );
                                    $this->User_model->add('tbl_wallet', $DirectIncome);
                                    $transactionArr = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'operator' => $opreator['opreator_name'],
                                        'amount' => $data['amount'],
                                        'status' => $jsonD['status'],
                                        'orderid' => $myorderid,
                                        'pay_id' => $jsonD['payid'],
                                        'service' => $data['phone'],
                                        'type' => $type,
                                    );
                                    
                                    $this->User_model->add('tbl_recharge', $transactionArr);
                                    //pr($jsonD,true);
                                    
                                    $response['provider'] = $opreator['opreator_name'];
                                    $response['amount'] = $data['amount'];
                                    $response['phone'] = $data['phone'];
                                    $this->load->view('rechargesuccess',$response);

                                    $this->session->set_flashdata('message', '<span class="text-success>Transaction Complete!</span>');

                                }
                            }else{
                                $this->session->set_flashdata('message',$jsonD['message']);
                                $this->load->view('recharge_transaction', $response);
                            }
                        }else {
                            $this->session->set_flashdata('message', 'Inactive User');
                            $this->load->view('recharge_transaction', $response);
                        }
                    }else {
                        $this->session->set_flashdata('message', 'Insuffcient Balance');
                        $this->load->view('recharge_transaction', $response);
                    }

                    //pr($data,1);
                }else{
                   // pr(validation_errors());
                      $this->load->view('recharge_transaction', $response);
                }
            }else{

            $this->load->view('recharge_transaction', $response);
            }
        } else {
            redirect('Dashboard/User/login');
        }
    }
    
    
    
    private function curlSetup($post_data){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.pay2all.in/api/v1/transaction',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $post_data,//array('number' => $data['mob'],'provider_id' => $provider,'amount' => $data['amount'],'client_id' => $myorderid,'operator_ref'=>$data['operator_code']),
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                "Authorization:Bearer ".access_token
            ),
        ));

        $response1 = curl_exec($curl);
        curl_close($curl);
        return $jsonD = json_decode($response1,true);
    }

    public function generate_order_id() {
        $order_id = rand(10000, 99999);
        $order = $this->User_model->get_single_record('tbl_recharge', array('orderid' => $order_id), 'orderid');
        if (!empty($order)) {
            return $this->generate_order_id();
        } else {
            return $order_id;
        }
    }

    public function get_json($provide_id){
        if (is_logged_in()) {
            $provide_id = trim(addslashes($provide_id));
            if($this->input->server("REQUEST_METHOD") == "GET"){
                if($this->input->is_ajax_request()){
                    $get_provider = $this->User_model->get_single_record('tbl_pay2all_opreators', ['id' => $provide_id], '*');
                    if(!empty($get_provider)){
                        $response['success'] = 1;
                        $response['records'] = $get_provider['json'];
                    }else{
                        $response['success'] = 0;
                        $response['message'] = 'Not Provider Found!';
                    }
                }
            }
            echo json_encode($response);

        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function json_encode(){
        $array = [
          1 => ['type' => 'number', 'name' => 'phone', 'placeholder' => 'Enter Mobile Number'],
            2 => ['type' => 'number', 'name' => 'amount', 'placeholder' => 'Enter Amount'],
        ];

        echo json_encode($array);
    }

    public function History() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Recharge History';
            $response['transactions'] = $this->User_model->get_records('tbl_recharge', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('recharge_history', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }



}
?>