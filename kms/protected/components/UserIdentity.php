<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {


        $user = User::model()->findByAttributes(array('UserName' => $this->username));

        //check that the user with the specified username exist
        if ($user === NULL) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else {

            //password matching
            if ($user->Password != md5($this->password)) {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            } else {
                // put code for successful log
                $this->_id = $user->UserID;
                $this->errorCode = self::ERROR_NONE;
            }
        }
        return !$this->errorCode;
    }

    public function authenticateLogin() {


        $user = User::model()->findByAttributes(array('UserName' => $this->username));

        //check that the user with the specified username exist
        if ($user === NULL) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else {

            //password matching
            if ($user->Password != User::generatePassoword($this->password)) {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            } else {
                //check that the user hasn't been locked
                if ($user->Status == 0) {
                    $this->errorCode = 3;
                } elseif ($user->IsLoggedIn == 1) {
                    $this->errorCode = 4;
                } else {
                    // put code for successful log
                $this->_id = $user->UserID;
                $this->errorCode = self::ERROR_NONE;
                }
                
            }
        }
        
        return $this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }

}
