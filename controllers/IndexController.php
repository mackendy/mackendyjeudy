<?php

/**
 * Description of IndexController
 *
 * @author mackendy
 */
    use Models\Test as Test;
    
class IndexController  extends app\Controller{
    //put your code here
    
    public function index(){
//      $post = new Test();
//      $post->setcontent('test2');
//      $this->em->persist($post);
//      $this->em->flush();
//      //var_dump($post);
        $this->render("index");
    }
}

?>
