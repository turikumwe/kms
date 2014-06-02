<?php

class MyDbHttpSession extends CDbHttpSession {

    public function setUserId($userId) {
        $db = $this->getDbConnection();
        $db->setActive(true);
        $db->createCommand()->update(
                $this->sessionTableName, array('userId' => $userId), // I asume you added a column 'userId' to your session table
                'id=:id', array(':id' => session_id())
        );
    }

}
