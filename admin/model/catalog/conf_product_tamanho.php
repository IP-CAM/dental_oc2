<?php 
class ModelCatalogConfProductTamanho extends Model {
    
	public function addTamanho($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "conf_product_tamanho SET value = '" . $data['name']."'");

		$conf_arcade = $this->db->getLastId();

		
	}

	public function editTamanho($conf_arcade_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "conf_product_tamanho SET value = '" . $data['name']."' WHERE id = '" . (int)$conf_arcade_id . "'");

		
	}

	public function deleteTamanho($conf_arcade_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "conf_product_tamanho WHERE id = '" . (int)$conf_arcade_id . "'");
		
	}

	public function getTamanho($conf_arcade_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . " conf_product_tamanho WHERE id = '" . (int)$conf_arcade_id);

		return $query->row;
	}

	public function getTamanhoes($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "conf_product_tamanho ad  WHERE id<>'' ";

		if (!empty($data['filter_value'])) {
			$sql .= " AND ad.value LIKE '" . $this->db->escape($data['filter_value']) . "%'";
		}

		

		$sort_data = array(
			'ad.value',
			//'a.sort_order'
		);	

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY  ad.value";	
		}	

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}				

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}	

		$query = $this->db->query($sql);

		return $query->rows;
	}


	public function getTotalTamanho() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "conf_product_tamanho");

		return $query->row['total'];
	}	

			
}
?>