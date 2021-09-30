<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reportmodel extends CI_Model
{
    public function printCatalogue($cat)
    {
        $q=$this->db->select('*')
            ->from('lm_tbl_books')
            ->join('lm_tbl_category', 'lm_tbl_category.subCatIdPK = lm_tbl_books.subCatId')
            ->join('lm_tbl_language', 'lm_tbl_language.languageIdPK = lm_tbl_books.languageId')
            ->where('lm_tbl_category.category', $cat)
            ->get();
        $r=$q->result();
        $output = '';
        $output .= '<div class="h5 mt-2">';
        $output .= '<div><span>Books Catalogue</span><button class="float-right btn btn-sm btn-primary" id="printPageButton" onclick="print();">Print</button></div>';
        $output .= '<h5>Category: <span class="text-info">'.$cat.'</span></h5>';
        $output .= '</div>';
        $output .= '<table class="table bordered" style="max-width: 260mm">';
        $output .= '<thead class="font-weight-bold">';
        $output .= '<tr>';
        $output .= '<td>ID</td>';
        $output .= '<td>Title</td>';
        $output .= '<td>Author</td>';
        $output .= '<td>Language</td>';
        $output .= '<td>Sub Category</td>';
        $output .= '<td>Publication</td>';
        $output .= '</tr>';
        $output .= '</thead>';
        $output .= '<tbody>';
        if ($r) {
            foreach ($r as $row) {
                $output .= '<tr>';
                $output .= '<td>';
                $output .= $row->bookIdPK;
                $output .= '</td>';
                $output .= '<td>';
                $output .= $row->title;
                $output .= '</td>';
                $output .= '<td>';
                $output .= $row->author;
                $output .= '</td>';
                $output .= '<td>';
                $output .= $row->language;
                $output .= '</td>';
                $output .= '<td>';
                $output .= $row->subCat;
                $output .= '</td>';
                $output .= '<td>';
                $output .= $row->publisher;
                $output .= '</td>';
                $output .= '</tr>';
            }
        } else {
            $output .= '<tr>';
            $output .= '<td colspan="6">No Book found in this Category</td>';
            $output .= '</tr>';
        }
        $output .= '</tbody>';
        $output .= '</table>';
        return $output;
    }
    public function printStudents($order)
    {
        $className='';
        if($order==0){
            $q=$this->db->select('*')
                ->from('sdb_tbl_students')
                ->join('sdb_tbl_classes', 'sdb_tbl_classes.classIdPK = sdb_tbl_students.classIdFK', 'left')
                ->join('sdb_tbl_sections', 'sdb_tbl_sections.sectionIdPK = sdb_tbl_students.sectionIdFK','left')
                ->get();
            $className='All Classes';
            $r=$q->result();
        } else {
            $q=$this->db->select('*')
                ->from('sdb_tbl_students')
                ->join('sdb_tbl_classes', 'sdb_tbl_classes.classIdPK = sdb_tbl_students.classIdFK', 'left')
                ->join('sdb_tbl_sections', 'sdb_tbl_sections.sectionIdPK = sdb_tbl_students.sectionIdFK','left')
                ->where('sdb_tbl_students.classIdFK', $order)
                ->get();
            $r=$q->result();
            if($r){
                $className=$q->row()->className;
            }
        }
        $output = '';
        $output .= '<div class="h5 mt-2">';
        $output .= '<div><span>Students List</span><button class="float-right btn btn-sm btn-primary" id="printPageButton" onclick="print();
        ">Print</button></div>';
        $output .= '<h5>Class: <span class="text-info">'.$className.'</span></h5>';
        $output .= '</div>';
        $output .= '<table class="table bordered" style="max-width: 260mm">';
        $output .= '<thead class="font-weight-bold">';
        $output .= '<tr>';
        $output .= '<td>Basic Info</td>';
        $output .= '<td>Contact Details</td>';
        $output .= '<td>Other Details</td>';
        $output .= '</tr>';
        $output .= '</thead>';
        $output .= '<tbody>';
        if ($r) {
            foreach ($r as $row) {
                if(($row->gender)=='2'){$gender='<i class="fas fa-female"></i> Female';} else {$gender='<i class="fas fa-male"></i> Male';}
                $output .= '<tr>';
                $output .= '<td>';
                $output .= '
                            <i class="fas fa-barcode"></i> '.$row->studentIdPK.'<br />
                            <i class="fas fa-id-badge"></i> '.$row->s_firstName.'&nbsp;'.$row->s_lastName.'<br />
                            <i class="fas fa-envelope"></i> '.$row->email
                ;
                $output .= '</td>';
                $output .= '<td>';
                $output .= '
                            <i class="fas fa-map-marked"></i> '.$row->address.'<br />
                            <i class="fas fa-phone-square-alt"></i> '.$row->contact1.'<br />
                            <i class="fas fa-phone-square-alt"></i> '.$row->contact2
                ;
                $output .= '</td>';
                $output .= '<td>';
                $output .= '
                            DOB: <i class="fas fa-calendar-alt"></i> '.$row->dob.'<br />
                            Gender: '.$gender.'<br />
                            <i class="fas fa-chalkboard"></i> '.$row->className.' [Section: <b>'.$row->sectionName.'</b>'
                ;
                $output .= '</td>';
                $output .= '</tr>';
            }
        } else {
            $output .= '<tr>';
            $output .= '<td colspan="6">No Student found in this Class</td>';
            $output .= '</tr>';
        }
        $output .= '</tbody>';
        $output .= '</table>';
        return $output;
    }
    public function printIdCards($id)
    {
        $q=$this->db->select('sdb_tbl_students.*, sdb_tbl_classes.className, sdb_tbl_sections.sectionName')
            ->from('sdb_tbl_students')
            ->join('sdb_tbl_classes', 'sdb_tbl_classes.classIdPK = sdb_tbl_students.classIdFK')
            ->join('sdb_tbl_sections', 'sdb_tbl_sections.sectionIdPK = sdb_tbl_students.sectionIdFK')
            ->where('studentIdPK', $id)
            ->get();
        $r=$q->row();
        $output = '';
        if ($r) {
            $output .='<button class="float-right btn btn-sm btn-primary" id="printPageButton" onclick="print();">Print</button>';
            $output .= '<div class="row m-2 border" style="max-width: 3.370in; max-height: 2.125in;">';
            $output .= '<table border="1" width="100%">';
            $output .= '<thead class="text-center">';
            $output .= '<tr>';
            $output .= '<th colspan="2" class="bg-secondary text-white">';
            $output .= $_SESSION['InstituteName'];
            $output .= '</th>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<th colspan="2">Identity Card</th>';
            $output .= '</tr>';
            $output .= '</thead>';
            $output .= '<tr>';
            $output .= '<td rowspan="5">';
            $output .= '<img src="'.base_url($r->image_path).'" class="float-left" style="max-width: 1in; ">';
            $output .= '</td>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<td>';
            $output .= 'Full Name:<span class="float-right font-weight-bold">ID:'.$r->studentIdPK.'</span><br/>
            <span class="font-weight-bold">'.$r->s_firstName.'&nbsp;'.$r->s_lastName
                .'</span><br />';
            $output .= '</td>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<td>';
            $output .= 'Contact No. <span class="float-right font-weight-bold">'.$r->contact1.'</span><br/>';
            $output .= '</td>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<td>';
            $output .= 'Address: <span class="float-right font-weight-bold">'.$r->address.'</span><br/>';
            $output .= '</td>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<td>';
            $output .= '<span class="">'.$r->className.'&nbsp;[Section: <b>'.$r->sectionName.'</b>]</span>';
            $output .= '</td>';
            $output .= '</tr>';
            $output .= '</table>';
            $output .= '</div>';
            $output .= '';
        } else {
            $output .= 'No Member Found';
        }
        return $output;
    }
    public function printStatement($id, $student)
    {
        $q=$this->db->select('*')
            ->from('sdb_tbl_fee_payment')
            ->join('sdb_tbl_payment_type', 'sdb_tbl_payment_type.paymentTypeIdPK = sdb_tbl_fee_payment.paymentTypeId', 'left')
            ->where('sdb_tbl_fee_payment.studentID', $id)
            ->get();
        $r = $q->result();
        $output = '';
        $total=0;
        if ($r) {
            $output .= '<table class="table bordered" style="max-width: 260mm">';
            $output .= '<thead class="font-weight-bold">';
            $output .= '<tr>';
            $output .= '<th colspan="5">';
            $output .= '<div class="h5 mb-0">';
            $output .= 'Finance Statement of: <button class="float-right btn btn-sm btn-primary" id="printPageButton" onclick="print();">Print</button>';
            $output .= '<h5 class="mb-0"><span class="text-info">'.$student->s_firstName.'&nbsp;'.$student->s_lastName.'</span></h5>';
            $output .= '</div>';
            $output .= '</th>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<th>Student ID:</th>';
            $output .= '<th colspan="4"><span class="text-right">'.$student->studentIdPK.'</span></th>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<th>Contact:</th>';
            $output .= '<td colspan="4"><span class="text-right">'.$student->contact1.'</span></td>';
            $output .= '</tr>';
            $output .= '</thead>';
            $output .= '<tbody>';
            $output .= '<tr class="bg-light">';
            $output .= '<td colspan="5">Payment Details</td>';
            $output .= '</tr>';
            $output .= '<tr class="font-weight-bold">';
            $output .= '<td>Date</td>';
            $output .= '<td>Transaction ID</td>';
            $output .= '<td>Payment Type</td>';
            $output .= '<td>Amount</td>';
            $output .= '<td>Notes</td>';
            $output .= '</tr>';
            foreach ($r as $row) {
                $total=$total+$row->paymentAmount;
                $output .= '
                <tr>
                        <td width="15%">'.$row->paymentDate.'</td>
                        <td width="13%">'.$row->feePaymentIdPK.'</td>
                        <td width="25%">'.$row->paymentType.'</td>
                        <td width="15%">'.$row->paymentAmount.'</td>
                        <td width="32%">'.$row->notes.'</td>
                        </tr>';
            }
            $output .= '</tbody>';
            $output .= '<tfoot class="font-weight-bold">';
            $output .= '<tr>';
            $output .= '<td colspan="3" align="right">Total Amount:</td>';
            $output .= '<td>'.$total.'</td>';
            $output .= '<td></td>';
            $output .= '</tr>';
            $output .= '</tfoot>';
            $output .= '</table>';
            $output .= '</div>';
            $output .= '';
        } else {
            $output .= 'No Transactions Found';
        }
        return $output;
    }
    public function dashboardChart(){
        $q = $this->db->select('sdb_tbl_students.studentIdPK,sdb_tbl_students.classIdFK, sdb_tbl_classes.className,
        (SELECT COUNT(studentIdPK) FROM sdb_tbl_students WHERE sdb_tbl_classes.classIdPK = sdb_tbl_students.classIdFK) as totalStudents')
            ->from('sdb_tbl_students')
            ->join('sdb_tbl_classes', 'sdb_tbl_classes.classIdPK = sdb_tbl_students.classIdFK')
            ->group_by('sdb_tbl_students.classIdFK')
            ->get();
        return $q->result();
    }
    public function countRows($table){
        $q = $this->db->from($table)
            ->where('status', 1)
            ->get();
        return $q->num_rows();
    }
}