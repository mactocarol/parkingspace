<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Base_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Calcutta");
    }

    public function checkfirsttime() {
        if ($this->input->cookie('test')) {
            return 1;
        } else {
            $cookie = array(
                'name' => 'test',
                'value' => 'test',
                'expire' => time() + (86400 * 30)
            );
            $this->input->set_cookie($cookie);
            return 2;
        }
    }

    public function checkSessionAdmin() {
        if ($this->session->userdata('isLoggedIn')) {
            return true;
        } else {
            redirect("Admin/logout");
        }
    }

    public function checkSessiononlyAdmin() {
        if ($this->session->userdata('isLoggedIn') && $this->session->userdata('type') == 'Admin') {
            return true;
        } else {
            redirect("Admin/logout");
        }
    }

    public function checkSession() {
        if ($this->session->userdata('isLoggedInUser')) {
            return true;
        } else {
            redirect("Home/logout");
        }
    }

    public function checkSessionParkingowner() {
        if ($this->session->userdata('type') == "Owner") {
            return true;
        } else {
            redirect("Home/logout");
        }
    }

    public function checkSessionUser() {
        if ($this->session->userdata('type') == "User") {
            return true;
        } else {
            redirect("Home/logout");
        }
    }

    function unsetImage($id, $table, $data, $path) {
        $this->db->select($data);
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $query = $query->result();
            $img = $query[0]->$data;
            @unlink($path . $img);
        }
        return true;
    }

    function savecropimage($file, $path) {
        $imageName = "";
        if ($this->input->post($file)) {
            $data = $this->input->post($file);
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);

            $data = base64_decode($data);
            $imageName = uniqid() . rand(1000, 9999) . time() . '.png';
            file_put_contents($path . $imageName, $data);
        }
        return $imageName;
    }

    public function adminheader() {
        $data['front'] = $this->Common_Model->getdata("front_setting", $where = '', $sort = '');
        $this->load->view("admin/Header", $data);
        $this->load->view("admin/Topbar");
    }

    public function adminfooter() {
        $data['front'] = $this->Common_Model->getdata("front_setting", $where = '', $sort = '');
        $data['admin'] = $this->Common_Model->getdata("admin_login", $where = '', $sort = '');
        $this->load->view("admin/Sidebar", $data);
        $this->load->view("admin/Footer", $data);
    }

    public function frontheader($data = null) {

        $data['front'] = $this->Common_Model->getdata("front_setting", $where = '', $sort = '');
        $this->load->view("Header", $data);
    }

    public function frontfooter() {
        $data['front'] = $this->Common_Model->getdata("front_setting", $where = '', $sort = '');
        $this->load->view("Footer", $data);
    }

    public function startdashboard() {

        $data['user'] = $this->Common_Model->getdata("user", $where = array("id" => $this->session->userdata('uid')), $sort = '');
        $data['allnewNotification'] = $this->Common_Model->countNewBookedStatus($this->session->userdata('uid'));
        $data['allnewmsg'] = $this->Common_Model->countNewMessage($this->session->userdata('uid'));
      
        $this->load->view("Startdashboard", $data);
    }

    public function enddashboard() {

        $this->load->view("Enddashboard");
    }

    public function getSingleValue($id, $table, $data) {
        $values = "";
        $this->db->select($data);
        $this->db->where("id", $id);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            $result = $query->result();
            $values = $result[0]->$data;
        }
        return $values;
    }

    public function getdataSingleValue($id, $table, $data, $col) {
        $values = "";
        $this->db->select($data);
        $this->db->where($col, $id);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            $result = $query->result();
            $values = $result[0]->$data;
        }
        return $values;
    }

    public function email($to, $subject, $msg) {
        $config = array(
            'mailtype' => 'html',
            'charset' => 'utf-8'
        );
        $body = $this->load->view('Common', $msg, TRUE);
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('info@mactosys.com', 'Pewny Parking');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($body);
        $this->email->send();
    }

    public function emailfile($to, $from, $subject, $msg, $attach) {
        $config = array(
            'mailtype' => 'html',
            'charset' => 'utf-8'
        );

        $this->load->library('email', $config);
        $body = $this->load->view('Common', $msg, TRUE);
        $this->email->set_newline("\r\n");
        $this->email->from('info@mactosys.com', $from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($body);
        $this->email->attach($attach);
        $this->email->send();
        /*
          if($this->email->send())
          return true;
          else
          return false; */
    }

    function alpha_dash_space($fullname) {
        if (!preg_match('/^[0-9a-zA-Z]+$/', $fullname)) {
            $this->form_validation->set_message('alpha_dash_space', 'The Username field contain only characters & number not White spaces');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function imageuploadresize($filename1, $path, $thumbpath, $minwidth, $minheight, $maxsize, $fileformat, $fileextension) {
        $minimumsizeval = $minwidth . '*' . $minheight;
        $sizeval = $maxsize . ' ' . $fileformat;

        $imagefilename = time() . str_replace(str_split(' ()\\/,:*?"<>|'), '', $_FILES[$filename1]['name']);
        $config['upload_path'] = $path;
        $config['allowed_types'] = $fileextension;
        $config['file_name'] = $imagefilename;
        //$config['max_size']      = $maxsize; 
        // $config['min_width'] = $minwidth;
        //$config['min_height'] = $minheight;		 
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($filename1)) {
            $this->form_validation->set_rules($filename1, $this->upload->display_errors(), 'required');
            //echo $this->upload->display_errors();
        } else {
            $image_data = $this->upload->data();
            $config = array(
                        'source_image' => $image_data['full_path'], //path to the uploaded image  
                        'new_image' => $thumbpath, //path to 
                        'maintain_ratio' => TRUE,
                        'width' => $minwidth,
                        'height' => $minheight,
                        'overwrite' => TRUE
            );
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            return $image_data['file_name'];
        }
    }

    public function imageUpload($image_name, $image_path) {
        $f_name = $_FILES[$image_name]['name'];
        $f_tmp = $_FILES[$image_name]['tmp_name'];
        $f_extension = explode('.', $f_name); //To breaks the string into array
        $f_extension = strtolower(end($f_extension)); //end() is used to retrun a last element to the array
        $f_newfile = "";
        if ($f_name) {
            $f_newfile = uniqid() . '.' . $f_extension; // It`s use to stop overriding if the image will be same then uniqid() will generate the unique name 
            $store = "$image_path" . $f_newfile;
            $file1 = move_uploaded_file($f_tmp, $store);
        }
        return $f_newfile;
    }

    public function getminute($end, $start) {
        $datediff = (strtotime($end) - strtotime($start));
        $hrs = round($datediff / 3600);
        $day = round($datediff / 86400);
        $min = round($datediff / 60);
        $month = round($datediff / 60 / 60 / 24 / 30);
        return $min;
    }

    function getago($ftime) {
        $ftime = date("Y-m-d H:i:s", strtotime($ftime));
        $cdt = date("Y-m-d H:i:s");
        $cdt = strtotime($cdt);
        $ftime = strtotime($ftime);
        $datediff = ($cdt - $ftime);

        $hrs = round($datediff / 3600);
        $day = round($datediff / 86400);
        $min = round($datediff / 60);
        $month = round($datediff / 60 / 60 / 24 / 30);
        $ago = 0;
        if ($min == 0) {
            $ago = "Just Now";
        } else if ($min < 60) {
            $ago = $min . ' Min ago';
        } else if ($min >= 60 && $min < 1440) {
            $ago = $hrs . ' Hours ago';
        } else if ($min >= 1440 && $min < 43200) {
            $ago = $day . ' Days ago';
        } else {
            $ago = $month . ' Months ago';
        }
        return $ago;
    }

    function convertminutetohour($minutes) {
        if ($minutes <= 0)
            return '00 Hours 00 Minutes';
        else
            return sprintf("%02d", floor($minutes / 60)) . ' Hours ' . sprintf("%02d", str_pad(($minutes % 60), 2, "0", STR_PAD_LEFT)) . " Minutes";
    }

    public function getTimeDiff($dtime, $atime) {
        $nextDay = $dtime > $atime ? 1 : 0;
        $dep = explode(':', $dtime);
        $arr = explode(':', $atime);
        $diff = abs(mktime($dep[0], $dep[1], 0, date('n'), date('j'), date('y')) - mktime($arr[0], $arr[1], 0, date('n'), date('j') + $nextDay, date('y')));
        $hours = floor($diff / (60 * 60));
        $mins = floor(($diff - ($hours * 60 * 60)) / (60));
        $secs = floor(($diff - (($hours * 60 * 60) + ($mins * 60))));
        if (strlen($hours) < 2) {
            $hours = "0" . $hours;
        }
        if (strlen($mins) < 2) {
            $mins = "0" . $mins;
        }
        if (strlen($secs) < 2) {
            $secs = "0" . $secs;
        }
        return $hours . ':' . $mins;
    }

    function countryNameToISO3166($country_name, $language) {
        if (strlen($language) != 2) {
            //Language must be on 2 caracters
            return NULL;
        }

        //Set uppercase if never
        $language = strtoupper($language);

        $countrycode_list = array('AF', 'AX', 'AL', 'DZ', 'AS', 'AD', 'AO', 'AI', 'AQ', 'AG', 'AR', 'AM', 'AW', 'AU', 'AT', 'AZ', 'BS', 'BH', 'BD', 'BB', 'BY', 'BE', 'BZ', 'BJ', 'BM', 'BT', 'BO', 'BQ', 'BA', 'BW', 'BV', 'BR', 'IO', 'BN', 'BG', 'BF', 'BI', 'KH', 'CM', 'CA', 'CV', 'KY', 'CF', 'TD', 'CL', 'CN', 'CX', 'CC', 'CO', 'KM', 'CG', 'CD', 'CK', 'CR', 'CI', 'HR', 'CU', 'CW', 'CY', 'CZ', 'DK', 'DJ', 'DM', 'DO', 'EC', 'EG', 'SV', 'GQ', 'ER', 'EE', 'ET', 'FK', 'FO', 'FJ', 'FI', 'FR', 'GF', 'PF', 'TF', 'GA', 'GM', 'GE', 'DE', 'GH', 'GI', 'GR', 'GL', 'GD', 'GP', 'GU', 'GT', 'GG', 'GN', 'GW', 'GY', 'HT', 'HM', 'VA', 'HN', 'HK', 'HU', 'IS', 'IN', 'ID', 'IR', 'IQ', 'IE', 'IM', 'IL', 'IT', 'JM', 'JP', 'JE', 'JO', 'KZ', 'KE', 'KI', 'KP', 'KR', 'KW', 'KG', 'LA', 'LV', 'LB', 'LS', 'LR', 'LY', 'LI', 'LT', 'LU', 'MO', 'MK', 'MG', 'MW', 'MY', 'MV', 'ML', 'MT', 'MH', 'MQ', 'MR', 'MU', 'YT', 'MX', 'FM', 'MD', 'MC', 'MN', 'ME', 'MS', 'MA', 'MZ', 'MM', 'NA', 'NR', 'NP', 'NL', 'NC', 'NZ', 'NI', 'NE', 'NG', 'NU', 'NF', 'MP', 'NO', 'OM', 'PK', 'PW', 'PS', 'PA', 'PG', 'PY', 'PE', 'PH', 'PN', 'PL', 'PT', 'PR', 'QA', 'RE', 'RO', 'RU', 'RW', 'BL', 'SH', 'KN', 'LC', 'MF', 'PM', 'VC', 'WS', 'SM', 'ST', 'SA', 'SN', 'RS', 'SC', 'SL', 'SG', 'SX', 'SK', 'SI', 'SB', 'SO', 'ZA', 'GS', 'SS', 'ES', 'LK', 'SD', 'SR', 'SJ', 'SZ', 'SE', 'CH', 'SY', 'TW', 'TJ', 'TZ', 'TH', 'TL', 'TG', 'TK', 'TO', 'TT', 'TN', 'TR', 'TM', 'TC', 'TV', 'UG', 'UA', 'AE', 'GB', 'US', 'UM', 'UY', 'UZ', 'VU', 'VE', 'VN', 'VG', 'VI', 'WF', 'EH', 'YE', 'ZM', 'ZW');
        $ISO3166 = NULL;
        //Loop all country codes
        foreach ($countrycode_list as $countrycode) {
            $locale_cc = Locale::getDisplayRegion('-' . $countrycode, $language);
            //Case insensitive
            if (strcasecmp($country_name, $locale_cc) == 0) {
                $ISO3166 = $countrycode;
                break;
            }
        }
        //return NULL if not found or country code
        return strtolower($ISO3166);
    }

    public function setpopularcount($id, $table) {
        $this->db->set('popular', 'popular+1', FALSE);
        $this->db->where('id', $id);
        $this->db->update($table);
    }

    function getMessages($id) {
        $this->db->select('*');
        $this->db->from('comments');
        $this->db->where('message_to', $id);
        $this->db->or_where('message_from', $id);
        $this->db->group_by('chat_id');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
            //echo "<pre>"; print_r($query); die;
        }
        //return true;		
    }

}

?>