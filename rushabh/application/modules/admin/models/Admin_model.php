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
        $this->db->select('pf.*,p_name');
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
        $this->db->join('leadstatus ls','ls.ls_id = iq.lead_status');
        $record = $this->db->get();

        if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;  
    }

        public function get_customer($id)
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
    }

        public function get_leadstatus($id)
    {
        $this->db->select('*');
        $this->db->from('leadstatus ls');
        $this->db->where('ls_id=',$id);
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

    public function get_inquiry($id)
    {

        $this->db->select('iq.*,c_name,c_mobile,c_email,rt_id,r_name,c_code');
        $this->db->from('inquiries iq');
        $this->db->where('inq_id=',$id);
        $this->db->where('inq_status=','1');
        $this->db->join('customer c','c.c_id = iq.c_id');
        $this->db->join('leadstatus ls','ls.ls_id = iq.lead_status');
        $record = $this->db->get();

        if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;
    }

    public function get_inqsupervisor($sup)
    {

        $this->db->select('sup_name');
        $this->db->from('supervisor s');
        $this->db->where_in('sup_id',explode(",", $sup));

        $record = $this->db->get();

        if($record->num_rows() > 0):
            $data = $record->result_array();
            return $data;
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



    public function getproductsupplier($id)
    {
        $this->db->select('ps.*,p_name');
        $this->db->from('p_supplier ps');
        $this->db->where('s_id',$id);
        $this->db->join('products p','p.p_id = ps.p_id');

         $record = $this->db->get();
         if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;

    }

    public function getsupplierproducts()
    {
        $this->db->select('ps.*,p_name,p_image,s_name');
        $this->db->from('p_supplier ps');
        $this->db->join('products p','p.p_id = ps.p_id');
        $this->db->join('supplier s','s.s_id = ps.s_id');
        $this->db->order_by('p_id','asc');
         $record = $this->db->get();
         if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;

    }

    public function getproductspecialized($id)
    {
        $this->db->select('psp.*,p_name');
        $this->db->from('p_specialized psp');
        $this->db->where('v_id',$id);
        $this->db->join('products p','p.p_id = psp.p_id');

         $record = $this->db->get();
         if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;

    }

     public function getproductspecailized()
    {
        $this->db->select('psp.*,p_name,p_image,v_name');
        $this->db->from('p_specialized psp');
        $this->db->join('products p','p.p_id = psp.p_id');
        $this->db->join('vendor v','v.v_id = psp.v_id');
        $this->db->order_by('p_id','asc');
         $record = $this->db->get();
         if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;

    }

    public function makequote($id)
    {

        $this->db->select('iq.*,c_name,c_mobile,c_email');
        $this->db->from('inquiries iq');
        $this->db->where('inq_status=','1');
        $this->db->where('inq_id=',$id);
        $this->db->join('customer c','c.c_id = iq.c_id');
        $record = $this->db->get();

        if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;  
    }


    public function getquote($id)
    {

        $this->db->select('iq.*,c_name,c_mobile,c_email,q_id');
        $this->db->from('inquiries iq');
        $this->db->where('inq_status=','1');
        $this->db->where('iq.inq_id=',$id);
        $this->db->join('customer c','c.c_id = iq.c_id');
        $this->db->join('quotation q','q.inq_id = iq.inq_id');
        $record = $this->db->get();

        if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;  
    }

    public function quote()
    {

        $this->db->select('iq.*,c_name,c_mobile,c_email,q_id');
        $this->db->from('inquiries iq');
        $this->db->where('inq_status=','1');
        $this->db->where('lead_status >=','4');
        $this->db->where('lead_status <=','8');
        $this->db->join('customer c','c.c_id = iq.c_id');
        $this->db->join('quotation q','q.inq_id = iq.inq_id','left');
        $record = $this->db->get();

        if($record->num_rows() > 0):
            return $record->result_array();
        else:
            return "no";
        endif;  
    }

    public function get_quote_id()
    {
        $this->db->select_max('q_id');
        $record = $this->db->get('quotation'); 
        if($record->num_rows() > 0):        
            $data = $record->result_array();
            return $data[0]['q_id'] + 1;
        else:
            return 1;
        endif;  
    }

    

}
?>