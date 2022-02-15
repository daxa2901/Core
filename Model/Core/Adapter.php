<?php 
class Adapter{

    public $config = [];
    private $connect = NULL;
    
    public function connect()
    {
        $connect = mysqli_connect($this->config['host'],$this->config['username'],$this->config['password'],$this->config['dbname']);
        $this->setConnect($connect);
        return $connect;
    }

    public function setConnect($connect)
    {
        $this->connect = $connect;
        return $this->connect;
    }

    public function getConnect()
    {
        return $this->connect;
    }

    public function setConfig($config)
    {
        $this->config = $config;
        return $this->config;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function query($query)
    {
        if(!$this->getConnect())
        {
            $this->connect();
        }
        $result = $this->getConnect()->query($query);
        if(!$result)
        {
            echo mysqli_error($this->getConnect());
            exit;
        }
        return $result; 
    }

    public function insert($query)
    {

        $result = $this->query($query);
        if($result)
        {
            return $this->getConnect()->insert_id;
        }
        return $result;
    }

    public function update($query)
    {
        $result = $this->query($query);
        if(!$result)
        {
            echo mysqli_error($this->getConnect());
        }
        return $result;
    }

    public function delete($query)
    {
        $result = $this->query($query);
        return $result;
    }

    public function fetchRow($query)
    {
        $result = $this->query($query);
        if($result->num_rows)
        {
            return $result->fetch_assoc();
        }
        return false;
    }

     public function fetchAll($query,$mode=MYSQLI_ASSOC)
     {
        $result = $this->query($query);
        if($result->num_rows)
        {
            return $result->fetch_all($mode);
        }
        return false;
    }

    public function fetchPair($query)
    {
        
        $result = $this->fetchAll($query,MYSQLI_NUM);
        if(!$result)
        {
            return false;
        }
        $keys = array_column($result, '0');
        $values = array_column($result, '1');
        if (!$values)   
        {
            $values = array_fill(0,count($keys),NULL);
        }
        $result = array_combine($keys, $values);
        return $result;
    }

    public function fetchOne($query)
    {
        $result = $this->fetchAll($query,MYSQLI_NUM);
    
        if(!$result)
        {
            return false;
        }
        $key = $result['0']['0'];
        return $key;
    }

} 
#echo "<pre>";
$adapter = new Adapter();
$adapter->setConfig([
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'dbname' => 'cybercom'
	]);

#$adapter->insert("insert into Product(name,price,quantity,createdAt,updatedAt,status) values ('Redmi19',16000,50,'2020-02-01','2022-01-01',1)");

#$adapter->update("update Product set status = 2 where id = 20");

#$adapter->delete("DELETE FROM product where id=17");

#$data = $adapter->fetchAll("SELECT * FROM product");
#$data = $adapter->fetchRow("SELECT * FROM product where id = 15");
#print_r($data);
#echo $adapter->currentDate();