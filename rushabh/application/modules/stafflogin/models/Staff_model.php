<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Staff_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function get_count($table,$condition) {
        $query = $this->db->where($condition)
            ->get($table);
        return $query->num_rows();
    }

    public function getWhere($table,$condition){
        $record = $this->db->get_where($table,$condition);
        if($record->num_rows() > 0):
            return $record->result();
        else:
            return "no";
        endif;
    }

    public function getCountRecord($table,$condition){
        $record = $this->db->get_where($table,$condition);

        if($record->num_rows() > 0):
            return $record->num_rows();
        else:
            return "no";
        endif;
    }

    public function getAllRec($table){
        $record = $this->db->get($table);
        if($record->num_rows() > 0):
            return $record->result();
        else:
            return "no";
        endif;
    }

    public function getWherewithlimit($table,$condition,$limit){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($condition);
        $this->db->order_by("id", "desc");
        if($limit != ""):
            $this->db->limit($limit);
        endif;

        $record = $this->db->get();
        if($record->num_rows() > 0):
            return $record->result();
        else:
            return "no";
        endif;
    }

    public function get_joins($table, $columns, $joins)
    {
        $this->db->select($columns)->from($table);
        if (is_array($joins) && count($joins) > 0)
        {
            foreach($joins as $k => $v)
            {
                $this->db->join($v['table'], $v['condition'], $v['jointype']);
            }
        }
        return $this->db->get()->result();
    }

    public function allinquiries()
    {

        $this->db->select('iq.*,c_name,c_mobile,ls_name');
        $this->db->from('inquiries iq');

        $this->db->where('inq_status=','1');
        $this->db->join('customer c','c.c_id = iq.c_id');
        $this->db->where('inq_product!=','no');
        $this->db->join('leadstatus ls','ls.ls_id = iq.lead_status');
        $record = $this->db->get();

        if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;
    }

    public function trashinquiries()
    {
        $this->db->select('iq.*,c_name,c_mobile,ls_name');
        $this->db->from('inquiries iq');

        $this->db->where('inq_status=','0');
        $this->db->join('customer c','c.c_id = iq.c_id');

        $this->db->join('leadstatus ls','ls.ls_id = iq.lead_status');
        $record = $this->db->get();

        if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;

    }

    public function getcorporates()
    {
        $this->db->select('cc.*');
        $this->db->from('corporateclient cc');
        $this->db->where('cc_status = 1');
        $record = $this->db->get();
        if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;
    }

    public function get_trashcorporates()
    {
        $this->db->select('cc.*');
        $this->db->from('corporateclient cc');
        $this->db->where('cc_status = 0');
        $record = $this->db->get();
        if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;
    }

    public function getbusinessowners()
    {
        $this->db->select('bo.*');
        $this->db->from('businessowners bo');
        $this->db->where('bo_status = 1');
        $record = $this->db->get();
        if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;
    }



    public function trash_businessowners()
    {
        $this->db->select('bo.*');
        $this->db->from('businessowners bo');
        $this->db->where('bo_status = 0');
        $record = $this->db->get();
        if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;
    }

    public function owners_contact($id)
    {
        $this->db->select('own.*,des_name');
        $this->db->from('owners_contact own');
        $this->db->where('bop_status = 1');
        $this->db->join('designation des','des.des_id = own.bop_designation');
        $record = $this->db->get();
        if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;
    }
    public function get_inquiry($id)
    {

        $this->db->select('iq.*,c_name,c_mobile');
        $this->db->from('inquiries iq');
        $this->db->where('inq_id=',$id);
        $this->db->join('customer c','c.c_id = iq.c_id');
        $this->db->join('leadstatus ls','ls.ls_id = iq.lead_status');
        $record = $this->db->get();

        if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;
    }


    public function inq_products($id)
    {   $this->db->select('p_name');
        $this->db->from('products p');
        $this->db->where_in('p_id',explode(",", $id));

        $record = $this->db->get();

        if($record->num_rows() > 0):
            $data = $record->result_array();
            return $data;
        else:
            return "no";
        endif;

    }

    public function all_birthdays($month)
    {

        $this->db->select('c_name as Name,c_mobile as Mobile,c_date as BirthDate');
        $this->db->from('customer');
        $this->db->where('month(c_date)', date($month));
        $this->db->where('c_status','1');
        $record = $this->db->get();

        if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;
    }


    public function all_anniversaries($month)
    {

        $this->db->select('c_name as Name,c_mobile as Mobile,ca_date as AnniversaryDate');
        $this->db->from('customer');
        $this->db->where('month(ca_date)', date($month));
        $this->db->where('c_status','1');
        $record = $this->db->get();

        if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;
    }

    public function all_sales($month)
    {
        $this->db->select('c_name as Name,c_mobile as Mobile,lead_type,inq_product,inq_pur,inq_billdate,inq_billamt');
        $this->db->from('inquiries iq');
        $this->db->where('month(ca_date)', date($month));
        $this->db->where('lead_status','2');
        $this->db->join('customer c','c.c_id = iq.c_id');
        $record = $this->db->get();

        if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;
    }
}
?>