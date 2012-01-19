<?php
class ShowController extends AppController {

	public $helpers = array('Html', 'Form');
	public $uses = array('Impressum.Impressum');
	private $complete = false; //this variable says whether the impressum has already been completed

	//authorization check
	function beforeFilter()	{
		//Actions which don't require authorization
		parent::beforeFilter();
		//TODO change to save
		$this->Auth->allow('*');
	}

	/**
	 * The following methods may be helpful for other controllers
	 */

	/**
	 * This method checks whether all necessary data was entered.
	 * @return boolean complete
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
	 * Please call this method when the google plus plugin is added or removed.
	 * @param add = true, remove = false
	 */
	function setGooglePlus($googlePlus) {
		$data = array('id' => 1, 'google_plus' => $googlePlus);
		$this->Impressum->save($data);
	}
	
	/**
	 * Please call this method when the xing plugin is added or removed.
	 * @param add = true, remove = false
	 */
	function setXing($xing) {
		$data = array('id' => 1, 'xing' => $xing);
		$this->Impressum->save($data);
	}
	
	/**
	 * Please call this method when the linkedin plugin is added or removed.
	 * @param add = true, remove = false
	 */
	function setLinkedin($linkedin) {
		$data = array('id' => 1, 'linkedin' => $linkedin);
		$this->Impressum->save($data);
	}
	
	/**
	 * methods for picture management
	 * origins of pictures not owned by the user must be written in impressum
	 * these functions are not implemented yet
	 */

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
	 * This method is called when the form on the first screen is submitted.
	 * select type (priv, comp, club, job)
	 */
	function admin() {
		$this->layout = 'overlay';
		$this->set('input',$this->Impressum->find('first'));
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->Impressum->id = 1;					
			switch ($data['Impressum']['type']) {
				case 'comp':
					$data['Impressum']['first_name'] = null;
					$data['Impressum']['last_name'] = null;
					$data['Impressum']['job_title'] = null;
					$data['Impressum']['regulations_name'] = null;
					$data['Impressum']['regulations_link'] = null;	
									
					if($this->Impressum->save($data)) {
						$this->render('compData');
						break;
					}
				case 'club':
					$data['Impressum']['first_name'] = null;
					$data['Impressum']['last_name'] = null;
					$data['Impressum']['job_title'] = null;
					$data['Impressum']['regulations_name'] = null;
					$data['Impressum']['regulations_link'] = null;	
									
					if($this->Impressum->save($data)) {
						$this->render('clubData');
						break;
					}
				case 'job':
					$data['Impressum']['comp_name'] = null;
					$data['Impressum']['legal_form'] = null;
					$data['Impressum']['auth_rep_first_name'] = null;
					$data['Impressum']['auth_rep_last_name'] = null;
					
					if($this->Impressum->save($data)) {
						$this->render('privJobData');
						break;
					}
				default:
					$data['Impressum']['comp_name'] = null;
					$data['Impressum']['legal_form'] = null;
					$data['Impressum']['auth_rep_first_name'] = null;
					$data['Impressum']['auth_rep_last_name'] = null;
					$data['Impressum']['reg'] = false;
					$data['Impressum']['reg_name'] = null;
					$data['Impressum']['reg_street'] = null;
					$data['Impressum']['reg_house_no'] = null;
					$data['Impressum']['reg_post_code'] = null;
					$data['Impressum']['reg_city'] = null;
					$data['Impressum']['reg_country'] = null;
					$data['Impressum']['reg_no'] = null;
					$data['Impressum']['adm_office'] = false;					
					$data['Impressum']['adm_office_name'] = null;
					$data['Impressum']['adm_office_street'] = null;
					$data['Impressum']['adm_office_house_no'] = null;
					$data['Impressum']['adm_office_post_code'] = null;
					$data['Impressum']['adm_office_city'] = null;
					$data['Impressum']['adm_office_country'] = null;
					$data['Impressum']['job_title'] = null;
					$data['Impressum']['regulations_name'] = null;
					$data['Impressum']['regulations_link'] = null;
					$data['Impressum']['vat_no'] = null;
					$data['Impressum']['eco_no'] = null;
										
					if($this->Impressum->save($data)) {
						$this->render('privJobData');
						break;
					}
			}
		}
	}

	/**
	 * The following methods are called when the different forms are submitted.
	 */

	/**
	 * type = private person
	 */

	/**
	 * this function saves all data that was entered on the general screen of types 'priv' and 'job'
	 * name and address
	 */
	function privJobData() {
		$this->layout = 'overlay';
		$this->set('input',$this->Impressum->find('first'));
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->checkPrivData($data);
			if ($this->complete) {
				$this->checkAddress($data);
				if ($this->complete) {
					$this->Impressum->id = 1;
					if ($this->Impressum->save($data)) {
						$this->render('privJobContact');
					}
				}
			}
		}
	}

	/**
	 * this function saves all data that was entered on the contact screen of types 'priv' and 'job'
	 * email, phone, fax
	 */
	function privJobContact() {
		$this->layout = 'overlay';
		$this->set('input',$this->Impressum->find('first'));
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->checkContactData($data);
			if ($this->complete) {
				$this->Impressum->id = 1;
				if ($this->Impressum->save($data)) {
					if ($data['Impressum']['type'] == 'job') { //private person is now finished
						$this->render('jobData');
					} else {
						$this->render('close');
					}
				}
			}
		}
	}

	/**
	 * type = company
	 */

	/**
	 * this function saves all data that was entered on the general screen of type 'comp'
	 * company name, legal form and address
	 */
	function compData() {
		$this->layout = 'overlay';
		$this->set('input',$this->Impressum->find('first'));
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->checkCompData($data);
			if ($this->complete) {
				$this->checkAddress($data);
				if ($this->complete) {
					$this->Impressum->id = 1;
					if($this->Impressum->save($data)) {
						$this->render('compContact');
					}
				}
			}
		}
	}

	/**
	 * this function saves all data that was entered on the contact screen of type 'comp'
	 * email, phone and fax
	 */
	function compContact() {
		$this->layout = 'overlay';
		$this->set('input',$this->Impressum->find('first'));
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->checkContactData($data);
			if ($this->complete) {
				$this->checkAuthRepData($data);
				if($this->complete) {
					$this->Impressum->id = 1;
					if ($this->Impressum->save($data)) {
						$this->render('compLegal');
					}
				}
			}
		}
	}

	/**
	 * this function saves all data that was entered on the legal screen of type 'comp'
	 * vat no and eco no
	 */
	function compLegal() {
		$this->layout = 'overlay';
		$this->set('input',$this->Impressum->find('first'));
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->checkLegalData($data);
			if ($this->complete) {
				$this->Impressum->id = 1;
				if($this->Impressum->save($data)) {
					$this->render('compReg');
				}
			}
		}
	}

	/**
	 * this function saves all data that was entered on the register screen of type 'comp'
	 */
	function compReg() {
		$this->layout = 'overlay';
		$this->set('input',$this->Impressum->find('first'));
		if ($this->request->is('post')) {
			$data = $this->request->data;
			if ($data['Impressum']['reg']) {
				$this->checkRegister($data);
				if ($this->complete) {
					$this->Impressum->id = 1;
					if($this->Impressum->save($data)) {
						$this->render('admOffice');
					}
				}
			} else {
				$this->Impressum->id = 1;
				$data['Impressum']['reg_name'] = null;
				$data['Impressum']['reg_street'] = null;
				$data['Impressum']['reg_house_no'] = null;
				$data['Impressum']['reg_post_code'] = null;
				$data['Impressum']['reg_city'] = null;
				$data['Impressum']['reg_country'] = null;
				$data['Impressum']['reg_no'] = null;
				if($this->Impressum->save($data)) {
					$this->render('admOffice');
				}
			}
		}
	}

	/**
	 * this function saves all data that was entered on the admission office screen of type 'comp'
	 */
	function admOffice() {
		$this->layout = 'overlay';
		$this->set('input',$this->Impressum->find('first'));
		if ($this->request->is('post')) {
			$data = $this->request->data;
			if ($data['Impressum']['adm_office']) {
				$this->checkAdmOffice($data);
				if ($this->complete) {
					$this->Impressum->id = 1;
					if($this->Impressum->save($data)) {
						$this->render('close');
					}
				}
			} else {
				$this->Impressum->id = 1;
				$data['Impressum']['adm_office_name'] = null;
				$data['Impressum']['adm_office_street'] = null;
				$data['Impressum']['adm_office_house_no'] = null;
				$data['Impressum']['adm_office_post_code'] = null;
				$data['Impressum']['adm_office_city'] = null;
				$data['Impressum']['adm_office_country'] = null;
				if($this->Impressum->save($data)) {
					$this->render('close');
				}
			}
		}
	}
	/**
	 * type = club
	 */

	/**
	 * this function saves all data that was entered on the general screen of type 'club'
	 * club name and club address
	 */
	function clubData() {
		$this->layout = 'overlay';
		$this->set('input',$this->Impressum->find('first'));
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$data['Impressum']['legal_form'] = __('e.V.'); //every club must have legal form e.V.
			$this->checkClubData($data);
			if ($this->complete) {
				$this->checkAddress($data);
				if ($this->complete) {
					$data['Impressum']['reg'] = true; //every club must be registered
					$this->Impressum->id = 1;
					if($this->Impressum->save($data)) {
						$this->render('clubContact');
					}
				}
			}
		}
	}

	/**
	 * this function saves all data that was entered on the contact screen of type 'club'
	 * email, phone and fax
	 */
	function clubContact () {
		$this->layout = 'overlay';
		$this->set('input',$this->Impressum->find('first'));
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->checkContactData($data);
			if ($this->complete) {
				$this->Impressum->id = 1;
				if($this->Impressum->save($data)) {
					$this->render('clubReg');
				}
			}
		}
	}

	/**
	 * this function saves all data that was entered on the register screen of type 'club'
	 * register's address and number
	 */
	function clubReg() {
		$this->layout = 'overlay';
		$this->set('input',$this->Impressum->find('first'));
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->checkRegister($data);
			if ($this->complete) {
				$this->Impressum->id = 1;
				if($this->Impressum->save($data)) {
					$this->render('close');
				}
			}
		}
	}

	/**
	 * type = job
	 */

	/**
	 * This function saves all data that was entered on the job screen
	 * job title, administration office, regulations
	 */

	function jobData() {
		$this->layout = 'overlay';
		$this->set('input',$this->Impressum->find('first'));
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->checkJobData($data);
			if ($this->complete) {
				$this->Impressum->id = 1;
				if($this->Impressum->save($data)) {
					$this->render('close');
				}
			}
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
						}
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
								$this->Session->setFlash(__('Jeder Verein muss ins Register eingetragen werden.'), 'default', array('class' => 'flash_failure'));
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

	/**
	 * checks if first and last names are set
	 * @param $data
	 */
	function checkPrivData($data) {
		if (empty($data['Impressum']['first_name'])) {
			$this->complete = false;
			$this->Session->setFlash(__('Vorname fehlt'), 'default', array('class' => 'flash_failure'));
		} else {
			if (empty($data['Impressum']['last_name'])) {
				$this->complete = false;
				$this->Session->setFlash(__('Name fehlt'), 'default', array('class' => 'flash_failure'));
			} else {
				$this->complete = true;
			}
		}
	}

	/**
	 * checks if company name and legal form are set
	 * @param $data
	 */
	function checkCompData($data) {
		if (empty($data['Impressum']['comp_name'])) {
			$this->complete = false;
			$this->Session->setFlash(__('Firma fehlt'), 'default', array('class' => 'flash_failure'));
		} else {
			if (empty($data['Impressum']['legal_form'])) {
				$this->complete = false;
				$this->Session->setFlash(__('Rechtsform fehlt'), 'default', array('class' => 'flash_failure'));
			} else {
				$this->complete = true;
			}
		}
	}

	/**
	 * checks if club name and legal form are set
	 * @param $data
	 */
	function checkClubData($data) {
		if (empty($data['Impressum']['comp_name'])) {
			$this->complete = false;
			$this->Session->setFlash(__('Vereinsbezeichnung fehlt'), 'default', array('class' => 'flash_failure'));
		} else {
			if (empty($data['Impressum']['legal_form'])) {
				$this->complete = false;
				$this->Session->setFlash(__('Rechtsform fehlt'), 'default', array('class' => 'flash_failure'));
			} else {
				$this->complete = true;
			}
		}
	}

	/**
	 * checks if all necessary job regulations are set
	 * @param $data
	 */
	function checkJobData($data) {
		if (!$data['Impressum']['adm']) {
			$this->complete = false;
			$this->Session->setFlash(__('Für geschützte Berufsbezeichnungen muss eine Aufsichtsbehörde angegeben werden.'), 'default', array('class' => 'flash_failure'));
		} else {
			if (empty($data['Impressum']['job_title'])) {
				$this->complete = false;
				$this->Session->setFlash(__('Berufsbezeichnung fehlt'), 'default', array('class' => 'flash_failure'));
			} else {
				if (empty($data['Impressum']['regulations_name'])) {
					$this->complete = false;
					$this->Session->setFlash(__('Berufsrechtliche Regelungen fehlen'), 'default', array('class' => 'flash_failure'));
				} else {
					if (empty($data['Impressum']['regulations_link'])) {
						$this->complete = false;
						$this->Session->setFlash(__('Link zu berufsrechtlichen Regelungen fehlt'), 'default', array('class' => 'flash_failure'));
					} else {
						$this->checkAdmOffice($data);
						if ($this->complete) {
							$this->complete = true;
						}
					}
				}
			}
		}
	}

	/**
	 * checks if street, house no, post code, city and country are set
	 * @param $data
	 */
	function checkAddress($data) {
		if (empty($data['Impressum']['street'])) {
			$this->complete = false;
			$this->Session->setFlash(__('Straße fehlt'), 'default', array('class' => 'flash_failure'));
		} else {
			if (empty($data['Impressum']['house_no'])) {
				$this->complete = false;
				$this->Session->setFlash(__('Hausnummer fehlt'), 'default', array('class' => 'flash_failure'));
			} else {
				if (empty($data['Impressum']['post_code'])) {
					$this->complete = false;
					$this->Session->setFlash(__('Postleitzahl fehlt'), 'default', array('class' => 'flash_failure'));
				} else {
					if (empty($data['Impressum']['city'])) {
						$this->complete = false;
						$this->Session->setFlash(__('Ort fehlt'), 'default', array('class' => 'flash_failure'));
					} else {
						if (empty($data['Impressum']['country'])) {
							$this->complete = false;
							$this->Session->setFlash(__('Land fehlt'), 'default', array('class' => 'flash_failure'));
						} else {
							$this->complete = true;
						}
					}
				}
			}
		}
	}

	/**
	 * checks if at least one contact form is set
	 * @param $data
	 */
	function checkContactData($data) {
		if (empty($data['Impressum']['phone_no']) and empty($data['Impressum']['fax_no']) and empty($data['Impressum']['email'])) {
			$this->complete = false;
			$this->Session->setFlash(__('Sie müssen mindestens eine Kontaktform pflegen (Telefon, Telefax oder E-Mail)'), 'default', array('class' => 'flash_failure'));
		} else {
			$this->complete = true;
		}
	}

	/**
	 * checks if all information on register office is set
	 * @param $data
	 */
	function checkRegister($data) {
		if (empty($data['Impressum']['reg_name'])) {
			$this->complete = false;
			$this->Session->setFlash(__('Registername fehlt'), 'default', array('class' => 'flash_failure'));
		} else {
			if (empty($data['Impressum']['reg_street'])) {
				$this->complete = false;
				$this->Session->setFlash(__('Straße des Registers fehlt'), 'default', array('class' => 'flash_failure'));
			} else {
				if (empty($data['Impressum']['reg_house_no'])) {
					$this->complete = false;
					$this->Session->setFlash(__('Hausnummer des Registers fehlt'), 'default', array('class' => 'flash_failure'));
				} else {
					if (empty($data['Impressum']['reg_post_code'])) {
						$this->complete = false;
						$this->Session->setFlash(__('Postleitzahl des Registers fehlt'), 'default', array('class' => 'flash_failure'));
					} else {
						if (empty($data['Impressum']['reg_city'])) {
							$this->complete = false;
							$this->Session->setFlash(__('Ort des Registers fehlt'), 'default', array('class' => 'flash_failure'));
						} else {
							if (empty($data['Impressum']['reg_country'])) {
								$this->complete = false;
								$this->Session->setFlash(__('Land des Registers fehlt'), 'default', array('class' => 'flash_failure'));
							} else {
								if (empty($data['Impressum']['reg_no'])) {
									$this->complete = false;
									$this->Session->setFlash(__('Registernummer fehlt'), 'default', array('class' => 'flash_failure'));
								} else {
									$this->complete = true;
								}
							}
						}
					}
				}
			}
		}
	}

	/**
	 * checks if all data concerning admission office is set
	 * @param $data
	 */
	function checkAdmOffice($data) {
		if (empty($data['Impressum']['adm_office_name'])) {
			$this->complete = false;
			$this->Session->setFlash(__('Name der Aufsichtsbehörde fehlt'), 'default', array('class' => 'flash_failure'));
		} else {
			if (empty($data['Impressum']['adm_office_street'])) {
				$this->complete = false;
				$this->Session->setFlash(__('Straße der Aufsichtsbehörde fehlt'), 'default', array('class' => 'flash_failure'));
			} else {
				if (empty($data['Impressum']['adm_office_house_no'])) {
					$this->complete = false;
					$this->Session->setFlash(__('Hausnummer der Aufsichtsbehörde fehlt'), 'default', array('class' => 'flash_failure'));
				} else {
					if (empty($data['Impressum']['adm_office_post_code'])) {
						$this->complete = false;
						$this->Session->setFlash(__('Postleitzahl der Aufsichtsbehörde fehlt'), 'default', array('class' => 'flash_failure'));
					} else {
						if (empty($data['Impressum']['adm_office_city'])) {
							$this->complete = false;
							$this->Session->setFlash(__('Ort der Aufsichtsbehörde fehlt'), 'default', array('class' => 'flash_failure'));
						} else {
							if (empty($data['Impressum']['adm_office_country'])) {
								$this->complete = false;
								$this->Session->setFlash(__('Land der Aufsichtsbehörde fehlt'), 'default', array('class' => 'flash_failure'));
							} else {
								$this->complete = true;
							}
						}
					}
				}
			}
		}
	}

	/**
	 * checks if vat no is set
	 * @param $data
	 */
	function checkLegalData($data) {
		if (empty($data['Impressum']['vat_no'])) {
			$this->complete = false;
			$this->Session->setFlash(__('Umsatzsteuer-ID fehlt'), 'default', array('class' => 'flash_failure'));
		} else {
			$this->complete = true;
		}
	}

	/**
	 * checks if authorised representative is set
	 * @param $data
	 */
	function checkAuthRepData($data) {
		if (empty($data['Impressum']['auth_rep_first_name'])) {
			$this->complete = false;
			$this->Session->setFlash(__('Vorname der vertretungsberechtigten Person fehlt'), 'default', array('class' => 'flash_failure'));
		} else {
			if (empty($data['Impressum']['auth_rep_last_name'])) {
				$this->complete = false;
				$this->Session->setFlash(__('Name der vertretungsbrechtigten Person fehlt'), 'default', array('class' => 'flash_failure'));
			} else {
				$this->complete = true;
			}
		}
	}
}