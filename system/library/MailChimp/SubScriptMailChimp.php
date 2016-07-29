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

    public static function getInstance($key = '8a5ff2864ed57767856a4b4579a7424a-us10') {
        if (empty(self::$constr)) {
            self::$mc = new Mailchimp($key);
            self::$constr = new SubScriptMailChimp();
        }

        return self::$constr;
    }

    /**
     * get already prepared list
     */
    public function getPreparedList() {
        return array(
            "Dentista" => "363969f8e1",
            "Tecnico em Protese" => "4ed6814bb9",
            "Academico" => "a44debd02e",
        );
    }

    /**
     * 
     * @param type $list_name
     * @return type
     */
    public function getPreparedListName($list_name) {
        $lists = $this->getPreparedList();
        return $lists[$list_name];
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

    /**
     * 
     * @param type $list_id
     * @return string
     */
    public function getListById($list_id) {
        $res = array();
        try {
            $list = self::$mc->lists->getList(array("list_id	" => $list_id));

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



                $data = self::$mc->lists->interestGroupingAdd($list_id, $add_group['name'], 'radio', array($add_group['name']));

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
        /*
          echo "<pre>";
          echo "<br>- Groups List------<br>";
          print_r($groups);
          echo "</pre>";
          echo "<br>- Emd Groups List------<br>";
         */
        if (!empty($groups['data'])) {
            foreach ($groups['data'] as $group) {
                $group['name'] = ($group['name']);
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

    public function add_batch_subscribers($list_id, $email, $group, $customer = '', $notes = '', $childGroups = array(), $login = true) {
        try {
//            $batch[] = array('email' => array('email' => $email));
//            self::$mc->lists->batchSubscribe($list_id, $batch);

            $sub_groups = array();
            foreach ($group['groups'] as $sub_group) {
                $sub_groups[] = ($sub_group['name']);
            }

            $emails = array('email' => $email);
            $merge_vars = array(
                'GROUPINGS' => array(
//                    array(
//                        'id' => (int) $group['id'],
//                    //'groups' => $sub_groups
//                    ),
                ), 'FNAME' => 'Not given', 'LNAME' => 'Not given',
            );
            //adding child group
            if (!empty($childGroups)) {
                foreach ($childGroups as $childGroup) {
                    if (!empty($childGroup['data'])) {
                        $merge_vars['GROUPINGS'][] = array(
                            'id' => (int) $childGroup['data']['id'],
                                //'groups' => $sub_groups
                        );
                    }
                }
            }

            if (!empty($customer) && $login) {
                $merge_vars['FNAME'] = $customer->getFirstName();
                $merge_vars['LNAME'] = $customer->getLastName();
            } else {
                $merge_vars['FNAME'] = $customer['firstname'];
                $merge_vars['LNAME'] = $customer['lastname'];
            }
            if (!empty($notes)) {
//                $merge_vars['mc_notes'] = array(
//                    'note' => $notes,
//                    'action' => "append",
//                    
//                );
                //$merge_vars['DROPDOWN'] = $notes;
            }


//            echo "<pre>";
//            print_r($childGroups);
//            print_r($merge_vars);
//            print_r($emails);
//            die;
            $result = self::$mc->lists->subscribe($list_id, $emails, $merge_vars, 'html', true, true);

//            print_r($result);
//            echo "</pre>";

            $res['code'] = '200';
            $res['msg'] = 'success';
            $res['data'] = $result;
        } catch (Exception $ex) {
            $res['code'] = '500';
            $res['errors'] = array($ex->getMessage());
            $res['type'] = 'exception';
            return $res;
        }
    }

    public function add_batch_subscribers_with_groups($list_id, $email, $groups, $customer = array()) {
        try {
            echo "<pre>";
            $emails = array('email' => $email);
            $merge_vars = array(
                'GROUPINGS' => array(
                ), 'FNAME' => 'Not given', 'LNAME' => 'Not given',
            );
            //adding child group
            if (!empty($groups)) {
                foreach ($groups as $group_name) {

                    $childGroup = $this->find_group_by_($list_id, $group_name, true);
                    //rint_r($childGroup);
                    $merge_vars['GROUPINGS'][] = array(
                        'id' => (int) $childGroup['id'],
//                        'id' => (int) $childGroup['data']['id'],
                            'groups' => array($group_name),
//                            'groups' => array($childGroup['groups'][0]['id']),
                    );
                }
            }

            if (!empty($customer) && isset($login) && !is_array($customer)) {
                $merge_vars['FNAME'] = $customer->getFirstName();
                $merge_vars['LNAME'] = $customer->getLastName();
            } else {
                $merge_vars['FNAME'] = $customer['firstname'];
                $merge_vars['LNAME'] = $customer['lastname'];
            }



            //print_r($groups);
            print_r($merge_vars);
            print_r($emails);
            
            $result = self::$mc->lists->subscribe($list_id, $emails, $merge_vars, 'html', true, true);
            echo "---------";    
            print_r($result);
            echo "</pre>";
die;
            $res['code'] = '200';
            $res['msg'] = 'success';
            $res['data'] = $result;
        } catch (Exception $ex) {
            $res['code'] = '500';
            $res['errors'] = array($ex->getMessage());
            $res['type'] = 'exception';
            print_r($res);
            return $res;
        }
    }

}
