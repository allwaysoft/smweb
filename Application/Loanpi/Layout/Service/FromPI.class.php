<?php

//use Service\ 
class FromPI {

    public function UpStatusDo($data) {
	
        //这里可以加些验证规则，实现一些特殊目的。如安全方面的。
        $ch = curl_init();
        $timeout = 5000;
        $header = array(
            'Content-Type: application/json',
        );
        curl_setopt($ch, CURLOPT_URL, "http://localhost/loanpi.php/Service/UpStatusToLocal");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        if ($output === FALSE) {
            $MESS_FLAG = 'F11';
            $MESSAGE = "API Error: "; // . curl_error($ch);
        } else {
            $reVal = json_decode($output);
            if ($reVal->val == 1) {
                $MESS_FLAG = 'T';
                //$MESSAGE = $reVal->msg;
            } else {
                $MESS_FLAG = 'F2' . $reVal->val;
                // $MESSAGE = json_decode($output);
            }
            $MESSAGE = $reVal->msg;
        }
        curl_close($ch);
        //   return  $data; //$data->AGENT_CODE,$data->LOAN_AMOUNT
        $result = array('MESS_FLAG' => $MESS_FLAG, 'MESSAGE' => $MESSAGE);
        //  $result = json_encode($result);

        return $result;
    }

    public function UpStatementDo($data) {
        //这里可以加些验证规则，实现一些特殊目的。如安全方面的。
       //  $result = array('MESS_FLAG' => 'testing', 'MESSAGE' => json_encode($data));
      // return $result;
      //   exit;
        $ch = curl_init();
        $timeout = 5000;
        $header = array(
            'Content-Type: application/json',
        );
        curl_setopt($ch, CURLOPT_URL, "http://localhost/loanpi.php/Service/UpStatementToLocal");//http://10.192.1.11/loanpi.php/Service/UpStatementToLocal
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
      //  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); ////所需传的数组用http_bulid_query()函数处理一下，就ok了
        $output = curl_exec($ch);
        if ($output === FALSE) {
            $MESS_FLAG = 'FS1';
            $MESSAGE = "API Error: " . curl_error($ch); // . curl_error($ch);
        } else {
            $reVal = json_decode($output);
            if ($reVal->val == 1) {
                $MESS_FLAG = 'T';
                //$MESSAGE = $reVal->msg;
            } else {
                $MESS_FLAG = 'FS2' . $reVal->val;
                // $MESSAGE = json_decode($output);
            }
            $MESSAGE = $reVal->msg;
        }
        curl_close($ch);
        //   return  $data; //$data->AGENT_CODE,$data->LOAN_AMOUNT
        $result = array('MESS_FLAG' => $MESS_FLAG, 'MESSAGE' => $MESSAGE);
        //  $result = json_encode($result);

        return $result;
    }

}
