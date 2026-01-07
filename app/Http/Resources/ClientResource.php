<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'uuid'       => $this->uuid,
            'id'         => $this->id,
            'name'       => $this->name,
            'email'      => $this->email,
            'cpf_cnpj'   => $this->cpf_cnpj,
            'phone'      => $this->phone,
            'address'    => $this->address,
            'status'     => (bool)$this->status,
            'created_at' => $this->created_at->format('d/m/Y H:i'),
        ];
    }
}
