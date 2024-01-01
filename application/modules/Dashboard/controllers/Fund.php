<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Fund extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user'));
    }

    // public function Request_fund() {
    //     if (is_logged_in()) {
    //         $response = array();
    //         $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->set_userdata['user_id']), '*');
    //         if ($this->input->server('REQUEST_METHOD') == 'POST') {
    //             $data = $this->security->xss_clean($this->input->post());
    //             $check = $this->User_model->get_single_record('tbl_payment_request', array('transaction_id' => $data['txn_id']), '*');
    //             if(empty($check) && !empty($data['txn_id'])){
    //                 // $config['upload_path'] = './uploads/';
    //                 // $config['allowed_types'] = 'gif|jpg|png';
    //                 // $config['file_name'] = 'payment_slip';
    //                 // $this->load->library('upload', $config);

    //                 // if (!$this->upload->do_upload('userfile')) {
    //                 //     $this->session->set_flashdata('message', $this->upload->display_errors());
    //                 // } else {
    //                 //     $fileData = array('upload_data' => $this->upload->data());
    //                     $reqArr = array(
    //                         'user_id' => $this->session->userdata['user_id'],
    //                         'amount' => $data['amount'],
    //                         'payment_method' => $data['payment_method'],
    //                         'transaction_id' => $data['txn_id'],
    //                         //'image' => $fileData['upload_data']['file_name'],
    //                         'status' => 0,
    //                     );
    //                     $res = $this->User_model->add('tbl_payment_request', $reqArr);
    //                     if ($res) {
    //                         $this->session->set_flashdata('message', 'Payment Request Submitted Successfully');
    //                     } else {
    //                         $this->session->set_flashdata('message', 'Error While Submitting Payment Request Please Try Again ...');
    //                     }
    //                // }
    //             }else {
    //                 $this->session->set_flashdata('message', 'Error please enter vaild Hash ID.');
    //             }
    //         }
    //         $this->load->view('header', $response);
    //         $this->load->view('Fund/request_fund', $response);
    //     } else {
    //         redirect('Dashboard/User/login');
    //     }
    // }

    // public function pay_fund()
    // {
    //     if (is_logged_in()) {
    //         $response = array();
    //         $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');

    //         if ($this->input->server('REQUEST_METHOD') == 'POST') {
    //             $data = $this->security->xss_clean($this->input->post());
    //             if(!empty($data['amount']) && $data['amount'] > 0){
    //                 $response['amount'] = $data['amount'];
    //                 $this->load->view('header', $response);
    //                 $this->load->view('Fund/request_fund', $response);
    //             }else{
    //                 $this->session->set_flashdata('message', 'Please Enter valid Amount!');
    //             }      
    //         }else{
    //             $this->load->view('header', $response);
    //             $this->load->view('Fund/pay_fund', $response);
    //         }
    //     } else {
    //         redirect('Dashboard/User/login');
    //     }
    // }



    public function payfund()
    {
        if (is_logged_in()) {
            $response['token_name'] = $this->security->get_csrf_token_name();
            $response['token_value'] = $this->security->get_csrf_hash();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                // $response['status'] = false;
                // $response['token'] = $this->security->get_csrf_hash();
                $data = $this->security->xss_clean($this->input->post());
                // pr($_FILES);
                // pr( $data,true);
                $this->form_validation->set_rules('amount', 'Amount', 'required|trim|numeric');
                $this->form_validation->set_rules('txn_id', 'Transaction ID', 'required');

                if ($this->form_validation->run() != FALSE) {
                    $config['upload_path'] = './uploads/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['file_name'] = 'payment_slip';
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('userfile')) {
                        $this->session->set_flashdata('message', $this->upload->display_errors());
                    } else {
                        $txn = $this->User_model->get_single_record('tbl_payment_request', array('transaction_id' => $data['txn_id']), '*');
                        $tokenValue = $this->User_model->get_single_record('tbl_token_value', ['id' => 1], 'amount');

                        if (!empty($data['txn_id'])) {
                            if (empty($txn)) {
                                if ($data['amount'] > 0) {
                                    $fileData = array('upload_data' => $this->upload->data());
                                    $reqArr = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => $data['amount'],
                                        'coin' => $data['amount'] / $tokenValue['amount'],
                                        'token_price' => $tokenValue['amount'],
                                        'payment_method' => "usdt",
                                        'image' => $fileData['upload_data']['file_name'],
                                        'status' => 0,
                                        'transaction_id' => $data['txn_id'],
                                        'days' => $data['days']
                                    );
                                    $res = $this->User_model->add('tbl_payment_request', $reqArr);
                                    if ($res) {
                                        $response['status'] = true;
                                        // $this->session->set_flashdata('message', 'Payment Request Successfully');
                                        $response['message'] = 'Thank You!';
                                    } else {
                                        $response['status'] = false;

                                        // $this->session->set_flashdata('message', 'Error While Submitting Payment Request Please Try Again ...');
                                        $response['message'] = '<h3 class = "text-danger">Error While Submitting Payment Request Please Try Again ...</h3>';
                                    }
                                } else {
                                    $response['status'] = false;

                                    $response['message'] = '<h3 class = "text-danger"> Minimun Deposit Amount ' . currency . ' 100</h3>';

                                    // $this->session->set_flashdata('message', ' Minimun Deposit Amount ' . currency . ' 1');
                                }
                            } else {
                                $response['status'] = false;

                                // $this->session->set_flashdata('message', ' Transaction ID Already Exists');
                                $response['message'] = '<h3 class = "text-danger">Transaction ID Already Exists</h3>';
                            }
                            // $response['status'] = false;
                        } else {
                            // $this->session->set_flashdata('message', ' Please Enter Transaction ID');
                            $response['message'] = '<h3 class = "text-danger">Please Enter Transaction ID</h3>';
                        }
                    }
                } else {
                    $response['status'] = false;

                    $response['message'] = '<h3 class = "text-danger">' . validation_errors() . '</h3>';
                }
                echo json_encode($response);
                exit;
            }
        } else {
            $response = [
                'status' => false,
                'message' => 'Please login first!'
            ];
            echo json_encode($response);
            exit;
        }
    }

    // public function Request_fund()
    // {
    //     // die;
    //     if (is_logged_in()) {
    //         $response = array();
    //         $response['none'] = 1;
    //         $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');


            // if ($this->input->server('REQUEST_METHOD') == 'POST') {
            //     $data = $this->security->xss_clean($this->input->post());
            //     $config['upload_path'] = './uploads/';
            //     $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //     $config['file_name'] = 'payment_slip';
            //     $this->load->library('upload', $config);

            //     if (!$this->upload->do_upload('userfile')) {
            //         $this->session->set_flashdata('message', $this->upload->display_errors());
            //     } else {
            //         $txn = $this->User_model->get_single_record('tbl_payment_request', array('transaction_id' => $data['txn_id']), '*');
            //         $tokenValue = $this->User_model->get_single_record('tbl_token_value', ['id' => 1], 'amount');

            //         if (!empty($data['txn_id'])) {
            //             if (empty($txn)) {
            //                 if ($data['amount'] > 0) {
            //                     $fileData = array('upload_data' => $this->upload->data());
            //                     $reqArr = array(
            //                         'user_id' => $this->session->userdata['user_id'],
            //                         'amount' => $data['amount']*$tokenValue['amount'],
            //                         'token_price' => $tokenValue['amount'],
            //                         'payment_method' => "usdt",
            //                         'image' => $fileData['upload_data']['file_name'],
            //                         'status' => 0,
            //                         'transaction_id' => $data['txn_id'],
            //                     );
            //                     $res = $this->User_model->add('tbl_payment_request', $reqArr);
            //                     if ($res) {
            //                         $this->session->set_flashdata('message', 'Payment Request Successfully');
            //                     } else {
            //                         $this->session->set_flashdata('message', 'Error While Submitting Payment Request Please Try Again ...');
            //                     }
            //                 } else {
            //                     $this->session->set_flashdata('message', ' Minimun Deposit Amount ' . currency . ' 1');
            //                 }
            //             } else {
            //                 $this->session->set_flashdata('message', ' Transaction ID Already Exists');
            //             }
            //         } else {
            //             $this->session->set_flashdata('message', ' Please Enter Transaction ID');
            //         }
            //     }
            // }
    //         $response['amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as amount');
    //         $response['tokenValue'] = $this->User_model->get_single_record('tbl_token_value', ['id' => 1], 'amount');
    //         $this->load->view('header', $response);
    //         $this->load->view('Fund/request_fund', $response);
    //         $this->load->view('footer', $response);
    //     } else {
    //         redirect('Dashboard/User/login');
    //     }
    // }

    // public function pay_fund()
    // {
    //     // die;
    //     if (is_logged_in()) {
    //         $response = array();
    //         $response['none'] = 1;
    //         $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');

    //         if ($this->input->server('REQUEST_METHOD') == 'POST') {
    //             $data = $this->security->xss_clean($this->input->post());
    //             $config['upload_path'] = './uploads/';
    //             $config['allowed_types'] = 'gif|jpg|png|jpeg';
    //             $config['file_name'] = 'payment_slip';
    //             $this->load->library('upload', $config);

    //             if (!$this->upload->do_upload('userfile')) {
    //                 $this->session->set_flashdata('message', $this->upload->display_errors());
    //             } else {
    //                 $txn = $this->User_model->get_single_record('tbl_payment_request', array('transaction_id' => $data['txn_id']), '*');
    //                 $tokenValue = $this->User_model->get_single_record('tbl_token_value', ['id' => 1], 'amount');

    //                 if (!empty($data['txn_id'])) {
    //                     if (empty($txn)) {
    //                         if ($data['amount'] > 0) {
    //                             $fileData = array('upload_data' => $this->upload->data());
    //                             $reqArr = array(
    //                                 'user_id' => $this->session->userdata['user_id'],
    //                                 'amount' => $data['amount']*$tokenValue['amount'],
    //                                 'token_price' => $tokenValue['amount'],
    //                                 'payment_method' => "usdt",
    //                                 'image' => $fileData['upload_data']['file_name'],
    //                                 'status' => 0,
    //                                 'transaction_id' => $data['txn_id'],
    //                             );
    //                             $res = $this->User_model->add('tbl_payment_request', $reqArr);
    //                             if ($res) {
    //                                 $this->session->set_flashdata('message', 'Payment Request Successfully');
    //                             } else {
    //                                 $this->session->set_flashdata('message', 'Error While Submitting Payment Request Please Try Again ...');
    //                             }
    //                         } else {
    //                             $this->session->set_flashdata('message', ' Minimun Deposit Amount ' . currency . ' 1');
    //                         }
    //                     } else {
    //                         $this->session->set_flashdata('message', ' Transaction ID Already Exists');
    //                     }
    //                 } else {
    //                     $this->session->set_flashdata('message', ' Please Enter Transaction ID');
    //                 }
    //             }
    //         }
    //         $response['amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as amount');

    //         $this->load->view('header', $response);
    //         $this->load->view('Fund/request_fund', $response);
    //     } else {
    //         redirect('Dashboard/User/login');
    //     }
    // }


    public function Manual_fund()
    {
        // die;
        if (is_logged_in()) {
            $response = array();
            $response['none'] = 1;

            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if (empty($response['user']['wallet_address']) && empty($response['user']['private_key'])) {
                $walletAdd = $this->walletAddress();
                $jsonD = json_decode($walletAdd, true);
                $this->User_model->update('tbl_users', ['user_id' => $this->session->userdata['user_id']], ['wallet_address' => $jsonD['address']]);
                redirect('Dashboard/Fund/Request_fund');
            }


            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_name'] = 'payment_slip' . time();
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile')) {
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                } else {
                    $txn = $this->User_model->get_single_record('tbl_payment_request', array('transaction_id' => $data['txn_id']), '*');
                    if (empty($txn)) {
                        $fileData = array('upload_data' => $this->upload->data());
                        $reqArr = array(
                            'user_id' => $this->session->userdata['user_id'],
                            'amount' => $data['amount'],
                            'payment_method' => $data['payment_method'],
                            'image' => $fileData['upload_data']['file_name'],
                            'status' => 0,
                            'transaction_id' => $data['txn_id'],
                        );
                        $res = $this->User_model->add('tbl_payment_request', $reqArr);
                        if ($res) {
                            $this->session->set_flashdata('message', 'Payment Request Submitted Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Submitting Payment Request Please Try Again ...');
                        }
                    } else {
                        $this->session->set_flashdata('message', ' Transaction ID Already Exists');
                    }
                }
            }
            $response['amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->set_userdata['user_id']), 'ifnull(sum(amount),0) as amount');

            $this->load->view('header', $response);
            $this->load->view('Fund/manual_fund', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    //     private function walletAddresss(){
    //         $curl = curl_init();

    //         curl_setopt_array($curl, array(
    //           CURLOPT_URL => 'https://crypto.mlmstore.co/Api/Apikey/generate_wallet_address',
    //           CURLOPT_RETURNTRANSFER => true,
    //           CURLOPT_ENCODING => '',
    //           CURLOPT_MAXREDIRS => 10,
    //           CURLOPT_TIMEOUT => 0,
    //           CURLOPT_FOLLOWLOCATION => true,
    //           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //           CURLOPT_CUSTOMREQUEST => 'POST',
    //           CURLOPT_POSTFIELDS => array('api_key' => '79105344761ac082c514ea0de411e83a','blockchain_id' => '1'),
    //           CURLOPT_HTTPHEADER => array(
    //             'Cookie: PHPSESSID=bq4i7lnk91157evfrougbj81di'
    //           ),
    //         ));

    //         $response = curl_exec($curl);

    //         curl_close($curl);
    //         return $response;
    //    }


    private function walletAddress()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://50.116.10.111:3000/generate_trx_address',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;

        return $response;
    }

    private function walletAddress2()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://50.116.10.111:3000/generate_bep_address', // 'http://18.216.195.54:3490/get_bep20_address',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return  $response;
    }

    // public function chk(){
    //  echo $this->walletAddress();
    // }

    private function livePrice()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://min-api.cryptocompare.com/data/price?fsym=TRX&tsyms=USD',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function depositHistory()
    {
        if (is_logged_in()) {
            $user = $this->User_model->get_single_record('tbl_users', ['user_id' => $this->session->userdata['user_id']], 'wallet_address,wallet_address2');
            $coin = ['bep_rvc'];
            foreach ($coin as $co) {
                if ($co == 'bep_rvc') {
                    $walletAddress = $user['wallet_address2'];
                    $url = 'https://api.bscscan.com/api?module=account&action=tokentx&contractaddress=0x7b95723f5b987b4C0FB99fc8Af843572A1834dD3&address=' . $walletAddress . '&page=1&offset=100&startblock=0&endblock=999999999&sort=desc&apikey=D4J7HQQSRA6AKKS3ABBCP9PI7ZSF5G5G78';
                } else {
                    $walletAddress = $user['wallet_address'];
                    $url = 'https://api.trongrid.io/v1/accounts/' . $user['wallet_address'] . '/transactions/trc20';
                }
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                $jsonD = json_decode($response, true);
                if ($co == 'bep_rvc') {
                    if (!empty($jsonD['result'])) {
                        foreach ($jsonD['result'] as $transaction) {
                            $check = $this->User_model->get_single_record('tbl_block_address', ['timeStamp' => $transaction['timeStamp']], 'timeStamp');
                            $tokenValue = $this->User_model->get_single_record('tbl_token_value', ['id' => 1], 'amount');
                            if (empty($check)) {
                                $addredArr  = [
                                    'user_id' => $this->session->userdata['user_id'],
                                    'timeStamp' => $transaction['timeStamp'],
                                    'hash' => $transaction['hash'],
                                    'blockHash' => $transaction['hash'],
                                    'from' => $transaction['from'],
                                    'to' => $transaction['to'],
                                    'txn_id' => $transaction['hash'],

                                    'value' => ($transaction['value'] / 1000000000000000000),
                                    'tokenName' => 'BEP_RVC',
                                    'tokenDecimal' => 18,
                                ];
                                $this->User_model->add('tbl_block_address', $addredArr);
                                $senderData = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => ($transaction['value'] / 1000000000000000000) * $tokenValue['amount'],
                                    'token_price' => $tokenValue['amount'],
                                    'sender_id' => $transaction['to'],
                                    'type' => 'automatic_fund_deposit',
                                    'remark' => 'Automatic fund deposit',
                                );
                                $res = $this->User_model->add('tbl_wallet', $senderData);
                            }
                        }
                    }
                } else {

                    if (!empty($jsonD['data'])) {
                        foreach ($jsonD['data'] as $transaction) {
                            if ($transaction['token_info']['symbol'] == 'USDT'  && $transaction['token_info']['address'] == 'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t') {

                                $check = $this->User_model->get_single_record('tbl_block_address', ['timeStamp' => $transaction['block_timestamp']], 'timeStamp');
                                if (empty($check) && $transaction['to'] == $user['wallet_address']) {
                                    $addredArr  = [
                                        'user_id' => $this->session->userdata['user_id'],
                                        'timeStamp' => $transaction['block_timestamp'],
                                        'hash' => $transaction['transaction_id'],
                                        'blockHash' => $transaction['transaction_id'],
                                        'from' => $transaction['from'],
                                        'to' => $transaction['to'],
                                        'txn_id' => $transaction['transaction_id'],
                                        // 'type' => $transaction['raw_data']['contract'][0]['type'],
                                        'value' => $transaction['value'] / 1000000,
                                        'tokenName' => 'USDT',
                                        'tokenDecimal' => 6,
                                    ];
                                    $this->User_model->add('tbl_block_address', $addredArr);
                                    $senderData = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => $transaction['value'] / 1000000,
                                        'sender_id' => $transaction['from'],
                                        'type' => 'automatic_fund_deposit',
                                        'remark' => 'Automatic fund deposit',
                                    );
                                    $res = $this->User_model->add('tbl_wallet', $senderData);
                                }
                            }


                            // pr($transaction,true);
                            // pr($user['hex_address']);
                            // pr(strtoupper($transaction['raw_data']['contract'][0]['parameter']['value']['to_address']),true);
                            // $check = $this->User_model->get_single_record('tbl_block_address',['timeStamp' => $transaction['timeStamp']],'timeStamp');
                            // if(empty($check)){
                            //     $getprice = $this->livePrice();
                            //     $jsonPrice = json_decode($getprice,true); 
                            //     // if($user['wallet_address'] == $transaction['raw_data']['contract'][0]['parameter']['value']['to_address']){

                            //         $addredArr  = [
                            //             'user_id' => $this->session->userdata['user_id'],
                            //             'txn_id' => $transaction['transaction_id'],
                            //             'timeStamp' => $transaction['timeStamp'],
                            //             'hash' => $transaction['hash'],
                            //             'blockHash' => $transaction['hash'],
                            //             'from' => $transaction['from'],
                            //             'to' => $transaction['to'],
                            //             // 'type' => $transaction['raw_data']['contract'][0]['type'],
                            //             'value' =>$transaction['value']/ 1000000,
                            //             'tokenName' => $co,
                            //             'tokenDecimal' => 6,
                            //         ];
                            //         $this->User_model->add('tbl_block_address',$addredArr);
                            //         $senderData = array(
                            //             'user_id' => $this->session->userdata['user_id'],
                            //             'amount' =>$jsonPrice['USD']*($transaction['value']/ 1000000),
                            //             'sender_id' => $transaction['to'],
                            //             'type' => 'automatic_fund_deposit',
                            //             'remark' => 'Automatic fund deposit',
                            //         );
                            //         $res = $this->User_model->add('tbl_wallet', $senderData);
                            //     // }    
                            // }
                        }
                    }
                }
            }

            $response1['records'] = $this->User_model->get_records('tbl_block_address', ['user_id' => $this->session->userdata['user_id']], '*');
            $this->load->view('depositHistory', $response1);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function depositAjax()
    {
        if (is_logged_in()) {

            $user = $this->User_model->get_single_record('tbl_users', ['user_id' => $this->session->userdata['user_id']], 'wallet_public,wallet_address,wallet_address2');
            $tokenValue = $this->User_model->get_single_record('tbl_token_value', ['id' => 1], 'amount');
            $coin = ['bep_rvc'];
            foreach ($coin as $co) {

                if ($co == 'Bep') {
                    $walletAddress = $user['wallet_address2'];
                    $url = 'https://api.bscscan.com/api?module=account&action=tokentx&contractaddress=0x55d398326f99059fF775485246999027B3197955&address=' . $walletAddress . '&page=1&offset=100&startblock=0&endblock=999999999&sort=desc&apikey=D4J7HQQSRA6AKKS3ABBCP9PI7ZSF5G5G78';
                } elseif ($co == 'bep_rvc') {
                    $walletAddress = $user['wallet_address2'];
                    $url = 'https://api.bscscan.com/api?module=account&action=tokentx&contractaddress=0x7b95723f5b987b4C0FB99fc8Af843572A1834dD3&address=' . $walletAddress . '&page=1&offset=100&startblock=0&endblock=999999999&sort=desc&apikey=D4J7HQQSRA6AKKS3ABBCP9PI7ZSF5G5G78';
                } else {
                    $walletAddress = $user['wallet_address'];
                    $url = 'https://api.trongrid.io/v1/accounts/' . $user['wallet_address'] . '/transactions/trc20';
                }
                // $curl = curl_init();
                // curl_setopt_array($curl, array(
                // CURLOPT_URL => 'https://crypto.mlmstore.co/Api/Apikey/checktokenTransaction',
                // CURLOPT_RETURNTRANSFER => true,
                // CURLOPT_ENCODING => '',
                // CURLOPT_MAXREDIRS => 10,
                // CURLOPT_TIMEOUT => 0,
                // CURLOPT_FOLLOWLOCATION => true,
                // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                // CURLOPT_CUSTOMREQUEST => 'POST',
                // CURLOPT_POSTFIELDS => array('api_key' => '79105344761ac082c514ea0de411e83a','tokenname' => $co,'wallet_address' => $user['wallet_address']),
                // CURLOPT_HTTPHEADER => array(
                //     'Cookie: PHPSESSID=r66ssmc41m6oi1oul83rkk4grk'
                // ),
                // ));

                // $response = curl_exec($curl);

                // curl_close($curl);
                // // echo $response;
                // // die;
                // $jsonD = json_decode($response,true); 
                // $url = 'https://api.trongrid.io/v1/accounts/'.$user['wallet_address'].'/transactions/trc20';
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                $jsonD = json_decode($response, true);
                if ($co == 'bep_rvc') {
                    if (!empty($jsonD['result'])) {
                        foreach ($jsonD['result'] as $transaction) {
                            $check = $this->User_model->get_single_record('tbl_block_address', ['timeStamp' => $transaction['timeStamp']], 'timeStamp');
                            $tokenValue = $this->User_model->get_single_record('tbl_token_value', ['id' => 1], 'amount');

                            if (empty($check)) {
                                if ($co == 'bep_rvc') {
                                    $co = 'BEP_RVC';
                                } else {
                                    $co = 'BEP_USDT';
                                }
                                $addredArr  = [
                                    'user_id' => $this->session->userdata['user_id'],
                                    'timeStamp' => $transaction['timeStamp'],
                                    'hash' => $transaction['hash'],
                                    'blockHash' => $transaction['hash'],
                                    'from' => $transaction['from'],
                                    'to' => $transaction['to'],
                                    'txn_id' => $transaction['hash'],

                                    // 'type' => $transaction['raw_data']['contract'][0]['type'],
                                    'value' => ($transaction['value'] / 1000000000000000000),
                                    'tokenName' => $co, //'BEP_USDT',
                                    'tokenDecimal' => 18,
                                ];
                                $this->User_model->add('tbl_block_address', $addredArr);
                                $senderData = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => ($transaction['value'] / 1000000000000000000) * $tokenValue['amount'],
                                    'token_price' => $tokenValue['amount'],
                                    'sender_id' => $transaction['to'],
                                    'type' => 'automatic_fund_deposit',
                                    'remark' => 'Automatic fund deposit',
                                );
                                $res = $this->User_model->add('tbl_wallet', $senderData);
                            }
                        }
                    }
                } else {

                    if (!empty($jsonD['data'])) {
                        foreach ($jsonD['data'] as $transaction) {
                            if ($transaction['token_info']['symbol'] == 'USDT'  && $transaction['token_info']['address'] == 'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t') {

                                $check = $this->User_model->get_single_record('tbl_block_address', ['timeStamp' => $transaction['block_timestamp']], 'timeStamp');
                                if (empty($check) && $transaction['to'] == $user['wallet_address']) {
                                    $addredArr  = [
                                        'user_id' => $this->session->userdata['user_id'],
                                        'timeStamp' => $transaction['block_timestamp'],
                                        'hash' => $transaction['transaction_id'],
                                        'blockHash' => $transaction['transaction_id'],
                                        'from' => $transaction['from'],
                                        'to' => $transaction['to'],
                                        'txn_id' => $transaction['transaction_id'],
                                        // 'type' => $transaction['raw_data']['contract'][0]['type'],
                                        'value' => $transaction['value'] / 1000000,
                                        'tokenName' => 'USDT',
                                        'tokenDecimal' => 6,
                                    ];
                                    $this->User_model->add('tbl_block_address', $addredArr);
                                    $senderData = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => $transaction['value'] / 1000000,
                                        'sender_id' => $transaction['from'],
                                        'type' => 'automatic_fund_deposit',
                                        'remark' => 'Automatic fund deposit',
                                    );
                                    $res = $this->User_model->add('tbl_wallet', $senderData);
                                }
                            }


                            // pr($transaction,true);
                            // pr($user['hex_address']);
                            // pr(strtoupper($transaction['raw_data']['contract'][0]['parameter']['value']['to_address']),true);
                            // $check = $this->User_model->get_single_record('tbl_block_address',['timeStamp' => $transaction['timeStamp']],'timeStamp');
                            // if(empty($check)){
                            //     $getprice = $this->livePrice();
                            //     $jsonPrice = json_decode($getprice,true); 
                            //     // if($user['wallet_address'] == $transaction['raw_data']['contract'][0]['parameter']['value']['to_address']){

                            //         $addredArr  = [
                            //             'user_id' => $this->session->userdata['user_id'],
                            //             'txn_id' => $transaction['transaction_id'],
                            //             'timeStamp' => $transaction['timeStamp'],
                            //             'hash' => $transaction['hash'],
                            //             'blockHash' => $transaction['hash'],
                            //             'from' => $transaction['from'],
                            //             'to' => $transaction['to'],
                            //             // 'type' => $transaction['raw_data']['contract'][0]['type'],
                            //             'value' =>$transaction['value']/ 1000000,
                            //             'tokenName' => $co,
                            //             'tokenDecimal' => 6,
                            //         ];
                            //         $this->User_model->add('tbl_block_address',$addredArr);
                            //         $senderData = array(
                            //             'user_id' => $this->session->userdata['user_id'],
                            //             'amount' =>$jsonPrice['USD']*($transaction['value']/ 1000000),
                            //             'sender_id' => $transaction['to'],
                            //             'type' => 'automatic_fund_deposit',
                            //             'remark' => 'Automatic fund deposit',
                            //         );
                            //         $res = $this->User_model->add('tbl_wallet', $senderData);
                            //     // }    
                            // }
                        }
                    }
                }
            }

            $response1['records'] = $this->User_model->get_single_record('tbl_wallet', ['user_id' => $this->session->userdata['user_id']], 'ifnull(sum(amount),0) as balance');
            echo json_encode($response1);
            // $this->load->view('depositHistory',$response1);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function requests()
    {
        if (is_logged_in()) {
            $response = array();
            $response['requests'] = $this->User_model->get_records('tbl_payment_request', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('requests', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function transfer_history()
    {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->get_records('tbl_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => 'fund_transfer'), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_history', $response);
            $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function wallet_ledger()
    {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->get_records('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header');
            $this->load->view('wallet_ledger', $response);
            $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function activation_history()
    {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->get_records('tbl_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => 'account_activation'), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => 'account_activation'), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header');
            $this->load->view('wallet_ledger', $response);
            // $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function upgrade_history()
    {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->get_records('tbl_wallet', array('user_id' => $this->session->userdata['user_id'], 'amount >' => 100), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id'], 'amount >' => 100), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header');
            $this->load->view('wallet_ledger2', $response);
            // $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }

    // public function transfer_fund()
    // {

    //     if (is_logged_in()) {
    //         $response = array();
    //         $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->set_userdata['user_id']), '*');
    //         $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
    //         if ($this->input->server('REQUEST_METHOD') == 'POST') {
    //             $data = $this->security->xss_clean($this->input->post());
    //             if ($data['amount'] >= 10) {
    //                 if ($data['user_id'] != $this->session->set_userdata['user_id']) {
    //                     $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
    //                     if (!empty($receiver)) {
    //                         if ($response['user']['retopup'] == 0) {
    //                             if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
    //                                 $senderData = array(
    //                                     'user_id' => $this->session->userdata['user_id'],
    //                                     'amount' => -$data['amount'],
    //                                     'sender_id' => $data['user_id'],
    //                                     'type' => 'fund_transfer',
    //                                     'remark' => $data['remark'],
    //                                 );
    //                                 $res = $this->User_model->add('tbl_wallet', $senderData);
    //                                 if ($res) {
    //                                     $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
    //                                     $this->session->set_flashdata('message', 'Fund Transferred Successfully');
    //                                     $receiverData = array(
    //                                         'user_id' => $data['user_id'],
    //                                         'amount' => $data['amount'],
    //                                         'sender_id' => $this->session->userdata['user_id'],
    //                                         'type' => 'fund_transfer',
    //                                         'remark' => $data['remark'],
    //                                     );
    //                                     $this->User_model->add('tbl_wallet', $receiverData);
    //                                 } else {
    //                                     $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
    //                                 }
    //                             } else {
    //                                 $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
    //                             }
    //                         } else {
    //                             $this->session->set_flashdata('message', 'Please upgrade your account to continue this facility');
    //                         }
    //                     } else {
    //                         $this->session->set_flashdata('message', 'Invalid Receiver Id');
    //                     }
    //                 } else {
    //                     $this->session->set_flashdata('message', 'You Cannot Transfer Amount In Same Account');
    //                 }
    //             } else {
    //                 $this->session->set_flashdata('message', 'Minimun Transfer Amount is $10');
    //             }
    //         }
    //         $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
    //         $this->load->view('header', $response);
    //         $this->load->view('Fund/transfer_fund', $response);
    //     } else {
    //         redirect('Dashboard/User/login');
    //     }
    // }

    public function maintransfer_fund()
    {

        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->set_userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] >= 20) {
                    // if ($data['user_id'] != $this->session->set_userdata['user_id']) {
                    // $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                    // if (!empty($receiver)) {
                    if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
                        $senderData = array(
                            'user_id' => $this->session->userdata['user_id'],
                            'amount' => -$data['amount'],
                            // 'sender_id' => $data['user_id'],
                            'type' => 'fund_transfer',
                            'description' => $data['remark'],
                        );
                        $res = $this->User_model->add('tbl_income_wallet', $senderData);
                        if ($res) {
                            $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                            $this->session->set_flashdata('message', 'Fund Transferred Successfully');
                            $receiverData = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => ($data['amount'] * 10) / 100,
                                // 'sender_id' => $this->session->userdata['user_id'],
                                'type' => 'fund_transfer',
                                'remark' => $data['remark'],
                            );
                            $this->User_model->add('tbl_wallet', $receiverData);
                        } else {
                            $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
                    }
                    // } else {
                    //     $this->session->set_flashdata('message', 'Invalid Receiver Id');
                    // }
                    // } else {
                    //     $this->session->set_flashdata('message', 'You Cannot Transfer Amount In Same Account');
                    // }
                } else {
                    $this->session->set_flashdata('message', 'Minimun Transfer Amount is 20 ZIL');
                }
            }
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/maintransfer_fund', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function ewallet_to_ewallet()
    {

        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->set_userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] > 0) {
                    if ($data['user_id'] != $this->session->set_userdata['user_id']) {
                        $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                        if (!empty($receiver)) {
                            if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
                                $senderData = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => -$data['amount'],
                                    'sender_id' => $data['user_id'],
                                    'type' => 'fund_transfer',
                                    'remark' => $data['remark'],
                                );
                                $res = $this->User_model->add('tbl_wallet', $senderData);
                                if ($res) {
                                    $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                                    $this->session->set_flashdata('message', 'Fund Transferred Successfully');
                                    $receiverData = array(
                                        'user_id' => $data['user_id'],
                                        'amount' => ($data['amount'] * 10) / 100,
                                        'sender_id' => $this->session->userdata['user_id'],
                                        'type' => 'fund_transfer',
                                        'remark' => $data['remark'],
                                    );
                                    $this->User_model->add('tbl_wallet', $receiverData);
                                } else {
                                    $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid Receiver Id');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'You Cannot Transfer Amount In Same Account');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Minimun Transfer Amount is rs 0');
                }
            }
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_fund', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function income_to_ewallet()
    {

        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] > 0) {
                    // if ($data['user_id'] != $this->session->set_userdata['user_id']) {
                    $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    if (!empty($receiver)) {
                        if ($response['user']['master_key'] == $data['master_key']) {

                            if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
                                $senderData = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => -$data['amount'],
                                    'type' => 'income_transfer',
                                    'description' => 'Transfer Income',
                                );
                                $res = $this->User_model->add('tbl_income_wallet', $senderData);
                                if ($res) {
                                    $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                                    $this->session->set_flashdata('message', 'Fund Transferred Successfully');
                                    $receiverData = array(
                                        'user_id' =>  $this->session->userdata['user_id'],
                                        'amount' => ($data['amount'] * 90) / 100,
                                        'sender_id' => $this->session->userdata['user_id'],
                                        'type' => 'income_transfer',
                                        'remark' =>  'Transfer Income',
                                    );
                                    $this->User_model->add('tbl_wallet', $receiverData);
                                } else {
                                    $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid Tnx Paasword');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Invalid User Id');
                    }
                    // } else {
                    //     $this->session->set_flashdata('message', 'You Cannot Transfer Amount In Same Account');
                    // }
                } else {
                    $this->session->set_flashdata('message', 'Minimun Transfer Amount is $ 1');
                }
            }
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/income_ewallet', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function shopping_wallet_transfer()
    {

        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->set_userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] > 0) {
                    if ($data['user_id'] != $this->session->set_userdata['user_id']) {
                        $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                        if (!empty($receiver)) {
                            if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
                                $senderData = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => -$data['amount'],
                                    'sender_id' => $data['user_id'],
                                    'type' => 'fund_transfer',
                                    'remark' => $data['remark'],
                                );
                                $res = $this->User_model->add('tbl_wallet', $senderData);
                                if ($res) {
                                    $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                                    $this->session->set_flashdata('message', 'Fund Transferred Successfully');
                                    $receiverData = array(
                                        'user_id' => $data['user_id'],
                                        'amount' => $data['amount'],
                                        'sender_id' => $this->session->userdata['user_id'],
                                        'type' => 'fund_transfer',
                                        'remark' => $data['remark'],
                                    );
                                    $this->User_model->add('tbl_shopping_wallet', $receiverData);
                                } else {
                                    $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid Receiver Id');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'You Cannot Transfer Amount In Same Account');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Minimun Transfer Amount is rs 0');
                }
            }
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_fund', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function token_wallet_transfer()
    {

        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->set_userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] > 0) {
                    if ($data['user_id'] != $this->session->set_userdata['user_id']) {
                        $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                        if (!empty($receiver)) {
                            if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
                                $senderData = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => -$data['amount'],
                                    'sender_id' => $data['user_id'],
                                    'type' => 'fund_transfer',
                                    'remark' => $data['remark'],
                                );
                                $res = $this->User_model->add('tbl_wallet', $senderData);
                                if ($res) {
                                    $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                                    $this->session->set_flashdata('message', 'Fund Transferred Successfully');
                                    $receiverData = array(
                                        'user_id' => $data['user_id'],
                                        'amount' => $data['amount'],
                                        'sender_id' => $this->session->userdata['user_id'],
                                        'type' => 'fund_transfer',
                                        'remark' => $data['remark'],
                                    );
                                    $this->User_model->add('tbl_token_wallet', $receiverData);
                                } else {
                                    $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid Receiver Id');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'You Cannot Transfer Amount In Same Account');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Minimun Transfer Amount is rs 0');
                }
            }
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_fund', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function all_transactions()
    {
        if (is_logged_in()) {
            $response = array();
            $response['transactions'] = $this->User_model->get_records('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,amount,type,description,created_at');
            $this->load->view('all_transactions', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function withdraw_request()
    {
        if (is_logged_in()) {
            $response = array();
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as total_income');
            //            pr($response,true);
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] > 0) {
                    if ($response['balance']['total_income'] >= $data['amount']) {
                        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'otp');
                        if ($user['otp'] == $data['otp']) {

                            $incomeArr = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -$data['amount'],
                                'type' => 'withdraw_amount',
                                'description' => 'WIthdraw Amount',
                            );
                            $withdrawArr = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => $data['amount'],
                            );
                            $res = $this->User_model->add('tbl_income_wallet', $incomeArr);
                            $this->User_model->add('tbl_withdraw', $withdrawArr);
                            if ($res) {
                                $this->session->set_flashdata('message', 'Withdraw Request Submitted Successfully');
                                $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as total_income');
                            } else {
                                $this->session->set_flashdata('message', 'Error While Requesting Withdraw Please Try Again ...');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid Otp');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Maximum Transfer Amount is $' . $response['balance']['total_income']);
                    }
                } else {
                    $this->session->set_flashdata('message', 'Minimun Withdraw Amount is $0');
                }
            }
            $this->load->view('withdraw_request', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function withdraw_summary()
    {
        if (is_logged_in()) {
            $response = array();
            $response['withdraw_transctions'] = $this->User_model->get_records('tbl_withdraw', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as sum');
            //            $this->load->view('header', $response);
            $this->load->view('withdraw_summary', $response);
            //            $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function FundRequest()
    {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->set_userdata['user_id']), '*');
            $transaction_id = $this->User_model->get_records('tbl_payment_request', array(''), 'transaction_id');
            if ($this->input->server("REQUEST_METHOD") == "POST") {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
                $this->form_validation->set_rules('hash_id', 'Hash ID', 'trim|required');
                if ($this->form_validation->run() != false) {
                    if ($transaction_id != $data['hash_id']) {
                        if ($data['payment_method'] == 'coinbase') {
                            $this->session->set_tempdata('amount', $data['amount'], 300);
                            redirect('Dashboard/Fund/coinbaseGateway');
                        } elseif ($data['payment_method'] == 'coin_payment') {
                            $this->session->set_tempdata('amount', $data['amount'], 300);
                            redirect('Dashboard/Fund/coinpaymentform');
                        } else {
                            redirect('Dashboard/User');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Invalid Hash ID');
                    }
                }
            }
            $this->load->view('header', $response);
            $this->load->view('Fund/coinbase_fund', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function coinpaymentform()
    {
        if (is_logged_in()) {
            if (!empty($this->session->tempdata('amount'))) {
                $response['amount'] = $this->session->tempdata('amount');
                $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                $this->load->view('header', $response);
                $this->load->view('Fund/coinpayment_internal', $response);
            } else {
                redirect('Dashboard/Fund/FundRequest');
            }
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function coinbaseGateway()
    {
        if (is_logged_in()) {
            if (!empty($this->session->tempdata('amount'))) {
                //$data = $this->security->xss_clean($this->input->post());
                $user_id = $this->session->userdata['user_id'];
                //$package = $this->User_model->get_single_record('tbl_package', array('id' => $id), '*');  
                $userInfo = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                $amount = $this->session->tempdata('amount');
                $email = $userInfo['email'];
                $curl = curl_init();
                $params = new stdClass();
                $params->name = $user_id;
                $params->description = 'Fund Request';

                $local_price = new stdClass();
                $local_price->amount = $amount;

                $local_price->currency = 'USD';
                $params->local_price = $local_price;
                $params->pricing_type = 'fixed_price';
                $params->requested_info = ['email'];
                // echo json_encode($params);

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.commerce.coinbase.com/checkouts",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($params),
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "X-CC-Api-Key: 45ac6b2e-529d-4d7f-b761-19d1384369d2",
                        "X-CC-Version: 2018-03-22",
                        "Cookie: __cfduid=da062b513a9ad4c1d0c77a2a7d01979841606206538"
                    ),
                ));

                $response = json_decode(curl_exec($curl), true);
                $response['package'] = $amount;
                $this->User_model->add('tbl_coinbase_transactions', ['user_id' => $user_id, 'checkout' => $response['data']['id'], 'data' => $amount, 'trans_type' => '1']);
                curl_close($curl);
                $response['amount'] = $amount;
                $this->load->view('addBalanceCoinBase', $response);
            } else {
                redirect('Dashboard/Fund/FundRequest');
            }
        } else {
            redirect('Dashboard/User/login');
        }
    }
}
