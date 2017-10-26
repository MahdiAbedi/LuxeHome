<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Mahdi Abedi Cordlar
 * Date: 9/26/2016
 * Time: 3:31 PM
 */
class MY_Model extends CI_Model{
    /*
     * CLASS VARIABLES
     */
    protected $_table_name;
   // protected $_primary_key='id';
    protected $_col_name='id';
    protected $_timestamps=FALSE;
    protected $_order_by='id';
    
    /*
     * IF WE DESCRIBE $_limit_offset AS PRIVATE OR PROTECTED
     * WE CANNOT ASSIGN A VALUE TO IT FROM CONTROLLER
     * BECAUSE CONTROLLER DOES NOT INHERIT FROM THE MODEL
     */
    public $_limit_offset=0;
    public $_limit_number=25;
    public $_order_set='DESC';
    /*
     * CONSTRUCTOR OF BASE MODEL
     */
    public function __construct(){
        parent::__construct();
        //$this->load->library('security');
        //!!!SET PREFIX FOR ALL TABLES GOLOBALLY
       // $this->db->set_dbprefix('tyz_');
    }

##***************************{{GET FUNCTION}}*****************************##
    public function get_by($conditions='',$single_row=FALSE){
        $conditions = $this->security->xss_clean($conditions);
        /**
         * some times we want to get rows but select where so we have to
         * clear which "where" is for single row and which one is for
         * "result" one
         **/
        
          //  $this->db->where($this->_col_name,$col_value);
        
        //single row
        if($single_row){
            $method='row';
        }//all rows
        else{$method='result';}
        //LIMIT & OFFSET
        /*
         *  return only 10 records, start on record 16 (OFFSET 15)":
         *  $sql = "SELECT * FROM Orders LIMIT 10 OFFSET 15";
         */
        //SET WHERE CONDITIONS
        if(count($conditions)>0 && $conditions!=''){
            $this->db->where($conditions);
        }
        $this->db->limit($this->_limit_number,  $this->_limit_offset);
        //order_by
        $this->db->order_by($this->_order_by,  $this->_order_set);
        //return result/results
        $result=$this->db->get($this->_table_name)->$method();
       // print_r($user);
        return $result;
        
        $result->free_result();// The $user result object will no longer be available

    }//end of get function

##***************************{{SAVE FUNCTION}}*****************************##
    public function save($data=array()){
        $data = $this->security->xss_clean($data);
        //  INSERT       
            $this->db->set($data);
            $this->db->insert($this->_table_name);
          //$this->db->insert_string($this->_table_name, $data);
            $id=$this->db->insert_id(); 
            return $id;
            $result->free_result();// The $user result object will no longer be available
    }
##***************************{{UPDATE FUNCTION}}*****************************##
    public function update($data,$id){
        $data = $this->security->xss_clean($data);
        $this->db->set($data);
        $this->db->where('id',$id);
       if($this->db->update($this->_table_name)){ 
           return TRUE;
           }else{
               return false;
           }
           $result->free_result();// The $user result object will no longer be available
    }
##***************************{{UPDATE FUNCTION}}*****************************##
    public function update_one($fieldname,$fieldvalue,$id,$true=false){
        $this->db->set($fieldname,$fieldvalue,$true);
        $this->db->where('id',$id);
       if($this->db->update($this->_table_name)){ 
           return TRUE;
           }else{
               return false;
           }
           $result->free_result();// The $user result object will no longer be available
    }
##***************************{{DELETE FUNCTION}}*****************************##

    public function delete($col_value,$all_col=FALSE){
        //CHECK THERE MUST BE A VALUE
        if(!$col_value){return FALSE;}

        $this->db->where($this->_col_name,$col_value);
        if(!$all_col){
            //DELETE SINGLE VALUE
            $this->db->limit(1);
        }

        return $this->db->delete($this->_table_name);
        $result->free_result();// The $user result object will no longer be available
    }//END OF DELETE FUNCTION

##***************************{{END OF CLASS}}*****************************##
}//end of MY_Curl Calss



