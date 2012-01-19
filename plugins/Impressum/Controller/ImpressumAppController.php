<?php

class ImpressumAppController extends AppController {

	public $name = 'Impressum';
	public $helpers = array('Html', 'Form');
	private $complete = false;

	//authorization check
	function beforeFilter()	{
		//Actions which don't require authorization
		parent::beforeFilter();
		//TODO change to save
		$this->Auth->allow('*');
	}

	/**
	 * methods which may be helpful for other controllers
	 */

	/**
	 * This method checks whether all necessary data was entered.
	 * @return boolean
	 */
	function isComplete() {
		$this->checkDataCompleteness();
		return $this->complete;
	}

	/**
	 * Please call this method when the facebook plugin is added or removed.
	 * @param add = true, remove = false
	 */
	function setFacebook($facebook) {
		$data = array('id' => 1, 'facebook' => $facebook);
		$this->Impressum->save($data);
	}

	/**
	 * Please call this method when the twitter plugin is added or removed.
	 * @param add = true, remove = false
	 */
	function setTwitter($twitter) {
		$data = array('id' => 1, 'twitter' => $twitter);
		$this->Impressum->save($data);
	}

	/**
	 * Please call this method when a picture is added which is not the user's own.
	 * @param link of the picture's origin or name of creator
	 * @return id of the origin's table entry
	 */
	function addPicture($origin) {
		return $id;
	}

	/**
	 * Please call this method when a picture is removed which is not the user's own.
	 * @param id of the origin's table entry. You got that one when adding the picture.
	 * @return boolean stating success
	 */
	function removePicture($id) {
		return true;
	}

	/**
	 * This method is called when the form in chooseType.ctp is submitted.
	 */
	function chooseType() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			switch ($data['Impressum']['type']) {
				case 'comp':
					$data = array('id' => 1, 'type' => 'comp');
					$this->Impressum->save($data);
					$this->redirect(array('url' => array('plugin'     => 'Impressum',
													   	  'controller' => 'ImpressumApp',
														  'action'	   => 'compData')));
					break;
				case 'club':
					$data = array('id' => 1, 'type' => 'club');
					$this->Impressum->save($data);
					$this->redirect(array('action' => 'clubData'));
					break;
				case 'job':
					$data = array('id' => 1, 'type' => 'job');
					$this->Impressum->save($data);
					$this->redirect(array('action' => 'privJobData'));
					break;
				default:
					$data = array('id' => 1, 'type' => 'priv');
					$this->Impressum->save($data);
					$this->redirect(array('action' => 'privJobData'));
					break;
			}
		}
	}

	/**
	 * The following methods are called when the different forms are submitted.
	 */

	/**
	 * private person
	 */

	/**
	 * this function saves all data that was entered on the general screen of types 'priv' and 'job'
	 */
	function privJobData() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->checkPrivData($data);
			if ($this->complete) {
				$this->checkAddress($data);
				if ($this->complete) {
					$this->Impressum->id = 1;
					$this->Impressum->save($data);
					$this->redirect(array('action' => 'privJobContact'));
				}
			}
		}
	}

	/**
	 * this function saves all data that was entered on the contact screen of types 'priv' and 'job'
	 */
	function privJobContact() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->checkContactData($data);
			if ($this->complete) {
				$this->Impressum->id = 1;
				$this->Impressum->save($data);
				if ($data['Impressum']['type'] == 'job') {
					$this->redirect(array('action' => 'jobData'));
				} else {
					$this->Session->setFlash(__('Impressum wurde erfolgreich erstellt!'));
					$this->redirect(array('action' => 'show'));
				}
			}
		}
	}

	/**
	 * company
	 */

	/**
	 * this function saves all data that was entered on the general screen of type 'comp'
	 */
	function compData() {
		if ($this->request->is('get')) {
			$this->request->data = $this->Impressum->find('first');
		}
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->checkCompData($data);
			if ($this->complete) {
				$this->checkAddress($data);
				if ($this->complete) {
					$this->Impressum->id = 1;
					$this->Impressum->save($data);
					$this->redirect(array('action'=>'compContact'));
				}
			}
		}
	}

	/**
	 * this function saves all data that was entered on the contact screen of type 'comp'
	 */
	function compContact() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->checkContactData($data);
			if ($this->complete) {
				$this->Impressum->id = 1;
				$this->Impressum->save($data);
				$this->redirect(array('action'=>'compLegal'));
			}
		}
	}

	/**
	 * this function saves all data that was entered on the legal screen of type 'comp'
	 */
	function compLegal() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->checkLegalData($data);
			if ($this->complete) {
				$this->Impressum->id = 1;
				$this->Impressum->save($data);
				$this->redirect(array('action'=>'compReg'));
			}
		}
	}

	/**
	 * this function saves all data that was entered on the register screen of type 'comp'
	 */
	function compReg() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->checkRegister($data);
			if ($this->complete) {
				$this->Impressum->id = 1;
				$this->Impressum->save($data);
				$this->Session->setFlash(__('Impressum wurde erfolgreich erstellt!'));
				$this->redirect(array('action'=>'show'));
			}
		}
	}

	/**
	 * club
	 */

	/**
	 * this function saves all data that was entered on the general screen of type 'club'
	 */
	function clubData() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->checkClubData($data);
			if ($this->complete) {
				$this->checkAddress($data);
				if ($this->complete) {
					$data['Impressum']['reg'] = true; //every club must be registered
					$this->Impressum->id = 1;
					$this->Impressum->save($data);
					$this->redirect(array('action'=>'clubContact'));
				}
			}
		}
	}

	/**
	 * this function saves all data that was entered on the contact screen of type 'club'
	 */
	function clubContact () {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->checkContactData($data);
			if ($this->complete) {
				$this->Impressum->id = 1;
				$this->Impressum->save($data);
				$this->redirect(array('action'=>'clubReg'));
			}
		}
	}

	/**
	 * this function saves all data that was entered on the register screen of type 'club'
	 */
	function clubReg() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->checkRegister($data);
			if ($this->complete) {
				$this->Impressum->id = 1;
				$this->Impressum->save($data);
				$this->redirect(array('action' => 'show'));
			}
		}
	}

	/**
	 * job
	 */

	function jobData() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->Impressum->id = 1;
			$this->Impressum->save($data);
		}
	}

	/**
	 * The next area is only about checking data completeness
	 */

	function checkDataCompleteness() {
		$data = $this->Impressum->find('first');
		switch ($data['Impressum']['type']) {
			case 'comp':
				$this->checkCompData($data);
				if ($this->complete) {
					$this->checkAddress($data);
					if ($this->complete) {
						$this->checkContactData($data);
						if ($this->complete) {
							$this->checkLegalData($data);
							if ($this->complete and $data['Impressum']['reg']) {
								$this->checkRegister($data);
							}
						};
					}
				}
				break;
			case 'club':
				$this->checkClubData($data);
				if ($this->complete) {
					$this->checkAddress($data);
					if ($this->complete) {
						$this->checkContactData($data);
						if ($this->complete) {
							if (!$data['Impressum']['reg']) {
								$this->complete = false;
								$this->Session->setFlash(__('Jeder Verein muss ins Register eingetragen werden.'));
							} else {
								$this->checkRegister($data);
							}
						}
					}
				}

				break;
			case 'job':
				$this->checkPrivData($data);
				if ($this->complete) {
					$this->checkAddressData($data);
					if ($this->complete) {
						$this->checkContactData($data);
						if ($this->complete) {
							$this->checkJobData($data);
						}
					}
				}
				break;
			default:
				$this->checkPrivData($data);
				if ($this->complete) {
					$this->checkAddress($data);
					if ($this->complete) {
						$this->checkContactData($data);
					}
				}
				break;
		}

	}

	function checkPrivData($data) {
		if (empty($data['Impressum']['first_name'])) {
			$this->complete = false;
			$this->Session->setFlash(__('Vorname fehlt'));
		} else {
			if (empty($data['Impressum']['last_name'])) {
				$this->complete = false;
				$this->Session->setFlash(__('Name fehlt'));
			} else {
				$this->complete = true;
				$this->Session->setFlash(__('Name ist vollständig'));
			}
		}
	}

	function checkCompData($data) {
		if (empty($data['Impressum']['comp_name'])) {
			$this->complete = false;
			$this->Session->setFlash(__('Firma fehlt'));
		} else {
			if (empty($data['Impressum']['legal_form'])) {
				$this->complete = false;
				$this->Session->setFlash(__('Rechtsform fehlt'));
			} else {
				$this->complete = true;
				$this->Session->setFlash(__('Firmenbezeichnung ist vollständig'));
			}
		}
	}

	function checkClubData($data) {
		if (empty($data['Impressum']['comp_name'])) {
			$this->complete = false;
			$this->Session->setFlash(__('Vereinsbezeichnung fehlt'));
		} else {
			if (empty($data['Impressum']['legal_form'])) {
				$this->complete = false;
				$this->Session->setFlash(__('Rechtsform fehlt'));
			} else {
				$this->complete = true;
				$this->Session->setFlash(__('Vereinsbezeichnung ist vollständig'));
			}
		}
	}

	function checkJobData($data) {
		if (!$data['Impressum']['adm']) {
			$this->complete = false;
			$this->Session->setFlash(__('Für geschützte Berufsbezeichnungen muss eine Aufsichtsbehörde angegeben werden.'));
		} else {
			if (empty($data['Impressum']['job_title'])) {
				$this->complete = false;
				$this->Session->setFlash(__('Berufsbezeichnung fehlt'));
			} else {
				if (empty($data['Impressum']['adm_office_name'])) {
					$this->complete = false;
					$this->Session->setFlash(__('Name der Aufsichtsbehörde fehlt'));
				} else {
					if (empty($data['Impressum']['adm_office_street'])) {
						$this->complete = false;
						$this->Session->setFlash(__('Straße der Aufsichtsbehörde fehlt'));
					} else {
						if (empty($data['Impressum']['adm_office_house_no'])) {
							$this->complete = false;
							$this->Session->setFlash(__('Hausnummer der Aufsichtsbehörde fehlt'));
						} else {
							if (empty($data['Impressum']['adm_office_post_code'])) {
								$this->complete = false;
								$this->Session->setFlash(__('Postleitzahl der Aufsichtsbehörde fehlt'));
							} else {
								if (empty($data['Impressum']['adm_office_city'])) {
									$this->complete = false;
									$this->Session->setFlash(__('Ort der Aufsichtsbehörde fehlt'));
								} else {
									if (empty($data['Impressum']['adm_office_country'])) {
										$this->complete = false;
										$this->Session->setFlash(__('Land der Aufsichtsbehörde fehlt'));
									} else {
										$this->complete = true;
										$this->Session->setFlash(__('Daten der Aufsichtsbehörde sind vollständig'));
									}
								}
							}
						}
					}
				}
			}
		}
	}

	function checkAddress($data) {
		if (empty($data['Impressum']['street'])) {
			$this->complete = false;
			$this->Session->setFlash(__('Straße fehlt'));
		} else {
			if (empty($data['Impressum']['house_no'])) {
				$this->complete = false;
				$this->Session->setFlash(__('Hausnummer fehlt'));
			} else {
				if (empty($data['Impressum']['post_code'])) {
					$this->complete = false;
					$this->Session->setFlash(__('Postleitzahl fehlt'));
				} else {
					if (empty($data['Impressum']['city'])) {
						$this->complete = false;
						$this->Session->setFlash(__('Ort fehlt'));
					} else {
						if (empty($data['Impressum']['country'])) {
							$this->complete = false;
							$this->Session->setFlash(__('Land fehlt'));
						} else {
							$this->complete = true;
							$this->Session->setFlash(__('Adresse ist vollständig.'));
						}
					}
				}
			}
		}
	}

	function checkContactData($data) {
		if (empty($data['Impressum']['phone_no']) and empty($data['Impressum']['fax_no']) and empty($data['Impressum']['email'])) {
			$this->complete = false;
			$this->Session->setFlash(__('Sie müssen mindestens eine Kontaktform pflegen (Telefon, Telefax oder E-Mail)'));
		} else {
			$this->complete = true;
			$this->Session->setFlash(__('Kontaktdaten sind vollständig'));
		}
	}

	function checkRegister($data) {
		if (empty($data['Impressum']['reg_name'])) {
			$this->complete = false;
			$this->Session->setFlash(__('Registername fehlt'));
			if (empty($data['Impressum']['reg_street'])) {
				$this->complete = false;
				$this->Session->setFlash(__('Straße des Registers fehlt'));
			} else {
				if (empty($data['Impressum']['reg_house_no'])) {
					$this->complete = false;
					$this->Session->setFlash(__('Hausnummer des Registers fehlt'));
				} else {
					if (empty($data['Impressum']['reg_post_code'])) {
						$this->complete = false;
						$this->Session->setFlash(__('Postleitzahl des Registers fehlt'));
					} else {
						if (empty($data['Impressum']['reg_city'])) {
							$this->complete = false;
							$this->Session->setFlash(__('Ort des Registers fehlt'));
						} else {
							if (empty($data['Impressum']['reg_country'])) {
								$this->complete = false;
								$this->Session->setFlash(__('Land des Registers fehlt'));
							} else {
								if (empty($data['Impressum']['reg_no'])) {
									$this->complete = false;
									$this->Session->setFlash(__('Registernummer fehlt'));
								} else {
									$this->complete = true;
									$this->Session->setFlash(__('Registerdaten sind vollständig'));
								}
							}
						}
					}
				}
			}
		}
	}

	function checkLegalData($data) {
		if (empty($data['Impressum']['vat_no'])) {
			$this->complete = false;
			$this->Session->setFlash(__('Umsatzsteuer-ID fehlt'));
		} else {
			$this->complete = true;
			$this->Session->setFlash(__('Umsatzsteuer-ID ist eingetragen'));
		}
	}
}