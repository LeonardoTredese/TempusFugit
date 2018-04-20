<?php    
     class UtilProf extends UtilDB{
        
        //costruttore ereditato
        public function __construct($conn){
            $this->$db=$conn;
        }//costruttore
        
        public function __construct(){
            $this->db=new mysqli("annoiato.net","professore","UZnXcEZ40p","tempusfugit"); 
            if ($this->db->connect_error){
                die('Connessione fallita: '.$this->db->connect_error);
            }//if 
        }//costruttore senza parametri
         
//RICHIESTE PROFESSORE AL DB
         
         //date le credenziali di accesso ritorna l'id dell' utente CONTROLLATO
        public function getIdUser($username,$pw){
            $stmt = $this->db->prepare("Select idAccount FROM ACCOUNT WHERE ACCOUNT.nomeUtente=? AND ACCOUNT.password=?");
            $stmt->bind_param('ss', $username,$pw); // 's' specifies the variable type => 'string
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return null;
            else 
                return $result;
        }//getIdUser    
        
        public function getUserById($idA){
            $stmt = $this->db->prepare("SELECT Username FROM ACCOUNT WHERE idAccount=?");
            $stmt->bind_param('i', $idA); // 's' specifies the variable type => 'string
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                die('Query fallita: '.$result->error." query='$query'"); 
            else{
                $row=$this->mysqli_fetch_array($result);
                foreach($row as $name=>$value)
                    if($name =='Ruolo')
                        return $value;
            }//else
        }//getUserById
         
        //ritorna tutti i corsi gestiti dal professore $idProf
        public function getCorsi($idProf){
            $stmt = $this->db->prepare("Select DISTINCT nomeCorso FROM CORSI where idProf=?");
            $stmt->bind_param('i',$idProf); 
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return null;
            else 
                return $result;
        }//getCorsi
        
        public function getIscrittiCorso($idCorso,$idProf){//OK
            $stmt = $this->db->prepare("Select A.nome,A.cognome,A.dataNascita FROM iscrizioni as I JOIN account as A ON I.idAccountI=A.idAccount JOIN corsi as C ON I.idCorsoI=C.idCorso WHERE I.idCorsoI=? AND C.idProf=?");
            $stmt->bind_param('ii',$idCorso,$idProf); 
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return null;
            else 
                return $result;
        }//getIscrittiCorso
         
        public function getPresenzeCorso($idCorso,$data){//OK
            $stmt = $this->db->prepare("Select A.nome,A.cognome FROM PRESENZE as P JOIN Account as A ON P.idAccountP = A.idAccount WHERE P.idEventoP=? AND P.dataP=?");
            $stmt->bind_param('is',$idCorso,$data); 
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return null;
            else 
                return $result;
        }//getIscrittiCorso
        
         
//INVIO DATI PROF DB    
         
        /*Crea un nuovo corso*/
        public function creaCorso($idProf,$nomeCorso,$postiDisponibili,$descrizione){
            $idR=rand(1,99999);
            $stmt = $this->db->prepare("INSERT INTO CORSI(idCorso,nomeCorso,idProf,postiDisponibili,descrizione) values($idR,?,?,?,?)");
            $stmt->bind_param('siis',$nomeCorso,$idProf,$postiDisponibili,$descrizione); 
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else 
                return true;
        }//creaCorso
        
        /*rimuove uno studente da un corso*/
        public function removeStudente($idAccount,$idCorso){
            $stmt = $this->db->prepare("DELETE FROM ISCRIZIONI WHERE idAccountI=? AND idCorsoI=?");
            $stmt->bind_param('ii',$idAccount,$idCorso); 
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else 
                return true;
        }//removeStudente
         
        /*pubblica una comunicazione sul corso*/
        public function creaComunicazione($idCorso,$idProf,$data){
            $stmt = $this->db->prepare("INSERT INTO COMUNICAZIONI(idCorsoCom,idProfCom,dataCom) values(?,?,?)");
            $stmt->bind_param('iis',$idCorso,$idProf,$data); 
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else 
                return true;
        }//creaComunicazione
            
        /*pubblica una comunicazione sul corso allegata ad un evento*/
        public function creaComunicazioneEvento($idCorso,$idProf,$idEvento,$data){
            $stmt = $this->db->prepare("INSERT INTO COMUNICAZIONI(idCorsoCom,idProfCom,idEventoCom,dataCom) values(?,?,?,?)");
            $stmt->bind_param('iiis',$idCorso,$idProf,$idEvento,$data); 
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else 
                return true;
        }//creaComunicazioneEvento
        
         
        //mette presente uno studente ad un evento
        public function setPresenze($idStudente,$idEvento,$data,$oraEntr,$idProfF){
            $stmt = $this->db->prepare("INSERT INTO PRESENZE(idAccountP,idCorsoP,dataP,oraEntrata,idProfFirma) values(?,?,?,?,?)");
            $stmt->bind_param('iissi',$idStudente,$idEvento,$data,$oraEntr,$idProfF); 
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else 
                return true;
        }//setPresenze
        
         
        //setta un' uscita di uno studente
        public function setUscita($idStudente,$idEvento,$idCorso,$oraUscita){
            $stmt = $this->db->prepare("INSERT INTO PRESENZE(oraUscita) values(?) WHERE idAccountP=? AND idEventoP=? AND idCorsoP=?";
            $stmt->bind_param('siii',$oraUscita,$idStudente,$idEvento,$idCorsoP); 
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else 
                return true;
        }//setUscita
        
        //crea evento
        public function creaEvento($idCorso,$dataOra,$luogo,$postiDisponibili){
            $stmt = $this->db->prepare("INSERT INTO EVENTI(idCCorso,dataOra,luogo,nPart) values(?,?,?,?)");
            $stmt->bind_param('issi',$idCorso,$dataOra,$luogo,$postiDisponibili); 
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else 
                return true;
        }//creaCorso
        
        
    }//UtilProf
?>