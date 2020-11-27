<?php

namespace App\Services\Category;

use App\Helpers\NotificationService;
use Illuminate\Support\Facades\Validator;
use App\Abstracts\MasterClassCategory;

class InvoiceCategoryService extends MasterClassCategory
{
    public function store($data)
    {
        // Composição da classe Notification para uso em qualquer parte desse método
            $notification = new NotificationService();

        try {
            // Criando nova categoria
                $this->model->name = $data['name'];
                $this->model->save();

            return $notification->create('success', ['Cadastro efetuado com sucesso'], 200, $this->model);

        } catch (\Exception $e) {
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
