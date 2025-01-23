<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Corporations Model
 *
 * @method \App\Model\Entity\Corporation newEmptyEntity()
 * @method \App\Model\Entity\Corporation newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Corporation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Corporation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Corporation findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Corporation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Corporation[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Corporation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Corporation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Corporation[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Corporation[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Corporation[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Corporation[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CorporationsTable extends Table
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

        $this->setTable('corporations');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->allowEmptyString('corporate_number')
            ->add('corporate_number', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('process')
            ->allowEmptyString('process');

        $validator
            ->scalar('correction')
            ->allowEmptyString('correction');

        $validator
            ->date('update_date')
            ->allowEmptyDate('update_date');

        $validator
            ->date('change_date')
            ->allowEmptyDate('change_date');

        $validator
            ->scalar('name')
            ->maxLength('name', 150)
            ->allowEmptyString('name');

        $validator
            ->nonNegativeInteger('name_image_id')
            ->allowEmptyFile('name_image_id');

        $validator
            ->scalar('kind')
            ->allowEmptyString('kind');

        $validator
            ->scalar('prefecture_name')
            ->maxLength('prefecture_name', 10)
            ->allowEmptyString('prefecture_name');

        $validator
            ->scalar('city_name')
            ->maxLength('city_name', 20)
            ->allowEmptyString('city_name');

        $validator
            ->scalar('street_number')
            ->maxLength('street_number', 300)
            ->allowEmptyString('street_number');

        $validator
            ->nonNegativeInteger('address_image_id')
            ->allowEmptyFile('address_image_id');

        $validator
            ->scalar('prefecture_code')
            ->maxLength('prefecture_code', 2)
            ->allowEmptyString('prefecture_code');

        $validator
            ->scalar('city_code')
            ->maxLength('city_code', 3)
            ->allowEmptyString('city_code');

        $validator
            ->scalar('postal_code')
            ->maxLength('postal_code', 7)
            ->allowEmptyString('postal_code');

        $validator
            ->scalar('address_outside')
            ->maxLength('address_outside', 300)
            ->allowEmptyString('address_outside');

        $validator
            ->nonNegativeInteger('address_outside_image_id')
            ->allowEmptyFile('address_outside_image_id');

        $validator
            ->date('close_date')
            ->allowEmptyDate('close_date');

        $validator
            ->scalar('close_cause')
            ->allowEmptyString('close_cause');

        $validator
            ->allowEmptyString('successor_corporate_number');

        $validator
            ->scalar('change_cause')
            ->maxLength('change_cause', 500)
            ->allowEmptyString('change_cause');

        $validator
            ->date('assignment_date')
            ->allowEmptyDate('assignment_date');

        $validator
            ->scalar('is_latest')
            ->allowEmptyString('is_latest');

        $validator
            ->scalar('en_name')
            ->maxLength('en_name', 300)
            ->allowEmptyString('en_name');

        $validator
            ->scalar('en_prefecture_name')
            ->maxLength('en_prefecture_name', 9)
            ->allowEmptyString('en_prefecture_name');

        $validator
            ->scalar('en_city_name')
            ->maxLength('en_city_name', 600)
            ->allowEmptyString('en_city_name');

        $validator
            ->scalar('en_address_outside')
            ->maxLength('en_address_outside', 600)
            ->allowEmptyString('en_address_outside');

        $validator
            ->scalar('furigana')
            ->maxLength('furigana', 500)
            ->allowEmptyString('furigana');

        $validator
            ->scalar('exclude_from_search')
            ->allowEmptyString('exclude_from_search');

        $validator
            ->scalar('hw_business_number')
            ->maxLength('hw_business_number', 15)
            ->allowEmptyString('hw_business_number');

        $validator
            ->integer('number_of_employees')
            ->allowEmptyString('number_of_employees');

        $validator
            ->scalar('homepage')
            ->maxLength('homepage', 255)
            ->allowEmptyString('homepage');

        $validator
            ->allowEmptyString('capital');

        $validator
            ->allowEmptyString('revenue');

        $validator
            ->scalar('revenue_year')
            ->maxLength('revenue_year', 30)
            ->allowEmptyString('revenue_year');

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
        $rules->add($rules->isUnique(['corporate_number'], ['allowMultipleNulls' => true]), ['errorField' => 'corporate_number']);

        return $rules;
    }

    /**
     * Returns the database connection name to use by default.
     *
     * @return string
     */
    public static function defaultConnectionName(): string
    {
        return 'corporate_db';
    }
}
