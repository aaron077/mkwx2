<?php
	class Bar_model extends CI_Model {
		public function __construct()
		{
			$this->load->database();
		}

		public function get_barinfo($bar_id)
		{
			$query = $this->db->get_where('bar', array('bar_id' => $bar_id));
			if($this->db->affected_rows() > 0)
			{
				return $query->row_array();
			}
			return null;
		}

		public function query_all_bars()
		{
			$query = $this->db->query('select * from `bar`');
			return $query->row_array();
		}
	}
?>