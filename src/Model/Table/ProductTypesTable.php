<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductTypes Model
 *
 * @property \App\Model\Table\CustomerOrdersTable&\Cake\ORM\Association\HasMany $CustomerOrders
 * @property \App\Model\Table\OricohSeriesTable&\Cake\ORM\Association\HasMany $OricohSeries
 * @property \App\Model\Table\ProductTypeCustomerContactTable&\Cake\ORM\Association\HasMany $ProductTypeCustomerContact
 *
 * @method \App\Model\Entity\ProductType newEmptyEntity()
 * @method \App\Model\Entity\ProductType newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProductType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductType get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProductType findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProductType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProductType[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductType|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductType[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductType[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductType[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductType[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProductTypesTable extends Table
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

        $this->setTable('product_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('CustomerProducts', [
            'foreignKey' => 'product_type_id',
        ]);
        $this->hasMany('OricohSeries', [
            'foreignKey' => 'product_type_id',
        ]);
        $this->hasMany('ProductTypeCustomerContact', [
            'foreignKey' => 'product_type_id',
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
            ->allowEmptyString('name');

        $validator
            ->integer('sale_state_flg')
            ->allowEmptyString('sale_state_flg');

        return $validator;
    }
}
