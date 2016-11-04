<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_room extends CI_Model
{
    private $table_room = 'm_room';
    private $column_order_room = array('m_room.name_room');            
    private $order_room = array('m_room.name_room' => 'desc');    


    public function _get_query_room()
    {
        $this->db->select('id_room, name_room, quota');
        $this->db->from($this->table_room);
        if (isset($_POST['order_room'])) {
            $this->db->order_by($this->column_order_room[$_POST['order_room']['0']['column']],
                $_POST['order_room']['0']['dir']);
        } else
            if (isset($this->order_room)) {
                $order_room = $this->order_room;
                $this->db->order_by(key($order_room), $order_room[key($order_room)]);
            }
    }

    public function get_room()
    {
        $this->_get_query_room();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    
    public function count_filtered_room()
    {
        $this->_get_query_room();
        $query = $this->db->get();
        return $query->num_rows();
    }

   
    public function count_all_room()
    {
        $this->db->from($this->table_room);
        return $this->db->count_all_results();
    }
    
    public function by_id($id)
    {        
        $datasrc = $this->db->get_where('m_room', array('id_room' => $id));
        return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
    }
       

}

/* End of file model_category_information.php */
/* Location: ./application/modules/back_office/models/model_category_information.php */
