<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SmartCron extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
        date_default_timezone_set('Asia/Kolkata');
    }

    public function index() {
        exit('No direct script access allowed');
    }


    public function withdrawBEP20Token()
    {
        // die('ok');
        // if(date('D') == 'Tue'){
                $users = $this->Main_model->get_records('tbl_withdraw', 'credit_type = "RVC" AND status = "0" AND process_status = "0" AND coin > "0" LIMIT 2', '*');
                foreach ($users as $key => $user) {
                    pr($user);
                $userInfo = $this->Main_model->get_single_record('tbl_users', ['user_id' => $user['user_id']], 'user_id,eth_address');
                $process_status = $this->Main_model->get_single_record('tbl_withdraw', ['id' => $user['id']], '*');
                $this->Main_model->update('tbl_withdraw', ['id' => $user['id']], ['process_status' => 1]);
                // $dd = $this->isAddress($userInfo['eth_address']);
                $amount = $user['coin'];//number_format($this->getTronPrice($user['payable_amount']),3);
                        // die();

                if(!empty($amount) && $process_status['process_status'] == 0 && !empty($userInfo['eth_address']) && $user['coin'] > 0 && $amount > 0){
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                        CURLOPT_URL => 'http://134.209.108.79/thericaversenet_bep20_usdt_withdraw/withdraw_to_user',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => 'receving_address='.$userInfo['eth_address'].'&amount='.$amount.'',
                        CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/x-www-form-urlencoded'
                        ),
                        ));

                        $_response = curl_exec($curl);
                        $response = json_decode($_response, true);
                        if(!empty($response)){
                            if($response['success'] == 'SUCCESS'){
                                    $txn_hash = $response['response']['transactionHash'];
                                    $gasUsed = $response['response']['gasUsed'];

                                    $this->Main_model->update('tbl_withdraw', ['id' => $user['id']], ['json_response' => $_response, 'gasUsed' => $gasUsed, 'hash' => $txn_hash,'remark' => $txn_hash, 'process_status' => 2, 'credit_date' => date('Y-m-d H:i:s'), 'status' => 1, 'paid_status' => 1]);    
                            }elseif($response['success'] == 'FAILED'){
                                    $this->Main_model->update('tbl_withdraw', ['id' => $user['id']], ['json_response' => $_response]);
                            }
                        }else{
                            $this->Main_model->update('tbl_withdraw', ['id' => $user['id']], ['json_response' => 'Something went wrong, Api Not Responding', 'process_status' => 3]);
                        }
                }elseif($dd['success'] == 'SUCCESS'){

                        $this->Main_model->update('tbl_withdraw', ['id' => $user['id']], ['status' => 2, 'paid_status' => 0, 'json_response' => 'Invaild TRX Address']);

                }

                }
        // }
    }


       


    public function isAddress($address) {
        if (!preg_match('/^(0x)?[0-9a-f]{40}$/i',$address)) {
            // Check if it has the basic requirements of an address
            return ['success' => 'FAILED'];;
        } elseif (preg_match('/^(0x)?[0-9a-f]{40}$/',$address) || preg_match('/^(0x)?[0-9A-F]{40}$/',$address)) {
            // If it's all small caps or all all caps, return true
            return ['success' => 'SUCCESS'];
        } else {
            // Otherwise check each case
            return ['success' => 'SUCCESS'];
            // return $this->isChecksumAddress($address);
        }
    }


}
