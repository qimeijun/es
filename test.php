<?php


    Smarty 是一个PHP末班引擎，可以实现程序逻辑和页面显示的分离。
    特性：
        1、快速
        2、比PHP内嵌到HTML的做法要有效率
        3、无模板解析的开销，只编译一次
        3、仅当模板文件被修改后才会聪明地重新编译
        4、容易创建自己的函数和变量修饰器，具有可扩展性。

    安装：
        1、Smarty 要求web服务器运行php 4.0.6 和以上版本
        2、基础安装：下载->解压->复制Smarty.class.php->项目中引用->修改php.ini
        3、进阶安装：

    使用：
        1、注释 {* 内容 *}
        2、变量
            {$foo} //显示简单变量
            {$foo[4]} //在0开始索引的数组中显示第五个元素
            {$foo.bar} //显示'bar'下标指向的数据值
            {$foo->bar} //显示对象属性'bar'
            {$foo->bar()} //显示对象成员方法'bar'的返回
            {#foo#} //显示变量配置文件内的变量'foo'
            {$smarty.config.foo} //等同于{#foo#}
        3、函数语法
            {include file = 'header.html'}
            {if $logged_in} 
                welcome
            {else}
                hello
        4、函数属性语法
            {include file = 'header.tpl'}
            {include file = 'header.tpl' nocache}  //等同于nocache=true
            {include file = 'header.tpl' attrib_name = 'attrib value'}
            {assign var = foo value=substr($bar, 2, 5)} // PHP函数结果
            {assign var = foo value = $buh + $bar | strlen} // 复杂表达式

        5、双引号中嵌入变量
            {func var = "test $foo test"} // 识别变量 $foo
            {func var = "test `$foo[bar]` test"} // 识别变量
            {func var = "test $foo.bar test"} // 识别$foo 而不是 $foo.bar
            {func var = "test `$foo.bar` test"} // 识别$foo.bar
            {func var = "test {time()} test"} // php 函数结果
        6、数学计算
            {$foo+1}
            {$foo*$bar}
            {if ($foo+$bar.test%$baz*134232+10+$b+10)}
        7、变量作用范围
            默认模板通过$smarty->display() 或者 $smarty->fetch() 调用，获取到smarty对象范围的变量
            $data = $smarty->createData();
            $data->assign('foo', 'data');
            $data->assign('bar', 'bar-data')

            $data = $smarty->createTemplate('index.tpl', $smarty);
            $tpl->assign('bar', 'bar-template');

            $smarty->display('index.tpl', $data);
        8、从配置文件获取变量
            // 使用hash 方式的模板
            {config_load file='foo.conf'} // 第一步加载配置文件
            {#pageTile#} // 第二步 获取pageTile 的值
            // 使用$smarty.config 方式的模板
            {config_load file='foo.conf'} // 第一步加载配置文件
            {$smarty.config.pageTile} // 第二步获取pageTitle的值
