<?php
App::uses('AppHelper', 'View/Helper');

class SocialNetworkHelper extends AppHelper {
	
	public function insertFacebookShare($url=null){
		
		if($url != null) $url = 'data-href="'.$url.'"';
		
		$script = '
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/de_DE/all.js#xfbml=1";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, \'script\', \'facebook-jssdk\'));</script>
			<div class="fb-like" '.$url.' data-send="false" data-layout="button_count" data-width="100" data-show-faces="true" data-font="arial"></div>
		';
		
		return $script;
		
	} // function insertFacebookShare
	
	public function insertTwitterShare($url=null){
		
		if($url != null) $url = 'data-url="'.$url.'"';
		
		$script = '	<a href="https://twitter.com/share" class="twitter-share-button" data-via="twitterapi" '.$url.' data-lang="en">Tweet</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							';
		return $script;
		
	} // function insertTwitterShare
	
	public function insertGoogleShare($url=null){
		
		if($url != null) $url = 'href="'.$url.'"';
		
		$script = '
			<g:plusone size="medium" '.$url.' annotation="none"></g:plusone>
			<script type="text/javascript">
			  (function() {
			    var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
			    po.src = \'https://apis.google.com/js/plusone.js\';
			    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>
		';
		
		return $script;
		
	} // function insertGoogleShare
	
	public function insertXingShare($url=null,$title=null){
		
		if($title != null) $title = 'title='.$title;
		if($url == null) $url = '"+location.href+"';
		
		$script = '
			<div class="xing"></div>
			<script>
				$(".xing").attr({
				"href": "https://www.xing.com/app/user?op=share;url='.$url.';'.$title.'
				});
			</script>
		';
		
		$script = '
			<script type="XING/Share" data-counter="no_count" data-lang="de" data-button-shape="rectangle"></script><script src="https://www.xing-share.com/js/external/share.js" type="text/javascript"></script>
		';
		
		return $script;
		
	} // function insertXingShare
	
	public function insertLinkedShare($url=null){
		
		if($url != null) $url = 'data-url="'.$url.'"';
		
		$script = '
			<script src="http://platform.linkedin.com/in.js" type="text/javascript"></script>
			<script type="IN/Share" '.$url.'></script>
		';
		
		return $script;
		
	} // function insertLinkedShare
	
	
} // class FacebookHelper