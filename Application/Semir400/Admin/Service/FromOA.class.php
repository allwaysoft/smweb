<?php

//use Service\Common\CheckUserController;
class FromOA {

    public function Up400Do($data) {
        //这里可以加些验证规则，实现一些特殊目的。如安全方面的。 
        $ch = curl_init();
        $timeout = 500;
        $header = array(
            'Content-Type: application/json',
        );
       
        //  $result = json_encode($result); 
        curl_setopt($ch, CURLOPT_URL, "http://w.semir.cn/semir400admin.php/Apifromoa/Up400ToLocal");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch); 
        
        if ($output === FALSE) {
            $MESS_FLAG = 'F1';
            $MESSAGE = "API Error: ".curl_error($ch); // . curl_error($ch);
        } else {
            $reVal = json_decode($output);
            if ($reVal->val == 1) {
                $MESS_FLAG = 'T';
                //$MESSAGE = $reVal->msg;
            } else {
                $MESS_FLAG = 'F2'; 
            }
            $MESSAGE =  $reVal->msg;
        }
        curl_close($ch);
        //   return  $data; //$data->AGENT_CODE,$data->LOAN_AMOUNT
        $result = array('MESS_FLAG' => $MESS_FLAG, 'MESSAGE' => $MESSAGE);
        //  $result = json_encode($result);

        return $result;
    }

}
