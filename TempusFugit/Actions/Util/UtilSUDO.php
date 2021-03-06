<?php

	include ("UtilProf.php");
     class UtilSudo extends UtilProf{

        /*Eredita da util prof:
            getUser($username,$pw)
            getUserById($idA)
            getCorsi($idProf)
            getIscrittiCorso($idCorso,$idProf)
            getPresenzeCorso($idCorso,$data)
            creaCorso($idProf,$nomeCorso,$postiDisponibili,$descrizione)
            removeStudente($idAccount,$idCorso)
            creaComunicazione($idCorso,$idProf,$data)
            creaComunicazioneEvento($idCorso,$idProf,$idEvento,$data)
            setPresenze($idStudente,$idEvento,$idCorso)
            setUscita($idStudente,$idEvento,$idCorso,$oraUscita)
        */



        public function __construct(){
            $this->db=new mysqli("annoiato.net","admin","tWgGYEY6SY","tempusfugit");
            if ($this->db->connect_error){
                die('Connessione fallita: '.$this->db->connect_error);
            }//if
        }//costruttore senza parametri


//RICHIESTE

       //ritorna tutti i corsi presenti nel sito
       public function getAllCorsi(){
            $this->db->prepare("Select DISTINCT * FROM CORSI ");
            $this->db->bind_param('i',$idProf);
            $this->db->execute();
            $result = $this->db->get_result();
            if(!$result)
                return null;
            else
                return $result;
        }//getCorsi

        //ritorna tutte quante le presenze del corso dato
        public function getPresenzeCorso($idCorso,$data){
            $this->db->prepare("Select A.Nome,A.Cognome FROM presenze as P JOIN account as A ON P.idAccountP = A.idAccount WHERE P.idCorsoP=? AND P.dataP=?");
            $this->db->bind_param('is',$idCorso,$data);
            $this->db->execute();
            $result = $this->db->get_result();
            if(!$result)
                return null;
            else
                return $result;
        }//getPresenzeCorso

//INVIO DATI

        //crea un nuovo account che non � studente o genitore
        public function createNotStudente($nome,$cognome,$dataNascita,$numCell,$password,$mail,$nomeUtente,$ruolo){
            $this->db->prepare("INSERT INTO ACCOUNT (nome,cognome,dataNascita,cellulare,password,mail,nomeUtente) values (?,?,?,?,?,?,?)");
            $this->db->bind_param('sssissi',$nome,$cognome,$dataNascita,$numCell,$password,$mail,$nomeUtente);
            $this->db->execute();
            $last_id = $this->$db->insert_id;
            $result = $this->db->get_result();
            if(!$result)
                return false;
            else {
                insertNotStudente($last_id,$ruolo);
            }//else
        }//createUser

        //inserisce un nuovo account prof o sudo nelle rispettive tabelle
        public function insertNotStudente($idAccountUser,$ruolo){
            if($ruolo=='Professore'){
                $this->db->prepare("INSERT INTO PROFESSORI (idProfessore) values (?)");
                $this->db->bind_param('i',$idAccountUser);
                $this->db->execute();
                $result = $this->db->get_result();
                if(!$result)
                    return false;
                else
                    return true;
            }else if ($ruolo=='sudo'){
                $this->db->prepare("INSERT INTO SUPERUSER (idSuperUser) values (?)");
                $this->db->bind_param('i',$idAccountUser);
                $this->db->execute();
                $result = $this->db->get_result();
                if(!$result)
                    return false;
                else
                    return true;
            }//else if
        }//insertNotStudente

        //metodo per inserire uno stidente all' interno del sistema
        public function insertStudente($nome,$cognome,$dataNascita,$numCell,$password,$mail,$nomeUtente,$matricola){
            $this->db->prepare("INSERT INTO ACCOUNT (nome,cognome,dataNascita,cellulare,password,mail,nomeUtente) values (?,?,?,?,?,?,?)");
            $this->db->bind_param('sssissi',$nome,$cognome,$dataNascita,$numCell,$password,$mail,$nomeUtente);
            $this->db->execute();
            //ottengo l'ultimo id inserito nell' account
            $last_id = $this->$db->insert_id;
            $result = $this->db->get_result();
            if(!$result)
                return false;
            else {
                //collegamento dell' account appena creato con la relazione studenti.
                $this->db->prepare("INSERT INTO STUDENTI (idStudente,matricola) values (?,?)");
                $this->db->bind_param('ii',$last_id,$matricola);
                $this->db->execute();
                $result = $this->db->get_result();
                if(!$result)
                    return false;
                else
                    return true;
            }//else
        }//insertStudente

     }//UtilSudo
?>
