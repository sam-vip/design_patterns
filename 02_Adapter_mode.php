<?php
header('Content-Type:text/html;charset=utf-8');
/**
 * 适配器模式演示代码
 * Target适配目标： IDataBase接口
 * Adaptee被适配者： mysql和mysql_i、postgresql的数据库操作函数
 * Adapter适配器 ：mysql类和mysql_i、postgresql类
 */

/**
 * Interface IDatabase 适配目标，规定的接口将被适配对象实现
 * 约定好统一的api行为
 */
interface IDatabase
{
    // 定义数据库连接方法
    public function connect($host, $username, $password, $database);

    // 定义数据库查询方法
    public function query($sql);

    // 关闭数据库
    public function close();
}

/**
 * Class Mysql 适配器
 */
class Mysql implements IDatabase
{
    protected $connect; // 连接资源

    /**
     * 实现连接方法
     *
     * @param $host host
     * @param $username 用户名
     * @param $password 密码
     * @param $database 数据库名
     */
    public function connect($host, $username, $password, $database)
    {
        $connect = mysql_connect($host, $username, $password);
        mysql_select_db($database, $connect);
        $this->connect = $connect;
        //其他操作
    }

    /**
     * 实现查询方法
     *
     * @param $sql 需要被查询的sql语句
     * @return mi
     */
    public function query($sql)
    {
        return mysql_query($sql);
    }

    // 实现关闭方法
    public function close()
    {
        mysql_close();
    }
}

/**
 * Class Mysql 适配器
 */
class Mysql_i implements IDatabase
{
    protected $connect; // 连接资源

    /**
     * 实现连接方法
     *
     * @param $host host
     * @param $username 用户名
     * @param $password 密码
     * @param $database 数据库名
     */
    public function connect($host, $username, $password, $database)
    {
        $connect = mysqli_connect($host, $username, $password, $database);
        $this->connect = $connect;
        //其他操作
    }

    /**
     * 实现查询方法
     *
     * @param $sql 需要被查询的sql语句
     */
    public function query($sql)
    {
        return mysqli_query($this->connect, $sql);
    }

    // 实现关闭
    public function close()
    {
        mysqli_close($this->connect);
    }
}

/**
 * Class Postgresql 适配器
 */
class Postgresql implements IDatabase
{
    protected $connect; // 连接资源

    /**
     * 实现连接方法
     *
     * @param $host
     * @param $username
     * @param $password
     * @param $database
     */
    public function connect($host, $username, $password, $database)
    {
        $this->connect = pg_connect("host=$host dbname=$database user=$username password=$password");
        //其他操作
    }

    /**
     * 实现查询方法
     *
     * @param $sql 需要被查询的sql语句
     */
    public function query($sql)
    {
        // 其他操作
    }

    // 实现关闭方法
    public function close()
    {

    }
}


/**
 * 客户端使用演示
 * 这里以mysql为例
 * 只要模式设计好，不论有多少种数据库，实现和调用方式都是一样的
 * 因为都是实现的同一个接口，所以都是可以随意切换的
 */

$host = 'localhost';
$username = 'root';
$password = 'root';
$database = 'mysql';

//$client = new Postgresql();
//$client = new Mysql();
$client = new Mysql_i();
$client->connect($host, $username, $password, $database);
$result = $client->query("select * from db");
while ($rows = mysqli_fetch_array($result)) {
    var_dump($rows);
}
$client->close();