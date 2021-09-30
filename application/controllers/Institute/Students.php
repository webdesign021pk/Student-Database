<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Students extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        if ((($this->uri->segment(4))=='') || !ctype_digit($this->uri->segment(4))) {
            redirect(base_url('Institute/Students/index/1'));
        }
        $order = $this->uri->segment(4);
        $students = $this->Studentmodel->studentList($order);
        $classId = $this->Studentmodel->classList();
        $this->load->view('Institute/Students', compact('students', 'classId'));
        $this->load->view('Template/footer');
    }
    public function add()
    {
        $classId = $this->Studentmodel->classList();
        $sections = $this->Studentmodel->sectionList();

        $post=$this->input->post();
        $post = $this->security->xss_clean($post);
        $file_name='';
        if (isset($_POST['s_firstName'])) {
            $file_name=$post['s_firstName'].$post['dob'];
        }
        $config['upload_path']   = './uploads/students/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 170;
        $config['max_width']     = 1024;
        $config['max_height']    = 768;
        $config['overwrite']     = true;
        $config['file_name']     = $file_name;
        $this->load->library('upload', $config);
        if ($this->form_validation->run('student') && $this->upload->do_upload('userfile')) {
            $data = $this->upload->data();
            //$image_path=base_url('uploads/'.$data['raw_name'].$data['file_ext']);
            $image_path='uploads/students/'.$data['raw_name'].$data['file_ext'];
            $post['image_path']=$image_path;
            $r = $this->Studentmodel->addStudent($post);
            if ($r) { //echo "insert successful";
                $fee = $this->Studentmodel->getFees($post['classIdFK']);
                //$registrationFees = $this->Studentmodel->getFees($post['classIdFK'], 'registrationFees');
                $data=array(
                    'paymentTypeId'=>3,
                    'studentId'=>$r,
                    'forYear'=>$_SESSION['year'],
                    'amountDue'=>$fee->registrationFees
                );
                $data2=array(
                    'paymentTypeId'=>1,
                    'studentId'=>$r,
                    'forYear'=>$_SESSION['year'],
                    'amountDue'=>$fee->yearlyTuitionFees
                );
                $this->Studentmodel->addFeeSchedule($data);
                $this->Studentmodel->addFeeSchedule($data2);
                $this->session->set_flashdata('msg', 'student added successfully!');
                $this->session->set_flashdata('alert', 'success');
                redirect(base_url('Institute/Students/index/'.$post['classIdFK']));
            } else { //echo "sorry";
                $this->session->set_flashdata('msg', 'Failed to add student, Contact Administrator!!');
                $this->session->set_flashdata('alert', 'danger');
                redirect(base_url('Institute/Students/index/'.$post['classIdFK']));
            }
        } else {
            $error = $this->upload->display_errors();
            $this->load->view('Institute/addStudent', compact('classId', 'sections', 'error'));
            $this->load->view('Template/footer');
        }
    }
    public function card($id)
    {
        if ((($this->uri->segment(4))=='') || !ctype_digit($this->uri->segment(4))) {
            redirect(base_url('Institute/Students'));
        }
        $id=$this->uri->segment(4); // gets memberID from URL'
        if ($this->form_validation->run('student')==false) {
            $student = $this->Studentmodel->studentCard($id);
            $classId = $this->Studentmodel->classList();
            $sections = $this->Studentmodel->sectionList();
            $this->load->view('Institute/card', compact('student', 'classId', 'sections'));
            $this->load->view('Template/footer');
        } else {
            $post=$this->input->post();
            $post = $this->security->xss_clean($post);
            if ($this->Studentmodel->modifyStudent($id, $post)) { //echo "member updated";
                $this->session->set_flashdata('msg', 'Student modified successfully!');
                $this->session->set_flashdata('alert', 'success');
                redirect(base_url('Institute/Students/card/').$id);
            } else {
                $this->session->set_flashdata('msg', 'Failed to Modify Student, Contact Administrator!!');
                $this->session->set_flashdata('alert', 'danger');
                redirect(base_url('Institute/Students'));
            }
        }
    }
    public function updateStudentImage(){
        $post=$this->input->post();
        $post = $this->security->xss_clean($post);
        $file_name='';
        if (isset($_POST['s_firstName'])) {
            $id=$_POST['studentIdPK'];
            $file_name=$post['s_firstName'].$post['dob'];
        }
        $config['upload_path']   = './uploads/students/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 170;
        $config['max_width']     = 1024;
        $config['max_height']    = 768;
        $config['overwrite']     = true;
        $config['file_name']     = $file_name;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('userfile')) {
            $data = $this->upload->data();
            //$image_path=base_url('uploads/'.$data['raw_name'].$data['file_ext']);
            $image_path='uploads/students/'.$data['raw_name'].$data['file_ext'];
            $post['image_path']=$image_path;
            if ($this->Studentmodel->modifyStudent($id, $post)) {
                //echo "member updated";
                $this->session->set_flashdata('msg', 'Image modified successfully!');
                $this->session->set_flashdata('alert', 'success');
                redirect(base_url('Institute/Students/card/').$id);
            } else {
                $this->session->set_flashdata('msg', 'Failed to Modify Image, Contact Administrator!!');
                $this->session->set_flashdata('alert', 'danger');
                redirect(base_url('Institute/Students/card/').$id);
            }
        } else {
            $error = $this->upload->display_errors();
            $student = $this->Studentmodel->studentCard($id);
            $classId = $this->Studentmodel->classList();
            $sections = $this->Studentmodel->sectionList();
            $this->load->view('Institute/card', compact('student', 'classId', 'sections', 'error'));
            $this->load->view('Template/footer');
        }
    }
}
