<?php
class GoogleMapsComponent extends Component {
	public function getRecipients($controller, $params)
	{
		$controller->loadModel("NewsletterRecipients");
		$recipients = $controller->NewsletterRecipients->find('first');
		if ($recipients != null) {
			return $recipients;
		} else {
			return __('no location');
		}
	}
}