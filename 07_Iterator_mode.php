<?php

header('Content-type:text/html;charset=utf-8');
/**
 * 迭代器模式
 */

/**
 * Class ConcreteIterator 具体的迭代器
 */
class ConcreteIterator implements Iterator
{
    private $position = 0;
    private $array = array();

    public function __construct($array)
    {
        $this->array = $array;
        $this->position = 0;
    }

    function rewind()
    {
        $this->position = 0;
    }

    function current()
    {
        return $this->array[$this->position];
    }

    function key()
    {
        return $this->position;
    }

    function next()
    {
        ++$this->position;
    }

    function valid()
    {
        return isset($this->array[$this->position]);
    }
}

/**
 * Class MyAggregate 聚合容器
 */
class ConcreteAggregate implements IteratorAggregate
{
    public $property;

    /**
     * 添加属性
     *
     * @param $property
     */
    public function addProperty($property)
    {
        $this->property[] = $property;
    }

    public function getIterator()
    {
        return new ConcreteIterator($this->property);
    }
}

/**
 * Class Client 客户端测试
 */
class Client
{
    public static function test()
    {
        //创建一个容器
        $concreteAggregate = new ConcreteAggregate();
        // 添加属性
        $concreteAggregate->addProperty('属性1');
        // 添加属性
        $concreteAggregate->addProperty('属性2');
        //给容器创建迭代器
        $iterator = $concreteAggregate->getIterator();
        //遍历
        while ($iterator->valid()) {
            $key = $iterator->key();
            $value = $iterator->current();
            echo '键: ' . $key . ' 值: ' . $value . '<hr>';
            $iterator->next();
        }

    }
}

Client:: test();