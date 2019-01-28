<?php
namespace Home\Controller;
define('RES', '/Public/home/report');
use Think\Controller;
class ReportController extends Controller
{
    
    /**
     * 举报须知
     *   */
    public function index(){
        $this->display();
    }
    
    /**
     * 表单页面
     *   */
    public function form(){
        $this->display();
    }
    /**
     * 数据提交
     *   */
    
    public function ajaxdata(){
        $data['Id']=uniqid();
        $data['ReportObjectId']=I('post.reportObjectId');
        $data['ReportName']=I('post.reportName');
        $data['Mobile']=I('post.mobile');
        $data['Email']=I('post.email');
        $data['Name']=I('post.name');
        $data['Department']=I('post.department');
        $data['Position']=I('post.position');
        $data['City']=I('post.city');
        $data['Content']=I('post.content');
        $imgpath=I('post.imgpath');
        if($imgpath){
            $data['FilesUrl']=implode(';', $imgpath);
        }
        $data['CreateTime']=date('Y-m-d H:i:s');
        $isbool=M('Report')->add($data);
        if($isbool){
            $this->ajaxReturn(array('status'=>true,'msg'=>'投诉成功'),'JSON');
        }else{
            $this->ajaxReturn(array('status'=>false,'msg'=>'投诉失败'),'JSON');
        }
    }
    /**
     * 投诉成功
     *   */
    public function result(){
        $this->display();
    }
    
    /**
     * 上传 图片
     *   */
    public function upload() {
        $base64 = I('post.base64');
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64, $result)){
            $uploadPath = '/Uploads'; // 存到文件位置
            $dates = date('YmdHis');
            $type = $result[2];
            $filepath = '.' . $uploadPath;
            $savepath = '/images/report/' . date('Ym') . '/' . date('d') . '/';
            // 文件保存路径+文件名称
        
            $filename = $filepath . $savepath . $dates . ".jpg";
            $this->saveFile($filename, base64_decode(str_replace($result[1], '', $base64)));
            //$this->ajaxReturn($filename, 'json');
            echo substr($filename, 1);
        }
        if (!empty($_FILES)) {
            //  echo $_FILES['Filedata']['tmp_name'];
            // exit();
    
            $upload = new \Think\Upload(); // 实例化上传类
            $upload->maxSize = 3145728; // 设置附件上传大小
            $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
            $upload->savePath = '/Uploads/';
            $upload->autoSub = true;
            $upload->subName = array('date', 'Ymd');
            $images = $upload->upload();
            //判断是否有图
            if ($images) {
                $info = $images['Filedata']['savepath'] . $images['Filedata']['savename'];
                //返回文件地址和名给JS作回调用
                echo $info;
            } else {
                $this->error($upload->getError()); //获取失败信息
            }
        }
    }
    
    private function saveFile($filename, $filecontent)
    {
        if (! file_exists($filename)) {
            mkdir(dirname($filename), 0775, true);
        }
        $local_file = fopen($filename, 'wb');
        if (false !== $local_file) {
            if (false !== fwrite($local_file, $filecontent)) {
                fclose($local_file);
            }
        }
    }
}

?>