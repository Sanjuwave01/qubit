<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Crypto extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','pagination'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }

    public function index() {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value,'tokenName' =>'USDT');
            if (empty($where[$field])){
                $where = array('tokenName' =>'USDT');
                // $config['base_url'] = base_url() . 'Admin/Withdraw/index/';
            }
            // else{
                // $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
            // }
            
            $config['base_url'] = base_url() . 'Admin/Crypto/index';
            $config['suffix'] = '?'.http_build_query($_GET);
            $config['total_rows'] = $this->Main_model->get_sum('tbl_block_address', $where, 'ifnull(count(id),0) as sum');
            $config ['uri_segment'] = 4;
            $config['per_page'] = 1000;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $response['transactions'] = $this->Main_model->get_limit_records('tbl_block_address', $where, '*', $config['per_page'], $segment);
            $response['bank_amount'] = $this->Main_model->get_sum('tbl_block_address', $where, 'ifnull(sum(value),0) as sum');
           
            $this->load->view('crypto_transaction', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function Pending() {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value,'transfer_status' =>0,'tokenName' =>'USDT');
            if (empty($where[$field])){
                $where = array('transfer_status' =>0,'tokenName' =>'USDT');
                // $config['base_url'] = base_url() . 'Admin/Withdraw/index/';
            }
            // else{
                // $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
            // }
            
            $config['base_url'] = base_url() . 'Admin/Crypto/Pending';
            $config['suffix'] = '?'.http_build_query($_GET);
            $config['total_rows'] = $this->Main_model->get_sum('tbl_block_address', $where, 'ifnull(count(id),0) as sum');
            $config ['uri_segment'] = 4;
            $config['per_page'] = 1000;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $response['transactions'] = $this->Main_model->get_limit_records('tbl_block_address', $where, '*', $config['per_page'], $segment);
            $response['bank_amount'] = $this->Main_model->get_sum('tbl_block_address', $where, 'ifnull(sum(value),0) as sum');
           
            $this->load->view('crypto_transaction', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }


    public function bep20transaction() {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value,'tokenName' =>'BEP_USDT');
            if (empty($where[$field])){
                $where = array('tokenName' =>'BEP_USDT');
                // $config['base_url'] = base_url() . 'Admin/Withdraw/index/';
            }
            // else{
                // $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
            // }
            
            $config['base_url'] = base_url() . 'Admin/Crypto/Pending';
            $config['suffix'] = '?'.http_build_query($_GET);
            $config['total_rows'] = $this->Main_model->get_sum('tbl_block_address', $where, 'ifnull(count(id),0) as sum');
            $config ['uri_segment'] = 4;
            $config['per_page'] = 1000;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $response['transactions'] = $this->Main_model->get_limit_records('tbl_block_address', $where, '*', $config['per_page'], $segment);
            $response['bank_amount'] = $this->Main_model->get_sum('tbl_block_address', $where, 'ifnull(sum(value),0) as sum');
           
            $this->load->view('crypto_transaction2', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }


    public function bep20Pending() {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value,'transfer_status' =>0,'tokenName' =>'BEP_USDT');
            if (empty($where[$field])){
                $where = array('transfer_status' =>0,'tokenName' =>'BEP_USDT');
                // $config['base_url'] = base_url() . 'Admin/Withdraw/index/';
            }
            // else{
                // $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
            // }
            
            $config['base_url'] = base_url() . 'Admin/Crypto/Pending';
            $config['suffix'] = '?'.http_build_query($_GET);
            $config['total_rows'] = $this->Main_model->get_sum('tbl_block_address', $where, 'ifnull(count(id),0) as sum');
            $config ['uri_segment'] = 4;
            $config['per_page'] = 1000;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $response['transactions'] = $this->Main_model->get_limit_records('tbl_block_address', $where, '*', $config['per_page'], $segment);
            $response['bank_amount'] = $this->Main_model->get_sum('tbl_block_address', $where, 'ifnull(sum(value),0) as sum');
           
            $this->load->view('crypto_transaction2', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function bep20Transactions($transaction_id){
        if (is_admin()) {
            $response['transaction'] = $this->Main_model->get_single_record('tbl_block_address', array('hash' => $transaction_id), '*');
            // if ($this->input->server('REQUEST_METHOD') == 'POST') {
            //     $data = $this->security->xss_clean($this->input->post());
            //     if ($response['request']['status'] != 0) {
            //         $this->session->set_flashdata('message', 'Status of this request already updated!');
            //     } else {
            //         if ($data['status'] == 1) {
            //             $wArr = array(
            //                 'status' => 1,
            //                 'remark' => $data['remark'],
            //             );
            //             $res = $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
            //             if ($res) {
            //                 $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $response['request']['user_id']), 'user_id,area_code');
            //                 $investMentArr = array(
            //                     'user_id' => $response['request']['user_id'],
            //                     'amount' => $response['request']['amount'],
            //                     'mode' => 'get',
            //                     'area_code' => $user['area_code'],
            //                 );
            //                 $this->Main_model->add('tbl_investment', $investMentArr);
            //                 $this->session->set_flashdata('message', 'Withdraw request approved');
            //             } else {
            //                 $this->session->set_flashdata('message', 'Error while Rejecting WithdraW');
            //             }
            //         } elseif ($data['status'] == 2) {
            //             $wArr = array(
            //                 'status' => 2,
            //                 'remark' => $data['remark'],
            //             );
            //             $res = $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
            //             if ($res) {
            //                 $productArr = array(
            //                     'user_id' => $response['request']['user_id'],
            //                     'amount' => $response['request']['amount'],
            //                     'type' => $response['request']['type'],
            //                     'description' => 'Working Withdraw Refund',
            //                 );
            //                 $this->Main_model->add('tbl_income_wallet', $productArr);
            //                 $this->session->set_flashdata('message', 'Withdraw request rejected');
            //             } else {
            //                 $this->session->set_flashdata('message', 'Error while Rejecting WithdraW');
            //             }
            //         }
            //     }
            // }
            $response['user_details'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $response['transaction']['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
            $this->load->view('crypto_transactions2', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

     public function Transaction($transaction_id){
        if (is_admin()) {
            $response['transaction'] = $this->Main_model->get_single_record('tbl_block_address', array('hash' => $transaction_id), '*');
            // if ($this->input->server('REQUEST_METHOD') == 'POST') {
            //     $data = $this->security->xss_clean($this->input->post());
            //     if ($response['request']['status'] != 0) {
            //         $this->session->set_flashdata('message', 'Status of this request already updated!');
            //     } else {
            //         if ($data['status'] == 1) {
            //             $wArr = array(
            //                 'status' => 1,
            //                 'remark' => $data['remark'],
            //             );
            //             $res = $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
            //             if ($res) {
            //                 $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $response['request']['user_id']), 'user_id,area_code');
            //                 $investMentArr = array(
            //                     'user_id' => $response['request']['user_id'],
            //                     'amount' => $response['request']['amount'],
            //                     'mode' => 'get',
            //                     'area_code' => $user['area_code'],
            //                 );
            //                 $this->Main_model->add('tbl_investment', $investMentArr);
            //                 $this->session->set_flashdata('message', 'Withdraw request approved');
            //             } else {
            //                 $this->session->set_flashdata('message', 'Error while Rejecting WithdraW');
            //             }
            //         } elseif ($data['status'] == 2) {
            //             $wArr = array(
            //                 'status' => 2,
            //                 'remark' => $data['remark'],
            //             );
            //             $res = $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
            //             if ($res) {
            //                 $productArr = array(
            //                     'user_id' => $response['request']['user_id'],
            //                     'amount' => $response['request']['amount'],
            //                     'type' => $response['request']['type'],
            //                     'description' => 'Working Withdraw Refund',
            //                 );
            //                 $this->Main_model->add('tbl_income_wallet', $productArr);
            //                 $this->session->set_flashdata('message', 'Withdraw request rejected');
            //             } else {
            //                 $this->session->set_flashdata('message', 'Error while Rejecting WithdraW');
            //             }
            //         }
            //     }
            // }
            $response['user_details'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $response['transaction']['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
            $this->load->view('crypto_transactions', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }



    public function usdtBalance($id){
        if(is_admin()){
            $getUser = $this->Main_model->get_single_record('tbl_block_address', array('id' => $id), 'user_id'); 
            $userInfo = $this->Main_model->get_single_record('tbl_users', array('user_id' => $getUser['user_id']), 'user_id,wallet_address'); 
                        
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => '50.116.10.111:3000/check_usdt_balance',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'wallet_address='.$userInfo['wallet_address'].'&private_key=1212',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
    
            echo $response;
    
        }else{
            redirect('Admin/Management/login');
        }
    }


    public function trxBalance($id){
        if(is_admin()){
            $getUser = $this->Main_model->get_single_record('tbl_block_address', array('id' => $id), 'user_id'); 
            $userInfo = $this->Main_model->get_single_record('tbl_users', array('user_id' => $getUser['user_id']), 'user_id,wallet_address');
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => '50.116.10.111:3000/check_trx_balance',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => 'wallet_address='.$userInfo['wallet_address'],
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
              ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            echo $response;
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function creditTron($id){
        if(is_admin()){
            $getUser = $this->Main_model->get_single_record('tbl_block_address', array('id' => $id), 'user_id,id'); 
            $userInfo = $this->Main_model->get_single_record('tbl_users', array('user_id' => $getUser['user_id']), 'user_id,wallet_address');
            
            $curl = curl_init();
    
            curl_setopt_array($curl, array(
            CURLOPT_URL => '50.116.10.111:3000/transfer__new_trx',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'to='.$userInfo['wallet_address'].'&from=TD1R7hUCAztRU6Qmsw1QJCGnL963mUBCLs&amount=15&private_key=1940f9fab28048538ff1c90486f89a693c6255cf48c6814dc5d5d98b69bfb1a0',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
            ));
    
            $response = curl_exec($curl);
    
            curl_close($curl);
            echo $response;
                $jsonTD =  json_decode($response,true);
                if($jsonTD['status']== 'success' && $jsonTD['success']== '1'){
                    $this->Main_model->update('tbl_block_address',['id'=>$getUser['id']],['tron_tx_id'=>$jsonTD['receipt']['txid']]);
                }
    
        }else{
            redirect('Admin/Management/login');
        }
    }


    public function debitUsdt($id){ 
        if(is_admin()){
            $getUser = $this->Main_model->get_single_record('tbl_block_address', array('id' => $id), 'user_id,id,value'); 
            $userInfo = $this->Main_model->get_single_record('tbl_users', array('user_id' => $getUser['user_id']), 'user_id,wallet_address,wallet_private');
            
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => '50.116.10.111:3000/trc_token_transfer',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => 'to=TFstyotyvhEgds9uHqqqrr9Xiu2b9qmFXG&from='.$userInfo['wallet_address'].'&amount='.$getUser['value'].'&private_key='.$userInfo['wallet_private'].'&contract_address=TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
              ),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);
            echo $response;
            $jsonTU = json_decode($response,true);
            // pr($jsonTU);
            if($jsonTU['success'] == 1 && $jsonTU['status'] == 'success'){
                $this->Main_model->update('tbl_block_address',['id'=>$getUser['id']],['transfer_usdt_hash'=>$jsonTU['receipt']['txid'],'transfer_usdt_status'=>1,'transfer_status'=>1]);
            }
    
        }else{
            redirect('Admin/Management/login');
        }
    
    
        
    } 




// debit bep 20 busd //

public function busdbalance($id){
    if(is_admin()){
        $getUser = $this->Main_model->get_single_record('tbl_block_address', array('id' => $id), 'user_id'); 
        $userInfo = $this->Main_model->get_single_record('tbl_users', array('user_id' => $getUser['user_id']), 'user_id,wallet_address2'); 
              
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => '50.116.10.111:3000/bep_token_balance',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'address='.$userInfo['wallet_address2'].'&contract_address=0x55d398326f99059fF775485246999027B3197955',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }else{
        redirect('Admin/Management/login');
    }
}


public function bnbBalance($id){
    if(is_admin()){
        $getUser = $this->Main_model->get_single_record('tbl_block_address', array('id' => $id), 'user_id'); 
        $userInfo = $this->Main_model->get_single_record('tbl_users', array('user_id' => $getUser['user_id']), 'user_id,wallet_address2');
      
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
            CURLOPT_URL => '50.116.10.111:3000/bnb_balance',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'address='.$userInfo['wallet_address2'],
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
            ));
            
        $response = curl_exec($curl);
        
        curl_close($curl);
        echo $response;
        
    }else{
        redirect('Admin/Management/login');
    }
}

public function creditBNB($id){
    if(is_admin()){
        $getUser = $this->Main_model->get_single_record('tbl_block_address', array('id' => $id), 'user_id,id'); 
        $userInfo = $this->Main_model->get_single_record('tbl_users', array('user_id' => $getUser['user_id']), 'user_id,wallet_address2');
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => '50.116.10.111:3000/bnb_transfer',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'to='.$userInfo['wallet_address2'].'&amount=0.0002&private_key=f99003e3f63259619d9907760dbafdff1ccf6edd99a98e9c7b2c7af0264672a9',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
            $jsonD = json_decode($response,true);

            if($jsonD['success']==1){
                $this->Main_model->update('tbl_block_address',['id'=>$getUser['id']],['transfer_bnb_hash'=>$jsonD['receipt']['blockHash']]);
            }

    }else{
        redirect('Admin/Management/login');
    }
}


public function debitBUSD($id){
    if(is_admin()){
        $getUser = $this->Main_model->get_single_record('tbl_block_address', array('id' => $id), 'user_id,id,value'); 
        $userInfo = $this->Main_model->get_single_record('tbl_users', array('user_id' => $getUser['user_id']), 'user_id,wallet_address2,wallet_private2,wallet_private2');
                    
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => '50.116.10.111:3000/bep_token_transfer',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'contract_address=0x55d398326f99059fF775485246999027B3197955&private_key='.$userInfo['wallet_private2'].'&from='. $userInfo['wallet_address2'].'&to=0xa5331eff25dba871b12a06e3fdddba4de4910316&amount='.(int)$getUser['value'],
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        // echo json_encode($response);
        $jsonD = json_decode($response,true);


        if($jsonD['status'] == 'success'){
            $this->Main_model->update('tbl_block_address',['id'=>$getUser['id']],['transfer_usdt_hash'=>$jsonD['receipt']['transactionHash'],'transfer_usdt_status'=>1,'transfer_status'=>1]);
        }

    }else{
        redirect('Admin/Management/login');
    }
}


    

}    