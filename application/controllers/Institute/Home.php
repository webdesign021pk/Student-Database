<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $graph=$this->Reportmodel->dashboardChart();
        $totalStudents=$this->Reportmodel->countRows('sdb_tbl_students');
        $totalClasses=$this->Reportmodel->countRows('sdb_tbl_classes');
        $totalSections=$this->Reportmodel->countRows('sdb_tbl_sections');
        $this->load->view('Institute/Dashboard', compact('graph', 'totalStudents', 'totalClasses', 'totalSections'));
        $this->load->view('Template/footer');
    }
    public function classes(){
        $classes=$this->Studentmodel->classList();
        $this->load->view('Institute/classes', compact('classes'));
        $this->load->view('Template/footer');
    }
    public function modifyClass(){
        if ((($this->uri->segment(4))=='') || !ctype_digit($this->uri->segment(4))) {
            redirect(base_url('Institute/Home/Classes'));
        }
        $id=$this->uri->segment(4); // gets memberID from URL'
        $validation='';
        if($this->input->post()){
            $post=$this->input->post();
            if($post['classNameConfirm']==$post['className']){
                $validation='modifyFees';
            } else {
                $validation='modifyClass';
            }
            unset($post['classNameConfirm']);
        } else {
            $validation='modifyFees';
        }
        if ($this->form_validation->run($validation)==false) {
            $classes=$this->Studentmodel->getFees($id);
            $this->load->view('Institute/modifyClass', compact('classes'));
        } else {
            $post = $this->security->xss_clean($post);
            if ($this->Studentmodel->modifyClass($id, $post)) { //echo "member updated";
                $this->session->set_flashdata('msg', 'Class modified successfully!');
                $this->session->set_flashdata('alert', 'success');
                redirect(base_url('Institute/Home/modifyClass/').$id);
            } else {
                $this->session->set_flashdata('msg', 'Failed to Modify Class, Contact Administrator!!');
                $this->session->set_flashdata('alert', 'danger');
                redirect(base_url('Institute/Home/Classes'));
            }
        }
    }
    public function Sections(){
        $sections=$this->Studentmodel->sectionList();
        $this->load->view('Institute/section', compact('sections'));
        $this->load->view('Template/footer');
    }
    public function Fee(){
        if ((($this->uri->segment(4))=='') || !ctype_digit($this->uri->segment(4))) {
            redirect(base_url('Institute/Home/Fee/1'));
        }
        $order = $this->uri->segment(4);
        $students = $this->Studentmodel->feeSchedule($order);
        $classId = $this->Studentmodel->classList();
        $this->load->view('Institute/Fees', compact('students', 'classId'));
        $this->load->view('Template/footer');
    }
    public function paymentDetails(){
        if ((($this->uri->segment(4))=='') || !ctype_digit($this->uri->segment(4))) {
            redirect(base_url('Institute/Home/Fee/1'));
        }
        $id = $this->uri->segment(4);
        $paymentDue = $this->Studentmodel->paymentDetails($id);
        $paymentTypeList = $this->Studentmodel->paymentTypeList();
        $transactionDetails = $this->Studentmodel->transactionDetails($id);
        $this->load->view('Institute/paymentDetails', compact('transactionDetails', 'paymentDue', 'paymentTypeList'));
        $this->load->view('Template/footer');
    }
    /*Profile Settings*/
    public function profile()
    {
        $id=$this->session->userdata('userIdPK');
        $user=$this->Loginmodel->userProfile($id);
        if (empty($_POST)) {
            $this->load->view('Users/profile', compact('user'));
            $this->load->view('Template/footer');
        }
        if (isset($_POST['userEmail'])) {
            if ($this->form_validation->run('profile_email_rule')==false) {
                $this->load->view('Users/profile',compact('user'));
                $this->load->view('Template/footer');
            } else {
                $post = $this->input->post();
                $post = $this->security->xss_clean($post);
                if ($this->Loginmodel->modifyUser($id, $post)) {
                    $this->session->set_flashdata('msg', 'User modified successfully!');
                    $this->session->set_flashdata('alert', 'success');
                    redirect(base_url('Institute/Home/profile'));
                } else {
                    $this->session->set_flashdata('msg', 'Failed to Modify User, Contact Administrator!!');
                    $this->session->set_flashdata('alert', 'danger');
                    redirect(base_url('Institute/Home/profile'));
                }
            }
        }
        if (isset($_POST['userName'])) {
            if ($this->form_validation->run('profile_userName_rule')==false) {
                $this->load->view('Users/profile',compact('user'));
                $this->load->view('Template/footer');
            } else {
                $post=$this->input->post();
                $post = $this->security->xss_clean($post);
                if ($this->Loginmodel->modifyUser($id, $post)) {
                    $this->session->set_flashdata('msg', 'User modified successfully!');
                    $this->session->set_flashdata('alert', 'success');
                    redirect(base_url('Institute/Home/profile'));
                } else {
                    $this->session->set_flashdata('msg', 'Failed to Modify User, Contact Administrator!!');
                    $this->session->set_flashdata('alert', 'danger');
                    redirect(base_url('Institute/Home/profile'));
                }
            }
        }
        if (isset($_POST['others'])) {
            unset($_POST['others']);
            if ($this->form_validation->run('profile_fields_rule')==false) {
                //$user=$this->Loginmodel->userProfile($id);
                $this->load->view('Users/profile', compact('user'));
                $this->load->view('Template/footer');
            } else {
                $post=$this->input->post();
                print_r($post);
                $post = $this->security->xss_clean($post);
                if ($this->Loginmodel->modifyUser($id, $post)) {
                    $this->session->set_flashdata('msg', 'User modified successfully!');
                    $this->session->set_flashdata('alert', 'success');
                    redirect(base_url('Institute/Home/profile'));
                } else {
                    $this->session->set_flashdata('msg', 'Failed to Modify User, Contact Administrator!!');
                    $this->session->set_flashdata('alert', 'danger');
                    redirect(base_url('Institute/Home/profile'));
                }
            }
        }
    }
    public function modifyPass()
    {
        $id=$this->session->userdata('userIdPK');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[3]');
        $this->form_validation->set_rules('confirm_pass', 'confirm_pass', 'required|matches[password]');
        if ($this->form_validation->run()==false) {
            $user=$this->Loginmodel->userProfile($id);
            $this->load->view('Users/profile', compact('user'));
            $this->load->view('Template/footer');
        } else {
            $userName=$this->input->post('userName');
            $password=$this->input->post('oldpwd');
            $match=$this->Loginmodel->isValidate($userName, $password);
            if ($match) {
                $post=$this->input->post();
                $post = $this->security->xss_clean($post);
                $post['password'] = password_hash($post['password'], PASSWORD_BCRYPT);
                unset($post['oldpwd'], $post['userName'], $post['confirm_pass']);
                if ($this->Loginmodel->modifyUser($id, $post)) {
                    $this->session->set_flashdata('msg', 'Password modified successfully!');
                    $this->session->set_flashdata('alert', 'success');
                    redirect(base_url('Institute/Home/profile'));
                } else {
                    $this->session->set_flashdata('msg', 'Failed to Modify password, Contact Administrator!!');
                    $this->session->set_flashdata('alert', 'danger');
                    redirect(base_url('Institute/Home/profile'));
                }
            } else { //echo 'no match';
                $this->session->set_flashdata('msg', 'Incorrect Old Password !!');
                $this->session->set_flashdata('alert', 'danger');
                redirect(base_url('Institute/Home/profile'));
            }
        }
    }
    /*Profile Settings*/
}
