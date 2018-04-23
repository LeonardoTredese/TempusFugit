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


        //ritorna i corsi a cui � iscirtto il figlio e le info del professore che gestisce il corso //OK
        public function getCorsiFiglio($idFiglio){
            $this->db->prepare("SELECT DISTINCT aa.nome,aa.cognome,C.nomeCorso FROM iscrizioni as I JOIN corsi as C ON I.idCorsoI=C.idCorso JOIN professore as P ON C.idProf=P.IdProfessore JOIN account as aa on P.IdProfessore= aa.idAccount WHERE I.idAccountI=?");
            $this->db->bind_param('i',$idUt); 
            $this->db->execute();
            $result = $this->db->get_result();
            if(!$result)
                return null;
            else
                return $result;
        }//getCorsiFiglio

         public function getPresenzeCorso($idCorso,$data){//OK
            $this->db->prepare("Select A.nome,A.cognome FROM PRESENZE as P JOIN Account as A ON P.idAccountP = A.idAccount WHERE P.idEventoP=? AND P.dataP=?");
            $this->db->bind_param('is',$idCorso,$data); 
            $this->db->execute();
            $result = $this->db->get_result();
            if(!$result)
                return null;
            else
                return $result;
        }//getIscrittiCorso

        public function confermaLettura($idAccount,$idComunicazione){//ok
            $this->db->prepare("INSERT INTO visualizzato(idAccountV,idComunicazione) values(?,?)");
            $this->db->bind_param('ii', $idAccount,$idComunicazione); 
            $this->db->execute();
            $result = $this->db->get_result();
            if(!$result)
                return false;
            else
                return true;
        }//confermaLettura

?>
