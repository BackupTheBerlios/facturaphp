<?php

function js_BtnFunctions()
{
	return '<script language="Javascript">
				btnNormal=0;
				btnActive=1;
				btnClick=2;
				btnRollNoClick=0;
				btnRollClick=1;

				function makeArray(btnType,path1,path2,path3="default")
				{
					switch(btnType)
						{
							case btnRollNoClick:
												imgButton=new Array();
												imgButton[0]=new Image();
												imgButton[1]=new Image();
												imgButton[0].src=path1;
												imgButton[1].src=path2;
												break;
							case btnRollClick:
												imgButton=new Array();
												imgButton[0]=new Image();
												imgButton[1]=new Image();
												imgButton[2]=new Image();
												imgButton[0].src=path1;
												imgButton[1].src=path2;
												imgButton[2].src=path3;
												break;
							}
					return imgButton;
					}

				function changeButton(Name,Images,NewState)
				{
					switch(NewState)
						{
							case btnNormal:
											document.images[Name].src=Images[0].src;
											break;
							case btnActive:
											document.images[Name].src=Images[1].src;
											break;
							case btnClick;
											document.images[Name].src=Images[2].src;
											break;
							}
					};
			</script>';
}
?>
