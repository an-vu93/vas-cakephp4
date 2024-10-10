<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Analyses Model
 *
 * @property \App\Model\Table\IndicatorWeightsTable&\Cake\ORM\Association\HasMany $IndicatorWeights
 *
 * @method \App\Model\Entity\Analysis newEmptyEntity()
 * @method \App\Model\Entity\Analysis newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Analysis[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Analysis get($primaryKey, $options = [])
 * @method \App\Model\Entity\Analysis findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Analysis patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Analysis[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Analysis|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Analysis saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Analysis[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Analysis[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Analysis[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Analysis[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AnalysesTable extends Table
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

        $this->setTable('analyses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('IndicatorWeights', [
            'foreignKey' => 'analysis_id',
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
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->integer('public_flg')
            ->notEmptyString('public_flg');

        return $validator;
    }
}
