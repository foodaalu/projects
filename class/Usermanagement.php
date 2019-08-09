<?php 

	class Usermanagement extends Database
	{
        public function __construct()
        {
            parent::__construct();
            $this->table('usermanagement');
        }


        public function addUser($data)
        {
            return $this->insert($data);
        }

    }

 ?>