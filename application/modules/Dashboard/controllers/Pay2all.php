<?php
defined('BASEPATH') OR exit('No direct script allowed');

class pay2all extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library(['session','form_validation']);
        $this->load->model('User_model');
        $this->load->helper(['url','user']);
        $this->token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6Ijg5OTFiMzc2YjM5MjM0ZDY4MzVmYmM2OTAwMmY3ZGFhMzEzODY4MDdmMTI5ZDRmZTc0NWRjMjVjZjc0MTcyNGRjMzFiZmY0YmRlYzZhMDVjIn0.eyJhdWQiOiIxIiwianRpIjoiODk5MWIzNzZiMzkyMzRkNjgzNWZiYzY5MDAyZjdkYWEzMTM4NjgwN2YxMjlkNGZlNzQ1ZGMyNWNmNzQxNzI0ZGMzMWJmZjRiZGVjNmEwNWMiLCJpYXQiOjE2NjM2Njg0NDUsIm5iZiI6MTY2MzY2ODQ0NSwiZXhwIjoxNjk1MjA0NDQ1LCJzdWIiOiI1NzQiLCJzY29wZXMiOltdfQ.f9Q8gVgzlEwhmL3dRTNMngD1sf6Pc4VTqxJqmMoVlA3wXHtKtpSvKSVArDtz_j3Ds1UiCR1AcjNHjVglGcWEv7AdkD2EaLCL1HMxwe-IgofAANDtrygaGCzGMToxxVzQREW9d7tDDTBr33BmBgyyDcyEM79spFq0TtqhhnSvsemf09rw8a1fwfgG230zdRF_kIHaOxf3pEL8uBBM8WSVHAZIajGBUiyPlYYyBlQs7DEuJea5j1di9Nt38w1Kem6D79ZliYMFdySv21Gkse-8x0gM6lUP858OYtk6Xy6uILO0_VWCi1FYguVv_aOOo36WwcwURiwHUTsB0tvRL6qfKFc1yIZ5Ow9htgWIWmq-051ZnKq5GBbaWuK3RsH-cmoBFTPnShnoubS3OM2z1PrTN333kzMm3u2q3lR3eFa34mCtvlZY4C37xPoINMbJp6P_8vBVxqHiMmmzZsEwwWxLYdM3HFdfIliqzALnDp149z9E2miYDOjwtjasJYaccMlN6jDolPpy8S_n513Ov7yg8eUlie1Ygtgsitr2d9MU2TwqnNgJ8wT7CfsvKKFLopjMQ7ETeQM8AMX2vBCmG3-2nPSDPuC3Qi-j0oJoeZVQ_SmJI9IguLsHoYjWbnF3YnqW-n8A4Wpk6Fzb4J9pTIP9npPRgqcXVOUXfouZN-omDj4';
    }

    // public function getProvider(){
    //     if(is_logged_in() === false){
    //         redirect('api-logout');
    //         exit;
    //     }

    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //     CURLOPT_URL => 'https://api.pay2all.in/v1/app/providers',
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_ENCODING => '',
    //     CURLOPT_MAXREDIRS => 10,
    //     CURLOPT_TIMEOUT => 0,
    //     CURLOPT_FOLLOWLOCATION => true,
    //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //     CURLOPT_CUSTOMREQUEST => 'GET',
    //     CURLOPT_HTTPHEADER => array(
    //         'Accept: application/json',
    //         'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmZGFlMGQ0YzJkZDBiNDM1YjA0ZDQxZDY2NjJmMmExOWE5NzIwMjMzODFhZjczMDZiNGU1NGUzNmRmYzBlNWY0ZjU1NTExNDJlYWVmODUxIn0.eyJhdWQiOiIxIiwianRpIjoiMWZkYWUwZDRjMmRkMGI0MzViMDRkNDFkNjY2MmYyYTE5YTk3MjAyMzM4MWFmNzMwNmI0ZTU0ZTM2ZGZjMGU1ZjRmNTU1MTE0MmVhZWY4NTEiLCJpYXQiOjE2NjM2NTAxMTQsIm5iZiI6MTY2MzY1MDExNCwiZXhwIjoxNjk1MTg2MTE0LCJzdWIiOiI1NzQiLCJzY29wZXMiOltdfQ.REkkomBZnsF-d3XAAXIjrqJ0Vx4XPSK9Ga6ZmR6SeREKTKDeGhNbIG1uMv8eobhlYrCEo5MQki5uRrVUMK_WlTwh5YD_5RfAAzA6Eu18YiMbHyQf8snGaNSGOJ7R0WBJzaoksCds7MeK9X8X5FJrLpRZ25NCR_IBk6T9PHUXgPZg7LDkbo2eeEtYyfLYYl3IlCaG5cfGkhw2zDUy2u7rRD1EH1GeDpA00bvpzZ9gXloTdcpjvVjtMnrhpvkw6Abl5Flqj-wBVLDhKTsA0JJUhB0M-_dTpl5XXDzxSIGe579Hu16dvZw9eoPYsUk51wb0g5x3HV0RcESRHvmjl4lQkNv8DBKKxN0l6RBLqni2zNWPi_2-Hc_jAEeggvLuDhLuSKWv_wrnY1Q2p5cMday-2GOuxXlwysSdFNEeZbBRUkfY-rjM2yS4gSOBlFtFtDHh6gNT0jS2tg_YmopEVx4kkJfcsxipquznhoLqd9bGis1dOP2e5YOEWFp0e-mAsUzsF0zbAEIgruBfUQsJrxzfgMu0KFDBEGiCEmZ6-ojFLMZpgQysAw5Qa8YB4gYxodgpNoyp5CI5q2XR0usUOucz2FTSvEVYGllGlJ1EeU-VHzuMP8pvOlPOQBeUQVD-Ew78uGfOVNRQPTc-ifuIZL16qGK0RGzCaO5FetoYURAlQdA'
    //     ),
    //     ));

    //     $response = curl_exec($curl);
    //     curl_close($curl);
    //     $result = json_decode($response,true);
    //     pr($result['providers'],true);
    //     foreach($result['providers'] as $key => $re){
    //         //pr($re);
    //         $data = [
    //             'provider_id' => $re['id'],
    //             'service_id' => $re['service_id'],
    //             'provider_name' => $re['provider_name'],
    //         ];
    //         //$this->User_model->add('pay2all_providers',$data);
    //     }
    // }

    public function rechargeList(){
        if(is_logged_in() === false){
            redirect('api-logout');
            exit;
        }
        $response['header'] = 'Pay2all Services';
        $this->load->view('provider-list',$response);
    }

    public function recharge($type) {
        if(is_logged_in() === false){
            redirect('api-logout');
            exit;
        }
        $response['header'] = ucfirst(str_replace('_', ' ', $type));
        $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
        $response['services'] = $this->User_model->get_single_record('pay2all_services',['service_name' => $response['header']],'service_id');
        $response['providers'] = $this->User_model->get_records('pay2all_providers', array('service_id' => $response['services']['service_id']), '*');
        $response['balance'] = $this->User_model->get_single_record('tbl_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
            $this->form_validation->set_rules('provider_id', 'Provider Id', 'trim|required');
            if ($this->form_validation->run() != FALSE) {
                $withdraw_amount = abs($data['amount']);
                $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                $balance = $this->User_model->get_single_record('tbl_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');

                $opreator = $this->User_model->get_single_record('pay2all_providers', ['provider_id' => $data['provider_id']], '*');
                $requiredAmount = $withdraw_amount/80;
                if ($balance['balance'] >= $requiredAmount) {
                    if ($user['paid_status'] == 1) {
                        $myorderid = $this->generate_order_id();
                        $postData = ['number' => $data['phone'],'provider_id' => $data['provider_id'],'amount' => $data['amount'],'client_id' => $myorderid];
                        // pr($postData,true);
                        $jsonD = $this->curlSetup($postData);
                        //pr($jsonD,true);
                        if(!empty($jsonD['status_id']) && ($jsonD['status_id'] == 0 || $jsonD['status_id'] == 1 || $jsonD['status_id'] == 3)){
                            $DirectIncome = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => - $requiredAmount,
                                'type' => 'recharge_amount',
                                'remark' => 'Mobile Recharge',
                            );
                            $this->User_model->add('tbl_wallet', $DirectIncome);
                            $transactionArr = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'utr' => !empty($jsonD['utr'])?$jsonD['utr']:'',
                                'report_id' => $jsonD['report_id'],
                                'orderid' => $myorderid,
                                'status_id' => $jsonD['status_id'],
                                'message' => $jsonD['message'],
                            );
                            
                            $this->User_model->add('tbl_recharge', $transactionArr);
                            //pr($jsonD,true);
                            
                            $response['provider'] = $opreator['provider_name'];
                            $response['amount'] = $data['amount'];
                            $response['phone'] = $data['phone'];
                            $this->load->view('rechargesuccess',$response);

                            $this->session->set_flashdata('message', '<span class="text-success>Transaction Complete!</span>');

                        }else{
                            $this->session->set_flashdata('message',$jsonD['message']);
                            $this->load->view('recharge_transaction', $response);
                        }
                    }else {
                        $this->session->set_flashdata('message', 'Inactive User');
                        $this->load->view('recharge_transaction', $response);
                    }
                }else {
                    $this->session->set_flashdata('message', 'Insuffcient Balance');
                    $this->load->view('recharge_transaction', $response);
                }

                //pr($data,1);
            }else{
                // pr(validation_errors());
                    $this->load->view('recharge_transaction', $response);
            }
        }else{
            $this->load->view('recharge_transaction', $response);
        }
       
    }

    private function curlSetup($post_data){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.pay2all.in/v1/payment/recharge',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $post_data,//array('number' => $data['mob'],'provider_id' => $provider,'amount' => $data['amount'],'client_id' => $myorderid,'operator_ref'=>$data['operator_code']),
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                "Authorization:Bearer ".$this->token
            ),
        ));

        $response1 = curl_exec($curl);
        curl_close($curl);
        return $jsonD = json_decode($response1,true);
    }

    private function generate_order_id() {
        $order_id = rand(10000, 99999);
        $order = $this->User_model->get_single_record('tbl_recharge', array('orderid' => $order_id), 'orderid');
        if (!empty($order)) {
            return $this->generate_order_id();
        } else {
            return $order_id;
        }
    }

    public function webhook(){
        $status_id = $_POST['status_id'];
        $utr = $_POST['utr'];
        $report_id = $_POST['report_id'];
        $client_id = $_POST['client_id'];
        $number = $_POST['number'];
        $check = $this->User_model->get_single_record('tbl_recharge',['orderid' => $client_id],'*');
        if(!empty($check)){
            $this->User_model->update('tbl_recharge',['orderid' => $client_id],['status_id' => $status_id,'utr' => $utr]);
        }
    }

    public function billVerification($type){
        if(is_logged_in() === false){
            redirect('api-logout');
            exit;
        }
        $response['header'] = ucfirst(str_replace('_', ' ', $type));
        $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
        $response['services'] = $this->User_model->get_single_record('pay2all_services',['service_name' => $response['header']],'service_id');
        $response['providers'] = $this->User_model->get_records('pay2all_providers', array('service_id' => $response['services']['service_id']), '*');
        $response['balance'] = $this->User_model->get_single_record('tbl_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
        $this->load->view('bill-payment',$response);
    }

    public function validateBill($provider){
        if($this->input->is_ajax_request()){
            $provider = trim($provider);
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.pay2all.in/apps/v1/provider/'.$provider,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: Bearer '.$this->token,
            ),
            ));

            $res = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($res,true);
            //pr($result);
            $response['data'] = $result;
            echo json_encode($response);
            exit;
        } else {
            exit('No direct hit');
        }
    }

    public function getBill(){
        if($this->input->is_ajax_request()){
            if($this->input->server("REQUEST_METHOD") == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $response['status'] = false;
                $response['token'] = $this->security->get_csrf_hash();
                $number = $data['phone'];
                $providerID = $data['provider_id'];
                $apiID = '27'; //$data['apiId'];

                $postData['number'] = $number;
                $postData['provider_id'] = $providerID;
                $postData['api_id'] = 27;
                $loop = count($data['optional']);
                for($i=0;$i < $loop;$i++){
                    $postData['optional'.($i+1)] = $data['optional'][$i];
                }
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.pay2all.in/v1/payment/verification',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $postData,
                CURLOPT_HTTPHEADER => array(
                    'Accept: application/json',
                    'Authorization: Bearer '.$this->token
                ),
                ));

                $res = curl_exec($curl);
                curl_close($curl);
                $result = json_decode($res,true);
                $response['data'] = $result;
                if(!empty($result['amount'])){
                    $response['status'] = true;
                    $response['pay_bill'] = "<button type='button' class='btn btn-danger' onclick='payBill(this,billForm)'>Pay Bill</button>";
                    $response['amountField'] = '<label class="text-dark">Amount</label><input type="number" name="amount" placeholder="Enter Amount" value="'.$result['amount'].'" required="" class="form-control" style="max-width: 400px"><input type="hidden" name="reference_id" value="'.$result['reference_id'].'">';
                }
                echo json_encode($response);
                exit;
            } 
        }
    }

    public function payBill(){
        if($this->input->is_ajax_request()){
            if($this->input->server("REQUEST_METHOD") == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $response['status'] = false;
                $response['token'] = $this->security->get_csrf_hash();
                $amount = $data['amount'];
                $checkBalance = $this->User_model->get_single_record('tbl_wallet',['user_id' => $this->session->userdata['user_id']],'ifnull(sum(amount),0) as balance');
                if($checkBalance['balance'] >= $amount){
                    $postData = array('number' => $data['phone'],'amount' => $data['amount'],'provider_id' => $data['provider_id'],'api_id' => 27,'payment_mode' => 'cash','reference_id' => $data['reference_id'],'client_id' => $this->generate_order_id());
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.pay2all.in/v1/payment/recharge',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => $postData,
                    CURLOPT_HTTPHEADER => array(
                        'Accept: application/json',
                        'Authorization: Bearer '.$this->token
                    ),
                    ));

                    $res = curl_exec($curl);
                    curl_close($curl);
                    $result = json_decode($res,true);
                    $response['msg'] = $result;
                    if(!empty($result['status_id']) && ($result['status_id'] == 1 || $result['status_id'] == 3)){
                        $DirectIncome = array(
                            'user_id' => $this->session->userdata['user_id'],
                            'amount' => - $amount,
                            'type' => 'recharge_amount',
                            'remark' => 'Bill Pay',
                        );
                        $this->User_model->add('tbl_wallet', $DirectIncome);
                        $transactionArr = array(
                            'user_id' => $this->session->userdata['user_id'],
                            'utr' => !empty($result['utr'])?$result['utr']:'',
                            'report_id' => $result['report_id'],
                            'orderid' => $result['orderid'],
                            'status_id' => $result['status_id'],
                            'message' => $result['message'],
                        );
                        $this->User_model->add('tbl_recharge', $transactionArr);
                        $response['status'] = true;
                        if($result['status_id'] == 1){
                            $response['message'] = 'Transaction success';
                        } else {
                            $response['message'] = 'Status Pending';
                        }
                    } else {
                        $response['message'] = 'Transaction failed';
                    }
                } else {
                    $response['message'] = 'Insufficient balance';
                }
                echo json_encode($response);
                exit;
            } else {
                exit('No direct hit is allowed');
            }
        } else {
            exit('No direct hit is allowed');
        }
    }

}
?>