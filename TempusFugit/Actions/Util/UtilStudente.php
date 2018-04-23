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

            $this->db->prepare("SELECT P.idProfessore,C.nomeCorso FROM ISCRIZIONI as I JOIN CORSI as C ON I.idCorsoI=C.idCorso JOIN PROFESSORE as P ON C.idProf=P.idProfessore WHERE I.idAccountI <> ?");
            $this->db->bind_param('i',$idUt);
            $this->db->execute();
            $result = $this->db->get_result();
			$this->db->close();
            if(!$result)
                return null;
            else
                return $result;
        }//getCorsiDisp

        //ritorna tutti i corsi a cui � iscritto lo studente $idUT CONTROLLATO
        public function getCorsiIscritto($idUt){
            $this->db->prepare("SELECT DISTINCT P.idProfessore,C.nomeCorso FROM ISCRIZIONI as I JOIN CORSI as C ON I.idCorsoI=C.idCorso JOIN PROFESSORE as P ON C.idProf=P.IdProfessore WHERE I.idAccountI=?");
            $this->db->bind_param("i",$idUt);
            $this->db->execute();
            $result = $this->db->get_result();
			$this->db->close();
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
            $this->db->prepare("INSERT INTO ACCOUNT(Colore) values(?) where IdUtente=?");
            $this->db->bind_param('si', $newColor,$idUt); // 's' specifies the variable type => 'string'
            $this->db->execute();
            $result = $this->db->get_result();
            if(!$result)
                return false;
            else
                return true;
        }//editColor

       //iscrizione corso CONTROLLATO
       public function iscrizioneCorso($idAc,$idC){
            $this->db->prepare("INSERT INTO ISCRIZIONI(idAccountI,idCorsoI) values(?,?)");
            $this->db->bind_param('ii', $idAc,$idC);
            $this->db->execute();
            $result = $this->db->get_result();
            if(!$result)
                return false;
            else
                return true;
       }//iscrizioneCorso


        //inserisce una presenza
        public function confermaPresenza($idAccount,$idEvento,$idCorso){
            $this->db->prepare("INSERT INTO PRESENZE(idAccountP,idEventoP,idCorsoP) values(?,?,?)");
            $this->db->bind_param('iii', $idAccount,$idEvento,$idCorso);
            $this->db->execute();
            $result = $this->db->get_result();
            if(!$result)
                return false;
            else
                return true;
       }//confermaPresenza

       public function confermaLettura($idAccount,$idComunicazione){
            $this->db->prepare("INSERT INTO VISUALIZZAZIONI(idAccountP,idComunicazione) values(?,?)");
            $this->db->bind_param('ii', $idAccount,$idComunicazione);
            $this->db->execute();
            $result = $this->db->get_result();
            if(!$result)
                return false;
            else
                return true;
       }//confermaLettura

   }//UtilStudente
?>
