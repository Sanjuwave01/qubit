<?phpdefined('BASEPATH') OR exit('No direct script access allowed');class Blog extends CI_Controller {    public function __construct() {        parent::__construct();        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','Binance'));        $this->load->model(array('User_model'));        $this->load->helper(array('user', 'birthdate', 'security', 'email'));    }  public function indexs() {             $this->load->view('blog.php');    }    }