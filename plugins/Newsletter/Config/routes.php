<?php
Router::connect('/unsubscribepermail/*', array('plugin' => 'newsletter', 'controller' => 'Subscription', 'action' => 'unSubscribePerMail'));