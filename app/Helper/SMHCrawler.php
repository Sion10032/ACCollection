<?php

namespace App\Helper;

use QL\QueryList;

class SMHCrawer
{
    // 看漫画爬虫

    // LZString.js 用于解密数据
    private static $LZS = 'var LZString=(function(){var f=String.fromCharCode;var keyStrBase64="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";var baseReverseDic={};function getBaseValue(alphabet,character){if(!baseReverseDic[alphabet]){baseReverseDic[alphabet]={};for(var i=0;i<alphabet.length;i++){baseReverseDic[alphabet][alphabet.charAt(i)]=i}}return baseReverseDic[alphabet][character]}var LZString={decompressFromBase64:function(input){if(input==null)return"";if(input=="")return null;return LZString._0(input.length,32,function(index){return getBaseValue(keyStrBase64,input.charAt(index))})},_0:function(length,resetValue,getNextValue){var dictionary=[],next,enlargeIn=4,dictSize=4,numBits=3,entry="",result=[],i,w,bits,resb,maxpower,power,c,data={val:getNextValue(0),position:resetValue,index:1};for(i=0;i<3;i+=1){dictionary[i]=i}bits=0;maxpower=Math.pow(2,2);power=1;while(power!=maxpower){resb=data.val&data.position;data.position>>=1;if(data.position==0){data.position=resetValue;data.val=getNextValue(data.index++)}bits|=(resb>0?1:0)*power;power<<=1}switch(next=bits){case 0:bits=0;maxpower=Math.pow(2,8);power=1;while(power!=maxpower){resb=data.val&data.position;data.position>>=1;if(data.position==0){data.position=resetValue;data.val=getNextValue(data.index++)}bits|=(resb>0?1:0)*power;power<<=1}c=f(bits);break;case 1:bits=0;maxpower=Math.pow(2,16);power=1;while(power!=maxpower){resb=data.val&data.position;data.position>>=1;if(data.position==0){data.position=resetValue;data.val=getNextValue(data.index++)}bits|=(resb>0?1:0)*power;power<<=1}c=f(bits);break;case 2:return""}dictionary[3]=c;w=c;result.push(c);while(true){if(data.index>length){return""}bits=0;maxpower=Math.pow(2,numBits);power=1;while(power!=maxpower){resb=data.val&data.position;data.position>>=1;if(data.position==0){data.position=resetValue;data.val=getNextValue(data.index++)}bits|=(resb>0?1:0)*power;power<<=1}switch(c=bits){case 0:bits=0;maxpower=Math.pow(2,8);power=1;while(power!=maxpower){resb=data.val&data.position;data.position>>=1;if(data.position==0){data.position=resetValue;data.val=getNextValue(data.index++)}bits|=(resb>0?1:0)*power;power<<=1}dictionary[dictSize++]=f(bits);c=dictSize-1;enlargeIn--;break;case 1:bits=0;maxpower=Math.pow(2,16);power=1;while(power!=maxpower){resb=data.val&data.position;data.position>>=1;if(data.position==0){data.position=resetValue;data.val=getNextValue(data.index++)}bits|=(resb>0?1:0)*power;power<<=1}dictionary[dictSize++]=f(bits);c=dictSize-1;enlargeIn--;break;case 2:return result.join("")}if(enlargeIn==0){enlargeIn=Math.pow(2,numBits);numBits++}if(dictionary[c]){entry=dictionary[c]}else{if(c===dictSize){entry=w+w.charAt(0)}else{return null}}result.push(entry);dictionary[dictSize++]=w+entry.charAt(0);enlargeIn--;w=entry;if(enlargeIn==0){enlargeIn=Math.pow(2,numBits);numBits++}}}};return LZString})();String.prototype.splic=function(f){return LZString.decompressFromBase64(this).split(f)};';

    // 看漫画网址
    private static $site = 'https://www.manhuagui.com';

    public static function search($name)
    {
        $url = self::$site . '/s/' . urlencode($name) . '_p1.html';
        $html = QueryList::get($url);

        // 获取结果总数
        $CountRule = array('res' => array('div.result-count>strong', 'html'));
        $resultCount = $html->rules($CountRule)->queryData()[1]['res'];

        $books = [];

        // 循环获取所有结果
        for($p = 1; count($books) < $resultCount; $p++){
            $url = self::$site . '/s/' . urlencode($name) . '_p' . $p . '.html';
            if($p != 1) $html = QueryList::get($url);

            $booksLi = $html->rules(array('html' => array('li.cf', 'html')))->query()->getData();

            $BookInfoRule = array(
                'name' => array('a.bcover', 'title'),
                'bid' => array('a.bcover', 'href')
            );

            foreach($booksLi as $book){
                $tmp = QueryList::html($book["html"])->rules($BookInfoRule)->queryData()[0];
                $tmp['bid'] = str_replace('comic', '', $tmp['bid']);
                $tmp['bid'] = str_replace('/', '', $tmp['bid']);
                array_push($books, $tmp);
            }
        }
        
        return json_encode($books, JSON_UNESCAPED_UNICODE);
    }

    public static function book($bid)
    {
        $url = self::$site . '/comic/' . $bid . '/';
        $html = QueryList::get($url);

        $book = [];
        $book['bid'] = $bid;
        $book['name'] = $html->rules(array(array("div>h1", "text")))->queryData()[0][0];
        $book['intro'] = $html->rules(array(array("div#intro-cut", "text")))->queryData()[0][0];
        $book['dir'] = [];

        // 获取目录
        $menu = $html->rules(array(
            "cateName" => array("h4>span", "text"),
            "cateMenu" => array("#chapter-list-0, #chapter-list-1", "html")
        ))->queryData();

        foreach($menu as $menuItem){
            $menulist = QueryList::html($menuItem['cateMenu'])
                ->rules(array(
                    'name' => array('ul>li>a', 'title'),
                    'cid' => array("ul>li>a", 'href'),
                    'page' => array('ul>li>a>span>i', 'text')
                ))->queryData();
            
            for($i = 0; $i < count($menulist); $i++){
                preg_match('~(?<=/comic/).*?(?=.html)~', $menulist[$i]['cid'], $matches);
                $menulist[$i]['cid'] = explode('/', $matches[0])[1];
                $menulist[$i]['page'] = str_replace('p', '', $menulist[$i]['page']);
            }

            array_push($book['dir'], array('cateName' => $menuItem['cateName'], 'cateMenu' => $menulist));
        }

        return json_encode($book, JSON_UNESCAPED_UNICODE);
    }

    public static function chapter($bid, $cid)
    {
        $url = self::$site . '/comic/' . $bid . '/' . $cid . '.html';
        $html = QueryList::get($url);
        $data_json = $html->rules(array('js' => array('body>script:not(:empty)', 'text')))->queryData()[0];

        $js = str_replace('window["\x65\x76\x61\x6c"](', 'var res = ', $data_json['js']);
        $js = str_replace('{}))', '{}); console.log(res);', $js);
        $js = str_replace('c35?', 'c<a?"":e(parseInt(c/a)))+((c=c%a)>35?', $js);
        $js = self::$LZS . $js;
        
        $fileName = 'cache/tmp.js';
        $tmpFile = fopen($fileName, 'w');
        fwrite($tmpFile, $js);
        fclose($tmpFile);
        
        $decyptionJsonData = exec('node ' . $fileName);
        $decyptionJsonData = str_replace('SMH.imgData(', '', $decyptionJsonData);
        $decyptionJsonData = str_replace(').preInit();', '', $decyptionJsonData);
        $json = json_decode($decyptionJsonData, true);

        $pics = [];
        $pics['path'] = 'https://i.hamreus.com' . $json['path'];
        $pics['file'] = [];
        $pics['parm'] = "?cid=" . $json['cid'] . '&md5=' . $json['sl']['md5'];
        foreach($json['files'] as $file)
            array_push($pics['file'], $file);

        return str_replace("\\/", "/", json_encode($pics, JSON_UNESCAPED_UNICODE));
    }

    public static function latest()
    {
        $url = self::$site . '/update/';
        $html = QueryList::get($url);

        $books = $html->rules(array(
            "name" => array('a.cover', 'title'),
            "bid" => array('a.cover', 'href')
        ))->queryData();

        foreach ($books as &$book) {
            $book['bid'] = str_replace('comic', '', $book['bid']);
            $book['bid'] = str_replace('/', '', $book['bid']);
        }

        return json_encode($books, JSON_UNESCAPED_UNICODE);
    }

    public static function hots()
    {
        $url = self::$site . '/rank/month.html';
        $html = QueryList::get($url);

        $books = $html->rules(array(
            "name" => array('tr>td.rank-title>h5>a', 'text'),
            "bid" => array('tr>td.rank-title>h5>a', 'href')
        ))->queryData();

        foreach ($books as &$book) {
            $book['bid'] = str_replace('comic', '', $book['bid']);
            $book['bid'] = str_replace('/', '', $book['bid']);
        }

        return json_encode($books, JSON_UNESCAPED_UNICODE);
    }

    private static function getHtml($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $html = curl_exec($curl);
        curl_close($curl);

        return $html;
    }
}
