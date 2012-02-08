<?php
/**
 * This file is part of BeePublished which is based on CakePHP.
 * BeePublished is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3
 * of the License, or any later version.
 * BeePublished is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public
 * License along with BeePublished. If not, see
 * http://www.gnu.org/licenses/.
 *
 * 
 * @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
 * @author Matthias Bentz and Martin Bredy
 * 
 * @description This helper allows you to add some SocialNetworks into your view.
 *
 **/

App::uses('AppHelper', 'View/Helper');

class SocialNetworkHelper extends AppHelper {
	
	/**
	 * 
	 * This function adds a Facebook-Share-Button
	 * The $url Parameter allows you to use a other URL instead of the current URL on this Page
	 * 
	 * @param String $url 
	 */
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
	
	/**
	 * 
	 * This function adds a Twitter-Share-Button
	 * The $url Parameter allows you to use a other URL instead of the current URL on this Page
	 * 
	 * @param String $url
	 */
	public function insertTwitterShare($url=null){
		
		if($url != null) $url = 'data-url="'.$url.'"';
		
		$script = '	<a href="https://twitter.com/share" class="twitter-share-button" data-via="twitterapi" '.$url.' data-lang="en">Tweet</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							';
		return $script;
		
	} // function insertTwitterShare
	
	/**
	 * 
	 * This function adds a Google+-Share-Button
	 * The $url Parameter allows you to use a other URL instead of the current URL on this Page
	 * 
	 * @param String $url
	 */
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
	
	/**
	 * 
	 * This function adds a Xing-Share-Button
	 * The $url & $title Parameter allows you to use a other URL & Title instead of the current URL & Title on this Page
	 * 
	 * @param String $url
	 */
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
	
	/**
	 * 
	 * This function adds a LinkedIn-Share-Button
	 * The $url Parameter allows you to use a different URL instead of the current URL on this Page
	 * 
	 * @param String $url
	 */
	public function insertLinkedShare($url=null){
		
		if($url != null) $url = 'data-url="'.$url.'"';
		
		$script = '
			<script src="http://platform.linkedin.com/in.js" type="text/javascript"></script>
			<script type="IN/Share" '.$url.'></script>
		';
		
		return $script;
		
	} // function insertLinkedShare
	
	
} // class FacebookHelper