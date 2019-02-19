#coding:utf-8
# mylib.py
import logging
import  os ,time
import  shutil

dir="D:\wwwroot\httpdocs20160331\httpdocs\Upload\\"
tar  =  "D:\wwwroot\httpdocs20160331\httpdocs\outpic\\"
# dir = "E:\image";#定义源文件夹地址，此文件夹目录是包含Image 只能两层
# tar = "E:\images";

newFolderName = os.path.join(dir,time.strftime('%Y%m%d',time.localtime(time.time())))
#newFolderName = os.path.join(dir,"20170913")
#
def do_something():
    # Business
    for root, dirs, files in os.walk(dir):
        if  root.__ne__(newFolderName):# 如果全量更新，请注释掉此 if 判断条件
            continue
        for file in files:
            file_ = file[0:1]
            if file_.isdigit():
                continue
            # tar = "D:\wwwroot\httpdocs20160331\httpdocs\outpic\\"
            tar = "D:\wwwroot\httpdocs20160331\httpdocs\outpic\\" #重置tar的目录，
            tar = os.path.join(tar, file[2:13])
            if not os.path.exists(tar):
                os.makedirs(tar)
            aa = os.path.join(root, file)
            bb = os.path.join(tar, file)
            shutil.copyfile(os.path.join(root, file), os.path.join(tar, file))
            shutil.copyfile(os.path.join(tar, file), os.path.join(tar, file[0:13] + '.jpg'))
            print os.path.join(root, file)
            print os.path.join(tar, file)

            logging.info(os.path.join(root, file))
            logging.info(os.path.join(tar, file))


