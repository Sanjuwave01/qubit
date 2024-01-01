<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email', 'Binance', 'pagination'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

    public function checkaddress($sender)
    {
        //$sender = $this->input->post("sender");
        $chk = 0;
        if (empty($sender)) {
            $chk = 2;
        } else {
            $chk = $this->User_model->get_single_record_status('tbl_users', array('eth_address' => $sender), 'user_id');
        }

        echo $chk;
        exit;
    }

    public function index()
    {

    if (is_logged_in()) {
            $date = date('Y-m-d H:i:s');
            $response['hub_rate'] = $this->User_model->get_single_record('tbl_admin', array('id' => 1), 'hub_rate,title');
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['stakeBusiness'] = $this->User_model->getStakeBusiness($this->session->userdata['user_id']);
            $response['totalStakeAmount'] = $this->User_model->get_single_record('tbl_stack_wallet', "user_id = '" . $this->session->userdata['user_id'] . "'", 'ifnull(sum(amount),0) as balance,ifnull(sum(maturity_amount),0) as balance2');
            $response['totalMurphyAmount'] = $this->User_model->get_single_record('tbl_roi', "user_id = '" . $this->session->userdata['user_id'] . "'", 'ifnull(sum(amount),0) as balance,ifnull(sum(coin),0) as balance2,ifnull(sum(package),0) as balance3');
            $response['stakeAmount'] = $this->User_model->get_single_record('tbl_stack_wallet', "user_id = '" . $this->session->userdata['user_id'] . "' ORDER BY id ASC limit 1", '*');
            $response['murphyAmount'] = $this->User_model->get_single_record('tbl_roi', "user_id = '" . $this->session->userdata['user_id'] . "' ORDER BY id ASC limit 1", '*');
            $response['transactions'] = $this->User_model->getLimitRecords('tbl_withdraw', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['roiRecords'] = $this->User_model->get_single_record('tbl_roi', array('user_id' => $this->session->userdata['user_id']), 'total_days');
            $response['token_value'] = $this->User_model->get_single_record('tbl_token_value', ['id' => 1], '*');
            $response['today_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and date(created_at) = date(now()) and amount > 0 and description != "Failed Bank Transaction"', 'ifnull(sum(amount),0) as today_income');
            $response['non_working_income'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as non_working_income');
            // $response['today_matching_bonus'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and type = "matching_bonus" and date(created_at) = date(now())', 'ifnull(sum(amount),0) as today_matching_bonus');
            /*incomes */
            $response['daily_minting_profit'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "roi_income"', 'ifnull(sum(amount),0) as daily_minting_profit');
            $response['level_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "level_income"', 'ifnull(sum(amount),0) as level_income');
            $response['level_minting_profit'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "level_minting_profit"', 'ifnull(sum(amount),0) as level_minting_profit');
            // $response['self_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and type = "self_income"', 'ifnull(sum(amount),0) as self_income');
            $response['royalty_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "royalty_income"', 'ifnull(sum(amount),0) as royalty_income');
            $response['passive_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "passive_income"', 'ifnull(sum(amount),0) as passive_income');

            // $response['level_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and type = "level_income"', 'ifnull(sum(amount),0) as level_income');
            // $response['matching_bonus'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and type = "matching_bonus"', 'ifnull(sum(amount),0) as matching_bonus');
            // $response['direct_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and type = "direct_income"', 'ifnull(sum(amount),0) as direct_income');
            // $response['gold_matrix_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and type = "gold_matrix_income"', 'ifnull(sum(amount),0) as gold_matrix_income');
            // $response['royal_matrix_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and type = "royal_matrix_income"', 'ifnull(sum(amount),0) as royal_matrix_income');
            // $response['crown_matrix_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and type = "crown_matrix_income"', 'ifnull(sum(amount),0) as crown_matrix_income');
            // $response['starter_matrix_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and type = "STARTER_MATRIX_INCOME"', 'ifnull(sum(amount),0) as STARTER_MATRIX_INCOME');
            // $response['star_matrix_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and type = "STAR_MATRIX_INCOME"', 'ifnull(sum(amount),0) as STAR_MATRIX_INCOME');
            //$response['incomeTransactions'] = $this->User_model->get_records('tbl_income_wallet',"user_id = '".$this->session->userdata['user_id']."' order by id desc limit 10", '*');
            /*incomes */
           // $response['withdraw_transactions'] = $this->User_model->get_single_records('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'].'"', 'ifnull(sum(amount),0) as withdraw_transactions');
            //echo "<pre>";
           // print_r($response);
           // exit;
            // stacking wallet Rewards
            $response['roi_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "roi_income"'.'and created_at > "2023-12-13 00:00:00"', 'ifnull(sum(amount),0) as roi_income');




            $response['without_roi_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as without_roi_income');
      

            // total earning income start
            $response['direct_income'] = $this->User_model->get_single_record('tbl_income_wallet', ['user_id' => $this->session->userdata['user_id'], 'type' => 'direct_income'], 'ifnull(sum(amount),0)as direct_income');
           
            $response['roi_incomes'] = $this->User_model->get_single_record('tbl_income_wallet', ['user_id' => $this->session->userdata['user_id'], 'type' => 'roi_income'], 'ifnull(sum(amount),0)as roi_incomes');

            $response['level_incomes'] = $this->User_model->get_single_record('tbl_income_wallet', ['user_id' => $this->session->userdata['user_id'], 'type' => 'level_income'], 'ifnull(sum(amount),0)as level_incomes');

            $response['booster_rewards_income'] = $this->User_model->get_single_record('tbl_income_wallet', ['user_id' => $this->session->userdata['user_id'], 'type' => 'booster_rewards_income'], 'ifnull(sum(amount),0)as booster_rewards_income');

            $response['reward_income'] = $this->User_model->get_single_record('tbl_income_wallet', ['user_id' => $this->session->userdata['user_id'], 'type' => 'reward_income'], 'ifnull(sum(amount),0)as reward_income');
       		
      		
          // $response['total_earning_income'] = $response['direct_income'] +$response['roi_incomes']+$response['level_incomes'] +$response['booster_rewards_income'] + $response['reward_income'];
            // total earing income end
           // echo "<pre>";
//print_r($response);
         // die;
           
             $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and amount > 0', 'ifnull(sum(amount),0) as total_income');

            // working wallet system with roi 06/12/2023
            $response['with_roi_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "roi_income"'.'and created_at <= "2023-12-13 00:00:00"', 'ifnull(sum(amount),0) as with_roi_income');
            $response['income_balance1'] = $this->User_model->get_single_record('tbl_income_wallet', ['user_id'=>$this->session->userdata['user_id'],'type'=>'direct_income'], 'ifnull(sum(amount),0) as income_balance1');
            $response['income_balance2'] = $this->User_model->get_single_record('tbl_income_wallet', ['user_id'=>$this->session->userdata['user_id'],'type'=>'level_income'], 'ifnull(sum(amount),0) as income_balance2');
            $response['income_balance3'] = $this->User_model->get_single_record('tbl_income_wallet', ['user_id'=>$this->session->userdata['user_id'],'type'=>'booster_rewards_income'], 'ifnull(sum(amount),0) as income_balance3');
     	//	$response['withdraw_transactions'] = $this->User_model->get_single_record('tbl_withdraw', ['user_id' => $this->session->userdata['user_id'],'status' => '1'] ,'ifnull(sum(coin),0) as withdraw_transactions');
            // working wallet system with roi 06/12/2023

            
           
            // $response['total_repurchase_income'] = $this->User_model->get_single_record('tbl_repurchase_income', 'user_id = "'.$this->session->userdata['user_id'].'"', 'ifnull(sum(amount),0) as total_repurchase_income');
            // $response['team'] = $this->User_model->get_single_record('tbl_downline_count', 'user_id = "'.$this->session->userdata['user_id'].'"', 'ifnull(count(id),0) as team');
            $response['paid_directs'] = $this->User_model->get_single_record('tbl_users', 'sponser_id = "' . $this->session->userdata['user_id'] . '" and paid_status = 1', 'ifnull(count(id),0) as paid_directs');
            $response['directBusiness'] = $this->User_model->get_single_record('tbl_users', 'sponser_id = "' . $this->session->userdata['user_id'] . '" and paid_status = 1', 'ifnull(sum(total_package),0) as directBusiness');

            $response['free_directs'] = $this->User_model->get_single_record('tbl_users', 'sponser_id = "' . $this->session->userdata['user_id'] . '"  and paid_status = 0', 'ifnull(count(id),0) as free_directs');
            // $response['requested_fund'] = $this->User_model->get_single_record('tbl_payment_request', 'user_id = "'.$this->session->userdata['user_id'].'" ', 'ifnull(sum(amount),0) as requested_fund');
            $response['wallet_balance'] = $this->User_model->get_single_record('tbl_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" ', 'ifnull(sum(amount),0) as wallet_balance');
            $response['coinBalance'] = $this->User_model->get_single_record('tbl_coin_wallet', ['user_id' => $this->session->userdata['user_id']], 'ifnull(sum(amount),0) as balance');
            $response['total_coin'] = $this->User_model->get_single_record('tbl_coin_wallet', ['user_id' => $this->session->userdata['user_id'], 'amount >' => 0], 'ifnull(sum(amount),0) as total_coin');
            $response['totalInstaStake'] = $this->User_model->get_single_record('tbl_coin_wallet', ['user_id' => $this->session->userdata['user_id'], 'type' => 'insta_stake'], 'ifnull(sum(amount),0) as balance,ifnull(sum(package),0) as balance2');
            //$response['token_wallet'] = $this->User_model->get_single_record('tbl_token_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" ', 'ifnull(sum(amount),0) as token_wallet');
            //$response['shopping_wallet'] = $this->User_model->get_single_record('tbl_shopping_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" ', 'ifnull(sum(amount),0) as shopping_wallet');
            // $response['released_fund'] = $this->User_model->get_single_record('tbl_payment_request', 'user_id = "'.$this->session->userdata['user_id'].'" and status = 1', 'ifnull(sum(amount),0) as released_fund');
            //$response['total_withdrawal'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and type="bank_transfer" and description != "Failed Bank Transaction"', 'ifnull(sum(amount),0) as total_withdrawal');
      
      
       
           // new working income wallet start
            $response['withdraw_transactions'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'].'"', 'ifnull(sum(amount),0) as withdraw_transactions');
           $response['reward_balance'] = $this->User_model->get_single_record('rewards_withdrawal', ['user_id'=>$this->session->userdata['user_id'], 'status' => '1'], 'ifnull(sum(amount),0) as reward_balance');
            
            // end working income wallet end
      
      
      
      
      
      
      
      
      
            $response['total_withdrawal'] = $this->User_model->get_single_record('tbl_withdraw', ['user_id' => $this->session->userdata['user_id'], 'status' => 1], 'ifnull(sum(amount),0) as balance');
            // $response['team_business'] = $this->User_model->get_single_record('tbl_downline_business', 'user_id = "'.$this->session->userdata['user_id'].'"', 'ifnull(sum(business),0) as team_business');
            $package = $this->User_model->get_single_record('tbl_package', 'id = "' . $response['user']['package_id'] . '"', '*');
            // if($response['user']['package_id'] > 0){
            //     $response['pool1'] = $this->User_model->get_single_record($package['products'], 'user_id = "'.$response['user']['user_id'].'"', '*');
            // }
            //pr($response,true);
            $response['pool2'] = $this->User_model->get_single_record('tbl_pool2', 'user_id = "' . $response['user']['user_id'] . '"', '*');
            $response['pool3'] = $this->User_model->get_single_record('tbl_pool3', 'user_id = "' . $response['user']['user_id'] . '"', '*');
            // $response['directs'] = $this->User_model->get_records('tbl_users', 'sponser_id = "'.$response['user']['user_id'].'"', 'id,user_id,name,first_name,last_name,phone,paid_status,created_at');
            $response['news'] = $this->User_model->get_records('tbl_news', array(), '*');
            // $response['matrix_packages'] = $this->User_model->get_matrix_pacakges();
            // foreach($response['matrix_packages'] as $k => $pack){
            //     $response['matrix_packages'][$k]['pool1'] = $this->User_model->get_single_record('tbl_matrix_pool',['user_id' => $response['user']['user_id'],'pool_level' => $pack['id']], '*');
            //     $response['matrix_packages'][$k]['pool2'] = $this->User_model->get_single_record('tbl_next_matrix_pool',['user_id' => $response['user']['user_id'],'pool_level' => $pack['id']], '*');
            //     if(empty($response['matrix_packages'][$k]['pool1'])){
            //         unset($response['matrix_packages'][$k]);
            //     }
            // }
            $response['club1'] = $this->User_model->get_records('tbl_pool', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['club2'] = $this->User_model->get_single_record('tbl_pool2', array('user_id' => $this->session->userdata['user_id'], 'org ' => 1), '*');
            $response['club3'] = $this->User_model->get_single_record('tbl_pool3', array('user_id' => $this->session->userdata['user_id'], 'org ' => 1), '*');
            $response['club4'] = $this->User_model->get_single_record('tbl_pool4', array('user_id' => $this->session->userdata['user_id'], 'org ' => 1), '*');
            // $response['roi_records'] = $this->User_model->get_limit_records('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and type = "roi_bonus"', '*',5,0);
            //    pr($response,true);
            $response['team_unpaid'] = $this->User_model->calculate_team($this->session->userdata['user_id'], 0);
            $response['team_paid'] = $this->User_model->calculate_team($this->session->userdata['user_id'], 1);
            $response['popup'] = $this->User_model->get_single_record1('tbl_user_popup', '*');
            $response['teamBusiness'] = $this->User_model->getBusiness($this->session->userdata['user_id']);
            $response['TodayteamBusiness'] = $this->User_model->getBusiness2($this->session->userdata['user_id'], $date);
            $response['directTeam'] = $this->User_model->get_single_record('tbl_users', ['sponser_id' => $this->session->userdata['user_id']], 'count(id) as directTeam');
            $response['investment_amount'] = $this->User_model->calculate_mpy_business($this->session->userdata['user_id']);    
            $response['TodayBusiness']=$this->User_model->getTodayBusiness($this->session->userdata['user_id'],$date);
            $response['MonthBusiness']=$this->User_model->getMonthsBusiness($this->session->userdata['user_id'],$date);

            //$this->load->view('header', $response);
            $response['legBusiness'] = $this->businessCalculationReward();
            $response['Businessleg'] = $this->businessCalculation();
            $response['booster_reward'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and date(created_at) = date(now()) and type = "booster_rewards_income"', 'ifnull(sum(amount),0) as today_income');
      $response['topup_date'] = $this->User_model->get_single_record('tbl_roi', array('user_id' =>$this->session->userdata['user_id'] ), '*');

        //    echo "<pre>";
        //    print_r($response);
        //    die;

            $this->load->view('index', $response);
            // $this->load->view('footer', $response);
        } else {
            redirect('Dashboard/User/login');
        }


    }

  
  public function offset_wallet(){
        if (is_logged_in()) {
            $response['roi_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "roi_income"'.'and created_at >= "2023-12-13 00:00:00"', 'ifnull(sum(amount),0) as roi_income');
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                  $data = $this->security->xss_clean($this->input->post());
                    $offset_per = $data['amount']*10/100;
                    $toteltransfer_offset = $data['amount'] - $offset_per;
                   $Userdata['offset_wallet'] = $user['offset_wallet'] + $data['amount'];
                   $Userdata['offset_wallet_per'] = $user['offset_wallet_per'] + $toteltransfer_offset;
                //    print_r($Userdata);
                //    die();
                   $updres = $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), $Userdata);
                   $sendWallet = array(
                    'user_id' => $this->session->userdata['user_id'],
                    'from' => 'staking_wallet',
                    'to' => 'offset_wallet',
                    'transfer_amount' => $data['amount'],
                    'created_at' => date('y-m-d H:i:sa'),
                     );
                $this->User_model->add('offset_history', $sendWallet);
                   if (!empty($updres)) {

                    $this->session->set_flashdata('message', 'Details Updated Successfully');

                    redirect('Dashboard/User/offset_wallet');
                } else {

                    $this->session->set_flashdata('message', 'Please contact to the admin for more changes.');

                    redirect('Dashboard/User/offset_wallet');
                }
                   
                // print_r('hi everyone!');
                // die();
            }
            $this->load->view('offset',$response);
        }else{
            redirect('Dashboard/User/login'); 
        }

    }
  
  

    private function businessCalculationReward()
    {
        // $users = $this->Main_model->get_records('tbl_users',['paid_status >' => 0],'*');
        // foreach($users as $key => $user){
        $getDirects = $this->User_model->get_records('tbl_users', ['sponser_id' => $this->session->userdata['user_id']], 'user_id');
        $directArr = [];
        foreach ($getDirects as $key2 => $gd) {
            $selfBusiness = $this->User_model->get_single_record('tbl_users', ['user_id' => $gd['user_id']], 'total_package');
            $getBusiness = $this->User_model->getTeamBusiness($gd['user_id']);
            $directArr[$key2] = [
                'user_id' => $gd['user_id'],
                'business' => $getBusiness['business'] + $selfBusiness['total_package'],
            ];
        }
        $columns = array_column($directArr, 'business');
        array_multisort($columns, SORT_DESC, $directArr);
        //pr($directArr,true);
        $teamA = 0;
        $teamB = 0;
        $i = 1;
        $secondLeg = 0;
        $thirdLeg = 0;
        $fourthLeg = 0;
        foreach ($directArr as $dkey => $da) {
            if ($dkey == 0) {
                $teamA = $da['business'];
            } else {
                $teamB += $da['business'];
            }
        }

        return $response = [
            'user_id' => $this->session->userdata['user_id'],
            'firstLeg' => $teamA,
            'secondLeg' => $teamB,
        ];
        //}
    }

    public function businessCalculation()
    {
        // $users = $this->Main_model->get_records('tbl_users',['paid_status >' => 0],'*');
        // foreach($users as $key => $user){
        $getDirects = $this->User_model->get_records('tbl_users', ['sponser_id' => $this->session->userdata['user_id']], 'user_id');
        $directArr = [];
        foreach ($getDirects as $key2 => $gd) {
            $selfBusiness = $this->User_model->get_single_record('tbl_users', ['user_id' => $gd['user_id']], 'total_package');
            $getBusiness = $this->User_model->getTeamBusiness($gd['user_id']);
            $directArr[$key2] = [
                'user_id' => $gd['user_id'],
                'business' => $getBusiness['business'] + $selfBusiness['total_package'],
            ];
        }
        $columns = array_column($directArr, 'business');
        array_multisort($columns, SORT_DESC, $directArr);
        // pr($directArr,true);
        $teamA = 0;
        $teamB = 0;
        $teamC = 0;
        $teamAUserID = '';
        $teamBUserID = '';
        $teamCUserID = '';

        $i = 1;
        $secondLeg = 0;
        $thirdLeg = 0;
        $fourthLeg = 0;
        foreach ($directArr as $dkey => $da) {
            if ($dkey == 0) {
                $teamA = $da['business'];
                $teamAUserID = $da['user_id'];
            } elseif ($dkey == 1) {
                $teamB = $da['business'];
                $teamBUserID = $da['user_id'];
            } else {
                $teamC += $da['business'];
                $teamCUserID = $da['user_id'];
            }
        }

        return $response['business'] = [
            // 'user_id' => $this->session->userdata['user_id'],
            'firstLeg' => $teamA,
            'secondLeg' => $teamB,
            'otherleg' => $teamC,
            'teamAUserID' => $teamAUserID,
            'teamBUserID' => $teamBUserID,
            'teamCUserID' => $teamCUserID,

        ];
        //}
    }



    public function index2()
    {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['token_value'] = $this->User_model->get_single_record('tbl_token_value', [], '*');
            $response['today_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and date(created_at) = date(now()) and amount > 0', 'ifnull(sum(amount),0) as today_income');
            $response['today_matching_bonus'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "matching_bonus" and date(created_at) = date(now())', 'ifnull(sum(amount),0) as today_matching_bonus');
            /*incomes */
            $response['self_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "self_income"', 'ifnull(sum(amount),0) as self_income');
            $response['matching_bonus'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "matching_bonus"', 'ifnull(sum(amount),0) as matching_bonus');
            $response['royalty_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "royalty_income"', 'ifnull(sum(amount),0) as royalty_income');
            $response['direct_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "direct_income"', 'ifnull(sum(amount),0) as direct_income');
            $response['gold_matrix_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "gold_matrix_income"', 'ifnull(sum(amount),0) as gold_matrix_income');
            $response['royal_matrix_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "royal_matrix_income"', 'ifnull(sum(amount),0) as royal_matrix_income');
            $response['crown_matrix_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "crown_matrix_income"', 'ifnull(sum(amount),0) as crown_matrix_income');
            $response['fix_deposit'] = $this->User_model->get_single_record('tbl_fix_deposit', 'user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as fix_deposit');
            /*incomes */
            $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and amount > 0', 'ifnull(sum(amount),0) as total_income');

            $response['income_balance'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as income_balance');
            $response['total_repurchase_income'] = $this->User_model->get_single_record('tbl_repurchase_income', 'user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as total_repurchase_income');
            $response['team'] = $this->User_model->get_single_record('tbl_downline_count', 'user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(count(id),0) as team');
            $response['paid_directs'] = $this->User_model->get_single_record('tbl_users', 'sponser_id = "' . $this->session->userdata['user_id'] . '" and paid_status = 1', 'ifnull(count(id),0) as paid_directs');
            $response['free_directs'] = $this->User_model->get_single_record('tbl_users', 'sponser_id = "' . $this->session->userdata['user_id'] . '"  and paid_status = 0', 'ifnull(count(id),0) as free_directs');
            $response['requested_fund'] = $this->User_model->get_single_record('tbl_payment_request', 'user_id = "' . $this->session->userdata['user_id'] . '" ', 'ifnull(sum(amount),0) as requested_fund');
            $response['wallet_balance'] = $this->User_model->get_single_record('tbl_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" ', 'ifnull(sum(amount),0) as wallet_balance');
            //$response['token_wallet'] = $this->User_model->get_single_record('tbl_token_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" ', 'ifnull(sum(amount),0) as token_wallet');
            //$response['shopping_wallet'] = $this->User_model->get_single_record('tbl_shopping_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" ', 'ifnull(sum(amount),0) as shopping_wallet');
            $response['released_fund'] = $this->User_model->get_single_record('tbl_payment_request', 'user_id = "' . $this->session->userdata['user_id'] . '" and status = 1', 'ifnull(sum(amount),0) as released_fund');
            $response['total_withdrawal'] = $this->User_model->get_single_record('tbl_withdraw', 'user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as total_withdrawal');
            $response['team_business'] = $this->User_model->get_single_record('tbl_downline_business', 'user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(business),0) as team_business');
            $response['package'] = $this->User_model->get_single_record('tbl_package', 'id = "' . $response['user']['package_id'] . '"', '*');
            $response['directs'] = $this->User_model->get_records('tbl_users', 'sponser_id = "' . $response['user']['user_id'] . '"', 'id,user_id,name,first_name,last_name,phone,paid_status,created_at');
            $response['news'] = $this->User_model->get_records('tbl_news', array(), '*');
            $response['roi_records'] = $this->User_model->get_limit_records('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "roi_bonus"', '*', 5, 0);
            // pr($response,true);
            $response['team_unpaid'] = $this->User_model->calculate_team($this->session->userdata['user_id'], 0);
            $response['team_paid'] = $this->User_model->calculate_team($this->session->userdata['user_id'], 1);
            $response['popup'] = $this->User_model->get_single_record1('tbl_user_popup', '*');
            $response['reward'] = $this->User_model->get_records('tbl_rewards', ['user_id' => $this->session->userdata['user_id']], '*');
            //$response['coins'] = $this->get_coin_prices();
            $get = $this->User_model->get_records('tbl_users', ['directs >=' => 10, 'user_id' => $this->session->userdata['user_id']], 'user_id');
            $data = array();
            foreach ($get as $key => $value) {
                $left = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $value['user_id'], 'position' => "L", 'paid_status >' => 0), 'count(id) as ids');
                if ($left['ids'] >= 5) {
                    $right = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $value['user_id'], 'position' => "R", 'paid_status >' => 0), 'count(id) as ids');
                    if ($right['ids'] >= 5) {
                        $data[] = $this->User_model->get_single_record('tbl_users', 'user_id = "' . $value['user_id'] . '"', 'user_id,leftPower,rightPower');
                    }
                }
            }

            $response['silver'] = $data;

            $get2 = $this->User_model->get_records('tbl_users', ['directs >=' => 20, 'user_id' => $this->session->userdata['user_id']], 'user_id');
            $data2 = array();
            foreach ($get2 as $key2 => $value2) {
                $left2 = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $value2['user_id'], 'position' => "L", 'paid_status >' => 0), 'count(id) as ids');
                if ($left2['ids'] >= 10) {
                    $right2 = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $value2['user_id'], 'position' => "R", 'paid_status >' => 0), 'count(id) as ids');
                    if ($right2['ids'] >= 10) {
                        $data2[] = $this->User_model->get_single_record('tbl_users', 'user_id = "' . $value2['user_id'] . '"', 'user_id,leftPower,rightPower');
                    }
                }
            }

            $response['gold'] = $data2;
            $response['global_matrix_income'] = [];

            $this->load->view('header', $response);
            $this->load->view('index2', $response);
            // $this->load->view('footer', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function Referral()
    {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['today_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = ' . $this->session->userdata['user_id'] . ' and date(created_at) = date(now()', 'ifnull(sum(amount),0) as today_income');
            $response['task_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = ' . $this->session->userdata['user_id'] . ' and type = "task_income"', 'ifnull(sum(amount),0) as task_income');
            $response['direct_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = ' . $this->session->userdata['user_id'] . ' and type = "direct_income"', 'ifnull(sum(amount),0) as direct_income');
            $this->load->view('header', $response);
            $this->load->view('refferal', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function sample()
    {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('header', $response);
            $this->load->view('index', $response);
            $this->load->view('footer', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function login()
    {
        redirect('Dashboard/User/MainLogin');
    }

    public function MainLoginAjax()
    {
        $response['message'] = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());

            $user = $this->User_model->get_single_record('tbl_users', array('eth_address' => $data['wallet_address']), 'id,user_id,role,name,email,paid_status,disabled');

            if (!empty($user)) {
                echo json_encode(array(
                    'csrf_token' => $this->security->get_csrf_hash(),
                    'userdata' => json_encode($user),
                    'status' => 'success',
                    'redirect' => base_url() . 'Dashboard/User/'
                ));
                $this->session->set_userdata('user_id', $user['user_id']);
                $this->session->set_userdata('role', $user['role']);
                //  redirect('Dashboard/User/');

            } else {
                echo json_encode(array(
                    'csrf_token' => $this->security->get_csrf_hash(),
                    'message' => 'Invalid Credentials',
                    'status' => 'fail'
                ));
            }
        }
    }



    public function MainLogin()
    {
        $response['message'] = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id'], 'password' => $data['password']), 'id,user_id,role,name,email,paid_status,disabled,otp,email_verified');
            if (!empty($user)) {
                // if($user['email_verified'] == '1'){
                if ($user['disabled'] == 0) {
                    // if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
                    //     $secretKey = '6LdqcLIeAAAAADLjv6RuCfoFwc-xWHCtq10yfBoP';
                    //     $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']);
                    //         $responseData = json_decode($verifyResponse);
                    //         if($responseData){
                    $this->session->set_userdata('user_id', $user['user_id']);
                    $this->session->set_userdata('role', $user['role']);
                    redirect('Dashboard/User/');
                    //     }else{
                    //         $response['message'] = 'Robot verification failed, please try again.';
                    //     }
                    // }else{
                    //     $response['message'] = 'Please check on the reCAPTCHA box.';
                    // }
                } else {
                    $response['message'] = 'This Account Is Blocked Please Contact to Administrator';
                }
                // } else {

                // sendOTP($user);
                // $response['message'] = 'Please check your email to verify your email for next process, ';
                // redirect(base_url().'Dashboard/Register/veryfiedOTP?user_id='.$user['id']);

                // }
            } else {
                $response['message'] = 'Invalid Credentials';
            }
        }
        $this->load->view('main_login', $response);
    }

    public function Success()
    {
        $response['message'] = 'Now You Can Login with <br>User ID :kkk <br> Password :`1234';
        $this->load->view('success', $response);
    }



    public function emailtest()
    {
        $email = 'manishgni20@gmail.com';
        $sms_text = 'Dear manish, Your Account Successfully created. <br>User ID :  Admin<br> Password :admin12 <br> Transaction Password:12346';
        composeMail($email, 'test', 'Reister', $sms_text, $display = false);
        //sendMail($sms_text,$email);
        // notify_mail($email,$sms_text,'Yahoo');
        echo 'Mail Sent';
    }

    public function testsuccss()
    {
        $userData['name'] = 'manishgni20';
        $userData['user_id'] = 'manishgni20';
        $userData['password'] = 'manishgni20';
        $userData['master_key'] = 'manishgni20';

        $response['message'] = 'Dear ' . $userData['name'] . ', Your Account Successfully created. <br>User ID :  ' . $userData['user_id'] . ' <br> Password :' . $userData['password'] . ' <br> Transaction Password:' . $userData['master_key'];

        $this->load->view('success', $response);
    }


    public function getMailOtp()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $email = trim(addslashes($_POST['email']));
                if (!empty($email)) {
                    $email2 = $this->User_model->get_single_record('tbl_users', array('email' => $email), '*');
                    if (empty($email2)) {
                        $_SESSION['verification_otp_email'] = rand(100000, 999999);
                        $this->session->mark_as_temp('verification_otp_email', 300);

                        // $curl = curl_init();
                        // curl_setopt_array($curl, array(
                        //   CURLOPT_URL => 'https://api.mailjet.com/v3.1/send',
                        //   CURLOPT_RETURNTRANSFER => true,
                        //   CURLOPT_ENCODING => '',
                        //   CURLOPT_MAXREDIRS => 10,
                        //   CURLOPT_TIMEOUT => 0,
                        //   CURLOPT_FOLLOWLOCATION => true,
                        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        //   CURLOPT_CUSTOMREQUEST => 'POST',
                        //   CURLOPT_POSTFIELDS =>'{
                        //     "Messages": [
                        //         {
                        //             "From": {
                        //                 "Email": "zilgrowoffical@gmail.com",
                        //                 "Name": "Zil Grow"
                        //             },
                        //             "To": [
                        //                 {
                        //                     "Email": "'.$email.'",
                        //                     "Name": "Zil Grow"
                        //                 }
                        //             ],
                        //             "Subject": "Registration OTP!",
                        //             "TextPart": "Registration OTP!",
                        //             "HTMLPart": "<center><img style=\'max-width:200px;\' src=\'https://zilgrow.io/uploads/logo.png\' alt=\'logo\'><br><h3>High Security OTP to complete your transaction.</h3><br><h2>'.$_SESSION['verification_otp'].'</h2><br><br><b>Never Share OTP with anyone for Registration https://zilgrow.io. Your browser will also display a padlock icon to let you know a site is secure.</b></center>"
                        //         }
                        //     ]
                        // }',
                        //   CURLOPT_HTTPHEADER => array(
                        //     'Content-Type: application/json',
                        //     'Username: 06f439fdaa3510ca9a6f5da1e8194ff9',
                        //     'Password: 4ad4be043b382f9623d36df32bd76b6a',
                        //     'Authorization: Basic MDZmNDM5ZmRhYTM1MTBjYTlhNmY1ZGExZTgxOTRmZjk6NGFkNGJlMDQzYjM4MmY5NjIzZDM2ZGYzMmJkNzZiNmE='
                        //   ),
                        // ));

                        // $response = curl_exec($curl);

                        // curl_close($curl);
                        // $data2 = json_decode($response);
                        // $status = ($data2->Messages[0]->Status);
                        // if(!empty($status)){
                        //     if($status == 'error'){
                        //         $errors = ($data2->Messages[0]->Errors);
                        //         $data['success'] = 0;
                        //         $data['message'] = $errors[0]->ErrorMessage;
                        //     }else{
                        // $headers = "MIME-Version: 1.0" . "\r\n";
                        // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        // $headers .= 'From: '.$email. "\r\n";
                        $message = 'Verify Your Email
                                    Thank you for choosing Ricaverse!
                                    Verification Code : ' . $_SESSION['verification_otp_email'] . '
                                    Yours sincerely
                                    Ricaverse Team
                                    Please do not reply directly to this system-generated email.';
                        // mail('jaydhundhara@gmail.com','Registration OTP',$message,$headers);
                        $result = send_crypto_email2($email, 'Email Verify', $message);

                        $data['success'] = 1;
                        $data['message'] = 'Verification OTP send on Email!';

                        //     }
                        // }
                    } else {
                        $data['success'] = 0;
                        $data['message'] = 'This email is already registered!';
                    }
                } else {
                    $data['success'] = 0;
                    $data['message'] = 'Please enter email and confirm email!';
                }
            }
        }
        $data['token'] = $this->security->get_csrf_hash();;
        echo json_encode($data);
    }


    function add_counts($user_name = 'DW56497', $downline_id = 'DW56497', $level)
    {
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
    public function user_downline()
    {
        die;
        $users = $this->User_model->get_records('tbl_users', [], 'id,user_id,upline_id,sponser_id');
        foreach ($users as $key => $user) {

            $this->update_count($user['user_id'], $user['user_id'], 1);
        }
    }
    public function update_count($user_name, $downline_id, $level)
    {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
        if (!empty($user)) {
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
                $this->update_count($user_name, $downline_id, $level + 1);
            }
        }
    }


    public function logout()
    {
        $this->session->unset_userdata(array('user_id', 'role'));
        redirect('Dashboard/User/login');
    }

    public function Profile()
    {
        if (is_logged_in()) {
            $response = array();
            // $response['active_tab'] = 'profile';
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $response['csrfName'] = $this->security->get_csrf_token_name();
                $response['csrfHash'] = $this->security->get_csrf_hash();
                $response['success'] = 0;
                $data = $this->security->xss_clean($this->input->post());
                $userDetail = $this->User_model->get_single_record('tbl_users', ['user_id' => $this->session->userdata['user_id']], 'paid_status');
                if ($userDetail['paid_status'] == 0) {
                    // $Userdata['name'] = $data['name'];
                    // $Userdata['last_name'] = $data['last_name'];
                    // $Userdata['address'] = $data['address'];
                    // $Userdata['postal_code'] = $data['postal_code'];
                    //$Userdata['phone'] = $data['phone'];
                    $get = $this->User_model->get_single_record('tbl_users', ['user_id' => $this->session->userdata['user_id']], 'city, email');
                    if (empty($get['city'])) {
                        $Userdata['city'] = $data['city'];
                        $updres = $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), $Userdata);
                    }
                    if (empty($get['email'])) {
                        $Userdata['email'] = $data['email'];
                        $updres = $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), $Userdata);
                    }

                    if (!empty($updres)) {
                        $this->session->set_flashdata('message', 'Details Updated Successfully');
                        $response['message'] = 'Details Updated Successfully';
                        $response['success'] = 1;
                    } else {
                        $this->session->set_flashdata('message', 'Please contact to the admin for more changes.');
                        $response['message'] = 'Please contact to the admin for more changes.';
                        // redirect('Dashboard/User/Profile');
                    }
                } else {
                    $this->session->set_flashdata('message', 'For Profile Update Please contact Admin');
                    $response['message'] = 'For Profile Update Please contact Admin';
                }
                echo json_encode($response);
                exit();
            }
            $userinfo = userinfo();
            $countries = $this->User_model->get_records('countries', array(), '*');
            $response['upline'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $userinfo->upline_id), 'name,first_name,last_name,phone,email');
            $response['user_bank'] = (object) $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
            // $response['stateArr'] = $this->User_model->get_records('states', array('country_id' => $userinfo->country), '*');
            // if (empty($userinfo->state)) {
            //     $state_id = $response['stateArr'][0]['id'];
            // } else {
            //     $state_id = $userinfo->state;
            // }
            //            pr($userinfo, true);
            // $response['cityArr'] = $this->User_model->get_records('cities', array('state_id' => $state_id), '*');
            // $countryN = array();
            // $response['message'] = '';
            // foreach ($countries as $key => $country)
            //     $countryN[$country['id']] = $country['name'];
            // $response['countries'] = $countryN;
            //            pr($response);
            $this->load->view('profile_update', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function bankProfile()
    {
        if (is_logged_in()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                //pr($data);
                $Userdata['btc'] = $data['btc'];
                $Userdata['tron'] = $data['tron'];
                $Userdata['ethereum'] = $data['ethereum'];
                $Userdata['litecoin'] = $data['litecoin'];
                $userInfo = $this->User_model->get_single_record('tbl_users', ['user_id' => $this->session->userdata['user_id']], 'paid_status');
                if ($userInfo['paid_status'] == 0) {
                    // $Userdata = [
                    //     'bank_name' => $data['bank_name'],
                    //     'account_holder_name' => $data['account_holder_name'],
                    //     'bank_account_number' => $data['bank_account_number'],
                    //     'ifsc_code' => $data['ifsc_code'],
                    //     'aadhar' => $data['aadhar'],
                    //     'pan' => $data['pan'],
                    // ];
                    $updres = $this->User_model->update('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), $Userdata);
                    if ($updres == true) {
                        $this->session->set_flashdata('message', 'Details Updated Successfully');
                        redirect('Dashboard/User/Profile');
                    } else {
                        $this->session->set_flashdata('message', 'There is an error while updating profile details Please try Again ..');
                        redirect('Dashboard/User/Profile');
                    }
                } else {
                    $response['message'] = 'For Profile Update Please contact Admin';
                }
            }
            redirect('Dashboard/User/Profile');
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function password_reset()
    {
        if (is_logged_in()) {
            $response = array();
            $response['csrfName'] = $this->security->get_csrf_token_name();
            $response['csrfHash'] = $this->security->get_csrf_hash();
            $response['success'] = 0;
            $data = $this->security->xss_clean($this->input->post());
            $cpassword = $data['cpassword'];
            $npassword = $data['npassword'];
            $vpassword = $data['vpassword'];
            $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,password');
            if ($npassword !== $vpassword) {
                $response['message'] = 'Verify Password Doed Not Match';
            } elseif ($cpassword !== $user['password']) {
                $response['message'] = 'Wrong Current Password';
            } else {
                $updres = $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), array('password' => $vpassword));
                if ($updres == true) {
                    $response['message'] = 'Password Updated Successfully';
                    $response['success'] = 1;
                } else {
                    $response['message'] = 'There is an error while Changing Password Please Try Again';
                }
            }
            echo json_encode($response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function btc_update()
    {
        if (is_logged_in()) {
            $response = array();
            $response['csrfName'] = $this->security->get_csrf_token_name();
            $response['csrfHash'] = $this->security->get_csrf_hash();
            $response['success'] = 0;
            $data = $this->security->xss_clean($this->input->post());
            $btc = $data['btc'];
            $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,password');
            // if ($npassword !== $vpassword) {
            //     $response['message'] = 'Verify Password Doed Not Match';
            // } elseif ($cpassword !== $user['password']) {
            //     $response['message'] = 'Wrong Current Password';
            // } else {
            $updres = $this->User_model->update('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), array('btc' => $btc));
            if ($updres == true) {
                $response['message'] = 'BTC Address Updated Successfully';
                $response['success'] = 1;
            } else {
                $response['message'] = 'There is an error while Updating BTC Address Please Try Again';
            }
            // }
            echo json_encode($response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function trans_password()
    {
        if (is_logged_in()) {
            $response = array();
            $response['csrfName'] = $this->security->get_csrf_token_name();
            $response['csrfHash'] = $this->security->get_csrf_hash();
            $response['success'] = 0;
            $data = $this->security->xss_clean($this->input->post());
            $cpassword = $data['cpassword'];
            $npassword = $data['npassword'];
            $vpassword = $data['vpassword'];
            $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,master_key');
            if ($npassword !== $vpassword) {
                $response['message'] = 'Verify Password Doed Not Match';
            } elseif ($cpassword !== $user['master_key']) {
                $response['message'] = 'Wrong Current Password';
            } else {
                $updres = $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), array('master_key' => $vpassword));
                if ($updres == true) {
                    $response['message'] = 'Password Updated Successfully';
                    $response['success'] = 1;
                } else {
                    $response['message'] = 'There is an error while Changing Password Please Try Again';
                }
            }
            echo json_encode($response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function id_card()
    {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('id_card', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function allincome()
    {
        $this->load->view('allincome');
    }
    public function BankDetails()
    {
        if (is_logged_in()) {
            $response = array();
            $response = array();
            $response['csrfName'] = $this->security->get_csrf_token_name();
            $response['csrfHash'] = $this->security->get_csrf_hash();
            $response['success'] = 0;
            // if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $data = html_escape($data);
            $this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('bank_account_number', 'Bank Account Number', 'trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('ifsc_code', 'Ifsc Code', 'trim|required|xss_clean');
            if ($this->form_validation->run() != FALSE) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
                $config['max_size'] = 100000;
                $config['file_name'] = 'payment_slip1' . time();
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('userfile')) {
                    // $this->session->set_flashdata('error', $this->upload->display_errors());
                    $response['message'] = $this->upload->display_errors();
                } else {
                    $fileData = array('upload_data' => $this->upload->data());
                    $userData['passbook_image'] = $fileData['upload_data']['file_name'];
                    $userData['account_type'] = $data['account_type'];
                    $userData['bank_account_number'] = $data['bank_account_number'];
                    $userData['bank_name'] = $data['bank_name'];
                    $userData['account_holder_name'] = $data['account_holder_name'];
                    $userData['ifsc_code'] = $data['ifsc_code'];
                    $userData['pan'] = $data['pan'];
                    $userData['kyc_status'] = 1;
                    $updres = $this->User_model->update('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), $userData);
                    if ($updres == true) {
                        // $this->session->set_flashdata('error', 'Details Updated Successfully');
                        $response['message'] = 'Details Updated Successfully';
                        $response['success'] = 1;
                    } else {
                        // $this->session->set_flashdata('error', 'There is an error while updating Bank details Please try Again ..');
                        $response['message'] = 'Validation Failed 2';
                    }
                }
            } else {
                // $this->session->set_flashdata('error', 'Validation Failed');
                $response['message'] = 'Validation Failed';
            }
            // }
            echo json_encode($response);
            // $response['user_bank'] = (object) $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
            // $this->load->view('bank_details', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function UploadProof()
    {
        if (is_logged_in()) {
            $response = array();
            $response['csrfName'] = $this->security->get_csrf_token_name();
            $response['csrfHash'] = $this->security->get_csrf_hash();

            if (!empty($_FILES['userfile'])) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
                $config['max_size'] = 100000;
                $config['file_name'] = 'id_proof' . time();
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('userfile')) {
                    $response['message'] = $this->upload->display_errors();
                    // $this->session->set_flashdata('error', $this->upload->display_errors());
                    $response['success'] = '0';
                } else {
                    $type = $this->input->post('proof_type');
                    $fileData = array('upload_data' => $this->upload->data());
                    $userData[$type] = $fileData['upload_data']['file_name'];
                    $updres = $this->User_model->update('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), $userData);
                    if ($updres == true) {
                        $response['success'] = '1';
                        $response['image'] = base_url('uploads/') . $fileData['upload_data']['file_name'];
                        $response['message'] = 'Proof Uploaded Successfully';
                    } else {
                        $response['success'] = '0';
                        $response['message'] = 'There is an error while updating Bank details Please try Again ..';
                    }
                }
            } else {
                $response['message'] = 'There is an error while updating Bank details Proof Please try Again ..';
                $response['success'] = '0';
            }
            echo json_encode($response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function PlaceParticipants()
    {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Place Participants';
            $response['users'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $this->session->userdata['user_id'], 'is_placed' => 0), 'id,user_id,sponser_id,role,name,email,phone,upline_id,created_at');
            $this->load->view('place_participants', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function Directs()
    {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Direct Participants';
            $response['users'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $this->session->userdata['user_id']), 'id,user_id,sponser_id,role,name,last_name,email,paid_status,phone,upline_id,created_at,topup_date,package_amount,position');
            foreach ($response['users'] as $key => $user) {
                $response['users'][$key]['userinfo'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['user_id']), '*');
            }
            $this->load->view('directs', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function Downline($position = '')
    {
        if (is_logged_in()) {
            $response = array();
            $where['user_id'] = $this->session->userdata['user_id'];
            if ($position != '') {
                $where['position'] = $position;
                if ($position == 'L')
                    $response['header'] = 'Left Downline Participants';
                else
                    $response['header'] = 'Right Downline Participants';
            } else {
                $response['header'] = 'Downline Participants';
            }

            $response['users'] = $this->User_model->get_records('tbl_downline_count', $where, 'id,downline_id,level');
            foreach ($response['users'] as $key => $user) {
                $response['users'][$key]['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['downline_id']), 'id,user_id,sponser_id,role,name,email,phone,position,package_amount,paid_status,upline_id,created_at');
            }
            $this->load->view('downline', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function income($type)
    {
        if (is_logged_in()) {
            $response = array();
            if ($type == 'self_income') {
                $table = 'tbl_coin_wallet';
            } else {
                $table = 'tbl_income_wallet';
            }
            $response['header'] = get_income_name($type); //ucwords(str_replace('_', ' ', $type));
            $response['total_income'] = $this->User_model->get_single_record($table, array('user_id' => $this->session->userdata['user_id'], 'type' => $type), 'ifnull(sum(amount),0) as total_income');
            $response['user_incomes'] = $this->User_model->get_records($table, array('user_id' => $this->session->userdata['user_id'], 'type' => $type), 'id,user_id,amount,type,description,created_at');
            $this->load->view('incomes', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function RewardsStatus()
    {
        echo 'hiii';
        die;
        if (is_logged_in()) {
            $response = array();
            $rewards = array(
                1 => array('matching' => '2000', 'bonus' => '100', 'rank' => '', 'status' => 1),
                2 => array('matching' => '6000', 'bonus' => '200', 'rank' => '', 'status' => 1),
                3 => array('matching' => '16000', 'bonus' => '500', 'rank' => '', 'status' => 1),
                4 => array('matching' => '36000', 'bonus' => '1000', 'rank' => '', 'status' => 1),
                5 => array('matching' => '86000', 'bonus' => '2000', 'rank' => '', 'status' => 1),
                6 => array('matching' => '186000', 'bonus' => '6000', 'rank' => '', 'status' => 1),
                7 => array('matching' => '386000', 'bonus' => '20000', 'rank' => '', 'status' => 1),
            );
            $response['rewards_income'] = $this->User_model->get_records('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => 'rewards_income'), '*');
            $response['rewards'] = $rewards;
            $this->load->view('rewards_status', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function Magicincome($type)
    {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Magic ' . ucwords(str_replace('_', ' ', $type));
            $response['user_incomes'] = $this->User_model->get_records('tbl_repurchase_income', array('user_id' => $this->session->userdata['user_id'], 'type' => $type), 'id,user_id,amount,type,description,created_at');
            $this->load->view('incomes', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function Magicincome_ledgar()
    {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Magic Income Ledgar';
            $response['total_income'] = $this->User_model->get_single_record('tbl_repurchase_income', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as total_income');
            $response['user_incomes'] = $this->User_model->get_records('tbl_repurchase_income', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,amount,type,description,created_at');
            $this->load->view('incomes', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function income_ledgar()
    {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Income Ledgar';
            $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as total_income');
            $response['user_incomes'] = $this->User_model->get_records('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,amount,type,description,created_at');
            $this->load->view('incomes', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function purchase_history()
    {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Shopping History';
            $response['orders'] = $this->User_model->get_records('tbl_orders', array('user_id' => $this->session->userdata['user_id']), '*');
            $i = 0;
            $this->load->view('purchase_history', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function Tree($user_id)
    {

        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
            $response['users'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $user_id), '*');

            // echo "<pre>";
            // print_r($response['users']);
            // die;

            foreach ($response['users'] as $key => $directs) {
                $response['users'][$key]['sub_directs'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $directs['user_id']), '*');
            }
            $this->load->view('tree', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
  
  public function rankachiever(){
        if (is_logged_in()) {
            $response = array();
            
            //$response['users'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $this->session->userdata['user_id']), '*');

            $response['users'] = $this->User_model->get_records('tbl_sponser_count',['user_id' => $this->session->userdata['user_id']],'*');

            foreach ($response['users'] as $key => $directs) {
                $response['users'][$key]['userinfo'] = $this->User_model->get_single_record('tbl_users',['user_id' => $directs['downline_id']],'*');
            }
            //echo "<pre>";
           // print_r($response);
            //exit;
           
            $this->load->view('rankachiever', $response);
        } else {
            redirect('Dashboard/User/login');
        } 
    }


    public function GenelogyTree($user_id = '')
    {
        if (is_logged_in()) {
            $validate_user = 0;
            $response = array();
            if ($user_id == '') {
                $user_id = $this->input->get('user_id');
            }
            $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id');
            if (!empty($user)) {
                if ($user_id == $this->session->userdata['user_id']) {
                    $validate_user = 1;
                } else {
                    $down_user = $this->User_model->get_single_record('tbl_downline_count', array('user_id' => $this->session->userdata['user_id'], 'downline_id' => $user_id), '*');
                    if (!empty($down_user)) {
                        $validate_user = 1;
                    }
                }
            } else {
                $validate_user = 0;
            }

            if ($validate_user == 1) {
                $response['validate_user'] = 1;
                $response['level1'] = $this->User_model->get_tree_user($user_id);
                if (!empty($response['level1'])) {
                    $response['level2'][1] = $this->User_model->get_tree_user($response['level1']->left_node);
                    $response['level2'][2] = $this->User_model->get_tree_user($response['level1']->right_node);
                    if (!empty($response['level2'][1]->left_node)) {
                        $response['level3'][1] = $this->User_model->get_tree_user($response['level2'][1]->left_node);
                        if (!empty($response['level3'][1]->left_node)) {
                            $response['level4'][1] = $this->User_model->get_tree_user($response['level3'][1]->left_node);
                        } else {
                            $response['level4'][1] = array();
                        }
                        if (!empty($response['level3'][1]->right_node)) {
                            $response['level4'][2] = $this->User_model->get_tree_user($response['level3'][1]->right_node);
                        } else {
                            $response['level4'][2] = array();
                        }
                    } else {
                        $response['level3'][1] = array();
                        $response['level4'][1] = array();
                        $response['level4'][2] = array();
                    }
                    if (!empty($response['level2'][1]->right_node)) {
                        $response['level3'][2] = $this->User_model->get_tree_user($response['level2'][1]->right_node);
                        if (!empty($response['level3'][2]->left_node)) {
                            $response['level4'][3] = $this->User_model->get_tree_user($response['level3'][2]->left_node);
                        } else {
                            $response['level4'][3] = array();
                        }
                        if (!empty($response['level3'][2]->right_node)) {
                            $response['level4'][4] = $this->User_model->get_tree_user($response['level3'][2]->right_node);
                        } else {
                            $response['level4'][4] = array();
                        }
                    } else {
                        $response['level3'][2] = array();
                        $response['level4'][3] = array();
                        $response['level4'][4] = array();
                    }
                    if (!empty($response['level2'][2]->left_node)) {
                        $response['level3'][3] = $this->User_model->get_tree_user($response['level2'][2]->left_node);
                        if (!empty($response['level3'][3]->left_node)) {
                            $response['level4'][5] = $this->User_model->get_tree_user($response['level3'][3]->left_node);
                        } else {
                            $response['level4'][5] = array();
                        }
                        if (!empty($response['level3'][3]->right_node)) {
                            $response['level4'][6] = $this->User_model->get_tree_user($response['level3'][3]->right_node);
                        } else {
                            $response['level4'][6] = array();
                        }
                    } else {
                        $response['level3'][3] = array();
                        $response['level4'][5] = array();
                        $response['level4'][6] = array();
                    }
                    if (!empty($response['level2'][2]->right_node)) {
                        $response['level3'][4] = $this->User_model->get_tree_user($response['level2'][2]->right_node);
                        if (!empty($response['level3'][4]->left_node)) {
                            $response['level4'][7] = $this->User_model->get_tree_user($response['level3'][4]->left_node);
                        } else {
                            $response['level4'][7] = array();
                        }
                        if (!empty($response['level3'][4]->right_node)) {
                            $response['level4'][8] = $this->User_model->get_tree_user($response['level3'][4]->right_node);
                        } else {
                            $response['level4'][8] = array();
                        }
                    } else {
                        $response['level3'][4] = array();
                        $response['level4'][7] = array();
                        $response['level4'][8] = array();
                    }
                } else {
                    $response['level1'] = [];
                }
                // $response['level2'][1]['placement'] = 0;
                // $response['level2'][2]['placement'] = 0;
                // $response['level3'][1]['placement'] = 0;
                // $response['level3'][4]['placement'] = 0;
                // $response['level4'][1]['placement'] = 0;
                // $response['level4'][8]['placement'] = 0;
                if (!empty($response['level2'][1])) {
                    if (!empty($response['level3'][1])) {
                        if (empty($response['level4'][1])) {
                            $response['level4'][1]['placement'] = 1;
                        }
                    } else {
                        $response['level3'][1]['placement'] = 1;
                    }
                } else {
                    $response['level2'][1]['placement'] = 1;
                }
                if (!empty($response['level2'][2])) {
                    if (!empty($response['level3'][4])) {
                        if (empty($response['level4'][8])) {
                            $response['level4'][8]['placement'] = 1;
                        }
                    } else {
                        $response['level3'][4]['placement'] = 1;
                    }
                } else {
                    $response['level2'][2]['placement'] = 1;
                }
            } else {
                $response['validate_user'] = 0;
            }

            // pr($response,true);
            $this->load->view('gonology-tree', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function Pool($user_id)
    {
        if (is_logged_in()) {
            $response = array();
            $response['pool_id'] = 1;
            $response['user'] = $this->User_model->get_single_record('tbl_pool', array('user_id' => $user_id), '*');
            $response['users'] = $this->User_model->get_records('tbl_pool', array('upline_id' => $user_id), '*');
            foreach ($response['users'] as $key => $directs) {
                $response['users'][$key]['user_info'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $directs['user_id']), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
                $response['users'][$key]['level_2'] = $this->User_model->get_records('tbl_pool', array('upline_id' => $directs['user_id']), '*');
            }
            //            pr($response,true);
            $this->load->view('pool', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function MatrixPool($user_id, $pool_id)
    {
        if (is_logged_in()) {
            $response = array();
            $response['pool_id'] = 1;
            $response['user'] = $this->User_model->get_single_record('tbl_matrix_pool', array('user_id' => $user_id, 'pool_level' => $pool_id), '*');
            $response['users'] = $this->User_model->get_records('tbl_matrix_pool', array('upline_id' => $user_id, 'pool_level' => $pool_id), '*');
            foreach ($response['users'] as $key => $directs) {
                $response['users'][$key]['user_info'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $directs['user_id']), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
                $response['users'][$key]['level_2'] = $this->User_model->get_records('tbl_matrix_pool', array('upline_id' => $directs['user_id'], 'pool_level' => $pool_id), '*');
            }
            //    pr($response,true);
            $this->load->view('pool', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function Genelogy()
    {
        if (is_logged_in()) {
            $response = array();
            //$response['directs'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $this->session->userdata['user_id']), 'id,user_id,name,sponser_id');
            $response['directs'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $this->session->userdata['user_id']), 'id,user_id,name,sponser_id');
            $this->load->view('genelogy', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function genelogy_users($user_id)
    {
        if (is_logged_in()) {
            $response = array();
            $response['directs'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $user_id), 'id,user_id,name,sponser_id');
            echo json_encode($response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function image_upload()
    {
        if (is_logged_in()) {
            $response = array();
            $data = $_POST['image'];
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);

            $data = base64_decode($data);
            $imageName = time() . '.png';
            file_put_contents(APPPATH . '../uploads/' . $imageName, $data);
            $updres = $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), array('image' => $imageName));
            $response['message'] = 'Image uploaed Succesffully';
            echo json_encode($response);
            exit();
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function get_states($country_id)
    {
        $countries = $this->User_model->get_records('states', array('country_id' => $country_id), '*');
        echo json_encode($countries);
    }

    public function get_city($state_id)
    {
        $countries = $this->User_model->get_records('cities', array('state_id' => $state_id), '*');
        echo json_encode($countries);
    }
    public function get_user($user_id = '')
    {
        $response = array();
        $response['success'] = 0;
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
        if (!empty($user)) {
            echo $user['name'];
        } else {
            echo 'User Not Found';
        }
    }

    public function test_rollup()
    {
        $this->rollup_personal_business($sponser_id = 'SG10008', $amount = '897', $share = 4, $sender_id = 'SG10015', 24);
    }

    public function credit_income($user_id, $amount, $type, $description)
    {
        $incomeArr = array(
            'user_id' => $user_id,
            'amount' => $amount,
            'type' => $type,
            'description' => $description,
        );
        $this->User_model->add('tbl_income_wallet', $incomeArr);
    }

    public function Validate_promo_code($code)
    {
        $res = array();
        $res['success'] = 0;
        $promo_code = $this->User_model->get_single_record('tbl_promo_codes', array('promo_code' => $code), '*');
        if (!empty($promo_code)) {
            $res['message'] = 'Promo Code Validated Now ' . $promo_code['discount'] . ' % Discount is Applied';
            $res['success'] = 1;
        } else {
            $res['message'] = 'Invalid Promo Code';
        }
        echo json_encode($res);
    }
    public function check_sponser($user_id)
    {
        $res = array();
        $res['success'] = 0;
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'id,user_id,name');
        if (!empty($user)) {
            $res['message'] = 'User Found';
            $res['user'] = $user;
            $res['success'] = 1;
        } else {
            $res['message'] = 'Invalid User ID';
        }
        echo json_encode($res);
    }

    public function send_email($email = '349kuldeep@gmail.com', $subject = "Security Alert", $message = 'hello i am here')
    {
        date_default_timezone_set('Asia/Singapore');
        $this->load->library('email');
        $this->email->from('info@dway.com', 'DwaySwotfish');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);

        $this->email->send();
    }
    public function addBalance()
    {
        if (is_logged_in()) {
            $response = array();
            $user_id = $this->session->userdata['user_id'];
            $response['data_retrieve'] = $this->User_model->get_single_record('btc_txn', array('user_id' => $user_id, 'status' => 0), 'count(id) as ids');
            if ($response['data_retrieve']['ids'] > 0) {
                header('Location: ' . base_url() . 'Dashboard/User/payBalance');
            }
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] >= 2) {
                    //                    pr($data,true);
                    if ($data['coin'] != 'BTC' || $data['coin'] != 'ETH' || $data['coin'] != 'LTC' || $data['coin'] != 'BCH') {
                        $get = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'name,email');
                        $address = $this->Test($orignal = 'USD', $data['coin'], $user_id, $get['name'], $data['amount'], $get['email']);
                        if ($address['error'] == 'ok') {
                            $save['user_id'] = $user_id;
                            $save['txn_id'] = $address['result']['txn_id'];
                            $save['orignal_amount'] = $data['amount'];
                            $save['amount'] = $address['result']['amount'];
                            $save['address'] = $address['result']['address'];
                            $save['timeout'] = $address['result']['timeout'];
                            $save['checkout_url'] = $address['result']['checkout_url'];
                            $save['status_url'] = $address['result']['status_url'];
                            $save['qrcode_url'] = $address['result']['qrcode_url'];
                            $save['coin'] = $data['coin'];
                            $this->User_model->add('btc_txn', $save);
                            header('Location: ' . base_url() . '/Dashboard/User/payBalance');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Coin Error');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Minimum Amount $25');
                }
            }
            $this->load->view('addBalance', $response);
        }
    }
    public function payment_repsponse($tax_id)
    {
        $payment = $this->User_model->get_single_record('btc_txn', array('txn_id' => $tax_id), 'user_id,coin,amount');
        $public_key = '6558f7dd0083c5493d87ced47b96a60d53b29fbe1e450a4c41b85a6d3f174c74';
        $private_key = '6dbACd8be6ade0ACDf622f1067275B2F8e0e76f8E1d9D93e0a4d3b00F437A2d0';
        $req['version'] = 1;
        $req['cmd'] = 'get_tx_info';
        $req['txid'] = $tax_id;
        $req['full'] = TRUE;
        $req['key'] = $public_key;
        $req['format'] = 'json'; //supported values are json and xml
        $post_data = http_build_query($req, '', '&');
        $hmac = hash_hmac('sha512', $post_data, $private_key);
        static $ch = NULL;
        if ($ch === NULL) {
            $ch = curl_init('https://www.coinpayments.net/api.php');
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $hmac));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $data = curl_exec($ch);
        $data2 = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
        pr($data2);
    }
    public function payBalance()
    {
        if (is_logged_in()) {
            $user_id = $this->session->userdata['user_id'];
            $response1['data_retrieve'] = $this->User_model->get_single_record('btc_txn', array('user_id' => $user_id, 'status' => 0), 'count(id) as ids');
            // pr($response1);
            if ($response1['data_retrieve']['ids'] == 0) {
                header('Location: ' . base_url() . 'Dashboard/User/addBalance');
            }
            $response['data_retrieve'] = $this->User_model->get_limit_records('btc_txn', array('user_id' => $user_id, 'status' => 0), '*', '1', '0');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['status'] == 3) {
                    $value['status'] = '3';
                    $updres = $this->User_model->update('btc_txn', array('user_id' => $user_id, 'status' => 0), $value);
                    header('Location: ' . base_url() . 'Dashboard/User/addBalance');
                }
            }
            $this->load->view('payBalance', $response);
        }
    }

    public function addBalanceHistory()
    {
        if (is_logged_in()) {
            $response = array();
            $response['requests'] = $this->User_model->get_records('btc_txn', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('addBalanceHistory', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function Test($currency1, $currency2, $user_id, $name, $amount, $email)
    {
        $public_key = '6558f7dd0083c5493d87ced47b96a60d53b29fbe1e450a4c41b85a6d3f174c74';
        $private_key = '6dbACd8be6ade0ACDf622f1067275B2F8e0e76f8E1d9D93e0a4d3b00F437A2d0';

        // Set the API command and required fields
        $req['version'] = 1;
        $req['amount'] = $amount;
        $req['currency1'] = $currency1;
        $req['currency2'] = $currency2;
        $req['buyer_email'] = $email;
        $req['buyer_name'] = 'User ID ' . $user_id . ', Name ' . $name;
        $req['item_name'] = '' . $amount . ' USD Added Request';
        $req['cmd'] = 'create_transaction';
        $req['key'] = $public_key;
        $req['currency'] = $currency2;
        // $req['user_id'] = $user_id;
        $req['format'] = 'json'; //supported values are json and xml
        // Generate the query string
        $post_data = http_build_query($req, '', '&');

        // Calculate the HMAC signature on the POST data
        $hmac = hash_hmac('sha512', $post_data, $private_key);

        // Create cURL handle and initialize (if needed)
        static $ch = NULL;
        if ($ch === NULL) {
            $ch = curl_init('https://www.coinpayments.net/api.php');
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $hmac));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        // Execute the call and close cURL handle
        $data = curl_exec($ch);
        $data2 = json_decode($data, true);
        // pr($data2,true);
        return $data2;
    }
    public function get_coins_prices()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://unl.finance/api/coin_stats",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZDU3YTIxMGNkZGVkYjYwNGMwNDg2NWIxNjJhMjg5NmRhNDNlZGNlYmVlOWUwNmM1ZjZmNjExZDk0MDQzOTdlMTQxMTUwMzljMmI3MWNiNGEiLCJpYXQiOjE2MDA4Nzg4NjcsIm5iZiI6MTYwMDg3ODg2NywiZXhwIjoxNjMyNDE0ODY3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.ArmBCO2KkEg_A-vWkgfuNQlROCxzLYj7x4n2xI-e360BcMt3yDGJ2-4kvFj8P6d7mHBuC4X273UxnI_P1u_Q1-x_LzVDGBco9eKUig4ZR5vxYBNSl2eQ367MTvAQ-4fglzuDNSx_QoanYBYe0caCHZ6DuTD95gKVOB4Yn7zetyDdvDzXgizEUykN_P8NEVguebEYyWKaG51sQtOdxpLiDtKuWU8o1tNIO6Lu-dXv0kOIuwxjR-t4EJJ0t5hONZcTP61wsy6gkoAlbbMPI5ONh_YeZI1qwahnlIq57_lQdfl24SCT3mPE0tS1VdhZ7OQNXxUMSzDWvPOk6DYDGEcvT6oLnKoW4qqwCi8kifY87ClgOmnhR9e-6X7blKzZmjfiPxb0Xuv07RbvfI_cp8dlQ_q_yKWObOb32dJGLjyNiiqeLqfhZGGtXLv0fRxVS7VrHGJ9bOietxL6qVueF2ZGPv0kfu_FfpOKmPlf6zirbV42P1JGz1PtOnCG8xzIN_JIS-nNfZgb9syd18GqYIdEEIvYacgN90CYd4Y_ss108OjIB77dO7hlMGXEFgbkMXOCkWNIdhfb1OLJirg-0VI3X-0IUsQtjBciOKzHsWiSufXaqXNRkgF0Nu2h80aTIAYAfCdnTiWNI27zvQDAg_0qImESmrzUc437ZWN7CcfARbc",
                "cache-control: no-cache",
                "postman-token: 61ff1e31-6671-f1a7-dfc0-dabfd794949a"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $coins = (json_decode($response, true));
            $html = '';
            foreach ($coins['success'] as $key => $coin) {
                $html .= '<li><i class="cc ' . $coin['currency'] . '"></i> ' . $coin['currency'] . ' <span class="text-yellow"> $' . $coin['price'] . '</span></li>';
            }
            echo $html;
            // echo $response;

        }
    }
    public function get_coin_prices()
    {
        $curl = curl_init();
        $html = '';
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.nomics.com/v1/currencies/ticker?key=demo-26240835858194712a4f8cc0dc635c7a&ids=BTC%2CETH%2CGAME%2CLBC%2CNEO%2CSTE%2CLIT%2CNOTE%2CMINT%2CIOT%2CDAS&interval=1d%2C30d&convert=USD",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: 4982dc17-cbab-bbcc-6a85-8d1a16f9abb0"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            // echo $response;
            $products = (json_decode($response, true));
            // pr($products);
            foreach ($products  as $key => $data) {
                $coins[$key]['currency'] = $data['currency'];
                $coins[$key]['name'] = $data['name'];
                $coins[$key]['logo_url'] = $data['logo_url'];
                $coins[$key]['price'] = $data['price'];
                $coins[$key]['price_date'] = $data['price_date'];
                // $coins[$key]['rank'] = $data['rank'];
                $coins[$key]['status'] = $data['status'];
                $html .= '<li><i class="cc ' . $data['currency'] . '"></i> ' . $data['currency'] . ' <span class="text-yellow"> $' . $data['price'] . '</span></li>';
            }
            // echo $html;
            return $coins;
        }
    }

    public function getOtp($phone)
    {
        if ($this->input->is_ajax_request()) {
            if ($this->input->server('REQUEST_METHOD') == 'GET') {
                $_SESSION['verification_otp'] = rand(100000, 999999);
                $this->session->mark_as_temp('verification_otp', 300);
                $message = 'You OTP is ' . $this->session->userdata['verification_otp'] . ' (One Time Password), this otp expire in 2 mintues!';
                $message = 'Dear User, Your OTP is ' . $this->session->userdata['verification_otp'] . ' Never share this OTP with anyone, this OTP expire in two minutes. More Info: ' . base_url() . ' From mlmsig';
                register_notify($phone, $message, '1201161518339990262', '1207162142573795782');
                if ($message) {
                    $response['status'] = 1;
                } else {
                    $response['status'] = 0;
                }
            }
        } else {
            $response['status'] = 0;
        }

        echo json_encode($response);
    }
    public function index1()
    {
        $this->load->view('index1');
    }

    public function mainWallet()
    {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['token_value'] = $this->User_model->get_single_record('tbl_token_value', [], '*');
            $response['today_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and date(created_at) = date(now()) and amount > 0', 'ifnull(sum(amount),0) as today_income');
            $response['today_matching_bonus'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "matching_bonus" and date(created_at) = date(now())', 'ifnull(sum(amount),0) as today_matching_bonus');
            /*incomes */
            $response['self_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "self_income"', 'ifnull(sum(amount),0) as self_income');
            $response['matching_bonus'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "matching_bonus"', 'ifnull(sum(amount),0) as matching_bonus');
            $response['royalty_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "royalty_income"', 'ifnull(sum(amount),0) as royalty_income');
            $response['direct_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "direct_income"', 'ifnull(sum(amount),0) as direct_income');
            $response['gold_matrix_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "gold_matrix_income"', 'ifnull(sum(amount),0) as gold_matrix_income');
            $response['royal_matrix_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "royal_matrix_income"', 'ifnull(sum(amount),0) as royal_matrix_income');
            $response['crown_matrix_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "crown_matrix_income"', 'ifnull(sum(amount),0) as crown_matrix_income');
            $response['fix_deposit'] = $this->User_model->get_single_record('tbl_fix_deposit', 'user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as fix_deposit');
            /*incomes */
            $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and amount > 0', 'ifnull(sum(amount),0) as total_income');
            $response['income_balance'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as income_balance');
            $response['total_repurchase_income'] = $this->User_model->get_single_record('tbl_repurchase_income', 'user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as total_repurchase_income');
            $response['team'] = $this->User_model->get_single_record('tbl_downline_count', 'user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(count(id),0) as team');
            $response['paid_directs'] = $this->User_model->get_single_record('tbl_users', 'sponser_id = "' . $this->session->userdata['user_id'] . '" and paid_status = 1', 'ifnull(count(id),0) as paid_directs');
            $response['free_directs'] = $this->User_model->get_single_record('tbl_users', 'sponser_id = "' . $this->session->userdata['user_id'] . '"  and paid_status = 0', 'ifnull(count(id),0) as free_directs');
            $response['requested_fund'] = $this->User_model->get_single_record('tbl_payment_request', 'user_id = "' . $this->session->userdata['user_id'] . '" ', 'ifnull(sum(amount),0) as requested_fund');
            $response['wallet_balance'] = $this->User_model->get_single_record('tbl_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" ', 'ifnull(sum(amount),0) as wallet_balance');
            //$response['token_wallet'] = $this->User_model->get_single_record('tbl_token_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" ', 'ifnull(sum(amount),0) as token_wallet');
            //$response['shopping_wallet'] = $this->User_model->get_single_record('tbl_shopping_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" ', 'ifnull(sum(amount),0) as shopping_wallet');
            $response['released_fund'] = $this->User_model->get_single_record('tbl_payment_request', 'user_id = "' . $this->session->userdata['user_id'] . '" and status = 1', 'ifnull(sum(amount),0) as released_fund');
            $response['total_withdrawal'] = $this->User_model->get_single_record('tbl_withdraw', 'user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as total_withdrawal');
            $response['team_business'] = $this->User_model->get_single_record('tbl_downline_business', 'user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(business),0) as team_business');
            $response['package'] = $this->User_model->get_single_record('tbl_package', 'id = "' . $response['user']['package_id'] . '"', '*');
            $response['directs'] = $this->User_model->get_records('tbl_users', 'sponser_id = "' . $response['user']['user_id'] . '"', 'id,user_id,name,first_name,last_name,phone,paid_status,created_at');
            $response['news'] = $this->User_model->get_records('tbl_news', array(), '*');
            $response['roi_records'] = $this->User_model->get_limit_records('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "roi_bonus"', '*', 5, 0);
            $response['reward_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "' . $this->session->userdata['user_id'] . '" and type = "reward_income"', 'ifnull(sum(amount),0) as reward_income');
            // pr($response,true);
            $response['team_unpaid'] = $this->User_model->calculate_team($this->session->userdata['user_id'], 0);
            $response['team_paid'] = $this->User_model->calculate_team($this->session->userdata['user_id'], 1);
            $response['popup'] = $this->User_model->get_single_record1('tbl_user_popup', '*');
            $response['reward'] = $this->User_model->get_records('tbl_rewards', ['user_id' => $this->session->userdata['user_id']], '*');
            //$response['coins'] = $this->get_coin_prices();
            $get = $this->User_model->get_records('tbl_users', ['directs >=' => 10, 'user_id' => $this->session->userdata['user_id']], 'user_id');
            $data = array();
            foreach ($get as $key => $value) {
                $left = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $value['user_id'], 'position' => "L", 'paid_status >' => 0), 'count(id) as ids');
                if ($left['ids'] >= 5) {
                    $right = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $value['user_id'], 'position' => "R", 'paid_status >' => 0), 'count(id) as ids');
                    if ($right['ids'] >= 5) {
                        $data[] = $this->User_model->get_single_record('tbl_users', 'user_id = "' . $value['user_id'] . '"', 'user_id,leftPower,rightPower');
                    }
                }
            }

            $response['silver'] = $data;

            $get2 = $this->User_model->get_records('tbl_users', ['directs >=' => 20, 'user_id' => $this->session->userdata['user_id']], 'user_id');
            $data2 = array();
            foreach ($get2 as $key2 => $value2) {
                $left2 = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $value2['user_id'], 'position' => "L", 'paid_status >' => 0), 'count(id) as ids');
                if ($left2['ids'] >= 10) {
                    $right2 = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $value2['user_id'], 'position' => "R", 'paid_status >' => 0), 'count(id) as ids');
                    if ($right2['ids'] >= 10) {
                        $data2[] = $this->User_model->get_single_record('tbl_users', 'user_id = "' . $value2['user_id'] . '"', 'user_id,leftPower,rightPower');
                    }
                }
            }

            $response['gold'] = $data2;
            $response['global_matrix_income'] = [];

            $this->load->view('header', $response);
            $this->load->view('maintofund', $response);
            // $this->load->view('footer', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }



    public function mynews($id = '')
    {
        if (is_logged_in()) {
            $check = $this->User_model->get_single_record('tbl_news', ['id' => $id], '*');
            if (!empty($check) && $check['id']) :
                $response['news'] = $this->User_model->get_single_record('tbl_news', ['id' => $id], '*');
            else :
                redirect('Dashboard/User/');
            endif;
            $this->load->view('mynews', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function generateRoi($value = '')
    {

        $users = $this->User_model->get_records('tbl_users', ['paid_status >' => 0], '*');
        foreach ($users as $key => $user) {
            $package = $this->User_model->get_single_record('tbl_package1', ['price' => $user['package_amount']], '*');
            $roiMaker = $package['price'] * $package['commision'] / 100;
            // $set = ['package_amount' => $package['now_price']];
            // $this->User_model->update('tbl_users', ['user_id' => $user['user_id']], $set);
            if ($roiMaker > 0) {
                $roiArr = array(
                    'user_id' => $user['user_id'],
                    'amount' => ($roiMaker * $package['days']),
                    'roi_amount' => $roiMaker,
                    'days' => $package['days'],
                    'type' => 'roi_income',
                );
                // pr($roiArr);
                $this->User_model->add('tbl_roi', $roiArr);
            }
        }
    }

    public function rewards()
    {
        if (is_logged_in()) {
            $response['header'] = "Rewards";
            $response['rewardarr'] = [
                1 => ['business' => '5000', 'amount' => 100],
                2 => ['business' => '10000', 'amount' => 250],
                3 => ['business' => '20000', 'amount' => 500],
                4 => ['business' => '50000', 'amount' => 1000],
                5 => ['business' => '100000', 'amount' => 2500],
                6 => ['business' => '500000', 'amount' => 10000],
                7 => ['business' => '2500000', 'amount' => 50000],
                8 => ['business' => '5000000', 'amount' => 100000],
                9 => ['business' => '10000000', 'amount' => 250000],
                10 => ['business' => '50000000', 'amount' => 1000000],
            ];
            $response['user_reward'] = $this->User_model->get_records('tbl_rewards', ['user_id' => $this->session->userdata['user_id']], '*');
            $this->load->view('rewards', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function sendMail($email, $message)
    {
        //if($this->input->is_ajax_request()){
        //if ($this->input->server('REQUEST_METHOD') == 'POST') {
        $email = trim(addslashes($email));
        //if(!empty($email)){
        $email2 = $this->User_model->get_single_record('tbl_users', array('email' => $email), '*');
        // if(empty($email2)){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mailjet.com/v3.1/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                                "Messages": [
                                    {
                                        "From": {
                                            "Email": "manishgni20@gmail.com",
                                            "Name": "MOON BYEOL"
                                        },
                                        "To": [
                                            {
                                                "Email": "' . $email . '",
                                                "Name": "MOON BYEOL"
                                            }
                                        ],
                                        "Subject": "Account Details",
                                        "TextPart": "Account Details",
                                        "HTMLPart": "<center><img style=\'max-width:200px;\' src=\'https://minting.moonbyeol.com/uploads/logo.png\' alt=\'logo\'><br><h3>' . $message . '</h3><br></h2><br><br><b>Never Share Account Details with anyone https://minting.moonbyeol.com/. Your browser will also display a padlock icon to let you know a site is secure.</b></center>"
                                    }
                                ]
                            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Username: 1ff47bac7e7c884454b6d51eee799375',
                'Password: 6fe3d8a9b6a45c0d194d45da3ee2c12f',
                'Authorization: Basic MWZmNDdiYWM3ZTdjODg0NDU0YjZkNTFlZWU3OTkzNzU6NmZlM2Q4YTliNmE0NWMwZDE5NGQ0NWRhM2VlMmMxMmY='
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data2 = json_decode($response);
        // $status = ($data2->Messages[0]->Status);
        // if(!empty($status)){
        //     if($status == 'error'){
        //         $errors = ($data2->Messages[0]->Errors);
        //         $data['success'] = 0;
        //         $data['message'] = $errors[0]->ErrorMessage;
        //     }else{
        //         $data['success'] = 1;
        //         $data['message'] = 'Verification OTP send on Email!';

        //     }
        // }
        // }else{
        //     $data['success'] = 0;
        //     $data['message'] = 'This email is already registered!';
        // }

        // }else{
        //     $data['success'] = 0;
        //     $data['message'] = 'Please enter email and confirm email!';
        // }
        // }
        //}
        // $data['token'] = $this->security->get_csrf_hash();;
        // echo json_encode($data);
    }

    public function forgot_password()
    {
        $response = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $user = $this->User_model->get_single_record('tbl_users', ['email' => $data['email']], 'name,user_id,email,password,master_key,phone');
            if (!empty($user)) {
                $user['message'] = "Dear " . $user['name'] . ' <p>your User ID ' . $user['user_id'] . '</p><p>  password for Your Account is ' . $user['password'] . ' </p>Transaction Password ' . $user['master_key'];


                sendEmail($user);

                //$response['message'] = 'Account Detail Sent on Your Email Please check';
                //$sms_text = 'Dear ' . $userData['name'] . '. Your Account Successfully created. User ID : ' . $userData['user_id'] . '. Password :' . $userData['password'] . '. Transaction Password:' . $userData['master_key'] . '. ' . base_url().'';

                //$this->send_email($user['email'], 'Security Alert', $message);
                //sendMail($user['email'],$message);
                //notify_user($user['user_id'] , $message);

                $this->session->set_flashdata('message', 'Account Details sent on your registered E-mail Address');
            } else {
                $this->session->set_flashdata('message', 'Invalid Email');
            }
        }
        $this->load->view('forgot_password', $response);
    }

    public function email_veryfication()
    {
        $user_id = $this->input->get('user_id');

        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            $UserCheck = $this->User_model->get_single_record('tbl_users', array('id' => $user_id), $select = 'sponser_id,user_id');
            if ($UserCheck) {
                $this->db->where('id', $user_id);
                $this->db->update('tbl_users', array('email_verified' => '1'));
                redirect('Dashboard/User/login');
                $this->session->set_flashdata('message', 'Your email verification has been successfully done!');
            } else {
                $this->session->set_flashdata('message', 'Invalid Email');
                redirect('Dashboard/Register');
            }
        }
    }

    public function payout_summary()
    {
        if (is_logged_in()) {
            $response = array();
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            if (!empty($start_date)) {
                $where = 'date(created_at) >= "' . $start_date . '" AND date(created_at) <= "' . $end_date . '"AND  user_id = "' . $this->session->userdata['user_id'] . '"';
            } else {
                $where = array('user_id' => $this->session->userdata['user_id']);
            }
            $response['base_url'] = base_url() . 'Dashboard/User/payout_summary/';
            $config['base_url'] = base_url() . 'Dashboard/User/payout_summary';
            $rowCount =  $this->User_model->get_sum2('tbl_income_wallet', $where, 'ifnull(count(id),0) as sum');
            $config['total_rows'] = count($rowCount);

            // pr($config['total_rows'],true);
            $config['uri_segment'] = 4;
            $config['per_page'] = 10;
            $config['suffix'] = '?' . http_build_query($_GET);
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['segament'] = $segment;
            $response['records'] = $this->User_model->payout_summary3($where, $config['per_page'], $segment);
            foreach ($response['records'] as $key => $record) {
                //
                $incomes = $this->User_model->get_incomes('tbl_income_wallet', 'date(created_at) = "' . $record['date'] . '" and user_id = "' . $this->session->userdata['user_id'] . '" and amount > 0', 'ifnull(sum(amount),0) as sum,type');
                $response['records'][$key]['incomes'] = calculate_income($incomes);
            }
            $response['type'] = $this->User_model->get_records('tbl_income_wallet', "type != 'withdraw_request' and type!='reward_income' and type!='passive_income' and amount > '0' Group by type", 'type');
            //pr($response,true);
            // pr($response,true);
            $this->load->view('payout_summary', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
}
