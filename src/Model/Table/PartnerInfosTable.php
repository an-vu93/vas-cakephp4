<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PartnerInfos Model
 *
 * @property \App\Model\Table\PrefecturesTable&\Cake\ORM\Association\BelongsTo $Prefectures
 * @property \App\Model\Table\PartnerInfosTable&\Cake\ORM\Association\BelongsTo $ParentPartnerInfos
 * @property \App\Model\Table\PartnerInfosTable&\Cake\ORM\Association\HasMany $ChildPartnerInfos
 *
 * @method \App\Model\Entity\PartnerInfo newEmptyEntity()
 * @method \App\Model\Entity\PartnerInfo newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PartnerInfo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PartnerInfo get($primaryKey, $options = [])
 * @method \App\Model\Entity\PartnerInfo findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PartnerInfo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PartnerInfo[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PartnerInfo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PartnerInfo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PartnerInfo[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PartnerInfo[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PartnerInfo[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PartnerInfo[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PartnerInfosTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('partner_infos');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Prefectures', [
            'foreignKey' => 'prefectures_id',
        ]);
        $this->belongsTo('ParentPartnerInfos', [
            'className' => 'PartnerInfos',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ChildPartnerInfos', [
            'className' => 'PartnerInfos',
            'foreignKey' => 'parent_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('parent')
            ->maxLength('parent', 255)
            ->requirePresence('parent', 'create')
            ->notEmptyString('parent');

        $validator
            ->integer('type')
            ->notEmptyString('type');

        $validator
            ->integer('prefectures_id')
            ->allowEmptyString('prefectures_id');

        $validator
            ->integer('area_id')
            ->notEmptyString('area_id');

        $validator
            ->integer('manager_id')
            ->notEmptyString('manager_id');

        $validator
            ->integer('order')
            ->notEmptyString('order');

        $validator
            ->integer('order_area')
            ->notEmptyString('order_area');

        $validator
            ->scalar('store_id')
            ->maxLength('store_id', 255)
            ->allowEmptyString('store_id');

        $validator
            ->integer('parent_partner_id')
            ->notEmptyString('parent_partner_id');

        $validator
            ->integer('use_flg')
            ->notEmptyString('use_flg');

        $validator
            ->scalar('remark')
            ->allowEmptyString('remark');

        $validator
            ->scalar('group_name')
            ->maxLength('group_name', 255)
            ->allowEmptyString('group_name');

        $validator
            ->integer('parent_id')
            ->notEmptyString('parent_id');

        $validator
            ->integer('branch_flg')
            ->notEmptyString('branch_flg');

        $validator
            ->integer('store_genre')
            ->allowEmptyString('store_genre');

        $validator
            ->scalar('sales_store_person')
            ->allowEmptyString('sales_store_person');

        $validator
            ->integer('most_parent_partner_id')
            ->allowEmptyString('most_parent_partner_id');

        $validator
            ->integer('ranking_flg')
            ->allowEmptyString('ranking_flg');

        $validator
            ->integer('partner_fixed')
            ->allowEmptyString('partner_fixed');

        $validator
            ->integer('del_flg')
            ->allowEmptyString('del_flg');

        $validator
            ->scalar('chief_name')
            ->maxLength('chief_name', 255)
            ->allowEmptyString('chief_name');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('prefectures_id', 'Prefectures'), ['errorField' => 'prefectures_id']);
        $rules->add($rules->existsIn('parent_id', 'ParentPartnerInfos'), ['errorField' => 'parent_id']);

        return $rules;
    }
}
