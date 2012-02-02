﻿<?php $this->Html->script('/impressum/js/impressum', false); ?>
<!-- so this is the automatically generated impressum, which is dynamically created based on database entries -->

<!-- heading section -->
<h1>
	<?php echo __('Impressum'); ?>
</h1>
<p>
	<small>
		<?php echo __('Angaben gemäß §5 TMG:'); ?>
	</small>
	<br>
	<br>
</p>

<!-- so now here comes some general data like name and address -->
<p>
	<!-- when company, club or public, provide legal entity's title and form, otherwise natural person's name -->
	<?php
		if ($data['Impressum']['type']==('comp') or  $data['Impressum']['type']==('club')) {
			echo $data['Impressum']['comp_name'].' '.$data['Impressum']['legal_form'];
		} elseif ($data['Impressum']['type']==('public')) {
			echo $data['Impressum']['legal_form'].' '.$data['Impressum']['comp_name'];
			echo ('<br>Körperschaft des öffentlichen Rechts');
		} else {
			echo $data['Impressum']['first_name'].' '.$data['Impressum']['last_name'];
		}
	?>
	<!-- now everybody needs an address -->
	<br />
	<?php echo $data['Impressum']['street'].' '.$data['Impressum']['house_no']; ?>
	<br />
	<?php echo $data['Impressum']['post_code'].' '.$data['Impressum']['city']; ?>
	<br />
	<?php echo $data['Impressum']['country']; ?>
	<br />
</p>
<br>

<!-- authorised representative is only necessary if type is company, club or public -->
<?php if ($data['Impressum']['type']==('comp') or  $data['Impressum']['type']==('club') or $data['Impressum']['type']==('public')) { ?>
	<h3>
		<?php echo __('Vertretungsberechtigt').': '; ?>
	</h3>
	<p>
		<?php echo $data['Impressum']['auth_rep_first_name'].' '.$data['Impressum']['auth_rep_last_name']; ?>
	</p>
<?php } //if type = comp, club or public ?>

<!-- and here comes the contact data, depending on whether it is set or not -->
<br>
<h2>
	<?php echo __('Kontaktdaten'); ?>
</h2>
<br>
<table>
	<tbody>
		<?php 
			if (!empty($data['Impressum']['phone_no'])) {
				echo("<tr>
						<td>
							<p>".__('Telefon').":</p>
						</td>
						<td>
							<p>".$data['Impressum']['phone_no']."</p>
						</td>
					</tr>");
			}
		?>
		<?php 
			if (!empty($data['Impressum']['fax_no'])) {
				echo("<tr>
						<td>
							<p>".__('Telefax').":</p>
						</td>
						<td>
							<p>".$data['Impressum']['fax_no']."</p>
						</td>
					</tr>");
			}
		?>
		<?php 
			if (!empty($data['Impressum']['email'])) {
				echo("<tr>
						<td>
							<p>".__('E-Mail').":</p>
						</td>
						<td>
							<p>".$this->Html->link($data['Impressum']['email'], 'mailto:'.$data['Impressum']['email'])."</p>
						</td>
					</tr>");
			}
		?>
	</tbody>
</table>

<!-- this was all data a private person needs to provide -->
<?php if ($data['Impressum']['type']!='priv') { ?>
	<br>
	<!-- so now here comes all the legal stuff -->

	<!-- maybe it has to be registered -->
	<?php if ($data['Impressum']['reg']) {?>
		<h2>
			<?php echo __('Registereintrag'); ?>
		</h2>
		<p>
			<?php echo __('Eintragung beim ').$data['Impressum']['reg_name']; ?>
			<br>
			<?php echo $data['Impressum']['reg_street'].' '.$data['Impressum']['reg_house_no']; ?>
			<br>
			<?php echo $data['Impressum']['reg_post_code'].' '.$data['Impressum']['reg_city']; ?>
			<br>
			<?php echo $data['Impressum']['reg_country']; ?>
			<br>
			<br>
			<?php echo __('Registernummer: ').$data['Impressum']['reg_no']; ?>
		</p>
	<?php } //reg == true?>

	<!-- only companies need economical identification -->
	<?php if ($data['Impressum']['type'] == 'comp') {?>
		<br>
		<h2>
			<?php echo __('Umsatzsteuer-Identifikationsnummer'); ?>
		</h2>
		<p>
			<small>
				<?php echo __('gemäß §27 a Umsatzsteuergesetz'); ?>
			</small>
		</p>
		<br>
		<p>
			<?php echo $data['Impressum']['vat_no']; ?>
		</p>

		<!-- but only some have an economic number -->
		<?php if (!empty($data['Impressum']['eco_no'])) { ?>
			<br>
			<h2>
				<?php echo __('Wirtschafts-Identifikationsnummer'); ?>
			</h2>
			<p>
				<small>
					<?php echo __('gemäß §139c Abgabenordnung'); ?>
				</small>
			</p>
			<br>
			<p>
				<?php echo $data['Impressum']['eco_no']; ?>
			</p>
		<?php } //eco_no ?>
	<?php } //type == comp ?>

	<!-- maybe there is an admission office -->
	<?php if ($data['Impressum']['adm_office']) { ?>
		<br>
		<h2>
			<?php echo __('Aufsichtsbehörde'); ?>
		</h2>
		<p>
			<!-- job title is only needed if the person has a special job -->
			<?php 
				if ($data['Impressum']['type'] == 'job') { 
					echo "<br>".__('Berufsbezeichnung: ').$data['Impressum']['job_title']; 
					echo "<br>".__('Zuständige Kammer: ');
				} else {
					echo "<br>".__('Zuständige Behörde: ');
				}
				echo $data['Impressum']['adm_office_name'];
			?>
			<br>
			<?php echo $data['Impressum']['adm_office_street'].' '.$data['Impressum']['adm_office_house_no']; ?>
			<br>
			<?php echo $data['Impressum']['adm_office_post_code'].' '.$data['Impressum']['adm_office_city']; ?>
			<br>
			<?php 
				if($data['Impressum']['type'] == 'job') {
					echo __('Land der Verleihung').': ';
				}
				echo $data['Impressum']['adm_office_country']; 
			?>
			<br>
			<?php 
				if ($data['Impressum']['type'] == 'job') {
					echo __('Es gelten folgende berufsrechtliche Regelungen: ').
					$this->Html->link($data['Impressum']['regulations_name'],$data['Impressum']['regulations_link'], array('target' => '_blank'));
				}
			?>
		</p>
		<br>
	<?php } //adm_office == true ?>
<?php } //type != priv ?>

<!-- now everybody needs the following -->
<h2>
	<?php echo __('Haftungsausschluss'); ?>
</h2>
<h3>
	<?php echo __('Haftung für Inhalte'); ?>
</h3>
<p align="justify">
	<?php echo __('Die Inhalte unserer Seiten wurden mit größter Sorgfalt erstellt. Für
		die Richtigkeit, Vollständigkeit und Aktualität der Inhalte können wir
		jedoch keine Gewähr übernehmen. Als Diensteanbieter sind wir gemäß § 7
		Abs.1 TMG für eigene Inhalte auf diesen Seiten nach den allgemeinen
		Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir als
		Diensteanbieter jedoch nicht verpflichtet, übermittelte oder
		gespeicherte fremde Informationen zu überwachen oder nach Umständen zu
		forschen, die auf eine rechtswidrige Tätigkeit hinweisen.
		Verpflichtungen zur Entfernung oder Sperrung der Nutzung von
		Informationen nach den allgemeinen Gesetzen bleiben hiervon unberührt.
		Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt der
		Kenntnis einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden
		von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend
		entfernen.');
	?>
</p>
<br>
<h3>
	<?php echo __('Urheberrecht'); ?>
</h3>
<p align="justify">
	<?php echo __('Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen
		Seiten unterliegen dem deutschen Urheberrecht. Die Vervielfältigung,
		Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der
		Grenzen des Urheberrechtes bedürfen der schriftlichen Zustimmung des
		jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite
		sind nur für den privaten, nicht kommerziellen Gebrauch gestattet.
		Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt
		wurden, werden die Urheberrechte Dritter beachtet. Insbesondere werden
		Inhalte Dritter als solche gekennzeichnet. Sollten Sie trotzdem auf	
		eine Urheberrechtsverletzung aufmerksam werden, bitten wir um einen
		entsprechenden Hinweis. Bei Bekanntwerden von Rechtsverletzungen werden
		wir derartige Inhalte umgehend entfernen.'); 
	?>
</p>
<br>
<h3>
	<?php echo __('Datenschutz'); ?>
</h3>
<p align="justify">
	<?php echo __('Die Nutzung unserer Webseite ist in der Regel ohne Angabe
		personenbezogener Daten möglich. Soweit auf unseren Seiten
		personenbezogene Daten (beispielsweise Name, Anschrift oder
		eMail-Adressen) erhoben werden, erfolgt dies, soweit möglich, stets auf
		freiwilliger Basis. Diese Daten werden ohne Ihre ausdrückliche
		Zustimmung nicht an Dritte weitergegeben.');
	?>
</p>
<br>
<p align="justify">
	<?php echo __('Wir weisen darauf hin, dass die Datenübertragung im Internet (z.B.
		bei der Kommunikation per E-Mail) Sicherheitslücken aufweisen kann. Ein
		lückenloser Schutz der Daten vor dem Zugriff durch Dritte ist nicht
		möglich.'); 
	?>
</p>
<br>
<p align="justify">
	<?php echo __('Der Nutzung von im Rahmen der Impressumspflicht veröffentlichten
		Kontaktdaten durch Dritte zur Übersendung von nicht ausdrücklich
		angeforderter Werbung und Informationsmaterialien wird hiermit
		ausdrücklich widersprochen. Die Betreiber der Seiten behalten sich
		ausdrücklich rechtliche Schritte im Falle der unverlangten Zusendung
		von Werbeinformationen, etwa durch Spam-Mails, vor.'); 
	?>
</p>
<br>

<!-- the following is only needed if facebook plugin is used -->
<?php if ($data['Impressum']['facebook']) { ?>
	<h3>
		<?php echo __('Datenschutzerklärung für die Nutzung von Facebook-Plugins (Like-Button)'); ?>
	</h3>
	<br>
	<p align="justify">
		<?php 
			echo __('Auf unseren Seiten sind Plugins des sozialen Netzwerks Facebook, 1601
			South California Avenue, Palo Alto, CA 94304, USA integriert. Die
			Facebook-Plugins erkennen Sie an dem Facebook-Logo oder dem
			"Like-Button" ("Gefällt mir") auf unserer Seite. Eine Übersicht über
			die Facebook-Plugins finden Sie ').
			$this->Html->link(__('hier'),"http://developers.facebook.com/docs/plugins/", array('target' => '_blank')).'.';
		?>
	</p>
	<br>
	<p align="justify">
		<?php 
			echo __('Wenn Sie unsere Seiten besuchen, wird über das Plugin eine direkte
			Verbindung zwischen Ihrem Browser und dem Facebook-Server hergestellt.
			Facebook erhält dadurch die Information, dass Sie mit Ihrer IP-Adresse
			unsere Seite besucht haben. Wenn Sie den Facebook "Like-Button"
			anklicken, während Sie in Ihrem Facebook-Account eingeloggt sind, können
			Sie die Inhalte unserer Seiten auf Ihrem Facebook-Profil verlinken.
			Dadurch kann Facebook den Besuch unserer Seiten Ihrem Benutzerkonto
			zuordnen. Wir weisen darauf hin, dass wir als Anbieter der Seiten keine
			Kenntnis vom Inhalt der übermittelten Daten sowie deren Nutzung durch
			Facebook erhalten. Weitere Informationen hierzu finden Sie in der ').
			$this->Html->link(__('Datenschutzerklärung von Facebook'), "http://www.facebook.com/policy.php", array('target' => '_blank')).'.';
		?>
	</p>
	<br>
	<p align="justify">
		<?php 
			echo __('Wenn Sie nicht wünschen, dass Facebook den Besuch unserer Seiten
			Ihrem Facebook-Nutzerkonto zuordnen kann, loggen Sie sich bitte aus
			Ihrem Facebook-Benutzerkonto aus.'); 
		?>
	</p>
	<br>
<?php } //facebook == true ?>

<!-- the following is only needed if the twitter plugin is used -->
<?php if ($data['Impressum']['twitter']) { ?>
	<h3>
		<?php echo __('Datenschutzerklärung für die Nutzung von Twitter'); ?>
	</h3>
	<br>
	<p align="justify">
		<?php 
			echo __('Auf unseren Seiten sind Funktionen des Dienstes Twitter eingebunden.
			Diese Funktionen werden angeboten durch die Twitter Inc., 795 Folsom
			St., Suite 600, San Francisco, CA 94107, USA. Durch das Benutzen von
			Twitter und der Funktion "Re-Tweet" werden die von Ihnen besuchten
			Webseiten mit Ihrem Twitter-Account verknüpft und anderen Nutzern
			bekannt gegeben. Dabei werden auch Daten an Twitter übertragen.'); 
		?>
	</p>
	<br>
	<p align="justify">
		<?php 
			echo __('Wir weisen darauf hin, dass wir als Anbieter der Seiten keine Kenntnis
			vom Inhalt der übermittelten Daten sowie deren Nutzung durch Twitter
			erhalten. Weitere Informationen hierzu finden Sie in der ').
			$this->Html->link(__('Datenschutzerklärung von Twitter'), "http://twitter.com/privacy", array('target' => '_blank')).'.'; 
		?>
	</p>
	<br>
	<p align="justify">
		<?php 
			echo __('Ihre Datenschutzeinstellungen bei Twitter können Sie in den ').
			$this->Html->link(__('Konto-Einstellungen'), "http://twitter.com/account/settings", array('target' => '_blank')).__(' ändern.');
		?>
	</p>
<?php }//twitter == true?>

<!-- the following is only needed if the google plus plugin is used -->
<?php if ($data['Impressum']['google_plus']) { ?>
	<h3>
		<?php echo __('Datenschutzerklärung für die Nutzung von GooglePlus'); ?>
	</h3>
	<br>
	<p align="justify">
		<?php 
			echo __('Diese Website verwendet die "Plus +1"-Schaltfläche ("Google-Plus Button") des 
			Social Networks "Google Plus", das von Google Inc., 1600 Amphitheatre Parkway, Mountain View, 
			CA 94043, USA betrieben wird ("Google"). Der "Google-Plus Button" ist an dem Zeichen "+1" 
			auf weißem oder farbigen Hintergrund erkennbar. Wenn Sie eine Seite unserer Website aufrufen,
			die eine solche Schaltfläche ("Google-Plus Button") enthält, baut Ihr Browser eine Verbindung 
			mit den Servern von Google auf. Der Inhalt der "+1"-Schaltfläche  wird von Google direkt an 
			Ihren Browser übermittelt und von diesem in die Webseite eingebunden. Wir haben keinen 
			Einfluss auf Umfang, Inhalt und Art der Daten, die Google mit der Schaltfläche erfasst. 
			Es ist davon auszugehen, dass u.a. die IP-Adresse mit erfasst wird. Zweck und Umfang der 
			Datenerhebung und die weitere Verarbeitung und Nutzung der erfassten Daten durch Google sowie 
			Ihre diesbezüglichen Rechte und Einstellungsmöglichkeiten zum Schutz Ihrer Privatsphäre 
			entnehmen Sie bitte den ').
			$this->Html->link(__('Datenschutzhinweisen'), "http://www.google.com/intl/de/+/policy/+1button.html", array('target' => '_blank')).
			__('von Google zur "+1"-Schaltfläche. Wenn Sie bei Google Plus registriert sind und nicht möchten, 
			dass Google über unsere Website Daten über Sie sammelt und mit Ihren bei Google gespeicherten 
			Mitgliedsdaten verknüpft, müssen Sie sich vor Ihrem Besuch unserer Website bei Google Plus ausloggen.'); 
		?>
	</p>
<?php }//google plus == true?>

<!-- the following is only needed if the xing plugin is used -->
<?php if ($data['Impressum']['xing']) { ?>
	<h3>
		<?php echo __('Datenschutzerklärung für die Nutzung von Xing'); ?>
	</h3>
	<br>
	<p align="justify">
		<?php 
			echo __('Auf dieser Website werden Social Plugins von Xing, betrieben durch die XING AG,
			Gänsemarkt 43, 20354 Hamburg, verwendet. Diese Plugins sind an dem Xing-Logo zu erkennen. 
			Wenn Sie den Xing-Button anklicken, wird die entsprechende Information von Ihrem Browser 
			direkt an Xing übermittelt und dort gespeichert. Wir haben keinen Einfluss auf Umfang, 
			Inhalt und Art der Daten, die Xing mit der Schaltfläche erfasst. Details zum Umgang mit Ihren 
			persönlichen Daten durch Xing sowie Ihren diesbezüglichen Rechten entnehmen Sie bitte den').
			$this->Html->link(__('Datenschutzhinweisen von Xing'), "http://www.xing.com/privacy", array('target' => '_blank')).
			__('. Wenn Sie Xing-Mitglied sind und nicht möchten, dass Xing über unsere Webseite Daten 
			Daten über Sie sammelt, sollten Sie sich vor dem Besuch unserer Webseite bei Xing ausloggen.'); 
		?>
	</p>
<?php }//xing == true?>

<!-- the following is only needed if the linkedin plugin is used -->
<?php if ($data['Impressum']['linkedin']) { ?>
	<h3>
		<?php echo __('Datenschutzerklärung für die Nutzung von LinkedIn'); ?>
	</h3>
	<br>
	<p align="justify">
		<?php 
			echo __('Auf unseren Webseiten verwenden wir Social Plugins von LinkedIn, betrieben durch die 
			LinkedIn Corporation, 2029 Stierlin Court, Mountain View, California 94043, USA. 
			Wenn Sie den LinkedIn-Button anklicken, wird die entsprechende Information von Ihrem Browser 
			direkt an LinkedIn übermittelt und dort gespeichert. Wir haben keinen Einfluss auf Umfang, 
			Inhalt und Art der Daten, die LinkedIn mit der Schaltfläche erfasst. Details zum Umgang mit Ihren 
			persönlichen Daten durch LinkedIn sowie Ihren diesbezüglichen Rechten entnehmen Sie bitte den').
			$this->Html->link(__('Datenschutzhinweisen von LinkedIn'), "http://de.linkedin.com/static?key=privacy_policy", array('target' => '_blank')).
			__('. Wenn Sie LinkedIn-Mitglied sind und nicht möchten, dass LinkedIn über unsere Webseite Daten 
			Daten über Sie sammelt, sollten Sie sich vor dem Besuch unserer Webseite bei LinkedIn ausloggen.'); 
		?>
	</p>
<?php }//linkedin == true?>

<!-- and now write where we stole the texts ;-) -->
<p style="font-style: italic;">
	<small>
		<?php
			echo __('Quelle der Texte: ').$this->Html->link(__('Impressum-Generator von e-Recht24', array('target' => '_blank')), "http://www.e-recht24.de");
			echo '<br>';
			echo __('Diese Seite wurde mit ').$this->Html->link(__('YAML'), 'http://www.yaml.de', array('target' => '_blank')).__(' erstellt.');
		?>
	</small>
	
</p>