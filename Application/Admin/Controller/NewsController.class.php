<?php

namespace Admin\Controller;

use Common\Common\Controller\AdminController;

class NewsController extends AdminController {

    public $cate;
    public $alist;
    public $treeList = array();      //存放无限分类结果如果一页面有多个无限分类

    public function _initialize() {
        parent::_initialize();
        $this->cate = M('News_type');
        $list = $this->cate->order('pid asc, sort asc, id asc')->select();
        $this->alist = $this->tree($list);
        $this->assign('alist', $this->alist);
    }

    public function index() {
        $table = M('News');
        $where = "";

        if (session('pid') != 0) {
            $condition = '';
            foreach ($this->alist as $val) {
                if ($val['level'] == 2) {
                    $condition.=',' . $val['id'];
                }
            }
            $condition = substr($condition, 1);
            $where.='type_id in (' . $condition . ') and edituser="' . session('username') . '" ';
            if (@$_GET['type_id'] != '' || @$_GET['keyword'] != '') {
                $where.="and ";
            }
        }

        $where.=@$_GET['type_id'] != '' ? "  (type_id=" . $_GET['type_id'] . ")" : '';
        $keyword = @$_GET['keyword'] != '' ? $_GET['keyword'] : '';
        if (@$_GET['type_id'] != '' && @$_GET['keyword'] != '') {
            $where.='AND ';
        }
        $where.= @$_GET['keyword'] != '' ? "title LIKE '%" . @$_GET['keyword'] . "%'" : '';
        $this->keyword = $keyword;

        $count = $table->where($where)->order('id desc')->count();
        $page = new \Think\Page($count, 20);
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show = $page->show();
        $list = $table->where($where)->order('id desc')->limit($page->firstRow . ',' . $page->listRows)->select();
        foreach ($list as $key => $value) {
            $type = M('News_type')->where(array('id' => $value['type_id']))->find();
            $list[$key]['type_name'] = $type['name'];
            unset($list[$key]['type_id']);
        }
        $this->list = $list;
        $this->page = $show;
        $this->display();
    }

    public function add() {
        if ($_POST) {
            $db = M('News');
            if (empty($_POST['isnew'])) {
                $isnew = 0;
            } else {
                $isnew = 1;
            }
            if (empty($_POST['istop'])) {
                $istop = 0;
            } else {
                $istop = 1;
            }
            $data = array(
                'title' => $_POST['title'],
                'type_id' => $_POST['type_id'],
                'image' => $_POST['image'],
                'time' => strtotime($_POST['time']),
                'endtime' => strtotime($_POST['endtime']),
                'author' => $_POST['author'],
                'sort' => $_POST['sort'],
                'keyword' => $_POST['keyword'],
                'description' => $_POST['description'],
                'contents' => $_POST['contents'],
                'isnew' => $isnew,
                'istop' => $istop,
                'addtime' => time(),
                'edittime' => time(),
                'edituser' => session('username')
            );
            $id = $db->add($data);
            if ($id) {
                $this->success('添加成功', U('News/index'));
            } else {
                $this->error('添加失败');
            }
        } else {
            $this->time = time();
            $this->endtime = time() + 365 * 24 * 60 * 60;
            $this->display();
        }
    }

    public function edit() {
        if ($_POST) {
            $db = M('News');
            if (empty($_POST['isnew'])) {
                $isnew = 0;
            } else {
                $isnew = 1;
            }
            if (empty($_POST['istop'])) {
                $istop = 0;
            } else {
                $istop = 1;
            }
            $data = array(
                'title' => $_POST['title'],
                'type_id' => $_POST['type_id'],
                'image' => $_POST['image'],
                'time' => strtotime($_POST['time']),
                'endtime' => strtotime($_POST['endtime']),
                'author' => $_POST['author'],
                'sort' => $_POST['sort'],
                'keyword' => $_POST['keyword'],
                'description' => $_POST['description'],
                'contents' => $_POST['contents'],
                'isnew' => $isnew,
                'istop' => $istop,
                'edittime' => time(),
                'edituser' => session('username')
            );
            $id = $db->where(array('id' => $_POST['id']))->save($data);
            if ($id) {
                $this->success('修改成功', U('News/index'));
            } else {
                $this->error('修改失败');
            }
        } else {
            $id = intval($_GET['id']);
            $db = M('News');
            $infos = $db->find($id);
            $this->infos = $infos;
            $this->display();
        }
    }

    public function del() {
        if ($_GET) {
            $id = I('get.id', 0, 'intval');
        } elseif ($_POST) {
            $id = implode(',', $_POST['id']);
        }
        $db = M('News');
        $isbool = $db->delete($id);
        if ($isbool) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }

    public function import() {
        if ($_POST) {
            vendor('PHPExcel.PHPExcel');
            $cacheMethod = \PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
            $cacheSettings = array();
            \PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
            $objPHPExcel = new \PHPExcel();
            $objPHPExcel = \PHPExcel_IOFactory::load($_FILES["inputExcel"]["tmp_name"]);
            $indata = $objPHPExcel->getSheet(0)->toArray();
            unset($indata[1]);
            $db = M('News');
            foreach ($indata as $arr) {
                $db->title = trim($arr[0]);
                $db->contents = trim($arr[1]);
                $db->type_id = trim($arr[2]);
                $db->time = strtotime(trim($arr[3]));
                $db->endtime = strtotime('2015-1-1 00:00:00');
                $db->count = trim($arr[6]);
                $db->author = trim($arr[5]);
                $db->addtime = strtotime(trim($arr[3]));
                $db->edittime = strtotime(trim($arr[4]));
                $db->edituser = session('username');

                $db->add();
            }
            $this->success('导入成功', U('News/index'));
        } else {
            $this->display();
        }
    }

    public function type() {
        $this->assign('alist', $this->alist);
        $this->display();
    }

    public function typeadd() {
        if ($_POST) {
            $db = M('News_type');
            $ishave = $db->where(array('name' => $_POST['name'], pid => $_POST['pid']))->find();
            if ($ishave) {
                $this->error('该分类已存在');
            }
            $db->name = $_POST['name'];
            $db->pid = $_POST['pid'];
            $db->image = $_POST['image'];
            $db->model = $_POST['model'];
            $db->sort = $_POST['sort'];
            $db->description = $_POST['description'];
            $id = $db->add();
            if ($id) {
                $this->success('添加成功', U('News/type'));
            } else {
                $this->error('添加失败');
            }
        } else {
            $this->display();
        }
    }

    public function typeedit() {
        if ($_POST) {
            $db = M('News_type');
            $data = array(
                'name' => $_POST['name'],
                'pid' => $_POST['pid'],
                'image' => $_POST['image'],
                'model' => $_POST['model'],
                'sort' => $_POST['sort'],
                'description' => $_POST['description'],
            );
            $id = $db->where(array('id' => $_POST['id']))->save($data);
            if ($id) {
                $this->success('修改成功', U('News/type'));
            } else {
                $this->error('修改失败');
            }
        } else {
            $id = I('get.id', 0, 'intval');
            $db = M('News_type');
            $info = $db->find($id);
            $this->info = $info;
            $this->display();
        }
    }

    public function typedel() {
        $id = I('get.id', 0, 'intval');
        $ishave = M('News')->where(array('type_id' => $id))->find();
        if ($ishave) {
            $this->error('请先删除相关新闻');
        }
        $id = M('News_type')->delete($id);
        if ($id) {
            $this->success('删除成功', U('News/type'));
        } else {
            $this->error('删除失败');
        }
    }

    public function manager() {
        /* if (session('uid')==1) {
          $where='pid !=0';
          }else{
          $where='pid='.session('uid');
          } */
        $newsrole = M('Role')->where(array('name' => '新闻管理', 'is_sys' => 1))->find();
        $where = 'pid !=0 and role_id =' . $newsrole['id'];

        //$where='pid !=0';
        //$where=array('pid'=>array('neq',0),'role_id'=>$newsrole['id']);
        $table = M('Admin');
        $keyword = @$_GET['keyword'] != '' ? $_GET['keyword'] : '';
        $where.=@$_GET['keyword'] != '' ? " AND user_id like '%" . $_GET['keyword'] . "%' or username like '%" . $_GET['keyword'] . "%'" : '';
        $this->keyword = $keyword;
        $count = $table->where($where)->order('id desc')->count();
        $page = new \Think\Page($count, 20);
        $page->setConfig('prve', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show = $page->show();
        $list = $table->where($where)->order('id desc')->limit($page->firstRow . ',' . $page->listRows)->select();
        foreach ($list as $key => $value) {
            $role = M('Role')->where(array('id' => $value['role_id']))->find();
            $list[$key]['role_name'] = $role['name'];
        }
        $this->list = $list;
        $this->page = $show;
        $this->display();
    }

    public function manageradd() {
        if ($_POST) {
            $db = M('Admin');
            $isset = $db->where(array('user_id' => $_POST['user_id']))->find();
            if ($isset) {
                $this->error('此账户名已存在');
            } else {
                $role = M('Role')->where(array('name' => '新闻管理', 'is_sys' => 1))->find();
                $data = array(
                    'user_id' => $_POST['user_id'],
                    'upwd' => md5($_POST['upwd']),
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'mobile' => $_POST['mobile'],
                    'role_id' => $role['id'],
                    //'role_id'=>session('role_id'),
                    'state_id' => $_POST['state_id'],
                    'create_time' => time(),
                    'pid' => session('uid')
                );
                $id = $db->add($data);
                if ($id) {
                    $this->success('添加成功', U('News/manager'));
                } else {
                    $this->error('添加失败');
                }
            }
        } else {
            $this->display();
        }
    }

    public function manageredit() {
        if ($_POST) {
            $db = M('Admin');

            $data = array(
                'user_id' => $_POST['user_id'],
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'mobile' => $_POST['mobile'],
                'state_id' => $_POST['state_id']
            );
            $id = $db->where(array('id' => $_POST['id']))->save($data);
            if ($id) {
                $this->success('修改成功', U('News/manager'));
            } else {
                $this->error('修改失败');
            }
        } else {
            $id = intval($_GET['id']);
            $db = M('Admin');
            $admin = $db->find($id);
            $this->admin = $admin;
            $this->display();
        }
    }

    public function managerdel() {
        if ($_GET) {
            $id = I('get.id', 0, 'intval');
        } elseif ($_POST) {
            $id = implode(',', $_POST['id']);
        }
        $db = M('Admin');
        $isbool = $db->delete($id);
        if ($isbool) {
            $this->success('删除成功', U('News/manager'));
        } else {
            $this->error('删除失败');
        }
    }

    public function newsnode() {
        if (IS_POST) {
            $db = M('Newsnode');
            /* 先清除 */
            $db->where(array('uid' => $_POST['uid']))->delete();
            $db->uid = $_POST['uid'];
            $db->news_type = implode(',', $_POST['node']);
            $id = $db->add();
            if ($id) {
                $this->success('更新成功', U('News/manager'));
            } else {
                $this->error('更新失败');
            }
        } else {
            $id = I('get.id');
            if (!$id) {
                $this->error('参数错误');
            }
            $tadm = M('Admin')->find($id);
            $this->tadm = $tadm;
            $newsnode = M('Newsnode')->where(array('uid' => $id))->find();
            $this->newstype = explode(',', $newsnode['news_type']);
            $db_type = M('News_type');
            $list = $db_type->where(array('pid' => 0))->order('sort asc')->select();
            $this->list = $list;
            $this->display();
        }
    }

    public function resetPwd() {
        $id = $_GET['id'];
        $db = M('Admin');
        $tuser = $db->find($id);
        $db->id = $id;
        $db->upwd = md5(C('backstage_pwd'));
        $isbool = $db->save();
        if ($isbool) {
            if (C('send_mail')) {
                $mail = A('Site');
                $mail->sendEmail($tuser['email'], 1);
            }
            die('1');
        } else {
            die('0');
        }
    }

    public function analysis() {
        $db = M('News');
        //新闻总访问量
        $sum = $db->sum('count');
        $this->sum = $sum;
        //最大访问量
        $max = $db->max('count');
        $this->max = $max;
        $maxlist = $db->where(array('count' => $max))->select();
        $this->maxlist = $maxlist;
        //所有二级新闻栏目
        $typelist = M('News_type')->where(array('pid' => array('neq', 0)))->select();
        $name_x = array();
        $value_y = array();
        foreach ($typelist as $val) {
            $name_x[] = "'" . $val['name'] . "'";
            $count = $db->where(array('type_id' => $val['id']))->sum('count');
            $value_y[] = $count != null ? $count : 0;
        }
        $name_x = implode(',', $name_x);
        $value_y = implode(',', $value_y);
        $this->name_x = $name_x;
        $this->value_y = $value_y;
        $this->display();
    }

    /**
     * 无限级分类
     * @access public
     * @param Array $data     //数据库里获取的结果集
     * @param Int $pid
     * @param Int $count       //第几级分类
     * @return Array $treeList
     */
    public function tree(&$data, $pid = 0, $level = 1) {
        if (session('pid') != 0) {
            $newsnode = M('Newsnode')->where(array('uid' => session('uid')))->find();
            $newstype = explode(',', $newsnode['news_type']);
            foreach ($data as $k => $val) {
                if (!in_array($val['id'], $newstype) && $val['pid'] == 0) {
                    unset($data[$k]);
                }
            }
        }
        foreach ($data as $key => $value) {

            if ($value['pid'] == $pid) {
                $value['level'] = $level;
                $count = M('News')->where(array('type_id' => $value['id']))->count();
                $value['count'] = $count;
                $this->treeList [] = $value;
                unset($data[$key]);
                $this->tree($data, $value['id'], $level + 1);
            }
        }
        return $this->treeList;
    }

}

?>