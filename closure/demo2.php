<?php

class test
{
    public $a = 'a';
    private $b = 'b';
    static $c = 'c';

    public function say()
    {
        return 'hi';
    }
}

$test = new test();

// 案例一：通过创建匿名函数, 不实例化类就访问类中的公有成员。
$func = function ($arg = '') {
    return $this->a . $this->say() . $arg;
};
$return = $func::bind($func, $test);
$return = Closure::bind($func, $test); //因为bind是静态方法,所以这样也行
$return = $func->bindto($test);
echo $return('111') . PHP_EOL; //执行函数，输出ahi
echo "<br/>";

// 案例二：通过创建匿名函数，不实例化类就访问类中的公有成员和私有成员和静态成员
$func = function ($arg = '') {
    return $this->b . self::$c . $this->a . $this->say() . $arg;
};
$return = $func::bind($func, $test, test::class);
$return = $func->bindto($test, test::class);
$return = Closure::bind($func, $test, test::class);
echo $return('111') . PHP_EOL; //输出bcahi
echo "<br/>";

// 案例三：PHP7后，使用call直接输出, 且作用域默认就在类
echo $func->call(new test, '111'); //输出bcahi