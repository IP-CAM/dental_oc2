<?php

/*
 * Purpose of this class to use Mail chimp
 * library add groups and subggroups
 * and subscribers  
 */
require_once 'Mailchimp/Mailchimp.php';

class SubScriptMailChimp {

    private $constr, $mc;

    private function SubScriptMailChimp() {
        
    }

    public function getInstance() {
        if (empty($this->constr)) {
            $this->mc = new Mailchimp();

            $this->constr = new SubScriptMailChimp();
        }
    }

    /**
     * 
     * @param type $list_name
     */
    public function getList($list_name) {
        $res = array();
        try {
            $list = $this->mc->lists->getList(array("list_name" => $list_name));

            if (!empty($list['data']) && !empty($list['data'][0])) {
                $res['data'] = $list['data'][0];
                $res['code'] = '200';
            } else {
                $res['code'] = '400';
                $res['data'] = null;
            }

            return $res;
        } catch (Exception $e) {
            $res['code'] = '500';
            $res['errors'] = array($e->getMessage());
            $res['type'] = 'exception';
            return $res;
        }
    }

    /*
     * Groups
     * 
     */

    public function getListGroups($list_id) {
        $res = array();
        try {
            if ($data = $mc->lists->interestGroupings($list_id)) {
                $res['data'] = $data;
                $res['code'] = '200';
            } else {
                $res['code'] = '400';
                $res['data'] = null;
            }
        } catch (Exception $e) {
            $res['code'] = '500';
            $res['errors'] = array($e->getMessage());
            $res['type'] = 'exception';
            return $res;
        }
    }

    /**
     * 
     * @param type $list_id
     * @param type $add_group
     *      -name
     *      -children = array("A","B")
     */
    public function addGroup($list_id, $add_group = array()) {
        $res = array();
        try {
            $group = $this->find_group_by_($list_id, $add_group['name'], true);
            if (empty($group)) {
                $data = $mc->lists->interestGroupingAdd($list_id, $add_group['name'], 'radio', $add_group['children']);

                if (!empty($data['id'])) {
                    $group = $this->find_group_by_($list_id, $data['id'], false);
                    $res['data'] = $group;
                    $res['code'] = '200';
                } else {
                    $res['code'] = '400';
                    $res['data'] = null;
                }
            } else {
                $res['data'] = $group;
                $res['code'] = '200';
            }
            return $res;
        } catch (Exception $ex) {
            $res['code'] = '500';
            $res['errors'] = array($e->getMessage());
            $res['type'] = 'exception';
            return $res;
        }
    }

    /**
     * 
     * @param type $list_id
     * @param type $group
     * @param type $by_name
     * @return type
     */
    public function find_group_by_($list_id, $group, $by_name = true) {
        $groups = $this->getListGroups($list_id);

        if (!empty($groups['data'])) {
            foreach ($groups['data'] as $group) {

                if ($by_name == true && $group['name'] == $group) {
                    return $group;
                    break;
                } else if ($by_name == false && $group['id'] == $group) {
                    return $group;
                    break;
                }
            }
        }
        return array();
    }

    /*
     * 
     */

    public function add_batch_subscribers($list_id, $email, $group, $sub_groups) {
        try {
            $batch[] = array('email' => array('email' => $email));
             $this->lists->batchSubscribe($list_id, $batch);

            $emails = array('email' => $email);
            $merge_vars = array(
                'GROUPINGS' => array(
                    array(
                        'id' => (int) $group[0]['id'],
                        'groups' => $sub_groups
                    )
                )
            );
            $mc->lists->subscribe($list_id, $emails, $merge_vars, 'html', true, true);
        
            $res['code'] = '200';
            $res['msg'] = 'success';
        } catch (Exception $ex) {
            $res['code'] = '500';
            $res['errors'] = array($e->getMessage());
            $res['type'] = 'exception';
            return $res;
            
        }
    }

}
