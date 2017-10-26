<?php
/**
 * Description of User_model
 *
 * @author Marketing1
 */
class Guest_model extends MY_Model{
    //put your code here
    ##***************************{{CONSTRUCTOR}}*****************************##
    public function __construct() {
        parent::__construct();
    }
    ##***************************{{VARIABLES}}*****************************##
    protected $_table_name='homes';
    ##****************************{{GET HOMES BY CATEGORY}}********************************************##
    public function home_detail($id) {
        $where['id']=$id;
        return $this->get_by($where,true);
    }

    ##***************************{{SEND MSG TO USER}}*****************************##
    public function contact($data){
        $this->_table_name='contacts';
        $result=  $this->save($data);
        if($result){
            echo 'پیام شما با موفقیت ثبت شد.';
        }
        else{
            echo 'در ثبت پیام شما مشکلی بوجود آمده است.';
        }
    }
##***************************{{GET HOMES BY CONDITION}}*****************************##
public function get_homes($conditions,$offset=0,$limit=33){
        $this->_order_by='special,id';
        $this->_limit_offset=$offset*$limit;
        $this->_limit_number=$limit;
        //$this->_order_by='id';
        $this->_limit_number=$limit;
        //return $conditons;
        $homes=$this->get_by($conditions);
        return $homes;
}

   ##***************************{{CHECK USER}}*****************************##
    public function check_user($username,$password){
        $this->_table_name='users';
        $where=array('email'=>$username,'password'=>$password);
       $user= $this->get_by($where, TRUE);
      //print_r($user);
       return $user;
    }
     ##***************{{LIST USER BY GROUP & CONDITION}}**********************##
     
    public function list_user($where,$offset=0,$limit=24){
        $this->_table_name='users';
        $this->_order_by='special,id';
        $this->_limit_offset=$offset*$limit;
        $this->_limit_number=$limit;
        $user=$this->get_by($where);
        return $user;
    }
    ##***************{{TOP USERS BY THERE'S GROUP-->USER/ADMIN/REALTOR/AGENT/...}}**********************##
    public function top_users($group='مشاور املاک',$limit=5) {
        $this->_table_name='users';
        $where['group']=$group;
        $this->_order_by='special,id';
        $this->_limit_number=$limit;
        $user=$this->get_by($where);
        return $user;
    }
    ##****************************{{GET USER BY ID}}********************************************##
    public function user_detail($id) {
        $this->_table_name='users';
        $where['id']=$id;
        return $this->get_by($where,true);
    }
    ##***************************{{POINT USER}}*****************************##
    public function point($point,$user_id){
        $this->_table_name='users';
        //$this->_table_name='user';
        if($point=='like'){
        $this->update_one('likes','likes+1',$user_id,FALSE);
        }
        else{
          $this->update_one('unlikes','unlikes+1',$user_id,FALSE);  
        }
    }
    ##***************************{{ADD/EDIT USER}}*****************************##
    public function add_user($user,$id=false){
        $this->_table_name='users';
       $user= $this->save($user, $id);
       return $user;
    }
    
    ##***************************{{END OF CLASS}}*****************************##
}//END OF CLASS ADVERTISMENT_MODEL