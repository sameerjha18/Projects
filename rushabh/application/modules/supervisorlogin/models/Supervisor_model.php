<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Supervisor_model extends CI_Model {

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
        // $record = $this->db->get_where($table,$condition);
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($condition);
        $this->db->order_by("id", "desc");
        $record = $this->db->get();
        if($record->num_rows() > 0):
            return $record->num_rows();
        else:
            return "no";
        endif;
    }

    public function getAllRec($table,$id){
        // $record = $this->db->get($table);
        $this->db->select('*');
        $this->db->from($table);
        // $this->db->where($condition);
        $this->db->order_by($id, "desc");
        $record = $this->db->get();
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
    
    public function get_inquiry()
    {

        $this->db->select('iq.*,c_name,c_mobile,c_email,rt_id,r_name,c_code');
        $this->db->from('inquiries iq');
        $this->db->where('inq_status=','1');
        $this->db->where('lead_status=','1')->or_where("lead_status","2")->or_where("lead_status","3");
        $this->db->join('customer c','c.c_id = iq.c_id');
        $record = $this->db->get();

        if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;
    }

    public function get_inquirybyid($id)
    {

        $this->db->select('*');
        $this->db->from('inquiry_detail');
        $this->db->where('inq_id=',$id);
        $record = $this->db->get();

        if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;
    }
    
    /*public function get_customer($id)
    {
        $this->db->select('c_id,c_name,c_code,c_mobile,c_email,rt_name,r_name');
        $this->db->from('customer c');
        $this->db->where('c_id=',$id);
        $this->db->join('referencetype rt','c.rt_id = rt.rt_id');
        $record = $this->db->get();
        if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif; 
    }*/
}
?>