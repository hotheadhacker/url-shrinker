<?php 
   class IndexController extends CI_Controller {
  
      public function index() { 
         $this->load->helper('url');
         $this->load->helper('form');
         $this->load->library('form_validation');
         $this->load->view('includes/header');
         // $this->codeGenerator(25);
         $this->load->view('index_page');
         $this->form_validation->set_rules('urlField', 'Url', 'required');
         if ($this->form_validation->run() == FALSE)
                {
                  $this->load->view('includes/form');
                }
                else
                {
                  //  setting DB ready
                  $data = array(
                     'url'=>$this->input->post('urlField'),
                     'code'=>rand(1, 999),
                     'added_by'=> 'Salman'
                 );
             
                 $this->db->insert('urls',$data);
                 $last_id = $this->db->insert_id();
                 $code = $this->codeGenerator($last_id);
                 $this->db->where('id', $last_id);
                 $this->db->update('urls', array('code' => $code));
                 
                 $data['url'] = $code;
                  $this->load->view('includes/result', $data);
                }
         $this->load->view('includes/footer');
      } 

      // Algo that generates unique number from id of php 
      // Algo V1.0 by salman qureshi (@hotheadhacker) date 08/11/2021
      // TODO: Future add timestamp base uniqueness too 
      public function codeGenerator($id){
         // for len 6

         //Step 1: Get Base64
         $code = base64_encode($id);
         

         //Step 2: Strip '==' if present
         $codeStripped = str_replace('=', '', $code);

         //Step 3: Compare if string has been stripped and if present convert to ASCII to reduce the code length
         if($code !== $codeStripped){
            $rand = rand(65,122);
            if($rand >90 && $rand <97){ //to ignore non url characters
               $ascii = $rand;
            }else{
               $ascii = chr($rand);
            }

            $code = $codeStripped. $ascii;

         }else{ //no '=' signs present
            $code = $codeStripped;
         }

         //Step 4: Shuffle Characters
         $code = str_shuffle($code);

         //Step 5: If length if > 6 we will trim it, to make code shorter
         if(strlen($code > 6)){
            $code = substr($code,0,6);
         }

         //Step 6: Convert Mix Random Case
         for ($i=0, $c=strlen($code); $i<$c; $i++)
         $code[$i] = (rand(0, 100) > 50
         ? strtoupper($code[$i])
         : strtolower($code[$i]));



         //Step 7: Shuffle again Characters to increase uniquenes
         $code = str_shuffle($code);

         //Done and Return
         return $code;
         
        
      }
   } 
?>