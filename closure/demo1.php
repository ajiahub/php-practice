<?php

//class Demo1
//{
//    /**
//     * @param $callable 必须可访问
//     *
//     * @return Closure
//     */
//    public function fromCallAble($callable)
//    {
//        if (method_exists(\Closure::class, 'fromCallable')) {
//            return \Closure::fromCallable($callable);
//        }
//        return function () use ($callable) {
//            call_user_func_array($callable, func_get_args());
//        };
//    }
//}

class Test
{
    public function exposeFunction()
    {
        $callable = [$this, 'privateFunction'];
        //return (new Demo1())->fromCallAble($callable);
        return \Closure::fromCallable($callable);
    }

    private function privateFunction($arg1, $arg2)
    {
        return [$arg1, $arg2];
    }
}

$closure = (new Test())->exposeFunction();
var_dump($closure('aaaa', 'bbb'));