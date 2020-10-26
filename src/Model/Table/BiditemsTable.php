<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Biditems Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\BidinfoTable&\Cake\ORM\Association\HasMany $Bidinfo
 * @property \App\Model\Table\BidrequestsTable&\Cake\ORM\Association\HasMany $Bidrequests
 *
 * @method \App\Model\Entity\Biditem get($primaryKey, $options = [])
 * @method \App\Model\Entity\Biditem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Biditem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Biditem|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Biditem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Biditem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Biditem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Biditem findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BiditemsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('biditems');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasOne('Bidinfo', [
            'foreignKey' => 'biditem_id',
        ]);
        $this->hasMany('Bidrequests', [
            'foreignKey' => 'biditem_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('item_detail')
            ->maxLength('item_detail', 1000)
            ->requirePresence('item_detail', 'create')
            ->notempty('item_detail');

        $validator
            ->requirePresence('item_image', 'create')
            ->notEmpty('item_image', '画像をアップロードしてください')
            ->add('item_image', 'custom', [
                'rule' => [$this, 'file_check'],
                'message' => '不正な拡張子です。ファイルを確認してください'
            ]);

        $validator
            ->boolean('finished')
            ->requirePresence('finished', 'create')
            ->notEmptyString('finished');

        $validator
            ->dateTime('endtime')
            ->requirePresence('endtime', 'create')
            ->notEmptyDateTime('endtime');

        return $validator;
    }

    //　アップロードファイルの拡張子チェック
    public function file_check($value, $context)
    {
        //boolで返さないとエラー
        return (bool) preg_match('/\.png$|\.jpg$|\.jpeg$/', $value);
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
