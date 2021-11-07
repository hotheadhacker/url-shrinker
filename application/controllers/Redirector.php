<?php 
   class Redirector extends CI_Controller {
  
      public function index() { 
        $this->load->helper('url');
        $code =  $this->uri->uri_string;
        $code= trim($code);
        $code= stripslashes($code);
        $val1 = $this->db->escape($code);

        //get data from db
        $this->db->select('*');
        $this->db->where('code',$code);
        $query = $this->db->get('urls');
        $data = $query->row();
        if(isset($data->url)){
            // update view count 
            $count = $data->viewed + 1;
            $this->db->where('code', $code);
            $this->db->update('urls', array('viewed' => $count));
            //redirect
            redirect($data->url,"refresh");
        }else{
            $this->load->view('includes/header');
            $this->load->view('includes/notFound');
            $this->load->view('includes/footer');

        }
      }
    }