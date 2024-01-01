<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cron extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
        date_default_timezone_set('Asia/Kolkata');
    }

    public function index()
    {
    }

    public function sapphireIncome()
    {
        $date1 = date('Y-m-d');
        $cron = $this->Main_model->get_single_record('tbl_cron', ['date' => $date1, 'cron_name' => 'sapphireIncome'], '*');
        if (empty($cron)) {
            $this->Main_model->add('tbl_cron', ['cron_name' => 'sapphireIncome', 'date' => $date1]);
            $date = date('Y-m-d', strtotime(date('Y-m-d') . ' 0 days'));
            $users = $this->Main_model->get_records('tbl_income_wallet', "amount > '0' and (type = 'stakeing_level_income' || type = 'direct_income') and date(created_at) = '" . $date . "' GROUP BY user_id", 'ifnull(sum(amount),0) as todayIncome,user_id');
            foreach ($users as $key => $user) {
                if ($user['todayIncome'] > 0) {
                    pr($user);
                    $getDirects = $this->Main_model->get_records('tbl_users', array('sponser_id' => $user['user_id'], 'paid_status' => 1, 'directs >=' => 10), 'user_id');
                    if (!empty($getDirects)) {
                        $perID = ($user['todayIncome'] * 0.1) / count($getDirects);
                        foreach ($getDirects as $dkey => $dr) {
                            $userinfo = $this->Main_model->get_single_record('tbl_users', ['user_id' => $dr['user_id']], 'incomeLimit,incomeLimit2');
                            if ($userinfo['incomeLimit2'] > $userinfo['incomeLimit']) {
                                $totalCredit = $userinfo['incomeLimit'] + $perID;
                                if ($totalCredit < $userinfo['incomeLimit2']) {
                                    $sapphire_income = $perID;
                                } else {
                                    $sapphire_income = $userinfo['incomeLimit2'] - $userinfo['incomeLimit'];
                                }
                                $incomeArr = array(
                                    'user_id' => $dr['user_id'],
                                    'amount' => $sapphire_income * 0.7,
                                    'type' => 'sapphire_income',
                                    'description' => 'Sapphire Income From User ' . $user['user_id'],
                                );
                                pr($incomeArr);
                                $this->Main_model->add('tbl_income_wallet', $incomeArr);
                                $this->Main_model->update('tbl_users', ['user_id' => $dr['user_id']], ['incomeLimit' => ($userinfo['incomeLimit'] + $incomeArr['amount'])]);
                                $coinCredit = array(
                                    'user_id' => $dr['user_id'],
                                    'amount' => $sapphire_income * 0.3, ///$tokenValue['amount'],
                                    'type' => 'sapphire_income',
                                    'description' => 'Sapphire Income From User ' . $user['user_id'],
                                );
                                pr($coinCredit);
                                $this->Main_model->add('tbl_coin_wallet', $coinCredit);
                            }
                        }
                    }
                }
            }
        } else {
            echo 'Today Cron already run';
        }
    }


    public function ThirdBoosterCron()
    {

        $date = date('Y-m-d');
        $cron = $this->Main_model->get_single_record('tbl_cron', ['date' => $date, 'cron_name' => 'passive_income'], '*');
        if (empty($cron)) {
            $this->Main_model->add('tbl_cron', ['cron_name' => 'passive_income', 'date' => $date]);
            $users = $this->Main_model->get_records('third_booster_daily_incomes', array('user_id' => 'Jaiguruji', 'last_date' <=  date('Y-m-d')), '*');
            $userinfo = $this->Main_model->get_single_record('tbl_users', ['user_id' => 'Jaiguruji'], 'package_amount,incomeLimit,incomeLimit2');

            if ($userinfo['incomeLimit2'] > $userinfo['incomeLimit']) {
                foreach ($users as $user) {
                    if (!empty($user['user_id'])) {
                        $sendWallet = array(
                            'user_id' => $user['user_id'],
                            'amount' => $user['amount'],
                            'type' => 'passive_income',
                            'description' => 'Daily income of passive income' . 'Jaiguruji',
                        );


                        // $this->User_model->add('tbl_wallet', $sendWallet);
                        $this->Main_model->add('tbl_income_wallet', $sendWallet);
                        $this->Main_model->update('tbl_users', ['user_id' => $user['user_id']], ['incomeLimit' => ($userinfo['incomeLimit'] + $user['amount'])]);
                    }
                }
            }
        } else {
            echo 'Today Cron already run';
        }
    }


    public function roiCron2()
    {

        $date = date('Y-m-d');
        $cron = $this->Main_model->get_single_record('tbl_cron', ['date' => $date, 'cron_name' => 'roiCron'], '*');
        // if(empty($cron)){
        // $this->Main_model->add('tbl_cron',['cron_name' => 'roiCron','date' => $date]);
        $roi_users = $this->Main_model->get_records('tbl_roi', array('type' => 'roi_income'), '*');

        $tokenValue = $this->Main_model->get_single_record('tbl_token_value', ['id' => 1], '*');
        foreach ($roi_users as $key => $user) {

            if ($user['user_id'] == 'Jaiho') {

                $date1 = date('Y-m-d H:i:s');
                $date2 = date('Y-m-d H:i:s', strtotime($user['creditDate'] . '+ 0 days'));
                $diff = strtotime($date1) - strtotime($date2);
                // echo $diff.' / '.$user['user_id'].'<br>';
                if ($diff >= 0) {
                    $userinfo = $this->Main_model->get_single_record('tbl_users', ['user_id' => $user['user_id']], 'package_amount,incomeLimit,incomeLimit2');

                    if ($userinfo['incomeLimit2'] > $userinfo['incomeLimit']) {
                        $totalCredit = $userinfo['incomeLimit'] + $user['roi_amount'];

                        if ($totalCredit < $userinfo['incomeLimit2']) {
                            $roi_amount = $user['roi_amount'];
                        } else {
                            $roi_amount = $userinfo['incomeLimit2'] - $userinfo['incomeLimit'];
                        }

                        //echo $roi_amount;
                        // die;

                        $new_day = $user['days'] - 1;
                        $days = ($user['total_days'] + 1) - $user['days'];
                        $incomeArr = array(
                            'user_id' => $user['user_id'],
                            // 'amount' => $roi_amount/24, ///$tokenValue['amount'],
                            'amount' => $roi_amount, ///$tokenValue['amount'],
                            'type' => 'roi_income',
                            'description' => 'Daily ROI Income at Day ' . $days,
                            //'withdraw_date' => date('Y-m-d H:i:s',strtotime($user['created_at'].'+ '.$user['total_days'].' days')),
                        );

                        pr($incomeArr);
                        echo 'user table' . $userinfo['incomeLimit'] + $incomeArr['amount'];
                        echo 'roi table' . $user['amount'] - $user['roi_amount'];

                        //  $this->Main_model->add('tbl_income_wallet', $incomeArr);
                        //  $this->Main_model->update('tbl_users',['user_id' => $user['user_id']],['incomeLimit' => ($userinfo['incomeLimit'] + $incomeArr['amount'])]);

                        //  $this->Main_model->update('tbl_users',['user_id' => $user['user_id']],['incomeLimit' => ($userinfo['incomeLimit'] + $incomeArr['amount'])]);
                        //  $this->Main_model->update('tbl_roi', array('id' => $user['id']), array('days' => $new_day, 'amount' => ($user['amount'] - $user['roi_amount']),'creditDate' => date('Y-m-d'),'status' => 1));
                        $sponsor = $this->Main_model->get_single_record('tbl_users', ['user_id' => $user['user_id']], 'sponser_id');
                        //  $this->roiLevelIncome($sponsor['sponser_id'],$user['user_id'], $roi_amount);
                    }
                }
            }
        }
        // } else {
        //     echo 'Today cron already run';
        // }
    }

    public function roiCron()
    {
        $date = date('Y-m-d');
        $cron = $this->Main_model->get_single_record('tbl_cron', ['date' => $date, 'cron_name' => 'roiCron'], '*');
        if (empty($cron)) {
            $this->Main_model->add('tbl_cron', ['cron_name' => 'roiCron', 'date' => $date]);
            $roi_users = $this->Main_model->get_records('tbl_roi', array('type' => 'roi_income', 'days >' => 0, 'status !=' => 2), '*');
            $tokenValue = $this->Main_model->get_single_record('tbl_token_value', ['id' => 1], '*');
            foreach ($roi_users as $key => $user) {
                $InactiveRoiBalance = $this->Main_model->get_single_record('tbl_roi', ['user_id' => $user['user_id'], 'id <' => $user['id']], 'ifnull(sum(package),0) as balance');
                $totalInactiveBalance = ($InactiveRoiBalance['balance'] + $user['package']);
                $inactiveBalance = ($totalInactiveBalance * 3);


                $date1 = date('Y-m-d H:i:s');
                $date2 = date('Y-m-d H:i:s', strtotime($user['creditDate'] . '+ 0 days'));
                $diff = strtotime($date1) - strtotime($date2);
                // echo $diff.' / '.$user['user_id'].'<br>';
                if ($diff >= 0) {
                    $userinfo = $this->Main_model->get_single_record('tbl_users', ['user_id' => $user['user_id']], 'package_amount,incomeLimit,incomeLimit2');
                    if ($userinfo['incomeLimit2'] > $userinfo['incomeLimit']) {
                        if ($userinfo['incomeLimit'] > $inactiveBalance) {
                            echo $user['user_id'];
                            echo $user['id'];
                            $this->Main_model->update('tbl_roi', ['id' => $user['id']], ['status' => 2]);
                        }

                        $totalCredit = $userinfo['incomeLimit'] + $user['roi_amount'];
                        if ($totalCredit < $userinfo['incomeLimit2']) {
                            $roi_amount = $user['roi_amount'];
                        } else {
                            $roi_amount = $userinfo['incomeLimit2'] - $userinfo['incomeLimit'];
                        }
                        $new_day = $user['days'] - 1;
                        $days = ($user['total_days'] + 1) - ($user['days']);
                        $incomeArr = array(
                            'user_id' => $user['user_id'],
                            // 'amount' => $roi_amount/24, ///$tokenValue['amount'],
                            'amount' => $roi_amount, ///$   ['amount'],
                            'type' => 'roi_income',
                            'description' => 'Daily ROI Income at Day ' . $days,
                            //'withdraw_date' => date('Y-m-d H:i:s',strtotime($user['created_at'].'+ '.$user['total_days'].' days')),
                        );
                        pr($incomeArr);

                        $this->Main_model->add('tbl_income_wallet', $incomeArr);
                       $this->Main_model->update('tbl_users', ['user_id' => $user['user_id']], ['incomeLimit' => ($userinfo['incomeLimit'] + $incomeArr['amount'])]);

                        $this->Main_model->update('tbl_roi', array('id' => $user['id'],'status !=' => 2), array('days' => $new_day, 'amount' => ($user['amount'] - $user['roi_amount']), 'creditDate' => date('Y-m-d'), 'status' => 1));
                        $sponsor = $this->Main_model->get_single_record('tbl_users', ['user_id' => $user['user_id']], 'sponser_id');
                        $this->roiLevelIncome($sponsor['sponser_id'], $user['user_id'], $roi_amount);
                    }
                }
            }
        } else {
            echo 'Today cron already run';
        }
    }



    public function roiCron20()
    {
        $date = date('Y-m-d');
        $cron = $this->Main_model->get_single_record('tbl_cron', ['date' => $date, 'cron_name' => 'roiCron20'], '*');
        if (empty($cron)) {
            $this->Main_model->add('tbl_cron', ['cron_name' => 'roiCron20', 'date' => $date]);
            $roi_users = $this->Main_model->get_records('tbl_roi_20', array('type' => 'roi_income', 'days >' => 0), '*');
            $tokenValue = $this->Main_model->get_single_record('tbl_token_value', ['id' => 1], '*');
            foreach ($roi_users as $key => $user) {
                $InactiveRoiBalance = $this->Main_model->get_single_record('tbl_roi_20', ['user_id' => $user['user_id'], 'id <' => $user['id']], 'ifnull(sum(package),0) as balance');
                $totalInactiveBalance = ($InactiveRoiBalance['balance'] + $user['package']);
                $inactiveBalance = ($totalInactiveBalance * 2);


                $date1 = date('Y-m-d H:i:s');
                $date2 = date('Y-m-d H:i:s', strtotime($user['creditDate'] . '+ 0 days'));
                $diff = strtotime($date1) - strtotime($date2);
                // echo $diff.' / '.$user['user_id'].'<br>';
                if ($diff >= 0) {
                    $userinfo = $this->Main_model->get_single_record('tbl_users', ['user_id' => $user['user_id']], 'package_amount,incomeLimit2,incomeLimit');
                    if ($userinfo['incomeLimit2'] > $userinfo['incomeLimit']) {
                        if ($userinfo['incomeLimit'] > $inactiveBalance) {
                            echo $user['user_id'];
                            echo $user['id'];
                            $this->Main_model->update('tbl_roi_20', ['id' => $user['id']], ['status' => 2]);
                        }

                        $totalCredit = $userinfo['incomeLimit'] + $user['roi_amount'];
                        if ($totalCredit < $userinfo['incomeLimit2']) {
                            $roi_amount = $user['roi_amount'];
                        } else {
                            $roi_amount = $userinfo['incomeLimit2'] - $userinfo['incomeLimit'];
                        }
                        $new_day = $user['days'] - 1;
                        $days = ($user['total_days'] + 1) - ($user['days']);
                        $incomeArr = array(
                            'user_id' => $user['user_id'],
                            // 'amount' => $roi_amount/24, ///$tokenValue['amount'],
                            'amount' => $roi_amount, ///$   ['amount'],
                            'type' => 'roi_income',
                            'description' => 'Daily ROI 20 Income  at Day ' . $days,
                            //'withdraw_date' => date('Y-m-d H:i:s',strtotime($user['created_at'].'+ '.$user['total_days'].' days')),
                        );
                        pr($incomeArr);

                        $this->Main_model->add('tbl_income_wallet', $incomeArr);
                       $this->Main_model->update('tbl_users', ['user_id' => $user['user_id']], ['incomeLimit' => ($userinfo['incomeLimit'] + $incomeArr['amount'])]);

                        $this->Main_model->update('tbl_roi_20', array('id' => $user['id'],'status !=' => 2), array('days' => $new_day, 'amount' => ($user['amount'] - $user['roi_amount']), 'creditDate' => date('Y-m-d'), 'status' => 1));
                        // $sponsor = $this->Main_model->get_single_record('tbl_users', ['user_id' => $user['user_id']], 'sponser_id');
                        // $this->roiLevelIncome($sponsor['sponser_id'], $user['user_id'], $roi_amount);
                    }
                }
            }
        } else {
            echo 'Today cron already run';
        }
    }

    private function roiLevelIncome($user_id, $linkedID, $amount)
    {
        for ($i = 1; $i <= 50; $i++) {
            if ($i == 1) {
                $incomeArr[$i] = ['amount' => 0.2, 'direct' => $i];
            } elseif ($i == 2) {
                $incomeArr[$i] = ['amount' => 0.15, 'direct' => $i];
            } elseif ($i == 3) {
                $incomeArr[$i] = ['amount' => 0.1, 'direct' => $i];
            } elseif ($i >= 4 && $i <= 6) {
                $incomeArr[$i] = ['amount' => 0.05, 'direct' => $i];
            } elseif ($i >= 7 && $i <= 15) {
                $incomeArr[$i] = ['amount' => 0.02, 'direct' => $i];
            } elseif ($i >= 16 && $i <= 20) {
                $incomeArr[$i] = ['amount' => 0.01, 'direct' => $i];
            } elseif ($i >= 21 && $i <= 30) {
                $incomeArr[$i] = ['amount' => 0.005, 'direct' => $i];
            } elseif ($i >= 31 && $i <= 50) {
                $incomeArr[$i] = ['amount' => 0.0025, 'direct' => $i];
            }
        }
        foreach ($incomeArr as $key => $income) :
            $userinfo = $this->Main_model->get_single_record('tbl_users', ['user_id' => $user_id], 'user_id,paid_status,sponser_id,total_package,directs,incomeLimit,incomeLimit2');
            if (!empty($userinfo['user_id'])) :
                if ($userinfo['directs'] >= $income['direct'] && $userinfo['paid_status'] == 1) :
                    if ($userinfo['incomeLimit2'] > $userinfo['incomeLimit']) {
                        $totalCredit = $userinfo['incomeLimit'] + ($amount * $income['amount']);
                        if ($totalCredit < $userinfo['incomeLimit2']) {
                            $stakeing_level_income = ($amount * $income['amount']);
                        } else {
                            $stakeing_level_income = $userinfo['incomeLimit2'] - $userinfo['incomeLimit'];
                        }
                        $creditIncome = [
                            'user_id' => $userinfo['user_id'],
                            'amount' => $stakeing_level_income,
                            'type' => 'level_income',
                            'description' => 'Level Income from User ' . $linkedID . ' at level ' . $key,
                            //'withdraw_date' => $withdraw_date,
                        ];
                        $this->Main_model->add('tbl_income_wallet', $creditIncome);
                        $this->Main_model->update('tbl_users', ['user_id' => $userinfo['user_id']], ['incomeLimit' => ($userinfo['incomeLimit'] + $creditIncome['amount'])]);
                    }
                endif;
                $user_id = $userinfo['sponser_id'];
            endif;
        endforeach;
    }

    public function boosterCron()
    {
        if (date('D') != 'Sun') {
            $roi_users = $this->Main_model->get_records('tbl_roi', array('amount >' => 0, 'type' => 'direct_booster_income', 'days >' => 0), '*');
            foreach ($roi_users as $key => $user) {
                $date1 = date('Y-m-d H:i:s');
                $date2 = date('Y-m-d H:i:s', strtotime($user['created_at'] . '+ 1 days'));
                $diff = strtotime($date1) - strtotime($date2);
                if ($diff >= 0) {
                    $new_day = $user['days'] - 1;
                    $days = 21 - $user['days'];
                    $incomeArr = array(
                        'user_id' => $user['user_id'],
                        'amount' => $user['roi_amount'],
                        'type' => 'direct_boost_income',
                        'description' => 'Direct Booster Income at ' . $new_day . ' Day',
                    );
                    pr($incomeArr);
                    $this->Main_model->add('tbl_income_wallet', $incomeArr);
                    $this->Main_model->update('tbl_roi', array('id' => $user['id']), array('days' => $new_day, 'amount' => ($user['amount'] - $user['roi_amount'])));
                    $sponsor = $this->Main_model->get_single_record('tbl_users', ['user_id' => $user['user_id']], 'sponser_id');
                    $this->levelIncome($sponsor['sponser_id'], $user['user_id']);
                }
            }
        }
    }

    public function point_match_cron()
    {
        $response['users'] = $this->Main_model->get_records('tbl_users', '(leftPower >= 2 and rightPower >= 1 and directs >= 2) OR (leftPower >= 1 and rightPower >= 2  and directs >= 2)', 'id,user_id,sponser_id,leftPower,rightPower,package_amount,package_id,capping,incomeLimit,directs');
        foreach ($response['users'] as $user) {
            pr($user);
            $package = $this->Main_model->get_single_record_desc('tbl_package', array('id' => $user['package_id']), '*');
            $user_match = $this->Main_model->get_single_record_desc('tbl_point_matching_income', array('user_id' => $user['user_id']), '*');
            $position_directs = $this->Main_model->count_position_directs($user['user_id']);
            if ($user['package_amount'] <= 5000) {
                $binary = 0.07;
            } elseif ($user['package_amount'] >= 5001 && $user['package_amount'] <= 10000) {
                $binary = 0.08;
            } elseif ($user['package_amount'] >= 10001 && $user['package_amount'] <= 20000) {
                $binary = 0.09;
            } elseif ($user['package_amount'] >= 20001) {
                $binary = 0.1;
            }
            if (!empty($position_directs) && count($position_directs) == 2) {
                if (!empty($user_match)) {
                    if ($user['leftPower'] > $user['rightPower']) {
                        $old_income = $user['rightPower'];
                    } else {
                        $old_income = $user['leftPower'];
                    }
                    if ($user_match['left_bv'] > $user_match['right_bv']) {
                        $new_income = $user_match['right_bv'];
                    } else {
                        $new_income = $user_match['left_bv'];
                    }
                    $income = ($old_income - $new_income);
                    $match_bv = $income;
                    $carry_forward = abs($user['leftPower'] - $user['rightPower']);

                    $user_income = $income * $binary;
                    if ($user_income > 0) {
                        $matchArr = array(
                            'user_id' => $user['user_id'],
                            'left_bv' => $user['leftPower'],
                            'right_bv' => $user['rightPower'],
                            'amount' => $user_income,
                            'match_bv' => $match_bv,
                            'carry_forward' => $carry_forward,
                        );
                        $this->Main_model->add('tbl_point_matching_income', $matchArr);
                        if ($user['capping'] < $user_income) {
                            $user_income = $user['capping'];
                        }
                        // if($user['capping'] > $user['incomeLimit']){
                        //     $totalCredit = $user['incomeLimit'] + $user_income;
                        //     if($totalCredit < $user['capping']){
                        $matching_income = $user_income;
                        // } else {
                        //     $matching_income = $user['capping'] - $user['incomeLimit'];
                        // }

                        $incomeArr = array(
                            'user_id' => $user['user_id'],
                            'amount' => $matching_income,
                            'type' => 'matching_bonus',
                            'description' => 'Point Matching Bonus'
                        );
                        $this->Main_model->add('tbl_income_wallet', $incomeArr);
                        //$this->Main_model->update('tbl_users',['user_id' => $user['user_id']],['incomeLimit' => ($user['incomeLimit'] + $incomeArr['amount'])]);
                        //}
                        // $this->generation_income($user['sponser_id'], ($user_income), $user['user_id'], 'generation_income');
                        //  $this->sponsers_directs_bonus($user['user_id'] , $user_income * 10/100);
                        // $this->direct_sponser_income(($user_income * 5 / 100), $user['directs'], $user['user_id']);
                        pr($matchArr);
                    }
                } else {
                    if ($user['leftPower'] > $user['rightPower']) {
                        $leftPower = $user['leftPower'] - 1;
                        $rightPower = $user['rightPower'];
                    } else {
                        $rightPower = $user['rightPower'] - 1;
                        $leftPower = $user['leftPower'];
                    }
                    if ($leftPower > $rightPower) {
                        $income = $rightPower;
                    } else {
                        $income = $leftPower;
                    }
                    $match_bv = $income;
                    $carry_forward = abs($leftPower - $rightPower);

                    $user_income = $income * $binary;
                    //                echo $user_income;
                    if ($user['capping'] < $user_income) {
                        $user_income = $user['capping'];
                    }
                    $matchArr = array(
                        'user_id' => $user['user_id'],
                        'left_bv' => $user['leftPower'],
                        'right_bv' => $user['rightPower'],
                        'amount' => $user_income,
                        'match_bv' => $match_bv,
                        'carry_forward' => $carry_forward,
                    );
                    $this->Main_model->add('tbl_point_matching_income', $matchArr);
                    // if($user['capping'] > $user['incomeLimit']){
                    //     $totalCredit = $user['incomeLimit'] + $user_income;
                    //     if($totalCredit < $user['capping']){
                    $matching_income = $user_income;
                    // } else {
                    //     $matching_income = $user['capping'] - $user['incomeLimit'];
                    // }

                    $incomeArr = array(
                        'user_id' => $user['user_id'],
                        'amount' => $matching_income,
                        'type' => 'matching_bonus',
                        'description' => 'Point Matching Bonus'
                    );
                    $this->Main_model->add('tbl_income_wallet', $incomeArr);
                    //$this->Main_model->update('tbl_users',['user_id' => $user['user_id']],['incomeLimit' => ($user['incomeLimit'] + $incomeArr['amount'])]);
                    //}
                    //  $this->generation_income($user['sponser_id'], ($user_income), $user['user_id'], 'generation_income');
                    //$this->sponsers_directs_bonus($user['user_id'] , $user_income * 10/100);
                    pr($matchArr);
                }
            }
        }
        pr($response);
        die('code executed Successfully');
    }

    public function generation_income($user_id, $amount, $sender_id, $type = 'direct_sponser_income')
    {
        //10,5,3,2,1 salary_income
        $incomeArr = [10, 8, 5, 4, 3];
        foreach ($incomeArr as $key => $ia) {
            $user = $this->Main_model->get_single_record('tbl_users', ['user_id' => $user_id], 'user_id , sponser_id');
            if (!empty($user)) {
                $incomeArr = array(
                    'user_id' => $user['user_id'],
                    'amount' => $amount * $ia / 100,
                    'type' => 'team_performace_bonus',
                    'description' => 'Team Performance Bonus From ' . $sender_id
                );
                $user_id = $user['sponser_id'];
                $this->Main_model->add('tbl_income_wallet', $incomeArr);
            }
        }
    }


    private function levelIncome($user_id, $linkedID)
    {
        $direct = 0;
        for ($i = 1; $i <= 20; $i++) :
            if ($i % 2 != 0) {
                $direct += 1;
            }
            $incomeArr[$i] = ['amount' => 10, 'direct' => $direct];
        endfor;
        foreach ($incomeArr as $key => $income) :
            $userinfo = $this->Main_model->get_single_record('tbl_users', ['user_id' => $user_id], 'user_id,sponser_id,directs');
            if (!empty($userinfo['user_id'])) :
                if ($userinfo['directs'] >= $income['direct']) :
                    $incomeArr = array(
                        'user_id' => $userinfo['user_id'],
                        'amount' => $income['amount'],
                        'type' => 'booster_level_income',
                        'description' => 'Booster Level Income From User ' . $linkedID,
                    );
                    pr($incomeArr);
                    $this->Main_model->add('tbl_income_wallet', $incomeArr);
                endif;
                $user_id = $userinfo['sponser_id'];
            endif;
        endforeach;
    }

    public function deactiveUser()
    {
        $users = $this->Main_model->get_records('tbl_users', ['user_id !=' => 'T11111', 'paid_status' => 1], 'user_id,package_id,package_amount,topup_date');
        foreach ($users as $user) :
            $date1 = date('Y-m-d');
            $date2 = date('Y-m-d', strtotime($user['topup_date'] . ' + 20 days'));
            $diff = strtotime($date1) - strtotime($date2);
            if ($diff > 0) {
                $topupData = [
                    'paid_status' => 0,
                    'package_id' => 0,
                    'package_amount' => 0,
                    'topup_date' => '0000-00-00 00:00:00',
                    'retopup' => 1,
                ];
                $this->Main_model->update('tbl_users', ['user_id' => $user['user_id']], $topupData);
            }
        endforeach;
    }

    private function businessCalculationReward($user_id)
    {

        // $users = $this->Main_model->get_records('tbl_users',['paid_status >' => 0],'*');
        // foreach($users as $key => $user){
        $getDirects = $this->Main_model->get_records('tbl_users', ['sponser_id' => $user_id], 'user_id');
        $directArr = [];
        foreach ($getDirects as $key2 => $gd) {
            $selfBusiness = $this->Main_model->get_single_record('tbl_users', ['user_id' => $gd['user_id']], 'total_package');
            $getBusiness = $this->Main_model->getTeamBusiness($gd['user_id']);
            // print_r($selfBusiness);
            // print_r($getBusiness);
            $directArr[$key2] = [
                'user_id' => $gd['user_id'],
                'business' => $getBusiness['business'] + $selfBusiness['total_package'],
            ];
        }
        $columns = array_column($directArr, 'business');
        array_multisort($columns, SORT_DESC, $directArr);
        //pr($directArr,true);
        $totalBusiness = 0;
        $teamA = 0;
        $teamB = 0;
        $i = 1;
        $secondLeg = 0;
        $thirdLeg = 0;
        $fourthLeg = 0;
        foreach ($directArr as $dkey => $da) {
            $totalBusiness += $da['business'];
            if ($dkey == 0) {
                $teamA = $da['business'];
            } else {
                $teamB += $da['business'];
            }
        }

        return $response = [
            'user_id' => $user_id,
            'totalBusiness' => $totalBusiness,
            'strongLeg' => $teamA,
            'weakLeg' => $teamB,
        ];
        // }
    }




    public function businessCalculationRewardtest($user_id = 'Adarshji')
    {

        // $users = $this->Main_model->get_records('tbl_users',['paid_status >' => 0],'*');
        // foreach($users as $key => $user){
        $getDirects = $this->Main_model->get_records('tbl_users', ['sponser_id' => $user_id], 'user_id');
        $directArr = [];
        foreach ($getDirects as $key2 => $gd) {
            $selfBusiness = $this->Main_model->get_single_record('tbl_users', ['user_id' => $gd['user_id']], 'total_package');
            $getBusiness = $this->Main_model->getTeamBusiness($gd['user_id']);
            $directArr[$key2] = [
                'user_id' => $gd['user_id'],
                'business' => $getBusiness['business'] + $selfBusiness['total_package'],
            ];
        }
        $columns = array_column($directArr, 'business');
        array_multisort($columns, SORT_DESC, $directArr);
        //pr($directArr,true);
        $totalBusiness = 0;
        $teamA = 0;
        $teamB = 0;
        $i = 1;
        $secondLeg = 0;
        $thirdLeg = 0;
        $fourthLeg = 0;
        foreach ($directArr as $dkey => $da) {
            $totalBusiness += $da['business'];
            if ($dkey == 0) {
                $teamA = $da['business'];
            } else {
                $teamB += $da['business'];
            }
        }

        $response = [
            'user_id' => $user_id,
            'totalBusiness' => $totalBusiness,
            'strongLeg' => $teamA,
            'weakLeg' => $teamB,
        ];
        pr($response);
        // }
    }

    public function rewardCron()
    {
        ini_set("memory_limit", "512M");
        $users = $this->Main_model->get_records('tbl_users', ['paid_status >' => 0, 'directs >=' => 0, 'user_id !=' => '', 'rank <=' => 2], 'user_id,capping,incomeLimit,incomeLimit2,topup_date,rank,direct_business');
        foreach ($users as $key => $user) {
            if ($user['rank'] >= 0 && $user['rank'] <= 2) {
                $rewards = [
                    1 => ['direct' => 500, 'team' => 2500, 'reward' => 250],
                    2 => ['direct' => 500, 'team' => 10000, 'reward' => 500],
                    3 => ['direct' => 2000, 'team' => 25000, 'reward' => 1000],
                ];
                foreach ($rewards as $key => $reward) {
                    $business = $this->businessCalculationReward($user['user_id']);

                    pr($business);
                    if ($business['weakLeg'] >= $reward['team'] && $user['direct_business'] >= $reward['direct']) {
                        $check = $this->Main_model->get_single_record('tbl_rewards', ['award_id' => $key, 'user_id' => $user['user_id']], '*');
                        if (empty($check)) {
                            $rewardData = [
                                'user_id' => $user['user_id'],
                                'amount' => $reward['reward'],
                                'award_id' => $key,
                            ];
                            $this->Main_model->add('tbl_rewards', $rewardData);
                            pr($rewardData);
                            $IncomeData = [
                                'user_id' => $user['user_id'],
                                'amount' => $reward['reward'],
                                'type' => 'reward_income',
                                'description' => 'You have Achieved your ' . $key . ' Reward Income ',
                            ];
                            pr($IncomeData);
                            $this->Main_model->add('tbl_income_wallet', $IncomeData);
                            $this->Main_model->update('tbl_users', ['user_id' => $user['user_id']], ['rewardLevel' => $key, 'rank' => $key, 'rankDate' => date('Y-m-d H:i:s')]);
                        }
                    }
                }
            }
        }
    }

    public function rewardCronSecond()
    {
        $users = $this->Main_model->get_records('tbl_users', ['paid_status >' => 0, 'directs >=' => 0, 'user_id !=' => '', 'rank >' => 2], 'user_id,capping,incomeLimit,incomeLimit2,topup_date,rank');
        foreach ($users as $key => $user) {
            if ($user['rank'] <= 9) {
                echo $user['user_id'];
                // $getTeamRank = $this->Main_model->getTeamRank($user['user_id'],$user['rank']);
                // pr($getTeamRank);
                $rankStatus = false;

                $rankArr = [
                    3 => ['requiredRank' => 1, 'business' => 50000, 'reward' => 2500, 'rank' => 4],
                    4 => ['requiredRank' => 1, 'business' => 150000, 'reward' => 5000, 'rank' => 5],
                    5 => ['requiredRank' => 1, 'business' => 750000, 'reward' => 25000, 'rank' => 6],
                    6 => ['requiredRank' => 1, 'business' => 1500000, 'reward' => 50000, 'rank' => 7],
                    7 => ['requiredRank' => 1, 'business' => 6000000, 'reward' => 200000, 'rank' => 8],
                    8 => ['requiredRank' => 1, 'business' => 15000000, 'reward' => 500000, 'rank' => 9],
                    9 => ['requiredRank' => 1, 'business' => 45000000, 'reward' => 1250000, 'rank' => 10],


                ];

                $rankStatus = true;
                // if($rankStatus == false){
                //     $rankStatus = ($getTeamRank['rank'] >= $rankArr[$user['rank']]['requiredRank'])?true:false;
                // }

                $business = $this->businessCalculationReward($user['user_id']);
                echo 'here';
                pr($business);
                $checkBusiness = $rankArr[$user['rank']]['business'];
                if ($rankStatus == true && $business['weakLeg'] >= $checkBusiness) {
                    $this->Main_model->update('tbl_users', ['user_id' => $user['user_id']], ['rewardLevel' => $rankArr[$user['rank']]['rank'], 'rank' => $rankArr[$user['rank']]['rank'], 'rankDate' => date('Y-m-d H:i:s')]);
                    $check = $this->Main_model->get_single_record('tbl_rewards', ['award_id' => $rankArr[$user['rank']]['rank'], 'user_id' => $user['user_id']], '*');
                    if (empty($check)) {
                        $rewardData = [
                            'user_id' => $user['user_id'],
                            'amount' => $rankArr[$user['rank']]['reward'],
                            'award_id' => $rankArr[$user['rank']]['rank'],
                        ];
                        $this->Main_model->add('tbl_rewards', $rewardData);
                        pr($rewardData);
                        if ($rankArr[$user['rank']]['reward'] > 0) {
                            $IncomeData = [
                                'user_id' => $user['user_id'],
                                'amount' => $rankArr[$user['rank']]['reward'],
                                'type' => 'reward_income',
                                'description' => 'You have Achieved your ' . $rankArr[$user['rank']]['rank'] . ' Reward Income ',
                            ];
                            pr($IncomeData);
                            $this->Main_model->add('tbl_income_wallet', $IncomeData);
                            $this->db->query("UPDATE tbl_roi SET roi_amount = package*0.0033 WHERE user_id = '" . $user['user_id'] . "'");
                        }
                    }
                }
                $rankStatus = false;
            }
        }
    }

    public function resetDailyLimit()
    {
        $date = date('Y-m-d');
        $cron = $this->Main_model->get_single_record('tbl_cron', ['date' => $date, 'cron_name' => 'resetDailyLimit'], '*');
        if (empty($cron)) {
            $this->Main_model->update('tbl_users', ['incomeLimit >' => 0], ['incomeLimit' => 0]);
            $this->Main_model->add('tbl_cron', ['cron_name' => 'resetDailyLimit', 'date' => $date]);
        } else {
            echo 'Today daily limit reset done';
        }
    }

    public function resetPackageLimit()
    {
        $date = date('Y-m-d');
        $users = $this->Main_model->get_records('tbl_users', ['paid_status' => 1, 'retopup' => 0], 'user_id,package_amount,retopup_count');
        foreach ($users as $user) {
            $checkBalance = $this->Main_model->get_single_record('tbl_income_wallet', ['amount >' => 0, 'user_id' => $user['user_id']], 'ifnull(sum(amount),0) as balance');
            $totalBalance = $checkBalance['balance'];
            if ($totalBalance >= ($user['package_amount'] * 5)) {
                pr($user);
                $this->Main_model->update('tbl_users', ['user_id' => $user['user_id']], ['retopup' => 1, 'package_amount' => 0, 'topup_date' => '0000-00-00 00:00:00', 'retopup_count' => ($user['retopup_count'] + 1)]);
            }
        }
    }

    public function approveFund()
    {
        $request = $this->Main_model->get_records('tbl_payment_request', array('status' => 0), '*');
        foreach ($request as $key => $req) {
            if ($req['status'] == 0) {
                $walletData = array(
                    'user_id' => $req['user_id'],
                    'amount' => $req['amount'],
                    'sender_id' => $req['user_id'],
                    'type' => 'auto_fund',
                    'remark' => 'Auto Fund Deposit',
                );
                pr($walletData);
                $this->Main_model->add('tbl_wallet', $walletData);
                $this->Main_model->update('tbl_payment_request', ['id' => $req['id']], ['status' => 1]);
            }
        }
    }

    public function WithdrawCron()
    {
        $date = date('Y-m-d');
        $cron = $this->Main_model->get_single_record('tbl_cron', "cron_name = 'withdraw_cron' and date = '" . $date . "'", '*');
        if (empty($cron)) :
            $users = $this->Main_model->withdraw_users(1);
            pr($users);
            foreach ($users as $key => $user) {
                //$checkKYC = $this->Main_model->get_single_record('tbl_bank_details',['user_id' => $user['user_id']],'*');
                $userinfo = $this->Main_model->get_single_record('tbl_users', ['user_id' => $user['user_id']], '*');
                //if(!empty($checkKYC['bank_account_number'])):
                $DirectIncome = array(
                    'user_id' => $user['user_id'],
                    'amount' => -$user['total_amount'],
                    'type' => 'withdraw_request',
                    'description' => 'Withdraw Request',
                );
                $this->Main_model->add('tbl_income_wallet', $DirectIncome);
                $withdrawArr = array(
                    'user_id' => $user['user_id'],
                    'amount' => $user['total_amount'],
                    'type' => 'withdraw_request',
                    'tds' => $user['total_amount'] * 0 / 100,
                    'admin_charges' => $user['total_amount']  * 0 / 100,
                    'fund_conversion' => 0,
                    'zil_address' => $userinfo['eth_address'],
                    'payable_amount' => $user['total_amount'] * 100 / 100
                );
                $this->Main_model->add('tbl_withdraw', $withdrawArr);
                //endif;
            }
            $this->Main_model->add('tbl_cron', ['cron_name' => 'withdraw_cron', 'date' => $date]);
        else :
            echo 'Today Cron already run';
        endif;
    }

    public function updateTokenValue()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.vindax.com/api/v1/ticker/24hr?symbol=RVCUSDT',
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
        $jsonData = json_decode($response, true);
        pr($jsonData['lastPrice']);
        $apiUrl = 'https://admin.republicexchange.io/api/p2p/live-amount-tracking?coin=RVC';
        $response = file_get_contents($apiUrl);
        $data = json_decode($response, true);
         pr($data['data']['price']); 
            $this->Main_model->update('rvc_price', ['id' => 1], ['price' => $data['data']['price']]);
         $this->Main_model->update('tbl_token_value', ['id' => 1], ['amount' => $jsonData['lastPrice']]);
    }

    public function test_node_api()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://18.216.195.54:3490/',
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
        $jsonData = json_decode($response, true);
        pr($jsonData);
    }


    // public function calculateBusiness() {
    //     $users = $this->Main_model->get_records('tbl_users',['paid_status >' => 0,'directs >=' => 0,'user_id !=' => ''],'user_id,capping,incomeLimit,incomeLimit2,topup_date,rank');
    //     foreach($users as $key => $user){
    //         if($user['rank'] == 0){
    //             $getDirects = $this->Main_model->get_records('tbl_users',['sponser_id' => $user['user_id']],'user_id');
    //             $directArr = [];
    //             foreach($getDirects as $key2 => $gd){
    //                 $selfBusiness = $this->Main_model->get_single_record('tbl_users',['user_id' => $gd['user_id']],'total_package');
    //                 $getBusiness = $this->Main_model->getTeamBusiness($gd['user_id']);
    //                 $directArr[$key2] = [
    //                     'user_id' => $gd['user_id'],
    //                     'business' => $getBusiness['business']+$selfBusiness['total_package'],
    //                 ];
    //             }
    //             $columns = array_column($directArr, 'business');
    //             array_multisort($columns, SORT_DESC, $directArr);
    //             //pr($directArr,true);
    //             $teamA = 0;
    //             $teamB = 0;
    //             foreach($directArr as $dkey => $da){
    //                 if($dkey == 0){
    //                     $teamA = $da['business'];
    //                 }else{
    //                     $teamB += $da['business'];
    //                 }
    //             }


    //             $rankArr = [
    //                 0 => ['business' => 500,'team' => 2500, 'rank' => 1,'reward' => 250,'amount' => 0,'requiredRank' => 0],
    //                 1 => ['business' => 30000,'team' => 10000, 'rank' => 2,'reward' => 500,'amount' => 0,'requiredRank' => 0],
    //                 2 => ['business' => 280000,'team' => 250000 ,'rank' => 3,'reward' => 1000,'amount' => 0,'requiredRank' => 0],
    //                 3 => ['business' => 2780000,'team' => 2500, 'rank' => 4,'reward' => 3500,'amount' => 0,'requiredRank' => 3],
    //                 4 => ['business' => 25000000,'team' => 2500, 'rank' => 5,'reward' => 4500,'amount' => 150000,'requiredRank' => 4],
    //                 5 => ['business' => 25000000,'team' => 2500, 'rank' => 6,'reward' => 5500,'amount' => 150000,'requiredRank' => 5],
    //                 6 => ['business' => 25000000,'team' => 2500, 'rank' => 7,'reward' => 6500,'amount' => 150000,'requiredRank' => 6],
    //                 7 => ['business' => 25000000,'team' => 2500 ,'rank' => 8,'reward' => 7500,'amount' => 150000,'requiredRank' => 7],
    //                 8 => ['business' => 25000000,'team' => 2500, 'rank' => 9,'reward' => 8500,'amount' => 150000,'requiredRank' => 8],
    //                 9 => ['business' => 25000000,'team' => 2500, 'rank' => 10,'reward' => 10000,'amount' => 150000,'requiredRank' => 9],



    //             ];
    //             $checkBusiness = $rankArr[$user['rank']]['business'];
    //             if($teamA >= ($checkBusiness*0.5) && $teamB >= ($checkBusiness*0.5)){
    //                 echo 'user '.$user['user_id'].' | '.$teamA.' | '.$teamB.' | '.$checkBusiness.'<br>';
    //                 $this->Main_model->update('tbl_users',['user_id' => $user['user_id']],['rank' => $rankArr[$user['rank']]['rank']]);
    //                 $check = $this->Main_model->get_single_record('tbl_rewards',['award_id' => $rankArr[$user['rank']]['rank'],'user_id' => $user['user_id']],'*');
    //                 if(empty($check)){
    //                     $rewardData = [
    //                         'user_id' => $user['user_id'],
    //                         'amount' => $rankArr[$user['rank']]['reward'],
    //                         'award_id' => $rankArr[$user['rank']]['rank'],
    //                     ];
    //                     $this->Main_model->add('tbl_rewards',$rewardData);
    //                     pr($rewardData);
    //                     if($rankArr[$user['rank']]['amount'] > 0){
    //                         // if($user['incomeLimit2'] > $user['incomeLimit']){
    //                         //     $totalCredit = $user['incomeLimit'] + $rankArr[$user['rank']]['amount'];
    //                         //     if($totalCredit < $user['incomeLimit2']){
    //                                 $rewards_income = $rankArr[$user['rank']]['amount'];
    //                             // } else {
    //                             //     $rewards_income = $user['incomeLimit2'] - $user['incomeLimit'];
    //                             // }
    //                             $IncomeData = [
    //                                 'user_id' => $user['user_id'],
    //                                 'amount' => $rewards_income, //$reward['amount'],
    //                                 'type' => 'rewards_bonus',
    //                                 'description' => 'You have Achieved level '.$rankArr[$user['rank']]['reward'].' Reward Income',
    //                             ];
    //                             pr($IncomeData);
    //                             $this->Main_model->add('tbl_income_wallet',$IncomeData);
    //                             //$this->Main_model->update('tbl_users',['user_id' => $user['user_id']],['incomeLimit' => ($user['incomeLimit'] + $IncomeData['amount'])]);
    //                         //}
    //                     }
    //                 }
    //             }
    //         } else {
    //             //$getBusiness = $this->Main_model->getTeamBusiness($user['user_id']);
    //             // $getTeamRank = $this->Main_model->get_single_record('tbl_users',['sponser_id' => $user['user_id'],'rank' => $user['rank']],'count(tbl_users.id) as rank');
    //             $getTeamRank = $this->Main_model->getTeamRank($user['user_id'],$user['rank']);

    //             $rankStatus = false;

    //             $rankArr = [
    //                 0 => ['business' => 1250, 'rank' => 1,'reward' => '$125','amount' => 125,'requiredRank' => 0],
    //                 1 => ['business' => 6250, 'rank' => 2,'reward' => 'LAPTOP OR $225','amount' => 0,'requiredRank' => 3],
    //                 2 => ['business' => 21250, 'rank' => 3,'reward' => 'BANGKOK TRIP + ANDROID MOBILE','amount' => 0,'requiredRank' => 4],
    //                 3 => ['business' => 66250, 'rank' => 4,'reward' => 'CAR DP $2,300','amount' => 0,'requiredRank' => 5],
    //                 4 => ['business' => 216250, 'rank' => 5,'reward' => 'CAR DP $11,500','amount' => 0,'requiredRank' => 5],
    //             ];

    //             if($rankStatus == false){
    //                 $rankStatus = ($getTeamRank['rank'] >= $rankArr[$user['rank']]['requiredRank'])?true:false;
    //             }

    //             //business check
    //             $getDirects = $this->Main_model->get_records('tbl_users',['sponser_id' => $user['user_id']],'user_id');
    //             $directArr = [];
    //             foreach($getDirects as $key2 => $gd){
    //                 $selfBusiness = $this->Main_model->get_single_record('tbl_users',['user_id' => $gd['user_id']],'total_package');
    //                 $getBusiness = $this->Main_model->getTeamBusiness($gd['user_id']);
    //                 $directArr[$key2] = [
    //                     'user_id' => $gd['user_id'],
    //                     'business' => $getBusiness['business']+$selfBusiness['total_package'],
    //                 ];
    //             }
    //             $columns = array_column($directArr, 'business');
    //             array_multisort($columns, SORT_DESC, $directArr);
    //             //pr($directArr,true);
    //             $teamA = 0;
    //             $teamB = 0;
    //             foreach($directArr as $dkey => $da){
    //                 if($dkey == 0){
    //                     $teamA = $da['business'];
    //                 }else{
    //                     $teamB += $da['business'];
    //                 }
    //             }

    //             $checkBusiness = $rankArr[$user['rank']]['business'];
    //             if($teamA >= $checkBusiness && $teamB >= $checkBusiness && $rankStatus == true){
    //                 // echo 'user '.$user['user_id'].' | '.$teamA.' | '.$teamB.' | '.$checkBusiness.'<br>';
    //                 $this->Main_model->update('tbl_users',['user_id' => $user['user_id']],['rank' => $rankArr[$user['rank']]['rank']]);
    //                 $check = $this->Main_model->get_single_record('tbl_rewards',['award_id' => $rankArr[$user['rank']]['rank'],'user_id' => $user['user_id']],'*');
    //                 if(empty($check)){
    //                     $rewardData = [
    //                         'user_id' => $user['user_id'],
    //                         'amount' => $rankArr[$user['rank']]['reward'],
    //                         'award_id' => $rankArr[$user['rank']]['rank'],
    //                     ];
    //                     $this->Main_model->add('tbl_rewards',$rewardData);
    //                     pr($rewardData);
    //                     if($rankArr[$user['rank']]['amount'] > 0){
    //                         if($user['incomeLimit2'] > $user['incomeLimit']){
    //                             $totalCredit = $user['incomeLimit'] + $rankArr[$user['rank']]['amount'];
    //                             if($totalCredit < $user['incomeLimit2']){
    //                                 $rewards_income = $rankArr[$user['rank']]['amount'];
    //                             } else {
    //                                 $rewards_income = $user['incomeLimit2'] - $user['incomeLimit'];
    //                             }
    //                             $IncomeData = [
    //                                 'user_id' => $user['user_id'],
    //                                 'amount' => $rewards_income, //$reward['amount'],
    //                                 'type' => 'rewards_bonus',
    //                                 'description' => 'You have Achieved level '.$rankArr[$user['rank']]['reward'].' Reward Income',
    //                             ];
    //                             pr($IncomeData);
    //                             $this->Main_model->add('tbl_income_wallet',$IncomeData);
    //                             $this->Main_model->update('tbl_users',['user_id' => $user['user_id']],['incomeLimit' => ($user['incomeLimit'] + $IncomeData['amount'])]);
    //                         }
    //                     }
    //                 }
    //             }
    //             $rankStatus = false;
    //         }
    //     }
    // }



    // business reward leg cron //
    public function businessCalculationRewardNew()
    {
        // die('d');
        $rewards = $this->config->item('rewardArray');
        // [
        //     1 => ['business' => 2000 ,'reward' => 1,'months' => 200],
        //     2 => ['business' => 7000 ,'reward' => 2.5,'months' => 200],
        //     3 => ['business' => 22000 ,'reward' => 10,'months' => 200],
        //     4 => ['business' => 57000 ,'reward' => 25,'months' => 200],
        //     5 => ['business' => 137000 ,'reward' => 60,'months' => 200],
        //     6 => ['business' => 287000 ,'reward' => 125,'months' => 200],
        //     7 => ['business' => 587000 ,'reward' => 250,'months' => 200],



        // ];
        $date = "2023-07-06 14:00:00";

        foreach ($rewards as $rkey => $reward) {
            $users = $this->Main_model->get_records('tbl_users', ['paid_status >' => 0], '*');
            foreach ($users as $key => $user) {
                $getDirects = $this->Main_model->get_records('tbl_users', ['sponser_id' => $user['user_id']], 'user_id');
                $directArr = [];
                foreach ($getDirects as $key2 => $gd) {
                    $selfBusiness = $this->Main_model->get_single_record('tbl_users', ['user_id' => $gd['user_id']], 'total_package');
                    $date2 = date('Y-m-d H:i:s', strtotime($date . '+ ' . $reward['Days'] . ' days'));

                    $getBusiness = $this->Main_model->getBusiness($gd['user_id'], $date, $date2);
                    $directArr[$key2] = [
                        'user_id' => $gd['user_id'],
                        'business' => $getBusiness['teamBusiness'] + $selfBusiness['total_package'],
                    ];
                }
                $columns = array_column($directArr, 'business');
                array_multisort($columns, SORT_DESC, $directArr);
                $teamA = 0;
                $teamB = 0;
                $i = 1;
                $secondLeg = 0;
                $thirdLeg = 0;
                // $fourthLeg = 0;

                foreach ($directArr as $dkey => $da) {

                    if ($dkey == 0) {
                        $teamA = $da['business'];
                    } else {
                        $teamB += $da['business'];
                        if ($dkey == 1) {

                            $secondLeg = $da['business'];
                        }
                        if ($dkey == 2) {
                            // pr($da);

                            $thirdLeg += $da['business'];
                        }
                        // if($dkey == 4){
                        //     $fourthLeg = $da['business'];
                        // }
                    }
                }

                $response = [
                    'user_id' => $user['user_id'],
                    'teamA' => $teamA,
                    '1st_required' => $reward['business'],
                    'teamB' => $secondLeg,
                    '2nd_required' => $reward['business'],
                    'teamC' => $thirdLeg,
                    '3rd_required' => $reward['otherbusiness'],
                    // 'fourthLeg' => $fourthLeg,
                ];
                pr($response);
                if ($response['teamA'] >= ($reward['business']) && $response['teamB'] >= ($reward['business']) && $response['teamC'] >= ($reward['otherbusiness'])) {
                    $check = $this->Main_model->get_single_record('tbl_roi_reward', ['level' => $rkey, 'user_id' => $user['user_id']], '*');
                    if (empty($check)) {

                        $getReward = $this->Main_model->get_single_record('tbl_roi_reward', 'user_id = "' . $user['user_id'] . '" order by id desc', 'id');
                        if (!empty($getReward)) {
                            $this->Main_model->update('tbl_roi_reward', ['id' => $getReward['id']], ['status' => 1]);
                        }

                        $creditIncome = [
                            'user_id' => $user['user_id'],
                            'amount' => $reward['PerDay'] * $reward['TotalEconomy'],
                            'roi_amount' => $reward['PerDay'],
                            'days' => $reward['TotalEconomy'], //100,
                            'total_days' => $reward['TotalEconomy'], //100,
                            'type' => 'rewards_income',
                            'level' => $rkey,
                        ];
                        $this->Main_model->add('tbl_roi_reward', $creditIncome);
                        //     $rewardData = [
                        //         'user_id' => $user['user_id'],
                        //         'amount' => $reward['reward'],
                        //         'award_id' => $rkey,
                        //         'days' => ($reward['months']-1),
                        //         'total_days' => $reward['months'],
                        //     ];
                        //     pr($rewardData);
                        //    $this->Main_model->add('tbl_rewards',$rewardData);

                        // $coinAdd = [
                        //     'user_id' => $user['user_id'],
                        //     'amount' => $reward['reward'],
                        //     'type' => "reward_coin",
                        //     'description' => "Reward Coin"
                        // ];
                        // $this->Main_model->add('tbl_coin_wallet',$coinAdd);

                        // $roiArr = array(   // User Roi
                        //     'user_id' => $user_id,
                        //     'amount' => $reward['reward']*$reward['months'],
                        //     'roi_amount' =>$reward['reward'],
                        //     'days' => $reward['months'],
                        //     'total_days' => $reward['months'],
                        //     'type' => 'reward_income',
                        //     'creditDate' => date('Y-m-d'),
                        // );
                        // pr($roiArr);
                        //   $this->User_model->add('tbl_reward_roi', $roiArr);

                        echo '<p style="color:green;"> Reward Credited....</p>';
                        pr($creditIncome);
                        // $userinfo = $this->Main_model->get_single_record('tbl_users',['user_id' => $user['user_id']],'incomeLimit,incomeLimit2');
                        // if($userinfo['incomeLimit2'] > $userinfo['incomeLimit']){
                        //     $totalCredit = $userinfo['incomeLimit'] + $reward['reward'];
                        //     if($totalCredit < $userinfo['incomeLimit2']){
                        //    $reward_income = $reward['reward'];
                        // } else {
                        //     $reward_income = $userinfo['incomeLimit2'] - $userinfo['incomeLimit'];
                        // }
                        // $IncomeData = [
                        //     'user_id' => $user['user_id'],
                        //     'amount' => $reward_income,
                        //     'type' => 'life_time_reward',
                        //     'description' => 'You have Achieved your '.$rkey.' Life Time Reward Income From Business Team A '.$teamA.' & Team B '.$secondLeg.' & Team C '.$thirdLeg,
                        // ];
                        // pr($IncomeData);
                        //    $this->Main_model->add('tbl_income_wallet',$IncomeData);
                        //  $this->Main_model->update('tbl_users',['user_id' => $user['user_id']],['incomeLimit' => ($userinfo['incomeLimit'] + $IncomeData['amount'])]);
                        //}
                        //    $this->Main_model->update('tbl_users',['user_id' => $user['user_id']],['rewardLevel' => $rkey]);
                    }
                }
            }
        }
    }
    /*business reward leg cron  end */



    public function businessCalculationRewardNew2()
    {
        $rewards = $this->config->item('rewardArray');
        $date = "2023-07-06 14:00:00";
        foreach ($rewards as $rkey => $reward) {
            $users = $this->Main_model->get_records('tbl_users', ['paid_status >' => 0], '*');
            foreach ($users as $key => $user) {
                $getDirects = $this->Main_model->get_records('tbl_users', ['sponser_id' => $user['user_id']], 'user_id,total_package,topup_date');
                $directArr = [];

                foreach ($getDirects as $key2 => $gd) {
                    $selfBusiness = $this->Main_model->get_single_record('tbl_users', ['user_id' => $gd['user_id']], 'package_amount,total_package ');
                    $date2 = date('Y-m-d H:i:s', strtotime($date . '+ ' . $reward['Days'] . ' days'));
                    $getBusiness = $this->Main_model->getBusiness($gd['user_id'], $date, $date2);
                    $directArr[$key2] = [
                        'user_id' => $gd['user_id'],
                        'business' => $getBusiness['teamBusiness'] + $selfBusiness['total_package'],
                        'package' => $gd['total_package'],
                    ];
                }
                $columns = array_column($directArr, 'business');
                array_multisort($columns, SORT_DESC, $directArr);
                $teamA = 0;
                $teamB = 0;
                $teamC = 0;


                foreach ($directArr as $dkey => $da) {
                    if ($dkey == 0) {
                        $teamA = $da['business'];
                    } elseif ($dkey == 1) {
                        $teamB = $da['business'];
                    } else {
                        $teamC += $da['business'];
                    }
                }

                $response = [
                    'user_id' => $user['user_id'],
                    'teamA' => $teamA,
                    'teamB' => $teamB,
                    'teamC' => $teamC,

                ];
                pr($response);
                if ($response['teamA'] >= ($reward['TeamA']) && $response['teamB'] >= ($reward['TeamB']) && $response['teamC'] >= ($reward['TeamC'])) {
                    $check = $this->Main_model->get_single_record('tbl_roi_reward', ['level' => $rkey, 'user_id' => $user['user_id']], '*');
                    if (empty($check)) {
                        $creditIncome = [
                            'user_id' => $user['user_id'],
                            'amount' => $reward['PerDay'] * 100,
                            'roi_amount' => $reward['PerDay'],
                            'days' => 100,
                            'total_days' => 100,
                            'type' => 'rewards_income',
                            'level' => $rkey,
                        ];
                        // $this->Main_model->add('tbl_roi_reward', $creditIncome);
                        // $rewardData = [
                        //     'user_id' => $user['user_id'],
                        //     'amount' => $reward['reward'],
                        //     'award_id' => $rkey,
                        // ];
                        // $this->Main_model->add('tbl_rewards',$rewardData);

                        // echo '<p style="color:green;"> Reward Credited....</p>';
                        // pr($rewardData);
                        // $userinfo = $this->Main_model->get_single_record('tbl_users',['user_id' => $user['user_id']],'incomeLimit,incomeLimit2');
                        // if($userinfo['incomeLimit2'] > $userinfo['incomeLimit']){
                        //     $totalCredit = $userinfo['incomeLimit'] + $reward['reward'];
                        //     if($totalCredit < $userinfo['incomeLimit2']){
                        //        $reward_income = $reward['reward'];
                        //     } else {
                        //         $reward_income = $userinfo['incomeLimit2'] - $userinfo['incomeLimit'];
                        //     }
                        //     $IncomeData = [
                        //         'user_id' => $user['user_id'],
                        //         'amount' => $reward_income,
                        //         'type' => 'rewards_income',
                        //         'description' => 'You have Achieved your '.$rkey.' Life Time Reward Income From Business Team A '.$teamA.' & Team B '.$teamB,
                        //     ];
                        //     pr($IncomeData);
                        //     $this->Main_model->add('tbl_income_wallet',$IncomeData);
                        //    $this->Main_model->update('tbl_users',['user_id' => $user['user_id']],['incomeLimit' => ($userinfo['incomeLimit'] + $IncomeData['amount'])]);
                        // }
                        // // $this->Main_model->update('tbl_users',['user_id' => $user['user_id']],['rewardLevel' => $rkey]);
                    }
                }
            }
        }
    }


    public function roiRerawdCron()
    {
        $date = date('Y-m-d');
        $cron = $this->Main_model->get_single_record('tbl_cron', ['date' => $date, 'cron_name' => 'roiRerawdCron'], '*');
        if (empty($cron)) {
            $this->Main_model->add('tbl_cron', ['cron_name' => 'roiRerawdCron', 'date' => $date]);
            $roi_users = $this->Main_model->get_records('tbl_roi_reward', array('days >' => 0, 'status' => 0), '*');
            $tokenValue = $this->Main_model->get_single_record('tbl_token_value', ['id' => 1], '*');
            foreach ($roi_users as $key => $user) {
                $date1 = date('Y-m-d H:i:s');
                $date2 = date('Y-m-d H:i:s', strtotime($user['creditDate'] . '+ 0 days'));
                $diff = strtotime($date1) - strtotime($date2);
                // echo $diff.' / '.$user['user_id'].'<br>';
                if ($diff >= 0) {
                    $userinfo = $this->Main_model->get_single_record('tbl_users', ['user_id' => $user['user_id']], 'package_amount,incomeLimit,incomeLimit2');
                    if ($userinfo['incomeLimit2'] > $userinfo['incomeLimit']) {

                        $totalCredit = $userinfo['incomeLimit'] + $user['roi_amount'];
                        if ($totalCredit < $userinfo['incomeLimit2']) {
                            $roi_amount = $user['roi_amount'];
                        } else {
                            $roi_amount = $userinfo['incomeLimit2'] - $userinfo['incomeLimit'];
                        }
                        $new_day = $user['days'] - 1;
                        $days = ($user['total_days'] + 1) - $user['days'];
                        if($days <= 100){
                            $incomeArr = array(
                                'user_id' => $user['user_id'],
                                // 'amount' => $roi_amount/24, ///$tokenValue['amount'],
                                'amount' => $roi_amount, ///$tokenValue['amount'],
                                'type' => 'booster_rewards_income',
                                'description' => 'Reward Income at Day ' . $days,
                                //'withdraw_date' => date('Y-m-d H:i:s',strtotime($user['created_at'].'+ '.$user['total_days'].' days')),
                            );
                            pr($incomeArr);
                            $this->Main_model->add('tbl_income_wallet', $incomeArr);
                            $this->Main_model->update('tbl_users', ['user_id' => $user['user_id']], ['incomeLimit' => ($userinfo['incomeLimit'] + $incomeArr['amount'])]);
                            // $this->Main_model->update('tbl_users', ['user_id' => $user['user_id']], ['incomeLimit' => ($userinfo['incomeLimit'] + $incomeArr['amount'])]);
                            $this->Main_model->update('tbl_roi_reward', array('id' => $user['id']), array('days' => $new_day, 'amount' => ($user['amount'] - $user['roi_amount']), 'creditDate' => date('Y-m-d')));
                            $sponsor = $this->Main_model->get_single_record('tbl_users', ['user_id' => $user['user_id']], 'sponser_id');
                        }else{
                            echo 0;
                        }
                    }
                }
            }
        } else {
            echo 'Today cron already run';
        }
    }

    public function afterincomeLimit(){
        $users = $this->Main_model->get_records('tbl_roi',['days >' => 0],'user_id,days,package');
        $i = 1;
        foreach ($users as $key => $use) {
                $totalAmount = $use['package']*3;
                $userDetails = $this->Main_model->get_single_record('tbl_users',['user_id' => $use['user_id']],'incomeLimit');
                if($userDetails['incomeLimit'] >= $totalAmount){
                    echo $i;
                    $userData = [
                        'user_id' => $use['user_id'],
                        'days' =>  $use['days'],
                        'package' => $use['package'],
                        'incomeLimit' => $userDetails['incomeLimit'],
                        'incomeLimit2' => $totalAmount 
                    ];
                    pr($userData);
                    $i++;
                }

        }
    }
}
