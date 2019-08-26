<?php

header('Content-type:text/html;charset=utf-8');
/*
 *工厂方法模式
 */

/**
 * Interface people 人类
 */
interface  people
{
    public function say();
}

/**
 * Class man 继承people的男人类
 */
class man implements people
{
    // 实现people的say方法
    function say()
    {
        echo '我是男人-hi<br>';
    }
}

/**
 * Class women 继承people的女人类
 */
class women implements people
{
    // 实现people的say方法
    function say()
    {
        echo '我是女人-hi<br>';
    }
}

/**
 * Interface createPeople 创建人物类
 * 注意：与上面简单工厂模式对比。这里本质区别在于，此处是将对象的创建抽象成一个接口。
 */
interface  createPeople
{
    public function create();

}

/**
 * Class FactoryMan 继承createPeople的工厂类-用于实例化男人类
 */
class FactoryMan implements createPeople
{
    // 创建男人对象（实例化男人类）
    public function create()
    {
        return new man();
    }
}

/**
 * Class FactoryMan 继承createPeople的工厂类-用于实例化女人类
 */
class FactoryWomen implements createPeople
{
    // 创建女人对象（实例化女人类）
    function create()
    {
        return new women();
    }
}

/**
 * Class Client 操作具体类
 */
class  Client
{
    // 具体生产对象并执行对象方法测试
    public function test()
    {
        $factory = new FactoryMan();
        $man = $factory->create();
        $man->say();

        $factory = new FactoryWomen();
        $man = $factory->create();
        $man->say();
    }
}

// 执行
$demo = new Client;
$demo->test();