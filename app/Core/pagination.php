<?php 
    namespace App\Core;
    class Pagination{
        // cac thong so mac dinh
        private $config=[
            'limit'=>10,
            'current_page'=>1,
            'start'=>0,
            'total_records'=>1,
            'total_pages'=>1,
            'link_full'=>'',
        ];
        // 
        public function __construct() {
        }
        // ham khoi tao
        public function init($config=array()) {
            // lay cac gia tri tu tham so config 
            foreach($config as $key => $val) {
                $this->config[$key] = $val;
            }
            // tinh tong trang dua theo tong so ban ghi chia cho so ban ghi moi trang
            $this->config['total_pages']=ceil($this->config['total_records']/$this->config['limit']);
            // kiem tra trang hien tai co lon hon tong so trang hay khong
            if($this->config['current_page']>$this->config['total_pages']){
                $this->config['current_page'] = $this->config['total_pages'];
            }
            // trang hien tai phai bat dau tu 1
            if($this->config['current_page']<1){
                $this->config['current_page'] = 1;
            }
            // vi tri bat dau duoc bat dau sau cac ban ghi da duoc hien thi o cac trang truoc do
            // cong thuc : so ban ghi cua 1 trang nhan voi so trang truoc do
            $this->config['start']=($this->config['current_page']-1)*$this->config['limit'];
        }
        // lay ra thong tin limit
        public function getLimit(){
            return $this->config['limit'];
        }
        // lay ra vi tri bat dau
        public function getStart(){
            return $this->config['start'];
        }
        // lay phan danh sach cac trang 
        public function getPagination(){
            echo '<nav style="font-size: 16px;" aria-label="...">';
            echo '<ul class="pagination">';
            echo "<li class=\"page-item ".($this->config['current_page'] > 1?"":"disabled")."\">
            <a class=\"page-link\" href=\"".$this->config['link_full'].($this->config['current_page']-1)."\" >Previous</a>
            </li>";
            for($i=1;$i<=$this->config['total_pages'];$i++){
                echo "<li class=\"page-item ".($this->config['current_page']==="$i"?"active":"")." \">
                        <a class=\"page-link\" href=\"".$this->config['link_full'].$i."\">$i</a>
                    </li>";
            }
            echo"<li class=\"page-item ".($this->config['current_page']<$this->config['total_pages']?"":"disabled")."\">
                    <a class=\"page-link\" href=\"".$this->config['link_full'].($this->config['current_page']+1)."\">Next</a>
                </li>
            </ul>
            </nav>";
        }
    }