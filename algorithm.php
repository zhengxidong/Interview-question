1、一群猴子排成一圈，按1，2，…，n依次编号。然后从第1只开始数，数到第m只,把它踢出圈，从它后面再开始数，再数到第m只，在把它踢出去…，如此不停的进行下去，直到最后只剩下一只猴子为止，那只猴子就叫做大王。要求编程模拟此过程，输入m、n, 输出最后那个大王的编号。

function king($n, $m){
    $monkeys = range(1, $n);         //创建1到n数组
    $i=0;
    while (count($monkeys)>1) {     //循环条件为猴子数量大于1
        if(($i+1)%$m==0) {     //$i为数组下标;$i+1为猴子标号
            unset($monkeys[$i]);  //余数等于0表示正好第m个，删除，用unset删除保持下标关系
        } else {
            array_push($monkeys,$monkeys[$i]);     //如果余数不等于0，则把数组下标为$i的放最后，形成一个圆形结构
            unset($monkeys[$i]);
        }
            $i++;//$i 循环+1，不断把猴子删除，或 push到数组 
    }
    return current($monkeys);  //猴子数量等于1时输出猴子标号，得出猴王
}
echo king(6,3);

2、有一母牛，到4岁可生育，每年一头，所生均是一样的母牛，到15岁绝育，不再能生，20岁死亡，问n年后有多少头牛。

function niu($y){
    static $num= 1;                    //定义静态变量;初始化牛的数量为1
    for ($i=1; $i <=$y ; $i++) {    
        if($i>=4 && $i<15){         //每年递增来算，4岁开始+1，15岁不能生育
        $num++;
            niu($y-$i);               //递归方法计算小牛$num，小牛生长年数为$y-$i
        }else if($i==20){          
        $num--;                             //20岁死亡减一
        }
    return $num;
}

3、杨辉三角

/* 默认输出十行，用T(值)的形式可改变输出行数 */
class T{
  private $num;
  public function __construct($var=10) {
    if ($var<3) die("值太小啦！");
    $this->num=$var;
  }
  public function display(){
    $n=$this->num;
    $arr=array();
  //$arr=array_fill(0,$n+1,array_fill(0,$n+1,0));
    $arr[1]=array_fill(0,3,0);
    $arr[1][1]=1;
    echo str_pad(" ",$n*12," ");
    printf("%3d",$arr[1][1]);
    echo "<br/>";
    for($i=2;$i<=$n;$i++){
      $arr[$i]=array_fill(0,($i+2),0);
      for($j=1;$j<=$i;$j++){
        if($j==1)
          echo str_pad(" ",($n+1-$i)*12," ");
        printf("%3d",$arr[$i][$j]=$arr[$i-1][$j-1]+$arr[$i-1][$j]);
        echo "  ";
      }
      echo"<br/>";
    }
  }
}
$yh=new T('3'); //$yh=new T(数量);
$yh->display();

4.冒泡排序

function maopao($arr){
    $len = count($arr); 
    for($k=0;$k<=$len;$k++)
    {
        for($j=$len-1;$j>$k;$j--){
          if($arr[$j]<$arr[$j-1]){
            $temp = $arr[$j];
            $arr[$j] = $arr[$j-1];
            $arr[$j-1] = $temp;
          }
        }
    }
    return $arr;
}

5.快速排序

function quickSort($arr) {
    //先判断是否需要继续进行
    $length = count($arr);
    if($length <= 1) {
        return $arr;
    }
    //选择第一个元素作为基准
    $base_num = $arr[0];
    //遍历除了标尺外的所有元素，按照大小关系放入两个数组内
    //初始化两个数组
    $left_array = array();  //小于基准的
    $right_array = array();  //大于基准的
    for($i=1; $i<$length; $i++) {
        if($base_num > $arr[$i]) {
            //放入左边数组
            $left_array[] = $arr[$i];
        } else {
            //放入右边
            $right_array[] = $arr[$i];
        }
    }
    //再分别对左边和右边的数组进行相同的排序处理方式递归调用这个函数
    $left_array = quickSort($left_array);
    $right_array = quickSort($right_array);
    //合并

    return array_merge($left_array, array($base_num), $right_array);
}

6.二分查找算法（折半查找算法）

function binsearch($x,$a){
    $c=count($a);
    $lower=0;
    $high=$c-1;
    while($lower<=$high){
        $middle=intval(($lower+$high)/2);
        if($a[$middle]>$x){
            $high=$middle-1;
        } elseif($a[$middle]<$x){
            $lower=$middle+1;
        } else{
            return $middle;
        }
    }
    return false;
}

8.字符集合：输入一个字符串，求出该字符串包含的字符集合，并按顺序排序（英文）

function set($str){
    //转化为数组
    $arr = str_split($str);
    //去除重复
    $arr = array_flip(array_flip($arr));
    //排序
    sort($arr);
    //返回字符串
    return implode('', $arr);
}

9.遍历一个文件下的所有文件和子文件夹下的文件

function AllFile($dir){
    if($dh = opendir($dir)){
        while (($file = readdir($dh)) !== false){
            if($file !='..' && $file !='.'){
                if(is_dir($dir.'/'.$file)){
                    AllFile($dir.'/'.$file);  //如果判断还是文件，则递归
                }else{  
                    echo $file;            //输出文件名
                }
            }
        } 
    }
}

10.从一个标准的Url提取出文件的扩展名

function getExt($url)
  {
    $arr = parse_url($url);
    $file = basename($arr['path']);// basename函数返回路径中的文件名部分
    $ext = explode('.', $file);
    return $ext[count($ext)-1];

  }

  11.有个人想上一个n级的台阶，每次只能迈1级或者迈2级台阶，问：这个人有多少种方法可以把台阶走完？例如：总共3级台阶，可以先迈1级再迈2级，或者先迈2级再迈1级，或者迈3次1级总共3中方式

  function jieti($num){    //实际上是斐波那契数列
    return $num<2?1:jieti($num-1)+jieti($num-2);
}

12.请写一段PHP代码，确保多个进程同时写入同一个文件成功

<?php
    $fp = fopen("lock.txt","w+");
    if (flock($fp,LOCK_EX)) {
        //获得写锁，写数据
        fwrite($fp, "write something");

        // 解除锁定
        flock($fp, LOCK_UN);
    } else {
        echo "file is locking...";
    }
    fclose($fp);
?>

13.无限级分类

function tree($arr,$pid=0,$level=0){
    static $list = array();
    foreach ($arr as $v) {
        //如果是顶级分类，则将其存到$list中，并以此节点为根节点，遍历其子节点
        if ($v['pid'] == $pid) {
            $v['level'] = $level;
            $list[] = $v;
            tree($arr,$v['id'],$level+1);
        }
    }
    return $list;
}

14.获取上个月第一天 和 最后一天

//获取上个月第一天
    date('Y-m-01',strtotime('-1 month'));

    //获取上个月最后一天
    date('Y-m-t',strtotime('-1 month'));

    15.随机输入一个数字能查询到对应的数据区间

    //把区间换成数组写法，用二分法查找区间
function binsearch($x,$a){  
    $c=count($a);  
    $lower=0;  
    $high=$c-1;  
    while($lower<=$high){  
        $middle=intval(($lower+$high)/2);  
        if($a[$middle]>=$x){  
            $high=$middle-1;
        }elseif($a[$middle]<=$x ){  
            $lower=$middle+1;
        }   
    }

    return '在区间'.$a[$high].'到'.$a[$lower];  
}

$array  = ['1','50','100','150','200','250','300'];
$a = '120';
echo binsearch($a,$array);

16，现在有一个字符串，你要对这个字符串进行 n 次操作，每次操作给出两个数字：(p, l) 表示当前字符串中从下标为 p 的字符开始的长度为 l 的一个子串。你要将这个子串左右翻转后插在这个子串原来位置的正后方，求最后得到的字符串是什么。字符串的下标是从 0 开始的，你可以从样例中得到更多信息。

每组测试用例仅包含一组数据，每组数据第一行为原字符串，长度不超过 10 ，仅包含大小写字符与数字。接下来会有一个数字 n 表示有 n 个操作，再接下来有 n 行，每行两个整数，表示每次操作的(p , l)。

保证输入的操作一定合法，最后得到的字符串长度不超过 1000。

<?php

class TestKeenSting{
    private $str;

    public function __construct($str)
    {
        $this->str = $str;
    }

    public function run($orders)
    {
        foreach($orders as $item)
        {
            $this->execute($item[0],$item[1]);
        }
        return $this->str;
    }

    private function execute($pos,$length)
   {
        $len = strlen($this->str);
        if(($length-$pos) > $len)
            exit(1);
        else
            $tmp_str = substr($this->str,$pos,$length);
        $s1 = substr($this->str,0,$pos+$length);
        $s2 = substr($this->str,$pos+$length);
        $dest_str = $this->str_reverse($tmp_str);
        $this->str = $s1.$dest_str.$s2;
    }

   private function str_reverse($str)
    {
        $len = strlen($str);
      if($len%2 == 0)
            $times = $len/2;
        else
            $times = ($len-1)/2;

      for($i=0;$i<$times;$i++)
        {
            $t = $str[$len-1-$i];
            $str[$len-1-$i] = $str[$i];
            $str[$i] = $t;
        }

        return $str;
   }


}


$a = new TestKeenSting('ab');
$re = $a->run([[0,2],[1,3]]);
echo $re;

17,你作为一名出道的歌手终于要出自己的第一份专辑了，你计划收录 n 首歌而且每首歌的长度都是 s 秒，每首歌必须完整地收录于一张 CD 当中。每张 CD 的容量长度都是 L 秒，而且你至少得保证同一张 CD 内相邻两首歌中间至少要隔 1 秒。为了辟邪，你决定任意一张 CD 内的歌数不能被 13 这个数字整除，那么请问你出这张专辑至少需要多少张 CD ？

每组测试用例仅包含一组数据，每组数据第一行为三个正整数 n, s, L。 保证 n ≤ 100 , s ≤ L ≤ 10000

<?php

class TestKeenSting{
    private $song_num;
    private $song_size;
    private $cd_size;

    public function __construct($n,$s,$l)
    {
        if($n>100 || $s>$l)
            exit('input error!');
        $this->song_num = $n;
        $this->song_size = $s;
        $this->cd_size = $l;
    }


    public function run()
    {
        $cd_container = $this->calculate_single_cd();
        return ceil($this->song_num/$cd_container);
    }

    private function calculate_single_cd()
    {
        //假设一张cd可以放n个 song_length+1
        $n = floor($this->cd_size / ($this->song_size + 1));
        //对剩余空间做判断
        $gap = $this->cd_size - $n * ($this->song_size + 1);
        if($gap == $this->song_size)//剩余空间是否刚好可以放一首歌
            if($n!=12)//已经放了12首歌,不要这最后的一首
                $n += 1;
        else
            if($n == 13) //如果之前就已经可以放13首,放弃一首
                $n = 12;
        return $n;
    }



}


$a = new TestKeenSting(7,2,6);
$re = $a->run();
echo $re;

18 用PHP实现一个双向队列

<?php
    class Deque{
    private $queue=array();
    public function addFirst($item){
        return array_unshift($this->queue,$item);
    }

    public function addLast($item){
        return array_push($this->queue,$item);
    }
    public function removeFirst(){
        return array_shift($this->queue);
    }

    public function removeLast(){
        return array_pop($this->queue);
    }
}
?>

19 请使用冒泡排序法对以下一组数据进行排序10 2 36 14 10 25 23 85 99 45。

<?php
    // 冒泡排序
    function bubble_sort(&$arr){
        for ($i=0,$len=count($arr); $i < $len; $i++) {
            for ($j=1; $j < $len-$i; $j++) {
                if ($arr[$j-1] > $arr[$j]) {
                    $temp = $arr[$j-1];
                    $arr[$j-1] = $arr[$j];
                    $arr[$j] = $temp;
                }
            }
        }
    }

    // 测试
    $arr = array(10,2,36,14,10,25,23,85,99,45);
    bubble_sort($arr);
    print_r($arr);
?>

20 写出一种排序算法（要写出代码），并说出优化它的方法。

<?php
    //快速排序
    function partition(&$arr,$low,$high){
        $pivotkey = $arr[$low];
        while($low<$high){
            while($low < $high && $arr[$high] >= $pivotkey){
                $high--;
            }
            $temp = $arr[$low];
            $arr[$low] = $arr[$high];
            $arr[$high] = $temp;
            while($low < $high && $arr[$low] <= $pivotkey){
                $low++;
            }
            $temp=$arr[$low];
            $arr[$low]=$arr[$high];
            $arr[$high]=$temp;
        }
        return$low;
    }


function quick_sort(&$arr,$low,$high){
    if($low < $high){
        $pivot = partition($arr,$low,$high);
        quick_sort($arr,$low,$pivot-1);
        quick_sort($arr,$pivot+1,$high);
    }
}
?>

21 洗牌算法

<?php
    $card_num = 54;//牌数
    function wash_card($card_num){
        $cards = $tmp = array();
        for($i = 0;$i < $card_num;$i++){
            $tmp[$i] = $i;
        }

        for($i = 0;$i < $card_num;$i++){
            $index = rand(0,$card_num-$i-1);
            $cards[$i] = $tmp[$index];
            unset($tmp[$index]);
            $tmp = array_values($tmp);
        }
        return $cards;
    }
    // 测试：
    print_r(wash_card($card_num));
?>

【程序1】   题目：古典问题：有一对兔子，从出生后第3个月起每个月都生一对兔子，小兔子长到第四个月后每个月又生一对兔子，假如兔子都不死，问每个月的兔子总数为多少？   
1.程序分析：   兔子的规律为数列1,1,2,3,5,8,13,21....   
2  就是第三个数是前两个数字的和,既是经典的菲波那切数列

function actionFblist($n)
    {
        // 1,1,2,3,5,8,13
    // $n 为第n个月
        $arr = [1,1];
        if($n < 2)
            return false;


        for ($i=2;$i<=$n+1;$i++)
        {
            $arr[$i] = $arr[$i-1] + $arr[$i-2];
        }
        var_dump($arr);
        echo $arr[$n+1];
    }

    程序2】   题目：判断101-200之间有多少个素数，并输出所有素数。   
    1.程序分析：判断素数的方法：用一个数分别去除2到sqrt(这个数)，如果能被整除，   
    则表明此数不是素数，反之是素数。

    public function actionIsPrimeNumber()
{
    $arr = [];
    for ($i=101;$i<=200;$i++)
    {
        $flag = true;
        for ($j = 2;$j<=sqrt($i);$j++)
        {
            if($i % $j == 0)
            {
                $flag = false;
            }
        }

        if($flag == true)
            $arr[] = $i;
    }
    var_dump($arr);
}

程序3】   题目：打印出所有的 "水仙花数 "，所谓 "水仙花数 "是指一个三位数，其各位数字立方和等于该数本身。例如：153是一个 "水仙花数 "，因为153=1的三次方＋5的三次方＋3的三次方。   
1.程序分析：利用for循环控制100-999个数，每个数分解出个位，十位，百位。

public function actionWaterFlower()
{
    $re = [];
    for($i = 100;$i<= 999;$i++)
    {
        $hundred = floor($i / 100 );     // 获取百位数字
        $ten = floor(($i %100 ) / 10 );  // 获取十位数字
        $one = floor($i % 100 % 10);     // 获取各位数字

        if((pow($hundred,3)  + pow($ten,3) + pow($one,3) ) == $i )
        {
            $re[] = $i;
        }
    }
    var_dump($re);

}

【程序4】   题目：利用条件运算符的嵌套来完成此题：学习成绩> =90分的同学用A表示，60-89分之间的用B表示，60分以下的用C表示。   
1.程序分析：(a> b)?a:b这是条件运算符的基本例子。

public function actionGetScore()
{
    $score = 90;
    if($score <0 || $score > 100)
        return false;

    $re = $score >= 90 ? 'A' : ($score >= 60 ?  'B' :'C');
    var_dump($re);
}

程序5】   题目：求s=a+aa+aaa+aaaa+aa...a的值，其中a是一个数字。例如2+22+222+2222+22222(此时共有5个数相加)，几个数相加有键盘控制。   
1.程序分析：关键是循环获得计算出每一项的值。
2. 可以使用php的str_repeat函数

public function actionRepeatN()
    {
        $a = 8;
        $n = 8;
        $sum = 0;

        for ($i = 0;$i<$n;$i++)
        {
            $num = 0;
            for ($j = 0;$j<=$i;$j++)
            {
                $num += $a* pow(10,$j);
            }
            $sum += $num;
        }
        var_dump($sum);
    }

    【程序6】题目：一个整数，它加上100后是一个完全平方数，加上168又是一个完全平方数，请问该数是多少？   
    1.程序分析：在10万以内判断，先将该数加上100后再开方，再将该数加上268后再开方，如果开方后的结果满足如下条件，即是结果。请看具体分析：   
    
    刚开始不知道怎么判断一个数字是否为完全平方数,但是根据php的基本函数sqrt和pow可以间接进行判断
    
    若开方后进行取整再平方等于原数字,那么这个数字则为一个完全平方数,根据这个方法进行判断

    public function actionWhitchNum()
    {
        for ($i=1;$i<=100000;$i++)
        {
            if(pow((int)sqrt($i+100),2) == ($i+100) &&pow((int)sqrt($i+168),2) == ($i+168) )
            {
                echo $i;
            }
        }
        echo 'ok';
    }

    【程序7】 题目：输入某年某月某日，判断这一天是这一年的第几天？   
    1.程序分析：以3月5日为例，应该先把前两个月的加起来，然后再加上5天即本年的第几天，特殊情况，闰年且输入月份大于3时需考虑多加一天。   刚开始看这题以为有什么简单的方法,但是我没有想到,没有办法,只能用这种方法了

    public function actionToday()
{
    $today = '2018-03-05'; // 格式固定
    $days = explode('-',$today);
    $year = $days[0];
    $month = (int)$days[1];
    $day = (int)$days[2];

    // 判断是否为闰年
    $flag = false;
    if($year%400==0||($year%4==0&&$year%100!=0))
    {
        $flag = true;
    }

    // 对月份进行判断 1,3,5,7,8,10,12 为31天
    // 4,6,9,11 为30天
    // 2月份闰年为29天,否则为28天
    switch ($month)
    {
        case 1:
            $sum = 0;break;
        case 2:
            $sum = 31;break;
        case 3:
            $sum = 59;break;
        case 4:
            $sum=90;break;
        case 5:
            $sum=120;break;
        case 6:
            $sum=151;break;
        case 7:
            $sum=181;break;
        case 8:
            $sum=212;break;
        case 9:
            $sum=243;break;
        case 10:
            $sum=273;break;
        case 11:
            $sum=304;break;
        case 12:
            $sum=334;break;
        default:
            break;
    }

    $sum = $sum + $day;
    if($flag && $month>2)
        $sum = $sum + 1;

    var_dump($sum);

}

【程序8】 题目：输入三个整数x,y,z，请把这三个数由小到大输出。   
1.程序分析：我们想办法把最小的数放到x上，先将x与y进行比较，如果x> y则将x与y的值进行交换，然后再用x与z进行比较，如果x> z则将x与z的值进行交换，这样能使x最小。   

这里不把排序当做考察点,排序的话可以使用冒泡,快速,插入等排序算法,这里使用了三种交换变量的方式,我感觉这才是重要的

public function actionSortX()
{
    $x = 6;
    $y = 53;
    $z = 6;
    if($x>$y) // $y<$x
    {
        $x = $x+$y;
        $y = $x-$y;
        $x = $x-$y;
    }
    if($x>$z)
    {
        $tmp = $x;
        $x = $z;
        $z = $tmp;
    }

    if($y>$z)
    {
        $tmp = $y . '-' .$z;
        $tmp = explode('-',$tmp);
        $y = $tmp[1];
        $z = $tmp[0];
    }
    echo $x,',',$y,',',$z;
}

【程序9】 题目：输出9*9口诀。   
1.程序分析：分行与列考虑，共9行9列，i控制行，j控制列。 

public function actionMultiplicationTable()
{
    for ($i=1;$i<=9;$i++)
    {
        for ($j=1;$j<=$i;$j++)
        {
            echo $j . '*' .$i .'=' . $i*$j;
            echo ' ';
        }
        echo "<br>";
    }
}

【程序10】   题目：有一分数序列：2/1，3/2，5/3，8/5，13/8，21/13...求出这个数列的前20项之和。   
1.程序分析：请抓住分子与分母的变化规律。

public function actionAddFraction()
{
    $sum = 0;
    $numerator = [2,3];
    $denominator = [1,2];
    // 根据规律获得所有的分子和分母
    for ($i=2;$i<20;$i++)
    {
        $numerator[$i] = $numerator[$i-2] + $numerator[$i-1];
        $denominator[$i] = $denominator[$i-2] + $denominator[$i-1];
    }
    // 获得分数的前n项和
    for ($i=0;$i<20;$i++)
    {
        $sum += $numerator[$i] / $denominator[$i];
    }
    var_dump($sum);
}

【程序11】   题目：求1+2!+3!+...+20!的和   
1.程序分析：此程序只是把累加变成了累乘。

public function actionAddFactorial()
{
    $n = 20;
    $sum = 0;
    for ($i=1;$i<=$n;$i++)
    {
        $num = 1;
        for ($j=1;$j<=$i;$j++)
        {
            $num = $j*$num;
        }
        $sum += $num;
    }
    var_dump($sum);
}

【程序12】   题目：利用递归方法求5!。   
1.程序分析：递归公式：fn=fn_1*4!   

public function numFactorial($n)
{
    if($n>1)
        return $sum = $n * $this->numFactorial($n-1);   // 需要注意这点,若是写成函数要替换成函数形式
    else
        return $n;
}
public function actionNumFactorial()
{
    $n =4;
    $sum =  $this->numFactorial($n);                   // 调用上面的阶乘方法(函数)
}

【程序13】   题目：有5个人坐在一起，问第五个人多少岁？他说比第4个人大2岁。问第4个人岁数，他说比第3个人大2岁。问第三个人，又说比第2人大两岁。问第2个人，说比第一个人大两岁。最后问第一个人，他说是10岁。请问第五个人多大？   
1.程序分析：利用递归的方法，递归分为回推和递推两个阶段。要想知道第五个人岁数，需知道第四人的岁数，依次类推，推到第一人（10岁），再往回推。

public function myAge($n)
{
    if($n == 1)
        return $age = 10;
    else
        return 2 + $this->myAge($n-1);
}

public function actionMyAge1()
{
    $n = 5;
    echo $this->myAge($n);
}

【程序14】   题目：给一个不多于5位的正整数，要求：一、求它是几位数，二、逆序打印出各位数字。 

public function actionIntLength()
{
    $num = 1232345;
    $num = (string) $num;
    $length = strlen($num);
    $numstring = '';
    for ($i=$length-1;$i>=0;$i--)
    {
        $numstring .= $num[$i];
    }
    echo $numstring;
}

【程序15】   题目：一个5位数，判断它是不是回文数。即12321是回文数，个位与万位相同，十位与千位相同。   

public function actionIsPalindromeNumber()
{
    $num = 12321;
    $num = (string) $num;
    if($num[0] == $num[4] && $num[1] == $num[3])
        var_dump('Is Palindrome Number');
    else
        echo 'false';
}

/*
 * 找到所有的5位的回文数
 * */
public function actionAllPalindromeNumber()
{
    $result = [];
    for ($i=10000;$i<99999;$i++)
    {
        $i = (string) $i;
        if($i[0] == $i[4] && $i[1] == $i[3])
            $result[] = $i;
    }
    var_dump($result);
}
