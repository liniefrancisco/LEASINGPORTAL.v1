<?php
defined('BASEPATH') or exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    exit;
}

class AdminPaymentController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('adminmodel');
        $this->load->model('basemodel');
        $this->load->model('ledgermodel');
        $this->load->library('upload');
        date_default_timezone_set('Asia/Manila');
        $timestamp = time();
        $this->_currentDate = date('Y-m-d', $timestamp);
        $this->_currentYear = date('Y', $timestamp);
        $this->load->library('excel');
        $this->load->library('PHPExcel');


        # Disable Cache
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        ('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    # TABLE OF CONTENTS
    # PORTAL INDEX FUNCTION

    
    function sanitize($string)
    {
        $string = htmlentities($string, ENT_QUOTES, 'UTF-8');
        $string = trim($string);
        return $string;
    }

    function get_dateTime()
    {
        $timestamp = time();
        $date_time = date('F j, Y g:i:s A  ', $timestamp);
        $result['current_dateTime'] = $date_time;
        echo json_encode($result);
    }

    public function getpayment()
    {
        $tenantID = $this->input->post('tenantID');
<<<<<<< HEAD
=======
        dump($tenantID);

>>>>>>> eeae2af07a0576f503f3a1d47c6cd26368265e68
        $payment  = $this->adminmodel->getPayments($tenantID);

        JSONResponse($payment);
    }

<<<<<<< HEAD
=======
    public function admingettenant(){
        $from        = $this->input->get('from');
        $store       = $this->input->get('store');
        $tenant_type = $this->input->get('type');
        $trade_name  = $this->input->get('trade_name');
        $storeID     = '';

        if($store == 'AM'){
            $storeID = '1';
        }elseif($store == 'ICM'){   
            $storeID = '2';
        }elseif($store == 'ACT'){
            $storeID = '4';
        }elseif($store == 'ASCT'){
            $storeID = '5';
        }elseif($store == 'ATT'){
            $storeID = '7';
        }

        if($from === 'Internal'){
            $tenants = $this->adminmodel->populate_tradeNameInternal($tenant_type, $storeID, $trade_name);
            JSONResponse($tenants);
        }else{
            $tenants = $this->adminmodel->populate_tradeNameCAS($tenant_type, $storeID, $trade_name);
            JSONResponse($tenants);
        }
    }


    public function uploadpaymentpertenant(){
        $data         = $this->input->post(NULL);
        $url          = 'https://leasingportal.altsportal.com/perTenantUpload';
        $msg          = array();
        $subsidiary   = array(); #SUBSIDIARY LEDGER AND GENERAL LEDGER
        $ledger       = array();
        $invoice      = array();
        $toUpload     = array();
        $update       = array();
        $this->portal = $this->load->database('portal', true);
        $this->cas    = $this->load->database('cas', true);

        if (isset($data)) {
            $this->db->trans_start();
            $tenantID   = $data['tenant_id'];
            $tenantFrom = $data['tenant_from'];
            $tenantP    = $this->portal->query("SELECT * FROM `duxvwc44_agc-pms`.tenants WHERE tenant_id = '{$tenantID}'")->ROW();

            if($tenantFrom === 'Internal'){
                $subsidiary    = $this->adminmodel->getPaymentsLedger($tenantID, $data['datefrom'], $data['dateto'], 'subsidiary_ledger');
                $ledger        = $this->adminmodel->getPaymentsLedger($tenantID, $data['datefrom'], $data['dateto'], 'ledger');
                $payment       = $this->adminmodel->getPaymentsTable($tenantID, $data['datefrom'], $data['dateto'], 'payment');
                $paymentscheme = $this->adminmodel->getPaymentsScheme($tenantID, $data['datefrom'], $data['dateto'], 'payment_scheme');
            }else{
                $subsidiary    = $this->adminmodel->getPaymentsLedgerCAS($tenantID, $data['datefrom'], $data['dateto'], 'subsidiary_ledger');
                $ledger        = $this->adminmodel->getPaymentsLedgerCAS($tenantID, $data['datefrom'], $data['dateto'], 'ledger');
                $payment       = $this->adminmodel->getPaymentsTableCAS($tenantID, $data['datefrom'], $data['dateto'], 'payment');
                $paymentscheme = $this->adminmodel->getPaymentsSchemeCAS($tenantID, $data['datefrom'], $data['dateto'], 'payment_scheme');

            }

            $cnt              = 0;
            $psNo             = '';
            $NumberOfPayments = 0;

            $this->portal->trans_start();
            
            if (!empty($subsidiary)) {
                foreach ($subsidiary as $s) {
                        if ($s['doc_no'] !== $psNo) {
                            $NumberOfPayments += 1;
                        }

                        $d = [
                            'posting_date' => $s['posting_date'],
                            'transaction_date' => $s['transaction_date'],
                            'due_date' => $s['due_date'],
                            'document_type' => $s['document_type'],
                            'ref_no' => $s['ref_no'],
                            'doc_no' => $s['doc_no'],
                            'cas_doc_no' => $s['cas_doc_no'],
                            'tenant_id' => $s['tenant_id'],
                            'gl_accountID' => $s['gl_accountID'],
                            'company_code' => $s['company_code'],
                            'department_code' => $s['department_code'],
                            'debit' => $s['debit'],
                            'credit' => $s['credit'],
                            'bank_name' => $s['bank_name'],
                            'bank_code' => $s['bank_code'],
                            'tag' => $s['tag'],
                            'status' => $s['status'],
                            'with_penalty' => $s['with_penalty'],
                            'prepared_by' => $s['prepared_by'],
                            'ft_ref' => $s['ft_ref'],
                            'export_batch_code' => $s['export_batch_code'],
                            'export_batch_internal' => $s['export_batch_internal'],
                            'adj_tag' => $s['adj_tag'],
                            'adj_ref' => $s['adj_ref'],
                            'upload_status' => $s['upload_status'],
                            'upload_date' => $s['upload_date'],
                        ];

                        $this->portal->insert('`duxvwc44_agc-pms`.subsidiary_ledger', $d);
                        // dump($this->portal->error());

                        $psNo = $s['doc_no'];
                }

                $cnt += 1;

                if(!empty($ledger)){
                        foreach ($ledger as $l) {
                                $led = [
                                    'posting_date' => $l['posting_date'],
                                    'transaction_date' => $l['transaction_date'],
                                    'document_type' => $l['document_type'],
                                    'ref_no' => $l['ref_no'],
                                    'doc_no' => $l['doc_no'],
                                    'tenant_id' => $l['tenant_id'],
                                    'contract_no' => $l['contract_no'],
                                    'description' => $l['description'],
                                    'debit' => $l['debit'],
                                    'credit' => $l['credit'],
                                    'balance' => $l['balance'],
                                    'due_date' => $l['due_date'],
                                    'charges_type' => $l['charges_type'],
                                    'with_penalty' => $l['with_penalty'],
                                    'bank_name' => $l['bank_name'],
                                    'bank_code' => $l['bank_code'],
                                    'flag' => $l['flag'],
                                    'prepared_by' => $l['prepared_by'],
                                    'upload_status' => $l['upload_status'],
                                    'upload_date' => $l['upload_date'],
                                ];
                                $this->portal->insert('`duxvwc44_agc-pms`.ledger', $led);
                                // var_dump($this->portal->error());

                            $cnt += 1;

                        }                    
                }
    
                if(!empty($payment)){
                    foreach ($payment as $i) {
                            $pay = [
                                'tenant_id' => $i['tenant_id'],
                                'doc_no' => $i['doc_no'],
                                'soa_no' => $i['soa_no'],
                                'amount_paid' => $i['amount_paid'],
                                'posting_date' => $i['posting_date'],
                                'rec_amount_paid' => $i['rec_amount_paid'],
                                'upload_status' => $i['upload_status'],
                                'upload_date' => $i['upload_date'],
                            ];
                            $this->portal->insert('`duxvwc44_agc-pms`.payment', $pay);
                            // var_dump($this->portal->error());
                    }
    
                    $cnt += 1;
                }

                if (!empty($paymentscheme)) {
                    foreach ($paymentscheme as $i) {
                            $payScheme = [
                                'tenant_id' => $i['tenant_id'],
                                'contract_no' => $i['contract_no'],
                                'tenancy_type' => $i['tenancy_type'],
                                'receipt_no' => $i['receipt_no'],
                                'vds_no' => $i['vds_no'],
                                'billing_period' => $i['billing_period'],
                                'tender_typeCode' => $i['tender_typeCode'],
                                'tender_typeDesc' => $i['tender_typeDesc'],
                                'soa_no' => $i['soa_no'],
                                'amount_due' => $i['amount_due'],
                                'amount_paid' => $i['amount_paid'],
                                'bank' => $i['bank'],
                                'bank_code' => $i['bank_code'],
                                'check_no' => $i['check_no'],
                                'check_date' => $i['check_date'],
                                'payor' => $i['payor'],
                                'payee' => $i['payee'],
                                'supp_doc' => $i['supp_doc'],
                                'receipt_doc' => $i['receipt_doc'],
                                'rec_amount_paid' => $i['rec_amount_paid'],
                                'upload_status' => $i['upload_status'],
                                'upload_date' => $i['upload_date'],
                            ];
                            $this->portal->insert('`duxvwc44_agc-pms`.payment_scheme', $payScheme);
                            // var_dump($this->portal->error());
                    }

                    $cnt += 1;
                }

    
                $this->portal->trans_complete();
    
                if($this->portal->trans_status() === FALSE){
                    $msg = ['info' => 'error', 'message' => "Failed Upload."];
                }else{
                    $this->db->trans_start();
                    
                    if($tenantFrom === 'Internal'){
                        foreach ($subsidiary as $value) {
                            $this->db->set('upload_status', 'Uploaded')
                                ->where('id', $value['id'])
                                ->update('subsidiary_ledger');
                        }

                        foreach ($ledger as $value) {
                            $this->db->set('upload_status', 'Uploaded')
                                ->where('id', $value['id'])
                                ->update('ledger');
                        }

                        foreach ($payment as $value) {
                            $this->db->set('upload_status', 'Uploaded')
                                ->where('id', $value['id'])
                                ->update('payment');
                        }

                        foreach ($paymentscheme as $value) {
                            $this->db->set('upload_status', 'Uploaded')
                                ->where('id', $value['id'])
                                ->update('payment_scheme', ['upload_status' => 'Uploaded']);
                        }
                    }else{
                        foreach ($subsidiary as $value) {
                            $this->cas->set('upload_status', 'Uploaded')
                                ->where('id', $value['id'])
                                ->update('subsidiary_ledger');
                        }

                        foreach ($ledger as $value) {
                            $this->cas->set('upload_status', 'Uploaded')
                                ->where('id', $value['id'])
                                ->update('ledger');
                        }

                        foreach ($payment as $value) {
                            $this->cas->set('upload_status', 'Uploaded')
                                ->where('id', $value['id'])
                                ->update('payment');
                        }

                        foreach ($paymentscheme as $value) {
                            $this->cas->set('upload_status', 'Uploaded')
                                ->where('id', $value['id'])
                                ->update('payment_scheme', ['upload_status' => 'Uploaded']);
                        }

                    }
                    
                    $this->db->trans_complete();
    
                    if ($this->db->trans_status() === 'FALSE') {
                        $this->db->trans_rollback();
                        $msg = ['info' => 'error', 'message' => 'Something went wrong on updating INTERNAL DATA, please check logs for error.'];
                    } else {
                        $msg = ['info' => 'success', 'message' => $NumberOfPayments .' payments uploaded succesfully.'];
                    }
                }

            }else{
                $msg = ['info' => 'No Data', 'message' => 'No Payments Found.'];
            }
        } else {
            $msg = ['info' => 'NO DATA', 'message' => 'Data seems to be empty. Please try again.'];
        }

        if($msg['info'] != 'Warning'){
            foreach ($subsidiary as $key => $value) {
                $this->saveLog('Payment', $value['doc_no'], $value['tenant_id'], $msg['info'], $msg['message']);
            }
        }

        JSONResponse($msg);
    }

>>>>>>> eeae2af07a0576f503f3a1d47c6cd26368265e68
    public function getpaymentperstore()
    {
        $tenantID  = $this->input->post('store') . '-' . $this->input->post('type');
        $startDate = $this->input->post('date1');
        $endDate   = $this->input->post('date2');
        $data      = array();

        $payment = $this->adminmodel->getPaymentsPerstore($tenantID, $startDate, $endDate);
        JSONResponse($payment);
    }

    public function uploadpaymentdata()
    {
        $paymentID = $this->input->post('paymentID');

        $this->db->trans_start();
        # CONTAINER FOR payment_scheme
        $paymentScheme = $this->adminmodel->getPaymentScheme($paymentID);

        if(isset($paymentScheme))
        {
            $slData  = array();
            $glData  = array();
            $Ledger  = array();

            # GET DATA FROM subsidiary_ledger
            $sl      = $this->adminmodel->getSL($paymentScheme->receipt_no);
            $payment = $this->adminmodel->getPaymentTable($paymentScheme->receipt_no);

            # LOOP TO GET THE REFERENCE NO
            foreach ($sl as $value) {
                $slData[] = $this->adminmodel->getLedgers($value['ref_no'], 'subsidiary_ledger');
            }

            # SUBSIDIARY AND GENERAL LEDGER CONTAINER
            $subsidiary = array();

            # LOOP TO GET THE ARRAYS CONTAINING THE DATA FROM subsidiary_ledger USING THE ref_no
            for ($i = 0; $i < count($slData); $i++) {
                for ($z = 0; $z < count($slData[$i]); $z++) {
                    $subsidiary[] = $slData[$i][$z];
                }
            }

            # CONTAINER
            $doc_no = array();

            foreach ($subsidiary as $value) {

                $doc_no[] = $value['doc_no'];
            }

            # DOCUMENT NUMBER FOR ledger TABLE
            $forLedger = array_unique($doc_no);
            $lData     = array();

            foreach ($forLedger as $value) {
                $lData[] = $this->adminmodel->getLedgerTable($value);
            }

            # LEDGER CONTAINER
            $ledger = array();

            for ($i = 0; $i < count($lData); $i++) {
                for ($z = 0; $z < count($lData[$i]); $z++) {
                    $ledger[] = $lData[$i][$z];
                }
            }

            # $subsidiary    = subsidiary_ledger and general_ledger
            # ledger         = $ledger
            # payment        = $payment
            # payment_scheme = $paymentScheme

            $soa_file = $this->adminmodel->getSoaForPayment($paymentScheme->soa_no);

            $url          = 'https://leasingportal.altsportal.com/uploadPaymentData';
            $notification = 'https://leasingportal.altsportal.com/paymentNotification';

            if ($this->isDomainAvailable('leasingportal.altsportal.com')) 
            {
                if (!empty($subsidiary)) 
                {
                    $upload   = array('subsidiary' => $subsidiary, 'ledger' => $ledger, 'paymentScheme' => $paymentScheme, 'payment' => $payment);
                    $response = $this->sendData($url, $upload);
                    $sms      = $this->sendData($notification, array('payment_scheme' => $paymentScheme, 'soa' => $soa_file));

                    if ($response == 'success') {
                        $this->db->trans_complete();

                        $update = ['upload_status' => 'Uploaded', 'upload_date' => date('Y-m-d')];

                        foreach ($subsidiary as $value) {
                            $this->db->where('id', $value['id']);
                            $this->db->update('subsidiary_ledger', $update);
                        }

                        if(isset($ledger))
                        {
                            foreach ($ledger as $value) {
                                $this->db->where('id', $value['id']);
                                $this->db->update('ledger', $update);
                            }
                        }

                        if (isset($payment)) 
                        {
                            $this->db->where('id', $payment->id);
                            $this->db->update('payment', $update);
                        }

                        $this->db->where('id', $paymentScheme->id);
                        $this->db->update('payment_scheme', $update);

                        if ($this->db->trans_status() === FALSE) {
                            $this->db->trans_rollback();
                            $msg = ['info' => 'error', 'message' => 'Data Seems to be empty, cant proceed.'];
                        } else {
                            $msg = ['info' => 'success', 'message' => 'Payment Data Succesfully Uploaded.'];
                        }
                    } else {
                        $msg = ['info' => 'error', 'message' => 'Something went wrong, please try again.'];
                    }
                } else {
                    $msg = ['info' => 'error', 'message' => 'Data Seems to be empty, cant proceed.'];
                }
            } else {
                $msg = ['info' => 'error', 'message' => 'PC has no connection, cant proceed.'];
            }
        }
        else
        {
            $msg = ['info' => 'error', 'message' => 'Data Seems to be empty, cant proceed.'];
        }

        $this->saveLog('Payment', $paymentScheme->receipt_no, $paymentScheme->tenant_id, $msg['info'], $msg['message']);
        JSONResponse($msg);
    }

    public function uploadpaymentdatachecked()
    {
        $data        = $this->input->post(NULL);
<<<<<<< HEAD
=======

        dump($data);
        exit();
>>>>>>> eeae2af07a0576f503f3a1d47c6cd26368265e68
        $count       = count($data['paymentcheck']);
        $uploadCheck = $data['paymentcheck'];
        $update      = ['upload_status' => 'Uploaded', 'upload_date'   => date('Y-m-d')];
        $msg         = array();

        if (!empty($data['paymentcheck'])) {
            for ($id = 0; $id < $count; $id++) {

                $this->db->trans_start();
                # CONTAINER FOR payment_scheme
                $paymentScheme = $this->adminmodel->getPaymentScheme($uploadCheck[$id]);

                if(isset($paymentScheme))
                {

                    $slData  = array();
                    $glData  = array();
                    $Ledger  = array();

                    # GET DATA FROM subsidiary_ledger
                    $sl      = $this->adminmodel->getSL($paymentScheme->receipt_no);
                    $payment = $this->adminmodel->getPaymentTable($paymentScheme->receipt_no);

                    # LOOP TO GET THE REFERENCE NO
                    foreach ($sl as $value) {
                        $slData[] = $this->adminmodel->getLedgers($value['ref_no'], 'subsidiary_ledger');
                    }

                    # SUBSIDIARY AND GENERAL LEDGER CONTAINER
                    $subsidiary = array();

                    # LOOP TO GET THE ARRAYS CONTAINING THE DATA FROM subsidiary_ledger USING THE ref_no
                    for ($i = 0; $i < count($slData); $i++) {
                        for ($z = 0; $z < count($slData[$i]); $z++) {
                            $subsidiary[] = $slData[$i][$z];
                        }
                    }

                    # CONTAINER
                    $doc_no = array();

                    foreach ($subsidiary as $value) {

                        $doc_no[] = $value['doc_no'];
                    }

                    # DOCUMENT NUMBER FOR ledger TABLE
                    $forLedger = array_unique($doc_no);
                    $lData     = array();

                    foreach ($forLedger as $value) {
                        $lData[] = $this->adminmodel->getLedgerTable($value);
                    }

                    # LEDGER CONTAINER
                    $ledger = array();

                    for ($i = 0; $i < count($lData); $i++) {
                        for ($z = 0; $z < count($lData[$i]); $z++) {
                            $ledger[] = $lData[$i][$z];
                        }
                    }

                    # subsidiary_ledger = $subsidiary
                    # ledger            = $ledger
                    # payment           = $payment
                    # payment_scheme    = $paymentScheme

                    $soa_file = $this->adminmodel->getSoaForPayment($paymentScheme->soa_no);

                    $url          = 'https://leasingportal.altsportal.com/uploadPaymentData';
                    $notification = 'https://leasingportal.altsportal.com/paymentNotification';

                    if ($this->isDomainAvailable('leasingportal.altsportal.com')) 
                    {
                        if (!empty($subsidiary)) 
                        {
                            $upload   = array('subsidiary' => $subsidiary, 'ledger' => $ledger, 'paymentScheme' => $paymentScheme, 'payment' => $payment);
                            $response = $this->sendData($url, $upload);
                            $sms      = $this->sendData($notification, array('payment_scheme' => $paymentScheme, 'soa' => $soa_file));

                            foreach ($subsidiary as $value) {
                                $this->db->where('id', $value['id']);
                                $this->db->update('subsidiary_ledger', $update);
                            }

                            if(isset($ledger))
                            {
                                foreach ($ledger as $value) {
                                    $this->db->where('id', $value['id']);
                                    $this->db->update('ledger', $update);
                                }
                            }

                            if (isset($payment)) {
                                $this->db->where('id', $payment->id);
                                $this->db->update('payment', $update);
                            }

                            $this->db->where('id', $paymentScheme->id);
                            $this->db->update('payment_scheme', $update);

                            $this->db->trans_complete();
                            if ($this->db->trans_status() === FALSE) {
                                $this->db->trans_rollback();
                                $this->saveLog('Payment', $paymentScheme->receipt_no, $paymentScheme->tenant_id, 'error', 'Uploaded Failed');
                                $msg = ['info' => 'error', 'message' => 'Uploading Failed.'];
                                JSONResponse($msg);
                            } else {
                                $this->saveLog('Payment', $paymentScheme->receipt_no, $paymentScheme->tenant_id, 'success', 'Uploaded Successfully');
                                continue;
                            }
                        } else {
                            $msg = [
                                'info' => 'error', 'message' => 'Data Seems to be empty, cant proceed.'
                            ];
                        }
                    } else {
                        $msg = ['info' => 'error', 'message' => 'PC has no connection, cant proceed.'];
                    }
                }
                else
                {
                    $msg = ['info' => 'error', 'message' => 'Data Seems to be empty, cant proceed.'];
                    JSONResponse($msg);
                }
            }

            $msg = ['info' => 'success', 'message' => 'Payment Data Succesfully Uploaded.'];
        } else {
            $msg = ['message' => 'Please Check any Payment to upload.', 'info' => 'error'];
        }

        JSONResponse($msg);
    }

    public function saveLog($type, $docno, $tenant_id, $status, $statusMessage)
    {
        $data   =
        [                
            'type_uploaded'  => $type,
            'tenant_id'      => $tenant_id,
            'upload_status'  => $status,
            'status_message' => $statusMessage,
            'date_uploaded'  => date('Y-m-d'),
            'user_id'        => $this->session->userdata('id')
        ];

        $this->db->trans_start();

        $this->db->insert('upload_log', $data);
        $uploadlogID = $this->db->insert_id();
        
        if($status === 'success')
        {
            $docs = 
            [
                'uploadlogID' => $uploadlogID,
                'documentno'  => $docno
            ];

            $this->db->insert('upload_log_docs', $docs); 
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === 'FALSE') 
        {
            $this->db->trans_rollback();
        }
    }

    public function isDomainAvailable($domain)
    {
        $file = @fsockopen($domain, 80); #@fsockopen is used to connect to a socket

        # Verify whether the internet is working or not
        if ($file) {
            return true;
        } else {
            return false;
        }
    }

    public function sendData($url, $data)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $server_output = curl_exec($ch);

        return $server_output;

        curl_close($ch);
    }
}