
<script type="text/javascript" src="http://widgets.twimg.com/j/2/widget.js"></script>
<script type="text/javascript">
//<![CDATA[
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: <?php echo $wdgvar['num']?>,
  interval: 5000,
  width: <?php echo $wdgvar['width']?>,
  height: <?php echo ($wdgvar['height']-100)?>,
  theme: {
    shell: {
      background: '#<?php echo $wdgvar['bgcolor1']?>',
      color: '#<?php echo $wdgvar['color1']?>'
    },
    tweets: {
      background: '#<?php echo $wdgvar['bgcolor']?>',
      color: '#<?php echo $wdgvar['color']?>',
      links: '#<?php echo $wdgvar['link']?>'
    }
  },
  features: {
    scrollbar: true,
    loop: true,
    live: true,
    hashtags: true,
    timestamp: true,
    avatars: false,
    behavior: '<?php echo $wdgvar['behavior']?>'
  }
}).render().setUser('<?php echo $wdgvar['id']?>').start();
//]]>
</script>

