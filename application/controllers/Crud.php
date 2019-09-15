<?php

/**
 * Created by PhpStorm.
 * User: Shehzad
 * Date: 11/25/2017
 * Time: 4:11 PM
 */
class Crud extends CI_Controller
{
    public function index(){
        $data['allRecords'] =  $this->modCrud->getAllRecords();
        $this->load->view('home',$data);
    }

    public function addUser()
    {
        if (!$this->input->is_ajax_request()){
           $this->session->set_flashdata('error','Please call the Ajax request.');
           redirect('crud');

        }
        else{
            $data['stName'] =   $this->input->post('name',true);
            $data['stEmail'] = $this->input->post('email',true);
            $data['stPassword'] = $this->input->post('password',true);
            $data['stDate'] = date('Y-m-d h:i:sa');
            $returnYpte = $this->modCrud->addNewUser($data);
            if (is_integer($returnYpte)){
                //echo $returnYpte;
                $lastRecord = $this->modCrud->getLastRecord($returnYpte);
                if (count($lastRecord) === 1){
                    $another['stId'] = $lastRecord[0]['stId'] ;
                    $another['stName'] = $lastRecord[0]['stName'] ;
                    $another['enId'] = $this->encryption->encrypt($lastRecord[0]['stId']);
                    $another['stDate'] = $lastRecord[0]['stDate'] ;
                    $another['stEmail'] = $lastRecord[0]['stEmail'] ;
                    echo json_encode($another);
                }
                else{
                    echo 'not works';
                }

                ///echo 'You have successfully added you student.';
            }
            else{
                echo 'You can\'t add your user right now please try again.';
            }
        }
    }

    public function checkUser()
    {
        if (!$this->input->is_ajax_request()){
            echo 'redirect here';
        }
        else{
            $data['stId'] = $this->input->post('text',true);
            $data['stId'] = $this->encryption->decrypt($data['stId']);
            $myresult = $this->modCrud->checkUser($data);
            if (count($myresult) === 1){
                echo json_encode($myresult);
            }
            else{
                echo 'not found..';
            }

        }
    }

    public function update()
    {
        if (!$this->input->is_ajax_request()){
            echo 'print here';
        }
        else{
            $data['stName'] = $this->input->post('dyName',true);
            $data['stEmail'] = $this->input->post('dyEmail',true);
            $data['stPassword'] = $this->input->post('dyPassword',true);
            $id = $this->input->post('id',true);
            if (
                    empty($data['stName']) || empty($data['stEmail']) ||
                    empty($data['stPassword']) || empty($id)
            )
            {
                echo 'please check the required fields.';
            }
            else{
                $myreturn = $this->modCrud->update($data,$id);
                if ($myreturn){
                    echo TRUE;
                }
                else{
                    echo FALSE;
                }
            }


        }
    }

    public function delete()
    {
        if (!$this->input->is_ajax_request()){
            echo 'redirect error here';
        }
        else{
            $id = $this->input->post('text',true);
            if (!empty($id)){
                $id = $this->encryption->decrypt($id);
                $returnType = $this->modCrud->delete($id);
                if ($returnType){
                    echo TRUE;
                }
                else{
                    echo 'we can\'t delete your record right now.';
                }

            }
            else{
                echo 'error here';
            }

        }
    }
}