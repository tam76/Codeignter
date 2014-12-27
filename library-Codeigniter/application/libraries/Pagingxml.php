<?php

class PagingXML {
    protected $rowPerPage = 25;
    protected $currentPage = 1;
    protected $startToShow = 0;
    protected $endToShow;
    protected $dataCount = 0;
    protected $totalPages;
    protected $pagePerSegment = 5;
    protected $adjacentSegment = 5;
    protected $pageUrl;
    protected $queryString;
    protected $navBar = null;
    
    // Các thuộc tính dùng để cài đặt các tính chất của thanh trạng thái
    /**
     * Holds the text before navigation bar
     * @var navBarLabel
     **/
    public $navBarLabel = 'Trang';
    /**
     * Holds the text of button First
     * @var firstButtonText
     **/
    public $firstButtonText = 'Đầu';
    /**
     * Holds the text of button End
     * @var endButtonText
     **/
    public $endButtonText = 'Cuối';
    /**
     * Holds status to show or hide siblings of current segment
     * @var showSiblingsSegment
     **/
    public $showSiblingsSegment = false;
    /**
     * Holds status to show or hide the textbox use to choose page
     * @var showMoveToPage
     **/
    public $showMoveToPage = false;
    /**
     * Holds the text before textbox
     * @var moveToPageText
     **/
    public $moveToPageText = 'Đến trang';
    /**
     * Holds the text after total pages number
     * @var totalPagesText
     **/
    public $totalPagesText = 'trang';
    
    // Các phương thức
    /**
     * Set number of data rows in one page
     * @param int rowPerPage
     **/
    protected function setTTPage($total_pages) {
        if (is_numeric($total_pages)) {
            $this->rowPerPage = (int)$rowPerPage;
        }
    }
    
    /**
     * Identify current page number
     */
    protected function setCurrentPage($currentPage) {
        /*if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"] > 0) {
            $this->currentPage = (int)$_GET["page"];
        }*/
        $this->currentPage = (int)$currentPage;
    }
    
    /**
     * Retun current page number
     * @return int
     */
    public function getCurrentPage() {
        return $this->currentPage;
    }
    
    /**
     * Set index of data to start show data on page
     */
    protected function setStartToShow() {
        $this->startToShow = ($this->currentPage - 1) * $this->rowPerPage;
    }
    
    /**
     * Return index of data to start show data on page
     * @return int
     */
    public function getStartToShow() {
        return $this->startToShow;
    }
    
    /**
     * Set index of data to finish show data on page
     */
    protected function setEndToShow() {
        $this->endToShow = $this->startToShow + $this->rowPerPage;
    }
    
    /**
     * Check condition to show data on page
     * @return bool
     **/
    public function acceptShow() {
        if ($this->dataCount >= $this->startToShow && $this->dataCount < $this->endToShow) {
            return true;
        }
        return false;
    }
    
    /**
     * Update total data
     **/
    public function countData() {
        $this->dataCount++;
    }
    
    /**
     * Calculation total page when using pagination
     */
    /*protected function calcTotalPages() {
        $totalPages = ceil($this->dataCount/$this->rowPerPage);
        $this->totalPages = (int)$totalPages;
    }*/
    protected function calcTotalPages($total_page) {
        $this->totalPages = $total_page;
    }
    
    /**
     * Return total page after using paging
     * @return int
     */
    public function getTotalPages() {
        return $this->totalPages;
    }
    
    /**
     * Identify number of pages each segement in paging navigation bar
     * @param int|null pagePerSegment
     **/
    protected function setPagePerSegment($pagePerSegment) {
        if (is_numeric($pagePerSegment)) {
            $this->pagePerSegment = (int)$pagePerSegment;
        }
    }
    
    /**
     * Identify back or next segment in paging navigation bar
     * @param int adjacentSegment
     **/
    public function setAdjacentSegment($adjacentSegment) {
        if (is_numeric($adjacentSegment)) {
            $this->adjacentSegment = (int)$adjacentSegment;
        }
    }
    
    /**
     * Set URL of link in paging navigation bar
     * @param string|null pageURL
     **/
    protected function setPageUrl($pageUrl) {
        if (empty($pageUrl)) {
            $this->pageUrl = $_SERVER["PHP_SELF"];
        } else {
            $this->pageUrl = $pageUrl;
        }
    }
    
    /**
     * Set query string at the end of URL of link in paging navigation bar
     * @param string|null queryString
     **/
    protected function setQueryString($queryString) {
        if (!empty($queryString)) {
            $this->queryString = $queryString.'&';
        }
    }
    
    /**
     * Render navigation bar of pagination
     * @param int|null pagePerSegment
     * @param string|null pageURL
     * @param string|null queryString
     */
    public function renderNavBar($pagePerSegment=null, $pageUrl=null, $queryString=null, $total_page=null, $currentPage=1) {
        $this->setCurrentPage($currentPage);
        $this->calcTotalPages($total_page);
        $this->setPagePerSegment($pagePerSegment);
        $this->setPageUrl($pageUrl);
        $this->setQueryString($queryString);
        // Chỉ hiển thị thanh phân trang khi số trang lớn hơn 1 và trang hiện tại nhỏ hơn hoặc bằng trang cuối
        if ($this->totalPages > 1 && $this->currentPage <= $this->totalPages) {
            // Phân đoạn thanh phân trang
            if ($this->totalPages < $this->pagePerSegment) {
                $startSegment = 1;
                $endSegment = $this->totalPages;
            } else {
                // Số trang bên trái trang hiện tại
                if ($this->pagePerSegment%2 != 0) {
                    $leftCurrent = floor($this->pagePerSegment/2);
                } else {
                    $leftCurrent = ($this->pagePerSegment/2) - 1;
                }
                // Số trang bên phải trang hiện tại
                $rightCurrent = $this->pagePerSegment - $leftCurrent - 1;
                $startSegment = $this->currentPage - $leftCurrent;
                $endSegment = $this->currentPage + $rightCurrent;
                if ($startSegment < 1) {
                    $startSegment = 1;
                    // Tính lại trang cuối đoạn
                    $endSegment = $this->pagePerSegment;
                }
                if ($endSegment > $this->totalPages) {
                    $endSegment = $this->totalPages;
                    // Tính lại trang đầu đoạn
                    $startSegment = $this->totalPages - $this->pagePerSegment + 1;
                }
            }
            
            // Bắt đầu thanh phân trang //////////////////////////////////////////
            $this->navBar .= '<div class="paging_nav">
            <form action="' .$this->pageUrl. '" method="get">';
            if (!is_null($this->queryString)) {
                $queryStringSet = trim($this->queryString, '&');
                $queryStringSet = explode('&', $queryStringSet);
                foreach ($queryStringSet as $queryString) {
                    $queryStringPart = explode('=', $queryString);
                    $this->navBar .= '<input type="hidden" name="' .$queryStringPart[0]. '" value="' .$queryStringPart[1]. '" />';
                }
            }
             $this->navBar .= $this->navBarLabel. ': ';
                //////////////////////////////////////////////////////////////////////
                
                // Nút trang đầu /////////////////////////////////////////////////////
                if ($startSegment > 1) {
                    $this->navBar .= '<a href="' .$this->pageUrl. '/trang1.html">' .$this->firstButtonText. '</a>...';
                }
                //////////////////////////////////////////////////////////////////////
                
                // Những phân đoạn trước đoạn hiện tại ///////////////////////////////
                if ($this->showSiblingsSegment) {
                    $backSegmentSet = null;
                    $backSegment = $this->currentPage - $this->adjacentSegment;
                    while ($backSegment > 1) {
                        if ($backSegment >= $startSegment - $rightCurrent) {
                            $backSegment -= 1;
                            continue;
                        }
                        $backSegmentSet = '<a href="' .$this->pageUrl. '/trang' .$backSegment. '.html">' .$backSegment. '</a>' .$backSegmentSet;
                        $backSegment -= $this->adjacentSegment;
                    }
                    if (!is_null($backSegmentSet) && $this->showSiblingsSegment) {
                        $this->navBar .= $backSegmentSet. '...';
                    }
                }
                //////////////////////////////////////////////////////////////////////
                
                // Danh sách trang đoạn hiện tại /////////////////////////////////////
                for ($page=$startSegment; $page<=$endSegment; $page++) {
                    if ($page == $this->currentPage) {
                        $this->navBar .= '<span class="current_page">' .$page. '</span>';
                    } else {
                        $this->navBar .= '<a href="' .$this->pageUrl. '/trang-' .$page. '.html">' .$page. '</a>';
                    }
                }
                //////////////////////////////////////////////////////////////////////
                
                // Những phân đoạn sau đoạn hiện tại /////////////////////////////////
                if ($this->showSiblingsSegment) {
                    $nextSegmentSet = null;
                    $nextSegment = $this->currentPage + $this->adjacentSegment;
                    while ($nextSegment < $this->totalPages) {
                        if ($nextSegment <= $endSegment + $leftCurrent) {
                            $nextSegment += 1;
                            continue;
                        }
                        $nextSegmentSet .= '<a href="' .$this->pageUrl. '/trang' .$nextSegment. '.html">' .$nextSegment. '</a>';
                        $nextSegment += $this->adjacentSegment;
                    }
                    if (!is_null($nextSegmentSet)) {
                        $this->navBar .= '...' .$nextSegmentSet;
                    }
                }
                //////////////////////////////////////////////////////////////////////
                
                // Nút trang cuối ////////////////////////////////////////////////////
                if ($endSegment < $this->totalPages) {
                    $this->navBar .= '...<a href="' .$this->pageUrl. '/trang-' .$this->totalPages. '.html">' .$this->endButtonText. '</a>';
                }
                //////////////////////////////////////////////////////////////////////
                
                // Show textbox chọn trang cần đến ///////////////////////////////////
                if ($this->showMoveToPage) {
                    $this->navBar .= ' - ' .$this->moveToPageText. ': <input type="text" name="page" />';
                }
                //////////////////////////////////////////////////////////////////////
                
                // Show tổng số trang ////////////////////////////////////////////////
                $this->navBar .= ' / '.$this->totalPages. ' ' .$this->totalPagesText;
                //////////////////////////////////////////////////////////////////////
                
                // Kết thúc thanh phân trang
                $this->navBar .= '</form></div>';
            //////////////////////////////////////////////////////////////////////            
        }
    }
    
    /**
     * Return navigation bar of pagination
     * @return string
     **/
    public function getNavBar() {
        return $this->navBar;
    }
    
    /**
     * Constructor
     * @param int rowPerPage - Number of data rows in one page
     **/
    public function __construct() {
        //$this->setRowPerPage($rowPerPage);
        //$this->setCurrentPage();
        //$this->setStartToShow();
        //$this->setEndToShow();
    }
    
}

?>