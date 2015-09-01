<?php

use Doctrine\ORM\Mapping\ClassMetadataInfo;

$metadata->setInheritanceType(ClassMetadataInfo::INHERITANCE_TYPE_NONE);
$metadata->setChangeTrackingPolicy(ClassMetadataInfo::CHANGETRACKING_DEFERRED_IMPLICIT);
$metadata->mapField(array(
   'fieldName' => 'id',
   'type' => 'integer',
   'id' => true,
   'columnName' => 'id',
  ));
$metadata->mapField(array(
   'columnName' => 'titol',
   'fieldName' => 'titol',
   'type' => 'string',
   'length' => 255,
  ));
$metadata->mapField(array(
   'columnName' => 'nomautor',
   'fieldName' => 'nomautor',
   'type' => 'string',
   'length' => '20',
  ));
$metadata->mapField(array(
   'columnName' => 'cognomautor',
   'fieldName' => 'cognomautor',
   'type' => 'string',
   'length' => '20',
  ));
$metadata->mapField(array(
   'columnName' => 'redaccio',
   'fieldName' => 'redaccio',
   'type' => 'date',
  ));
$metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_AUTO);