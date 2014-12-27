<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class XML {
    protected $CI;
    
    protected $bookid;
    protected $cateid;
    protected $limit;
    protected $home_limit;
    protected $hot_limit;
    protected $total_page;
    
    protected $data;
    
    public function __construct($props = array())
	{
        $this->CI =& get_instance();
        $this->CI->load->helper('seourl');
		if (count($props) > 0)
		{
			$this->initialize($props);
		}
        echo $this->cateid;
	}
    
    function initialize($props = array())
	{
		if (count($props) > 0)
		{
			foreach ($props as $key => $val)
			{
				$this->$key = $val;
			}
		}
		return TRUE;
	}
    function CateXML($cateid = '') {
        $this->CI->load->model('book','category');
        if($cateid != ''){
            $this->cateid = $cateid;
        }
        $this->data = $this->CI->book->BookCache($this->cateid);
        $this->WriteXLM(unicode($this->CI->category->SelectTitle($this->cateid)),$this->limit);
        return $this->data;
    }
    function Checkid() {
        $this->CI->load->model('book');
        $home   = $this->CI->book->CheckHome($this->home_limit);
        $hot    = $this->CI->book->CheckHot($this->hot_limit);
        $rate   = $this->CI->book->CheckRate($this->hot_limit);
        $result = array('CateXML');
        foreach($home as $item) {
            if($item['bookid'] == $this->bookid) {
                $result[] = 'HomeXML';
                break;
            }
        }
        foreach($hot as $item) {
            if($item['bookid'] == $this->bookid) {
                $result[] = 'HotXML';
                break;
            }
        }
        foreach($rate as $item) {
            if($item['bookid'] == $this->bookid) {
                $result[] = 'RateXML';
                break;
            }
        }
        return $result;
    }
    function HomeXML() {
        $this->CI->load->model('book');
        $this->data = $this->CI->book->HomeCache($this->home_limit);
        $this->WriteXLM('home',$this->home_limit);
    }
    function HotXML() {
        $this->CI->load->model('book');
        $this->data = $this->CI->book->HotCache($this->hot_limit);
        $this->WriteXLM('hot',$this->hot_limit);
    }
    function RateXML() {
        $this->CI->load->model('book');
        $this->data = $this->CI->book->RateCache($this->hot_limit);
        $this->WriteXLM('rate',$this->hot_limit);
    }
    function WriteXLM($file,$limit) {
        $xml = new DOMDocument('1.0', 'utf-8');
        $book = $xml->createElement('BOOK');
        $xml->appendChild($book);
        $page = $xml->createElement('PAGE');
        $book->appendChild($page);
        $stt = 0;
        foreach($this->data as $data) {
            if($stt%$limit == 0 && $stt != 0){
                $page = $xml->createElement('PAGE');
                $book->appendChild($page);
            }
            $item = $xml->createElement('ITEM');
            $page->appendChild($item);
            $id = $xml->createAttribute('id');
            $item->appendChild($id);
            $id_val = $xml->createTextNode($data["bookid"]);
            $id->appendChild($id_val);
            $cid = $xml->createAttribute('cid');
            $item->appendChild($cid);
            $cid_val = $xml->createTextNode($data["cateid"]);
            $cid->appendChild($cid_val);
            
            
            $title = $xml->createElement('TITLE');
            $item->appendChild($title);
            $title_val = $xml->createTextNode(htmlspecialchars($data["book_title"]));
            $title->appendChild($title_val);
            
            $img = $xml->createElement('IMG');
            $item->appendChild($img);
            $img_val = $xml->createTextNode($data["book_img"]);
            $img->appendChild($img_val);
            
            $cost = $xml->createElement('COST');
            $item->appendChild($cost);
            $cost_val = $xml->createTextNode($data["cost"]);
            $cost->appendChild($cost_val);
            
            if(empty($data["author"])) {
                $tam = 'Không xác định';
            } else {
                $tam = htmlspecialchars($data["author"]);
            }
            $author = $xml->createElement('AUTHOR');
            $item->appendChild($author);
            $author_val = $xml->createTextNode($tam);
            $author->appendChild($author_val);
            
            if(empty($data["publisher"])) {
                $tam = 'Không xác định';
            } else {
                $tam = htmlspecialchars($data["publisher"]);
            }
            $publisher = $xml->createElement('PUBLISHER');
            $item->appendChild($publisher);
            $publisher_val = $xml->createTextNode($tam);
            $publisher->appendChild($publisher_val);
            
            if(empty($data["book_date"])) {
                $tam = 'Không xác định';
            } else {
                $tam = $data["book_date"];
            }
            $date = $xml->createElement('DATE');
            $item->appendChild($date);
            $date_val = $xml->createTextNode($tam);
            $date->appendChild($date_val);
            
            
            $description = $xml->createElement('DESCRIPTION');
            $item->appendChild($description);
            $description_val = $xml->createCDATASection($data['description']);
            $description->appendChild($description_val);
            
            if(empty($data["book_tag"])) {
                $tam = '["không có tag"]';
            } else {
                $tam = $data["book_tag"];
            }
            $tag = $xml->createElement('TAG');
            $item->appendChild($tag);
            $tag_val = $xml->createTextNode($tam);
            $tag->appendChild($tag_val);
            
            if(empty($data["score"])) {
                $tam = 0;
            } else {
                $tam = $data["score"];
            }
            $score = $xml->createElement('SCORE');
            $item->appendChild($score);
            $score_val = $xml->createTextNode($tam);
            $score->appendChild($score_val);
            
            $votes = $xml->createElement('VOTES');
            $item->appendChild($votes);
            $votes_val = $xml->createTextNode($data["views_rate"]);
            $votes->appendChild($votes_val);
            $stt++;
        }
        
        if($file != 'home' || $file != 'hot' || $file != 'rate') {
            $tp = ceil($stt/$limit);
            $total_page = $xml->createElement('TP');
            $book->appendChild($total_page);
            $total_page_val = $xml->createTextNode($tp);
            $total_page->appendChild($total_page_val);
        }
        
        $xml->formatOutput = true;
        $xml->save('application/cache/' .$file. '.xml');
    }
    
    function GetTotal_Page(){
        return $this->total_page;
    }
    
    function ReadXML($file,$page = 0){
        if(!file_exists('application/cache/'.unicode($file).'.xml')){
            return false;
        }else{
            $xml = simplexml_load_file('application/cache/'.unicode($file).'.xml');
            $bookPage = $xml->PAGE[$page];
            if($bookPage == false){
                return false;
            }else{
                $bookSet = $bookPage->ITEM;
                foreach ($bookSet as $bookitem) {
                    $data[] = $bookitem;
                }
                $this->total_page = $xml->TP;
                return $data;
            }
        }
    }
    function Selectbook($file, $id){
        $xml = simplexml_load_file('application/cache/' .unicode($file). '.xml');
        $tp = $xml->TP;
        $data = '';
        for($i=0;$i<$tp;$i++) {
            $bookPage = $xml->PAGE[$i];
            $bookSet = $bookPage->ITEM;
            foreach ($bookSet as $bookitem){
                if($bookitem[0]['id'] == $id) {
                    $data = $bookitem[0];
                    break;
                }
            }
        }
        if($data == ''){
            return false;
        }else{
            return $data;
        }
    }
}