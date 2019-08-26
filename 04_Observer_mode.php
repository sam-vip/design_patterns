<?php
header('Content-type:text/html;charset=utf-8');

/**
 * Class Subject 主题
 */
class Subject implements SplSubject
{
    private $_observers = [];

    /**
     * 实现添加观察者方法
     *
     * @param SplObserver $observer
     */
    public function attach(SplObserver $observer)
    {
        if (!in_array($observer, $this->_observers)) {
            $this->_observers[] = $observer;
        }
    }

    /**
     * 实现移除观察者方法
     *
     * @param SplObserver $observer
     */
    public function detach(SplObserver $observer)
    {
        if (false !== ($index = array_search($observer, $this->_observers))) {
            unset($this->_observers[$index]);
        }
    }

    /**
     * 实现提示信息方法
     */
    public function notify()
    {
        foreach ($this->_observers as $observer) {
            $observer->update($this);
        }
    }

    /**
     * 设置数量
     *
     * @param $count
     */
    public function sendMessage($name)
    {
        echo   $name .'去吃饭<br>';
    }


}

/**
 * Class Observer1 观察者一
 */
class Observer1 implements SplObserver
{
    public function update(SplSubject $subject)
    {
        $subject->sendMessage("小明");
    }
}

/**
 * Class Observer2 观察者二
 */
class Observer2 implements SplObserver
{
    public function update(SplSubject $subject)
    {
        $subject->sendMessage("晓红");
    }
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
        // 初始化主题
        $subject = new Subject();
        // 初始化观察者一
        $observer1 = new Observer1();
        // 初始化观察者二
        $observer2 = new Observer2();
        // 添加观察者一
        $subject->attach($observer1);
        // 添加观察者二
        $subject->attach($observer2);
        // 消息提示
        $subject->notify();
        // 移除观察者一
        $subject->detach($observer1);
        // 消息提示
        $subject->notify();//输出：数据量加1 积分量加10 积分量加10
    }
}

// 执行测试
Client::test();