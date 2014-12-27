<?php
class Book extends CI_Model{
    protected $table = 'books';
    function __construct(){
        parent::__construct();
        $this->load->database();
    }
    function CountBook(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    function BookList($number, $offset,$order,$by){
        $this->db->select('bookid, book_title, author, publisher, book_date, book_public, cate_title, round((total_rate/views_rate),0) as score',FALSE)
                    ->join('category', 'category.cateid = books.cateid','left')
                    ->order_by($order, $by); 
        $query = $this->db->get($this->table,$number,$offset);
        return $query->result_array();
    }
    function BookCache($cateid ,$number = 0 ,$offset = 0 ,$not = false){
        $this->db->select('bookid, book_title, description, book_img, cost, author, publisher, book_date, book_tag, books.cateid, cate_title, views_rate, round((total_rate/views_rate),0) as score',FALSE)
                    ->join('category', 'category.cateid = books.cateid','left')
                    ->where(array('books.cateid' => $cateid, 'book_public' => 'Y'))
                    ->order_by('bookid', 'DESC');
        if($number == 0 && $offset == 0 && $not == false){
            $query = $this->db->get($this->table);
        }else{
            $this->db->where_not_in('bookid',$not);
            $query = $this->db->get($this->table,$number,$offset);
        }  
        return $query->result_array();
    }
    function CheckHome($limit){
        $this->db->select('bookid')
                    ->where('book_public', 'Y')
                    ->order_by('bookid', 'DESC'); 
        $query = $this->db->get($this->table,$limit,0);
        return $query->result_array();
    }
    function CheckHot($limit){
        $this->db->select('bookid')
                    ->where('book_public', 'Y')
                    ->order_by('viewing', 'DESC'); 
        $query = $this->db->get($this->table,$limit,0);
        return $query->result_array();
    }
    function CheckRate($limit){
        $this->db->select('bookid, round((total_rate/views_rate),0) as score',FALSE)
                    ->where('book_public', 'Y')
                    ->order_by('score', 'DESC')
                    ->order_by('views_rate', 'DESC'); 
        $query = $this->db->get($this->table,$limit,0);
        return $query->result_array();
    }
    function HomeCache($limit){
        $this->db->select('bookid, book_title, book_img, description, cost, author, publisher, book_date, book_tag, books.cateid, cate_title, views_rate, round((total_rate/views_rate),0) as score',FALSE)
                    ->join('category', 'category.cateid = books.cateid','left')
                    ->where('book_public', 'Y')
                    ->order_by('bookid', 'DESC');
        $query = $this->db->get($this->table,$limit,0);
        return $query->result_array();
    }
    function HotCache($limit){
        $this->db->select('bookid, book_title, book_img, description, cost, author, publisher, book_date, book_tag, books.cateid, cate_title, views_rate, round((total_rate/views_rate),0) as score',FALSE)
                    ->join('category', 'category.cateid = books.cateid','left')
                    ->where('book_public', 'Y')
                    ->order_by('viewing', 'DESC');
        $query = $this->db->get($this->table,$limit,0);
        return $query->result_array();
    }
    function RateCache($limit){
        $this->db->select('bookid, book_title, book_img, description, cost, author, publisher, book_date, book_tag, books.cateid, cate_title, views_rate, round((total_rate/views_rate),0) as score',FALSE)
                    ->join('category', 'category.cateid = books.cateid','left')
                    ->where('book_public', 'Y')
                    ->order_by('score', 'DESC')
                    ->order_by('views_rate', 'DESC');
        $query = $this->db->get($this->table,$limit,0);
        return $query->result_array();
    }
    function CheckChange($change){
        if($change == 'active'){
            return 'Y';
        }elseif($change == 'inactive'){
            return 'N';
        }else{
            return false;
        }
    }
    function ChangePublic($change, $id){
        if($this->CheckChange($change) == false){
            return false;
        }else{
            $data = array(
                           'book_public'    => $this->CheckChange($change),
                           'userid_modify'  => $this->session->userdata('userid')
                        );
            
            $this->db->where('bookid', $id);
            $this->db->update($this->table, $data); 
            return true;
        }
    }
    function BookOfCate($id){
        $this->db->from('books')->where('cateid',$id);
        return $this->db->count_all_results();
    }
    function ChangeCate($id){
        $data = array(
                       'cateid' => '',
                       'book_public' => 'N'
                    );
        
        $this->db->where('cateid', $id);
        $this->db->update($this->table, $data);
        return true;
    }
    
    function InfoBook($id){
        $this->db->select('bookid, book_title, book_img, book_url, cate_title, book_tag, cost, author, publisher, book_date, description, q.username as id_create, w.username as id_modify, books.cateid as cateid, round((total_rate/views_rate),0) as score, book_public, viewing',false)
                ->where('bookid',$id)
                ->join('user as q','books.userid_create = q.userid')
                ->join('user as w','books.userid_modify = w.userid', 'left')
                ->join('category', 'category.cateid = books.cateid');
        $query = $this->db->get($this->table);
        if($this->db->count_all_results() == 0){
            return false;
        } else{
            return $query->row_array();
        }
    }
    function AddBook($book_title, $book_url, $cost, $book_img, $author, $publisher, $book_date, $book_tag, $description, $book_public, $cateid, $user_create){
        $data = array(
           'book_title'     => $book_title ,
           'book_url'       => $book_url ,
           'cost'           => $cost,
           'book_img'       => $book_img ,
           'author'         => $author ,
           'publisher'      => $publisher,
           'book_date'      => $book_date,
           'book_tag'       => $book_tag ,
           'description'    => $description,
           'cateid'         => $cateid,
           'userid_create'  => $user_create ,
           'book_public'    => $book_public
        );
        
        $this->db->insert($this->table, $data); 
    }
    function EditBook($id, $book_url, $cost, $book_img, $author, $publisher, $book_date, $book_tag, $description, $book_public, $cateid, $userid_modify){
        $data = array(
                       'book_url'       => $book_url,
                       'cost'           => $cost,
                       'book_img'       => $book_img,
                       'author'         => $author,
                       'publisher'      => $publisher,
                       'book_date'      => $book_date,
                       'book_tag'       => $book_tag,
                       'description'    => $description,
                       'book_public'    => $book_public,
                       'cateid'         => $cateid,
                       'userid_modify'  => $userid_modify
                    );
        
        $this->db->where('bookid', $id);
        $this->db->update($this->table, $data); 
    }
    function SearchBook($text){
        $this->db->select('bookid, book_title, book_img, book_url, cate_title, book_tag, cost, author, publisher, book_date, books.cateid as cateid, round((total_rate/views_rate),0) as score',false)
                ->like('book_title', $text)
                ->where('book_public','Y')
                ->join('category', 'category.cateid = books.cateid');
        $query = $this->db->get($this->table);
        if($this->db->count_all_results() == 0){
            return false;
        } else{
            return $query->result_array();
        }
    }
    function GetLink($id){
        $this->db->where('bookid',$id);
        $this->db->select('book_img,book_url, cateid');
        $query = $this->db->get($this->table);
        if($this->db->count_all_results() == 0){
            return false;
        } else{
            return $query->row_array();
        }
    }
    function DelBook($id){
        $this->db->delete($this->table, array('bookid' => $id)); 
    }
    function SelectBook($id){
        $this->db->select('bookid, book_title, book_img, cost, author, publisher, books.cateid, book_date, book_tag, views_rate, round((total_rate/views_rate),0) as score',FALSE)
                ->where('bookid',$id)
                ->where('book_public','Y')
                ->join('user','books.userid_create = user.userid')
                ->join('category', 'category.cateid = books.cateid');
        $query = $this->db->get($this->table);
        if($this->db->count_all_results() == 0){
            return false;
        } else{
            return $query->row_array();
        }
    }
    function AddViews($id){
        $data = array(
                       'viewing'    =>  'viewing + 1'
                    );
        $this->db->where('bookid', $id);
        $this->db->update($this->table, $data,null,null,false); 
        return true;
    }
    function SubtractViews($id){
        $data = array(
                       'viewing'    =>  'viewing - 1'
                    );
        $this->db->where('bookid', $id);
        $this->db->update($this->table, $data,null,null,false); 
        return true;
    }
    function Rating($id, $score){
        $data = array(
                       'views_rate'    =>  'views_rate + 1',
                       'total_rate'    =>   "total_rate + $score"
                    );
        $this->db->where('bookid', $id);
        $this->db->update($this->table, $data,null,null,false); 
        return true;
    }
}

?>