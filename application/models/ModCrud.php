<?php

/**
 * Created by PhpStorm.
 * User: Shehzad
 * Date: 11/25/2017
 * Time: 4:08 PM
 */
class ModCrud extends CI_Model
{
    public function addNewUser($data)
    {
        //return
            $this->db->insert('students',$data);
            return $this->db->insert_id();
    }

    public function getAllRecords(){
        $this->db->order_by('stId','desc');
        return $this->db->get('students');
    }

    public function getLastRecord($stId)
    {
        return $this->db->get_where('students',array('stId'=>$stId))
            ->result_array();

    }

    public function checkUser($data)
    {
       return  $this->db->get_where('students',$data)
           ->result_array();
    }
    public function update($data,$id){
        $this->db->where('stId',$id);
       return $this->db->update('students',$data);
    }

    public function delete($id)
    {
        $this->db->where('stId',$id);
       return  $this->db->delete('students');
    }
}