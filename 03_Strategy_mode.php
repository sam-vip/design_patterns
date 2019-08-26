<?php
header('Content-Type:text/html;charset=utf-8');
/**
 * 策略模式演示代码
 *
 * 为了更好地突出“策略”，我们这里以出行为例演示，日常出行大概分为以下几种工具：自驾车，公交车，地铁，火车，飞机，轮船
 *
 * 下面一起看代码，领会何为策略模式
 */

/**
 * Interface Travel 抽象策略角色
 * 约定具体方法
 */
interface Travel
{
    public function go();
}

/**
 * Class selfDriving 具体策略角色
 * 自驾车
 */
class bySelfDriving implements Travel
{
    public function go()
    {
        echo '我自己开着车出去玩<br>';
    }
}

/**
 * Class byBus具体策略角色
 * 乘公交
 */
class byBus implements Travel {
    public function go()
    {
        echo '我乘公交出去玩<br>';
    }
}

/**
 * Class byMetro 具体策略角色
 * 乘地铁
 */
class byMetro implements Travel
{
    public function go()
    {
        echo '我乘地铁出去玩<br>';
    }
}

/**
 * Class byTrain 具体策略角色
 * 乘火车
 */
class byTrain implements Travel
{
    public function go()
    {
        echo '我乘火车出去玩<br>';
    }
}

/**
 * Class byAirplane 具体策略角色
 * 乘飞机
 */
class byAirplane implements Travel
{
    public function go()
    {
        echo '我乘飞机出去玩<br>';
    }
}

/**
 * Class bySteamship 具体策略角色
 * 乘轮船
 */
class bySteamship implements Travel
{
    public function go()
    {
        echo '我乘轮船出去玩<br>';
    }
}

/**
 * Class Mine 环境角色
 */
class Mine{
    private $_strategy;
    private $_isChange = false;

    public function __construct(Travel $travel)
    {
        $this->_strategy = $travel;
    }

    /**
     * 改变出行方式
     *
     * @param Travel $travel
     */
    public function change(Travel $travel)
    {
        $this->_strategy = $travel;
        $this->_isChange = true;
    }

    public function goTravel()
    {
        if ($this->_isChange) {
            echo '现在改变主意，';
            $this->_strategy->go();
        } else {
            $this->_strategy->go();
        }

    }
}

/**
 * 客户端使用
 */
$strategy = new Mine(new byBus());
// 乘公交
$strategy->goTravel();
// 乘地铁
$strategy->change(new byMetro());
$strategy->goTravel();
// 自驾车
$strategy->change(new bySelfDriving());
$strategy->goTravel();