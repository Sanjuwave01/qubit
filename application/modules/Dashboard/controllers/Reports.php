<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'pagination'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user'));
        date_default_timezone_set('Asia/Kolkata');
        if (is_logged_in() === false) {
            redirect('Dashboard/Management/logout');
            exit;
        }
    }

    public function stackHistory()
    {
        $response['header'] = 'Stack History';
        $type = $this->input->get('type');
        $value = $this->input->get('value');
        $where = ['user_id' => $this->session->userdata['user_id']];
        if (!empty($type)) {
            $where = [$type => $value];
        }
        $records = $this->pagination('tbl_stack_wallet', $where, '*', 'Dashboard/Reports/stackHistory', 4, 100);
        $response['path'] =  $records['path'];
        $searchField = '<div class="col-4">
                            <select class="form-control" name="type">
                                <option value="name" ' . $type . ' == "name" ? "selected" : "";?>
                                    Name</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" name="value" class="form-control text-white float-right"
                                value="' . $value . '" placeholder="Search">
                        </div>
                        <div class="col-4">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>';
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Stake Price</th>
                                <th>Maturity Amount</th>
                                <th>Stacking Date</th>
                                <th>Maturity Date</th>
                                <th>Timmer</th>
                             </tr>';
        $tbody = [];
        $i = $records['segment'] + 1;
        foreach ($records['records'] as $key => $rec) {
            extract($rec);
            $diff = strtotime('+' . $rec['months'] . ' months', strtotime($rec['created_at'])) - strtotime(date('Y-m-d H:i:s'));
            $timmer = '<div class="text-danger" id="timer' . $key . '"></div><script> countdown("timer' . $key . '","' . $diff . '") </script>';
            // $button =  form_open().form_hidden('orderID',$order_id).form_submit(['type' => 'submit','class' => 'btn btn-success','value' => 'Withdraw']);
            $tbody[$key]  = ' <tr>
                                <td>' . $i . '</td>
                                <td>$' . $amount . '</td>
                                <td>' . $token_price . '</td>
                                <td>' . $maturity_amount . '</td>
                                <td>' . $created_at . '</td>
                                <td>' . $maturity_date . '</td>
                                <td>' . $timmer . '</td>
                             </tr>';
            $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('reports', $response);
    }

    public function MyDirects()
    {
        $response['header'] = 'MyDirects';
        $type = $this->input->get('type');
        $value = $this->input->get('value');
        $where = ['user_id' => $this->session->userdata['user_id']];
        if (!empty($type)) {
            $where = [$type => $value];
        }
        $records = $this->pagination('tbl_users', $where, '*', 'Dashboard/Reports/MyDirects', 4, 100);
        $response['path'] =  $records['path'];
        $searchField = '<div class="col-4">
                            <select class="form-control" name="type">
                                <option value="name" ' . $type . ' == "name" ? "selected" : "";?>
                                    Name</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" name="value" class="form-control text-white float-right"
                                value="' . $value . '" placeholder="Search">
                        </div>
                        <div class="col-4">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>';
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>E Mail</th>
                                <th>Phone</th>
                                <th>Staking Coin</th>
                                <th>Joining Date</th>
                                <th>Top UP Date</th>
                                
                             </tr>';
        $tbody = [];
        $i = $records['segment'] + 1;
        foreach ($records['records'] as $key => $rec) {
            extract($rec);
            $diff = strtotime('+' . $rec['months'] . ' months', strtotime($rec['created_at'])) - strtotime(date('Y-m-d H:i:s'));
            $timmer = '<div class="text-danger" id="timer' . $key . '"></div><script> countdown("timer' . $key . '","' . $diff . '") </script>';
            // $button =  form_open().form_hidden('orderID',$order_id).form_submit(['type' => 'submit','class' => 'btn btn-success','value' => 'Withdraw']);
            $tbody[$key]  = ' <tr>
                                <td>' . $i . '</td>
                                <td>$' . $user_id . '</td>
                                <td>' . $name . '</td>
                                <td>' . $email . '</td>
                                <td>' . $phone . '</td>
                                <td>' . $stakeCoin . '</td>
                                <td>' . $created_at . '</td>
                                <td>' . $topup_date . '</td>
                             </tr>';
            $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('reports', $response);
    }

    public function magneticHistory()
    {
        $response['header'] = 'Magnetic Plan History';
        $type = $this->input->get('type');
        $value = $this->input->get('value');
        $where = ['user_id' => $this->session->userdata['user_id']];
        if (!empty($type)) {
            $where = [$type => $value];
        }
        $records = $this->pagination('tbl_roi', $where, '*', 'Dashboard/Reports/magneticHistory', 4, 100);
        $response['path'] =  $records['path'];
        $searchField = '<div class="col-4">
                            <select class="form-control" name="type">
                                <option value="name" ' . $type . ' == "name" ? "selected" : "";?>
                                    Name</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" name="value" class="form-control text-white float-right"
                                value="' . $value . '" placeholder="Search">
                        </div>
                        <div class="col-4">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>';
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Coin</th>
                                <th>Months</th>
                                <th>Date</th>
                                <th>Timmer</th>
                             </tr>';
        $tbody = [];
        $i = $records['segment'] + 1;
        foreach ($records['records'] as $key => $rec) {
            extract($rec);
            $diff = strtotime('+' . $rec['total_days'] . ' months', strtotime($rec['created_at'])) - strtotime(date('Y-m-d H:i:s'));
            $timmer = '<div class="text-danger" id="timer' . $key . '"></div><script> countdown("timer' . $key . '","' . $diff . '") </script>';
            // $button =  form_open().form_hidden('orderID',$order_id).form_submit(['type' => 'submit','class' => 'btn btn-success','value' => 'Withdraw']);
            $tbody[$key]  = ' <tr>
                                <td>' . $i . '</td>
                                <td>' . $package . '</td>
                                <td>' . $coin . '</td>
                                <td>' . $total_days . '</td>
                                <td>' . $created_at . '</td>
                                <td>' . $timmer . '</td>
                             </tr>';
            $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('reports', $response);
    }

    public function StakeHistory()
    {
        $response['header'] = 'Stake History';
        $type = $this->input->get('type');
        $value = $this->input->get('value');
        $where = ['user_id' => $this->session->userdata['user_id']];
        if (!empty($type)) {
            $where = [$type => $value];
        }
        $records = $this->pagination('tbl_roi', $where, '*', 'Dashboard/Reports/StakeHistory', 4, 100);
        $response['path'] =  $records['path'];
        $searchField = '<div class="col-4">
                            <select class="form-control" name="type">
                                <option value="name" ' . $type . ' == "name" ? "selected" : "";?>
                                    Name</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" name="value" class="form-control text-white float-right"
                                value="' . $value . '" placeholder="Search">
                        </div>
                        <div class="col-4">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>';
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Coin</th>
                                <th>Days</th>
                                <th>Total Days</th>
                                <th>Date</th>
                              
                             </tr>';
        $tbody = [];
        $i = $records['segment'] + 1;
        foreach ($records['records'] as $key => $rec) {
            extract($rec);

            $tbody[$key]  = ' <tr>
                                <td>' . $i . '</td>
                                <td>' . $package . '</td>
                                <td>' . $coin . '</td>
                                <td>' . $days . '</td>
                                <td>' . $total_days . '</td>
                                <td>' . $created_at . '</td>
                             </tr>';
            $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('reports', $response);
    }


    public function TopuptHistory()
    {
        $response['header'] = 'Topup Wallet Ledger';
        $type = $this->input->get('type');
        $value = $this->input->get('value');
        $where = ['user_id' => $this->session->userdata['user_id']];
        if (!empty($type)) {
            $where = [$type => $value];
        }
        $records = $this->pagination('tbl_wallet', $where, '*', 'Dashboard/Reports/TopuptHistory', 4, 100);
        $response['path'] =  $records['path'];
        $searchField = '<div class="col-4">
                            <select class="form-control" name="type">
                                <option value="name" ' . $type . ' == "name" ? "selected" : "";?>
                                    Name</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" name="value" class="form-control text-white float-right"
                                value="' . $value . '" placeholder="Search">
                        </div>
                        <div class="col-4">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>';
        $response['field'] = '';
        $response['thead'] = '<tr>
                                    <th>#</th>
                                    <th>Amount</th>
                                    <th>Sender ID</th>
                                    <th>Type</th>
                                    <th>Remark</th>
                                    <th>Date</th>
                             </tr>';
        $tbody = [];
        $i = $records['segment'] + 1;
        foreach ($records['records'] as $key => $rec) {
            extract($rec);
            // $button =  form_open().form_hidden('orderID',$order_id).form_submit(['type' => 'submit','class' => 'btn btn-success','value' => 'Withdraw']);
            $tbody[$key]  = ' <tr>
                                    <td>' . $i . '</td>
                                    <td>' . $amount . '</td>
                                    <td>' . $sender_id . '</td>
                                    <td>' . $type . '</td>
                                    <td>' . $remark . '</td>
                                    <td>' . $created_at . '</td>
                             </tr>';
            $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('reports', $response);
    }

    public function incomesLedger()
    {
        $response['header'] = 'Income Ledger';
        $type = $this->input->get('type');
        $value = $this->input->get('value');
        $where = ['user_id' => $this->session->userdata['user_id']];
        if (!empty($type)) {
            $where = [$type => $value];
        }
        $records = $this->pagination('tbl_income_wallet', $where, '*', 'Dashboard/Reports/incomesLedger', 4, 100);
        $response['path'] =  $records['path'];
        $searchField = '<div class="col-4">
                            <select class="form-control" name="type">
                                <option value="name" ' . $type . ' == "name" ? "selected" : "";?>
                                    Name</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" name="value" class="form-control text-white float-right"
                                value="' . $value . '" placeholder="Search">
                        </div>
                        <div class="col-4">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>';
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Date</th>
                             </tr>';
        $tbody = [];
        $i = $records['segment'] + 1;
        foreach ($records['records'] as $key => $rec) {
            extract($rec);
            // $button =  form_open().form_hidden('orderID',$order_id).form_submit(['type' => 'submit','class' => 'btn btn-success','value' => 'Withdraw']);
            $tbody[$key]  = ' <tr>
                                <td>' . $i . '</td>
                                <td>' . $amount . '</td>
                                <td>' . ucwords(str_replace('_', ' ', $type)) . '</td>
                                <td>' . $description . '</td>
                                <td>' . $created_at . '</td>
                             </tr>';
            $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('reports', $response);
    }


    public function businessIncomes()
    {
        $response['header'] = 'User Business /Direct/Team/Other';
        $type = $this->input->get('type');
        $value = $this->input->get('value');
        $where = ['user_id' => $this->session->userdata['user_id']];
        if (!empty($type)) {
            $where = [$type => $value];
        }
        $records = $this->pagination('tbl_income_wallet', $where, '*', 'Dashboard/Reports/incomesLedger', 4, 100);
        
        $response['path'] =  $records['path'];
        $searchField = '<div class="col-4">
                            <select class="form-control" name="type">
                                <option value="name" ' . $type . ' == "name" ? "selected" : "";?>
                                    Name</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" name="value" class="form-control text-white float-right"
                                value="' . $value . '" placeholder="Search">
                        </div>
                        <div class="col-4">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>';
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Date</th>
                             </tr>';
        $tbody = [];
        $i = $records['segment'] + 1;
        foreach ($records['records'] as $key => $rec) {
            extract($rec);
            // $button =  form_open().form_hidden('orderID',$order_id).form_submit(['type' => 'submit','class' => 'btn btn-success','value' => 'Withdraw']);
            $tbody[$key]  = ' <tr>
                                <td>' . $i . '</td>
                                <td>' . $amount . '</td>
                                <td>' . ucwords(str_replace('_', ' ', $type)) . '</td>
                                <td>' . $description . '</td>
                                <td>' . $created_at . '</td>
                             </tr>';
            $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('user_bussiness_income', $response);
    }

    public function coinHistory()
    {
        $response['header'] = 'Coin History';
        $type = $this->input->get('type');
        $value = $this->input->get('value');
        $where = ['user_id' => $this->session->userdata['user_id']];
        if (!empty($type)) {
            $where = [$type => $value];
        }
        $records = $this->pagination('tbl_coin_wallet', $where, '*', 'Dashboard/coin-history', 2, 100);
        $response['path'] =  $records['path'];
        $searchField = '<div class="col-4">
                            <select class="form-control" name="type">
                                <option value="name" ' . $type . ' == "name" ? "selected" : "";?>
                                    Name</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" name="value" class="form-control text-white float-right"
                                value="' . $value . '" placeholder="Search">
                        </div>
                        <div class="col-4">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>';
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Date</th>
                             </tr>';
        $tbody = [];
        $i = $records['segment'] + 1;
        foreach ($records['records'] as $key => $rec) {
            extract($rec);
            // $diff = strtotime('+'.$rec['total_days'].' months', strtotime($rec['created_at'])) - strtotime(date('Y-m-d H:i:s'));
            // $timmer = '<div class="text-danger" id="timer'.$key.'"></div><script> countdown("timer'.$key.'","'.$diff.'") </script>';
            // $button =  form_open().form_hidden('orderID',$order_id).form_submit(['type' => 'submit','class' => 'btn btn-success','value' => 'Withdraw']);
            $tbody[$key]  = ' <tr>
                                <td>' . $i . '</td>
                                <td>' . $amount . '</td>
                                <td>' . ucwords(str_replace('_', ' ', $type)) . '</td>
                                <td>' . $description . '</td>
                                <td>' . $created_at . '</td>
                             </tr>';
            $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('reports', $response);
    }


    public function incomes($getType)
    {

        $type = $this->input->get('type');
        $type = $this->input->get('type');
       // echo $type;
       // die;
        $value = $this->input->get('value');
        $where = ['user_id' => $this->session->userdata['user_id'], 'type' => $getType];
        if (!empty($type)) {
            $where = [$type => $value];
        }
        if ($getType == 'principle_reedem') {
            $table = 'tbl_income_wallet1';
        } elseif ($getType == 'daily_minting_profit') {
            $table = 'tbl_holding_wallet';
        } else {
            $table = 'tbl_income_wallet';
        }

        $totalBalance = $this->User_model->get_single_record($table, ['user_id' => $this->session->userdata['user_id'], 'type' => $getType], 'ifnull(sum(amount),0)as TotalAmount');
        $response['header'] = ucwords(str_replace('_', ' ', $getType)) . '(Total:- $' . $totalBalance['TotalAmount'] . ')';
        $records = $this->pagination($table, $where, '*', "Dashboard/Reports/incomes/".$getType, 5, 30);
        // echo "<pre>";
        // print_r($table);
        // die;
        $response['path'] =  $records['path'];
        $searchField = '<div class="col-4">
                            <select class="form-control" name="type">
                                <option value="name" ' . $type . ' == "name" ? "selected" : "";?>
                                    Name</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" name="value" class="form-control text-white float-right"
                                value="' . $value . '" placeholder="Search">
                        </div>
                        <div class="col-4">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>';
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Withdraw Date</th>
                             </tr>';
        $tbody = [];
        $i = $records['segment'] + 1;
        foreach ($records['records'] as $key => $rec) {
            extract($rec);
            // $button =  form_open().form_hidden('orderID',$order_id).form_submit(['type' => 'submit','class' => 'btn btn-success','value' => 'Withdraw']);
            $tbody[$key]  = ' <tr>
                                <td>' . $i . '</td>
                                <td>$' . $amount . '</td>
                                <td>' . ucwords(str_replace('_', ' ', $type)) . '</td>
                                <td>' . $description . '</td>
                                <td>' . $created_at . '</td>
                                <td>' . $withdraw_date . '</td>
                             </tr>';
            $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('reports', $response);
    }


    public function incomesHolding()
    {
        $response['header'] = 'Staking Ledger';
        $type = $this->input->get('type');
        $value = $this->input->get('value');
        $where = ['user_id' => $this->session->userdata['user_id']];
        if (!empty($type)) {
            $where = [$type => $value];
        }
        $records = $this->pagination('tbl_holding_wallet', $where, '*', 'Dashboard/Reports/incomesHolding', 4, 100);
        $response['path'] =  $records['path'];
        $searchField = '<div class="col-4">
                            <select class="form-control" name="type">
                                <option value="name" ' . $type . ' == "name" ? "selected" : "";?>
                                    Name</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" name="value" class="form-control text-white float-right"
                                value="' . $value . '" placeholder="Search">
                        </div>
                        <div class="col-4">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>';
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Date</th>
                             </tr>';
        $tbody = [];
        $i = $records['segment'] + 1;
        foreach ($records['records'] as $key => $rec) {
            extract($rec);
            // $button =  form_open().form_hidden('orderID',$order_id).form_submit(['type' => 'submit','class' => 'btn btn-success','value' => 'Withdraw']);
            $tbody[$key]  = ' <tr>
                                <td>' . $i . '</td>
                                <td>' . $amount . '</td>
                                <td>' . ucwords(str_replace('_', ' ', $type)) . '</td>
                                <td>' . $description . '</td>
                                <td>' . $created_at . '</td>
                             </tr>';
            $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('reports', $response);
    }

    public function payout_summary()
    {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->payout_summary();
            
            foreach ($response['records'] as $key => $record) {
                //
                $incomes = $this->User_model->get_incomes('tbl_income_wallet', 'date(created_at) = "' . $record['date'] . '" and user_id = "' . $this->session->userdata['user_id'] . '" and amount > 0', 'ifnull(sum(amount),0) as sum,type');
                $response['records'][$key]['incomes'] = calculate_income($incomes);
            }
            $response['type'] = $this->User_model->get_records('tbl_income_wallet', "type != 'withdraw_request' and type!='reward_income' and type!='passive_income' and amount > '0' Group by type", 'type');
            //pr($response,true);
            $this->load->view('payout_summary', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    
    public function pagination($table, $where, $select, $base_url, $segment, $per_page)
    {
        $config['total_rows'] = $this->User_model->get_sum($table, $where, 'ifnull(count(id),0) as sum');
        $config['base_url'] = base_url($base_url);
        $config['suffix'] = '?' . http_build_query($_GET);
        $config['uri_segment'] = $segment;
        $config['per_page'] = $per_page;
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
        $segment = $this->uri->segment($segment);
        $records = $this->User_model->get_limit_records($table, $where, $select, $config['per_page'], $segment);
        $response = ['records' => $records, 'segment' => $segment, 'path' => $config['base_url']];
        return $response;
    }

    //   public function coinHistory(){
    //     $response['header'] = 'Coin Wallet History';
    //     $type = $this->input->get('type');
    //     $value = $this->input->get('value');
    //     $where = ['user_id' => $this->session->userdata['user_id']];
    //     if(!empty($type)){
    //        $where=[$type => $value];
    //     }
    //     $records = $this->pagination('tbl_coin_wallet',$where,'*','Dashboard/Reports/incomesLedger',4,10);
    //     $response['path'] =  $records['path'];
    //     $searchField = '<div class="col-4">
    //                         <select class="form-control" name="type">
    //                             <option value="name" '.$type.' == "name" ? "selected" : "";
    //                                 Name</option>
    //                         </select>
    //                     </div>
    //                     <div class="col-4">
    //                         <input type="text" name="value" class="form-control text-white float-right"
    //                             value="'.$value.'" placeholder="Search">
    //                     </div>
    //                     <div class="col-4">
    //                         <div class="input-group-append">
    //                             <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
    //                         </div>
    //                     </div>';
    //     $response['field'] = '';
    //     $response['thead'] = '<tr>
    //                             <th>#</th>
    //                             <th>Amount</th>
    //                             <th>Type</th>
    //                             <th>Description</th>
    //                             <th>Date</th>
    //                          </tr>';
    //      $tbody = [];
    //      $i = $records['segment'] +1;
    //     foreach ($records['records'] as $key => $rec) {
    //         extract($rec);
    //         // $button =  form_open().form_hidden('orderID',$order_id).form_submit(['type' => 'submit','class' => 'btn btn-success','value' => 'Withdraw']);
    //         $tbody[$key]  = ' <tr>
    //                             <td>'.$i.'</td>
    //                             <td>'.$amount.'</td>
    //                             <td>'.ucwords(str_replace('_',' ',$type)).'</td>
    //                             <td>'.$description.'</td>
    //                             <td>'.$created_at.'</td>
    //                          </tr>';
    //                          $i++;
    //     }
    //     $response['tbody'] = $tbody;
    //     $this->load->view('reports',$response);
    // }
     public function Stackinghistory()
{
    $user_id = $this->session->userdata['user_id'];
    $where = ['user_id' => $this->session->userdata['user_id']];
    
    $config['base_url'] = base_url() . 'Dashboard/Reports/Stackinghistory';
    $config['total_rows'] = $this->User_model->get_sum('tbl_roi', $where, 'count(id) as sum');
    $config['per_page'] = 100;
    $config['uri_segment'] = 4;
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
    $response['links'] = $this->pagination->create_links();
   $this->db->order_by('created_at', 'ASC');
     $response['stake_history'] = $this->db->get_where('tbl_roi', $where)->result_array();

    $response['live_token'] = $this->User_model->get_single_record('tbl_token_value', [], '*');
    $response['segment'] = $segment;
    $this->load->view('stackingHistory', $response);
}
 
  
 public function Stackinghistory20()
{
    $user_id = $this->session->userdata['user_id'];
    $where = ['user_id' => $this->session->userdata['user_id']];
    
    $config['base_url'] = base_url() . 'Dashboard/Reports/Stackinghistory20';
    $config['total_rows'] = $this->User_model->get_sum('tbl_roi_20', $where, 'count(id) as sum');
    $config['per_page'] = 100;
    $config['uri_segment'] = 4;
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
    $response['links'] = $this->pagination->create_links();
   
$this->db->order_by('id', 'ASC');   
     $response['stake_history'] = $this->db->get_where('tbl_roi_20', $where)->result_array();
    $response['live_token'] = $this->User_model->get_single_record('tbl_token_value', [], '*');
    $response['segment'] = $segment;
    $this->load->view('stackingHistory', $response);
}




    public function DirectReport(){
        $response['header'] = 'Team Business Report';
        $type = $this->input->get('type');
        $value = $this->input->get('value');
        $where = ['sponser_id' => $this->session->userdata['user_id']];
        if(!empty($type)){
           $where=[$type => $value];
        }
        $records = $this->pagination('tbl_users',$where,'*','Dashboard/Reports/DirectReport',4,100);
        $response['path'] =  $records['path'];
        $searchField = '<div class="col-4">
                            <select class="form-control" name="type">
                                <option value="name" '.$type.' == "name" ? "selected" : "";?>
                                    Name</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" name="value" class="form-control text-white float-right"
                                value="'.$value.'" placeholder="Search">
                        </div>
                        <div class="col-4">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>';
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>User ID</th>
                                <th>Package</th>
                                <th>Team Business</th>
                                <th>Total Business</th>

                             </tr>';
        $tbody = [];
        $i = $records['segment'] +1;
        // $tokenValue = $this->User_model->get_single_record('tbl_token_value',['id' => 1],'amount');
        $date = "2023-07-06 14:00:00";
        
        foreach ($records['records'] as $key => $rec) {
            extract($rec);
            $business = $this->User_model->getBusiness2($user_id,$date);
            // if()
            $totalBusiness = ($total_package+$business['teamBusiness']);
            // if($topup_date == '0000-00-00 00:00:00'){
            //     $total_package = 0;
            //     $totalBusiness = $business['business'];
            // }
            $tbody[$key]  = ' <tr>
                                <td>'.$i.'</td>
                                <td>'.$user_id.'</td>
                                <td>'.$total_package.'</td>
                                <td>'.$business['teamBusiness'].'</td>
                                <td>'.$totalBusiness.'</td>
                             </tr>';
                             $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('reports',$response);
    }
}
