<?php

/**
 * Description of ContactController
 *
 * @author mackendy
 */
class ContactController  extends app\Controller{
    //put your code here
    
    public function index(){
    	$this->notification = true;
        $this->render("index");
    }

    public function contact()
    {

        if (isset($_POST['contact'])) {

             //je filtre les informations envoyé
             $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
             $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
             $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
             $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
             $this->send($nom,$prenom,$email,$message);
        }
    }

     public function send($nom,$prenom,$email,$message)
    {      
        if (isset($_POST['contact'])) {

            $to = "mackendy.jeudy@gmail.com";
            $subject = "Contact web";
            $message = $message;
            $headers = 'From:<'.$email.'> '.$prenom.','.$nom. "\r\n" .
                        'Reply-To:'.$email . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

            if(mail($to, $subject, $message, $headers))
            {
                
                $this->redirect('/contact/?mail=ok');
            }else{
                $this->e404("Erreur SMTP ou POP3");
            }
        }else{
            $this->e404("Erreur cette page existe pas :)");
        }
    }
}


?>
