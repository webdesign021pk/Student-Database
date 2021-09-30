<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $userDetail=$this->Loginmodel->userDetail();
        $this->load->view('Template/header', compact('userDetail'));
        $classId = $this->Studentmodel->classList();
        $this->load->view('Institute/reports', compact('classId'));
        $this->load->view('Template/footer');
    }
    public function printMembers()
    {
        $post=$this->input->post('order');
        $post = $this->security->xss_clean($post);
        $this->load->view('Template/header-report');
        echo $this->Reportmodel->printStudents($post);
    }
    public function printIdCards()
    {
        $id=$this->input->post('id');
        $id = $this->security->xss_clean($id);
        $this->load->view('Template/header-report');
        echo $this->Reportmodel->printIdCards($id);
    }
    public function printStatement()
    {
        $id=$this->input->post('id');
        $student = $this->Studentmodel->studentCard($id);
        $this->load->view('Template/header-report');
        echo $this->Reportmodel->printStatement($id, $student);
    }
}
