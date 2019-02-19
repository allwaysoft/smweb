#coding:utf-8
# myapp.py
import logging,time
import Mylib

def main():
    logging.basicConfig(filename='myapp.log', level=logging.INFO)#创建打开日志文件
    logging.info(time.strftime('%Y-%m-%d %H:%H:%S',time.localtime(time.time()))+'__'+'Started')
    Mylib.do_something()
    logging.info(time.strftime('%Y-%m-%d %H:%H:%S',time.localtime(time.time()))+'__'+'Finished')

if __name__ == '__main__':
    main()