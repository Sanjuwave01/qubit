<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Withdraw extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email', 'pagination'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
        //        require_once( APPPATH . 'modules/Admin/libraries/SimpleExcel/SimpleExcel.php');
        //        if (file_exists(APPPATH . 'modules/Admin/libraries/SimpleExcel/SimpleExcel.php')) {
        //            echo'file exist';
        //        }
    }

    public function index()
    {
        if (is_admin()) {
            // $object = new PHPExcel();
            // pr($object);
            // echo APPPATH . 'modules/Admin/libraries/SimpleExcel/SimpleExcel.php';
            // die;
            $response['requests'] = $this->Main_model->get_records('tbl_withdraw', array(), '*');
            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,first_name,name,last_name,sponser_id,email,phone,eth_address,other_address');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            $this->load->view('withdraw_requests', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }




    public function Pending()
    {
        if (is_admin()) {
           
            $response['requests'] = $this->Main_model->get_records('tbl_withdraw', array('status' => 0), '*');
            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone,eth_address,other_address');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            $this->load->view('withdraw_requests', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

   // public function Approved()
    //{
      //  if (is_admin()) {
        //    $response['requests'] = $this->Main_model->get_approved('tbl_withdraw', array('status' => 1), '*');
          //  foreach ($response['requests'] as $key => $request) {
            //    $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone,eth_address,other_address');
              //  $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
           // }
            //echo "<pre>";
            //print_r($response);
            //$this->load->view('withdraw_requests', $response);
        //} else {
          //  redirect('Admin/Management/administrator');
        //}
    //}
  
   public function stakingreward(){
      if (is_admin()) {
            $response['requests'] = $this->Main_model->get_rewards_history('rewards_withdrawal', array('processing' => 0) ,'*');
            //echo "<pre>";
           // print_r($response);
           // exit;
            $this->load->view('stakingreward', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
   }
   public function stakingrewardapprove(){
      if (is_admin()) {
            $response['requests'] = $this->Main_model->get_rewards_history('rewards_withdrawal', array('processing' => 1) , '*');
            //echo "<pre>";
           // print_r($response);
           // exit;
            $this->load->view('stakingreward', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
   }
   public function stakingrewardreject(){
      if (is_admin()) {
            $response['requests'] = $this->Main_model->get_rewards_history('rewards_withdrawal', array('processing' => 2) ,'*');
            //echo "<pre>";
           // print_r($response);
           // exit;
            $this->load->view('stakingreward', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
   }

    public function Rejected()
    {
        if (is_admin()) {
            $response['requests'] = $this->Main_model->get_records('tbl_withdraw', array('status' => 2), '*');
            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone,eth_address,other_address');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            $this->load->view('withdraw_requests', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    // public function payout_summary() {
    //     if (is_admin()) {
    //         $response = array();
    //         $response['records'] = $this->Main_model->payout_summary();
    //         foreach($response['records'] as $key => $record){
    //             //
    //             $incomes = $this->Main_model->get_incomes('tbl_income_wallet', 'date(created_at) = "'.$record['date'].'"', 'ifnull(sum(amount),0) as sum,type');
    //             $response['records'][$key]['incomes'] = calculate_income($incomes);
    //         }
    //         // pr($response,true);
    //         $this->load->view('payout_summary', $response);
    //     } else {
    //         redirect('Admin/Management/administrator');
    //     }
    // }

    public function payout_summary2()
    {
        if (is_admin()) {
            $response = array();
            $this->db->order_by('id', 'desc');  
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            $export = $this->input->get('export');
            if (!empty($start_date)) {
                $where = 'date(created_at) >= "' . $start_date . '" AND date(created_at) <= "' . $end_date . '"';
            } else {
                $where = array('');
            }
            $response['records'] = $this->Main_model->payout_summary2($where);
            foreach ($response['records'] as $key => $record) {
                //
                $this->db->order_by('id', 'desc');  
                $incomes = $this->Main_model->get_incomes('tbl_income_wallet', 'date(created_at) = "' . $record['date'] . '"', 'ifnull(sum(amount),0) as sum,type');
                $response['records'][$key]['incomes'] = calculate_income($incomes);
            }
            // pr($response,true);

            if ($export) {
                $filename = 'PayoutSummary_' . time() . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $usersData = $response['records'];
                $file = fopen('php://output', 'w');
                $header = array("#", "Date", "Matching Bonus", "Monthly Salary Bonus", "Level Bonus", "Royalty Bonus", "Total Payout");
                fputcsv($file, $header);
                foreach ($usersData as $key => $record) {
                    $records[$key]['i'] = ($key + 1);
                    $records[$key]['date'] = $record['date'];
                    $records[$key]['matching_bonus'] = $record['incomes']['matching_bonus'];
                    $records[$key]['daily_roi_income'] = $record['incomes']['daily_roi_income'];
                    $records[$key]['level_income'] = $record['incomes']['level_income'];
                    $records[$key]['royalty_income'] = $record['incomes']['royalty_income'];
                    $records[$key]['total_payout'] = $record['incomes']['total_payout'];
                }

                foreach ($records as $key => $line) {
                    fputcsv($file, $line);
                }
                fclose($file);
                exit;
            }
            $this->load->view('payout_summary', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function payout_summary()
    {
        if (is_admin()) {
            $response = array();
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            $export = $this->input->get('export');
            if (!empty($start_date)) {
                $where = 'date(created_at) >= "' . $start_date . '" AND date(created_at) <= "' . $end_date . '"';
            } else {
                $where = array('');
            }
            $response['base_url'] = base_url() . 'Admin/Withdraw/payout_summary/';
            $config['base_url'] = base_url() . 'Admin/Withdraw/payout_summary';
            $this->db->order_by('id', 'desc');  
            $rowCount = $this->Main_model->get_sum2('tbl_income_wallet', 'date(created_at)');
            $config['total_rows'] = count($rowCount);

            // pr($config['total_rows'],true);
            $config['uri_segment'] = 4;
            $config['per_page'] = 10;
            $config['suffix'] = '?' . http_build_query($_GET);
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['segament'] = $segment;
            $this->db->order_by('id', 'desc');  
            $response['records'] = $this->Main_model->payout_summary3($where, $config['per_page'], $segment);
            foreach ($response['records'] as $key => $record) {
                //
            $this->db->order_by('id', 'desc');  
                $incomes = $this->Main_model->get_incomes('tbl_income_wallet', 'date(created_at) = "' . $record['date'] . '"', 'ifnull(sum(amount),0) as sum,type');
                $response['records'][$key]['incomes'] = calculate_income($incomes);
            }
            // pr($response,true);
            if ($export) {
                $filename = 'PayoutSummary_' . time() . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $usersData = $response['records'];
                $file = fopen('php://output', 'w');
                $header = array("#", "Date", "Matching Bonus", "Monthly Salary Bonus", "Level Bonus", "Royalty Bonus", "Total Payout");
                fputcsv($file, $header);
                foreach ($usersData as $key => $record) {
                    $records[$key]['i'] = ($key + 1);
                    $records[$key]['date'] = $record['date'];
                    $records[$key]['matching_bonus'] = $record['incomes']['matching_bonus'];
                    $records[$key]['daily_roi_income'] = $record['incomes']['daily_roi_income'];
                    $records[$key]['level_income'] = $record['incomes']['level_income'];
                    $records[$key]['royalty_income'] = $record['incomes']['royalty_income'];
                    $records[$key]['total_payout'] = $record['incomes']['total_payout'];
                }

                foreach ($records as $key => $line) {
                    fputcsv($file, $line);
                }
                fclose($file);
                exit;
            }

            $this->load->view('payout_summary', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }


    public function request($id)
    {
        if (is_admin()) {
            $response['request'] = $this->Main_model->get_single_record('tbl_withdraw', array('id' => $id), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($response['request']['status'] != 0) {
                    $this->session->set_flashdata('message', 'Status of this request already updated!');
                } else {
                    if ($data['status'] == 1) {
                        $wArr = array(
                            'status' => 1,
                            'remark' => $data['remark'],
                        );
                        $res = $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
                        if ($res) {
                            $this->session->set_flashdata('message', 'Withdraw request approved');
                        } else {
                            $this->session->set_flashdata('message', 'Error while apporing request');
                        }
                    } elseif ($data['status'] == 2) {
                        $wArr = array(
                            'status' => 2,
                            'remark' => $data['remark'],
                        );
                        $res = $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
                        if ($res) {
                            $productArr = array(
                                'user_id' => $response['request']['user_id'],
                                'amount' => $response['request']['amount'],
                                'type' => $response['request']['type'],
                                'description' => $data['remark'],
                                'withdraw_date' => date('Y-m-d'),
                            );
                            $this->Main_model->add('tbl_income_wallet', $productArr);
                            $this->session->set_flashdata('message', 'Withdraw request rejected');
                        } else {
                            $this->session->set_flashdata('message', 'Error while apporing rejection');
                        }
                    }
                }
            }
            $response['request'] = $this->Main_model->get_single_record('tbl_withdraw', array('id' => $id), '*');
            $response['user_details'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $response['request']['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
            $this->load->view('request', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }


    public function requestWithdraw($id)
    {
        if (is_admin()) {
            $response['request'] = $this->Main_model->get_single_record('tbl_withdraw', array('id' => $id), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($response['request']['status'] != 0) {
                    $this->session->set_flashdata('message', 'Status of this request already updated!');
                } else {
                    if ($data['status'] == 1) {
                        $wArr = array(
                            'status' => 1,
                            'remark' => $data['remark'],
                        );
                        $res = $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
                        if ($res) {
                            $this->session->set_flashdata('message', 'Withdraw request approved');
                        } else {
                            $this->session->set_flashdata('message', 'Error while apporing request');
                        }
                    } elseif ($data['status'] == 2) {
                        $wArr = array(
                            'status' => 2,
                            'remark' => $data['remark'],
                        );
                        $res = $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
                        if ($res) {
                            $productArr = array(
                                'user_id' => $response['request']['user_id'],
                                'amount' => $response['request']['amount'],
                                'type' => $response['request']['type'],
                                'description' => $data['remark'],
                                'withdraw_date' => date('Y-m-d'),
                            );
                            $this->Main_model->add('tbl_income_wallet', $productArr);
                            $this->session->set_flashdata('message', 'Withdraw request rejected');
                        } else {
                            $this->session->set_flashdata('message', 'Error while apporing rejection');
                        }
                    }
                }
            }
            redirect('Admin/Withdraw/Pending');
            // $response['request'] = $this->Main_model->get_single_record('tbl_withdraw', array('id' => $id), '*');
            // $response['user_details'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $response['request']['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
            // $this->load->view('request', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }
  
   public function stakingstatus($id){
     if (is_admin()) {
        $data = $this->security->xss_clean($this->input->post());
                   $wArr = array(
                            'status' => $data['status'],
                            'remarks' => $data['remark'],
                            'processing'=>$data['status']
                        );
       
       $res = $this->Main_model->update('rewards_withdrawal', array('id' => $id), $wArr);
       if ($res) {
                          
         $this->session->set_flashdata('message', 'Status has been updated successfully!');
                        } else {
                            $this->session->set_flashdata('message', 'Error while Apporing rejection');
                        }
       redirect('Admin/Withdraw/stakingreward');
       } else {
            redirect('Admin/Management/administrator');
        }
   }



    public function approve_withdraw()
    {
        // sk

        secure_request();

        if ($this->input->is_ajax_request()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('hash', 'Transaction Hash', 'trim|required');
                $this->form_validation->set_rules('id', 'id', 'trim|required|numeric');
                $this->form_validation->set_rules('transaction', 'Transaction', 'trim|required', ['required' => 'Invaild Method for Registration!']);
                $this->form_validation->set_rules('blockHash', 'Transaction Hash Confirm', 'trim|required', ['required' => 'Transaction Hash Confirm not found!']);
                if ($this->form_validation->run() != false) {
                    $check = $this->Main_model->get_single_record('tbl_withdraw', ['id' => $data['id'], 'status' => 0], '*');
                    if (!empty($check)) {
                        $this->Main_model->update('tbl_withdraw', ['id' => $data['id']], [
                            'status' => 1,
                            'remark' => $data['hash'],
                            'json_response' => $data['transaction']
                        ]);

                        $response['success'] = 1;
                        $response['message'] = 'Withdraw Approved Successfully!';
                    } else {
                        $response['success'] = 0;
                        $response['message'] = 'Withdraw Already transfered!';
                    }
                } else {
                    $response['success'] = 0;
                    $response['message'] = validation_errors();
                }
            } else {
                redirect('Admin/Management/administrator');
            }
        } else {
            $response['success'] = 0;
            $response['message'] = 'Do not hit with direct script!';
        }
        $response['token'] = $this->security->get_csrf_hash();
        echo json_encode($response);
        exit();
    }

    public function stakeEdit($id)
    {
        $response = array();
        $response['user'] = $this->Main_model->get_single_record('tbl_roi', array('id' => $id), '*');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('total_days', 'Total Days', 'trim');
            $this->form_validation->set_rules('coin', 'Coin', 'trim');
            $this->form_validation->set_rules('days', 'Days', 'trim');
            $this->form_validation->set_rules('roi_amount', 'Roi Amount', 'trim');
            $this->form_validation->set_rules('created_at', 'Credit Date', 'trim');
            if ($this->form_validation->run() != FALSE) {
                $UserData = array(
                    'total_days' => $data['total_days'],
                    'coin' => $data['coin'],
                    'days' => $data['days'],
                    'roi_amount' => $data['roi_amount'],
                    'created_at' => $data['created_at'],
                );
                $res = $this->Main_model->update('tbl_roi', array('id' => $id), $UserData);
                if ($res == TRUE) {
                    $this->session->set_flashdata('message', '<span class="text-success">User Details Updated Successfully</span>');
                } else {
                    $this->session->set_flashdata('message', '<span class="text-danger">Error While Updating Details Please Try Again ...</span>');
                }
            } else {
                $this->session->set_flashdata('message', validation_errors());
            }
        }
        $this->load->view('stake_edit', $response);
    }

   public function Stackinghistory()
    {
        //echo "hi";
        // die;
        $type = $this->input->get('type');
        $value = $this->input->get('value');
         $user_id = $this->session->userdata['user_id'];
        $where = ['user_id' => $this->session->userdata['user_id']];
        $where = [];
        if (!empty($value)) {
            $where = [$type => $value];
        }
        $config['base_url'] = base_url() . 'Admin/Withdraw/Stackinghistory';
        $config['total_rows'] = $this->Main_model->get_sum('tbl_roi', $where, 'count(id) as sum');
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
        $this->db->order_by('id', 'desc');
        //$response['tbl1'] = $this->Main_model->get_limit_records('tbl_roi_20', $where, '*', $config['per_page'], $segment);
        //$response['tbl2'] = $this->Main_model->get_limit_records('tbl_roi', $where, '*', $config['per_page'], $segment, 'id DESC');
        //$response['stake_history'] = array_merge( $response['tbl1'],$response['tbl2']);
        $response['stake_history'] = $this->Main_model->get_limit_records('tbl_roi', $where, '*', $config['per_page'], $segment);
      //	$response['stake_user_id'] = $this->Main_model->get_limit_records('tbl_roi',$where, 'id,user_id', $config['per_page'], $segment);
     
     	
        $response['segment'] = $segment;
        $response['type'] = $type;
        $response['value'] = $value;
        $this->load->view('stackingHistory', $response);
    }
  
      public function Stackinghistory20()
    {
        //echo "hi";
        // die;
        $type = $this->input->get('type');
        $value = $this->input->get('value');
         $user_id = $this->session->userdata['user_id'];
        $where = ['user_id' => $this->session->userdata['user_id']];
        $where = [];
        if (!empty($value)) {
            $where = [$type => $value];
        }
        $config['base_url'] = base_url() . 'Admin/Withdraw/Stackinghistory20';
        $config['total_rows'] = $this->Main_model->get_sum('tbl_roi_20', $where, 'count(id) as sum');
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
        $this->db->order_by('id', 'desc');
        //$response['tbl1'] = $this->Main_model->get_limit_records('tbl_roi_20', $where, '*', $config['per_page'], $segment);
        //$response['tbl2'] = $this->Main_model->get_limit_records('tbl_roi', $where, '*', $config['per_page'], $segment, 'id DESC');
        //$response['stake_history'] = array_merge( $response['tbl1'],$response['tbl2']);
        $response['stake_history'] = $this->Main_model->get_limit_records('tbl_roi_20', $where, '*', $config['per_page'], $segment);
        $response['segment'] = $segment;
        $response['type'] = $type;
        $response['value'] = $value;
        $this->load->view('stackingHistory', $response);
    }
  
  

    public function income2($type = '')
    {
        if (is_admin()) {
            $response['header'] = ucwords(str_replace('_', ' ', $type));
            $config['base_url'] = base_url() . 'Admin/Withdraw/income/' . $type;
            $config['total_rows'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => $type), 'ifnull(count(id),0) as sum');
            $config['uri_segment'] = 5;
            $config['per_page'] = 100;
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(5);
            $response['total_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => $type), 'ifnull(sum(amount),0) as sum');
            $this->db->order_by('id', 'desc');  
            $response['user_incomes'] = $this->Main_model->get_limit_records('tbl_income_wallet', array('type' => $type), '*', $config['per_page'], $segment);
            $response['segament'] = $segment;
            $this->load->view('incomes', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }
    

    public function dateWisePayout($date = '')
    {
        if (is_admin()) {
            $response['header'] = 'Datewise Payout Summary';
            $config['base_url'] = base_url() . 'Admin/Withdraw/incomeLedgar';
            $this->db->order_by('id', 'desc');  
            $config['total_rows'] = $this->Main_model->get_sum('tbl_income_wallet', 'date(created_at) = "' . $date . '"', 'ifnull(count(id),0) as sum');
            $config['uri_segment'] = 4;
            $config['per_page'] = 100;
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $this->db->order_by('id', 'desc');  
            $response['total_income'] = $this->Main_model->get_sum('tbl_income_wallet', 'date(created_at) = "' . $date . '"', 'ifnull(sum(amount),0) as sum');
            $this->db->order_by('id', 'desc');  
            $response['user_incomes'] = $this->Main_model->get_records('tbl_income_wallet', 'date(created_at) = "' . $date . '"', '*');
            $response['segament'] = 0;
            // pr($response,true);
            $this->load->view('incomes', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function incomeLedgar($type = '')
    {
        if (is_admin()) {
            $response['header'] = 'Income Ledgar';
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            $export = $this->input->get('export');
            if (!empty($start_date)) {
                $where = 'date(created_at) >= "' . $start_date . '" AND date(created_at) <= "' . $end_date . '"';
            } else {
                $where = array('');
            }
            $response['base_url'] = base_url() . 'Admin/Withdraw/incomeLedgar/';
            $config['base_url'] = base_url() . 'Admin/Withdraw/incomeLedgar';
           	$config['total_rows'] = $this->Main_model->get_sum('tbl_income_wallet', $where, 'count(id) as sum');
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
            $config['reuse_query_string'] = true;
            $config['suffix'] = '?' . http_build_query($_GET);
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['total_income'] = $this->Main_model->get_sum('tbl_income_wallet', $where, 'ifnull(sum(amount),0) as sum');
            $this->db->order_by('id', 'desc');  
            $response['user_incomes'] = $this->Main_model->get_limit_records('tbl_income_wallet', $where, '*', $config['per_page'], $segment);
            $response['segament'] = $segment;
            $response['total_rows']= $config['total_rows']; 

            if ($export) {
                $application_type = 'application/' . $export;
                $header = ['#', 'User ID', 'Amount', 'Type', 'Description', 'Credit Date'];
                foreach ($response['user_incomes'] as $key => $record) {
                    $records[$key]['i'] = ($key + 1);
                    $records[$key]['user_id'] = $record['user_id'];
                    $records[$key]['amount'] = $record['amount'];
                    $records[$key]['type'] = $record['type'];
                    $records[$key]['description'] = $record['description'];
                    $records[$key]['created_at'] = $record['created_at'];
                }
                $this->finalExport($export, $application_type, $header, $records);
            }
            $this->load->view('incomeLedgar', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function userIncome($type = '')
    {
        if (is_admin()) {
            $response['header'] = 'User Business Income';
            $user_id = $this->input->get('user_id');
            $type = $this->input->get('type');
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            $export = $this->input->get('export');
            if (!empty($start_date) && !empty($end_date) && !empty($type) && !empty($user_id)) {
                $where = 'user_id = "' . $user_id . '" AND type = "' . $type . '" AND date(created_at) >= "' . $start_date . '" AND date(created_at) <= "' . $end_date . '"';
            } else if (!empty($start_date) && !empty($end_date) && !empty($type)) {
                $where = 'type = "' . $type . '" AND date(created_at) >= "' . $start_date . '" AND date(created_at) <= "' . $end_date . '"';
            } else if (!empty($start_date) && !empty($end_date) && !empty($user_id)) {
                $where = 'user_id = "' . $user_id . '" AND date(created_at) >= "' . $start_date . '" AND date(created_at) <= "' . $end_date . '"';
            } else if (!empty($type) && !empty($user_id)) {
                $where = 'user_id = "' . $user_id . '" AND type = "' . $type . '"';
            } else if (!empty($type)) {
                $where = 'type = "' . $type . '"';
            } else if (!empty($user_id)) {
                $where = 'user_id = "' . $user_id . '"';
            } else {
                $where = array('');
            }

            $response['base_url'] = base_url() . 'Admin/Withdraw/userIncome/';
            $config['base_url'] = base_url() . 'Admin/Withdraw/userIncome/';
            $config['total_rows'] = $this->Main_model->get_sum('tbl_income_wallet', $where, 'ifnull(count(id),0) as sum');
            // $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->input->post('user_id').'" and amount > 0', 'ifnull(sum(amount),0) as total_income');
            $config['uri_segment'] = 4;
            $config['per_page'] = 100;
            $config['suffix'] = '?' . http_build_query($_GET);
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['total_income'] = $this->Main_model->get_sum('tbl_income_wallet', $where, 'ifnull(sum(amount),0) as sum');


            //  $response['teamBusiness'] = $this->Main_model->getUserBusiness($user_id);

            // $response['user_incomes'] = $this->Main_model->get_limit_records('tbl_income_wallet', $where, 'user_id, created_at, amount,type,description , ifnull(max(amount),0) as amount', $config['per_page'], $segment);
            $this->db->order_by('id', 'desc');  
            $response['user_incomes'] = $this->Main_model->get_limit_records('tbl_income_wallet', $where, '*', $config['per_page'], $segment);
            $response['segament'] = $segment;
            if ($export) {
                $application_type = 'application/' . $export;
                $header = ['#', 'User ID', 'Amount', 'Type', 'Description', 'Credit Date'];
                foreach ($response['user_incomes'] as $key => $record) {
                    $records[$key]['i'] = ($key + 1);
                    $records[$key]['user_id'] = $record['user_id'];
                    $records[$key]['amount'] = $record['amount'];
                    $records[$key]['type'] = $record['type'];
                    $records[$key]['description'] = $record['description'];
                    $records[$key]['created_at'] = $record['created_at'];
                }
                $this->finalExport($export, $application_type, $header, $records);
            }
            $this->load->view('user_business_income', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function ManageUserWallet()
    {

        //die('this page is accessable');
        if (is_admin()) {
            $response['title'] = "Direct Withdraw";
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('user_id', 'User id', 'trim|required|xss_clean');
                $this->form_validation->set_rules('type', 'Type', 'trim|required|xss_clean');

                if ($this->form_validation->run() != FALSE) {
                    $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $this->input->post('user_id')), '*');

                    //  $kyc_status = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $this->input->post('user_id')), '*');
                    // $totalWithdraw = $this->Main_model->get_single_record('tbl_withdraw', array('user_id' => $this->input->post('user_id'),'status !=' => 2), 'ifnull(sum(amount),0) as balance');
                    $withdraw_amount = abs($this->input->post('amount'));
                    // $master_key = $this->input->post('master_key');

                    $balance = $this->Main_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->input->post('user_id') . '"', 'ifnull(sum(amount),0) as balance');

                    //  $income_wallet_info = $this->Main_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->input->post('user_id') . '"', 'id');


                    $update_amount = $this->input->post('type') == '1' ? abs($this->input->post('amount')) : '-' . abs($this->input->post('amount'));
                    if ($user) {
                        $DirectIncome = array(
                            'user_id' => $this->input->post('user_id'),
                            'amount' => $update_amount,
                            'type' => 'withdraw_request',
                            'description' => 'Withdrawal Amount ',
                            'withdraw_date' => date('Y-m-d'),
                        );
                        $this->Main_model->add('tbl_income_wallet', $DirectIncome);

                        // $this->Main_model->update('tbl_income_wallet', array('id' => $id), $DirectIncome);


                        // $walletArr = array(
                        //     'user_id' => $this->input->post('user_id'),
                        //     'amount' => $update_amount * 90 / 100,
                        //     'type' => 'direct_income_withdraw',
                        //     'remark' => 'fund generated from direct income withdraw',
                        //     'sender_id' => $this->input->post('user_id'),
                        // );
                        // $this->Main_model->add('tbl_wallet', $walletArr);

                        // if ($data['pin_transfer'] == 0) {
                        //     $withdrawArr = array(
                        //         'user_id' => $this->input->post('user_id'),
                        //         'amount' => $update_amount,
                        //         'type' => 'withdraw_request',
                        //         'tds' => $update_amount * 0 / 100,
                        //         'admin_charges' => $update_amount * 10 / 100,
                        //         'fund_conversion' => 0,
                        //         'zil_address' => $data['wallet_address'],
                        //         'payable_amount' => $update_amount - ($update_amount * 10 / 100),
                        //         'coin' => $update_amount/$response['tokenValue']['amount'],
                        //         'credit_type' => $data['credit_type'],
                        //     );
                        //     $this->Main_model->add('tbl_withdraw', $withdrawArr);
                        // } else {

                        //     $walletArr = array(
                        //         'user_id' => $this->input->post('user_id'),
                        //         'amount' => $update_amount * 90 / 100,
                        //         'type' => 'direct_income_withdraw',
                        //         'remark' => 'fund generated from direct income withdraw',
                        //         'sender_id' => $this->input->post('user_id'),
                        //     );
                        //     $this->Main_model->add('tbl_wallet', $walletArr);
                        // }

                        $this->session->set_flashdata('message', 'Your Requeste has been Successfully done');
                    } else {
                        $this->session->set_flashdata('message', 'Please enter valid user id');
                    }
                } else {
                    $this->session->set_flashdata('message', validation_errors());
                }
            }
            $response['balance'] = $this->Main_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->input->post('user_id') . '"', 'ifnull(sum(amount),0) as balance, id');

            $this->load->view('manage_user_wallet', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }


 public function userLevel($type = '')
    {
        if (is_admin()) {
            $response['header'] = 'User Business Income';
            $user_id = $this->input->get('user_id');
            $type = $this->input->get('type');
            $export = $this->input->get('export');
            
            $where = array(); // Create an array to hold your WHERE conditions
            
            if (!empty($type)) {
                $where['award_id'] = $type;
            }
            
            if (!empty($user_id)) {
                $where['user_id'] = $user_id;
            }
            
            $this->load->library('pagination');
            
            $config['base_url'] = base_url() . 'Admin/Withdraw/userLevel';
            $config['total_rows'] = $this->db->where($where)->count_all_results('tbl_rewards');
            $config['per_page'] = 100;
            $config['suffix'] = '?' . http_build_query($_GET);
            
            $this->pagination->initialize($config);
            
            $segment = $this->uri->segment(4);
            
            $this->db->select('user_id, SUM(amount) AS amount, MAX(award_id) AS award_id, created_at');
            $this->db->from('tbl_rewards');
            $this->db->where($where);
           	$this->db->order_by('created_at', 'DESC');         
            $this->db->group_by('user_id');
            $this->db->limit($config['per_page'], $segment);
            
            $query = $this->db->get();
            
            $response['user_incomes'] = $query->result_array();
            $response['segment'] = $segment;
            
            if ($export) {
                $application_type = 'application/' . $export;
                $header = ['#', 'User ID', 'Amount', 'Credit Date'];
                $records = array();
                foreach ($response['user_incomes'] as $key => $record) {
                    $records[$key]['i'] = ($key + 1);
                    $records[$key]['user_id'] = $record['user_id'];
                    $records[$key]['amount'] = $record['amount'];
                    $records[$key]['created_at'] = $record['created_at'];
                }
                $this->finalExport($export, $application_type, $header, $records);
            }
            
            $this->load->view('user_level', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }
  
  

    public function incomeHolding($type = '')
    {
        if (is_admin()) {
            $response['header'] = 'Staking Ledgar';
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            $export = $this->input->get('export');
            if (!empty($start_date)) {
                $where = 'date(created_at) >= "' . $start_date . '" AND date(created_at) <= "' . $end_date . '"';
            } else {
                $where = array('');
            }
            $response['base_url'] = base_url() . 'Admin/Withdraw/incomeHolding/';
            $config['base_url'] = base_url() . 'Admin/Withdraw/incomeHolding';
            $config['total_rows'] = $this->Main_model->get_sum('tbl_holding_wallet', $where, 'ifnull(count(id),0) as sum');
            $config['uri_segment'] = 4;
            $config['per_page'] = 100;
            $config['suffix'] = '?' . http_build_query($_GET);
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);

            $response['total_income'] = $this->Main_model->get_sum('tbl_holding_wallet', $where, 'ifnull(sum(amount),0) as sum');
            $this->db->order_by('id', 'desc');  
            $response['user_incomes'] = $this->Main_model->get_limit_records('tbl_holding_wallet', $where, '*', $config['per_page'], $segment);
            $response['segament'] = $segment;
            if ($export) {
                $application_type = 'application/' . $export;
                $header = ['#', 'User ID', 'Amount', 'Type', 'Description', 'Credit Date'];
                foreach ($response['user_incomes'] as $key => $record) {
                    $records[$key]['i'] = ($key + 1);
                    $records[$key]['user_id'] = $record['user_id'];
                    $records[$key]['amount'] = $record['amount'];
                    $records[$key]['type'] = $record['type'];
                    $records[$key]['description'] = $record['description'];
                    $records[$key]['created_at'] = $record['created_at'];
                }
                $this->finalExport($export, $application_type, $header, $records);
            }
            $this->load->view('incomeLedgar', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }


    public function income($type = '')
    {


        if (is_admin()) {
            $response['header'] = ucwords(str_replace('_', ' ', $type));
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            $export = $this->input->get('export');
            if (!empty($start_date)) {
                $where = 'date(created_at) >= "' . $start_date . '" AND date(created_at) <= "' . $end_date . '" AND type = "' . $type . '"';
            } else {
                $where = array('type' => $type);
            }

            if ($type == 'self_income') {
                $table = 'tbl_coin_wallet';
            } else {
                $table = 'tbl_income_wallet';
            }

            $response['base_url'] = base_url() . 'Admin/Withdraw/income/' . $type . '/';
            $config['base_url'] = base_url() . 'Admin/Withdraw/income/' . $type;
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
            $config['total_rows'] = $this->Main_model->get_sum($table, $where, 'ifnull(count(id),0) as sum');
            $config['reuse_query_string'] = true;
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(5);
            $response['total_income'] = $this->Main_model->get_sum($table, $where, 'ifnull(sum(amount),0) as sum');
            $this->db->order_by('id', 'desc');  
            $response['user_incomes'] = $this->Main_model->get_limit_records($table, $where, '*', $config['per_page'], $segment);
            $response['segament'] = $segment;
            $response['total_rows']=$config['total_rows'];
            if ($export) {
                $application_type = 'application/' . $export;
                $header = ['#', 'User ID', 'Amount', 'Type', 'Description', 'Credit Date'];
                foreach ($response['user_incomes'] as $key => $record) {
                    $records[$key]['i'] = ($key + 1);
                    $records[$key]['user_id'] = $record['user_id'];
                    $records[$key]['amount'] = $record['amount'];
                    $records[$key]['type'] = $record['type'];
                    $records[$key]['description'] = $record['description'];
                    $records[$key]['created_at'] = $record['created_at'];
                }
                $this->finalExport($export, $application_type, $header, $records);
            }

            $this->load->view('incomeLedgar', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }


    public function finalExport($export, $application_type, $header, $records)
    {
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
    }

    public function AddressRequests()
    {
        if (is_admin()) {
            $where = array('kyc_status' => 1);
            $start_date = '';
            $end_date = '';
            // if ($this->input->server('REQUEST_METHOD') == 'POST') {
            //     $start_date = date_format(date_create($this->input->post('start_date')),"Y-m-d"); 
            //     $end_date = date_format(date_create($this->input->post('end_date')),"Y-m-d");; 
            //     $where = "  date(created_at) >= date('".$start_date."') and date(created_at) <= date('".$end_date."')";
            // }else{
            //     $where = array('kyc_status' => 1);
            // }
            $response['start_date'] = date_format(date_create($start_date), "m/d/Y");
            $response['end_date'] = date_format(date_create($end_date), "m/d/Y");
            $response['header'] = 'Bank Address Requests';
            $response['users'] = $this->Main_model->get_records('tbl_bank_details', $where, '*');

            $this->load->view('AddressRequests', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function ApprovedAddressRequests()
    {
        if (is_admin()) {
            $where = array('kyc_status' => 2);
            $start_date = '';
            $end_date = '';
            // if ($this->input->server('REQUEST_METHOD') == 'GET') {
            //     $start_date = date_format(date_create($this->input->get('start_date')),"Y-m-d"); 
            //     $end_date = date_format(date_create($this->input->get('end_date')),"Y-m-d");; 
            //     $where = "kyc_status  = 2 and date(created_at) >= date('".$start_date."') and date(created_at) <= date('".$end_date."')";
            // }
            $response['start_date'] = date_format(date_create($start_date), "m/d/Y");
            $response['end_date'] = date_format(date_create($end_date), "m/d/Y");
            $response['header'] = 'Approved Bank Address Requests';
            $response['users'] = $this->Main_model->get_records('tbl_bank_details', $where, '*');

            $this->load->view('AddressRequests', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function RejectedAddressRequests()
    {
        if (is_admin()) {
            $where = array('kyc_status' => 3);
            $start_date = '';
            $end_date = '';
            // if ($this->input->server('REQUEST_METHOD') == 'GET') {
            //     $start_date = date_format(date_create($this->input->get('start_date')),"Y-m-d"); 
            //     $end_date = date_format(date_create($this->input->get('end_date')),"Y-m-d");; 
            //     $where = "kyc_status  = 3 and date(created_at) >= date('".$start_date."') and date(created_at) <= date('".$end_date."')";
            // }
            $response['start_date'] = date_format(date_create($start_date), "m/d/Y");
            $response['end_date'] = date_format(date_create($end_date), "m/d/Y");
            $response['header'] = 'Rejected Bank Address Requests';
            $response['users'] = $this->Main_model->get_records('tbl_bank_details', $where, '*');
            // pr($where,true);
            $this->load->view('AddressRequests', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function ApproveUserAddressRequest($id, $status)
    {
        if (is_admin()) {
            $data['success'] = 0;
            $res = $this->Main_model->update('tbl_bank_details', array('id' => $id), array('kyc_status' => $status));
            if ($res) {
                $data['message'] = 'Request Accepted Successfully';
                $data['success'] = 1;
            } else {
                $data['message'] = 'Error While Updating Status';
            }
            echo json_encode($data);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function withdrawZil($type = '')
    {
        if (is_admin()) {
            if ($type == '') {
                $where = [];
            }
            if ($type == 'pending') {
                $where = ['status' => 0];
            }
            if ($type == 'approve') {
                $where = ['status' => 1];
            }
            if ($type == 'reject') {
                $where = ['status' => 2];
            }
            $response['requests'] = $this->Main_model->get_records('tbl_withdrawZil', $where, '*');
            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,first_name,name,last_name,sponser_id,email,phone');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            $this->load->view('withdrawZil_requests', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function Zilapprove($id)
    {
        if (is_admin()) {
            $request = $this->Main_model->get_single_record('tbl_withdrawZil', array('id' => $id), '*');
            if ($request['status'] == 0) {
                $wArr = array(
                    'status' => 1,
                    'remark' => "Approved by Admin",
                );
                $this->Main_model->update('tbl_withdrawZil', array('id' => $id), $wArr);
            }
            redirect('Admin/Withdraw/withdrawZil/pending');
        } else {
            redirect('Admin/Management/administrator');
        }
    }


    public function Zilreject($id)
    {
        if (is_admin()) {
            $request = $this->Main_model->get_single_record('tbl_withdrawZil', array('id' => $id), '*');
            if ($request['status'] == 0) {
                $wArr = array(
                    'status' => 2,
                    'remark' => "Rejected By Admin",
                );
                $res = $this->Main_model->update('tbl_withdrawZil', array('id' => $id), $wArr);
                if ($res) {
                    $productArr = array(
                        'user_id' => $request['user_id'],
                        'amount' => $request['amount'],
                        'type' => $request['type'],
                        'description' => $request['remark'],
                    );
                    $this->Main_model->add('tbl_refferal_wallet', $productArr);
                }
            }
            redirect('Admin/Withdraw/withdrawZil/pending');
        } else {
            redirect('Admin/Management/administrator');
        }
    }


    public function approveNormal($id)
    {
        if (is_admin()) {
            $request = $this->Main_model->get_single_record('tbl_withdraw', array('id' => $id), '*');
            if ($request['status'] == 0) {
                $wArr = array(
                    'status' => 1,
                );
                $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
            }
            redirect('Admin/Withdraw/Pending');
        } else {
            redirect('Admin/Management/administrator');
        }
    }


    public function rejectNormal($id)
    {
        if (is_admin()) {
            $request = $this->Main_model->get_single_record('tbl_withdraw', array('id' => $id), '*');
            if ($request['status'] == 0) {
                $wArr = array(
                    'status' => 2,
                    'remark' => "Rejected By Admin",
                );
                $res = $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
                if ($res) {
                    $productArr = array(
                        'user_id' => $request['user_id'],
                        'amount' => $request['amount'],
                        'type' => $request['type'],
                        'description' => $request['remark'],
                    );
                    $this->Main_model->add('tbl_income_wallet', $productArr);
                }
            }
            redirect('Admin/Withdraw/Pending');
        } else {
            redirect('Admin/Management/administrator');
        }
    }



    public function withDrawUpdated()
    {
        if (is_admin()) {
            $res = array();
            $wArr = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());

                $requestID = $data['withDrawRequestID'];

                $wArr['status'] = 1;
                $wArr['remark'] = json_encode($data['data']);

                $res = $this->Main_model->update('tbl_withdraw', array('id' => $requestID), $wArr);

                $res = array('csrf' => $this->security->get_csrf_hash(), 'data' => $data);

                echo json_encode($res, true);
            }
        }
    }
  
     public function Dec_Withdraw_Pending(){
        if(is_admin()){
            
            $response['users'] =$this->Main_model->get_stack_records('tbl_roi', '*');
        
                $this->load->view('withdraw_request_pending', $response);
            
        }else{
            redirect('Admin/Management/administrator'); 
        }
    }
   public function Dec_Pending()
    {
        if (is_admin()) {
          	$response['requests'] = $this->Main_model->get_records('tbl_withdraw', ['status' => 0,'created_at >='=>'2023-12-13 00:00:00','withdrawal_type'=>'rewards'], '*');
            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']),'id,name,first_name,last_name,sponser_id,email,phone,eth_address,other_address');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
        //     echo "<pre>";
        //  print_r($response);
        //  exit;
            $this->load->view('withdraw_requests', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

  	public function Approved(){
        if (is_admin()) {
         	$field = $this->input->get('type');
            $value = $this->input->get('value');
          	$cond = array();
            if (!empty($field) && !empty($value)) {
                $cond = array($field => $value);
            }
           $config['base_url'] = base_url('Admin/Withdraw/Approved');
              $config['total_rows'] = $this->Main_model->count_approved_requests(); // Implement this method in your Main_model
              $config['per_page'] = 10; // Number of records per page
              $this->pagination->initialize($config);
              // Get the current page from the URL segment
              $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
              // Fetch data with limit and offset
              $response['requests'] = $this->Main_model->get_approveds('tbl_withdraw', array('status' => 1),$cond, '*', $config['per_page'], $page,$this->uri->segment(4));
              // Loop through results and fetch related data
              foreach ($response['requests'] as $key => $request) {
                  $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone,eth_address,other_address');
                  $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
              }
              // Load the view with pagination data
              $response['pagination'] = $this->pagination->create_links();
             // $this->load->view('withdraw_requests', $response);
              $this->load->view('approved_check', $response);
          } else {
              redirect('Admin/Management/administrator');
          }
      }
}
       