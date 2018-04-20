<?php 
    class UtilGenitore extends UtilDB{
        
        public function __construct(){
            $this->db=new mysqli("annoiato.net","genitore","0gFdDuFR2x","tempusfugit"); 
            if ($this->db->connect_error){
                die('Connessione fallita: '.$this->db->connect_error);
            }//if 
        }//costruttore senza parametri 
        
        //costruttore ereditato
        public function __construct($conn){
            $this->$db=$conn;
        }//costruttore
        
        
        //ritorna i corsi a cui è iscirtto il figlio e le info del professore che gestisce il corso //OK
        public function getCorsiFiglio($idFiglio){
            $stmt = $this->db->prepare("SELECT DISTINCT aa.nome,aa.cognome,C.nomeCorso FROM iscrizioni as I JOIN corsi as C ON I.idCorsoI=C.idCorso JOIN professore as P ON C.idProf=P.IdProfessore JOIN account as aa on P.IdProfessore= aa.idAccount WHERE I.idAccountI=?");
            $stmt->bind_param('i',$idUt); 
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return null;
            else 
                return $result;
        }//getCorsiFiglio
        
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
        
        public function confermaLettura($idAccount,$idComunicazione){//ok
            $stmt = $this->db->prepare("INSERT INTO visualizzato(idAccountV,idComunicazione) values(?,?)");
            $stmt->bind_param('ii', $idAccount,$idComunicazione); 
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else 
                return true;  
        }//confermaLettura
          
?>