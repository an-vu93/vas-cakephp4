<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PartnerPersons Model
 *
 * @method \App\Model\Entity\PartnerPerson newEmptyEntity()
 * @method \App\Model\Entity\PartnerPerson newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PartnerPerson[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PartnerPerson get($primaryKey, $options = [])
 * @method \App\Model\Entity\PartnerPerson findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PartnerPerson patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PartnerPerson[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PartnerPerson|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PartnerPerson saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PartnerPerson[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PartnerPerson[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PartnerPerson[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PartnerPerson[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PartnerPersonsTable extends Table
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

        $this->setTable('partner_persons');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->integer('relationship_id')
            ->requirePresence('relationship_id', 'create')
            ->notEmptyString('relationship_id');

        $validator
            ->scalar('position')
            ->maxLength('position', 255)
            ->allowEmptyString('position');

        $validator
            ->integer('use_flg')
            ->allowEmptyString('use_flg');

        $validator
            ->integer('order')
            ->allowEmptyString('order');

        $validator
            ->integer('partner_fixed')
            ->allowEmptyString('partner_fixed');

        return $validator;
    }
}
