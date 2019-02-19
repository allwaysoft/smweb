var scrollPic_13 = new ScrollPic();
				scrollPic_13.scrollContId   = "ISL_Cont_13"; //内容容器ID
				scrollPic_13.arrLeftId      = "LeftArr13";//左箭头ID
				scrollPic_13.arrRightId     = "RightArr13"; //右箭头ID
				scrollPic_13.frameWidth     = 840;//显示框宽度 **显示框宽度必须是翻页宽度的倍数
				scrollPic_13.pageWidth      = 168; //翻页宽度
				scrollPic_13.upright        = false; //垂直滚动
				scrollPic_13.listEvent      = "onclick"; //切换事件
				scrollPic_13.speed          = 10; //移动速度(单位毫秒，越小越快)
				scrollPic_13.space          = 10; //每次移动像素(单位px，越大越快)
				scrollPic_13.autoPlay       = false; //自动播放
				scrollPic_13.autoPlayTime   = 5; //自动播放间隔时间(秒)
				scrollPic_13.circularly		= true; //不循环
				scrollPic_13.initialize(); //初始化