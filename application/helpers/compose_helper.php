<?php
    if(!function_exists('composeMail')){ 
        function composeMail($email,$subject,$message,$display=false){
            if(!empty($email)){
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.zeptomail.in/v1.1/email",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    // CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
                    // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => '{
                        "bounce_address":"noreplyinfomail7@info.primecapitals.biz",
                        "from": { "address": "noreply@optimalspt.com"},
                        "to": [{"email_address": {"address": "'.$email.'"}}],
                        "subject":"'.$subject.'",
                        "htmlbody":"<div><b> '.$message.' </b></div>",
                        }',
                    CURLOPT_HTTPHEADER => array(
                        "accept: application/json",
                        "authorization: Zoho-enczapikey PHtE6r0LS+7sjmZ980UC4fXrHpKiMdwuqepgeggTtdtDXvQLH01Xrt4rkGfj+Bp/B/ZAFfGZzdhps7mft+KCdmy/PGZLX2qyqK3sx/VYSPOZsbq6x00buFgbdkfVXI/ue9Vp1yffstveNA==",
                        "cache-control: no-cache",
                        "content-type: application/json",
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);
            }
            if($display == true){
                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    echo $response;
                }
                // echo json_encode($data);
            }
        }
    }

?>