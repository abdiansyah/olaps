<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_blocked_room extends CI_Model
{
    private $table_blocked_room = 't_blocked_room';
    
    private $column_order_blocked_room = array('t_blocked_room.date_until');    
        
    private $order_blocked_room = array('t_blocked_room.date_until' => 'desc');    


    public function _get_query_blocked_room()
    {
        $this->db->select('t_blocked_room.id, mr.name_room, (CONVERT(varchar(10), CONVERT(datetime, t_blocked_room.date_from,120),105)) as date_from, (CONVERT(varchar(10), CONVERT(datetime, t_blocked_room.date_until,120),105)) as date_until, (DATEDIFF(day,date_from, date_until) + 1) as total_days, t_blocked_room.reason');
        $this->db->from($this->table_blocked_room);
        $this->db->join('m_room AS mr', 'mr.id_room = t_blocked_room.id_room_fk', 'left');
        
        if (isset($_POST['order_blocked_room'])) {
            $this->db->order_by($this->column_order_blocked_room[$_POST['order_blocked_room']['0']['column']],
                $_POST['order_blocked_room']['0']['dir']);
        } else
            if (isset($this->order_blocked_room)) {
                $order_blocked_room = $this->order_blocked_room;
                $this->db->order_by(key($order_blocked_room), $order_blocked_room[key($order_blocked_room)]);
            }
    }

    public function get_blocked_room()
    {
        $this->_get_query_blocked_room();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }

    
    public function count_filtered_blocked_room()
    {
        $this->_get_query_blocked_room();
        $query = $this->db->get();
        return $query->num_rows();
    }

   
    public function count_all_blocked_room()
    {
        $this->db->from($this->table_blocked_room);
        return $this->db->count_all_results();
    }
    
    public function by_id($id)
    {        
        $datasrc = $this->db->get_where('t_blocked_room', array('id' => $id));
        return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
    }
       	
       

}

/* End of file model_category_information.php */
/* Location: ./application/modules/back_office/models/model_category_information.php */
