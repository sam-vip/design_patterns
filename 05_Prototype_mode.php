<?php

header('Content-type:text/html;charset=utf-8');

/**
 * PHP原型模式-潜拷贝
 */

/**
 * Interface Prototype 抽象原型模式
 */
interface Prototype
{
    // 定义拷贝自身方法啊
    public function copy();
}

/**
 * Class ConcretePrototype 具体原型模式
 */
class ConcretePrototype implements Prototype
{

    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * 拷贝自身
     *
     * @return ConcretePrototype 返回自身
     */
    public function copy()
    {
        return clone $this;//浅拷贝
    }
}

/**
 * 测试潜拷贝
 */
class LatentCopyDemo
{
    public $array;
}

/**
 * Class Client 客户端
 */
class Client
{

    /**
     * 测试方法
     */
    public static function test()
    {

        $demo = new LatentCopyDemo();
        $demo->array = array(1, 2);

        $object1 = new ConcretePrototype($demo);
        $object2 = $object1->copy();

        var_dump($object1->getName());
        echo '<br/>';
        var_dump($object2->getName());
        echo '<br/>';

        $demo->array = array(3, 4);
        var_dump($object1->getName());
        echo '<br />';
        var_dump($object2->getName());
        echo '<br />';
    }
}

Client::test();