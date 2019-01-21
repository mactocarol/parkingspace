<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
ob_start();

class Home extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Core_Model');
    }

    public function index() {
        $data['main_heading'] = $this->Core_Model->SelectSingleRecord("settings", '*', array('key' => 'main_heading_' . $this->session->userdata("site_lang")), array());
        $data['main_subheading'] = $this->Core_Model->SelectSingleRecord("settings", '*', array('key' => 'main_subheading_' . $this->session->userdata("site_lang")), array());
        $data['main_image'] = $this->Core_Model->SelectSingleRecord("settings", '*', array('key' => 'main_image_' . $this->session->userdata("site_lang")), array());
        $data['main_button'] = $this->Core_Model->SelectSingleRecord("settings", '*', array('key' => 'main_button_' . $this->session->userdata("site_lang")), array());

        $data['featured_image1'] = $this->Core_Model->SelectSingleRecord("settings", '*', array('key' => 'featured_image1_' . $this->session->userdata("site_lang")), array());
        $data['featured_heading1'] = $this->Core_Model->SelectSingleRecord("settings", '*', array('key' => 'featured_heading1_' . $this->session->userdata("site_lang")), array());
        $data['featured_content1'] = $this->Core_Model->SelectSingleRecord("settings", '*', array('key' => 'featured_content1_' . $this->session->userdata("site_lang")), array());
        $data['featured_image2'] = $this->Core_Model->SelectSingleRecord("settings", '*', array('key' => 'featured_image2_' . $this->session->userdata("site_lang")), array());
        $data['featured_heading2'] = $this->Core_Model->SelectSingleRecord("settings", '*', array('key' => 'featured_heading2_' . $this->session->userdata("site_lang")), array());
        $data['featured_content2'] = $this->Core_Model->SelectSingleRecord("settings", '*', array('key' => 'featured_content2_' . $this->session->userdata("site_lang")), array());
        $data['featured_image3'] = $this->Core_Model->SelectSingleRecord("settings", '*', array('key' => 'featured_image3_' . $this->session->userdata("site_lang")), array());
        $data['featured_heading3'] = $this->Core_Model->SelectSingleRecord("settings", '*', array('key' => 'featured_heading3_' . $this->session->userdata("site_lang")), array());
        $data['featured_content3'] = $this->Core_Model->SelectSingleRecord("settings", '*', array('key' => 'featured_content3_' . $this->session->userdata("site_lang")), array());

        $data['total_space'] = $this->Core_Model->SelectRecord("rentourspace", '*', array(), array());
        $data['total_users'] = $this->Core_Model->SelectRecord("user", '*', array(), array());
        $latest = $this->Core_Model->SelectSingleRecord("booking", '*', array(), 'id desc');

        if (!empty($latest)) {
            $data['latest_booking'] = $this->Core_Model->SelectSingleRecord("rentourspace", '*', array('id' => $latest->spaceid), 'id desc');
        } else {
            $data['latest_booking'] = [];
        }



        $data['testimonials'] = $this->Core_Model->SelectRecord("testimonial", '*', array(), 'id desc');
        //echo "<pre>"; print_r($data['latest_booking']); die;
        $this->frontheader();
        $this->load->view('Content', $data);
        $this->frontfooter();
    }

    public function login() {

        if ($this->session->userdata("uid")) {
            $sts = array("online" => 1, "onlinedate" => date("Y-m-d H:i:s"));
            $this->db->where("id", $this->session->userdata("uid"));
            $this->db->update("user", $sts);
            redirect("Home");
        } else {
            $cooki = $this->checkfirsttime();
            $data['cooki'] = $cooki;
            $this->frontheader();
            $this->load->view("Login", $data);
            $this->frontfooter();
        }
    }

    public function checkuser() {
        $id = $this->uri->segment(3);

        if ($this->Login_Model->checkuser($id)) {
            $pass = $this->getSingleValue($id, "user", "password");
            if ($pass != '') {
                redirect("dashboard");
            } else {
                redirect("editprofile");
            }
        } else {
            redirect("Home");
        }
    }

    public function checklogin() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->login();
        } else {
            $data = $this->Login_Model->user_login();
            if ($data) {

                if ($data == 1) {
                    if ($this->input->cookie('pass')) {
                        delete_cookie('pass');
                    }
                    if ($this->session->userdata('prebooking')) {
                        redirect('Search/prebooking');
                    }
                    redirect("dashboard");
                } else if ($data == 2) {
                    if ($this->input->cookie('pass')) {
                        delete_cookie('pass');
                    }
                    if ($this->session->userdata('prebooking')) {
                        redirect('Search/prebooking');
                    }
                    redirect("dashboard");
                } else {
                    $this->session->set_flashdata('result', 1);
                    $this->session->set_flashdata('class', 'danger');
                    $this->session->set_flashdata('msg', "Invalid Email/Password. Please try again");
                    $cookie = array(
                        'name' => 'pass',
                        'value' => 'pass',
                        'expire' => '0'
                    );
                    $this->input->set_cookie($cookie);
                    redirect("Home/login");
                }
            } else {
                $this->session->set_flashdata('result', 1);
                $this->session->set_flashdata('class', 'danger');
                $this->session->set_flashdata('msg', "Invalid Email/Password. Please try again");
                $cookie = array(
                    'name' => 'pass',
                    'value' => 'pass',
                    'expire' => '0'
                );
                $this->input->set_cookie($cookie);
                redirect("Home/login");
            }
        }
    }

    public function signup() {
        $this->form_validation->set_rules('username', 'User Name', 'required');
        $this->form_validation->set_rules('rpassword', 'Password', 'required');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[rpassword]');
        $this->form_validation->set_rules('remail', 'Email', 'required|valid_email|is_unique[user.email]');

        if ($this->form_validation->run() == FALSE) {
            $this->login();
        } else {
            $cdt = date("Y-m-d H:i:s");
            $type = "User";
            $email = $this->input->post("remail");
            $name = $this->input->post("username");

            $datass = array("name" => $name, "password" => md5($this->input->post('rpassword')),
                "email" => $email, "created_dt" => $cdt, "updated_dt" => $cdt, "type" => $type);
            $id = $this->Common_Model->insert("user", $datass);
            if ($id) {
                $ids = base64_encode($id);
                $site_title = $this->getdataSingleValue(22, 'front_setting', 'title_english', 'st');
                $message = "Thanks for creating account with us at <a href=" . base_url() . ">" . $site_title . "</a>. <br>
            <a href='" . base_url() . "Verify/account/" . $ids . "'>Verify Email</a><br>
            To get started, please confirm your email address so that we know your details are correct.";

                $datas['messages'] = array($name, $message);

                $this->email($email, "Registration at " . $site_title, $datas);

                $this->session->set_userdata(array(
                    'uid' => $id,
                    'type' => $type,
                    'isLoggedInUser' => true
                        )
                );

                $this->session->set_flashdata('result', 1);
                $this->session->set_flashdata('class', 'success');
                $this->session->set_flashdata('msg', "Thank you for registering with us.");
                if ($type == "User") {
                    redirect("dashboard");
                }
                if ($type == "Owner") {
                    redirect("dashboard");
                }
            } else {
                $this->session->set_flashdata('result', 1);
                $this->session->set_flashdata('class', 'danger');
                $this->session->set_flashdata('msg', "Error to signup");
                redirect("Signup");
            }
        }
    }

    public function getjson() {
        $id = $this->input->post('id');
        $table = $this->input->post('table');
        $col = $this->input->post('col');
        $sort = $this->input->post('sort');
        $where = array($col => $id);
        $data = $this->Common_Model->getdata($table, $where, $sort);
        echo json_encode($data);
    }

    public function checkMail() {
        header('Content-type: application/json');
        $request = $this->input->post('email');
        if ($this->uri->segment(3)) {
            $eml = $this->uri->segment(3);
            $this->db->where('email !=', $eml);
        }
        $this->db->where("email", $request);
        $result = $this->db->get("user");
        if ($result->num_rows() > 0) {
            $valid = 'false';
        } else {
            $valid = 'true';
        }
        echo $valid;
    }

    public function resendmail() {
        $ids = base64_encode($this->session->userdata('uid'));
        $name = $this->getSingleValue($this->session->userdata('uid'), "user", "name");
        $email = $this->getSingleValue($this->session->userdata('uid'), "user", "email");
        $site_title = $this->getdataSingleValue(22, 'front_setting', 'title_english', 'st');
        $message = "Thanks for creating account with us at <a href=" . base_url() . ">" . $site_title . "</a>. <br>
            <a href='" . base_url() . "Verify/account/" . $ids . "'>Verify Email</a><br>
            To get started, please confirm your email address so that we know your details are correct.";

        $datas['messages'] = array($name, $message);

        $this->email($email, "Email verification at " . $site_title, $datas);

        $this->session->set_flashdata('result', 1);
        $this->session->set_flashdata('class', 'success');
        $this->session->set_flashdata('msg', "Email successfully resend for verification.");
        redirect("dashboard");
    }

    public function subscribenewsletter() {
        $this->form_validation->set_rules('nemail', 'Email', 'required|min_length[6]|max_length[300]|valid_email|is_unique[newsletter.email]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('result', 1);
            $this->session->set_flashdata('class', 'danger');
            $this->session->set_flashdata('msg', "Error to signup Newsletter");
            redirect("Home");
            $this->index();
        } else {
            $cdt = date("Y-m-d H:i:s");
            $email = $this->input->post("nemail");
            $name = "User";

            $datass = array("email" => $email, "created_dt" => $cdt, "updated_dt" => $cdt);
            $id = $this->Common_Model->insert("newsletter", $datass);
            if ($id) {
                $site_title = $this->getdataSingleValue(22, 'front_setting', 'title_english', 'st');
                $message = "Thanks for subscribing newsletter at <a href=" . base_url() . ">" . $site_title . "</a>. <br>
           
           You will recieve newsletter.";

                $datas['messages'] = array($name, $message);

                $this->email($email, "Newsletter subscribing at " . $site_title, $datas);

                $this->session->set_flashdata('result', 1);
                $this->session->set_flashdata('class', 'success');
                $this->session->set_flashdata('msg', "Thank you for subscribing your newsletter.");
                redirect("Home");
            } else {
                $this->session->set_flashdata('result', 1);
                $this->session->set_flashdata('class', 'danger');
                $this->session->set_flashdata('msg', "Error to signup");
                redirect("Home");
            }
        }
    }

    public function logout() {
        $uid = $this->session->userdata('uid');
        $sts = array("online" => 0, "onlinedate" => "0000-00-00 00:00:00");
        $this->db->where("id", $uid);
        $this->db->update("user", $sts);
        session_start();
        session_destroy();
        $cookie = array(
            'name' => 'test',
            'value' => 'test',
            'expire' => time() - (86400 * 30)
        );
        $this->input->set_cookie($cookie);
        $this->session->sess_destroy();
        redirect('Home/login');
    }

    public function setoffline() {
        $uid = $this->session->userdata('uid');
        $sts = array("online" => 0, "onlinedate" => "0000-00-00 00:00:00");
        $this->db->where("id", $uid);
        $this->db->where("online", 1);
        $this->db->update("user", $sts);
        echo true;
    }

}
