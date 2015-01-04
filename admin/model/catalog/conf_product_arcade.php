<?php

class ModelCatalogConfProductArcade extends Model {

    public function addArcade($data) {
        $columns [] = "value = '" . $data['name'] . "'";
        foreach($this->getLanguages() as $key=>$column){
            $columns [] = $column." = '" . $data['name_'.$key]. "'";
        }
        
        $this->db->query("INSERT INTO " . DB_PREFIX . "conf_product_arcade SET ".implode($columns,","));

        $conf_arcade = $this->db->getLastId();
    }

    public function editArcade($conf_arcade_id, $data) {
        $columns [] = "value = '" . $data['name'] . "'";
        foreach($this->getLanguages() as $key=>$column){
            $columns [] = $column." = '" . $data['name_'.$key]. "'";
        }
        $this->db->query("UPDATE " . DB_PREFIX . "conf_product_arcade SET ".implode($columns,",")." WHERE id = '" . (int) $conf_arcade_id . "'");
    }

    public function deleteArcade($conf_arcade_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "conf_product_arcade WHERE id = '" . (int) $conf_arcade_id . "'");
    }

    public function getArcade($conf_arcade_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "conf_product_arcade WHERE id = " . (int) $conf_arcade_id);

        return $query->row;
    }

    public function getArcades($data = array()) {
        $sql = "SELECT * FROM " . DB_PREFIX . "conf_product_arcade ad  WHERE id<>'' ";

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

            $sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTotalArcade() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "conf_product_arcade");

        return $query->row['total'];
    }

    protected function getLanguages() {
        $res = $this->db->query("Select * FROM " . DB_PREFIX . "language WHERE code <>'en'");
        $array = array();
        foreach ($res->rows as $row) {
            $array[$row['code']] = "value_" . $row['code'];
        }
        return $array;
    }

}

?>