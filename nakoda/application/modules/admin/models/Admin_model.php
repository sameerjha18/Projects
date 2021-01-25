<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

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

    public function getpurchase($id)
    {
        $this->db->select('pf.*,p_name,p_code');
        $this->db->from('purchase_details pf');

        $this->db->join('products p','p.p_id=pf.p_id');
        $this->db->where('purchase_id',$id);
         $record = $this->db->get();
         if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;  

    }

    public function getproducts()
    {
        $this->db->select('p.*,p_name,d_size,p_avail,p_sold,p_total,tax_name,tax_price,pd_unitprice');
        $this->db->from('products p');

        $this->db->where('p_status = 1');
        $this->db->join('dimension d','p.d_id = d.d_id');
        $this->db->join('taxes t','p.p_tax = t.t_id','left');
        $this->db->join('product_inventory pi','pi.p_id = p.p_id');
        $this->db->join('purchase_details pd','pd.p_id = p.p_id');

         $record = $this->db->get();
         if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;  
    }


    public function getproductinventory()
    {

        $this->db->select('pi.*,p_code');
        $this->db->from('product_inventory pi');
        $this->db->where('pi_status = 1');
        $this->db->join('products p','p.p_id = pi.p_id');

         $record = $this->db->get();
         if($record->num_rows() > 0):
            return $record->result_array();
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

    public function getmapdata($id)
    {
        $this->db->select('ed.*,edu_type');
        $this->db->from('educations_detail ed');
        $this->db->join('education e','ed.edu_id = e.edu_id','left');
        // $this->db->where('ed_status',1);
        $this->db->where('ed.e_id', $id );
        $record = $this->db->get();
         if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;  
    }
    public function getmapdatas($id)
    {
        $this->db->select('dd.*,d_name');
        $this->db->from('documents_detail dd');
        $this->db->join('doc_type d','dd.d_id = d.d_id','left');
        // $this->db->where('dd_status',1);
        $this->db->where('dd.e_id', $id );
        $record = $this->db->get();
         if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;  
    }

}
?>