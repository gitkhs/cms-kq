<?php $d['page']['widget'] = array()?>
<?php include_once $g['dir_module'].'var/users/'.$my['id'].'.widget.php'?>


<div id="deskbox">

	<?php if($type == 'editmode'):?>


	<div id="pages_widget">


		<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return makeMap(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="a" value="widgetwrite" />
		<input type="hidden" name="escapevar" value="" />

		<div class="tt">
			<img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" />
			데스크 꾸미기

			<input type="button" value="위젯추가" class="btnblue" onclick="getWidget(-1);" />
			<input type="submit" value="저장하기" class="btnblue" />
			
			<span class="height">
			(데스크 높이
			<input type="text" name="mainheight" id="mainheight" value="<?php echo $d['page']['mainheight']?$d['page']['mainheight']:700?>" size="5" class="input" />px)
			</span>

			<span id="saveresult" class="result">
			위젯이 저장되었습니다.
			</span>
		</div>

		</form>

		<div id="workSpace" class="posrel"></div>

	</div>


	<script type="text/javascript">
	//<![CDATA[

	var isIE = document.all;
	var isNN = !document.all&&getId;
	var isHot = false;
	var maxTiles = 20;
	var MovableItem;
	var moveObject = new Array(maxTiles);
	var blocktitle = new Array(maxTiles);
	var blockarray = new Array(maxTiles);
	var scrollAmt  = new Array();

	function layoutWidth(obj)
	{
		var f = document.procForm;
		if (obj.value != '')
		{
			f.mainwidth.value = obj.value;
			getId('workSpace').style.width = obj.value;
		}
	}
	function startMove(e)
	{
		if (!MovableItem) return;
		canvas = isIE ? "BODY" : "HTML";
			activeItem=isIE ? event.srcElement : e.target;  
			offsetx=isIE ? event.clientX : e.clientX;
			offsety=isIE ? event.clientY : e.clientY;
			lastX=parseInt(MovableItem.style.left);
			lastY=parseInt(MovableItem.style.top);
			lastW=parseInt(MovableItem.style.width);
			lastH=parseInt(MovableItem.style.height);
		if (offsetx+scrollAmt[0]>=(MovableItem.parentNode.offsetLeft+parseInt(MovableItem.style.left)+(MovableItem.offsetWidth*0.95)) || offsety+scrollAmt[1]>=(MovableItem.parentNode.offsetTop+parseInt(MovableItem.style.top)+(MovableItem.offsetHeight*0.95)) ){edge=true;MovableItem.style.cursor='se-resize';} else{edge=false;MovableItem.style.cursor='move';}
		moveEnabled=true;
		document.onmousemove=moveIt;
	}
	function widgetMove(obj, X, Y)
	{
	   scrollAmt = puGetScrollXY();
	   if (X+scrollAmt[0]>=(obj.parentNode.offsetLeft+parseInt(obj.style.left)+(obj.offsetWidth*0.95)) || Y+scrollAmt[1]>=(obj.parentNode.offsetTop+parseInt(obj.style.top)+(obj.offsetHeight*0.95)) ) {obj.style.cursor='se-resize';} else{obj.style.cursor='move';}
	}
	function moveIt(e)
	{
		if (!moveEnabled||!MovableItem) return;

		getWHTL();

		var w = isIE ? event.clientX-offsetx +lastW : e.clientX-offsetx+lastW;
		var h = isIE ? event.clientY-offsety +lastH : e.clientY-offsety+lastH;
		var x = isIE ? lastX+event.clientX-offsetx : lastX+e.clientX-offsetx;
		var y = isIE ? lastY+event.clientY-offsety : lastY+e.clientY-offsety;


		if (edge)
		{
			MovableItem.style.width = w+'px'; 
			MovableItem.style.height = h+'px'; 
			return false;
		}
		else
		{
			MovableItem.style.top = y+'px';
			MovableItem.style.left = x+'px';
			return false;
		}
	}

	function puGetScrollXY()
	{
		var scrollXamt = 0, scrollYamt = 0;
		if( typeof( window.pageYOffset ) == 'number' )
		{
			scrollYamt = window.pageYOffset;
			scrollXamt = window.pageXOffset;
		} 
		else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) 
		{
			scrollYamt = document.body.scrollTop;
			scrollXamt = document.body.scrollLeft;
		} 
		else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) 
		{
			scrollYamt = document.documentElement.scrollTop;
			scrollXamt = document.documentElement.scrollLeft;
		}
		return [ scrollXamt, scrollYamt ];
	}
	function createTile(w,h,t,l)
	{
		var i;
		for (i=0; i<maxTiles; i++)
		{
			if (moveObject[i].style.display == 'none')
			{
				moveObject[i].style.display = 'block';
				moveObject[i].style.width = w;
				moveObject[i].style.height = h;
				moveObject[i].style.top = t;
				moveObject[i].style.left = l;
				
				MovableItem = moveObject[i];
				getWHTL();
				return;
			}
		}
	}
	function poplayer(topObject)
	{
		if (!topObject) return;
		for (var i=0; i<moveObject.length; i++)
		{
			moveObject[i].style.border = '#C5D7EF solid 1px';
			if (moveObject[i].style.zIndex > topObject.style.zIndex-1 && moveObject[i]!=topObject)
			{
				moveObject[i].style.zIndex = moveObject[i].style.zIndex-1;
			}
		}
		
		topObject.style.zIndex = moveObject.length-1;
		topObject.style.border = '#1A62BA solid 1px';
	}
	function getWHTL()
	{
		var i;
		var w = parseInt(MovableItem.offsetWidth);
		var h = parseInt(MovableItem.offsetHeight);
		var t = parseInt(MovableItem.style.top);
		var l = parseInt(MovableItem.style.left);

		getId('whtl'+MovableItem.id.replace('popup','')).innerHTML = 'W : <input type="text" id="whtl'+MovableItem.id.replace('popup','')+'_w" value="'+(w)+'" size="4" class="input" title="폭" onkeypress="widgetAply(\''+MovableItem.id.replace('popup','')+'\',event)" /> / '+ 'H : <input type="text" id="whtl'+MovableItem.id.replace('popup','')+'_h" value="'+(h)+'" size="4" class="input" title="높이" onkeypress="widgetAply(\''+MovableItem.id.replace('popup','')+'\',event)" /> / '+ 'T : <input type="text" id="whtl'+MovableItem.id.replace('popup','')+'_t" value="'+(t)+'" size="4" class="input" title="상단" onkeypress="widgetAply(\''+MovableItem.id.replace('popup','')+'\',event)" /> / '+ 'L : <input type="text" id="whtl'+MovableItem.id.replace('popup','')+'_l" value="'+(l)+'" size="4" class="input" title="좌측" onkeypress="widgetAply(\''+MovableItem.id.replace('popup','')+'\',event)" /> ' + '<input type="button" value="적용" class="btngray" style="height:20px;position:relative;top:1px;" onclick="widgetAply(\''+MovableItem.id.replace('popup','')+'\',event)" />';
	}
	function widgetAply(layer,e)
	{
		var keycode = event.keyCode ? event.keyCode : e.which;
		
		if (keycode == 13 || keycode == undefined)
		{
			var w = getId('whtl'+layer+'_w').value;
			var h = getId('whtl'+layer+'_h').value;
			var t = getId('whtl'+layer+'_t').value;
			var l = getId('whtl'+layer+'_l').value;

			moveObject[layer].style.width = parseInt(w)-2;
			moveObject[layer].style.height = parseInt(h)-2;
			moveObject[layer].style.top = t;
			moveObject[layer].style.left = l;
		}
	}
	function makeWorkspace()
	{
		var i;
		var workspace='';
		var widgetvar;

		for (i=0; i<maxTiles; i++)
		{
			widgetvar=blockarray[i].split(',');
			workspace=workspace+'<div id=popup'+i+' style="'+
			' z-Index:'+i+';display:none;position:absolute;left:0px;top:0px;filter:alpha(opacity=70);opacity:0.7;background:#ffffff url(\'<?php echo $g['img_module_admin']?>/widget/btn_resize.gif\') bottom right no-repeat;border:#C5D7EF solid 1px;"'+
			' onSelectStart="return false;"'+
			' onmousedown="MovableItem=this;poplayer(this);return false;"'+
			' onMouseover="isHot=true;"'+
			' onMousemove="widgetMove(this,event.clientX,event.clientY);" '+
			' onMouseout="isHot=false;" ondblclick="getWidget('+i+');">'+

			' <div style="height:20px;border-bottom:#C5D7EF;background:#D4E6FC;color:#224499;font-weight:bold;padding:8px 10px 0 10px;">'+
			' <div style="float:left;cursor:move;"><img src="<?php echo $g['img_module_admin']?>/widget/btn_move.gif" alt="" title="이동" /> <span id="wtitle'+i+'" style="position:relative;top:-1px;">'+blocktitle[i]+'</span></div>'+
			' <div style="text-align:right;">'+
			' <img src="<?php echo $g['img_module_admin']?>/widget/btn_conf.gif" alt="" title="속성" class="hand" onclick="getWidget('+i+');" />'+
			' <img src="<?php echo $g['img_module_admin']?>/widget/btn_del.gif" alt="" title="삭제" class="hand" onclick="delWidget('+i+');" />'+
			' </div>'+
			' <div style="clear:both;"></div>'+
			' </div>'+
			' <div id="whtl'+i+'" style="font-size:12px;font-family:arial;color:#555;padding:7px 0 0 10px;width:100%;height:100%;background:url(\'<?php echo $g['img_module_admin']?>/widget/widget/thumb_small.gif\') center center no-repeat;"></div>'+
			'</div>';
		}
		getId('workSpace').innerHTML = workspace;
	}
	function getWidget(i)
	{
		var n = i < 0 ? 0 : i;
		var g = i < 0 ? '' : blockarray[i];
		window.open('<?php echo $g['s']?>/?r=<?php echo $r?>&system=popup.widget&iframe=Y&dropfield='+n+'&option='+g.replace(/&/g,'[!]'),'widgetWin','left=0,top=0,width=100px,height=100px,statusbar=no,scrollbars=no,toolbar=no');
	}
	function delWidget(i)
	{
		if (!moveObject[i]) return;
		if (confirm('정말로 삭제하시겠습니까? '))
		{
			moveObject[i].style.display = "none";
			blocktitle[i] = '';
			blockarray[i] = '';
		}
	}
	function makeMap(f)
	{
		getId('saveresult').style.display = 'inline';
		var i;
		var validMap = false;
		var mapSource = '\n\n';

		for (i=0; i<maxTiles; i++)
		{
			if (moveObject[i].style.display=='block')
			{
				mapSource=mapSource+

				'$d[\'page\'][\'widget\']['+i+'][\'name\'] = "'+blocktitle[i]+'";\n'+
				'$d[\'page\'][\'widget\']['+i+'][\'size\'] = "'+(moveObject[i].offsetWidth-2)+'px|'+(moveObject[i].offsetHeight-2)+'px|'+parseInt(moveObject[i].style.top)+'px|'+parseInt(moveObject[i].style.left)+'px";\n'+
				'$d[\'page\'][\'widget\']['+i+'][\'prop\'] = "'+blockarray[i]+'";\n\n';

				validMap = true;
			}
		}
		f.escapevar.value = mapSource;
	}

	window.onload = function()
	{
		var i;
		document.onmousedown = startMove;
		document.onmouseup = Function("moveEnabled=false;MovableItem=''");

		<?php $i = 0?>
		<?php foreach($d['page']['widget'] as $_key => $_val):?>
		blocktitle[<?php echo $i?>] = "<?php echo $d['page']['widget'][$_key]['name']?>";
		blockarray[<?php echo $i?>] = "<?php echo $d['page']['widget'][$_key]['prop']?>";
		<?php $i++; endforeach?>

		for(i=0;i<maxTiles;i++)
		{
			if (!blocktitle[i]) blocktitle[i] = '';
			if (!blockarray[i]) blockarray[i] = '';
		}

		makeWorkspace();

		for(i=0;i<maxTiles;i++) moveObject[i] = getId('popup'+i);

		<?php $i = 0?>
		<?php foreach($d['page']['widget'] as $_key => $_val):?>
		<?php $_size = explode('|',$d['page']['widget'][$_key]['size'])?>
		
		createTile("<?php echo $_size[0]?>","<?php echo $_size[1]?>","<?php echo $_size[2]?>","<?php echo $_size[3]?>");

		<?php $i++; endforeach?>

		getId('workSpace').style.height = getId('mainheight').value + 'px';
	}
	//]]>
	</script>


	<?php else:?>
	
	<?php if(count($d['page']['widget'])):?>
	<div class="widgetposition">
	<?php include $g['path_core'].'engine/widget.engine.php'?>
	</div>
	<?php else:?>
	<?php include $g['dir_module'].'/lang.'.$_HS['lang'].'/admin/_pc/main.desk.php'?>
	<?php endif?>
	<?php endif?>



</div>