<?php
/* -------------------------------------connect to database-------------------------------------------------- */
    abstract class Database{
        protected $conn = null;
        protected $sql = null;
        protected $stmt = null;
        protected $table = null;
        public function __construct()
        {
            try {
                $this->conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';', DB_USER, DB_PASSWORD);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->sql = "SET NAMES utf8";
                $this->stmt = $this->conn->prepare($this->sql);
                $this->stmt->execute();
            } catch (PDOEXCEPTION  $th) {
                // PDO , connection (2019-06-04 09:34 PM); message
                $message = 'PDO Connection, '.date('Y-m-d h:i A').": " .$th->getMessage()."\r\n";
                error_log($message,3,ERROR_LOG); //message, 3 error log ma put gara constant k gharna error log bhanara , destination 
                return false;
            }catch(Exception $th){
                    // PDO , connection (2019-06-04 09:34 PM); message
                $message = 'PDO, general Connection, '.date('Y-m-d h:i A').": " .$th->getMessage()."\r\n";
                error_log($message,3,ERROR_LOG); //message, 3 error log ma put gara constant k gharna error log bhanara , destination
                return false;
            }
        }
/* ----------------------------------TABLE creating --------------------------------------------------------------- */
final protected function table($_table){
    $this->table = $_table;
}
/* ----------------------------------END TABLE creating --------------------------------------------------------------- */
/* -------------------------------Generating SQL Command SELECT --------------------------------------------------- */
final protected function select($args = array(), $is_debug= false){ // parameter of making array and sometime array will come otherwise it won't 
      /* 
         -SELECT id,name,email,password
        1.SELECT fields FROM table
        2.JOIN statement
        3.WHERE clause
        4.GROUP BY clause
        5.ORDER BY clause
        6.LIMIT start, count
      */ 
    try{
        $this->sql = "SELECT ";
        
        if(isset($args,$args['fields']) && !empty($args['fields'])){
           if(is_array($args['fields'])){
               $this->sql .= implode(", ", $args['fields']);  /// array conversion argument
           }else{
           $this->sql .= $args['fields'];   //string conversion  string 
           }
           
        }else{
            $this->sql .= " * ";
        }
        $this->sql .= " FROM ";
/*----------------------------------whether the  table is created or not----------------------------------------------*/
        if(!$this->table){
            throw new Exception("Table not set");
        }
        $this->sql .=$this->table;
/*----------------------------------whether the  table is created or not----------------------------------------------*/
/* --------------------------------------------------------------JOINT condition----------- -------------------- */

/* --------------------------------------------------------------JOINT condition----------- -------------------- */
/* ------------------------------------------WEHRE clause Creation------------------------------------------------------------*/
if(isset($args['where']) && !empty($args['where'])){
    //$this->sql .=  " WHERE ".$args['where']; 
    if(is_string($args['where'])){
      $this->sql .= " WHERE ".$args['where']; 
    }else{
      // array xa bhana we have to generator string  data
      $temp = array();
      foreach($args['where'] as $column_name => $value){
          $str = $column_name . " = :".$column_name;
          $temp[] = $str;
      }
      $this->sql .= " WHERE ".implode(' AND ' ,$temp);
    }
}
/* ------------------------------------------END WEHRE clause Creation------------------------------------------------------------*/
/* 
        GROUP BY 
        ORDER BY

*/
/* ---------------------------------------------ORDER BY --------------------------------------------------------- */
if(isset($args,$args['order_by']) && !empty($args['order_by'])){
    $this->sql .= " ORDER BY ".$args['order_by']; // append data 
}else{
    $this->sql .= " ORDER BY ".$this->table.".id DESC"; // deafault   
}
/* ---------------------------------------------End ORDER BY --------------------------------------------------------- */
/* ------------------------------------------------LIMIT ------------------------------------------------------ */
/* ------------------------------------------------End LIMIT ------------------------------------------------------ */
/* ---------------------------------------------query dubg --------------------------------------------------------- */
        if($is_debug){
            debug($args);
            debug($this->sql,true);
        }
/* ---------------------------------------------end of query dubg --------------------------------------------------------- */
/* ----------------------------------------process of PDO format--------------------------------------- --------------*/
        $this->stmt = $this->conn->prepare($this->sql);
        
/* ------------------------------------to bind the value of for each where loop ------------------------------------------------------------ */
if(isset($args['where']) && !empty($args['where']) && is_array($args['where'])){
    foreach($args['where'] as $column_name => $value) {
        if(is_integer($value)){
            $param = PDO::PARAM_INT;
        }elseif(is_bool($value)){
            $param = PDO::PARAM_BOOL;
        }else{
            $param = PDO::PARAM_STR;
        }
        if($param){
            $this->stmt->bindValue(":".$column_name,$value,$param); // parmenter : column name key , vlaue of its, $paramter
        }
    }
}
/* ------------------------------------to bind the value ------------------------------------------------------------ */
        $this->stmt->execute();
        $data = $this->stmt->fetchAll(PDO::FETCH_OBJ);
        return $data;
/* ----------------------------------------end of process of PDO format--------------------------------------- --------------*/
    }catch (PDOException  $th) {
        // PDO , connection (2019-06-04 09:34 PM); message
        $message = 'PDO Select, '.date('Y-m-d h:i A').": ".$this->sql." , " .$th->getMessage()."\r\n";
        error_log($message,3,ERROR_LOG); //message, 3 error log ma put gara constant k gharna error log bhanara , destination 
        return false;
    }catch(Exception $th){
            // PDO , connection (2019-06-04 09:34 PM); message
        $message = 'PDO, general Select , '.date('Y-m-d h:i A').": ".$this->sql." , ".$th->getMessage()."\r\n";
        error_log($message,3,ERROR_LOG); //message, 3 error log ma put gara constant k gharna error log bhanara , destination
        return false;
    }
}
/* -------------------------------END Generating SQL Command SELECT --------------------------------------------------- */
/* ------------------------------- Generating the Update query --------------------------------------------------- */
final protected function update($data = array(),$args = array(), $is_debug = false){
    try{
          /* 
          UPDATE table SET 
          column_name = value,
          column_name = value,
          ......
          WHERE clause
          
          
          */
          $this->sql = "UPDATE ";
  /*----------------------------------whether the  table is created or not----------------------------------------------*/
          if(!$this->table){
              throw new Exception("Table not set");
          }
          $this->sql .= $this->table . " SET ";

          
          if(isset($data) && !empty($data)){
              if(is_array($data)){
                  $temp = array();
                  foreach($data as $column_name => $value){
                      $str_data = $column_name. " = :_".$column_name;
                      $temp[] = $str_data;
                  }
                  $this->sql .= implode(', ', $temp);
              }else {
                  $this->sql .= $data;
              }
          }else{
              throw new Exception('Data not set for Update.');
          }
  /*----------------------------------whether the  table is created or not----------------------------------------------*/
  /* ------------------------------------------WEHRE clause Creation------------------------------------------------------------*/
  if(isset($args['where']) && !empty($args['where'])){
      //$this->sql .=  " WHERE ".$args['where']; 
      if(is_string($args['where'])){
        $this->sql .= "WHERE ".$args['where']; 
      }else{
        // array xa bhana we have to generator string  data
        $temp = array();
        foreach($args['where'] as $column_name => $value){
            $str = $column_name . " = :".$column_name;
            $temp[] = $str;
        }
        $this->sql .= " WHERE ".implode(' AND ' ,$temp);
      }
  }
  /* ------------------------------------------END WEHRE clause Creation------------------------------------------------------------*/
  /* ---------------------------------------------query dubg --------------------------------------------------------- */
          if($is_debug){
              debug($args);
              debug($this->sql,true);
          }
  /* ---------------------------------------------end of query dubg --------------------------------------------------------- */
  /* ----------------------------------------process of PDO format--------------------------------------- --------------*/
          $this->stmt = $this->conn->prepare($this->sql);
/* ------------------------------------to bind the value of for each where loop Update ------------------------------------------------------------ */
  if(isset($data) && !empty($data) && is_array($data)){
    foreach($data as $column_name => $value) {
        if(is_integer($value)){
            $param = PDO::PARAM_INT;
        }elseif(is_bool($value)){
            $param = PDO::PARAM_BOOL;
        }else{
            $param = PDO::PARAM_STR;
        }
        if($param){
            $this->stmt->bindValue(":_".$column_name,$value,$param); // parmenter : column name key , vlaue of its, $paramter
        }
    }
}
/* ------------------------------------to bind the value fo Update ------------------------------------------------------------ *
    
  /* ------------------------------------to bind the value of for each where loop ------------------------------------------------------------ */
  if(isset($args['where']) && !empty($args['where']) && is_array($args['where'])){
      foreach($args['where'] as $column_name => $value) {
          if(is_integer($value)){
              $param = PDO::PARAM_INT;
          }elseif(is_bool($value)){
              $param = PDO::PARAM_BOOL;
          }else{
              $param = PDO::PARAM_STR;
          }
          if($param){
              $this->stmt->bindValue(":".$column_name,$value,$param); // parmenter : column name key , vlaue of its, $paramter
          }
      }
  }
  /* ------------------------------------to bind the value ------------------------------------------------------------ */
        return  $this->stmt->execute();
        
  /* ----------------------------------------end of process of PDO format--------------------------------------- --------------*/
    }catch (PDOException  $th) {
        // PDO , connection (2019-06-04 09:34 PM); message
        $message = 'PDO Update, '.date('Y-m-d h:i A').": ".$this->sql." , " .$th->getMessage()."\r\n";
        error_log($message,3,ERROR_LOG); //message, 3 error log ma put gara constant k gharna error log bhanara , destination 
        return false;
    }catch(Exception $th){
            // PDO , connection (2019-06-04 09:34 PM); message
        $message = 'PDO, general update , '.date('Y-m-d h:i A').": ".$this->sql." , ".$th->getMessage()."\r\n";
        error_log($message,3,ERROR_LOG); //message, 3 error log ma put gara constant k gharna error log bhanara , destination
        return false;
    }
}
/* -------------------------------END Generating the insert query --------------------------------------------------- */




final protected function insert($data = array(), $is_debug = false){
    try{
          /* 
          INSERT  INTO table SET 
          column_name = value,
          column_name = value,
          
          */
          $this->sql = "INSERT INTO";
  /*----------------------------------whether the  table is created or not----------------------------------------------*/
          if(!$this->table){
              throw new Exception("Table not set");
          }
          $this->sql .= $this->table . " SET ";

          
          if(isset($data) && !empty($data)){
              if(is_array($data)){
                  $temp = array();
                  foreach($data as $column_name => $value){
                      $str_data = $column_name. " = :_".$column_name;
                      $temp[] = $str_data;
                  }
                  $this->sql .= implode(', ', $temp);
              }else {
                  $this->sql .= $data;
              }
          }else{
              throw new Exception('Data not inserted .');
          }
  /*----------------------------------whether the  table is created or not----------------------------------------------*/
  /* ---------------------------------------------query dubg --------------------------------------------------------- */
          if($is_debug){
              debug($data);
              debug($this->sql,true);
          }
  /* ---------------------------------------------end of query dubg --------------------------------------------------------- */
  /* ----------------------------------------process of PDO format--------------------------------------- --------------*/
          $this->stmt = $this->conn->prepare($this->sql);
/* ------------------------------------to bind the value of for each where loop Update ------------------------------------------------------------ */
  if(isset($data) && !empty($data) && is_array($data)){
    foreach($data as $column_name => $value) {
        if(is_integer($value)){
            $param = PDO::PARAM_INT;
        }elseif(is_bool($value)){
            $param = PDO::PARAM_BOOL;
        }else{
            $param = PDO::PARAM_STR;
        }
        if($param){
            $this->stmt->bindValue(":_".$column_name,$value,$param); // parmenter : column name key , vlaue of its, $paramter
        }
    }
}     
  /* ----------------------------------------end of process of PDO format--------------------------------------- --------------*/
    }catch (PDOException  $th) {
        // PDO , connection (2019-06-04 09:34 PM); message
        $message = 'PDO Insert, '.date('Y-m-d h:i A').": ".$this->sql." , " .$th->getMessage()."\r\n";
        error_log($message,3,ERROR_LOG); //message, 3 error log ma put gara constant k gharna error log bhanara , destination 
        return false;
    }catch(Exception $th){
            // PDO , connection (2019-06-04 09:34 PM); message
        $message = 'PDO, general Insert , '.date('Y-m-d h:i A').": ".$this->sql." , ".$th->getMessage()."\r\n";
        error_log($message,3,ERROR_LOG); //message, 3 error log ma put gara constant k gharna error log bhanara , destination
        return false;
    }
}
/* -------------------------------END Generating the Insert query --------------------------------------------------- */





/*------------------------------- Generating the Delete query --------------------------------------------------- */
final protected function delete($args = array(), $is_debug = false){
    try{
          /* 
          DELETE FROM table 
          WHERE clause
          
          
          */
          $this->sql = "DELETE FROM ";
  /*----------------------------------whether the  table is created or not----------------------------------------------*/
          if(!$this->table){
              throw new Exception("Table not set");
          }
          $this->sql .= $this->table;

          
         
  /*----------------------------------whether the  table is created or not----------------------------------------------*/
  /* ------------------------------------------WEHRE clause Creation------------------------------------------------------------*/
  if(isset($args['where']) && !empty($args['where'])){
      //$this->sql .=  " WHERE ".$args['where']; 
      if(is_string($args['where'])){
        $this->sql .= "WHERE ".$args['where']; 
      }else{
        // array xa bhana we have to generator string  data
        $temp = array();
        foreach($args['where'] as $column_name => $value){
            $str = $column_name . " = :".$column_name;
            $temp[] = $str;
        }
        $this->sql .= " WHERE ".implode(' AND ' ,$temp);
      }
  }
  /* ------------------------------------------END WEHRE clause Creation------------------------------------------------------------*/
  /* ---------------------------------------------query dubg --------------------------------------------------------- */
          if($is_debug){
              debug($args);
              debug($this->sql,true);
          }
  /* ---------------------------------------------end of query dubg --------------------------------------------------------- */
  /* ----------------------------------------process of PDO format--------------------------------------- --------------*/
          $this->stmt = $this->conn->prepare($this->sql);
    
  /* ------------------------------------to bind the value of for each where loop ------------------------------------------------------------ */
  if(isset($args['where']) && !empty($args['where']) && is_array($args['where'])){
      foreach($args['where'] as $column_name => $value) {
          if(is_integer($value)){
              $param = PDO::PARAM_INT;
          }elseif(is_bool($value)){
              $param = PDO::PARAM_BOOL;
          }else{
              $param = PDO::PARAM_STR;
          }
          if($param){
              $this->stmt->bindValue(":".$column_name,$value,$param); // parmenter : column name key , vlaue of its, $paramter
          }
      }
  }
  /* ------------------------------------to bind the value ------------------------------------------------------------ */
        return  $this->stmt->execute();
        
  /* ----------------------------------------end of process of PDO format--------------------------------------- --------------*/
    }catch (PDOException  $th) {
        // PDO , connection (2019-06-04 09:34 PM); message
        $message = 'PDO Delete, '.date('Y-m-d h:i A').": ".$this->sql." , " .$th->getMessage()."\r\n";
        error_log($message,3,ERROR_LOG); //message, 3 error log ma put gara constant k gharna error log bhanara , destination 
        return false;
    }catch(Exception $th){
            // PDO , connection (2019-06-04 09:34 PM); message
        $message = 'PDO, general Delete , '.date('Y-m-d h:i A').": ".$this->sql." , ".$th->getMessage()."\r\n";
        error_log($message,3,ERROR_LOG); //message, 3 error log ma put gara constant k gharna error log bhanara , destination
        return false;
    }
}
/* -------------------------------END Generating the Delete query --------------------------------------------------- */
}
/* ------------------------------end of connect to database-------------------------------------------------- */

?>