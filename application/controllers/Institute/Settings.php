<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{
    public function addClass(){
        if (!$this->input->is_ajax_request()) {
            exit('no valid req.');
        }
        $post=$this->input->post();
        $post = $this->security->xss_clean($post);
        if ($this->form_validation->run('modifyClass')==false) {
            echo '<div class="alert-danger rounded p-1">'.validation_errors().'</div>';
        } else {
            if ($post) {
                $this->Studentmodel->addClass($post);
                echo '1';
            }
        }
    }
    public function addSection(){
        if (!$this->input->is_ajax_request()) {
            exit('no valid req.');
        }
        $post=$this->input->post();
        $post = $this->security->xss_clean($post);
        if ($this->form_validation->run('sectionName')==false) {
            echo '<div class="alert-danger rounded p-1">'.validation_errors().'</div>';
        } else {
            if ($post) {
                $this->Studentmodel->addSection($post);
                echo '1';
            }
        }
    }
    public function modifySection()
    {
        $id = $this->input->post('id');
        $field = $this->input->post('field');
        $value = $this->input->post('value');
        // Update records
        $this->Studentmodel->modifySection($id, $field, $value);
        echo 1;
        exit;
    }
    public function addPayment(){
        if (!$this->input->is_ajax_request()) {
            exit('no valid req.');
        }
        $balanceDue = $_POST['amountDue'];
        unset($_POST['amountDue']);
        $payment=$this->input->post();
        $payment = $this->security->xss_clean($payment);
        $this->form_validation->set_message('textRegex', 'Only alphabets and commas are allowed');
        if ($this->form_validation->run('payment')==false) {
            echo '<div class="alert alert-dismissible alert-danger rounded p-1 "><button type="button" class="close" data-dismiss="alert">&times;</button>'.validation_errors().'</div>';
        } else {
            if ($payment) {
                $this->Studentmodel->addpayment($payment);
                if ($payment['paymentAmount'] < $balanceDue) {
                    $data=array('fee_status'=>2);
                    $this->Studentmodel->modifyFeeScheduleStatus($payment['feeScheduleId'], $data);
                } elseif ($payment['paymentAmount']==$balanceDue) {
                    $data=array('fee_status'=>1);
                    $this->Studentmodel->modifyFeeScheduleStatus($payment['feeScheduleId'], $data);
                }
                echo '1';
            }
        }
    }
}