<?php
     class UtilProf extends UtilDB{



        public function __construct(){
            $this->db=new mysqli("annoiato.net","professore","UZnXcEZ40p","tempusfugit");
            if ($this->db->connect_error){
                die('Connessione fallita: '.$this->db->connect_error);
            }//if
        }//costruttore senza parametri

//RICHIESTE PROFESSORE AL DB

         //date le credenziali di accesso ritorna l'id dell' utente CONTROLLATO
        public function getIdUser($username,$pw){
            $this->db->prepare("Select idAccount FROM ACCOUNT WHERE ACCOUNT.nomeUtente=? AND ACCOUNT.password=?");
            $this->db->bind_param('ss', $username,$pw); // 's' specifies the variable type => 'string
            $this->db->execute();
            $result = $this->db->get_result();
            if(!$result)
                return null;
            else
                return $result;
        }//getIdUser

        public function getUserById($idA){
            $this->db->prepare("SELECT Username FROM ACCOUNT WHERE idAccount=?");
            $this->db->bind_param('i', $idA); // 's' specifies the variable type => 'string
            $this->db->execute();
            $result = $this->db->get_result();
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
            $this->db->prepare("Select DISTINCT nomeCorso FROM CORSI where idProf=?");
            $this->db->bind_param('i',$idProf);
            $this->db->execute();
            $result = $this->db->get_result();
            if(!$result)
                return null;
            else
                return $result;
        }//getCorsi

        public function getIscrittiCorso($idCorso,$idProf){//OK
            $this->db->prepare("Select A.nome,A.cognome,A.dataNascita FROM iscrizioni as I JOIN account as A ON I.idAccountI=A.idAccount JOIN corsi as C ON I.idCorsoI=C.idCorso WHERE I.idCorsoI=? AND C.idProf=?");
            $this->db->bind_param('ii',$idCorso,$idProf);
            $this->db->execute();
            $result = $this->db->get_result();
            if(!$result)
                return null;
            else
                return $result;
        }//getIscrittiCorso

        public function getPresenzeCorso($idCorso,$data){//OK
            $this->db->prepare("Select A.nome,A.cognome FROM PRESENZE as P JOIN Account as A ON P.idAccountP = A.idAccount WHERE P.idEventoP=? AND P.dataP=?");
            $this->db->->bind_param('is',$idCorso,$data);
            $this->db->->execute();
            $result = $this->db->->get_result();
            if(!$result)
                return null;
            else
                return $result;
        }//getIscrittiCorso


//INVIO DATI PROF DB

        /*Crea un nuovo corso*/
        public function creaCorso($idProf,$nomeCorso,$postiDisponibili,$descrizione){
            $idR=rand(1,99999);
            $this->db->prepare("INSERT INTO CORSI(idCorso,nomeCorso,idProf,postiDisponibili,descrizione) values($idR,?,?,?,?)");
            $this->db->->bind_param('siis',$nomeCorso,$idProf,$postiDisponibili,$descrizione);
            $this->db->->execute();
            $result = $this->db->->get_result();
            if(!$result)
                return false;
            else
                return true;
        }//creaCorso

        /*rimuove uno studente da un corso*/
        public function removeStudente($idAccount,$idCorso){
            $this->db->prepare("DELETE FROM ISCRIZIONI WHERE idAccountI=? AND idCorsoI=?");
            $this->db->->bind_param('ii',$idAccount,$idCorso);
            $this->db->->execute();
            $result = $this->db->->get_result();
            if(!$result)
                return false;
            else
                return true;
        }//removeStudente

        /*pubblica una comunicazione sul corso*/
        public function creaComunicazione($idCorso,$idProf,$data){
            $this->db->prepare("INSERT INTO COMUNICAZIONI(idCorsoCom,idProfCom,dataCom) values(?,?,?)");
            $this->db->->bind_param('iis',$idCorso,$idProf,$data);
            $this->db->->execute();
            $result = $this->db->->get_result();
            if(!$result)
                return false;
            else
                return true;
        }//creaComunicazione

        /*pubblica una comunicazione sul corso allegata ad un evento*/
        public function creaComunicazioneEvento($idCorso,$idProf,$idEvento,$data){
            $this->db->prepare("INSERT INTO COMUNICAZIONI(idCorsoCom,idProfCom,idEventoCom,dataCom) values(?,?,?,?)");
            $this->db->->bind_param('iiis',$idCorso,$idProf,$idEvento,$data);
            $this->db->->execute();
            $result = $this->db->->get_result();
            if(!$result)
                return false;
            else
                return true;
        }//creaComunicazioneEvento


        //mette presente uno studente ad un evento
        public function setPresenze($idStudente,$idEvento,$data,$oraEntr,$idProfF){
            $this->db->prepare("INSERT INTO PRESENZE(idAccountP,idCorsoP,dataP,oraEntrata,idProfFirma) values(?,?,?,?,?)");
            $this->db->->bind_param('iissi',$idStudente,$idEvento,$data,$oraEntr,$idProfF);
            $this->db->->execute();
            $result = $this->db->->get_result();
            if(!$result)
                return false;
            else
                return true;
        }//setPresenze


        //setta un' uscita di uno studente
        public function setUscita($idStudente,$idEvento,$idCorso,$oraUscita){
            $this->db->prepare("INSERT INTO PRESENZE(oraUscita) values(?) WHERE idAccountP=? AND idEventoP=? AND idCorsoP=?");
            $this->db->->bind_param('siii',$oraUscita,$idStudente,$idEvento,$idCorsoP);
            $this->db->->execute();
            $result = $this->db->->get_result();
            if(!$result)
                return false;
            else
                return true;
        }//setUscita

        //crea evento
        public function creaEvento($idCorso,$dataOra,$luogo,$postiDisponibili){
            $this->db->prepare("INSERT INTO EVENTI(idCCorso,dataOra,luogo,nPart) values(?,?,?,?)");
            $this->db->->bind_param('issi',$idCorso,$dataOra,$luogo,$postiDisponibili);
            $this->db->->execute();
            $result = $this->db->->get_result();
            if(!$result)
                return false;
            else
                return true;
        }//creaCorso


    }//UtilProf
?>
