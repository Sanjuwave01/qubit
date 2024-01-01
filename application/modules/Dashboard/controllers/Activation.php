<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Activation extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user'));
        date_default_timezone_set('Asia/Kolkata');
        $this->exceptionCase = '';
        if (is_logged_in() === false) {
            redirect('Dashboard/User/logout');
            exit;
        }
    }

  
  
   public function index()
    {

        // die('under matainace!');
       if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['tokenValue'] = $this->User_model->get_single_record('tbl_token_value', ['id' => 1], 'amount');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                // echo"pre";
                // print_r($data);
                // exit();
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');
                //$this->form_validation->set_rules('package_id', 'Package', 'trim|required|numeric');
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
                $this->form_validation->set_rules('days', 'Months', 'trim|required|numeric');
                if ($this->form_validation->run() != FALSE) {
                    if (!in_array($data['days'], [18, 36,20])) {
                        redirect('Dashboard/User/logout');
                        exit;
                    }
                    $user_id = $data['user_id'];
                    //$package_id = $data['package_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');

                    // echo "<pre>";
                    // print_r($userRank['creditDate']);
                    // die;
                    //$sponserInfo = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'package_amount');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    //$package = $this->User_model->get_single_record('tbl_package', array('id' => $package_id), '*');
                    $activationAmount = $data['amount'];
                    if (!empty($user)) {

                        // $conditionArr = $this->conditionArr($data['amount'],$data['days']);
                        // if($conditionArr['status'] == true){
                       if ($data['days'] == 20 && $activationAmount < 500) {
                    $this->session->set_flashdata('message', '<h3 class="text-danger">Minimum Activate Amount $500 and Multiple of 500 is allowed!</h3>');
                  } elseif ($activationAmount >= 100 || $activationAmount % 100 == 0) {
                            if ($user['paid_status'] == 0) {
                                $debitAmount = $activationAmount + 25;
                            } else {
                                $debitAmount = $activationAmount;
                            }
                            if ($wallet['wallet_balance'] >= $debitAmount) {
                               

                                if ($user['paid_status'] >= 0) {
                                    $percenatgeamount =  $debitAmount*$data['perce']/100;
                                     // max 50% deduct from offset wallet
                                     $percentage = 0;
                                     if($data['perce']){
                                        $percentage = $percentage + $debitAmount*$data['perce']/100;
                                     }
                                     if($user['offset_wallet_per'] >= $percentage ){
                                        $balnceper = $debitAmount - $percentage;
                                        $sendWallet = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => -$balnceper,
                                            'type' => 'account_activation',
                                            'remark' => 'Max 50% Amount deduct from offset Wallet for Account Activation' . $user_id,
                                        );
                                   
                                        $this->User_model->add('tbl_wallet', $sendWallet);
                                        $Userdata['offset_wallet_per'] = $wallet['offset_wallet_per'] - $percentage;
                                       

                                      $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), $Userdata);

                                     }else{
                                        $sendWallet = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => -$debitAmount,
                                            'type' => 'account_activation',
                                            'remark' => 'Account Activation Deduction for ' . $user_id,
                                        );
   
                                        $this->User_model->add('tbl_wallet', $sendWallet);
                                     }
                                     
                                    if ($user['days'] == 36) {
                                        $days = 36;
                                    } else {
                                        $days = $data['days'];
                                    }


                                    $topupData = array(
                                        'paid_status' => 1,
                                        'package_id' => 1, //$package['id'],
                                        'package_amount' => $activationAmount,
                                        'total_package' => $user['total_package'] + $activationAmount,
                                        'topup_date' => date('Y-m-d H:i:s'),
                                        'capping' => $activationAmount,
                                        // 'incomeLimit2' => $user['incomeLimit2'] + ($activationAmount * 3),
                                        'days' => $days,
                                    );

                                    if($data['days'] == 20){
                                        $topupData['incomeLimit2'] = $user['incomeLimit2']+($activationAmount*3);
                                    }else{
                                        $topupData['incomeLimit2'] = $user['incomeLimit2']+($activationAmount*3);

                                    }
                                    $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);

                                    $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), '*');
                                    $userRank = $this->User_model->get_single_record('tbl_roi', "user_id = '" . $user['sponser_id'] . "' ORDER BY id desc limit 1", '*');

                                    $sponserUser = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $user['sponser_id']), '*');

                                    $usersLevel = $this->User_model->get_records('tbl_users', array('sponser_id' => $user['sponser_id']), 'user_id');
                                    $userIdList = array_column($usersLevel, 'user_id');
                                    $userIds = "'" . implode("', '", $userIdList) . "'";
                                    $packageAmount = $userRank['package'];

                                    $userCountQuery = $this->db->query("SELECT user_id FROM tbl_roi WHERE user_id IN ($userIds) AND package >= '$packageAmount' GROUP BY user_id ");


                                    // echo "<pre>";
                                    // echo $userCountQuery->num_rows();
                                    // die;

                                    // implode(" ",$arr)
                                    //  $this->db->select('*');
                                    // $this->db->from('tbl_roi');
                                    // $this->db->where_in('user_id', $userIdList);
                                    // return $this->db->get();




                                    if ($user['paid_status'] == 0) {
                                        $this->User_model->update_directs($user['sponser_id']);
                                    }

                                    $now = time(); // or your date as well
                                    $your_date = strtotime($userRank['created_at']);
                                    $datediff = $now - $your_date;
                                    $days = round($datediff / (60 * 60 * 24));



                                    if ($userRank['package'] >= 1000 && $days <= 28 && $userCountQuery->num_rows() >= 10) {
                                        $percent = 0.15;
                                    } elseif ($user['rank'] > 3) {
                                        $days = $data['days'];
                                        $percent = 0.0033;
                                        $directPercent = 0.1;
                                    } else {
                                        if ($data['days'] == 18) {
                                            $percent = 0.002;
                                            $days = $data['days'];
                                            $directPercent = 0.05;
                                        } elseif ($data['days'] == 36) {
                                            $days = $data['days'];
                                            $percent = 0.0026;
                                            $directPercent = 0.07;
                                        }elseif($data['days'] == 20){
                                            $days = $data['days'];
                                            $percent = 0.0033;
                                            $directPercent = 0.05;
                                        }
                                    }


                                    $roiArr = array(
                                        'user_id' => $user['user_id'],
                                        'amount' => $activationAmount * $percent,
                                        'roi_amount' => $activationAmount * $percent,
                                        'days' => $days * 30 - 30,
                                        'total_days' => $days * 30 - 30,
                                        'package' => $activationAmount,
                                        'coin' => $activationAmount / $data['rvc_price'],
                                        'token_price' => $data['rvc_price'],
                                        'type' => 'roi_income',
                                        'creditDate' => date('Y-m-d'),
                                    );

                                    if($data['days'] == 20){
                                        $this->User_model->add('tbl_roi_20', $roiArr);
                                    }else{
                                        $this->User_model->add('tbl_roi', $roiArr);
                                    }

                                    // $creditCoin = [
                                    //     'user_id' => $user['user_id'],
                                    //     'amount' => $activationAmount/$response['tokenValue']['amount'],
                                    //     'type' => 'coin_income',
                                    //     'description' => 'Coin Income',
                                    // ];
                                    // $this->User_model->add('tbl_coin_wallet',$creditCoin);



                                    if ($sponser['paid_status'] == 1) {

                                        if ($sponser['days'] == 18) {
                                            $directPercent = 0.05;
                                        }
                                        if ($sponser['days'] == 36) {
                                            $directPercent =  0.07;  //0.07;
                                        }
                                        if ($sponser['rank'] > 3) {
                                            $directPercent = 0.1;
                                        }

                                        if ($userRank['created_at'] != NULL && $sponser['rank'] >= 2) {

                                            $now = time(); // or your date as well
                                            $your_date = strtotime($userRank['created_at']);
                                            $datediff = $now - $your_date;
                                            $days = round($datediff / (60 * 60 * 24));

                                            //echo "<pre>";
                                            // print_r($days);
                                            //die;

                                            if ($days <= 28) {
                                                $directPercent = 0.1;
                                            }
                                        }


                                        if ($sponser['incomeLimit2'] > $sponser['incomeLimit']) {
                                            $totalCredit = $sponser['incomeLimit'] + ($activationAmount * $directPercent);
                                            if ($totalCredit < $sponser['incomeLimit2']) {
                                                $direct_income = $activationAmount * $directPercent;
                                            } else {
                                                $direct_income = $sponser['incomeLimit2'] - $sponser['incomeLimit'];
                                            }

                                            $DirectIncome = array(
                                                'user_id' => $user['sponser_id'],
                                                'amount' => $direct_income,
                                                'type' => 'direct_income',
                                                'description' => 'Direct Income from Activation of Member ($' . $activationAmount . ')' . $user_id,
                                            );
                                            $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                            $this->User_model->update('tbl_users', ['user_id' => $user['sponser_id']], ['incomeLimit' => ($sponser['incomeLimit'] + $DirectIncome['amount'])]);
                                        }
                                    }
                                    $this->db->query("UPDATE tbl_users SET direct_business = direct_business + '$activationAmount' WHERE user_id = '" . $sponser['user_id'] . "'");
                                    $this->updateBusiness($sponser['user_id'], 'team_business', $activationAmount);
                                    $this->ThirdBooster($sponser['user_id']);
                                    $message = 'Hello ' . $user['name'] . ', This is a notice to confirm that you have successfully purchased a $' . $activationAmount . ' Ricaverse Membership. If you did not perform this action, please contact our support team immediately. Ricaverse Team, This is an automated message. Please do not reply.';
                                    send_crypto_email($user['email'], 'Activation Alert', $message);
                                    $message = 'Dear User your account is successfully activated with amount ' . $activationAmount . ' by User ' . $this->session->userdata['user_id'];
                                    $this->session->set_flashdata('message', '<h3 class="text-danger">Account Activated Successfully </h3>');
                                } else {
                                    $this->session->set_flashdata('message', '<h3 class = "text-danger">This Account Already Acitvated </h3>');
                                }
                            } else {
                                $this->session->set_flashdata('message', '<h3 class = "text-danger">Insuffcient Balance </h3>');
                            }
                            // } else {
                            //     $this->session->set_flashdata('message', '<h3 class = "text-danger">'.$conditionArr['message'].'</h3>');
                            // }
                        } else {
                            $this->session->set_flashdata('message', '<h3 class = "text-danger">Minimum Activate Amount $100 and Multiple of 100 is allowed!</h3>');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<h3 class = "text-danger">Invalid User ID </h3>');
                    }
                }
            }
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            $response['packages'] = $this->User_model->get_records('tbl_package', array(), '*');
            $this->load->view('activate_account', $response);
        } else {
            redirect('Dashboard/User/login');
        }

    }

    public function indexCopy()
    {

        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['tokenValue'] = $this->User_model->get_single_record('tbl_token_value', ['id' => 1], 'amount');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');
                //$this->form_validation->set_rules('package_id', 'Package', 'trim|required|numeric');
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
                $this->form_validation->set_rules('days', 'Months', 'trim|required|numeric');
                if ($this->form_validation->run() != FALSE) {
                    if (!in_array($data['days'], [18, 36])) {
                        redirect('Dashboard/User/logout');
                        exit;
                    }
                    $user_id = $data['user_id'];
                    //$package_id = $data['package_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');

                    // echo "<pre>";
                    // print_r($userRank['creditDate']);
                    // die;
                    //$sponserInfo = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'package_amount');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    //$package = $this->User_model->get_single_record('tbl_package', array('id' => $package_id), '*');
                    $activationAmount = $data['amount'];
                    if (!empty($user)) {

                        // $conditionArr = $this->conditionArr($data['amount'],$data['days']);
                        // if($conditionArr['status'] == true){
                        if ($activationAmount >= 100 || $activationAmount % 100 == 0) {
                            if ($user['paid_status'] == 0) {
                                $debitAmount = $activationAmount + 25;
                            } else {
                                $debitAmount = $activationAmount;
                            }
                            if ($wallet['wallet_balance'] >= $debitAmount) {
                                if ($user['paid_status'] >= 0) {
                                    $sendWallet = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => -$debitAmount,
                                        'type' => 'account_activation',
                                        'remark' => 'Account Activation Deduction for ' . $user_id,
                                    );
                                    $this->User_model->add('tbl_wallet', $sendWallet);
                                    if ($user['days'] == 36) {
                                        $days = 36;
                                    } else {
                                        $days = $data['days'];
                                    }
                                    $topupData = array(
                                        'paid_status' => 1,
                                        'package_id' => 1, //$package['id'],
                                        'package_amount' => $activationAmount,
                                        'total_package' => $user['total_package'] + $activationAmount,
                                        'topup_date' => date('Y-m-d H:i:s'),
                                        'capping' => $activationAmount,
                                        'incomeLimit2' => $user['incomeLimit2'] + ($activationAmount * 3),
                                        'days' => $days,
                                    );
                                    $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);

                                    $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), '*');

                                    $userRank = $this->User_model->get_single_record('tbl_roi', "user_id = '" . $user['sponser_id'] . "' ORDER BY id desc limit 1", '*');

                                    $sponserUser = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $user['sponser_id']), '*');

                                    $usersLevel = $this->User_model->get_records('tbl_users', array('sponser_id' => $user['sponser_id']), 'user_id');
                                    $userIdList = array_column($usersLevel, 'user_id');
                                    $userIds = "'" . implode("', '", $userIdList) . "'";
                                    $packageAmount = $userRank['package'];

                                    $userCountQuery = $this->db->query("SELECT user_id FROM tbl_roi WHERE user_id IN ($userIds) AND package >= '$packageAmount' GROUP BY user_id ");


                                    // echo "<pre>";
                                    // echo $userCountQuery->num_rows();
                                    // die;

                                    // implode(" ",$arr)
                                    //  $this->db->select('*');
                                    // $this->db->from('tbl_roi');
                                    // $this->db->where_in('user_id', $userIdList);
                                    // return $this->db->get();

                                    //  echo $userCountQuery->num_rows();
                                    //  echo "<pre>";
                                    // print_r($this->db->get());
                                    //  die;


                                    // if($user['paid_status'] == 0) {
                                    //     $this->User_model->update_directs($user['sponser_id']);
                                    // } 


                                    // echo $userCountQuery->num_rows();
                                    // echo "<pre>";
                                    // print_r($days);
                                    // echo "<pre>";
                                    // print_r($userRank['package']);
                                    // die;

                                    $now = time(); // or your date as well
                                    $your_date = strtotime($userRank['created_at']);
                                    $datediff = $now - $your_date;
                                    $days = round($datediff / (60 * 60 * 24));

                                    if ($userRank['package'] >= 1000 && $days <= 36 && $userCountQuery->num_rows() >= 10) {
                                        $percent = 0.005;
                                    } elseif ($sponser['rank'] >= 4) {

                                        $days = $data['days'];
                                        $percent = 0.0033;
                                        $directPercent = 0.1;
                                    } else {
                                        if ($data['days'] == 18) {
                                            $percent = 0.002;
                                            $days = $data['days'];
                                            $directPercent = 0.05;
                                        } elseif ($data['days'] == 36) {
                                            $days = $data['days'];
                                            $percent = 0.0026;
                                            $directPercent = 0.07;
                                        }
                                    }


                                    // echo $percent;
                                    // echo "first";
                                    // echo $directPercent;
                                    // echo "second";
                                    // echo $activationAmount*$percent;
                                    // die;


                                    $roiArr = array(
                                        'user_id' => $user['user_id'],
                                        'amount' => $activationAmount * $percent,
                                        'roi_amount' => $activationAmount * $percent,
                                        'days' => $days * 30 - 30,
                                        'total_days' => $days * 30 - 30,
                                        'package' => $activationAmount,
                                        'coin' => $activationAmount / $response['tokenValue']['amount'],
                                        'token_price' => $response['tokenValue']['amount'],
                                        'type' => 'roi_income',
                                        'creditDate' => date('Y-m-d'),
                                    );

                                    echo "<pre>";
                                    print_r($roiArr);
                                    die;

                                    $this->User_model->add('tbl_roi', $roiArr);

                                    // $creditCoin = [
                                    //     'user_id' => $user['user_id'],
                                    //     'amount' => $activationAmount/$response['tokenValue']['amount'],
                                    //     'type' => 'coin_income',
                                    //     'description' => 'Coin Income', 
                                    // ];
                                    // $this->User_model->add('tbl_coin_wallet',$creditCoin);



                                    if ($sponser['paid_status'] == 1) {

                                        if ($sponser['days'] == 18) {
                                            $directPercent = 0.05;
                                        }
                                        if ($sponser['days'] == 36) {
                                            $directPercent =  0.07;  //0.07; 
                                        }
                                        if ($sponser['rank'] >= 4) {
                                            $directPercent = 0.1;
                                        }

                                        if ($userRank['created_at'] != NULL && $sponser['rank'] >= 2) {

                                            $now = time(); // or your date as well
                                            $your_date = strtotime($userRank['created_at']);
                                            $datediff = $now - $your_date;
                                            $days = round($datediff / (60 * 60 * 24));

                                            //echo "<pre>";
                                            // print_r($days);
                                            //die;

                                            if ($days <= 28) {
                                                $directPercent = 0.1;
                                            }
                                        }


                                        if ($sponser['incomeLimit2'] > $sponser['incomeLimit']) {
                                            $totalCredit = $sponser['incomeLimit'] + ($activationAmount * $directPercent);
                                            if ($totalCredit < $sponser['incomeLimit2']) {
                                                $direct_income = $activationAmount * $directPercent;
                                            } else {
                                                $direct_income = $sponser['incomeLimit2'] - $sponser['incomeLimit'];
                                            }

                                            $DirectIncome = array(
                                                'user_id' => $user['sponser_id'],
                                                'amount' => $direct_income,
                                                'type' => 'direct_income',
                                                'description' => 'Direct Income from Activation of Member ($' . $activationAmount . ')' . $user_id,
                                            );
                                            $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                            $this->User_model->update('tbl_users', ['user_id' => $user['sponser_id']], ['incomeLimit' => ($sponser['incomeLimit'] + $DirectIncome['amount'])]);
                                        }
                                    }
                                    $this->db->query("UPDATE tbl_users SET direct_business = direct_business + '$activationAmount' WHERE user_id = '" . $sponser['user_id'] . "'");
                                    $this->updateBusiness($sponser['user_id'], 'team_business', $activationAmount);
                                    //$this->royaltyAchiever($user['sponser_id']);
                                    // $LevelIncome = '0.02,0.01,0.01,0.005,0.005,0.005,0.003,0.003,0.002';
                                    // $this->level_income($sponser['sponser_id'], $user['user_id'], $LevelIncome,$activationAmount);
                                    //$this->update_business($user['user_id'], $user['user_id'], $level = 1,$data['amount'] ,$data['amount'], $type = 'topup');
                                    //if($sponser['directs'] >= 3){
                                    // $checkPool = $this->User_model->get_single_record($package['products'],['user_id' => $user['user_id']],'*');
                                    // if(empty($checkPool['user_id'])){
                                    //$this->individualPoolEntry($user['user_id'],'tbl_pool1');
                                    //$this->globlePoolEntry($user['user_id'],'tbl_pool');
                                    // $debit = [
                                    //     'user_id' => $user['sponser_id'],
                                    //     'amount' => -10,
                                    //     'type' => 'club_upgradation',
                                    //     'description' => 'Club Upgrdation Deduction',
                                    // ];
                                    // $this->User_model->add('tbl_income_wallet',$debit);
                                    //}
                                    //}

                                    $this->ThirdBooster($sponser['user_id']);
                                    $message = 'Hello ' . $user['name'] . ', This is a notice to confirm that you have successfully purchased a $' . $activationAmount . ' Ricaverse Membership. If you did not perform this action, please contact our support team immediately. Ricaverse Team, This is an automated message. Please do not reply.';
                                    send_crypto_email($user['email'], 'Activation Alert', $message);
                                    $message = 'Dear User your account is successfully activated with amount ' . $activationAmount . ' by User ' . $this->session->userdata['user_id'];
                                    $this->session->set_flashdata('message', '<h3 class="text-success">Account Activated Successfully </h3>');
                                } else {
                                    $this->session->set_flashdata('message', '<h3 class = "text-danger">This Account Already Acitvated </h3>');
                                }
                            } else {
                                $this->session->set_flashdata('message', '<h3 class = "text-danger">Insuffcient Balance </h3>');
                            }
                            // } else {
                            //     $this->session->set_flashdata('message', '<h3 class = "text-danger">'.$conditionArr['message'].'</h3>');
                            // }
                        } else {
                            $this->session->set_flashdata('message', '<h3 class = "text-danger">Minimum Activate Amount $100 and Multiple of 100 is allowed!</h3>');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<h3 class = "text-danger">Invalid User ID </h3>');
                    }
                }
            }
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            $response['packages'] = $this->User_model->get_records('tbl_package', array(), '*');
            $this->load->view('activate_account', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    private function ThirdBooster($user_id)
    {

        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
            $response['users'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $user_id), '*');

            $response['users'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $user_id), '*');

            // nine condition end here
            $response['third_booster_daily_incomes'] = $this->User_model->get_single_record('third_booster_daily_incomes', array('user_id' => $user_id), '*');

            // echo "<pre>";
            // print_r($response['users']);
            // die;

            $userBusiness1 = 1000;
            $userBusiness2 = 2000;
            $userBusiness3 = 6000;
            $userBusiness4 = 14000;
            $userBusiness5 = 32000;
            $userBusiness6 = 60000;
            $userBusiness7 = 120000;
            $userBusiness8 = 240000;
            $userBusiness9 = 400000;
            $userBusiness10 = 800000;


            $teemBusiness1 = 500;
            $teemBusiness2 = 1000;
            $teemBusiness3 = 3000;
            $teemBusiness4 = 7000;
            $teemBusiness5 = 16000;
            $teemBusiness6 = 30000;
            $teemBusiness7 = 60000;
            $teemBusiness8 = 120000;
            $teemBusiness9 = 200000;
            $teemBusiness10 = 400000;


            $date1 = date('Y-m-d', strtotime(date('Y-m-d') . ' + 14 days'));
            $date2 = date('Y-m-d', strtotime(date('Y-m-d') . ' + 30 days'));
            $date3 = date('Y-m-d', strtotime(date('Y-m-d') . ' + 60 days'));
            $date4 = date('Y-m-d', strtotime(date('Y-m-d') . ' + 90 days'));
            $date5 = date('Y-m-d', strtotime(date('Y-m-d') . ' + 150 days'));
            $date6 = date('Y-m-d', strtotime(date('Y-m-d') . ' + 240 days'));
            $date7 = date('Y-m-d', strtotime(date('Y-m-d') . ' + 330 days'));
            $date8 = date('Y-m-d', strtotime(date('Y-m-d') . ' + 450 days'));
            $date9 = date('Y-m-d', strtotime(date('Y-m-d') . ' + 600 days'));
            $date10 = date('Y-m-d', strtotime(date('Y-m-d') . ' + 880 days'));


            $userCountQuery = $this->db->query("SELECT user_id FROM tbl_users WHERE sponser_id = '$user_id'");
            $directUserCont = $userCountQuery->num_rows();
            $userIdList = array_column($response['users'], 'user_id');
            $userIds = "'" . implode("', '", $userIdList) . "'";

            // 3 user direct +


            // first condition start here //
            $userCountQuery1 = $this->db->query("SELECT user_id FROM tbl_users WHERE user_id IN ($userIds) AND total_package >= '$userBusiness1' AND DATE(topup_date) <=  '$date1' GROUP BY user_id ");
            $userIdOfTotalPackage1 = $userCountQuery1->result_array();
            $numOfUserCount1 = $userCountQuery1->num_rows();

            $userIdListOfPackage1 = array_column($userIdOfTotalPackage1, 'user_id');
            $teemABuserIds1 = "'" . implode("', '", $userIdListOfPackage1) . "'";

            // 2 user bussiness maximum
            $totalUserPackageCountQuery1 = $this->db->query("SELECT sum(total_package) as total_package FROM tbl_users WHERE sponser_id = '$user_id' AND DATE(topup_date) <=  '$date1' AND user_id IN ($userIds) AND user_id NOT IN ($teemABuserIds1)");

            $teemCBusiness1 = $totalUserPackageCountQuery1->row();


            // first condition end here

            // echo $directUserCont;
            // echo 'first';
            // echo $numOfUserCount1;
            // echo 'second';
            // echo $directUserCont;
            // echo 'third';
            // echo "<pre>";
            // print_r($teemCBusiness1);

            // die;


            // second condition start here //
            $userCountQuery2 = $this->db->query("SELECT user_id FROM tbl_users WHERE user_id IN ($userIds) AND total_package >= '$userBusiness2' AND DATE(topup_date) <=  '$date2' GROUP BY user_id ");
            $userIdOfTotalPackage2 = $userCountQuery2->result_array();
            $numOfUserCount2 = $userCountQuery2->num_rows();

            $userIdListOfPackage2 = array_column($userIdOfTotalPackage2, 'user_id');
            $teemABuserIds2 = "'" . implode("', '", $userIdListOfPackage2) . "'";

            // 2 user bussiness maximum
            $totalUserPackageCountQuery2 = $this->db->query("SELECT sum(total_package) as total_package FROM tbl_users WHERE sponser_id = '$user_id' AND DATE(topup_date) <=  '$date2' AND  user_id IN ($userIds) AND user_id NOT IN ($teemABuserIds2)");

            $teemCBusiness2 = $totalUserPackageCountQuery2->row();

            //  second condition end here

            //  third start here //
            $userCountQuery3 = $this->db->query("SELECT user_id FROM tbl_users WHERE user_id IN ($userIds) AND total_package >= '$userBusiness3' AND DATE(topup_date) <=  '$date3' GROUP BY user_id ");
            $userIdOfTotalPackage3 = $userCountQuery3->result_array();
            $numOfUserCount3 = $userCountQuery3->num_rows();

            $userIdListOfPackage3 = array_column($userIdOfTotalPackage3, 'user_id');
            $teemABuserIds3 = "'" . implode("', '", $userIdListOfPackage3) . "'";

            // 2 user bussiness maximum
            $totalUserPackageCountQuery3 = $this->db->query("SELECT sum(total_package) as total_package FROM tbl_users WHERE sponser_id = '$user_id' AND DATE(topup_date) <=  '$date3' AND user_id IN ($userIds) AND user_id NOT IN ($teemABuserIds3)");

            $teemCBusiness3 = $totalUserPackageCountQuery3->row();

            // third condition end here

            //  four start here //
            $userCountQuery4 = $this->db->query("SELECT user_id FROM tbl_users WHERE user_id IN ($userIds) AND total_package >= '$userBusiness4' AND DATE(topup_date) <=  '$date4' GROUP BY user_id ");
            $userIdOfTotalPackage4 = $userCountQuery4->result_array();
            $numOfUserCount4 = $userCountQuery4->num_rows();

            $userIdListOfPackage4 = array_column($userIdOfTotalPackage4, 'user_id');
            $teemABuserIds4 = "'" . implode("', '", $userIdListOfPackage4) . "'";

            // 2 user bussiness maximum
            $totalUserPackageCountQuery4 = $this->db->query("SELECT sum(total_package) as total_package FROM tbl_users WHERE sponser_id = '$user_id' AND DATE(topup_date) <=  '$date4' AND user_id IN ($userIds) AND user_id NOT IN ($teemABuserIds4)");

            $teemCBusiness4 = $totalUserPackageCountQuery4->row();

            // four condition end here

            //  five start here //
            $userCountQuery5 = $this->db->query("SELECT user_id FROM tbl_users WHERE user_id IN ($userIds) AND total_package >= '$userBusiness4' AND DATE(topup_date) <=  '$date5' GROUP BY user_id ");
            $userIdOfTotalPackage5 = $userCountQuery5->result_array();
            $numOfUserCount5 = $userCountQuery5->num_rows();

            $userIdListOfPackage5 = array_column($userIdOfTotalPackage5, 'user_id');
            $teemABuserIds5 = "'" . implode("', '", $userIdListOfPackage5) . "'";

            // 2 user bussiness maximum
            $totalUserPackageCountQuery5 = $this->db->query("SELECT sum(total_package) as total_package FROM tbl_users WHERE sponser_id = '$user_id' AND DATE(topup_date) <=  '$date5' AND user_id IN ($userIds) AND user_id NOT IN ($teemABuserIds5)");

            $teemCBusiness5 = $totalUserPackageCountQuery5->row();

            // five condition end here

            //  six start here //
            $userCountQuery6 = $this->db->query("SELECT user_id FROM tbl_users WHERE user_id IN ($userIds) AND total_package >= '$userBusiness6' AND DATE(topup_date) <=  '$date6' GROUP BY user_id ");
            $userIdOfTotalPackage6 = $userCountQuery6->result_array();
            $numOfUserCount6 = $userCountQuery6->num_rows();

            $userIdListOfPackage6 = array_column($userIdOfTotalPackage6, 'user_id');
            $teemABuserIds6 = "'" . implode("', '", $userIdListOfPackage6) . "'";

            // 2 user bussiness maximum
            $totalUserPackageCountQuery6 = $this->db->query("SELECT sum(total_package) as total_package FROM tbl_users WHERE sponser_id = '$user_id' AND DATE(topup_date) <=  '$date6' AND user_id IN ($userIds) AND user_id NOT IN ($teemABuserIds6)");

            $teemCBusiness6 = $totalUserPackageCountQuery6->row();

            // six condition end here

            //  seven start here //
            $userCountQuery7 = $this->db->query("SELECT user_id FROM tbl_users WHERE user_id IN ($userIds) AND total_package >= '$userBusiness7' AND DATE(topup_date) <=  '$date7' GROUP BY user_id ");
            $userIdOfTotalPackage7 = $userCountQuery7->result_array();
            $numOfUserCount7 = $userCountQuery7->num_rows();

            $userIdListOfPackage7 = array_column($userIdOfTotalPackage7, 'user_id');
            $teemABuserIds7 = "'" . implode("', '", $userIdListOfPackage7) . "'";

            // 2 user bussiness maximum
            $totalUserPackageCountQuery7 = $this->db->query("SELECT sum(total_package) as total_package FROM tbl_users WHERE sponser_id = '$user_id' AND DATE(topup_date) <=  '$date7' AND user_id IN ($userIds) AND user_id NOT IN ($teemABuserIds7)");

            $teemCBusiness7 = $totalUserPackageCountQuery7->row();

            // seven condition end here


            //  eight start here //
            $userCountQuery8 = $this->db->query("SELECT user_id FROM tbl_users WHERE user_id IN ($userIds) AND total_package >= '$userBusiness8' AND DATE(topup_date) <=  '$date8' GROUP BY user_id ");
            $userIdOfTotalPackage8 = $userCountQuery8->result_array();
            $numOfUserCount8 = $userCountQuery8->num_rows();

            $userIdListOfPackage8 = array_column($userIdOfTotalPackage8, 'user_id');
            $teemABuserIds8 = "'" . implode("', '", $userIdListOfPackage8) . "'";

            // 2 user bussiness maximum
            $totalUserPackageCountQuery8 = $this->db->query("SELECT sum(total_package) as total_package FROM tbl_users WHERE sponser_id = '$user_id' AND DATE(topup_date) <=  '$date8' AND user_id IN ($userIds) AND user_id NOT IN ($teemABuserIds8)");

            $teemCBusiness8 = $totalUserPackageCountQuery8->row();

            // eight condition end here

            //  nine start here //
            $userCountQuery9 = $this->db->query("SELECT user_id FROM tbl_users WHERE user_id IN ($userIds) AND total_package >= '$userBusiness9' AND DATE(topup_date) <=  '$date9' GROUP BY user_id ");
            $userIdOfTotalPackage9 = $userCountQuery9->result_array();
            $numOfUserCount9 = $userCountQuery9->num_rows();

            $userIdListOfPackage9 = array_column($userIdOfTotalPackage9, 'user_id');
            $teemABuserIds9 = "'" . implode("', '", $userIdListOfPackage9) . "'";

            // 2 user bussiness maximum
            $totalUserPackageCountQuery9 = $this->db->query("SELECT sum(total_package) as total_package FROM tbl_users WHERE sponser_id = '$user_id' AND DATE(topup_date) <=  '$date9' AND user_id IN ($userIds) AND user_id NOT IN ($teemABuserIds9)");

            $teemCBusiness9 = $totalUserPackageCountQuery9->row();

            // nine condition end here

            //  nine start here //
            $userCountQuery10 = $this->db->query("SELECT user_id FROM tbl_users WHERE user_id IN ($userIds) AND total_package >= '$userBusiness10' AND DATE(topup_date) <=  '$date10' GROUP BY user_id ");
            $userIdOfTotalPackage10 = $userCountQuery10->result_array();
            $numOfUserCount10 = $userCountQuery10->num_rows();

            $userIdListOfPackage10 = array_column($userIdOfTotalPackage10, 'user_id');
            $teemABuserIds10 = "'" . implode("', '", $userIdListOfPackage10) . "'";

            // 2 user bussiness maximum
            $totalUserPackageCountQuery10 = $this->db->query("SELECT sum(total_package) as total_package FROM tbl_users WHERE sponser_id = '$user_id' AND DATE(topup_date) <=  '$date10' AND user_id IN ($userIds) AND user_id NOT IN ($teemABuserIds10)");

            $teemCBusiness10 = $totalUserPackageCountQuery10->row();


            //    echo $directUserCont;
            // echo 'first';
            // echo $numOfUserCount1;
            // echo 'second';
            // echo $teemBusiness1;
            // echo 'third';

            if ($directUserCont >= 3 && $numOfUserCount1 >= 2 && $teemCBusiness1->total_package >= $teemBusiness1) {

                $thirdBooster1 = array(
                    'user_id' => $user_id,
                    'amount' => 1,
                    'date' => date('Y-m-d'),
                    'total_days' => 100,
                    'balance_days' => '',
                    'last_date' => date('Y-m-d', strtotime(date('Y-m-d') . ' + 100 days')),
                    'created_at' => date('d-m-Y h:i:s'),
                    'updated_at' => date('d-m-Y h:i:s'),
                );

                if ($response['third_booster_daily_incomes']) {
                    $this->User_model->update('third_booster_daily_incomes', array('user_id' => $user_id), $thirdBooster1);
                } else {
                    $this->User_model->add('third_booster_daily_incomes', $thirdBooster1);
                }
            } else if ($directUserCont >= 3 && $numOfUserCount2 >= 2 && $teemCBusiness2->total_package >= $teemBusiness2) {

                $thirdBooster2 = array(
                    'user_id' => $user_id,
                    'amount' => 2,
                    'date' => date('Y-m-d'),
                    'total_days' => 100,
                    'balance_days' => '',
                    'last_date' => date('Y-m-d', strtotime(date('Y-m-d') . ' + 100 days')),
                    'created_at' => date('d-m-Y h:i:s'),
                    'updated_at' => date('d-m-Y h:i:s'),
                );

                if ($response['third_booster_daily_incomes']) {
                    $this->User_model->update('third_booster_daily_incomes', array('user_id' => $user_id), $thirdBooster2);
                } else {
                    $this->User_model->add('third_booster_daily_incomes', $thirdBooster2);
                }
            } else if ($directUserCont >= 3 && $numOfUserCount3 >= 2 && $teemCBusiness3->total_package >= $teemBusiness3) {

                $thirdBooster3 = array(
                    'user_id' => $user_id,
                    'amount' => 6,
                    'date' => date('Y-m-d'),
                    'total_days' => 100,
                    'balance_days' => '',
                    'last_date' => date('Y-m-d', strtotime(date('Y-m-d') . ' + 100 days')),
                    'created_at' => date('d-m-Y h:i:s'),
                    'updated_at' => date('d-m-Y h:i:s'),
                );
                if ($response['third_booster_daily_incomes']) {
                    $this->User_model->update('third_booster_daily_incomes', array('user_id' => $user_id), $thirdBooster3);
                } else {
                    $this->User_model->add('third_booster_daily_incomes', $thirdBooster3);
                }
            } else if ($directUserCont >= 3 && $numOfUserCount4 >= 2 && $teemCBusiness4->total_package >= $teemBusiness4) {

                $thirdBooster4 = array(
                    'user_id' => $user_id,
                    'amount' => 14,
                    'date' => date('Y-m-d'),
                    'total_days' => 100,
                    'balance_days' => '',
                    'last_date' => date('Y-m-d', strtotime(date('Y-m-d') . ' + 100 days')),
                    'created_at' => date('d-m-Y h:i:s'),
                    'updated_at' => date('d-m-Y h:i:s'),
                );
                if ($response['third_booster_daily_incomes']) {
                    $this->User_model->update('third_booster_daily_incomes', array('user_id' => $user_id), $thirdBooster4);
                } else {
                    $this->User_model->add('third_booster_daily_incomes', $thirdBooster4);
                }
            } else if ($directUserCont >= 3 && $numOfUserCount5 >= 2 && $teemCBusiness5->total_package >= $teemBusiness5) {

                $thirdBooster5 = array(
                    'user_id' => $user_id,
                    'amount' => 32,
                    'date' => date('Y-m-d'),
                    'total_days' => 100,
                    'balance_days' => '',
                    'last_date' => date('Y-m-d', strtotime(date('Y-m-d') . ' + 100 days')),
                    'created_at' => date('d-m-Y h:i:s'),
                    'updated_at' => date('d-m-Y h:i:s'),
                );
                if ($response['third_booster_daily_incomes']) {
                    $this->User_model->update('third_booster_daily_incomes', array('user_id' => $user_id), $thirdBooster5);
                } else {
                    $this->User_model->add('third_booster_daily_incomes', $thirdBooster5);
                }
            } else if ($directUserCont >= 3 && $numOfUserCount6 >= 2 && $teemCBusiness6->total_package >= $teemBusiness6) {

                $thirdBooster6 = array(
                    'user_id' => $user_id,
                    'amount' => 60,
                    'date' => date('Y-m-d'),
                    'total_days' => 100,
                    'balance_days' => '',
                    'last_date' => date('Y-m-d', strtotime(date('Y-m-d') . ' + 100 days')),
                    'created_at' => date('d-m-Y h:i:s'),
                    'updated_at' => date('d-m-Y h:i:s'),
                );
                if ($response['third_booster_daily_incomes']) {
                    $this->User_model->update('third_booster_daily_incomes', array('user_id' => $user_id), $thirdBooster6);
                } else {
                    $this->User_model->add('third_booster_daily_incomes', $thirdBooster6);
                }
            } else if ($directUserCont >= 3 && $numOfUserCount7 >= 2 && $teemCBusiness7->total_package >= $teemBusiness7) {

                $thirdBooster7 = array(
                    'user_id' => $user_id,
                    'amount' => 120,
                    'date' => date('Y-m-d'),
                    'total_days' => 100,
                    'balance_days' => '',
                    'last_date' => date('Y-m-d', strtotime(date('Y-m-d') . ' + 100 days')),
                    'created_at' => date('d-m-Y h:i:s'),
                    'updated_at' => date('d-m-Y h:i:s'),
                );
                if ($response['third_booster_daily_incomes']) {
                    $this->User_model->update('third_booster_daily_incomes', array('user_id' => $user_id), $thirdBooster7);
                } else {
                    $this->User_model->add('third_booster_daily_incomes', $thirdBooster7);
                }
            } else if ($directUserCont >= 3 && $numOfUserCount8 >= 2 && $teemCBusiness8->total_package >= $teemBusiness8) {

                $thirdBooster8 = array(
                    'user_id' => $user_id,
                    'amount' => 240,
                    'date' => date('Y-m-d'),
                    'total_days' => 100,
                    'balance_days' => '',
                    'last_date' => date('Y-m-d', strtotime(date('Y-m-d') . ' + 100 days')),
                    'created_at' => date('d-m-Y h:i:s'),
                    'updated_at' => date('d-m-Y h:i:s'),
                );
                if ($response['third_booster_daily_incomes']) {
                    $this->User_model->update('third_booster_daily_incomes', array('user_id' => $user_id), $thirdBooster8);
                } else {
                    $this->User_model->add('third_booster_daily_incomes', $thirdBooster8);
                }
            } else if ($directUserCont >= 3 && $numOfUserCount9 >= 2 && $teemCBusiness9->total_package >= $teemBusiness9) {

                $thirdBooster9 = array(
                    'user_id' => $user_id,
                    'amount' => 400,
                    'date' => date('Y-m-d'),
                    'total_days' => 100,
                    'balance_days' => '',
                    'last_date' => date('Y-m-d', strtotime(date('Y-m-d') . ' + 100 days')),
                    'created_at' => date('d-m-Y h:i:s'),
                    'updated_at' => date('d-m-Y h:i:s'),
                );
                if ($response['third_booster_daily_incomes']) {
                    $this->User_model->update('third_booster_daily_incomes', array('user_id' => $user_id), $thirdBooster9);
                } else {
                    $this->User_model->add('third_booster_daily_incomes', $thirdBooster9);
                }
            } else if ($directUserCont >= 3 && $numOfUserCount10 >= 2 && $teemCBusiness10->total_package >= $teemBusiness10) {

                $thirdBooster10 = array(
                    'user_id' => $user_id,
                    'amount' => 800,
                    'date' => date('Y-m-d'),
                    'total_days' => 100,
                    'balance_days' => '',
                    'last_date' => date('Y-m-d', strtotime(date('Y-m-d') . ' + 100 days')),
                    'created_at' => date('d-m-Y h:i:s'),
                    'updated_at' => date('d-m-Y h:i:s'),
                );
                if ($response['third_booster_daily_incomes']) {
                    $this->User_model->update('third_booster_daily_incomes', array('user_id' => $user_id), $thirdBooster10);
                } else {
                    $this->User_model->add('third_booster_daily_incomes', $thirdBooster10);
                }
            }
            return true;
        }
    }

    private function updateBusiness($user_id, $field, $business)
    {
        $userinfo = $this->User_model->get_single_record('tbl_users', ['user_id' => $user_id], 'user_id,sponser_id');
        if (!empty($userinfo['user_id']) && $userinfo['user_id'] != 'none') {
            $this->User_model->update_business($field, $userinfo['user_id'], $business);
            $this->updateBusiness($userinfo['sponser_id'], $field, $business);
        }
    }

    private function conditionArr($amount, $days)
    {
        if ($amount >= 1) {
            if ($amount >= 1 && $amount <= 500) {
                if ($days == 1) {
                    $roi = 1.4;
                } elseif ($days == 7) {
                    $roi = 1.50;
                } elseif ($days == 30) {
                    $roi = 1.75;
                } elseif ($days == 180) {
                    $roi = 2;
                }
            }
            if ($amount >= 501 && $amount <= 1000) {
                if ($days == 1) {
                    $roi = 1.47;
                } elseif ($days == 7) {
                    $roi = 1.58;
                } elseif ($days == 30) {
                    $roi = 1.84;
                } elseif ($days == 180) {
                    $roi = 2.10;
                }
            }
            if ($amount >= 1001 && $amount <= 2500) {
                if ($days == 1) {
                    $roi = 1.56;
                } elseif ($days == 7) {
                    $roi = 1.67;
                } elseif ($days == 30) {
                    $roi = 1.95;
                } elseif ($days == 180) {
                    $roi = 2.23;
                }
            }
            if ($amount >= 2501 && $amount <= 5000) {
                if ($days == 1) {
                    $roi = 1.67;
                } elseif ($days == 7) {
                    $roi = 1.79;
                } elseif ($days == 30) {
                    $roi = 2.08;
                } elseif ($days == 180) {
                    $roi = 2.38;
                }
            }
            if ($amount >= 5001 && $amount <= 10000) {
                if ($days == 1) {
                    $roi = 1.80;
                } elseif ($days == 7) {
                    $roi = 1.93;
                } elseif ($days == 30) {
                    $roi = 2.25;
                } elseif ($days == 180) {
                    $roi = 2.57;
                }
            }
            if ($amount >= 10001 && $amount <= 20000) {
                if ($days == 1) {
                    $roi = 1.96;
                } elseif ($days == 7) {
                    $roi = 2.10;
                } elseif ($days == 30) {
                    $roi = 2.45;
                } elseif ($days == 180) {
                    $roi = 2.80;
                }
            }
            if ($amount >= 20001) {
                if ($days == 1) {
                    $roi = 2.16;
                } elseif ($days == 7) {
                    $roi = 2.31;
                } elseif ($days == 30) {
                    $roi = 2.70;
                } elseif ($days == 180) {
                    $roi = 3.08;
                }
            }
            return $data = [
                'roi' => $amount * $roi / 100,
                'status' => true,
            ];
        } else {
            $data = [
                'message' => 'Minimum activation amount is 50',
                'status' => false
            ];
        }
        return $data;
    }

    private function royaltyAchiever($user_id = '')
    {
        if (is_logged_in()) {
            $userDetail = $this->User_model->get_single_record('tbl_users', ['user_id' => $user_id], 'directs,topup_date,royalty_status');
            $date1 = date('Y-m-d H:i:s');
            $date2 = date('Y-m-d H:i:s', strtotime($userDetail['topup_date'] . '+10 days'));
            $diff1 = strtotime($date2) - strtotime($date1);
            if ($diff1 > 0) {
                if ($userDetail['directs'] >= 15 && $userDetail['royalty_status'] == 0) {
                    $this->User_model->update('tbl_users', ['user_id' => $user_id], ['royalty_status' => 1]);
                }
            }
        }
    }

    private function level_income($sponser_id, $activated_id, $package_income, $package)
    {
        $incomes = explode(',', $package_income);
        for ($i = 1; $i <= 9; $i++) {
            if ($i == 1) {
                $incomeArr[$i] = ['amount' => $incomes[$i - 1], 'direct' => 0];
            } elseif ($i == 2) {
                $incomeArr[$i] = ['amount' => $incomes[$i - 1], 'direct' => 5];
            } elseif ($i >= 3 && $i <= 4) {
                $incomeArr[$i] = ['amount' => $incomes[$i - 1], 'direct' => 5];
            } elseif ($i == 5) {
                $incomeArr[$i] = ['amount' => $incomes[$i - 1], 'direct' => 5];
            } elseif ($i >= 6 && $i <= 9) {
                $incomeArr[$i] = ['amount' => $incomes[$i - 1], 'direct' => 5];
            }
        }
        foreach ($incomeArr as $key => $income) {
            $direct = $key + 1; //$directArr[$key];
            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'id,user_id,sponser_id,paid_status,incomeLimit2,incomeLimit,directs');
            if (!empty($sponser)) {
                if ($sponser['paid_status'] == 1) {
                    if ($sponser['directs'] >= $income['direct']) {
                        //     if($sponser['incomeLimit2'] > $sponser['incomeLimit']){
                        //         $totalCredit = $sponser['incomeLimit'] + ($income*$package);
                        //         if($totalCredit < $sponser['incomeLimit2']){
                        $level_income = $income['amount'] * $package;
                        // } else {
                        //     $level_income = $sponser['incomeLimit2'] - $sponser['incomeLimit'];
                        // }
                        $LevelIncome = array(
                            'user_id' => $sponser['user_id'],
                            'amount' => $level_income,
                            'type' => 'level_income',
                            'description' => 'Level Income from Activation of Member ($' . $package . ')' . $activated_id . ' At level ' . ($key + 1),
                        );
                        $this->User_model->add('tbl_income_wallet', $LevelIncome);
                        //$this->User_model->update('tbl_users',['user_id' => $sponser['user_id']],['incomeLimit' => ($sponser['incomeLimit'] + $LevelIncome['amount'])]);
                        //}
                    }
                }
                $sponser_id = $sponser['sponser_id'];
            }
        }
    }

    private function update_business($user_name, $downline_id, $level = 1, $power, $business, $type)
    {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
        if (!empty($user)) {
            if ($user['position'] == 'L') {
                $c = 'leftPower';
                $d = 'leftBusiness';
            } else if ($user['position'] == 'R') {
                $c = 'rightPower';
                $d = 'rightBusiness';
            } else {
                return;
            }
            $this->User_model->update_business($c, $user['upline_id'], $power);
            $this->User_model->update_business($d, $user['upline_id'], $business);
            $downlineArray = array(
                'user_id' => $user['upline_id'],
                'downline_id' => $downline_id,
                'position' => $user['position'],
                'business' => $business,
                'type' => $type,
                'created_at' => date('Y-m-d H:i:s'),
                'level' => $level,
            );
            $this->User_model->add('tbl_downline_business', $downlineArray);
            $user_name = $user['upline_id'];

            if ($user['upline_id'] != '') {
                $this->update_business($user_name, $downline_id, $level + 1, $power, $business, $type);
            }
        }
    }

    protected function individualPoolEntry($user_id, $table)
    {
        if ($table == 'tbl_pool1') {
            $org = 1;
            $amount = 100;
        } elseif ($table == 'tbl_pool2') {
            $org = 2;
            $amount = 200;
        } elseif ($table == 'tbl_pool3') {
            $org = 3;
            $amount = 400;
        } elseif ($table == 'tbl_pool4') {
            $org = 4;
            $amount = 800;
        } elseif ($table == 'tbl_pool5') {
            $org = 5;
            $amount = 1600;
        } elseif ($table == 'tbl_pool6') {
            $org = 6;
            $amount = 3200;
        } elseif ($table == 'tbl_pool7') {
            $org = 7;
            $amount = 6400;
        } elseif ($table == 'tbl_pool8') {
            $org = 7;
            $amount = 12800;
        } elseif ($table == 'tbl_pool9') {
            $org = 7;
            $amount = 25600;
        } elseif ($table == 'tbl_pool10') {
            $org = 7;
            $amount = 51200;
        }
        $sponsorID = $this->User_model->get_single_record('tbl_users', ['user_id' => $user_id], 'sponser_id');
        $pool_upline = $this->User_model->get_single_record($table, array('user_id' => $sponsorID['sponser_id'], 'down_count <' => 3), 'user_id');
        //pr($pool_upline,true);
        if ($pool_upline['user_id'] == '') {
            $uplineID = $this->get_pool_upline($sponsorID['sponser_id'], $table, $org);
        } else {
            $uplineID = $pool_upline['user_id'];
        }
        $userinfo = $this->User_model->get_single_record($table, ['user_id' => $uplineID], 'down_count');
        $poolArr = [
            'user_id' => $user_id,
            'upline_id' => $uplineID,
        ];
        //pr($poolArr,true);
        $this->User_model->add($table, $poolArr);
        $this->User_model->update($table, array('user_id' => $uplineID), ['down_count' => ($userinfo['down_count'] + 1)]);
        $this->updateTeam($user_id, $table);
        $this->update_pool_downline($uplineID, $user_id, $level = 1, $table, $org);
        $this->poolIncome($table, $user_id, $user_id, $org, 3, 1, $amount);
    }

    protected function updateTeam($user_id, $table, $org)
    {
        $uplineID = $this->User_model->get_single_record($table, array('user_id' => $user_id, 'org' => $org), 'upline_id');
        if (!empty($uplineID['upline_id'])) {
            $team = $this->User_model->get_single_record($table, array('user_id' => $uplineID['upline_id'], 'org' => $org), 'team');
            $newTeam = $team['team'] + 1;
            $this->User_model->update($table, array('user_id' => $uplineID['upline_id'], 'org' => $org), array('team' => $newTeam));
            $this->updateTeam($uplineID['upline_id'], $table, $org);
        }
    }

    public function update_pool_downline($upline_id, $user_id, $level, $table, $org)
    {
        $user = $this->User_model->get_single_record($table, array('user_id' => $upline_id), $select = 'user_id,upline_id');
        if (!empty($user['user_id'])) {
            $pool_downArr = [
                'user_id' => $user['user_id'],
                'downline_id' => $user_id,
                'level' => $level,
                'org' => $org,
            ];
            $this->User_model->add('tbl_pool_downline', $pool_downArr);
            $this->update_pool_downline($user['upline_id'], $user_id, $level + 1, $table, $org);
        }
    }

    private function poolIncome($table, $user_id, $linkedID, $org, $team, $level, $amount)
    {
        $upline = $this->User_model->get_single_record($table, ['user_id' => $user_id], ['upline_id']);

        if (!empty($upline['upline_id'])) {
            $checkTeam = $this->User_model->get_single_record('tbl_pool_downline', ['user_id' => $upline['upline_id'], 'level' => $level, 'org' => $org], 'count(id) as team');
            if ($checkTeam['team'] == $team) {
                $creditSIncome = [
                    'user_id' => $upline['upline_id'],
                    'amount' => $amount,
                    'type' => 'working_pool',
                    'description' => 'Working Pool Income from User ' . $linkedID,
                ];
                $this->User_model->add('tbl_income_wallet', $creditSIncome);

                $debitIncome = [
                    'user_id' => $upline['upline_id'],
                    'amount' => -$amount,
                    'type' => 'upgradation_deduction',
                    'description' => 'Working Pool Income from User ' . $linkedID,
                ];
                $this->User_model->add('tbl_income_wallet', $debitIncome);
            } else {
                $creditIncome = [
                    'user_id' => $upline['upline_id'],
                    'amount' => $amount,
                    'type' => 'working_pool',
                    'description' => 'Working Pool upgradation deduction',
                ];
                $this->User_model->add('tbl_income_wallet', $creditIncome);
            }
            $level += 1;
            $team *= 3;
            $this->poolIncome($table, $upline['upline_id'], $linkedID, $org, $team, $level, $amount);
        }
    }

    public function upgradePool()
    {
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $data = $this->security->xss_clean($this->input->post());
            $package = $this->User_model->get_single_record('tbl_package', ['id' => $data['product']], 'direct_income,products');
            $user_id = $this->session->userdata['user_id'];
            $this->globlePoolEntry($user_id, $package['products'], 1);
            $debit = [
                'user_id' => $user_id,
                'amount' => - ($package['direct_income'] * 2),
                'type' => 'upgrade_deduction',
                'description' => 'Pool Upgrade Deduction',
            ];
            $this->User_model->add('tbl_income_wallet', $debit);
        }
        redirect('Dashboard/User');
    }

    protected function globlePoolEntry($user_id, $table, $org)
    {
        if ($table == 'tbl_pool') {
            $amount = 20;
        } elseif ($table == 'tbl_pool2') {
            $amount = 400;
        } elseif ($table == 'tbl_pool3') {
            $amount = 2000;
        } elseif ($table == 'tbl_pool4') {
            $amount = 5000;
        }
        $pool_upline = $this->User_model->get_single_record($table, array('down_count <' => 2, 'org' => $org), 'id,user_id,down_count');
        if (!empty($pool_upline)) {
            $poolArr =  array(
                'user_id' => $user_id,
                'upline_id' => $pool_upline['user_id'],
                'org' => $org,
            );
            $this->User_model->add($table, $poolArr);
            $this->User_model->update($table, array('id' => $pool_upline['id'], 'org' => $org), array('down_count' => $pool_upline['down_count'] + 1));
            $this->updateTeam($user_id, $table, $org);
            $this->poolIncome2($table, $user_id, $user_id, $org);
        } else {
            $poolArr =  array(
                'user_id' => $user_id,
                'upline_id' => '',
                'org' => $org,
            );
            $this->User_model->add($table, $poolArr);
            $this->updateTeam($user_id, $table, $org);
            $this->poolIncome2($table, $user_id, $user_id, $org);
        }
    }

    private function poolIncome2($table, $user_id, $linkedID, $org)
    {
        $poolDetails = $this->poolDetails($table);
        $poolData = $poolDetails[$org];
        $upline = $this->User_model->get_single_record($table, ['user_id' => $user_id], ['upline_id']);
        if (!empty($upline['upline_id'])) {
            $checkTeam = $this->User_model->get_single_record($table, ['user_id' => $upline['upline_id']], 'team');
            if ($checkTeam['team'] == 2) {
                $creditIncome = [
                    'user_id' => $upline['upline_id'],
                    'amount' => $poolData['amount'],
                    'type' => 'pool_income',
                    'description' => 'Pool Income from level ' . $org,
                ];
                $this->User_model->add('tbl_income_wallet', $creditIncome);
                $creditIncome = [
                    'user_id' => $upline['upline_id'],
                    'amount' => -$poolData['amount'],
                    'type' => 'upgrade_deduction',
                    'description' => 'Pool Upgrade Deduction',
                ];
                $this->User_model->add('tbl_income_wallet', $creditIncome);
                $orgNext = $org + 1;
                $this->globlePoolEntry($upline['upline_id'], $table, $orgNext);
            }
        }
    }

    // public function test($table,$org){
    //     $poolDetails = $this->poolDetails($table);
    //     $poolData = $poolDetails[$org];
    //     pr($poolData); 
    // }

    private function poolDetails($table)
    {
        $poolArr = [
            'tbl_pool' => [
                1 => ['amount' => 20],
                2 => ['amount' => 40],
                3 => ['amount' => 80],
                4 => ['amount' => 160],
                5 => ['amount' => 320],
            ],
            'tbl_pool2' => [
                1 => ['amount' => 400],
                2 => ['amount' => 800],
                3 => ['amount' => 1600],
                4 => ['amount' => 3200],
                5 => ['amount' => 6400],
            ],
            'tbl_pool3' => [
                1 => ['amount' => 2000],
                2 => ['amount' => 4000],
                3 => ['amount' => 8000],
                4 => ['amount' => 16000],
                5 => ['amount' => 32000],
            ],
            'tbl_pool4' => [
                1 => ['amount' => 5000],
                2 => ['amount' => 10000],
                3 => ['amount' => 20000],
                4 => ['amount' => 40000],
                5 => ['amount' => 80000],
            ],
        ];

        return $poolArr[$table];
    }

    private function getSponsor($user_id, $table)
    {
        $users = $this->User_model->get_records('tbl_sponser_count', "downline_id = '" . $user_id . "' and user_id != 'none' ORDER BY level ASC", 'user_id');
        foreach ($users as $user) {
            $check = $this->User_model->get_single_record($table, ['user_id' => $user['user_id']], 'user_id');
            if (!empty($check['user_id'])) {
                $check2 = $this->User_model->get_single_record($table, ['user_id' => $user['user_id'], 'down_count <' => 3], 'user_id');
                $this->exceptionCase = $check2['user_id'];
                if (!empty($check2['user_id'])) {
                    return $check2['user_id'];
                    break;
                }
            }
        }
    }

    private function get_pool_upline($sponser_id, $table, $org)
    {
        $users = $this->User_model->get_records('tbl_pool_downline', "user_id = '" . $sponser_id . "' and org = '" . $org . "' ORDER BY level,created_at ASC", 'downline_id');
        if (!empty($users)) {
            foreach ($users as $key => $user) {
                $check = $this->User_model->get_single_record($table, ['user_id' => $user['downline_id'], 'down_count <' => 3], 'user_id');
                if (!empty($check['user_id'])) {
                    return $check['user_id'];
                    break;
                }
            }
        } else {
            $sponsorID = $this->getSponsor($sponser_id, $table);
            if (!empty($sponsorID)) {
                return $sponsorID;
            } else {
                return $this->get_pool_upline($this->exceptionCase, $table, $org);
            }
        }
    }

    public function UpgradeAccount()
    {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('package_id', 'Package', 'trim|numeric|required');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $this->session->userdata['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    //$sponserInfo = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'package_amount');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    $package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
                    //$packageCheck = $this->User_model->get_single_record('tbl_package', 'id = "'.$user['package_id'].'"', '*');
                    //$pool = $this->User_model->get_single_record($packageCheck['products'], 'user_id = "'.$user['user_id'].'"', '*');
                    //if(!empty($pool)){
                    if (!empty($user)) {
                        //if($sponserInfo['package_amount'] >= $package['price']){
                        if ($package['price'] > $user['package_amount']) {
                            if ($wallet['wallet_balance'] >= $package['price']) {
                                //if (empty($poolID['user_id'])) {
                                $sendWallet = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => -$package['price'],
                                    'type' => 'account_activation',
                                    'remark' => 'Account Upgrade Deduction for ' . $user_id,
                                );
                                $this->User_model->add('tbl_wallet', $sendWallet);

                                $topupData = array(
                                    'package_id' => $package['id'],
                                    'package_amount' => $package['price'],
                                    'total_package' => $user['package_amount'] + $package['price'],
                                    'topup_date' => date('Y-m-d H:i:s'),
                                    'capping' => $package['capping'],
                                    'incomeLimit2' => $user['incomeLimit2'] + ($package['price'] * 2.2),
                                    //'retopup' => 0,
                                );
                                $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                                $roiArr = array(
                                    'user_id' => $user['user_id'],
                                    'amount' => ($package['commision'] * $package['days']),
                                    'roi_amount' => $package['commision'] * $package['price'],
                                    'days' => $package['days'],
                                    'total_days' => $package['days'],
                                    'package' => $package['price'],
                                    'type' => 'roi_income',
                                );
                                $this->User_model->add('tbl_roi', $roiArr);
                                //$this->individualPoolEntry($user['user_id'],$amount['product']);
                                // $this->User_model->update_directs($user['sponser_id']);
                                $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), '*');
                                if ($sponser['paid_status'] == 1) {
                                    if ($sponser['incomeLimit2'] > $sponser['incomeLimit']) {
                                        $totalCredit = $sponser['incomeLimit'] + ($package['price'] * $package['direct_income']);
                                        if ($totalCredit < $sponser['incomeLimit2']) {
                                            $direct_income = $package['price'] * $package['direct_income'];
                                        } else {
                                            $direct_income = $sponser['incomeLimit2'] - $sponser['incomeLimit'];
                                        }

                                        $DirectIncome = array(
                                            'user_id' => $user['sponser_id'],
                                            'amount' => $direct_income * 0.7,
                                            'type' => 'direct_income',
                                            'description' => 'Direct Income from Upgradation of Member ' . $user_id,
                                        );
                                        $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                        $this->User_model->update('tbl_users', ['user_id' => $user['sponser_id']], ['incomeLimit' => ($sponser['incomeLimit'] + $DirectIncome['amount'])]);
                                        $coinCredit = array(
                                            'user_id' => $user['sponser_id'],
                                            'amount' => $direct_income * 0.3,
                                            'type' => 'direct_income',
                                            'description' => 'Direct Income from Activation of Member ' . $user_id,
                                        );
                                        $this->User_model->add('tbl_coin_wallet', $coinCredit);
                                    }
                                }
                                // $this->level_income($sponser['sponser_id'], $user['user_id'], $data['amount']);
                                // $DirectIncome = array(
                                //     'user_id' => $user['sponser_id'],
                                //     'amount' => $package['direct_income'],
                                //     'type' => 'direct_income',
                                //     'description' => 'Direct Income from Retopup of Member ' . $user_id,
                                // );
                                // $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                //$this->update_business($user['user_id'], $user['user_id'], $level = 1, $package['bv'], $type = 'topup');
                                // $roiData = [
                                //     'user_id' => $user['user_id'],
                                //     'amount' => $data['amount'] * 2,
                                //     'days' => 44,
                                //     'roi_amount' => $data['amount']*0.04,
                                //     'creditDate' => date('Y-m-d'),
                                // ];
                                // $this->User_model->add('tbl_roi', $roiData);
                                // $roiArr = array(
                                //     'user_id' => $user['user_id'],
                                //     'amount' => ($package['price'] * $package['days']),
                                //     'roi_amount' => $package['commision'],
                                // );

                                // $this->User_model->add('tbl_roi', $roiArr);
                                $message = 'Hello ' . $user['name'] . ', This is a notice to confirm that you have successfully purchased a $' . $package['price'] . ' Ricaverse Membership. If you did not perform this action, please contact our support team immediately. Ricaverse Team, This is an automated message. Please do not reply.';
                                send_crypto_email($user['email'], 'Activation Alert', $message);

                                $this->session->set_flashdata('message', '<h5 class = "text-success">Account upgraded Successfully</h5>');
                                // } else {
                                //     $this->session->set_flashdata('message', '<h5 class = "text-danger">This Account Already Upgrade to this Amount</h5>');
                                // }
                            } else {
                                $this->session->set_flashdata('message', '<h5 class = "text-danger">Insuffcient Balance</h5>');
                            }
                        } else {
                            $this->session->set_flashdata('message', '<h5 class = "text-danger">You can upgrade to only above amount!</h5>');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<h5 class = "text-danger">Invalid User ID</h5>');
                    }
                    // } else {
                    //     $this->session->set_flashdata('message', '<h3 class = "text-danger">Please activate your 1st Pool First </h3>');
                    // }
                } else {
                    $this->session->set_flashdata('message', validation_errors());
                }
            }
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            $response['packages'] = $this->User_model->get_records('tbl_package', [], '*');
            // $response['packages'] = $this->User_model->get_records('tbl_package',"price > '".$response['user']['package_amount']."' ORDER BY id ASC LIMIT 1", '*');

            $this->load->view('upgrade_account', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function stackCoinAjax()
    {
        if (is_logged_in()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $response['status'] = 0;
                $response['csrf'] = $this->security->get_csrf_hash();
                $tokenValue = $this->User_model->get_single_record('tbl_token_value', ['id' => 1], 'amount');
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $this->session->userdata['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_coin_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    if (!empty($user)) {
                        if ($data['amount']) {
                            $sendWallet = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -$data['amount'],
                                'type' => 'stake_coin',
                                'description' => 'Stake Coin Deduction for ' . $user_id,
                            );
                            $this->User_model->add('tbl_coin_wallet', $sendWallet);
                            $totalStakeCoin = $user['stakeCoin'] + $data['amount'];
                            $this->User_model->update('tbl_users', ['user_id' => $user_id], ['stakeCoin' => $totalStakeCoin]);

                            $amount = $data['amount']; //$response['tokenValue']['amount'];
                            $month = $data['months'];
                            if ($month == 18) {
                                $percent = 20;
                                $finalAmount = $amount + $amount * 0.2;
                            } elseif ($month == 24) {
                                $percent = 36;
                                $finalAmount = $amount + $amount * 0.36;
                            } elseif ($month == 36) {
                                $percent = 48;
                                $finalAmount = $amount + $amount * 0.48;
                            } elseif ($month == 48) {
                                $percent = 60;
                                $finalAmount = $amount + $amount * 0.6;
                            } else {
                                redirect('Dashboard/User/logout');
                                exit;
                            }
                            $creditCoin = array(
                                'user_id' => $user['user_id'],
                                'amount' =>  $amount,
                                'token_price' => $tokenValue['amount'],
                                'maturity_amount' => $finalAmount,
                                'months' => $month,
                                'maturity_date' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . '+ ' . $month . 'months')),
                                'created_at' => date('Y-m-d H:i:s'),
                            );
                            $this->User_model->add('tbl_stack_wallet', $creditCoin);
                            $this->levelStackingIncome($user['user_id'], $user['user_id'], $data['amount']);
                            $this->updateBusiness($user['sponser_id'], 'team_business', $data['amount']);
                            $response['status'] = 1;
                            $response['message'] = 'Staking done Successfully';
                        } else {
                            $response['message'] = 'Insuffcient Balance';
                        }
                    } else {
                        $response['message'] = 'Invalid User ID';
                    }
                } else {
                    $response['message'] = validation_errors();
                }
                echo json_encode($response);
                exit;
            }
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function stackCoin()
    {
        if (is_logged_in()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $response['status'] = 0;
                $response['token'] = $this->security->get_csrf_hash();
                $tokenValue = $this->User_model->get_single_record('tbl_token_value', ['id' => 1], 'amount');
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $this->session->userdata['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_coin_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    if (!empty($user)) {
                        if ($wallet['wallet_balance'] >= $data['amount']) {
                            $sendWallet = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -$data['amount'],
                                'type' => 'stake_coin',
                                'description' => 'Stake Coin Deduction for ' . $user_id,
                            );
                            $this->User_model->add('tbl_coin_wallet', $sendWallet);
                            $totalStakeCoin = $user['stakeCoin'] + $data['amount'];
                            $this->User_model->update('tbl_users', ['user_id' => $user_id], ['stakeCoin' => $totalStakeCoin]);

                            $amount = $data['amount']; //$response['tokenValue']['amount'];
                            $month = $data['months'];
                            if ($month == 18) {
                                $percent = 20;
                                $finalAmount = $amount + $amount * 0.2;
                            } elseif ($month == 24) {
                                $percent = 36;
                                $finalAmount = $amount + $amount * 0.36;
                            } elseif ($month == 36) {
                                $percent = 48;
                                $finalAmount = $amount + $amount * 0.48;
                            } elseif ($month == 48) {
                                $percent = 60;
                                $finalAmount = $amount + $amount * 0.6;
                            } else {
                                redirect('Dashboard/User/logout');
                                exit;
                            }
                            $creditCoin = array(
                                'user_id' => $user['user_id'],
                                'amount' =>  $amount,
                                'token_price' => $tokenValue['amount'],
                                'maturity_amount' => $finalAmount,
                                'months' => $month,
                                'maturity_date' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . '+ ' . $month . 'months')),
                                'created_at' => date('Y-m-d H:i:s'),
                            );
                            $this->User_model->add('tbl_stack_wallet', $creditCoin);
                            $this->levelStackingIncome($user['user_id'], $user['user_id'], $data['amount']);
                            $this->updateBusiness($user['sponser_id'], 'team_business', $data['amount']);
                            $response['status'] = 1;
                            $response['message'] = 'Staking done Successfully';
                        } else {
                            $response['message'] = 'Insuffcient Balance';
                        }
                    } else {
                        $response['message'] = 'Invalid User ID';
                    }
                } else {
                    $response['message'] = validation_errors();
                }
                echo json_encode($response);
                exit;
            }
        } else {
            redirect('Dashboard/User/login');
        }
    }

    private function levelStackingIncome($user_id, $linkedID, $amount)
    {
        $incomeArr = ['0.1', '0.05', '0.03', '0.02'];
        foreach ($incomeArr as $key => $income) :
            $sponsor = $this->User_model->get_single_record('tbl_users', ['user_id' => $user_id], 'sponser_id');
            if (!empty($sponsor['sponser_id']) && $sponsor['sponser_id'] != 'none') :
                $creditIncome = [
                    'user_id' => $sponsor['sponser_id'],
                    'amount' => $amount * $income,
                    'type' => 'level_income',
                    'description' => 'Staking level income from User ' . $linkedID . ' at level ' . ($key + 1),
                ];
                $this->User_model->add('tbl_income_wallet', $creditIncome);
                $user_id = $sponsor['sponser_id'];
            endif;
        endforeach;
    }


    public function purchaseMurphyAjax()
    {
        if (is_logged_in()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $response['status'] = 0;
                $response['csrf'] = $this->security->get_csrf_hash();
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $this->session->userdata['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    $tokenValue = $this->User_model->get_single_record('tbl_token_value', ['id' => 1], 'amount');
                    if (!empty($user)) {
                        if ($data['amount']) {
                            $sendWallet = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -$data['amount'],
                                'type' => 'account_activation',
                                'remark' => 'Account Activation Deduction for ' . $user_id,
                            );
                            $this->User_model->add('tbl_wallet', $sendWallet);
                            $topupData = array(
                                'paid_status' => 1,
                                'package_id' => 1,
                                'package_amount' => $user['package_amount'] + $data['amount'],
                                'topup_date' => date('Y-m-d H:i:s'),
                            );
                            $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                            if ($user['paid_status'] == 0) {
                                $this->User_model->update_directs($user['sponser_id']);
                            }
                            $roiMaker = $data['amount'] * 0.03;
                            $month = $data['months'];
                            $coin = $data['amount'] / $tokenValue['amount'];
                            // if($month == 18){
                            //     $percent = 20;
                            //     $finalAmount = $amount + $amount*0.2;
                            // } elseif($month == 24) {
                            //     $percent = 36;
                            //     $finalAmount = $amount + $amount*0.36;
                            // } elseif($month == 36) {
                            //     $percent = 48;
                            //     $finalAmount = $amount + $amount*0.48;
                            // } elseif($month == 48) {
                            //     $percent = 60;
                            //     $finalAmount = $amount + $amount*0.6;
                            // } else {
                            //     redirect('Dashboard/User/logout');
                            //     exit;
                            // }

                            $roiArr = array(
                                'user_id' => $user['user_id'],
                                'amount' => ($roiMaker * $month),
                                'roi_amount' => $roiMaker,
                                'days' => $month,
                                'total_days' => $month,
                                'coin' => $coin,
                                'token_price' => $tokenValue['amount'],
                                'package' => $data['amount'],
                                'type' => 'roi_income',
                                'creditDate' => date('Y-m-d'),
                                'currency' => $data['currency'],
                                'transactionHash' => $data['data']
                            );
                            $this->User_model->add('tbl_roi', $roiArr);
                            $this->updateBusiness($user['sponser_id'], 'team_business_plan', $data['amount']);
                            $response['status'] = 1;
                            $response['message'] = 'Murphy Purchase done Successfully';
                        } else {
                            $response['message'] = 'Insuffcient Balance';
                        }
                    } else {
                        $response['message'] = 'Invalid User ID';
                    }
                } else {
                    $response['message'] = validation_errors();
                }
                echo json_encode($response);
                exit;
            }
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function purchaseMurphy()
    {
        if (is_logged_in()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $response['status'] = 0;
                $response['token'] = $this->security->get_csrf_hash();
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $this->session->userdata['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    $tokenValue = $this->User_model->get_single_record('tbl_token_value', ['id' => 1], 'amount');
                    if (!empty($user)) {
                        if ($wallet['wallet_balance'] >= $data['amount']) {
                            $sendWallet = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -$data['amount'],
                                'type' => 'account_activation',
                                'remark' => 'Account Activation Deduction for ' . $user_id,
                            );
                            $this->User_model->add('tbl_wallet', $sendWallet);
                            $topupData = array(
                                'paid_status' => 1,
                                'package_id' => 1,
                                'package_amount' => $user['package_amount'] + $data['amount'],
                                'topup_date' => date('Y-m-d H:i:s'),
                            );
                            $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                            if ($user['paid_status'] == 0) {
                                $this->User_model->update_directs($user['sponser_id']);
                            }
                            $roiMaker = $data['amount'] * 0.03;
                            $month = $data['months'];
                            $coin = $data['amount'] / $tokenValue['amount'];
                            // if($month == 18){
                            //     $percent = 20;
                            //     $finalAmount = $amount + $amount*0.2;
                            // } elseif($month == 24) {
                            //     $percent = 36;
                            //     $finalAmount = $amount + $amount*0.36;
                            // } elseif($month == 36) {
                            //     $percent = 48;
                            //     $finalAmount = $amount + $amount*0.48;
                            // } elseif($month == 48) {
                            //     $percent = 60;
                            //     $finalAmount = $amount + $amount*0.6;
                            // } else {
                            //     redirect('Dashboard/User/logout');
                            //     exit;
                            // }

                            $roiArr = array(
                                'user_id' => $user['user_id'],
                                'amount' => ($roiMaker * $month),
                                'roi_amount' => $roiMaker,
                                'days' => $month,
                                'total_days' => $month,
                                'coin' => $coin,
                                'token_price' => $tokenValue['amount'],
                                'package' => $data['amount'],
                                'type' => 'roi_income',
                                'creditDate' => date('Y-m-d'),
                            );
                            $this->User_model->add('tbl_roi', $roiArr);
                            $this->updateBusiness($user['sponser_id'], 'team_business_plan', $data['amount']);
                            $response['status'] = 1;
                            $response['message'] = 'Murphy Purchase done Successfully';
                        } else {
                            $response['message'] = 'Insuffcient Balance';
                        }
                    } else {
                        $response['message'] = 'Invalid User ID';
                    }
                } else {
                    $response['message'] = validation_errors();
                }
                echo json_encode($response);
                exit;
            }
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function getBalance()
    {
        if (is_logged_in()) {
            $coinBalance = $this->User_model->get_single_record('tbl_coin_wallet', ['user_id' => $this->session->userdata['user_id']], 'ifnull(sum(amount),0) as balance');
            $walletBalance = $this->User_model->get_single_record('tbl_wallet', ['user_id' => $this->session->userdata['user_id']], 'ifnull(sum(amount),0) as balance');
            $response = [
                'coinBalance' => $coinBalance['balance'],
                'walletBalance' => $walletBalance['balance'],
            ];
            echo json_encode($response);
            exit;
        } else {
            redirect('Dashboard/User/logout');
        }
    }

    public function getMHY()
    {
        if (is_logged_in()) {
            $tokenValue = $this->User_model->get_single_record('tbl_token_value', ['id' => 1], '*');
            $response['tokenValue'] = $tokenValue['amount'];
            $response['sellValue'] = $tokenValue['sellValue'];
            echo json_encode($response);
            exit;
        } else {
            redirect('Dashboard/User/logout');
        }
    }

    public function buyCoin()
    {
        if (is_logged_in()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $response['status'] = 0;
                $response['token'] = $this->security->get_csrf_hash();
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $this->session->userdata['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    $tokenValue = $this->User_model->get_single_record('tbl_token_value', ['id' => 1], 'amount');
                    if (!empty($user)) {
                        if ($wallet['wallet_balance'] >= $data['amount']) {
                            $debitWallet = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -abs($data['amount']),
                                'type' => 'buy_coin',
                                'remark' => 'Deducted for buying coin at price ' . $$tokenValue['amount'],
                            );
                            $this->User_model->add('tbl_wallet', $debitWallet);

                            $coin = abs($data['amount']) / $tokenValue['amount'];

                            $creditCoin = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => $coin,
                                'type' => 'buy_coin',
                                'description' => 'Buy Coin at price ' . $tokenValue['amount'],
                            );
                            $this->User_model->add('tbl_coin_wallet', $creditCoin);

                            $response['status'] = 1;
                            $response['message'] = 'Coin Purchase done Successfully';
                        } else {
                            $response['message'] = 'Insuffcient Balance';
                        }
                    } else {
                        $response['message'] = 'Invalid User ID';
                    }
                } else {
                    $response['message'] = validation_errors();
                }
                echo json_encode($response);
                exit;
            }
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function sellCoin()
    {
        if (is_logged_in()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $response['status'] = 0;
                $response['token'] = $this->security->get_csrf_hash();
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $this->session->userdata['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_coin_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    $tokenValue = $this->User_model->get_single_record('tbl_token_value', ['id' => 1], 'sellValue');
                    if (!empty($user)) {
                        if ($wallet['wallet_balance'] >= $data['amount']) {
                            $debitCoin = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -abs($data['amount']),
                                'type' => 'sell_coin',
                                'description' => 'Deducted for sell coin at price ' . $$tokenValue['sellValue'],
                            );
                            $this->User_model->add('tbl_coin_wallet', $debitCoin);

                            $amount = abs($data['amount']) * $tokenValue['sellValue'];

                            $creditWallet = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => $amount,
                                'type' => 'sell_coin',
                                'description' => 'Sell Coin at price ' . $tokenValue['sellValue'],
                            );
                            $this->User_model->add('tbl_wallet', $creditWallet);

                            $response['status'] = 1;
                            $response['message'] = 'Coin Selling done Successfully';
                        } else {
                            $response['message'] = 'Insuffcient Coin Balance';
                        }
                    } else {
                        $response['message'] = 'Invalid User ID';
                    }
                } else {
                    $response['message'] = validation_errors();
                }
                echo json_encode($response);
                exit;
            }
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function fixDeposit()
    {
        $response['tokenValue'] = $this->User_model->get_single_record('tbl_token_value', ['id' => 1], 'amount');
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');
            if ($this->form_validation->run() === true) {
                $checkUser = $this->User_model->get_single_record('tbl_users', ['user_id' => $data['user_id']], '*');
                if (!empty($checkUser['user_id'])) {
                    $checkBalance = $this->User_model->get_single_record('tbl_wallet', ['user_id' => $this->session->userdata['user_id']], 'ifnull(sum(amount),0) as balance');
                    if ($checkBalance['balance'] >= $data['amount']) {
                        // if($data['amount'] == 1000){
                        //     $percent = 0.04;
                        // } elseif ($data['amount'] == 5000){
                        //     $percent = 0.05;
                        // } elseif ($data['amount'] == 10000){
                        //     $percent = 0.06;
                        // } else {
                        //     $this->session->set_flashdata('message','<h5 class="text-danger">Invalid Amount!</h5>');
                        //     exit;
                        // }
                        $debit = [
                            'user_id' => $this->session->userdata['user_id'],
                            'amount' => -abs($data['amount']),
                            'type' => 'insta_stake',
                            'remark' => 'Amount deducted for insta stake of User ' . $data['user_id'],
                        ];
                        $this->User_model->add('tbl_wallet', $debit);
                        $months = $data['months'];
                        if ($months == 3) {
                            $percent = 1.09;
                        } elseif ($months == 6) {
                            $percent = 1.12;
                        } elseif ($months == 9) {
                            $percent = 1.15;
                        } elseif ($months == 12) {
                            $percent = 1.2;
                        }
                        $credit = [
                            'user_id' => $data['user_id'],
                            'amount' => ($data['amount'] / $response['tokenValue']['amount']) * $percent,
                            'type' => 'insta_stake',
                            'description' => 'Insta Stake',
                            'package' => $data['amount'],
                        ];
                        $this->User_model->add('tbl_coin_wallet', $credit);
                        $this->instaLevel($data['user_id'], $data['user_id'], $data['amount']);
                        $this->session->set_flashdata('message', '<h5 class="text-success">Staking done successfully.</h5>');
                    } else {
                        $this->session->set_flashdata('message', '<h5 class="text-danger">Insufficient balance!</h5>');
                    }
                } else {
                    $this->session->set_flashdata('message', '<h5 class="text-danger">Invalid User ID!</h5>');
                }
            }
        }
        $response['balance'] = $this->User_model->get_single_record('tbl_wallet', ['user_id' => $this->session->userdata['user_id']], 'ifnull(sum(amount),0) as balance');
        $response['header'] = ucwords(str_replace('-', ' ', $this->uri->segment(2)));
        $response['form'] = '<div class="form-group">
                                <label>User ID</label>
                                <input type="text" class="form-control" id="user_id" name="user_id"
                                    value="' . set_value('user_id') . '" placeholder="User ID"
                                    style="max-width: 400px" />
                                <span class="text-danger">' . form_error('user_id') . '</span>
                                <span class="text-danger" id="errorMessage"></span>
                            </div>
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" class="form-control" name="amount"
                                    value="' . set_value('amount') . '" placeholder="Enter Amount"
                                    style="max-width: 400px" />
                                <span class="text-danger">' . form_error('amount') . '</span>
                            </div>
                            <div class="form-group">
                                <label>Time Period</label>
                                <select class="form-control" name="months" style="max-width: 400px">
                                    <option value="3">3 Months 9%</option>
                                    <option value="6">6 Months 12%</option>
                                    <option value="9">9 Months 15%</option>
                                    <option value="12">12 Months 20%</option>
                                </select>
                            </div>
                            <div class="form-group" id="SaveBtn">
                                <button type="subimt" name="save" class="btn btn-success">Submit</button>
                            </div>';
        $this->load->view('form', $response);
    }

    private function instaLevel($user_id, $linkedID, $amount)
    {
        $incomeArr = ['0.05', '0.03', '0.02'];
        foreach ($incomeArr as $key => $income) :
            $sponsorID = $this->User_model->get_single_record('tbl_users', ['user_id' => $user_id], 'sponser_id');
            if (!empty($sponsorID['sponser_id']) && $sponsorID['sponser_id'] != 'none') :
                $sponsorInfo = $this->User_model->get_single_record('tbl_users', ['user_id' => $sponsorID['sponser_id']], 'user_id');
                $credit = [
                    'user_id' => $sponsorInfo['user_id'],
                    'amount' => $amount * $income,
                    'type' => 'instal_stake_reffer_income',
                    'description' => 'Insta Stake Reffer Income From User ' . $linkedID . ' at level ' . ($key + 1),
                ];
                $this->User_model->add('tbl_income_wallet', $credit);
                $user_id = $sponsorInfo['user_id'];
            endif;
        endforeach;
    }

    public function stake()
    {
        if (is_logged_in()) {
            $response['title'] = "Staking";
            $response['tokenValue'] = $this->User_model->get_single_record('tbl_token_value', ['id' => 1], '*');
            $this->load->view('stake', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function stakeAjax()
    {
        secure_request();
        if ($this->input->is_ajax_request()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('hash', 'Transaction Hash', 'trim|required');
                $this->form_validation->set_rules('amount', 'Stake Amount', 'trim|required|numeric');
                $this->form_validation->set_rules('days', 'days', 'trim|required|numeric');
                $this->form_validation->set_rules('eth_address', 'Wallet Address', 'trim|required', ['required' => 'Wallet Address filed Required!']);
                $this->form_validation->set_rules('transaction', 'Transaction', 'trim|required', ['required' => 'Invaild Method for Registration!']);
                $this->form_validation->set_rules('blockHash', 'Transaction Hash Confirm', 'trim|required', ['required' => 'Transaction Hash Confirm not found!']);
                if ($this->form_validation->run() != false) {
                    $package = $this->User_model->get_single_record('tbl_package', array('id' => 1), '*');
                    $data['amount'] = abs($data['amount']);
                    // $cal = $data['amount'] % 1;
                    if ($data['amount'] >= 1) {
                        if ($data['days'] == 1 || $data['days'] == 7 || $data['days'] == 30 || $data['days'] == 180) {
                            $days = abs($data['days']);
                            $hash = trim(addslashes($data['hash']));
                            $eth_address = strtolower(trim(addslashes($data['eth_address'])));
                            $transaction_check = json_decode($data['transaction'], true);
                            $user_id = trim($this->session->userdata['user_id']);
                            $hash_found = $this->User_model->get_single_record('tbl_users', array('tranx_id' => $hash), '*');
                            $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                            if (empty($hash_found) && !empty($hash)) {
                                $response2['coin_price'] = $this->User_model->get_single_record('tbl_token_value', [], '*');
                                $trueAmount = intval(abs($data['amount'])); ///intval(abs($data['amount']) / $response2['coin_price']['amount']);
                                //$trueAmount = substr(str_replace(".", "", $filterTrueAmount),0,10);
                                $transferAmount = intval($transaction_check['events']['Transfer']['returnValues']['value'] / decimal_number);
                                if ($trueAmount != $transferAmount) {
                                    $response['success'] = 2;
                                    $response['message'] = 'Transaction Amount not macthed with BSC Scan!';
                                    echo json_encode($response);
                                    exit();
                                }


                                if ($data['amount'] > 25000) {
                                    $response['success'] = 2;
                                    $response['message'] = 'Please activate less the amount $ 25000!';
                                    echo json_encode($response);
                                    exit();
                                }


                                $check_transaction = json_decode($this->check_transaction($transaction_check['transactionHash']), true);

                                if (!empty($check_transaction) && $check_transaction['success'] == 'SUCCESS') {

                                    if ($check_transaction['success'] == 'SUCCESS') {
                                        $datecheck = date('YmdHi', $check_transaction['response']['timestamp']);
                                        //if($datecheck == date('YmdHi')){
                                        if ($check_transaction['response']['value'] == $trueAmount) {
                                            if (strtolower($check_transaction['response']['from']) == strtolower($data['eth_address'])) {
                                                if (strtolower($check_transaction['response']['to']) == strtolower(receiving_address)) {
                                                    $transaction_confirm_status = 1;
                                                } else {
                                                    $transaction_confirm_status = 0;
                                                }
                                            } else {
                                                $transaction_confirm_status = 0;
                                            }
                                        } else {
                                            $transaction_confirm_status = 0;
                                        }
                                        // }else{
                                        //     $transaction_confirm_status = 0;
                                        // }
                                    } else {
                                        $transaction_confirm_status = 0;
                                    }


                                    if ($transaction_confirm_status == 0) {
                                        $response['success'] = 2;
                                        $response['message'] = 'Transaction Amount not macthed with BSC Scan Second!';
                                        // $response['d'] = $check_transaction;
                                        echo json_encode($response);
                                        exit();
                                    }


                                    if (empty($check_transaction['response']['contract'])) {
                                        $response['success'] = 2;
                                        $response['message'] = 'Invaild Contract!';
                                        echo json_encode($response);
                                        exit();
                                    }

                                    if (!empty($check_transaction['response']['contract']) && strtolower($check_transaction['response']['contract']) != strtolower(contract_address)) {
                                        $response['success'] = 2;
                                        $response['message'] = 'Try another method!';
                                        echo json_encode($response);
                                        exit();
                                    }


                                    if (!empty($transaction_check) && $transaction_check['status'] === TRUE && $transaction_check['transactionHash'] == $hash && $transaction_check['events']['Transfer']['transactionHash'] == $hash) {
                                        if (strtolower($transaction_check['from']) == strtolower($eth_address) && !empty($transaction_check['events']['Transfer'])) {
                                            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), '*');
                                            $eth_address2 = $this->User_model->get_single_record('tbl_users', array('eth_address' => $data['eth_address']), '*');


                                            if (!empty($user)) {

                                                if (!empty($data['amount'])) {

                                                    $conditionArr = $this->conditionArr($data['amount'], $data['days']);
                                                    if ($conditionArr['status'] == true) {
                                                        $topupData = array(
                                                            'paid_status' => 1,
                                                            'package_id' => 1, //$package['id'],
                                                            'package_amount' => $data['amount'],
                                                            'total_package' => $user['total_package'] + $data['amount'],
                                                            'topup_date' => date('Y-m-d H:i:s'),
                                                            'capping' => $data['amount'],
                                                            'incomeLimit2' => $user['incomeLimit2'] + ($data['amount'] * 3),
                                                        );
                                                        $this->User_model->update('tbl_users', ['user_id' => $user_id], $topupData);
                                                        $this->User_model->update_directs($user['sponser_id']);
                                                        $totalStakeCoin = $user['stakeCoin'] + $data['amount'];

                                                        $roiArr = array(
                                                            'user_id' => $user['user_id'],
                                                            'amount' => $conditionArr['roi'] * $data['days'],
                                                            'roi_amount' => $conditionArr['roi'],
                                                            'days' => $data['days'],
                                                            'total_days' => $data['days'],
                                                            'package' => $data['amount'],
                                                            'type' => 'roi_income',
                                                            'creditDate' => date('Y-m-d'),
                                                        );
                                                        $this->User_model->add('tbl_roi', $roiArr);

                                                        //$this->levelStackingIncome($user['user_id'], $user['user_id'],$data['amount']);
                                                        //$this->updateBusiness($user['sponser_id'],'team_business',$data['amount']);
                                                        $response['success'] = 1;
                                                        $response['message'] = 'User Activate Successfully!';
                                                    } else {
                                                        $response['message'] =  $conditionArr['message'];
                                                    }
                                                } else {
                                                    $response['success'] = 2;
                                                    $response['message'] = 'Invaild Package Amount!';
                                                }
                                            } else {
                                                $response['success'] = 2;
                                                $response['message'] = 'Invaild User Id!';
                                            }
                                        } else {
                                            $response['success'] = 2;
                                            $response['message'] = 'Wallet Address not matched with transaction!';
                                        }
                                    } else {
                                        $response['success'] = 2;
                                        $response['message'] = 'Invaild Transaction or Invaild Method!';
                                    }
                                } else {
                                    $response['success'] = 2;
                                    $response['message'] = 'Invaild Transaction or Invaild Method!';
                                }
                            } else {
                                $response['success'] = 2;
                                $response['message'] = 'Transaction Hash alrady exist!';
                            }
                        } else {
                            $response['success'] = 2;
                            $response['message'] = 'Invaild Year selected!';
                        }
                    } else {
                        $response['success'] = 2;
                        $response['message'] = 'Minimum Staking $100 & Mulitple Staking $100!';
                    }
                } else {
                    $response['success'] = 0;
                    $response['message'] = validation_errors();
                }
            } else {
                redirect('Dashboard/User/login');
            }
        } else {
            $response['success'] = 0;
            $response['message'] = 'Do not hit with direct script!';
        }
        $response['token'] = $this->security->get_csrf_hash();
        echo json_encode($response);
        exit();
    }



    private function check_transaction($hash = '')
    {
        if (!empty($hash)) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://139.59.41.9/gnc/all_in_one_confirm_transaction',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'hash=' . $hash . '&deimal=' . decimal_number,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return $response;
        } else {
            return false;
        }
    }


    public function userExist($csrf, $eth_address)
    {
        // sk (Tony)
        if ($this->input->is_ajax_request()) {
            if (!empty($csrf)) {
                if ($csrf == $this->security->get_csrf_hash()) {
                    $user = $this->User_model->get_single_record('tbl_users', ['user_id' =>  $this->session->userdata['user_id']], '*');
                    if (!empty($user)) {
                        $response['success'] = 1;
                    } else {
                        $response['success'] = 0;
                        $response['message'] = 'Invaild Wallet Address/Not Registered!';
                    }
                } else {
                    $response['success'] = 0;
                    $response['message'] = 'Invaild Token';
                }
            } else {
                $response['success'] = 0;
                $response['message'] = 'Invaild Token';
            }
        } else {
            $response['success'] = 0;
            $response['message'] = 'Do not hit with direct script!';
        }
        echo json_encode($response);
        exit();
    }


    public function checkPackage($csrf, $package, $month)
    {
        date_default_timezone_set("Asia/Calcutta");
        if ($this->input->is_ajax_request()) {
            if (!empty($csrf)) {
                if ($csrf == $this->security->get_csrf_hash()) {
                    if ($month == 1 || $month == 7 || $month == 30 || $month == 180) {
                        // $cal = $package % 1;
                        if ($package >= 1) {
                            $response['success'] = 1;
                        } else {
                            $response['success'] = 0;
                            $response['message'] = 'Minimum Staking 100USDT & Multiple Staking 100USDT!';
                        }
                    } else {
                        $response['success'] = 0;
                        $response['message'] = 'Invaild Days Selected!';
                    }
                } else {
                    $response['success'] = 0;
                    $response['message'] = 'Invaild Token';
                }
            } else {
                $response['success'] = 0;
                $response['message'] = 'Invaild Token';
            }
        } else {
            $response['success'] = 0;
            $response['message'] = 'Do not hit with direct script!';
        }
        echo json_encode($response);
        exit();
    }

    private function getOrderId()
    {
        $order_id = rand(100000, 999999);
        $check_order_id = $this->User_model->get_single_record('tbl_staking_history', ['order_id' => $order_id], '*');
        if (empty($check_order_id)) {
            return $order_id;
        } else {
            return $this->getOrderId();
        }
    }

    public function principle_stake()
    {
        if (is_logged_in()) {
            $response['title'] = "Principal Stake";
            $response['des'] = "";
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Stake Amount', 'trim|required|numeric');
                $this->form_validation->set_rules('days', 'days', 'trim|required|numeric');
                if ($this->form_validation->run() != false) {
                    $package = $this->User_model->get_single_record('tbl_package', array('id' => 1), '*');
                    $data['amount'] = abs($data['amount']);
                    if ($data['amount'] >= 1) {
                        if ($data['days'] == 1 || $data['days'] == 7 || $data['days'] == 30 || $data['days'] == 180) {
                            $days = abs($data['days']);
                            $user_id = trim($this->session->userdata['user_id']);
                            $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');

                            $response2['coin_price'] = $this->User_model->get_single_record('tbl_token_value', [], '*');
                            $trueAmount = intval(abs($data['amount']));

                            if ($data['amount'] > 25000) {
                                $response['success'] = 2;
                                $response['message'] = 'Please activate less the amount $ 25000!';
                                $this->session->set_flashdata('message', 'Please activate less the amount $ 25000!');

                                // echo json_encode($response);
                                // exit();
                            }
                            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), '*');
                            if (!empty($user)) {
                                if (!empty($data['amount'])) {
                                    $balance = $this->User_model->get_single_record('tbl_income_wallet1', ['user_id' => $this->session->userdata['user_id'], 'withdraw_date <=' => date('Y-m-d H:i:s')], 'ifnull(sum(amount),0) as balance');
                                    if ($balance['balance'] >= $data['amount']) {
                                        $conditionArr = $this->conditionArr($data['amount'], $data['days']);
                                        if ($conditionArr['status'] == true) {
                                            $debitAmount = [
                                                'user_id' => $user['user_id'],
                                                'amount' => -$data['amount'],
                                                'type' => 'staking_deduction',
                                                'description' => 'Staking Deduction',
                                                'withdraw_date' => date('Y-m-d H:i:s'),
                                            ];
                                            $this->User_model->add('tbl_income_wallet1', $debitAmount);
                                            $topupData = array(
                                                'paid_status' => 1,
                                                'package_id' => 1, //$package['id'],
                                                'package_amount' => $data['amount'],
                                                'total_package' => $user['total_package'] + $data['amount'],
                                                'topup_date' => date('Y-m-d H:i:s'),
                                                'capping' => $data['amount'],
                                                'incomeLimit2' => $user['incomeLimit2'] + ($data['amount'] * 3),
                                            );
                                            $this->User_model->update('tbl_users', ['user_id' => $user_id], $topupData);
                                            // $this->User_model->update_directs($user['sponser_id']);
                                            $totalStakeCoin = $user['stakeCoin'] + $data['amount'];
                                            $roiArr = array(
                                                'user_id' => $user['user_id'],
                                                'amount' => $conditionArr['roi'] * $data['days'],
                                                'roi_amount' => $conditionArr['roi'],
                                                'days' => $data['days'],
                                                'total_days' => $data['days'],
                                                'package' => $data['amount'],
                                                'type' => 'roi_income',
                                                'creditDate' => date('Y-m-d'),
                                            );
                                            $this->User_model->add('tbl_roi', $roiArr);
                                            $response['url'] = base_url('Dashboard/Activation/principle_stake');

                                            $response['success'] = 1;
                                            $this->session->set_flashdata('message', 'User Activate Successfully!');
                                            $response['message'] = 'User Activate Successfully!';
                                        } else {
                                            $response['url'] = base_url('Dashboard/Activation/principle_stake');

                                            $response['success'] = 2;
                                            $this->session->set_flashdata('message', $conditionArr['message']);

                                            $response['message'] =  $conditionArr['message'];
                                        }
                                    } else {
                                        $response['url'] = base_url('Dashboard/Activation/principle_stake');

                                        $response['success'] = 2;
                                        $this->session->set_flashdata('message', 'Insufficient Balance!');

                                        $response['message'] = 'Insufficient Balance!';
                                    }
                                } else {
                                    $response['url'] = base_url('Dashboard/Activation/principle_stake');

                                    $response['success'] = 2;
                                    $this->session->set_flashdata('message', 'Invaild Package Amount!');

                                    $response['message'] = 'Invaild Package Amount!';
                                }
                            } else {
                                $response['url'] = base_url('Dashboard/Activation/principle_stake');

                                $response['success'] = 2;
                                $this->session->set_flashdata('message', 'Invaild User Id!');

                                $response['message'] = 'Invaild User Id!';
                            }
                        } else {
                            // $response['url'] = base_url('Dashboard/Activation/principle_stake');

                            // $response['success'] = 2;
                            $this->session->set_flashdata('message', 'Invaild Year selected!');

                            // $response['message'] = 'Invaild Year selected!';
                        }
                    } else {
                        // $response['url'] = base_url('Dashboard/Activation/principle_stake');

                        // $response['success'] = 2;
                        $this->session->set_flashdata('message', 'Minimum Staking $100 & Mulitple Staking $100!');

                        // $response['message'] = 'Minimum Staking $100 & Mulitple Staking $100!';
                    }
                }
                // else{
                //     // $response['url'] = base_url('Dashboard/Activation/principle_stake');

                //     // $response['success'] = 0;
                //     $this->session->set_flashdata('message',validation_errors());

                //     // $response['message'] = validation_errors();
                // }
            }
            // else{
            //     redirect('Dashboard/User/login');
            // }

            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet1', ' user_id = "' . $this->session->userdata['user_id'] . '" and withdraw_date <= "' . date('Y-m-d H:i:s') . '"', 'ifnull(sum(amount),0) as balance');

            $this->load->view('principle_stake', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function principleStake()
    {
        secure_request();
        // if($this->input->is_ajax_request()){
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('amount', 'Stake Amount', 'trim|required|numeric');
            $this->form_validation->set_rules('days', 'days', 'trim|required|numeric');
            if ($this->form_validation->run() != false) {
                $package = $this->User_model->get_single_record('tbl_package', array('id' => 1), '*');
                $data['amount'] = abs($data['amount']);
                if ($data['amount'] >= 1) {
                    if ($data['days'] == 1 || $data['days'] == 7 || $data['days'] == 30 || $data['days'] == 180) {
                        $days = abs($data['days']);
                        $user_id = trim($this->session->userdata['user_id']);
                        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');

                        $response2['coin_price'] = $this->User_model->get_single_record('tbl_token_value', [], '*');
                        $trueAmount = intval(abs($data['amount']));

                        if ($data['amount'] > 25000) {
                            $response['success'] = 2;
                            $response['message'] = 'Please activate less the amount $ 25000!';
                            echo json_encode($response);
                            exit();
                        }
                        $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), '*');
                        if (!empty($user)) {
                            if (!empty($data['amount'])) {
                                $balance = $this->User_model->get_single_record('tbl_income_wallet1', ['user_id' => $this->session->userdata['user_id'], 'withdraw_date <=' => date('Y-m-d H:i:s')], 'ifnull(sum(amount),0) as balance');
                                if ($balance['balance'] >= $data['amount']) {
                                    $conditionArr = $this->conditionArr($data['amount'], $data['days']);
                                    if ($conditionArr['status'] == true) {
                                        $debitAmount = [
                                            'user_id' => $user['user_id'],
                                            'amount' => -$data['amount'],
                                            'type' => 'staking_deduction',
                                            'description' => 'Staking Deduction',
                                            'withdraw_date' => date('Y-m-d H:i:s'),
                                        ];
                                        $this->User_model->add('tbl_income_wallet1', $debitAmount);
                                        $topupData = array(
                                            'paid_status' => 1,
                                            'package_id' => 1, //$package['id'],
                                            'package_amount' => $data['amount'],
                                            'total_package' => $user['total_package'] + $data['amount'],
                                            'topup_date' => date('Y-m-d H:i:s'),
                                            'capping' => $data['amount'],
                                            'incomeLimit2' => $user['incomeLimit2'] + ($data['amount'] * 3),
                                        );
                                        $this->User_model->update('tbl_users', ['user_id' => $user_id], $topupData);
                                        // $this->User_model->update_directs($user['sponser_id']);
                                        $totalStakeCoin = $user['stakeCoin'] + $data['amount'];
                                        $roiArr = array(
                                            'user_id' => $user['user_id'],
                                            'amount' => $conditionArr['roi'] * $data['days'],
                                            'roi_amount' => $conditionArr['roi'],
                                            'days' => $data['days'],
                                            'total_days' => $data['days'],
                                            'package' => $data['amount'],
                                            'type' => 'roi_income',
                                            'creditDate' => date('Y-m-d'),
                                        );
                                        $this->User_model->add('tbl_roi', $roiArr);
                                        $response['url'] = base_url('Dashboard/Activation/principle_stake');

                                        $response['success'] = 1;
                                        $this->session->set_flashdata('message', 'User Activate Successfully!');
                                        $response['message'] = 'User Activate Successfully!';
                                    } else {
                                        $response['url'] = base_url('Dashboard/Activation/principle_stake');

                                        $response['success'] = 2;
                                        $this->session->set_flashdata('message', $conditionArr['message']);

                                        $response['message'] =  $conditionArr['message'];
                                    }
                                } else {
                                    $response['url'] = base_url('Dashboard/Activation/principle_stake');

                                    $response['success'] = 2;
                                    $this->session->set_flashdata('message', 'Insufficient Balance!');

                                    $response['message'] = 'Insufficient Balance!';
                                }
                            } else {
                                $response['url'] = base_url('Dashboard/Activation/principle_stake');

                                $response['success'] = 2;
                                $this->session->set_flashdata('message', 'Invaild Package Amount!');

                                $response['message'] = 'Invaild Package Amount!';
                            }
                        } else {
                            $response['url'] = base_url('Dashboard/Activation/principle_stake');

                            $response['success'] = 2;
                            $this->session->set_flashdata('message', 'Invaild User Id!');

                            $response['message'] = 'Invaild User Id!';
                        }
                    } else {
                        // $response['url'] = base_url('Dashboard/Activation/principle_stake');

                        // $response['success'] = 2;
                        $this->session->set_flashdata('message', 'Invaild Year selected!');

                        // $response['message'] = 'Invaild Year selected!';
                    }
                } else {
                    // $response['url'] = base_url('Dashboard/Activation/principle_stake');

                    // $response['success'] = 2;
                    $this->session->set_flashdata('message', 'Minimum Staking $100 & Mulitple Staking $100!');

                    $response['message'] = 'Minimum Staking $100 & Mulitple Staking $100!';
                }
            } else {
                // $response['url'] = base_url('Dashboard/Activation/principle_stake');

                // $response['success'] = 0;
                $this->session->set_flashdata('message', validation_errors());

                // $response['message'] = validation_errors();
            }
        } else {
            redirect('Dashboard/User/login');
        }
        // }else{
        //     $response['url'] = base_url('Dashboard/Activation/principle_stake');
        //     $response['success'] = 0;
        //     $this->session->set_flashdata('message','Do not hit with direct script!');

        //     $response['message'] = 'Do not hit with direct script!';
        // }
        // $response['token'] = $this->security->get_csrf_hash();
        // echo json_encode($response);
        // redirect('Dashboard/Activation/principle_stake');?
        // exit();
    }
}
