<?php

class ModelAccountMailchimp extends Model {

    public function test() {
        $res_mail_list = $this->db->query("Select value FROM " . DB_PREFIX . "setting as t WHERE t.key IN('config_mail_chimp')");
        $res_mail_key = $this->db->query("Select value FROM " . DB_PREFIX . "setting as t WHERE t.key IN('config_mail_chimp_key')");
        $res_mail_list = $res_mail_list->row['value'];
        $res_mail_key = $res_mail_key->row['value'];

        require_once getcwd() . '/system/library/MailChimp/SubScriptMailChimp.php';
        
        $mailchimp = SubScriptMailChimp::getInstance($res_mail_key);

       



        $list = $mailchimp->getList($res_mail_list);

        $data['payment_profession_type'] = 'Dentista';
        $data['payment_profession_atuacao'] = 'Dentística,Endodontia,Ortodondia';
        $email = 'itsgeniusstar@gmail.com';

        if (!empty($list['data'])) {
            if (!empty($data['payment_profession_type'])) {
                $add_group = array("name" => $data['payment_profession_type']);

                $groups = $mailchimp->addGroup($list['data']['id'], $add_group);
                $sytem_groups = array();
                $notes = '';
                if (!empty($data['payment_profession_atuacao'])) {
                    $notes = utf8_decode($data['payment_profession_atuacao']);
                    $children = explode(',', $data['payment_profession_atuacao']);
                    foreach ($children as $child) {

                        $add_group = array("name" => $child);
                        $child_group = $mailchimp->addGroup($list['data']['id'], $add_group);
                        $sytem_groups[] = $child_group;
                    }
                }

               


                //$mailchimp->add_batch_subscribers($list['data']['id'], $this->customer->getEmail(), $groups['data'], $this->customer);
                $res = $mailchimp->add_batch_subscribers($list['data']['id'], $email, $groups['data'], $this->customer, $notes,$sytem_groups);

                
            }
        }
    }

}
