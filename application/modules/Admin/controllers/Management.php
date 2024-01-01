<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Management extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email', 'pagination'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }

    public function index()
    {
        if (is_admin()) {
            $response = array();
            $response['total_users'] = $this->Main_model->get_sum('tbl_users', array(), 'ifnull(count(id),0) as sum');
            $response['paid_users'] = $this->Main_model->get_sum('tbl_users', array('paid_status' => '1'), 'ifnull(count(id),0) as sum');
            $response['totalSms'] = $this->Main_model->get_single_record('tbl_sms_counter', [], 'count(id) as totalSms');
            $response['today_joined_users'] = $this->Main_model->get_sum('tbl_users', 'date(created_at) = date(now())', 'ifnull(count(id),0) as sum');
            $response['today_paid_users'] = $this->Main_model->get_sum('tbl_users', 'date(created_at) = date(now()) and paid_status > 0', 'ifnull(count(id),0) as sum');
            $response['total_payout'] = $this->Main_model->get_sum('tbl_income_wallet', array('amount > ' => 0), 'ifnull(sum(amount),0) as sum');
            $response['total_stake'] = $this->Main_model->get_sum('tbl_roi', array(), 'ifnull(sum(package),0) as sum');

            $response['total_staked_coin'] = $this->Main_model->get_sum('tbl_roi', array(), 'ifnull(sum(coin),0) as sum');


            $response['global_matrix_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'global_matrix_income'), 'ifnull(sum(amount),0) as sum , type');
            $response['smart_matrix_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'smart_matrix_income'), 'ifnull(sum(amount),0) as sum , type');
            $response['direct_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'direct_income'), 'ifnull(sum(amount),0) as sum , type');
            $response['single_leg'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'single_leg'), 'ifnull(sum(amount),0) as sum , type');
            $response['self_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'self_income'), 'ifnull(sum(amount),0) as sum , type');
            $response['turnover_rewards'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'turnover_rewards'), 'ifnull(sum(amount),0) as sum , type');
            $response['matching_bonus'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'matching_bonus'), 'ifnull(sum(amount),0) as sum , type');
            $response['level_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'level_income'), 'ifnull(sum(amount),0) as sum , type');
            $response['royalty_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'royalty_income'), 'ifnull(sum(amount),0) as sum , type');


            $response['total_sent_fund'] = $this->Main_model->get_sum('tbl_wallet', array(), 'ifnull(sum(amount),0) as sum');
            $response['used_fund'] = $this->Main_model->get_sum('tbl_wallet', array('amount <' => '0'), 'ifnull(sum(amount),0) as sum ');
            $response['requested_fund'] = $this->Main_model->get_sum('tbl_payment_request', array(), 'ifnull(sum(amount),0) as sum');

            $response['today_matchingIncome'] = $this->Main_model->get_sum('tbl_income_wallet', 'date(created_at) = date(now()) -1 AND type = "matching_bonus"', 'ifnull(sum(amount),0) as sum');
            $response['today_silverIncome'] = $this->Main_model->get_sum('tbl_income_wallet', 'date(created_at) = date(now()) AND type = "silver_club_income"', 'ifnull(sum(amount),0) as sum');
            $response['today_goldIncome'] = $this->Main_model->get_sum('tbl_income_wallet', 'date(created_at) = date(now()) AND type = "gold_club_income"', 'ifnull(sum(amount),0) as sum');
            $response['today_directSponsorIncome'] = $this->Main_model->get_sum('tbl_income_wallet', 'date(created_at) = date(now()) AND type = "direct_sponsor_matching"', 'ifnull(sum(amount),0) as sum');
            $response['today_seniorSupportIncome'] = $this->Main_model->get_sum('tbl_income_wallet', 'date(created_at) = date(now()) AND type = "senior_support_bonus"', 'ifnull(sum(amount),0) as sum');
            $response['today_rewardsIncome'] = $this->Main_model->get_sum('tbl_income_wallet', 'date(created_at) = date(now()) AND type = "turnover_rewards"', 'ifnull(sum(amount),0) as sum');
            $response['today_business'] = $this->Main_model->get_sum('tbl_users', 'date(topup_date) = date(now())', 'ifnull(sum(package_amount),0) as sum');
            $response['today_withdraw'] = $this->Main_model->get_sum('tbl_withdraw', 'date(created_at) = date(now()) AND status != "2"', 'ifnull(sum(amount),0) as sum');
            $response['pending_withdraw'] = $this->Main_model->get_sum('tbl_withdraw', 'status = "0"', 'ifnull(sum(amount),0) as sum');
            $response['todayPair'] = $this->Main_model->todayPair();

            $this->load->view('dashboard', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }
    public function read_users()
    {
        $filename = FCPATH . 'uploads/Combine.csv';
        $file = fopen($filename, "r");
        $i = 0;
        echo '<table border="1px" id="example" class="table table-striped table-bordered" style="width:100%">';
        // echo'<tr>';
        // echo'<td>Mid</td>';
        // echo'<td>idNo</td>';
        // echo'<td>RefLegNo</td>';
        // echo'<td>LegNo</td>';
        // echo'<td>UpLnFormNo</td>';
        // echo'<td>Doj</td>';
        // echo'</tr>';
        while (!feof($file)) {
            if ($i == 1000)
                break;

            // if($i > 0){

            $user = (fgetcsv($file));

            echo '<tr>';
            // echo'<td>'.$user[0].'</td>';
            // echo'<td>'.$user[3].'</td>';
            // echo'<td>'.$user[10].'</td>';
            // echo'<td>'.$user[8].'</td>';
            // echo'<td>'.$user[6].'</td>';
            // echo'<td>'.$user[40].'</td>';
            foreach ($user as $key => $u) {
                echo '<td>' . $u . '</td>';
            }
            echo '</tr>';
            // pr($user);
            // $userData['MId'] = $user[0];
            // $userData['idNo'] = $user[3];
            // $userData['RefLegNo '] = $user[10];
            // $userData['LegNo '] = $user[8];
            // $userData['UpLnFormNo '] = $user[6];
            // $userData['Doj '] = $user[40];
            // pr($userData);
            // $this->Main_model->add('agtoken_csv', $userData);
            // }
            $i++;
        }
        echo '</table>';
    }

    public function BankTransactions()
    {
        if (is_admin()) {
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            // pr($where,true);
            $where = array();
            if (!empty($start_date)) {
                $where = "date(created_at) >= '" . $start_date . "' and date(created_at) <= '" . $end_date . "'";
            }
            $config['total_rows'] = $this->Main_model->get_sum('tbl_money_transfer', $where, 'ifnull(count(id),0) as sum');
            $response['bank_amount'] = $this->Main_model->get_sum('tbl_money_transfer', $where, 'ifnull(sum(amount),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/BankTransactions';
            $config['uri_segment'] = 4;
            $config['per_page'] = 100;
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
            $config['reuse_query_string'] = true;
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['segament'] = $segment;
            $response['start_date'] = $start_date;
            $response['end_date'] = $end_date;
            $response['total_records'] = $config['total_rows'];

            $response['requests'] = $this->Main_model->get_limit_records('tbl_money_transfer', $where, '*', $config['per_page'], $segment);
            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', ['user_id' => $request['user_id']], 'name');
            }
            $this->load->view('bank_transactions', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }


    public function poolUsers()
    {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            $response['header'] = "Pool Users";
            // pr($where,true);
            if (empty($where[$field]))
                $where = array();
            $config['total_rows'] = $this->Main_model->get_sum('tbl_pool', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/poolUsers';
            $config['suffix'] = '?' . http_build_query($_GET);
            $config['uri_segment'] = 4;
            $config['per_page'] = 100;
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
            $response['users'] = $this->Main_model->get_limit_records('tbl_pool', $where, '*', $config['per_page'], $segment);
            foreach ($response['users'] as $key => $user) {
                $response['users'][$key]['name'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user['user_id']), 'name');
            }
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $this->load->view('pool_users', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }


    public function matrixPoolUsers()
    {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            $response['header'] = "Matrix Pool Users";
            // pr($where,true);
            if (empty($where[$field]))
                $where = array();
            $config['total_rows'] = $this->Main_model->get_sum('tbl_matrix_pool', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/matrixPoolUsers';
            $config['suffix'] = '?' . http_build_query($_GET);
            $config['uri_segment'] = 4;
            $config['per_page'] = 100;
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
            $response['users'] = $this->Main_model->get_limit_records('tbl_matrix_pool', $where, '*', $config['per_page'], $segment);
            foreach ($response['users'] as $key => $user) {
                $response['users'][$key]['name'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user['user_id']), 'name');
            }
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $this->load->view('matrix_pool_users', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }


    public function nextMatrixPoolUsers()
    {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            $response['header'] = "Next Matrix Pool Users";
            // pr($where,true);
            if (empty($where[$field]))
                $where = array();
            $config['total_rows'] = $this->Main_model->get_sum('tbl_next_matrix_pool', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/nextMatrixPoolUsers';
            $config['suffix'] = '?' . http_build_query($_GET);
            $config['uri_segment'] = 4;
            $config['per_page'] = 100;
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
            $response['users'] = $this->Main_model->get_limit_records('tbl_next_matrix_pool', $where, '*', $config['per_page'], $segment);
            foreach ($response['users'] as $key => $user) {
                $response['users'][$key]['name'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user['user_id']), 'name');
            }
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $this->load->view('matrix_pool_users', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function nextPool($title = '')
    {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            $title = urldecode($title);
            $response['header'] = $title;
            // pr($where,true);
            if (empty($where[$field]))
                $where = array('package_title' => $title);
            $config['total_rows'] = $this->Main_model->get_sum('tbl_next_matrix_pool', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/nextPool/' . $title;
            $config['suffix'] = '?' . http_build_query($_GET);
            $config['uri_segment'] = 5;
            $config['per_page'] = 100;
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
            $segment = $this->uri->segment(5);
            $response['users'] = $this->Main_model->get_limit_records('tbl_next_matrix_pool', $where, '*', $config['per_page'], $segment);
            foreach ($response['users'] as $key => $user) {
                $response['users'][$key]['name'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user['user_id']), 'name');
            }
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $this->load->view('matrix_pool_users', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function nextMatrixPool($title = '')
    {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            $title = urldecode($title);
            $response['header'] = $title;
            // pr($where,true);
            if (empty($where[$field]))
                $where = array('package_title' => $title);
            $config['total_rows'] = $this->Main_model->get_sum('tbl_matrix_pool', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/nextMatrixPool/' . $title;
            $config['suffix'] = '?' . http_build_query($_GET);
            $config['uri_segment'] = 5;
            $config['per_page'] = 100;
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
            $segment = $this->uri->segment(5);
            $response['users'] = $this->Main_model->get_limit_records('tbl_matrix_pool', $where, '*', $config['per_page'], $segment);
            foreach ($response['users'] as $key => $user) {
                $response['users'][$key]['name'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user['user_id']), 'name');
            }
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $this->load->view('matrix_pool_users', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function secondPoolUsers($type)
    {
        if (is_admin()) {
            if ($type == 'second_pool') {
                $table = 'tbl_pool2';
            }
            if ($type == 'third_pool') {
                $table = 'tbl_pool3';
            }
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            $response['header'] = ucfirst(str_replace('_', ' ', $type)) . " users";
            // pr($where,true);
            if (empty($where[$field])) {
                $where = array();
            }
            $config['total_rows'] = $this->Main_model->get_sum($table, $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/secondPoolUsers/' . $type . '/';
            $config['suffix'] = '?' . http_build_query($_GET);
            $config['uri_segment'] = 5;
            $config['per_page'] = 100;
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
            $segment = $this->uri->segment(5);
            $response['users'] = $this->Main_model->get_limit_records($table, $where, '*', $config['per_page'], $segment);
            foreach ($response['users'] as $key => $user) {
                $response['users'][$key]['name'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user['user_id']), 'name');
            }
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $response['type'] = $type;
            $this->load->view('second_pool_users', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function RechargeHistory()
    {
        if (is_admin()) {
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            // pr($where,true);
            $where = array();
            if (!empty($start_date)) {
                $where = "date(created_at) >= '" . $start_date . "' and date(created_at) <= '" . $end_date . "'";
            }
            $config['total_rows'] = $this->Main_model->get_sum('tbl_recharge', $where, 'ifnull(count(id),0) as sum');
            $response['bank_amount'] = $this->Main_model->get_sum('tbl_recharge', [], 'ifnull(sum(amount),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/BankTransactions';
            $config['uri_segment'] = 4;
            $config['per_page'] = 100;
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
            $config['reuse_query_string'] = true;
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['segament'] = $segment;
            $response['start_date'] = $start_date;
            $response['end_date'] = $end_date;
            $response['total_records'] = $config['total_rows'];

            $response['requests'] = $this->Main_model->get_limit_records('tbl_recharge', $where, '*', $config['per_page'], $segment);
            $this->load->view('recharge_summary', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }
    public function update_register_time()
    {
        $biglist = $this->Main_model->get_records('agtoken_csv', ['RefLegNo >' => 0, 'sponser_id' => ''], 'idNo,RefLegNo,LegNo,Doj');
        foreach ($biglist as $k => $blist) {
            if ($k == 10000)
                break;

            $user = $this->Main_model->get_single_record('agtokes_sponsers', ['user_id' => $blist['idNo']], 'sponser_id');
            // if($blist['LegNo'] == 1){
            //     $position = 'L';
            // }else{
            //     $position = 'R';
            // }
            $upData['sponser_id'] = $user['sponser_id'];
            // $upData['position'] = $position;
            $upData['created_at'] = date("Y-m-d h:i:s", strtotime($blist['Doj']));
            $position;
            pr($blist);
            pr($user);
            $this->Main_model->update('agtoken_csv', array('idNo' => $blist['idNo']), $upData);
        }
    }
    public function migrate_users()
    {
        $filename = FCPATH . 'uploads/agtoken.csv';

        $file = fopen($filename, "r");
        $users = [];
        echo '<table border="1px">';
        echo '<tr>';
        echo '<th>Sr.No</th>';
        echo '<th>UserID</th>';
        echo '<th>Name</th>';
        echo '<th>CreatedAt</th>';
        echo '<th>topupDate</th>';
        echo '<th>packageName</th>';
        echo '<th>sponser_id</th>';
        echo '<th>sponser_name</th>';
        echo '<th>Password</th>';
        echo '<th>MasterKey</th>';
        echo '<th>Phone</th>';
        echo '<th>Paid Status</th>';
        echo '<th>UPline ID</th>';
        echo '<th>Position</th>';
        echo '</tr>';
        $i = 0;
        while (!feof($file)) {
            // if($i == 10)
            //     break;

            $user = (fgetcsv($file));
            if ($i > 0) {
                // $userData['id'] = $i;
                $userData['user_id'] = $user[1];
                $userData['name'] = $user[2];
                $userData['created_at'] = date("Y-m-d h:i:s", strtotime($user[3]));
                $userData['topup_date'] = $user[12] == 'Active' ? date("Y-m-d h:i:s", strtotime($user[4])) : '0000-00-00 00:00:00';
                $userData['sponser_id'] = $user[6];
                $userData['password'] = $user[8];
                $userData['master_key'] = $user[9];
                $userData['phone'] = $user[10];
                $userData['paid_status'] = ($user[12] == 'Active' ? 1 : 0);
                $userData['upline_id'] = $user[13];
                $userData['position'] = ($user[15] == 'LEFT' ? 'L' : 'R');
                // $this->Main_model->add('agtoken_users', $userData);
                // pr($userData);
                echo '<tr>';
                // foreach($user as $key => $u){
                //     echo'<td>'.$u.'</td>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $user[1] . '</td>';
                echo '<td>' . $user[2] . '</td>';
                echo '<td>' . date("d-m-Y h:i:s", strtotime($user[3])) . '<br>' . $user[3] . '</td>';
                echo '<td>' . date("d-m-Y h:i:s", strtotime($user[4])) . '</td>';
                echo '<td>' . $user[5] . '</td>';
                echo '<td>' . $user[6] . '</td>';
                echo '<td>' . $user[7] . '</td>';
                echo '<td>' . $user[8] . '</td>';
                echo '<td>' . $user[9] . '</td>';
                echo '<td>' . $user[10] . '</td>';
                echo '<td>' . ($user[12] == 'Active' ? 1 : 0) . '</td>';
                echo '<td>' . $user[13] . '</td>';
                echo '<td>' . ($user[15] == 'LEFT' ? 'L' : 'R') . '</td>';
                // }
                echo '</tr>';
            }

            $i++;
        }
        echo '</table>';
        // pr($users);
        fclose($file);
    }
    public function CommingSoon($header = '')
    {
        $response['header'] = ucwords(str_replace('_', ' ', $header));
        $this->load->view('coming_soon', $response);
    }

    public function sample()
    {
        $this->load->view('sample');
    }

    public function get_user($user_id = '')
    {
        if (is_admin()) {
            $response = array();
            $response['success'] = 0;
            $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            if (!empty($user)) {
                $response['success'] = 1;
                $response['message'] = 'user Found';
                $response['user'] = $user;
                echo $user['name'];
            } else {
                echo 'User Not Found';
            }
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function users()
    {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $export = $this->input->get('export');
            $where = array($field => $value);
            // pr($where,true);
            if (empty($where[$field]))
                $where = array();
            $config['total_rows'] = $this->Main_model->get_sum('tbl_users', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/users';
            $config['uri_segment'] = 4;
            $config['per_page'] = 10;
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
            $this->db->order_by('id', 'desc');
            $response['users'] = $this->Main_model->get_limit_records('tbl_users', $where, '*', $config['per_page'], $segment);
            foreach ($response['users'] as $key => $user) {
                $response['users'][$key]['e_wallet'] = $this->Main_model->get_single_record('tbl_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as e_wallet');
                $response['users'][$key]['income_wallet'] = $this->Main_model->get_single_record('tbl_income_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as income_wallet');
            }

            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            if ($export) {
                $application_type = 'application/' . $export;
                $header = ['#', 'User ID', 'Name', 'Phone', 'Postion', 'Password', 'Transaction Pin', 'Sponsor ID', 'Package', 'E-wallet', 'Income', 'Joining Date'];
                $response['users'] = $this->Main_model->get_records('tbl_users', array(''), 'id,user_id,name,last_name,phone,password,master_key,email,sponser_id,directs,package_id,paid_status,created_at,disabled,position,package_amount');
                foreach ($response['users'] as $key => $record) {
                    $e_wallet = $this->Main_model->get_single_record('tbl_wallet', array('user_id' => $record['user_id']), 'ifnull(sum(amount),0) as e_wallet');
                    $income_wallet = $this->Main_model->get_single_record('tbl_income_wallet', array('user_id' => $record['user_id']), 'ifnull(sum(amount),0) as income_wallet');
                    $records[$key]['i'] = ($key + 1);
                    $records[$key]['user_id'] = $record['user_id'];
                    $records[$key]['name'] = $record['name'];
                    $records[$key]['phone'] = $record['phone'];
                    $records[$key]['position'] = $record['position'];
                    $records[$key]['password'] = $record['password'];
                    $records[$key]['master_key'] = $record['master_key'];
                    $records[$key]['sponser_id'] = $record['sponser_id'];
                    $records[$key]['package_amount'] = $record['package_amount'];
                    $records[$key]['e_wallet'] = $e_wallet['e_wallet'];
                    $records[$key]['income_wallet'] = $income_wallet['income_wallet'];
                    $records[$key]['created_at'] = $record['created_at'];
                }
                $this->finalExport($export, $application_type, $header, $records);
            }
            // $response['users'] = $this->Main_model->get_records('tbl_users', array(), 'id,user_id,name,last_name,phone,password,master_key,email,sponser_id,directs,package_id,paid_status,created_at,disabled,position,package_amount');
            // foreach ($response['users'] as $key => $user) {
            //     // $response['users'][$key]['e_wallet'] = $this->Main_model->get_single_record('tbl_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as e_wallet');
            //     // $response['users'][$key]['income_wallet'] = $this->Main_model->get_single_record('tbl_income_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as income_wallet');
            //     // $response['users'][$key]['rank'] = calculate_rank($user['directs']);
            //     // $response['users'][$key]['package'] = calculate_package($user['package_id']);
            // }
            $this->load->view('users', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function today_joinings()
    {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);

            // pr($where,true);
            if (empty($where[$field]))
                $where = 'date(created_at) = date(now())';
            $config['total_rows'] = $this->Main_model->get_sum('tbl_users', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/today_joinings';
            $config['uri_segment'] = 4;
            $config['per_page'] = 100;
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
            $response['users'] = $this->Main_model->get_limit_records('tbl_users', $where, 'id,user_id,name,last_name,phone,password,master_key,email,sponser_id,directs,package_id,paid_status,created_at,disabled,position,package_amount,wallet_address,total_package', $config['per_page'], $segment);
            foreach ($response['users'] as $key => $user) {
                $response['users'][$key]['e_wallet'] = $this->Main_model->get_single_record('tbl_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as e_wallet');
                $response['users'][$key]['income_wallet'] = $this->Main_model->get_single_record('tbl_income_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as income_wallet');
            }
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $this->load->view('users', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    private function finalExport($export, $application_type, $header, $records)
    {
        if (is_admin()) {
            if ($export) {
                $filename = $export . 'Summary_' . time() . '.' . $export;
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: " . $application_type . "");
                $file = fopen('php://output', 'w');
                $header = $header;
                fputcsv($file, $header);

                foreach ($records as $key => $line) {
                    fputcsv($file, $line);
                }

                fclose($file);
                exit();
            }
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function user_login($user_id)
    {
        if (is_admin()) {
            $this->session->set_userdata('user_id', $user_id);
            redirect('Dashboard/User');
        } else {
            redirect('Admin/Management/administrator');
        }
    }

   // public function paidUsers()
    //{
       // if (is_admin()) {
          //  $response['users'] = $this->Main_model->get_records('tbl_users', array('paid_status' => 1), '*');
           // foreach ($response['users'] as $key => $user) {
             //   $response['users'][$key]['roi'] = $this->Main_model->get_single_record('tbl_roi', array('user_id' => $user['user_id']), '*');
                 //  }
          //  $this->load->view('paid_users', $response);
      //  } else {
           // redirect('Admin/Management/administrator');
      //  }
   // }
  
  public function paidUsers()
    {
        if (is_admin()) {
           // $response['users'] = $this->Main_model->get_only_one_records('tbl_roi', '*');
            $response['users'] = $this->Main_model->checkpaidusers('tbl_users', array('paid_status' => 1), '*');
            // foreach ($response['users'] as $key => $user) {
            //     $response['users'][$key]['roi'] = $this->Main_model->get_single_record('tbl_roi', array('user_id' => $user['user_id']), '*');
            //        }
            // echo "<pre>";
            // print_r($response);
            // exit;
            $this->load->view('check_paid_users', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function PositionPaidUsers()
    {
        if (is_admin()) {
            $response['users'] = $this->Main_model->position_paid_users();
            foreach ($response['users'] as $key => $user) {
                $response['users'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'id,name,user_id,sponser_id,phone,created_at');
            }
            $this->load->view('cto_users', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function UserInvoice()
    {
        if (is_admin()) {
            $response['users'] = $this->Main_model->get_records('tbl_users', array('paid_status' => 1), '*');
            $this->load->view('user_invoice', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function BlockedMembers()
    {
        if (is_admin()) {
            $response['users'] = $this->Main_model->get_records('tbl_users', array('disabled' => 1), '*');
            $this->load->view('paid_users', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function Genelogy($user_id = 'admin')
    {
        if (is_admin()) {
            $response = array();
            $response['level1'] = $this->Main_model->get_tree_user($user_id);
            $response['level2'][1] = $this->Main_model->get_tree_user($response['level1']->left_node);
            $response['level2'][2] = $this->Main_model->get_tree_user($response['level1']->right_node);
            if (!empty($response['level2'][1]->left_node))
                $response['level3'][1] = $this->Main_model->get_tree_user($response['level2'][1]->left_node);
            else
                $response['level3'][1] = array();
            if (!empty($response['level2'][1]->right_node))
                $response['level3'][2] = $this->Main_model->get_tree_user($response['level2'][1]->right_node);
            else
                $response['level3'][2] = array();
            if (!empty($response['level2'][2]->left_node))
                $response['level3'][3] = $this->Main_model->get_tree_user($response['level2'][2]->left_node);
            else
                $response['level3'][3] = array();
            if (!empty($response['level2'][2]->right_node))
                $response['level3'][4] = $this->Main_model->get_tree_user($response['level2'][2]->right_node);
            else
                $response['level3'][4] = array();
            $this->load->view('genelogy', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function Tree($user_id = 'adminadmin')
    {
        if (is_admin()) {
            $response = array();
            $response['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            $response['users'] = $this->Main_model->get_records('tbl_users', array('sponser_id' => $user_id), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            foreach ($response['users'] as $key => $directs) {
                $response['users'][$key]['sub_directs'] = $this->Main_model->get_records('tbl_users', array('user_id' => $directs['user_id']), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            }
            $this->load->view('tree', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function Pool($user_id = 'adminadmin', $pool_id)
    {
        if (is_admin()) {
            $response = array();
            // $response['user'] = $this->Main_model->get_single_record('tbl_pool', array('user_id' => $user_id , 'pool_level' => $pool_id), '*');
            $response['users'] = $this->Main_model->get_records('tbl_pool', array('pool_level' => $pool_id), '*');
            // foreach($response['users'] as $key => $directs){
            //     $response['users'][$key]['user_info'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $directs['user_id']), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            // }
            // $response['pool_id'] = $pool_id;
            // $this->load->view('pool', $response);
            $this->load->view('pool_view', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function RankUsers()
    {
        if (is_admin()) {
            $response = array();
            $response['users'] = $this->Main_model->get_records('tbl_user_positions', array('user_id != ' => 'admin'), '*');
            foreach ($response['users'] as $key => $users) {
                $response['users'][$key]['package'] = $this->Main_model->get_single_record('tbl_package', array('id' => $users['package']), '*');
            }
            $this->load->view('rank_users', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    // public function login() {
    //     if (is_admin()) {
    //         redirect('Admin/Management');
    //     } else {
    //         $response['message'] = '';
    //         if ($this->input->server('REQUEST_METHOD') == 'POST') {
    //             $data = $this->security->xss_clean($this->input->post());
    //             $user = $this->Main_model->get_single_record('tbl_admin', array('user_id' => $data['user_id'], 'password' => $data['password'], 'role' => 'A'), 'id,user_id,role,name,email');
    //             if (!empty($user)) {
    //                 $this->session->set_userdata('user_id', $user['user_id']);
    //                 $this->session->set_userdata('role', $user['role']);
    //                 redirect('Admin/Management/');
    //             } else {
    //                 $response['message'] = 'Invalid Credentials';
    //             }
    //         }
    //         $this->load->view('login', $response);
    //     }
    // }


    public function administrator()
    {
        if (is_admin()) {
            redirect('Admin/Management');
        } else {
            $response['message'] = '';
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                // $user = $this->Main_model->get_single_record('tbl_admin', array('user_id' => $data['user_id'], 'password' => $data['password'], 'role' => 'A'), 'id,user_id,role,name,email');
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    if (!empty($data) && $data['user_id'] == 'secureadmin' && $data['password'] == 'as@$t34#k#@!') {
                        // $this->session->set_userdata('user_id', $user['user_id']);
                        // $this->session->set_userdata('role', $user['role']);
                        $guard = md5(rand(100000, 999999));
                        $this->session->set_userdata('admin_id', 'admin');
                        $this->session->set_userdata('role', 'A');
                        $this->session->set_userdata('guard', $guard);

                        redirect('Admin/Management/');
                    } else {
                        $response['message'] = 'Invalid Credentials';
                    }
                } else {
                    $response['message'] = 'Invalid Validation!';
                }
            }
            $this->load->view('login', $response);
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(array('user_id', 'role', 'admin_id', 'guard'));
        redirect('Admin/Management/administrator');
    }

    public function Fund_requests($status = '')
    {
        if (is_admin()) {
            if ($status == '') {
                $where = array();
            } else {
                $where = array('status' => $status);
            }
            $response['requests'] = $this->Main_model->get_records('tbl_payment_request', $where, '*');
            $response['sumrequests'] = $this->Main_model->get_single_record('tbl_payment_request', $where, 'ifnull(sum(amount),0)as sumrequests');
            $this->load->view('fund_requests', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    // public function fund_history() {
    //     if (is_admin()) {
    //         $response['requests'] = $this->Main_model->get_records('tbl_wallet', array(), '*');
    //         $this->load->view('fund_history', $response);
    //     } else {
    //         redirect('Admin/Management/administrator');
    //     }
    // }


    public function fund_history()
    {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            // pr($where,true);
            if (empty($where[$field]))
                $where = array('');
            $config['total_rows'] = $this->Main_model->get_sum('tbl_wallet', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/fund_history';
            $config['uri_segment'] = 4;
            $config['per_page'] = 100;
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
            $response['requests'] = $this->Main_model->get_limit_records('tbl_wallet', $where, '*', $config['per_page'], $segment);
            // foreach($response['users'] as $key => $user){
            //     $response['users'][$key]['e_wallet'] = $this->Main_model->get_single_record('tbl_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as e_wallet');
            //     $response['users'][$key]['income_wallet'] = $this->Main_model->get_single_record('tbl_income_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as income_wallet');
            // }
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $this->load->view('fundHistory', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }


    public function token_fund_history()
    {
        if (is_admin()) {
            $response['requests'] = $this->Main_model->get_records('tbl_token_wallet', array(), '*');
            $this->load->view('fund_history', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }


    public function update_fund_request($id)
    {
        if (is_admin()) {
            $response['request'] = $this->Main_model->get_single_record('tbl_payment_request', array('id' => $id), '*');
            $response['user_info'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $response['request']['user_id']), 'id,user_id,first_name,last_name,email,phone,country,image,site_url');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['status'] == 'Reject') {
                    if ($response['request']['status'] == 0) {
                        $updres = $this->Main_model->update('tbl_payment_request', array('id' => $id), array('status' => 2, 'remarks' => $data['remarks']));
                        if ($updres == true) {
                            $this->session->set_flashdata('error', 'Reqeust Rejected Successfully');
                            // redirect('Admin/Management/Fund_requests/2');
                        } else {
                            $this->session->set_flashdata('error', 'There is an error while Rejecting request Please try Again ..');
                        }
                    }else{
                        $this->session->set_flashdata('error', 'This Payment Request Already Updated');
                    }    
                } elseif ($data['status'] == 'Approve') {
                    if ($response['request']['status'] != 1) {
                        /*                         * Topup Member */
                        $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $response['request']['user_id']), '*');
                        $package = $this->Main_model->get_single_record('tbl_package', array('price' => $response['request']['amount']), '*');
                        // pr($user,true);
                        // if ($user['paid_status'] == 0) {
                        //     // $sendWallet = array(
                        //     //     'user_id' => $user['user_id'],
                        //     //     'amount' => -$package['price'],
                        //     //     'type' => 'account_activation',
                        //     //     'remark' => 'Account Activation Deduction for '.$user_id,
                        //     // );
                        //     // $this->User_model->add('tbl_wallet', $sendWallet);
                        //     $topupData = array(
                        //         'paid_status' => 1,
                        //         'package_id' => $package['id'],
                        //         'package_amount' => $package['price'],
                        //         'topup_date' => date('Y-m-d h:i:s'),
                        //         'capping' => $package['capping'],
                        //     );
                        //     $this->Main_model->update('tbl_users', array('user_id' => $user['user_id']), $topupData);
                        //     $this->Main_model->update_directs($user['sponser_id']);
                        //     $sponser = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,directs');
                        //     $DirectIncome = array(
                        //         'user_id' => $user['sponser_id'],
                        //         'amount' => $package['direct_income'],
                        //         'type' => 'direct_income',
                        //         'description' => 'Direct Income from Activation of Member ' . $user['user_id'],
                        //     );
                        //     $this->Main_model->add('tbl_income_wallet', $DirectIncome);
                        //     $this->update_business($user['user_id'], $user['user_id'], $level = 1, $package['bv'], $type = 'topup');
                        //     $roiArr = array(
                        //         'user_id' => $user['user_id'],
                        //         'amount' => ($package['price'] * 2),
                        //         'roi_amount' => $package['commision'],
                        //     );
                        //     $this->Main_model->add('tbl_roi', $roiArr);
                        //     $this->session->set_flashdata('error', 'Account Activated Successfully');
                        //     $updres = $this->Main_model->update('tbl_payment_request', array('id' => $id), array('status' => 1, 'remarks' => $data['remarks']));
                        // } else {
                        //     $this->session->set_flashdata('error', 'This Account Already Acitvated');
                        // }
                        /*                         * Topup Member */
                        $updres = $this->Main_model->update('tbl_payment_request', array('id' => $id), array('status' => 1, 'remarks' => $data['remarks']));
                        if ($updres == true) {
                            $this->session->set_flashdata('error', 'Reqeust Accepted And Fund released Successfully');
                            $walletData = array(
                                'user_id' => $response['request']['user_id'],
                                'amount' => $response['request']['amount'],
                                'sender_id' => 'admin',
                                'type' => 'admin_fund',
                                'remark' => $data['remarks'],
                            );
                            $this->Main_model->add('tbl_wallet', $walletData);
                            $this->AdminActivation($walletData['user_id'],$walletData['amount'],$response['request']['coin'],$response['request']['days']);
                            // redirect('Admin/Management/Fund_requests/1');
                            
                        } else {
                            $this->session->set_flashdata('error', 'There is an error while Rejecting request Please try Again ..');
                        }
                    } else {
                        $this->session->set_flashdata('error', 'This Payment Request Already Approved');
                    }
                }
            }
            $this->load->view('update_fund_request', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    function update_business($user_name = 'A915813', $downline_id = 'A915813', $level = 1, $business = '40', $type = 'topup')
    {
        $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
        if (!empty($user)) {
            if ($user['position'] == 'L') {
                $c = 'leftPower';
            } else if ($user['position'] == 'R') {
                $c = 'rightPower';
            } else {
                return;
            }
            $this->Main_model->update_business($c, $user['upline_id'], $business);
            $downlineArray = array(
                'user_id' => $user['upline_id'],
                'downline_id' => $downline_id,
                'position' => $user['position'],
                'business' => $business,
                'type' => $type,
                'created_at' => date('Y-m-d h:i:s'),
                'level' => $level,
            );
            $this->Main_model->add('tbl_downline_business', $downlineArray);
            $user_name = $user['upline_id'];

            if ($user['upline_id'] != '') {
                $this->update_business($user_name, $downline_id, $level + 1, $business, $type);
            }
        }
    }

    public function adminEditProfileOtp($beneficiry_id)
    {
        if (is_admin()) {
            $_SESSION['otp'] = rand(100000, 999999);
            $this->session->mark_as_temp('otp', 120);
            if (!empty($_SESSION['otp'])) {
                $message = 'Your OTP is ' . $_SESSION['otp'] . ' Please never share your OTP (One Time Password) with anyone, This OTP is valid for 2 Mintues.';
                send_otp($message);
                $this->session->set_flashdata('message', 'OTP send on your registered mobile no.');
            } else {
                $this->session->set_flashdata('message', 'ERROR:: OTP Failed!  ');
            }
            redirect('Admin/Settings/EditUser/' . $beneficiry_id . '');
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function adminSendWalletOtp()
    {
        if (is_admin()) {
            $_SESSION['otp'] = rand(100000, 999999);
            $this->session->mark_as_temp('otp', 120);
            if (!empty($_SESSION['otp'])) {
                $message = 'Your OTP is ' . $_SESSION['otp'] . ' Please never share your OTP (One Time Password) with anyone, This OTP is valid for 2 Mintues.';
                send_otp($message);
                $this->session->set_flashdata('message', 'OTP send on your registered mobile no.');
            } else {
                $this->session->set_flashdata('message', 'ERROR:: OTP Failed!  ');
            }
            redirect('Admin/Management/SendWallet');
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function SendWallet()
    {
        $response = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            //$this->form_validation->set_rules('otp', 'OTP', 'trim|numeric|required|xss_clean');
            $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
            if ($this->form_validation->run() != FALSE) {
                // if(!empty($_SESSION['otp']) && $data['otp'] == $_SESSION['otp']){
                $user_id = $data['user_id'];
                $amount = $data['amount'];
                $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                if (!empty($user)) {
                  
                        if ($data['type'] == 'credit') {
                            $amount = abs($data['amount']);
                        }
                        if ($data['type'] == 'debit') {
                            $amount = '-' . abs($data['amount']);
                        }
                    $sendWallet = array(
                        'user_id' => $user_id,
                        'amount' => $amount,
                        'type' => 'topup_amount',
                        'sender_id' => 'topup',
                        // 'remark' => 'Fund Sent By Admin',
                        'remark' => 'Income ' . strtoupper($data['type']) . ' by Topup ',
                    );
                    $this->Main_model->add('tbl_wallet', $sendWallet);
                    $this->session->set_flashdata('message', 'Income ' . $data['type'] . ' Successfully');

                    // $this->session->set_flashdata('message', 'Fund Sent Successfully');
                    redirect('Admin/Management/SendWallet');
                } else {
                    $this->session->set_flashdata('message', 'Invalid User ID');
                }
                // }else{
                //     $this->session->set_flashdata('message', 'Invalid OTP');
                // }

            }
        }
        $response['header'] = 'Fund Transfer Personally';
        $this->load->view('send_wallet', $response);
    }
  
    public function SendWallet_History(){
       if (is_admin()) {
         $response['topup'] = $this->Main_model->transfer_history('tbl_wallet', ['type'=>'topup_amount'], '*');
         //echo "<pre>";
        // print_r($response['topup']);
        // exit;
         
       $this->load->view('send_wallet_history', $response);
       }else{
          $this->session->set_flashdata('message', 'Invalid User ID');
       }
    }

    public function SendCoin()
    {
        $response = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            //$this->form_validation->set_rules('otp', 'OTP', 'trim|numeric|required|xss_clean');
            $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
            if ($this->form_validation->run() != FALSE) {
                // if(!empty($_SESSION['otp']) && $data['otp'] == $_SESSION['otp']){
                $user_id = $data['user_id'];
                $amount = $data['amount'];
                $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                if (!empty($user)) {
                    if ($data['type'] == 'credit') {
                        $amount = abs($data['amount']);
                    }
                    if ($data['type'] == 'debit') {
                        $amount = '-' . abs($data['amount']);
                    }
                    $sendWallet = array(
                        'user_id' => $user_id,
                        'amount' => $amount,
                        'type' => 'admin_amount',
                        // 'description' => 'Send by Admin',
                        'description' => 'Income ' . strtoupper($data['type']) . ' by Admin ',

                    );
                    $this->Main_model->add('tbl_coin_wallet', $sendWallet);
                    $this->session->set_flashdata('message', 'Coin ' . $data['type'] . ' Successfully');

                    // $this->session->set_flashdata('message', 'Coin Sent Successfully');
                    redirect('Admin/Management/SendCoin');
                } else {
                    $this->session->set_flashdata('message', 'Invalid User ID');
                }
                // }else{
                //     $this->session->set_flashdata('message', 'Invalid OTP');
                // }

            }
        }
        $response['header'] = 'Send Coin Personally';
        $this->load->view('send_wallet2', $response);
    }


    public function sendIncome()
    {
        $response = array();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('income_type', 'Income Type', 'trim|required|xss_clean');
            $this->form_validation->set_rules('type', 'Type', 'trim|required|xss_clean');
            // $this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
            if ($this->form_validation->run() != FALSE) {
                $user_id = $data['user_id'];
                //$amount = $data['amount'];
                $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                if (!empty($user)) {

                    if ($data['type'] == 'credit') {
                        $amount = abs($data['amount']);
                    }
                    if ($data['type'] == 'debit') {
                        $amount = '-' . abs($data['amount']);
                    }
                    $sendWallet = array(
                        'user_id' => $user_id,
                        'amount' => $amount,
                        'type' => $data['income_type'],
                        'description' => 'Income ' . strtoupper($data['type']) . ' by Admin ',
                    );
                    $this->Main_model->add('tbl_income_wallet', $sendWallet);
                    $this->session->set_flashdata('message', 'Income ' . $data['type'] . ' Successfully');
                } else {
                    $this->session->set_flashdata('message', 'Invalid User ID');
                }
            }
        }
        $this->load->view('sendIncome', $response);
    }

    public function SendTokenWallet()
    {
        $response = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|numeric|xss_clean');
            if ($this->form_validation->run() != FALSE) {
                $user_id = $data['user_id'];
                $amount = $data['amount'];
                $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                if (!empty($user)) {
                    $sendWallet = array(
                        'user_id' => $user_id,
                        'amount' => $amount,
                        'type' => 'admin_amount',
                        'sender_id' => 'admin',
                        'remark' => 'Fund Sent By Admin',
                    );
                    $this->Main_model->add('tbl_token_wallet', $sendWallet);
                    $this->session->set_flashdata('message', 'Fund Sent Successfully');
                } else {
                    $this->session->set_flashdata('message', 'Invalid User ID');
                }
            }
        }
        $this->load->view('send_wallet', $response);
    }

    public function distribute_growth()
    {
        $response = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|numeric|xss_clean');
            if ($this->form_validation->run() != FALSE) {
                $amount = $data['amount'];
                $users = $this->Main_model->get_records('tbl_users', ['units >' => 0], 'id,user_id,units');
                foreach ($users as $key => $user) {
                    $sendWallet = array(
                        'user_id' => $user['user_id'],
                        'amount' => floor($user['units']) * $amount,
                        'type' => 'daily_growth_income',
                        'description' => 'Daily Growth Income',
                    );
                    $this->Main_model->add('tbl_income_wallet', $sendWallet);
                    $this->session->set_flashdata('message', 'Daily Growth Distributed Successfully');
                }
            } else {
                $this->session->set_flashdata('message', validation_erros());
            }
        }
        $response['total_unit'] = $this->Main_model->get_single_record('tbl_users', [], 'ifnull(sum(units),0) as sum');
        $this->load->view('distribute_growth', $response);
    }

    // public function UpdateRank($user_id) {
    //     if (is_admin()) {
    //         if ($this->input->server('REQUEST_METHOD') == 'POST') {
    //             $data = $this->security->xss_clean($this->input->post());
    //             $user = $this->Main_model->get_single_record('tbl_user_positions', array('user_id' => $user_id), '*');
    //             $user_package = $this->Main_model->get_single_record('tbl_package', array('id' => $user['package']), '*');
    //             $new_package = $this->Main_model->get_single_record('tbl_package', array('id' => $data['package']), '*');
    //             if ($user_package['bv'] == $new_package['bv']) {
    //                 $this->session->set_flashdata('messsage', 'This Account Have Already Same BV');
    //             } else {
    //                 $updres = $this->Main_model->update('tbl_user_positions', array('user_id' => $data['user_id']), array('package' => $new_package['id'], 'capping' => $new_package['capping']));
    //                 if ($updres == true) {
    //                     $new_bv = $new_package['bv'] - $user_package['bv'];
    //                     if ($new_bv > 0) {
    //                         $response['sponser'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'id,user_id,package_id,sponser_id,paid_status');
    //                         $response['sponser_package'] = $this->Main_model->get_single_record('tbl_package', array('id' => $response['sponser']['package_id']), '*');
    //                         $bonus = ($new_bv * $response['sponser_package']['commision'] / 100) * 1.3;
    //                         if ($response['sponser_package']['commision'] == '20') {
    //                             $roll_up_amount = $response['sponser_package']['bv'] * 1.3;
    //                             $this->rollup_personal_business($response['sponser']['sponser_id'], $roll_up_amount, $share = 8, $sender_id = $data['user_id'], 20);
    //                         } elseif ($response['sponser_package']['commision'] == '22') {
    //                             $roll_up_amount = $response['sponser_package']['bv'] * 1.3;
    //                             $this->rollup_personal_business($response['sponser']['sponser_id'], $roll_up_amount, $share = 6, $sender_id = $data['user_id'], 22);
    //                         } elseif ($response['sponser_package']['commision'] == '24') {
    //                             $roll_up_amount = $response['sponser_package']['bv'] * 1.3;
    //                             $this->rollup_personal_business($response['sponser']['sponser_id'], $roll_up_amount, $share = 4, $sender_id = $data['user_id'], 24);
    //                         }
    //                     }
    //                     $this->update_business($data['user_id'], 1, $new_bv);

    //                     $this->session->set_flashdata('messsage', 'Rank Updated Successfully');
    //                 }
    //             }
    //         }
    //         $response['user'] = $this->Main_model->get_single_record('tbl_user_positions', array('user_id' => $user_id), '*');
    //         $response['user_info'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
    //         $response['user_package'] = $this->Main_model->get_single_record('tbl_package', array('id' => $response['user']['package']), '*');
    //         $response['packages'] = $this->Main_model->get_records('tbl_package', array(), '*');
    //         $this->load->view('update_rank', $response);
    //     } else {
    //         redirect('Admin/Management/administrator');
    //     }
    // }

    //     public function rollup_personal_business($sponser_id = 'SG10006', $amount = '2070', $share = 4, $sender_id = 'SG10011', $last_distribution) {
    //         $sponser = $this->Main_model->get_user_package_commison($sponser_id);
    //         if (!empty($sponser)) {
    // //            pr($sponser);
    //             if ($sponser['commision'] == '28') {
    //                 $this->credit_income($sponser_id, ($amount * $share / 100), 'roll_up_personal_network', 'Roll Up Personal Network Income from User ' . $sender_id);
    //             } elseif ($sponser['commision'] == '24') {
    //                 if ($sponser['commision'] > $last_distribution) {
    //                     $this->credit_income($sponser['user_id'], ($amount * 4 / 100), 'roll_up_personal_network', 'Roll Up Personal Network Income from User ' . $sender_id);
    //                     if ($share > 4)
    //                         $this->rollup_personal_business($sponser['sponser_id'], $amount = '100', $share = $share - 4, $sender_id = 'sd', 24);
    //                 }else {
    //                     $this->rollup_personal_business($sponser['sponser_id'], $amount, $share, $sender_id, $last_distribution);
    //                 }
    //             } elseif ($sponser['commision'] == '22') {
    //                 if ($sponser['commision'] > $last_distribution) {
    //                     $this->credit_income($sponser['user_id'], ($amount * 2 / 100), 'roll_up_personal_network', 'Roll Up Personal Network Income from User ' . $sender_id);
    //                     if ($share > 2)
    //                         $this->rollup_personal_business($sponser['sponser_id'], $amount = '100', $share = $share - 2, $sender_id = 'sd', 22);
    //                 }else {
    //                     $this->rollup_personal_business($sponser['sponser_id'], $amount, $share, $sender_id, $last_distribution);
    //                 }
    //             } elseif ($sponser['commision'] == '20') {
    //                 $this->rollup_personal_business($sponser['sponser_id'], $amount, $share, $sender_id, $last_distribution);
    //             }
    //         }
    //     }

    public function credit_income($user_id, $amount, $type, $description)
    {
        $incomeArr = array(
            'user_id' => $user_id,
            'amount' => $amount,
            'type' => $type,
            'description' => $description,
        );
        $this->Main_model->add('tbl_income_wallet', $incomeArr);
    }

    //     function update_business($user_name = 'SG10004', $level = 1, $bv = 1380) {
    //         $user = $this->Main_model->get_single_record('tbl_user_positions', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
    //         if (count($user)) {
    // //            pr($user);
    //             if ($user['position'] == 'L') {
    //                 $c = 'left_bv';
    //             } else if ($user['position'] == 'R') {
    //                 $c = 'right_bv';
    //             } else {
    //                 return;
    //             }
    //             $this->Main_model->update_bv($c, $user['upline_id'], $bv);
    //             $user_name = $user['upline_id'];
    //             if ($user['upline_id'] != '') {
    //                 $this->update_business($user_name, $level = 1, $bv);
    //             }
    //         }
    //     }

    function content_management($title = false)
    {
        if (is_admin()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $updres = $this->Main_model->update('tbl_content', array('title' => $title), array('content' => $data['content']));
                if ($updres == true) {
                    $this->session->set_flashdata('message', 'Content Updated Successfully');
                } else {
                    $this->session->set_flashdata('message', 'There is an error while Updating Content Please try Again ..');
                }
            }
            $response['content'] = $this->Main_model->get_single_record('tbl_content', array('title' => $title), '*');
            $this->load->view('content_management', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    function blockStatus($user_id, $status)
    {
        if (is_admin()) {
            $response['success'] = 0;
            $updres = $this->Main_model->update('tbl_users', array('user_id' => $user_id), array('disabled' => $status));
            if ($updres == true) {
                $response['success'] = 1;
                $response['message'] = 'Status Updated Successfully';
            } else {
                $response['message'] = 'Error While Updating Status';
            }
            echo json_encode($response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    function promo_code()
    {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $this->form_validation->set_rules('promo_code', 'Promo Code', 'trim|required|xss_clean');
                $this->form_validation->set_rules('discount', 'Discount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('valid_upto', 'Valid Upto', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    //                    $real_date = '08/08/2019';

                    $data = $this->security->xss_clean($this->input->post());
                    $date = date_create($data['valid_upto']);
                    $valid_upto = date_format($date, "Y-m-d");
                    $promoArr = array(
                        'promo_code' => $data['promo_code'],
                        'discount' => $data['discount'],
                        'valid_upto' => $valid_upto
                    );
                    $res = $this->Main_model->add('tbl_promo_codes', $promoArr);
                    if ($res) {
                        $this->session->set_flashdata('message', 'Promo Code Created Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Creating New Promo Code Please Try Again ...');
                    }
                }
            }
            $response['promo_codes'] = $this->Main_model->get_records('tbl_promo_codes', array(), '*');
            $this->load->view('promo_code', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    function delete_promo_code($id)
    {
        if (is_admin()) {
            $response = array();
            $promo_code = $this->Main_model->get_single_record('tbl_promo_codes', array('id' => $id), '*');
            if (!empty($promo_code)) {
                $res = $this->Main_model->delete('tbl_promo_codes', $id);
                if ($res) {
                    $this->session->set_flashdata('message', 'Promo Code Deleted Successfully');
                } else {
                    $this->session->set_flashdata('message', 'Error While Deleting Promo Code Please Try Again ...');
                }
            } else {
                $this->session->set_flashdata('message', 'Error While Deleting Promo Code Please After some Time ...');
            }
            $response['promo_codes'] = $this->Main_model->get_records('tbl_promo_codes', array(), '*');
            $this->load->view('promo_code', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    function popup_upload()
    {
        if (is_admin()) {
            $response = array();
            $response['popup'] = '';
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());

                $data = html_escape($data);
                if ($data['type'] == 'image') {
                    if (!empty($_FILES['media']['name'])) {
                        $config['upload_path'] = './uploads/';
                        $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
                        $config['file_name'] = 'payment_slip';
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('media')) {
                            $error = array('error' => $this->upload->display_errors());
                            $response = $this->session->set_flashdata('error', $this->upload->display_errors());
                            $this->load->view('popup.php', $response);
                            print_r($error);
                            die('here');
                        } else {

                            $fileData = array('upload_data' => $this->upload->data());

                            //die('here');
                            $fileData = array('upload_data' => $this->upload->data());
                            $userData['media'] = $fileData['upload_data']['file_name'];
                            $userData['type'] = 'image';
                            $userData['caption'] = $this->input->post('caption');
                            $updres = $this->Main_model->add('tbl_popup', $userData);
                            if ($updres == true) {
                                $response = array('error' => 'Popup Uploaded Successfully');
                                $this->session->set_flashdata('error', 'Popup Uploaded Successfully');
                                $this->load->view('popup.php', $response);
                            } else {
                                $response = array('error' => 'There is an error while uploading Popup Image, Please try Again ..');
                                $this->session->set_flashdata('error', 'There is an error while uploading Popup Image, Please try Again ..');
                                $this->load->view('popup.php', $response);
                            }
                        }
                    } else {
                        $response = array('error' => 'There is an error while uploading Popup Image, Please try Again ..');
                        $this->session->set_flashdata('error', 'There is an error while uploading Popup Image, Please try Again ..');
                        $this->load->view('popup.php', $response);
                    }
                } else {
                    $userData['media'] = $this->input->post('media');
                    $userData['type'] = 'video';
                    $userData['caption'] = $this->input->post('caption');
                    $updres = $this->Main_model->add('tbl_popup', $userData);
                    if ($updres == true) {
                        $response = array('error' => 'Popup Uploaded Successfully');
                        $this->session->set_flashdata('error', 'Popup Uploaded Successfully');
                        $this->load->view('popup.php', $response);
                    } else {
                        $response = array('error' => 'There is an error while uploading Popup Image, Please try Again ..');
                        $this->session->set_flashdata('error', 'There is an error while uploading Popup Image, Please try Again ..');
                        $this->load->view('popup.php', $response);
                    }
                }
            }
            $response['popup'] = $this->Main_model->get_single_record('tbl_user_popup', [], '*');
            $this->load->view('popup.php', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function Blogs($type = '')
    {
        if (is_admin()) {
            $response['header'] = 'Blogs';
            $user_id = $this->input->get('user_id');
            $type = $this->input->get('type');
            $export = $this->input->get('export');

           if (!empty($type) && !empty($user_id) ) {
                $where = 'where user_id = "' . $user_id . '" AND award_id = "' . $type . '"';
            } else if (!empty($type)) {
                $where = 'where award_id = "' . $type . '"';
            } else if (!empty($user_id)) {
                $where = 'where user_id = "' . $user_id . '"';
            } else {
                $where = array('');
            }


            $response['base_url'] = base_url() . 'Admin/Withdraw/incomeLedgar/';
            $config['base_url'] = base_url() . 'Admin/Withdraw/incomeLedgar';
           // $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->input->post('user_id').'" and amount > 0', 'ifnull(sum(amount),0) as total_income');

            $config['uri_segment'] = 4;
            $config['per_page'] = 100;
            $config['suffix'] = '?' . http_build_query($_GET);
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);

            // $sql =  "SELECT user_id, SUM(amount) AS amount, max(award_id) AS award_id, created_at
            // FROM tbl_rewards
            // $where
            // GROUP BY user_id";
            // $query = $this->db->query($sql);
            // $response['user_incomes'] = $query->result_array();

            $response['segament'] = $segment;


            $response['blogs'] = $this->Main_model->get_limit_records('tbl_blogs', $where, '*', $config['per_page'], $segment);
            
         
        
            $this->load->view('blogs.php', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }




    function ManageBlog()
    {
        
        if (is_admin()) {
            $response = array();
            $response['popup'] = '';
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
               // $this->form_validation->set_rules('media', 'Media', 'required');
                if (empty($_FILES['media']['name']))
                {
                    $this->form_validation->set_rules('media', 'Media', 'required');
                }

                $this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                $data = html_escape($data);
            
                    if (!empty($_FILES['media']['name'])) {
                        $config['upload_path'] = './uploads/';
                        $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
                        $config['file_name'] = 'blog';

                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('media')) {
                            $error = array('error' => $this->upload->display_errors());
                            $response = $this->session->set_flashdata('error', $this->upload->display_errors());
                            $this->load->view('create_blog.php', $response);
                            print_r($error);
                            die('here');
                            } else {
                                $fileData = array('upload_data' => $this->upload->data());
                                //die('here');
                                $fileData = array('upload_data' => $this->upload->data());
                                $userData['image'] = $fileData['upload_data']['file_name'];
                                $userData['title'] = $this->input->post('title');
                                $userData['description'] = $this->input->post('description');
                                $updres = $this->Main_model->add('tbl_blogs', $userData);
                                if ($updres == true) {
                                    $response = array('error' => 'Blog Uploaded Successfully');
                                    $this->session->set_flashdata('error', 'Blog Uploaded Successfully');
                                    redirect('Admin/Management/Blogs');

                                } else {
                                    $response = array('error' => 'There is an error while uploading Blog Image, Please try Again ..');
                                    $this->session->set_flashdata('error', 'There is an error while uploading Blog Image, Please try Again ..');
                                    $this->load->view('create_blog.php', $response);
                                }
                            }
                        } else {
                            $response = array('error' => 'There is an error while uploading Blog Image, Please try Again ..');
                            $this->session->set_flashdata('error', 'There is an error while uploading Blog Image, Please try Again ..');
                            $this->load->view('create_blog.php', $response);
                        }
                     
                }   else {
                    $this->session->set_flashdata('message', validation_errors());
                }
            }

            $this->load->view('create_blog.php');
        } else {
            redirect('Admin/Management/administrator');
        }
    }




    function EditBlog($id)
    {
        
        if (is_admin()) {
            $response = array();
            $response['popup'] = '';
            $response['blog'] = $this->Main_model->get_single_record('tbl_blogs', array('id' => $id), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
                if (empty($_FILES['media']['name']))
                {
                    $this->form_validation->set_rules('media', 'Media', 'required');
                }
                $this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                $data = html_escape($data);
            
                    if (!empty($_FILES['media']['name'])) {
                        $config['upload_path'] = './uploads/';
                        $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
                        $config['file_name'] = 'blog';

                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('media')) {
                            $error = array('error' => $this->upload->display_errors());
                            $response = $this->session->set_flashdata('error', $this->upload->display_errors());
                            $this->load->view('create_blog.php', $response);
                            print_r($error);
                            die('here');
                            } else {
                                $fileData = array('upload_data' => $this->upload->data());
                                //die('here');
                                $fileData = array('upload_data' => $this->upload->data());
                                $userData['image'] = $fileData['upload_data']['file_name'];
                                $userData['title'] = $this->input->post('title');
                                $userData['description'] = $this->input->post('description');
                              //  $updres = $this->Main_model->add('tbl_blogs', $userData);
                            
                                $updres = $this->Main_model->update('tbl_blogs', array('id' => $id), $userData);

                                if ($updres == true) {
                                    $response = array('error' => 'Blog Uploaded Successfully');
                                    $this->session->set_flashdata('error', 'Blog Uploaded Successfully');
                                    redirect('Admin/Management/Blogs');

                                } else {
                                    $response = array('error' => 'There is an error while uploading Blog Image, Please try Again ..');
                                    $this->session->set_flashdata('error', 'There is an error while uploading Blog Image, Please try Again ..');
                                    $this->load->view('create_blog.php', $response);
                                }
                            }
                        } else {
                            $response = array('error' => 'There is an error while uploading Blog Image, Please try Again ..');
                            $this->session->set_flashdata('error', 'There is an error while uploading Blog Image, Please try Again ..');
                            $this->load->view('create_blog.php', $response);
                        }
                     
                }   else {
                    $this->session->set_flashdata('message', validation_errors());
                }
            }
            $this->load->view('edit_blog.php', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function notification()
    {
        if (is_admin()) {
            $user_id = $this->input->get('user_id');
            $userinfo = $this->Main_model->get_single_record('tbl_users', ['user_id' => $user_id], 'user_id,name,password,master_key,phone');
            $msg = 'Dear ' . $userinfo['name'] . ', Your Account Successfully created. User ID : ' . $userinfo['user_id'] . ' Password : ' . $userinfo['password'] . ' Transaction Password: ' . $userinfo['master_key'] . ' https://theroyalfuture.com/';
            notify_user($userinfo['user_id'], $msg);
            echo 'Registeration message sent on  phone number : ' . $userinfo['phone'];
        } else {
            redirect('Admin/Management/administrator');
        }
    }
    /////////////////////Admin Activation//////////////////////////
    Private function AdminActivation($userID,$Amount,$dollar,$Days) {
       
        if (is_admin()) {
            $response['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $userID), '*');
            $response['tokenValue'] = $this->Main_model->get_single_record('tbl_token_value',['id' => 1],'amount');
            
            $user_id = $userID;//$data['user_id'];
            $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                                
            //$wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            $activationAmount = $Amount;//$data['amount'];
            $data['days'] = $Days;
            if (!empty($user)) {
                if($user['paid_status'] == 0) {
                    $debitAmount = $activationAmount + 25;
                } else {
                    $debitAmount = $activationAmount;
                }
        
                $sendWallet = array(
                    'user_id' => $user_id,//$this->session->userdata['user_id'],
                    'amount' => -$debitAmount,
                    'type' => 'account_activation',
                    'remark' => 'Account Activation Deduction for ' . $user_id,
                );
                $this->Main_model->add('tbl_wallet', $sendWallet);
                if($user['days'] == 36){
                    $days = 36;
                }else{
                    $days = $data['days'];
                }
                $topupData = array(
                    'paid_status' => 1,
                    'package_id' => 1,//$package['id'],
                    'package_amount' => $activationAmount,
                    'total_package' => $user['total_package'] + $activationAmount,
                    'topup_date' => date('Y-m-d H:i:s'),
                    'capping' => $activationAmount,
                    'incomeLimit2' => $user['incomeLimit2'] + ($activationAmount*3),
                    'days' =>$days,
                );
                $this->Main_model->update('tbl_users', array('user_id' => $user_id), $topupData);


                $adminData = array(
                    'user_id' => $user_id,
                    'activater' => 'admin',//$package['id'],
                    'package' => $activationAmount,
                    'topup_date' => date('Y-m-d H:i:s'),
                    'activation_type' => 'admin_activation',
                );
                $this->Main_model->add('tbl_activation_details',$adminData);
            
                $sponser = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), '*');
                $userRank = $this->Main_model->get_single_record('tbl_roi',"user_id = '".$user['sponser_id']."' ORDER BY id desc limit 1", '*');
                
                $sponserUser = $this->Main_model->get_single_record('tbl_users', array('sponser_id' => $user['sponser_id']), '*');

                $usersLevel = $this->Main_model->get_records('tbl_users', array('sponser_id' => $user['sponser_id']), 'user_id');
                $userIdList = array_column($usersLevel, 'user_id');
                $userIds = "'" . implode ( "', '", $userIdList ) . "'";
                $packageAmount = $userRank['package'];

                $userCountQuery = $this->db->query("SELECT user_id FROM tbl_roi WHERE user_id IN ($userIds) AND package >= '$packageAmount' GROUP BY user_id ");

                if($user['paid_status'] == 0) {
                    $this->Main_model->update_directs($user['sponser_id']);
                } 

                $now = time(); // or your date as well
                $your_date = strtotime($userRank['created_at']);
                $datediff = $now - $your_date;
                $days = round($datediff / (60 * 60 * 24));
                if($userRank['package'] >= 1000 && $days <= 28 && $userCountQuery->num_rows() >= 10){
                    $percent = 0.15;
                }
                elseif($sponser['rank'] >= 2){
                    $days = $data['days'];
                    $percent = 0.0033;
                    $directPercent = 0.1;
                } else {
                    if($data['days'] == 18){
                        $percent = 0.002;
                        $days = $data['days'];
                        $directPercent = 0.05;
                    } elseif($data['days'] == 36){
                        $days = $data['days'];
                        $percent = 0.0026;
                        $directPercent = 0.07;
                    } 
                }
                $roiArr = array(
                    'user_id' => $user['user_id'],
                    'amount' => $activationAmount*$percent,
                    'roi_amount' => $activationAmount*$percent,
                    'days' => $days * 30 - 30,
                    'total_days' => $days * 30 - 30,
                    'package' => $activationAmount,
                    'coin' => $dollar,///$response['tokenValue']['amount'],
                    'token_price' => $response['tokenValue']['amount'],
                    'type' => 'roi_income',
                    'creditDate' => date('Y-m-d'),
                );
                
                $this->Main_model->add('tbl_roi', $roiArr);

                if($sponser['paid_status'] == 1){

                    if($sponser['days'] == 18){
                        $directPercent = 0.05;
                    }
                    if($sponser['days'] == 36){
                        $directPercent =  0.07;  //0.07; 
                    }
                    if($sponser['rank'] >= 4){
                        $directPercent = 0.1;
                    } 

                    if($userRank['created_at'] != NULL && $sponser['rank'] >= 2){
                        
                        $now = time(); // or your date as well
                        $your_date = strtotime($userRank['created_at']);
                        $datediff = $now - $your_date;
                        $days = round($datediff / (60 * 60 * 24));

                        if($days <= 28){
                            $directPercent = 0.1;
                        }  
                    }
                    
                    
                    if($sponser['incomeLimit2'] > $sponser['incomeLimit']){
                        $totalCredit = $sponser['incomeLimit'] + ($activationAmount*$directPercent);
                        if($totalCredit < $sponser['incomeLimit2']){
                            $direct_income = $activationAmount*$directPercent;
                        } else {
                            $direct_income = $sponser['incomeLimit2'] - $sponser['incomeLimit'];
                        }
                        
                        $DirectIncome = array(
                            'user_id' => $user['sponser_id'],
                            'amount' => $direct_income,
                            'type' => 'direct_income',
                            'description' => 'Direct Income from Activation of Member ($'.$activationAmount.')' . $user_id ,
                        );
                        $this->Main_model->add('tbl_income_wallet', $DirectIncome);
                        $this->Main_model->update('tbl_users',['user_id' => $user['sponser_id']],['incomeLimit' => ($sponser['incomeLimit'] + $DirectIncome['amount'])]);
                    }
                }
                $this->db->query("UPDATE tbl_users SET direct_business = direct_business + '$activationAmount' WHERE user_id = '".$sponser['user_id']."'");
                $this->updateBusiness($sponser['user_id'],'team_business',$activationAmount);
                

                $this->ThirdBooster($sponser['user_id']);
                // $message = 'Hello '.$user['name'].', This is a notice to confirm that you have successfully purchased a $'.$activationAmount.' Ricaverse Membership. If you did not perform this action, please contact our support team immediately. Ricaverse Team, This is an automated message. Please do not reply.';
                // send_crypto_email($user['email'],'Activation Alert',$message);
                // $message = 'Dear User your account is successfully activated with amount '.$activationAmount.' by User '.$this->session->userdata['user_id'];
                // $this->session->set_flashdata('message', '<h3 class="text-success">Account Activated Successfully </h3>');
                    
            }
                    
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    private function updateBusiness($user_id,$field,$business){
        $userinfo = $this->Main_model->get_single_record('tbl_users',['user_id' => $user_id],'user_id,sponser_id');
        if(!empty($userinfo['user_id']) && $userinfo['user_id'] != 'none'){
            $this->Main_model->update_business($field,$userinfo['user_id'],$business);
            $this->updateBusiness($userinfo['sponser_id'],$field,$business);
        }
    }


    private function ThirdBooster($user_id) {
        
        // if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
            $response['users'] = $this->Main_model->get_records('tbl_users', array('sponser_id' => $user_id), '*');
           
            $response['users'] = $this->Main_model->get_records('tbl_users', array('sponser_id' => $user_id), '*');

             // nine condition end here
             $response['third_booster_daily_incomes'] = $this->Main_model->get_single_record('third_booster_daily_incomes', array('user_id' => $user_id), '*');
            
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


            $date1 = date('Y-m-d', strtotime(date('Y-m-d'). ' + 14 days'));
            $date2 = date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days'));
            $date3 = date('Y-m-d', strtotime(date('Y-m-d'). ' + 60 days'));
            $date4 = date('Y-m-d', strtotime(date('Y-m-d'). ' + 90 days'));
            $date5 = date('Y-m-d', strtotime(date('Y-m-d'). ' + 150 days'));
            $date6 = date('Y-m-d', strtotime(date('Y-m-d'). ' + 240 days'));
            $date7 = date('Y-m-d', strtotime(date('Y-m-d'). ' + 330 days'));
            $date8 = date('Y-m-d', strtotime(date('Y-m-d'). ' + 450 days'));
            $date9 = date('Y-m-d', strtotime(date('Y-m-d'). ' + 600 days'));
            $date10 = date('Y-m-d', strtotime(date('Y-m-d'). ' + 880 days'));


            $userCountQuery = $this->db->query("SELECT user_id FROM tbl_users WHERE sponser_id = '$user_id'");
            $directUserCont = $userCountQuery->num_rows();
            $userIdList = array_column($response['users'], 'user_id');
            $userIds = "'" . implode ( "', '", $userIdList ) . "'";

            // 3 user direct +


           // first condition start here //
            $userCountQuery1 = $this->db->query("SELECT user_id FROM tbl_users WHERE user_id IN ($userIds) AND total_package >= '$userBusiness1' AND DATE(topup_date) <=  '$date1' GROUP BY user_id ");  
            $userIdOfTotalPackage1 = $userCountQuery1->result_array();
            $numOfUserCount1 = $userCountQuery1->num_rows();
           
            $userIdListOfPackage1 = array_column($userIdOfTotalPackage1, 'user_id');
            $teemABuserIds1 = "'" . implode ( "', '", $userIdListOfPackage1 ) . "'";
            
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
            $teemABuserIds2 = "'" . implode ( "', '", $userIdListOfPackage2 ) . "'";
            
            // 2 user bussiness maximum
            $totalUserPackageCountQuery2 = $this->db->query("SELECT sum(total_package) as total_package FROM tbl_users WHERE sponser_id = '$user_id' AND DATE(topup_date) <=  '$date2' AND  user_id IN ($userIds) AND user_id NOT IN ($teemABuserIds2)");  
           
            $teemCBusiness2 = $totalUserPackageCountQuery2->row();

            //  second condition end here

             //  third start here //
             $userCountQuery3 = $this->db->query("SELECT user_id FROM tbl_users WHERE user_id IN ($userIds) AND total_package >= '$userBusiness3' AND DATE(topup_date) <=  '$date3' GROUP BY user_id ");  
             $userIdOfTotalPackage3 = $userCountQuery3->result_array();
             $numOfUserCount3 = $userCountQuery3->num_rows();
            
             $userIdListOfPackage3 = array_column($userIdOfTotalPackage3, 'user_id');
             $teemABuserIds3 = "'" . implode ( "', '", $userIdListOfPackage3 ) . "'";
             
             // 2 user bussiness maximum
             $totalUserPackageCountQuery3 = $this->db->query("SELECT sum(total_package) as total_package FROM tbl_users WHERE sponser_id = '$user_id' AND DATE(topup_date) <=  '$date3' AND user_id IN ($userIds) AND user_id NOT IN ($teemABuserIds3)");  
            
             $teemCBusiness3 = $totalUserPackageCountQuery3->row();
 
             // third condition end here

              //  four start here //
              $userCountQuery4 = $this->db->query("SELECT user_id FROM tbl_users WHERE user_id IN ($userIds) AND total_package >= '$userBusiness4' AND DATE(topup_date) <=  '$date4' GROUP BY user_id ");  
              $userIdOfTotalPackage4 = $userCountQuery4->result_array();
              $numOfUserCount4 = $userCountQuery4->num_rows();
             
              $userIdListOfPackage4 = array_column($userIdOfTotalPackage4, 'user_id');
              $teemABuserIds4 = "'" . implode ( "', '", $userIdListOfPackage4 ) . "'";
              
              // 2 user bussiness maximum
              $totalUserPackageCountQuery4 = $this->db->query("SELECT sum(total_package) as total_package FROM tbl_users WHERE sponser_id = '$user_id' AND DATE(topup_date) <=  '$date4' AND user_id IN ($userIds) AND user_id NOT IN ($teemABuserIds4)");  
             
              $teemCBusiness4 = $totalUserPackageCountQuery4->row();
  
              // four condition end here

               //  five start here //
               $userCountQuery5 = $this->db->query("SELECT user_id FROM tbl_users WHERE user_id IN ($userIds) AND total_package >= '$userBusiness4' AND DATE(topup_date) <=  '$date5' GROUP BY user_id ");  
               $userIdOfTotalPackage5 = $userCountQuery5->result_array();
               $numOfUserCount5 = $userCountQuery5->num_rows();
              
               $userIdListOfPackage5 = array_column($userIdOfTotalPackage5, 'user_id');
               $teemABuserIds5 = "'" . implode ( "', '", $userIdListOfPackage5 ) . "'";
               
               // 2 user bussiness maximum
               $totalUserPackageCountQuery5 = $this->db->query("SELECT sum(total_package) as total_package FROM tbl_users WHERE sponser_id = '$user_id' AND DATE(topup_date) <=  '$date5' AND user_id IN ($userIds) AND user_id NOT IN ($teemABuserIds5)");  
              
               $teemCBusiness5 = $totalUserPackageCountQuery5->row();
   
               // five condition end here

               //  six start here //
               $userCountQuery6 = $this->db->query("SELECT user_id FROM tbl_users WHERE user_id IN ($userIds) AND total_package >= '$userBusiness6' AND DATE(topup_date) <=  '$date6' GROUP BY user_id ");  
               $userIdOfTotalPackage6 = $userCountQuery6->result_array();
               $numOfUserCount6 = $userCountQuery6->num_rows();
              
               $userIdListOfPackage6 = array_column($userIdOfTotalPackage6, 'user_id');
               $teemABuserIds6 = "'" . implode ( "', '", $userIdListOfPackage6 ) . "'";
               
               // 2 user bussiness maximum
               $totalUserPackageCountQuery6 = $this->db->query("SELECT sum(total_package) as total_package FROM tbl_users WHERE sponser_id = '$user_id' AND DATE(topup_date) <=  '$date6' AND user_id IN ($userIds) AND user_id NOT IN ($teemABuserIds6)");  
              
               $teemCBusiness6 = $totalUserPackageCountQuery6->row();
   
               // six condition end here

               //  seven start here //
               $userCountQuery7 = $this->db->query("SELECT user_id FROM tbl_users WHERE user_id IN ($userIds) AND total_package >= '$userBusiness7' AND DATE(topup_date) <=  '$date7' GROUP BY user_id ");  
               $userIdOfTotalPackage7 = $userCountQuery7->result_array();
               $numOfUserCount7 = $userCountQuery7->num_rows();
              
               $userIdListOfPackage7 = array_column($userIdOfTotalPackage7, 'user_id');
               $teemABuserIds7 = "'" . implode ( "', '", $userIdListOfPackage7 ) . "'";
               
               // 2 user bussiness maximum
               $totalUserPackageCountQuery7 = $this->db->query("SELECT sum(total_package) as total_package FROM tbl_users WHERE sponser_id = '$user_id' AND DATE(topup_date) <=  '$date7' AND user_id IN ($userIds) AND user_id NOT IN ($teemABuserIds7)");  
              
               $teemCBusiness7 = $totalUserPackageCountQuery7->row();
   
               // seven condition end here


               //  eight start here //
               $userCountQuery8 = $this->db->query("SELECT user_id FROM tbl_users WHERE user_id IN ($userIds) AND total_package >= '$userBusiness8' AND DATE(topup_date) <=  '$date8' GROUP BY user_id ");  
               $userIdOfTotalPackage8 = $userCountQuery8->result_array();
               $numOfUserCount8 = $userCountQuery8->num_rows();
              
               $userIdListOfPackage8 = array_column($userIdOfTotalPackage8, 'user_id');
               $teemABuserIds8 = "'" . implode ( "', '", $userIdListOfPackage8 ) . "'";
               
               // 2 user bussiness maximum
               $totalUserPackageCountQuery8 = $this->db->query("SELECT sum(total_package) as total_package FROM tbl_users WHERE sponser_id = '$user_id' AND DATE(topup_date) <=  '$date8' AND user_id IN ($userIds) AND user_id NOT IN ($teemABuserIds8)");  
              
               $teemCBusiness8 = $totalUserPackageCountQuery8->row();
   
               // eight condition end here

               //  nine start here //
               $userCountQuery9 = $this->db->query("SELECT user_id FROM tbl_users WHERE user_id IN ($userIds) AND total_package >= '$userBusiness9' AND DATE(topup_date) <=  '$date9' GROUP BY user_id ");  
               $userIdOfTotalPackage9 = $userCountQuery9->result_array();
               $numOfUserCount9 = $userCountQuery9->num_rows();
              
               $userIdListOfPackage9 = array_column($userIdOfTotalPackage9, 'user_id');
               $teemABuserIds9 = "'" . implode ( "', '", $userIdListOfPackage9 ) . "'";
               
               // 2 user bussiness maximum
               $totalUserPackageCountQuery9 = $this->db->query("SELECT sum(total_package) as total_package FROM tbl_users WHERE sponser_id = '$user_id' AND DATE(topup_date) <=  '$date9' AND user_id IN ($userIds) AND user_id NOT IN ($teemABuserIds9)");  
              
               $teemCBusiness9 = $totalUserPackageCountQuery9->row();
   
               // nine condition end here

               //  nine start here //
               $userCountQuery10 = $this->db->query("SELECT user_id FROM tbl_users WHERE user_id IN ($userIds) AND total_package >= '$userBusiness10' AND DATE(topup_date) <=  '$date10' GROUP BY user_id ");  
               $userIdOfTotalPackage10 = $userCountQuery10->result_array();
               $numOfUserCount10 = $userCountQuery10->num_rows();
              
               $userIdListOfPackage10 = array_column($userIdOfTotalPackage10, 'user_id');
               $teemABuserIds10 = "'" . implode ( "', '", $userIdListOfPackage10 ) . "'";
               
               // 2 user bussiness maximum
               $totalUserPackageCountQuery10 = $this->db->query("SELECT sum(total_package) as total_package FROM tbl_users WHERE sponser_id = '$user_id' AND DATE(topup_date) <=  '$date10' AND user_id IN ($userIds) AND user_id NOT IN ($teemABuserIds10)");  
              
               $teemCBusiness10 = $totalUserPackageCountQuery10->row();
   
              
            //    echo $directUserCont;
            // echo 'first';
            // echo $numOfUserCount1;
            // echo 'second';
            // echo $teemBusiness1;
            // echo 'third';

               if($directUserCont >= 3 && $numOfUserCount1 >= 2 && $teemCBusiness1->total_package >= $teemBusiness1) {

                $thirdBooster1 = array(
                    'user_id' => $user_id,
                    'amount' => 1,
                    'date' => date('Y-m-d'),
                    'total_days' => 100,
                    'balance_days' => '',
                    'last_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' + 100 days')),
                    'created_at' => date('d-m-Y h:i:s'),
                    'updated_at' => date('d-m-Y h:i:s'),
                );

                if($response['third_booster_daily_incomes']){
                    $this->Main_model->update('third_booster_daily_incomes', array('user_id' => $user_id), $thirdBooster1);
                } else {
                    $this->Main_model->add('third_booster_daily_incomes', $thirdBooster1);
                }

               } else if ($directUserCont >= 3 && $numOfUserCount2 >= 2 && $teemCBusiness2->total_package >= $teemBusiness2) {
                
                $thirdBooster2 = array(
                    'user_id' => $user_id,
                    'amount' => 2,
                    'date' => date('Y-m-d'),
                    'total_days' => 100,
                    'balance_days' => '',
                    'last_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' + 100 days')),
                    'created_at' => date('d-m-Y h:i:s'),
                    'updated_at' => date('d-m-Y h:i:s'),
                );

                if($response['third_booster_daily_incomes']){
                    $this->Main_model->update('third_booster_daily_incomes', array('user_id' => $user_id), $thirdBooster2);
                }  else {
                    $this->Main_model->add('third_booster_daily_incomes', $thirdBooster2);
                }

               } else if ($directUserCont >= 3 && $numOfUserCount3 >= 2 && $teemCBusiness3->total_package >= $teemBusiness3) {
               
                $thirdBooster3 = array(
                    'user_id' => $user_id,
                    'amount' => 6,
                    'date' => date('Y-m-d'),
                    'total_days' => 100,
                    'balance_days' => '',
                    'last_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' + 100 days')),
                    'created_at' => date('d-m-Y h:i:s'),
                    'updated_at' => date('d-m-Y h:i:s'),
                );
                if($response['third_booster_daily_incomes']){
                    $this->Main_model->update('third_booster_daily_incomes', array('user_id' => $user_id), $thirdBooster3);
                } else {
                    $this->Main_model->add('third_booster_daily_incomes', $thirdBooster3);
                }
              
               } else if ($directUserCont >= 3 && $numOfUserCount4 >= 2 && $teemCBusiness4->total_package >= $teemBusiness4) {
                
                $thirdBooster4 = array(
                    'user_id' => $user_id,
                    'amount' => 14,
                    'date' => date('Y-m-d'),
                    'total_days' => 100,
                    'balance_days' => '',
                    'last_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' + 100 days')),
                    'created_at' => date('d-m-Y h:i:s'),
                    'updated_at' => date('d-m-Y h:i:s'),
                );
                if($response['third_booster_daily_incomes']){
                    $this->Main_model->update('third_booster_daily_incomes', array('user_id' => $user_id), $thirdBooster4);
                } else {
                    $this->Main_model->add('third_booster_daily_incomes', $thirdBooster4);
                }

            } else if ($directUserCont >= 3 && $numOfUserCount5 >= 2 && $teemCBusiness5->total_package >= $teemBusiness5) {

                $thirdBooster5 = array(
                    'user_id' => $user_id,
                    'amount' => 32,
                    'date' => date('Y-m-d'),
                    'total_days' => 100,
                    'balance_days' => '',
                    'last_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' + 100 days')),
                    'created_at' => date('d-m-Y h:i:s'),
                    'updated_at' => date('d-m-Y h:i:s'),
                );
                if($response['third_booster_daily_incomes']){
                    $this->Main_model->update('third_booster_daily_incomes', array('user_id' => $user_id), $thirdBooster5);
                }  else {
                    $this->Main_model->add('third_booster_daily_incomes', $thirdBooster5);

                }


               } else if ($directUserCont >= 3 && $numOfUserCount6 >= 2 && $teemCBusiness6->total_package >= $teemBusiness6) {
              
                $thirdBooster6 = array(
                    'user_id' => $user_id,
                    'amount' => 60,
                    'date' => date('Y-m-d'),
                    'total_days' => 100,
                    'balance_days' => '',
                    'last_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' + 100 days')),
                    'created_at' => date('d-m-Y h:i:s'),
                    'updated_at' => date('d-m-Y h:i:s'),
                );
                if($response['third_booster_daily_incomes']){
                    $this->Main_model->update('third_booster_daily_incomes', array('user_id' => $user_id), $thirdBooster6);
                } 
                else {
                    $this->Main_model->add('third_booster_daily_incomes', $thirdBooster6);

                }


               } else if ($directUserCont >= 3 && $numOfUserCount7 >= 2 && $teemCBusiness7->total_package >= $teemBusiness7) {

                $thirdBooster7 = array(
                    'user_id' => $user_id,
                    'amount' => 120,
                    'date' => date('Y-m-d'),
                    'total_days' => 100,
                    'balance_days' => '',
                    'last_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' + 100 days')),
                    'created_at' => date('d-m-Y h:i:s'),
                    'updated_at' => date('d-m-Y h:i:s'),
                );
                if($response['third_booster_daily_incomes']){
                    $this->Main_model->update('third_booster_daily_incomes', array('user_id' => $user_id), $thirdBooster7);
                } 
                else {
                    $this->Main_model->add('third_booster_daily_incomes', $thirdBooster7);

                }

               } else if ($directUserCont >= 3 && $numOfUserCount8 >= 2 && $teemCBusiness8->total_package >= $teemBusiness8) {
               
                $thirdBooster8 = array(
                    'user_id' => $user_id,
                    'amount' => 240,
                    'date' => date('Y-m-d'),
                    'total_days' => 100,
                    'balance_days' => '',
                    'last_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' + 100 days')),
                    'created_at' => date('d-m-Y h:i:s'),
                    'updated_at' => date('d-m-Y h:i:s'),
                );
                if($response['third_booster_daily_incomes']){
                    $this->Main_model->update('third_booster_daily_incomes', array('user_id' => $user_id), $thirdBooster8);
                } 
                else {
                    $this->Main_model->add('third_booster_daily_incomes', $thirdBooster8);
                }

               } else if ($directUserCont >= 3 && $numOfUserCount9 >= 2 && $teemCBusiness9->total_package >= $teemBusiness9) {

                $thirdBooster9 = array(
                    'user_id' => $user_id,
                    'amount' => 400,
                    'date' => date('Y-m-d'),
                    'total_days' => 100,
                    'balance_days' => '',
                    'last_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' + 100 days')),
                    'created_at' => date('d-m-Y h:i:s'),
                    'updated_at' => date('d-m-Y h:i:s'),
                );
                if($response['third_booster_daily_incomes']){
                    $this->Main_model->update('third_booster_daily_incomes', array('user_id' => $user_id), $thirdBooster9);
                } 
                else {
                    $this->Main_model->add('third_booster_daily_incomes', $thirdBooster9);
                }
                
               } else if ($directUserCont >= 3 && $numOfUserCount10 >= 2 && $teemCBusiness10->total_package >= $teemBusiness10){

                $thirdBooster10 = array(
                    'user_id' => $user_id,
                    'amount' => 800,
                    'date' => date('Y-m-d'),
                    'total_days' => 100,
                    'balance_days' => '',
                    'last_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' + 100 days')),
                    'created_at' => date('d-m-Y h:i:s'),
                    'updated_at' => date('d-m-Y h:i:s'),
                );
                if($response['third_booster_daily_incomes']){
                    $this->Main_model->update('third_booster_daily_incomes', array('user_id' => $user_id), $thirdBooster10);
                } 
                else {
                    $this->Main_model->add('third_booster_daily_incomes', $thirdBooster10);
                }
            } 
               return true;
        } 
    // }
}
