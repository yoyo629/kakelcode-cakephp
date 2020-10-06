<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class MessagesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->setDisplayField('message');
        $this->belongsTo('People');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->integer('person_id', 'person idは整数で入力してください')
            ->notEmpty('person_id', 'person idは必ず記入してください');

        $validator
            ->scalar('message', 'テキストを入力ください')
            ->requirePresence('message', 'create')
            ->notEmpty('message', 'メッセージは必ず記入してください');

        return $validator;
    }
}
