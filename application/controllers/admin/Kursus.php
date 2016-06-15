<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */


class kursus extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola kursus | '.$judul;
			$data['heading'] 		= "kursus";
			$data['page']			= 'admin/kursus/page_list';
			$data['kursus_list']	= $this->model_utama->get_order('create_date','desc','kursus');
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat kursus";
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect(base_url().'login');
		}
	}

	function upload_form($kode)
	{
		$data['kode']	= $kode;
		$this->load->view('admin/kursus/upload_form',$data);
	}

	function upload_file_form($kode)
	{
		$data['kode']	= $kode;
		$this->load->view('admin/kursus/upload_file',$data);
	}

	function upload_answer($kode)
	{
		$data['kode']	= $kode;
		$this->load->view('admin/kursus/upload_answer',$data);
	}

	function upload_picture($kode,$table)
	{
		$data['kode']	= $kode;
		$data['table']	= $table;
		$this->load->view('admin/kursus/upload_answer',$data);
	}

	function view_slide($kode)
	{
		$cek_slide = $this->model_utama->cek_data($kode,'sub_modul_id','sub_modul');
		if($cek_slide->num_rows() > 0)
		{
			echo '<img src="'.base_url().'uploads/slide/'.$cek_slide->row()->sub_modul_picture.'" class="img img-responsive">';
		}
		else
		{
			echo 'Data tidak ada';
		}
	}

	// fungsi diabwah ini udah standard, bisa dipakek sama tabel manapun
	function upload_picture_process($table)
	{
		if(isset($_FILES["file"]["type"]))
		{
			$folder_name = $table;
			if($table == 'sub_modul')
			{
				$folder_name = 'slide';
			}
			$validextensions = array("jpeg", "jpg", "png");
			$temporary = explode(".", $_FILES["file"]["name"]);
			$file_extension = end($temporary);
			if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
				) && ($_FILES["file"]["size"] < 2000000)//Approx. 100kb files can be uploaded.
				&& in_array($file_extension, $validextensions)) 
				{
				if ($_FILES["file"]["error"] > 0)
				{
					echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
				}
				else
				{
					if (file_exists("uploads/".$folder_name."/" . $_FILES["file"]["name"])) 
					{
						echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
					}
					else
					{
						$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
						$targetPath = "uploads/".$folder_name."/".$_FILES['file']['name']; // Target path where file is to be stored
						move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
						
						$kode = $_POST[$table.'_id'];
						$data[$table.'_picture'] 	= $_FILES['file']['name'];
						$this->model_utama->update_data($kode,$table.'_id',$table,$data);

						echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
						echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
						echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
						echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
						echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
					}
				}
			}
			else
			{
				echo "<span id='invalid'>***Invalid file Size or Type***<span>";
			}
		}
	}
	// di atas adl udah standard

	function upload_file_process()
	{
		if(isset($_FILES["file"]["type"]))
		{
			
			if ($_FILES["file"]["size"] < 2000000)
			{
				if ($_FILES["file"]["error"] > 0)
				{
					echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
				}
				else
				{
					if (file_exists("uploads/modul/" . $_FILES["file"]["name"])) 
					{
						echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
					}
					else
					{
						$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
						$targetPath = "uploads/modul/".$_FILES['file']['name']; // Target path where file is to be stored
						move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
						
						$modul_id = $_POST['modul_id'];
						$data['modul_picture'] 	= $_FILES['file']['name'];
						$this->model_utama->update_data($modul_id,'modul_id','modul',$data);

						echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
						echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
						echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
						echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
						echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
					}
				}
			}
			else
			{
				echo "<span id='invalid'>***Invalid file Size, Max 2MB ***<span>";
			}
		}
	}
	
	function upload_process()
	{
		if(isset($_FILES["file"]["type"]))
		{
			$validextensions = array("jpeg", "jpg", "png");
			$temporary = explode(".", $_FILES["file"]["name"]);
			$file_extension = end($temporary);
			if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
				) && ($_FILES["file"]["size"] < 2000000)//Approx. 100kb files can be uploaded.
				&& in_array($file_extension, $validextensions)) 
				{
				if ($_FILES["file"]["error"] > 0)
				{
					echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
				}
				else
				{
					if (file_exists("uploads/slide/" . $_FILES["file"]["name"])) 
					{
						echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
					}
					else
					{
						$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
						$targetPath = "uploads/slide/".$_FILES['file']['name']; // Target path where file is to be stored
						move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
						
						$sub_modul_id = $_POST['sub_modul_id'];
						$data['sub_modul_picture'] 	= $_FILES['file']['name'];
						$this->model_utama->update_data($sub_modul_id,'sub_modul_id','sub_modul',$data);

						echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
						echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
						echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
						echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
						echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
					}
				}
			}
			else
			{
				echo "<span id='invalid'>***Invalid file Size or Type***<span>";
			}
		}
	}


	
	function add()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah kursus | '.$judul;
			$data['heading'] 		= 'Add kursus List';
			$data['form_action'] 	= site_url('index.php/admin/kursus/add_process');
			$data['kursus_list']	= $this->model_utama->get_order('create_date','desc','kursus');
			$data['page']			= 'admin/kursus/page_form_add';
			$this->load->view('template', $data);

			$log['user_id']		= $user_id;
			$log['activity']			= 'klik tambah data kursus';
			$this->model_utama->insert_data('log_user', $log);

		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function add_process()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah kursus | '.$judul;
			$data['heading'] 		= 'Add kursus List';
			$data['kursus_list']	= $this->model_utama->get_order('create_date','desc','kursus');
			$data['form_action'] 	= site_url('index.php/admin/kursus/add_process');
			$data['page']			= 'admin/kursus/page_form_add';

			
			$this->form_validation->set_rules('kursus_title', 'Title', 'required|min_length[3]|max_length[30]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				
				$weleh = array (
								'kursus_title' 			=> $this->input->post('kursus_title'),
								'kursus_slug' 			=> url_title($this->input->post('kursus_title'), 'dash', TRUE),
								'create_date'			=> date('Y-m-d H:i:s')
								);
				
				$this->model_utama->insert_data('kursus', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data kursus';
				$this->model_utama->insert_data('log_user', $log);

				$last_id = $this->model_utama->get_last('create_date','kursus')->row()->kursus_id;
				redirect('admin/kursus/update/'.$last_id, 'refresh');
			}
			else
			{
				$this->load->view('template', $data);
			}
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function delete($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{

			$log['user_id']				= $this->session->userdata('id_user');
			$log['activity']			= 'hapus data kursus dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$this->model_utama->delete_data($kode, 'kursus_id','kursus');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/kursus');
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function update($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah kursus | '.$judul;
			$data['heading'] 		= 'Update kursus';
			$data['form_action'] 	= site_url('index.php/admin/kursus/update_process');

			$wew = $this->model_utama->get_detail($kode, 'kursus_id', 'kursus')->row_array();
			$this->session->set_userdata('kd_weleh', $wew['kursus_id']);
			
			$data['default'] 		= $wew;
			
			$data['page']			= 'admin/kursus/page_form';
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data kursus dengan id : '.$kode;
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function update_process()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah kursus | '.$judul;
			$data['heading'] 		= 'Update kursus';
			$data['form_action'] 	= site_url('index.php/admin/kursus/update_process');

			
			$this->form_validation->set_rules('kursus_title', 'Title', 'required|min_length[3]|max_length[30]');
			
			if ($this->form_validation->run() == TRUE)
			{

				$wew = $this->model_utama->get_detail($this->session->userdata('kd_weleh'), 'kursus_id', 'kursus')->row();	
				
				$weleh = array ('kursus_title' 			=> $this->input->post('kursus_title'),
								'kursus_slug' 			=> url_title($this->input->post('kursus_title'), 'dash', TRUE),
								'update_date'			=> date('Y-m-d H:i:s')
								);
				
				$this->model_utama->update_data($this->input->post('kursus_id'),'kursus_id','kursus',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data kursus dengan id : '.$this->session->userdata('kd_weleh').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/kursus/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/kursus/');
			}
			else
			{
				$data['page']			= 'admin/kursus/page_form';
				$this->load->view('template', $data);
			}
		}
		else
		{
			redirect(base_url().'login');
		}
	}


	function update_field($field,$id,$id_field,$table)
	{
		if($this->session->userdata('login_admin') == true)
		{

			$data[$field] = $this->input->post('value');
			if($field ==  $table.'_title')
			{
				$slug 	= $table.'_slug';
				$query 	= $this->db->query("SHOW COLUMNS FROM `$table` LIKE '$slug'");
				if($query->num_rows() > 0) {
					$data[$table.'_slug'] = url_title($this->input->post('value'),'dash',true);
				}
				$query_date	= $this->db->query("SHOW COLUMNS FROM `$table` LIKE 'update_date'");
				if($query_date->num_rows() > 0) {
					$data['update_date'] = date('Y-m-d H:i:s');
				}
			}

			$this->model_utama->update_data($id,$id_field,$table, $data);
			echo $this->input->post('value');
		}
	}

	function add_item($kode, $field, $table)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$data[$field] 	= $kode;
			$field_order 	= $table.'_order';
			$query 	= $this->db->query("SHOW COLUMNS FROM `$table` LIKE '$field_order'");
			if($query->num_rows() > 0) {
				$order = 1;
				$query_order = $this->model_utama->cek_order_limit($kode,$field,$table.'_order','desc','1',$table);
				if($query_order->num_rows() > 0) {
					$row_order = $query_order->row_array();
					$order = $row_order[$field_order] + 1;
				}
				$data[$table.'_order'] = $order;
			}
			$query_date	= $this->db->query("SHOW COLUMNS FROM `$table` LIKE 'create_date'");
			if($query_date->num_rows() > 0) {
				$data['create_date'] = date('Y-m-d H:i:s');
			}
			
			if($table == 'modul')
			{	
				$this->model_utama->insert_data($table,$data);

				$data_modul['row'] = $this->model_utama->get_last('create_date','modul')->row();
				$this->load->view('admin/kursus/modul_add_view',$data_modul);

				
			}
			if($table == 'sub_modul')
			{
				$this->model_utama->insert_data($table,$data);

				$data_sub_modul['sub'] = $this->model_utama->get_last('create_date','sub_modul')->row();
				$this->load->view('admin/kursus/sub_modul_add_view',$data_sub_modul);

				
			}
			if($table == 'soal')
			{
				$query_sub_modul = $this->model_utama->cek_data($kode,$field,'sub_modul');
				if($query_sub_modul->num_rows() > 0) :
					$data['modul_id'] = $query_sub_modul->row()->modul_id;
				endif;

				$this->model_utama->insert_data($table,$data);

				$data_soal['qui'] = $this->model_utama->get_last('create_date','soal')->row();
				

				$this->load->view('admin/kursus/soal_add_view',$data_soal);
			}
			if($table == 'soal_option')
			{
				$this->model_utama->insert_data($table,$data);

				$data_sub_modul['so'] = $this->model_utama->get_last('create_date','soal_option')->row();
				$this->load->view('admin/kursus/soal_option_add_view',$data_sub_modul);

			}

			if($table == 'answer_picture')
			{
				$query_sub_modul = $this->model_utama->cek_data($kode,$field,'soal');
				if($query_sub_modul->num_rows() > 0) :
					$data['sub_modul_id'] = $query_sub_modul->row()->sub_modul_id;
				endif;
				$this->model_utama->insert_data($table,$data);

				$data_sub_modul['ap'] = $this->model_utama->get_last('create_date','answer_picture')->row();
				// $this->load->view('admin/kursus/answer_picture_add_view',$data_sub_modul);
				echo 'masuk';

			}
			
		}
	}

	function sorting($field_order,$field_id,$table)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$i = 1;

			foreach ($this->input->post('target_item_'.$table) as $value) {
			    // Execute statement:
			    // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
				$data[$field_order]	= $i;
			    $this->model_utama->update_data($value,$field_id,$table,$data);
			    $i++;
			}
		}
	}

	function delete_item($value,$field,$table)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$this->model_utama->delete_data($value,$field,$table);
		}
	}


	function delete_picture($value,$field,$table)
	{
		if($this->session->userdata('login_admin') == true)
		{

			$data[$table.'_picture'] = '';
			$this->model_utama->update_data($value,$field,$table,$data);
		}
	}

	function upload_item($kode,$field,$table)
	{
		if($this->session->userdata('login_admin') == true)
		{
		    $status = "";
		    $msg = "";
		    $file_element_name = 'userfile_'.$table.'_'.$field.'_'.$table;    
		    
		     
		    if ($status != "error")
		    {
		        $config['upload_path'] 		= './uploads';
		        $config['allowed_types'] = 'gif|jpg|png|doc|txt|jpeg';
		        // $config['max_size'] = 1024 * 8;
		        $config['encrypt_name'] = TRUE;
		 
		        $this->load->library('upload', $config);
		 
		        if (!$this->upload->do_upload($file_element_name))
		        {
		            $status = 'error';
		            $msg = $this->upload->display_errors('', '');
		        }
		        else
		        {
		            $data = $this->upload->data();
		            $data_upload[$table.'_picture'] = $data['file_name'];
		            $file_id = $this->model_utama->update_data($kode,$field,$table,$data_upload);
		            // $file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']); ini asli dar contoh web brow
		            if($file_id)
		            {
		                $status = "success";
		                $msg = "File successfully uploaded";
		            }
		            else
		            {
		                unlink($data['full_path']);
		                $status = "error";
		                $msg = "Something went wrong when saving the file, please try again.";
		            }
		        }
		        @unlink($_FILES[$file_element_name]);
		    }
		    echo json_encode(array('status' => $status, 'msg' => $msg));
		}
	}



	function do_upload()
	{
		$max_filesize = 2097152; // Maximum filesize in BYTES.
		$allowed_filetypes = array('.jpg','.jpeg','.gif','.png'); // These will be the types of file that will pass the validation.
		$filename = $_FILES['userfile']['name']; // Get the name of the file (including file extension).
		$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // Get the extension from the filename.
		$file_strip = str_replace(" ","_",$filename); //Strip out spaces in filename
		// $folder	= $_POST['folder'];
		//$upload_path = 'uploads/kursus/'.$folder.'/'; //Set upload path
		$upload_path = 'uploads/kursus/';
		 
		if ( ! is_dir($upload_path)) {
			mkdir($upload_path);
		} 
		 
		 // Check if the filetype is allowed, if not DIE and inform the user.
		if(!in_array($ext,$allowed_filetypes)) {
				die('<div class="error">The file you attempted to upload is not allowed.</div>');
		}
		
		// Now check the filesize, if it is too large then DIE and inform the user.
		if(filesize($_FILES['userfile']['tmp_name']) > $max_filesize) {
		  die('<div class="error">The file you attempted to upload is too large.</div>');
		}
		
		// Check if we can upload to the specified path, if not DIE and inform the user.
		if(!is_writable($upload_path)) {
		  die('<div class="error">You cannot upload to the /uploads/ folder. The permissions must be changed.</div>');
		}
		
		 // Move the file if eveything checks out.
		 if(move_uploaded_file($_FILES['userfile']['tmp_name'],$upload_path . $file_strip)) 
		 {
		  echo '<div class="success">'.$upload_path.$file_strip.'</div>'; // It worked.
		 } 
		 else 
			{
				echo '<div class="error">'. $file_strip .' was not uploaded.  Please try again.</div>'; // It failed :(.
			}
	}
	

	function add_detail($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$soal = $this->db->query("select * from soal,fitur_game where soal.soal_id = '$kode' and soal.fitur_game_id = fitur_game.fitur_game_id")->row();
			redirect(base_url().'admin/kursus/'.$soal->fitur_game_function.'/'.$kode);
		}
	}
	
	function leadership($kode)
	{
		$user_id 				= $this->session->userdata('id_user');
		$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$data['title'] 			= 'Halaman Kelola kursus | '.$judul;
		$data['heading'] 		= "kursus";
		$data['page']			= 'admin/kursus/page_create_leadership';
		$data['question']		= $this->db->query("select * from leadership_question where soal_id = '$kode'");
		//$data['kursus_list']		= $this->model_utama->get_order('create_date','desc','kursus');
		$this->load->view('template', $data);

		//$log['user_id']			= $this->session->userdata('id_user');
		//$log['activity']		= "lihat kursus";
		//$this->model_utama->insert_data('log_user', $log);
	}
	
	function add_leadership_question($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$data['soal_id'] = $kode;
			$data['create_date'] = date('Y-m-d H:i:s');
			$this->model_utama->insert_data('leadership_question',$data);

			$row = $this->model_utama->get_last('create_date','leadership_question')->row();
			
			echo '
			<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
			<script>$( document ).ready(function(){$(".form_editable").editable();});</script>
			<div class="row" id="itemQuestion'.$row->leadership_question_id.'">
					<div class="col-md-11">

						<div class="panel">
							<div class="panel-heading">
								<span class="panel-title"><h2><a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah Tanda"  data-url="'.base_url().'admin/kursus/ubah_leadership/position/'.$row->leadership_question_id.'/leadership_question_id/leadership_question">'.set_value('position', isset($row->position) ? $row->position : '').'</a> : <a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah Pertanyaan"  data-url="'.base_url().'admin/kursus/ubah_pertanyaan/'.$row->leadership_question_id.'"></a></h2></span>
							</div>
							<div class="panel-body">
								<a id="tambahOptionButton'.$row->leadership_question_id.'" class="btn btn-labeled btn-success btn-xs" href="javascript:;" onclick="tambahOption('.$row->leadership_question_id.')"><span class="btn-label icon fa fa-plus"></span> Tambah Option</a>
								<img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loadingOption'.$row->leadership_question_id.'" style="display:none" /> 
								<br><br>
								<div class="ui-accordion" id="optionBox'.$row->leadership_question_id.'">
								</div> <!-- / #ui-accordion -->
							</div>
							<div class="panel-footer">
								<p class="text-right">
									<button class="btn btn-labeled btn-danger" type="button" id="delete_item_modul_'.$row->leadership_question_id.'" onclick="delete_item('.$row->leadership_question_id.')"><span class="btn-label icon fa fa-times"></span> Delete Question</button>
									<img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_modul_'.$row->leadership_question_id.'" style="display:none" /> 
								</p>
							</div>
						</div>

                                        </div>
                                    </div>';
		}
	}
	
	function add_leadership_option($kode,$soal_id)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$data['leadership_question_id'] = $kode;
			$data['create_date'] = date('Y-m-d H:i:s');
			$this->model_utama->insert_data('leadership_option',$data);

			$sub = $this->model_utama->get_last('create_date','leadership_option')->row();
			
			echo '
			<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
			<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
			<script>$( document ).ready(function(){
				$(".form_editable").editable();
				$(".select_editable").editable();
				});
					
			</script>
			<div class="group" id="listOption'.$sub->leadership_option_id.'">
				<h3><strong>Option : <a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah Pertanyaan"  data-url="'. base_url().'admin/kursus/ubah_leadership/option_description/'.$sub->leadership_option_id.'/leadership_option_id/leadership_option">'.set_value('option', isset($sub->option_description) ? $sub->option_description : '').'</a></strong></h3>
				<div>
					<table class="table">
						<tr>
							<td>Next Flow</td>
							<td><a href="#" class="select_editable" data-type="select" data-pk="1" data-value="5" data-source="'.base_url().'admin/kursus/list_leadership_question/'.$soal_id.'" data-title="Pilih Alur" data-url="'.base_url().'admin/kursus/ubah_leadership/next_flow/'.$sub->leadership_option_id.'/leadership_option_id/leadership_option">'.set_value('next_flow', isset($sub->next_flow) ? $sub->next_flow : '').'</a></td>
						</tr>
					</table>
					<br>
					<p class="text-right">
						<button class="btn btn-labeled btn-danger btn-xs" type="button" id="delete_item_sub_modul_'.$sub->leadership_option_id.'" onclick="delete_item('.$sub->leadership_option_id.')"><span class="btn-label icon fa fa-times"></span> Delete Option</button>
						<img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_sub_modul_<?php echo $sub->leadership_option_id?>" style="display:none" /> 
					</p>
				</div>
			</div>';
		}
	}
	
	function ubah_leadership($field,$id,$id_field,$table)
	{
		if($this->session->userdata('login_admin') == true)
		{

			$data[$field] = $this->input->post('value');
			
			$this->model_utama->update_data($id,$id_field,$table, $data);
			echo $this->input->post('value');
		}
	}
	
	function list_leadership_question($kode)
	{
		$list = $this->db->query("select * from leadership_question where soal_id = '$kode'");
		$i = 0;
		foreach($list->result() as $row)
		{
			$groups[$i]	= array(
							'value'		=> $row->leadership_question_id,
							'text'		=> $row->position.' = '.$row->question
			);
			$i++;
		}
		
		echo json_encode($groups);
	}
	
	function checklist($kode)
	{
		$user_id 				= $this->session->userdata('id_user');
		$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$data['title'] 			= 'Halaman Kelola kursus | '.$judul;
		$data['heading'] 		= "kursus";
		$data['page']			= 'admin/kursus/page_game_checklist';
		$data['question']		= $this->db->query("select * from checklist_result where soal_id = '$kode'");
		//$data['kursus_list']		= $this->model_utama->get_order('create_date','desc','kursus');
		$this->load->view('template', $data);

		//$log['user_id']			= $this->session->userdata('id_user');
		//$log['activity']		= "lihat kursus";
		//$this->model_utama->insert_data('log_user', $log);
	}
	
	function add_checklist($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$data['soal_id'] = $kode;
			$data['create_date'] = date('Y-m-d H:i:s');
			$this->model_utama->insert_data('checklist_result',$data);

			$row = $this->model_utama->get_last('create_date','checklist_result')->row();
			
			echo '
			<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
			<script>$( document ).ready(function(){$(".form_editable").editable();});</script>
			<div class="row" id="itemQuestion'.$row->check_result_id.'">
					<div class="col-md-11">

						<div class="panel">
							<div class="panel-heading">
								<span class="panel-title col-md-6">
								<h4 class="text-center"><a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah Title"  data-url="'.base_url().'admin/kursus/ubah_ckecklist/result_a/'.$row->check_result_id.'/check_result_id/check_result">'.set_value('title1', isset($row->result_a) ? $row->result_a : '').'</a></h4></span>
								<span class="panel-title col-md-6">
								<h4 class="text-center"><a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah Title"  data-url="'.base_url().'admin/kursus/ubah_checklist/result_b/'.$row->check_result_id.'/check_result_id/check_result">'.set_value('title2', isset($row->result_b) ? $row->result_b : '').'</a></h4></span>
							</div>
							<div class="panel-body">
								<a id="tambahOptionButton'.$row->check_result_id.'" class="btn btn-labeled btn-success btn-xs" href="javascript:;" onclick="tambahOption('.$row->check_result_id.')"><span class="btn-label icon fa fa-plus"></span> Tambah Option</a>
								<img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loadingOption'.$row->check_result_id.'" style="display:none" /> 
								<br><br>
								<div class="ui-accordion" id="optionBox'.$row->check_result_id.'">
								</div> <!-- / #ui-accordion -->
							</div>
							<div class="panel-footer">
								<p class="text-right">
									<button class="btn btn-labeled btn-danger" type="button" id="delete_item_modul_'.$row->check_result_id.'" onclick="delete_item('.$row->check_result_id.')"><span class="btn-label icon fa fa-times"></span> Delete Question</button>
									<img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_modul_'.$row->check_result_id.'" style="display:none" /> 
								</p>
							</div>
						</div>

                                        </div>
                                    </div>';
		}
	}
	
	function add_checklist_item($kode,$soal_id)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$data['checklist_result_id'] = $kode;
			$data['create_date'] = date('Y-m-d H:i:s');
			$this->model_utama->insert_data('checklist_item',$data);

			$sub = $this->model_utama->get_last('create_date','checklist_item')->row();
			
			echo '
			<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
			<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
			<script>$( document ).ready(function(){
				$(".form_editable").editable();
				$(".select_editable").editable();
				});
					
			</script>
			<div class="row">
			<div class="col-md-6">
				<div class="alert alert-info alert-dark">
					<strong><a href="#" style="color:white" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah Title"  data-url="'.base_url().'admin/kursus/ubah_checklist/text_a/'.$sub->checklist_item_id.'/checklist_item_id/checklist_item">'.set_value('title2', isset($sub->text_a) ? $sub->text_a : '').'</a></strong>
				</div>
			</div>
			<div class="col-md-6">																
				<div class="alert alert-danger alert-dark">
					<strong><a href="#" style="color:white" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah Title"  data-url="'.base_url().'admin/kursus/ubah_checklist/text_b/'.$sub->checklist_item_id.'/checklist_item_id/checklist_item">'.set_value('title2', isset($sub->text_b) ? $sub->text_b : '').'</a></strong>
				</div>
			</div>	
		</div>';
		}
	}
	
	function ubah_checklist($field,$id,$id_field,$table)
	{
		if($this->session->userdata('login_admin') == true)
		{

			$data[$field] = $this->input->post('value');
			
			$this->model_utama->update_data($id,$id_field,$table, $data);
			echo $this->input->post('value');
		}
	}
	
	function game_kuesioner($kode)
	{
		$user_id 				= $this->session->userdata('id_user');
		$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$data['title'] 			= 'Halaman Kelola kursus | '.$judul;
		$data['heading'] 		= "kursus";
		$data['page']			= 'admin/kursus/page_game_kuesioner';
		$data['option']		= $this->db->query("select * from soal_option where soal_id = '$kode'");
		$data['soal']		= $this->db->query("select * from kuesioner_soal where soal_id = '$kode'"); 
		//$data['kursus_list']		= $this->model_utama->get_order('create_date','desc','kursus');
		$this->load->view('template', $data);

		//$log['user_id']			= $this->session->userdata('id_user');
		//$log['activity']		= "lihat kursus";
		//$this->model_utama->insert_data('log_user', $log);
	}
	
	function ubah_kuesioner($field,$id,$id_field,$table) 
	{
		if($this->session->userdata('login_admin') == true)
		{

			$data[$field] = $this->input->post('value');
			
			$this->model_utama->update_data($id,$id_field,$table, $data);
			echo $this->input->post('value');
		}
	}
	
	function add_soal_kuesioner()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$i 						= $this->input->post('jumlah');
			$data['soal_id']	= $id = $this->input->post('id');
			
			$option					= $this->db->query("select * from soal_option where soal_id = '$id'");
			
			for($j=0; $j<$i; $j++)
			{
				$data['create_date'] = date('Y-m-d H:i:s');
				$this->model_utama->insert_data('kuesioner_soal',$data);
				$sub = $this->db->query("select * from kuesioner_soal order by kuesioner_soal_id desc")->row();
				foreach($option->result() as $row)
				{
					$data2['create_date'] = date('Y-m-d H:i:s');
					$data2['kuesioner_soal_id']		= $sub->kuesioner_soal_id;
					$data2['soal_option_id']			= $row->soal_option_id;
					
					$this->model_utama->insert_data('kuesioner_scoring',$data2);
				}
			}
			
			redirect(base_url().'admin/kursus/game_kuesioner/'.$this->input->post('id'));
		}	
		else
		{
			redirect(base_url().'login'); 
		}
	}

	function diagram_batang($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola kursus | '.$judul;
			$data['heading'] 		= "kursus";
			$data['page']			= 'admin/kursus/page_diagram_batang';
			$data['kategori']		= $this->db->query("select * from diagram_kategori where soal_id = '$kode'");
			//$data['kursus_list']		= $this->model_utama->get_order('create_date','desc','kursus');
			$this->load->view('template', $data);
		}	
		else
		{
			redirect(base_url().'login'); 
		}		
	}
	
	function ubah_diagram($field,$id,$id_field,$table)
	{
		if($this->session->userdata('login_admin') == true)
		{

			$data[$field] = $this->input->post('value');
			
			$this->model_utama->update_data($id,$id_field,$table, $data);
			echo $this->input->post('value');
		}
	}
	
	function add_diagram_kategori($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$data['soal_id'] = $kode;
			$data['create_date'] = date('Y-m-d H:i:s');
			$this->model_utama->insert_data('diagram_kategori',$data);

			$row = $this->model_utama->get_last('create_date','diagram_kategori')->row();
			
			echo '
			<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
			<script>$( document ).ready(function(){$(".form_editable").editable();});</script>
			<div class="row" id="itemQuestion'.$row->diagram_kategori_id.'">
					<div class="col-md-11">

						<div class="panel">
							<div class="panel-heading">
								<span class="panel-title"><h2><a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah Tanda"  data-url="'.base_url().'admin/kursus/ubah_diagram/nama/'.$row->diagram_kategori_id.'/diagram_kategori_id/diagram_kategori">'.set_value('nama', isset($row->nama) ? $row->nama : '').'</a> </h2></span>
							</div>
							<div class="panel-body">
								<a id="tambahOptionButton'.$row->diagram_kategori_id.'" class="btn btn-labeled btn-success btn-xs" href="javascript:;" onclick="tambahOption('.$row->diagram_kategori_id.')"><span class="btn-label icon fa fa-plus"></span> Tambah Pertanyaan</a>
								<img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loadingOption'.$row->diagram_kategori_id.'" style="display:none" /> 
								<br><br>
								<div class="ui-accordion" id="optionBox'.$row->diagram_kategori_id.'">
								</div> <!-- / #ui-accordion -->
							</div>
							<div class="panel-footer">
								<p class="text-right">
									<button class="btn btn-labeled btn-danger" type="button" id="delete_item_modul_'.$row->diagram_kategori_id.'" onclick="delete_item('.$row->diagram_kategori_id.')"><span class="btn-label icon fa fa-times"></span> Delete Question</button>
									<img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_modul_'.$row->diagram_kategori_id.'" style="display:none" /> 
								</p>
							</div>
						</div>

                                        </div>
                                    </div>';
		}
	}
	
	function add_diagram_question($kode,$soal_id)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$data['diagram_kategori_id'] = $kode;
			$data['create_date'] = date('Y-m-d H:i:s');
			$this->model_utama->insert_data('diagram_question',$data);

			$sub = $this->model_utama->get_last('create_date','diagram_question')->row();
			
			echo '
			<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
			<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
			<script>$( document ).ready(function(){
				$(".form_editable").editable();
				$(".select_editable").editable();
				});
					
			</script>
			<div class="group" id="listOption'.$sub->diagram_question_id.'">
				<h3><strong>Pertanyaan : <a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah Pertanyaan"  data-url="'. base_url().'admin/kursus/ubah_diagram/pertanyaan/'.$sub->diagram_question_id.'/diagram_question_id/diagram_question">'.set_value('pertanyaan', isset($sub->pertanyaan) ? $sub->pertanyaan : '').'</a></strong></h3>
				
			</div>';
		}
	}
}

