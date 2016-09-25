<?php
	require_once(APPPATH."controllers/errcode.php");

	class Admin extends CI_Controller {

		private $privateKey = "1234567812345678";  
		private $iv     = "1234567812345678"; 
		public function __construct()
		{
			parent::__construct();
			$this->load->model('bar_model');
			$this->load->model('user_model');
			$this->load->model('order_model');
			$this->load->model('money_model');
			$this->load->model('item_model');
			$this->load->model('admin_model');
			$this->load->model('barserver_model');
			$this->load->model('baruser_model');
			$this->load->model('desk_model');


			$this->load->model('useritem_model');
			$this->load->model('userpresentinfo_model');
			$this->load->helper('url_helper');
			$this->load->library('https');
			$this->load->library('aes');
		}

		public function index()
		{
			$this->load->view('admin/index');
		}

		public function login()
		{
			if(!isset($_REQUEST['username']) || !isset($_REQUEST['password']))
			{
				$ret['code'] = -1001;
				$ret['msg'] = '参数错误！';
				echo json_encode($ret);
				return;
			}

			$username = $_REQUEST['username'];
			$password = md5($_REQUEST['password']);

			$user_info = $this->admin_model->get_user($username, $password);
			if(!$user_info)
			{
				$ret['code'] = -1002;
				$ret['msg'] = '用户名或密码错误!';
				echo json_encode($ret);
				return;
			}

			session_start();
			$_SESSION['logined'] = true;
			$ret['code'] = 0;
			$ret['msg'] = 'success';
			$ret['uid'] = $user_info['uid'];
			$ret['bar_id'] = $user_info['bar_id'];
			echo json_encode($ret);
			return;
		}

		public function queryBarSinger() 
		{
			session_start();
			if(!isset($_REQUEST['bar_id']))
			{
				$ret['code'] = -1;
				echo json_encode($ret);
				return;
			}
			$bar_id = $_REQUEST['bar_id'];
			$singers_info = $this->barserver_model->get_singers($bar_id);
			$ret['code'] = 0;
			$ret['singers'] = $singers_info;
			echo json_encode($ret);
			return;
		}

		public function queryBarUsers()
		{
			session_start();
			if(!isset($_REQUEST['bar_id']))
			{
				$ret['code'] = -1;
				echo json_encode($ret);
				return;
			}
			$bar_id = $_REQUEST['bar_id'];
			$users_info = $this->baruser_model->query_bar_users($bar_id);
			$ret['code'] = 0;
			$ret['users'] = $users_info;
			echo json_encode($ret);
		}

		public function queryBarServer() 
		{
			session_start();
			if(!isset($_REQUEST['bar_id']))
			{
				$ret['code'] = -1;
				echo json_encode($ret);
				return;
			}
			$bar_id = $_REQUEST['bar_id'];
			$servers_info = $this->barserver_model->get_servers($bar_id);
			$ret['code'] = 0;
			$ret['servers'] = $servers_info;
			echo json_encode($ret);
			return;
		}

		public function query_desks()
		{
			session_start();
			if(!isset($_REQUEST['bar_id']))
			{
				$ret['code'] = -1;
				echo json_encode($ret);
				return;
			}
			$bar_id = $_REQUEST['bar_id'];
			$desks_info = $this->desk_model->query_desks($bar_id);
			$ret['code'] = 0;
			$ret['desks'] = $desks_info;
			echo json_encode($ret);
			return;
		}

		public function add_desk()
		{
			if(!isset($_REQUEST['bar_id']))
			{
				$ret['code'] = -1;
				echo json_encode($ret);
				return;
			}
			$bar_id = $_REQUEST['bar_id'];
			$desk_id = $_REQUEST['desk_id'];
			$desk_name = $_REQUEST['desk_name'];
			$desk_qrimg = 'http://qr.topscan.com/api.php?text=https%3A//open.weixin.qq.com/connect/oauth2/authorize%3Fappid%3Dwx0523023df5aa4bf1%26redirect_uri%3Dhttp%3A//dream.waimaipu.cn/index.php/user/login%26response_type%3Dcode%26scope%3Dsnsapi_userinfo%26state%3Dbarid%253D'.$bar_id.'%2526deskid%253D'.$desk_id.'%2526role%253Dg%23wechat_redirect';
			$retCode = $this->desk_model->add_desk($bar_id, $desk_id, $desk_name, $desk_qrimg);
			if($retCode)
			{
				$ret['code'] = 0;
			}
			else
			{
				$ret['code'] = -1;
			}
			echo json_encode($ret);
		}

		public function del_desk()
		{
			if(!isset($_REQUEST['bar_id']))
			{
				$ret['code'] = -1;
				echo json_encode($ret);
				return;
			}
			$bar_id = $_REQUEST['bar_id'];
			$desk_id = $_REQUEST['desk_id'];
			$this->desk_model->del_desk($bar_id, $desk_id);
			$ret['code'] = 0;
			echo json_encode($ret);
		}

		public function update_desk()
		{
			$bar_id = $_REQUEST['bar_id'];
			$desk_id = $_REQUEST['desk_id'];
			$new_desk_id = $_REQUEST['new_desk_id'];
			$desk_name = $_REQUEST['desk_name'];
			$desk_qrimg = 'http://qr.topscan.com/api.php?text=https%3A//open.weixin.qq.com/connect/oauth2/authorize%3Fappid%3Dwx0523023df5aa4bf1%26redirect_uri%3Dhttp%3A//dream.waimaipu.cn/index.php/user/login%26response_type%3Dcode%26scope%3Dsnsapi_userinfo%26state%3Dbarid%253D'.$bar_id.'%2526deskid%253D'.$new_desk_id.'%2526role%253Dg%23wechat_redirect';

			$retCode = $this->desk_model->update_desk($bar_id, $desk_id, $new_desk_id, $desk_name, $desk_qrimg);
			if($retCode)
			{
				$ret['code'] = 0;
			}
			else
			{
				$ret['code'] = -1;
			}
			echo json_encode($ret);
			return;
		}

		public function delSinger()
		{
			$bar_id = $_REQUEST['bar_id'];
			$id = $_REQUEST['id'];
			$this->barserver_model->delSinger($id);
			$ret['code'] = 0;
			echo json_encode($ret);
		}

		public function verifySinger()
		{
			$bar_id = $_REQUEST['bar_id'];
			$id = $_REQUEST['id'];
			$this->barserver_model->verifySinger($id);
			$ret['code'] = 0;
			echo json_encode($ret);
		}

		public function verifyServer()
		{
			$bar_id = $_REQUEST['bar_id'];
			$id = $_REQUEST['id'];
			$this->barserver_model->verifySinger($id);
			$ret['code'] = 0;
			echo json_encode($ret);
		}

		public function logout()
		{
			session_start();
			unset($_SESSION['logined']);
			header("location: http://dream.waimaipu.cn/index.php/admin/index");
		}

		public function dashboard()
		{
			session_start();
			if(!isset($_SESSION['logined']) || !$_SESSION['logined'])
			{
				header("location: http://dream.waimaipu.cn/index.php/admin/index");
				return;
			}

			if(!isset($_REQUEST['uid']))
			{
				header("location: http://dream.waimaipu.cn/index.php/admin/index");
				return;
			}

			$uid = $_REQUEST['uid'];

			$user_info = $this->admin_model->get_user_by_uid($uid);
			$bar_info = $this->bar_model->get_barinfo($user_info['bar_id']);
			$data['headimg'] = $user_info['headimg'];
			$data['nickname'] = $user_info['nickname'];
			$data['barname'] = $bar_info['name'];
			$data['bar_id'] = $user_info['bar_id'];
			$data['barimg'] = $bar_info['barimg'];
			$this->load->view('admin/dashboard', $data);
		}
	}
?>