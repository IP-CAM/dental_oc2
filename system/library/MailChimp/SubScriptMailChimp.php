<?php

/*
 * Purpose of this class to use Mail chimp
 * library add groups and subggroups
 * and subscribers  
 */
require_once 'Mailchimp.php';

class SubScriptMailChimp {

    private static $constr;
    private static $mc;

    private function SubScriptMailChimp() {
        
    }

    public static function getInstance() {
        if (empty(self::$constr)) {
            self::$mc = new Mailchimp("8a5ff2864ed57767856a4b4579a7424a-us10");
            self::$constr = new SubScriptMailChimp();
        }

        return self::$constr;
    }

    /**
     * 
     * @param type $list_name
     */
    public function getList($list_name) {
        $res = array();
        try {
            $list = self::$mc->lists->getList(array("list_name" => $list_name));

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
            if ($data = self::$mc->lists->interestGroupings($list_id)) {
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
        return $res;
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
                $data = self::$mc->lists->interestGroupingAdd($list_id, $add_group['name'], 'radio', $add_group['children']);

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
            $res['errors'] = array($ex->getMessage());
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
    public function find_group_by_($list_id, $group_name, $by_name = true) {
        $groups = $this->getListGroups($list_id);
        
        
        if (!empty($groups['data'])) {
            foreach ($groups['data'] as $group) {

                if ($by_name == true && $group['name'] == $group_name) {
                    return $group;
                    break;
                } else if ($by_name == false && $group['id'] == $group_name) {
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

    public function add_batch_subscribers($list_id, $email, $group) {
        try {
            $batch[] = array('email' => array('email' => $email));
            self::$mc->lists->batchSubscribe($list_id, $batch);
            
            $sub_groups = array();
            foreach($group['groups'] as $sub_group){
                $sub_groups[] = $sub_group['name'];
            }
            
            $emails = array('email' => $email);
            $merge_vars = array(
                'GROUPINGS' => array(
                    array(
                        'id' => (int) $group['id'],
                        'groups' => $sub_groups
                    )
                )
            );
        
            $result = self::$mc->lists->subscribe($list_id, $emails, $merge_vars, 'html', true, true);
         
            
            $res['code'] = '200';
            $res['msg'] = 'success';
        } catch (Exception $ex) {
            $res['code'] = '500';
            $res['errors'] = array($ex->getMessage());
            $res['type'] = 'exception';
            return $res;
        }
    }

}
