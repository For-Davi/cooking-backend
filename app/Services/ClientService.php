<?php

namespace App\Services;

use App\DTO\Client\CreateClientDTO;
use App\DTO\Client\UpdateClientDTO;
use App\Repositories\ClientRepository;

class ClientService
{
    protected $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($request)
    {
        $clientDTO = CreateClientDTO::fromRequest([
            ...$request->only([
                'name',
                'email',
                'sex',
                'phone',
                'cpf',
                'cnpj',
                'stateRegistration',
                'municipalRegistration',
                'dateBirthday',
                'cep',
                'country',
                'state',
                'city',
                'neighborhood',
                'address',
                'complement',
                'number',
                'description',
            ]),
            'enterpriseId' => $request->get('enterprise_id'),
        ]);

        return $this->repository->create($clientDTO->toArray());
    }

    public function update($request)
    {
        $supplierDTO = UpdateClientDTO::fromRequest([
            ...$request->only([
                'name',
                'email',
                'sex',
                'phone',
                'cpf',
                'cnpj',
                'stateRegistration',
                'municipalRegistration',
                'dateBirthday',
                'cep',
                'country',
                'state',
                'city',
                'neighborhood',
                'address',
                'complement',
                'number',
                'description',
            ]),
            'enterpriseId' => $request->get('enterprise_id'),
        ]);

        return $this->repository->update($request->id, $supplierDTO->toArray());
    }
}
