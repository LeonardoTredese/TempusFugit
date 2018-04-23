<?php
    
	include("UtilDB.php");

    class UtilStudente extends UtilDB{
        
        public function __construct(){
            $this->db=new mysqli("localhost","root","","tempusfugit"); 
            if ($this->db->connect_error){
                die('Connessione fallita: '.$this->db->connect_error);
            }//if 
        }//costruttore senza parametri 
       
/**RICHIESTE STUDENTE**/
       
        /*ritorna i corsi disponibili allo studente $idUT    CONTROLLATO*/
        public function getCorsiDisp($idUt){

            $stmt = $this->db->prepare("SELECT P.idProfessore,C.nomeCorso FROM ISCRIZIONI as I JOIN CORSI as C ON I.idCorsoI=C.idCorso JOIN PROFESSORE as P ON C.idProf=P.idProfessore WHERE I.idAccountI <> ?");
            $stmt->bind_param('i',$idUt); 
            $stmt->execute();
            $result = $stmt->get_result();
			$stmt->close();
            if(!$result)
                return null;
            else 
                return $result;
        }//getCorsiDisp
        
        //ritorna tutti i corsi a cui � iscritto lo studente $idUT CONTROLLATO
        public function getCorsiIscritto($idUt){
            $stmt = $this->db->prepare("SELECT DISTINCT P.idProfessore,C.nomeCorso FROM ISCRIZIONI as I JOIN CORSI as C ON I.idCorsoI=C.idCorso JOIN PROFESSORE as P ON C.idProf=P.IdProfessore WHERE I.idAccountI=?");
            $stmt->bind_param("i",$idUt); 
            $stmt->execute();
            $result = $stmt->get_result();
			$stmt->close();
            if(!$result)
                return null;
            else 
                return $result;
        }//getCorsiIscritto
        
        /* DA FINIRE ritorna tutte le comunicazioni in una discussione in un corso */
        public function getComunicazioni($idUt,$idDisc){
            $result=$this->db->query("SELECT * FROM DISCUSSIONI"); 
            if(!$result)
                die('Query fallita: '.$result->error);
            else
                return $result;            
        }//getComunicazioni
       
/**INVIO DATI STUDENTE**/       
       
        //modifica il colore dell' utente CONTROLLATO
        public function editColor($newColor,$idUt){
            $stmt = $this->db->prepare("INSERT INTO ACCOUNT(Colore) values(?) where IdUtente=?");
            $stmt->bind_param('si', $newColor,$idUt); // 's' specifies the variable type => 'string'
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else 
                return true;
        }//editColor
       
       //iscrizione corso CONTROLLATO
       public function iscrizioneCorso($idAc,$idC){
            $stmt = $this->db->prepare("INSERT INTO ISCRIZIONI(idAccountI,idCorsoI) values(?,?)");
            $stmt->bind_param('ii', $idAc,$idC); 
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else 
                return true;  
       }//iscrizioneCorso
       
       
        //inserisce una presenza
        public function confermaPresenza($idAccount,$idEvento,$idCorso){
            $stmt = $this->db->prepare("INSERT INTO PRESENZE(idAccountP,idEventoP,idCorsoP) values(?,?,?)");
            $stmt->bind_param('iii', $idAccount,$idEvento,$idCorso); 
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else 
                return true;  
       }//confermaPresenza
       
       public function confermaLettura($idAccount,$idComunicazione){
            $stmt = $this->db->prepare("INSERT INTO VISUALIZZAZIONI(idAccountP,idComunicazione) values(?,?)");
            $stmt->bind_param('ii', $idAccount,$idComunicazione); 
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else 
                return true;  
       }//confermaLettura
       
   }//UtilStudente
?>