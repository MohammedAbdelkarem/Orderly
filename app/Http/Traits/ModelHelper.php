<?php

namespace App\Http\Traits;

use App\Constants\ApiMessages;
use App\Http\Traits\ApiResponder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait ModelHelper
{
    public static function findByIdOrFail($model, $modelId, $type = 'male', $resource, $withTrashed = false, $with = [], $selectedColumns = null)
    {
        $modelInstance = null;
        $query = $withTrashed ? $model::withTrashed() : $model::query();

        if (isset($selectedColumns)) {
            $query->select($selectedColumns);
        }

        if (!empty($with)) {
            $query->with($with);
        }

        $modelInstance = $query->find($modelId);

        if (!$modelInstance) {
            $notFoundMessage = '';
            if ($type == 'female') {
                $notFoundMessage = ApiMessages::MSG_NOT_FOUNDF;
            } else {
                $notFoundMessage = ApiMessages::MSG_NOT_FOUND;
            }
            return ApiResponder::notFoundResourceResponse([], __($notFoundMessage, ['resource' => __($resource)]));
        }
        return $modelInstance;
    }


    public static function getModelInstancesDependingOnIds($model, $modelIds)
    {
        $modelInstances = collect();
        foreach ($modelIds as $modelId) {
            $modelInstance = $model::find($modelId);
            $modelInstances->push($modelInstance);
        }

        return $modelInstances;
    }

    public static function updateMediaAssociation($fromModelType, $toModelType,  $fromModelId, $toModelId)
    {
        // Retrieve media records for join request
        $fromMedia = Media::where('model_id', $fromModelId)
            ->where('model_type', $fromModelType)
            ->get();

        // Update model_id and model_type to reflect new captain model
        foreach ($fromMedia as $media) {
            $media->model_id = $toModelId;
            $media->model_type = $toModelType;
            $media->save();
        }
    }


    //morph type and morph value is for the morphable_type column in the table , the morphable_id column value will be passed by the columnToCheck and value
    public static function checkIfRecordsExists($modelToCehck , $column , $value , $operation , $resource)
    {
        $result = $modelToCehck::where($column , $value)
                    ->exists();

        if($result) {
            if($operation == 'delete') {
                $message = ApiMessages::MSG_NOT_ALLOWED_DELETE;
            } else {
                $message = ApiMessages::MSG_NOT_ALLOWED_UPDATE;
            }
            $message = messageHandler($message , $resource);

            return ApiResponder::notAllowedResponse([] , $message);
        }
    }
}
