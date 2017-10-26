<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("../application/libraries/pasargad/RSAProcessor.class.php"); 
require_once("../application/libraries/pasargad/parser.php");

class Guest extends CI_Controller {

        public $limit_number=42;
    
        private $merchantCode = 709633; // كد پذيرنده
        private $terminalCode = 710368; // كد ترمينال
        private $action = "1003"; 	// 1003 : براي درخواست خريد  
        private $redirectAddress;
        private $amount; // مبلغ فاكتور
        private $invoiceNumber;
      //private $timeStamp;
        private $invoiceDate; //تاريخ فاكتور
        
    ###################### constructor #############################
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Tehran");
    }
    public function index()
    {
        #sending date for seo the page
        $data['page_title']="خانه رویایی|بهترین سایت املاک کشور";
        $data['key_words']="بهترین سایت املاک";
        $data['meta_description']="خانه رویایی بهترین سایت املاک کشور";
        $data['limit_number']=9;
        $this->load->view('front/homepage',$data);
    }

    public function contact()
    {
            #sending date for seo the page
            $data['page_title']="تماس با خانه رویایی";
            $data['key_words']="بهترین سایت املاک";
            $data['meta_description']="خانه رویایی بهترین سایت املاک کشور";
            
            $this->load->view('front/contact',$data);
        }
        
    ##***************************{{SEARCH RESULT PAGE}}*****************************##
    public function home($id=1){
        $home=  $this->guest_model->home_detail($id);
        $user=  $this->guest_model->user_detail($home->user_id);
        
        $data['user']=$user;
        $data['home']=$home;
        $data['page_title']=$home->title;
        $deal_type=array('فروش','خرید','رهن','اجاره');
        $home_type=array('آپارتمان','ویلا','مغازه','خانه');
        $city= explode(',',$home->region_id);
        if($city[2]!=''){
          $this->db->where('id',$city[2]);  
        }elseif($city[1]!=''){
          $this->db->where('id',$city[1]);
        }else{
          $this->db->where('id',$city[0]); 
        }
        $city_name=$this->db->get('regions')->row();
        foreach ($deal_type as $deal) {
            foreach ($home_type as $home) {
                $keyword.=$deal.' '.$home.' در '. $city_name->name.' , ';
            }
        }
        $data['key_words']=$keyword;
        $data['meta_description']=substr($home->description,0,50);
        
        $this->load->view('front/home_detail',$data);
    }
        
    ##***************************{{CAPTCHA CREATOR}}*****************************##
    public function captcha() {
        $cap_image=array(
            '1480315372.3628.jpg','1480315494.0126.jpg','1480315760.6157.jpg','1480315820.7166.jpg',
            '1480315878.1451.jpg','1480316531.3275.jpg','1480316625.001.jpg','1480316627.1986.jpg',
            '1480316629.4992.jpg','1480316761.4674.jpg','1480316822.8306.jpg','1480317404.3308.jpg',
            '1480317420.5799.jpg','1480317430.1631.jpg','1480317432.9451.jpg','1480317435.9051.jpg');
        $cap_value=array('5037','8767','1424','6155','2482','4165','2526','2330','7940','9588','1419','1594','3105','3921','3022','9235');
        $rand=rand(0,15);
        $this->session->set_userdata(array('captcha'=>$cap_value[$rand]));
        echo '<img src='.base_url().'assets/captcha/'.$cap_image[$rand].'?c='.rand(100,800).'width="140" height="35" style="border:0;" alt=" عبارت امنیتی">';
    }//enf of captcha
    //##***************************{{CAPTCHA CREATOR}}*****************************##
    public function captcha1() {
        $rand=rand(1000,9999);
        $this->session->set_userdata(array('captcha'=>$rand));
         $this->load->helper('captcha');
                            $vals = array(
                            'word'          => $rand,
                            'img_path'      => './captcha/',
                            'img_url'       => base_url().'captcha/',
                            'font_path'     => 'assets/css/fonts/BTitrBold.ttf',
                            'img_width'     => '100',
                            'img_height'    => 45,
                            'expiration'    => 7200,
                            'word_length'   => 10,
                            'font_size'     => 18,
                            'img_id'        => 'Imageid',
                            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

                            // White background and border, black text and red grid
                            'colors'        => array(
                                    'background' => array(255, 255, 255),
                                    'border' => array(255, 255, 255),
                                    'text' => array(0, 0, 0),
                                    'grid' => array(255, 40, 40)
                            )
                    );

                    $cap = create_captcha($vals);
                    echo $cap['image'];
    }//enf of captcha  
    
    
    ##***************************{{SEND MSG TO USER}}*****************************##
    public function contact_user($user_id){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('captcha', 'Captcha', 'required|exact_length[4]|trim|numeric|htmlspecialchars');
        
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[100]|trim|htmlspecialchars');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|max_length[100]|trim|htmlspecialchars');
        $this->form_validation->set_rules('phone', 'phone', 'required|max_length[255]|trim|numeric|htmlspecialchars');
        // $this->form_validation->set_rules('subject', 'Subject', 'required|max_length[255]|trim|htmlspecialchars');
        $this->form_validation->set_rules('message', 'Message', 'required|max_length[500]|trim|htmlspecialchars');
        if ($this->form_validation->run() == FALSE)
            {
                echo 'اطلاعات وارد شده صحیح نمیباشند.';
                print_r($this->form_validation->error_array());
            }
            else
            {
                $captcha=  $this->input->post('captcha');
               //CHECKS CAPTCA #2
                if ($captcha!=$_SESSION['captcha'])
                   {
                       echo 'عبارت امنیتی وارد شده صحیح نمیباشد';
                   }else{
                    $data['name']=  $this->input->post('name');
                    $data['email']=  $this->input->post('email');
                    $data['telephone']=  $this->input->post('phone');
                    //$data['subject']=  $this->input->post('subject');
                    $data['message']=  $this->input->post('message');
                    $data['reciever_id']=  $user_id;
                    //print_r($data);
                    $this->guest_model->contact($data);
                   }  
            }
    }
    
    ##***************************{{GET REGIONS}}*****************************##
    public function city($parent_id=0){
       
        $this->db->select('name,id');
        $this->db->from('regions');
        $this->db->where('parent_id',$parent_id);
        $query=$this->db->get();
        $options="<option value=''>انتخاب کنید</option>";
        foreach ($query->result() as $city)
        {
           $options.="<option value=".$city->id.">".$city->name."</option>"  ;   
        }
        echo $options;
    }
    ##***************************{{SEARCH RESULTS PAGE}}*****************************##
    public function search() {
       $data['page_title']="نتایج جستجو ملک در خانه رویایی";
        $region=$this->input->post('city');
        $data['region_id']=  $region[0].',';
        $shahr=$region[1];
        $mantage=$region[2];
        if(!empty($shahr)){
            $data['region_id'].=$shahr.',';
        }
        if(!empty($mantage)){
            $data['region_id'].= $mantage;
        }
        $data['limit_number']=$this->limit_number;
        $data['home_type']= $this->input->post('category');
        $data['deal_type']= $this->input->post('sell-type');
       // print_r($data);
        $this->load->view('front/search_result',$data);
    }
    ##***************************{{MORE SEARCH RESULT WIDGET}}*****************************## 
    public function more_searh_result(){
        $data['region_id']=$this->input->post('city');
        $data['limit_number']=$this->limit_number;
        $data['offset']=$this->input->post('page');
        $data['home_type']= $this->input->post('category');
        $data['deal_type']= $this->input->post('sell-type');
       // print_r($data);
     $new=$this->load->view('widgets/home_list',$data,true);
     echo $new;
}
    ##***************************{{AGENT PROFILE}}*****************************##
    public function profile($user_id=0) {
        $data['page_title']="خانه رویایی|بهترین سایت املاک کشور";
        $data['key_words']="مشاهده پروفایل کاربران خانه رویایی";
        $data['meta_description']="خانه رویایی بهترین سایت املاک کشور";
        $data['limit_number']=  $this->limit_number;
        $data['user_id']=$user_id;
        $this->load->view('front/profile',$data);
    } 
    ##***************************{{INSERT HOME ADVERTISMENTS}}*****************************##
    public function add_home(){
    
if (!$this->input->post('submit')){
    $data['page_title']="ثبت آگهی رایگان ملک،خرید و فروش آپارتمان";
    $data['key_words']="ثبت آگهی رایگان,فروش سریع آپارتمان,فروش فوری ملک,ثبت رایگان ملک";
    $data['meta_description']="خانه رویایی بهترین سایت املاک کشور";
    $this->load->view('front/add_home',$data);}
    else{#CHECKING VALIDATION INFO

        $this->load->library('form_validation');
        $this->form_validation->set_rules('captcha', 'عبارت امنیتی', 'required|min_length[4]|max_length[4]|trim|htmlspecialchars');
        $this->form_validation->set_rules('title', 'عنوان', 'required|max_length[250]|htmlspecialchars');
        $this->form_validation->set_rules('home-type', 'نوع ملک', 'required|max_length[30]|htmlspecialchars');
        $this->form_validation->set_rules('deal-type', 'نوع معامله', 'required|max_length[20]|htmlspecialchars');
        $this->form_validation->set_rules('description', 'توضحیات', 'required|max_length[500]|htmlspecialchars');
        $this->form_validation->set_rules('contact', 'اطلاعات تماس', 'required|max_length[20]|htmlspecialchars');
        $this->form_validation->set_rules('address', 'نشانی', 'required|max_length[70]|htmlspecialchars');
        $this->form_validation->set_rules('price', 'قیمت', 'max_length[70]|htmlspecialchars');
        $this->form_validation->set_rules('city', 'شهر', 'max_length[250]|htmlspecialchars');
        $this->form_validation->set_rules('image', 'تصویر', 'htmlspecialchars');
        if ($this->form_validation->run() == FALSE){
             $this->session->set_flashdata('error',validation_errors());
             redirect('newhome');
            }
            
        #CHECK CAPTCHA
        $captcha=  $this->input->post('captcha');
        if ($captcha!=$_SESSION['captcha']){
            $this->session->set_flashdata('error','عبارت امنیتی وارد شده صحیح نمی باشد');
            redirect('newhome'); 
        }//END IF
        
        #GET DATA

        $data['title']=         $this->input->post('title');
        $data['home_type']=     $this->input->post('home-type');
        $data['deal_type']=     $this->input->post('deal-type');
        $data['description']=   $this->input->post('description');
        $data['telphone']=      $this->input->post('contact');
        $data['address']=       $this->input->post('address');
        $data['price']=         $this->input->post('price');

        $data['user_id']=(isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 0;
        
        /*EXTRACT CITY NAMES*/
        $region=  $this->input->post('city');
        $data['region_id']=  $region[0].',';
        $shahr=$region[1];
        $mantage=$region[2];
        
        if(!empty($shahr))
        {
            $data['region_id'].=$shahr.',';
            if(!empty($mantage)){$data['region_id'].= $mantage;}
        }

        #############################################################               
        $insert_id=$this->guest_model->save($data);
        
        if($insert_id)
        {
            //if($_FILES['image']['size'][0]!=0){$data['image']=count($_FILES['image']['name']);}
              $filecount=count($_FILES['image']['name']);
              if($_FILES['image']['size'][0]!=0){

                      for($i = 0; $i < $filecount; $i++) {
                        $data['img_src'].=base_url().'assets/img/homes/'.$insert_id.'_'.$i.'.jpg';
                        if($i<$filecount-1){$data['img_src'].=';';}
                      }

                  $data['thumb_img_src']=base_url().'assets/img/homes_thumbs/'.$insert_id.'_0.jpg';
                  $this->guest_model->update($data,$insert_id);


                  $error=$this->upload_img($insert_id,'homes');
                  $this->session->set_flashdata('error',$error);
              }
            
        ##***************************{{INVOICE}}*****************************##
            $ads= $this->input->post('ads_price');
            if($ads)
            {
            //CHECK IF USER SELECTED ADDITIONAL SERVICES AND MUST PAY MONEY
             foreach ($ads  as $ad) {$ids.=$ad.',';}
             $ids=  rtrim($ids, ',');
             $this->db->where("id in ($ids)");
             $data['invoice_id']=$insert_id;
             $data['page_title']="پرداخت صورت حساب خانه رویایی";
             $query = $this->db->get('ads_group')->result();
             $data['query']=$query;
             foreach ($query as $value)
                 {
                     $amount+=$value->price;
                 }
             $data['total_price']=$amount;
             $data['bank']=  $this->pay($amount,$insert_id);
             
           //  echo '<pre>';
           // print_r($data['bank']);
           // echo '</pre>';
            // exit();
             $this->load->view('front/invoice',$data);
            }
            else{
                redirect(base_url().'home/'.$insert_id);
            }
        ################################################################################
        }else{
           $this->session->set_flashdata('error','خطایی روخ داده و آگهی شما ثبت نشده است');
           redirect('newhome');
        }//end if
     }//end first else
    }
    ##***************************{{LOGIN/LogOut}}*****************************##
    public function login() {
        $data['page_title']="ورود و ثبت نام در سایت خانه رویایی";
        $data['key_words']="بهترین سایت املاک";
        $data['meta_description']="خانه رویایی بهترین سایت املاک کشور";
       // $this->output->cache(24*60);
        if (!$_SESSION['logged_in']) {
            $this->load->view('front/login',$data);
        }else
        {
             session_destroy();
             redirect('login');
        }
    }//end of login/logout
    ##***************************{{CHECK USER LOGIN}}*****************************##
    public function check_user(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('captcha', 'Captcha', 'required|exact_length[4]|trim|numeric|htmlspecialchars');
        $this->form_validation->set_rules('username', 'username', 'required|max_length[30]|trim|htmlspecialchars');
        $this->form_validation->set_rules('password', 'password', 'required|max_length[40]|trim|htmlspecialchars');
       
        if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error',validation_errors());
                redirect('login');
            }
        else
            {
            //GET POSTED DATA FOR CHECKING #1
                $username=  $this->input->post('username');
                $password=  $this->input->post('password');
                $captcha=  $this->input->post('captcha');
            //CHECKS CAPTCA #2
                if ($captcha!=$_SESSION['captcha'])
                   {
                       $this->session->set_flashdata('error','عبارت امنیتی وارد شده صحیح نمی باشد');
                       redirect('login');
                   }
            //CHECK FORM VALIDATION RULES #3       
                    $user=$this->guest_model->check_user($username,$password);
                    //print_r($user);
                    if (count($user)) {
                        $_SESSION['user_id']=$user->id;
                        $_SESSION['name']=$user->name;
                        $_SESSION['email']=$user->email;
                        $_SESSION['telephone']=$user->telephone;
                        $_SESSION['logged_in']=TRUE;
                        //$this->session->set_flashdata('error','شما با موفقیت وارد سایت شدید');
                        redirect('/');
                    } else{
                        $this->session->set_flashdata('error','نام کاربری و یا رمز عبور اشتباه است');
                        redirect('login');
                    }
                    


        }
    }//end of check_user
  
    ##***************************{{INSERT NEW USERS}}*****************************##
    public function register($id=FALSE) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('captcha', 'Captcha', 'required|exact_length[4]|trim|numeric|htmlspecialchars');
                $this->form_validation->set_rules('name', 'نام و نام خانوادگی', 'required|max_length[100]|trim|htmlspecialchars');
                $this->form_validation->set_rules('email', 'ایمیل', 'valid_email|max_length[100]');
                $this->form_validation->set_rules('contact', 'شماره تماس', 'max_length[255]|htmlspecialchars');
                $this->form_validation->set_rules('password', 'رمز عبور', 'required|max_length[100]|trim|htmlspecialchars');
                $this->form_validation->set_rules('description', 'درباره من', 'max_length[255]|trim|htmlspecialchars');
                $this->form_validation->set_rules('image', 'تصویر', 'htmlspecialchars');
                $this->form_validation->set_rules('city', 'شهر', 'max_length[250]|htmlspecialchars');
                if ($this->form_validation->run() == FALSE)
                    {
                        $this->session->set_flashdata('error',  validation_errors());
                       redirect('login');
                    }
                    
                $user['name']=$this->input->post('name');
                $user['password']=$this->input->post('password');
                $user['email']=$this->input->post('email');
                //$user['ip_address']=$this->input->ip_address();
                $user['about']=$this->input->post('description');
                $user['telephone']=$this->input->post('contact');
        /*EXTRACT CITY NAMES*/
                $region=  $this->input->post('city');
                $user['region_id']=  $region[0].',';
                $shahr=$region[1];
                $mantage=$region[2];

                if(!empty($shahr))
                {
                    $user['region_id'].=$shahr.',';
                    if(!empty($mantage)){$user['region_id'].= $mantage;}
                }
         /*****************/ 
        //INSERT/UPDATE INTO DATABASE
        if (!$id){$insert_id=$this->guest_model->add_user($user);}
        else{$insert_id=$this->guest_model->add_user($user,$id);}
                    
                    if($insert_id){
                        //DO UPLOAD PROFILE IMAGE
                        $error="ثبت نام شما با موفقیت انجام شد.";
                        $error.=$this->upload_img($insert_id,'users');
                    }//END OF IF
                    else{
                        $error="ثبت نام شما با شکست مواجه شد لطفا مجددا تلاش کنید";
                    }
                    
                $this->session->set_flashdata('error',$error);
                redirect('login');
    }
    ##***************************{{UPLOAD IMAGE}}*****************************##
    public function upload_img($filename,$upload_path,$max_size=2048,$max_width=2048,$max_height=2048){
        $config['upload_path']          = './assets/img/'.$upload_path.'/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = $max_size;
        $config['max_width']            = $max_width;
        $config['max_height']           = $max_height;
       // $config['file_name']           = $filename;
       //print_r($config);
       ///exit();
        $filesCount = count($_FILES['image']['name']);
        for($i = 0; $i < $filesCount; $i++) {  
            /*
             * PLEASE NOTICE TO THIS THAT 'filename' USED HERE IS JUST A 
             * NAME AND U CAN CHANGE IT TO ANYTHING YOU WANT
             */
            $_FILES['filename']['name'] = $_FILES['image']['name'][$i];
            $_FILES['filename']['type'] = $_FILES['image']['type'][$i];
            $_FILES['filename']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
            $_FILES['filename']['error'] = $_FILES['image']['error'][$i];
            $_FILES['filename']['size'] = $_FILES['image']['size'][$i];
           // print_r($_FILES['image']);

            $config['file_name']= $filename.'_'.$i;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

                if ( !$this->upload->do_upload('filename'))
                    {
                        $this->session->set_flashdata('error','تصویری بارگزاری نشد');
                            $error = array('error' => $this->upload->display_errors());
                            echo '<pre>';
                            print_r($error);
                           echo '</pre>';
                           exit();
                    }
                    else{
                        echo 'no error in upload';
                        //$data = array('upload_data' => $this->upload->data());
                        echo 'upload shod';
                        $result = $this->upload->data();
                        $origional_image = $result['full_path'];
                        if($i==0){
                            //create thumnail images
                            $this->resize_img($origional_image,$upload_path.'_thumbs',265,170); 
                            //create list images
                        }
                        //$this->resize_img($origional_image,$upload_path,$max_width,$max_height);                            
                    }  

        }//end for
        
    } //endo of function
    ##***************************{{RESIZE IMAGE}}*****************************##
    public function resize_img($source_img,$des_path,$width,$height) {
       //echo 'resize image has loaded</br>';
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source_img;
       // $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        if($width){$config['width']         = $width;}
        if($height){ $config['height']       = $height;}
       
        $config['quality'] = '80%';
        $config['new_image'] = './assets/img/'.$des_path.'/';
        /*
         * IT IS IMPORTANT TO USE THIS ORDER:
         * LIBRARY > CLEAR > INITIALIZE > RESIZE
         */
        $this->load->library('image_lib', $config);
        $this->image_lib->clear();
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        echo $this->image_lib->display_errors();
        
    }
    ##***************************{{MY FAVORITE HOMES}}*****************************##
    public function favorite_homes() {
        if(!$_SESSION['user_id']){redirect('login');}
        else
        {
            $data['title']="املاک مورد علاقه من";
           // $data['limit_number']=42;
            $data['home_type']= $this->input->post('category');
            $data['deal_type']= $this->input->post('sell-type');
           // print_r($data);
            $this->load->view('front/search_result',$data); 
        }
        
    }
   
  ##***************************{{AGENTS LIST}}*****************************## 
    public function agents(){
    $data['page_title']="مشاهده لیست مشاوران املاک";
        $data['key_words']="مشاهده پروفایل کاربران خانه رویایی";
        $data['meta_description']="خانه رویایی بهترین سایت املاک کشور";
    
        $region=$this->input->post('city');
        $data['region_id']=  $region[0].',';
        $shahr=$region[1];
        $mantage=$region[2];
        if(!empty($shahr)){
            $data['region_id'].=$shahr.',';
        }
        if(!empty($mantage)){
            $data['region_id'].= $mantage;
        }
    $this->load->view('front/agents',$data); 
}

##***************************{{MORE SEARCH RESULT WIDGET}}*****************************## 
    public function more_agents_searh_result(){
        $data['region_id']=$this->input->post('city');
        $data['limit_number']=  $this->limit_number;
        $data['offset']=$this->input->post('page');
       // print_r($data);
     $new=$this->load->view('widgets/agents_list',$data,true);
     echo $new;
}


    ###################### DO PAYMENT #############################
    public function pay($amount,$invoiceNumber){
        //$amount= $this->input->post('amount');
        //$invoiceNumber= $this->input->post('invoiceNumber');
        $certificate="http://www.royalstate.ir/certificate.xml";
        $processor = new RSAProcessor($processor,RSAKeyType::XMLFile);
        $params['merchantCode'] = 709633; // كد پذيرنده
        $params['terminalCode'] = 710368; // كد ترمينال
        $params['amount']= $amount; // مبلغ فاكتور
        $params['redirectAddress'] = base_url()."transaction_check"; 

        //$invoiceNumber = $_GET["invoice"]; //شماره فاكتور
            $params['invoiceNumber'] = $invoiceNumber;
            $params['timeStamp']= date("Y/m/d H:i:s");
            $params['invoiceDate']=date("Y/m/d H:i:s"); //تاريخ فاكتور
            $params['action'] = "1003"; 	// 1003 : براي درخواست خريد 

            $data = "#". $params['merchantCode'] ."#". $params['terminalCode'] ."#". $params['invoiceNumber'] ."#". $params['invoiceDate'] ."#". $params['amount'] ."#". $params['redirectAddress'] ."#". $params['action'] ."#". $params['timeStamp'] ."#";
            $data = sha1($data,true);
            $data =  $processor->sign($data); // امضاي ديجيتال 
            $params['result']=base64_encode($data); // base64_encode 

            
        #SAVE TRANSACTION INFO IN TO DATABASE FOR NEXT CHASE
            $bank['amount']=$params['amount'];
            $bank['invoiceNumber']=$params['invoiceNumber'];
            $bank['invoiceDate']=$params['invoiceDate'];
            //$bank['status']=$params['action'];
            $bank['user_id']=$_SESSION['user_id'];
            $bank['BankName']='پاسارگاد';
            $bank['ip_address']=  $this->input->ip_address();
            $this->db->insert('payment',$bank);
            return $params;
    }
    ###################### CHECK TRANSACTION #############################
    public function transaction_check(){
        $fields = array('invoiceUID' => $_GET['tref'] );
        $InvoiceNumber=$_GET['iN'];
        $result = post2https($fields,'https://pep.shaparak.ir/CheckTransactionResult.aspx');
        $array = makeXMLTree($result);
        echo '<pre>';
        echo 'transaction:</br>';
        print_r($array);
        echo '</pre>';
        if($array["resultObj"]["result"]==TRUE){
            echo 'تراکنش با موفقیت انجام شد و منتظر تایید میباشد';
            $this->verify($InvoiceNumber);
            echo 'InvoiceNumber='.$InvoiceNumber;
        }else{
            echo 'تراکنش با مشکل مواجه شده است لطفا مجددا اقدام نمایید';
            echo 'وجه پرداخت شده توسط بانک تا 20 دقیقه دیگر به حساب شما باز خواهد گشت';
        }
       
    }
    ###################### VERIFY TRANSACTION #############################
    public function verify($InvoiceNumber=909176){
        $bank=  $this->db->where('InvoiceNumber',$InvoiceNumber)->get('payment')->result();
        //print_r($bank);
	$fields = array(
                    'MerchantCode' => $this->merchantCode, 			//shomare ye moshtari e shoma.
                    'TerminalCode' => $this->terminalCode, 			//shomare ye terminal e shoma.
                    'InvoiceNumber' => $bank[0]->invoiceNumber,  	//shomare ye factor tarakonesh.
                    'InvoiceDate' => $bank[0]->invoiceDate,         //tarikh e tarakonesh.
                    'amount' => $bank[0]->amount,                   //mablagh e tarakonesh. faghat adad.
                    'TimeStamp' => date("Y/m/d H:i:s"),             //zamane jari ye system.
                    'sign' => ''                                    //reshte ye ersali ye code shode. in mored automatic por mishavad. 
                );
               
	$processor = new RSAProcessor("certificate.xml",RSAKeyType::XMLFile);
	
	//$data = "#". $fields['MerchantCode'] ."#". $fields['TerminalCode'] ."#". $fields['InvoiceNumber'] ."#". $fields['InvoiceDate'] ."#". $fields['amount'] ."#". $fields['TimeStamp'] ."#";
	$data = "#". $fields['MerchantCode'] ."#". $fields['TerminalCode'] ."#". $fields['InvoiceNumber'] ."#". $fields['InvoiceDate'] ."#". $fields['amount'] ."#". $fields['TimeStamp'] ."#";
    $data = sha1($data,true);
	$data =  $processor->sign($data);
	$fields['sign'] =  base64_encode($data); // base64_encode
	 echo '<pre>';
    print_r($fields);
    echo '</pre>';
        if($array["resultObj"]["verifyresult"]){
          echo 'تراکنش شما تایید شد';  
        }else{
            echo 'تراکنش شما تایید نشد';
        }
	$sendingData =  "MerchantCode=". $merchantCode ."&TerminalCode=". $terminalCode ."&InvoiceNumber=". $invoiceNumber ."&InvoiceDate=". $invoiceDate ."&amount=". $amount ."&TimeStamp=". $timeStamp ."&sign=".$fields['sign'];
	$verifyresult = post2https($fields,'https://pep.shaparak.ir/VerifyPayment.aspx');
	$array = makeXMLTree($verifyresult);
    echo '<pre>';
    echo 'verification:</br>';
    //var_dump($array);
        print_r($array);
        echo '</pre>';
        if($array["resultObj"]["verifyresult"]){
          echo 'تراکنش شما تایید شد';  
        }else{
            echo 'تراکنش شما تایید نشد';
        }
    }
    
     ##***************************{{SITE MAP CREATOR}}*****************************##
 public function sitemap(){
     $this->load->helper('file');
     delete_files('./sitemap');
    //SELECTING DATA FROM DATABASE
    $this->db->select('id');
    $result=$this->db->get('homes')->result_array();
    $count=  count($result);
    $size=50000;
    //CREATION OF SITEMAP INDEX
    $counter= floor($count/$size);
    $sitemapindex="<?xml version='1.0' encoding='UTF-8'?>
    <sitemapindex xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>";
        for($i=0;$i<=$counter;$i++){
                $sitemapindex.="
                <sitemap>
                <loc>".base_url()."sitemap/sitemap_xml_".$i.".xml</loc>
                <lastmod>".date("F j, Y, g:i a")."</lastmod>
                </sitemap>\n";
        }//for
        $sitemapindex.=""
        ."\t</sitemapindex>";
    $f=  fopen("sitemapindex_xml.xml", "w");
    fwrite($f, $sitemapindex);
    fclose($f);
    
    //FOR LOOP FOR CREATING SITEMAP MULTI FILES FOR LARGE SITEMAPS
    for($i=0;$i<=$counter;$i++){
        //CREATION OF SITEMAP FILES
        $filestart="<?xml version='1.0' encoding='UTF-8'?>";
        $filestart.='<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" '
        . 'xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
        $file_end="</urlset>";
        $sitemapfile="sitemap/sitemap_xml_".$i.".xml";
        $sitemap= fopen($sitemapfile, "a");
        fwrite($sitemap,$filestart);
       // echo "i=".$i."\n";
        for($j=$i*$size;$j<($i+1)*$size;$j++){
            //echo "j=".$j."\t";
            if($result[$j]['id']==''){
                break;
            }
            $urlpath="<url>
                <loc>".base_url()."home/".$result[$j]['id']."</loc>
                <changefreq>daily</changefreq>
                <priority>0.5</priority>
                </url>"; 
            fwrite($sitemap,$urlpath);
        }//FOR
        echo "\n";
        fwrite($sitemap,$file_end);
        fclose($sitemap);
    }//END FOR
    echo 'sitemap created successfully.';
 }
}//end of guest class
