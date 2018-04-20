<?php    
     class UtilLogin extends UtilDB{
        
        
        //costruttore ereditato
        public function __construct($conn){
            $this->$db=$conn;
        }//costruttore
         
        public function __construct(){
            $this->db=new mysqli("annoiato.net","admin","tWgGYEY6SY","tempusfugit"); 
            if ($this->db->connect_error){
                die('Connessione fallita: '.$this->db->connect_error);
            }//if 
        }//costruttore senza parametri
        
        /*@param username -> username dell' utente
          @param pw -> password dell' utente
          @return un array contente Ruolo e IdAccount
        
        public function getUser($username,$pw){ 
            
            //quattro query una per tabella
            $stmt = $this->db->prepare("SELECT Ruolo,idAccount FROM ACCOUNT WHERE ACCOUNT.nomeUtente=? AND ACCOUNT.password=?");
            $stmt->bind_param('ss', $username,$pw); // 's' specifies the variable type => 'string
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else{
                $row=$this->mysqli_fetch_array($result);
                if($row.count()==0)
                    return false;//0 se il l'utente non è loggato
                else{
                    $userInfo= array();
                    foreach($row as $name=>$value){
                        if($name =='Ruolo'){
                                $userinfo = [
                                    'Ruolo'=>$value,
                                    'idAccount'=>$idAccount
                                ];
                                return $userinfo; //ritorna un array associativo che contiene le info dell'utente
                        }//if-foreach
                    }//foreach
                }//else not logged
            }//else - !result
        }//getUser*/
        
        // - I: idUtente, O:nomeUtente- CONTROLLATO
        public function getUserNameById($idA){
            $stmt = $this->db->prepare("SELECT nomeUtente FROM account WHERE idAccount=?");
            $stmt->bind_param('i', $idA); // 's' specifies the variable type => 'string
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                die('Query fallita: '.$result->error." query='$query'"); 
            else{
                $row=$this->mysqli_fetch_array($result);
                foreach($row as $name=>$value)
                    if($name =='nomeUtente')
                        return $value;
            }//else
        }//getUserById
         
        //date le credenziali di accesso ritorna l'id dell' utente CONTROLLATO
        public function getIdUser($username,$pw){
            $stmt = $this->db->prepare("Select idAccount FROM account WHERE nomeUtente=? AND password=?");
            $stmt->bind_param('ss', $username,$pw); // 's' specifies the variable type => 'string
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return null;
            else 
                return $result;
        }//getIdUser
    }//UtilLogin
?>