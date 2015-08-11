function fontFace(layer,fontbox)
{
	var x = getId(fontbox);
	if (x.style.display == 'block')
	{
		x.style.display = 'none';
	}
	else {
		var s = '';
			s+= '<ul>';
			s+= '<li style="font-family:dotum;border-bottom:#dfdfdf solid 1px;background:#ECF0F6;" onclick="aplyFont(\''+layer+'\',\''+fontbox+'\',0);">기본글꼴</li>';
			s+= '<li style="font-family:malgun gothic;" onclick="aplyFont(\''+layer+'\',\''+fontbox+'\',this);">맑은고딕</li>';
			s+= '<li style="font-family:gulim;" onclick="aplyFont(\''+layer+'\',\''+fontbox+'\',this);">굴림</li>';
			s+= '<li style="font-family:dotum;" onclick="aplyFont(\''+layer+'\',\''+fontbox+'\',this);">돋움</li>';
			s+= '<li style="font-family:batang;" onclick="aplyFont(\''+layer+'\',\''+fontbox+'\',this);">바탕</li>';
			s+= '</ul>';
			x.innerHTML = s;
			x.style.display = 'block';
	}
}
function aplyFont(layer,fontbox,obj)
{
	if (!obj)
	{
		getId(layer).style.fontFamily = 'gulim';
		getId(layer).style.fontSize = '12px';
		setCookie('myFontFamily',getId(layer).style.fontFamily,1);
		setCookie('myFontSize',getId(layer).style.fontSize,1);
	}
	else {
		getId(layer).style.fontFamily = obj.style.fontFamily;
		setCookie('myFontFamily',obj.style.fontFamily,1);
	}
	getId(fontbox).style.display = 'none';
}
function fontResize(layer,type)
{
	var l = getId(layer);
	var nSize = l.style.fontSize ? l.style.fontSize : '12px';
	var iSize = parseInt(nSize.replace('px',''));

	if (type == '+')
	{
		if (iSize < 20) l.style.fontSize   = (iSize + 1) + 'px';
	}
	else {
		if (iSize > 6) l.style.fontSize = (iSize - 1) + 'px';
	}

	setCookie('myFontSize',l.style.fontSize,1);
}
function changeAuthImg(id){
	var	tm = new Date();
	var key = new Array(
		'attuhb','ceelvn','cttnlu','dsates','dyktfl','etyrcv','euytcv','fkccbl','heyneh','khnppp',
		'kklcpp','nhsxxs','suckus','sxdhvl','tffsel','thdlvu','vcvxsk','vddcpv','vlansd','vvettb',
		'xdhhvb'
	);

	$('#'+id).attr('src','modules/bbs/var/_sp/'+key[tm.getTime()%key.length]+'.jpg');
	$('#'+id).attr('_key',key[tm.getTime()%key.length]);
}
var authCode = function(id) {
	this.changeCode = function() {
		_change_code();
	}
	this.getKey = function() {
		return _key;
	}

	var _key = '';
	var key = new Array(
		'attuhb','ceelvn','cttnlu','dsates','dyktfl','etyrcv','euytcv','fkccbl','heyneh','khnppp',
		'kklcpp','nhsxxs','suckus','sxdhvl','tffsel','thdlvu','vcvxsk','vddcpv','vlansd','vvettb',
		'xdhhvb'
	);
	function _change_code() {
		var	tm	= new Date();
		_key	= key[tm.getTime()%key.length];
		$('#'+id).attr('src','modules/bbs/var/_sp/'+_key+'.jpg');
	}

	_change_code();
}