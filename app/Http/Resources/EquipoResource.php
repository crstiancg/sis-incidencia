<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'marca' => $this->marca,
            'serie' => $this->serie,
            'ip' => $this->ip,
            'observacion' => $this->observacion,
            'estado' => $this->estado,
            'tipo_equipo' => $this->tipo_equipo,
            'oficina' => new OficinaResource($this->whenLoaded('oficina'))
        ];
    }
}
