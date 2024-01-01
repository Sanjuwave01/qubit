<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','Binance'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

   

    public function index() {
        // die('under matainace!');

        $response = array();
        $sponser_id = $this->input->get('sponser_id');
        if($sponser_id == ''){
            $sponser_id = '';
        }
        $response['packages'] = $this->User_model->get_records('tbl_package',[],'*');
        $response['countries'] = $this->User_model->get_records('countries',[],'*');
        $response['sponser_id'] = $sponser_id;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('sponser_id', 'Sponser ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('user_id', 'User Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
            // $this->form_validation->set_rules('otp', 'OTP', 'trim|required|numeric');

            //$this->form_validation->set_rules('Lposition', 'Position', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
               $this->session->set_flashdata('error', validation_errors());
               $this->load->view('register', $response);
            }else{
                // if(!empty($this->input->post('Lposition') == "L")){
                //     $position= 'L';
                // }elseif(!empty($this->input->post('Lposition') == "R")){
                //     $position= 'R';
                // }

                $paidReg = false;

                $otp = $this->input->post('otp');
                $sponser_id = $this->input->post('sponser_id');
                $phone = $this->input->post('phone');
                $package_invest = $this->input->post('package');
                $response['sponser_id'] = $sponser_id;
                $userID = $this->input->post('user_id');
                $user_id = str_replace(" ","",$userID);
                $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), '*');
                $package = $this->User_model->get_single_record('tbl_package',['id' => 1],'*');
                $emailCheck = $this->User_model->get_single_record('tbl_users', array('email' => $this->input->post('email')), 'email');
                $phoneCheck = $this->User_model->get_single_record('tbl_users', array('phone' => $this->input->post('phone')), 'phone');
                $UserCheck = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id');

 
                if(empty($UserCheck)){
                    if(!empty($sponser)){
                        if(empty($emailCheck)){
                            // if(!empty($_SESSION['verification_otp_email'])){
                                // if($_SESSION['verification_otp_email'] == $otp){
                                    // if(empty($phoneCheck)){
                                        $status = $this->input->post('status');
                                        $id_number = $this->getUserIdForRegister();
                                        $userData['user_id'] = $user_id; //$id_number;
                                        $userData['sponser_id'] = $sponser_id;
                                        $userData['name'] = $this->input->post('name');
                                        // $userData['eth_address'] = $this->input->post('sender');
                                        // $userData['tranx_id'] = $this->input->post('txn');
                                        // $userData['eth'] = $this->input->post('eth');
                                        // $userData['phone'] = $this->input->post('phone');
                                        $userData['country'] = $this->input->post('country');
                                        $userData['password'] = $this->input->post('password'); //rand(100000,999999);
                                        $userData['email'] = $this->input->post('email');
                                        $userData['master_key'] = rand(100000,999999);
                                        // $userData['position'] = $position;
                                        // $userData['last_left'] = $userData['user_id'];
                                        // $userData['last_right'] = $userData['user_id'];
                                        // $walletAdd = $this->walletAddress();
                                        // $jsonD = json_decode($walletAdd,true);
                                        // $userData['wallet_address'] = !empty($jsonD['address'])?$jsonD['address']:'';

                                        if($paidReg == true){
                                            $userData['package_id'] = $package['id'];
                                            $userData['package_amount'] = $package_invest ;//$package['price'];
                                            // $userData['tron_details'] = $this->input->post('receiptdata');

                                            $userData['paid_status'] = 1;
                                            $userData['topup_date'] = date('Y-m-d H:i:s');
                                            $hub_rate = $this->User_model->get_single_record('tbl_admin', ['id' => 1], 'hub_rate');
                                            $userData['hub_price'] = $package_invest/$hub_rate['hub_rate'];
                                            $userData['capping'] = $package['capping'];
                                        }
                                        // if($userData['position'] == 'L'){
                                        //     $userData['upline_id'] = $sponser['last_left'];
                                        // }else{
                                        //     $userData['upline_id'] = $sponser['last_right'];
                                        
                                        // }

                                        $userData['otp'] = generateNumericOTP(6);
                                        
                                        $res = $this->User_model->add('tbl_users', $userData);
                                        $insertUserId = $res;
                                        $res = $this->User_model->add('tbl_bank_details',array('user_id' => $userData['user_id'] ));
                                        if ($res) {
                                            // if ($userData['position'] == 'R') {
                                            //     $this->User_model->update('tbl_users', array('last_right' => $userData['upline_id']), array('last_right' => $userData['user_id']));
                                            //     $this->User_model->update('tbl_users', array('user_id' => $userData['upline_id']), array('right_node' => $userData['user_id']));
                                            // } elseif ($userData['position'] == 'L') {
                                            //     $this->User_model->update('tbl_users', array('last_left' => $userData['upline_id']), array('last_left' => $userData['user_id']));
                                            //     $this->User_model->update('tbl_users', array('user_id' => $userData['upline_id']), array('left_node' => $userData['user_id']));
                                            // }
                                            // $this->add_counts($userData['user_id'], $userData['user_id'], 1);
                                            $this->add_sponser_counts($userData['user_id'],$userData['user_id'], $level = 1);

                                            if($paidReg == true){
                                                $this->User_model->update_directs($userData['sponser_id']);

                                                $roiMaker = $userData['hub_price']*$package['commision'];
                                            
                                                $roiArr = array(
                                                    'user_id' => $userData['user_id'],
                                                    'amount' => ($roiMaker * $package['days']),
                                                    'roi_amount' => $roiMaker,
                                                    'days' => $package['days'],
                                                    'type' => 'roi_income',
                                                );
                                                $this->User_model->add('tbl_roi', $roiArr);

                                                $directIncome = [
                                                    'user_id' => $userData['sponser_id'],
                                                    'amount' => $package_invest*$package['direct_income']/100,
                                                    'type' => 'direct_income',
                                                    'description' => 'Direct Income From User '.$userData['user_id'],
                                                ];
                                                $this->User_model->add('tbl_income_wallet',$directIncome);

                                                $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $userData['sponser_id']), 'sponser_id,paid_status,package_amount,package_id,directs');
                                                
                                                $this->level_income($sponser['sponser_id'], $userData['user_id'], $package['level_income'], $package_invest);
                                            }


                                           // sendOTP($userData);
                                            //redirect(base_url().'Dashboard/Register/veryfiedOTP?user_id='.$insertUserId);

                                            $response['message'] = 'Dear ' .$userData['name']. ', Your Account Successfully created. <br>User ID :  ' . $userData['user_id'] . ' <br> Password :' . $userData['password'] . ' <br> Transaction Password:' .$userData['master_key']
                                            .'Hi, We are so happy to have you on board! Together with Kubit Coin, and the Kubit Coin Global platform, Kubit Coin strives to disrupt entire industries by pioneering the world`s most comprehensive digital finance ecosystem and transform the world economy. Are you ready to be inspired? Ricaverse Global Team This is an automated message. Please do not reply. © 2023 - 2024 All Rights Reserved.';
                                            // composeMail($userData['email'],'Registration',$response['message'],$display=false);
                                            send_crypto_email($userData['email'],'Registration',$response['message'],$display=false);

                                        
                                            $sms_text = 'Dear ' . $userData['name'] . '. Your Account Successfully created. User ID : ' . $userData['user_id'] . '. Password :' . $userData['password'] . '. Transaction Password:' . $userData['master_key'] . '. ' . base_url().'';
                                            $email_msg['message'] = '<p>Hi ' . $userData['name'] . ' </p>
                                            <p>Congratulations on becoming Consultant with !</p>
                                            <p>Welcome to the world of crypto Currency .</p>
                                            <p> is a crypto wallet and exchange platform where merchants and consumers can transact with digital
                                                assets BNBCAP We`re based out of LONDON UNITED KINGDOM(U.K.)</p>
                                            <p>We look forward to long term association with you.</p>
                                            Login: <a href="'.base_url('Dashboard/User/MainLogin').'" target=\'_blank\'>Click here</a>
                                            <br> User Id:' . $userData['user_id'] . '<br>Password
                                            :' . $userData['password'].'<br> Transaction Password:'.$userData['master_key'];
                                            $email_msg['message_data'] = '<p>Hi ' . $userData['name'] . ' </p>
                                            <p>Congratulations on becoming Consultant with !</p>
                                            <p>Welcome to the world of crypto Currency .</p>
                                            <p> is a crypto wallet and exchange platform where merchants and consumers can transact with digital
                                                assets BNBCAP We`re based out of LONDON UNITED KINGDOM(U.K.)</p>
                                            <p>We look forward to long term association with you.</p>
                                            Login: <a href="'.base_url('Dashboard/User/MainLogin').'" target=\'_blank\'>Click here</a>
                                            <br> User Id:' . $userData['user_id'] . '<br>Password
                                            :' . $userData['password'].'<br> Transaction Password:'.$userData['master_key'];
                                            $email_msg['name'] = $userData['name'];
                                            $email_msg['user_id'] = $insertUserId;
                                            _sendWelcomeMail($userData, $email_msg);
                                            $this->load->view('success', $response);



                                        }else {
                                            $this->session->set_flashdata('error', 'Error while Registraion please try Again');
                                            $this->load->view('register', $response);
                                        }
                                    // }else{
                                    //     $this->session->set_flashdata('error', "This Phone number already exists");
                                    //     $this->load->view('register', $response);
                                    // }
                            //     } else {
                            //         $this->session->set_flashdata('error', "Invalid OTP,Please try valid OTP!");
                            //         $this->load->view('register', $response);
                            //     }
                            // } else {
                            //     $this->session->set_flashdata('error', "OTP Expired!");
                            //     $this->load->view('register', $response);
                            // }
                        }else{
                            $this->session->set_flashdata('error', "This E-mail already exists");
                            $this->load->view('register', $response);
                        }
                    } else{
                        $this->session->set_flashdata('error', "Please enter valid Sponsor ID.");
                        $this->load->view('register', $response);
                    }
                }else{
                    $this->session->set_flashdata('error', "User Name already exists.");
                    $this->load->view('register', $response);
                }
            }
        } else {
            $this->load->view('register', $response);
        }
        
    }



    public function resentOTP()
    {

        $userData['otp'] = generateNumericOTP(6);
        $user_id = $this->input->post('user_id');
        $userData = $this->User_model->get_single_record('tbl_users', array('id' => $user_id), '*');
        if ($this->input->is_ajax_request()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                    if($userData) {
                        $this->db->where('id', $user_id);
                        $this->db->update('tbl_users', array('otp' => $userData['otp']));

                        sendOTP($userData);
                        
                        $response['status'] = 1;
                    }
                else {
                    $response['status'] = 0;
                }
            }
        }else{
            $response['status'] = 0;
        }
        echo json_encode($response);
    }





    public function veryfiedOTP() {
        $response = array();
        $otp = $this->input->post('otp');
        $userid = $this->input->post('user_id');

        $user_id = $this->input->get('user_id');

        $userData = $this->User_model->get_single_record('tbl_users', array('id' => $userid), '*');

        $response['user_id'] = $user_id;
       //return redirect($link);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            if(!empty($userData)){

                $array = array('id' => $userid, 'otp' => $otp);

                $userInfoVal = $this->User_model->get_single_record('tbl_users', $array, 'sponser_id,paid_status,package_amount,package_id,directs');

                if($userInfoVal) {

                    $this->db->from('tbl_users');
                    $this->db->where('id', $userData['id']);
                    $this->db->update('tbl_users', array('email_verified' => '1'));

                    $response['message'] = 'Dear ' .$userData['name']. ', Your Account Successfully created. <br>User ID :  ' . $userData['user_id'] . ' <br> Password :' . $userData['password'] . ' <br> Transaction Password:' .$userData['master_key']
                    .'Hi, We are so happy to have you on board! Together with Kubit Coin, and the Kubit Coin Global platform, Kubit Coin Group strives to disrupt entire industries by pioneering the world`s most comprehensive digital finance ecosystem and transform the world economy. Are you ready to be inspired? Ricaverse Global Team This is an automated message. Please do not reply. © 2023 - 2024 All Rights Reserved.';
                    // composeMail($userData['email'],'Registration',$response['message'],$display=false);
                    send_crypto_email($userData['email'],'Registration',$response['message'],$display=false);
    
                    $sms_text = 'Dear ' . $userData['name'] . '. Your Account Successfully created. User ID : ' . $userData['user_id'] . '. Password :' . $userData['password'] . '. Transaction Password:' . $userData['master_key'] . '. ' . base_url().'';
                    $email_msg['message'] = '<p>Hi ' . $userData['name'] . ' </p>
                    <p>Congratulations on becoming Consultant with !</p>
                    <p>Welcome to the world of crypto Currency .</p>
                   
                    <p>We look forward to long term association with you.</p>
                    Login: <a href="'.base_url('Dashboard/User/MainLogin').'" target=\'_blank\'>Click here</a>
                    <br> User Id:' . $userData['user_id'] . '<br>Password
                    :' . $userData['password'].'<br> Transaction Password:'.$userData['master_key'];
                    $email_msg['message_data'] = '<p>Hi ' . $userData['name'] . ' </p>
                    <p>Congratulations on becoming Consultant with !</p>
                    <p>Welcome to the world of crypto Currency .</p>
                    <p>We look forward to long term association with you.</p>
                    Login: <a href="'.base_url('Dashboard/User/MainLogin').'" target=\'_blank\'>Click here</a>
                    <br> User Id:' . $userData['user_id'] . '<br>Password
                    :' . $userData['password'].'<br> Transaction Password:'.$userData['master_key'];
                    $email_msg['name'] = $userData['name'];
                    $email_msg['user_id'] = $userData['id'];
                    _sendWelcomeMail($userData, $email_msg);
                    $this->load->view('success', $response);
                }
                else {
                    $this->session->set_flashdata('error', "Invalid OTP,Please try valid OTP!");
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $this->session->set_flashdata('error', "User not found");
                redirect('Dashboard/Register');
            }
        } else {
            $this->load->view('otp', $response);
        }
    }

    private function walletAddress(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'crypto.mlmstore.co/Api/Apikey/generate_wallet_address',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array('api_key' => '209b17ca2ede3a097f19f59324acbb76','blockchain_id' => '1'),
          CURLOPT_HTTPHEADER => array(
            'Cookie: PHPSESSID=bq4i7lnk91157evfrougbj81di'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
        // $curl = curl_init();

        //    curl_setopt_array($curl, array(
        //      CURLOPT_URL => 'http://18.216.195.54:3490/get_bep20_address',
        //      CURLOPT_RETURNTRANSFER => true,
        //      CURLOPT_ENCODING => '',
        //      CURLOPT_MAXREDIRS => 10,
        //      CURLOPT_TIMEOUT => 0,
        //      CURLOPT_FOLLOWLOCATION => true,
        //      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //      CURLOPT_CUSTOMREQUEST => 'GET',
        //    ));

        //    $response = curl_exec($curl);

        //    curl_close($curl);
        //    return $response;
        // //    echo $response;
           

   }

    public function countryCode($name) {
        $name1 = str_replace("%20"," ",$name);
        $countries = $this->User_model->get_single_record('countries', array('name' =>$name1), 'phonecode');
        echo json_encode($countries);
    }

    private function getUserIdForRegister() {
        $user_id = 'RVC'.rand(100000,999999);
        $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id,name');
        if (!empty($sponser)) {
            return $this->getUserIdForRegister();
        } else {
            return $user_id;
        }
    }

    private function add_counts($user_name, $downline_id, $level) {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
        if (!empty($user)) {
            if ($user['position'] == 'L') {
                $count = array('left_count' => ' left_count + 1');
                $c = 'left_count';
            } else if ($user['position'] == 'R') {
                $c = 'right_count';
                $count = array('right_count' => ' right_count + 1');
            } else {
                return;
            }
            $this->User_model->update_count($c, $user['upline_id']);
            $downlineArray = array(
                'user_id' => $user['upline_id'],
                'downline_id' => $downline_id,
                'position' => $user['position'],
                'created_at' => date('Y-m-d h:i:s'),
                'level' => $level,
            );
            $this->User_model->add('tbl_downline_count', $downlineArray);
            $user_name = $user['upline_id'];

            if ($user['upline_id'] != '') {
                $this->add_counts($user_name, $downline_id, $level + 1);
            }
        }
    }

    private function add_sponser_counts($user_name, $downline_id , $level) {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'sponser_id,user_id');
        if ($user['sponser_id'] != '') {
                $downlineArray = array(
                    'user_id' => $user['sponser_id'],
                    'downline_id' => $downline_id,
                    'position' => '',
                    'level' => $level,
                );
                $this->User_model->add('tbl_sponser_count', $downlineArray);
                $user_name = $user['sponser_id'];
                $this->add_sponser_counts($user_name, $downline_id, $level + 1);
        }
    }

    public function registerAjax()
    {
        secure_request();
        $response['success'] = 0;
        if($this->input->is_ajax_request()){
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('sponser_id', 'Sponser ID', 'trim|required', ['required' => 'Sponser id Field is required!']);
                $this->form_validation->set_rules('eth_address', 'Wallet Address', 'trim|required', ['required' => 'Wallet Address Field is required!']);
                if($this->form_validation->run() != false){
                    $sponser_id = trim(addslashes($data['sponser_id']));
                    $eth_address = trim(addslashes($data['eth_address']));
                    $user_id = $this->getUserIdForRegister();
                    $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), '*');
                    $wallet_check = $this->User_model->get_single_record('tbl_users', array('eth_address' => $eth_address), '*');
                    $package = $this->User_model->get_single_record('tbl_package',['id' => 1],'*');
                    if(!empty($eth_address)){
                        if(!empty($sponser_id)){
                            if(!empty($sponser)){
                                if(!empty($user_id)){
                                    if(empty($wallet_check)){
                                        $res = $this->User_model->add('tbl_users',[
                                            'user_id' => $user_id,
                                            'eth_address' => $eth_address,
                                            'sponser_id' => $sponser_id,
                                            'password' => rand(1000000, 9999999),
                                            'master_key' => rand(1000000, 9999999),
                                        ]);
            
                                        $res = $this->User_model->add('tbl_bank_details',[
                                            'user_id' => $user_id,
                                        ]);

                                        $this->add_sponser_counts($user_id,$user_id, $level = 1);

                                        // $tokenValue = $this->User_model->get_single_record('tbl_token_value',['id' => 1],'amount');

                                        // $self_coin = [
                                        //     'user_id' => $user_id,
                                        //     'amount' => $package['self_coin']/$tokenValue['amount'],
                                        //     'type' => 'self_coin',
                                        //     'description' => 'Self Coin',
                                        // ];
                                        // $this->User_model->add('tbl_coin_wallet',$self_coin);

                                        // $this->self_level_income($sponser['user_id'], $user_id, $package['self_level_coin'],$tokenValue['amount']);

                                        if($res){
                                            $this->session->set_userdata('user_id', $user_id);
                                            $this->session->set_userdata('role', 'U');
                                            $response['success'] = 1;
                                            $response['message'] = 'Wallet Register/Connected Successfully!';
                                            $response['url  '] = base_url('Dashboard/User/');
                                        }else{
                                            $response['message'] = 'Error while Connecting Wallet!';
                                        }

                                    }else{
                                        $response['message'] = 'Wallet address is already registred with us!';
                                    }
                                }else{
                                    $response['message'] = 'Something went wrong, please try again later!';
                                }
                            }else{
                                $response['message'] = 'Invaild Sponser Id!';
                            }
                        }else{
                            $response['message'] = 'Sponser id Field is required!';
                        }
                    }else{
                        $response['message'] = 'Wallet Address Field is required!';
                    }
                }else{
                    $response['message'] = validation_errors();
                }
            }else{
                $response['message'] = 'Invaild Method trying!';
            }
        }else{
            $response['message'] = 'Do not hit with direct script!';
        }

        $response['token'] = $this->security->get_csrf_hash();
        echo json_encode($response);
        exit();
    }

    public function sponserActive($csrf, $eth_address)
    {
        $response['success'] = 0;
        if($this->input->is_ajax_request()){
            if(!empty($csrf)){
                if($csrf == $this->security->get_csrf_hash()){
                    $eth_address = trim(addslashes($eth_address));
                    $user = $this->User_model->get_single_record('tbl_users', ['user_id' =>  $eth_address], '*');
                    if(!empty($user)){
                        $response['success'] = 1;
                    }else{
                        $response['message'] = 'Invaild Sponser Id!';

                    }
                }else{
                    $response['message'] = 'Invaild Token';
                }
            }else{
                $response['message'] = 'Invaild Token';
            }
        }else{
            $response['message'] = 'Do not hit with direct script!';
        }
        echo json_encode($response);
        exit();
    }

    public function userActive($csrf, $eth_address)
    {
        $response['success'] = 0;
        if($this->input->is_ajax_request()){
            if(!empty($csrf)){
                if($csrf == $this->security->get_csrf_hash()){
                    $eth_address = trim(addslashes($eth_address));
                    $user = $this->User_model->get_single_record('tbl_users', ['eth_address' =>  $eth_address], '*');
                    if(empty($user)){
                       
                        $response['message'] = 'Wallet Address not Registered with us!';
                    }else{
                        $response['message'] = 'Login Successfully!';
                        $response['success'] = 1;
                        $this->session->set_userdata('user_id', $user['user_id']);
                        $this->session->set_userdata('role', 'U');
                    }
                }else{
                    $response['message'] = 'Invaild Token';
                }
            }else{
                $response['message'] = 'Invaild Token';
            }
        }else{
            $response['message'] = 'Do not hit with direct script!';
        }
        echo json_encode($response);
        exit();
    }

    // public function emaild(){
    //     $response['message'] = 'Hi,tsty We are so happy to have you on board! Together with Ricaverse Community, and the Ricaverse Global platform, Ricaverse Group strives to disrupt entire industries by pioneering the world`s most comprehensive digital finance ecosystem and transform the world economy. Are you ready to be inspired? Ricaverse Global Team This is an automated message. Please do not reply. © 2023 - 2024 All Rights Reserved.';
    //                                         send_crypto_email('manishgni20@gmail.com','Registration',$response['message'],$display=false);

    // }
}
