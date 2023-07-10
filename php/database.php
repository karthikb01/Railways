<?php
class database{
    private $host;
    private $dbusername;
    private $dbpassword;
    private $dbname;

    protected function connect(){
        $this->host="localhost";
        $this->dbusername="root";
        $this->dbpassword="";
        $this->dbname="dbms";

        $con=new mysqli($this->host,$this->dbusername,$this->dbpassword,$this->dbname);
        return $con;
    }
}

class query extends database{
    public function getdata($table,$field="*",$conditionArr='',$order_by_field="",$order_by_type="",$limit=""){
        $sql="select $field from $table";
       
        if($conditionArr!=""){
            $sql.=' where ';
            $c=count($conditionArr);
            $i=1;

            foreach($conditionArr as $key=>$val){
                if($i==$c){
                    $sql.="$key='$val' "; 
                }  
                else{
                    $sql.="$key='$val' and "; 
                }
                $i++;
            }
           
        }
        die($sql);
        if($limit!=""){
            $sql.=" limit $limit";
        }

        if($order_by_field!=""){
            $sql.=" order by $order_by_field $order_by_type ";
        }


        $result=$this->connect()->query($sql);
        // print_r($result);
        
        if($result->num_rows>0){
            $arr=array();
            while($row=$result->fetch_assoc()){
                // print_r($row);
                $arr[]=$row;
            }
            return $arr;
        }
        else{
            return 0;
        }
    }


    public function insertdata($table,$valuesArr){
       
       
        if($valuesArr!=""){
            foreach($valuesArr as $key=>$val){
               $fieldArr[]=$key;
               $valueArr[]=$val;
                
            }
            $field=implode(",",$fieldArr);
            $value=implode("','",$valueArr);
            $value="'".$value."'";
            
            $sql="insert into $table(id,$field) values (NULL,$value) ";
            // die($sql);
            $result=$this->connect()->query($sql);
        }
       
    }

     public function deletedata($table,$conditionArr){
       
       
        if($conditionArr!=""){
            $sql="delete from $table where ";
            $c=count($conditionArr);
            $i=1;

            foreach($conditionArr as $key=>$val){
                if($i==$c){
                    $sql.="$key='$val' "; 
                }  
                else{
                    $sql.="$key='$val' and "; 
                }
                $i++;
            }
            die($sql);
            //echo $sql;
            $result=$this->connect()->query($sql);
        }
       
    }


    public function updatedata($table,$conditionArr,$where_field,$where_value){
       
       
        if($conditionArr!=""){
            $sql="update $table set ";
            $c=count($conditionArr);
            $i=1;

            foreach($conditionArr as $key=>$val){
                if($i==$c){
                    $sql.="$key='$val' "; 
                }  
                else{
                    $sql.="$key='$val' , "; 
                }
                $i++;
            }
            $sql.=" where $where_field = $where_value ";
            //echo $sql;
            die($sql);
            $result=$this->connect()->query($sql);
        }
       
    }
}

/*select $field from $table where $condition like $like order by $order_by_field $order_by_type limit $limit;


$field-> * of name,email..
$table-> user
*/
?>