<?php
defined('BASEPATH') OR exit('No direct script are allowed');
class Tooltips extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Tooltipsmodel');
    }
    public function index() {
        $header = ['title' => 'Tooltips Management'];
        $data = ['heading' => 'Tooltips Management'];
        $this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/tooltips/list',$data);
        $this->load->view('admin/footer');
    }
    public function ajax_manage_page() {
        $get_tooltips = $this->Tooltipsmodel->get_datatables();
        if(empty($_POST['start'])) {
            $no = 0;
        } else {
            $no = $_POST['start'];
        }
        $data = [];
        foreach ($get_tooltips as $row) {
            $btn = ''.'<span class="btn btn-sm bg-success-light mr-2" data-toggle="modal" data-target="#viewModal" onclick="view_data('.$row->id.')" data-placement="right"><i class="far fa-eye mr-1"></i>View</span>';
            $btn .= '| '.'<span class="btn btn-sm bg-success-light mr-2" data-toggle="modal" data-target="#editModal" onclick="getValue('.$row->id.')" data-placement="right"><i class="far fa-edit mr-1"></i> Edit</span>';
            if(strlen($row->description) > 100) {
                $desc = substr($row->description, 0, 60).'...';
            } else {
                $desc = $row->description;
            }
            $no++;
            $nestedData = [];
            $nestedData[] = $no;
            $nestedData[] = ucwords($row->menu_name);
            $nestedData[] = $desc;
            $nestedData[] = $btn;
            $data[] = $nestedData;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Tooltipsmodel->count_all(),
            "recordsFiltered" => $this->Tooltipsmodel->count_filtered(),
            "data" => $data,
        ];
        echo json_encode($output);
    }
    public function create_action() {
        $get_data = $this->Crud_model->get_single('manage_tooltips', "menu_name = '".$_POST['menu_name']."'");
        if(empty($get_data)) {
            $data = [
                'menu_name' => $_POST['menu_name'],
                'description' => $_POST['description'],
                'created_date '=> date('Y-m-d H:i:s'),
            ];
            $this->Crud_model->SaveData('manage_tooltips', $data);
            $this->session->set_flashdata('message', 'Tooltips created successfully');
            echo "1"; exit;
        } else {
            $this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
            echo "0"; exit;
        }
    }
    public function get_value() {
        $get_data = $this->Crud_model->get_single('manage_tooltips', "id='".$_POST['id']."'");
        $data = [
            'id' => $get_data->id,
            'menu_name' => $get_data->menu_name,
            'description' => $get_data->description
        ];
        echo json_encode($data); exit;
    }
    public function update_action() {
        $update_data = $this->Crud_model->get_single('manage_tooltips', "menu_name ='".$_POST['menu_name']."' and id != '".$_POST['id']."'");
        if(empty($update_data)) {
            $data=array(
                'menu_name'=>$_POST['menu_name'],
                'description'=>$_POST['description'],
            );
            $this->Crud_model->SaveData('manage_tooltips', $data, "id = '".$_POST['id']."'");
            $this->session->set_flashdata('message', 'Tooltips updated successfully');
            echo "1"; exit;
        } else {
            $this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
            echo "0"; exit;
        }
    }
    public function view() {
        $get_data = $this->Crud_model->get_single('manage_tooltips', "id='".$_POST['id']."'");
        $data=array(
            'description'=>$get_data->description,
        );
        echo json_encode($data); exit;
    }

    public function get_tooltip() {
        $get_data = $this->Crud_model->get_single('manage_tooltips', "menu_name = '".$_POST['tooltip']."'");
        $menuTitle = $this->Crud_model->get_single('admin_menu_list', "controller_name = '".$get_data->menu_name."'");
        $data = [
            'menu_name' => $menuTitle->menu_name,
            'description' => $get_data->description,
        ];
        echo json_encode($data); exit;
    }

    public function ck_upload() {
        if(isset($_FILES['upload']['name'])) {
            $file = $_FILES['upload']['name'];
            $filetmp = $_FILES['upload']['tmp_name'];
            //echo 'sayantan'.$file; die;
            //echo dirname(__FILE__); die;
            move_uploaded_file($filetmp,'uploads/tooltips/'.$file);
            $function_number=$_GET['CKEditorFuncNum'];
            $url=base_url().'uploads/tooltips/'.$file;
            $message='';
            echo "<script>window.parent.CKEDITOR.tools.callFunction('".$function_number."','".$url."','".$message."');</script>";
        }
    }
}
