<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_blocked_date extends CI_Model
{
    private $table_blocked_date = 't_blocked_date';
    
    private $column_order_blocked_date = array('t_blocked_date.date_until');    
        
    private $order_blocked_date = array('t_blocked_date.date_until' => 'desc');    


    public function _get_query_blocked_date()
    {
        $this->db->select('id, (CONVERT(varchar(10), CONVERT(datetime, date_from,120),105)) as date_from, (CONVERT(varchar(10), CONVERT(datetime, date_until,120),105)) as date_until, (DATEDIFF(day,date_from, date_until) + 1) as total_days, reason');
        $this->db->from($this->table_blocked_date);
        if (isset($_POST['order_blocked_date'])) {
            $this->db->order_by($this->column_order_blocked_date[$_POST['order_blocked_date']['0']['column']],
                $_POST['order_blocked_date']['0']['dir']);
        } else
            if (isset($this->order_blocked_date)) {
                $order_blocked_date = $this->order_blocked_date;
                $this->db->order_by(key($order_blocked_date), $order_blocked_date[key($order_blocked_date)]);
            }
    }

    public function get_blocked_date()
    {
        $this->_get_query_blocked_date();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }

    
    public function count_filtered_blocked_date()
    {
        $this->_get_query_blocked_date();
        $query = $this->db->get();
        return $query->num_rows();
    }

   
    public function count_all_blocked_date()
    {
        $this->db->from($this->table_blocked_date);
        return $this->db->count_all_results();
    }
    
    public function by_id($id)
    {        
        $datasrc = $this->db->get_where('t_blocked_date', array('id' => $id));
        return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
    }
       

}

/* End of file model_category_information.php */
/* Location: ./application/modules/back_office/models/model_category_information.php */
