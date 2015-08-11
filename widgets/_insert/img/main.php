
<?php if($wdgvar['href']):?>
<a href="<?php echo $wdgvar['href']?>"<?php if($wdgvar['target']):?> target="<?php echo $wdgvar['target']?>"<?php endif?>><img src="<?php echo $wdgvar['url']?>" alt="<?php echo $wdgvar['alt']?>" title="<?php echo $wdgvar['alt']?>" /></a>
<?php else:?>
<img src="<?php echo $wdgvar['url']?>" alt="<?php echo $wdgvar['alt']?>" title="<?php echo $wdgvar['alt']?>" />
<?php endif?>
