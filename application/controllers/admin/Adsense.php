<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Adsense extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Adsensemodel');
	}
	function index() {
		$get_adsense=$this->Crud_model->GetData('adsense');
		$header = array('title' => 'AdSense');
		$data = array(
			'heading' => 'AdSense',
			'get_adsense' => $get_adsense
		);
		$this->load->view('admin/header', $header);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/adsense/list',$data);
		$this->load->view('admin/footer');
	}
	function ajax_manage_page() {
		$cond = "1=1";
		$adsense = $_POST['SearchData6'];
		$from_date = $_POST['SearchData5'];
		//print_r($from_date); exit;
		//$to_date = $_POST['SearchData7'];
		if($adsense!='') {
			$cond .=" and adsense.id  = '".$adsense."' ";
		}
		if($from_date!='') {
			$cond .=" and adsense.created_date  >= '".date('Y-m-d',strtotime($from_date))."' ";
		}
		// if($to_date!='') {
		// 	$cond .=" and adsense.created_date  <= '".date('Y-m-d',strtotime($to_date))."' ";
		// }
		$GetData = $this->Adsensemodel->get_datatables($cond);
		if(empty($_POST['start'])) {
			$no=0;
		} else {
			$no =$_POST['start'];
		}
		$data = array();
		foreach ($GetData as $row) {
			$btn = ''.'<span class="btn btn-sm bg-success-light mr-2" data-toggle="modal" data-target="#editModal" onclick="getValue('.$row->id.')" data-placement="right"><i class="far fa-edit mr-1"></i> Edit</span>';
			$btn .= ' | '.'<span data-placement="right" class="btn btn-sm btn-danger mr-2" onclick="adsenseDelete(this,'.$row->id.')" style="margin-left: 8px;">Delete</span>';
			if(!empty($row->image)) {
				if(!file_exists("uploads/adsense/".$row->image)) {
					$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
				} else {
					$img ='<a href="'.base_url('uploads/adsense/'.$row->image).'" data-lightbox="roadtrip"><img class="rounded service-img mr-1"src="'.base_url('uploads/adsense/'.$row->image).'"><a>';
				}
			} else {
				$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
			}
            if(!empty($link)) {
                $link = '<a href="'.$row->link.'" data-lightbox="roadtrip" target="_blank">Adsense Link </a>';
            } else {
                $link = '<a href="javascript:void(0)">Adsense Link </a>';
            }
			$no++;
			$nestedData = array();
			$nestedData[] = $no;
			$nestedData[] = $img.' '.ucwords($row->title);
			$nestedData[] = $link;
			$nestedData[] = date('d-m-Y',strtotime($row->created_date));
			$nestedData[] = $btn;
			$data[] = $nestedData;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Adsensemodel->count_all($cond),
			"recordsFiltered" => $this->Adsensemodel->count_filtered($cond),
			"data" => $data,
		);
		echo json_encode($output);
	}
	public function create_action() {
		$get_data=$this->Crud_model->get_single('adsense',"title='".$_POST['title']."'");
		if(isset($_FILES['image']['name'])!='' ) {
			$_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
			$config2['image_library'] = 'gd2';
			$config2['source_image'] =  $_FILES['image']['tmp_name'];
			$config2['new_image'] =   getcwd().'/uploads/adsense/'.$_POST['image'];
			$config2['upload_path'] =  getcwd().'/uploads/adsense/';
			$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
			$config2['maintain_ratio'] = FALSE;
			$this->image_lib->initialize($config2);
			if(!$this->image_lib->resize()) {
				echo('<pre>');
				echo ($this->image_lib->display_errors());
				exit;
			} else {
				$image  = $_POST['image'];
			}
		} else {
			$image  = "";
		}
		if(empty($get_data)) {
			$data=array(
				'title'=>$_POST['title'],
				'link'=>$_POST['link'],
				'image'=>$image,
				'created_date'=>date('Y-m-d H:i:s'),
			);
			$this->db->insert('adsense',$data);
			$this->session->set_flashdata('message', 'AdSence created successfully');
			echo "1"; exit;
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
			echo "0"; exit;
		}
	}
	public function get_value() {
		$adsense_data=$this->Crud_model->get_single('adsense',"id='".$_POST['id']."'");
		if(!empty($adsense_data->image)) {
			if(!file_exists("uploads/adsense/".$adsense_data->image)) {
				$img ='<img class="rounded service-img mr-1" src="'.base_url('adsense/no_image.png').'">';
			} else {
				$img ='<img  class="rounded service-img mr-1" src="'.base_url('uploads/adsense/'.$adsense_data->image).'" >';
			}
		} else {
			$img ='<img class="rounded service-img mr-1" src="'.base_url('uploads/no_image.png').'">';
		}
		$data=array(
			'id'=>$adsense_data->id,
			'title'=>$adsense_data->title,
			'link'=>$adsense_data->link,
			'image'=>$img,
			'old_image'=>$adsense_data->image,
		);
		echo json_encode($data);exit;
	}
	function update_action() {
		if(isset($_FILES['image']['name'])!='' ) {
			$_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
			$config2['image_library'] = 'gd2';
			$config2['source_image'] =  $_FILES['image']['tmp_name'];
			$config2['new_image'] =   getcwd().'/uploads/adsense/'.$_POST['image'];
			$config2['upload_path'] =  getcwd().'/uploads/adsense/';
			$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
			$config2['maintain_ratio'] = FALSE;
			$this->image_lib->initialize($config2);
			if(!$this->image_lib->resize()) {
				echo('<pre>');
				echo ($this->image_lib->display_errors());
				exit;
			} else {
				$image  = $_POST['image'];
				@unlink('uploads/adsense/'.$_POST['old_image']);
			}
		} else {
			$image  = $_POST['old_image'];
		}
		$get_data=$this->Crud_model->get_single_record('adsense',"title='".$_POST['title']."' and id!='".$_POST['id']."'");
		if(empty($get_data)) {
			$data = array(
				'title'=> $_POST['title'],
				'link'=>$_POST['link'],
				'image'=>$image,
				'update_date'=>date('Y-m-d H:i:s'),
			);
			$this->Crud_model->SaveData('adsense',$data,"id='".$_POST['id']."'");
			$this->session->set_flashdata('message', 'AdSense updated successfully');
			echo 1; exit;
		} else{
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
			echo 0; exit;
		}
	}
	public function delete() {
        $this->Crud_model->DeleteData('adsense',"id='".$_POST['cid']."'");
		$this->session->set_flashdata('message', 'AdSense deleted successfully');
    }
}
