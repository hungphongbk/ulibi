<?php

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Article')->delete();
        Article::create(array(
            'user_id'                   => 1,
            'article_like'              => 2,
            'article_title'             => 'Lorem ipsum dolor sit amet',
            'article_content'           => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
            dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
            mollit anim id est laborum",
            'article_date'              => new DateTime('2014-12-18'),
            'view'                      => 1000
        ));
        Article::create(array(
            'user_id'                   => 1,
            'article_like'              => 5,
            'article_title'             => '腠 慛慖 枲柊氠 娞弳弰',
            'article_content'           => "腠 慛慖 枲柊氠 娞弳弰, 漊煻獌 棰椻楒 鑏鑆驈 蒛 蓩蔮, 彔抳抰 戫摴撦 烳牼翐 嫫嵾 鉾 忁曨曣 捘栒毤 娞弳弰 賗 魡鳱 簥翷 耏胠臿 椸楢楩 緷, 璻甔 殠 嬽巃攇 擙樲橚 焟硱筎 鳭 璸瓁穟 忣抏旲 棳棔欿 駔鳿, 嬃 韰頯 肵苂苃 莃荶衒 榓甂睮",
            'article_date'              => new DateTime('2013-12-18'),
            'view'                      => 1200
        ));
        Article::create(array(
            'user_id'                   => 2,
            'article_like'              => 3,
            'article_title'             => 'Lorem ipsum dolor',
            'article_content'           => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum",
            'article_date'              => new DateTime('2014-08-18'),
            'view'                      => 100
        ));
        Article::create(array(
            'user_id'                   => 2,
            'article_like'              => 51,
            'article_title'             => 'とぴゅ盤 䤦䋨榚リュい',
            'article_content'           => "とぴゅ盤 䤦䋨榚リュい つ楥饺䰩みゅ ぷ䥞きょ棃覥 䨩蝣, 駧みょ 馜禤㤣 禞穯ずづビャ 簥ゞヘ䦤饪, シュ簯を さ饜 ツど䨩蝣チ 堦まが獧ゐ な障 骦僯楌だる 覟や餣㛤㠯 功壃廦, ぎ祟もりょ绣 䨵れぱ楯め 矩ぴ儥鄤ヅ すふ䏤 ふ䏤 觃槞饵功壃 ぢゅ润セファ趣 䰩みゅ 馜禤㤣, 禞穯ず 廩す 䤦䋨榚リュい 馜禤㤣杧ぐ 襟のよ覌矤 饟ピ期 な障 椧にゅグァごシュ 壪ちょ馨盨㛥 矩ぴ儥鄤ヅ, 楣饥しょ查に 	てあ焨䨣ぎゃ とぴゅ盤む鍯 ちゃにゃしゃ 禧氧, 蟤秵 趣矩ぴ 簯をおびょく つ楥饺䰩みゅ や餣 穟っ䶥 骦僯楌だる 窨極億䦌諥 韩獤ひ埩苦 䦌諥 饺䰩みゅ 誧ヴョ䦞襨µ 堦まが獧ゐ, のよ 廦饟ピ期ぎょ 	てあ焨䨣ぎゃ 駧みょ嶥りゅ裌 びゅんゆ",
            'article_date'              => new DateTime('2014-08-18'),
            'view'                      => 634
        ));
    }
}
