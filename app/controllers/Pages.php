<?php
  class Pages extends Controller {
    public function __construct(){
      $this->urlModel = $this->model('Url');
    }
    
    public function index($code = null){

      if($code){
        if($url = $this->urlModel->getUrl($code)){
          external_redirect($url);
        }
      }

      $this->view('pages/homepage');

    }

    public function addUrl(){
      $data = [
        'url' => '',
        'url_err' => '',
        'code' => '',
        'adding_err' => ''
      ];

      if( $_SERVER['REQUEST_METHOD'] == 'POST'){
        
        // Process Form

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $data['url'] = $_POST['url'];


        //Trim the url
        $data['url'] = trim($data['url']);

        //Adding http
        if(substr( $data['url'], 0, 7 ) != "http://" && substr( $data['url'], 0, 8 ) != "https://"){
          $data['url'] = 'http://' . $data['url'];
        }

        //Is url valid or not
        if(!filter_var($data['url'], FILTER_VALIDATE_URL)){
          $data['url_err'] = 'Url is not valid.';
        }

        //Check the url is already in the database
        if($this->urlModel->isThereThisUrl($data['url'])){
          $data['code'] = $this->urlModel->getCode($data['url']);
        }
        //Adding url
        else if(empty($data['url_err']) && !empty($data['url']) ) {
          if($code = $this->urlModel->addUrl($data['url'])){
            $data['code'] = $code;
          }
          else{
            $data['adding_err'] = 'The url couldn\'t be added'; 
          }
        }

      }
      
      $this->view('pages/homepage', $data);

    }

  }
