<?php

  class Db{
    public static $tablename;
    public static $where = '';
    public static $pdo;
    public static $stmt;
    public static $executeData;
    public static $order = '';
    public static $limit = '';
    public static $field = '*';
    //判断是否在where组内
    private $isGrouping = false;
    private $whereAndOrNot = "AND";
    
    public function __construct() {
      self::connect();
      self::setAttr();
    }
    // 数据库连接
    public static function connect(){
      $DS = DIRECTORY_SEPARATOR;
      $config = require __DIR__."{$DS}..{$DS}config{$DS}database.php";
      $dbms = $config["dbms"];
      $host = $config["host"];
      $user = $config["user"];
      $pass = $config["pass"];
      $dbms = $config["dbms"];
      $dbName = $config["dbName"];
      $dsn="$dbms:host=$host;dbname=$dbName;charset=utf8mb4";
      try {
        self::$pdo = new PDO($dsn, $user, $pass); //初始化一个PDO对象
      } catch (PDOException $e) {
        die ("错误!: " . $e->getMessage() . "<br/>");
      }
    }

    private static function setAttr(){
      self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    public static function table($tablename){
      self::$tablename = $tablename;
      return new self();
    }

    //查询
    public function where(Array|Closure $condition,$andOrNot = "AND"){
      $where = '';
      if(!empty($condition)){
        if($condition instanceof Closure){
          $this->isGrouping = true;
          $this->whereAndOrNot = $andOrNot;
          $condition($this);
          $this->isGrouping = false;
          return $this;
        }
        $whereArray = [];
        $executeData = [];
        foreach ($condition as $key => $value) {
          if(strtolower($value[1]) == "between"){
            $whereArray[] = "$value[0] $value[1] ? AND ?";
            $executeData[] = $value[2][0];
            $executeData[] = $value[2][1];
          }else if(strtolower($value[1]) == "in"){
            $str = rtrim(str_repeat("?,",count($value[2])),',');
            $whereArray[] = "$value[0] $value[1] ($str)";
            foreach ($value[2] as $vv){
              $executeData[] = $vv;
            }
          }else{
            $whereArray[] = "$value[0] $value[1] ?";
            $executeData[] = $value[2];
          }
        }
        if($andOrNot !== "NOT" && $andOrNot !== "OR NOT"){
          $where = implode(" $andOrNot ",$whereArray);
        }else{
          if($andOrNot == "OR NOT"){
            $where = implode(" OR ",$whereArray);
          }else{
            $where = implode(" AND ",$whereArray);
          }
          $where = "NOT (".$where.")";
        }
        if($this->isGrouping){
          $where = "( $where )";
        }
        if(isset(self::$executeData)){
          self::$executeData = array_merge(self::$executeData,$executeData);
        }else{
          self::$executeData = $executeData;
        }
      }
      if($this->isGrouping === true){
        $this->buildWhere($where,$this->whereAndOrNot);
      }else{
        $this->buildWhere($where,$andOrNot);
      }
      return $this;
    }
    
    public function whereOr(Array|Closure $condition){
      return $this->where($condition,"OR");
    }

    public function whereNot(Array|Closure $condition){
      return $this->where($condition,"NOT");
    }

    public function whereOrNot(Array|Closure $condition){
      return $this->where($condition,"OR NOT");
    }


    public function whereNull($name){
      $where = "$name is null";
      $this->buildWhere($where);
      return $this;
    }
    
    public function whereNotNull($name){
      $where = "$name is not null";
      $this->buildWhere($where);
      return $this;
    }

    private function buildWhere($where,$andOrNot="AND"){
      $oldWhere = self::$where;
      if($where!==''){
        if(strpos($oldWhere,"WHERE")===false){
          if($oldWhere!==''){
            $where = "WHERE ".$oldWhere." ".$andOrNot." ".$where;
          }else{
            $where = "WHERE ".$where;
          }
        }else{
          $where = $oldWhere." ".$andOrNot." ".$where;
        }
        self::$where = $where;
      }
    }

    public function order($orderby){
      self::$order = "order by ".$orderby;
      return $this;
    }

    public function limit($num1,$num2=null){
      self::$limit = "limit ".(is_null($num2)?$num1:"$num1,$num2");
      return $this;
    }

    public function find(){
      $result = $this->limit(1)->select();
      return isset($result[0])?$result[0]:false;
    }

    public function field(string $fields){
      self::$field = $fields;
      return $this;
    }

    public function getLastSql(){
      return self::$stmt->queryString;
    }

    public function count(){
      $totalArray = $this->field("count(*) as total")->find();
      return $totalArray["total"];
    }

    public function select(){
      try{
        $sql = "SELECT ".self::$field." FROM ".self::$tablename." ".self::$where." ".self::$order." ".self::$limit;    
        // echo $sql;
        self::$stmt = self::$pdo->prepare($sql);
        // 执行sql语句
        if(isset(self::$executeData)){
          self::$stmt->execute(self::$executeData);
        }else{
          self::$stmt->execute();
        }
        $result = self::$stmt->fetchAll(PDO::FETCH_ASSOC);
        self::$stmt->closeCursor();
        return $result;
      }catch(PDOException $e){
        // self::$errmessage = [
        //   "message"=>$e->getMessage(),
        //   "line"=>$e->getLine(),
        //   "code"=>$e->getCode(),
        // ];
        // return false;
        throw new Exception("查询异常：".$e->getMessage());
      }
    }

    public function delete(){
      try{
        $sql = "DELETE FROM ".self::$tablename." ".self::$where;  
        // echo $sql;
        self::$stmt = self::$pdo->prepare($sql);
        // 执行sql语句
        if(isset(self::$executeData)){
          self::$stmt->execute(self::$executeData);
        }else{
          self::$stmt->execute();
        }
        $result = self::$stmt->rowCount();
        self::$stmt->closeCursor();
        return $result;
      }catch(PDOException $e){
        // self::$errmessage = [
        //   "message"=>$e->getMessage(),
        //   "line"=>$e->getLine(),
        //   "code"=>$e->getCode(),
        // ];
        // return false;
        throw new Exception("删除异常：".$e->getMessage());
      }
    }

    public function insert(array $datas){
      try{
        if(empty($datas)){
          throw new Exception("插入异常：缺少要插入的数据");
        }
        $keys = array_keys($datas);
        $executeData = array_values($datas);
        // var_dump( $executeData );
        $str = rtrim(str_repeat("?, ",count($datas)),', ');
        // $sql = 'INSERT INTO '. self::$tablename .'('.implode(', ',$keys).') VALUES ('.$str.') ';  
        $sql = 'INSERT INTO '. self::$tablename .'('.implode(', ',$keys).') VALUES ('.$str.') ';  
        // $sql = 'INSERT INTO '. self::$tablename .'('.implode(', ',$keys).') VALUES ('.$str.') ';  
        // $sql = "INSERT INTO users (username,pwd) VALUES ('123','456')";  
        // echo $sql;
        self::$stmt = self::$pdo->prepare($sql);
        // 执行sql语句
        for($i = 1;$i<=count($datas);$i++){
          self::$stmt -> bindParam($i,$executeData[$i-1]);
        }
        // self::$stmt -> bindParam(1,$executeData[0]);
        // self::$stmt -> bindParam(2,$executeData[1]);
        self::$stmt->execute();
        // self::$stmt->execute(self::$executeData);
        // var_dump(self::$stmt->queryString) ;
        $result = self::$stmt->rowCount();
        self::$stmt->closeCursor();
        return $result;
      }catch(PDOException $e){
        // self::$errmessage = [
        //   "message"=>$e->getMessage(),
        //   "line"=>$e->getLine(),
        //   "code"=>$e->getCode(),
        // ];
        // return false;
        throw new Exception("插入异常：".$e->getMessage());
      }
    }
    /**
     * 更新数据
     * 
     * @param array 要更新的数组 $datas[]
     * @return int
     */
    public function update(array $datas) {
      try{
        if(empty($datas)){
          throw new Exception("修改异常：缺少要修改的数据");
        }
        $insertArr = [];
        foreach($datas as $key => $value){
          $insertArr[] = $key."=?";
          $executeData[] = $value;
        }
        $insertStr = implode(',',$insertArr);
        $sql = 'UPDATE '. self::$tablename .' SET '.$insertStr.' '.self::$where;  
        // echo $sql;
        self::$stmt = self::$pdo->prepare($sql);
        if(isset(self::$executeData)){
          $executeData = array_merge($executeData,self::$executeData);
        }
        // 执行sql语句
        self::$stmt->execute($executeData);
        $result = self::$stmt->rowCount();
        self::$stmt->closeCursor();
        return $result;
      }catch(PDOException $e){
        // self::$errmessage = [
        //   "message"=>$e->getMessage(),
        //   "line"=>$e->getLine(),
        //   "code"=>$e->getCode(),
        // ];
        // return false;
        throw new Exception("修改异常：".$e->getMessage());
      }
    }

  }
  
  // $config = require __DIR__."/../config/database.php";
  // var_dump($config);
  // $result = Db::table("users")->where([["createtime","between",["2024-1-28 16:00:00","2024-1-28 19:00:00"]]])->select();
  // $result = Db::table("users")->where([["id","in",[1,2,3]]])->where([["createtime","between",["2024-1-28 16:00:00","2024-1-28 19:00:00"]]])->select();
  // $result = Db::table("user")->where([["id","in",[1,2]]])->select();
  // $result = Db::table("users")->where([["id","in",[1,2]],["createtime","between",["2024-1-28 16:00:00","2024-1-28 19:00:00"]]],"AND")->select();
  // $result = Db::table("users")->whereOr([["id","<=",3],["createtime","between",["2024-1-28 16:00:00","2024-1-28 19:00:00"]]])->select();
  // $result = Db::table("users")->where([["id","in",[1,3]]],"NOT")->select();
  // $result = Db::table("users")->whereNot([["id","in",[1,3]]])->select();
  // $result = Db::table("users")->where([["id","in",[1,2,3]]])->whereNotNull("createtime")->select();
  // $result = Db::table("users")->where(function($query){
  //   $query->where([
  //     ["id","in",[1,2,3]],
  //     ["id",">","1"]
  //   ]);
  // })->whereOr([["id","<","3"]])->select();
  // $result = Db::table("users")->order("id DESC")->select();
  // $result = Db::table("users")->order("id DESC")->limit(2)->select();
  // $result = Db::table("users")->order("id DESC")->limit(1,2)->select();
  // $result = Db::table("users")->order("id DESC")->find();
  // $result = Db::table("users")->field("id,username,password")->order("id DESC")->find();
  // $queryObject = Db::table("users")->field("id,username,password")->order("id DESC");
  // $result = $queryObject->select();
  // $result = $queryObject->count();
  //获取最终sql执行语句
  // $sql = $queryObject->getLastSql();
  
  // $result = Db::table("users")->where([["id","=","4"]])->delete();
  // $result = Db::table("users")->insert(
  //   [
  //     "username"=>"1232222",
  //     "pwd"=>"456",
  //     "createtime"=>date("Y-m-d H:i:s"),
  //   ]
  // );
  // $result = Db::table("users")->where([["id","=","123"]])
  // ->update(
  //   [
  //     "username"=>"testupdate",
  //     "updatetime"=>date("Y-m-d H:i:s"),
  //   ]
  // );
  
  // var_dump($sql);
  // var_dump($result);
?>