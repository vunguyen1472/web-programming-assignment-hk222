<?php 
    function getConnection() {
        $servername = "localhost";
        $username = "root";
        $password = NULL;
        $dbname = "enterprise_management";

        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
    function get_staff_info_list(){
        $conn = getConnection();
        $sql = "SELECT `id`, `name`, `type` FROM `user` WHERE 1;";
        $list = $conn->query($sql);
        $conn->close();
        return $list;
    }
    class Paginator {
 
        private $_conn;
            private $_limit;
            private $_page;
            private $_query;
            private $_total;
        public function __construct( $conn, $query ) {
        
            $this->_conn = $conn;
            $this->_query = $query;
            
            $rs= $this->_conn->query( $this->_query );
            $this->_total = $rs->num_rows;  
        }
        public function getData( $limit = 10, $page = 1 ) {
         
            $this->_limit   = $limit;
            $this->_page    = $page;
         
            if ( $this->_limit == 'all' ) {
                $query      = $this->_query;
            } else {
                $query      = $this->_query . " LIMIT " . ( ( $this->_page - 1 ) * $this->_limit ) . ", $this->_limit";
            }
            $rs             = $this->_conn->query( $query );
         
            while ( $row = $rs->fetch_assoc() ) {
                $results[]  = $row;
            }
         
            $result         = new stdClass();
            $result->page   = $this->_page;
            $result->limit  = $this->_limit;
            $result->total  = $this->_total;
            $result->data   = $results;
         
            return $result;
        }
        public function createLinks( $links ) {
            if ( $this->_limit == 'all' ) {
                return '';
            }
         
            $last       = ceil( $this->_total / $this->_limit );
         
            $start      = ( ( $this->_page - $links ) > 0 ) ? $this->_page - $links : 1;
            $end        = ( ( $this->_page + $links ) < $last ) ? $this->_page + $links : $last;
            $html = '<div class="soft-pagination">
            <ul class="soft-pagination-items">
            ';
            if ($this->_page != 1){
                $html .= '<li> <a class="fa fa-chevron-circle-left" style="font-size:20px;color:white" href="?page=role_management&numpage='.($this->_page - 1).'"></a></li>';
            }
         
            for ( $i = $start ; $i <= $end; $i++ ) {
                if ($this->_page == $i){
                    $html .= '<li class="active"><a href="?page=role_management&numpage='.$i.'">'.$i.'</a></li>';
                }
                else {
                    $html .= '<li><a href="?page=role_management&numpage='.$i.'">'.$i.'</a></li>';
                    
                }
            }
            if ($this->_page != $last){
                $html .= '<li> <a class="fa fa-chevron-circle-right" style="font-size:20px;color:white" href="?page=role_management&numpage='.($this->_page + 1).'"></a></li>';
            }
            $html .= '</ul>
            </div>';
            return $html;
        }
    }
?>