<?php

namespace App\Services\Category;

use App\Helpers\NotificationService;
use Illuminate\Support\Facades\Validator;
use App\Abstracts\MasterClassCategory;

class InvoiceCategoryService extends MasterClassCategory
{
    public function store($data)
    {
        $rules = [
            'name' => 'required',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            $notification = new NotificationService();
            return $notification->create('error', $validator->getMessageBag()->all(), 400);
        }

        try {
            // Criando nova categoria
            $this->model->name = $data['name'];
            $this->model->save();

            $notification = new NotificationService();
            return $notification->create('success', ['Cadastro efetuado com sucesso'], 200, $this->model);

        } catch (\Exception $e) {
            $notification = new NotificationService();
            return $notification->create('error', [$e->getMessage()], 500);
        }
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
