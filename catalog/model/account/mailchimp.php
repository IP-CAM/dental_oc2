<?php

class ModelAccountMailchimp extends Model {

    public function test() {
        $res_mail_list = $this->db->query("Select value FROM " . DB_PREFIX . "setting as t WHERE t.key IN('config_mail_chimp')");
        $res_mail_key = $this->db->query("Select value FROM " . DB_PREFIX . "setting as t WHERE t.key IN('config_mail_chimp_key')");
        $res_mail_list = $res_mail_list->row['value'];
        $res_mail_key = $res_mail_key->row['value'];

        require_once getcwd() . '/system/library/MailChimp/SubScriptMailChimp.php';

        $mailchimp = SubScriptMailChimp::getInstance($res_mail_key);


        $data['payment_profession_type'] = 'Dentista';
        $data['payment_profession_atuacao'] = 'Clinica,Dentistica,Endodontia,Periodontia';
        $email = 'itsgeniusstar@gmail.com';


        if (!empty($data['payment_profession_type'])) {

            $list_id = $mailchimp->getPreparedListName($data['payment_profession_type']);

            $add_group = array("name" => $data['payment_profession_type']);

            $groups = $mailchimp->addGroup($list_id, $add_group);

            print_r($groups);

            $sytem_child_groups = array();
            $notes = '';
            if (!empty($data['payment_profession_atuacao'])) {
                $notes = ($data['payment_profession_atuacao']);
                $children = explode(',', $data['payment_profession_atuacao']);
                foreach ($children as $child) {

                    $add_group = array("name" => $child);
                    $child_group = $mailchimp->addGroup($list_id, $add_group);
                    $sytem_child_groups[] = $child_group;
                }
            }

            print_r($sytem_child_groups);
            //$mailchimp->add_batch_subscribers($list_id, $this->customer->getEmail(), $groups['data'], $this->customer);
            $res = $mailchimp->add_batch_subscribers($list_id, $email, $groups['data'], $this->customer, $notes, $sytem_child_groups);
        }
    }

}
