<?php $this->Html->script('/impressum/js/impressum', false); ?>
<!-- so this is the automatically generated impressum, which is dynamically created based on database entries -->

<!-- heading section -->
<h1><?php echo __('Impressum'); ?></h1>
<p><small><?php echo __('Angaben gemäß §5 TMG:'); ?></small><br><br></p>

<!-- so now here comes some general data like name and address -->
<p>
	<!-- when company or club, provide legal entity's title and authorized representative, otherwise natural person's name -->
	<?php
		if ($data['Impressum']['type']==('comp') or  $data['Impressum']['type']==('club')) {
			echo $data['Impressum']['comp_name'].' '.$data['Impressum']['legal_form'];
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

<!-- authorised representative is only necessary if type is company or club -->
<?php if ($data['Impressum']['type']==('comp') or  $data['Impressum']['type']==('club')) { ?>
	<h3><?php echo __('Vertretungsberechtigt').': '; ?></h3>
	<p><?php echo $data['Impressum']['auth_rep_first_name'].' '.$data['Impressum']['auth_rep_last_name']; ?></p>
<?php } //if type = comp or club ?>


<!-- and here comes the contact data, depending on whether it is set or not -->
<br>
<h2><?php echo __('Kontaktdaten'); ?></h2>
<table>
	<tbody>
		<?php 
			if (!empty($data['Impressum']['phone_no'])) {
				echo("<tr>
						<td><p>".__('Telefon').":</p></td>
						<td><p>".$data['Impressum']['phone_no']."</p></td>
					</tr>");
			}
		?>
		<?php 
			if (!empty($data['Impressum']['fax_no'])) {
				echo("<tr>
						<td><p>".__('Telefax').":</p></td>
						<td><p>".$data['Impressum']['fax_no']."</p></td>
					</tr>");
			}
		?>
		<?php 
			if (!empty($data['Impressum']['email'])) {
				echo("<tr>
						<td><p>".__('E-Mail').":</p></td>
						<td><p>".$this->Html->link($data['Impressum']['email'], 'mailto:'.$data['Impressum']['email'])."</p></td>
					</tr>");
			}
		?>
	</tbody>
</table>
<br>

<!-- this was all data a private person needs to provide -->
<?php if ($data['Impressum']['type']!='priv') { ?>

	<!-- so now here comes all the legal stuff -->

	<!-- maybe it has to be registered -->
	<?php if ($data['Impressum']['reg']) {?>
		<h2><?php echo __('Registereintrag'); ?></h2>
		<p>
			<?php echo __('Eintragung beim ').$data['Impressum']['reg_name']; ?>
			<br>
			<?php echo $data['Impressum']['reg_street'].' '.$data['Impressum']['reg_house_no']; ?>
			<br>
			<?php echo $data['Impressum']['reg_post_code'].' '.$data['Impressum']['reg_city']; ?>
			<br>
			<?php echo $data['Impressum']['reg_country']; ?>
			<br><br>
			<?php echo __('Registernummer: ').$data['Impressum']['reg_no']; ?>
		</p>
	<?php } //reg == true?>

	<!-- only companies need economical identification -->
	<?php if ($data['Impressum']['type'] == 'comp') {?>
		<br>
		<h2><?php echo __('Umsatzsteuer-Identifikationsnummer'); ?></h2>
		<p><small><?php echo __('gemäß §27 a Umsatzsteuergesetz'); ?></small></p><br>
		<p><?php echo $data['Impressum']['vat_no']; ?></p>

		<!-- but only some have an economic number -->
		<?php if (!empty($data['Impressum']['eco_no'])) { ?>
			<br>
			<h2><?php echo __('Wirtschafts-Identifikationsnummer'); ?></h2>
			<p><small><?php echo __('gemäß §139c Abgabenordnung'); ?></small></p><br>
			<p><?php echo $data['Impressum']['eco_no']; ?></p>
		<?php } //eco_no ?>
	<?php } //type == comp ?>

	<!-- maybe there is an admission office -->
	<?php if ($data['Impressum']['adm_office']) { ?>
		<br>
		<h2><?php echo __('Aufsichtsbehörde'); ?></h2>
		<p>
			<!-- job title is only needed if the person has a special job -->
			<?php 
				if ($data['Impressum']['type'] == 'job') { 
					echo "<br>".__('Berufsbezeichnung').': '.$data['Impressum']['job_title']; 
					echo "<br>".__('Zuständige Kammer:');
				} else {
					echo "<br>".__('Zuständige Behörde:');
				}
			?>
			<?php echo $data['Impressum']['adm_office_name']; ?>
			<br />
			<?php echo $data['Impressum']['adm_office_street'].' '.$data['Impressum']['adm_office_house_no']; ?>
			<br />
			<?php echo $data['Impressum']['adm_office_post_code'].' '.$data['Impressum']['adm_office_city']; ?>
			<br />
			<?php 
				if($data['Impressum']['type'] == 'job') {
					echo __('Land der Verleihung').': ';
				}
				echo $data['Impressum']['adm_office_country']; 
			?>
			<br />
			<?php 
				if ($data['Impressum']['type'] == 'job') {
					echo __('Es gelten folgende berufsrechtliche Regelungen').': '.
					$this->Html->link($data['Impressum']['adm_regulations'],$data['Impressum']['adm_regulations_link']);
				}
			?>
		</p>
	<?php } //adm_office == true ?>
<?php } //type != priv ?>

<!-- now everybody needs the following -->
<br>
<h2><?php echo __('Haftungsausschluss'); ?></h2>
<h3><?php echo __('Haftung für Inhalte'); ?></h3>
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
<h3><?php echo __('Urheberrecht'); ?></h3>
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
<h3><?php echo __('Datenschutz'); ?></h3>
<p align="justify">
<?php echo __('Die Nutzung unserer Webseite ist in der Regel ohne Angabe
	personenbezogener Daten möglich. Soweit auf unseren Seiten
	personenbezogene Daten (beispielsweise Name, Anschrift oder
	eMail-Adressen) erhoben werden, erfolgt dies, soweit möglich, stets auf
	freiwilliger Basis. Diese Daten werden ohne Ihre ausdrückliche
	Zustimmung nicht an Dritte weitergegeben.'); ?>
</p>
<br>
<p align="justify">
<?php echo __('Wir weisen darauf hin, dass die Datenübertragung im Internet (z.B.
	bei der Kommunikation per E-Mail) Sicherheitslücken aufweisen kann. Ein
	lückenloser Schutz der Daten vor dem Zugriff durch Dritte ist nicht
	möglich.'); ?>
</p>
<br>
<p align="justify">
<?php echo __('Der Nutzung von im Rahmen der Impressumspflicht veröffentlichten
	Kontaktdaten durch Dritte zur Übersendung von nicht ausdrücklich
	angeforderter Werbung und Informationsmaterialien wird hiermit
	ausdrücklich widersprochen. Die Betreiber der Seiten behalten sich
	ausdrücklich rechtliche Schritte im Falle der unverlangten Zusendung
	von Werbeinformationen, etwa durch Spam-Mails, vor.'); ?>
</p>
<br>
<p></p>
<!-- the following is only needed if facebook plugin is used -->
<?php if ($data['Impressum']['facebook']) { ?>
	<h3><?php echo __('Datenschutzerklärung für die Nutzung von Facebook-Plugins (Like-Button)'); ?></h3>
	<br>
	<p align="justify">
		<?php 
			echo __('Auf unseren Seiten sind Plugins des sozialen Netzwerks Facebook, 1601
			South California Avenue, Palo Alto, CA 94304, USA integriert. Die
			Facebook-Plugins erkennen Sie an dem Facebook-Logo oder dem
			"Like-Button" ("Gefällt mir") auf unserer Seite. Eine Übersicht über
			die Facebook-Plugins finden Sie ').
			$this->Html->link(__('hier'),"http://developers.facebook.com/docs/plugins/").'.';
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
			$this->Html->link(__('Datenschutzerklärung von Facebook'), "http://www.facebook.com/policy.php").'.';
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
	<h3><?php echo __('Datenschutzerklärung für die Nutzung von Twitter'); ?></h3>
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
			$this->Html->link(__('Datenschutzerklärung von Twitter'), "http://twitter.com/privacy").'.'; 
		?>
	</p>
	<br>
	<p align="justify">
		<?php 
			echo __('Ihre Datenschutzeinstellungen bei Twitter können Sie in den ').
			$this->Html->link(__('Konto-Einstellungen'), "http://twitter.com/account/settings").__(' ändern.');
		?>
	</p>
<?php }//twitter == true?>