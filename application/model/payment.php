<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 20.03.17
 * Time: 17:03
 */

class Payment extends Model
{
    public $id;
    public $category_id;
    public $direct_id;
    public $date;
    public $summ;

    public $direct;
    public $category;
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        parent::__construct($db);
    }

    /**
     * Get all songs from database
     */
    public function getAllPayments($filterParams=null)
    {
        $sql = "SELECT * FROM payment ";
        if($filterParams!=null){
            $sql = $this->filterPaymentSql($filterParams,$sql);
        }

        $query = $this->db->prepare($sql);
        $query->execute();
        if($query->rowCount() > 0){
            while($row = $query->fetchObject('Payment',['db'=>$this->db])){
                $row->direct = $this->getName('direct', $row->direct_id);
                $row->category = $this->getName('category', $row->category_id);
                $array[] = $row;
            }
            return $array;
        }else{
            return '';
        }
    }

    public function filterPaymentSql($filterParams, $sql){
        $str ='';
        if(!empty($filterParams)){
            $str.=' WHERE ';
            foreach ($filterParams as $key=>$param){
                if($key == 'direct_id'){
                    if($param != 0 && $param != ''){
                        $str.=$key.'='.$param.' AND ';
                    }
                }elseif($key == 'summ'){
                    if($param != 0 && $param != ''){
                        $char = substr($param, 0, 1);
                        if($char == '>') {
                            $char1 = substr($param, 0, 2);
                            if($char1 == '>=') {
                                $flag0 = '>=';
                                $param = substr($param, 2);
                            }
                            else {
                                $flag0 = '>';
                                $param = substr($param, 1);
                            }
                        }
                        elseif($char == '<') {
                            $char1 = substr($param, 0, 2);
                            if($char1 == '<=') {
                                $flag0 = '<=';
                                $param = substr($param, 2);
                            }
                            else {
                                $flag0 = '<';
                                $param = substr($param, 1);
                            }
                        }
                        else {
                            $flag0 = '=';
                        }
                        $str.=$key.' '.$flag0.' '.$param.' AND ';
                    }
                }elseif($key == 'category_id'){
                    if(!empty($param) && $param[0]!=0){
                        $str.=$key.' IN ('.implode(',',$param).') AND ';
                    }
                }elseif($key == 'date_start'){
                    if($param!=''){
                        $str.= 'date >="'. $param.'" AND ';
                    }
                }elseif($key == 'date_end'){
                    if($param!=''){
                        $str.= 'date <="'. $param.'" AND ';
                    }
                }
            }
            if($str == ' WHERE '){
                $str = '';
            }else{
                $str = substr($str, 0, strlen($str)-4);
            }

            if($filterParams['sort'] != 0 && $filterParams['sort'] !=''){
                if($filterParams['sort_option']!=2){
                    $str.= "ORDER BY ". $filterParams['sort']. " ASC";
                }else{
                    $str.= "ORDER BY ". $filterParams['sort']. " DESC";
                }
            }
            return $sql.$str;
        }else{
            return $sql;
        }
    }

    public function getName($name, $value){
        if($value != null){
            $sql = 'Select * from '.$name.' where id =:id';
            $query = $this->db->prepare($sql);
            $parameters = [':id' => $value];
            $query->execute($parameters);
            return $query->fetch();
        }else{
            return null;
        }
    }

    public function getPaymentById($id){
        $sql = "SELECT * FROM payment WHERE id = :id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = [':id' => $id];
        $query->execute($parameters);

        $payment = $query->fetchObject('Payment',['db'=>$this->db]);
        $payment->direct = $this->getName('direct', $payment->direct_id);
        $payment->category = $this->getName('category', $payment->category_id);

        return $payment;
    }

    public function deletePayment($id)
    {
        $sql = "DELETE FROM payment WHERE id = :id";
        return $this->deleteRow($id, $sql);
    }

    public function addPayment($values){
        $sql = "INSERT INTO payment (direct_id, category_id, date, summ) VALUES (:direct_id, :category_id, :date, :summ)";
        if($this->addRow($sql, $values)){
            return true;
        }else{
            return false;
        }
    }

    public function updateValueById($pk, $name, $value){
        $sql = "UPDATE payment SET ".$name." = :value WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = [':id' => $pk, ':value' => $value];
        if($query->execute($parameters)){
            return $value;
        }
    }
}