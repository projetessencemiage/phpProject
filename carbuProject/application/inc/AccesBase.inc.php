<?php
/**
 * ------------------------------------------------------------------------
 * AccesBase.inc.php
 * Gestion des acces a la BDD
 * ------------------------------------------------------------------------
 **/

//---------------------------------------------------------------------------
// Classe AccesBase
//---------------------------------------------------------------------------
class AccesBase {
	static function openRecordSet($sql) {
		$tableau = array();

		$dbh = AccesBase::dbPDO_Connect_mySQL(USER, PASSE, BASE, HOST);

		if (!is_object($dbh)) {
			echo 'erreur '.E_USER_ERROR;
			throw new MyException('Erreur connexion : '.$e->getCode().'<br />'.$e->getMessage());
		}
			
		try {
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
			if ($stmt->errorCode()<>'00000') {
				throw new MyException($stmt->errorCode());
				die;
			}
			$i=0;
			while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
				$tableau[$i] = $row;
				$i ++;
			}
			$stmt = null;
			$dbh = null;
			return $tableau;
		} catch (PDOException $e) {
			throw new MyException('openRecordSet : '.$sql.' ('.BASE.'/'.HOST.'/'.USER.'/'.PASSE.')');
			exit();
		} catch (MyException $e) {
			throw new MyException('Erreur sql : '.$sql);
			exit();
		} catch (Exception $e) {
			throw new MyException('Erreur sql : '.$sql);
			exit();
		}
	}


	static function openRecordSetAndValue($sql,$action) {
		$tableau = array();
		$resReq = array();
		$dbh = AccesBase::dbPDO_Connect_mySQL(USER, PASSE, BASE, HOST);

		if (!is_object($dbh)) {
			echo 'erreur '.E_USER_ERROR;
			throw new MyException('Erreur connexion : '.$e->getCode().'<br />'.$e->getMessage());
		}
			
		try {
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
			if ($stmt->errorCode()<>'00000') {
				throw new MyException($stmt->errorCode());
				die;
			}
			$i=0;
			while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
				$tableau[$i] = $row;
				$i ++;
			}
			$stmt = null;
			$resReq[0] = $tableau;
		} catch (PDOException $e) {
			throw new MyException('openRecordSet : '.$sql.' ('.BASE.'/'.HOST.'/'.USER.'/'.PASSE.')');
			exit();
		} catch (MyException $e) {
			throw new MyException('Erreur sql : '.$sql);
			exit();
		} catch (Exception $e) {
			throw new MyException('Erreur sql : '.$sql);
			exit();
		}

		$resReq[1] = AccesBase::recupNombreAnnexe($action,$dbh);
		return $resReq;
	}


	static function recupNombreAnnexe($action,$dbh){

		try {
			$stmt = $dbh->prepare($action);
			$stmt->execute();
			if ($stmt->errorCode()<>'00000') {
				throw new MyException($stmt->errorCode());
				die;
			}
			$i=0;
			while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
				$tableau[$i] = $row;
				$i ++;
			}
			$stmt = null;
			$dbh = null;
			return $tableau[0][0];
		} catch (PDOException $e) {
			throw new MyException('openRecordSet : '.$sql.' ('.BASE.'/'.HOST.'/'.USER.'/'.PASSE.')');
			exit();
		} catch (MyException $e) {
			throw new MyException('Erreur sql : '.$sql);
			exit();
		} catch (Exception $e) {
			throw new MyException('Erreur sql : '.$sql);
			exit();
		}
	}

	static function execute($sql) {


		$dbh = AccesBase::dbPDO_Connect_mySQL(USER, PASSE, BASE, HOST);
			
		try {
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
			if ($stmt->errorCode()<>'00000') {
				throw new MyException($stmt->errorCode());
				die;
			}
			$stmt = null;
			$dbh = null;
			return true;
		} catch (PDOException $e) {
			throw new MyException('execute : '.$sql);
			exit();
		} catch (MyException $e) {
			throw new MyException('Erreur sql : '.$sql);
			exit();
		} catch (Exception $e) {
			throw new MyException('Erreur sql : '.$sql);
			exit();
		}
	}

	//pppppppppppppppppppppppppppppppppppppppppppppppppppppppppppp
	//
	//  Creates a new mySQL database connection
	//
	//  Returns a PDO object or an error message
	//  Use: is_object()  to verify the result
	//
	//
	//  If $DBHost starts with a '/' then it is treated as a Socket
	//
	//  if $DBHost is empty it will default to LOCALHOST which is NOT the
	//  same as 127.0.0.1
	//
	//  $DBPort is optional and will use the standard mySQL default if not
	//  specified
	//
	//  The database name ($DBName) is optional, but if it is specified
	//  it must exist or an error results
	//
	//  2009-03-11  Created: by codeslinger at compsalot.com
	//
	//          Released to the Public Domain free to use and modify
	//
	//
	private function dbPDO_Connect_mySQL($DBUser, $DBPass, $DBName = false, $DBHost = false, $DBPort = false) {
		$DBNameEq = empty($DBName) ? '' : ";dbname=$DBName";
		if (empty($DBHost)) {
			$DBHost = 'localhost';
		}
		If ($DBHost[0] === '/') {
			$Connection = "unix_socket=$DBHost";
		} else {
			if (empty($DBPort)) $DBPort = 3306;
			$Connection = "host=$DBHost;port=$DBPort";
		}
			
		try {
			$dbh     = new PDO("mysql:".$Connection.$DBNameEq,  $DBUser, $DBPass);
		} catch (PDOException $e) {
			echo '$Connection='.$Connection.', $DBNameEq='.$DBNameEq.', $DBUser='.$DBUser.', $DBPass='.$DBPass.'<br />';
			echo 'erreur '.$e->getCode().' '.$e->getMessage().'<br />';
			return $e->getMessage();
		}
		return $dbh;
	}
}
?>
