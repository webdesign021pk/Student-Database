<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Studentmodel extends CI_Model
{
    public function studentList($order)
    {
        if($order==0){
            $q=$this->db->select('*')
                ->from('sdb_tbl_students')
                ->join('sdb_tbl_classes', 'sdb_tbl_classes.classIdPK = sdb_tbl_students.classIdFK', 'left')
                ->join('sdb_tbl_sections', 'sdb_tbl_sections.sectionIdPK = sdb_tbl_students.sectionIdFK','left')
                ->get();
        } else {
            $q=$this->db->select('*')
                ->from('sdb_tbl_students')
                ->join('sdb_tbl_classes', 'sdb_tbl_classes.classIdPK = sdb_tbl_students.classIdFK', 'left')
                ->join('sdb_tbl_sections', 'sdb_tbl_sections.sectionIdPK = sdb_tbl_students.sectionIdFK','left')
                ->where('sdb_tbl_students.classIdFK', $order)
                ->get();
        }
        $output = '';
        $otherDetails = '';
        $output .= '';
        $r = $q->result();
        if ($r) {
            $gender = '';
            foreach ($r as $row) {
                $q2=$this->db->select('*')
                    ->from('sdb_tbl_fee_schedule')
                    ->join('sdb_tbl_payment_type', 'sdb_tbl_payment_type.paymentTypeIdPK = sdb_tbl_fee_schedule.paymentTypeId', 'left')
                    ->where('sdb_tbl_fee_schedule.studentId', $row->studentIdPK)
                    ->where('sdb_tbl_fee_schedule.fee_status !=','1')
                    ->get();
                $r2 = $q2->result();
                if ($r2) {
                    $feeDetails = '';
                    foreach ($r2 as $row2) {
                        $feeStatus = '';
                        if($row2->fee_status==0){
                            $feeStatus='<span class="badge badge-danger">Unpaid</span>';
                        }
                        elseif($row2->fee_status==2){
                            $feeStatus='<span class="badge badge-warning">Partial</span>';
                        }
                        $feeDetails .= '
                        <div>
                        Fee Type: '.$row2->paymentType.'&nbsp;'.$feeStatus.'<br />
                        Total Fee: '.$row2->amountDue.'&nbsp;
                        <a class="mx-1" href="'.base_url('Institute/Home/paymentDetails/').$row2->feeScheduleIdPK.'">
                            <span class="badge badge-pill badge-primary">View</span>
                        </a>
                        </div>
                        ';
                    }
                } else {
                    $feeDetails = 'No Fee Due';
                }
                if ($row->gender==1) {
                    $gender='<i class="fas fa-male"></i> Male';
                } elseif ($row->gender==2) {
                    $gender='<i class="fas fa-female"></i> Female';
                }
                $output .= '<tr>';
                $output .= '<td>';
                $output .= '
                <div class="media">
                    <img src="'.base_url($row->image_path).'"
                         class="rounded-circle img-fluid mr-1" style="max-width: 100px">
                    <div class="media-body">
                        <i class="fas fa-barcode"></i> '.$row->studentIdPK.'<br />
                        <i class="fas fa-id-badge"></i> '.$row->s_firstName.'&nbsp;'.$row->s_lastName.'<br />
                        '.$gender.'
                        <br />
                        <i class="fas fa-calendar-alt"></i> DOB:  '.$row->dob.'
                    </div>
                </div>
                ';
                $output .= '</td>';
                $output .= '<td>';
                $output .= '
                <i class="fas fa-map-marked"></i> '.$row->address.'<br />
                <i class="fas fa-phone-square-alt"></i> '.$row->contact1.'<br />
                <i class="fas fa-phone-square-alt"></i> '.$row->contact2.'<br />
                <i class="fas fa-envelope"></i> '.$row->email
                ;
                $output .= '</td>';
                $output .= '<td>';
                $output .= '
                <a href="'.base_url('Institute/Students/card/'.$row->studentIdPK).'"
                   class="btn btn-sm btn-info text-white float-right">
                    Modify
                </a>
                <i class="fas fa-chalkboard"></i> '.$row->className.' [Section: <b>'.$row->sectionName.'</b>]
                <br />';
                $output .= $feeDetails;
                $output .= '</td>';
                $output .= '</tr>';
            }
        } else {
            $output .= '<tr><td colspan="3">No Data Found</td></tr>';
        }
        return $output;
    }
    public function studentCard($id){
        $q=$this->db->select('*')
            ->from('sdb_tbl_students')
            ->join('sdb_tbl_classes', 'sdb_tbl_classes.classIdPK = sdb_tbl_students.classIdFK')
            ->join('sdb_tbl_sections', 'sdb_tbl_sections.sectionIdPK = sdb_tbl_students.sectionIdFK')
            ->where('studentIdPK', $id)
            ->get();
        return $q->row();
    }
    public function classList(){
        $q=$this->db->select('*')
            ->from('sdb_tbl_classes')
            ->get();
        return $q->result();
    }
    public function addClass($post){
        return $this->db->insert('sdb_tbl_classes', $post);
    }
    public function modifyClass($id, $array)
    {// Update
        return $this->db->where('classIdPK', $id)
            ->update('sdb_tbl_classes', $array);
    }
    public function getFees($id){
        $q=$this->db->select('*')
            ->from('sdb_tbl_classes')
            ->where('classIdPK', $id)
            ->get();
        return $q->row();
    }
    public function sectionList(){
        $q=$this->db->select('*')
            ->from('sdb_tbl_sections')
            ->get();
        return $q->result();
    }
    public function addSection($post){
        return $this->db->insert('sdb_tbl_sections', $post);
    }
    public function modifySection($id, $field, $value)
    {// Update
        $data = array($field => $value);
        $this->db->where('sectionIdPK', $id);
        $this->db->update('sdb_tbl_sections', $data);
    }
    public function paymentTypeList(){
        $q=$this->db->select('*')
            ->from('sdb_tbl_payment_type')
            ->get();
        return $q->result();
    }
    public function addStudent($array)
    {
        $this->db->insert('sdb_tbl_students', $array);
        $last_id = $this->db->insert_id();
        return $last_id;
    }
    public function modifyStudent($id, $array)
    {
        return $this->db->where('studentIdPK', $id)
            ->update('sdb_tbl_students', $array);
    }
    public function feeSchedule($order)
    {
        if($order==0){
            $q=$this->db->select('*')
                ->from('sdb_tbl_fee_schedule')
                ->join('sdb_tbl_students', 'sdb_tbl_students.studentIdPK = sdb_tbl_fee_schedule.studentId', 'left')
                ->join('sdb_tbl_classes', 'sdb_tbl_classes.classIdPK = sdb_tbl_students.classIdFK', 'left')
                ->join('sdb_tbl_sections', 'sdb_tbl_sections.sectionIdPK = sdb_tbl_students.sectionIdFK','left')
                ->group_by('sdb_tbl_students.studentIdPK')
                ->get();
        } else {
            $q=$this->db->select('*')
                ->from('sdb_tbl_fee_schedule')
                ->join('sdb_tbl_students', 'sdb_tbl_students.studentIdPK = sdb_tbl_fee_schedule.studentId', 'left')
                ->join('sdb_tbl_classes', 'sdb_tbl_classes.classIdPK = sdb_tbl_students.classIdFK', 'left')
                ->join('sdb_tbl_sections', 'sdb_tbl_sections.sectionIdPK = sdb_tbl_students.sectionIdFK','left')
                ->where('sdb_tbl_students.classIdFK', $order)
                ->group_by('sdb_tbl_students.studentIdPK')
                ->get();
        }
        $r = $q->result();
        $output = '';
        if($r){
            foreach($r as $row){
                $q2=$this->db->select('*')
                    ->from('sdb_tbl_fee_schedule')
                    ->join('sdb_tbl_payment_type', 'sdb_tbl_payment_type.paymentTypeIdPK = sdb_tbl_fee_schedule.paymentTypeId', 'left')
                    ->where('sdb_tbl_fee_schedule.studentId', $row->studentIdPK)
                    ->get();
                $r2 = $q2->result();
                if ($r2) {
                    $feeDetails1 = '';
                    $feeDetails1 .= '<table id="particular" class="table" border="1">';
                    foreach($r2 as $row2) {
                        $feeStatus='';
                        if($row2->fee_status==0){
                            $feeStatus='<span class="badge badge-danger">Unpaid</span>';
                        }
                        elseif($row2->fee_status==2){
                            $feeStatus='<span class="badge badge-warning">Partial</span>';
                        }
                        elseif($row2->fee_status==1){
                            $feeStatus='<span class="badge badge-success">Paid</span>';
                        }

                        $feeDetails1 .= '
                        <tr>
                        <td width="30%">'.$row2->paymentType.'</td>
                        <td width="17%">'.$row2->forYear.'</td>
                        <td width="17%">'.$row2->amountDue.'</td>
                        <td width="35%">'.$feeStatus.'
                            <a class="mx-1" href="'.base_url('Institute/Home/paymentDetails/').$row2->feeScheduleIdPK.'">
                                <span class="badge badge-pill badge-primary">View</span>
                            </a>
                        </td>
                        </tr>
                        ';
                    }
                    $feeDetails1 .= '</table>';
                }

                $output .= '';
                $output .= '<tr>';
                $output .= '<td><i class="fas fa-barcode"></i> <span class="studentId">'.$row->studentIdPK.'</span>
                            <br /><i class="fas fa-id-badge"></i> <span class="studentName">'.$row->s_firstName.'&nbsp;'.$row->s_lastName.'</span>
                            <br /><i class="fas fa-phone-square-alt"></i> '.$row->contact1.'</td>';
                $output .= '<td>'.$row->className.' [Section: <b>'.$row->sectionName.'</b>]</td>';
                $output .= '<td colspan="2">';
                $output .= $feeDetails1;
                $output .= '</td>';
                $output .= '</tr>';
            }
        } else {
            $output .= '<tr><td colspan="4">No Student Data Available</td></tr>';
        }
        return $output;
    }
    public function addFeeSchedule($array){
        return $this->db->insert('sdb_tbl_fee_schedule', $array);
    }
    public function paymentDetails($id)
    {
        $q=$this->db->select('*')
            ->from('sdb_tbl_fee_schedule')
            ->join('sdb_tbl_payment_type', 'sdb_tbl_payment_type.paymentTypeIdPK = sdb_tbl_fee_schedule.paymentTypeId', 'left')
            ->join('sdb_tbl_students', 'sdb_tbl_students.studentIdPK = sdb_tbl_fee_schedule.studentId', 'left')
            ->join('sdb_tbl_classes', 'sdb_tbl_classes.classIdPK = sdb_tbl_students.classIdFK', 'left')
            ->join('sdb_tbl_sections', 'sdb_tbl_sections.sectionIdPK = sdb_tbl_students.sectionIdFK','left')
            ->where('sdb_tbl_fee_schedule.feeScheduleIdPK', $id)
            ->get();
        //return $q->row();
        $r = $q->row();
        if($r){
            return $r;
        }
    }
    public function transactionDetails($id)
    {
        $q=$this->db->select('*')
            ->from('sdb_tbl_fee_payment')
            ->join('sdb_tbl_fee_schedule', 'sdb_tbl_fee_schedule.feeScheduleIdPK = sdb_tbl_fee_payment.feeScheduleId', 'left')
            ->join('sdb_tbl_payment_type', 'sdb_tbl_payment_type.paymentTypeIdPK = sdb_tbl_fee_payment.paymentTypeId', 'left')
            ->where('sdb_tbl_fee_payment.feeScheduleId', $id)
            ->get();
        $r = $q->result();
        $output = '';
        if($r){
            foreach($r as $row){
                $output .= '';
                $output .= '<tr class="p-0">';
                $output .= '<td class="p-1">'.$row->feePaymentIdPK.'</td>';
                $output .= '<td class="p-1"><span class="transactionDate">'.$row->paymentDate.'</span></td>';
                $output .= '<td class="p-1">'.$row->paymentType.'</td>';
                $output .= '<td class="p-1"><span class="paidAmount">'.$row->paymentAmount.'</span></td>';
                $output .= '<td class="p-1">'.$row->notes.'</td>';
                $output .= '</tr>';
            }
        } else {
            $output .= '<tr><td colspan="5">No Payment Data Available</td></tr>';
        }
        return $output;
    }
    public function addpayment($array){
        return $this->db->insert('sdb_tbl_fee_payment', $array);
    }
    public function modifyFeeScheduleStatus($id, $array)
    {
        return $this->db->where('feeScheduleIdPK', $id)
            ->update('sdb_tbl_fee_schedule', $array);
    }

}
