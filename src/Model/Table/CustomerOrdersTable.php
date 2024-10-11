<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomerOrders Model
 *
 * @property \App\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 * @property \App\Model\Table\ProductTypesTable&\Cake\ORM\Association\BelongsTo $ProductTypes
 * @property \App\Model\Table\IndustriesTable&\Cake\ORM\Association\BelongsTo $Industries
 * @property \App\Model\Table\SubIndustriesTable&\Cake\ORM\Association\BelongsTo $SubIndustries
 *
 * @method \App\Model\Entity\CustomerOrder newEmptyEntity()
 * @method \App\Model\Entity\CustomerOrder newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CustomerOrder[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CustomerOrder get($primaryKey, $options = [])
 * @method \App\Model\Entity\CustomerOrder findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CustomerOrder patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CustomerOrder[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CustomerOrder|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CustomerOrder saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CustomerOrder[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CustomerOrder[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CustomerOrder[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CustomerOrder[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomerOrdersTable extends Table
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

        $this->setTable('customer_orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ProductTypes', [
            'foreignKey' => 'product_type_id',
            'joinType' => 'INNER',
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
            ->notEmptyString('customer_id');

        $validator
            ->integer('product_type_id')
            ->notEmptyString('product_type_id');

        $validator
            ->integer('industry_id')
            ->allowEmptyString('industry_id');

        $validator
            ->integer('sub_industry_id')
            ->allowEmptyString('sub_industry_id');

        $validator
            ->integer('cancel_flg')
            ->notEmptyString('cancel_flg');

        $validator
            ->integer('replace_flg')
            ->notEmptyString('replace_flg');

        $validator
            ->date('order_date')
            ->allowEmptyDate('order_date');

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
        $rules->add($rules->existsIn('product_type_id', 'ProductTypes'), ['errorField' => 'product_type_id']);
        $rules->add($rules->existsIn('industry_id', 'Industries'), ['errorField' => 'industry_id']);
        $rules->add($rules->existsIn('sub_industry_id', 'SubIndustries'), ['errorField' => 'sub_industry_id']);

        return $rules;
    }
}
