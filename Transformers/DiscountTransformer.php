<?php

namespace Modules\Discountable\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Ruleable\Transformers\RuleTransformer;


class DiscountTransformer extends JsonResource
  {
  public function toArray($request)
    {
      $data = [
        'id' => $this->when($this->id, $this->id),
        'status' => $this->status,
        'name' => $this->when($this->name, $this->name),
        'code' => $this->when($this->code, $this->code),
        'value' => $this->when($this->value, $this->value),
        'formatValue' => $this->when($this->value, $this->value.($this->type==='percentage'?'%':'')),
        'type' => $this->when($this->type, $this->type),
        'criteria' => $this->when($this->criteria, $this->criteria),
        'discountable' => $this->discountable,
        'rules' => RuleTransformer::collection($this->whenLoaded('rules')),
        'createdAt' => $this->when($this->created_at, $this->created_at),
        'updatedAt' => $this->when($this->updated_at, $this->updated_at),
      ];

      return $data;

    }
}
