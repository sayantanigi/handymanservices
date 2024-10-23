<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class Dashboard extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('post_job_model');
		$this->load->model('Users_model');
		if (!$this->session->userdata('afrebay')) {
			header("location" . base_url() . "login");
		}
	}
	function index() {
		$data['get_service'] = $this->Crud_model->GetData('employer_services', '', "employer_id='" . $_SESSION['afrebay']['userId'] . "'");
		$data['get_job'] = $this->Crud_model->GetData('postjob', '', "user_id='".$_SESSION['afrebay']['userId']."'");
		$data['bid_job'] = $this->db->query("SELECT `postjob`.*, `job_bid`.* FROM `job_bid` JOIN `postjob` ON `postjob`.`id` = `job_bid`.`postjob_id` where `postjob`.user_id = '".$_SESSION['afrebay']['userId']."' AND postjob.is_delete = '0'")->result_array();
		$data['get_subscribe'] = $this->Crud_model->GetData('employer_subscription', '', "employer_id='" . $_SESSION['afrebay']['userId'] . "'");
		$data['get_user'] = $this->Crud_model->get_single('users', "userId ='" . $_SESSION['afrebay']['userId'] . "' and userType='1'");
		$data['get_product'] = $this->Crud_model->GetData('user_product', '', "user_id='".$_SESSION['afrebay']['userId']."' AND status = 1 AND is_delete= 1");
		$data1['title'] = 'Dashboard';
		$this->load->view('header', $data1);
		$this->load->view('user_dashboard/dashboard', $data);
		$this->load->view('footer');
	}
	public function view_profile() {
		$user_info = $this->Crud_model->get_single('users', "userId='" . $_SESSION['afrebay']['userId'] . "'");
		$data = array(
			'userinfo' => $user_info,
		);
		$data1['title'] = 'View Profile';
		$this->load->view('header', $data1);
		$this->load->view('user_dashboard/view_profile', $data);
		$this->load->view('footer');
	}
	public function profile() {
	 	$user_id=base64_decode($this->uri->segment(2));
		if($user_id!=''){
			$userid=$user_id;
			$data_request='admin';
			$this->load->view('admin_header');
		} else {
			$userid=$_SESSION['afrebay']['userId'];
			$data_request='user';
			$data1['title'] = 'Profile';
			$this->load->view('header', $data1);
		}
		$user_info = $this->Crud_model->get_single('users', "userId='" . $userid . "'");
		$data = array(
			'userinfo' => $user_info,
			'data_request'=>$data_request,
		);
		$this->load->view('user_dashboard/profile_settings', $data);
		$this->load->view('footer');
	}
	public function update_profile() {
		if ($_FILES['profilePic']['name'] != '') {
			$src = $_FILES['profilePic']['tmp_name'];
			$filEnc = time();
			$avatar = rand(0000, 9999) . "_" . $_FILES['profilePic']['name'];
			$avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
			$dest = getcwd() . '/uploads/users/' . $avatar1;
			if (move_uploaded_file($src, $dest)) {
				$image  = $avatar1;
				@unlink('uploads/users/' . $_POST['old_resume']);
			}
		} else {
			if(!empty($_POST['old_image'])) {
				$image  = $_POST['old_image'];
			} else {
				$image  = '';
			}
		}

		if ($_FILES['backgroundPic']['name'] != '') {
			$src = $_FILES['backgroundPic']['tmp_name'];
			$filEnc = time();
			$avatar = rand(0000, 9999) . "_" . $_FILES['backgroundPic']['name'];
			$avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
			$dest = getcwd() . '/uploads/users/background/' . $avatar1;
			if (move_uploaded_file($src, $dest)) {
				$bimage  = $avatar1;
				@unlink('uploads/users/background/' . $_POST['old_bimage']);
			}
		} else {
			if(!empty($_POST['old_bimage'])) {
				$bimage  = $_POST['old_bimage'];
			} else {
				$bimage  = '';
			}
		}
		/*if ($_FILES['resume']['name'] != '') {
			$src = $_FILES['resume']['tmp_name'];
			$filEnc = time();
			$avatar = rand(0000, 9999) . "_" . $_FILES['resume']['name'];
			$avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
			$dest = getcwd() . '/uploads/users/resume/' . $avatar1;
			if (move_uploaded_file($src, $dest)) {
				$resume  = $avatar1;
				@unlink('uploads/users/resume/' . $_POST['old_resume']);
			}
		} else {
			if(!empty($_POST['old_resume'])) {
				$resume  = $_POST['old_resume'];
			} else {
				$resume  = '';
			}
		}
        if ($_FILES['work_sample']['name'] != '') {
			$src = $_FILES['work_sample']['tmp_name'];
			$filEnc = time();
			$avatar = rand(0000, 9999) . "_" . $_FILES['work_sample']['name'];
			$avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
			$dest = getcwd() . '/uploads/users/work_sample/' . $avatar1;
			if (move_uploaded_file($src, $dest)) {
				$work_sample  = $avatar1;
				@unlink('uploads/users/work_sample/' . $_POST['old_work_sample']);
			}
		} else {
			if(!empty($_POST['old_work_sample'])) {
				$work_sample  = $_POST['old_work_sample'];
			} else {
				$work_sample  = '';
			}
		}*/

        if (!empty($_FILES['work_sample']['size'])) {
        	$count = count($_FILES['work_sample']['name']);
        	for ($i=0; $i < $count; $i++) {
	            $src = $_FILES['work_sample']['tmp_name'][$i];
	            $filEnc = time();
	            $avatar = rand(0000, 9999) . "_" . $_FILES['work_sample']['name'][$i];
	            $avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
	            $dest = getcwd() . '/uploads/users/work_sample/' . $avatar1;
	            if (move_uploaded_file($src, $dest)) {
	                $file1  = $avatar1;
	            }
				if(!empty($file1)) {
					$file  = $file1;
				} else if(!empty($_POST['old_work_sample'])) {
					$file  = $_POST['old_work_sample'];
				} else {
					$file  = "";
				}
	            $details_data = array(
                    'user_id'=> $_SESSION['afrebay']['userId'],
                    'work_sample'=> $file,
                    'created_at'=> date('Y-m-d H:m:s')
                );
                $this->Crud_model->SaveData('users_work_sample',$details_data);
	        }
        }

		if(!empty($this->input->post('key_skills'))) {
			$key_skills = $this->input->post('key_skills');
			for ($i=0; $i < count($key_skills); $i++) {
				$get_specialist = $this->db->query("SELECT * FROM specialist WHERE specialist_name = '".$key_skills[$i]."'")->result();
				if(empty($get_specialist)) {
					$insrt = array(
						'specialist_name'=>ucfirst($key_skills[$i]),
						'created_date'=>date('Y-m-d H:i:s'),
					);
					$this->db->insert('specialist',$insrt);
				}
			}
			$skills = implode(", ",$this->input->post('key_skills',TRUE));
		} else {
			$skills = '';
		}

        if(!empty($this->input->post('business_category'))) {
			$business_category = $this->input->post('business_category');
			for ($i=0; $i < count($business_category); $i++) {
				$get_category = $this->db->query("SELECT * FROM category WHERE category_name LIKE '%".$business_category[$i]."%'")->result();
				if(empty($get_category)) {
					$insrt = array(
						'category_name'=>ucfirst($business_category[$i]),
                        'status'=> 'Active',
						'created_date'=>date('Y-m-d H:i:s'),
					);
					$this->db->insert('category',$insrt);
				}
			}
			$business_category = implode(", ",$this->input->post('business_category',TRUE));
		} else {
			$business_category = '';
		}

        $checkUserEmail = $this->db->query("SELECT * FROM users WHERE email = '".$_POST['email']."' AND userId != '".$_SESSION['afrebay']['userId']."'")->row();
        if(!empty($checkUserEmail)) {
            $this->session->set_flashdata('error', 'Email already exists');
            redirect(base_url('profile'));
        } else {
            $data = array(
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'profilePic' => $image,
                'email' => $_POST['email'],
                'backgroundPic' => $bimage,
                'zip' => $_POST['zip'],
                'short_bio' => $_POST['short_bio'],
            );
            $this->Crud_model->SaveData('users', $data, "userId='" . $_SESSION['afrebay']['userId'] . "'");
            if($_POST['from_data_request']=='admin'){
                $this->session->set_flashdata('message', 'Profile Updated Successfull !');
                redirect(base_url('admin/users'));
            }
            else{
                $this->session->set_flashdata('message', 'Profile Updated Successfull !');
                // if($_SESSION['afrebay']['userType'] == '2') {
                //     redirect(base_url('homepage'));
                // } else {
                //     redirect(base_url('business_details'));
                // }
                redirect(base_url('homepage'));
            }
        }
	}

    public function business_details() {
        $user_info = $this->Crud_model->get_single('users', "userId='" . $_SESSION['afrebay']['userId'] . "'");
		$data = array(
			'userinfo' => $user_info,
			'data_request'=>'user',
		);
        $data1['title'] = 'Business Details';
        $this->load->view('header', $data1);
		$this->load->view('user_dashboard/business_details', $data);
		$this->load->view('footer');
    }
    public function update_businessDetails() {
        if(!empty($this->input->post('business_category'))) {
			$business_category = $this->input->post('business_category');
			for ($i=0; $i < count($business_category); $i++) {
				$get_category = $this->db->query("SELECT * FROM category WHERE category_name LIKE '%".$business_category[$i]."%'")->result();
				if(empty($get_category)) {
					$insrt = array(
						'category_name'=>ucfirst($business_category[$i]),
                        'status'=> 'Active',
						'created_date'=>date('Y-m-d H:i:s'),
					);
					$this->db->insert('category',$insrt);
				}
			}
			$business_category = implode(", ",$this->input->post('business_category',TRUE));
		} else {
			$business_category = '';
		}

        if (!empty($_FILES['work_sample']['size'])) {
        	$count = count($_FILES['work_sample']['name']);
        	for ($i=0; $i < $count; $i++) {
	            $src = $_FILES['work_sample']['tmp_name'][$i];
	            $filEnc = time();
	            $avatar = rand(0000, 9999) . "_" . $_FILES['work_sample']['name'][$i];
	            $avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
	            $dest = getcwd() . '/uploads/users/work_sample/' . $avatar1;
	            if (move_uploaded_file($src, $dest)) {
	                $file1  = $avatar1;
	            }
				if(!empty($file1)) {
					$file  = $file1;
				} else if(!empty($_POST['old_work_sample'])) {
					$file  = $_POST['old_work_sample'];
				} else {
					$file  = "";
				}
	            $details_data = array(
                    'user_id'=> $_SESSION['afrebay']['userId'],
                    'work_sample'=> $file,
                    'created_at'=> date('Y-m-d H:m:s')
                );
                $this->Crud_model->SaveData('users_work_sample',$details_data);
	        }
        }
        $checkUserEmail = $this->db->query("SELECT * FROM users WHERE email = '".$_POST['email']."' AND userId != '".$_SESSION['afrebay']['userId']."'")->row();
        if(!empty($checkUserEmail)) {
            $this->session->set_flashdata('error', 'Email already exists');
            redirect(base_url('business_details'));
        } else {
            $data = array(
                'companyname' => $_POST['companyname'],
                'mobile' => $_POST['mobile'],
                'email' => $_POST['email'],
                'serviceType' => $business_category,
                'address' => $_POST['address'],
                'latitude' => $_POST['latitude'],
                'longitude' => $_POST['longitude'],
                'reference_link' => $_POST['reference_link'],
                'hourly_rate' => $_POST['hourly_rate'],
            );
            //print_r($data); die();
            $this->Crud_model->SaveData('users', $data, "userId='" . $_POST['id'] . "'");
            redirect(base_url('homepage'));
        }

    }
	function getVisIpAddr() {
    	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        	return $_SERVER['HTTP_CLIENT_IP'];
    	} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        	return $_SERVER['HTTP_X_FORWARDED_FOR'];
    	} else {
        	return $_SERVER['REMOTE_ADDR'];
    	}
	}
	public function subscription() {
		$vis_ip = $this->getVisIPAddr(); // Store the IP address
		$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $vis_ip));
		$countryName = $ipdat->geoplugin_countryName;
		if($countryName == 'Nigeria') {
			$cond = " WHERE subscription_country = 'Nigeria'";
		} else {
			$cond = " WHERE subscription_country = 'Global'";
		}
		if($_SESSION['afrebay']['userType'] == '1') {
			$uType = 'Freelancer';
		} else {
			$uType = 'Business';
		}
		$data['get_subscription'] = $this->db->query("SELECT * FROM subscription ".$cond." AND subscription_user_type = '".$uType."'")->result();
		$data['current_plan'] = $this->Crud_model->GetData('employer_subscription', '', "employer_id='".$_SESSION['afrebay']['userId']."' AND status IN (1,2)");
		$data['expired_plan'] = $this->Crud_model->GetData('employer_subscription', '', "employer_id='".$_SESSION['afrebay']['userId']."' AND status = '3'");
		$data['subscription_check'] = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='".$_SESSION['afrebay']['userId']."' AND (status = '1' OR status = '2')")->result_array();
		$data1['title'] = 'Subscription';
		$this->load->view('header', $data1);
		$this->load->view('user_dashboard/subscription', $data);
		$this->load->view('footer');
	}
	public function products() {
		$data['product_list'] = $this->Crud_model->GetData('user_product', '', "user_id='".$_SESSION['afrebay']['userId']."' AND status = 1 and is_delete = 1");
		$data1['title'] = 'Products';
		$this->load->view('header', $data1);
		$this->load->view('user_dashboard/product/list', $data);
		$this->load->view('footer');
	}
	public function myservice() {
		$data['get_services'] = $this->Crud_model->GetData('employer_services', '', "employer_id='" . $_SESSION['afrebay']['userId'] . "'");
		$this->load->view('header');
		$this->load->view('user_dashboard/my_service', $data);
		$this->load->view('footer');
	}
	public function service_form() {
		$get_category = $this->Crud_model->GetData('category');
		$data = array(
			'button' => 'Submit',
			'action' => base_url('user/Dashboard/save_service'),
			'service_name' => set_value('service_name'),
			'category_id' => set_value('category_id'),
			'subcategory_id' => set_value('subcategory_id'),
			'description' => set_value('description'),
			'get_category' => $get_category,
			'id' => set_value('id'),
		);
		$this->load->view('header');
		$this->load->view('user_dashboard/service_form', $data);
		$this->load->view('footer');
	}
	public function update_service_form($id) {
		$service_id = base64_decode($id);
		$get_category = $this->Crud_model->GetData('category');
		$get_subcategory = $this->Crud_model->GetData('sub_category');
		$get_services = $this->Crud_model->get_single('employer_services', "id='" . $service_id . "'");
		$data = array(
			'button' => 'Update',
			'action' => base_url('user/Dashboard/update_service'),
			'service_name' => $get_services->service_name,
			'category_id' => $get_services->category_id,
			'subcategory_id' => $get_services->subcategory_id,
			'description' => $get_services->description,
			'id' => $get_services->id,
			'get_category' => $get_category,
			'get_subcategory' => $get_subcategory,
		);
		$this->load->view('header');
		$this->load->view('user_dashboard/service_form', $data);
		$this->load->view('footer');
	}
	public function save_service() {
		$data = array(
			'employer_id' => $_SESSION['afrebay']['userId'],
			'service_name' => $_POST['service_name'],
			'category_id' => $_POST['category_id'],
			'subcategory_id' => $_POST['subcategory_id'],
			'description' => $_POST['description'],
			'created_date' => date('Y-m-d H:i:s'),
		);
		$this->Crud_model->SaveData('employer_services', $data);
		$this->session->set_flashdata('message', 'Services Created Successfull !');
		redirect(base_url('myservice'));
	}
	public function update_service() {
		$id = $_POST['id'];
		$data = array(
			'service_name' => $_POST['service_name'],
			'category_id' => $_POST['category_id'],
			'subcategory_id' => $_POST['subcategory_id'],
			'description' => $_POST['description'],
		);
		$this->Crud_model->SaveData('employer_services', $data, "id='" . $id . "'");
		$this->session->set_flashdata('message', 'Services Updated Successfully !');
		redirect(base_url('myservice'));
	}
	function delete_service($id) {
		$this->Crud_model->DeleteData('employer_services', "id='" . $id . "'");
		$this->session->set_flashdata('message', 'Service Deleted successfully !');
		redirect(base_url('myservice'));
	}
	public function myjob() {
		$data['get_postjob'] = $this->Crud_model->GetData('postjob', '', "user_id='".$_SESSION['afrebay']['userId']."' ");
		$data['title'] = 'My Jobs';
		$this->load->view('header', $data);
		$this->load->view('user_dashboard/my_job', $data);
		$this->load->view('footer');
	}
	public function buy_subscription() {
		$employer_id = $_SESSION['afrebay']['userId'];
		$data = array(
			'employer_id' => $employer_id,
			'subscription_id' => $_POST['subscription_id'],
			'amount' => $_POST['amount'],
			'created_date' => date('Y-m-d, H:i:s'),
		);
		$this->Crud_model->SaveData('employer_subscription', $data);
		$this->session->set_flashdata('message', 'Subscription purchased Successfull !');
		echo '1';
	}
	function jobbid() {
		$this->load->model('Post_job_model');
		if($_SESSION['afrebay']['userType'] == '1'){
			$cond = "job_bid.user_id='" . $_SESSION['afrebay']['userId'] . "'";
			$data1['title'] = 'My Work Bids';
		} else {
			$cond = "postjob.user_id='" . $_SESSION['afrebay']['userId'] . "'";
			$data1['title'] = 'List of Bids';
		}
		$data['get_postjob'] = $this->Post_job_model->postjob_bid($cond);
		$this->load->view('header', $data1);
		$this->load->view('user_dashboard/my_jobbid', $data);
		$this->load->view('footer');
	}
	function save_postbid() {
		$data = array(
			'postjob_id' => $_POST['postjob_id'],
			'user_id' => $_SESSION['afrebay']['userId'],
			'bid_amount' => $_POST['bid_amount'],
			'currency' => $_POST['currency'],
			'duration' => $_POST['duration'],
			'description' => $_POST['description'],
			'created_date' => date('Y-m-d H:i:s'),
		);
		$this->Crud_model->SaveData('job_bid', $data);
		$insert_id = $this->db->insert_id();
		if(!empty($insert_id)) {
			$this->session->set_flashdata('message', 'Bid Submitted Successfully! You will be notified once the Business has approved your bid');
			redirect(base_url("workdetail/".base64_encode($_POST['postjob_id'])), "refresh");
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later.');
			redirect(base_url("workdetail/".base64_encode($_POST['postjob_id'])), "refresh");
		}
	}
	function changebiddingstatus() {
		$bidstatus = $this->input->post('bidstatus');
		$jodBidid = $this->input->post('jodBidid');
		$postJobid = $this->input->post('postJobid');
		$jobbiduserid = $this->input->post('jobbiduserid');
		$jobpostuserid = $this->input->post('jobpostuserid');
		$data1 = array(
			'bidding_status' => $bidstatus,
		);
		$this->Crud_model->SaveData('job_bid', $data1, "id='".$jodBidid."' AND postjob_id='".$postJobid."'");
		if($bidstatus == "Selected") {
			$this->Crud_model->SaveData('job_bid', $data1, "id='".$jodBidid."' AND postjob_id='".$postJobid."'");
			$binddingstatus = $this->Crud_model->GetData('job_bid', '', "postjob_id = '".$postJobid."' and bidding_status IN ('Pending','Under Review','Short Listed')");
			foreach ($binddingstatus as $row) {
				$data = array(
					'bidding_status' => 'Rejected',
				);
				$this->Crud_model->SaveData('job_bid', $data, "id='" . $row->id . "'");
			}
			$updatepost = array(
				'is_delete' => 1,
			);
			$this->Crud_model->SaveData('postjob', $updatepost, "id='".$postJobid."'");
		}
		echo "1";
		exit;
	}
	function calender() {
		$this->load->view('header');
		$this->load->view('user_dashboard/calender');
		$this->load->view('footer');
	}
	function chat() {
        $data['get_banner'] = $this->Crud_model->get_single('banner', "page_name='Chat'");
		$data['get_user'] = $this->Crud_model->get_single('users', "userId ='".$_SESSION['afrebay']['userId']."'");
		//$cond = "job_bid.bidding_status IN ('Short Listed','Selected')";
		//$data['get_jobbid'] = $this->Users_model->get_jobbidding($cond);
		$data1['title'] = 'Messages';
		$this->load->view('header', $data1);
		$this->load->view('user_dashboard/chat', $data);
		$this->load->view('footer');
	}
	function showmessage_count() {
		$user_id = $this->input->post('userId');
		$getUserType = $this->db->query("Select * FROM users WHERE userId ='".$user_id."'")->result();
		$uType = $getUserType[0]->userType;
		$countMessage = $this->db->query("Select COUNT(id) as msgcount, userfrom_id, userto_id FROM chat WHERE userto_id ='".$user_id."' AND status = '0'")->result();
		$data = array(
			'userfrom_id' => $countMessage[0]->userfrom_id,
			'userto_id' => $countMessage[0]->userto_id,
			'count' => $countMessage[0]->msgcount,
		);
		echo json_encode($data);
	}
	function showmessageCountEach() {
		$userfromid = $this->input->post('userfromid');
		$usertoid = $this->input->post('usertoid');
		$getEachChatCount = $this->db->query("Select COUNT(id) as msgcount, userfrom_id, userto_id, postjob_id FROM chat WHERE userto_id ='".$userfromid."' AND status = '0'")->result();
		$data = array(
			'userfrom_id' => $getEachChatCount[0]->userfrom_id,
			'userto_id' => $getEachChatCount[0]->userto_id,
			'count' => $getEachChatCount[0]->msgcount,
		);
		echo json_encode($data);
	}
	function showmessage_list() {
		$userdId = $_SESSION['afrebay']['userId'];
		$usert_id = $this->input->post('usert_id');
		$post_id = $this->input->post('post_id');
		$get_data = $this->Users_model->getChat();
		$updatastatus = $this->db->query("UPDATE chat SET status = '1' WHERE (userfrom_id ='".$usert_id."' AND userto_id ='".$userdId."') OR (userto_id ='".$usert_id."' AND userfrom_id ='".$userdId."')");
		$get_chatuser = $this->Crud_model->get_single('users', "userId='" . $_POST['usert_id'] . "'");
		// if (!empty($get_chatuser->firstname)) {
		// 	$name = $get_chatuser->firstname . ' ' . $get_chatuser->lastname;
		// } else {
		// 	$name = $get_chatuser->companyname;
		// }

        if(@$get_chatuser->companyname){
            $name = $get_chatuser->companyname;
        }else{
            $name = $get_chatuser->firstname . ' ' . $get_chatuser->lastname;
        }
		if (@$get_chatuser->profilePic && file_exists('uploads/users/' . @$get_chatuser->profilePic)) {
			$userpic = '<img src="' . base_url('uploads/users/' . @$get_chatuser->profilePic) . '" alt="" />';
		} else {
			$userpic = '<img src="' . base_url('uploads/no_pimage.png') . '" alt="" />';
		}
		$html_data = '<div class="contact-profile">' . $userpic . '<p>' . ucfirst($name) . '</p><div class="social-media"><a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a><a href="javascript:void(0);" onclick="openVideoCallWindow('.@$userdId.');"><i class="fa fa-video-camera" aria-hidden="true"></i></a><a href="#"><i class="fa fa-cog" aria-hidden="true"></i></a></div></div><div class="messages"><ul>';
		if (!empty($get_data)) {
			foreach ($get_data as $key) {
				if (@$key->profilePic && file_exists('uploads/users/' . @$key->profilePic)) {
					$from_pic = '<img src="' . base_url('uploads/users/' . @$key->profilePic) . '" alt="" />';
				} else {
					$from_pic = '<img src="' . base_url('uploads/no_pimage.png') . '" alt="" />';
				}
				if (@$key->profilePic && file_exists('uploads/users/' . @$key->profilePic)) {
					$to_pic = '<img src="' . base_url('uploads/users/' . @$key->profilePic) . '" alt="" />';
				} else {
					$to_pic = '<img src="' . base_url('uploads/no_pimage.png') . '" alt="" />';
				}
				if ($key->userfrom_id == $_SESSION['afrebay']['userId'] && $key->userto_id == $_POST['usert_id']) {
					$sent = '<li class="sent">' . $from_pic . '<p>' . $key->message . '</p><div style="font-size: 10px;">'.$key->created_date.'</li>';
				} else {
					$sent = '';
				}
				if ($key->userto_id == $_SESSION['afrebay']['userId'] && $key->userfrom_id == $_POST['usert_id']) {
					$reply = '<li class="replies">' . $to_pic . '<p>' . $key->message . '</p><div style="font-size: 10px;">'.$key->created_date.'</li>';
				} else {
					$reply = '';
				}
				$html_data .= $sent . $reply;
			}
		} else {
			$html_data .= '<li class="sent"><center>No Messages</center></li>';
		}
		echo json_encode($html_data);
		exit;
	}
	function showmessage_listS() {
		$userfrom_id = $this->input->post('userfromid');
		$user_id = $this->input->post('usertoid');
		$post_id = $this->input->post('postid');
		$get_data = $this->Users_model->getCurrentChat($userfrom_id, $user_id);
		$updatastatus = $this->db->query("UPDATE chat SET status = '1' WHERE (userfrom_id ='".$userfrom_id."' AND userto_id ='".$user_id."') OR (userto_id ='".$user_id."' AND userfrom_id ='".$userfrom_id."')");
		$get_chatuser = $this->Crud_model->get_single('users', "userId='" . $user_id . "'");
		if (!empty($get_chatuser->firstname)) {
			$name = $get_chatuser->firstname . ' ' . $get_chatuser->lastname;
		} else {
			$name = $get_chatuser->companyname;
		}
		if (@$get_chatuser->profilePic && file_exists('uploads/users/' . @$get_chatuser->profilePic)) {
			$userpic = '<img src="' . base_url('uploads/users/' . @$get_chatuser->profilePic) . '" alt="" />';
		} else {
			$userpic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
		}
		$html_data = '<div class="contact-profile">' . $userpic . '<p>' . ucfirst($name) . '</p><div class="social-media"><a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a><a href="javascript:void(0);" onclick="openVideoCallWindow('.$user_id.');"><i class="fa fa-video-camera" aria-hidden="true"></i></a><a href="#"><i class="fa fa-cog" aria-hidden="true"></i></a></div></div><div class="messages"><ul>';
		if (!empty($get_data)) {
			foreach ($get_data as $key) {
				if (@$key->profilePic && file_exists('uploads/users/' . @$key->profilePic)) {
					$from_pic = '<img src="' . base_url('uploads/users/' . @$key->profilePic) . '" alt="" />';
				} else {
					$from_pic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
				}
				if (@$key->profilePic && file_exists('uploads/users/' . @$key->profilePic)) {
					$to_pic = '<img src="' . base_url('uploads/users/' . @$key->profilePic) . '" alt="" />';
				} else {
					$to_pic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
				}
				if ($key->userfrom_id == $_SESSION['afrebay']['userId'] && $key->userto_id == $user_id) {
					$sent = '<li class="sent">' . $from_pic . '<p>' . $key->message . '</p><div style="font-size: 10px;">'.$key->created_date.'</li>';
				} else {
					$sent = '';
				}
				if ($key->userto_id == $_SESSION['afrebay']['userId'] && $key->userfrom_id == $user_id) {
					$reply = '<li class="replies">' . $to_pic . '<p>' . $key->message . '</p><div style="font-size: 10px;">'.$key->created_date.'</li>';
				} else {
					$reply = '';
				}
				$html_data .= $sent . $reply;
			}
		} else {
			$html_data .= '<li class="sent"><center>No Messages</center></li>';
		}
		echo json_encode($html_data);
		exit;
	}
	function sent_message() {
		$userfromid = $this->input->post('userfromid');
		$usertoid = $this->input->post('usertoid');
		$updatastatus = $this->db->query("UPDATE chat SET status = '1' WHERE (userfrom_id ='".$usertoid."' AND userto_id ='".$userfromid."') OR (userto_id ='".$usertoid."' AND userfrom_id ='".$userfromid."')");
		if (!empty($this->input->post('usertoid'))) {
			$data = array(
				'userfrom_id' => $userfromid,
				'userto_id' => $usertoid,
				'postjob_id' => $this->input->post('postid'),
                'chat_between' => $userfromid.','.$usertoid,
				'message' => $this->input->post('message'),
				'created_date' => date('Y-m-d H:i:s'),
			);
			$this->db->insert('chat', $data);
			$lastid = $this->db->insert_id();
			$con = "id='" . $lastid . "'";
			$getdata = $this->Users_model->getmessage($con);
			if (@$getdata->profilePic && file_exists('uploads/users/' . @$getdata->profilePic)) {
				$from_pic = '<img src="' . base_url('uploads/users/' . @$getdata->profilePic) . '" alt="" />';
			} else {
				$from_pic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
			}
			$data = array(
				'result' => 1,
				'userpic' => $from_pic,
			);
			echo json_encode($data);
			exit;
		}
	}
	function video_call() {
		$this->load->view('header');
		$this->load->view('user_dashboard/video_call');
		$this->load->view('footer');
	}
	public function save_event() {
		$data = array(
			'user_id' => $_SESSION['afrebay']['userId'],
			'event_name' => $_POST['event_name'],
			'event_date' => date('Y-m-d', strtotime($_POST['event_date'])),
			'start_time' => date('H:i', strtotime($_POST['start_time'])),
			'end_time' => date('H:i', strtotime($_POST['end_time'])),
			'description' => $_POST['description'],
			'event_color' => $_POST['event_color'],
			'event_icon' => $_POST['event_icon'],
			'created_date' => date('Y-m-d H:i:s'),
		);
		$this->Crud_model->SaveData('appointment_scheduling', $data);
		$this->session->set_flashdata('message', 'Appointment Created Successfully !');
		redirect(base_url('calender'));
	}
	public function get_events() {
		$events = $this->db->query("select * from appointment_scheduling where user_id='" . $_SESSION['afrebay']['userId'] . "'")->result();
		$data_events = array();
		foreach ($events as $r) {
			$data_events[] = array(
				"id" => $r->id,
				"title" => $r->event_name,
				"start" => date('Y-m-d', strtotime($r->event_date)),
				"description" => $r->description,
				"className" => $r->event_color,
				"icon" => $r->event_icon,
			);
		}
		echo json_encode($data_events);
		exit();
	}
	function change_password() {
		$data1['title'] = 'Change Password';
		$this->load->view('header', $data1);
		$this->load->view('user_dashboard/change_password');
		$this->load->view('footer');
	}
	function update_password() {
		$get_user = $this->Crud_model->get_single('users', "userId='" . $_SESSION['afrebay']['userId'] . "'");
		if ($get_user->password == base64_encode($_POST['cur_password'])) {
			$data = array(
				'password' => base64_encode($_POST['new_password']),
			);
			$this->Crud_model->SaveData('users', $data, "userId='" . $_SESSION['afrebay']['userId'] . "'");
			$this->session->set_flashdata('message', 'Password Reset Successfully !');
			echo "1";
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
			echo "0";
		}
	}
	function save_employer_rating() {
		if (!empty($this->input->post('rating'))) {
			$data = array(
				'employer_id' => $_SESSION['afrebay']['userId'],
				'worker_id' => $_POST['user_id'],
				'rating' => $this->input->post('rating', TRUE),
				'subject' => $this->input->post('subject', TRUE),
				'review' => $this->input->post('review', TRUE),
				'created_date' => date('Y-m-d H:i:s'),
			);
			$this->Crud_model->SaveData('employer_rating', $data);
			$this->session->set_flashdata('message', 'Rating successfully');
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
		}
        if($_POST['userType'] == '1') {
            redirect(base_url('customer_detail/' . base64_encode($_POST['user_id'])));
        } else {
            //redirect(base_url('professionals_detail/' . base64_encode($_POST['user_id'])));
            redirect(base_url('customer_detail/' . base64_encode($_POST['user_id'])));
        }

	}
	function education_list() {
		$data['education_list'] = $this->Crud_model->GetData('user_education', '', "user_id='".$_SESSION['afrebay']['userId']."' order by id DESC");
		$data1['title'] = 'Education List';
		$this->load->view('header', $data1);
		$this->load->view('user_dashboard/education/list', $data);
		$this->load->view('footer');
	}
	function add_education() {
		$get_education = $this->Crud_model->GetData('user_education', 'id,education', "");
		$get_passing = $this->Crud_model->GetData('user_education', 'id,passing_of_year', "");
		$get_college = $this->Crud_model->GetData('user_education', 'id,college_name', "");
		$get_department = $this->Crud_model->GetData('user_education', 'id,department', "");
		$data = array(
			'button' => 'submit',
			'action' => base_url('user/Dashboard/save_education'),
			'education' => set_value('education'),
			'passing_of_year' => set_value('passing_of_year'),
			'college_name' => set_value('college_name'),
			'department' => set_value('department'),
			'description' => set_value('description'),
			'id' => set_value('id'),
			'get_education' => $get_education,
			'get_passing' => $get_passing,
			'get_college' => $get_college,
			'get_department' => $get_department,
		);
		$data1['title'] = 'Add Education';
		$this->load->view('header', $data1);
		$this->load->view('user_dashboard/education/form', $data);
		$this->load->view('footer');
	}
	public function save_education() {
		$data = array(
			'user_id' => $_SESSION['afrebay']['userId'],
			'education' => $this->input->post('education', TRUE),
			'passing_of_year' => $this->input->post('passing_of_year', TRUE),
			'college_name' => $this->input->post('college_name', TRUE),
			'department' => $this->input->post('department', TRUE),
			'description' => $this->input->post('description', TRUE),
			'created_date' => date('Y-m-d H:i:s'),
		);
		$this->Crud_model->SaveData('user_education', $data);
		$this->session->set_flashdata('message', 'Education Created Successfully !');
		redirect(base_url('education-list'));
	}
	public function update_education($id) {
		$education_id = base64_decode($id);
		$update_education = $this->Crud_model->get_single('user_education', "id='" . $education_id . "'");
		$get_education = $this->Crud_model->GetData('user_education', 'id,education', "");
		$get_passing = $this->Crud_model->GetData('user_education', 'id,passing_of_year', "");
		$get_college = $this->Crud_model->GetData('user_education', 'id,college_name', "");
		$get_department = $this->Crud_model->GetData('user_education', 'id,department', "");
		$data = array(
			'button' => 'update',
			'action' => base_url('user/Dashboard/edit_education'),
			'education' => $update_education->education,
			'passing_of_year' => $update_education->passing_of_year,
			'college_name' => $update_education->college_name,
			'department' => $update_education->department,
			'description' => $update_education->description,
			'id' => $update_education->id,
			'get_education' => $get_education,
			'get_passing' => $get_passing,
			'get_college' => $get_college,
			'get_department' => $get_department,
		);
		$data1['title'] = 'Update Education';
		$this->load->view('header', $data1);
		$this->load->view('user_dashboard/education/form', $data);
		$this->load->view('footer');
	}
	public function edit_education() {
		$id = $_POST['id'];
		$data = array(
			'education' => $this->input->post('education', TRUE),
			'passing_of_year' => $this->input->post('passing_of_year', TRUE),
			'college_name' => $this->input->post('college_name', TRUE),
			'department' => $this->input->post('department', TRUE),
			'description' => $this->input->post('description', TRUE),
		);
		$this->Crud_model->SaveData('user_education', $data, "id='" . $id . "'");
		$this->session->set_flashdata('message', 'Education Updated Successfully !');
		redirect(base_url('education-list'));
	}
	function delete_education(){
		$id = $this->input->post('id');
		$this->Crud_model->DeleteData('user_education', "id='" . $id . "'");
		$this->session->set_flashdata('message', 'Education Deleted successfully !');
		echo '1';
	}
	function workexperience_list() {
		$data['workexperience_list'] = $this->Crud_model->GetData('user_workexperience', '', "user_id='".$_SESSION['afrebay']['userId']."' order by id DESC");
		$data1['title'] = 'Work Experience';
		$this->load->view('header', $data1);
		$this->load->view('user_dashboard/work_experience/list', $data);
		$this->load->view('footer');
	}
	function add_workexperience() {
		$get_designation = $this->Crud_model->GetData('user_workexperience', 'id,designation', "");
		$get_companyname = $this->Crud_model->GetData('user_workexperience', 'id,company_name', "");
		$get_duration = $this->Crud_model->GetData('user_workexperience', 'id,duration', "");
		$data = array(
			'button' => 'submit',
			'action' => base_url('user/Dashboard/save_workexperience'),
			'designation' => set_value('designation'),
			'company_name' => set_value('company_name'),
			'from_date' => set_value('from_date'),
			'to_date' => set_value('to_date'),
			'description' => set_value('description'),
			'id' => set_value('id'),
			'get_designation' => $get_designation,
			'get_companyname' => $get_companyname,
			'get_duration' => $get_duration,
		);
		$data1['title'] = 'Add Work Experience';
		$this->load->view('header', $data1);
		$this->load->view('user_dashboard/work_experience/form', $data);
		$this->load->view('footer');
	}
	public function save_workexperience() {
		$data = array(
			'user_id' => $_SESSION['afrebay']['userId'],
			'designation' => $this->input->post('designation', TRUE),
			'company_name' => $this->input->post('company_name', TRUE),
			'from_date' => $this->input->post('from_date', TRUE),
			'to_date' => $this->input->post('to_date', TRUE),
			'description' => $this->input->post('description', TRUE),
			'created_date' => date('Y-m-d H:i:s'),
		);
		$this->Crud_model->SaveData('user_workexperience', $data);
		$this->session->set_flashdata('message', 'Work Experience Created Successfully !');
		redirect(base_url('workexperience-list'));
	}
	public function update_workexperience($id) {
		$work_id = base64_decode($id);
		$update_data = $this->Crud_model->get_single('user_workexperience', "id='" . $work_id . "'");
		$get_designation = $this->Crud_model->GetData('user_workexperience', 'id,designation', "");
		$get_companyname = $this->Crud_model->GetData('user_workexperience', 'id,company_name', "");
		$get_duration = $this->Crud_model->GetData('user_workexperience', 'id,duration', "");
		$data = array(
			'button' => 'update',
			'action' => base_url('user/Dashboard/edit_workexperience'),
			'designation' => $update_data->designation,
			'company_name' => $update_data->company_name,
			'from_date' => $update_data->from_date,
			'to_date' => $update_data->to_date,
			'description' => $update_data->description,
			'id' => $update_data->id,
			'get_designation' => $get_designation,
			'get_companyname' => $get_companyname,
			'get_duration' => $get_duration,
		);
		$data1['title'] = 'Update Work Experience';
		$this->load->view('header', $data1);
		$this->load->view('user_dashboard/work_experience/form', $data);
		$this->load->view('footer');
	}
	public function edit_workexperience() {
		$id = $_POST['id'];
		$data = array(
			'designation' => $this->input->post('designation', TRUE),
			'company_name' => $this->input->post('company_name', TRUE),
			'from_date' => $this->input->post('from_date', TRUE),
			'to_date' => $this->input->post('to_date', TRUE),
			'description' => $this->input->post('description', TRUE),
		);
		$this->Crud_model->SaveData('user_workexperience', $data, "id='" . $id . "'");
		$this->session->set_flashdata('message', 'Work experience updated successfully !');
		redirect(base_url('workexperience-list'));
	}
	function delete_workexperience() {
		$id = $this->input->post('id');
		$this->Crud_model->DeleteData('user_workexperience', "id='" . $id . "'");
		$this->session->set_flashdata('message', 'Work experience deleted successfully !');
		echo "1";
	}
	function userSubscription() {
		$paymentDate = date('Y-m-d H:i:s');
		$n=24;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $n; $i++) {
			$index = rand(0, strlen($characters) - 1);
			$randomString .= $characters[$index];
		}
		;
		$data = array(
			'employer_id' => $this->input->post('user_id'),
			'subscription_id' => $this->input->post('sub_id'),
			'name_of_card' => $this->input->post('sub_name'),
			'email' => $this->input->post('user_email'),
			'amount' => $this->input->post('sub_price'),
			'duration' => $this->input->post('sub_duration'),
			'transaction_id' => "sub_".$randomString,
			'payment_date' => $paymentDate,
			'created_date' => $paymentDate,
			'duration' => $this->input->post('sub_duration'),
			'payment_status' => 'paid',
			'expiry_date' => date("Y-m-d", strtotime('+'.$this->input->post('sub_duration').'days'))
		);
		$this->Crud_model->SaveData('employer_subscription', $data);
		$insert_id = $this->db->insert_id();
		if(!empty($insert_id)) {
			echo '1';
		} else {
			echo '2';
		}
	}
	function cancelSubscription() {
		$id = $this->input->post('id');
		$sub_id = $this->input->post('sub_id');
		$amount = $this->input->post('amount');
		if($amount < '1') {
			$subStatus = $this->db->query("UPDATE employer_subscription SET status = '2' WHERE `id` ='".$id."'");
			if($subStatus) {
				echo '1';
			} else {
				echo '2';
			}
		} else {
			require 'vendor/autoload.php';
			require_once APPPATH."third_party/stripe/init.php";
			$stripe = new \Stripe\StripeClient('sk_test_835fqzvcLuirPvH0KqHeQz9K');
			$cnclsubData = $stripe->subscriptions->cancel("$sub_id",[]);
			if($cnclsubData['status'] == 'canceled') {
				$subStatus = $this->db->query("UPDATE employer_subscription SET status = '2' WHERE `id` ='".$id."'");
				if($subStatus) {
					echo '1';
				} else {
					echo '2';
				}
			}
		}
	}
	function checkSubscriptionForUser() {
		$getAllSubscription = $this->db->query("SELECT * FROM employer_subscription WHERE status = '1'")-> result_array();
		foreach ($getAllSubscription as $value) {
			$sub_id = $value['transaction_id'];
			$now_date = date('Y-m-d');
			$expiry_date = date('Y-m-d', strtotime($value['expiry_date']));
			$amount = $value['amount'];
			if($expire_date > $now_date) {
				if($amount < '1') {
					$subStatus = $this->db->query("UPDATE employer_subscription SET status = '3' where status = '1'");
					if($subStatus) {
						echo '1';
					} else {
						echo '2';
					}
				} else {
					require 'vendor/autoload.php';
					require_once APPPATH."third_party/stripe/init.php";
					$stripe = new \Stripe\StripeClient('sk_test_835fqzvcLuirPvH0KqHeQz9K');
					$cnclsubData = $stripe->subscriptions->cancel("$sub_id",[]);
					if($cnclsubData['status'] == 'canceled') {
						$subStatus = $this->db->query("UPDATE employer_subscription SET status = '3' where status = '1'");
						if($subStatus) {
							echo '1';
						} else {
							echo '2';
						}
					}
				}
			}
		}
	}
	function add_product() {
		//print_r($_FILES['prod_image']['name'][0]); die();
		if(!empty($this->input->post())){
			$data = array(
				'user_id' => $_SESSION['afrebay']['userId'],
				'prod_name' => $this->input->post('prod_name'),
				'prod_description' => $this->input->post('prod_description'),
				'created_date' => date("Y-m-d H:i:s"),
			);
			$this->Crud_model->SaveData('user_product', $data);
			$insert_id = $this->db->insert_id();
			$sitemap_date = array(
				'link'=>'/'.'productdetail/'.base64_encode($insert_id),
				'changefreq' => 'daily',
				'priority' => '0.51',
				'lastmod'=> date('c', time()),
			);
			$this->Crud_model->SaveData('sitemap',$sitemap_date);
			if(!empty($insert_id)) {
				if (!empty($_FILES['prod_image']['name'][0])) {
					$cpt = count($_FILES['prod_image']['name']);
					for($i=0; $i<$cpt; $i++) {
						$_POST['prod_image'] = rand(0000, 9999) . "_" . $_FILES['prod_image']['name'][$i];
						$config2['image_library'] = 'gd2';
						$config2['source_image'] =  $_FILES['prod_image']['tmp_name'][$i];
						$config2['new_image'] =   getcwd() . '/uploads/products/'.$_POST['prod_image'];
						$config2['upload_path'] =  getcwd() . '/uploads/products/';
						$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
						$config2['maintain_ratio'] = FALSE;
						$this->image_lib->initialize($config2);
						if (!$this->image_lib->resize()) {
							echo ('<pre>');
							echo ($this->image_lib->display_errors());
							exit;
						} else {
							$image  = $_POST['prod_image'];
							@unlink('uploads/products/' . $_POST['old_image']);
						}
						$data_image = array(
							'prod_id' => $insert_id,
							'prod_image' => $image,
							'created_date' => date("Y-m-d H:i:s"),
						);
						$this->Crud_model->SaveData('user_product_image', $data_image);
						$this->session->set_flashdata('message', 'Product Created Successfully !');
					}
				}
			}
			redirect(base_url('product'));
		}
		$data1['title'] = 'Add Product';
		$this->load->view('header', $data1);
		$this->load->view('user_dashboard/product/form', $data1);
		$this->load->view('footer');
	}
	public function update_product($id) {
		$product_id = base64_decode($id);
		$update_product = $this->Crud_model->get_single('user_product', "id='" . $product_id . "'");
		$data = array(
			'button' => 'update',
			'action' => base_url('user/Dashboard/edit_product'),
			'product' => $update_product->prod_name,
			'description' => $update_product->prod_description,
			'id' => $update_product->id,
		);
		$data1['title'] = 'Update Product';
		$this->load->view('header', $data1);
		$this->load->view('user_dashboard/product/form', $data);
		$this->load->view('footer');
	}
	public function edit_product() {
		$id = $_POST['id'];
		$data = array(
			'prod_name' => $this->input->post('prod_name', TRUE),
			'prod_description' => $this->input->post('prod_description', TRUE),
		);
		$updateQuery = $this->Crud_model->SaveData('user_product', $data, "id='".$id."'");
		if (!empty($_FILES['prod_image']['name'][0])) {
			$cpt = count($_FILES['prod_image']['name']);
			for($i=0; $i<$cpt; $i++) {
				$_POST['prod_image'] = rand(0000, 9999) . "_" . $_FILES['prod_image']['name'][$i];
				$config2['image_library'] = 'gd2';
				$config2['source_image'] =  $_FILES['prod_image']['tmp_name'][$i];
				$config2['new_image'] =   getcwd() . '/uploads/products/'.$_POST['prod_image'];
				$config2['upload_path'] =  getcwd() . '/uploads/products/';
				$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
				$config2['maintain_ratio'] = FALSE;
				$this->image_lib->initialize($config2);
				if (!$this->image_lib->resize()) {
					echo ('<pre>');
					echo ($this->image_lib->display_errors());
					exit;
				} else {
					$image  = $_POST['prod_image'];
					@unlink('uploads/products/' . $_POST['old_image']);
				}
				$data_image = array(
					'prod_id' => $_POST['id'],
					'prod_image' => $image,
					'created_date' => date("Y-m-d H:i:s"),
				);
				$this->Crud_model->SaveData('user_product_image', $data_image);
			}
		}
		$this->session->set_flashdata('message', 'Product Updated Successfully !');
		redirect(base_url('product'));
	}
	function delete_product() {
		$p_id = $this->input->post('id');
		$delete_prod = $this->db->query("UPDATE user_product SET is_delete = '2' WHERE id = '$p_id'");
		if($delete_prod > 0){
			echo '1';
		} else {
			echo '2';
		}
	}
	function delete_job() {
		$p_id = $this->input->post('id');
		$delete_prod = $this->db->query("DELETE FROM postjob WHERE id = '$p_id'");
		if($delete_prod > 0){
			$this->db->query("DELETE FROM postjob_image WHERE id = '".$p_id."'");
            echo '1';
		} else {
			echo '2';
		}
	}
	function delete_job_image() {
		$p_id = $this->input->post('id');
		$delete_prod = $this->db->query("DELETE FROM postjob_image WHERE id = '".$p_id."'");
	}
	public function postComment() {
        if (!empty($_POST['comment_id'])) {
            $commentData = array(
                'user_id' => $_POST['user_id'],
                'postjob_id' => $_POST['postjob_id'],
                'comment_id' => $_POST['comment_id'],
                'comment' => $_POST['comment'],
                'created_at'=>date('Y-m-d H:i:s'),
            );
            $this->Crud_model->SaveData('postjob_comment_rply', $commentData);
        } else {
            $commentData = array(
                'user_id' => $_POST['user_id'],
                'postjob_id' => $_POST['postjob_id'],
                'comment' => $_POST['comment'],
                'created_at'=>date('Y-m-d H:i:s'),
            );
            $this->Crud_model->SaveData('postjob_comment', $commentData);
        }
        $insert_id = $this->db->insert_id();
        if ($insert_id > 0) {
            echo "Post comment successfully.";
        } else {
            echo "Error while posting comment.";
        }
    }
	public function postUserReply() {
        if (!empty($_POST['comment_id'])) {
            $commentData = array(
                'user_id' => $_POST['user_id'],
                'postjob_id' => $_POST['postjob_id'],
                'comment_id' => $_POST['comment_id'],
                'comment' => $_POST['comment'],
                'created_at'=>date('Y-m-d H:i:s'),
            );
            $this->Crud_model->SaveData('postjob_comment_rply', $commentData);
        } else {
            $commentData = array(
                'user_id' => $_POST['user_id'],
                'postjob_id' => $_POST['postjob_id'],
                'comment' => $_POST['comment'],
                'created_at'=>date('Y-m-d H:i:s'),
            );
            $this->Crud_model->SaveData('postjob_comment', $commentData);
        }
        $insert_id = $this->db->insert_id();
        if ($insert_id > 0) {
            echo "Replied";
        } else {
            echo "Error while replying";
        }
    }
	public function likepostjob() {
        $likeData = array(
            'user_id' => $_POST['user_id'],
            'postjob_id' => $_POST['postjob_id'],
            'is_liked' => 1,
            'created_at'=>date('Y-m-d H:i:s', time()),
        );
        $isExistLikedSql = "SELECT * FROM postjob_like WHERE user_id = '".$_POST['user_id']."' AND postjob_id = '".$_POST['postjob_id']."'";
        $isExist = $this->db->query($isExistLikedSql)->num_rows();
        if ($isExist == 0) {
            $this->Crud_model->SaveData('postjob_like', $likeData);
            $insert_id = $this->db->insert_id();
            if ($insert_id > 0) {
                echo "Liked";
            } else {
                echo "Error";
            }
        } else {
            $checkisLiked = $this->db->query("SELECT * FROM postjob_like WHERE user_id = '".$_POST['user_id']."' AND postjob_id = '".$_POST['postjob_id']. "'")->row();
            if ($checkisLiked->isliked == '1') {
                $this->db->query("UPDATE postjob_like SET is_liked = '0' WHERE user_id = '".$_POST['user_id']."' AND postjob_id = '".$_POST['postjob_id']. "'");
            } else {
                $this->db->query("UPDATE postjob_like SET is_liked = '1' WHERE user_id = '".$_POST['user_id']."' AND postjob_id = '".$_POST['postjob_id']. "'");
            }
            echo "liked";
        }
    }
	public function likeuserrply() {
        $likeData = array(
            'user_id' => $_POST['user_id'],
            'postjob_id' => $_POST['postjob_id'],
			'comment_id' => $_POST['comment_id'],
            'is_liked' => 1,
            'created_at'=>date('Y-m-d H:i:s', time()),
        );
        $isExistLikedSql = "SELECT * FROM postjob_comment_like WHERE user_id = '".$_POST['user_id']."' AND postjob_id = '".$_POST['postjob_id']."' AND comment_id = '".$_POST['comment_id']."'";
        $isExist = $this->db->query($isExistLikedSql)->num_rows();
        if ($isExist == 0) {
            $this->Crud_model->SaveData('postjob_comment_like', $likeData);
            $insert_id = $this->db->insert_id();
            if ($insert_id > 0) {
                echo "Liked";
            } else {
                echo "Error";
            }
        } else {
            $checkisLiked = $this->db->query("SELECT * FROM postjob_comment_like WHERE user_id = '".$_POST['user_id']."' AND postjob_id = '".$_POST['postjob_id']."' AND comment_id = '".$_POST['comment_id']."'")->row();
            if ($checkisLiked->isliked == '1') {
                $this->db->query("UPDATE postjob_comment_like SET is_liked = '0' WHERE user_id = '".$_POST['user_id']."' AND postjob_id = '".$_POST['postjob_id']."' AND comment_id = '".$_POST['comment_id']."'");
            } else {
                $this->db->query("UPDATE postjob_comment_like SET is_liked = '1' WHERE user_id = '".$_POST['user_id']."' AND postjob_id = '".$_POST['postjob_id']."' AND comment_id = '".$_POST['comment_id']."'");
            }
            echo "liked";
        }
    }
	public function dislikepostjob() {
        $this->db->query("UPDATE postjob_like SET is_liked = '0' WHERE user_id = '".$_POST['user_id']."' AND postjob_id = '".$_POST['postjob_id']. "'");
    }
	public function dislikeuserrply() {
        $this->db->query("UPDATE postjob_comment_like SET is_liked = '0' WHERE user_id = '".$_POST['user_id']."' AND postjob_id = '".$_POST['postjob_id']."' AND comment_id = '".$_POST['comment_id']."'");
    }
    public function reportUser() {
        $toUser = $_POST['toUser'];
        $fromUser = $_POST['fromUser'];
        $reason = $_POST['reason'];
        $data = array(
            'to_user_id' => $toUser,
            'from_user_id' => $fromUser,
            'reason' => $reason,
        );
        $this->Crud_model->SaveData('report_user', $data);
        $insertid = $this->db->insert_id();
        if(!empty($insertid)) {
            echo "1";
        } else {
            echo "Something went wrong. Please try again.";
        }
    }
    public function muteUser() {
        $toUser = $_POST['toUser'];
        $fromUser = $_POST['fromUser'];
        $data = array(
            'to_user_id' => $toUser,
            'from_user_id' => $fromUser,
            'status' => '1'
        );
        $checkMuteUser = $this->db->query("SELECT * FROM mute_user WHERE to_user_id = '".$toUser."' AND from_user_id = '".$fromUser."'")->row();
        if(!empty($checkMuteUser)) {
            $this->db->query("UPDATE mute_user SET status = '1' WHERE to_user_id = '".$toUser."' AND from_user_id = '".$fromUser."'");
        } else {
            $this->Crud_model->SaveData('mute_user', $data);
        }
        echo "1";
    }
    public function unmuteUser() {
        $toUser = $_POST['toUser'];
        $fromUser = $_POST['fromUser'];
        $data = array(
            'to_user_id' => $toUser,
            'from_user_id' => $fromUser,
            'status' => '0'
        );
        $this->db->query("UPDATE mute_user SET status = '0' WHERE to_user_id = '".$toUser."' AND from_user_id = '".$fromUser."'");
        echo "1";
    }
    function get_time_ago($time) {
        $time_ago = time() - $time;
        if ($time_ago < 60) {
            return $time_ago . ' second ago';
        }
        $minutes = floor($time_ago / 60);
        if ($minutes < 60) {
            return $minutes . ' minutes ago';
        }
        $hours = floor($time_ago / 3600);
        if ($hours < 24) {
            return $hours . ' hours ago';
        }
        $days = floor($time_ago / 86400);
        if ($days < 7) {
            return $days . ' days ago';
        }
        $weeks = floor($time_ago / 604800);
        if ($weeks < 4) {
            return $weeks . ' weeks ago';
        }
        $months = floor($time_ago / 2628000); // Approximate value
        if ($months < 12) {
            return $months . ' months ago';
        }
        $years = floor($time_ago / 31536000); // Approximate value
        return $years . ' years ago';
    }
    public function get_feed_data() {
        $id = $_POST['id'];
        $lat = $_POST['latitude'];
        $lon = $_POST['longitude'];
        if($id == '1') {
            $get_post = $this->Crud_model->GetData('postjob', 'id, post_title, description, user_id, created_date', "status='Active'", '', '(id)desc', '');
        } else {
            $get_post = $this->db->query("SELECT *, (6367 * acos(cos(radians('".$lat."')) * cos(radians(`latitude`)) * cos(radians(`longitude`) - radians('".$lon."')) + sin(radians('".$lat."')) * sin(radians(`latitude`)))) AS distance FROM `postjob` having `distance` < 10  AND (status = 'Active' ) ORDER BY distance ASC")->result();
        }
        if (!empty($get_post)) {
            foreach ($get_post as $row) {
                $get_user = $this->db->query("SELECT * FROM users WHERE userId = '$row->user_id'")->row(); ?>
                <div class="DataContainer postblockElement" >
                    <!-- <div id="loader_<?= $row->id?>" style="background: #21252954;position: absolute;width: 96%;text-align: center;margin-top: 0px;border-radius: 20px;" class="d-none">
                        <img src="<?= base_url('uploads/loader.gif'); ?>" style="padding: 122px;">
                    </div> -->
                    <div class="boxuppost">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="InfoBlock" style="display: flex; flex-direction: row; height: 70px; align-items: center; justify-content: flex-start;">
                                <?php if (!empty($get_user->profilePic) && file_exists('uploads/users/' . $get_user->profilePic)) { ?>
                                    <img style="width:70px; height: 70px; border-radius: 100%; object-fit: cover;" src="<?= base_url() ?>uploads/users/<?= $get_user->profilePic ?>" alt="">
                                <?php } else { ?>
                                    <img style="width: 70px; height: 70px; border-radius: 100%; object-fit: cover;" src="<?= base_url() ?>uploads/no_pimage.png" alt="">
                                <?php } ?>
                                <div class="TextData" style="display: flex; flex-direction: column; align-items: flex-start; justify-content: center; padding-left: 15px;">
                                    <h3 style="font-size: 20px; font-weight: 600; margin: 0; color: #000;"><?= "@".$get_user->username?>
                                    </h3>
                                    <p style="margin: 0; font-size: 13px; color: #b1b1b1;">Posted <?php echo $this->get_time_ago(strtotime($row->created_date)) ?></p>
                                </div>
                            </div>
                            <?php if(@$_SESSION['afrebay']['userId'] === @$row->user_id) { ?>
                            <div>
                                <div class="btn-group dropleft dropPost">
                                    <a class="dotsdrop"  href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-regular fa-ellipsis-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu  dropdown-menu-lg-right">
                                        <!-- <a class="dropdown-item" href="<?= base_url()?>update-postjob/<?= base64_encode($row->id)?>">Edit Post</a> -->
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="jobDelete(<?= $row->id ?>)">Delete Post</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <p class="CommentData" style="margin-top: 15px;margin-bottom:8px;font-size: 14px;color: #000;line-height: 25px;"><?= ucfirst($row->post_title) ?></p>
                        <?php if(!empty($row->category_id)) {
                            $get_category = $this->db->query("SELECT * FROM category WHERE id = '".$row->category_id."'")->row();
                        } ?>
                        <p class="CommentData" style="margin-top: 8px;margin-bottom: 8px;font-size: 14px;color: #2892ff;line-height: 18px;"> <?= "#".ucfirst(str_replace(' ', '', $get_category->category_name)) ?></p>
                        <div class="imageData">
                            <?php
                            $getImage = $this->db->query("SELECT * FROM postjob_image WHERE job_id = '".$row->id."'")->result_array();
                            $max_display = 4;
                            $total_image = count($getImage);
                            //echo "<pre>"; print_r($getImage);
                            for ($i = 0; $i < min($total_image, $max_display); $i++) { ?>
                            <div class="box-image<?php if($total_image > 4) {echo $max_display;} else {echo $total_image;} ?>">
                                <?php
                                $extension = strtolower(pathinfo($getImage[$i]['job_image'], PATHINFO_EXTENSION));
                                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) { ?>
                                <img src="<?php base_url()?>uploads/postjob/<?= $getImage[$i]['job_image']?>" class="postImageData">
                                <?php if ($i===$max_display - 1 && $total_image > $max_display) {?>
                                <div class="extra-images">+<?php echo $total_image - $max_display?></div>
                                <?php } } elseif (in_array($extension, ['mp4', 'webm', 'avi', 'mov'])) { ?>
                                <video width="100%" controls>
                                <source src="<?= base_url('uploads/postjob/'.$getImage[$i]['job_image']); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                                </video>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                        <input type="hidden" name="postjobID" id="postjobID" value="<?= $row->id ?>">
                        <input type="hidden" name="userID" id="userID" value="<?= @$_SESSION['afrebay']['userId'] ?>">

                        <div class="Rply_Comment_Block" style="display: flex; flex-direction: row; align-items: center; justify-content: space-between;">
                            <div class="Active_Icon_Block" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; width: 50%; ">
                                <?php if (!empty(@$_SESSION['afrebay']['userType'])) {
                                $chechis_like = $this->db->query("SELECT * FROM postjob_like WHERE postjob_id = '" . $row->id . "' AND user_id = '" . @$_SESSION['afrebay']['userId'] . "' AND is_liked = 1")->num_rows();
                                if ($chechis_like > 0) { ?>
                                <a href="javascript:void(0)" class="Icon_1" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start;" onclick="dislikepostjob(<?= $row->id ?>)">
                                <span><i class="fa fa-heart" aria-hidden="true"></i></span>
                                <?php } else { ?>
                                <a href="javascript:void(0)" class="Icon_1" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start;" onclick="likepostjob(<?= $row->id ?>)">
                                <span><i class="fa-regular fa-heart"></i></span>
                                <?php } } else  { ?>
                                <a href="javascript:void(0)" class="Icon_1" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start;" onclick="forguestAlert()">
                                <span><i class="fa-regular fa-heart"></i></span>
                                <?php } ?>
                                    <?php $getLikeCount = $this->db->query("SELECT COUNT(id) as count FROM postjob_like WHERE postjob_id = '" . $row->id . "' AND is_liked = 1")->row(); ?>
                                    <p style="margin: 0; margin-left: 5px; font-size: 14px; font-weight: 500; "><?= $getLikeCount->count ?> </p>
                                </a>
                                <a href="#" class="Icon_2" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; margin-left: 20px;">
                                    <span><i class="fa-regular fa-comment-dots"></i></span>
                                    <?php $getCommentCount = $this->db->query("SELECT COUNT(id) as count FROM postjob_comment WHERE postjob_id = '" . $row->id . "'")->row(); ?>
                                    <p style="margin: 0; margin-left: 5px; font-size: 15px; font-weight: 500;"><?= $getCommentCount->count; ?> </p>
                                </a>
                                <a href="#" class="Icon_2" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; margin-left: 20px;">
                                    <span><i class="fa-regular fa-share-nodes"></i></span>

                                    <p style="margin: 0; margin-left: 5px; font-size: 15px; font-weight: 500;">0</p>
                                </a>
                            </div>
                            <ul style="margin: 0; display: flex; align-items: center; justify-content: flex-end; flex-direction: row; width: 250px; float: right;">
                                <li class="mb-0" onclick="onclickShare(<?= $row->id ?>)">
                                    <a href="javascript:void(0)" class="shareBtn1"> <i class="fa-solid fa-share"></i> Share</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Comment Btn -->
                    <!-- Comment Data -->
                    <?php
                    $getpostComment = $this->db->query("SELECT * FROM postjob_comment WHERE postjob_id = '" . @$row->id . "'")->result_array();
                    if (!empty($getpostComment)) {
                        $i = 1;
                        foreach ($getpostComment as $each) {
                            $rplycount = $this->db->query("SELECT COUNT(id) as count FROM postjob_comment_like  WHERE postjob_id = '" . @$row->id . "' AND comment_id = '" . $each['id'] . "' AND is_liked = 1")->row();
                    ?>
                    <div class="Comment_Block replyComment" style="display: flex; flex-direction: column; ">
                        <div class="Comment_Block_Container" style="flex-direction: row; align-items: flex-start; justify-content: flex-start; display: flex; width: 100%;">
                            <div class="Comment_Img" style="min-width: 50px;">
                                <?php
                                $userData = $this->db->query("SELECT * FROM users WHERE userId = '" . $each['user_id'] . "'")->row();
                                if (!empty($userData->profilePic) && file_exists('uploads/users/' . $userData->profilePic)) { ?>
                                    <img style="width: 45px; height: 45px; border-radius: 100%; object-fit: cover;" src="<?= base_url() ?>uploads/users/<?= $userData->profilePic ?>" alt="User Profile">
                                <?php } else { ?>
                                    <img style="width: 45px; height: 45px; border-radius: 100%; object-fit: cover;" src="<?= base_url() ?>uploads/no_pimage.png" alt="User Profile">
                                <?php } ?>
                            </div>
                            <div class="User_Comment_Data" style="width: 92%; display: flex; flex-direction: column;">
                                <div class="replyPost">
                                    <p style="margin: 0; font-weight: 600; color: #000 !important;"> <?= "@".$userData->username;?> .
                                        <span style=" color: #6a6a6a; font-weight: 400;"><?php echo $this->get_time_ago(strtotime($each['created_at'])) ?></span>
                                    </p>
                                    <p style="margin-bottom: 0; "><?= $each['comment']; ?></p>
                                </div>
                                <ul style="margin: 0; display: flex; align-items: center; justify-content: flex-start; margin-top: 10px;">
                                    <li style="margin: 0 25px 0 0 !important; font-size: 14px; color: #000 !important; font-weight: 600;">
                                        <?php if (!empty(@$_SESSION['afrebay']['userType'])) {
                                            $checkrplycount = $this->db->query("SELECT * FROM postjob_comment_like WHERE user_id = '" . @$_SESSION['afrebay']['userId'] . "' AND postjob_id = '" . @$row->id . "' AND comment_id = '" . $each['id'] . "' AND is_liked = 1")->row();
                                            if ($checkrplycount > 0) { ?>
                                                <a style="color: #000 !important;" href="javascript:void(0)" onclick="dislikeuserrply(<?= $row->id ?>, <?= $each['id'] ?>)"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                            <?php } else { ?>
                                                <a style="color: #000 !important;" href="javascript:void(0)" onclick="likeuserrply(<?= $row->id ?>, <?= $each['id'] ?>)"><i class="fa-regular fa-heart"></i></a>
                                            <?php }
                                        } else { ?>
                                            <a style="color: #000 !important;" href="<?= base_url() ?>login"><i class="fa-regular fa-heart"></i></a>
                                        <?php } ?>
                                    </li>
                                    <?php if (!empty(@$_SESSION['afrebay']['userType'])) { ?>
                                        <li style="margin: 0 !important; font-size: 13px; color: #000 !important; font-weight: 600;">
                                            <a style="color: #000 !important;" href="javascript:void(0)" onclick="replylink(<?= $row->id; ?>, <?= $each['id']; ?>)"><i class="fa-sharp fa-regular fa-reply-all"></i></a>
                                        </li>
                                    <?php } else { ?>
                                        <li style="margin: 0 !important; font-size: 13px; color: #000 !important; font-weight: 600;">
                                            <a style="color: #000 !important;" href="<?= base_url() ?>login"><i class="fa-sharp fa-regular fa-reply-all"></i></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <!-- <div style="height: 148px; overflow-y: scroll;"> -->
                                <?php
                                $commentRply = $this->db->query("SELECT * FROM postjob_comment_rply WHERE comment_id = '" . $each['id'] . "'")->result_array();
                                if (!empty($commentRply)) {
                                    foreach ($commentRply as $rply) {
                                        $userDataRply = $this->db->query("SELECT * FROM users WHERE userId = '" . $rply['user_id'] . "'")->row(); ?>
                                        <div class="replyPost mt-2" style="margin-left: 30px;">
                                            <p style="font-weight: 600;color: #000 !important;"><?= "@".$userDataRply->username;?> .
                                                <span style="font-size: 13px; color: #6a6a6a; font-weight: 400;"><?php echo $this->get_time_ago(strtotime($rply['created_at'])) ?></span>
                                            </p>
                                            <p><?= $rply['comment']; ?></p>
                                        </div>
                                <?php }
                                } ?>
                                <!-- </div> -->
                                <div class="replyBox mt-3" id="replyBox_<?= $each['id']; ?>">
                                    <textarea required="" name="users_rply_<?= $each['id']; ?>" id="users_rply_<?= $each['id']; ?>" placeholder="Reply"></textarea>
                                    <a href="javascript:void(0)" class="replySubmit" onclick="postUserComment(<?= $row->id; ?>, <?= $each['id']; ?>)">
                                        Reply
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++; } } ?>
                    <div class="boxdownpost">
                        <div class="d-flex">
                            <div class="commnetUser">
                                <img src="<?= base_url(); ?>uploads/no_pimage.png">
                            </div>
                            <div class="Comment_Mobile position-relative flex-fill w-100">
                                <textarea class="postComment mt-0 form-control f1 emoji_act" type="text" placeholder="Enter your comments" name="comment_<?= $row->id ?>" id="comment_<?= $row->id ?>"></textarea>
                                <div>
                                    <?php if (!empty(@$_SESSION['afrebay']['userType'])) { ?>
                                        <a href="javascript:void(0)" class="postCommentbtn" onclick="postComment(<?= $row->id ?>)">
                                            <span >Comment</span>
                                        </a>
                                    <?php } else { ?>
                                        <a href="<?= base_url() ?>login" class="postCommentbtn">
                                            <span >Comment</span>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
        } else {
            echo '<div class="col-12" style=" background: #fff; border-radius: 20px; "><div class="boxuppost">No post available</div></div>';
        }
    }

    public function search_post() {
        $year = $_POST['year'];
        $postedBy = $_POST['postedBy'];
        $privacy = $_POST['privacy'];
        if(isset($year) || isset($postedBy) || isset($privacy)) {
            $query = "SELECT * FROM postjob WHERE status = 'Active'";
            if(!empty($year)) {
                $query .= " AND created_date like '%".$year."%'";
            }
            if(!empty($postedBy)) {
                if($postedBy == '2') {
                    $query .= " AND user_id = '".$_SESSION['afrebay']['userId']."'";
                } else {
                    $query .= " AND 1=1";
                }
            }
            if(!empty($privacy)) {
                $query .= " AND visibility = '".$privacy."'";
            }
            $get_post = $this->db->query($query)->result();
        }
        if (!empty($get_post)) {
            foreach ($get_post as $row) {
                $get_user = $this->db->query("SELECT * FROM users WHERE userId = '$row->user_id'")->row(); ?>
                <div class="DataContainer postblockElement" >
                    <!-- <div id="loader_<?= $row->id?>" style="background: #21252954;position: absolute;width: 96%;text-align: center;margin-top: 0px;border-radius: 20px;" class="d-none">
                        <img src="<?= base_url('uploads/loader.gif'); ?>" style="padding: 122px;">
                    </div> -->
                    <div class="boxuppost">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="InfoBlock" style="display: flex; flex-direction: row; height: 70px; align-items: center; justify-content: flex-start;">
                                <?php if (!empty($get_user->profilePic) && file_exists('uploads/users/' . $get_user->profilePic)) { ?>
                                    <img style="width:70px; height: 70px; border-radius: 100%; object-fit: cover;" src="<?= base_url() ?>uploads/users/<?= $get_user->profilePic ?>" alt="">
                                <?php } else { ?>
                                    <img style="width: 70px; height: 70px; border-radius: 100%; object-fit: cover;" src="<?= base_url() ?>uploads/no_pimage.png" alt="">
                                <?php } ?>
                                <div class="TextData" style="display: flex; flex-direction: column; align-items: flex-start; justify-content: center; padding-left: 15px;">
                                    <h3 style="font-size: 20px; font-weight: 600; margin: 0; color: #000;"><?= "@".$get_user->username?>
                                    <p style="margin: 0; font-size: 13px; color: #b1b1b1;">Posted <?php echo $this->get_time_ago(strtotime($row->created_date)) ?></p>
                                </div>
                            </div>
                            <?php if(@$_SESSION['afrebay']['userId'] === @$row->user_id) { ?>
                            <div>
                                <div class="btn-group dropleft dropPost">
                                    <a class="dotsdrop"  href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-regular fa-ellipsis-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu  dropdown-menu-lg-right">
                                        <!-- <a class="dropdown-item" href="<?= base_url()?>update-postjob/<?= base64_encode($row->id)?>">Edit Post</a> -->
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="jobDelete(<?= $row->id ?>)">Delete Post</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <p class="CommentData" style="margin-top: 15px;margin-bottom:8px;font-size: 14px;color: #000;line-height: 25px;"><?= ucfirst($row->post_title) ?></p>
                        <?php if(!empty($row->category_id)) {
                                            $get_category = $this->db->query("SELECT * FROM category WHERE id = '".$row->category_id."'")->row();
                                        } ?>
                                        <p class="CommentData" style="margin-top: 8px;margin-bottom: 8px;font-size: 14px;color: #2892ff;line-height: 18px;"> <?= "#".ucfirst(str_replace(' ', '', $get_category->category_name)) ?></p>
                        <div class="imageData">
                            <?php
                            $getImage = $this->db->query("SELECT * FROM postjob_image WHERE job_id = '".$row->id."'")->result_array();
                            $max_display = 4;
                            $total_image = count($getImage);
                            //echo "<pre>"; print_r($getImage);
                            for ($i = 0; $i < min($total_image, $max_display); $i++) { ?>
                            <div class="box-image<?php if($total_image > 4) {echo $max_display;} else {echo $total_image;} ?>">
                                <?php
                                $extension = strtolower(pathinfo($getImage[$i]['job_image'], PATHINFO_EXTENSION));
                                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) { ?>
                                <img src="<?php base_url()?>uploads/postjob/<?= $getImage[$i]['job_image']?>" class="postImageData">
                                <?php if ($i===$max_display - 1 && $total_image > $max_display) {?>
                                <div class="extra-images">+<?php echo $total_image - $max_display?></div>
                                <?php } } elseif (in_array($extension, ['mp4', 'webm', 'avi', 'mov'])) { ?>
                                <video width="100%" controls>
                                <source src="<?= base_url('uploads/postjob/'.$getImage[$i]['job_image']); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                                </video>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                        <input type="hidden" name="postjobID" id="postjobID" value="<?= $row->id ?>">
                        <input type="hidden" name="userID" id="userID" value="<?= @$_SESSION['afrebay']['userId'] ?>">

                        <div class="Rply_Comment_Block" style="display: flex; flex-direction: row; align-items: center; justify-content: space-between;">
                            <div class="Active_Icon_Block" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; width: 50%; ">
                                <?php if (!empty(@$_SESSION['afrebay']['userType'])) {
                                $chechis_like = $this->db->query("SELECT * FROM postjob_like WHERE postjob_id = '" . $row->id . "' AND user_id = '" . @$_SESSION['afrebay']['userId'] . "' AND is_liked = 1")->num_rows();
                                if ($chechis_like > 0) { ?>
                                <a href="javascript:void(0)" class="Icon_1" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start;" onclick="dislikepostjob(<?= $row->id ?>)">
                                <span><i class="fa fa-heart" aria-hidden="true"></i></span>
                                <?php } else { ?>
                                <a href="javascript:void(0)" class="Icon_1" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start;" onclick="likepostjob(<?= $row->id ?>)">
                                <span><i class="fa-regular fa-heart"></i></span>
                                <?php } } else  { ?>
                                <a href="javascript:void(0)" class="Icon_1" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start;" onclick="forguestAlert()">
                                <span><i class="fa-regular fa-heart"></i></span>
                                <?php } ?>
                                    <?php $getLikeCount = $this->db->query("SELECT COUNT(id) as count FROM postjob_like WHERE postjob_id = '" . $row->id . "' AND is_liked = 1")->row(); ?>
                                    <p style="margin: 0; margin-left: 5px; font-size: 14px; font-weight: 500; "><?= $getLikeCount->count ?> </p>
                                </a>
                                <a href="#" class="Icon_2" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; margin-left: 20px;">
                                    <span><i class="fa-regular fa-comment-dots"></i></span>
                                    <?php $getCommentCount = $this->db->query("SELECT COUNT(id) as count FROM postjob_comment WHERE postjob_id = '" . $row->id . "'")->row(); ?>
                                    <p style="margin: 0; margin-left: 5px; font-size: 15px; font-weight: 500;"><?= $getCommentCount->count; ?> </p>
                                </a>
                                <a href="#" class="Icon_2" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; margin-left: 20px;">
                                    <span><i class="fa-regular fa-share-nodes"></i></span>

                                    <p style="margin: 0; margin-left: 5px; font-size: 15px; font-weight: 500;">0</p>
                                </a>
                            </div>
                            <ul style="margin: 0; display: flex; align-items: center; justify-content: flex-end; flex-direction: row; width: 250px; float: right;">
                                <li class="mb-0" onclick="onclickShare(<?= $row->id ?>)">
                                    <a href="javascript:void(0)" class="shareBtn1"> <i class="fa-solid fa-share"></i> Share</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Comment Btn -->
                    <!-- Comment Data -->
                    <?php
                    $getpostComment = $this->db->query("SELECT * FROM postjob_comment WHERE postjob_id = '" . @$row->id . "'")->result_array();
                    if (!empty($getpostComment)) {
                        $i = 1;
                        foreach ($getpostComment as $each) {
                            $rplycount = $this->db->query("SELECT COUNT(id) as count FROM postjob_comment_like  WHERE postjob_id = '" . @$row->id . "' AND comment_id = '" . $each['id'] . "' AND is_liked = 1")->row();
                    ?>
                    <div class="Comment_Block replyComment" style="display: flex; flex-direction: column; ">
                        <div class="Comment_Block_Container" style="flex-direction: row; align-items: flex-start; justify-content: flex-start; display: flex; width: 100%;">
                            <div class="Comment_Img" style="min-width: 50px;">
                                <?php
                                $userData = $this->db->query("SELECT * FROM users WHERE userId = '" . $each['user_id'] . "'")->row();
                                if (!empty($userData->profilePic) && file_exists('uploads/users/' . $userData->profilePic)) { ?>
                                    <img style="width: 45px; height: 45px; border-radius: 100%; object-fit: cover;" src="<?= base_url() ?>uploads/users/<?= $userData->profilePic ?>" alt="User Profile">
                                <?php } else { ?>
                                    <img style="width: 45px; height: 45px; border-radius: 100%; object-fit: cover;" src="<?= base_url() ?>uploads/no_pimage.png" alt="User Profile">
                                <?php } ?>
                            </div>
                            <div class="User_Comment_Data" style="width: 92%; display: flex; flex-direction: column;">
                                <div class="replyPost">
                                    <p style="margin: 0; font-weight: 600; color: #000 !important;"><?= "@".$userData->username;?> .
                                        <span style=" color: #6a6a6a; font-weight: 400;"><?php echo $this->get_time_ago(strtotime($each['created_at'])) ?></span>
                                    </p>
                                    <p style="margin-bottom: 0; "><?= $each['comment']; ?></p>
                                </div>
                                <ul style="margin: 0; display: flex; align-items: center; justify-content: flex-start; margin-top: 10px;">
                                    <li style="margin: 0 25px 0 0 !important; font-size: 14px; color: #000 !important; font-weight: 600;">
                                        <?php if (!empty(@$_SESSION['afrebay']['userType'])) {
                                            $checkrplycount = $this->db->query("SELECT * FROM postjob_comment_like WHERE user_id = '" . @$_SESSION['afrebay']['userId'] . "' AND postjob_id = '" . @$row->id . "' AND comment_id = '" . $each['id'] . "' AND is_liked = 1")->row();
                                            if ($checkrplycount > 0) { ?>
                                                <a style="color: #000 !important;" href="javascript:void(0)" onclick="dislikeuserrply(<?= $row->id ?>, <?= $each['id'] ?>)"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                            <?php } else { ?>
                                                <a style="color: #000 !important;" href="javascript:void(0)" onclick="likeuserrply(<?= $row->id ?>, <?= $each['id'] ?>)"><i class="fa-regular fa-heart"></i></a>
                                            <?php }
                                        } else { ?>
                                            <a style="color: #000 !important;" href="<?= base_url() ?>login"><i class="fa-regular fa-heart"></i></a>
                                        <?php } ?>
                                    </li>
                                    <?php if (!empty(@$_SESSION['afrebay']['userType'])) { ?>
                                        <li style="margin: 0 !important; font-size: 13px; color: #000 !important; font-weight: 600;">
                                            <a style="color: #000 !important;" href="javascript:void(0)" onclick="replylink(<?= $row->id; ?>, <?= $each['id']; ?>)"><i class="fa-sharp fa-regular fa-reply-all"></i></a>
                                        </li>
                                    <?php } else { ?>
                                        <li style="margin: 0 !important; font-size: 13px; color: #000 !important; font-weight: 600;">
                                            <a style="color: #000 !important;" href="<?= base_url() ?>login"><i class="fa-sharp fa-regular fa-reply-all"></i></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <!-- <div style="height: 148px; overflow-y: scroll;"> -->
                                <?php
                                $commentRply = $this->db->query("SELECT * FROM postjob_comment_rply WHERE comment_id = '" . $each['id'] . "'")->result_array();
                                if (!empty($commentRply)) {
                                    foreach ($commentRply as $rply) {
                                        $userDataRply = $this->db->query("SELECT * FROM users WHERE userId = '" . $rply['user_id'] . "'")->row(); ?>
                                        <div class="replyPost mt-2" style="margin-left: 30px;">
                                            <p style="font-weight: 600;color: #000 !important;"><?= "@".$userDataRply->username;?> .
                                                <span style="font-size: 13px; color: #6a6a6a; font-weight: 400;"><?php echo $this->get_time_ago(strtotime($rply['created_at'])) ?></span>
                                            </p>
                                            <p><?= $rply['comment']; ?></p>
                                        </div>
                                <?php }
                                } ?>
                                <!-- </div> -->
                                <div class="replyBox mt-3" id="replyBox_<?= $each['id']; ?>">
                                    <textarea required="" name="users_rply_<?= $each['id']; ?>" id="users_rply_<?= $each['id']; ?>" placeholder="Reply"></textarea>
                                    <a href="javascript:void(0)" class="replySubmit" onclick="postUserComment(<?= $row->id; ?>, <?= $each['id']; ?>)">
                                        Reply
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++; } } ?>
                    <div class="boxdownpost">
                        <div class="d-flex">
                            <div class="commnetUser">
                                <img src="<?= base_url(); ?>uploads/no_pimage.png">
                            </div>
                            <div class="Comment_Mobile position-relative flex-fill w-100">
                                <textarea class="postComment mt-0 form-control f1 emoji_act" type="text" placeholder="Enter your comments" name="comment_<?= $row->id ?>" id="comment_<?= $row->id ?>"></textarea>
                                <div>
                                    <?php if (!empty(@$_SESSION['afrebay']['userType'])) { ?>
                                        <a href="javascript:void(0)" class="postCommentbtn" onclick="postComment(<?= $row->id ?>)">
                                            <span >Comment</span>
                                        </a>
                                    <?php } else { ?>
                                        <a href="<?= base_url() ?>login" class="postCommentbtn">
                                            <span >Comment</span>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
        } else {
            echo '<div class="col-12" style=" background: #fff; border-radius: 20px; "><div class="boxuppost">No post available</div></div>';
        }
    }

    public function savePost() {
        $post_id = $_POST['p_id'];
        $user_id =  $_SESSION['afrebay']['userId'];
        $details_data = array(
            'post_id' => $post_id,
            'user_id' => $user_id,
            'status' => '1',
            'created_at'=> date('Y-m-d H:m:s')
        );
        //print_r($details_data); die();
        $this->Crud_model->SaveData('users_save_post',$details_data);
    }

    public function searchPostData() {
        $search_box = $_POST['search_box'];
        $category = $_POST['category'];
        $distance = $_POST['distance'];
        $lat = $_POST['search_lat'];
        $lon = $_POST['search_lon'];
        if($distance == '1') {
            $query = "SELECT * FROM postjob WHERE visibility = '1' AND status = 'Active' AND is_delete = '0'";
        } else {
            $query = "SELECT *, (6367 * acos(cos(radians('".$lat."')) * cos(radians(`latitude`)) * cos(radians(`longitude`) - radians('".$lon."')) + sin(radians('".$lat."')) * sin(radians(`latitude`)))) AS distance FROM `postjob` Having `distance` < 10  AND visibility = '1' AND status = 'Active' AND is_delete = '0'";
        }

        if(isset($search_box) && !empty($search_box)) {
            $query .= " AND post_title like '%".$search_box."%'";
        }

        if(isset($category) && !empty($category)) {
            if($category == '0') {
                $query .= " AND category_id != '0'";
            } else {
                $query .= " AND category_id = '".$category."'";
            }
        }
        $get_post = $this->db->query($query)->result();
        if (!empty($get_post)) {
            foreach ($get_post as $row) {
                $get_user = $this->db->query("SELECT * FROM users WHERE userId = '$row->user_id'")->row(); ?>
                <div class="DataContainer postblockElement" >
                    <!-- <div id="loader_<?= $row->id?>" style="background: #21252954;position: absolute;width: 96%;text-align: center;margin-top: 0px;border-radius: 20px;" class="d-none">
                        <img src="<?= base_url('uploads/loader.gif'); ?>" style="padding: 122px;">
                    </div> -->
                    <div class="boxuppost">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="InfoBlock" style="display: flex; flex-direction: row; height: 70px; align-items: center; justify-content: flex-start;">
                                <?php if (!empty($get_user->profilePic) && file_exists('uploads/users/' . $get_user->profilePic)) { ?>
                                    <img style="width:70px; height: 70px; border-radius: 100%; object-fit: cover;" src="<?= base_url() ?>uploads/users/<?= $get_user->profilePic ?>" alt="">
                                <?php } else { ?>
                                    <img style="width: 70px; height: 70px; border-radius: 100%; object-fit: cover;" src="<?= base_url() ?>uploads/no_pimage.png" alt="">
                                <?php } ?>
                                <div class="TextData" style="display: flex; flex-direction: column; align-items: flex-start; justify-content: center; padding-left: 15px;">
                                    <h3 style="font-size: 20px; font-weight: 600; margin: 0; color: #000;"><?= "@".$get_user->username;?></h3>
                                    <p style="margin: 0; font-size: 13px; color: #b1b1b1;">Posted <?php echo $this->get_time_ago(strtotime($row->created_date)) ?></p>
                                </div>
                            </div>
                            <?php if(@$_SESSION['afrebay']['userId'] === @$row->user_id) { ?>
                            <div>
                                <div class="btn-group dropleft dropPost">
                                    <a class="dotsdrop"  href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-regular fa-ellipsis-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu  dropdown-menu-lg-right">
                                        <!-- <a class="dropdown-item" href="<?= base_url()?>update-postjob/<?= base64_encode($row->id)?>">Edit Post</a> -->
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="jobDelete(<?= $row->id ?>)">Delete Post</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <p class="CommentData" style="margin-top: 15px;margin-bottom:8px;font-size: 14px;color: #000;line-height: 25px;"><?= ucfirst($row->post_title) ?></p>
                        <?php if(!empty($row->category_id)) {
                                            $get_category = $this->db->query("SELECT * FROM category WHERE id = '".$row->category_id."'")->row();
                                        } ?>
                                        <p class="CommentData" style="margin-top: 8px;margin-bottom: 8px;font-size: 14px;color: #2892ff;line-height: 18px;"> <?= "#".ucfirst(str_replace(' ', '', $get_category->category_name)) ?></p>
                        <div class="imageData">
                            <?php
                            $getImage = $this->db->query("SELECT * FROM postjob_image WHERE job_id = '".$row->id."'")->result_array();
                            $max_display = 4;
                            $total_image = count($getImage);
                            //echo "<pre>"; print_r($getImage);
                            for ($i = 0; $i < min($total_image, $max_display); $i++) { ?>
                            <div class="box-image<?php if($total_image > 4) {echo $max_display;} else {echo $total_image;} ?>">
                                <?php
                                $extension = strtolower(pathinfo($getImage[$i]['job_image'], PATHINFO_EXTENSION));
                                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) { ?>
                                <img src="<?php base_url()?>uploads/postjob/<?= $getImage[$i]['job_image']?>" class="postImageData">
                                <?php if ($i===$max_display - 1 && $total_image > $max_display) {?>
                                <div class="extra-images">+<?php echo $total_image - $max_display?></div>
                                <?php } } elseif (in_array($extension, ['mp4', 'webm', 'avi', 'mov'])) { ?>
                                <video width="100%" controls>
                                <source src="<?= base_url('uploads/postjob/'.$getImage[$i]['job_image']); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                                </video>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                        <input type="hidden" name="postjobID" id="postjobID" value="<?= $row->id ?>">
                        <input type="hidden" name="userID" id="userID" value="<?= @$_SESSION['afrebay']['userId'] ?>">

                        <div class="Rply_Comment_Block" style="display: flex; flex-direction: row; align-items: center; justify-content: space-between;">
                            <div class="Active_Icon_Block" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; width: 50%; ">
                                <?php if (!empty(@$_SESSION['afrebay']['userType'])) {
                                $chechis_like = $this->db->query("SELECT * FROM postjob_like WHERE postjob_id = '" . $row->id . "' AND user_id = '" . @$_SESSION['afrebay']['userId'] . "' AND is_liked = 1")->num_rows();
                                if ($chechis_like > 0) { ?>
                                <a href="javascript:void(0)" class="Icon_1" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start;" onclick="dislikepostjob(<?= $row->id ?>)">
                                <span><i class="fa fa-heart" aria-hidden="true"></i></span>
                                <?php } else { ?>
                                <a href="javascript:void(0)" class="Icon_1" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start;" onclick="likepostjob(<?= $row->id ?>)">
                                <span><i class="fa-regular fa-heart"></i></span>
                                <?php } } else  { ?>
                                <a href="javascript:void(0)" class="Icon_1" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start;" onclick="forguestAlert()">
                                <span><i class="fa-regular fa-heart"></i></span>
                                <?php } ?>
                                    <?php $getLikeCount = $this->db->query("SELECT COUNT(id) as count FROM postjob_like WHERE postjob_id = '" . $row->id . "' AND is_liked = 1")->row(); ?>
                                    <p style="margin: 0; margin-left: 5px; font-size: 14px; font-weight: 500; "><?= $getLikeCount->count ?> </p>
                                </a>
                                <a href="#" class="Icon_2" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; margin-left: 20px;">
                                    <span><i class="fa-regular fa-comment-dots"></i></span>
                                    <?php $getCommentCount = $this->db->query("SELECT COUNT(id) as count FROM postjob_comment WHERE postjob_id = '" . $row->id . "'")->row(); ?>
                                    <p style="margin: 0; margin-left: 5px; font-size: 15px; font-weight: 500;"><?= $getCommentCount->count; ?> </p>
                                </a>
                                <a href="#" class="Icon_2" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; margin-left: 20px;">
                                    <span><i class="fa-regular fa-share-nodes"></i></span>

                                    <p style="margin: 0; margin-left: 5px; font-size: 15px; font-weight: 500;">0</p>
                                </a>
                            </div>
                            <ul style="margin: 0; display: flex; align-items: center; justify-content: flex-end; flex-direction: row; width: 250px; float: right;">
                                <li class="mb-0" onclick="onclickShare(<?= $row->id ?>)">
                                    <a href="javascript:void(0)" class="shareBtn1"> <i class="fa-solid fa-share"></i> Share</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Comment Btn -->
                    <!-- Comment Data -->
                    <?php
                    $getpostComment = $this->db->query("SELECT * FROM postjob_comment WHERE postjob_id = '" . @$row->id . "'")->result_array();
                    if (!empty($getpostComment)) {
                        $i = 1;
                        foreach ($getpostComment as $each) {
                            $rplycount = $this->db->query("SELECT COUNT(id) as count FROM postjob_comment_like  WHERE postjob_id = '" . @$row->id . "' AND comment_id = '" . $each['id'] . "' AND is_liked = 1")->row();
                    ?>
                    <div class="Comment_Block replyComment" style="display: flex; flex-direction: column; ">
                        <div class="Comment_Block_Container" style="flex-direction: row; align-items: flex-start; justify-content: flex-start; display: flex; width: 100%;">
                            <div class="Comment_Img" style="min-width: 50px;">
                                <?php
                                $userData = $this->db->query("SELECT * FROM users WHERE userId = '" . $each['user_id'] . "'")->row();
                                if (!empty($userData->profilePic) && file_exists('uploads/users/' . $userData->profilePic)) { ?>
                                    <img style="width: 45px; height: 45px; border-radius: 100%; object-fit: cover;" src="<?= base_url() ?>uploads/users/<?= $userData->profilePic ?>" alt="User Profile">
                                <?php } else { ?>
                                    <img style="width: 45px; height: 45px; border-radius: 100%; object-fit: cover;" src="<?= base_url() ?>uploads/no_pimage.png" alt="User Profile">
                                <?php } ?>
                            </div>
                            <div class="User_Comment_Data" style="width: 92%; display: flex; flex-direction: column;">
                                <div class="replyPost">
                                    <p style="margin: 0; font-weight: 600; color: #000 !important;"><?= "@".$userData->username;?> .
                                        <span style=" color: #6a6a6a; font-weight: 400;"><?php echo $this->get_time_ago(strtotime($each['created_at'])) ?></span>
                                    </p>
                                    <p style="margin-bottom: 0; "><?= $each['comment']; ?></p>
                                </div>
                                <ul style="margin: 0; display: flex; align-items: center; justify-content: flex-start; margin-top: 10px;">
                                    <li style="margin: 0 25px 0 0 !important; font-size: 14px; color: #000 !important; font-weight: 600;">
                                        <?php if (!empty(@$_SESSION['afrebay']['userType'])) {
                                            $checkrplycount = $this->db->query("SELECT * FROM postjob_comment_like WHERE user_id = '" . @$_SESSION['afrebay']['userId'] . "' AND postjob_id = '" . @$row->id . "' AND comment_id = '" . $each['id'] . "' AND is_liked = 1")->row();
                                            if ($checkrplycount > 0) { ?>
                                                <a style="color: #000 !important;" href="javascript:void(0)" onclick="dislikeuserrply(<?= $row->id ?>, <?= $each['id'] ?>)"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                            <?php } else { ?>
                                                <a style="color: #000 !important;" href="javascript:void(0)" onclick="likeuserrply(<?= $row->id ?>, <?= $each['id'] ?>)"><i class="fa-regular fa-heart"></i></a>
                                            <?php }
                                        } else { ?>
                                            <a style="color: #000 !important;" href="<?= base_url() ?>login"><i class="fa-regular fa-heart"></i></a>
                                        <?php } ?>
                                    </li>
                                    <?php if (!empty(@$_SESSION['afrebay']['userType'])) { ?>
                                        <li style="margin: 0 !important; font-size: 13px; color: #000 !important; font-weight: 600;">
                                            <a style="color: #000 !important;" href="javascript:void(0)" onclick="replylink(<?= $row->id; ?>, <?= $each['id']; ?>)"><i class="fa-sharp fa-regular fa-reply-all"></i></a>
                                        </li>
                                    <?php } else { ?>
                                        <li style="margin: 0 !important; font-size: 13px; color: #000 !important; font-weight: 600;">
                                            <a style="color: #000 !important;" href="<?= base_url() ?>login"><i class="fa-sharp fa-regular fa-reply-all"></i></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <!-- <div style="height: 148px; overflow-y: scroll;"> -->
                                <?php
                                $commentRply = $this->db->query("SELECT * FROM postjob_comment_rply WHERE comment_id = '" . $each['id'] . "'")->result_array();
                                if (!empty($commentRply)) {
                                    foreach ($commentRply as $rply) {
                                        $userDataRply = $this->db->query("SELECT * FROM users WHERE userId = '" . $rply['user_id'] . "'")->row(); ?>
                                        <div class="replyPost mt-2" style="margin-left: 30px;">
                                            <p style="font-weight: 600;color: #000 !important;"><?= "@".$userDataRply->username;?> .
                                                <span style="font-size: 13px; color: #6a6a6a; font-weight: 400;"><?php echo $this->get_time_ago(strtotime($rply['created_at'])) ?></span>
                                            </p>
                                            <p><?= $rply['comment']; ?></p>
                                        </div>
                                <?php }
                                } ?>
                                <!-- </div> -->
                                <div class="replyBox mt-3" id="replyBox_<?= $each['id']; ?>">
                                    <textarea required="" name="users_rply_<?= $each['id']; ?>" id="users_rply_<?= $each['id']; ?>" placeholder="Reply"></textarea>
                                    <a href="javascript:void(0)" class="replySubmit" onclick="postUserComment(<?= $row->id; ?>, <?= $each['id']; ?>)">
                                        Reply
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++; } } ?>
                    <div class="boxdownpost">
                        <div class="d-flex">
                            <div class="commnetUser">
                                <img src="<?= base_url(); ?>uploads/no_pimage.png">
                            </div>
                            <div class="Comment_Mobile position-relative flex-fill w-100">
                                <textarea class="postComment mt-0 form-control f1 emoji_act" type="text" placeholder="Enter your comments" name="comment_<?= $row->id ?>" id="comment_<?= $row->id ?>"></textarea>
                                <div>
                                    <?php if (!empty(@$_SESSION['afrebay']['userType'])) { ?>
                                        <a href="javascript:void(0)" class="postCommentbtn" onclick="postComment(<?= $row->id ?>)">
                                            <span >Comment</span>
                                        </a>
                                    <?php } else { ?>
                                        <a href="<?= base_url() ?>login" class="postCommentbtn">
                                            <span >Comment</span>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
        } else {
            echo '<div class="col-12" style=" background: #fff; border-radius: 20px; "><div class="boxuppost">No post available</div></div>';
        }
    }
}