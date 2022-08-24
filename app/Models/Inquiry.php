<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','name','tel','email','support','detail','supporter_id','reply','status','note'];

    /**
    * 
    * @var array
    */
    


    /* サポート内容のデータベース化 */
    
    const SUPPORT_ITEM = [
        "1" => "サーバ・ネットワークに関する設定変更",
        "2" => "OS・ミドルウェアに関する設定変更",
        "3" => "バックアップリストア",
        "4" => "リストア",
        "5" => "サーバのスケール調整",
        "6" => "その他"
    ];
      
    /**
     * お問い合わせデータを保持するユーザーの取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * ステータスの表記  
     */
    public static function  getStatus($status){
        $message = "";
        switch($status) {
            case 2:
                $message = "対応中";
                break;
            case 3:
                $message = "保  留";
                break;
            case 4:
                $message = "対応済";
                break;
            default:
                $message = "未対応";
                break;
            }
            return $message;
    }
}