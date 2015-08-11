function actQue()
{
	var f = document.listForm;
    var l = document.getElementsByName('members[]');
    var n = l.length;
    var i;
	var j=0;
	var s='';

	for	(i = 0; i < n; i++)
	{
		if (l[i].checked == true)
		{
			j++;
			s += l[i].value +',';
		}
	}
	if (!j){
		alert('파일을 선택해 주세요.');
		return false;
	}
	
	if (!confirm('사용중인 관련파일을 삭제할 경우 심각한 문제가 발생할 수 있습니다.\n\n그래도 삭제하시겠습니까?')){
		return false;
	}
	f.submit();
}
function imgModifyCheck(f)
{
	if (f.upfile.value == '')
	{
		alert('변경하려는 파일을 선택해 주세요.');
		f.upfile.focus();
		return false;
	}
	if (f.upfile.value.indexOf('.'+f.fileext.value) == -1)
	{
		alert('기존파일은 [' + f.fileext.value + '] 포맷입니다.');
		f.upfile.focus();
		return false;
	}
}

function menubar_over(t) {
	$(t).find('.sub-box').show();
}
function menubar_out(t) {
	$(t).find('.sub-box').hide();
}