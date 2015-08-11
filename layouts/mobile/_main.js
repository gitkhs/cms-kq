function mLayerShow(m1,m2,obj)
{
	obj.src = obj.src.replace('_off.','_on.');
	if (memberid == '')
	{
		if(m1 == '_admin_layer_')
		{
			getId('_login_layer_').style.right = '96px';
			getId('_login_layer_').children[0].children[1].style.background = '#317AB1';
			getId('_login_layer_').children[0].children[1].style.borderLeft = '#317AB1 solid 1px';
			getId('_login_layer_').children[0].children[0].style.color = '#317AB1';
			getId('_login_layer_tt_').innerHTML = '회원님의 활동정보';
		}
		else {
			getId('_login_layer_').style.right = '50px';
			getId('_login_layer_').children[0].children[1].style.background = '#D74208';
			getId('_login_layer_').children[0].children[1].style.borderLeft = '#D74208 solid 1px';
			getId('_login_layer_').children[0].children[0].style.color = '#D74208';
			getId('_login_layer_tt_').innerHTML = '내 계정 관리';
		}
		getId('_login_layer_').children[0].children[0].style.left = '169px';
		getId('_login_layer_').style.display = 'block';
	}
	else 
	{
		getId(m1).style.display = 'block';
		getId(m2).style.display = 'none';
	}
}
function mLayerHide()
{
	getId('header').children[1].children[0].src = getId('header').children[1].children[0].src.replace('_on.','_off.');
	getId('header').children[1].children[1].src = getId('header').children[1].children[1].src.replace('_on.','_off.');
	if (memberid == '')
	{
		getId('_login_layer_').style.display = 'none';
	}
	else {
		getId('_admin_layer_').style.display = 'none';
		getId('_system_layer_').style.display = 'none';
	}
}
function searchBox()
{
	if(getId('searchbox').style.display != 'block')
	{
		getId('searchbox').style.display = 'block';
		getId('m_keyword').focus();
	}
	else {
		getId('searchbox').style.display = 'none';
	}
}
function searchBlur()
{
	getId('searchbox').style.display = 'none';
}
