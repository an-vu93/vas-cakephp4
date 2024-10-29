<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomerMetrics Model
 *
 * @property \App\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 *
 * @method \App\Model\Entity\CustomerMetric newEmptyEntity()
 * @method \App\Model\Entity\CustomerMetric newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CustomerMetric[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CustomerMetric get($primaryKey, $options = [])
 * @method \App\Model\Entity\CustomerMetric findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CustomerMetric patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CustomerMetric[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CustomerMetric|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CustomerMetric saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CustomerMetric[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CustomerMetric[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CustomerMetric[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CustomerMetric[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomerMetricsTable extends Table
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

        $this->setTable('customer_metrics');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER',
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
            ->notEmptyString('customer_id');

        $validator
            ->dateTime('first_order_date')
            ->allowEmptyDateTime('first_order_date');

        $validator
            ->dateTime('last_order_date')
            ->allowEmptyDateTime('last_order_date');

        $validator
            ->integer('order_count')
            ->allowEmptyString('order_count');

        $validator
            ->integer('oricoh_license_count')
            ->allowEmptyString('oricoh_license_count');

        $validator
            ->integer('other_license_count')
            ->allowEmptyString('other_license_count');

        $validator
            ->integer('in_contact_count')
            ->allowEmptyString('in_contact_count');

        $validator
            ->integer('out_contact_count')
            ->allowEmptyString('out_contact_count');

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

        return $rules;
    }
}
