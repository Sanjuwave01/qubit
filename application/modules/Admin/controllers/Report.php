<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
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
            redirect('Admin/Management');
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function btcPayment()
    {
        if (is_admin()) {
            $response['btc'] = $this->Main_model->get_records('BTC_TRANSACTION', [], '*');
            $response['header'] = 'Coin Payment Transaction';
            $this->load->view('coinbase_report', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }

    public function coinbaseTransaction()
    {
        if (is_admin()) {
            $response['btc'] = $this->Main_model->get_records('tbl_coinbase_transactions', [], '*');
            $response['header'] = 'Coinbase Transaction';
            $this->load->view('coinbase_list', $response);
        } else {
            redirect('Admin/Management/administrator');
        }
    }


    public function CoinHistory()
    {
        $response['header'] = 'Coin History';
        $type = $this->input->get('type');
        $value = $this->input->get('value');
        $where = [];
        if (!empty($type)) {
            $where = [$type => $value];
        }
        $records = $this->pagination('tbl_coin_wallet', $where, '*', 'Admin/Report/CoinHistory', 4, 10, 'id', 'ASC');
        $response['path'] =  $records['path'];
        $response['field'] = '<div class="col-4">
                                  <select class="form-control" name="type">
                                      <option value="user_id" ' . $type . ' == "user_id" ? "selected" : "";?>
                                          User ID</option>
                                  </select>
                                </div>
                              <div class="col-4">
                                  <input type="text" name="value" class="form-control text-dark float-right"
                                      value="' . $value . '" placeholder="Search">
                              </div>
                              <div class="col-4">
                                  <div class="input-group-append">
                                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                  </div>
                              </div>';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>User ID</th>
                                <th>Coin</th>
                                <th>Action</th>
                             </tr>';
        $tbody = [];
        $i = $records['segment'] + 1;
        foreach ($records['records'] as $key => $rec) {
            extract($rec);
            $tbody[$key]  = ' <tr>
                                <td>' . $i . '</td>
                                <td>' . $user_id . '</td>
                                <td>' . $amount . '</td>
                                <td>' . $created_at . '</td>
                             </tr>';
            $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('report', $response);
    }

    public function roiHistory()
    {
        $response['header'] = 'ROI Details';
        $type = $this->input->get('type');
        $value = $this->input->get('value');
        $where = [];
        if (!empty($type)) {
            $where = [$type => $value];
        }
        $records = $this->pagination('tbl_roi', $where, '*', 'Admin/roi-details', 3, 10, 'id', 'ASC');
        $response['path'] =  $records['path'];
        $response['field'] = '<div class="col-4">
                                  <select class="form-control" name="type">
                                      <option value="user_id" ' . $type . ' == "user_id" ? "selected" : "";?>
                                          User ID</option>
                                  </select>
                                </div>
                              <div class="col-4">
                                  <input type="text" name="value" class="form-control text-dark float-right"
                                      value="' . $value . '" placeholder="Search">
                              </div>
                              <div class="col-4">
                                  <div class="input-group-append">
                                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                  </div>
                              </div>';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>User ID</th>
                                <th>Amount</th>
                                <th>Action</th>
                             </tr>';
        $tbody = [];
        $i = $records['segment'] + 1;
        foreach ($records['records'] as $key => $rec) {
            extract($rec);
            if ($days > 0) {
                $button =  form_open('Admin/roiAction') . form_hidden('orderID', $id) . form_submit(['type' => 'submit', 'class' => 'btn btn-danger', 'value' => 'STOP']) . form_close();
            } else {
                $button =  form_open('Admin/roiAction') . form_hidden('orderID', $id) . form_input('days') . form_submit(['type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Start']) . form_close();
            }

            $tbody[$key]  = ' <tr>
                                <td>' . $i . '</td>
                                <td>' . $user_id . '</td>
                                <td>' . $roi_amount . '</td>
                                <td>' . $button . $this->session->flashdata('message' . $id) . '</td>
                             </tr>';
            $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('report', $response);
    }


    public function roiAction()
    {
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('orderID', 'Order ID', 'trim|required|numeric');
            if ($this->form_validation->run() === true) {
                if (!empty($data['days'])) {
                    $userdata = [
                        'days' => $data['days'],
                    ];
                    $this->Main_model->update('tbl_roi', ['id' => $data['orderID']], $userdata);
                    $this->session->set_flashdata('message' . $data['orderID'], '<h5 class="text-success">ROI enabled successfully</h5>');
                } else {
                    $userdata = [
                        'days' => 0,
                    ];
                    $this->Main_model->update('tbl_roi', ['id' => $data['orderID']], $userdata);
                    $this->session->set_flashdata('message' . $data['orderID'], '<h5 class="text-success">ROI disabled successfully</h5>');
                }
            }
        }
        redirect('Admin/roi-details');
    }


    public function pagination($table, $where, $select, $base_url, $segment, $per_page, $field, $order)
    {
        $config['total_rows'] = $this->Main_model->get_sum($table, $where, 'ifnull(count(id),0) as sum');
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
        $records = $this->Main_model->get_limit_records_orderBy($table, $where, $select, $config['per_page'], $segment, $field, $order);
        $response = ['records' => $records, 'segment' => $segment, 'path' => $config['base_url']];
        return $response;
    }
}
