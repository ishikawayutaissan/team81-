<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class SendTestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     //配列の保護（クラス自身と親子関係にあるクラスのみアクセスが可能）
     protected $data;

     //__constructだと最初にここくる トークンを配列で入れておく
    public function __construct($data)
    {
        $this->data = $data;
    }


    
    /**
     * Build the message.
     *
     * @return $this
     */

     //メールで送る内容(本文のview,送り元,トークンの中身(URL),表題)
    public function build()
    {
        return $this  ->view('login.aplymail')
                      ->from('techis.team81@gmail.com','チーム81')
                      ->with($this->data)
                      ->subject('パスワード設定のご案内');
    }
}