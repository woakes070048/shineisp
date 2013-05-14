<?php

/**
 * Isp
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class Isp extends BaseIsp {
	
	/**
	 * Find all the ISP occurences
	 * 
	 */
	public static function findAll() {
		return Doctrine::getTable ( 'Isp' )->findAll ();
	}
	
	/**
	 * Get a ISP record resource
	 * 
	 * @param integer $id
	 * @return Doctrine_Record
	 */
	public static function find($id) {
		return Doctrine::getTable ( 'Isp' )->findOneBy ( 'isp_id', $id );
	}
	
	/**
	 * Get the list of the ISP Companies saved
	 * 
	 * @return ArrayObject
	 */
	public static function getList() {
		$items = array ();
		$arrTypes = Doctrine::getTable ( 'Isp' )->findAll ();
		foreach ( $arrTypes->getData () as $c ) {
			$items [$c ['isp_id']] = $c ['company'];
		}
		return $items;
	}
	
	/**
	 * Get ISP Company by ID
	 * 
	 * @return ArrayObject
	 */
	public static function getActiveIspById($id) {
		$isp = Doctrine_Query::create ()->from ( 'Isp u' )->where ( 'isp_id = ?', $id )->andWhere( 'active = ?', true )->execute (null, Doctrine::HYDRATE_ARRAY);

		return !empty($isp[0]) ? $isp[0] : array();
	}
	
	/**
	 * return the active ISP
	 * 
	 * @return array
	 */
	public static function getActiveISP() {
		$q = Doctrine_Query::create ()->from ( 'Isp u' )->where ( 'active=?', 1 );
		$isp = $q->execute (null, Doctrine::HYDRATE_ARRAY);
		return isset ( $isp [0] ) ? $isp [0] : array();
	}
	
	/**
	 * return the active ISP identifier
	 * 
	 * 
	 * @return integer or false
	 */
	public static function getActiveISPID() {
		$isp = Doctrine_Query::create ()->select('isp_id as id')->from ( 'Isp' )->where ( 'active = ?', 1 )->limit(1)->execute (null, Doctrine::HYDRATE_ARRAY);
		return isset ( $isp [0]['id'] ) ? $isp [0]['id'] : false;
	}
	
	/**
	 * return the logged ISP
	 * 
	 * @return array
	 */
	public static function getLogged() {
		$auth = Zend_Auth::getInstance()->getIdentity();
		
		if ( !is_array($auth) || empty($auth) || !isset($auth['isp_id']) || !intval($auth['isp_id']) > 0 ) {
			return false;
		}
		
		$isp_id = intval($auth['isp_id']);
		
		return self::getActiveIspById($isp_id);
	}	 
	
	/**
	 * return the logged ISP ID
	 * 
	 * @return integer isp_id
	 */
	public static function getLoggedId() {
		$isp = self::getLogged();
		return (is_array($isp) && isset($isp['isp_id'])) ? intval($isp['isp_id']) : 0;
	}	 
	
	 
	
	/**
	 * get the active ISP Control Panel module var
	 * 
	 * 
	 * @return string
	 */
	public static function getPanel() {
		$isp = Doctrine_Query::create ()->select('isppanel')
									  ->from ( 'Isp' )
									  ->where ( 'active = ?', 1 )
									  ->execute (null, Doctrine::HYDRATE_ARRAY);

		return isset ( $isp [0]['isppanel'] ) ? $isp [0]['isppanel'] : null;
	}
	
	/**
	 * Save all the ISP data
	 * 
	 * @return string
	 */
	public static function saveAll($data, $id=FALSE) {
		
		if(is_numeric($id)){
			$isp = self::find($id);
		}else{
			$isp = new Isp();	
		}
		
		$isp->company = !empty($data ['company']) ? $data ['company'] : NULL;
		$isp->vatnumber = !empty($data ['vatnumber']) ? $data ['vatnumber'] : NULL;
		$isp->address = !empty($data ['address']) ? $data ['address'] : NULL;
		$isp->zip = !empty($data ['zip']) ? $data ['zip'] : NULL;
		$isp->city = !empty($data ['city']) ? $data ['city'] : NULL;
		$isp->country = !empty($data ['country']) ?  $data ['country']: NULL;
		$isp->telephone = !empty($data ['telephone']) ? $data ['telephone'] : NULL;
		$isp->fax = !empty($data ['fax']) ? $data ['fax'] : NULL;
		$isp->slogan = !empty($data ['slogan']) ? $data ['slogan'] : NULL;
		$isp->manager = !empty($data ['manager']) ? $data ['manager'] : NULL;
		$isp->website = !empty($data ['website']) ? $data ['website'] : NULL;
		$isp->email = !empty($data ['email']) ? $data ['email'] : NULL;
		$isp->isppanel = !empty($data ['isppanel']) ? $data ['isppanel'] : NULL;
		$isp->bankname = !empty($data ['bankname']) ? $data ['bankname'] : NULL;
		$isp->iban = !empty($data ['iban']) ? $data ['iban'] : NULL;
		$isp->bic = !empty($data ['bic']) ? $data ['bic'] : NULL;
		
		if (! empty ( $data ['password'] )) {
			$isp->password = md5($data ['password']);
		}

		$isp->save ();
		$id = $isp['isp_id'];
		
		// Upload the logo
		self::UploadLogo($id);

		// Set the ISP panel
		if(!empty($data ['isppanel'])){
			Panels::setAsActive($data ['isppanel'], $isp ['isp_id']);
		}
		
		return $isp;
	}
	
	
	/**
     * UploadLogo
     * the extensions allowed are JPG, GIF, PNG
     */
    public static function UploadLogo($id){
    	try{
    		if(is_numeric($id)){
		    	$attachment = new Zend_File_Transfer_Adapter_Http();
		    	
				$files = $attachment->getFileInfo();
				
				if(!empty($files['logo']['name'])){
					// Create the directory
					@mkdir ( PUBLIC_PATH . "/documents/" );
					@mkdir ( PUBLIC_PATH . "/documents/isp/");
					
					// Set the destination directory
					$attachment->setDestination ( PUBLIC_PATH . "/documents/isp/" );
					
					if ($attachment->receive()) {
						$isp = self::find($id);
						$isp->logo =  $files['logo']['name'];
						$isp->save();
						return true;
					}	
				}
    		}
    		
    		return false;
    	}catch (Exception $e){
			throw new Exception($e->getMessage() . ": " . PUBLIC_PATH . "/documents/isp/");
    	}
    }	   

    /**
     * Get ISP by the MD5 email
     * @param string $email
     */
    public static function getIspbyMd5email($md5email){
    
    	// Check if the user exists!
    	$record = Doctrine_Query::create ()->from ( 'Isp i' )
									    	->where ( 'MD5(i.email) = ?', $md5email)
									    	->execute(array(), Doctrine::HYDRATE_ARRAY);
    
    	if($record){
    		return !empty($record[0]) ? $record[0] : FALSE;
    	}else{
    		return NULL;
    	}
    }
	
	/**
	 * Check if the ISP exist
	 * 
	 * 
	 * @param $email
	 * @param $password
	 * @return boolean
	 */
	public static function login($email, $password) {
		$q = Doctrine_Query::create ()->from ( 'Isp u' )->where ( 'email=? and password=? and active=?', array ($email, md5 ( $password ), true ) );
		return $q->execute ()->toArray ();
	}
	
}