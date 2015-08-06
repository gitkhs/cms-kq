function imgShow(tdir,obj,w,e)
{
	var xy = getEventXY(e);

	if (w > 300)
	{
		var xw = 'width=300';
	}
	else {
		var xw = 'width='+w;
	}

	getId('hImg').style.display = 'block';
	getId('hImg').style.top = parseInt(xy.y) + 'px'
	getId('hImg').style.left = (parseInt(xy.x) + 20) + 'px';


	if (obj.innerHTML.indexOf('.swf') != -1)
	{
		getId('hImg').innerHTML = '<div style="background:#ffffff;border:#000000 solid 4px;"><embed src="'+tdir+obj.title+'" '+xw+' style="padding:5px;"></embed></div>';
	}
	else {
		getId('hImg').innerHTML = '<div style="background:#ffffff;border:#000000 solid 4px;"><img src="'+tdir+obj.title+'" '+xw+' style="padding:5px;" /></div>';
	}
}
function imgHide()
{
	getId('hImg').style.display = 'none';
}
