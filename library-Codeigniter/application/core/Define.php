<?php
class Define extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('conf');
        $controller = $this->uri->segment(2);
        $data = $this->conf->GetAllConfig();
        $general = json_decode($data[0]['setting'], true);
        define('TIME_ZONE',$general['time_zone']);
        define('LANGUAGE',$general['language']);
        define('STYLE_TIME',$general['style_time']);
        
        $upload_avata = json_decode($data[1]['setting'], true);
        define('AVATA_UPOAD_PATH',$upload_avata['upload_path']);
        define('AVATA_ALLOWED_TYPES',$upload_avata['allowed_types']);
        define('AVATA_MAX_SIZE',$upload_avata['max_size']);
        define('AVATA_MAX_WIDTH',$upload_avata['max_width']);
        define('AVATA_MAX_HEIGHT',$upload_avata['max_height']);
        
        define('AVATA_IMG_LIBRARY',$upload_avata['image_library']);
        define('AVATA_QUALITY',$upload_avata['quality']);
        define('AVATA_WIDTH',$upload_avata['width']);
        define('AVATA_HEIGHT',$upload_avata['height']);
        
        define('THUMB_NEW_IMAGE',$upload_avata['new_image']);
        define('THUMB_IMG_LIBRARY',$upload_avata['image_library']);
        define('THUMB_WIDTH',$upload_avata['width']);
        define('THUMB_HEIGHT',$upload_avata['height']);
        
        $upload_book = json_decode($data[2]['setting'], true);
        define('BOOK_UPOAD_PATH',$upload_book['upload_path']);
        define('BOOK_ALLOWED_TYPES',$upload_book['allowed_types']);
        define('BOOK_MAX_SIZE',$upload_book['max_size']);
        
        $upload_img_book = json_decode($data[3]['setting'], true);
        define('IMG_UPOAD_PATH',$upload_img_book['upload_path']);
        define('IMG_ALLOWED_TYPES',$upload_img_book['allowed_types']);
        define('IMG_MAX_SIZE',$upload_img_book['max_size']);
        define('IMG_MAX_WIDTH',$upload_img_book['max_width']);
        define('IMG_MAX_HEIGHT',$upload_img_book['max_height']);
        
        define('IMG_IMG_LIBRARY',$upload_img_book['image_library']);
        define('IMG_QUALITY',$upload_img_book['quality']);
        define('IMG_WIDTH',$upload_img_book['width']);
        define('IMG_HEIGHT',$upload_img_book['height']);
        
        $pagination = json_decode($data[4]['setting'], true);
        define('HOME_LIMIT',$pagination['home_limit']);
        define('DEFAULT_LIMIT',$pagination['book_limit']);
        define('HOT_LIMIT',$pagination['hot_limit']);
        
        define('USER_LIMIT',$pagination['user']);
        define('CATE_LIMIT',$pagination['cate']);
        define('BOOK_LIMIT',$pagination['book']);
        
        $banner = json_decode($data[5]['setting'], true);
        define('BANNER_UPOAD_PATH',$banner['upload_path']);
        define('BANNER_ALLOWED_TYPES',$banner['allowed_types']);
        
        define('SLIDE_WIDTH',$banner['slide']['width']);
        define('SLIDE_HEIGHT',$banner['slide']['height']);
        
        define('LEFT_AD_WIDTH',$banner['left-ad']['width']);
        
        define('RIGHT_AD_WIDTH',$banner['right-ad']['width']);
        
        define('BLOCK_1_HEIGHT',$banner['block-1']['height']);
        
        define('BLOCK_2_HEIGHT',$banner['block-2']['height']);
        
    }
}
?>