<?php
    
/**
 * Description of Post
 *
 * @author mackendy
 */
namespace Models;

/**
* @Entity(repositoryClass="Models\Repository\PostRepository")
* @Table(name="posts")
*/
class Post 
{


    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    protected $post_id;

    /** @Column(type="string",length=255)*/
    protected $post_title;

    /** @Column(type="text") */
    protected $post_content;
    
    /** @Column(type="text")*/
    protected $post_excerpt;
    
    /** @Column(type="string",length=20)*/
    protected $post_status;
    
    /** @Column(type="string",length=20)*/
    protected $post_type;
    
    /** @Column(type="datetime")*/
    protected $post_date;
    
    /** @Column(type="bigint", length=20)*/
    protected $post_parent;
    
    /** @Column(type="string", length=45)*/
    protected $post_slug;
    
    /** @Column(type="bigint", length=20)*/
    protected $post_author;
    
    /** @Column(type="integer", length=11)*/
    protected $user_id;
    
    public function getPost_id() {
        return $this->post_id;
    }

    public function setPost_id($post_id) {
        $this->post_id = $post_id;
    }

    public function getPost_title() {
        return $this->post_title;
    }

    public function setPost_title($post_title) {
        $this->post_title = $post_title;
    }

    public function getPost_content() {
        return $this->post_content;
    }

    public function setPost_content($post_content) {
        $this->post_content = $post_content;
    }

    public function getPost_excerpt() {
        return $this->post_excerpt;
    }

    public function setPost_excerpt($post_excerpt) {
        $this->post_excerpt = $post_excerpt;
    }

    public function getPost_status() {
        return $this->post_status;
    }

    public function setPost_status($post_status) {
        $this->post_status = $post_status;
    }

    public function getPost_type() {
        return $this->post_type;
    }

    public function setPost_type($post_type) {
        $this->post_type = $post_type;
    }

    public function getPost_date() {
        return $this->post_date;
    }

    public function setPost_date($post_date) {
        $this->post_date = $post_date;
    }

    public function getPost_parent() {
        return $this->post_parent;
    }

    public function setPost_parent($post_parent) {
        $this->post_parent = $post_parent;
    }

    public function getPost_slug() {
        return $this->post_slug;
    }

    public function setPost_slug($post_slug) {
        $this->post_slug = $post_slug;
    }

    public function getPost_author() {
        return $this->post_author;
    }

    public function setPost_author($post_author) {
        $this->post_author = $post_author;
    }
    
    public function getUser_id() {
        return $this->user_id;
    }

    public function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    
    
    
        
}


