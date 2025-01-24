<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\EventInterface;
use Cake\Event\EventManager;
use App\Service\ScoringService;

/**
 * Indicators Model
 *
 * @property \App\Model\Table\CustomerScoresTable&\Cake\ORM\Association\HasMany $CustomerScores
 * @property \App\Model\Table\IndicatorWeightsTable&\Cake\ORM\Association\HasMany $IndicatorWeights
 *
 * @method \App\Model\Entity\Indicator newEmptyEntity()
 * @method \App\Model\Entity\Indicator newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Indicator[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Indicator get($primaryKey, $options = [])
 * @method \App\Model\Entity\Indicator findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Indicator patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Indicator[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Indicator|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Indicator saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Indicator[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Indicator[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Indicator[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Indicator[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class IndicatorsTable extends Table
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

        $this->setTable('indicators');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('CustomerScores', [
            'foreignKey' => 'indicator_id',
        ]);
        $this->hasMany('IndicatorWeights', [
            'foreignKey' => 'indicator_id',
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
            ->scalar('query')
            ->allowEmptyString('query');

        $validator
            ->integer('active')
            ->notEmptyString('active');

        $validator
            ->integer('percentile_20')
            ->notEmptyString('percentile_20');

        $validator
            ->integer('percentile_40')
            ->notEmptyString('percentile_40');

        $validator
            ->integer('percentile_60')
            ->notEmptyString('percentile_60');

        $validator
            ->integer('percentile_80')
            ->notEmptyString('percentile_80');

        return $validator;
    }

    public function afterSave(EventInterface $event, $entity, $options)
    {
        // Skip if this is triggered by the scoring service itself
        if (isset($options['skipScoring']) && $options['skipScoring'] === true) {
            dd("skipped");
            return;
        }

        // Only update scores if the indicator is active and relevant fields have changed
        $relevantFields = ['query', 'active', 'percentile_20', 'percentile_40', 
                          'percentile_60', 'percentile_80'];
        
        $shouldUpdateScores = $entity->active &&
            ($entity->isNew() || array_intersect($relevantFields, $entity->getDirty()));
        
        if ($shouldUpdateScores) {
            try {
                $scoringService = new ScoringService();

                $scoringService->updateScorePerIndicator($entity->id);
               
            } catch (\Exception $e) {
                // Log the error but don't prevent the save
                \Cake\Log\Log::error('Failed to update scores for indicator ' . $entity->id . ': ' . $e->getMessage());
                
                throw new RuntimeException('Failed to update indicator scores: ' . $e->getMessage());
            }
        }
    }
}
