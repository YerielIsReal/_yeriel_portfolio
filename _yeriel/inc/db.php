<?

    class _mysql{
        
        function conn(){
            // mysqli_connect('ip/host','DB ID','DB PW','dbname');
            $this->conn = mysqli_connect('localhost','yejin287','Kyj814908!db','yejin287') or die("Databases connect error!!");
        }      

        //
        function stop(){
            if(!$this->conn) return;
            $close = mysqli_close($this->conn);
            $this->conn = null;
        }

        //
        function conn_check(){
            if(!$this->conn){
                echo "Databases connect error!!";
                exit;
            }
        }        

        //
        function qry($qry){
            $proc = mysqli_query($this->conn,$qry);
            return $proc;
        }

        //
        function get($qry){
            $this->conn_check();
            $proc = array();
            $proc = mysqli_fetch_array(mysqli_query($this->conn,$qry));
            $c=@sizeof($proc)/2;
            for($d=0;$d<$c;$d++) unset($proc[$d]);            
            return $proc;
        }

        //
        function gets($qry,$ok=TRUE){
            $this->conn_check();
            $q = mysqli_query($this->conn,$qry);
            $proc=array();
            while(@$r = mysqli_fetch_array($q)) $proc[] = $r;
            for($i=0;$i<sizeof($proc);$i++){
                $c=sizeof($proc[$i])/2;
                for($d=0;$d<$c;$d++) unset($proc[$i][$d]);
            }

            return $proc;
        }

        //
        function insert_array($table,$data,$ok=TRUE){
            $this->conn_check();
            $qry=make_query($table,$data);
            if($ok){
                $this->qry($qry);
            }else echo $qry;
            return $qry;
        }

        //
        function update_array($table,$data,$where,$ok=TRUE){
            $this->conn_check();
            $qry=make_query($table,$data,$where);
            if($ok){
                $this->qry($qry);
            }
            else echo $qry;
            return $qry;
        }        
    }

    $my =   new _mysql;

?>