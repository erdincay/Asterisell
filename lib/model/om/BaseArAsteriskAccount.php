<?php


abstract class BaseArAsteriskAccount extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $account_code;


	
	protected $ar_office_id;


	
	protected $is_active = true;


	
	protected $ar_rate_category_id;

	
	protected $aArOffice;

	
	protected $aArRateCategory;

	
	protected $collCdrs;

	
	protected $lastCdrCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getAccountCode()
	{

		return $this->account_code;
	}

	
	public function getArOfficeId()
	{

		return $this->ar_office_id;
	}

	
	public function getIsActive()
	{

		return $this->is_active;
	}

	
	public function getArRateCategoryId()
	{

		return $this->ar_rate_category_id;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ArAsteriskAccountPeer::ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ArAsteriskAccountPeer::NAME;
		}

	} 
	
	public function setAccountCode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->account_code !== $v) {
			$this->account_code = $v;
			$this->modifiedColumns[] = ArAsteriskAccountPeer::ACCOUNT_CODE;
		}

	} 
	
	public function setArOfficeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ar_office_id !== $v) {
			$this->ar_office_id = $v;
			$this->modifiedColumns[] = ArAsteriskAccountPeer::AR_OFFICE_ID;
		}

		if ($this->aArOffice !== null && $this->aArOffice->getId() !== $v) {
			$this->aArOffice = null;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v || $v === true) {
			$this->is_active = $v;
			$this->modifiedColumns[] = ArAsteriskAccountPeer::IS_ACTIVE;
		}

	} 
	
	public function setArRateCategoryId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ar_rate_category_id !== $v) {
			$this->ar_rate_category_id = $v;
			$this->modifiedColumns[] = ArAsteriskAccountPeer::AR_RATE_CATEGORY_ID;
		}

		if ($this->aArRateCategory !== null && $this->aArRateCategory->getId() !== $v) {
			$this->aArRateCategory = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->account_code = $rs->getString($startcol + 2);

			$this->ar_office_id = $rs->getInt($startcol + 3);

			$this->is_active = $rs->getBoolean($startcol + 4);

			$this->ar_rate_category_id = $rs->getInt($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ArAsteriskAccount object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ArAsteriskAccountPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ArAsteriskAccountPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ArAsteriskAccountPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aArOffice !== null) {
				if ($this->aArOffice->isModified()) {
					$affectedRows += $this->aArOffice->save($con);
				}
				$this->setArOffice($this->aArOffice);
			}

			if ($this->aArRateCategory !== null) {
				if ($this->aArRateCategory->isModified()) {
					$affectedRows += $this->aArRateCategory->save($con);
				}
				$this->setArRateCategory($this->aArRateCategory);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ArAsteriskAccountPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ArAsteriskAccountPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collCdrs !== null) {
				foreach($this->collCdrs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aArOffice !== null) {
				if (!$this->aArOffice->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aArOffice->getValidationFailures());
				}
			}

			if ($this->aArRateCategory !== null) {
				if (!$this->aArRateCategory->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aArRateCategory->getValidationFailures());
				}
			}


			if (($retval = ArAsteriskAccountPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCdrs !== null) {
					foreach($this->collCdrs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ArAsteriskAccountPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getAccountCode();
				break;
			case 3:
				return $this->getArOfficeId();
				break;
			case 4:
				return $this->getIsActive();
				break;
			case 5:
				return $this->getArRateCategoryId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ArAsteriskAccountPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getAccountCode(),
			$keys[3] => $this->getArOfficeId(),
			$keys[4] => $this->getIsActive(),
			$keys[5] => $this->getArRateCategoryId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ArAsteriskAccountPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setAccountCode($value);
				break;
			case 3:
				$this->setArOfficeId($value);
				break;
			case 4:
				$this->setIsActive($value);
				break;
			case 5:
				$this->setArRateCategoryId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ArAsteriskAccountPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAccountCode($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setArOfficeId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsActive($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setArRateCategoryId($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ArAsteriskAccountPeer::DATABASE_NAME);

		if ($this->isColumnModified(ArAsteriskAccountPeer::ID)) $criteria->add(ArAsteriskAccountPeer::ID, $this->id);
		if ($this->isColumnModified(ArAsteriskAccountPeer::NAME)) $criteria->add(ArAsteriskAccountPeer::NAME, $this->name);
		if ($this->isColumnModified(ArAsteriskAccountPeer::ACCOUNT_CODE)) $criteria->add(ArAsteriskAccountPeer::ACCOUNT_CODE, $this->account_code);
		if ($this->isColumnModified(ArAsteriskAccountPeer::AR_OFFICE_ID)) $criteria->add(ArAsteriskAccountPeer::AR_OFFICE_ID, $this->ar_office_id);
		if ($this->isColumnModified(ArAsteriskAccountPeer::IS_ACTIVE)) $criteria->add(ArAsteriskAccountPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(ArAsteriskAccountPeer::AR_RATE_CATEGORY_ID)) $criteria->add(ArAsteriskAccountPeer::AR_RATE_CATEGORY_ID, $this->ar_rate_category_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ArAsteriskAccountPeer::DATABASE_NAME);

		$criteria->add(ArAsteriskAccountPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);

		$copyObj->setAccountCode($this->account_code);

		$copyObj->setArOfficeId($this->ar_office_id);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setArRateCategoryId($this->ar_rate_category_id);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getCdrs() as $relObj) {
				$copyObj->addCdr($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ArAsteriskAccountPeer();
		}
		return self::$peer;
	}

	
	public function setArOffice($v)
	{


		if ($v === null) {
			$this->setArOfficeId(NULL);
		} else {
			$this->setArOfficeId($v->getId());
		}


		$this->aArOffice = $v;
	}


	
	public function getArOffice($con = null)
	{
		if ($this->aArOffice === null && ($this->ar_office_id !== null)) {
						include_once 'lib/model/om/BaseArOfficePeer.php';

			$this->aArOffice = ArOfficePeer::retrieveByPK($this->ar_office_id, $con);

			
		}
		return $this->aArOffice;
	}

	
	public function setArRateCategory($v)
	{


		if ($v === null) {
			$this->setArRateCategoryId(NULL);
		} else {
			$this->setArRateCategoryId($v->getId());
		}


		$this->aArRateCategory = $v;
	}


	
	public function getArRateCategory($con = null)
	{
		if ($this->aArRateCategory === null && ($this->ar_rate_category_id !== null)) {
						include_once 'lib/model/om/BaseArRateCategoryPeer.php';

			$this->aArRateCategory = ArRateCategoryPeer::retrieveByPK($this->ar_rate_category_id, $con);

			
		}
		return $this->aArRateCategory;
	}

	
	public function initCdrs()
	{
		if ($this->collCdrs === null) {
			$this->collCdrs = array();
		}
	}

	
	public function getCdrs($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCdrPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCdrs === null) {
			if ($this->isNew()) {
			   $this->collCdrs = array();
			} else {

				$criteria->add(CdrPeer::AR_ASTERISK_ACCOUNT_ID, $this->getId());

				CdrPeer::addSelectColumns($criteria);
				$this->collCdrs = CdrPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CdrPeer::AR_ASTERISK_ACCOUNT_ID, $this->getId());

				CdrPeer::addSelectColumns($criteria);
				if (!isset($this->lastCdrCriteria) || !$this->lastCdrCriteria->equals($criteria)) {
					$this->collCdrs = CdrPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCdrCriteria = $criteria;
		return $this->collCdrs;
	}

	
	public function countCdrs($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseCdrPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CdrPeer::AR_ASTERISK_ACCOUNT_ID, $this->getId());

		return CdrPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCdr(Cdr $l)
	{
		$this->collCdrs[] = $l;
		$l->setArAsteriskAccount($this);
	}


	
	public function getCdrsJoinArTelephonePrefix($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCdrPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCdrs === null) {
			if ($this->isNew()) {
				$this->collCdrs = array();
			} else {

				$criteria->add(CdrPeer::AR_ASTERISK_ACCOUNT_ID, $this->getId());

				$this->collCdrs = CdrPeer::doSelectJoinArTelephonePrefix($criteria, $con);
			}
		} else {
									
			$criteria->add(CdrPeer::AR_ASTERISK_ACCOUNT_ID, $this->getId());

			if (!isset($this->lastCdrCriteria) || !$this->lastCdrCriteria->equals($criteria)) {
				$this->collCdrs = CdrPeer::doSelectJoinArTelephonePrefix($criteria, $con);
			}
		}
		$this->lastCdrCriteria = $criteria;

		return $this->collCdrs;
	}


	
	public function getCdrsJoinArRateRelatedByIncomeArRateId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCdrPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCdrs === null) {
			if ($this->isNew()) {
				$this->collCdrs = array();
			} else {

				$criteria->add(CdrPeer::AR_ASTERISK_ACCOUNT_ID, $this->getId());

				$this->collCdrs = CdrPeer::doSelectJoinArRateRelatedByIncomeArRateId($criteria, $con);
			}
		} else {
									
			$criteria->add(CdrPeer::AR_ASTERISK_ACCOUNT_ID, $this->getId());

			if (!isset($this->lastCdrCriteria) || !$this->lastCdrCriteria->equals($criteria)) {
				$this->collCdrs = CdrPeer::doSelectJoinArRateRelatedByIncomeArRateId($criteria, $con);
			}
		}
		$this->lastCdrCriteria = $criteria;

		return $this->collCdrs;
	}


	
	public function getCdrsJoinArRateRelatedByCostArRateId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCdrPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCdrs === null) {
			if ($this->isNew()) {
				$this->collCdrs = array();
			} else {

				$criteria->add(CdrPeer::AR_ASTERISK_ACCOUNT_ID, $this->getId());

				$this->collCdrs = CdrPeer::doSelectJoinArRateRelatedByCostArRateId($criteria, $con);
			}
		} else {
									
			$criteria->add(CdrPeer::AR_ASTERISK_ACCOUNT_ID, $this->getId());

			if (!isset($this->lastCdrCriteria) || !$this->lastCdrCriteria->equals($criteria)) {
				$this->collCdrs = CdrPeer::doSelectJoinArRateRelatedByCostArRateId($criteria, $con);
			}
		}
		$this->lastCdrCriteria = $criteria;

		return $this->collCdrs;
	}

} 