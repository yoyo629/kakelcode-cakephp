<?php

namespace App\Controller;

use App\Controller\AppController;

use Cake\Auth\DefaultPasswordHasher; //added.

use Cake\Event\Event; //added

class AuctionBaseController extends AppController
{
    //初期化処理
    public function initialize()
    {
        parent::initialize();
        //必要なコンポーネントのロード
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'looutRedirect' => [
                'controller' => 'Users',
                'action' => 'logout'
            ],
            'authError' => 'ログインしてください',
        ]);
    }

    //ログイン処理
    function login()
    {
        //post時の処理
        if ($this->request->isPost()) {
            $user = $this->Auth->identify();
            //Authのidentifyをユーザーに設定
            if (!empty($user)) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('ユーザー名かパスワードがまちがっています。');
        }
    }
    //ログアウト処理
    public function logout()
    {
        //セッションを破壊
        $this->request->session()->destroy();
        return $this->redirect($this->Auth->logout());
    }

    //認証をしないページの設定 
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow([]);
    }

    //認証時のロールの処理
    public function isAuthorized($user = null)
    {
        //管理者はtrue
        if ($user['role'] === 'admin') {
            return true;
        }
        //一般ユーザーはAuctionControllerのみtrue、他はfalse
        if ($user['role'] === 'user') {
            if ($this->name == 'Auction') {
                return true;
            }
        }
        //その他は全てfalse
        return false;
    }
}
