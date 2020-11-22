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
            $notification->type('error');
            $notification->message($validator->getMessageBag()->all());
            return $notification->create();
        }

        try {
            // Criando nova categoria
            $this->model->name = $data['name'];
            $this->model->save();

            $notification = new NotificationService();
            $notification->type('success');
            $notification->message(['Cadastro efetuado com sucesso']);
            $notification->data($this->model);
            return $notification->create();

        } catch (\Exception $e) {
            $notification = new NotificationService();
            $notification->type('error');
            $notification->message([$e->getMessage()]);
            return $notification->create();
        }
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
