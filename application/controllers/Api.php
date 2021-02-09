<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Api extends REST_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('api_model');
        } 

    public function index_get($id = null){
        $output = '';
        if(isset($id)){
            $output = $this->api_model->fetch_single($id);
        } else{
            $data = $this->api_model->fetch_all();
            foreach($data as $row)
					{
						$output .= '
						<tr>
							<td>'.ucfirst($row->name).'</td>
							<td>'.$row->age.'</td>
							<td>'.ucfirst($row->gender).'</td>
							<td><butto type="button" class="btn btn-warning btn-xs edit" data-id="'.$row->id.'">Edit</button></td>
							<td><button type="button" class="btn btn-danger btn-xs delete" data-id="'.$row->id.'">Delete</button></td>
						</tr>

						';
					}
        }
        $this->response($output, REST_Controller::HTTP_OK);
    }

    public function index_post(){
        $input = $this->input->post();
        $db_check_user = $this->db->get_where("users", array("name" => $input['name'], "gender" => $input['gender']));
        if ($db_check_user->num_rows()) {
            $this->response('User already exists', REST_Controller::HTTP_BAD_REQUEST);
        }else{
            $this->api_model->insert($input);
            $this->response('Data inserted successfully', REST_Controller::HTTP_OK);
        }
    }

    public function index_put($id){
        $input = $this->put();
        $input = json_decode($input['jsonData']);
        $this->db->update('users', $input, array('id'=>$id));
        $this->response('Data updated successfully', REST_Controller::HTTP_OK);
    }

    public function index_delete($id){
        $this->api_model->delete($id);
        $this->response('Data deleted successfully', REST_Controller::HTTP_OK);
    }
    
    //user login check
    public function login_post(){
        
        if($this->api_model->user_check($input)){
            $result['success'] = true;                
            $result['message'] = 'User Logged in';
            $this->response($result, REST_Controller::HTTP_OK);
        } else{
            $error = $this->db->error();
            $result['success'] = false;
            $result['error'] = $error['message'];
            $this->response($result, REST_Controller::HTTP_BAD_REQUEST);                
        }
    }


    
                
}