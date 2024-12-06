<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SubIndustries Model
 *
 * @property \App\Model\Table\CustomerOrdersTable&\Cake\ORM\Association\HasMany $CustomerOrders
 *
 * @method \App\Model\Entity\SubIndustry newEmptyEntity()
 * @method \App\Model\Entity\SubIndustry newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SubIndustry[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SubIndustry get($primaryKey, $options = [])
 * @method \App\Model\Entity\SubIndustry findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SubIndustry patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SubIndustry[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SubIndustry|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SubIndustry saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SubIndustry[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SubIndustry[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SubIndustry[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SubIndustry[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SubIndustriesTable extends Table
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

        $this->setTable('sub_industries');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Industries', [
            'foreignKey' => 'industry_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('CustomerOrders', [
            'foreignKey' => 'sub_industry_id',
        ]);
        $this->hasMany('CustomerProfiles', [
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        $validator
            ->integer('order')
            ->notEmptyString('order');

        $validator
            ->integer('industry_id')
            ->notEmptyString('industry_id');

        $validator
            ->integer('modified_id')
            ->notEmptyString('modified_id');

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
        $rules->add($rules->existsIn('industry_id', 'Industries'), ['errorField' => 'industry_id']);

        return $rules;
    }
}
