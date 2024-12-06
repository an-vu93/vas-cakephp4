<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomerProfiles Model
 *
 * @property \App\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 * @property \App\Model\Table\PrefecturesTable&\Cake\ORM\Association\BelongsTo $Prefectures
 *
 * @method \App\Model\Entity\CustomerProfile newEmptyEntity()
 * @method \App\Model\Entity\CustomerProfile newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CustomerProfile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CustomerProfile get($primaryKey, $options = [])
 * @method \App\Model\Entity\CustomerProfile findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CustomerProfile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CustomerProfile[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CustomerProfile|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CustomerProfile saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CustomerProfile[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CustomerProfile[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CustomerProfile[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CustomerProfile[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomerProfilesTable extends Table
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

        $this->setTable('customer_profiles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
        ]);
        $this->belongsTo('Prefectures', [
            'foreignKey' => 'prefecture_id',
        ]);
        $this->belongsTo('Industries', [
            'foreignKey' => 'industry_id',
        ]);
        $this->belongsTo('SubIndustries', [
            'foreignKey' => 'sub_industry_id',
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
            ->integer('customer_id')
            ->allowEmptyString('customer_id');

        $validator
            ->integer('corporate_number')
            ->allowEmptyString('corporate_number');

        $validator
            ->integer('hw_business_number')
            ->allowEmptyString('hw_business_number');

        $validator
            ->integer('employee_number')
            ->allowEmptyString('employee_number');

        $validator
            ->integer('capital')
            ->allowEmptyString('capital');

        $validator
            ->integer('revenue')
            ->allowEmptyString('revenue');

        $validator
            ->integer('recruiting_flg')
            ->allowEmptyString('recruiting_flg');

        $validator
            ->integer('ignore_flg')
            ->allowEmptyString('ignore_flg');

        $validator
            ->scalar('remark')
            ->allowEmptyString('remark');

        $validator
            ->integer('prefecture_id')
            ->allowEmptyString('prefecture_id');

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
        $rules->add($rules->existsIn('customer_id', 'Customers'), ['errorField' => 'customer_id']);
        $rules->add($rules->existsIn('prefecture_id', 'Prefectures'), ['errorField' => 'prefecture_id']);

        return $rules;
    }
}
