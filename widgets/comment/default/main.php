<?php $wdgvar['parent']=$_HM['uid']?'c'.$_HM['uid']:($_HP['uid']?'p'.$_HP['uid']:'a'.$my['uid'])?>
<?php $wdgvar['rdrect']=$_HM['uid']?'c:'.$c:($_HP['uid']?'mod:'.$_HP['id']:'m:admin,module:admin')?>

<div class="widget_comment01">
<a href="#." onclick="WidgetCommentShow<?php echo $i?>();">댓글보기 (<span id="comment_num<?php echo $wdgvar['parent']?>"><?php echo getDbRows($table['s_comment'],"parent='".$m.$wdgvar['parent']."'")?></span>개)</a>
</div>
<a name="CMT"></a>
<iframe name="commentFrame<?php echo $i?>" id="commentFrame<?php echo $i?>" src="<?php if($wdgvar['c_open']||$GLOBALS['CMT']):?><?php echo $g['s']?>/?r=<?php echo $r?>&m=comment&skin=<?php echo $wdgvar['c_skin']?>&hidepost=<?php echo $wdgvar['c_hidepost']?>&iframe=Y&cync=[<?php echo $m?>][<?php echo $wdgvar['parent']?>][,,,][][][<?php echo $wdgvar['rdrect']?>]&CMT=<?php echo $GLOBALS['CMT']?><?php endif?>" width="100%" height="0" frameborder="0" scrolling="no" allowTransparency="true"></iframe>

<script type="text/javascript">
//<![CDATA[
var wdjTop<?php echo $wdgvar['parent']?> = <?php echo $_size[2]? str_replace('px','',$_size[2]) : 0?>;
function WidgetCommentShow<?php echo $i?>()
{
	var url;
	url = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=comment&skin=<?php echo $wdgvar['c_skin']?>&hidepost=<?php echo $wdgvar['c_hidepost']?>&iframe=Y&cync=';
	url+= '[<?php echo $m?>]';
	url+= '[<?php echo $wdgvar['parent']?>]';
	url+= '[,,,]';
	url+= '[]';
	url+= '[]';
	url+= '[<?php echo $wdgvar['rdrect']?>]';
	url+= '&CMT=<?php echo $GLOBALS['CMT']?>';
	frames.commentFrame<?php echo $i?>.location.href = url;
}
//]]>
</script>
